<div class="modal fade" id="surveyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Survey Department Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="surveyForm">
                    <div class="row g-3">
                        <!-- First row -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Survey By</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>

                        <!-- Second row -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Approved By</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div
                            style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow"
                                onclick="showDepartmentConfirmation('ok')"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                OK
                                <i class="material-icons"
                                    style="color: #4CAF50; font-size: 16px;">check_circle</i>
                            </button>
                            <button type="button" class="bttn gray-shadow"
                                onclick="showDepartmentConfirmation('edit')"
                                style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                Edit
                                <i class="material-icons"
                                    style="color: #9E9E9E; font-size: 16px;">edit</i>
                            </button>
                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
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