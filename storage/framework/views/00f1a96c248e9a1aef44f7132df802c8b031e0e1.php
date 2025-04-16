<div class="flex-1 overflow-y-auto p-2 space-y-1">
  <div class="sidebar-item active">
    <i data-lucide="layout-dashboard" class="sidebar-icon text-blue-500"></i>
    <div class="flex-1">
    <span class="font-medium">1. DASHBOARD</span>
    </div>
    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
  </div>
  
  <div class="sidebar-item">
    <i data-lucide="users" class="sidebar-icon text-green-500"></i>
    <div class="flex-1">
    <span class="font-medium">2. CUSTOMER MANAGEMENT</span>
    </div>
    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
  </div>
  
  <div class="sidebar-item has-submenu">
    <i data-lucide="book-open" class="sidebar-icon text-purple-500"></i>
    <div class="flex-1">
    <span class="font-medium">3. PROGRAMMES</span>
    </div>
    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400 submenu-toggle"></i>
  </div>
  <div class="submenu hidden space-y-1">
    <div class="submenu-item">
      <i data-lucide="grid" class="w-4 h-4 mr-2 text-red-500"></i>
      <span>Allocation</span>
      <i data-lucide="chevron-right" class="w-4 h-4 ml-auto text-gray-400"></i>
    </div>
    
    <div class="submenu-item">
      <i data-lucide="home" class="w-4 h-4 mr-2 text-orange-500"></i>
      <span>Resettlement</span>
      <i data-lucide="chevron-right" class="w-4 h-4 ml-auto text-gray-400"></i>
    </div>
    
    <div class="submenu-item">
      <i data-lucide="refresh-cw" class="w-4 h-4 mr-2 text-teal-500"></i>
      <span>Recertification</span>
    </div>
    
    <div class="submenu-item">
      <i data-lucide="file-text" class="w-4 h-4 mr-2 text-pink-500"></i>
      <span>SLTR / First Registration</span>
    </div>
    
    <div class="submenu-item">
      <i data-lucide="repeat" class="w-4 h-4 mr-2 text-indigo-500"></i>
      <span>Regularization / Conversion</span>
    </div>
    
    <div class="submenu-item active">
      <a href="<?php echo e(route('sectionaltitling.index')); ?>" class="flex items-center">
      <i data-lucide="layout-grid" class="w-4 h-4 mr-2 text-blue-500"></i>
      <span>Sectional Titling</span>
      <span class="ml-2 px-2 py-0.5 bg-yellow-100 text-yellow-800 text-xs rounded">Active</span>
      </a>
    </div>
    <div class="submenu-item">
      <i data-lucide="map" class="w-4 h-4 mr-2 text-green-500"></i>
      <span>GIS Mapping</span>
    </div>
    
    <div class="submenu-item">
      <i data-lucide="clipboard-list" class="w-4 h-4 mr-2 text-gray-500"></i>
      <span>Land Property Enumeration</span>
    </div>
    </div>

  <div class="sidebar-item">
    <i data-lucide="file-text" class="sidebar-icon text-red-500"></i>
    <div class="flex-1">
    <span class="font-medium">4. INFORMATION PRODUCTS</span>
    </div>
    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
  </div>
  
  <div class="sidebar-item">
    <i data-lucide="clipboard-list" class="sidebar-icon text-yellow-500"></i>
    <div class="flex-1">
    <span class="font-medium">5. INSTRUMENT REGISTRATION</span>
    </div>
    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
  </div>
  
  <div class="sidebar-item">
    <i data-lucide="folder-archive" class="sidebar-icon text-purple-500"></i>
    <div class="flex-1">
    <span class="font-medium">6. FILE DIGITAL REGISTRY</span>
    </div>
    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
  </div>
  
  <div class="sidebar-item">
    <i data-lucide="shield" class="sidebar-icon text-pink-700"></i>
    <div class="flex-1">
    <span class="font-medium">7. SYSTEMS</span>
    </div>
    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
  </div>
  
  <div class="sidebar-item">
    <i data-lucide="history" class="sidebar-icon text-rose-950"></i>
    <div class="flex-1">
    <span class="font-medium">8. LEGACY SYSTEMS</span>
    </div>
    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
  </div>
  
  <div class="sidebar-item">
    <i data-lucide="settings" class="sidebar-icon text-blue-700"></i>
    <div class="flex-1">
    <span class="font-medium">9. SYSTEM ADMIN</span>
    </div>
    <i data-lucide="chevron-right" class="w-4 h-4 text-violet-900"></i>
  </div>
  </div>

  <!-- User Profile -->
  <div class="border-t border-gray-200 p-4">
  <div class="flex items-center">
    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
    <i data-lucide="user" class="w-5 h-5 text-gray-500"></i>
    </div>
    <div class="flex-1">
    <div class="font-medium">Admin User</div>
    <div class="text-xs text-gray-500"><?php echo e(auth()->user()->email); ?></div>
    </div>
    <div class="text-gray-400">
    <i data-lucide="settings" class="w-4 h-4"></i>
    </div>
  </div>
  </div>
</div>
<?php /**PATH C:\wamp64\www\gisedms\resources\views/admin/menu.blade.php ENDPATH**/ ?>