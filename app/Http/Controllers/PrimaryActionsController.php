<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrimaryActionsController extends Controller
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
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'application_id' => 'required|integer',
                'fileno' => 'required|string|max:255',
                // Survey personnel information
                'survey_by' => 'required|string|max:255',
                'survey_by_date' => 'required|date',
                'drawn_by' => 'required|string|max:255',
                'drawn_by_date' => 'required|date',
                'checked_by' => 'required|string|max:255',
                'checked_by_date' => 'required|date',
                'approved_by' => 'required|string|max:255',
                'approved_by_date' => 'required|date',
                // Property Identification
                'plot_no' => 'nullable|string|max:255',
                'block_no' => 'nullable|string|max:255',
                'approved_plan_no' => 'nullable|string|max:255',
                'tp_plan_no' => 'nullable|string|max:255',
                // Beacon Control Information
                'beacon_control_name' => 'nullable|string|max:255',
                'Control_Beacon_Coordinate_X' => 'nullable|string|max:255',
                'Control_Beacon_Coordinate_Y' => 'nullable|string|max:255',
                // Sheet Information
                'Metric_Sheet_Index' => 'nullable|string|max:255',
                'Metric_Sheet_No' => 'nullable|string|max:255',
                'Imperial_Sheet' => 'nullable|string|max:255',
                'Imperial_Sheet_No' => 'nullable|string|max:255',
                // Location Information
                'layout_name' => 'nullable|string|max:255',
                'district_name' => 'nullable|string|max:255',
                'lga_name' => 'nullable|string|max:255',
            ]);

            // Insert the data into the database
            DB::connection('sqlsrv')->table('surveyCadastralRecord')->insert($validatedData);
            
            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Survey submitted successfully!'
            ]);
        } catch (\Exception $e) {
            // Return JSON error response
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 422);
        }
    }  
    
    public function storeDeeds(Request $request)
    {
        try {
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
                return response()->json([
                    'success' => false,
                    'message' => 'Mother application not found!'
                ], 404);
            }

            // Add the Applicant_Name from mother_applications
            $validatedData['Applicant_Name'] = $motherApplication->owner_fullname;

            // Insert the data into the database
            DB::connection('sqlsrv')->table('landAdministration')->insert($validatedData);
     
            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Deeds submitted successfully!'
            ]);
        } catch (\Exception $e) {
            // Return JSON error response
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 422);
        }
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

            // Initialize records array
            $records = [];
            
            if ($application && $application->conveyance) {
                $conveyanceData = json_decode($application->conveyance, true);
                
                // Handle both old and new data formats
                if (isset($conveyanceData['records']) && is_array($conveyanceData['records'])) {
                    $records = $conveyanceData['records'];
                } elseif (isset($conveyanceData['buyerName']) && isset($conveyanceData['sectionNo'])) {
                    // Convert old format to new format
                    $records = [[
                        'buyerName' => $conveyanceData['buyerName'],
                        'sectionNo' => $conveyanceData['sectionNo']
                    ]];
                }
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
        try {
            $validated = $request->validate([
                'application_id'       => 'required|integer',
                'records'              => 'required|array',
                'records.*.buyerName'  => 'required|string',
                'records.*.sectionNo'  => 'required|string',
            ]);

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
                return response()->json([
                    'success' => true,
                    'message' => 'Conveyance data updated successfully'
                ]);
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
     * Add a single buyer to the conveyance data
     */
    public function addBuyer(Request $request)
    {
        try {
            $validated = $request->validate([
                'application_id' => 'required|integer',
                'buyerTitle'     => 'nullable|string',
                'buyerName'      => 'required|string',
                'sectionNo'      => 'required|string',
            ]);

            $application = DB::connection('sqlsrv')
                ->table('mother_applications')
                ->where('id', $validated['application_id'])
                ->first();

            // Initialize records array
            $records = [];
            
            if ($application && $application->conveyance) {
                $conveyanceData = json_decode($application->conveyance, true);
                
                if (isset($conveyanceData['records']) && is_array($conveyanceData['records'])) {
                    $records = $conveyanceData['records'];
                } elseif (isset($conveyanceData['buyerName']) && isset($conveyanceData['sectionNo'])) {
                    // Convert old format to new format
                    $records = [[
                        'buyerName' => $conveyanceData['buyerName'],
                        'sectionNo' => $conveyanceData['sectionNo']
                    ]];
                }
            }

            // Add the new buyer
            $records[] = [
                'buyerTitle' => $validated['buyerTitle'] ?? '',
                'buyerName'  => $validated['buyerName'],
                'sectionNo'  => $validated['sectionNo']
            ];

            // Save the updated records
            $updated = DB::connection('sqlsrv')
                ->table('mother_applications')
                ->where('id', $validated['application_id'])
                ->update([
                    'conveyance' => json_encode(['records' => $records]),
                    'updated_at' => now()
                ]);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Buyer added successfully',
                    'records' => $records
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to add buyer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a buyer from the conveyance data
     */
    public function deleteBuyer(Request $request)
    {
        try {
            $validated = $request->validate([
                'application_id' => 'required|integer',
                'index'          => 'required|integer',
            ]);

            $application = DB::connection('sqlsrv')
                ->table('mother_applications')
                ->where('id', $validated['application_id'])
                ->first();

            if (!$application || !$application->conveyance) {
                return response()->json([
                    'success' => false,
                    'message' => 'No conveyance data found'
                ]);
            }

            $conveyanceData = json_decode($application->conveyance, true);
            $records = $conveyanceData['records'] ?? [];

            if (!isset($records[$validated['index']])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Buyer not found'
                ]);
            }

            // Remove the buyer at the specified index
            array_splice($records, $validated['index'], 1);

            // Save the updated records
            $updated = DB::connection('sqlsrv')
                ->table('mother_applications')
                ->where('id', $validated['application_id'])
                ->update([
                    'conveyance' => json_encode(['records' => $records]),
                    'updated_at' => now()
                ]);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Buyer deleted successfully',
                    'records' => $records
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete buyer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the final conveyance view for an application
     */
    public function finalConveyance($id)
    {
        $application = DB::connection('sqlsrv')->table('mother_applications')
                         ->where('id', $id)
                         ->first();

        if (!$application) {
            return redirect()->back()->with('error', 'Application not found');
        }

        return view('actions.final_conveyance', [
            'application' => $application
        ]);
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

    /**
     * Get survey data for an application
     */
    public function getSurvey($applicationId)
    {
        try {
            $survey = DB::connection('sqlsrv')
                        ->table('surveyCadastralRecord')
                        ->where('application_id', $applicationId)
                        ->first();

            if (!$survey) {
                return response()->json([
                    'success' => false,
                    'message' => 'No survey record found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'survey' => $survey
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an existing survey record
     */
    public function updateSurvey(Request $request)
    {
        try {
            // Validate the request data - same validation as in store method
            $validatedData = $request->validate([
                'application_id' => 'required|integer',
                'fileno' => 'required|string|max:255',
                // Survey personnel information
                'survey_by' => 'required|string|max:255',
                'survey_by_date' => 'required|date',
                'drawn_by' => 'required|string|max:255',
                'drawn_by_date' => 'required|date',
                'checked_by' => 'required|string|max:255',
                'checked_by_date' => 'required|date',
                'approved_by' => 'required|string|max:255',
                'approved_by_date' => 'required|date',
                // Property Identification
                'plot_no' => 'nullable|string|max:255',
                'block_no' => 'nullable|string|max:255',
                'approved_plan_no' => 'nullable|string|max:255',
                'tp_plan_no' => 'nullable|string|max:255',
                // Beacon Control Information
                'beacon_control_name' => 'nullable|string|max:255',
                'Control_Beacon_Coordinate_X' => 'nullable|string|max:255',
                'Control_Beacon_Coordinate_Y' => 'nullable|string|max:255',
                // Sheet Information
                'Metric_Sheet_Index' => 'nullable|string|max:255',
                'Metric_Sheet_No' => 'nullable|string|max:255',
                'Imperial_Sheet' => 'nullable|string|max:255',
                'Imperial_Sheet_No' => 'nullable|string|max:255',
                // Location Information
                'layout_name' => 'nullable|string|max:255',
                'district_name' => 'nullable|string|max:255',
                'lga_name' => 'nullable|string|max:255',
            ]);

            // Update the record in the database
            $updated = DB::connection('sqlsrv')
                ->table('surveyCadastralRecord')
                ->where('application_id', $validatedData['application_id'])
                ->update($validatedData);
            
            if (!$updated) {
                return response()->json([
                    'success' => false,
                    'message' => 'Survey record not found or no changes made'
                ], 404);
            }
            
            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Survey updated successfully!'
            ]);
        } catch (\Exception $e) {
            // Return JSON error response
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 422);
        }
    }
}
