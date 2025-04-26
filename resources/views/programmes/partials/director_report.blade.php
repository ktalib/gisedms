<div class="bg-white rounded-md shadow-sm border border-gray-200 p-6 mb-6">
  <h3 class="text-lg font-semibold mb-4">Director's Approvals Status Breakdown</h3>
  <div class="grid grid-cols-3 gap-4 mb-6">
 
    <div class="stat-card border-l-4 border-green-500 pl-3">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-gray-600 font-medium">Approved </h3>
        <i data-lucide="file-text" class="text-green-500 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold text-green-600"> {{ $approvedPrimaryApplications }}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="info" class="text-green-500 w-4 h-4 mr-1"></i>
      </div>
    </div>

    <div class="stat-card border-l-4 border-red-500 pl-3">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-gray-600 font-medium">Declined </h3>
        <i data-lucide="file-text" class="text-red-500 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold text-red-600">{{ $rejectedPrimaryApplications }}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="info" class="text-red-500 w-4 h-4 mr-1"></i>
      </div>
    </div>

    <div class="stat-card border-l-4 border-amber-500 pl-3">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-gray-600 font-medium">Pending</h3>
        <i data-lucide="file-text" class="text-amber-500 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold text-amber-600">{{ $pendingPrimaryApplications }}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="info" class="text-amber-500 w-4 h-4 mr-1"></i>
      </div>
    </div>
  </div>
</div>
