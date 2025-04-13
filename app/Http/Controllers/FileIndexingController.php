<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class FileIndexingController extends Controller
{
  
    public function index()
    {
     return view('fileindex.index');
    }

  
    public function create()
    {
        return view('fileindex.create');
    }

 
    public function saveCofO(Request $request)
    {
        try {
            // Prepare CofO data for insertion
            $cofOData = [
                'fileNo' => $request->Previewflenumber,
                'oldTitleSerialNo' => $request->oldTitleSerialNo,
                'title' => $request->title,
                'oldTitlePageNo' => $request->oldTitlePageNo,
                'landuse' => $request->landUse,
                'oldTitleVolumeNo' => $request->oldTitleVolumeNo,
                'plotDescription' => $request->plotDescription,
                'groundRent' => $request->groundRent,
                'deedsDate' => $request->deedsDate,
                'tenancy' => $request->tenancy,
                'created_at' => DB::raw('GETDATE()'),
                'updated_at' => DB::raw('GETDATE()'),
            ];
            
            // Insert into CofO table
            DB::connection('sqlsrv')->table('CofO')->insert($cofOData);
            
            // Prepare Fileindexing data for insertion/update
            $fileindexData = [
                'fileNo' => $request->Previewflenumber,
                'file_title' => $request->fileTitle,
                'location_title' => $request->locationTitle,
                'other_file_no' => $request->otherFileNo,
                'other_file_no1' => $request->otherFileNo1,
                'batch_no' => $request->batchNo,
                'plot_no' => $request->plotNo,
                'file_co_owned' => $request->fileCoOwned ? '1' : '0',
                'file_has_transaction' => $request->fileHasTransaction ? '1' : '0',
                'file_has_certificate_of_occupancy' => '1',
                'file_category' => $request->fileCategory ? '1' : '0',
                'file_category_select' => $request->fileCategorySelect,
                'file_sub_category' => $request->fileSubCategory ? '1' : '0',
                'file_sub_category_select' => $request->fileSubCategorySelect,
                'file_merged' => $request->fileMerged ? '1' : '0',
                'file_subdivided' => $request->fileSubdivided ? '1' : '0',
                'file_lease' => $request->fileLease,
                'occupancy' => $request->occupancy,
                'updated_at' => DB::raw('GETDATE()'),
            ];
            
            // Check if a record already exists in Fileindexing
            $existingRecord = DB::connection('sqlsrv')->table('Fileindexing')
                ->where('fileNo', $request->Previewflenumber)
                ->first();
                
            if ($existingRecord) {
                // Update existing record
                DB::connection('sqlsrv')->table('Fileindexing')
                    ->where('fileNo', $request->Previewflenumber)
                    ->update($fileindexData);
            } else {
                // Insert new record with additional required fields
                $fileindexData['created_at'] = DB::raw('GETDATE()');
                DB::connection('sqlsrv')->table('Fileindexing')->insert($fileindexData);
            }
            
          // Insert into fileNumber table
            // Determine file number format and assign to correct fields
            $fileNumber = $request->Previewflenumber;
            $mlsfNo = null;
            $kangisFileNo = null;
            $newKANGISFileNo = null;
            
            if (!empty($fileNumber)) {
                if (strpos($fileNumber, '-') !== false) {
                    // Contains hyphens - mlsfNo format (e.g., COM-2022-572)
                    $mlsfNo = $fileNumber;
                } elseif (strpos($fileNumber, ' ') !== false) {
                    // Contains spaces - kangisFileNo format (e.g., MLKN 04367)
                    $kangisFileNo = $fileNumber;
                } elseif (strpos($fileNumber, 'KN') === 0 && ctype_alnum($fileNumber)) {
                    // Starts with KN and is alphanumeric - NewKANGISFileNo format (e.g., KN1586)
                    $newKANGISFileNo = $fileNumber;
                } else {
                    // Default case - assign to mlsfNo
                    $mlsfNo = $fileNumber;
                }
            }
            
            DB::connection('sqlsrv')->table('fileNumber')->insert([
                'mlsfNo' => $mlsfNo,
                'kangisFileNo' => $kangisFileNo,
                'NewKANGISFileNo' => $newKANGISFileNo,
                'created_at' => DB::raw('GETDATE()'),
                'updated_at' => DB::raw('GETDATE()'),
            ]);
            return response()->json(['success' => true, 'message' => 'Certificate of Occupancy saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
 
    public function savePropertyTransaction(Request $request)
    {
        try {
            // Prepare property transaction data for insertion
            $data = [
                'customer' => $request->customer,
                'statutory' => $request->statutory,
                'grantLease' => $request->grantLease,
                'grantor' => $request->grantor,
                'titleType' => $request->titleType,
                'grantee' => $request->grantee,
                'landUseType' => $request->landUseType,
                'assignment' => $request->assignment,
                'lga' => $request->lga,
                'categoryCode' => $request->categoryCode,
                'assignorName' => $request->assignorName,
                'newKANGISFileNo' => $request->newKANGISFileNo,
                'assignee' => $request->assignee,
                'kagisFileNo' => $request->kagisFileNo,
                'mortgage' => $request->mortgage,
                'mlsFileNo' => $request->mlsFileNo,
                'mortgagor' => $request->mortgagor,
                'batchNo' => $request->batchNo2,
                'mortgagee' => $request->mortgagee,
                'plotNo' => $request->plotNo2,
                'thirdParty' => $request->thirdParty,
                'typeForm' => $request->typeForm2,
                'surrenderor' => $request->surrenderor,
                'surrenderee' => $request->surrenderee,
                'subLease' => $request->subLease,
                'lessor' => $request->lessor,
                'instrument' => $request->instrument,
                'Period' => is_array($request->Period) ? json_encode($request->Period) : $request->Period,
                'created_at' => DB::raw('GETDATE()'),
                'updated_at' => DB::raw('GETDATE()'),
            ];
            
            // Insert into instrumentsRegistrations table
            DB::connection('sqlsrv')->table('instrumentsRegistrations')->insert($data);
            
            // Update file_has_transaction flag in Fileindexing table
            if ($request->newKANGISFileNo) {
                DB::connection('sqlsrv')->table('Fileindexing')
                    ->where('fileNo', $request->newKANGISFileNo)
                    ->update(['file_has_transaction' => '1']);
            }
            
            // Insert into fileNumber table
            // Determine file number format and assign to correct fields
            $fileNumber = $request->Previewflenumber;
            $mlsfNo = null;
            $kangisFileNo = null;
            $newKANGISFileNo = null;
            
            if (!empty($fileNumber)) {
                if (strpos($fileNumber, '-') !== false) {
                    // Contains hyphens - mlsfNo format (e.g., COM-2022-572)
                    $mlsfNo = $fileNumber;
                } elseif (strpos($fileNumber, ' ') !== false) {
                    // Contains spaces - kangisFileNo format (e.g., MLKN 04367)
                    $kangisFileNo = $fileNumber;
                } elseif (strpos($fileNumber, 'KN') === 0 && ctype_alnum($fileNumber)) {
                    // Starts with KN and is alphanumeric - NewKANGISFileNo format (e.g., KN1586)
                    $newKANGISFileNo = $fileNumber;
                } else {
                    // Default case - assign to mlsfNo
                    $mlsfNo = $fileNumber;
                }
            }
            
            DB::connection('sqlsrv')->table('fileNumber')->insert([
                'mlsfNo' => $mlsfNo,
                'kangisFileNo' => $kangisFileNo,
                'NewKANGISFileNo' => $newKANGISFileNo,
                'created_at' => DB::raw('GETDATE()'),
                'updated_at' => DB::raw('GETDATE()'),
            ]);
            
            return response()->json(['success' => true, 'message' => 'Property transaction data saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    
    public function getAllRecords(Request $request)
    {
        try {
            // Optional pagination parameters
            $perPage = $request->input('per_page', 10);
            $page = $request->input('page', 1);
            
            $query = DB::connection('sqlsrv')->table('Fileindexing');
            
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
            $record = DB::connection('sqlsrv')->table('Fileindexing')->where('id', $id)->first();
            
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
            $query = DB::connection('sqlsrv')->table('Fileindexing');
            
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

    //  API endpoint to get CofO record by file number
   
    public function getCofORecord($fileNo)
    {
        try {
            // Get CofO data with specific fields
            $cofOData = DB::connection('sqlsrv')
                ->table('CofO')
                ->select([
                    'fileNo',
                    'oldTitleSerialNo',
                    'title',
                    'oldTitlePageNo',
                    'landuse',
                    'oldTitleVolumeNo',
                    'plotDescription',
                    'groundRent',
                    'deedsDate',
                    'tenancy'
                ])
                ->where('fileNo', $fileNo)
                ->first();

            // Get Fileindexing data with specific fields
            $fileindexData = DB::connection('sqlsrv')
                ->table('Fileindexing')
                ->select([
                    'fileNo',
                    'file_title',
                    'location_title',
                    'other_file_no',
                    'other_file_no1',
                    'batch_no',
                    'plot_no',
                    'file_co_owned',
                    'file_has_transaction',
                    'file_has_certificate_of_occupancy',
                    'file_category',
                    'file_category_select',
                    'file_sub_category',
                    'file_sub_category_select',
                    'file_merged',
                    'file_subdivided',
                    'file_lease',
                    'occupancy'
                ])
                ->where('fileNo', $fileNo)
                ->first();

            if (!$cofOData && !$fileindexData) {
                return response()->json(['success' => false, 'message' => 'No records found for this file number'], 404);
            }

            return response()->json([
                'success' => true, 
                'data' => [
                    'cofO' => $cofOData,
                    'fileindex' => $fileindexData
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    
    //API endpoint to get Property Transaction record
     
  
    public function getPropertyTransactionRecord(Request $request)
    {
        try {
            $query = DB::connection('sqlsrv')
                ->table('instrumentsRegistrations')
                ->select([
                    'customer',
                    'statutory',
                    'grantLease',
                    'grantor',
                    'titleType',
                    'grantee',
                    'landUseType',
                    'assignment',
                    'lga',
                    'categoryCode',
                    'assignorName',
                    'newKANGISFileNo',
                    'assignee',
                    'kagisFileNo',
                    'mortgage',
                    'mlsFileNo',
                    'mortgagor',
                    'batchNo',
                    'mortgagee',
                    'plotNo',
                    'thirdParty',
                    'typeForm',
                    'surrenderor',
                    'surrenderee',
                    'subLease',
                    'lessor',
                    'instrument',
                    'Period'
                ]);

            // Filter by any combination of identifiers
            if ($request->has('newKANGISFileNo')) {
                $query->where('newKANGISFileNo', $request->newKANGISFileNo);
            }

            if ($request->has('kagisFileNo')) {
                $query->where('kagisFileNo', $request->kagisFileNo);
            }

            if ($request->has('mlsFileNo')) {
                $query->where('mlsFileNo', $request->mlsFileNo);
            }

            // Handle other optional filters
            if ($request->has('batchNo')) {
                $query->where('batchNo', $request->batchNo);
            }

            $transactionData = $query->get();

            if ($transactionData->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'No property transaction records found'], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $transactionData
            ]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

}
