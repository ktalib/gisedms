<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ConveyanceController extends Controller
{
    
    public function buyersList()
    {
        
    }
    
    /**
     * Get conveyance data for an application
     */
    public function getConveyanceData($id)
    {
        try {
            $application = DB::connection('sqlsrv')->table('mother_applications')->where('id', $id)->first();
            
            if (!$application) {
                return response()->json(['error' => 'Application not found'], 404);
            }
            
            return response()->json([
                'conveyance' => $application->conveyance ?? null
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getConveyanceData: ' . $e->getMessage());
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
   
    public function updateConveyance(Request $request)
    {
        try {
            $request->validate([
                'application_id' => 'required|integer',
                'conveyance'    => 'required|array'
            ]);
    
            $app = DB::connection('sqlsrv')->table('mother_applications')->where('id', $request->application_id)->first();
            if (!$app) {
                return response()->json(['message' => 'Application not found.'], 404);
            }
    
            // Get the conveyance data
            $conveyanceData = $request->conveyance;
            
            // Log the data for debugging
            
            // Save the conveyance data exactly as received
            DB::connection('sqlsrv')->table('mother_applications')
                ->where('id', $request->application_id)
                ->update(['conveyance' => json_encode($conveyanceData)]);
    
            return response()->json(['message' => 'Conveyance data updated successfully.']);
        } catch (\Exception $e) {
            \Log::error('Error in updateConveyance: ' . $e->getMessage());
            return response()->json(['message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
 
}
