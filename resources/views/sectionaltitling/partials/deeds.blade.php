<div class="modal fade" id="deedsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deeds</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deedsForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Serial No</label>
                            <input type="text" class="form-control"   name="serial_no">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Page No</label>
                            <input type="text" class="form-control"   name="page_no">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Volume NO</label>
                            <input type="text" class="form-control"  name="volume_no">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Deeds Time</label>
                            <input type="text" class="form-control" name="deeds_time">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deeds Date</label>
                            <input type="date" class="form-control" name="deeds_date">
                        </div>
                    </div> 
                    
                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow" data-bs-dismiss="modal" aria-label="Close"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 150px; height: 40px;">
                                Close
                                <i class="material-icons" style="color: #c70707; font-size: 16px;">cancel</i>
                            </button>
                             
                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 150px; height: 40px;">
                                Submit
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#deedsForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true).text('Sending...');
        $.ajax({
            url: '{{ route("deeds.insert") }}',
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                submitBtn.prop('disabled', false).text('Submit');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Deed data inserted successfully',
                }).then(() => {
                    $('#deedsModal').modal('hide');
                });
            },
            error: function(err) {
                console.error("Error submitting deed data:", err);
                submitBtn.prop('disabled', false).text('Submit');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error submitting deed data. Check console for details.',
                });
            }
        });
    });
</script>
