<div id="bulkSmsModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg p-6 w-full max-w-lg">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-medium">Send Bulk SMS</h3>
      <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeBulkSmsModal()">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>
    </div>
    
    <div class="mb-4">
      <p class="text-sm text-gray-500 mb-2">Selected Recipients: <span id="selectedRecipientCount">0</span></p>
      
      <div class="mb-4 max-h-40 overflow-y-auto border border-gray-200 rounded-md p-2">
        <div id="selectedRecipientsList" class="space-y-2"></div>
      </div>
      
      <div class="mb-4">
        <label for="bulkSmsMessage" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
        <textarea 
          id="bulkSmsMessage" 
          rows="4" 
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Type your message here..."
        ></textarea>
      </div>
    </div>
    
    <div class="flex justify-end space-x-3">
      <button 
        type="button" 
        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
        onclick="closeBulkSmsModal()"
      >
        Cancel
      </button>
      <button 
        type="button" 
        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"
        onclick="sendBulkSms()"
      >
        Send Bulk SMS
      </button>
    </div>
    
    <input type="hidden" id="bulkSmsType" value="primary">
  </div>
</div>
