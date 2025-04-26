@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING  MODULE') }}
@endsection


@include('sectionaltitling.partials.assets.css')
@section('content')
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        @include('admin.header')
        <!-- Dashboard Content -->
        <div class="p-6">
            <!-- Stats Cards -->



            <!-- Tabs -->
            @include('sectionaltitling.partials.tabs')
           
            <!-- Secondary Applications Table - Screenshot 135 -->
            <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
              


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
                 
                 
                 
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js" integrity="sha512-w3u9q/DeneCSwUDjhiMNibTRh/1i/gScBVp2imNVAMCt6cUHIw6xzhzcPFIaL3Q1EbI2l+nu17q2aLJJLo4ZYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

                  <script src="https://cdn.jsdelivr.net/npm/jspdf@3.0.1/dist/jspdf.es.min.js"></script>
                 <div    >
                    <div class="flex items-center justify-center min-h-screen p-4 ">
                        
                       
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
                                 <h3 class="text-sm font-medium">{{$application->land_use}} Property</h3>
                                 <p class="text-xs text-gray-500">
                                   Application ID: <span id="display_application_id">ST-2025-0{{$application->id}}</span> | File No: <span id="display_file_no">{{$application->fileno}}</span>
                                 </p>
                                </div>
                                <div class="text-right">
                                 <h3 class="text-sm font-medium">{{ $application->applicant_title}} {{ $application->surname}} {{ $application->first_name}}</h3>
                                 <p class="text-xs text-gray-500">{{  $application->land_use}}</p>
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
                                        <input id="application-fee" type="text" value="{{ $application->application_fee ?? '0.00' }}" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                                      </div>
                                      <div class="space-y-2">
                                        <label for="processing-fee" class="text-xs font-medium block">
                                          Processing Fee (₦)
                                        </label>
                                        <input id="processing-fee" type="text" value="{{ $application->processing_fee ?? '0.00' }}" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                                      </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                      <div class="space-y-2">
                                        <label for="site-plan-fee" class="text-xs font-medium block">
                                          Survey Fee (₦)
                                        </label>
                                        <input id="site-plan-fee" type="text" value="{{ $application->site_plan_fee ?? '0.00' }}" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                                      </div>
                                      <div class="space-y-2">
                                        <label for="payment-date" class="text-xs font-medium block">
                                          Payment Date
                                        </label>
                                        <input id="payment-date" type="text" value="{{ $application->payment_date ?? 'Not paid yet' }}" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                                      </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                      <div class="space-y-2">
                                        <label for="receipt-number" class="text-xs font-medium block">
                                          Receipt Number
                                        </label>
                                        <input id="receipt-number" type="text" value="{{ $application->receipt_number ?? 'N/A' }}" class="w-full p-2 border border-gray-300 rounded-md text-sm" readonly>
                                      </div>
                                    </div>
                                    
                                    <hr class="my-4">
                                    
                                    @php
                                      $application_fee = $application->application_fee ?? 0;
                                      $processing_fee = $application->processing_fee ?? 0;
                                      $site_plan_fee = $application->site_plan_fee ?? 0;
                                      $total_amount = $application_fee + $processing_fee + $site_plan_fee;
                                    @endphp
                                    
                                    <div class="flex justify-between items-center">
                                      <div>
                                        <p class="text-xs text-gray-500">Total Amount</p>
                                        <p class="text-lg font-bold" id="total-amount">₦{{ number_format($total_amount, 2) }}</p>
                                      </div>
                                      <div class="flex gap-2">
                                        <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50" onclick="printPaymentSlip()">
                                          <i data-lucide="printer" class="w-3.5 h-3.5 mr-1.5"></i>
                                          Print
                                        </button>
                                        <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50" onclick="downloadPaymentSlip()">
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
                                        @if($application->payment_date)
                                          <div class="h-2 w-2 rounded-full bg-green-500"></div>
                                          <p class="text-xs">Payment Completed</p>
                                        @else
                                          <div class="h-2 w-2 rounded-full bg-amber-500"></div>
                                          <p class="text-xs">Pending Payment</p>
                                        @endif
                                      </div>
                                      <p class="text-xs text-gray-500 mt-1">
                                        @if($application->payment_date)
                                          Payment was completed on {{ $application->payment_date }}.
                                        @else
                                          Initial payment must be completed before application processing can begin.
                                        @endif
                                      </p>
                                    </div>
                                    
                                    <!-- Hidden Payment Slip for printing/downloading -->
                                    <div id="payment-slip" class="hidden">
                                      <div class="payment-slip-content p-6 bg-white border border-gray-300 rounded-lg">
                                        <!-- Header with logos -->
                                        <div class="flex items-center justify-between mb-4">
                                          <div class="w-20 h-20">
                                            <img src="{{ asset('assets/logo/logo1.jpg') }}" alt="Kano State Logo" class="w-full h-full object-contain">
                                          </div>
                                          <div class="text-center">
                                            <h2 class="text-lg font-bold text-green-800">KANO STATE MINISTRY OF LAND AND PHYSICAL PLANNING</h2>
                                            <p class="text-md font-medium text-red-600">SECTIONAL TITLE INITIAL  PAYMENT SLIP</p>
                                          </div>
                                          <div class="w-20 h-20">
                                            <img src="{{ asset('assets/logo/logo3.jpeg') }}" alt="Ministry Logo" class="w-full h-full object-contain">
                                          </div>
                                        </div>
                                        
                                        <!-- Payment Details -->
                                        <div class="mt-6 border-t border-b border-gray-300 py-4">
                                          <div class="grid grid-cols-2 gap-4 mb-4">
                                            <div>
                                              <p class="text-sm"><span class="font-bold">Application ID:</span> ST-2025-0{{ $application->id }}</p>
                                              <p class="text-sm"><span class="font-bold">File No:</span> {{ $application->fileno }}</p>
                                              <p class="text-sm"><span class="font-bold">Applicant:</span> {{ $application->applicant_title }} {{ $application->surname }} {{ $application->first_name }}</p>
                                              <p class="text-sm"><span class="font-bold">Land Use:</span> {{ $application->land_use }}</p>
                                            </div>
                                            <div>
                                              <p class="text-sm"><span class="font-bold">Payment Date:</span> {{ $application->payment_date ?? date('Y-m-d') }}</p>
                                              <p class="text-sm"><span class="font-bold">Receipt Number:</span> {{ $application->receipt_number ?? 'Pending' }}</p>
                                              <p class="text-sm"><span class="font-bold">Location:</span> {{ $application->property_house_no ?? '' }} {{ $application->property_plot_no ?? '' }}, {{ $application->property_street_name ?? '' }}</p>
                                              <p class="text-sm"><span class="font-bold">District:</span> {{ $application->property_district ?? '' }}, {{ $application->property_lga ?? '' }}</p>
                                            </div>
                                          </div>
                                          
                                          <!-- Payment Items Table -->
                                          <table class="w-full border-collapse border border-gray-300 mt-4">
                                            <thead>
                                              <tr class="bg-gray-100">
                                                <th class="border border-gray-300 p-2 text-left">Description</th>
                                                <th class="border border-gray-300 p-2 text-right">Amount (₦)</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td class="border border-gray-300 p-2">Application Fee</td>
                                                <td class="border border-gray-300 p-2 text-right">{{ number_format($application->application_fee ?? 0, 2) }}</td>
                                              </tr>
                                              <tr>
                                                <td class="border border-gray-300 p-2">Processing Fee</td>
                                                <td class="border border-gray-300 p-2 text-right">{{ number_format($application->processing_fee ?? 0, 2) }}</td>
                                              </tr>
                                              <tr>
                                                <td class="border border-gray-300 p-2">Survey Fee</td>
                                                <td class="border border-gray-300 p-2 text-right">{{ number_format($application->site_plan_fee ?? 0, 2) }}</td>
                                              </tr>
                                              <tr class="bg-gray-100 font-bold">
                                                <td class="border border-gray-300 p-2">Total</td>
                                                <td class="border border-gray-300 p-2 text-right">{{ number_format($total_amount, 2) }}</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                        
                                        <!-- Footer -->
                                        <div class="mt-6">
                                          <p class="text-sm mb-2"><span class="font-bold">Amount in words:</span> 
                                            {{ ucfirst((new NumberFormatter('en', NumberFormatter::SPELLOUT))->format($total_amount)) }} Naira Only
                                          </p>
                                          <p class="text-sm mb-1">Please present this payment slip when making your payment.</p>
                                          <p class="text-sm italic">This is an official document of the Kano State Ministry of Land and Physical Planning.</p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <script>
                                // Print payment slip function
                                function printPaymentSlip() {
                                  const printContent = document.getElementById('payment-slip').innerHTML;
                                  const originalContent = document.body.innerHTML;
                                  
                                  document.body.innerHTML = `
                                    <div style="padding: 20px;">
                                      ${printContent}
                                    </div>
                                  `;
                                  
                                  window.print();
                                  document.body.innerHTML = originalContent;
                                  
                                  // Reinitialize Lucide icons after restoring content
                                  lucide.createIcons();
                                }
                                
                                // Download payment slip as PDF
                                function downloadPaymentSlip() {
                                  // Create a notification that this feature requires HTML2PDF library
                                  alert('Downloading payment slip as PDF. This would typically use a library like html2pdf.js or jsPDF to generate the PDF.');
                                  
                                  // In a real implementation, you would:
                                  // 1. Use a library like html2pdf.js
                                  // 2. Target the payment-slip element
                                  // 3. Convert to PDF and trigger download
                                  
                                  // Example implementation with html2pdf would be:
                                  // html2pdf().from(document.getElementById('payment-slip')).save('payment-slip.pdf');
                                }
                              </script>
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
                                      <button class="flex items-center px-3 py-1 text-xs bg-black text-white rounded-md hover:bg-gray-800">
                                              <i data-lucide="receipt" class="w-3.5 h-3.5 mr-1.5"></i>
                                              Launch ArcGis 
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                 </div>
                            
                                  <!-- Final Bill Tab -->
                                  <div id="final-tab" class="tab-content">
                                    @include('actions.final_bill')
                                 </div>
                                 
                 
                                </div>
                              </div>
                              </div>
                           
                           <!-- Footer -->
                           <div class="flex justify-end p-4 border-t">
                              <button type="button" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300" id="closePaymentBtnFooter">Close</button>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                 
  <script>
    // Initialize Lucide icons
    lucide.createIcons();
    
    // Tab switching functionality
    document.addEventListener('DOMContentLoaded', function() {
      const tabButtons = document.querySelectorAll('.tab-button');
      const tabContents = document.querySelectorAll('.tab-content');
      
      tabButtons.forEach(button => {
        button.addEventListener('click', function() {
          const tabId = this.getAttribute('data-tab');
          
          // Deactivate all tabs
          tabButtons.forEach(btn => btn.classList.remove('active'));
          tabContents.forEach(content => content.classList.remove('active'));
          
          // Activate selected tab
          this.classList.add('active');
          document.getElementById(`${tabId}-tab`).classList.add('active');
        });
      });
      
      // Close modal button
      document.getElementById('closeModal').addEventListener('click', function() {
        // In a real application, this would close the modal
        alert('Modal closed');
      });
    });
  </script>

                <!-- Footer -->
                @include('admin.footer')
            </div>
        @endsection


        <script></script>
