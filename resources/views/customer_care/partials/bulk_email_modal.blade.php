<div id="bulkEmailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl mx-auto">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Send Bulk Email</h3>
            <button onclick="closeBulkEmailModal()" class="text-gray-400 hover:text-gray-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        <div class="p-6">
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="text-base font-medium">Selected Recipients (<span id="selectedEmailRecipientCount">0</span>)</h4>
                </div>
                <div class="border border-gray-200 rounded-md p-2 max-h-40 overflow-y-auto">
                    <div id="selectedEmailRecipientsList" class="divide-y divide-gray-200">
                        <!-- Recipients will be dynamically added here -->
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="bulkEmailSubject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                <input type="text" id="bulkEmailSubject" class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter email subject">
            </div>
            
            <div class="mb-6">
                <label for="bulkEmailMessage" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea id="bulkEmailMessage" rows="6" class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Type your email message here..."></textarea>
            </div>
            
            <input type="hidden" id="bulkEmailType" value="primary">
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeBulkEmailModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </button>
                <button onclick="sendBulkEmail()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Send Bulk Email
                </button>
            </div>
        </div>
    </div>
</div>
