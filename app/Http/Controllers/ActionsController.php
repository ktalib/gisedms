<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ActionsController extends Controller
{
    private function getApplication($id)
    {
        $application = DB::connection('sqlsrv')->table('mother_applications')
            ->where('id', $id)
            ->first();

        if (!$application) {
            return response()->json(['error' => 'Application not found'], 404);
        }

        return $application;
    }

    public function OtherDepartments($d)
    {
        $PageTitle = 'OTHER DEPARTMENTS';
        $PageDescription = '';
        
        $application = $this->getApplication($d);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('actions.other_departments', compact('application', 'PageTitle', 'PageDescription'));
    }

    public function Bill($d)
    {
        $PageTitle = 'Bill';
        $PageDescription = '';
        
        $application = $this->getApplication($d);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('actions.bill', compact('application', 'PageTitle', 'PageDescription'));
    }

    public function Payment($d)
    {
        $PageTitle = 'Payment';
        $PageDescription = '';
        
        $application = $this->getApplication($d);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('actions.payments', compact('application', 'PageTitle', 'PageDescription'));
    }
    
    public function Recommendation($d)
    {
        $PageTitle = 'PLANNING RECOMMENDATION';
        $PageDescription = '';
        
        $application = $this->getApplication($d);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('actions.recommendation', compact('application', 'PageTitle', 'PageDescription'));
    }

    public function FinalConveyance($d)
    {
        $PageTitle = 'FINAL CONVEYANCE AGREEMENT';
        $PageDescription = '';
        
        $application = $this->getApplication($d);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

        return view('actions.final_conveyance', compact('application', 'PageTitle', 'PageDescription'));
    }

    public function DirectorApproval($d)
    {
    
        $PageTitle = 'Directors Approval';
        $PageDescription = 'This page is for directors to approve the application.';
        
        $application = $this->getApplication($d);
        if ($application instanceof \Illuminate\Http\JsonResponse) {
            return $application;
        }

       return view('actions.director_approval', compact('application', 'PageTitle', 'PageDescription'));
    }

 
    
    public function updateArchitecturalDesign(Request $request, $applicationId)
    {
        $request->validate([
            'architectural_design' => 'required|file|mimes:jpeg,png,jpg,pdf|max:10240',
        ]);
    
        try {
            // Get the current application from the SQL Server database
            $application = DB::connection('sqlsrv')
                ->table('mother_applications')
                ->where('id', $applicationId)
                ->first();
                
            if (!$application) {
                return response()->json([
                    'success' => false,
                    'message' => 'Application not found.'
                ], 404);
            }
            
            // Parse the existing documents JSON
            $documents = json_decode($application->documents, true) ?? [];
            
            // Upload the new file
            $file = $request->file('architectural_design');
            $path = $file->store('documents', 'public');
            
            // Update only the architectural_design portion of the JSON
            $documents['architectural_design'] = [
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'type' => $file->getClientOriginalExtension(),
                'uploaded_at' => now()->format('Y-m-d H:i:s')
            ];
            
            // Update the application in the SQL Server database
            DB::connection('sqlsrv')
                ->table('mother_applications')
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
                    'full_path' => asset('storage/' . $documents['architectural_design']['path'])
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
}
