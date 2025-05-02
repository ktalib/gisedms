<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
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
 
    //Memo
    public function Memo()
    {
        $PageTitle = 'Memo';
        $PageDescription = '';

        // Fetch subapplications data
        $subapplications = DB::connection('sqlsrv')->table('subapplications')
            ->leftJoin('mother_applications', 'subapplications.main_application_id', '=', 'mother_applications.id')
            ->select(
                'subapplications.id',
                'subapplications.scheme_no',
                'subapplications.main_application_id',
                'subapplications.fileno',
                'subapplications.applicant_title',
                'subapplications.first_name',
                'subapplications.surname',
                'subapplications.corporate_name',
                'subapplications.multiple_owners_names',
                'subapplications.block_number',
                'subapplications.floor_number',
                'subapplications.unit_number',
                'subapplications.application_status',
                'subapplications.planning_recommendation_status',
                'subapplications.planning_approval_date',
                'subapplications.approval_date',
             
                'subapplications.created_at',
                'mother_applications.property_lga',
                'mother_applications.land_use'
            )
            ->get();

        // Process owner names
        foreach ($subapplications as $application) {
            if (!empty($application->multiple_owners_names)) {
                $ownerArray = json_decode($application->multiple_owners_names, true);
                $application->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($application->corporate_name)) {
                $application->owner_name = $application->corporate_name;
            } else {
                $application->owner_name = trim($application->applicant_title . ' ' . $application->first_name . ' ' . $application->surname);
            }
        }

        //select from mother_applications table

        $motherApplications = DB::connection('sqlsrv')->table('mother_applications')
            ->select(
                'id',
                'fileno',
                'applicant_title',
                'first_name',
                'surname',
                'corporate_name',
                'multiple_owners_names',
                'land_use',
                'NoOfUnits',
                'receipt_date',
                'planning_recommendation_status',
                'application_status',
                'planning_approval_date',
                
                'property_street_name',
                'property_lga',
                'created_at'
            )
            ->get();
             // Process owner names for mother applications
        foreach ($motherApplications as $application) {
            if (!empty($application->multiple_owners_names)) {
                $ownerArray = json_decode($application->multiple_owners_names, true);
                $application->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($application->corporate_name)) {
                $application->owner_name = $application->corporate_name;
            } else {
                $application->owner_name = trim($application->applicant_title . ' ' . $application->first_name . ' ' . $application->surname);
            }
        }

        return view('programmes.memo', compact('motherApplications', 'subapplications', 'PageTitle', 'PageDescription'));
    } 
    
    private function generateCertificateNumber()
    {
        $currentYear = date('Y');
        $prefix = 'COM'; // Prefix for commercial properties
        
        // Get the highest number for the current year
        $lastMemo = DB::connection('sqlsrv')->table('memos')
            ->where('certificate_number', 'like', $prefix . '/' . $currentYear . '/%')
            ->orderByRaw('LEN(certificate_number) DESC, certificate_number DESC')
            ->first();
        
        if ($lastMemo) {
            // Extract the numeric part and increment
            $parts = explode('/', $lastMemo->certificate_number);
            $lastNumber = (int)end($parts);
            $newNumber = $lastNumber + 1;
        } else {
            // First record for this year
            $newNumber = 1;
        }
        
        // Format with leading zeros (4 digits)
        return $prefix . '/' . $currentYear . '/' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
    
    // Generate memo form
    public function generateMemo($id)
    {
       
        $PageTitle = request()->query('edit') === 'yes' ? 'Edit Memo' : 'Generate Memo';
        $PageDescription = '';
 
        
        // Fetch the mother application data
        $application = DB::connection('sqlsrv')->table('mother_applications')
            ->where('id', $id)
            ->first();
            
        if (!$application) {
            return back()->with('error', 'Application not found');
        }
        
        // Fetch land administration data if it exists
        $landAdmin = DB::connection('sqlsrv')->table('landAdministration')
            ->where('application_id', $id)
            ->first();
        
        // Process owner name
        if (!empty($application->multiple_owners_names)) {
            $ownerArray = json_decode($application->multiple_owners_names, true);
            $application->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
        } elseif (!empty($application->corporate_name)) {
            $application->owner_name = $application->corporate_name;
        } else {
            $application->owner_name = trim($application->applicant_title . ' ' . $application->first_name . ' ' . $application->middle_name . ' ' . $application->surname);
        }
        
        // Calculate default residual years
        $startDate = \Carbon\Carbon::parse($application->approval_date ?? now());
        $totalYears = 40; // Default value
        $currentYear = now()->year;
        $elapsedYears = $currentYear - $startDate->year;
        $residualYears = max(0, $totalYears - $elapsedYears);
        $expiryDate = $startDate->copy()->addYears($totalYears);
        
        // Check if a memo already exists
        $existingMemo = DB::connection('sqlsrv')->table('memos')
            ->where('application_id', $id)
            ->where('memo_type', 'primary')
            ->first();
        
        // Generate a certificate number if creating a new memo
        $certificateNumber = $existingMemo ? $existingMemo->certificate_number : $this->generateCertificateNumber();
            
        return view('programmes.generate_memo', compact(
            'application',
            'landAdmin',
            'totalYears',
            'residualYears',
            'expiryDate',
            'existingMemo',
            'PageTitle',
            'PageDescription',
            'certificateNumber'
        ));
    }
    
    // Save memo data
    public function saveMemo(Request $request)
    {
        $request->validate([
            'application_id' => 'required|integer',
            'memo_type' => 'required|string',
            'page_no' => 'nullable|string',
            'certificate_number' => 'nullable|string',
            'applicant_name' => 'required|string',
            'property_location' => 'nullable|string',
            'commencement_date' => 'nullable|date',
            'term_years' => 'nullable|integer',
            'residual_years' => 'nullable|integer',
            'expiry_date' => 'nullable|date',
            'planner_recommendation' => 'nullable|string',
            'is_planning_recommended' => 'nullable|boolean'
        ]);
        
        // Filter out non-database fields like _token and _method
        $data = $request->except(['_token', '_method']);
        
        // Add created_by field
        $data['created_by'] = Auth::id();
        
        // Check if record exists, update if it does
        $existingMemo = DB::connection('sqlsrv')->table('memos')
            ->where('application_id', $request->application_id)
            ->where('memo_type', $request->memo_type)
            ->first();
            
        if ($existingMemo) {
            // Update existing record
            $data['updated_at'] = now();
            DB::connection('sqlsrv')->table('memos')
                ->where('id', $existingMemo->id)
                ->update($data);
                
            $message = 'Memo updated successfully!';
        } else {
            // Create new record
            $data['created_at'] = now();
            DB::connection('sqlsrv')->table('memos')->insert($data);
            $message = 'Memo created successfully!';
        }
        
        return redirect()->route('programmes.view_memo_primary', $request->application_id)
            ->with('success', $message);
    }
   
    public function viewMemoPrimary($id)
    {
        $PageTitle = 'Memo';
        $PageDescription = '';
 
        try {
            // First try to fetch from memos table
            $memoData = DB::connection('sqlsrv')->table('memos')
                ->where('application_id', $id)
                ->where('memo_type', 'primary')
                ->first();
                
            // Fetch the mother application data
            $application = DB::connection('sqlsrv')->table('mother_applications')
                ->where('id', $id)
                ->select('*')
                ->first();

            if (!$application) {
                return back()->with('error', 'Application not found');
            }

            // Fetch land administration data
            $landAdmin = DB::connection('sqlsrv')->table('landAdministration')
                ->where('application_id', $id)
                ->first();

            // If we have saved memo data, use it
            if ($memoData) {
                $memo = $application; // Base data from application
                
                // Override with saved memo data
                $memo->page_no = $memoData->page_no;
                $memo->certificate_number = $memoData->certificate_number;
                $memo->property_location = $memoData->property_location;
                $memo->term_years = $memoData->term_years;
                $memo->residual_years = $memoData->residual_years;
                $memo->commencement_date = $memoData->commencement_date;
                $memo->expiry_date = $memoData->expiry_date;
                $memo->planner_recommendation = $memoData->planner_recommendation;
                $memo->is_planning_recommended = $memoData->is_planning_recommended;
                
                // Director info
                $memo->director_name = $memoData->director_name;
                $memo->director_rank = $memoData->director_rank;
                
                // Use the saved applicant name
                $memo->memo_applicant_name = $memoData->applicant_name;
            } else {
                // Calculate defaults if we don't have saved data
                $memo = $application;
                
                // Calculate residual years
                $startDate = \Carbon\Carbon::parse($memo->approval_date ?? now());
                $totalYears = 40; // Default value
                $currentYear = now()->year;
                $elapsedYears = $currentYear - $startDate->year;
                $residualYears = max(0, $totalYears - $elapsedYears); 
                
                $memo->residual_years = $residualYears;
                $memo->term_years = $totalYears;
                
                // Process owner names
                if (!empty($memo->multiple_owners_names)) {
                    $ownerArray = json_decode($memo->multiple_owners_names, true);
                    $memo->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
                } elseif (!empty($memo->corporate_name)) {
                    $memo->owner_name = $memo->corporate_name;
                } else {
                    $memo->owner_name = trim($memo->applicant_title . ' ' . $memo->first_name . ' ' . $memo->surname);
                }
                
                $memo->memo_applicant_name = $memo->owner_name;
            }

            // Set default page info if landAdmin data is missing
            $pageNo = $landAdmin->page_no ?? '01';

            return view('programmes.view_memo_primary', compact(
                'memo',
                'landAdmin',
                'memoData',
                'PageTitle',
                'PageDescription',
                'pageNo'
            ));
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error in viewMemoPrimary: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching memo data');
        }
    }
}