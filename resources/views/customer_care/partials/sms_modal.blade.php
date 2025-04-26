<div id="smsModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg p-6 w-full max-w-md">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-medium">Send SMS</h3>
      <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeSmsModal()">
        <i data-lucide="x" class="w-5 h-5"></i>
      </button>
    </div>
    
    <div class="mb-4">
      <p class="text-sm text-gray-500 mb-2">Send SMS to:</p>
      <div class="flex items-center mb-4">
        <div id="smsCustomerImage" class="w-12 h-12 rounded-full bg-gray-200 mr-4 flex items-center justify-center overflow-hidden">
          <span class="text-gray-500">No Image</span>
        </div>
        <div>
          <h4 id="smsCustomerName" class="font-medium"></h4>
          <p id="smsCustomerPhone" class="text-sm text-gray-500"></p>
        </div>
      </div>
      
      <div class="mb-4">
        <label for="smsMessage" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
        <textarea 
          id="smsMessage" 
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
        onclick="closeSmsModal()"
      >
        Cancel
      </button>
      <button 
        type="button" 
        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"
        onclick="sendSms()"
      >
        Send SMS
      </button>
    </div>
    
    <input type="hidden" id="smsRecipientId">
    <input type="hidden" id="smsRecipientType" value="primary">
  </div>
</div>
