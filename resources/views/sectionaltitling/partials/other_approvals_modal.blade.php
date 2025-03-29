<!-- filepath: c:\wamp64\www\gisedms\resources\views\sectionaltitling\partials\other_approvals_modal.blade.php -->
<div class="modal fade" id="OtherApprovals" tabindex="-1" aria-labelledby="OtherApprovalsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OtherApprovalsLabel">Other Approvals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="button-grid">
                    <button type="button" class="bttn" onclick="showDepartmentConfirmation('survey')">
                        Survey
                        <i class="material-icons text-orange-500">straighten</i>
                    </button>
                    
                    <button type="button" class="bttn" onclick="showDepartmentConfirmation('deeds')">
                        Deeds
                        <i class="material-icons text-purple-500">menu_book</i>
                    </button>
                    
                    <button type="button" class="bttn" onclick="showDepartmentConfirmation('architectural')">
                        Architectural
                        <i class="material-icons text-red-500">architecture</i>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>