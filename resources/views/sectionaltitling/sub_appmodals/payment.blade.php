<!-- Add jQuery CDN if not already loaded -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="modal fade" id="actionsModal" tabindex="-1" aria-labelledby="actionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:210px;">
        <div class="modal-content">
            <div class="modal-header" style="height: 30px;">
                <h5 class="modal-title" id="actionsModalLabel">
                    Payments <span id="payment-app-id" class="badge bg-secondary"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #f1f1f1;">
                <input type="hidden" id="current-app-id" value="">
                <div>
                    <div class="payments-grid">
                        <!-- Row 1 -->
                        <button class="bttn purple-shadow" data-bs-toggle="modal" data-bs-target="#financeModal"
                            onclick="loadBillingData(document.getElementById('current-app-id').value)">
                            Initial Bill
                            <i class="material-icons" style="color: #4CAF50;">account_balance</i>
                        </button>

                        <button class="bttn pink-shadow" id="bettermentFeeBtn"
                            onclick="showDepartmentConfirmation('generateBettermentBill')">
                            GEN BETTERMENT FEE
                            <i class="material-icons" style="color: #E91E63;">receipt_long</i>
                        </button>

                        <button class="bttn blue-shadow" data-bs-toggle="modal" data-bs-target="#generateBillModal">
                            Generate Final Bill
                            <i class="material-icons" style="color: #3F51B5;">receipt</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openPaymentsModal(applicationId) {
        // Store the application ID in hidden field
        document.getElementById('current-app-id').value = applicationId;

        // Correct fetch URL using the defined route "/subapplications"
        fetch("{{ url('generate_bill2') }}/" + applicationId)
            .then(response => {
                if (!response.ok) { throw new Error('Network response was not ok'); }
                return response.json();
            })
            .then(data => {
                // Display application ID in the modal title
                document.getElementById('payment-app-id').textContent = 'ID: ' + data.id;
                document.getElementById('bettermentFeeBtn').setAttribute('data-id', data.id);
            })
            .catch(error => console.error('Error fetching application data:', error));
    }
</script>
