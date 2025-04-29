
<form id="survey-form" method="POST">
    @csrf
    <!-- Survey Tab -->
    <div id="initial-tab" class="tab-content active">
      <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
      <div class="p-4 border-b">
        <h3 class="text-sm font-medium">Survey</h3>
        <p class="text-xs text-gray-500">Fill in the survey details for the property</p>
      </div>
      <div class="p-4 space-y-4">
        <input type="hidden" id="application_id" name="application_id" value="{{$application->id}}">
        <input type="hidden" name="fileno" value="{{$application->fileno}}">
        
        <!-- Property Identification Card -->
        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
        <h4 class="text-sm font-medium mb-3">Property Identification</h4>
        <div class="grid grid-cols-2 gap-4">
          <div class="space-y-2">
          <label for="plot-no" class="text-xs font-medium block">Plot No</label>
          <input id="plot-no" name="plot_no" type="text" placeholder="Enter plot number" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="block-no" class="text-xs font-medium block">Block No</label>
          <input id="block-no" name="block_no" type="text" placeholder="Enter block number" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-3">
          <div class="space-y-2">
          <label for="approved-plan-no" class="text-xs font-medium block">Approved Plan No</label>
          <input id="approved-plan-no" name="approved_plan_no" type="text" placeholder="Enter approved plan number" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="tp-plan-no" class="text-xs font-medium block">TP Plan No</label>
          <input id="tp-plan-no" name="tp_plan_no" type="text" placeholder="Enter TP plan number" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>
        </div>

        <!-- Beacon Control Information Card -->
        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
        <h4 class="text-sm font-medium mb-3">Beacon Control Information</h4>
        <div class="grid grid-cols-3 gap-4">
          <div class="space-y-2">
          <label for="beacon-control-name" class="text-xs font-medium block">Beacon Control Name</label>
          <input id="beacon-control-name" name="beacon_control_name" type="text" placeholder="Enter beacon control name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="beacon-control-x" class="text-xs font-medium block">Beacon Control X</label>
          <input id="beacon-control-x" name="Control_Beacon_Coordinate_X" type="text" placeholder="Enter X coordinate" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="beacon-control-y" class="text-xs font-medium block">Beacon Control Y</label>
          <input id="beacon-control-y" name="Control_Beacon_Coordinate_Y" type="text" placeholder="Enter Y coordinate" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>
        </div>
        <!-- Sheet Information Card -->
        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
        <h4 class="text-sm font-medium mb-3">Sheet Information</h4>
        <div class="grid grid-cols-2 gap-4">
          <div class="space-y-2">
          <label for="metric-sheet-index" class="text-xs font-medium block">Metric Sheet Index</label>
          <input id="metric-sheet-index" name="Metric_Sheet_Index" type="text" placeholder="Enter metric sheet index" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="metric-sheet-no" class="text-xs font-medium block">Metric Sheet No</label>
          <input id="metric-sheet-no" name="Metric_Sheet_No" type="text" placeholder="Enter metric sheet number" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-3">
          <div class="space-y-2">
          <label for="imperial-sheet" class="text-xs font-medium block">Imperial Sheet</label>
          <input id="imperial-sheet" name="Imperial_Sheet" type="text" placeholder="Enter imperial sheet" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="imperial-sheet-no" class="text-xs font-medium block">Imperial Sheet No</label>
          <input id="imperial-sheet-no" name="Imperial_Sheet_No" type="text" placeholder="Enter imperial sheet number" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>
        </div>

        <!-- Location Information Card -->
        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
        <h4 class="text-sm font-medium mb-3">Location Information</h4>
        <div class="grid grid-cols-3 gap-4">
          <div class="space-y-2">
          <label for="layout-name" class="text-xs font-medium block">Layout Name</label>
          <input id="layout-name" name="layout_name" type="text" placeholder="Enter layout name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="district-name" class="text-xs font-medium block">District Name</label>
          <input id="district-name" name="district_name" type="text" placeholder="Enter district name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div> 
          <div class="space-y-2">
          <label for="lga-name" class="text-xs font-medium block">LGA Name</label>
          <input id="lga-name" name="lga_name" type="text" placeholder="Enter LGA name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>
        </div>

        <!-- Personnel Information Card -->
        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
        <h4 class="text-sm font-medium mb-3">Personnel Information</h4>
        <div class="grid grid-cols-2 gap-4">
          <div class="space-y-2">
          <label for="survey-by" class="text-xs font-medium block">Survey By</label>
          <input id="survey-by" name="survey_by" type="text" placeholder="Enter surveyor's name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="survey-date" class="text-xs font-medium block">Date</label>
          <input id="survey-date" name="survey_by_date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>
    
        <div class="grid grid-cols-2 gap-4 mt-3">
          <div class="space-y-2">
          <label for="drawn-by" class="text-xs font-medium block">Drawn By</label>
          <input id="drawn-by" name="drawn_by" type="text" placeholder="Enter drafter's name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="drawn-date" class="text-xs font-medium block">Date</label>
          <input id="drawn-date" name="drawn_by_date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>
    
        <div class="grid grid-cols-2 gap-4 mt-3">
          <div class="space-y-2">
          <label for="checked-by" class="text-xs font-medium block">Checked By</label>
          <input id="checked-by" name="checked_by" type="text" placeholder="Enter checker name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="checked-date" class="text-xs font-medium block">Date</label>
          <input id="checked-date" name="checked_by_date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>
    
        <div class="grid grid-cols-2 gap-4 mt-3">
          <div class="space-y-2">
          <label for="approved-by" class="text-xs font-medium block">Approved By</label>
          <input id="approved-by" name="approved_by" type="text" placeholder="Enter approver's name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
          <div class="space-y-2">
          <label for="approved-date" class="text-xs font-medium block">Date</label>
          <input id="approved-date" name="approved_by_date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
          </div>
        </div>
        </div>
    
        <hr class="my-4">
    
        <div class="flex justify-between items-center">
        <div class="flex gap-2">
          <a href="{{route('sectionaltitling.primary')}}" class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
          <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
          Back
          </a>
          <button type="button" class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
          <i data-lucide="map" class="w-3.5 h-3.5 mr-1.5"></i>
          View Survey Plan
          </button>      
          <button type="button" class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
          <i data-lucide="pencil" class="w-3.5 h-3.5 mr-1.5"></i>
          Edit
          </button>
          <button type="button" id="submit-survey" class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800">
          <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
          Submit
          </button>
        </div>
        </div>
      </div>
      </div>
    </div>
 </form>
