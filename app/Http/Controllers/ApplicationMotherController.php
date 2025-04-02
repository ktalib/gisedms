<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ApplicationMotherController extends Controller
{
    public function landuse()
    {
        return view('sectionaltitling.landuse');
    }

    public function index()
    {
        $Main_application = DB::connection('sqlsrv')->table('dbo.mother_applications')->get();

        return view('sectionaltitling.index', compact('Main_application'));
    }
    
    public function subApplication()
    {
        // Get the land use type from the request
        $landUse = request()->get('land_use');
        $prefix = '';

        // Determine the prefix based on land use
        if (strtolower($landUse) === 'commercial') {
            $prefix = 'ST-COM';
        } elseif (strtolower($landUse) === 'residential') {
            $prefix = 'ST-RES';
        } elseif (strtolower($landUse) === 'industrial') {
            $prefix = 'ST-IND';
        }

        // Get the current year
        $currentYear = date('Y');

        // Find the last serial number for this specific prefix and year
        $lastRecord = DB::connection('sqlsrv')
            ->table('dbo.StFileNo')
            ->where('file_prefix', $prefix)
            ->where('year', $currentYear)
            ->orderBy('serial_number', 'desc')
            ->first();

        // Determine the next serial number for this prefix-year combination
        $nextSerialNumber = 1; // Default to 1 if no previous records

        if ($lastRecord) {
            $nextSerialNumber = intval($lastRecord->serial_number) + 1;
        }

        // Format the serial number with leading zeros (e.g., 01, 02, etc.)
        $formattedSerialNumber = sprintf('%02d', $nextSerialNumber);

        return view('sectionaltitling.sub_application', compact('nextSerialNumber', 'prefix', 'currentYear', 'formattedSerialNumber'));
    }

    public function create()
    {
        return view('sectionaltitling.create');
    }
    public function Subapplications(Request $request)
    {
        $query = DB::connection('sqlsrv')
            ->table('dbo.subapplications AS sub')
            ->join('dbo.mother_applications AS main', 'sub.main_application_id', '=', 'main.id')
            ->select([
                'sub.*', 'main.fileno as main_fileno', 'main.plot_size', 'main.land_use', 'main.plot_house_no',
                'main.plot_street_name', 'main.owner_district', 'main.address', 'main.approval_date',
                'main.applicant_type as main_applicant_type', 'main.applicant_title as main_applicant_title',
                'main.first_name as main_first_name', 'main.middle_name as main_middle_name',
                'main.surname as main_surname', 'main.corporate_name as main_corporate_name',
                'main.multiple_owners_names as main_multiple_owners_names'
            ]);
            
        // Filter by main_application_id if provided in the URL
        if ($request->has('main_application_id')) {
            $mainId = $request->main_application_id;
            
            // Check if main application exists
            $mainAppExists = DB::connection('sqlsrv')
                ->table('dbo.mother_applications')
                ->where('id', $mainId)
                ->exists();
                
            if (!$mainAppExists) {
                return redirect()->back()->with('sweet_alert', [
                    'type' => 'error',
                    'title' => 'Error',
                    'text' => 'Mother application with ID ' . $mainId . ' not found.'
                ]);
            }
            
            $query->where('sub.main_application_id', $mainId);
        }
        
        $subApplications = $query->get();

        // If filtering by main_application_id and no results found
        if ($request->has('main_application_id') && $subApplications->isEmpty()) {
            return view('sectionaltitling.sub_applications', compact('subApplications'))
                ->with('sweet_alert', [
                    'type' => 'info',
                    'title' => 'No Records',
                    'text' => 'No sub-applications found for mother application ID ' . $request->main_application_id
                ]);
        }

        return view('sectionaltitling.sub_applications', compact('subApplications'));
    }

    public function GenerateBill(Request $request, $id = null)
    {
        // Use either route parameter or query parameter for ID
        $id = $id ?? $request->get('id');
        
        // Fetch application data from database if ID is provided
        if ($id) {
            $application = DB::connection('sqlsrv')
                ->table('dbo.mother_applications')
                ->where('id', $id)
                ->first();
                
            if ($application) {
                // Process owner name based on application type
                $ownerName = '';
                if ($application->applicant_type == 'corporate' && $application->corporate_name) {
                    $ownerName = $application->corporate_name;
                } elseif ($application->applicant_type == 'multiple' && $application->multiple_owners_names) {
                    // Try to decode JSON; if it fails, use as a string
                    $multipleOwners = json_decode($application->multiple_owners_names, true);
                    $ownerName = is_array($multipleOwners) ? implode(', ', $multipleOwners) : $application->multiple_owners_names;
                } else {
                    $ownerName = trim($application->first_name . ' ' . $application->middle_name . ' ' . $application->surname);
                }
                
                // Calculate fees based on land use
                $processingFee = 0;
                $surveyFee = 0;
                $assignmentFee = 0;
                $billBalance = 30525.00; // Default bill balance
                $groundRent = 0;
                
                if (strtolower($application->land_use) == 'residential') {
                    $processingFee = 20000.00;
                    $surveyFee = isset($application->NoOfUnits) && $application->NoOfUnits > 1 ? 50000.00 : 70000.00; // Block of flats or apartment
                    $assignmentFee = 50000.00;
                } else { // Commercial or others
                    $processingFee = 50000.00;
                    $surveyFee = 100000.00;
                    $assignmentFee = 100000.00;
                }
                
                // Calculate total
                $total = $processingFee + $surveyFee + $assignmentFee + $billBalance + $groundRent;
                
                // Format date
                $approvalDate = $request->get('approval_date') ?? 
                    (isset($application->approval_date) ? date('Y-m-d', strtotime($application->approval_date)) : date('Y-m-d'));
                
                // Convert plot size to more readable format if needed
                $plotSize = $application->plot_size;
                if (is_numeric($plotSize) && $plotSize > 0) {
                    // Format plot size (example: convert to square meters notation if needed)
                    $plotSize = number_format($plotSize, 2) . ' sqm';
                }
                
                // Prepare data for the view
                $data = [
                    'id' => $application->id,
                    'fileno' => $application->fileno,
                    'applicant_title' => $application->applicant_title,
                    'owner_name' => $ownerName,
                    'plot_size' => $plotSize,
                    'land_use' => $application->land_use,
                    'plot_house_no' => $application->plot_house_no,
                    'plot_plot_no' => $application->plot_plot_no,
                    'plot_street_name' => $application->plot_street_name,
                    'owner_district' => $application->plot_district,
                    'address' => $application->address,
                    'approval_date' => $approvalDate,
                    'processing_fee' => $processingFee,
                    'survey_fee' => $surveyFee,
                    'assignment_fee' => $assignmentFee,
                    'bill_balance' => $billBalance,
                    'ground_rent' => $groundRent,
                    'total' => $total,
                    'total_words' => $this->numberToWords($total),
                    'application_type' => $application->applicant_type,
                ];
                
                return view('sectionaltitling.generate_bill', $data);
            }
        }
        
        // Fallback to request data if no database record found
        $data = $request->only([
            'id', 'fileno', 'applicant_title', 'owner_name', 'plot_house_no',
            'plot_street_name', 'address', 'owner_district', 'approval_date', 'plot_size', 'land_use'
        ]);
        
        return view('sectionaltitling.generate_bill', $data);
    }

    /**
     * Convert a number to words
     * @param float $number The number to convert
     * @return string The number in words
     */
    private function numberToWords($number) 
    {
        $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);
        return strtoupper($formatter->format($number) . ' NAIRA ONLY');
    }

    public function AcceptLetter()
    {
        return view('sectionaltitling.AcceptLetter');
    }

    public function storeMotherApp(Request $request)
    {
        $request->validate([
            'applicant_type' => 'required',
            'applicant_title' => 'nullable',
            'first_name' => 'nullable',
            'middle_name' => 'nullable',
            'surname' => 'nullable',
            'passport' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fileno' => 'nullable',
            'corporate_name' => 'nullable',
            'rc_number' => 'nullable',
            'multiple_owners_names' => 'nullable',
            'multiple_owners_passport' => 'nullable',
            'address' => 'nullable',
            'phone_number' => 'nullable',
            'email' => 'nullable|email',
            'identification_type' => 'nullable',
            'NoOfUnits' => 'nullable',
            'plot_house_no' => 'nullable',
            'plot_plot_no' => 'nullable',
            'plot_street_name' => 'nullable',
            'plot_district' => 'nullable',
            'owner_house_no' => 'nullable',
            'owner_plot_no' => 'nullable',
            'owner_street_name' => 'nullable',
            'owner_district' => 'nullable',
            'additional_comments' => 'nullable',
            'application_fee' => 'nullable|numeric',
            'payment_date' => 'nullable|date',
            'receipt_number' => 'nullable',
            'receipt_date' => 'nullable|date',
            'revenue_accountant' => 'nullable',
            'accountant_signature_date' => 'nullable|date',
            'scheme_no' => 'nullable',
            'application_status' => 'required|string|in:pending',
            'approval_date' => 'nullable|date',
            'plot_size' => 'nullable|numeric',
            'land_use' => 'nullable',
            'comments' => 'nullable',
            'planning_recommendation_status' => 'required|string|in:pending',
            'application_fee' => 'nullable|numeric',
            'processing_fee' => 'nullable|numeric',
            'site_plan_fee' => 'nullable|numeric',
            'payment_date' => 'nullable',
            'receipt_number' => 'nullable',
            'address_house_no' => 'nullable|string|max:50',
            'address_plot_no' => 'nullable|string|max:50',
            'address_street_name' => 'nullable|string|max:100',
            'address_district' => 'nullable|string|max:100',
            'address_lga' => 'nullable|string|max:100',
            'address_state' => 'nullable|string|max:50',
            'property_house_no' => 'nullable|string|max:50',
            'property_plot_no' => 'nullable|string|max:50',
            'property_street_name' => 'nullable|string|max:100',
            'property_district' => 'nullable|string|max:100',
            'property_lga' => 'nullable|string|max:100',
            'property_state' => 'nullable|string|max:50',
            'residential_type' => 'nullable|string|max:50',
            'house_number' => 'nullable|string|max:50',
            'floor_number' => 'nullable|string|max:20',
            'ownership_type' => 'nullable|string|max:50',
            'ownership_type_others_text' => 'nullable|string|max:255'
        ]);

        $data = $request->except('_token', 'fileNoPrefix', 'fileNumber');

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

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = json_encode($value);
            }
        }

        DB::connection('sqlsrv')->table('dbo.mother_applications')->insert($data);

        return redirect()->route('sectionaltitling.index')->with('success', 'Mother Application created successfully.');
    }

    public function storeSub(Request $request)
    {
        $validatedData = $request->validate([
            'main_application_id' => 'required|integer',
            'applicant_type' => 'required|in:individual,corporate,multiple',
            'fileno' => 'nullable|string|max:255',
            'applicant_title' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'passport' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'corporate_name' => 'nullable|string|max:255',
            'rc_number' => 'nullable|string|max:255',
            'multiple_owners_names' => 'nullable|string',
            'multiple_owners_passport' => 'nullable',
            'multiple_owners_data' => 'nullable|string',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'identification_type' => 'nullable|string|max:255',
            'identification_others' => 'nullable|string',
            'block_number' => 'nullable|string|max:255',
            'floor_number' => 'nullable|string|max:255',
            'unit_number' => 'nullable|string|max:255',
            'property_location' => 'nullable|string',
            'ownership' => 'nullable|string|max:255',
            'application_status' => 'required|string|in:pending',
            'comments' => 'nullable|string',
            'approval_date' => 'nullable|date',
            'planning_recommendation_status' => 'required|string|in:pending',
        ]);

        // Insert into StFileNo table
        DB::connection('sqlsrv')->table('dbo.StFileNo')->insert([
            'file_prefix' => $request->input('file_prefix'),
            'serial_number' => $request->input('serial_number'),
            'year' => $request->input('year'),
            'fileno' => $request->input('fileno'),
        ]);

        if ($request->hasFile('passport')) {
            $validatedData['passport'] = $request->file('passport')->store('sub_applications/passports', 'public');
        }

        DB::connection('sqlsrv')->table('dbo.subapplications')->insert($validatedData);

        return redirect()->route('sectionaltitling.sub_applications')->with('success', 'Sub-application created successfully.');
    }

    public function decisionSubApplication(Request $request)
    {
        $id = $request->input('id');
        $decision = $request->input('decision');
        $approval_date = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $request->input('approval_date'))));
        $comments = $request->input('comments');

        $subApp = DB::connection('sqlsrv')->table('dbo.subapplications')->where('id', $id)->first();

        if (!$subApp) {
            return response()->json(['message' => 'Sub-application not found.'], 404);
        }

        $updateData = ['application_status' => $decision == 'approve' ? 'Approved' : 'Declined', 'approval_date' => $approval_date];
        if ($decision == 'decline') {
            $updateData['comments'] = $comments;
        }

        DB::connection('sqlsrv')->table('dbo.subapplications')->where('id', $id)->update($updateData);

        return response()->json([
            'message' => $decision == 'approve'
                ? "Approval for Subdivision of Fileno {$subApp->fileno} has been granted."
                : "Sub-application has been declined."
        ]);
    }

    public function decisionMotherApplication(Request $request)
    {
        $id = $request->input('id');
        $decision = $request->input('decision');
        $approval_date = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $request->input('approval_date'))));
        $comments = $request->input('comments');

        $app = DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->first();

        if (!$app) {
            return response()->json(['message' => 'Application not found.'], 404);
        }

        $updateData = ['application_status' => $decision == 'approve' ? 'Approved' : 'Declined', 'approval_date' => $approval_date];
        if ($decision == 'decline') {
            $updateData['comments'] = $comments;
        }

        DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->update($updateData);

        return response()->json([
            'message' => $decision == 'approve'
                ? "Approval has been sent to fragmentation of File Number {$app->fileno}."
                : "Application has been declined."
        ]);
    }

    public function planningRecommendation(Request $request)
    {
        $id = $request->input('id');
        $decision = $request->input('decision');
        $approval_date = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $request->input('approval_date'))));
        $comments = $request->input('comments');
        $fileno = $request->input('fileno');
        $owner_name = $request->input('owner_name');
        $plot_location = $request->input('plot_location');
        $land_use = $request->input('land_use');
        $plot_size = $request->input('plot_size');

        $app = DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->first();

        if (!$app) {
            return response()->json(['message' => 'Application not found.'], 404);
        }

        $updateData = [
            'planning_recommendation_status' => $decision == 'approve' ? 'Approved' : 'Declined', 
            'planning_approval_date' => $approval_date,
            'planning_officer' => Auth::user()->name, // Store the name of the planning officer
        ];
        
        if ($decision == 'decline') {
            $updateData['planning_comments'] = $comments;
        }

        DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->update($updateData);

        // Store the planning recommendation for printing
        $recommendationData = [
            'application_id' => $id,
            'fileno' => $fileno,
            'owner_name' => $owner_name,
            'plot_location' => $plot_location,
            'land_use' => $land_use,
            'plot_size' => $plot_size,
            'recommendation' => $decision == 'approve' ? 'Approved' : 'Declined',
            'comments' => $comments,
            'approved_by' => Auth::user()->name,
            'approval_date' => $approval_date,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Check if the planning_recommendations table exists, if not we can just skip this part
        try {
            DB::connection('sqlsrv')->table('dbo.planning_recommendations')->insert($recommendationData);
        } catch (\Exception $e) {
            // Table might not exist, continue without error
        }

        return response()->json([
            'message' => $decision == 'approve'
                ? "Planning recommendation has been approved for File Number {$app->fileno}."
                : "Planning recommendation has been declined.",
            'data' => $recommendationData
        ]);
    }

    public function departmentApproval(Request $request)
    {
        $id = $request->input('id');
        $department = $request->input('department');
        $action = $request->input('action');
        $comments = $request->input('comments');
        $approval_date = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $request->input('approval_date'))));

        $app = DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->first();

        if (!$app) {
            return response()->json(['message' => 'Application not found.'], 404);
        }

        $updateField = '';
        $message = '';

        switch ($department) {
            case 'finance':
                $updateField = 'finance_status';
                $message = "Finance approval has been updated";
                break;
            case 'survey':
                $updateField = 'survey_status';
                $message = "Survey approval has been updated";
                break;
            case 'lands':
                $updateField = 'lands_status';
                $message = "Lands approval has been updated";
                break;
            case 'deeds':
                $updateField = 'deeds_status';
                $message = "Deeds approval has been updated";
                break;
            default:
                return response()->json(['message' => 'Invalid department specified.'], 400);
        }

        $updateData = [
            $updateField => $action == 'approve' ? 'Approved' : 'Declined',
            "{$department}_approval_date" => $approval_date
        ];

        if ($action == 'decline') {
            $updateData["{$department}_comments"] = $comments;
        }

        DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->update($updateData);

        return response()->json([
            'message' => $message . " for File Number {$app->fileno}."
        ]);
    }

    public function getBillingData($id)
    {
        try {
            $application = DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->first();
            
            if (!$application) {
                \Log::error("getBillingData: Application with ID {$id} not found");
                return response()->json(['error' => 'Application not found'], 404);
            }
            
            \Log::info("getBillingData: Successfully retrieved data for application ID {$id}");
            return response()->json([
                'application_fee' => $application->application_fee,
                'processing_fee' => $application->processing_fee,
                'site_plan_fee' => $application->site_plan_fee,
                'payment_date' => $application->payment_date,
                'receipt_number' => $application->receipt_number
            ]);
        } catch (\Exception $e) {
            \Log::error("getBillingData: Error retrieving data for application ID {$id}: " . $e->getMessage());
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    }
    
    
    public function getBillingData2($id)
    {
        try {
            $application = DB::connection('sqlsrv')->table('dbo.subapplications')->where('id', $id)->first();
            
            if (!$application) {
                \Log::error("getBillingData2: Application with ID {$id} not found");
                return response()->json(['error' => 'Application not found'], 404);
            }
            
            \Log::info("getBillingData2: Successfully retrieved data for application ID {$id}");
            return response()->json([
                'application_fee' => $application->application_fee,
                'processing_fee' => $application->processing_fee,
                'site_plan_fee' => $application->site_plan_fee,
                'payment_date' => $application->payment_date,
                'receipt_number' => $application->receipt_number
            ]);
        } catch (\Exception $e) {
            \Log::error("getBillingData2: Error retrieving data for application ID {$id}: " . $e->getMessage());
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    }
    
    public function saveBillingData(Request $request)
    {
        try {
            $request->validate([
                'application_id' => 'required|integer',
                'application_fee' => 'nullable|numeric',
                'processing_fee' => 'nullable|numeric',
                'site_plan_fee' => 'nullable|numeric',
                'payment_date' => 'nullable|date',
                'receipt_number' => 'nullable|string',
            ]);
            
            $id = $request->input('application_id');
            \Log::info("saveBillingData: Attempting to save billing data for application ID {$id}");
            
            $app = DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->first();
            
            if (!$app) {
                \Log::error("saveBillingData: Application with ID {$id} not found");
                return response()->json(['error' => 'Application not found'], 404);
            }
            
            $updateData = [
                'application_fee' => $request->input('application_fee'),
                'processing_fee' => $request->input('processing_fee'),
                'site_plan_fee' => $request->input('site_plan_fee'),
                'payment_date' => $request->input('payment_date'),
                'receipt_number' => $request->input('receipt_number'),
            ];
            
            DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->update($updateData);
            \Log::info("saveBillingData: Successfully saved billing data for application ID {$id}");
            
            return response()->json([
                'message' => "Billing information has been updated for File Number {$app->fileno}."
            ]);
        } catch (\Exception $e) {
            \Log::error("saveBillingData: Error saving data: " . $e->getMessage());
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Save E-Registry information for an application
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveERegistry(Request $request)
    {
        try {
            $request->validate([
                'application_id' => 'required|integer',
                'file_location' => 'nullable|string',
                'commission_date' => 'nullable|date',
                'decommission_date' => 'nullable|date',
            ]);
            
            $id = $request->input('application_id');
            \Log::info("saveERegistry: Attempting to save E-Registry data for application ID {$id}");
            
            $app = DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->first();
            
            if (!$app) {
                \Log::error("saveERegistry: Application with ID {$id} not found");
                return response()->json(['error' => 'Application not found'], 404);
            }
            
            $updateData = [
                'file_location' => $request->input('file_location'),
                'file_commission_date' => $request->input('commission_date'),
                'file_decommission_date' => $request->input('decommission_date'),
                'updated_at' => now(),
            ];
            
            DB::connection('sqlsrv')->table('dbo.mother_applications')->where('id', $id)->update($updateData);
            \Log::info("saveERegistry: Successfully saved E-Registry data for application ID {$id}");
            
            return response()->json([
                'message' => "E-Registry information has been updated for File Number {$app->fileno}."
            ]);
        } catch (\Exception $e) {
            \Log::error("saveERegistry: Error saving data: " . $e->getMessage());
            return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
        }
    }

    public function Veiwrecords(Request $request)
    {
        $id = $request->query('id');
        
        if (!$id) {
            return redirect()->route('sectionaltitling.index')->with('error', 'No record ID provided');
        }
        
        $application = DB::connection('sqlsrv')
            ->table('dbo.mother_applications')
            ->where('id', $id)
            ->first();
            
        if (!$application) {
            return redirect()->route('sectionaltitling.index')->with('error', 'Record not found');
        }
        
        return view('sectionaltitling.viewrecorddetail', compact('application'));
    }

 
}
