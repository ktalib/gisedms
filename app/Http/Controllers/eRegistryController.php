<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class eRegistryController extends Controller
{
    /**
     * Save eRegistry data
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveERegistry(Request $request)
    {
        Log::info('saveERegistry called', ['data' => $request->all()]);
        
        // Validate the input
        $validator = Validator::make($request->all(), [
            'eRegistryId' => 'nullable',
            'eRegistryFileName' => 'nullable',
            'eRegistryFileNo' => 'nullable',
            'eRegistryFileLocation' => 'required|string|max:255',
            'eRegistryCommissionDate' => 'required|date',
            'eRegistryDecommissionDate' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            Log::warning('eRegistry validation failed', ['errors' => $validator->errors()]);
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Insert into eRegistry table using SQL Server connection
            $id = DB::connection('sqlsrv')->table('eRegistry')->insertGetId([
                'MLSFileNo' => $request->eRegistryId,
                'Sectional_Title_File_No' => $request->eRegistryFileNo,
                'NEWKangisFileNo' => $request->eRegistryFileName,
                'Current_Office' => $request->eRegistryFileLocation,
                'Commissioning_Date' => $request->eRegistryCommissionDate,
                'Decommissioning_Date' => $request->eRegistryDecommissionDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('eRegistry data saved successfully', ['id' => $id]);
            return response()->json(['success' => 'E-Registry data saved successfully', 'id' => $id]);
        } catch (\Exception $e) {
            Log::error('Failed to save eRegistry data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'connection' => config('database.connections.sqlsrv')
            ]);
            return response()->json(['error' => 'Failed to save E-Registry data: ' . $e->getMessage()], 500);
        }
    }
}
