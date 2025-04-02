<div class="modal fade" id="decisionModalMother" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="decisionFormMother">
                <div class="modal-header">
                    <h5 class="modal-title">Director's Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="decisionMotherId">
                    <div class="mb-3">
                        <label class="form-label">Decision</label><br>
                        <input type="radio" name="decision" value="approve" id="dmmApprove" checked>
                        <label for="dmmApprove">Approve</label>
                        <input type="radio" name="decision" value="decline" id="dmmDecline" class="ms-3">
                        <label for="dmmDecline">Decline</label>
                        <input type="radio" name="decision" value="Pedding" id="dmmDecline" class="ms-3">
                        <label for="dmmDecline">Pedding</label>
                    </div>
                    <div class="mb-3" id="declineReasonMotherGroup" style="display:none;">
                        <label for="declineReasonMother" class="form-label">Reason For Decline</label>
                        <textarea class="form-control" id="declineReasonMother" name="comments"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="approvalDateMother" class="form-label">Approval Date</label>
                        <input type="datetime-local" class="form-control" id="approvalDateMother"
                            name="approval_date" required>
                    </div>

                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px;"
                                data-bs-dismiss="modal">
                                Cancel
                                <i class="material-icons" style="color: #d80000; font-size: 16px;">cancel</i>
                            </button>
                            <div></div>
                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px;">
                                Submit
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>