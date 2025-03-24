<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ApplicationMotherController extends Controller
{
    public function index()
    {
        $Main_application = DB::connection('sqlsrv')->table('dbo.mother_applications')->get();
        return view('sectionaltitling.index', compact('Main_application'));
    }

    public function storeMotherApp(Request $request)
    {
        try {
            $request->validate([
                'applicant_type' => 'required',
                // Other validation rules...
            ]);

            $data = $request->all();

            // Generate dynamic file number
            $lastApplication = DB::connection('sqlsrv')
                ->table('dbo.mother_applications')
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

            DB::connection('sqlsrv')->table('dbo.mother_applications')->insert($data);

            return redirect()->route('sectionaltitling.index')->with('success', 'Application created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
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
