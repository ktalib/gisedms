<div class="modal fade" id="generateBettermentBillModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Betterment Fee Bill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="bettermentPdfViewer" style="width:100%; height:600px;"></div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.min.js"></script>
                <script>
                    PDFObject.embed("{{ asset('storage/uploads/betterment_bill.pdf') }}", "#bettermentPdfViewer", {
                        pdfOpenParams: {
                            zoom: "80" // Set default zoom to 80%
                        }
                    });
                </script>
            </div>

            <div class="modal-footer"
                style="background-color: #f1f1f1; display: flex; justify-content: center;">
                <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal"
                    style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                    Close
                    <i class="material-icons" style="color: #9E9E9E;">close</i>
                </button>
                <button type="button" class="bttn blue-shadow" onclick="printBettermentBill()"
                    style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                    Print Betterment Bill
                    <i class="material-icons" style="color: #3F51B5;">print</i>
                </button>
            </div>


        </div>
    </div>
</div>
