<div class="modal fade" id="financeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Initial Bill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="financeForm">
                    <input type="hidden" id="application_id" name="application_id">
                    @csrf
                    <!-- Receipt Details Section -->
                    <div class="row mb-4">
                        <h6>Receipt Details</h6>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Receipt No</label>
                                <input type="text" class="form-control" name="receipt_number" id="receipt_number" disabled>
                            </div>
                            <div>
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" name="payment_date" id="payment_date" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Fees Section -->
                    <div class="row mb-4">
                        <h6>Fees</h6>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Application Fee (₦)</label>
                                <input type="number" class="form-control" name="application_fee" id="application_fee" disabled>
                            </div>
                            <div>
                                <label class="form-label">Processing Fee (₦)</label>
                                <input type="number" class="form-control" name="processing_fee" id="processing_fee" disabled>
                            </div>
                            <div>
                                <label class="form-label">Site Plan Fee (₦)</label>
                                <input type="number" class="form-control" name="site_plan_fee" id="site_plan_fee" disabled>
                            </div>
                            <div>
                                <label class="form-label">Total Amount (₦)</label>
                                <input type="number" class="form-control" id="totalAmount" readonly disabled>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: 1fr auto; gap: 8px; width: 100%;">
                            <button type="button" class="bttn green-shadow" data-bs-dismiss="modal" aria-label="Close"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 8px 12px; width: 150px; height: 40px;">
                                Close
                                <i class="material-icons" style="color: #c70707; font-size: 16px;">cancel</i>
                            </button>
                            <button type="button" class="bttn green-shadow" onclick="printReceipt()"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 8px 12px; width: 150px; height: 40px;">
                                Print Receipt
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">print</i>
                            </button>
                        </div>
                    </div>
                </form>

                <script>
                    function calculateTotal() {
                        const applicationAmount = parseFloat(document.getElementById('application_fee').value) || 0;
                        const processingAmount = parseFloat(document.getElementById('processing_fee').value) || 0;
                        const sitePlanAmount = parseFloat(document.getElementById('site_plan_fee').value) || 0;
                        
                        const total = applicationAmount + processingAmount + sitePlanAmount;
                        document.getElementById('totalAmount').value = total.toFixed(2);
                    }

                    function printReceipt() {
                        const receiptContent = `
                            <div style="width: 80mm; padding: 10mm; font-family: Arial; margin: 0 auto;">
                                <div style="text-align: center; margin-bottom: 10mm; position: relative;">
                                    <!-- Left Logo -->
                                    <img src="{{ asset('assets/images/kanologo.png') }}" 
                                         style="position: absolute; left: 10px; top: 10px; width: 50px; height: auto;">
                                    
                                    <!-- Right Logo -->
                                    <img src="{{ asset('assets/images/blm.png') }}" 
                                         style="position: absolute; right: 10px; top: 10px; width: 50px; height: auto;">
                                    
                                    <h2 style="margin: 0; padding-top: 60px;">KANO STATE GOVERNMENT</h2>
                                    <h3 style="margin: 5px 0;">Bureau for Land Management</h3>
                                    <h4 style="margin: 5px 0;">OFFICIAL RECEIPT</h4>
                                </div>

                                <div style="margin-bottom: 5mm;">
                                    <p style="margin: 2px 0;"><b>Receipt No:</b> ${document.getElementById('receipt_number').value}</p>
                                    <p style="margin: 2px 0;"><b>Date:</b> ${document.getElementById('payment_date').value}</p>
                                </div>

                                <div style="border-top: 1px dashed #000; border-bottom: 1px dashed #000; padding: 5mm 0; margin-bottom: 5mm;">
                                    <p style="margin: 2px 0;"><b>Application Fee:</b> ₦${document.getElementById('application_fee').value}</p>
                                    <p style="margin: 2px 0;"><b>Processing Fee:</b> ₦${document.getElementById('processing_fee').value}</p>
                                    <p style="margin: 2px 0;"><b>Site Plan Fee:</b> ₦${document.getElementById('site_plan_fee').value}</p>
                                </div>

                                <div style="text-align: right; margin-bottom: 5mm;">
                                    <h3 style="margin: 0;">Total: ₦${document.getElementById('totalAmount').value}</h3>
                                </div>

                                <div style="text-align: center; font-size: 12px;">
                                    <p style="margin: 2px 0;">Thank you for your payment</p>
                                    <p style="margin: 2px 0;">This is an official receipt</p>
                                </div>
                            </div>
                        `;

                        const originalContent = document.body.innerHTML;
                        document.body.innerHTML = receiptContent;
                        window.print();
                        document.body.innerHTML = originalContent;
                        window.location.reload(); // Reload the page to restore event listeners
                    }

                    function loadBillingData(applicationId) {
                        console.log('Loading billing data for application ID:', applicationId);
                        if (!applicationId) {
                            console.error('No application ID provided!');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No application ID selected. Please try again.'
                            });
                            return;
                        }
                        
                        document.getElementById('application_id').value = applicationId;
                        
                        // Show loading state
                        const inputs = document.querySelectorAll('#financeForm input:not([type="hidden"]):not([name="_token"])');
                        inputs.forEach(input => {
                            input.value = 'Loading...';
                            if (input.type === 'number') input.value = '';
                        });
                        
                        fetch(`{{ url('/') }}/sectionaltitling/get-billing-data2/${applicationId}`)
                            .then(response => {
                                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                                return response.json();
                            })
                            .then(data => {
                                console.log('Received billing data:', data);
                                document.getElementById('receipt_number').value = data.receipt_number || '';
                                document.getElementById('payment_date').value = data.payment_date ? new Date(data.payment_date).toISOString().split('T')[0] : '';
                                document.getElementById('application_fee').value = data.application_fee || '';
                                document.getElementById('processing_fee').value = data.processing_fee || '';
                                document.getElementById('site_plan_fee').value = data.site_plan_fee || '';
                                calculateTotal();
                            })
                            .catch(error => {
                                console.error('Error fetching billing data:', error);
                                // Clear loading state
                                inputs.forEach(input => {
                                    input.value = '';
                                });
                                
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: `Failed to load billing data. Error: ${error.message}`
                                });
                            });
                    }
                </script>
            </div>
        </div>
    </div>
</div>
