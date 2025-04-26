<div id="OtherApprovalsModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    {{-- Adjusted max-width if needed, keeping it reasonable for smaller buttons --}}
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xs"> {{-- Reduced max-width slightly --}}
        <div class="flex items-center justify-between px-4 py-2 border-b">
            <h5 class="text-base font-semibold">Other Departments</h5>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeOtherApprovalsModal()">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="px-4 py-4 bg-gray-50">

            {{-- Hidden input to store the application ID --}}
            <input type="text" id="otherApprovalsApplicationId" name="application_id" value="">

            {{-- Grid layout for buttons --}}
            <div class="grid grid-cols-2 gap-3"> {{-- Reduced gap slightly --}}

                {{-- Survey Button --}}
                <button
                    class="flex flex-col items-center justify-center p-2 rounded-md shadow hover:shadow-md text-xs bg-pink-100 hover:bg-pink-200 text-pink-700 transition duration-150 ease-in-out" {{-- Reduced padding, text size --}}
                    onclick="openSurveyModal()">
                    <i data-lucide="map" class="w-4 h-4 text-pink-500 mb-0.5"></i> {{-- Reduced icon size, margin --}}
                    <span class="font-medium">Survey</span>
                </button>

                {{-- Deeds Button --}}
                <button
                    class="flex flex-col items-center justify-center p-2 rounded-md shadow hover:shadow-md text-xs bg-purple-100 hover:bg-purple-200 text-purple-700 transition duration-150 ease-in-out" {{-- Reduced padding, text size --}}
                    onclick="openDeedsModal()">
                    <i data-lucide="gavel" class="w-4 h-4 text-purple-500 mb-0.5"></i> {{-- Reduced icon size, margin --}}
                    <span class="font-medium">Deeds</span>
                </button>

                {{-- Lands Button (Spanning both columns for centering) --}}
                <button type="button"
                    class="col-span-2 flex flex-col items-center justify-center p-2 rounded-md shadow hover:shadow-md text-xs bg-blue-100 hover:bg-blue-200 text-blue-700 transition duration-150 ease-in-out" {{-- Reduced padding, text size --}}
                    onclick="openLandsModal()">
                    <i data-lucide="proportions" class="w-4 h-4 text-blue-500 mb-0.5"></i> {{-- Reduced icon size, margin --}}
                    <span class="font-medium">Lands</span>
                </button>

            </div>
        </div>
    </div>
</div>

<div id="surveyModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="flex items-center justify-between px-4 py-2 border-b">
            <h5 class="text-base font-semibold">Survey</h5>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeSurveyModal()">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="px-4 py-4 bg-gray-50">
            <form method="POST" action="{{ route('sub-application.survey.store') }}" onsubmit="showPreloader(event)">
                @csrf
                {{-- Hidden input to store the application ID --}}
                <input type="hidden" id="survey-application-id" value="" disabled>

                {{-- Applicant Name and File No (Readonly) --}}
                <div class="grid grid-cols-2 gap-4 mb-4" style="display: none;">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">FileNo</label>
                        <input type="text" name="fileno" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="fileno-display">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">ID</label>
                        <input type="text" name="sub_application_id" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="survey-file-no">
                    </div>
                </div>

                {{-- Survey By / Date --}}
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Survey By</label>
                        <input type="text" name="survey_by" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="survey_by_date" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                </div>

                {{-- Drawn By / Date --}}
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Drawn By</label>
                        <input type="text" name="drawn_by" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="drawn_by_date" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                </div>

                {{-- Checked By / Date --}}
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Checked By</label>
                        <input type="text" name="checked_by" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="checked_by_date" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                </div>

                {{-- Approved By / Date --}}
                <div class="grid grid-cols-2 gap-4 mb-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Approved By</label>
                        <input type="text" name="approved_by" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="approved_by_date" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                    </div>
                </div>

                {{-- View Survey Plan Button --}}
                <div class="mb-4">
                    <button type="button" class="px-3 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 flex items-center text-sm" onclick="openViewSurveyPlanModal()">
                        <i data-lucide="map" class="w-4 h-4 mr-1"></i> View Survey Plan
                    </button>
                </div>

                {{-- Footer Buttons --}}
                <div class="mt-5 pt-4 border-t border-gray-200">
                    <div class="flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 flex items-center text-sm" onclick="closeSurveyModal()">
                            Close
                            <i data-lucide="x" class="w-4 h-4 ml-1 text-red-600"></i>
                        </button>
                        <button type="button" class="px-3 py-1.5 bg-green-100 text-green-800 rounded-md hover:bg-green-200 flex items-center shadow-sm text-sm" onclick="showDepartmentConfirmation('ok')">
                            OK
                            <i data-lucide="check-circle" class="w-4 h-4 ml-1 text-green-600"></i>
                        </button>
                        <button type="button" class="px-3 py-1.5 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 flex items-center shadow-sm text-sm" onclick="showDepartmentConfirmation('edit')">
                            Edit
                            <i data-lucide="edit" class="w-4 h-4 ml-1 text-gray-600"></i>
                        </button>
                        <button type="submit" class="px-3 py-1.5 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 flex items-center shadow-sm text-sm">
                            Submit
                            <i data-lucide="send" class="w-4 h-4 ml-1 text-blue-600"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showPreloader(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Processing...',
            html: 'Submitting Survey',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        event.target.submit();
    }
</script>
                        
<div id="deedsModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="flex items-center justify-between px-4 py-2 border-b">
            <h5 class="text-base font-semibold">Deeds</h5>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeDeedsModal()">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        
        <div class="px-4 py-4 bg-gray-50">
            <form id="deedsForm" method="POST" action="{{ route('sub-application.deeds.store') }}" onsubmit="showDeedsPreloader(event)">
                @csrf
           
                <input type="hidden" id="deeds-application-id" name="sub_application_id" value="">
                
                <div class="grid gap-4 mb-3">
                    
                          <input type="hidden" class="w-full px-3 py-2 border border-gray-300 rounded-md" name="sub_application_id"  id="applicant-name">
               
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">File No</label>
                        <input type="hidden" class="w-full px-3 py-2 border border-gray-300 rounded-md" id="deedfileno-display" readonly>
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-3 mb-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Serial No</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" name="serial_no">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Page No</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" name="page_no">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Volume No</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" name="volume_no">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deeds Time</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" name="deeds_time">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deeds Date</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md" name="deeds_date">
                    </div>
                </div>

                <div class="flex justify-between mt-5 pt-3 border-t">
                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 flex items-center" onclick="closeDeedsModal()">
                        Close
                        <i data-lucide="x" class="w-4 h-4 ml-1 text-red-600"></i>
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-100 text-green-800 rounded-md hover:bg-green-200 flex items-center shadow-sm">
                        Submit
                        <i data-lucide="send" class="w-4 h-4 ml-1 text-green-600"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
   

{{-- Land Modal --}}
<div id="landsModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="flex items-center justify-between px-4 py-2 border-b">
            <h5 class="text-base font-semibold">Lands</h5>
            <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeLandsModal()">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="px-4 py-4">
            <form id="landsForm">
                <div class="mb-4">
                    <label for="landsFileNo" class="block text-sm font-medium text-gray-700">File No</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="landsFileNo" name="landsFileNo" required>
                </div>
                <div class="mb-4">
                    <label for="landsFileName" class="block text-sm font-medium text-gray-700">File Name</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" id="landsFileName" name="landsFileName" required>
                </div>
                <div class="flex justify-between items-center bg-gray-100 mt-4 px-4 py-3 rounded-b">
                    <button type="button" class="flex items-center space-x-2 px-3 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600" onclick="showDepartmentConfirmation('ok')">
                        <span>OK</span>
                        <i data-lucide="check-circle" class="w-4 h-4 text-white"></i>
                    </button>
                    <button type="button" class="flex items-center space-x-2 px-3 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600" onclick="openFile()">
                        <span>EDMS</span>
                        <i data-lucide="folder-open" class="w-4 h-4 text-white"></i>
                    </button>
                    <button type="submit" class="flex items-center space-x-2 px-3 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">
                        <span>Submit</span>
                        <i data-lucide="send" class="w-4 h-4 text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showDeedsPreloader(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Processing...',
            html: 'Submitting Deeds',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        event.target.submit();
    }
</script>

<!-- View Survey Plan Modal -->
@include('sectionaltitling.sub_action_modals.survey_plan')
<script>
    //OtherApprovals
    let currentApplicationId = null; // Store application ID globally within this script scope

    function openOtherApprovalsModal(applicationId) {
        // Set the value of the hidden input field
        document.getElementById('otherApprovalsApplicationId').value = applicationId;
        currentApplicationId = applicationId; // Store it
        // Show the modal
        document.getElementById('OtherApprovalsModal').classList.remove('hidden');
    }

    function closeOtherApprovalsModal() {
        document.getElementById('OtherApprovalsModal').classList.add('hidden');
        // Optional: Clear the hidden input value when closing
        document.getElementById('otherApprovalsApplicationId').value = '';
    }
    // Close modal when clicking outside the modal content
    document.addEventListener('mousedown', function(event) {
        const modal = document.getElementById('OtherApprovalsModal');
        if (!modal.classList.contains('hidden')) {
            const modalContent = modal.querySelector('div.bg-white');
            if (modal && !modalContent.contains(event.target)) {
                closeOtherApprovalsModal();
            }
        }
    });

    //Survey Modal
    function openSurveyModal() {
        if (!currentApplicationId) {
            console.error("Application ID not set.");
            return;
        }
        // Set the application ID in the survey form
        document.getElementById('survey-application-id').value = currentApplicationId;
        document.getElementById('survey-file-no').value = currentApplicationId;
        
        // Fetch file number for the survey modal
        fetch(`/gisedms/sub-application/${currentApplicationId}`)
            .then(response => {
                return response.json();
            })
            .then(data => {
                // Corrected ID to match the input field in the survey modal
                const fileNoInput = document.getElementById('fileno-display');
                if (fileNoInput) {
                    fileNoInput.value = data.fileno || 'N/A';
                } else {
                    console.error('Survey FileNo input field not found.');
                }
            })
            .catch(error => {
                console.error('Error fetching file details:', error);
                console.error('Error fetching file details:', error);
            });

        // Show the survey modal
        document.getElementById('surveyModal').classList.remove('hidden');
        // Close the other approvals modal
        closeOtherApprovalsModal();
    }

    function closeSurveyModal() {
        document.getElementById('surveyModal').classList.add('hidden');
        // Optional: Clear fields when closing
        document.getElementById('surveyForm').reset();
        document.getElementById('survey-application-id').value = '';
        currentApplicationId = null; // Clear stored ID
    }

    // Close survey modal when clicking outside
    document.addEventListener('mousedown', function(event) {
        const modal = document.getElementById('surveyModal');
        if (!modal.classList.contains('hidden')) {
            const modalContent = modal.querySelector('div.bg-white');
            if (modal && !modalContent.contains(event.target)) {
                closeSurveyModal();
            }
        }
    });

    // Handle Survey Form Submission (Example)
    document.getElementById('surveyForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        console.log('Survey form submitted for application ID:', document.getElementById('survey-application-id').value);
        // TODO: Add AJAX logic to submit form data
        // After successful submission, close the modal
        // closeSurveyModal();
    });

    //Deeds Modal
    function openDeedsModal() {
        if (!currentApplicationId) {
            console.error("Application ID not set.");
            return;
        }
        // Set the application ID in the deeds form
        document.getElementById('deeds-application-id').value = currentApplicationId;

        // TODO: Fetch applicant name and file number based on currentApplicationId
        // Example placeholder logic (replace with actual fetch/data retrieval)
        document.getElementById('applicant-name').value =  currentApplicationId; // Placeholder - Deeds
        
        fetch(`/gisedms/sub-application/${currentApplicationId}`)
            .then(response => {
                return response.json();
            })
            .then(data => {
                // Corrected ID to match the input field in the survey modal
                const fileNoInput = document.getElementById('deedfileno-display');
                if (fileNoInput) {
                    fileNoInput.value = data.fileno || 'N/A';
                } else {
                    console.error('Survey FileNo input field not found.');
                }
            })
            .catch(error => {
                console.error('Error fetching file details:', error);
                console.error('Error fetching file details:', error);
            });
        // Show the deeds modal
        document.getElementById('deedsModal').classList.remove('hidden');
        // Close the other approvals modal
        closeOtherApprovalsModal();
    }

    function closeDeedsModal() {
        document.getElementById('deedsModal').classList.add('hidden');
        // Optional: Clear fields when closing
        document.getElementById('deedsForm').reset();
        document.getElementById('deeds-application-id').value = '';
        currentApplicationId = null; // Clear stored ID
    }

    // Close deeds modal when clicking outside
    document.addEventListener('mousedown', function(event) {
        const modal = document.getElementById('deedsModal');
        if (!modal.classList.contains('hidden')) {
            const modalContent = modal.querySelector('div.bg-white');
            if (modal && !modalContent.contains(event.target)) {
                closeDeedsModal();
            }
        }
    });

    // Handle Deeds Form Submission (Example)
    document.getElementById('deedsForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        console.log('Deeds form submitted for application ID:', document.getElementById('deeds-application-id').value);
        // TODO: Add AJAX logic to submit form data
        // After successful submission, close the modal
        // closeDeedsModal();
    });

    // View Survey Plan Modal
    function openViewSurveyPlanModal() {
        document.getElementById('viewSurveyPlanModal').classList.remove('hidden');
    }

    function closeViewSurveyPlanModal() {
        document.getElementById('viewSurveyPlanModal').classList.add('hidden');
    }

    // Close view survey plan modal when clicking outside
    document.addEventListener('mousedown', function(event) {
        const modal = document.getElementById('viewSurveyPlanModal');
        if (!modal.classList.contains('hidden')) {
            const modalContent = modal.querySelector('div.bg-white');
            if (modal && !modalContent.contains(event.target)) {
                closeViewSurveyPlanModal();
            }
        }
    });

    // Placeholder Print Function
    function printSurveyPlan() {
        console.log("Print Survey Plan clicked");
        // Add actual print logic here, potentially opening a print dialog for the image or a specific section
        // window.print(); // This would print the whole page, likely not desired.
        // You might need to isolate the image or content to print.
    }

    // Placeholder for Survey Modal OK/Edit buttons
    function showDepartmentConfirmation(action) {
        console.log(`Department confirmation action: ${action}`);
        // Add logic for OK/Edit actions here
    }

    // Handle Survey Form Submission (Example)
    document.getElementById('surveyForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        console.log('Survey form submitted for application ID:', document.getElementById('survey-application-id').value);
        // TODO: Add AJAX logic to submit form data
        // After successful submission, close the modal
        // closeSurveyModal();
    });


        // Lands Modal logic  
    async function fetchFileNo(applicationId) {
        try {
            console.log('Fetching file number for application ID:', applicationId);
            const response = await fetch(`/sub-application/${applicationId}`);
            
            if (!response.ok) {
                throw new Error('Failed to fetch application details');
            }
            
            const data = await response.json();
            console.log('Received data:', data);
            
            const landsFileNoInput = document.getElementById('landsFileNo');
            console.log('Found input element:', landsFileNoInput);
            
            if (landsFileNoInput) {
                landsFileNoInput.value = data.fileno || 'N/A';
                console.log('Set value to:', data.fileno || 'N/A');
            } else {
                console.error('landsFileNo input field not found.');
            }
        } catch (error) {
            console.error('Error fetching application details:', error);
        }
    }

    function openLandsModal() {
        if (!currentApplicationId) {
            console.error("Application ID not set.");
            return;
        }
        
        // First show the modal so the DOM element exists
        document.getElementById('landsModal').classList.remove('hidden');
        
        // Then fetch and populate the file number
        fetchFileNo(currentApplicationId);
    }

    function closeLandsModal() {
        document.getElementById('landsModal').classList.add('hidden');
    }
    // Close lands modal when clicking outside the modal content
    document.addEventListener('mousedown', function(event) {
        const modal = document.getElementById('landsModal');
        if (!modal.classList.contains('hidden')) {
            const modalContent = modal.querySelector('div.bg-white');
            if (modal && !modalContent.contains(event.target)) {
                closeLandsModal();
            }
        }
    });
</script>
