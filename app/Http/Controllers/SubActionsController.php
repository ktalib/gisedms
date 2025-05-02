<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SubActionsController extends Controller
{
    private function getApplication($id)
    {
        // Modified to join subapplications with mother_applications to get primary application details
        $application = DB::connection('sqlsrv')->table('subapplications')
            ->select(
                'subapplications.*', 
                'subapplications.id as applicationID', // Add alias for applicationID
                'subapplications.main_application_id as main_application_id', // Add main_application_id if it exists
                'mother_applications.fileno as primary_fileno',
                'mother_applications.first_name as primary_first_name',
                'mother_applications.surname as primary_surname',
                'mother_applications.applicant_title as primary_applicant_title',
                'mother_applications.application_status as primary_application_status',
                'mother_applications.land_use as primary_land_use',
                'mother_applications.id as main_application_id',

                // Property fields with proper aliases
                'mother_applications.property_house_no as property_house_no',
                'mother_applications.property_plot_no as property_plot_no',
                'mother_applications.property_street_name as property_street_name',
                'mother_applications.property_lga as property_lga',
                 

                'mother_applications.applicationID as primary_applicationID' // Get primary app's applicationID
            )
            ->leftJoin('mother_applications', 'subapplications.main_application_id', '=', 'mother_applications.id')
            ->where('subapplications.id', $id)
            ->first();

        if (!$application) {
            return response()->json(['error' => 'Sub application not found'], 404);
        }

        return $application;
    }

    public function OtherDepartments($id)
    {
        $PageTitle = 'OTHER DEPARTMENTS';
        $PageDescription = 'Sub-Application Departmental Actions';
        
        $application = $this->getApplication($id);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('sub_actions.other_departments', compact('application', 'PageTitle', 'PageDescription'));
    }

    public function Bill($id)
    {
        $PageTitle = 'Bill';
        $PageDescription = 'Sub-Application Billing Details';
        
        $application = $this->getApplication($id);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('sub_actions.bill', compact('application', 'PageTitle', 'PageDescription'));
    }

    public function Payment($id)
    {
        $PageTitle = 'Payment';
        $PageDescription = 'Sub-Application Payment Management';
        
        $application = $this->getApplication($id);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('sub_actions.payments', compact('application', 'PageTitle', 'PageDescription'));
    }
    
    public function Recommendation($id)
    {
        $PageTitle = 'PLANNING RECOMMENDATION';
        $PageDescription = 'Sub-Application Planning Recommendation';
        
        $application = $this->getApplication($id);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('sub_actions.recommendation', compact('application', 'PageTitle', 'PageDescription'));
    }

    public function FinalConveyance($id)
    {
        $PageTitle = 'FINAL CONVEYANCE AGREEMENT';
        $PageDescription = 'Sub-Application Final Conveyance Details';
        
        $application = $this->getApplication($id);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('sub_actions.final_conveyance', compact('application', 'PageTitle', 'PageDescription'));
    }

    public function DirectorApproval($id)
    {
        $PageTitle = 'Director\'s Approval';
        $PageDescription = 'Sub-Application Director Approval';
        
        $application = $this->getApplication($id);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('sub_actions.director_approval', compact('application', 'PageTitle', 'PageDescription'));
    }
 
    public function updateArchitecturalDesign(Request $request, $applicationId)
    {
        $request->validate([
            'architectural_design' => 'required|file|mimes:jpeg,png,jpg,pdf|max:10240',
        ]);
    
        try {
            // Get the current application from the SQL Server database
            $application = DB::connection('sqlsrv')
                ->table('subapplications')
                ->where('id', $applicationId)
                ->first();
                
            if (!$application) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sub-application not found.'
                ], 404);
            }
            
            // Parse the existing documents JSON
            $documents = json_decode($application->documents, true) ?? [];
            
            // Upload the new file
            $file = $request->file('architectural_design');
            $path = $file->store('documents/subapplications', 'public');
            
            // Update only the architectural_design portion of the JSON
            $documents['architectural_design'] = [
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'type' => $file->getClientOriginalExtension(),
                'uploaded_at' => now()->format('Y-m-d H:i:s')
            ];
            
            // Update the application in the SQL Server database
            DB::connection('sqlsrv')
                ->table('subapplications')
                ->where('id', $applicationId)
                ->update([
                    'documents' => json_encode($documents),
                    'updated_at' => now()
                ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Architectural design has been updated successfully.',
                'design' => [
                    'path' => $documents['architectural_design']['path'],
                    'uploaded_at' => $documents['architectural_design']['uploaded_at'],
                    'full_path' => asset('storage/app/public/' . $documents['architectural_design']['path'])
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating architectural design: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating architectural design. Please try again.'
            ], 500);
        }
    }

    // New method to update planning recommendation via AJAX
    public function updatePlanningRecommendation(Request $request)
    {
        try {
            $validated = $request->validate([
                'application_id' => 'required|integer',
                'status' => 'required|string|in:approve,decline',
                'approval_date' => 'required|date',
                'comments' => 'nullable|string'
            ]);

            DB::connection('sqlsrv')->table('subapplications')
                ->where('id', $validated['application_id'])
                ->update([
                    'planning_recommendation_status' => $validated['status'],
                    'planning_recommendation_date' => $validated['approval_date'],
                    'planning_recommendation_comments' => $validated['comments'],
                    'updated_at' => now()
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Planning recommendation has been updated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating planning recommendation: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating planning recommendation. Please try again.'
            ], 500);
        }
    }

    // New method to update director approval via AJAX
    public function updateDirectorApproval(Request $request)
    {
        try {
            $validated = $request->validate([
                'application_id' => 'required|integer',
                'status' => 'required|string|in:approve,decline',
                'approval_date' => 'required|date',
                'comments' => 'nullable|string'
            ]);

            DB::connection('sqlsrv')->table('subapplications')
                ->where('id', $validated['application_id'])
                ->update([
                    'application_status' => $validated['status'],
                    'approval_date' => $validated['approval_date'],
                    'approval_comments' => $validated['comments'],
                    'updated_at' => now()
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Director approval has been updated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating director approval: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating director approval. Please try again.'
            ], 500);
        }
    }

    // New method to store survey info via AJAX
    public function storeSurvey(Request $request)
    {
        try {
            $validated = $request->validate([
                'application_id' => 'required|integer',
                'survey_by' => 'required|string|max:255',
                'survey_by_date' => 'required|date',
                'drawn_by' => 'required|string|max:255',
                'drawn_by_date' => 'required|date',
                'checked_by' => 'required|string|max:255',
                'checked_by_date' => 'required|date',
                'approved_by' => 'required|string|max:255',
                'approved_by_date' => 'required|date'
            ]);

            $surveyData = [
                'survey_by' => $validated['survey_by'],
                'survey_by_date' => $validated['survey_by_date'],
                'drawn_by' => $validated['drawn_by'],
                'drawn_by_date' => $validated['drawn_by_date'],
                'checked_by' => $validated['checked_by'],
                'checked_by_date' => $validated['checked_by_date'],
                'approved_by' => $validated['approved_by'],
                'approved_by_date' => $validated['approved_by_date'],
                'updated_at' => now()
            ];

            DB::connection('sqlsrv')->table('subapplications')
                ->where('id', $validated['application_id'])
                ->update($surveyData);

            return response()->json([
                'success' => true,
                'message' => 'Survey information has been saved successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving survey information: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error saving survey information. Please try again.'
            ], 500);
        }
    }

    // New method to store deeds info via AJAX
    public function storeDeeds(Request $request)
    {
        try {
            $validated = $request->validate([
                'application_id' => 'required|integer',
                'serial_no' => 'required|string|max:255',
                'page_no' => 'required|string|max:255',
                'volume_no' => 'required|string|max:255',
                'deeds_time' => 'required|string',
                'deeds_date' => 'required|date'
            ]);

            $deedsData = [
                'serial_no' => $validated['serial_no'],
                'page_no' => $validated['page_no'],
                'volume_no' => $validated['volume_no'],
                'deeds_time' => $validated['deeds_time'],
                'deeds_date' => $validated['deeds_date'],
                'updated_at' => now()
            ];

            DB::connection('sqlsrv')->table('subapplications')
                ->where('id', $validated['application_id'])
                ->update($deedsData);

            return response()->json([
                'success' => true,
                'message' => 'Deeds information has been saved successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving deeds information: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error saving deeds information. Please try again.'
            ], 500);
        }
    }

    // Method to get related subapplications for a primary application
    public function getRelatedSubApplications($primaryId)
    {
        try {
            $subapplications = DB::connection('sqlsrv')->table('subapplications')
                ->where('main_application_id', $primaryId)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $subapplications
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching related subapplications: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching related subapplications. Please try again.'
            ], 500);
        }
    }
}
