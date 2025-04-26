<div id="viewSurveyPlanModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl flex flex-col h-full">
        <div class="flex items-center justify-between px-4 py-2 border-b">
            <h5 class="text-base font-semibold">Survey Plan</h5>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeViewSurveyPlanModal()">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="px-4 py-4 overflow-y-auto flex-grow">
            {{-- Displaying survey plan image --}}
            <div class="text-center">
                <img src="{{ asset(Storage::url('uploads')) . '/survey.jpeg' }}" alt="Survey Plan" class="max-w-full h-auto mx-auto max-h-[80vh]">
            </div>
        </div>
        <div class="flex justify-center items-center space-x-3 px-4 py-3 border-t bg-gray-50">
            <button type="button" class="px-3 py-1.5 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 flex items-center text-sm shadow-sm" onclick="closeViewSurveyPlanModal()">
                Close
                <i data-lucide="x-circle" class="w-4 h-4 ml-1 text-gray-600"></i>
            </button>
            <button type="button" class="px-3 py-1.5 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 flex items-center text-sm shadow-sm" onclick="printSurveyPlan()">
                Print Survey Plan
                <i data-lucide="printer" class="w-4 h-4 ml-1 text-blue-600"></i>
            </button>
        </div>
    </div>
</div>
