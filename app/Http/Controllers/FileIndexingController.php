<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class FileIndexingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view('fileindex.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fileindex.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Prepare data for insertion
            $data = [
                // File Registry Details
                'file_no_prefix' => $request->fileNoPrefix,
                'file_number' => $request->fileNumber,
                'fileNo' => $request->Previewflenumber,
                'file_title' => $request->fileTitle,
                'location_title' => $request->locationTitle,
                'other_file_no' => $request->otherFileNo,
                'other_file_no1' => $request->otherFileNo1,
                'other_file_no2' => $request->otherFileNo2,
                'batch_no' => $request->batchNo,
                'plot_no' => $request->plotNo,
                
                // Checkboxes
                'file_co_owned' => $request->fileCoOwned ? '1' : '0',
                'file_has_transaction' => $request->fileHasTransaction ? '1' : '0',
                'file_has_certificate_of_occupancy' => $request->fileHasCertificateOfOccupancy ? '1' : '0',
                'file_category' => $request->fileCategory ? '1' : '0',
                'file_category_select' => $request->fileCategorySelect,
                'file_sub_category' => $request->fileSubCategory ? '1' : '0',
                'file_sub_category_select' => $request->fileSubCategorySelect,
                'file_merged' => $request->fileMerged ? '1' : '0',
                'file_subdivided' => $request->fileSubdivided ? '1' : '0',
                
                // File Lease
                'file_lease' => $request->fileLease,
                'occupancy' => $request->occupancy,
                
                // Registry Info
                'serial_no' => $request->serialNo,
                'title' => $request->title,
                'reg_page' => $request->regPage,
                'landuse_type' => $request->landuseType,
                'covenant' => $request->covenant,
                'plot_description' => $request->plotDescription,
                'lease_period' => $request->leasePeriod,
                'reg_date' => $request->regDate,
                
                // Property Tabs
                'customer' => $request->customer ? '1' : '0',
                'statutory' => $request->statutory ? '1' : '0',
                'grant_lease' => $request->grantLease ? '1' : '0',
                
                // Search Filter
                'grantor' => $request->grantor ? '1' : '0',
                'grantor_text' => $request->grantorText,
                'title_type' => $request->titleType ? '1' : '0',
                'title_type_text' => $request->titleTypeText,
                'grantee' => $request->grantee,
                'land_use_type' => $request->landUseType ? '1' : '0',
                'land_use_type_text' => $request->landUseTypeText,
                'assignment' => $request->assignment ? '1' : '0',
                'assignment_text' => $request->assignmentText,
                'lga' => $request->lga ? '1' : '0',
                'lga_text' => $request->lgaText,
                'category_code' => $request->categoryCode ? '1' : '0',
                'category_code_text' => $request->categoryCodeText,
                'assignor' => $request->assignor,
                'new_kangis_file_no' => $request->newKANGISFileNo ? '1' : '0',
                'new_kangis_file_no_text' => $request->newKANGISFileNoText,
                'assignee' => $request->assignee,
                'kagis_file_no' => $request->kagisFileNo ? '1' : '0',
                'kagis_file_no_text' => $request->kagisFileNoText,
                'mortgage' => $request->mortgage ? '1' : '0',
                'mortgage_text' => $request->mortgageText,
                'mls_file_no' => $request->mlsFileNo ? '1' : '0',
                'mls_file_no_text' => $request->mlsFileNoText,
                'mortgagor' => $request->mortgagor,
                'batch_number' => $request->batchNumber ? '1' : '0',
                'batch_number_text' => $request->batchNumberText,
                'mortgagee' => $request->mortgagee,
                'plot_num' => $request->plotNum ? '1' : '0',
                'plot_num_text' => $request->plotNumText,
                'third_party' => $request->thirdParty,
                'type_form' => $request->typeForm ? '1' : '0',
                'type_form_text' => $request->typeFormText,
                'surrenderor' => $request->surrenderor ? '1' : '0',
                'surrenderor_text' => $request->surrenderorText,
                'surrenderee' => $request->surrenderee,
                'sub_lease' => $request->subLease ? '1' : '0',
                'sub_lease_text' => $request->subLeaseText,
                'lessor' => $request->lessor,
                'instrument' => $request->instrument,
                'period_start' => $request->periodStart,
                'period_end' => $request->periodEnd,
                'period_duration' => $request->periodDuration,
                
                // Use SQL Server's GETDATE() function for timestamps
                'created_at' => DB::raw('GETDATE()'),
                'updated_at' => DB::raw('GETDATE()'),
            ];
            
            // Insert into database using SQL Server connection
            DB::connection('sqlsrv')->table('edms')->insert($data);
            
            return response()->json(['success' => true, 'message' => 'Record saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Save certificate of occupancy data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveCofO(Request $request)
    {
        try {
            // Prepare CofO data for insertion
            $data = [
                'file_no_prefix' => $request->fileNoPrefix,
                'file_number' => $request->fileNumber,
                'fileNo' => $request->Previewflenumber,
                'serial_no' => $request->serialNo,
                'title' => $request->title,
                'reg_page' => $request->regPage,
                'landuse_type' => $request->landuseType,
                'covenant' => $request->covenant,
                'plot_description' => $request->plotDescription,
                'lease_period' => $request->leasePeriod,
                'reg_date' => $request->regDate,
                'file_has_certificate_of_occupancy' => '1',
                // Use SQL Server's GETDATE() function for timestamps
                'created_at' => DB::raw('GETDATE()'),
                'updated_at' => DB::raw('GETDATE()'),
            ];
            
            // Insert into database using SQL Server connection
            DB::connection('sqlsrv')->table('edms')->insert($data);
            
            return response()->json(['success' => true, 'message' => 'Certificate of Occupancy saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * API endpoint to get all records
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllRecords(Request $request)
    {
        try {
            // Optional pagination parameters
            $perPage = $request->input('per_page', 10);
            $page = $request->input('page', 1);
            
            $query = DB::connection('sqlsrv')->table('edms');
            
            // Apply any search filters
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where(function($q) use ($searchTerm) {
                    $q->where('fileNo', 'like', "%$searchTerm%")
                      ->orWhere('file_title', 'like', "%$searchTerm%")
                      ->orWhere('serial_no', 'like', "%$searchTerm%");
                });
            }
            
            // Apply specific filters if provided
            if ($request->has('file_no_prefix')) {
                $query->where('file_no_prefix', $request->input('file_no_prefix'));
            }
            
            // Count total records (for pagination)
            $total = $query->count();
            
            // Get paginated results
            $records = $query->orderBy('created_at', 'desc')
                            ->skip(($page - 1) * $perPage)
                            ->take($perPage)
                            ->get();
            
            return response()->json([
                'success' => true,
                'data' => $records,
                'pagination' => [
                    'total' => $total,
                    'per_page' => $perPage,
                    'current_page' => $page,
                    'last_page' => ceil($total / $perPage)
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    
    /**
     * API endpoint to get a single record by ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRecord($id)
    {
        try {
            $record = DB::connection('sqlsrv')->table('edms')->where('id', $id)->first();
            
            if (!$record) {
                return response()->json(['success' => false, 'message' => 'Record not found'], 404);
            }
            
            return response()->json(['success' => true, 'data' => $record]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    
    /**
     * API endpoint to search records
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchRecords(Request $request)
    {
        try {
            $query = DB::connection('sqlsrv')->table('edms');
            
            // Build dynamic search conditions based on request
            foreach ($request->all() as $key => $value) {
                if ($value && $key !== 'page' && $key !== 'per_page') {
                    // For text fields, use LIKE search
                    if (in_array($key, ['fileNo', 'file_title', 'location_title', 'other_file_no'])) {
                        $query->where($key, 'like', "%$value%");
                    } else {
                        $query->where($key, $value);
                    }
                }
            }
            
            // Optional pagination
            $perPage = $request->input('per_page', 10);
            $page = $request->input('page', 1);
            
            $total = $query->count();
            $records = $query->orderBy('created_at', 'desc')
                            ->skip(($page - 1) * $perPage)
                            ->take($perPage)
                            ->get();
                            
            return response()->json([
                'success' => true,
                'data' => $records,
                'pagination' => [
                    'total' => $total,
                    'per_page' => $perPage,
                    'current_page' => $page,
                    'last_page' => ceil($total / $perPage)
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
