<?php

namespace App\Http\Controllers;
use App\Models\ApplicationMother;
use App\Models\Subapplications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SubApplicationController extends Controller
{
    
 
 
    

    
  
    
    public function AcceptLetter(Request $request)
    {
        
        $application_id = $request->input('application_id');
        if (!$application_id) {
            abort(400, 'Application ID is required');
        }
        
        $application = ApplicationMother::findOrFail($application_id);
        return view('sectionaltitling.AcceptLetter', compact('application'));
    }

    public function getSubApplication($id)
    {
        $subApplication = Subapplications::find($id);

        if (!$subApplication) {
            return response()->json(['error' => 'Sub-application not found'], 404);
        }

        return response()->json($subApplication);
    }


    public function GenerateBill(Request $request, $id = null)
    {
        $id = $id ?? $request->get('id');
        
        // Debug output
        \Log::info('GenerateBill called with ID: ' . ($id ?? 'null'));

        if ($id) {
            // Fetch from the subapplications table
            $subApplication = DB::connection('sqlsrv')
                ->table('dbo.subapplications')
                ->where('id', $id)
                ->first();
                
            \Log::info('Found subApplication: ' . ($subApplication ? 'Yes' : 'No'));
                
            if ($subApplication) {
                // Determine owner name based on applicant type or fallback to any available field
                if ($subApplication->applicant_type == 'corporate' && $subApplication->corporate_name) {
                    $ownerName = $subApplication->corporate_name;
                } elseif ($subApplication->applicant_type == 'multiple' && $subApplication->multiple_owners_names) {
                    $multipleOwners = json_decode($subApplication->multiple_owners_names, true);
                    $ownerName = is_array($multipleOwners) ? implode(', ', $multipleOwners) : $subApplication->multiple_owners_names;
                } else {
                    // Prefer first_name, middle_name, surname; if not present, fallback to passport.
                    if (!empty($subApplication->first_name) || !empty($subApplication->middle_name) || !empty($subApplication->surname)) {
                        $ownerName = trim($subApplication->first_name . ' ' . $subApplication->middle_name . ' ' . $subApplication->surname);
                    } elseif (!empty($subApplication->passport)) {
                        $ownerName = $subApplication->passport;
                    } else {
                        $ownerName = 'N/A';
                    }
                }
                
                // Determine land use based on fileno prefix
                if (strpos($subApplication->fileno, 'ST-COM') === 0) {
                    $landUse = 'commercial';
                } elseif (strpos($subApplication->fileno, 'ST-RES') === 0) {
                    $landUse = 'residential';
                } else {
                    $landUse = strtolower($subApplication->land_use);
                }
                
                // Calculate fees based on land use
                $billBalance = 30525.00;
                $groundRent = 0;
                if ($landUse === 'residential') {
                    $processingFee = 20000.00;
                    $surveyFee = 70000.00;
                    $assignmentFee = 50000.00;
                } else { // commercial
                    $processingFee = 50000.00;
                    $surveyFee = 100000.00;
                    $assignmentFee = 100000.00;
                }
                $total = $processingFee + $surveyFee + $assignmentFee + $billBalance + $groundRent;
                $approvalDate = $subApplication->approval_date 
                    ? date('Y-m-d', strtotime($subApplication->approval_date)) 
                    : date('Y-m-d');
                
                // Prepare data for the view using subapplication fields
                $data = [
                    'id' => $subApplication->id,
                    'fileno' => $subApplication->fileno,
                    'applicant_title' => $subApplication->applicant_title,
                    'owner_name' => $ownerName,
                    'plot_size' => '', // Not available in subapplications
                    'land_use' => $landUse,
                    'block_number' => $subApplication->block_number,
                    'floor_number' => $subApplication->floor_number,
                    'unit_number' => $subApplication->unit_number,
                    'property_location' => $subApplication->property_location,
                    'address' => $subApplication->address,
                    'approval_date' => $approvalDate,
                    'processing_fee' => $processingFee,
                    'survey_fee' => $surveyFee,
                    'assignment_fee' => $assignmentFee,
                    'bill_balance' => $billBalance,
                    'ground_rent' => $groundRent,
                    'total' => $total,
                    'total_words' => $this->numberToWords($total),
                    'application_type' => $subApplication->applicant_type,
                ];
                
                // Debug output before returning view
                \Log::info('Prepared data for bill: ', [
                    'id' => $subApplication->id,
                    'fileno' => $subApplication->fileno,
                    'owner_name' => $ownerName,
                    'land_use' => $landUse,
                    'total' => $total
                ]);
                
                return view('sectionaltitling.generate_final_bill', $data);
            }
        }
        
        // If we get here, we couldn't find the record or there was no ID
        \Log::warning('No sub-application found or no ID provided');
        
        // Fallback to request data if no database record found
        $data = $request->only([
            'id', 'fileno', 'applicant_title', 'owner_name', 'block_number',
            'floor_number', 'unit_number', 'property_location', 'address', 'approval_date'
        ]);
        
        // Add some dummy data to make sure the view at least shows something
        $data['id'] = $id ?? 'No ID';
        $data['owner_name'] = $data['owner_name'] ?? 'No Owner Name';
        $data['fileno'] = $data['fileno'] ?? 'No File Number';
        $data['property_location'] = $data['property_location'] ?? 'No Location';
        $data['land_use'] = 'commercial'; // Default to commercial
        $data['total'] = 280525.00; // Default total
        $data['total_words'] = $this->numberToWords(280525.00);
        
        return view('sectionaltitling.generate_final_bill', $data);
    }

    public function GenerateBill2(Request $request, $id = null)
    {
        return $this->GenerateBill($request, $id);
    }
    
    /**
     * Convert a number to words
     * 
     * @param float $number The number to convert
     * @return string The number in words
     */


    private function numberToWords($number) 
    {
        $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);
        $words = $formatter->format($number);
        return ucfirst($words) . ' Naira Only';
    }
   

    public function Veiwrecords(Request $request)
    {
        $id = $request->query('id');
        
        if (!$id) {
            return redirect()->route('sectionaltitling.index')->with('error', 'No record ID provided');
        }
        
        $application = DB::connection('sqlsrv')
            ->table('dbo.mother_applications')
            ->where('id', $id)
            ->first();
            
        if (!$application) {
            return redirect()->route('sectionaltitling.index')->with('error', 'Record not found');
        }
        
        return view('sectionaltitling.viewrecorddetail', compact('application'));
    }




}