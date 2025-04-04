<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SaveMainAppController extends Controller
{
    public function storeMotherApp(Request $request)
    {
        try {
            // Debug log to verify the method is being called
            Log::info('storeMotherApp method called', ['request_data' => $request->all()]);
            
            // Validate common fields
            $validator = Validator::make($request->all(), [
                'applicant_type' => 'required|in:individual,corporate,multiple',
                'fileno' => 'required|string|max:255',
                'landuse' => 'nullable|string',
                'land_use' => 'nullable|string',
                'NoOfUnits' => 'required|integer|min:1',
                'identification_type' => 'required',
                'phone_number' => 'required|array|min:1',
                'phone_number.*' => 'nullable|string|max:20',
                'email' => 'required|email|max:255',
                
                // Make all type fields nullable
                'residential_type' => 'nullable|string',
                'industrial_type' => 'nullable',
                'commercial_type' => 'nullable|string',
                
                // Address fields
                'address_house_no' => 'required|string|max:50',
                'address_plot_no' => 'required|string|max:50',
                'address_street_name' => 'required|string|max:100',
                'address_district' => 'required|string|max:100',
                'address_lga' => 'required|string|max:100', // Will map to address_lga
                'address_state' => 'required|string|max:50', // Will map to address_state
                
                // Fee fields
                'application_fee' => 'required|numeric',
                'processing_fee' => 'required|numeric',
                'site_plan_fee' => 'required|numeric',
                'payment_date' => 'required|date',
                'receipt_number' => 'required|string',
                
                // Property fields for residential
                'property_house_no' => 'nullable|string|max:50',
                'property_plot_no' => 'nullable|string|max:50',
                'property_street_name' => 'nullable|string|max:100',
                'property_district' => 'nullable|string|max:100',
                'property_lga' => 'nullable|string|max:100',
                'property_state' => 'nullable|string|max:50',
            ]);

            // Add conditional validation based on applicant type
            if ($request->input('applicant_type') === 'individual') {
                $validator->addRules([
                    'applicant_title' => 'required|string|max:20',
                    'first_name' => 'required|string|max:100',
                    'surname' => 'required|string|max:100',
                    'passport' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
            } elseif ($request->input('applicant_type') === 'corporate') {
                $validator->addRules([
                    'corporate_name' => 'required|string|max:255',
                    'rc_number' => 'required|string|max:50',
                ]);
            } elseif ($request->input('applicant_type') === 'multiple') {
                $validator->addRules([
                    'multiple_owners_names' => 'required|array|min:1',
                    'multiple_owners_names.*' => 'required|string',
                    'multiple_owners_passport.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
            }
            
            // Add residential-specific validation if landuse is Residential
            if (strtolower($request->input('landuse')) === 'residential' || strtolower($request->input('land_use')) === 'residential') {
                $validator->addRules([
                    'residential_type' => 'required|string',
                    'ownership_type' => 'required|string',
                ]);
                
                // If 'others' is selected, require specification
                if ($request->input('residential_type') === 'others') {
                    $validator->addRules(['residentialOthersInput' => 'required|string|max:255']);
                }
                
                if ($request->input('ownership_type') === 'others') {
                    $validator->addRules(['ownership_type_others_text' => 'required|string|max:255']);
                }
            }
            
            // Check if commercial type is required
            if (strtolower($request->input('landuse')) === 'commercial' || strtolower($request->input('land_use')) === 'commercial') {
                $validator->addRules(['commercial_type' => 'required|string']);
                
                if ($request->input('commercial_type') === 'Others') {
                    $validator->addRules(['commercial_type_others' => 'required|string|max:255']);
                }
            }
            
            // Check if industrial type is required 
            if (strtolower($request->input('landuse')) === 'industrial' || strtolower($request->input('land_use')) === 'industrial') {
                $validator->addRules(['industrial_type' => 'required|string']);
                
                if ($request->input('industrial_type') === 'Others') {
                    $validator->addRules(['industrial_type_others' => 'required|string|max:255']);
                }
            }
            
            // Run validation with more detailed error handling
            if ($validator->fails()) {
                Log::error('Validation failed: ' . json_encode($validator->errors()->toArray()));
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please check the form for errors.');
            }
            
            // Prepare data for database insertion - exclude form_debug field
            $data = $request->except(['_token', 'form_debug']);
            
            // Map shortened field names to their full database column names
            $fieldMappings = [
                'address_lga' => 'address_lga',
                'address_state' => 'address_state'
            ];
            
            foreach ($fieldMappings as $shortName => $fullName) {
                if (isset($data[$shortName])) {
                    $data[$fullName] = $data[$shortName];
                    unset($data[$shortName]);
                }
            }
            
            // Explicitly map landuse to land_use field
            if (isset($data['landuse'])) {
                $data['land_use'] = $data['landuse'];
                unset($data['landuse']);
            }
            
            // Set default values for required fields if they weren't provided
            if (!isset($data['application_status'])) {
                $data['application_status'] = 'pending';
            }
            
            if (!isset($data['planning_recommendation_status'])) {
                $data['planning_recommendation_status'] = 'pending';
            }
            
            // Construct address from address components if no combined address is provided
            if (!isset($data['address']) && isset($data['address_house_no'])) {
                $address_parts = [
                    $data['address_house_no'] ?? '',
                    $data['address_plot_no'] ?? '',
                    $data['address_street_name'] ?? '',
                    $data['address_district'] ?? '',
                    $data['address_lga'] ?? '',
                    $data['address_state'] ?? ''
                ];
                $data['address'] = implode(', ', array_filter($address_parts));
            }
            
            // Handle file uploads
            if ($request->hasFile('passport')) {
                $data['passport'] = $request->file('passport')->store('passports', 'public');
            }
            
            if ($request->hasFile('multiple_owners_passport')) {
                $files = $request->file('multiple_owners_passport');
                $filePaths = [];
                foreach ($files as $file) {
                    $filePaths[] = $file->store('multiple_owners_passports', 'public');
                }
                $data['multiple_owners_passport'] = json_encode($filePaths);
            }
            
            // JSON encode arrays
            $jsonFields = ['industrial_type', 'phone_number', 'multiple_owners_names'];
            foreach ($jsonFields as $field) {
                if (isset($data[$field]) && is_array($data[$field])) {
                    $data[$field] = json_encode($data[$field]);
                }
            }
            
            // Remove form fields that don't match database columns
            $data = Arr::except($data, [
                'fileNoPrefix', 
                'fileNumber', 
                'Previewflenumber', 
                'applicant_name_preview',
                'industrial_type_others',
                'commercial_type_others',
                'residentialType',  // Remove this as we're now using residential_type directly
                'residentialOthersInput',
                'form_debug'  // Add form_debug to the exclude list again for safety
            ]);
            
            // Add timestamps
            $data['created_at'] = now();
            $data['updated_at'] = now();
            
            // Log data before insertion attempt
            Log::info('About to insert mother application data', ['data_keys' => array_keys($data)]);
            
            try {
                // Insert the data with explicit transaction
                DB::connection('sqlsrv')->beginTransaction();
                DB::connection('sqlsrv')->table('dbo.mother_applications')->insert($data);
                DB::connection('sqlsrv')->commit();
                
                Log::info('Mother application inserted successfully');
                
                // Use a flash message that will be visible on the next page load
                return redirect()->route('sectionaltitling.index')
                    ->with('success', 'Mother Application created successfully.');
            } catch (\Exception $e) {
                DB::connection('sqlsrv')->rollBack();
                Log::error('Database error during insertion: ' . $e->getMessage(), [
                    'exception' => $e,
                    'sql_state' => $e->getCode(),
                    'trace' => $e->getTraceAsString()
                ]);
                
                // Return with detailed error for debugging
                return redirect()->back()
                    ->with('error', 'Database error: ' . $e->getMessage())
                    ->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Unexpected error in storeMotherApp: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'An unexpected error occurred. Please try again or contact support.')
                ->withInput();
        }
    }
}
