<?php

namespace App\Http\Controllers;
use App\Models\ApplicationMother;
use App\Models\Subapplications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationMotherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function index()
     {
       
        $Main_application = ApplicationMother::all();
        return view('sectionaltitling.index', compact('Main_application'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('sectionaltitling.create');
    }

    public function createMotherApp()
    {
        return view('sectionaltitling.create');
    }

    public function storeMotherApp(Request $request)
    {
        try {
            $request->validate([
                'applicant_type' => 'required',
                'applicant_title' => 'nullable|string|max:20',
                'fileno' => 'nullable|string|max:50',
                'first_name' => 'nullable|string|max:100',
                'middle_name' => 'nullable|string|max:100',
                'surname' => 'nullable|string|max:100',
                'passport' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'corporate_name' => 'nullable|string|max:255',
                'rc_number' => 'nullable|string|max:50',
                'multiple_owners_names' => 'nullable|string',
                'multiple_owners_passport.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'address' => 'nullable|string',
                'phone_number' => 'nullable|string|max:20',
                'email' => 'nullable|string|email|max:100',
                'identification_type' => 'nullable|in:national_id,voters_card,drivers_license,international_passport,others',
                'identification_others' => 'nullable|string|max:100',
                'plot_house_no' => 'nullable|string|max:50',
                'plot_plot_no' => 'nullable|string|max:50',
                'plot_street_name' => 'nullable|string|max:100',
                'plot_district' => 'nullable|string|max:100',
                'owner_house_no' => 'nullable|string|max:50',
                'owner_plot_no' => 'nullable|string|max:50',
                'owner_street_name' => 'nullable|string|max:100',
                'owner_district' => 'nullable|string|max:100',
                'additional_comments' => 'nullable|string',
                'application_fee' => 'nullable|numeric',
                'payment_date' => 'nullable|date',
                'receipt_number' => 'nullable|string|max:50',
                'receipt_date' => 'nullable|date',
                'revenue_accountant' => 'nullable|string|max:100',
                'accountant_signature_date' => 'nullable|date',
                'scheme_no' => 'nullable|string|max:50',
                'application_status' => 'nullable|in:Pending,Under Review,Approved,Rejected',
                'approval_date' => 'nullable|date',
            ]);

            $data = $request->all();

            // Generate dynamic file number
            $lastApplication = ApplicationMother::orderBy('id', 'desc')->first();
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

            $application = new ApplicationMother();
            $application->fill($data);
            $application->save();

            return redirect()->route('sectionaltitling.index')->with('success', 'Application created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function subApplications()
    {
        $subApplications = Subapplications::all();
        return view('sectionaltitling.sub_applications', compact('subApplications'));
    }

    public function Subapplication()
    {
        $subApplications = Subapplications::all();
        return view('sectionaltitling.sub_application', compact('subApplications'));
    }
    
    public function AcceptLetter(Request $request)
    {
       // \Log::info('AcceptLetter called with application_id: ' . $request->input('application_id'));
        // $application_id = $request->input('application_id');
        // if (!$application_id) {
        //     abort(400, 'Application ID is required');
        // }
        
        //$application = ApplicationMother::findOrFail($application_id);
        return view('sectionaltitling.AcceptLetter');
    }



    public function createSub(Request $request)
    {
        $application_id = $request->input('application_id');
        if (!$application_id) {
            abort(400, 'Application ID is required');
        }
        
        $application = ApplicationMother::findOrFail($application_id);
        return view('sectionaltitling.create_sub', compact('application'));
    }
    
    public function storeSub(Request $request)
    {
        try {
            $mainAppId = $request->input('main_application_id');
            $applicationMother = ApplicationMother::findOrFail($mainAppId);
            
            $validatedData = $request->validate([
                'applicant_type' => 'required|in:individual,corporate,multiple',
                'applicant_title' => 'nullable|string|max:20',
                'first_name' => 'nullable|string|max:100',
                'middle_name' => 'nullable|string|max:100',
                'surname' => 'nullable|string|max:100',
                'passport' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'corporate_name' => 'nullable|string|max:255',
                'rc_number' => 'nullable|string|max:50',
                'multiple_owners_passport.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'address' => 'required|string',
                'phone_number' => 'required|string|max:20',
                'email' => 'required|email|max:100',
                'identification_type' => 'required',
                'identification_others' => 'nullable|string|max:100',
                'block_number' => 'required|string|max:50',
                'floor_number' => 'required|string|max:50',
                'unit_number' => 'required|string|max:50',  
                'ownership' => 'required|string',
                'application_status' => 'required|string',
                'comments' => 'nullable|string',
                'multiple_owners_names.*' => 'required_if:applicant_type,multiple|string',
                'multiple_owners_passport.*' => 'required_if:applicant_type,multiple|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $validatedData['main_application_id'] = $mainAppId;

            // Generate sub-application fileno
            $lastSubApplication = Subapplications::where('main_application_id', $mainAppId)
                ->orderBy('id', 'desc')
                ->first();

            if ($lastSubApplication && $lastSubApplication->fileno) {
                $lastNumber = (int)substr($lastSubApplication->fileno, strpos($lastSubApplication->fileno, '-') + 1);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            } 

            $validatedData['fileno'] = $applicationMother->fileno . '-' . $newNumber;

            // Handle multiple owners
            if ($request->applicant_type === 'multiple' && 
                $request->has('multiple_owners_names') && 
                $request->hasFile('multiple_owners_passport')) {
                
                $ownersData = [];
                $names = $request->multiple_owners_names;
                $files = $request->file('multiple_owners_passport');
                
                foreach ($names as $index => $name) {
                    if (isset($files[$index])) {
                        $sanitizedName = str_replace(' ', '_', strtolower($name));
                        $filename = $sanitizedName . '_' . time() . '.' . $files[$index]->getClientOriginalExtension();
                        $path = $files[$index]->storeAs('multiple_owners_passports', $filename, 'public');
                        
                        $ownersData[] = [
                            'name' => $name,
                            'photo' => $path
                        ];
                    }
                }
                
                // Convert arrays to JSON before saving
                $validatedData['multiple_owners_names'] = json_encode($names);
                $validatedData['multiple_owners_passport'] = json_encode(array_column($ownersData, 'photo'));
                $validatedData['multiple_owners_data'] = json_encode($ownersData);
            }

            // Handle individual passport if present
            if ($request->hasFile('passport')) {
                $passportPath = $request->file('passport')->store('sub_applications/passports', 'public');
                $validatedData['passport'] = $passportPath;
            }

            // Add debug logging
            \Log::info('Validated data before create:', $validatedData);

            $subApplication = Subapplications::create($validatedData);

            if ($subApplication) {
                return redirect()
                    ->route('sectionaltitling.sub_applications')
                    ->with('success', 'Sub-application created successfully.');
            }

            return redirect()
                ->back()
                ->with('error', 'Failed to create sub-application.')
                ->withInput();

        } catch (\Exception $e) {
            \Log::error('Sub-application creation error: ' . $e->getMessage());
            \Log::error('Request data: ' . json_encode($request->all()));
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()
                ->back()
                ->with('error', 'An error occurred while creating the sub-application: ' . $e->getMessage())
                ->withInput();
        }
    }
    
}
