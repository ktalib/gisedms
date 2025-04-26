<div id="emailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-auto">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Send Email</h3>
            <button onclick="closeEmailModal()" class="text-gray-400 hover:text-gray-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        <div class="p-6">
            <div class="flex space-x-4 mb-6">
                <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden" id="emailCustomerImage">
                    <span class="text-gray-500">No Image</span>
                </div>
                
                <div class="flex-1">
                    <h4 class="text-lg font-medium" id="emailCustomerName">Customer Name</h4>
                    <p class="text-gray-500" id="emailCustomerEmail">email@example.com</p>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="emailSubject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                <input type="text" id="emailSubject" class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter email subject">
            </div>
            
            <div class="mb-6">
                <label for="emailMessage" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea id="emailMessage" rows="6" class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Type your email message here..."></textarea>
            </div>
            
            <input type="hidden" id="emailRecipientId" value="">
            <input type="hidden" id="emailRecipientType" value="primary">
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeEmailModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </button>
                <button onclick="sendEmail()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Send Email
                </button>
            </div>
        </div>
    </div>
</div>
