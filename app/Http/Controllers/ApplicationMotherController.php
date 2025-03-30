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
        
        

        // Fetch the last serial number from the subapplications table
        $lastSerialNumber = DB::connection('sqlsrv')->table('dbo.StFileNo')->max('serial_number');

        // Determine the next serial number
        $nextSerialNumber = ($lastSerialNumber !== null) ? intval($lastSerialNumber) + 1 : 1;

        // Format the next serial number with leading zeros if necessary
        $nextSerialNumber = sprintf('%02d', $nextSerialNumber);
        return view('sectionaltitling.sub_application' , compact('nextSerialNumber'));
    }

    public function create()
    {
        return view('sectionaltitling.create');
    }

    public function Subapplications()
    {
        $subApplications = DB::connection('sqlsrv')
            ->table('dbo.subapplications AS sub')
            ->join('dbo.mother_applications AS main', 'sub.main_application_id', '=', 'main.id')
            ->select([
                'sub.*', 'main.fileno as main_fileno', 'main.plot_size', 'main.land_use', 'main.plot_house_no',
                'main.plot_street_name', 'main.owner_district', 'main.address', 'main.approval_date',
                'main.applicant_type as main_applicant_type', 'main.applicant_title as main_applicant_title',
                'main.first_name as main_first_name', 'main.middle_name as main_middle_name',
                'main.surname as main_surname', 'main.corporate_name as main_corporate_name',
                'main.multiple_owners_names as main_multiple_owners_names'
            ])
            ->get();
       

        return view('sectionaltitling.sub_applications', compact('subApplications'));
    }

    public function GenerateBill(Request $request)
    {
        $data = $request->only([
            'id', 'main_fileno', 'fileno', 'applicant_title', 'owner_name', 'plot_house_no',
            'plot_street_name', 'address', 'owner_district', 'approval_date', 'plot_size', 'land_use'
        ]);

        return view('sectionaltitling.generate_bill', $data);
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
            'planning_recommendation_status' =>  'required|string|in:pending',
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
                ? "Approval has been sent for sectional titling of File Number {$app->fileno}."
                : "Application has been declined."
        ]);
    }
}
