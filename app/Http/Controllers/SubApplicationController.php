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
                        $ownerName = trim(($subApplication->applicant_title ? $subApplication->applicant_title . ' ' : '') .
                                        $subApplication->first_name . ' ' . 
                                        $subApplication->middle_name . ' ' . 
                                        $subApplication->surname);
                    } elseif (!empty($subApplication->passport)) {
                        $ownerName = $subApplication->passport;
                    } else {
                        $ownerName = 'N/A';
                    }
                }
                
                // Determine land use based on fileno prefix or explicit land_use field
                $landUse = '';
                if (!empty($subApplication->land_use)) {
                    $landUse = strtolower($subApplication->land_use);
                } elseif (!empty($subApplication->fileno)) {
                    if (strpos($subApplication->fileno, 'ST-COM') === 0) {
                        $landUse = 'commercial';
                    } elseif (strpos($subApplication->fileno, 'ST-RES') === 0) {
                        $landUse = 'residential';
                    } elseif (strpos($subApplication->fileno, 'ST-IND') === 0) {
                        $landUse = 'industrial';
                    }
                }
                
                // Calculate fees based on land use
                $billBalance = 30525.00;
                $groundRent = 0;
                
                if ($landUse === 'residential') {
                    $processingFee = 20000.00;
                    $surveyFee = isset($subApplication->NoOfUnits) && $subApplication->NoOfUnits > 1 ? 50000.00 : 70000.00;
                    $assignmentFee = 50000.00;
                } else { // commercial or other
                    $processingFee = 50000.00;
                    $surveyFee = 100000.00;
                    $assignmentFee = 100000.00;
                }
                
                $total = $processingFee + $surveyFee + $assignmentFee + $billBalance + $groundRent;
                $approvalDate = $subApplication->approval_date 
                    ? date('Y-m-d', strtotime($subApplication->approval_date)) 
                    : date('Y-m-d');
                
                // Prepare location string from block/floor/unit/property_location
                $locationParts = [];
                
                if (!empty($subApplication->block_number)) {
                    $locationParts[] = 'Block ' . $subApplication->block_number;
                }
                
                if (!empty($subApplication->floor_number)) {
                    $locationParts[] = 'Floor ' . $subApplication->floor_number;
                }
                
                if (!empty($subApplication->unit_number)) {
                    $locationParts[] = 'Unit ' . $subApplication->unit_number;
                }
                
                if (!empty($subApplication->property_location)) {
                    $locationParts[] = $subApplication->property_location;
                } elseif (!empty($subApplication->address)) {
                    $locationParts[] = $subApplication->address;
                }
                
                $location = implode(', ', $locationParts);
                
                // Prepare data for the view using subapplication fields
                $data = [
                    'id' => $subApplication->id,
                    'fileno' => $subApplication->fileno,
                    'applicant_title' => $subApplication->applicant_title,
                    'owner_name' => $ownerName,
                    'plot_size' => $subApplication->plot_size ?? '',
                    'land_use' => $landUse,
                    'location' => $location,
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
                    'location' => $location,
                    'total' => $total
                ]);
                
                return view('sectionaltitling.generate_bill_sub', $data);
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
        
        return view('sectionaltitling.generate_bill_sub', $data);
    }

 public function GenerateBill2(Request $request, $id = null)
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
   

    public function viewrecorddetail_sub(Request $request)
    {
        $PageTitle = 'Unit Application Details';
 
        $PageDescription = 'View Unit Application Details';
        // Check if the ID is provided directly in the URL path (as a route parameter)
        $id = $request->route('id');
        
        // If not, check if it's in the query string
        if (!$id) {
            $id = $request->query('id');
        }
        
        // If still no ID, check if it's the first segment of the query string (for URLs like viewrecorddetail_sub?5)
        if (!$id) {
            $queryString = $request->getQueryString();
            if ($queryString && is_numeric($queryString)) {
                $id = $queryString;
            }
        }
        
        // Log the input for debugging
        \Log::info('Viewing subapplication record - ID detection', [
            'request_query' => $request->query(),
            'query_string' => $request->getQueryString(),
            'detected_id' => $id
        ]);
        
        if (!$id) {
            return redirect()->route('sectionaltitling.index')->with('error', 'No record ID provided');
        }
        
        // Join subapplications with mother_applications to get complete data
        $application = DB::connection('sqlsrv')
            ->table('dbo.subapplications as sub')
            ->leftJoin('dbo.mother_applications as mother', 'sub.main_application_id', '=', 'mother.id')
            ->select(
                'sub.*',
                'mother.applicant_type as mother_applicant_type',
                'mother.applicant_title as mother_applicant_title',
                'mother.first_name as mother_first_name',
                'mother.middle_name as mother_middle_name',
                'mother.surname as mother_surname',
                'mother.passport as mother_passport',
                'mother.corporate_name as mother_corporate_name',
                'mother.rc_number as mother_rc_number',
                'mother.multiple_owners_names as mother_multiple_owners_names',
                'mother.multiple_owners_passport as mother_multiple_owners_passport',
                'mother.address as mother_address',
                'mother.phone_number as mother_phone_number',
                'mother.email as mother_email',
                'mother.land_use as mother_land_use',
                'mother.plot_size as mother_plot_size',
                'mother.fileno as mother_fileno',
                'mother.property_house_no as mother_property_house_no',
                'mother.property_plot_no as mother_property_plot_no',
                'mother.property_street_name as mother_property_street_name',
                'mother.property_district as mother_property_district',
                'mother.property_lga as mother_property_lga',
                
            )
            ->where('sub.id', $id)
            ->first();
            
        // Rest of the method remains the same
        if (!$application) {
            return redirect()->route('sectionaltitling.index')->with('error', 'Record not found');
        }
        
        // Parse JSON data for sub-application multiple owners
        if (!empty($application->multiple_owners_names)) {
            // Try to decode as JSON first
            $decoded = json_decode($application->multiple_owners_names, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $application->multiple_owners_names_array = $decoded;
            } 
            // If not valid JSON, try CSV format with quotes
            else if (is_string($application->multiple_owners_names) && 
                    strpos($application->multiple_owners_names, ',') !== false) {
                // Handle CSV format with quotes
                preg_match_all('/"([^"]+)"/', $application->multiple_owners_names, $matches);
                $application->multiple_owners_names_array = !empty($matches[1]) ? $matches[1] : 
                    array_map('trim', explode(',', $application->multiple_owners_names));
            } 
            // If single string
            else {
                $application->multiple_owners_names_array = [$application->multiple_owners_names];
            }
        } else {
            $application->multiple_owners_names_array = [];
        }
        
        // Parse multiple_owners_passport (JSON)
        if (!empty($application->multiple_owners_passport)) {
            $application->multiple_owners_passport_array = json_decode($application->multiple_owners_passport, true) ?: [];
        } else {
            $application->multiple_owners_passport_array = [];
        }
        
        // Parse multiple_owners_data (JSON)
        if (!empty($application->multiple_owners_data)) {
            $application->multiple_owners_data_array = json_decode($application->multiple_owners_data, true) ?: [];
        } else {
            $application->multiple_owners_data_array = [];
        }
        
        // Parse mother application multiple owners
        if (!empty($application->mother_multiple_owners_names)) {
            // Try to decode as JSON first
            $decoded = json_decode($application->mother_multiple_owners_names, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $application->mother_multiple_owners_names_array = $decoded;
            } 
            // If not valid JSON, try CSV format with quotes
            else if (is_string($application->mother_multiple_owners_names) && 
                    strpos($application->mother_multiple_owners_names, ',') !== false) {
                // Handle CSV format with quotes
                preg_match_all('/"([^"]+)"/', $application->mother_multiple_owners_names, $matches);
                $application->mother_multiple_owners_names_array = !empty($matches[1]) ? $matches[1] : 
                    array_map('trim', explode(',', $application->mother_multiple_owners_names));
            } 
            // If single string
            else {
                $application->mother_multiple_owners_names_array = [$application->mother_multiple_owners_names];
            }
        } else {
            $application->mother_multiple_owners_names_array = [];
        }
        
        // Log data for debugging
        \Log::info('Viewing subapplication record', [
            'id' => $id,
            'application_data_exists' => !empty($application),
            'multiple_owners_names' => $application->multiple_owners_names ?? null,
            'multiple_owners_names_array' => $application->multiple_owners_names_array ?? [],
            'mother_multiple_owners_names_array' => $application->mother_multiple_owners_names_array ?? []
        ]);
        
        return view('sectionaltitling.viewrecorddetail_sub', compact('application', 'PageTitle', 'PageDescription'));
    }




}