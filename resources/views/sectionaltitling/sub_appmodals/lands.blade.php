<div class="modal fade" id="landsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lands</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="landsForm">
                    <div class="mb-3">
                        <label for="landsFileNo" class="form-label">File No</label>
                        <input type="text" class="form-control" id="landsFileNo" name="landsFileNo" required>
                    </div>
                    <div class="mb-3">
                        <label for="landsFileName" class="form-label">File Name</label>
                        <input type="text" class="form-control" id="landsFileName" name="landsFileName" required>
                    </div>
                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow" 
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;" onclick="showDepartmentConfirmation('ok')">
                                OK
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">check_circle</i>
                            </button>
                            <button type="button" class="bttn gray-shadow" 
                                style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;" onclick="openFile()">
                                Open File
                                <i class="material-icons" style="color: #2196F3; font-size: 16px;">folder_open</i>
                            </button>
                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
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
