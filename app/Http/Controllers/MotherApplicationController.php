<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MotherApplicationController extends Controller
{
    // Fetch application by ID (for payment modal)
    public function show($id)
    {
        // Use the DB facade to query the 'mother_applications' table (adjust table name if needed)
        $application = DB::connection('sqlsrv')->table('mother_applications')
                         ->where('id', $id)
                         ->first();

        if (!$application) {
            return response()->json(['error' => 'Application not found'], 404);
        }
        return response()->json($application);
    }
 

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'application_id' => 'required|integer',
            'fileno' => 'required|string|max:255',
            'survey_by' => 'required|string|max:255',
            'survey_by_date' => 'required|date',
            'drawn_by' => 'required|string|max:255',
            'drawn_by_date' => 'required|date',
            'checked_by' => 'required|string|max:255',
            'checked_by_date' => 'required|date',
            'approved_by' => 'required|string|max:255',
            'approved_by_date' => 'required|date',
        ]);

        // Insert the data into the database
        DB::connection('sqlsrv')->table('Surveys')->insert($validatedData);
 
        return redirect()->back()->with('success', 'Survey submitted successfully!');
    }  
    
    public function storeDeeds(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'application_id' => 'required|integer',
            'serial_no' => 'required|string|max:255',
            'page_no' => 'required|string|max:255',
            'volume_no' => 'required|string|max:255',
            'deeds_time' => 'required',
            'deeds_date' => 'required|date',
        ]);

        // Get the owner_fullname from mother_applications table
        $motherApplication = DB::connection('sqlsrv')->table('mother_applications')
                             ->where('id', $request->application_id)
                             ->first();

        if (!$motherApplication) {
            return redirect()->back()->with('error', 'Mother application not found!');
        }

        // Add the Applicant_Name from mother_applications
        $validatedData['Applicant_Name'] = $motherApplication->owner_fullname;

        // Insert the data into the database
        DB::connection('sqlsrv')->table('landAdministration')->insert($validatedData);
 
        return redirect()->back()->with('success', 'Deeds submitted successfully!');
    }

    /**
     * Update planning recommendation status for a mother application
     */
    public function updatePlanningRecommendation(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'application_id' => 'required|integer',
            'status' => 'required|string|in:approve,decline',
            'approval_date' => 'required|date',
            'comments' => 'nullable|string',
        ]);

        try {
            // Map 'approve/decline' to database values
            $status = ($validatedData['status'] === 'approve') ? 'Approved' : 'Declined';
            
            // Update the mother application record
            $updated = DB::connection('sqlsrv')->table('mother_applications')
                ->where('id', $validatedData['application_id'])
                ->update([
                    'planning_recommendation_status' => $status,
                    'planning_approval_date' => $validatedData['approval_date'],
                    'comments' => $validatedData['comments'] ?? null,
                    'updated_at' => now()
                ]);

            if ($updated) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to update record or record not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update director's approval status for a mother application
     */
    public function updateDirectorApproval(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'application_id' => 'required|integer',
            'status' => 'required|string|in:approve,decline',
            'approval_date' => 'required|date',
            'comments' => 'nullable|string',
        ]);

        try {
            // Map 'approve/decline' to database values
            $status = ($validatedData['status'] === 'approve') ? 'Approved' : 'Declined';
            
            // Update the mother application record
            $updated = DB::connection('sqlsrv')->table('mother_applications')
                ->where('id', $validatedData['application_id'])
                ->update([
                    'application_status' => $status,
                    'approval_date' => $validatedData['approval_date'],
                    'director_comments' => $validatedData['comments'] ?? null,
                    'updated_at' => now()
                ]);

            if ($updated) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to update record or record not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get conveyance data for an application
     */
    public function getConveyance($applicationId)
    {
        try {
            $application = DB::connection('sqlsrv')
                             ->table('mother_applications')
                             ->where('id', $applicationId)
                             ->first();

            // always return a records array
            $records = [];
            if ($application && $application->conveyance) {
                $data = json_decode($application->conveyance, true);
                $records = $data['records'] ?? [];
            }

            return response()->json([
                'success' => true,
                'records' => $records
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update conveyance data for an application
     */
    public function updateConveyance(Request $request)
    {
        $validated = $request->validate([
            'application_id'       => 'required|integer',
            'records'              => 'required|array',
            'records.*.buyerName'  => 'required|string',
            'records.*.sectionNo'  => 'required|string',
        ]);

        try {
            // encode the records array into a JSON string
            $conveyanceJson = json_encode(['records' => $validated['records']]);

            $updated = DB::connection('sqlsrv')
                ->table('mother_applications')
                ->where('id', $validated['application_id'])
                ->update([
                    'conveyance' => $conveyanceJson,
                    'updated_at' => now()
                ]);

            if ($updated) {
                return response()->json(['success' => true]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to update record or record not found'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Render the buyers list template with provided data
     */
    public function renderBuyersList(Request $request)
    {
        $data = $request->validate([
            'PrimaryApplication' => 'required|array',
            'conveyanceData' => 'present|array'
        ]);
        
        // Create a proper object from the array
        $primaryApplication = (object)$data['PrimaryApplication'];
        
        // Convert the conveyance data to the format expected by the template
        if (isset($data['conveyanceData']) && !empty($data['conveyanceData'])) {
            $primaryApplication->conveyance = json_encode(['records' => $data['conveyanceData']]);
        }
        
        return view('sectionaltitling.action_modals.buyers_list', [
            'PrimaryApplication' => $primaryApplication
        ])->render();
    }
}
