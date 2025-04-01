<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeedsController extends Controller
{
    public function insert(Request $request)
    {
        $data = $request->only(['serial_no', 'deeds_date', 'applicant_name']);
        $result = DB::connection('sqlsrv')->insert("INSERT INTO [klass].[dbo].[landAdministration]
            ([Sectional_Title_File_No],
             [Applicant_Name],
             [Tenure_Period],
             [Deeds_Transfer],
             [Deeds_Serial_No],
             [Registration_Date],
             [Current_Owner],
             [Occupation])
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [
                null,                      // Sectional_Title_File_No
                $data['applicant_name'] ?? 'Unknown', // Applicant_Name
                null,                      // Tenure_Period
                null,                      // Deeds_Transfer
                $data['serial_no'] ?? null, // Deeds_Serial_No
                $data['deeds_date'] ?? now(), // Registration_Date
                null,                      // Current_Owner
                null                       // Occupation
            ]
        );
        return response()->json(['success' => $result]);
    }
}
