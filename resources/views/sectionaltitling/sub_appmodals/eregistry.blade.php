<div class="modal fade" id="eRegistryModal" tabindex="-1" aria-labelledby="eRegistryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lands & E-Registry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eRegistryForm">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">E-Registry ID</label>
                                <input type="text" class="form-control" id="eRegistryId" name="eRegistryId" value="" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">File Name</label>
                                <input type="text" class="form-control" id="eRegistryFileName" name="eRegistryFileName" value="" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">File Number</label>
                                <input type="text" class="form-control" id="eRegistryFileNo" name="eRegistryFileNo" value="" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">File Location</label>
                                <input type="text" class="form-control" id="eRegistryFileLocation" name="eRegistryFileLocation">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">File Commissioning Date</label>
                                <input type="date" class="form-control" id="eRegistryCommissionDate" name="eRegistryCommissionDate">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Decommissioning Date</label>
                                <input type="date" class="form-control" id="eRegistryDecommissionDate" name="eRegistryDecommissionDate">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: space-between; padding-top: 20px; padding-right: 20px; padding-left: 20px;">
                        <button type="button" class="bttn purple-shadow" data-bs-toggle="modal" data-bs-target="#landsModal">
                            Lands
                            <i class="material-icons" style="color: #9C27B0;">landscape</i>
                        </button>
                        <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); margin-right: 10px; transform: translateY(-5px);">
                            Edit
                            <i class="material-icons" style="color: #9E9E9E;">edit</i>
                        </button>
                        <button type="button" id="submitERegistry" class="bttn green-shadow" 
                        style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px; transform: translateY(-5px);">
                        Submit
                        <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Make sure this code runs AFTER jQuery is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded');
    
    // Check if jQuery is loaded
    if (typeof jQuery === 'undefined') {
        console.error('jQuery is not loaded! This will cause issues with AJAX calls.');
        return;
    }
    
    console.log('eRegistry document ready');
    
    // Make sure jQuery is working and element exists
    if ($('#submitERegistry').length) {
        console.log('Submit button found');
    } else {
        console.error('Submit button not found!');
    }

    // Use document for event delegation
    $(document).on('click', '#submitERegistry', function(e) {
        console.log('Submit button clicked');
        e.preventDefault();
        
        // Check for required fields
        if (!$('#eRegistryFileLocation').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'File Location is required',
                confirmButtonText: 'OK'
            });
            return;
        }
        
        if (!$('#eRegistryCommissionDate').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'File Commissioning Date is required',
                confirmButtonText: 'OK'
            });
            return;
        }
        
        // First temporarily enable disabled fields
        $('#eRegistryId, #eRegistryFileName, #eRegistryFileNo').prop('disabled', false);
        
        // Get the CSRF token
        let token = $('meta[name="csrf-token"]').attr('content');
        if (!token) {
            console.error('CSRF token not found in meta tags');
            // Try to get it from the form
            token = $('input[name="_token"]').val();
            
            if (!token) {
                console.error('CSRF token not found in form either');
                token = '{{ csrf_token() }}';
            } else {
                console.log('CSRF token found in form');
            }
        } else {
            console.log('CSRF token found in meta tags');
        }
        
        // Get form data
        let formData = {
            _token: token,
            eRegistryId: $('#eRegistryId').val(),
            eRegistryFileName: $('#eRegistryFileName').val(),
            eRegistryFileNo: $('#eRegistryFileNo').val(),
            eRegistryFileLocation: $('#eRegistryFileLocation').val(),
            eRegistryCommissionDate: $('#eRegistryCommissionDate').val(),
            eRegistryDecommissionDate: $('#eRegistryDecommissionDate').val()
        };
        
        console.log('Form data:', formData);
        
        // Re-disable the fields
        $('#eRegistryId, #eRegistryFileName, #eRegistryFileNo').prop('disabled', true);
        
        // Show alert before sending request
        console.log('About to send AJAX request to: {{ route("sectionaltitling.saveERegistry") }}');
        
        // Submit AJAX request
        $.ajax({
            type: 'POST',
            url: '{{ route("sectionaltitling.saveERegistry") }}',
            data: formData,
            dataType: 'json',
            beforeSend: function(xhr) {
                console.log('Setting up AJAX request...');
                // Ensure the CSRF token is set in the header
                xhr.setRequestHeader('X-CSRF-TOKEN', token);
                // Show loading indication
                $('#submitERegistry').html('<i class="material-icons" style="color: #4CAF50; font-size: 16px;">hourglass_empty</i> Saving...');
                $('#submitERegistry').prop('disabled', true);
            },
            success: function(response) {
                console.log('AJAX success:', response);
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.success,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Close modal
                    $('#eRegistryModal').modal('hide');
                });
            },
            error: function(xhr, status, error) {
                console.error('AJAX error status:', status);
                console.error('AJAX error:', error);
                console.error('AJAX response:', xhr.responseText);
                
                let errorMessage = 'An error occurred while saving the data.';
                
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }
                
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                });
            },
            complete: function() {
                console.log('AJAX request completed');
                // Reset button
                $('#submitERegistry').html('Submit <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>');
                $('#submitERegistry').prop('disabled', false);
            }
        });
    });
});
</script>