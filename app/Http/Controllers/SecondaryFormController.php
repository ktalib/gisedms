<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Exception;
use Illuminate\Support\Facades\Log;

class SecondaryFormController extends Controller
{

    public function save(Request $request)
    {
        try {
            // Validate the form data - making some fields optional to improve form submission success
            $validated = $request->validate([
                'applicantType' => 'required',
                'applicant_title' => 'nullable',
                'first_name' => 'nullable',
                'middle_name' => 'nullable',
                'surname' => 'nullable',
                'corporate_name' => 'nullable',
                'rc_number' => 'nullable',
                'multiple_owners_names' => 'nullable|array',
                'multiple_owners_passport' => 'nullable|array',
                'multiple_owners_passport.*' => 'nullable|image|max:5120',
                'address_house_no' => 'nullable',
                'address_street_name' => 'nullable',
                'address_district' => 'nullable',
                'address_lga' => 'nullable',
                'address_state' => 'nullable',
                'phone_number' => 'nullable|array',
                'owner_email' => 'nullable|email',
                'identification_type' => 'nullable',
                'residence_type' => 'nullable',
                'block_number' => 'nullable',
                'floor_number' => 'nullable',
                'unit_number' => 'nullable',
                'application_fee' => 'nullable',
                'processing_fee' => 'nullable',
                'site_plan_fee' => 'nullable',
                'payment_date' => 'nullable',
                'receipt_number' => 'nullable',
                'application_comment' => 'nullable',
                'commercial_type' => 'nullable',
                'industrial_type' => 'nullable',
                'ownership_type' => 'nullable',
                'ownershipType' => 'nullable',
                'otherOwnership' => 'nullable',
                'shared_areas' => 'nullable|array',
                'main_application_id' => 'required',
                'scheme_no' => 'nullable',
                'prefix' => 'required',
                'year' => 'required',
                'serial_number' => 'required',
                'fileno' => 'required',
                'application_letter' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
                'building_plan' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
                'architectural_design' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
                'ownership_document' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
            ]);

            // Debug log to check what's being received
            Log::info('Form data received', [
                'owner_fullname' => $request->input('fullname'),
                'all_data' => $request->all()
            ]);

            // Handle passport upload
            $passportPath = null;
            if ($request->hasFile('passport')) {
                $passport = $request->file('passport');
                $passportPath = $passport->store('passports', 'public');
            }

            // Handle multiple owners passports upload
            $multipleOwnersPassportPaths = [];
            if ($request->hasFile('multiple_owners_passport')) {
                foreach ($request->file('multiple_owners_passport') as $passport) {
                    if ($passport && $passport->isValid()) {
                        $path = $passport->store('multiple_owners_passports', 'public');
                        $multipleOwnersPassportPaths[] = $path;
                    }
                }
            }

            // Process document uploads
            $documents = [];
            $documentTypes = ['application_letter', 'building_plan', 'architectural_design', 'ownership_document'];
            
            foreach ($documentTypes as $docType) {
                if ($request->hasFile($docType)) {
                    $file = $request->file($docType);
                    if ($file && $file->isValid()) {
                        $originalName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $path = $file->store('documents', 'public');
                        
                        // Add detailed info about each document
                        $documents[$docType] = [
                            'path' => $path,
                            'original_name' => $originalName,
                            'type' => $extension,
                            'uploaded_at' => now()->toDateTimeString()
                        ];
                        
                        Log::info('Document uploaded', [
                            'docType' => $docType,
                            'path' => $path,
                            'original_name' => $originalName
                        ]);
                    }
                }
            }

            // Format phone numbers
            $phoneNumber = null;
            if ($request->has('phone_number') && is_array($request->input('phone_number'))) {
                $phoneNumber = implode(', ', array_filter($request->input('phone_number')));
            } elseif ($request->has('phone_number')) {
                $phoneNumber = $request->input('phone_number');
            }
            
            // Process shared areas
            $sharedAreas = null;
            if ($request->has('shared_areas') && is_array($request->input('shared_areas'))) {
                $sharedAreas = json_encode($request->input('shared_areas'));
            }
            
            // Process ownership type
            $ownershipType = $request->input('ownershipType');
            if ($ownershipType === 'others' && $request->filled('otherOwnership')) {
                $ownershipType = $request->input('otherOwnership');
            }
            
            // Create data array for subapplications table
            $subApplicationData = [
                'main_id' => $request->input('main_application_id'),
                'applicant_type' => $request->input('applicantType'),
                'fileno' => $request->input('fileno'),
                'applicant_title' => $request->input('applicant_title'),
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'surname' => $request->input('surname'),
                'passport' => $passportPath,
                'corporate_name' => $request->input('corporate_name'),
                'rc_number' => $request->input('rc_number'),
                'multiple_owners_names' => $request->has('multiple_owners_names') ? json_encode($request->input('multiple_owners_names')) : null,
                'multiple_owners_passport' => !empty($multipleOwnersPassportPaths) ? json_encode($multipleOwnersPassportPaths) : null,
                'address' => $request->input('address'),
                'phone_number' => $phoneNumber,
                'email' => $request->input('owner_email'),
                'identification_type' => $request->input('identification_type'),
                'block_number' => $request->input('block_number'),
                'floor_number' => $request->input('floor_number'),
                'unit_number' => $request->input('unit_number'),
                'application_status' => 'Pending',
                 'planning_recommendation_status' => 'Pending',
                'application_fee' => $request->input('application_fee'),
                'processing_fee' => $request->input('processing_fee'),
                'site_plan_fee' => $request->input('site_plan_fee'),
                'payment_date' => $request->input('payment_date'),
                'receipt_number' => $request->input('receipt_number'),
                'commercial_type' => $request->input('commercial_type'),
                'industrial_type' => $request->input('industrial_type'),
                'residence_type' => $request->input('residence_type'),
                'ownership_type' => $ownershipType,
                'address_street_name' => $request->input('address_street_name'),
                'address_district' => $request->input('address_district'),
                'address_lga' => $request->input('address_lga'),
                'address_state' => $request->input('address_state'),
                'scheme_no' => $request->input('scheme_no'),
                'shared_areas' => $sharedAreas,
                'documents' => !empty($documents) ? json_encode($documents) : null,
                'application_comment' => $request->input('application_comment'),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'updated_by' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            ];

            // Get the land use from the mother application
            $motherApplication = DB::connection('sqlsrv')->table('mother_applications')
                ->where('applicationID', $request->input('main_application_id'))
                ->first();
                
            if ($motherApplication) {
                $subApplicationData['land_use'] = $motherApplication->land_use;
            }

            // Log the data being inserted into subapplications
            Log::info('Data being inserted into subapplications table', [
                'documents' => $subApplicationData['documents'],
                'document_count' => count($documents)
            ]);

            // Insert data into the subapplications table
            $subApplicationId = DB::connection('sqlsrv')->table('subapplications')->insertGetId($subApplicationData);

            // Now insert into StFileNo table
            $stFileNoData = [
                'file_prefix' => $request->input('prefix'),
                'year' => $request->input('year'),
                'serial_number' => $request->input('serial_number'),
                'fileno' => $request->input('fileno'),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => Auth::user()->first_name . ' ' . Auth::user()->last_name
            ];

            // Insert data into the StFileNo table
            DB::connection('sqlsrv')->table('StFileNo')->insert($stFileNoData);

            // Log successful submission
            Log::info('Sub-application submitted successfully', [
                'subapplication_id' => $subApplicationId, 
                'fileno' => $request->input('fileno')
            ]);

            // Return response with success message and flash data
            return back()
                ->with('success', 'Secondary application submitted successfully!')
                ->with('application_id', $subApplicationId);
                
        } catch (Exception $e) {
            // Enhanced error logging for debugging
            Log::error('Error submitting sub-application form', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'form_data' => $request->all()
            ]);

            // Return with error message
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error submitting application: ' . $e->getMessage());
        }
    }
}