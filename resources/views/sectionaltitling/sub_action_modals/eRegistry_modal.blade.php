<div id="eRegistryModal" class="fixed inset-0 z-[1000] hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg">
        <div class="flex items-center justify-between px-4 py-2 border-b">
            <h5 class="text-base font-semibold">eRegistry</h5>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeERegistryModal()">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="px-4 py-4">
            <form id="eRegistryForm">
                @csrf
                <input type="text" id="eRegistryApplicationId" name="application_id" value="">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">eRegistry ID</label>
                        <input type="text"  class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="eRegistryId" name="eRegistryId" value="" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">File Name</label>
                        <input type="text"  class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="eRegistryFileName" name="eRegistryFileName" value="" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">File Number</label>
                        <input type="text"  class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="eRegistryFileNo" name="eRegistryFileNo" value="" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">File Location</label>
                        <input type="text"  class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="eRegistryFileLocation" name="eRegistryFileLocation">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">File Commissioning Date</label>
                        <input type="date"  class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="eRegistryCommissionDate" name="eRegistryCommissionDate">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Decommissioning Date</label>
                        <input type="date"  class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="eRegistryDecommissionDate" name="eRegistryDecommissionDate">
                    </div>
                </div>
                <div class="flex justify-between items-center bg-gray-100 mt-4 px-4 py-3 rounded-b">
            
                    <button type="button" class="flex items-center space-x-2 px-4 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600">
                        <i data-lucide="edit" class="w-4 h-4"></i>
                        <span>Edit</span>
                    </button>
                    <button type="button" id="submitERegistry" class="flex items-center space-x-2 px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>Submit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Lands Modal -->


 <script>
     


    // eRegistry Modal logic
    function openERegistryModal(applicationId) {
        // Set the application id to the hidden input
        document.getElementById('eRegistryApplicationId').value = applicationId;
        // Show the modal
        document.getElementById('eRegistryModal').classList.remove('hidden');
    }
    function closeERegistryModal() {
        document.getElementById('eRegistryModal').classList.add('hidden');
        document.getElementById('eRegistryApplicationId').value = '';
    }
    // Close modal when clicking outside the modal content
    document.addEventListener('mousedown', function(event) {
        const modal = document.getElementById('eRegistryModal');
        if (!modal.classList.contains('hidden')) {
            const modalContent = modal.querySelector('div.bg-white');
            if (modal && !modalContent.contains(event.target)) {
                closeERegistryModal();
            }
        }
    });


       
 </script>