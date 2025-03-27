<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ResidentialController extends Controller
{
    public function index()
    {
        $Res_Main_application = DB::connection('sqlsrv')->table('dbo.mother_applications_residentail')->get();
        return view('sectionaltitling.residential.index', compact('Res_Main_application'));
    }
    public function subApplication()
    {
        return view('sectionaltitling.residential.sub_application');
    } 
    
    
    public function create()
    {
        return view('sectionaltitling.residential.create');
    }

    public function Subapplications()
    {
        $subApplications = DB::connection('sqlsrv')
            ->table('dbo.subapplications AS sub')
            ->join('dbo.mother_applications_residentail  AS main', 'sub.main_application_id', '=', 'main.id')
            ->select(
                'sub.*',
                'main.fileno as main_fileno',
                'main.plot_size',
                'main.land_use',
                'main.plot_house_no',
                'main.plot_street_name',
                'main.owner_district',
                'main.address',
                'main.approval_date'  // Added this line
            )
            ->get();

        return view('sectionaltitling.residential.sub_applications', compact('subApplications'));   
    }

    public function GenerateBill(Request $request)
    {
        // Convert query parameters to view data
        $data = [
            'id' => $request->query('id'),
            'main_fileno' => $request->query('main_fileno'),
            'fileno' => $request->query('fileno'),
            'applicant_title' => $request->query('applicant_title'),
            'owner_name' => $request->query('owner_name'),
            'plot_house_no' => $request->query('plot_house_no'),
            'plot_street_name' => $request->query('plot_street_name'),
            'address' => $request->query('address'),
            'owner_district' => $request->query('owner_district'),
            'approval_date' => $request->query('approval_date'),
            'plot_size' => $request->query('plot_size'),
            'land_use' => $request->query('land_use'),
        ];
        
        return view('sectionaltitling.residential.generate_bill', $data);
    }

    public function AcceptLetter()
    {
        return view('sectionaltitling.residential.AcceptLetter');
    }
    public function storeResMotherApp(Request $request)
    {
        try {
            $request->validate([
                'applicant_type'                   => 'required',
                'applicant_title'                  => 'required',
                'first_name'                       => 'required|string',
                'middle_name'                      => 'nullable|string',
                'surname'                          => 'required|string',
                'passport'                         => 'nullable|file',
                'fileno'                           => 'required|string',
                'corporate_name'                   => 'nullable|string',
                'rc_number'                        => 'nullable|string',
                'multiple_owners_names'            => 'nullable|string',
                'multiple_owners_passport'         => 'nullable',
                'address'                          => 'required|string',
                'phone_number'                     => 'required|string',
                'email'                            => 'required|email',
                'residential_type'                 => 'required|string',
                'identification_type'              => 'required|string',
                'plot_house_no'                    => 'nullable|string',
                'plot_plot_no'                     => 'nullable|string',
                'plot_street_name'                 => 'required|string',
                'plot_district'                    => 'nullable|string',
                'plot_size'                        => 'required|numeric',
                'land_use'                         => 'required|string',
                'owner_house_no'                   => 'nullable|string',
                'owner_plot_no'                    => 'nullable|string',
                'owner_street_name'                => 'nullable|string',
                'owner_district'                   => 'required|string',
                'additional_comments'              => 'nullable|string',
                'application_fee'                  => 'required|numeric',
                'payment_date'                     => 'required|date',
                'receipt_number'                   => 'required|string',
                'receipt_date'                     => 'required|date',
                'revenue_accountant'               => 'nullable|string',
                'accountant_signature_date'        => 'nullable|date',
                'scheme_no'                        => 'nullable|string',
                'application_status'               => 'nullable|string',
                'approval_date'                    => 'nullable|date',
                'planning_recommendation_status'   => 'nullable|string',
                'created_at' => now(),
                'updated_at' => now(),
                'comments'                         => 'nullable|string',
            ]);

            // Remove _token from request data explicitly
            $data = $request->all();
            unset($data['_token']);

            // Generate dynamic file number
            $lastApplication = DB::connection('sqlsrv')
                ->table('dbo.mother_applications_residentail')
                ->orderBy('id', 'desc')
                ->first();

            if ($lastApplication && $lastApplication->fileno) {
                $lastNumber = (int) substr($lastApplication->fileno, 2);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            $data['fileno'] = 'KN' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

            if ($request->hasFile('passport')) {
                $passportPath = $request->file('passport')->store('passports', 'public');
                $data['passport'] = $passportPath;
            }

            if ($request->hasFile('multiple_owners_passport')) {
                $multipleOwnersPassportPaths = [];
                foreach ($request->file('multiple_owners_passport') as $file) {
                    $path = $file->store('multiple_owners_passports', 'public');
                    $multipleOwnersPassportPaths[] = $path;
                }
                $data['multiple_owners_passport'] = json_encode($multipleOwnersPassportPaths);
            }

            // Insert data into the ApplicantRegistration table
            DB::connection('sqlsrv')->table('dbo.mother_applications_residentail')->insert($data);

            return redirect()->route('sectionaltitling.residential.index')->with('success', 'Application created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function storeSub(Request $request)
    {
        try {
            $mainAppId = $request->input('main_application_id');
            $applicationMother = DB::connection('sqlsrv')
                ->table('dbo.mother_applications_residentail ')
                ->where('id', $mainAppId)
                ->first();

            if (!$applicationMother) {
                abort(404, 'Main application not found.');
            }

            $validatedData = $request->validate([
                'applicant_type' => 'required|in:individual,corporate,multiple',
                // Other validation rules...
            ]);

            $validatedData['main_application_id'] = $mainAppId;

            // Generate sub-application fileno
            $lastSubApplication = DB::connection('sqlsrv')
                ->table('dbo.subapplications')
                ->where('main_application_id', $mainAppId)
                ->orderBy('id', 'desc')
                ->first();

            if ($lastSubApplication && $lastSubApplication->fileno) {
                $lastNumber = (int) substr($lastSubApplication->fileno, strpos($lastSubApplication->fileno, '-') + 1);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $validatedData['fileno'] = $applicationMother->fileno . '-' . $newNumber;

            if ($request->hasFile('passport')) {
                $passportPath = $request->file('passport')->store('sub_applications/passports', 'public');
                $validatedData['passport'] = $passportPath;
            }

            DB::connection('sqlsrv')->table('dbo.sub_applications')->insert($validatedData);

            return redirect()
                ->route('sectionaltitling.residential.sub_applications')
                ->with('success', 'Sub-application created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred while creating the sub-application: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Method to approve sub-application
    public function approveSubApplication(Request $request)
    {
        $id = $request->input('id');
        // Fetch the sub-application record to get the unit number (assuming fileno represents the unit number)
        $subApp = DB::connection('sqlsrv')
                      ->table('dbo.subapplications')
                      ->where('id', $id)
                      ->first();
        if (!$subApp) {
            return response()->json(['message' => 'Sub-application not found.'], 404);
        }
        DB::connection('sqlsrv')
            ->table('dbo.subapplications')
            ->where('id', $id)
            ->update(['application_status' => 'Approved']);

        return response()->json([
            'message' => "Approval for Subdivision of Fileno {$subApp->fileno} has been granted."
        ]);
    }

    // Method to decline sub-application
    public function declineSubApplication(Request $request)
    {
        $id = $request->input('id');
        $comments = $request->input('comments');

        $subApp = DB::connection('sqlsrv')
                      ->table('dbo.subapplications')
                      ->where('id', $id)
                      ->first();
        if (!$subApp) {
            return response()->json(['message' => 'Sub-application not found.'], 404);
        }
        DB::connection('sqlsrv')
            ->table('dbo.subapplications')
            ->where('id', $id)
            ->update([
                'application_status' => 'Declined',
                // Assumes there is a column named comments. Create it if needed.
                'comments' => $comments
            ]);

        return response()->json(['message' => "Sub-application has been declined."]);
    }
    
    // Combined decision method for sub-applications
    public function decisionSubApplication(Request $request)
    {
        $id = $request->input('id');
        $decision = $request->input('decision'); // 'approve' or 'decline'
        $approval_date = $request->input('approval_date'); // e.g., "2025-03-25T09:20"
        // Convert to SQL-friendly format with seconds
        $approval_date = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $approval_date)));
        $comments = $request->input('comments'); // only if decline

        $subApp = DB::connection('sqlsrv')->table('dbo.subapplications')->where('id', $id)->first();
        if (!$subApp) {
            return response()->json(['message' => 'Sub-application not found.'], 404);
        }
        if ($decision == 'approve') {
            DB::connection('sqlsrv')->table('dbo.subapplications')->where('id', $id)->update([
                'application_status' => 'Approved!',
                'approval_date'      => $approval_date
            ]);
            return response()->json([
                'message' => "Approval for Subdivision of Fileno {$subApp->fileno} has been granted."
            ]);
             
        } else {
            DB::connection('sqlsrv')->table('dbo.subapplications')->where('id', $id)->update([
                'application_status' => 'Declined',
                'comments'           => $comments,
                'approval_date'      => $approval_date
            ]);
            return response()->json(['message' => "Sub-application has been declined."]);
        }
    }

    // Combined decision method for main applications
    public function decisionMotherApplication(Request $request)
    {
        $id = $request->input('id');
        $decision = $request->input('decision');
        $approval_date = $request->input('approval_date');
        // Convert to "Y-m-d H:i:s" format
        $approval_date = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $approval_date)));
        $comments = $request->input('comments');

        $app = DB::connection('sqlsrv')->table('dbo.mother_applications_residentail ')->where('id', $id)->first();
        if (!$app) {
            return response()->json(['message' => 'Application not found.'], 404);
        }
        if ($decision == 'approve') {
            DB::connection('sqlsrv')->table('dbo.mother_applications_residentail ')->where('id', $id)->update([
                'application_status' => 'Approved',
                'approval_date'      => $approval_date
            ]);
            return response()->json([
                'message' => "Approval has been sent for sectional titling of File Number {$app->fileno}."
            ]);
        } else {
            DB::connection('sqlsrv')->table('dbo.mother_applications_residentail ')->where('id', $id)->update([
                'application_status' => 'Declined',
                'comments'           => $comments,
                'approval_date'      => $approval_date
            ]);
            return response()->json(['message' => "Application has been declined."]);
        }
    }
}


