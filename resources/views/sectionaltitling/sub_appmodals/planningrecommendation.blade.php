<div class="modal fade" id="printModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Planning Recommendation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="printContent">
                    <div class="flex justify-between items-center mb-4 relative z-10">
                        <img src="{{ asset('assets/logo/logo1.jpg') }}" alt="Kano State Coat of Arms" class="w-16 h-16 object-contain">
                        <div class="text-center mt-20">
                            <h1 class="text-lg font-bold">KANO STATE MINISTRY OF LAND AND PHYSICAL PLANNING</h1>
                            <h3 class="text-sm font-semibold mt-1"><strong>PERMANENT SECRETARY</strong></h3>
                        </div>
                        <img src="{{ asset('assets/logo/logo3.jpeg') }}" alt="KANGIS Logo" class="w-16 h-16 object-contain">
                    </div>
            
                    <div class="print-section">
                        <p>Kindly find Page 01 in an application for sectional titling in respect of a
                            property (plaza) covered by Certificate of Occupancy No. <span id="printModalFileNo"></span> situated
                            at <span id="printModalLocation"></span> in the name of <strong id="printModalOwnerName"></strong></p>
                        <p>As well as change of name to various shop owners as per attached on the
                            application.</p>
                        <p>The application was referred to Physical Planning Department for planning,
                            engineering as well as architectural views. Subsequently, the planners at page
                            01 recommended the application, because the application is feasible, and the
                            shops meet the minimum requirements for commercial titles. Moreover, the
                            proposals as submitted and conforms with the existing commercial development in
                            the area.</p>
                        <p>However, the recommendation is based on the recommended site plan at page 01 and
                            architectural design at page 01 and back cover with the following measurements:
                        </p>
                        <p>Meanwhile, the title was granted for commercial purposes for a term of 40 years
                            commencing from 01/01/2025 and has a residual term of 20 to expire.</p>
                        <p>In view of the above, you may kindly wish to recommend the following for approval
                            of the Honorable Commissioner:</p>
                        <ol>
                            <li>Consider and approve the application for Sectional Titling over plot 01
                                situated at <span id="printModalLocationRepeat"></span> covered by Certificate of Occupancy No.
                                <span id="printModalFileNoRepeat"></span> in favor of <strong id="printModalOwnerNameRepeat"></strong></li>
                            <li>Consider and approve the change of name of various shop owners as per
                                provisions of the Bill.</li>
                            <li>Consider and approve the Revocation of old Certificate of Occupancy
                                <span id="printModalFileNoRepeat2"></span> to pave the way for new Sectional Titles to the new owners.
                            </li>
                        </ol>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px;">
                            <div>
                                <p>Name:___________________________</p>
                                <p>Rank: ___________________________</p>
                                <p>Sign: ___________________________</p>
                                <p>Date: ___________________________</p>
                            </div>
                            <div>
                                <p>Counter Sign: ___________________________</p>
                                <p style="white-space: pre-line;"><strong>Director Section Titling</strong></p>
                                <p>Date: ___________________________</p>
                            </div>
                        </div>
                        <div style="margin-top: 20px;">
                            <p><strong>HONOURABLE COMMISSIONER</strong></p>
                            <hr style="width: 100%; text-align: left; margin-left: 0;">
                            <p>The application is hereby recommended for your kind approval, please.</p>
                            <br>
                            <p>Date: ______2025.</p>
                        </div>
                        <div style="justify-content: end;">
                            <div style="text-align: right;">
                                <p>___________________________</p>
                                <p><strong>Permanent Secretary</strong></p>
                            </div>
                        </div>

                        <div style="margin-top: 20px;">
                            <p><strong>PERMANENT SECRETARY</strong></p>
                            <hr style="width: 100%; text-align: left; margin-left: 0;">
                            <p>The application is hereby APPROVED/NOT APPROVED.</p>
                            <p>Date: __________________2025.</p>
                            <div style="text-align: right;">
                                <p>___________________________</p>
                                <p><strong>HONOURABLE COMMISSIONER.</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal"
                    style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                    Close
                    <i class="material-icons" style="color: #9E9E9E;">close</i>
                </button>
                <button type="button" class="bttn blue-shadow" onclick="printContent()"
                    style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                    Print Bill
                    <i class="material-icons" style="color: #3F51B5;">print</i>
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="architecturalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Architectural Design Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="architecturalForm">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Submit architectural design?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="submit_design"
                                    id="submit_yes" value="yes" required>
                                <label class="form-check-label" for="submit_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="submit_design"
                                    id="submit_no" value="no">
                                <label class="form-check-label" for="submit_no">No</label>
                            </div>
                        </div>

                        <div id="designFields" style="display: none;">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Drawn By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Approved By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="background-color: #f1f1f1;">
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                                <button type="button" class="bttn green-shadow"
                                    onclick="showDepartmentConfirmation('ok')"
                                    style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                    OK
                                    <i class="material-icons" style="color: #4CAF50; font-size: 16px;">check_circle</i>
                                </button>
                                <button type="button" class="bttn gray-shadow"
                                    onclick="showDepartmentConfirmation('edit')"
                                    style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                    Edit
                                    <i class="material-icons" style="color: #9E9E9E; font-size: 16px;">edit</i>
                                </button>
                                <button type="submit" class="bttn green-shadow"
                                    style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                    Submit
                                    <i class="material-icons" style="color: #eeeeee; font-size: 16px;">send</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="planningRecommendationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Planning Recommendation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="planningRecommendationForm">
                    <div class="mb-3">
                        <label class="form-label">Decision</label><br>
                        <input type="radio" name="decision" value="approve" id="prApprove" checked>
                        <label for="prApprove">Approve</label>
                        <input type="radio" name="decision" value="decline" id="prDecline"
                            class="ms-3">
                        <label for="prDecline">Decline</label>
                    </div>
                    <div class="mb-3" id="declineReasonGroup" style="display:none;">
                        <label for="declineReason" class="form-label">Reason For Decline</label>
                        <textarea class="form-control" id="declineReason" name="comments"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="approvalDate" class="form-label">Approval/Decline Date</label>
                            <input type="datetime-local" class="form-control" id="approvalDate"
                                name="approval_date" required>
                        </div>
                        <div>
                            <label class="form-label">....</label>
                            <select class="form-select" required
                                onchange="handleSelectChange(this.value)">
                                <option value="" disabled selected>Select</option>
                                <option value="architectural">Architectural Design</option>
                                <option value="planningRec">Planning Recommendation</option>
                            </select>
                        </div>
                        <!-- Empty cells to complete a 2x2 grid -->
                        <div></div>
                        <div></div>
                    </div>

                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;"
                                data-bs-dismiss="modal">
                                Cancel
                                <i class="material-icons" style="color: #f44336; font-size: 16px;">cancel</i>
                            </button>
                            <button type="button" class="bttn gray-shadow"
                                onclick="showDepartmentConfirmation('edit')"
                                style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                Submit
                                <i class="material-icons" style="color: #9E9E9E; font-size: 16px;">edit</i>
                            </button>
                            <button type="button" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;"
                                onclick="showPrintModal()">
                                Print
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">print</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>