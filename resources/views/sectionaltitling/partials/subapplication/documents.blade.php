<div class="form-section" id="step3">
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-center text-gray-800">MINISTRY OF LAND AND PHYSICAL PLANNING</h2>
        <button id="closeModal2" class="text-gray-500 hover:text-gray-700">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </div>
      
      <div class="mb-6">
        <div class="flex items-center mb-2">
          <i data-lucide="file-text" class="w-5 h-5 mr-2 text-green-600"></i>
          <h3 class="text-lg font-bold">Application for Sectional Titling - Main Application</h3>
          <div class="ml-auto flex items-center">
            <span class="text-gray-600 mr-2">Land Use:</span>
            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">{{ $motherApplication->land_use ?? 'N/A' }}</span>
          </div>
        </div>
        <p class="text-gray-600">Complete the form below to submit a new primary application for sectional titling</p>
      </div>

      <div class="flex items-center mb-8">
        <div class="flex items-center mr-4">
          <div class="step-circle inactive-tab">1</div>
        </div>
        <div class="flex items-center mr-4">
          <div class="step-circle inactive-tab">2</div>
        </div>
        <div class="flex items-center  mr-4">
          <div class="step-circle active-tab">3</div>
        </div>
        <div class="flex items-center  mr-4">
          <div class="step-circle inactive-tab">4</div>
        </div>
        <div class="ml-4">Step 3</div>
      </div>

      <div class="mb-6">
        <div class="flex items-start mb-4">
          <i data-lucide="file-text" class="w-5 h-5 mr-2 text-green-600"></i>
          <span class="font-medium">Required Documents</span>
        </div>
        
        <div class="bg-blue-50 border border-blue-100 rounded-md p-4 mb-6">
          <div class="flex items-start">
            <i data-lucide="info" class="w-5 h-5 mr-2 text-blue-500 mt-0.5"></i>
            <div>
              <h4 class="font-medium text-blue-800">Document Requirements</h4>
              <p class="text-sm text-blue-600">Please upload all required documents. Acceptable formats are PDF, JPG, and PNG. Maximum file size is 5MB per document.</p>
            </div>
          </div>
        </div>
        
        <div class="grid grid-cols-2 gap-6 mb-6">
          <div class="grid grid-cols-2 gap-6 mb-6">
            <div class="border border-gray-200 rounded-md p-4">
                <h4 class="font-medium mb-2">Application Letter</h4>
                <p class="text-sm text-gray-600 mb-4">Formal letter requesting sectional titling</p>
                
                <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="upload" class="w-6 h-6 text-gray-400"></i>
                    </div>
                    <div class="flex justify-center">
                        <input type="file" name="application_letter" id="application_letter" accept=".pdf,.jpg,.jpeg,.png" class="hidden" onchange="updateFileName(this, 'application_letter_label')">
                        <label for="application_letter" id="application_letter_label" class="flex items-center text-blue-600 cursor-pointer">
                            <span>Upload Document</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-2" id="application_letter_name">PDF, JPG or PNG (max. 5MB)</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-md p-4">
                <h4 class="font-medium mb-2">Building Plan</h4>
                <p class="text-sm text-gray-600 mb-4">Approved building plan with architectural details</p>
                
                <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="upload" class="w-6 h-6 text-gray-400"></i>
                    </div>
                    <div class="flex justify-center">
                        <input type="file" name="building_plan" id="building_plan" accept=".pdf,.jpg,.jpeg,.png" class="hidden" onchange="updateFileName(this, 'building_plan_label')">
                        <label for="building_plan" id="building_plan_label" class="flex items-center text-blue-600 cursor-pointer">
                            <span>Upload Document</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-2" id="building_plan_name">PDF, JPG or PNG (max. 5MB)</p>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div class="border border-gray-200 rounded-md p-4">
                <h4 class="font-medium mb-2">Architectural Design</h4>
                <p class="text-sm text-gray-600 mb-4">Detailed architectural design of the property</p>
                
                <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="upload" class="w-6 h-6 text-gray-400"></i>
                    </div>
                    <div class="flex justify-center">
                        <input type="file" name="architectural_design" id="architectural_design" accept=".pdf,.jpg,.jpeg,.png" class="hidden" onchange="updateFileName(this, 'architectural_design_label')">
                        <label for="architectural_design" id="architectural_design_label" class="flex items-center text-blue-600 cursor-pointer">
                            <span>Upload Document</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-2" id="architectural_design_name">PDF, JPG or PNG (max. 5MB)</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-md p-4">
                <h4 class="font-medium mb-2">Ownership Document</h4>
                <p class="text-sm text-gray-600 mb-4">Proof of ownership (CofO, deed, etc.)</p>
                
                <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="upload" class="w-6 h-6 text-gray-400"></i>
                    </div>
                    <div class="flex justify-center">
                        <input type="file" name="ownership_document" id="ownership_document" accept=".pdf,.jpg,.jpeg,.png" class="hidden" onchange="updateFileName(this, 'ownership_document_label')">
                        <label for="ownership_document" id="ownership_document_label" class="flex items-center text-blue-600 cursor-pointer">
                            <span>Upload Document</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-500 mt-2" id="ownership_document_name">PDF, JPG or PNG (max. 5MB)</p>
                </div>
            </div>
        </div>
        </div>
        
 
        
        <div class="flex justify-between mt-8">
          <button class="px-4 py-2 bg-white border border-gray-300 rounded-md" id="backStep3">Back</button>
          <div class="flex items-center">
            <span class="text-sm text-gray-500 mr-4">Step 2 of 3</span>
            <button class="px-4 py-2 bg-black text-white rounded-md" id="nextStep3">Next</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function updateFileName(input, labelId) {
        const fileName = input.files[0]?.name;
        if (fileName) {
            document.getElementById(input.id + '_name').textContent = fileName;
            document.getElementById(labelId).innerHTML = '<span>Change Document</span>';
            
            // Trigger the summary update whenever a document is uploaded
            if (typeof updateApplicationSummary === 'function') {
                updateApplicationSummary();
            }
        }
    }
    </script>