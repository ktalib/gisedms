<div class="modal fade" id="deedsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deeds</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deedsForm">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Serial No</label>
                            <input type="text" class="form-control" value="10" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Page No</label>
                            <input type="text" class="form-control" value="10" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Volume NO</label>
                            <input type="text" class="form-control" value="1" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Deeds Time</label>
                            <input type="text" class="form-control" value="12:00 PM" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deeds Date</label>
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                disabled>
                        </div>
                    </div>

                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div
                            style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 150px; height: 40px;">
                                Close
                                <i class="material-icons"
                                    style="color: #c70707; font-size: 16px;">cancel</i>
                            </button>

                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 150px; height: 40px;">
                                Submit
                                <i class="material-icons"
                                    style="color: #4CAF50; font-size: 16px;">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
