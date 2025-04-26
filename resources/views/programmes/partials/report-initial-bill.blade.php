<style>
   
    

    .tab2:hover {
       
    }
    
    .tab2.active {
       
 
    }
    
    .tab2-content {
      display: none;
      padding: 15px;
    }
    
    .tab2-content.active {
      display: block;
    }
  </style>
  
  <div class="tabs-inner mb-6">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold">Initial Payments Overview</h2>
    <ul class="flex border-b payment-tabs">
      <li class="mr-1">
        <button  class="bg-white inline-block py-2 px-4 text-blue-500 font-semibold border-b-2 border-blue-500 tab2 active" data-tab="tab1">Primary Payments</button>
      </li>
      <li class="mr-1">
        <button class="bg-white inline-block py-2 px-4 text-blue-500 tab2" data-tab="tab3">Unit Payments</button>
      </li>
    </ul>
  </div>

  <!-- Primary Payments Tab -->
  <div id="tab1" class="tab2-content active">
    <!-- Primary Payments Stats Cards -->
    <div class="grid grid-cols-4 gap-4 mb-6">
      <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Total Application Fees</h3>
        <div class="mt-2 flex justify-between items-end">
          <p class="text-2xl font-bold text-gray-800">₦ {{ number_format(collect($primaryPaymentData ?? [])->sum('application_fee'), 2) }}</p>
          <div class="flex items-center text-green-600">
            <i data-lucide="banknote" class="w-5 h-5"></i>
          </div>
        </div>
      </div>

      <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Total Processing Fees</h3>
        <div class="mt-2 flex justify-between items-end">
          <p class="text-2xl font-bold text-gray-800">₦ {{ number_format(collect($primaryPaymentData ?? [])->sum('processing_fee'), 2) }}</p>
          <div class="flex items-center text-blue-600">
            <i data-lucide="receipt" class="w-5 h-5"></i>
          </div>
        </div>
      </div>

      <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Total Site Plan Fees</h3>
        <div class="mt-2 flex justify-between items-end">
          <p class="text-2xl font-bold text-gray-800">₦ {{ number_format(collect($primaryPaymentData ?? [])->sum('site_plan_fee'), 2) }}</p>
          <div class="flex items-center text-purple-600">
            <i data-lucide="map" class="w-5 h-5"></i>
          </div>
        </div>
      </div>

      <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Total Payments</h3>
        <div class="mt-2 flex justify-between items-end">
          <p class="text-2xl font-bold text-gray-800">₦ {{ number_format(
            collect($primaryPaymentData ?? [])->sum('application_fee') + 
            collect($primaryPaymentData ?? [])->sum('processing_fee') + 
            collect($primaryPaymentData ?? [])->sum('site_plan_fee'), 2) }}</p>
          <div class="flex items-center text-indigo-600">
            <i data-lucide="wallet" class="w-5 h-5"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Primary Payments Charts -->
    <div class="grid grid-cols-2 gap-4 mb-6">
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Primary Payment Distribution</h3>
        <div id="primary-payment-distribution-chart" style="height: 250px;"></div>
      </div>
      
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Monthly Payment Trend</h3>
        <div id="primary-payment-trend-chart" style="height: 250px;"></div>
      </div>
    </div>

    <!-- Primary Payments Table -->
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold">Primary Application Payments</h2>
        <div class="flex items-center space-x-4">
          {{-- <button id="export-primary-payments-btn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
            <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
            <span>Export</span>
          </button>
          
          <button id="print-primary-payments-btn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
            <i data-lucide="printer" class="w-4 h-4 text-gray-600"></i>
            <span>Print</span>
          </button> --}}
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table id="primary-payments-table" class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="table-header">File No</th>
              <th class="table-header">Owner</th>
              <th class="table-header">Application Fee</th>
              <th class="table-header">Processing Fee</th>
              <th class="table-header">Site Plan Fee</th>
              <th class="table-header">Total</th>
              
              <th class="table-header">Receipt Number</th>
              <th class="table-header">Payment Date</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @if(isset($primaryPaymentData) && count($primaryPaymentData) > 0)
              @foreach($primaryPaymentData as $payment)
                @if(floatval($payment->application_fee) > 0 || floatval($payment->processing_fee) > 0 || floatval($payment->site_plan_fee) > 0)
                  <tr>
                    <td class="table-cell">{{ $payment->fileno }}</td>
                    <td class="table-cell">{{ $payment->owner_name }}</td>
                    <td class="table-cell">₦ {{ number_format($payment->application_fee ?? 0, 2) }}</td>
                    <td class="table-cell">₦ {{ number_format($payment->processing_fee ?? 0, 2) }}</td>
                    <td class="table-cell">₦ {{ number_format($payment->site_plan_fee ?? 0, 2) }}</td>
                    <td class="table-cell">₦ {{ number_format(
                      floatval($payment->application_fee ?? 0) + 
                      floatval($payment->processing_fee ?? 0) + 
                      floatval($payment->site_plan_fee ?? 0), 2) }}</td>
                   
                    <td class="table-cell">{{ $payment->receipt_number ?? 'N/A' }}</td>
                    <td class="table-cell">{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') : 'N/A' }}</td>
                  </tr>
                @endif
              @endforeach
            @else
              <tr>
                <td colspan="8" class="table-cell text-center py-4">No payment records found</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
     
  <!-- Unit Payments Tab -->
  <div id="tab3" class="tab2-content">
    <!-- Unit Payments Stats Cards -->
    <div class="grid grid-cols-4 gap-4 mb-6">
      <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Total Application Fees</h3>
        <div class="mt-2 flex justify-between items-end">
          <p class="text-2xl font-bold text-gray-800">₦ {{ number_format(collect($unitPaymentData ?? [])->sum('application_fee'), 2) }}</p>
          <div class="flex items-center text-green-600">
            <i data-lucide="banknote" class="w-5 h-5"></i>
          </div>
        </div>
      </div>

      <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Total Processing Fees</h3>
        <div class="mt-2 flex justify-between items-end">
          <p class="text-2xl font-bold text-gray-800">₦ {{ number_format(collect($unitPaymentData ?? [])->sum('processing_fee'), 2) }}</p>
          <div class="flex items-center text-blue-600">
            <i data-lucide="receipt" class="w-5 h-5"></i>
          </div>
        </div>
      </div>

      <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Total Site Plan Fees</h3>
        <div class="mt-2 flex justify-between items-end">
          <p class="text-2xl font-bold text-gray-800">₦ {{ number_format(collect($unitPaymentData ?? [])->sum('site_plan_fee'), 2) }}</p>
          <div class="flex items-center text-purple-600">
            <i data-lucide="map" class="w-5 h-5"></i>
          </div>
        </div>
      </div>

      <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Total Payments</h3>
        <div class="mt-2 flex justify-between items-end">
          <p class="text-2xl font-bold text-gray-800">₦ {{ number_format(
            collect($unitPaymentData ?? [])->sum('application_fee') + 
            collect($unitPaymentData ?? [])->sum('processing_fee') + 
            collect($unitPaymentData ?? [])->sum('site_plan_fee'), 2) }}</p>
          <div class="flex items-center text-indigo-600">
            <i data-lucide="wallet" class="w-5 h-5"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Unit Payments Charts -->
    <div class="grid grid-cols-2 gap-4 mb-6">
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Unit Payment Distribution</h3>
        <div id="unit-payment-distribution-chart" style="height: 250px;"></div>
      </div>
      
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Monthly Payment Trend</h3>
        <div id="unit-payment-trend-chart" style="height: 250px;"></div>
      </div>
    </div>

    <!-- Unit Payments Table -->
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold">Unit Application Payments</h2>
        <div class="flex items-center space-x-4">
          {{-- <button id="export-unit-payments-btn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
            <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
            <span>Export</span>
          </button>
          
          <button id="print-unit-payments-btn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
            <i data-lucide="printer" class="w-4 h-4 text-gray-600"></i>
            <span>Print</span>
          </button> --}}
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table id="unit-payments-table" class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="table-header">File No</th>
              <th class="table-header">Owner</th>
              <th class="table-header">Block/Floor/Unit</th>
              <th class="table-header">Application Fee</th>
              <th class="table-header">Processing Fee</th>
              <th class="table-header">Site Plan Fee</th>
              <th class="table-header">Total</th>
              
              <th class="table-header">Receipt Number</th>
              <th class="table-header">Payment Date</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @if(isset($unitPaymentData) && count($unitPaymentData) > 0)
              @foreach($unitPaymentData as $payment)
                @if(floatval($payment->application_fee) > 0 || floatval($payment->processing_fee) > 0 || floatval($payment->site_plan_fee) > 0)
                  <tr>
                    <td class="table-cell">{{ $payment->fileno }}</td>
                    <td class="table-cell">{{ $payment->owner_name }}</td>
                    <td class="table-cell">
                      Block: {{ $payment->block_number ?? 'N/A' }}, 
                      Floor: {{ $payment->floor_number ?? 'N/A' }}, 
                      Unit: {{ $payment->unit_number ?? 'N/A' }}
                    </td>
                    <td class="table-cell">₦ {{ number_format($payment->application_fee ?? 0, 2) }}</td>
                    <td class="table-cell">₦ {{ number_format($payment->processing_fee ?? 0, 2) }}</td>
                    <td class="table-cell">₦ {{ number_format($payment->site_plan_fee ?? 0, 2) }}</td>
                    <td class="table-cell">₦ {{ number_format(
                      floatval($payment->application_fee ?? 0) + 
                      floatval($payment->processing_fee ?? 0) + 
                      floatval($payment->site_plan_fee ?? 0), 2) }}</td>
                        <td class="table-cell">{{ $payment->receipt_number ?? 'N/A' }}</td>
                    <td class="table-cell">{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') : 'N/A' }}</td>
                  
                  </tr>
                @endif
              @endforeach
            @else
              <tr>
                <td colspan="9" class="table-cell text-center py-4">No payment records found</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<div class="bg-white rounded-md shadow-sm border border-gray-200 p-4 mb-6">
    <div class="flex flex-wrap items-center justify-between">
        <h3 class="text-md font-medium text-gray-700 mb-2 sm:mb-0">Payment Date Filter</h3>
        <div class="flex flex-wrap items-center space-x-2">
            <select id="initial-date-range-preset" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                <option value="all" selected>All Time</option>
                <option value="7days">Last 7 Days</option>
                <option value="30days">Last 30 Days</option>
                <option value="this-month">This Month</option>
                <option value="last-month">Last Month</option>
                <option value="custom">Custom Range</option>
            </select>
            
            <div id="initial-custom-date-range" class="hidden flex items-center space-x-2">
                <input type="date" id="initial-date-from" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <span>to</span>
                <input type="date" id="initial-date-to" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button id="initial-apply-custom-range" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Apply</button>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Initial Payment Overview</h3>
        <div class="mt-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Application Fee:</span>
                <span class="text-sm font-medium">
                    ₦{{ number_format(
                        collect($primaryPaymentData ?? [])->sum('application_fee') + 
                        collect($unitPaymentData ?? [])->sum('application_fee'), 2
                    ) }}
                </span>
            </div>
            <div class="flex justify-between mt-1">
                <span class="text-sm text-gray-600">Processing Fee:</span>
                <span class="text-sm font-medium">
                    ₦{{ number_format(
                        collect($primaryPaymentData ?? [])->sum('processing_fee') + 
                        collect($unitPaymentData ?? [])->sum('processing_fee'), 2
                    ) }}
                </span>
            </div>
            <div class="flex justify-between mt-1">
                <span class="text-sm text-gray-600">Site Plan Fee:</span>
                <span class="text-sm font-medium">
                    ₦{{ number_format(
                        collect($primaryPaymentData ?? [])->sum('site_plan_fee') + 
                        collect($unitPaymentData ?? [])->sum('site_plan_fee'), 2
                    ) }}
                </span>
            </div>
            <div class="flex justify-between mt-2 pt-2 border-t border-gray-200">
                <span class="text-sm font-medium text-gray-800">Total:</span>
                <span class="text-sm font-bold">
                    ₦{{ number_format(
                        collect($primaryPaymentData ?? [])->sum('application_fee') + 
                        collect($unitPaymentData ?? [])->sum('application_fee') +
                        collect($primaryPaymentData ?? [])->sum('processing_fee') + 
                        collect($unitPaymentData ?? [])->sum('processing_fee') +
                        collect($primaryPaymentData ?? [])->sum('site_plan_fee') + 
                        collect($unitPaymentData ?? [])->sum('site_plan_fee'), 2
                    ) }}
                </span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Primary Application Payments</h3>
        <div class="mt-2">
            <div class="flex justify-between mb-2">
                <span class="text-sm text-gray-600">Total Records:</span>
                <span class="text-sm font-medium">{{ count($primaryPaymentData ?? []) }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 100%"></div>
            </div>
            <div class="flex justify-between mt-2">
                <span class="text-xs text-gray-500">Initial Fees</span>
                <span class="text-xs text-gray-500">
                    ₦{{ number_format(
                        collect($primaryPaymentData ?? [])->sum('application_fee') + 
                        collect($primaryPaymentData ?? [])->sum('processing_fee') + 
                        collect($primaryPaymentData ?? [])->sum('site_plan_fee'), 2
                    ) }}
                </span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Unit Application Payments</h3>
        <div class="mt-2">
            <div class="flex justify-between mb-2">
                <span class="text-sm text-gray-600">Total Records:</span>
                <span class="text-sm font-medium">{{ count($unitPaymentData ?? []) }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-purple-600 h-2.5 rounded-full" style="width: 100%"></div>
            </div>
            <div class="flex justify-between mt-2">
                <span class="text-xs text-gray-500">Initial Fees</span>
                <span class="text-xs text-gray-500">
                    ₦{{ number_format(
                        collect($unitPaymentData ?? [])->sum('application_fee') + 
                        collect($unitPaymentData ?? [])->sum('processing_fee') + 
                        collect($unitPaymentData ?? [])->sum('site_plan_fee'), 2
                    ) }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Initial Payment Visualization Charts -->
<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Initial Fees Breakdown</h3>
        <div id="fees-breakdown-chart" style="height: 250px;"></div>
    </div>
    
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Payment Trend</h3>
        <div id="payment-trend-chart" style="height: 250px;"></div>
    </div>
</div>

<!-- Payment Tables -->
<div class="grid grid-cols-1 gap-6">
    <!-- Primary Application Payments -->
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold mb-4">Primary Application Initial Fees</h3>
        <div class="overflow-x-auto">
            <table id="primary-initial-payments-table" class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="table-header">File No</th>
                        <th class="table-header">Owner</th>
                        <th class="table-header">Application Fee</th>
                        <th class="table-header">Processing Fee</th>
                        <th class="table-header">Site Plan Fee</th>
                        <th class="table-header">Payment Date</th>
                        <th class="table-header">Receipt Number</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if(isset($primaryPaymentData) && count($primaryPaymentData) > 0)
                        @foreach($primaryPaymentData as $payment)
                            <tr>
                                <td class="table-cell">{{ $payment->fileno ?? 'N/A' }}</td>
                                <td class="table-cell">{{ $payment->owner_name ?? 'N/A' }}</td>
                                <td class="table-cell">₦{{ number_format($payment->application_fee ?? 0, 2) }}</td>
                                <td class="table-cell">₦{{ number_format($payment->processing_fee ?? 0, 2) }}</td>
                                <td class="table-cell">₦{{ number_format($payment->site_plan_fee ?? 0, 2) }}</td>
                                <td class="table-cell">{{ isset($payment->payment_date) && $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') : 'N/A' }}</td>
                                <td class="table-cell">{{ $payment->receipt_number ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="table-cell text-center py-4">No primary application payment records found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Unit Application Payments -->
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold mb-4">Unit Application Initial Fees</h3>
        <div class="overflow-x-auto">
            <table id="unit-initial-payments-table" class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="table-header">File No</th>
                        <th class="table-header">Owner</th>
                        <th class="table-header">Block/Floor/Unit</th>
                        <th class="table-header">Application Fee</th>
                        <th class="table-header">Processing Fee</th>
                        <th class="table-header">Site Plan Fee</th>
                        <th class="table-header">Payment Date</th>
                        <th class="table-header">Receipt Number</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if(isset($unitPaymentData) && count($unitPaymentData) > 0)
                        @foreach($unitPaymentData as $payment)
                            <tr>
                                <td class="table-cell">{{ $payment->fileno ?? 'N/A' }}</td>
                                <td class="table-cell">{{ $payment->owner_name ?? 'N/A' }}</td>
                                <td class="table-cell">
                                    Block: {{ $payment->block_number ?? 'N/A' }},
                                    Floor: {{ $payment->floor_number ?? 'N/A' }},
                                    Unit: {{ $payment->unit_number ?? 'N/A' }}
                                </td>
                                <td class="table-cell">₦{{ number_format($payment->application_fee ?? 0, 2) }}</td>
                                <td class="table-cell">₦{{ number_format($payment->processing_fee ?? 0, 2) }}</td>
                                <td class="table-cell">₦{{ number_format($payment->site_plan_fee ?? 0, 2) }}</td>
                                <td class="table-cell">{{ isset($payment->payment_date) && $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') : 'N/A' }}</td>
                                <td class="table-cell">{{ $payment->receipt_number ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="table-cell text-center py-4">No unit application payment records found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Improved tab switching for payment reports - using dataset attribute to prevent conflicts with main tabs
    document.querySelectorAll('.payment-tabs a').forEach(tab => {
      tab.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation(); // Prevent event from bubbling up to parent tab system
        
        // Hide all payment tab content
        document.querySelectorAll('.payment-tab-content').forEach(content => {
          content.classList.add('hidden');
        });
        
        // Reset all payment tab styles
        document.querySelectorAll('.payment-tabs a').forEach(link => {
          link.classList.remove('text-blue-500', 'font-semibold', 'border-b-2', 'border-blue-500');
          link.classList.add('text-gray-500');
        });
        
        // Activate clicked tab
        this.classList.remove('text-gray-500');
        this.classList.add('text-blue-500', 'font-semibold', 'border-b-2', 'border-blue-500');
        
        // Show corresponding content
        const targetId = this.getAttribute('data-payment-tab');
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
          targetElement.classList.remove('hidden');
        }
        
        // Redraw charts when switching tabs
        window.dispatchEvent(new Event('resize'));
        
        return false; // Prevent any other handlers from being called
      });
    });

    // Initialize charts if ApexCharts is available
    if (typeof ApexCharts !== 'undefined') {
      // Primary Payment Distribution Chart
      const primaryPaymentData = [
        {{ floatval(collect($primaryPaymentData ?? [])->sum('application_fee')) }},
        {{ floatval(collect($primaryPaymentData ?? [])->sum('processing_fee')) }},
        {{ floatval(collect($primaryPaymentData ?? [])->sum('site_plan_fee')) }}
      ];
      
      const primaryPaymentDistributionOptions = {
        series: primaryPaymentData,
        chart: {
          type: 'donut',
          height: 250
        },
        labels: ['Application Fee', 'Processing Fee', 'Site Plan Fee'],
        colors: ['#3B82F6', '#10B981', '#F97316'],
        legend: {
          position: 'bottom'
        }
      };
      
      const primaryPaymentDistributionChart = new ApexCharts(
        document.querySelector("#primary-payment-distribution-chart"),
        primaryPaymentDistributionOptions
      );
      primaryPaymentDistributionChart.render();
      
      // Primary Monthly Payment Trend Chart
      const primaryMonthLabels = {!! json_encode(($primaryPaymentsByMonth ?? collect())->keys()->toArray()) !!};
      const primaryMonthValues = {!! json_encode(($primaryPaymentsByMonth ?? collect())->values()->toArray()) !!};
      
      const primaryPaymentTrendOptions = {
        series: [{
          name: 'Total Payments',
          data: primaryMonthValues
        }],
        chart: {
          type: 'line',
          height: 250,
          toolbar: {
            show: false
          }
        },
        xaxis: {
          categories: primaryMonthLabels
        },
        colors: ['#6366F1'],
        stroke: {
          curve: 'smooth',
          width: 3
        },
        markers: {
          size: 4
        },
        yaxis: {
          labels: {
            formatter: function(value) {
              return '₦' + new Intl.NumberFormat().format(value);
            }
          }
        }
      };
      
      const primaryPaymentTrendChart = new ApexCharts(
        document.querySelector("#primary-payment-trend-chart"),
        primaryPaymentTrendOptions
      );
      primaryPaymentTrendChart.render();
      
      // Unit Payment Distribution Chart
      const unitPaymentData = [
        {{ floatval(collect($unitPaymentData ?? [])->sum('application_fee')) }},
        {{ floatval(collect($unitPaymentData ?? [])->sum('processing_fee')) }},
        {{ floatval(collect($unitPaymentData ?? [])->sum('site_plan_fee')) }}
      ];
      
      const unitPaymentDistributionOptions = {
        series: unitPaymentData,
        chart: {
          type: 'donut',
          height: 250
        },
        labels: ['Application Fee', 'Processing Fee', 'Site Plan Fee'],
        colors: ['#8B5CF6', '#EC4899', '#F59E0B'],
        legend: {
          position: 'bottom'
        }
      };
      
      const unitPaymentDistributionChart = new ApexCharts(
        document.querySelector("#unit-payment-distribution-chart"),
        unitPaymentDistributionOptions
      );
      unitPaymentDistributionChart.render();
      
      // Unit Monthly Payment Trend Chart
      const unitMonthLabels = {!! json_encode(($unitPaymentsByMonth ?? collect())->keys()->toArray()) !!};
      const unitMonthValues = {!! json_encode(($unitPaymentsByMonth ?? collect())->values()->toArray()) !!};
      
      const unitPaymentTrendOptions = {
        series: [{
          name: 'Total Payments',
          data: unitMonthValues
        }],
        chart: {
          type: 'line',
          height: 250,
          toolbar: {
            show: false
          }
        },
        xaxis: {
          categories: unitMonthLabels
        },
        colors: ['#EC4899'],
        stroke: {
          curve: 'smooth',
          width: 3
        },
        markers: {
          size: 4
        },
        yaxis: {
          labels: {
            formatter: function(value) {
              return '₦' + new Intl.NumberFormat().format(value);
            }
          }
        }
      };
      
      const unitPaymentTrendChart = new ApexCharts(
        document.querySelector("#unit-payment-trend-chart"),
        unitPaymentTrendOptions
      );
      unitPaymentTrendChart.render();
    }
    
    // Initialize DataTables for payment tables
    if (typeof $.fn.DataTable !== 'undefined') {
      $('#primary-payments-table').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
      
      $('#unit-payments-table').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    }
    
    // Print button functionality
    document.getElementById('print-primary-payments-btn').addEventListener('click', function() {
      window.print();
    });
    
    document.getElementById('print-unit-payments-btn').addEventListener('click', function() {
      window.print();
    });
  });



  document.addEventListener('DOMContentLoaded', function() {
      const tabs = document.querySelectorAll('.tab2');
      
      tabs.forEach(tab2 => {
        tab2.addEventListener('click', function() {
          // Remove active class from all tabs and content
          document.querySelectorAll('.tab2').forEach(t => t.classList.remove('active'));
          document.querySelectorAll('.tab2-content').forEach(c => c.classList.remove('active'));
          
          // Add active class to clicked tab
          this.classList.add('active');
          
          // Show the corresponding content
          const tabId = this.getAttribute('data-tab');
          document.getElementById(tabId).classList.add('active');
        });
      });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTables
        if (typeof $.fn.DataTable !== 'undefined') {
            $('#primary-initial-payments-table').DataTable({
                responsive: true,
                pageLength: 10,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
            
            $('#unit-initial-payments-table').DataTable({
                responsive: true,
                pageLength: 10,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        }
        
        // Initialize charts if ApexCharts is available
        if (typeof ApexCharts !== 'undefined') {
            // Calculate fee totals
            const totalAppFee = {{ 
                collect($primaryPaymentData ?? [])->sum('application_fee') + 
                collect($unitPaymentData ?? [])->sum('application_fee') 
            }};
            
            const totalProcFee = {{ 
                collect($primaryPaymentData ?? [])->sum('processing_fee') + 
                collect($unitPaymentData ?? [])->sum('processing_fee') 
            }};
            
            const totalSitePlanFee = {{ 
                collect($primaryPaymentData ?? [])->sum('site_plan_fee') + 
                collect($unitPaymentData ?? [])->sum('site_plan_fee') 
            }};
            
            // Fees Breakdown Chart
            const feesBreakdownOptions = {
                series: [totalAppFee, totalProcFee, totalSitePlanFee],
                chart: {
                    type: 'donut',
                    height: 250
                },
                labels: ['Application Fee', 'Processing Fee', 'Site Plan Fee'],
                colors: ['#10B981', '#F59E0B', '#3B82F6'],
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return '₦' + value.toLocaleString();
                        }
                    }
                }
            };
            
            const feesBreakdownChart = new ApexCharts(
                document.querySelector("#fees-breakdown-chart"), 
                feesBreakdownOptions
            );
            feesBreakdownChart.render();
            
            // Payment Trend Chart - Combine data from primary and unit payments
            // First, process payment data by month
            const paymentByMonth = {};
            
            // Process primary payments
            @foreach($primaryPaymentData ?? [] as $payment)
                @if(isset($payment->payment_date) && $payment->payment_date)
                    (function() {
                        const primaryDate = '{{ \Carbon\Carbon::parse($payment->payment_date)->format("Y-m") }}';
                        if (!paymentByMonth[primaryDate]) paymentByMonth[primaryDate] = 0;
                        paymentByMonth[primaryDate] += {{ 
                            floatval($payment->application_fee ?? 0) + 
                            floatval($payment->processing_fee ?? 0) + 
                            floatval($payment->site_plan_fee ?? 0) 
                        }};
                    })();
                @endif
            @endforeach
            
            // Process unit payments
            @foreach($unitPaymentData ?? [] as $payment)
                @if(isset($payment->payment_date) && $payment->payment_date)
                    const unitDate = '{{ \Carbon\Carbon::parse($payment->payment_date)->format("Y-m") }}';
                    if (!paymentByMonth[unitDate]) paymentByMonth[unitDate] = 0;
                    paymentByMonth[unitDate] += {{ 
                        floatval($payment->application_fee ?? 0) + 
                        floatval($payment->processing_fee ?? 0) + 
                        floatval($payment->site_plan_fee ?? 0) 
                    }};
                @endif
            @endforeach
            
            // Convert to arrays for chart
            const months = Object.keys(paymentByMonth).sort();
            const paymentValues = months.map(month => paymentByMonth[month]);
            
            // Payment Trend Chart
            const paymentTrendOptions = {
                series: [{
                    name: 'Initial Payment',
                    data: paymentValues
                }],
                chart: {
                    type: 'area',
                    height: 250,
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: months,
                    labels: {
                        rotate: -45,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                colors: ['#6366F1'],
                yaxis: {
                    title: {
                        text: 'Payment Amount (₦)'
                    },
                    labels: {
                        formatter: function(value) {
                            return '₦' + value.toLocaleString();
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return '₦' + value.toLocaleString();
                        }
                    }
                }
            };
            
            const paymentTrendChart = new ApexCharts(
                document.querySelector("#payment-trend-chart"), 
                paymentTrendOptions
            );
            paymentTrendChart.render();
        }
        
        // Date range filter functionality
        const initialDateRangePreset = document.getElementById('initial-date-range-preset');
        const initialCustomDateRange = document.getElementById('initial-custom-date-range');
        const initialDateFrom = document.getElementById('initial-date-from');
        const initialDateTo = document.getElementById('initial-date-to');
        const initialApplyCustomRange = document.getElementById('initial-apply-custom-range');
        
        // Set default dates for custom range
        const today = new Date();
        initialDateTo.valueAsDate = today;
        
        const thirtyDaysAgo = new Date();
        thirtyDaysAgo.setDate(today.getDate() - 30);
        initialDateFrom.valueAsDate = thirtyDaysAgo;
        
        // Show/hide custom date inputs
        initialDateRangePreset.addEventListener('change', function() {
            if (this.value === 'custom') {
                initialCustomDateRange.classList.remove('hidden');
            } else {
                initialCustomDateRange.classList.add('hidden');
                applyInitialDateFilter(this.value);
            }
        });
        
        // Apply custom date filter
        initialApplyCustomRange.addEventListener('click', function() {
            applyInitialDateFilter('custom');
        });
        
        // Apply date filter to tables
        function applyInitialDateFilter(filterType) {
            let startDate, endDate;
            const today = new Date();
            
            // Set date range based on filter
            switch(filterType) {
                case '7days':
                    startDate = new Date();
                    startDate.setDate(today.getDate() - 7);
                    endDate = today;
                    break;
                case '30days':
                    startDate = new Date();
                    startDate.setDate(today.getDate() - 30);
                    endDate = today;
                    break;
                case 'this-month':
                    startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                    endDate = today;
                    break;
                case 'last-month':
                    startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                    endDate = new Date(today.getFullYear(), today.getMonth(), 0);
                    break;
                case 'custom':
                    startDate = new Date(initialDateFrom.value);
                    endDate = new Date(initialDateTo.value);
                    // Add 1 day to end date to include the selected date
                    endDate.setDate(endDate.getDate() + 1);
                    break;
                default: // 'all'
                    // Reset filters
                    if ($.fn.DataTable.isDataTable('#primary-initial-payments-table')) {
                        $('#primary-initial-payments-table').DataTable().search('').columns().search('').draw();
                    }
                    if ($.fn.DataTable.isDataTable('#unit-initial-payments-table')) {
                        $('#unit-initial-payments-table').DataTable().search('').columns().search('').draw();
                    }
                    return;
            }
            
            // Apply date filter to both tables
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                if (settings.nTable.id !== 'primary-initial-payments-table' && 
                    settings.nTable.id !== 'unit-initial-payments-table') {
                    return true;
                }
                
                const dateValue = data[settings.nTable.id === 'primary-initial-payments-table' ? 5 : 6]; // Date column
                if (!dateValue || dateValue === 'N/A') return false;
                
                try {
                    // Parse date from 'd Mon, YYYY' format
                    const dateParts = dateValue.split(' ');
                    if (dateParts.length < 3) return false; // Skip if date format is invalid
                    
                    const day = parseInt(dateParts[0]);
                    const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'].indexOf(dateParts[1].replace(',', ''));
                    const year = parseInt(dateParts[2]);
                    
                    if (isNaN(day) || month === -1 || isNaN(year)) return false;
                    
                    const rowDate = new Date(year, month, day);
                    return rowDate >= startDate && rowDate <= endDate;
                } catch (e) {
                    console.error('Error parsing date:', e);
                    return false;
                }
            });
            
            // Apply filters to tables
            if ($.fn.DataTable.isDataTable('#primary-initial-payments-table')) {
                $('#primary-initial-payments-table').DataTable().draw();
            }
            if ($.fn.DataTable.isDataTable('#unit-initial-payments-table')) {
                $('#unit-initial-payments-table').DataTable().draw();
            }
            
            // Remove the filter
            $.fn.dataTable.ext.search.pop();
        }
    });
</script>
