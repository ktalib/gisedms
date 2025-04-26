<div class="grid grid-cols-3 gap-4 mb-6">
   <div class="stat-card">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-gray-600 font-medium">Total Payments</h3>
        <i data-lucide="credit-card" class="text-gray-400 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold">₦{{ number_format($totalPaymentSum ?? 0, 2) }}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="info" class="text-blue-500 w-4 h-4 mr-1"></i>
        <span class="text-blue-500">All payment fields combined</span>
      </div>
    </div>
    
   <div class="stat-card">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-gray-600 font-medium">Total Records</h3>
        <i data-lucide="file-text" class="text-gray-400 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold">{{ $totalPayments }}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="info" class="text-blue-500 w-4 h-4 mr-1"></i>
        <span class="text-blue-500">Payment records in system</span>
      </div>
    </div>
    
   <div class="stat-card">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-gray-600 font-medium">Payment Status</h3>
        <i data-lucide="check-circle" class="text-gray-400 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold">{{ $paidPayments }} / {{ $pendingPayments }}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="info" class="text-blue-500 w-4 h-4 mr-1"></i>
        <span class="text-blue-500">Complete / Incomplete payments</span>
      </div>
    </div>
</div>

<!-- Payment Type Breakdown -->
<div class="bg-white rounded-md shadow-sm border border-gray-200 p-6 mb-6">
  <h3 class="text-lg font-semibold mb-4">Payment Type Breakdown</h3>
  
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 payment-type-breakdown">
    <div class="p-4 border rounded-md" data-payment="scheme">
      <div class="text-sm text-gray-600 mb-1">Scheme Application Fee</div>
      <div class="text-xl font-bold">₦{{ number_format($schemeApplicationFeeSum ?? 0, 2) }}</div>
    </div>
    
    <div class="p-4 border rounded-md" data-payment="site">
      <div class="text-sm text-gray-600 mb-1">Site Plan Fee</div>
      <div class="text-xl font-bold">₦{{ number_format($sitePlanFeeSum ?? 0, 2) }}</div>
    </div>
    
    <div class="p-4 border rounded-md" data-payment="processing">
      <div class="text-sm text-gray-600 mb-1">Processing Fee</div>
      <div class="text-xl font-bold">₦{{ number_format($processingFeeSum ?? 0, 2) }}</div>
    </div>
    
    <div class="p-4 border rounded-md" data-payment="betterment">
      <div class="text-sm text-gray-600 mb-1">Betterment Charges</div>
      <div class="text-xl font-bold">₦{{ number_format($bettermentChargesSum ?? 0, 2) }}</div>
    </div>
    
    <div class="p-4 border rounded-md" data-payment="unit">
      <div class="text-sm text-gray-600 mb-1">Unit Application Fees</div>
      <div class="text-xl font-bold">₦{{ number_format($unitApplicationFeesSum ?? 0, 2) }}</div>
    </div>
    
    <div class="p-4 border rounded-md" data-payment="landuse">
      <div class="text-sm text-gray-600 mb-1">Land Use Charge</div>
      <div class="text-xl font-bold">₦{{ number_format($landUseChargeSum ?? 0, 2) }}</div>
    </div>
    
    <div class="p-4 border rounded-md" data-payment="penalty">
      <div class="text-sm text-gray-600 mb-1">Penalty Fees</div>
      <div class="text-xl font-bold">₦{{ number_format($penaltyFeesSum ?? 0, 2) }}</div>
    </div>
  </div>
</div>
