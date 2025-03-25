<?php

namespace App\Http\Controllers;
use App\Models\ApplicationMother;
use App\Models\Subapplications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SubApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('sectionaltitling.create');
    }

 
 
    

    
  
    
    public function AcceptLetter(Request $request)
    {
        
        $application_id = $request->input('application_id');
        if (!$application_id) {
            abort(400, 'Application ID is required');
        }
        
        $application = ApplicationMother::findOrFail($application_id);
        return view('sectionaltitling.AcceptLetter', compact('application'));
    }

    public function storeSub(Request $request)
    {
        try {
            $mainAppId = $request->input('main_application_id');
            $applicationMother = DB::connection('sqlsrv')
                ->table('dbo.mother_applications')
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
                ->table('dbo.sub_applications')
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
                ->route('sectionaltitling.sub_applications')
                ->with('success', 'Sub-application created successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'An error occurred while creating the sub-application: ' . $e->getMessage())
                ->withInput();
        }
    }
}