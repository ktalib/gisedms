{{-- Director's Approval Modal (Tailwind version) --}}
<div id="directorApprovalModal"
    class="fixed inset-0 z-60 flex items-center justify-center bg-black bg-opacity-40 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6 relative">
        <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
            onclick="closeDirectorApprovalModal()">
            <span class="text-2xl">&times;</span>
        </button>
        <h2 class="text-xl font-semibold mb-4">Director's Approval</h2>
        <form id="directorApprovalForm">
            <input type="hidden" name="application_id" id="directorApprovalApplicationId" value="">
            <!-- CSRF token for Laravel -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Decision</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="decision" value="approve" id="daApprove"
                            class="form-radio text-green-600" checked>
                        <span class="ml-2">Approve</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="decision" value="decline" id="daDecline"
                            class="form-radio text-red-600 ml-3">
                        <span class="ml-2">Decline</span>
                    </label>
                </div>
            </div>
            <div class="mb-4" id="daDeclineReasonGroup" style="display:none;">
                <label for="daDeclineReason" class="block text-gray-700 mb-2">Reason For Decline</label>
                <textarea class="w-full border rounded px-3 py-2" id="daDeclineReason" name="comments"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="daApprovalDate" class="block text-gray-700 mb-2">Approval/Decline Date</label>
                    <input type="datetime-local" class="w-full border rounded px-3 py-2" id="daApprovalDate"
                        name="approval_date" required>
                </div>
            </div>

            {{-- Action Buttons Section --}}
            <div class="bg-gray-100 rounded-lg px-4 py-3 mt-4">
                <div class="grid grid-cols-3 gap-2">
                    <button type="button"
                        class="bttn green-shadow flex items-center justify-center px-3 py-2 rounded bg-gray-200 hover:bg-gray-300 text-sm w-full"
                        onclick="closeDirectorApprovalModal()">
                        Cancel
                        <i data-lucide="x-circle" class="ml-1 w-4 h-4 text-red-500"></i>
                    </button>
                    <button type="submit"
                        class="bttn green-shadow flex items-center justify-center px-3 py-2 rounded bg-green-600 hover:bg-green-700 text-white text-sm w-full">
                        Submit
                        <i data-lucide="send" class="ml-1 w-4 h-4 text-white"></i>
                    </button>
                    <button type="button"
                        class="bttn blue-shadow flex items-center justify-center px-3 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white text-sm w-full"
                        onclick="showFinalBillModal(); return false;">
                        Final Bill
                        <i data-lucide="receipt" class="ml-1 w-4 h-4 text-indigo-200"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openDirectorApprovalModal(applicationId) {
        document.getElementById('directorApprovalApplicationId').value = applicationId;
        document.getElementById('directorApprovalModal').classList.remove('hidden');
    }

    function closeDirectorApprovalModal() {
        document.getElementById('directorApprovalModal').classList.add('hidden');
        document.getElementById('directorApprovalForm').reset();
    }

    // Show/hide decline reason textarea
    document.addEventListener('DOMContentLoaded', function() {
        const approveRadio = document.getElementById('daApprove');
        const declineRadio = document.getElementById('daDecline');
        const declineGroup = document.getElementById('daDeclineReasonGroup');
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

        // Add form submission via AJAX
        const form = document.getElementById('directorApprovalForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const applicationId = document.getElementById('directorApprovalApplicationId').value;
            const decision = document.querySelector('input[name="decision"]:checked').value;
            const approvalDate = document.getElementById('daApprovalDate').value;
            let comments = '';
            
            if (decision === 'decline') {
                comments = document.getElementById('daDeclineReason').value;
            }
            
            // Show preloader with SweetAlert
            Swal.fire({
                title: 'Processing...',
                html: 'Submitting director\'s approval',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // AJAX request
            fetch('{{ url('/sub-application/director-approval') }}', {
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
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Director\'s approval updated successfully!'
                    }).then(() => {
                        closeDirectorApprovalModal();
                        // Refresh the page or update UI as needed
                        location.reload();
                    });
                } else {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to update approval'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating director\'s approval.'
                });
            });
        });
    });
</script>
