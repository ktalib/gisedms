<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Exception;
use Illuminate\Support\Facades\Log;

class PrimaryFormController extends Controller
{
    public function index()
    {
        $PageTitle = 'Application for Sectional Titling ';
        $PageDescription = 'Main Application';

        return view('primaryform.index', compact(
            'PageTitle', 
            'PageDescription'
        )); 
    }
    
    public function store(Request $request)
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
                'owner_street_name' => 'nullable',
                'owner_district' => 'nullable',
                'owner_lga' => 'nullable',
                'owner_state' => 'nullable',
                'phone_number' => 'nullable',
                'owner_email' => 'nullable|email',
                'idType' => 'nullable',
                'residenceType' => 'nullable',
                'units_count' => 'nullable',
                'blocks_count' => 'nullable',
                'sections_count' => 'nullable',
                'application_fee' => 'nullable',
                'processing_fee' => 'nullable',
                'site_plan_fee' => 'nullable',
                'payment_date' => 'nullable',
                'receipt_number' => 'nullable',
                'comments' => 'nullable',
                'commercial_type' => 'nullable',
                'passportInput' => 'nullable',
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

            // Process the file number based on active tab
            $fileNo = null;
            if ($request->filled('mlsPreviewFileNumber')) {
                $fileNo = $request->input('mlsPreviewFileNumber');
            } elseif ($request->filled('kangisPreviewFileNumber')) {
                $fileNo = $request->input('kangisPreviewFileNumber');
            } elseif ($request->filled('newKangisPreviewFileNumber')) {
                $fileNo = $request->input('newKangisPreviewFileNumber');
            }

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

            // Process document uploads - using direct file access
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

            // Create data array for insertion
            $data = [
                'applicant_type' => $request->input('applicantType'),
                'applicant_title' => $request->input('applicant_title'),
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'surname' => $request->input('surname'),
                'corporate_name' => $request->input('corporate_name'),
                'rc_number' => $request->input('rc_number'),
                'multiple_owners_names' => $request->has('multiple_owners_names') ? json_encode($request->input('multiple_owners_names')) : null,
                'multiple_owners_passport' => !empty($multipleOwnersPassportPaths) ? json_encode($multipleOwnersPassportPaths) : null,
                'passport' => $passportPath,
                'fileno' => $fileNo,
                'address' =>$request->input('address'),
                'address_house_no' => $request->input('address_house_no'),
                'address_street_name' => $request->input('owner_street_name'),
                'address_district' => $request->input('owner_district'),
                'address_lga' => $request->input('owner_lga'),
                'address_state' => $request->input('owner_state'),
                'phone_number' => $phoneNumber,
                'email' => $request->input('owner_email'),
                'identification_type' => $request->input('idType'),
             
               
                'property_plot_no' => $request->input('property_plot_no'),
                'property_street_name' => $request->input('property_street_name'),
                'property_district' => $request->input('property_district'),
                'property_lga' => $request->input('property_lga'),
                'property_state' => $request->input('property_state'),
                'NoOfUnits' => $request->input('units_count'),
                'application_fee' => $request->input('application_fee'),
                'processing_fee' => $request->input('processing_fee'),
                'site_plan_fee' => $request->input('site_plan_fee'),
                'payment_date' => $request->input('payment_date'),
                'receipt_number' => $request->input('receipt_number'),
                'comments' => $request->input('comments'),
                'commercial_type' => $request->input('commercial_type'),
                'residential_type' => $request->input('residenceType'),
                'industrial_type' => $request->input('industrial_type'),
                'land_use' => $request->input('land_use'),
                'application_status' => 'Pending',
                'applicationID' => date('Y').'-'.str_pad((DB::connection('sqlsrv')->table('mother_applications')->count() + 1), 2, '0', STR_PAD_LEFT),
                'created_at' => now(),
                'updated_at' => now(),
                // Store documents as a proper JSON string
                'documents' => !empty($documents) ? json_encode($documents) : null,
            ];

            // Log the data being inserted
            Log::info('Data being inserted into DB', [
                'documents' => $data['documents'],
                'document_count' => count($documents)
            ]);

            // Insert data into the mother_applications table
            $applicationId = DB::connection('sqlsrv')->table('mother_applications')->insertGetId($data);

            // Log successful submission
            Log::info('Application submitted successfully', ['application_id' => $applicationId]);

            // Return response with success message and flash data
            return redirect()->route('primaryform.index')
                ->with('success', 'Application submitted successfully! Your application ID is: ' . $applicationId)
                ->with('application_id', $applicationId);
        } catch (Exception $e) {
            // Enhanced error logging for debugging
            Log::error('Error submitting application form', [
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