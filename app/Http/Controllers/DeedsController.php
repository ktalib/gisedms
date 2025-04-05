<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeedsController extends Controller
{
    public function insert(Request $request)
    {
        // Get application data from mother_applications table
        $applicationId = $request->input('application_id');
        $applicationData = null;
        
        if ($applicationId) {
            $applicationData = DB::connection('sqlsrv')
                ->table('dbo.mother_applications')
                ->where('id', $applicationId)
                ->first();
        }
        
        // Build applicant name from application data
        $applicantName = null;
        if ($applicationData) {
            if (!empty($applicationData->multiple_owners_names)) {
                $applicantName = $applicationData->multiple_owners_names;
            } elseif (!empty($applicationData->corporate_name)) {
                $applicantName = $applicationData->corporate_name;
            } elseif (!empty($applicationData->first_name) || !empty($applicationData->surname)) {
                $applicantName = trim($applicationData->first_name . ' ' . $applicationData->surname);
            }
        } else {
            $applicantName = $request->input('applicant_name', 'Unknown');
        }
        
        // Get file number from application data
        $fileNo = $applicationData->fileno ?? null;
        
        // Form data from request
        $serial_no = $request->input('serial_no');
        $page_no = $request->input('page_no');
        $volume_no = $request->input('volume_no');
        $deeds_time = $request->input('deeds_time');
        $deeds_date = $request->input('deeds_date');
        
        // Insert query with data from application and form
        $result = DB::connection('sqlsrv')->insert("INSERT INTO [klass].[dbo].[landAdministration]
            ([Sectional_Title_File_No],
             [Applicant_Name],
             [Tenure_Period],
             [Deeds_Transfer],
             [Deeds_Serial_No],
             [Registration_Date],
             [Current_Owner],
             [Occupation],
             [serial_no],
             [page_no],
             [volume_no],
             [deeds_time],
             [deeds_date])
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $fileNo,                    // Sectional_Title_File_No from application
                $applicantName,             // Applicant_Name constructed from application
                null,                       // Tenure_Period
                null,                       // Deeds_Transfer
                $serial_no,                 // Deeds_Serial_No
                $deeds_date,                // Registration_Date
                $applicantName,             // Current_Owner - same as Applicant_Name
                null,                       // Occupation
                $serial_no,                 // serial_no
                $page_no,                   // page_no
                $volume_no,                 // volume_no
                $deeds_time,                // deeds_time
                $deeds_date                 // deeds_date
            ]
        );
        
        return response()->json(['success' => $result]);
    }

    public function getDeedsDublicate(Request $request)
    {
        $applicationId = $request->input('application_id');
        
        // Get application data from mother_applications table
        $applicationData = null;
        if ($applicationId) {
            $applicationData = DB::connection('sqlsrv')
                ->table('dbo.mother_applications')
                ->where('id', $applicationId)
                ->first();
        }
        
        // Build applicant name from application data
        $applicantName = null;
        if ($applicationData) {
            if (!empty($applicationData->multiple_owners_names)) {
                $applicantName = $applicationData->multiple_owners_names;
            } elseif (!empty($applicationData->corporate_name)) {
                $applicantName = $applicationData->corporate_name;
            } elseif (!empty($applicationData->first_name) || !empty($applicationData->surname)) {
                $applicantName = trim($applicationData->first_name . ' ' . $applicationData->surname);
            }
        }
        
        // Get fileno from application data
        $fileNo = $applicationData->fileno ?? null;
        
        // Get deed records with modified fields
        $deeds = DB::connection('sqlsrv')
            ->select("
                SELECT TOP (1000) 
                    [ID],
                    ? AS [Sectional_Title_File_No],
                    ? AS [Applicant_Name],
                    NULL AS [Tenure_Period],
                    NULL AS [Deeds_Transfer],
                    NULL AS [Deeds_Serial_No],
                    NULL AS [Registration_Date],
                    [Applicant_Name] AS [Current_Owner],
                    NULL AS [Occupation],
                    [serial_no],
                    [page_no],
                    [volume_no],
                    [deeds_time],
                    [deeds_date]
                FROM [klass].[dbo].[landAdministration]
            ", [$fileNo, $applicantName]);
        
        return response()->json([
            'deeds' => $deeds,
            'application_data' => $applicationData
        ]);
    }
}
