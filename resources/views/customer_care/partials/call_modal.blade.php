<div id="callModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg p-6 w-full max-w-md">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-medium">Call Customer</h3>
      <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeCallModal()">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>
    </div>
    
    <div class="mb-4">
      <p class="text-sm text-gray-500 mb-2">You are about to call:</p>
      <div class="flex items-center">
        <div id="callCustomerImage" class="w-12 h-12 rounded-full bg-gray-200 mr-4 flex items-center justify-center overflow-hidden">
          <span class="text-gray-500">No Image</span>
        </div>
        <div>
          <h4 id="callCustomerName" class="font-medium"></h4>
          <p id="callCustomerPhone" class="text-sm text-gray-500"></p>
        </div>
      </div>
    </div>
    
    <div class="flex justify-end space-x-3">
      <button 
        type="button" 
        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
        onclick="closeCallModal()"
      >
        Cancel
      </button>
      <button 
        type="button" 
        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
        onclick="initiateCall()"
      >
        Call Now
      </button>
    </div>
    
    <input type="hidden" id="callRecipientId">
    <input type="hidden" id="callRecipientType" value="primary">
  </div>
</div>
