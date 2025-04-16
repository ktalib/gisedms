

<div class="p-6 bg-white border-b border-gray-200">
    <div class="flex justify-between items-center">
      <div>
        <h1 class="text-2xl font-bold"><?php echo e($PageTitle); ?></h1>
        <p class="text-gray-500"><?php echo e($PageDescription); ?></p>
      </div>
      <div class="flex items-center space-x-4">
        <div class="relative">
          <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
          <input
            type="text"
            placeholder="Search applications..."
            class="pl-10 pr-4 py-2 border border-gray-200 rounded-md w-64 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
        <div class="relative">
          <i data-lucide="bell" class="w-5 h-5"></i>
          <span class="absolute -top-1 -right-1 bg-orange-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
            2
          </span>
        </div>
      </div>
    </div>
  </div>
<?php /**PATH C:\wamp64\www\gisedms\resources\views/admin/header.blade.php ENDPATH**/ ?>