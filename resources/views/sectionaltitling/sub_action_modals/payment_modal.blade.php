<style>
   /* Modal styles */
   .modal-content {
     background-color: white;
     border-radius: 0.5rem;
     box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
     width: 100%;
     max-width: 600px;
     max-height: 90vh;
     overflow-y: auto;
     position: relative;
   }
   .tab-content {
     display: none;
   }
   .tab-content.active {
     display: block;
   }
   .tab-button {
     position: relative;
     display: inline-flex;
     align-items: center;
     justify-content: center;
     font-size: 0.75rem;
     padding: 0.5rem 1rem;
     border-radius: 0.25rem;
     cursor: pointer;
     transition: background-color 0.2s;
   }
   .tab-button.active {
     background-color: #f3f4f6;
     font-weight: 500;
   }
   .tab-button:hover:not(.active) {
     background-color: #f9fafb;
   }
 </style>

 {{-- @php
    <input type="text"id="application_id_display">
 @endphp --}}




<div id="paymentModal" class="fixed inset-0 z-50 hidden overflow-y-auto ">
   <div class="flex items-center justify-center min-h-screen p-4 ">
      <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" id="paymentModalBackdrop"></div>
      
      <div class="relative bg-white rounded-lg max-w-4xl w-full mx-auto shadow-xl">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b">
          <h3 class="text-lg font-semibold">Payment Management</h3>
          <button type="button" class="text-gray-400 hover:text-gray-500" id="closePaymentBtn">
            <span class="sr-only">Close</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        
        <!-- Body -->
        <div class="p-4">
         <div class="">
            
            
            <div class="py-2">
             <div class="flex items-center justify-between mb-4">
               <div>
                <h3 class="text-sm font-medium">Residential Property</h3>
                <p class="text-xs text-gray-500">
                  Application ID: <span id="display_application_id">APP-2023-001</span> | File No: <span id="display_file_no">KN0001</span>
                </p>
               </div>
               <div class="text-right">
                <h3 class="text-sm font-medium">Mr. Clement Joseph</h3>
                <p class="text-xs text-gray-500">Residential</p>
               </div>
             </div>
     
             <!-- Tabs Navigation -->
             <div class="grid grid-cols-3 gap-2 mb-4">
               <button class="tab-button active" data-tab="initial">
                <i data-lucide="banknote" class="w-3.5 h-3.5 mr-1.5"></i>
                INITIAL BILL
               </button>
               <button class="tab-button" data-tab="betterment">
                <i data-lucide="calculator" class="w-3.5 h-3.5 mr-1.5"></i>
                GENERATE BETTERMENT BILL
               </button>
               <button class="tab-button" data-tab="final">
                <i data-lucide="file-check" class="w-3.5 h-3.5 mr-1.5"></i>
                GENERATE FINAL BILL
               </button>
             </div>
         
             <!-- Initial Bill Tab -->
             <div id="initial-tab" class="tab-content active">
               <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="p-4 border-b">
                  <h3 class="text-sm font-medium">Initial Application Fee</h3>
                  <p class="text-xs text-gray-500">Generate and manage initial application payment</p>
                </div>
                <div class="p-4 space-y-4">
                  <div class="grid grid-cols-2 gap-4">
                   <div class="space-y-2">
                     
                     <label for="application-fee" class="text-xs font-medium block">
                      Application Fee (₦)
                     </label>
                     <input id="application-fee" type="text" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                   </div>
                   <div class="space-y-2">
                     <label for="processing-fee" class="text-xs font-medium block">
                      Processing Fee (₦)
                     </label>
                     <input id="processing-fee" type="text" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                   </div>
                  </div>
         
               
                  <div class="grid grid-cols-2 gap-4">
                   <div class="space-y-2">
                     <label for="site-plan-fee" class="text-xs font-medium block">
                      Survey Fee (₦)
                     </label>
                     <input id="site-plan-fee" type="text" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                   </div>
                   <div class="space-y-2">
                     <label for="payment-date" class="text-xs font-medium block">
                      Payment Date
                     </label>
                     <input id="payment-date" type="text" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                   </div>
                  </div>
         
                  <div class="grid grid-cols-2 gap-4">
                   <div class="space-y-2">
                     <label for="receipt-number" class="text-xs font-medium block">
                      Receipt Number
                     </label>
                     <input id="receipt-number" type="text" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                   </div>
                
                  </div>
         
                  <hr class="my-4">
         
                  <div class="flex justify-between items-center">
                   <div>
                     <p class="text-xs text-gray-500">Total Amount</p>
                     <p class="text-lg font-bold" id="total-amount">₦0.00</p>
                   </div>
                   <div class="flex gap-2">
                     <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                      <i data-lucide="printer" class="w-3.5 h-3.5 mr-1.5"></i>
                      Print
                     </button>
                     <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                      <i data-lucide="download" class="w-3.5 h-3.5 mr-1.5"></i>
                      Download
                     </button>
                     <button class="flex items-center px-3 py-1 text-xs bg-black text-white rounded-md hover:bg-gray-800">
                      <i data-lucide="credit-card" class="w-3.5 h-3.5 mr-1.5"></i>
                      Pay Now
                     </button>
                   </div>
                  </div>
         
                  <div class="bg-gray-100 p-3 rounded-md">
                   <h4 class="text-xs font-medium mb-1">Payment Status</h4>
                   <div class="flex items-center gap-2">
                     <div class="h-2 w-2 rounded-full bg-amber-500"></div>
                     <p class="text-xs">Pending Payment</p>
                   </div>
                   <p class="text-xs text-gray-500 mt-1">
                     Initial payment must be completed before application processing can begin.
                   </p>
                  </div>
                </div>
               </div>
             </div>
         
             <!-- betterment Bill Tab -->
             <div id="betterment-tab" class="tab-content">
               <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="p-4 border-b">
                  <h3 class="text-sm font-medium">betterment Bill</h3>
                  <p class="text-xs text-gray-500">Generate betterment charges based on property assessment</p>
                </div>
                <div class="p-4 space-y-4">
                  <div class="grid grid-cols-2 gap-4">
                   <div class="space-y-2">
                     <label for="property-value" class="text-xs font-medium block">
                      Property Value (₦)
                     </label>
                     <input id="property-value" type="text" placeholder="Enter property value" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                   </div>
                   <div class="space-y-2">
                     <label for="land-size" class="text-xs font-medium block">
                      Land Size (sqm)
                     </label>
                     <input id="land-size" type="text" value="1,200" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                   </div>
                  </div>
         
                  <div class="grid grid-cols-2 gap-4">
                   <div class="space-y-2">
                     <label for="betterment-rate" class="text-xs font-medium block">
                      betterment Rate (%)
                     </label>
                     <input id="betterment-rate" type="text" value="2.5" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                   </div>
                   <div class="space-y-2">
                     <label for="units-count" class="text-xs font-medium block">
                      Number of Units
                     </label>
                     <input id="units-count" type="text" value="12" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                   </div>
                  </div>
         
                  <div class="bg-gray-100 p-3 rounded-md">
                   <h4 class="text-xs font-medium mb-1">Calculation Preview</h4>
                   <p class="text-xs text-gray-500">
                     betterment Fee = Property Value × betterment Rate × Land Size Factor
                   </p>
                  </div>
         
                  <hr class="my-4">
         
                  <div class="flex justify-between items-center">
                   <div>
                     <p class="text-xs text-gray-500">Estimated Amount</p>
                     <p class="text-lg font-bold">₦0.00</p>
                   </div>
                   <div class="flex gap-2">
                     <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                      <i data-lucide="calculator" class="w-3.5 h-3.5 mr-1.5"></i>
                      Calculate
                     </button>
                     <button class="flex items-center px-3 py-1 text-xs bg-black text-
                             <i data-lucide="receipt" class="w-3.5 h-3.5 mr-1.5"></i>
                             Generate Bill
                           </button>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
           
                 <!-- Final Bill Tab -->
                 <div id="final-tab" class="tab-content">
                  <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                    <div class="p-4">
                      <!-- Header with two logos and title -->
                      <div class="flex items-center justify-between mb-2">
                        <div class="w-12 h-12">
                          <img src="{{ asset('assets/logo/logo1.jpg') }}" alt="Kano State Logo" class="w-full h-full object-contain">
                        </div>
                        <div class="text-center">
                          <h3 class="text-sm font-bold text-green-800">KANO STATE MINISTRY OF LAND AND PHYSICAL PLANNING</h3>
                          <p class="text-xs font-medium text-red-600">SECTIONAL TITLE FINAL BILL</p>
                        </div>
                        <div class="w-12 h-12">
                          <img src="{{ asset('assets/logo/logo3.jpeg') }}" alt="Ministry Logo" class="w-full h-full object-contain">
                        </div>
                      </div>
                      
                      <!-- Date -->
                      <div class="text-right text-xs mb-4">
                        <p>Wednesday, April 16, 2025</p>
                      </div>
                      
                      <!-- Introduction -->
                      <div class="mb-4">
                        <p class="text-xs mb-2">Dear Sir/Madam,</p>
                        <p class="text-xs">
                          I am directed to inform you that the total cost of processing of your application for sectional 
                          title located at <span class="font-medium">Street plot/property address</span> with the following particulars.
                        </p>
                      </div>
                      
                      <!-- Property Details -->
                      <div class="mb-4">
                        <div class="grid grid-cols-2 gap-2 text-xs">
                          <div>
                            <p><span class="font-medium">Owner/Lessee:</span> Mr. Clement Joseph</p>
                            <p><span class="font-medium">Block/Application No:</span> APP-2023-001</p>
                            <p><span class="font-medium">Plot No./Section/Outline:</span> KN0001</p>
                            <p><span class="font-medium">Plan No:</span> PL-2023-001</p>
                          </div>
                          <div>
                            <p><span class="font-medium">Location:</span> Kano</p>
                            <p><span class="font-medium">Approval Date:</span> 15/04/2025</p>
                            <p><span class="font-medium">Land Use:</span> Residential</p>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Fee Table -->
                      <div class="mb-4">
                        <table class="bill-table">
                          <thead>
                            <tr>
                              <th>S/N</th>
                              <th>Survey / Processing Fees</th>
                              <th>Dev. Charges ₦</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Administrative Fees</td>
                              <td>₦ 20,000.00</td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Survey Fees</td>
                              <td>₦ 50,000.00</td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Dev. Charges</td>
                              <td>₦ 100,000.00</td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>Appraisal</td>
                              <td>₦ 30,000.00</td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>GIS Retrieval Fees</td>
                              <td>₦ 15,000.00</td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td>Certificate Fees</td>
                              <td>₦ 25,000.00</td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td>Processing Fees</td>
                              <td>₦ 100,000.00</td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td>Penalty Fees</td>
                              <td>₦ 0.00</td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td>Registration Fees</td>
                              <td>₦ 15,000.00</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      
                      <!-- Ground Rent -->
                      <div class="mb-4">
                        <table class="bill-table">
                          <tr>
                            <td>One year Ground Rent</td>
                            <td>₦ _____________</td>
                            <td>₦ _____________</td>
                          </tr>
                        </table>
                      </div>
                      
                      <!-- Total -->
                      <div class="mb-4">
                        <div class="flex justify-between items-center">
                          <p class="text-sm font-bold">TOTAL:</p>
                          <p class="text-sm font-bold">₦ 355,000.00</p>
                        </div>
                        <hr class="my-2 border-t border-gray-300">
                      </div>
                      
                      <!-- Footer Text -->
                      <div class="text-xs space-y-2 mb-4">
                        <p>
                          You are hereby directed to settle this bill promptly in order to accelerate the processing of your 
                          application.
                        </p>
                        <p>
                          <span class="font-medium">Note:</span> Documentary Payments can be made at the Checkout-Point and KANGIS 
                          Cashier's Office.
                        </p>
                        <p>
                          <span class="font-medium">Note:</span> Ensure that you obtain a duly acknowledged Revenue Receipt issued at the KANGIS 
                          Office.
                        </p>
                        <p>Thank you.</p>
                      </div>
                      
                      <!-- Action Buttons -->
                      <div class="flex justify-between items-center mt-6">
                        <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                          <i data-lucide="printer" class="w-3.5 h-3.5 mr-1.5"></i>
                          Print Bill
                        </button>
                        <button class="flex items-center px-3 py-1 text-xs bg-black text-white rounded-md hover:bg-gray-800">
                          <i data-lucide="credit-card" class="w-3.5 h-3.5 mr-1.5"></i>
                          Pay Now
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                

               </div>
             </div>
          </div>
          
          <!-- Footer -->
          <div class="flex justify-end p-4 border-t">
             <button type="button" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300" id="closePaymentBtnFooter">Close</button>
             <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700" id="processPayment">Process Payment</button>
          </div>
       </div>
    </div>
 </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Payment modal elements ---
        const paymentBtns = document.querySelectorAll('.payment-btn');
        const paymentModal = document.getElementById('paymentModal');
        const closePaymentBtn = document.getElementById('closePaymentBtn');
        const closePaymentBtnFooter = document.getElementById('closePaymentBtnFooter');
        const paymentModalBackdrop = document.getElementById('paymentModalBackdrop');
        const totalAmountElement = document.getElementById('total-amount');
        const applicationFeeInput = document.getElementById('application-fee');
        const processingFeeInput = document.getElementById('processing-fee');
        const sitePlanFeeInput = document.getElementById('site-plan-fee');
        const paymentApplicationIdInput = document.getElementById('payment_application_id');
        const applicationIdDisplayInput = document.getElementById('application_id_display');
        const paymentDateInput = document.getElementById('payment-date');
        const receiptNumberInput = document.getElementById('receipt-number');
        const filenoInput = document.getElementById('fileno');
        const displayApplicationId = document.getElementById('display_application_id');
        const displayFileNo = document.getElementById('display_file_no');

        // --- Tab elements ---
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        // --- Function to calculate and update total amount ---
        function calculateTotal() {
            // Ensure elements exist before accessing value
            const applicationFee = parseFloat(applicationFeeInput?.value.replace(/[^\d.-]/g, '') || 0);
            const processingFee = parseFloat(processingFeeInput?.value.replace(/[^\d.-]/g, '') || 0);
            const sitePlanFee = parseFloat(sitePlanFeeInput?.value.replace(/[^\d.-]/g, '') || 0);

            const total = applicationFee + processingFee + sitePlanFee;

            // Format the total as Nigerian Naira
            const formattedTotal = new Intl.NumberFormat('en-NG', {
                style: 'currency',
                currency: 'NGN',
                minimumFractionDigits: 2
            }).format(total); // Intl includes currency symbol by default for 'currency' style

            if (totalAmountElement) {
                totalAmountElement.textContent = formattedTotal;
            } else {
                console.error("Element with ID 'total-amount' not found.");
            }
        }

        // --- Payment modal functionality ---
        paymentBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                if (!id) {
                    console.error("Payment button clicked but data-id attribute is missing or empty.");
                    return;
                }
                if (paymentApplicationIdInput) paymentApplicationIdInput.value = id;
                if (applicationIdDisplayInput) applicationIdDisplayInput.value = id;
                if (displayApplicationId) displayApplicationId.textContent = id;

                // Fetch application data and display in modal
                // Consider using relative URL if backend is on the same domain
                fetch(`/gisedms/sub-application/${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data) {
                            console.error("Received empty data from fetch.");
                            if (totalAmountElement) totalAmountElement.textContent = 'Error: No data';
                            return;
                        }
                        // Safely update input values
                        if (applicationFeeInput) applicationFeeInput.value = data.application_fee ?? '';
                        if (processingFeeInput) processingFeeInput.value = data.processing_fee ?? '';
                        if (sitePlanFeeInput) sitePlanFeeInput.value = data.site_plan_fee ?? '';
                        if (paymentDateInput) paymentDateInput.value = data.payment_date ?? '';
                        if (receiptNumberInput) receiptNumberInput.value = data.receipt_number ?? '';
                        if (displayFileNo) displayFileNo.textContent = data.fileno ?? ''; 

                        // Removed line causing error as 'applicant_type' ID was not found in HTML:
                        // document.getElementById('applicant_type').textContent = data.applicant_type;

                        // Calculate and update total after setting fee values
                        calculateTotal();

                        // Show the modal only after data is successfully fetched and populated
                        if (paymentModal) {
                            paymentModal.classList.remove('hidden');
                        } else {
                            console.error("Element with ID 'paymentModal' not found.");
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching application data:', error);
                        if (totalAmountElement) {
                             totalAmountElement.textContent = 'Error loading data';
                        }
                        // Optionally show a user-friendly error message in the modal
                    });
            });
        });

        // --- Function to close payment modal ---
        function closePaymentModal() {
            if (paymentModal) {
                paymentModal.classList.add('hidden');
            }
        }

        // --- Attach close listeners ---
        if (closePaymentBtn) closePaymentBtn.addEventListener('click', closePaymentModal);
        if (closePaymentBtnFooter) closePaymentBtnFooter.addEventListener('click', closePaymentModal);
        if (paymentModalBackdrop) paymentModalBackdrop.addEventListener('click', closePaymentModal);

        // --- Tab switching functionality ---
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                if (!tabId) return;

                // Deactivate all tabs
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => {
                    if (content) content.classList.remove('active');
                });

                // Activate selected tab
                this.classList.add('active');
                const activeTabContent = document.getElementById(`${tabId}-tab`);
                if (activeTabContent) {
                    activeTabContent.classList.add('active');
                } else {
                    console.error(`Tab content with ID '${tabId}-tab' not found.`);
                }
            });
        });

        // Removed potentially problematic/unused 'closeModal' listener from original second block
        // const closeModalButton = document.getElementById('closeModal');
        // if (closeModalButton) { ... }

    });
   </script>