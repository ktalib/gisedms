<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PropertyRecord;

class PropertyCardController extends Controller
{
    public function index()
    {
        $Property_records = DB::connection('sqlsrv')
            ->table('property_records')
            ->where('mlsfNo', '!=', '')
            ->where('kangisFileNo', '!=', '')->get();

        $pageLength = 50; // set default page length
        return view('propertycard.index', compact('pageLength'));
    } 
     public function capture(Request $request){
         
        
        return view('propertycard.capture');
    }


       
    
    public function getData(Request $request)
    {
        $query = DB::table('property_records')
            ->orderByRaw("CASE WHEN mlsfNo != '' OR kangisFileNo != '' THEN 0 ELSE 1 END")
            ->get();
    
        return DataTables::of($query)
            ->addColumn('actions', function ($row) {
                return '
                    <div class="d-flex gap-1">
                        <button class="btn btn-icon btn-info" data-bs-toggle="modal" data-bs-target="#viewModal' . $row->id . '" title="View Details">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button class="btn btn-icon btn-secondary" data-bs-toggle="tooltip" title="Edit">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button class="btn btn-icon btn-danger" data-bs-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }




   
public function search(Request $request)
{
    \Log::info('Search request received:', $request->all());

    $query = DB::table('property_records');
    $hasConditions = false;

    // Handle each possible search field
    if ($request->filled('kangisFileNo')) {
        $query->where('kangisFileNo', 'LIKE', '%' . $request->kangisFileNo . '%');
        $hasConditions = true;
    }

    if ($request->filled('mlsfNo')) {
        $query->where('mlsfNo', 'LIKE', '%' . $request->mlsfNo . '%');
        $hasConditions = true;
    }

    if ($request->filled('oldTitleSerialNo')) {
        $query->where('oldTitleSerialNo', 'LIKE', '%' . $request->oldTitleSerialNo . '%');
        $hasConditions = true;
    }

    if ($request->filled('oldTitlePageNo')) {
        $query->where('oldTitlePageNo', 'LIKE', '%' . $request->oldTitlePageNo . '%');
        $hasConditions = true;
    }

    if ($request->filled('oldTitleVolumeNo')) {
        $query->where('oldTitleVolumeNo', 'LIKE', '%' . $request->oldTitleVolumeNo . '%');
        $hasConditions = true;
    }

    if ($request->filled('lgaName')) {
        $query->where('lgaName', 'LIKE', '%' . $request->lgaName . '%');
        $hasConditions = true;
    }

    if ($request->filled('originalAllottee')) {
        $query->where('originalAllottee', 'LIKE', '%' . $request->originalAllottee . '%');
        $hasConditions = true;
    }

    if ($request->filled('currentAllottee')) {
        $query->where('currentAllottee', 'LIKE', '%' . $request->currentAllottee . '%');
        $hasConditions = true;
    }

    if (!$hasConditions) {
        return response()->json(['success' => false, 'message' => 'No search criteria provided']);
    }

    $result = $query->first();
    \Log::info('Search result:', ['result' => $result]);

    if (!$result) {
        return response()->json(['success' => false, 'message' => 'No matching records found']);
    }

    // Map the database fields to view fields
    $kangisFileNo = $result->kangisFileNo ?? '';
    $fileNoPrefix = '';
    $fileNumber = '';

    // Safely split kangisFileNo into prefix and number
    if (!empty($kangisFileNo)) {
        $parts = explode(' ', $kangisFileNo, 2);
        $fileNoPrefix = $parts[0] ?? '';
        $fileNumber = $parts[1] ?? '';
    }

    $mappedResult = [
        'success' => true,
        'data' => [
            'id' => $result->id ?? 'N/A',
            'fileNoPrefix' => $fileNoPrefix,
            'fileNumber' =>  $fileNumber,
            'plotNo' => $result->plotNo ?: 'N/A',
            'blockNo' => $result->blockNo ?: 'N/A',
            'districtName' => $result->districtName ?: 'N/A',
            'lgaName' => $result->lgaName ?: 'N/A',
            'description' => trim(implode(' ', array_filter([
                $result->plotNo,
                $result->blockNo,
                $result->districtName,
                $result->lgaName
            ], function($value) {
                return $value !== null && $value !== '';
            }))),
            'originalAllottee' => $result->originalAllottee ?: 'N/A',
            'currentAllottee' => $result->currentAllottee ?: 'N/A',
            'oldTitleSerialNo'   => $result->oldTitleSerialNo ?: 'N/A',
            'oldTitlePageNo'    => $result->oldTitlePageNo ?: 'N/A',
            'oldTitleVolumeNo'  => $result->oldTitleVolumeNo ?: 'N/A',
            'layoutName' => $result->layoutName ?: 'N/A',
            'mlsfNo' => $result->mlsfNo ?: 'N/A',
            'kangisFileNo' => $result->kangisFileNo ?: 'N/A'
        ]
    ];

    return response()->json($mappedResult);
}


    public function create(Request $request)
    {
        $result = null;
        $recordCount = DB::table('property_records')->count();
        return view('propertycard.create', compact('result', 'recordCount'));
    }

    public function store(Request $request)
    {
        \Log::info('Store request received:', $request->all());

        $validatedData = $request->validate([
            'planid' => 'nullable|string|max:255',
            'mlsfNo' => 'nullable|string|max:255',
            'kangisFileNo' => 'nullable|string|max:255',
            'plotNo' => 'nullable|string|max:255',
            'blockNo' => 'nullable|string|max:255',
            'approvedPlanNo' => 'nullable|string|max:255',
            'tpPlanNo' => 'nullable|string|max:255',
            'surveyedBy' => 'nullable|string|max:255',
            'drawnBy' => 'nullable|string|max:255',
            'checkedBy' => 'nullable|string|max:255',
            'passedBy' => 'nullable|string|max:255',
            'plotYearCreated' => 'nullable|string|max:255',
            'beaconControlName' => 'nullable|string|max:255',
            'beaconControlX' => 'nullable|string|max:255',
            'beaconControlY' => 'nullable|string|max:255',
            'metricSheetIndex' => 'nullable|string|max:255',
            'metricSheetNo' => 'nullable|string|max:255',
            'imperialSheet' => 'nullable|string|max:255',
            'imperialSheetNo' => 'nullable|string|max:255',
            'layoutName' => 'nullable|string|max:255',
            'districtName' => 'nullable|string|max:255',
            'lgaName' => 'nullable|string|max:255',
            'streetName' => 'nullable|string|max:255',
            'houseNo' => 'nullable|string|max:255',
            'tenancy' => 'nullable|string|max:255',
            'areaInHectares' => 'nullable|string|max:255',
            'titleStatus' => 'nullable|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'oldTitleSerialNo' => 'nullable|string|max:255',
            'oldTitlePageNo' => 'nullable|string|max:255',
            'oldTitleVolumeNo' => 'nullable|string|max:255',
            'deedsDate' => 'nullable|date',
            'deedsTime' => 'nullable|string|max:255',
            'certificateDate' => 'nullable|date',
            'originalAllottee' => 'nullable|string|max:255',
            'addressOfOriginalAllottee' => 'nullable|string|max:255',
            'titleIssuedYear' => 'nullable|string|max:255',
            'currentAllottee' => 'nullable|string|max:255',
            'addressOfCurrentAllottee' => 'nullable|string|max:255',
            'titleOfCurrentAllottee' => 'nullable|string|max:255',
            'currentYearTitleOwned' => 'nullable|string|max:255',
            'phoneNo' => 'nullable|string|max:255',
            'emailAddress' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'parcelNewlyDigitized' => 'nullable|string|max:255',
            'digitizationSource' => 'nullable|string|max:255',
            'workTime' => 'nullable|string|max:255',
            'electronicSupervisor' => 'nullable|string|max:255',
            'directorGeneral' => 'nullable|string|max:255',
            'evidenceOfPayment' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'transactionDocument' => 'nullable|string|max:255',
            'passportPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nationalId' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'internationalPassport' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'businessRegCert' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'formCO7AndCO4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'certOfIncorporation' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'memorandumAndArticle' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'letterOfAdmin' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'courtAffidavit' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'policeReport' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'newspaperAdvert' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'acknowledgementStatus' => 'nullable|string|max:255',
            'acknowledgementIssuedDate' => 'nullable|date',
            'acknowledgementIssuedBy' => 'nullable|string|max:255',
            'bankDraftSerialNo' => 'nullable|string|max:255',
            'bankName' => 'nullable|string|max:255',
            'conflictExistence' => 'nullable|string|max:255',
            'problemNature1' => 'nullable|string|max:255',
            'problemNature2' => 'nullable|string|max:255',
            'landUse' => 'nullable|string|max:255',
            'specifically' => 'nullable|string|max:255',
        ]);

        \Log::info('Validated data:', $validatedData);

        $propertyRecord = new PropertyRecord($validatedData);

        // Handle file uploads
        $fileFields = [
            'picture',
            'passportPhoto',
            'nationalId',
            'internationalPassport',
            'businessRegCert',
            'formCO7AndCO4',
            'certOfIncorporation',
            'memorandumAndArticle',
            'letterOfAdmin',
            'courtAffidavit',
            'policeReport',
            'newspaperAdvert',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public'); // Store in the 'public' disk under 'uploads' folder
                $propertyRecord->$field = $path; // Save the path to the database
            }
        }

        $propertyRecord->save();

        return redirect()->route('propertycard.index')->with('success', 'Property record created successfully.');
    }

    public function savePropertyRecord(Request $request)
    {
        // Validate and sanitize the input
        $validatedData = $request->validate([
            'mlsfNo'                     => 'nullable|string|max:255',
            'kangisFileNo'               => 'nullable|string|max:255',
            'plotNo'                     => 'nullable|string|max:255',
            'blockNo'                    => 'nullable|string|max:255',
            'approvedPlanNo'             => 'nullable|string|max:255',
            'tpPlanNo'                   => 'nullable|string|max:255',
            'surveyedBy'                 => 'nullable|string|max:255',
            'layoutName'                 => 'nullable|string|max:255',
            'districtName'               => 'nullable|string|max:255',
            'lgaName'                    => 'nullable|string|max:255',
            'oldTitleSerialNo'           => 'nullable|string|max:255',
            'oldTitlePageNo'             => 'nullable|string|max:255',
            'oldTitleVolumeNo'           => 'nullable|string|max:255',
            'deedsDate'                  => 'nullable|date',
            'deedsTime'                  => 'nullable|string|max:255',
            'certificateDate'            => 'nullable|date',
            'originalAllottee'           => 'nullable|string|max:255',
            'addressOfOriginalAllottee'  => 'nullable|string|max:255',
            'titleIssuedYear'            => 'nullable|string|max:255',
            'changeOfOwnership'          => 'nullable|string|max:255',
            'reasonForChange'            => 'nullable|string|max:255',
            'currentAllottee'            => 'nullable|string|max:255',
            'addressOfCurrentAllottee'   => 'nullable|string|max:255',
            'titleOfCurrentAllottee'     => 'nullable|string|max:255',
            'currentYearTitleOwned'      => 'nullable|string|max:255',
            'phoneNo'                    => 'nullable|string|max:255',
            'landUse'                    => 'nullable|string|max:255',
            'specifically'               => 'nullable|string|max:255',
            'tenancy'                    => 'nullable|string|max:255',
            'areaInHectares'             => 'nullable|string|max:255',
        ]);
        
        // Create and save a new property record ensuring we use the property_records table
        $record = new \App\Models\PropertyRecord($validatedData);
        $record->setDataSource('property_records');
        $record->save();
        
        return response()->json(['success' => true]);
    }

    public function navigateRecord(Request $request)
    {
        $currentId = $request->input('currentId');
        $direction = $request->input('direction');
        
        // Query builder for property_records table
        $query = DB::table('property_records');

        // Handle different navigation directions
        switch ($direction) {
            case 'first':
                $record = $query->orderBy('id', 'asc')->first();
                break;
                
            case 'last':
                $record = $query->orderBy('id', 'desc')->first();
                break;
                
            case 'previous':
                if (empty($currentId)) {
                    $record = $query->orderBy('id', 'desc')->first();
                } else {
                    $record = $query->where('id', '<', $currentId)
                                   ->orderBy('id', 'desc')
                                   ->first();
                                   
                    if (!$record) {
                        $record = $query->orderBy('id', 'desc')->first();
                    }
                }
                break;
                
            case 'next':
                if (empty($currentId)) {
                    $record = $query->orderBy('id', 'asc')->first();
                } else {
                    $record = $query->where('id', '>', $currentId)
                                   ->orderBy('id', 'asc')
                                   ->first();
                                   
                    if (!$record) {
                        $record = $query->orderBy('id', 'asc')->first();
                    }
                }
                break;
                
            default:
                return response()->json(['success' => false, 'message' => 'Invalid navigation direction']);
        }

        if (!$record) {
            return response()->json(['success' => false, 'message' => 'No records found']);
        }

        // Safely map kangisFileNo parts without assuming a space exists
        $fileNoPrefix = '';
        $fileNumber = '';
        if (!empty($record->kangisFileNo)) {
            $pos = strpos($record->kangisFileNo, ' ');
            if ($pos !== false) {
                $fileNoPrefix = substr($record->kangisFileNo, 0, $pos);
                $fileNumber   = substr($record->kangisFileNo, $pos + 1);
            } else {
                $fileNoPrefix = $record->kangisFileNo;
            }
        }

        $mappedResult = [
            'id'                => $record->id ?? 'N/A',
            'fileNoPrefix'      => $fileNoPrefix ?: 'N/A',
            'fileNumber'        => $fileNumber ?: 'N/A',
            'plotNo'            => $record->plotNo ?: 'N/A',
            'blockNo'           => $record->blockNo ?: 'N/A',
            'districtName'      => $record->districtName ?: 'N/A',
            'lgaName'           => $record->lgaName ?: 'N/A',
            'description'       => $record->specifically ?: 'N/A',
            'originalAllottee'  => $record->originalAllottee ?: 'N/A',
            'currentAllottee'   => $record->currentAllottee ?: 'N/A',
            'layoutName'        => $record->layoutName ?: 'N/A',
            'description' => trim(implode(' ', array_filter([
                $record->plotNo,
                $record->blockNo,
                $record->districtName,
                $record->lgaName
            ], function($value) {
                return $value !== null && $value !== '';
            }))),
            'oldTitleSerialNo'   => $record->oldTitleSerialNo ?: 'N/A',
            'oldTitlePageNo'    => $record->oldTitlePageNo ?: 'N/A',
            'oldTitleVolumeNo'  => $record->oldTitleVolumeNo ?: 'N/A',
            'mlsfNo'            => $record->mlsfNo ?: 'N/A',
            'kangisFileNo'      => $record->kangisFileNo ?: 'N/A'
        ];

        $recordCount = DB::table('property_records')->count();

        return response()->json(array_merge(['success' => true, 'recordCount' => $recordCount], $mappedResult));
    }
}

