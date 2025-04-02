<div class="modal fade" id="generateBillModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Final Bill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="billContent">
                    <iframe id="billFrame" style="width: 100%; height: 600px;"></iframe>
                </div>
            </div>
            <div class="modal-footer"
                style="background-color: #f1f1f1; display: flex; justify-content: center;">
                <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal"
                    style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                    Close
                    <i class="material-icons" style="color: #9E9E9E;">close</i>
                </button>
                <button type="button" class="bttn blue-shadow" onclick="printBill()"
                    style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                    Print Bill
                    <i class="material-icons" style="color: #3F51B5;">print</i>
                </button>
            </div>
        </div>
    </div>
</div>