@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Data View') }}
@endsection


@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@include('programmes.partials.style')

<!-- Print Dialog Loading Indicator -->
<div id="print-loading" style="display:none;">
  <div class="spinner"></div>
  <div>Preparing your document...</div>
</div>

<!-- Main Content Container - This will remain in place -->
<div id="main-content" class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
    <!-- Filter Form -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-6">
      <div class="flex items-center justify-between mb-4">
      <div class="flex items-center">
        <h3 class="text-lg font-semibold text-gray-800">
        <i data-lucide="filter" class="w-5 h-5 inline-block mr-2 text-blue-600"></i>
        Payments
        </h3>
        <button id="toggle-filters-btn" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white font-medium py-1.5 px-3 rounded-md transition-colors shadow-sm flex items-center justify-center text-sm">
        <i data-lucide="filter" class="w-3.5 h-3.5 mr-1"></i>
        Filter
        </button>
      </div>
      <span class="text-sm text-gray-500">Filter payment records by date, type and status</span>
      </div>

      <!-- Filter form that's hidden by default -->
      <div id="payment-filter-container" style="display: none;">
      <form id="payment-filter-form" class="grid grid-cols-1 md:grid-cols-5 gap-5">
        <div class="col-span-1">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Start Date</label>
        <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i data-lucide="calendar" class="w-4 h-4 text-gray-500"></i>
        </div>
        <input type="text" id="start-date" name="start_date" 
          class="w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all" 
          placeholder="Select start date">
        </div>
        </div>
        
        <div class="col-span-1">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">End Date</label>
        <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i data-lucide="calendar" class="w-4 h-4 text-gray-500"></i>
        </div>
        <input type="text" id="end-date" name="end_date" 
          class="w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all" 
          placeholder="Select end date">
        </div>
        </div>
        
        <div class="col-span-1">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Payment Type</label>
        <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i data-lucide="credit-card" class="w-4 h-4 text-gray-500"></i>
        </div>
        <select id="payment-type" name="payment_type" 
          class="w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 appearance-none transition-all">
          <option value="all">All Payments</option>
          <option value="initial">Initial Bill</option>
          <option value="betterment">Betterment Charges</option>
          <option value="final">Final Bill</option>
        </select>
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
          <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
        </div>
        </div>
        </div>
        
        <div class="col-span-1">
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Payment Status</label>
        <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <i data-lucide="check-circle-2" class="w-4 h-4 text-gray-500"></i>
        </div>
        <select id="payment-status" name="payment_status" 
          class="w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 appearance-none transition-all">
          <option value="all">All Status</option>
          <option value="Complete">Complete</option>
          <option value="Incomplete">Incomplete</option>
        </select>
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
          <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
        </div>
        </div>
        </div>
        
        <div class="col-span-1 flex items-end gap-2">
        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-md transition-colors shadow-sm flex items-center justify-center">
        <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
        Apply
        </button>
        <button type="reset" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 px-3 rounded-md transition-colors shadow-sm">
        <i data-lucide="x" class="w-4 h-4"></i>
        </button>
        </div>
      </form>
      </div>
    </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Add toggle functionality for the filter form
    document.getElementById('toggle-filters-btn').addEventListener('click', function() {
      const filterContainer = document.getElementById('payment-filter-container');
      if (filterContainer.style.display === 'none') {
      filterContainer.style.display = 'block';
      } else {
      filterContainer.style.display = 'none';
      }
    });
    });
  </script>
    
    <!-- Payments Overview -->
    @include('programmes.partials.payments_report')
   
      <!-- Payment Visualization -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
          <h3 class="text-lg font-semibold mb-4">Payment Status Distribution</h3>
          <div class="chart-container">
            <canvas id="statusChart"></canvas>
          </div>
        </div>
        
        <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
          <h3 class="text-lg font-semibold mb-4">Payment Trends</h3>
          <div class="chart-container">
            <canvas id="trendsChart"></canvas>
          </div>
        </div>
        
        <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
          <h3 class="text-lg font-semibold mb-4">Application Type Comparison</h3>
          <div class="chart-container">
            <canvas id="comparisonChart"></canvas>
          </div>
        </div>
      </div>
      
      <!-- Report Print Button -->
      <div class="flex justify-end mb-6">
        <button id="print-charts-btn" class="flex items-center space-x-2 px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700">
          <i data-lucide="printer" class="w-4 h-4"></i>
          <span>Print Payment Summary</span>
        </button>
      </div>
      
      <!-- Payments Tabs -->
      <div class="bg-white rounded-md shadow-sm border border-gray-200">
        <div class="border-b border-gray-200">
          <div class="flex">
            <!-- Remove inline onclick attributes -->
            <button id="primary-tab" class="px-6 py-3 tab-active border-t border-l border-r">
              Primary Applications ({{ count($primaryPayments) }})
            </button>
            <button id="unit-tab" class="px-6 py-3 tab-inactive">
              Unit Applications ({{ count($unitPayments) }})
            </button>
          </div>
        </div>
        
        <!-- Primary Applications Tab -->
        <div id="primary-content" class="p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Primary Application Payments</h2>
            
            <div class="flex items-center space-x-4">
              <div class="relative">
                <select id="primary-filter" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                  <option value="all">All...</option>
                  <option value="paid">Complete</option>
                  <option value="pending">Incomplete</option>
                  <option value="overdue">Overdue</option>
                </select>
                <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
              </div>
              
              <button id="print-primary-btn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
                <i data-lucide="printer" class="w-4 h-4 text-gray-600"></i>
                <span>Print</span>
              </button>
            </div>
          </div>
          
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="table-header">File No</th>
                  <th class="table-header">Owner</th>
                  <th class="table-header">Scheme App Fee</th>
                  <th class="table-header">Site Plan Fee</th>
                  <th class="table-header">Processing Fee</th>
                  <th class="table-header">Betterment</th>
                   
                  <th class="table-header">Land Use</th>
                  <th class="table-header">Penalty</th>
                 
                  <th class="table-header">Date</th>
                  <th class="table-header">Status</th>
                  
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($primaryPayments as $payment)
                <tr>
                  <td class="table-cell">{{ $payment->Sectional_Title_File_No }}</td>
                  <td class="table-cell">{{ $payment->owner_name }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Scheme_Application_Fee, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Site_Plan_Fee, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Processing_Fee, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Betterment_Charges, 2) }}</td>
            
                  <td class="table-cell">₦{{ number_format($payment->Land_Use_Charge, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Penalty_Fees, 2) }}</td>
                
                  <td class="table-cell">{{ \Carbon\Carbon::parse($payment->created_at)->format('Y-m-d') }}</td>
                  <td class="table-cell">
                    <span class="badge badge-{{ strtolower($payment->Payment_Status) === 'paid' ? 'approved' : (strtolower($payment->Payment_Status) === 'pending' ? 'pending' : 'declined') }}">
                      {{ $payment->Payment_Status }}
                    </span>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="12" class="table-cell text-center py-4">No primary application payment records found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- Unit Applications Tab -->
        <div id="unit-content" class="p-6 hidden">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Unit Application Payments</h2>
            
            <div class="flex items-center space-x-4">
              <div class="relative">
                <select id="unit-filter" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                  <option value="all">All...</option>
                  <option value="paid">Complete</option>
                  <option value="pending">Incomplete</option>
                  <option value="overdue">Overdue</option>
                </select>
                <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
              </div>
              
              <button id="print-unit-btn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
                <i data-lucide="printer" class="w-4 h-4 text-gray-600"></i>
                <span>Print</span>
              </button>
            </div>
          </div>
          
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="table-header">File No</th>
                  <th class="table-header">Unit Owner</th>
                  <th class="table-header">Scheme App Fee</th>
                  <th class="table-header">Site Plan Fee</th>
                  <th class="table-header">Processing Fee</th>
                  <th class="table-header">Betterment</th>
                  <th class="table-header">Unit App Fees</th>
                  <th class="table-header">Land Use</th>
                  <th class="table-header">Penalty</th>
                
                  <th class="table-header">Date</th>
                  <th class="table-header">Status</th>
                 
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($unitPayments as $payment)
                <tr>
                  <td class="table-cell">{{ $payment->Sectional_Title_File_No }}</td>
                  <td class="table-cell">{{ $payment->owner_name }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Scheme_Application_Fee, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Site_Plan_Fee, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Processing_Fee, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Betterment_Charges, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Unit_Application_Fees, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Land_Use_Charge, 2) }}</td>
                  <td class="table-cell">₦{{ number_format($payment->Penalty_Fees, 2) }}</td>
             
                  <td class="table-cell">{{ \Carbon\Carbon::parse($payment->created_at)->format('Y-m-d') }}</td>
                  <td class="table-cell">
                    <span class="badge badge-{{ strtolower($payment->Payment_Status) === 'paid' ? 'approved' : (strtolower($payment->Payment_Status) === 'pending' ? 'pending' : 'declined') }}">
                      {{ $payment->Payment_Status }}
                    </span>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="12" class="table-cell text-center py-4">No unit application payment records found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
 
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>

<!-- Print Area - Content will be injected here dynamically -->
<div id="print-area" class="printable" style="display:none;">
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  // Make sure everything is wrapped in a DOMContentLoaded event
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize date pickers
    flatpickr("#start-date", {
      dateFormat: "Y-m-d",
      maxDate: "today"
    });
    
    flatpickr("#end-date", {
      dateFormat: "Y-m-d",
      maxDate: "today"
    });
    
    // Tab Functionality - Attach event listeners properly
    const primaryTab = document.getElementById('primary-tab');
    const unitTab = document.getElementById('unit-tab');
    const primaryContent = document.getElementById('primary-content');
    const unitContent = document.getElementById('unit-content');
    
    // Handle tab clicks through event listeners instead of inline onclick
    primaryTab.addEventListener('click', function() {
      showTab('primary');
    });
    
    unitTab.addEventListener('click', function() {
      showTab('unit');
    });
    
    // Tab switching function
    function showTab(tabName) {
      // Hide all content and reset tab styles
      primaryContent.classList.add('hidden');
      unitContent.classList.add('hidden');
      primaryTab.classList.remove('tab-active');
      unitTab.classList.remove('tab-active');
      primaryTab.classList.add('tab-inactive');
      unitTab.classList.add('tab-inactive');
      
      // Show selected content and update tab style
      if (tabName === 'primary') {
        primaryContent.classList.remove('hidden');
        primaryTab.classList.remove('tab-inactive');
        primaryTab.classList.add('tab-active');
      } else {
        unitContent.classList.remove('hidden');
        unitTab.classList.remove('tab-inactive');
        unitTab.classList.add('tab-active');
      }
    }
    
    // Create error handler for chart initialization
    function initializeChartWithErrorHandling(chartId, chartConfig) {
      const canvas = document.getElementById(chartId);
      if (!canvas) {
        console.error(`Canvas element '${chartId}' not found!`);
        return null;
      }
      
      try {
        const ctx = canvas.getContext('2d');
        return new Chart(ctx, chartConfig);
      } catch (error) {
        console.error(`Error initializing chart '${chartId}':`, error);
        const container = canvas.parentElement;
        const errorMsg = document.createElement('div');
        errorMsg.className = 'text-red-500 text-center mt-4';
        errorMsg.textContent = 'Chart failed to load. Please try refreshing the page.';
        container.appendChild(errorMsg);
        return null;
      }
    }
    
    // Store chart instances for updating later
    let statusChart, trendsChart, comparisonChart;
    
    // Filter form submission handler
    document.getElementById('payment-filter-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Show loading spinner
      document.body.classList.add('cursor-wait');
      const loadingEl = document.createElement('div');
      loadingEl.id = 'loading-overlay';
      loadingEl.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
      loadingEl.innerHTML = '<div class="bg-white p-5 rounded-lg shadow-lg">Loading filtered data...</div>';
      document.body.appendChild(loadingEl);
      
      // Get form data
      const formData = new FormData(this);
      const params = new URLSearchParams(formData);
      
      // Fetch filtered data
      fetch(`{{ route('programmes.payments.filter') }}?${params.toString()}`)
        .then(response => {
          if (!response.ok) {
            throw new Error(`Server returned ${response.status}: ${response.statusText}`);
          }
          return response.json().catch(() => {
            // If JSON parsing fails, throw a more specific error
            throw new Error('Invalid response format. Expected JSON but received something else.');
          });
        })
        .then(data => {
          // Update payment summary statistics
          updatePaymentSummary(data);
          
          // Update charts
          updateCharts(data);
          
          // Update tables
          updateTables(data);
          
          // Remove loading overlay
          document.body.classList.remove('cursor-wait');
          document.getElementById('loading-overlay').remove();
        })
        .catch(error => {
          console.error('Error fetching filtered data:', error);
          
          // Show a more user-friendly error message with debugging info
          const errorMessage = `An error occurred while filtering data: ${error.message}.<br><br>
            <small>If this problem persists, please contact the administrator with the following information:<br>
            - Time: ${new Date().toLocaleTimeString()}<br>
            - Error: ${error.message}</small>`;
          
          // Create error notification
          const errorEl = document.createElement('div');
          errorEl.id = 'error-notification';
          errorEl.className = 'fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 max-w-md shadow-md rounded z-50';
          errorEl.innerHTML = `
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm">${errorMessage}</p>
                <div class="mt-4">
                  <button type="button" id="close-error-btn" class="text-sm text-red-700 font-medium hover:underline">
                    Dismiss
                  </button>
                </div>
              </div>
            </div>
          `;
          document.body.appendChild(errorEl);
          
          // Add event listener to close button
          document.getElementById('close-error-btn').addEventListener('click', function() {
            document.getElementById('error-notification').remove();
          });
          
          // Auto-close after 15 seconds
          setTimeout(() => {
            if (document.getElementById('error-notification')) {
              document.getElementById('error-notification').remove();
            }
          }, 15000);
          
          // Remove loading overlay
          document.body.classList.remove('cursor-wait');
          if (document.getElementById('loading-overlay')) {
            document.getElementById('loading-overlay').remove();
          }
        });
    });
    
    // Update payment summary with filtered data
    function updatePaymentSummary(data) {
      document.querySelector('.stat-card:nth-child(1) .text-3xl').textContent = 
        `₦${parseFloat(data.totalPaymentSum).toLocaleString('en-NG', {minimumFractionDigits: 2})}`;
      
      document.querySelector('.stat-card:nth-child(2) .text-3xl').textContent = 
        data.totalPayments;
      
      document.querySelector('.stat-card:nth-child(3) .text-3xl').textContent = 
        `${data.paidPayments} / ${data.pendingPayments}`;
      
      // Update payment type breakdown
      const paymentBreakdown = document.querySelector('.payment-type-breakdown');
      if (paymentBreakdown) {
        document.querySelector('[data-payment="scheme"] .text-xl').textContent = 
          `₦${parseFloat(data.schemeApplicationFeeSum).toLocaleString('en-NG', {minimumFractionDigits: 2})}`;
        
        document.querySelector('[data-payment="site"] .text-xl').textContent = 
          `₦${parseFloat(data.sitePlanFeeSum).toLocaleString('en-NG', {minimumFractionDigits: 2})}`;
        
        document.querySelector('[data-payment="processing"] .text-xl').textContent = 
          `₦${parseFloat(data.processingFeeSum).toLocaleString('en-NG', {minimumFractionDigits: 2})}`;
        
        document.querySelector('[data-payment="betterment"] .text-xl').textContent = 
          `₦${parseFloat(data.bettermentChargesSum).toLocaleString('en-NG', {minimumFractionDigits: 2})}`;
        
        document.querySelector('[data-payment="unit"] .text-xl').textContent = 
          `₦${parseFloat(data.unitApplicationFeesSum).toLocaleString('en-NG', {minimumFractionDigits: 2})}`;
        
        document.querySelector('[data-payment="landuse"] .text-xl').textContent = 
          `₦${parseFloat(data.landUseChargeSum).toLocaleString('en-NG', {minimumFractionDigits: 2})}`;
        
        document.querySelector('[data-payment="penalty"] .text-xl').textContent = 
          `₦${parseFloat(data.penaltyFeesSum).toLocaleString('en-NG', {minimumFractionDigits: 2})}`;
      }
    }
    
    // Update charts with filtered data
    function updateCharts(data) {
      // Status Distribution Chart
      if (statusChart) {
        statusChart.data.datasets[0].data = [data.paidPayments, data.pendingPayments];
        statusChart.update();
      }
      
      // Payment Trends Chart
      if (trendsChart) {
        const months = Object.keys(data.paymentsByMonth);
        const counts = Object.values(data.paymentsByMonth);
        
        trendsChart.data.labels = months;
        trendsChart.data.datasets[0].data = counts;
        trendsChart.update();
      }
      
      // Payment Comparison Chart
      if (comparisonChart) {
        comparisonChart.data.datasets[0].data = [data.primaryTotalSum, data.unitTotalSum];
        comparisonChart.update();
      }
    }
    
    // Update tables with filtered data
    function updateTables(data) {
      // Update primary payments table
      const primaryTable = document.querySelector('#primary-content table tbody');
      if (primaryTable) {
        primaryTable.innerHTML = '';
        
        if (data.primaryPayments.length > 0) {
          data.primaryPayments.forEach(payment => {
            const paymentStatus = payment.Payment_Status ? payment.Payment_Status.toLowerCase() : '';
            const statusClass = paymentStatus === 'paid' || paymentStatus === 'complete' ? 'approved' : 
                               (paymentStatus === 'pending' || paymentStatus === 'incomplete' ? 'pending' : 'declined');
            
            primaryTable.innerHTML += `
              <tr>
                <td class="table-cell">${payment.Sectional_Title_File_No}</td>
                <td class="table-cell">${payment.owner_name}</td>
                <td class="table-cell">₦${parseFloat(payment.Scheme_Application_Fee || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Site_Plan_Fee || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Processing_Fee || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Betterment_Charges || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Land_Use_Charge || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Penalty_Fees || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">${payment.created_at ? new Date(payment.created_at).toISOString().split('T')[0] : ''}</td>
                <td class="table-cell">
                  <span class="badge badge-${statusClass}">
                    ${payment.Payment_Status}
                  </span>
                </td>
              </tr>
            `;
          });
        } else {
          primaryTable.innerHTML = `
            <tr>
              <td colspan="12" class="table-cell text-center py-4">No primary application payment records found</td>
            </tr>
          `;
        }
      }
      
      // Update unit payments table
      const unitTable = document.querySelector('#unit-content table tbody');
      if (unitTable) {
        unitTable.innerHTML = '';
        
        if (data.unitPayments.length > 0) {
          data.unitPayments.forEach(payment => {
            const paymentStatus = payment.Payment_Status ? payment.Payment_Status.toLowerCase() : '';
            const statusClass = paymentStatus === 'paid' || paymentStatus === 'complete' ? 'approved' : 
                              (paymentStatus === 'pending' || paymentStatus === 'incomplete' ? 'pending' : 'declined');
            
            unitTable.innerHTML += `
              <tr>
                <td class="table-cell">${payment.Sectional_Title_File_No}</td>
                <td class="table-cell">${payment.owner_name}</td>
                <td class="table-cell">₦${parseFloat(payment.Scheme_Application_Fee || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Site_Plan_Fee || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Processing_Fee || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Betterment_Charges || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Unit_Application_Fees || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Land_Use_Charge || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">₦${parseFloat(payment.Penalty_Fees || 0).toLocaleString('en-NG', {minimumFractionDigits: 2})}</td>
                <td class="table-cell">${payment.created_at ? new Date(payment.created_at).toISOString().split('T')[0] : ''}</td>
                <td class="table-cell">
                  <span class="badge badge-${statusClass}">
                    ${payment.Payment_Status}
                  </span>
                </td>
              </tr>
            `;
          });
        } else {
          unitTable.innerHTML = `
            <tr>
              <td colspan="12" class="table-cell text-center py-4">No unit application payment records found</td>
            </tr>
          `;
        }
      }
      
      // Update counts in tabs
      document.getElementById('primary-tab').innerHTML = `Primary Applications (${data.primaryPayments.length})`;
      document.getElementById('unit-tab').innerHTML = `Unit Applications (${data.unitPayments.length})`;
    }
    
    try {
      // Chart Data
      const paidCount = {{ $paidPayments ?? 0 }};
      const pendingCount = {{ $pendingPayments ?? 0 }};
      const totalCount = {{ $totalPayments ?? 0 }};
      const primaryTotal = {{ $primaryTotalSum ?? 0 }};
      const unitTotal = {{ $unitTotalSum ?? 0 }};
      
      // Status Distribution Chart (Donut)
      const statusChartConfig = {
        type: 'doughnut',
        data: {
          labels: ['Complete', 'Incomplete'],
          datasets: [{
            data: [paidCount, pendingCount],
            backgroundColor: ['#22c55e', '#f97316'],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
            }
          },
          cutout: '70%'
        }
      };
      statusChart = initializeChartWithErrorHandling('statusChart', statusChartConfig);
      
      // Payment Trends Chart (Line)
      const monthsData = @json($paymentsByMonth ?? []);
      const months = Object.keys(monthsData);
      const counts = Object.values(monthsData);
      
      const trendsChartConfig = {
        type: 'line',
        data: {
          labels: months,
          datasets: [{
            label: 'Payments',
            data: counts,
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.3,
            fill: true
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      };
      trendsChart = initializeChartWithErrorHandling('trendsChart', trendsChartConfig);
      
      // Payment Comparison Chart (Bar)
      const comparisonChartConfig = {
        type: 'bar',
        data: {
          labels: ['Primary Applications', 'Unit Applications'],
          datasets: [{
            label: 'Total Payments (₦)',
            data: [primaryTotal, unitTotal],
            backgroundColor: ['#4ade80', '#60a5fa'],
            borderWidth: 0,
            borderRadius: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return '₦' + context.raw.toLocaleString();
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  return '₦' + value.toLocaleString();
                }
              }
            }
          }
        }
      };
      comparisonChart = initializeChartWithErrorHandling('comparisonChart', comparisonChartConfig);
    } catch (e) {
      console.error('Error initializing charts:', e);
    }
    
    // Filter Functionality
    try {
      document.getElementById('primary-filter').addEventListener('change', function() {
        // Future implementation for filtering
        console.log('Primary filter:', this.value);
      });
      
      document.getElementById('unit-filter').addEventListener('change', function() {
        // Future implementation for filtering
        console.log('Unit filter:', this.value);
      });
    } catch (e) {
      console.error('Error setting up filters:', e);
    }

    // Print functionality - Updated approach
    function createReportHeader(title) {
      return `
        <div class="flex flex-col items-center mb-6">
          <img src="{{ asset('assets/logo/logo3.jpeg') }}" alt="Kano State Coat of Arms" class="w-16 h-16 object-contain mb-2">
          <div class="text-center">
            <p class="font-bold text-sm uppercase">KANO STATE MINISTRY OF LAND AND PHYSICAL PLANNING</p>
            <p class="text-sm">NO 2 DR BALA MUHAMMAD ROAD</p>
            <p class="text-sm">PHYSICAL PLANNING DEPARTMENT.</p>
          </div>
        </div>
        <h1 class="text-2xl font-bold text-center mb-6">${title}</h1>
        <p class="text-right mb-4">Generated on: ${new Date().toLocaleDateString()}</p>
      `;
    }
    
    function showPrintLoading() {
      document.getElementById('print-loading').style.display = 'flex';
    }
    
    function hidePrintLoading() {
      document.getElementById('print-loading').style.display = 'none';
    }
    
    // Print Primary Application Payments
    document.getElementById('print-primary-btn').addEventListener('click', function() {
      showPrintLoading();
      
      setTimeout(function() {
        try {
          const printArea = document.getElementById('print-area');
          const primaryTable = document.querySelector('#primary-content table').cloneNode(true);
          
          // Create content
          printArea.innerHTML = '';
          printArea.innerHTML = createReportHeader('Primary Application Payments Report');
          
          // Apply filter if selected
          const filterValue = document.getElementById('primary-filter').value;
          if (filterValue !== 'all') {
            applyTableFilter(primaryTable, filterValue);
          }
          
          // Add the table to print area
          printArea.appendChild(primaryTable);
          
          // Show print area, hide main content (visually, not with CSS)
          document.getElementById('main-content').style.display = 'none';
          printArea.style.display = 'block';
          
          // Wait a bit to ensure rendering
          setTimeout(function() {
            hidePrintLoading();
            window.print();
            
            // After printing
            printArea.style.display = 'none';
            document.getElementById('main-content').style.display = 'block';
            printArea.innerHTML = '';
          }, 300);
        } catch (e) {
          console.error('Print error:', e);
          hidePrintLoading();
          alert('An error occurred while preparing the document for printing.');
          document.getElementById('main-content').style.display = 'block';
        }
      }, 200);
    });
    
    // Print Unit Application Payments
    document.getElementById('print-unit-btn').addEventListener('click', function() {
      showPrintLoading();
      
      setTimeout(function() {
        try {
          const printArea = document.getElementById('print-area');
          const unitTable = document.querySelector('#unit-content table').cloneNode(true);
          
          // Create content
          printArea.innerHTML = '';
          printArea.innerHTML = createReportHeader('Unit Application Payments Report');
          
          // Apply filter if selected
          const filterValue = document.getElementById('unit-filter').value;
          if (filterValue !== 'all') {
            applyTableFilter(unitTable, filterValue);
          }
          
          // Add the table to print area
          printArea.appendChild(unitTable);
          
          // Show print area, hide main content (visually, not with CSS)
          document.getElementById('main-content').style.display = 'none';
          printArea.style.display = 'block';
          
          // Wait a bit to ensure rendering
          setTimeout(function() {
            hidePrintLoading();
            window.print();
            
            // After printing
            printArea.style.display = 'none';
            document.getElementById('main-content').style.display = 'block';
            printArea.innerHTML = '';
          }, 300);
        } catch (e) {
          console.error('Print error:', e);
          hidePrintLoading();
          alert('An error occurred while preparing the document for printing.');
          document.getElementById('main-content').style.display = 'block';
        }
      }, 200);
    });
    
    // Print Payment Summary (charts and breakdown)
    document.getElementById('print-charts-btn').addEventListener('click', function() {
      showPrintLoading();
      
      setTimeout(function() {
        try {
          const printArea = document.getElementById('print-area');
          
          // Create content
          printArea.innerHTML = '';
          printArea.innerHTML = createReportHeader('Payment Summary Report');
          
          // Copy payment breakdown
          const breakdownDiv = document.querySelector('.bg-white.rounded-md.shadow-sm.border.border-gray-200.p-6.mb-6').cloneNode(true);
          printArea.appendChild(breakdownDiv);
          
          // Create a container for charts
          const chartsContainer = document.createElement('div');
          chartsContainer.className = 'grid grid-cols-1 gap-6 mb-6';
          
          // Get canvas elements and convert to images
          ['statusChart', 'trendsChart', 'comparisonChart'].forEach(function(chartId) {
            try {
              const canvas = document.getElementById(chartId);
              const chartContainer = document.createElement('div');
              chartContainer.className = 'mb-6';
              
              // Add chart title
              const title = document.createElement('h3');
              title.className = 'text-lg font-semibold mb-4';
              title.textContent = canvas.closest('.bg-white').querySelector('h3').textContent;
              chartContainer.appendChild(title);
              
              // Convert canvas to image
              const img = document.createElement('img');
              img.src = canvas.toDataURL('image/png');
              img.style.width = '100%';
              img.style.maxWidth = '500px';
              img.style.margin = '0 auto';
              img.style.display = 'block';
              chartContainer.appendChild(img);
              
              chartsContainer.appendChild(chartContainer);
            } catch (err) {
              console.error(`Error processing chart ${chartId}:`, err);
            }
          });
          
          // Add charts to print area
          printArea.appendChild(chartsContainer);
          
          // Show print area, hide main content (visually, not with CSS)
          document.getElementById('main-content').style.display = 'none';
          printArea.style.display = 'block';
          
          // Wait a bit to ensure rendering
          setTimeout(function() {
            hidePrintLoading();
            window.print();
            
            // After printing
            printArea.style.display = 'none';
            document.getElementById('main-content').style.display = 'block';
            printArea.innerHTML = '';
          }, 300);
        } catch (e) {
          console.error('Print error:', e);
          hidePrintLoading();
          alert('An error occurred while preparing the charts for printing.');
          document.getElementById('main-content').style.display = 'block';
        }
      }, 200);
    });
    
    // Filter function for tables when printing
    function applyTableFilter(table, filterValue) {
      const rows = table.querySelectorAll('tbody tr');
      rows.forEach(row => {
        const statusCell = row.querySelector('td:last-child');
        if (!statusCell) return;
        
        const status = statusCell.textContent.trim().toLowerCase();
        const matchesPaid = (filterValue === 'paid' && (status === 'paid' || status === 'complete'));
        const matchesPending = (filterValue === 'pending' && (status === 'pending' || status === 'incomplete'));
        const matchesOverdue = (filterValue === 'overdue' && status === 'overdue');
        
        if (filterValue !== 'all' && !matchesPaid && !matchesPending && !matchesOverdue) {
          row.style.display = 'none';
        } else {
          row.style.display = '';
        }
      });
    }
  });
</script>
@endsection


