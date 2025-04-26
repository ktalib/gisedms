<style>
  .sidebar {
    width: 280px;
    height: 100vh;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }
  
  .sidebar-content {
    flex: 1;
    overflow-y: auto;
    height: calc(100vh - 8rem);
  }
  
  .sidebar-content::-webkit-scrollbar {
    width: 4px;
  }
  
  .sidebar-content::-webkit-scrollbar-track {
    background: transparent;
  }
  
  .sidebar-content::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 10px;
  }
  
  .active {
    font-weight: 500;
    background-color: #EBF5FF;
    border-left: 4px solid #3B82F6;
  }
  
  .sidebar-badge {
    font-size: 0.65rem;
    padding: 0.1rem 0.4rem;
    border-radius: 9999px;
    background-color: #E5E7EB;
    color: #374151;
  }
  
  .module-badge-programmes {
    background-color: #DBEAFE;
    color: #1E40AF;
  }
  
  .module-badge-legal-search {
    background-color: #DCFCE7;
    color: #166534;
  }
  
  .module-badge-instrument {
    background-color: #FEF3C7;
    color: #92400E;
  }
  
  .sidebar-item {
    transition: all 0.2s;
  }
  
  .sidebar-item:hover {
    background-color: #F9FAFB;
  }
  
  .animate-ping {
    animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
  }
  
  @keyframes ping {
    75%, 100% {
      transform: scale(2);
      opacity: 0;
    }
  }
  
  /* Module icon colors for different sections */
  .module-icon-dashboard {
    opacity: 0.8;
    color: #2563eb; /* Blue */
  }
  
  .module-icon-customer {
    opacity: 0.8;
    color: #7c3aed; /* Purple */
  }
  
  .module-icon-programmes {
    opacity: 0.8;
    color: #059669; /* Green */
  }
  
  .module-icon-info-products {
    opacity: 0.8;
    color: #d97706; /* Orange */
  }
  
  .module-icon-legal-search {
    opacity: 0.8;
    color: #0891b2; /* Teal */
  }
  
  .module-icon-instrument {
    opacity: 0.8;
    color: #002f64; /* Red */
  }
  
  .module-icon-file-registry {
    opacity: 0.8;
    color: #4f46e5; /* Indigo */
  }
  
  .module-icon-systems {
    opacity: 0.8;
    color: #db2777; /* Pink */
  }
  
  .module-icon-legacy {
    opacity: 0.8;
    color: #92400e; /* Brown */
  }
  
  .module-icon-admin {
    opacity: 0.8;
    color: #4b5563; /* Gray */
  }
  
  /* Nested submenu styles */
  .submenu-l1 {
    padding-left: 1.5rem;
  }
  
  .submenu-l2 {
    padding-left: 2.5rem;
  }
  
  .submenu-l3 {
    padding-left: 3.5rem;
  }
  
  .submenu-item {
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
    display: flex;
    align-items: center;
    border-radius: 0.375rem;
    transition: all 0.2s;
  }
  
  .submenu-item:hover {
    background-color: #F9FAFB;
  }
  
  .submenu-item.active {
    font-weight: 500;
    background-color: #EBF5FF;
    border-left: 4px solid #3B82F6;
  }
</style>
<style>

  

  .stat-card {
    background-color: white;
    border-radius: 0.375rem;
    padding: 1.25rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
  }
  .tab {
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: all 0.2s;
    border-bottom: 2px solid transparent;
  }
  .tab:hover {
    color: #4b5563;
  }
  .tab.active {
    color: #3b82f6;
    border-bottom-color: #3b82f6;
  }
  .service-card {
    background-color: white;
    border-radius: 0.375rem;
    padding: 1.5rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
  }
  .badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 500;
  }
  .badge-primary {
    background-color: #f3f4f6;
    color: #4b5563;
  }
  .badge-progress {
    background-color: #dbeafe;
    color: #2563eb;
  }
  .badge-approved {
    background-color: #d1fae5;
    color: #059669;
  }
  .badge-pending {
    background-color: #fef3c7;
    color: #d97706;
  }
  .progress-bar {
    height: 8px;
    border-radius: 4px;
    background-color: #e5e7eb;
    overflow: hidden;
  }
  .progress-bar-fill {
    height: 100%;
    border-radius: 4px;
  }
  .progress-bar-blue {
    background-color: #3b82f6;
  }
  .progress-bar-orange {
    background-color: #f59e0b;
  }
  .progress-bar-red {
    background-color: #ef4444;
  }
  .table-header {
    background-color: #f9fafb;
    font-weight: 500;
    color: #4b5563;
    text-align: left;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #e5e7eb;
  }
  .table-cell {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #e5e7eb;
  }
</style>

<div class="sidebar border-r border-gray-200 bg-white">
  <!-- Sidebar Header -->
  <div class="sidebar-header border-b border-gray-200 h-16 flex items-center px-6 bg-gradient-to-r from-white via-blue-100 to-purple-200">
    <div class="flex items-center gap-2">
      <div class="relative">
        <img
          src="{{ asset('storage/upload/logo/logo.png') }}"
          alt="KLAS Logo"
          class="h-10 w-auto object-contain rounded"
        />
  
      </div>
      
    </div>
  </div>

  <!-- Sidebar Content -->
  <div class="sidebar-content p-2">
    <!-- 1. Dashboard -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="dashboard">
        <div class="flex items-center gap-2">
          <i data-lucide="layout-dashboard" class="h-5 w-5 "></i>
          <span class="text-sm font-bold uppercase tracking-wider">1. Dashboard</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="dashboard"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="dashboard">
        <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <i data-lucide="home" class="h-4 w-4 "></i>
          <span>Dashboard</span>
        </a>
      </div>
    </div>

    <!-- 2. Customer Management -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="customer">
        <div class="flex items-center gap-2">
          <i data-lucide="user-plus" class="h-6 w-6 module-icon-customer module-icon-dashboard"></i>
          <span class="text-sm font-bold uppercase tracking-wider">2. Customer Management</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="customer"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="customer">
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="person">
          <span>Person</span>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="person"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="person">
          <a href="/person/individual" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="user-circle" class="h-3.5 w-3.5"></i>
            <span>Individual</span>
          </a>
          <a href="/person/group" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="users" class="h-3.5 w-3.5"></i>
            <span>Group</span>
          </a>
          <a href="/person/family" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="users-2" class="h-3.5 w-3.5"></i>
            <span>Family</span>
          </a>
          <a href="/person/corporate" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="building" class="h-3.5 w-3.5"></i>
            <span>Corporate</span>
          </a>
        </div>

        <a href="/customer-manager" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="user-cog" class="h-4 w-4  "></i>
          <span>Customer Manager</span>
        </a>
        <a href="/appointment" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="calendar-clock" class="h-4 w-4  "></i>
          <span>Appointment</span>
        </a>
        <a href="/appointment-calendar" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="calendar" class="h-4 w-4  "></i>
          <span>Appointment Calendar</span>
        </a>
      </div>
    </div>

    <!-- 3. Programmes -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="programmes">
        <div class="flex items-center gap-2">
          <i data-lucide="briefcase" class="h-5 w-5 module-icon-programmes"></i>
          <span class="text-sm font-bold uppercase tracking-wider">3. Programmes</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="programmes"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="programmes">
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="allocation">
          <div class="flex items-center gap-2">
            <i data-lucide="building" class="h-4 w-"></i>
            <span>Allocation</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="allocation"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="allocation">
          <a href="/programmes/allocation/governors-list" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <span>Governors List</span>
          </a>
          <a href="/programmes/allocation/commissioners-list" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <span>Commissioners List</span>
          </a>
        </div>

        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="resettlement">
          <div class="flex items-center gap-2">
            <i data-lucide="home" class="h-4 w-4 "></i>
            <span>Resettlement</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="resettlement"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="resettlement">
          <a href="/programmes/resettlement/governors-list" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <span>Governors List</span>
          </a>
          <a href="/programmes/resettlement/commissioners-list" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <span>Commissioners List</span>
          </a>
        </div>

        <a href="/programmes/recertification" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-cog" class="h-4 w-4 "></i>
          <span>Recertification</span>
        </a>
        <a href="/programmes/sltr" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-search" class="h-4 w-4 "></i>
          <span>SLTR / First Registration</span>
        </a>
        <a href="/programmes/regularization" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-up" class="h-4 w-4 "></i>
          <span>Regularization / Conversion</span>
        </a>
        
        <!-- Modified Sectional Titling Section -->
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="sectionalTitling">
          <div class="flex items-center gap-2">
            <i data-lucide="building-2" class="h-4 w-4 "></i>
            <span>Sectional Titling</span>
            
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="sectionalTitling"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="sectionalTitling">
          <a href="{{ route('sectionaltitling.primary') }}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200  {{ request()->routeIs('sectionaltitling.primary') ? 'active' : '' }}">
            <i data-lucide="file-plus" class="h-3.5 w-3.5"></i>
            <span> Primary Application</span>
          </a>
          <a href="{{ route('sectionaltitling.secondary') }}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('sectionaltitling.secondary') ? 'active' : '' }}">
            <i data-lucide="file-plus-2" class="h-3.5 w-3.5"></i>
            <span>Unit Application</span>
          </a>
          <a href="{{route("programmes.field-data")}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="clipboard-list" class="h-3.5 w-3.5"></i>
            <span> Field Data</span>
          </a>
          <a href="{{route('programmes.payments')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.payments') ? 'active' : '' }}">
            <i data-lucide="credit-card" class="h-3.5 w-3.5"></i>
            <span> Payments</span>
          </a>
          
          <!-- Approvals at same level -->
          <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="approvals">
            <div class="flex items-center gap-2">
              <i data-lucide="check-circle" class="h-3.5 w-3.5"></i>
              <span> Approvals</span>
            </div>
            <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="approvals"></i>
          </div>
          
          <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="approvals">
            <a href="{{route('programmes.approvals.other-departments')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.approvals.other-departments') ? 'active' : '' }}">
              <i data-lucide="building-2" class="h-3.5 w-3.5"></i>
              <span> Other Departments</span>
            </a>
            <a href="{{route('programmes.approvals.planning_recomm')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.approvals.planning_recomm') ? 'active' : '' }}">
              <i data-lucide="clipboard-check" class="h-3.5 w-3.5"></i>
              <span>Planning Recommendation</span>
            </a>
            <a href="{{route('programmes.approvals.director')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.approvals.director') ? 'active' : '' }}">
              <i data-lucide="stamp" class="h-3.5 w-3.5"></i>
              <span> Director's Approval</span>
            </a>
          </div>
          
          <!-- e-Registry at same level -->
          <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="eRegistry">
            <div class="flex items-center gap-2">
              <i data-lucide="database" class="h-3.5 w-3.5"></i>
              <span> e-Registry</span>
            </div>
            <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="eRegistry"></i>
          </div>
          
          <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="eRegistry">
            <a href="/sectional-titling/e-registry/files" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
              <i data-lucide="folder" class="h-3.5 w-3.5"></i>
              <span>Files</span>
            </a>
            <a href="{{route('programmes.certificates')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.certificates') ? 'active' : '' }}">
              <i data-lucide="file-cog" class="h-4 w-4 "></i>
              <span> Certificate</span>
            </a>
          </div>
          
          <!-- Reports at same level -->
          <a href="{{route('programmes.report')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.report') ? 'active' : '' }}">
            <i data-lucide="file-bar-chart" class="h-3.5 w-3.5"></i>
            <span>ST Reports</span>
          </a>
          
          <!-- GIS at same level -->
          <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="gis">
            <div class="flex items-center gap-2">
              <i data-lucide="map" class="h-3.5 w-3.5"></i>
              <span> GIS</span>
            </div>
            <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="gis"></i>
          </div>
          
          <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="gis">
            <a href="/sectional-titling/gis/system" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
              <i data-lucide="server" class="h-3.5 w-3.5"></i>
              <span> System</span>
            </a>
            <a href="{{ route('map.index') }}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('map.index') ? 'active' : '' }}">
              <i data-lucide="map-pin" class="h-3.5 w-3.5"></i>
              <span> Map</span>
            </a>
          </div>
        </div>
        
        <a href="/programmes/enumeration" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-down" class="h-4 w-4 "></i>
          <span>Land Property Enumeration</span>
        </a>
      </div>
    </div>

    <!-- 4. Information Products -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="infoProducts">
        <div class="flex items-center gap-2"> 
          <i data-lucide="file-output" class="6-5 w-6 module-icon-info-products "></i>
          <span class="text-sm font-bold uppercase tracking-wider">4. Information Products</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="infoProducts"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="infoProducts">
        <a href="/documents/letter-of-administration" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-plus-2" class="h-4 w-4 "></i>
          <span>Letter of Administration / Grant / Offer Letter</span>
        </a>
        <a href="/documents/occupancy-permit" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-warning" class="h-4 w-4 "></i>
          <span>Occupancy Permit (OP)</span>
        </a>
        <a href="/documents/site-plan" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-text" class="h-4 w-4 "></i>
          <span>Site Plan / Parcel Plan</span>
        </a>
        <a href="/documents/right-of-occupancy" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-check" class="h-4 w-4 "></i>
          <span>Right of Occupancy</span>
        </a>
        <a href="/documents/certificate-of-occupancy" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-text" class="h-4 w-4 "></i>
          <span>Certificate of Occupancy</span>
        </a>
      </div>
    </div>

    <!-- 5. Digital Legal Search -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="legalSearch">
        <div class="flex items-center gap-2"> 
          <i data-lucide="file-search" class="h-6 w-6 module-icon-legal-search"></i>
          <span class="text-sm font-bold uppercase tracking-wider">5. Digital Legal Search</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="legalSearch"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="legalSearch">
        <a href="/legal-search/online" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="globe" class="h-4 w-4 "></i>
          <span>Online Search</span>
          <span class="ml-auto text-xs px-1.5 py-0.5 rounded-full sidebar-badge module-badge-legal-search">
            New
          </span>
        </a>
        <a href="/legal-search/on-premise" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="building" class="h-4 w-4 "></i>
          <span>On-Premise Search</span>
        </a>
      </div>
    </div>

    <!-- 6. Instrument Registration -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="instrument">
        <div class="flex items-center gap-2">  
          <i data-lucide="book-open" class="h-6 w-6 module-icon-instrument"></i>
          <span class="text-sm font-bold uppercase tracking-wider">6. Instrument Registration</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="instrument"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="instrument">
        <a href="/instrument-registration" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="book-open" class="h-4 w-4 "></i>
          <span>Instrument Registration</span>
          <span class="ml-auto text-xs px-1.5 py-0.5 rounded-full sidebar-badge module-badge-instrument">
            5
          </span>
        </a>
      </div>
    </div>

    <!-- 7. File Digital Registry -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="fileRegistry">
        <div class="flex items-center gap-2">
          <i data-lucide="file-input" class="h-5 w-5 "></i>
          <span class="text-sm font-bold uppercase tracking-wider">7. File Digital Registry</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="fileRegistry"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="fileRegistry">
        <a href="/file-digital-registry/archive" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-archive" class="h-4 w-4 module-icon-file-registry"></i>
          <span>File Digital Archive</span>
        </a>
        <a href="/file-digital-registry/tracker" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-search" class="h-4 w-4 "></i>
          <span>File Tracker / Tracking</span>
        </a>

        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="indexing">
          <div class="flex items-center gap-2">
            <i data-lucide="file-text" class="h-4 w-4 "></i>
            <span>Indexing</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="indexing"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="indexing">
          <a href="/file-digital-registry/indexing-assistant" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <span>File Indexing Assistant</span>
          </a>
          <a href="/file-digital-registry/print-labels" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <span>Print File Labels</span>
          </a>
        </div> 

        <a href="/file-digital-registry/scanning" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-digit" class="h-4 w-4 "></i>
          <span>Scanning</span>
        </a>
        <a href="/file-digital-registry/upload" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-up" class="h-4 w-4 "></i>
          <span>Upload</span>
        </a>
        <a href="/file-digital-registry/download" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-down" class="h-4 w-4 "></i>
          <span>Download</span>
        </a>
        <a href="/file-digital-registry/page-typing" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-text" class="h-4 w-4 "></i>
          <span>Page Typing</span>
        </a>
      </div>
    </div>

    <!-- 8. Systems -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="systems">
        <div class="flex items-center gap-2"> 
          <i data-lucide="shield" class="h-5 w-5 module-icon-systems"></i>
          <span class="text-sm font-bold uppercase tracking-wider">8. Systems</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="systems"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="systems">
        <a href="/systems/caveat" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="shield-alert" class="h-4 w-4 "></i>
          <span>Caveat</span>
        </a>
        <a href="/systems/encumbrance" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="lock" class="h-4 w-4 "></i>
          <span>Encumbrance</span>
        </a>
      </div>
    </div>

    <!-- 9. Legacy Systems -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="legacy">
        <div class="flex items-center gap-2">
          <i data-lucide="hard-drive" class="h-5 w-5 "></i>
          <span class="text-sm font-bold uppercase tracking-wider">9. Legacy Systems</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="legacy"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="legacy">
        <a href="/legacy-systems" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="database" class="h-4 w-4 "></i>
          <span>Legacy Systems</span>
        </a>
      </div>
    </div>

    <!-- 10. System Admin -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="admin">
        <div class="flex items-center gap-2"> 
          <i data-lucide="cog" class="h-5 w-5 module-icon-admin"></i>
          <span class="text-sm font-bold uppercase tracking-wider">10. System Admin</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="admin"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="admin">
        <a href="/admin/user-account" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="user-cog" class="h-4 w-4 "></i>
          <span>User Account</span>
        </a>
        <a href="/admin/system-settings" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="settings" class="h-4 w-4 "></i>
          <span>System Settings</span>
        </a>
      </div>
    </div>
  </div>

  <!-- Sidebar Footer -->
  <div class="sidebar-footer border-t border-gray-200 p-4">
    <div class="flex items-center gap-3">
      <div class="relative">
        <div class="h-10 w-10 rounded-full border-2 border-blue-600 cursor-pointer hover:scale-105 transition-transform overflow-hidden">
          <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740" alt="User" class="h-full w-full object-cover" />
        </div>
      </div>
      <div class="flex flex-col">
        <span class="text-sm font-medium">Admin User</span>
        <span class="text-xs text-gray-500">admin@kangis.gov</span>
      </div>
      <div class="relative ml-auto">
        <button class="p-1.5 rounded-md hover:bg-gray-100" id="userMenuButton">
          <i data-lucide="settings" class="h-4 w-4"></i>
        </button>
        <div class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" id="userMenu">
          <div class="py-1">
            <div class="px-4 py-2 text-sm font-medium border-b border-gray-100">My Account</div>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              <div class="flex items-center">
                <i data-lucide="user-circle" class="mr-2 h-4 w-4"></i>
                <span>Profile</span>
              </div>
            </a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              <div class="flex items-center">
                <i data-lucide="settings" class="mr-2 h-4 w-4"></i>
                <span>Settings</span>
              </div>
            </a>
            <div class="border-t border-gray-100"></div>
            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
              <div class="flex items-center">
                <i data-lucide="lock" class="mr-2 h-4 w-4"></i>
                <span>Logout</span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  // Initialize Lucide icons
  lucide.createIcons();
  
  // Toggle modules and sections
  document.addEventListener('DOMContentLoaded', function() {
    // Set dashboard as open by default
    toggleModule('dashboard');
    
    // Open Programmes and Sectional Titling by default
    toggleModule('programmes');
    setTimeout(() => {
      toggleSection('sectionalTitling');
    }, 100);
    
    // Module toggle handlers
    const moduleHeaders = document.querySelectorAll('[data-module]');
    moduleHeaders.forEach(header => {
      header.addEventListener('click', function() {
        const moduleName = this.getAttribute('data-module');
        toggleModule(moduleName);
      });
    });
    
    // Section toggle handlers
    const sectionHeaders = document.querySelectorAll('[data-section]');
    sectionHeaders.forEach(header => {
      header.addEventListener('click', function(e) {
        e.stopPropagation();
        const sectionName = this.getAttribute('data-section');
        toggleSection(sectionName);
      });
    });
    
    // User menu toggle
    const userMenuButton = document.getElementById('userMenuButton');
    const userMenu = document.getElementById('userMenu');
    
    userMenuButton.addEventListener('click', function() {
      userMenu.classList.toggle('hidden');
    });
    
    // Close user menu when clicking outside
    document.addEventListener('click', function(e) {
      if (!userMenuButton.contains(e.target) && !userMenu.contains(e.target)) {
        userMenu.classList.add('hidden');
      }
    });
  });
  
  function toggleModule(moduleName) {
    const content = document.querySelector(`[data-content="${moduleName}"]`);
    const chevron = document.querySelector(`[data-chevron="${moduleName}"]`);
    
    if (content.classList.contains('hidden')) {
      content.classList.remove('hidden');
      chevron.classList.add('rotate-90');
    } else {
      content.classList.add('hidden');
      chevron.classList.remove('rotate-90');
    }
  }
  
  function toggleSection(sectionName) {
    const content = document.querySelector(`[data-content="${sectionName}"]`);
    const chevron = document.querySelector(`[data-chevron="${sectionName}"]`);
    
    if (content.classList.contains('hidden')) {
      content.classList.remove('hidden');
      chevron.classList.add('rotate-90');
    } else {
      content.classList.add('hidden');
      chevron.classList.remove('rotate-90');
    }
  }
</script>