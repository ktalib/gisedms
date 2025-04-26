{{-- Planning Recommendation Modal (Tailwind version) --}}
<div id="planningRecommendationModal"
    class="fixed inset-0 z-60 flex items-center justify-center bg-black bg-opacity-40 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6 relative">
        <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
            onclick="closePlanningRecommendationModal()">
            <span class="text-2xl">&times;</span>
        </button>
        <h2 class="text-xl font-semibold mb-4">Planning Recommendation</h2>
        <form id="planningRecommendationForm">
            <input type="hidden" name="application_id" id="planningRecommendationApplicationId" value="">
            <!-- CSRF token for Laravel -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Decision</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="decision" value="approve" id="prApprove"
                            class="form-radio text-green-600" checked>
                        <span class="ml-2">Approve</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="decision" value="decline" id="prDecline"
                            class="form-radio text-red-600 ml-3">
                        <span class="ml-2">Decline</span>
                    </label>
                </div>
            </div>
            <div class="mb-4" id="declineReasonGroup" style="display:none;">
                <label for="declineReason" class="block text-gray-700 mb-2">Reason For Decline</label>
                <textarea class="w-full border rounded px-3 py-2" id="declineReason" name="comments"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="approvalDate" class="block text-gray-700 mb-2">Approval/Decline Date</label>
                    <input type="datetime-local" class="w-full border rounded px-3 py-2" id="approvalDate"
                        name="approval_date" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">....</label>
                    <select class="w-full border rounded px-3 py-2" onchange="handleSelectChange(this.value)">
                        <option value="" disabled selected>Select</option>
                        <option value="architectural">Architectural Design</option>
                        <option value="planningRec">Planning Recommendation</option>
                    </select>
                </div>
                <div></div>
                <div></div>
            </div>
            {{-- Action Buttons Section --}}
            <div class="bg-gray-100 rounded-lg px-4 py-3 mt-4">
                <div class="flex justify-center space-x-3">
                    <button type="button"
                        class="flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium bg-gray-200 hover:bg-gray-300 text-gray-700 border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        onclick="closePlanningRecommendationModal()">
                        Cancel
                        <i data-lucide="x-circle" class="ml-1.5 -mr-1 h-4 w-4 text-red-500"></i>
                    </button>

                    {{-- Submit Button --}}
                    <button type="submit" id="planningRecommendationSubmitBtn"
                        class="flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700 border border-transparent shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Submit
                        <i data-lucide="check-circle" class="ml-1.5 -mr-1 h-4 w-4 text-white"></i>
                    </button>

                    {{-- Gen & Print Bill Button --}}
                    <button type="button"
                        class="flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 border border-transparent shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        onclick="showGenDocumentModal(); return false;">
                        Gen & Print Bill
                        <i data-lucide="printer" class="ml-1.5 -mr-1 h-4 w-4 text-white"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Preloader --}}
<div id="preloader" class="fixed inset-0 z-70 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
</div>

<script>
    function openPlanningRecommendationModal(applicationId) {
        document.getElementById('planningRecommendationApplicationId').value = applicationId;
        document.getElementById('planningRecommendationModal').classList.remove('hidden');
    }

    function closePlanningRecommendationModal() {
        document.getElementById('planningRecommendationModal').classList.add('hidden');
        document.getElementById('planningRecommendationForm').reset();
    }

    function showPreloader() {
        Swal.fire({
            title: 'Processing...',
            html: 'Approval',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    function hidePreloader() {
        Swal.close();
    }

    // Show/hide decline reason textarea
    document.addEventListener('DOMContentLoaded', function() {
        const approveRadio = document.getElementById('prApprove');
        const declineRadio = document.getElementById('prDecline');
        const declineGroup = document.getElementById('declineReasonGroup');
        if (approveRadio && declineRadio && declineGroup) {
            approveRadio.addEventListener('change', function() {
                if (approveRadio.checked) {
                    declineGroup.style.display = 'none';
                }
            });
            declineRadio.addEventListener('change', function() {
                if (declineRadio.checked) {
                    declineGroup.style.display = '';
                }
            });
        }
    });

    // Add form submission via AJAX with SweetAlert and preloader
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('planningRecommendationForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show preloader
            showPreloader();
            
            // Disable submit button
            document.getElementById('planningRecommendationSubmitBtn').disabled = true;
            
            const formData = new FormData(form);
            const applicationId = document.getElementById('planningRecommendationApplicationId').value;
            const decision = document.querySelector('input[name="decision"]:checked').value;
            const approvalDate = document.getElementById('approvalDate').value;
            let comments = '';
            
            if (decision === 'decline') {
                comments = document.getElementById('declineReason').value;
            }
            
            // AJAX request
            fetch('{{ url("planning-recommendation/update") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    application_id: applicationId,
                    status: decision,
                    approval_date: approvalDate,
                    comments: comments
                })
            })
            .then(response => response.json())
            .then(data => {
                // Hide preloader
                hidePreloader();
                
                // Enable submit button
                document.getElementById('planningRecommendationSubmitBtn').disabled = false;
                
                if (data.success) {
                    // Show success message with SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Planning recommendation updated successfully!',
                        confirmButtonColor: '#10B981'
                    }).then((result) => {
                        closePlanningRecommendationModal();
                        // Refresh the page or update UI as needed
                        location.reload();
                    });
                } else {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Something went wrong!',
                        confirmButtonColor: '#EF4444'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Hide preloader
                hidePreloader();
                
                // Enable submit button
                document.getElementById('planningRecommendationSubmitBtn').disabled = false;
                
                // Show error with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating planning recommendation.',
                    confirmButtonColor: '#EF4444'
                });
            });
        });
    });
</script>

