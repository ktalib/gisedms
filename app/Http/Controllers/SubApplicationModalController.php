<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubApplicationModalController extends Controller
{
    // Fetch application by ID (for payment modal)[]
    public function showSubApplication($id)
    {
        // Use the DB facade to query the 'subapplications' table (adjust table name if needed)
        $application = DB::connection('sqlsrv')->table('subapplications')
                         ->where('id', $id)
                         ->first();

        if (!$application) {
            return response()->json(['error' => 'Application not found'], 404);
        }
        return response()->json($application);
    }
 

    public function storeSurvey(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'sub_application_id' => 'required|integer',
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
    
    public function storeSubApplicationDeeds(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'sub_application_id' => 'required|integer',
            'serial_no' => 'required|string|max:255',
            'page_no' => 'required|string|max:255',
            'volume_no' => 'required|string|max:255',
            'deeds_time' => 'required',
            'deeds_date' => 'required|date',
        ]);

        // Get the owner_name from subapplications table
        $subApplication = DB::connection('sqlsrv')->table('subapplications')
                     ->where('id', $request->sub_application_id)
                     ->first();

        if (!$subApplication) {
            return redirect()->back()->with('error', 'Application not found!');
        }

        // Determine the owner_name based on the first non-null value
        $ownerName = $subApplication->first_name ?? 
                 $subApplication->surname ?? 
                 $subApplication->corporate_name ?? 
                 $subApplication->multiple_owners_names;

        // Add the determined owner_name to the validated data
        $validatedData['Applicant_Name'] = $ownerName;

        // Insert the data into the database
        DB::connection('sqlsrv')->table('landAdministration')->insert($validatedData);
 
        return redirect()->back()->with('success', 'Deeds submitted successfully!');
    }



    /**
     * Update planning recommendation status for a mother application
     */
    public function updateSubPlanningRecommendation(Request $request)
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
            $updated = DB::connection('sqlsrv')->table('subapplications')
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
    public function updateSubDirectorApproval(Request $request)
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
            $updated = DB::connection('sqlsrv')->table('subapplications')
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
    public function getSubConveyance($applicationId)
    {
        try {
            $application = DB::connection('sqlsrv')
                             ->table('subapplication')
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
    public function updateSubConveyance(Request $request)
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
                ->table('subapplications')
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
    public function renderSubBuyersList(Request $request)
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
