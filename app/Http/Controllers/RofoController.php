<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RofoController extends Controller
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

    public function FieldData()
    {
        $PageTitle = 'FIELD DATA';
        $PageDescription = '';

        return view('programmes.field_data', compact('PageTitle', 'PageDescription'));
    }

    public function RofO()
    {
        $PageTitle = 'RofO (Letter of Grant)';
        $PageDescription = '';

        // Fetch subapplications data with rofo_no
        $subapplications = DB::connection('sqlsrv')->table('subapplications')
            ->leftJoin('mother_applications', 'subapplications.main_application_id', '=', 'mother_applications.id')
            ->leftJoin('rofo', function($join) {
                $join->on('subapplications.id', '=', 'rofo.sub_application_id')
                     ->where('rofo.active', 1);
            })
            ->select(
                'subapplications.id',
                'subapplications.scheme_no',
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
                'mother_applications.land_use',
                'rofo.rofo_no'
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

        return view('programmes.rofo', compact('motherApplications', 'subapplications', 'PageTitle', 'PageDescription'));
    }

    // Generate ROFO form
    public function generateRofO($id)
    {
        $PageTitle = request()->query('edit') === 'yes' ? 'Edit RofO (Letter of Grant)' : 'Generate RofO (Letter of Grant)';
        $PageDescription = '';

        try {
            // Fetch the subapplication details with mother application data
            $rofo = DB::connection('sqlsrv')->table('subapplications')
                ->leftJoin('mother_applications', 'subapplications.main_application_id', '=', 'mother_applications.id')
                ->where('subapplications.id', $id)
                ->select(
                    'subapplications.*',
                    'mother_applications.property_house_no',
                    'mother_applications.property_plot_no',
                    'mother_applications.property_street_name',
                    'mother_applications.property_district',
                    'mother_applications.property_lga',
                    'mother_applications.property_state',
                    'mother_applications.land_use'
                )
                ->first();

            if (!$rofo) {
                return back()->with('error', 'Application not found');
            }

            // Fetch land administration data
            $landAdmin = DB::connection('sqlsrv')->table('landAdministration')
                ->where('sub_application_id', $id)
                ->first();

            // Fetch financial data from final_bills table
            $finalBill = DB::connection('sqlsrv')->table('final_bills')
                ->where('sub_application_id', $id)
                ->first();

            // Fetch survey cadastral record for plan number
            $surveyRecord = DB::connection('sqlsrv')->table('surveyCadastralRecord')
                ->where('sub_application_id', $id)
                ->first();

            // Process owner names
            if (!empty($rofo->multiple_owners_names)) {
                $ownerArray = json_decode($rofo->multiple_owners_names, true);
                $rofo->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($rofo->corporate_name)) {
                $rofo->owner_name = $rofo->corporate_name;
            } else {
                $rofo->owner_name = trim($rofo->applicant_title . ' ' . $rofo->first_name . ' ' . $rofo->surname);
            }

            // Check if a ROFO already exists for this application
            $existingRofo = DB::connection('sqlsrv')->table('rofo')
                ->where('sub_application_id', $id)
                ->first();

            // Calculate next ROFO number
            $lastId = DB::connection('sqlsrv')->table('rofo')->max('id') ?? 0;
            $nextId = $lastId + 1;
            $currentYear = Carbon::now()->format('Y');
            $nextRofoNo = 'ST/ROFO/' . $currentYear . '/' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

            return view('programmes.generate_rofo', compact(
                'rofo',
                'landAdmin',
                'existingRofo',
                'finalBill',
                'surveyRecord',
                'nextRofoNo',
                'PageTitle',
                'PageDescription'
            ));
        } catch (\Exception $e) {
            \Log::error('Error in generateROFO: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while preparing ROFO form');
        }
    }

    // Save ROFO data
    public function saveRofO(Request $request)
    {
        try {
            $validated = $request->validate([
                'sub_application_id' => 'required|integer',
                'application_id' => 'required|integer',
                'shop_house_no' => 'nullable|string',
                'floor_no' => 'nullable|string',
                'location' => 'required|string',
                'application_date' => 'required|date',
                'approval_date' => 'required|date',
                'plot_no' => 'nullable|string',
                'block_no' => 'nullable|string',
                'plan_no' => 'nullable|string',
                'ground_rent' => 'nullable|numeric',
                'development_charges' => 'nullable|numeric',
                'survey_processing_fees' => 'nullable|numeric',
                'term_years' => 'required|integer',
                'purpose' => 'required|string',
                'improvement_value' => 'nullable|string',
                'improvement_time_limit' => 'nullable|integer',
                'commissioner_name' => 'required|string',
                'signed_date' => 'required|date',
            ]);

            // Check if a ROFO already exists for this application
            $existingRofo = DB::connection('sqlsrv')->table('rofo')
                ->where('sub_application_id', $validated['sub_application_id'])
                ->first();

            if ($existingRofo) {
                // Update existing ROFO
                $result = DB::connection('sqlsrv')->table('rofo')
                    ->where('id', $existingRofo->id)
                    ->update([
                        'shop_house_no' => $validated['shop_house_no'],
                        'floor_no' => $validated['floor_no'],
                        'location' => $validated['location'],
                        'application_date' => $validated['application_date'],
                        'approval_date' => $validated['approval_date'],
                        'plot_no' => $validated['plot_no'],
                        'block_no' => $validated['block_no'],
                        'plan_no' => $validated['plan_no'],
                        'ground_rent' => $validated['ground_rent'],
                        'development_charges' => $validated['development_charges'],
                        'survey_processing_fees' => $validated['survey_processing_fees'],
                        'term_years' => $validated['term_years'],
                        'purpose' => $validated['purpose'],
                        'improvement_value' => $validated['improvement_value'],
                        'improvement_time_limit' => $validated['improvement_time_limit'],
                        'commissioner_name' => $validated['commissioner_name'],
                        'signed_date' => $validated['signed_date'],
                        'updated_at' => now()
                    ]);

                $rofoId = $existingRofo->id;
                $message = 'ROFO updated successfully';
            } else {
                // Get the next ID for auto-incrementing
                $lastId = DB::connection('sqlsrv')->table('rofo')->max('id') ?? 0;
                $nextId = $lastId + 1;
                
                // Generate ROFO number: ST/ROFO/current year/0001
                $currentYear = Carbon::now()->format('Y');
                $rofoNo = 'ST/ROFO/' . $currentYear . '/' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
                
                // Calculate end date based on term years
                $startDate = Carbon::parse($validated['approval_date']);
                $endDate = $startDate->copy()->addYears($validated['term_years']);

                // Insert new ROFO
                $rofoId = DB::connection('sqlsrv')->table('rofo')->insertGetId([
                    'rofo_no' => $rofoNo,
                    'application_id' => $validated['application_id'],
                    'sub_application_id' => $validated['sub_application_id'],
                    'shop_house_no' => $validated['shop_house_no'],
                    'floor_no' => $validated['floor_no'],
                    'location' => $validated['location'],
                    'application_date' => $validated['application_date'],
                    'approval_date' => $validated['approval_date'],
                    'plot_no' => $validated['plot_no'],
                    'block_no' => $validated['block_no'],
                    'plan_no' => $validated['plan_no'],
                    'ground_rent' => $validated['ground_rent'],
                    'development_charges' => $validated['development_charges'],
                    'survey_processing_fees' => $validated['survey_processing_fees'],
                    'term_years' => $validated['term_years'],
                    'purpose' => $validated['purpose'],
                    'improvement_value' => $validated['improvement_value'],
                    'improvement_time_limit' => $validated['improvement_time_limit'],
                    'commissioner_name' => $validated['commissioner_name'],
                    'signed_date' => $validated['signed_date'],
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'active' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $message = 'ROFO generated successfully';
            }

            return redirect()->route('programmes.view_rofo', $validated['sub_application_id'])
                ->with('success', $message);
        } catch (\Exception $e) {
            \Log::error('Error saving ROFO: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while saving ROFO data: ' . $e->getMessage())
                ->withInput();
        }
    }

    //view rofo
    public function viewRofO($id)
    {
        $PageTitle = 'RofO (Letter of Grant)';
        $PageDescription = '';
        
        try {
            // Check if a ROFO record exists for this application
            $rofoData = DB::connection('sqlsrv')->table('rofo')
                ->where('sub_application_id', $id)
                ->first();
                
            // Debug the ROFO data to check what's being retrieved
            \Log::info('ROFO Data for ID '.$id.':', ['data' => $rofoData]);
                
            if (!$rofoData) {
                // If no ROFO exists, redirect to generate ROFO
                return redirect()->route('programmes.generate_rofo', $id)
                    ->with('info', 'No ROFO has been generated yet. Please generate one first.');
            }
            
            // Fetch the subapplication details with mother application data
            $rofo = DB::connection('sqlsrv')->table('subapplications')
                ->leftJoin('mother_applications', 'subapplications.main_application_id', '=', 'mother_applications.id')
                ->where('subapplications.id', $id)
                ->select(
                    'subapplications.*',
                    'mother_applications.property_house_no',
                    'mother_applications.property_plot_no',
                    'mother_applications.property_street_name',
                    'mother_applications.property_district',
                    'mother_applications.property_lga',
                    'mother_applications.property_state',
                    'mother_applications.land_use'
                )
                ->first();

            if (!$rofo) {
                return back()->with('error', 'Application not found');
            }

            // Fetch land administration data
            $landAdmin = DB::connection('sqlsrv')->table('landAdministration')
                ->where('sub_application_id', $id)
                ->first();

            // Calculate residual years
            $startDate = \Carbon\Carbon::parse($rofoData->start_date ?? now());
            $endDate = \Carbon\Carbon::parse($rofoData->end_date ?? now()->addYears(40));
            $totalYears = $rofoData->term_years ?? 40;
            $residualYears = $startDate->diffInYears($endDate);

            // Process owner names
            if (!empty($rofo->multiple_owners_names)) {
                $ownerArray = json_decode($rofo->multiple_owners_names, true);
                $rofo->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($rofo->corporate_name)) {
                $rofo->owner_name = $rofo->corporate_name;
            } else {
                $rofo->owner_name = trim($rofo->applicant_title . ' ' . $rofo->first_name . ' ' . $rofo->surname);
            }

            // Set default page info if landAdmin data is missing
            $pageNo = $landAdmin->page_no ?? '01';

            // Make sure we're passing the correct data to the view - verify all fields exist
            $finalRofoData = [];
            foreach ((array)$rofoData as $key => $value) {
                $finalRofoData[$key] = $value;
            }
            
            return view('programmes.view_rofo', compact(
                'rofo',
                'rofoData',
                'finalRofoData', // Add this to help debugging
                'landAdmin',
                'totalYears',
                'residualYears',
                'PageTitle',
                'PageDescription',
                'pageNo'
            ));
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error in viewROFO: ' . $e->getMessage());
            \Log::error('Error stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'An error occurred while fetching rofo data');
        }
    }
}