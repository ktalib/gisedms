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
    <!-- 0. Dashboard -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="dashboard">
        <div class="flex items-center gap-2">
          <i data-lucide="layout-dashboard" class="h-5 w-5 text-blue-600"></i>
          <span class="text-sm font-bold uppercase tracking-wider">0. Dashboard</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="dashboard"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="dashboard">
        <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <i data-lucide="home" class="h-4 w-4 text-blue-500"></i>
          <span>Dashboard</span>
        </a>
      </div>
    </div>

    <!-- 1. Customer Relationship Management -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="customer">
        <div class="flex items-center gap-2">
          <i data-lucide="user-plus" class="h-6 w-6 module-icon-customer text-green-600"></i>
          <span class="text-sm font-bold uppercase tracking-wider">1. Customer Relationship Management</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="customer"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="customer">
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="person">
          <div class="flex items-center gap-2">
            <i data-lucide="users" class="h-4 w-4 text-green-500"></i>
            <span>Person</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="person"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="person">
          <a href="/person/individual" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="user-circle" class="h-3.5 w-3.5 text-green-400"></i>
            <span>Individual</span>
          </a>
          <a href="/person/group" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="users" class="h-3.5 w-3.5 text-green-400"></i>
            <span>Group</span>
          </a>
          <a href="/person/family" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="users-2" class="h-3.5 w-3.5 text-green-400"></i>
            <span>Family</span>
          </a>
        </div>

        <a href="/person/corporate" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="building" class="h-4 w-4 text-green-500"></i>
          <span>Corporate</span>
        </a>
        <a href="/customer-manager" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="user-cog" class="h-4 w-4 text-green-500"></i>
          <span>Customer Manager</span>
        </a>
        <a href="/appointment" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="calendar-clock" class="h-4 w-4 text-green-500"></i>
          <span>Appointment</span>
        </a>
        <a href="/appointment-calendar" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="calendar" class="h-4 w-4 text-green-500"></i>
          <span>Appointment Calendar</span>
        </a>
      </div>
    </div>

    <!-- 2. Programmes -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="programmes">
        <div class="flex items-center gap-2">
          <i data-lucide="briefcase" class="h-5 w-5 module-icon-programmes text-purple-600"></i>
          <span class="text-sm font-bold uppercase tracking-wider">2. Programmes</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="programmes"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="programmes">
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="allocation">
          <div class="flex items-center gap-2">
            <i data-lucide="building" class="h-4 w-4 text-purple-500"></i>
            <span>Allocation</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="allocation"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="allocation">
          <a href="/programmes/allocation/governors-list" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="list" class="h-3.5 w-3.5 text-purple-400"></i>
            <span>Governors List</span>
          </a>
          <a href="/programmes/allocation/commissioners-list" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="list-checks" class="h-3.5 w-3.5 text-purple-400"></i>
            <span>Commissioners List</span>
          </a>
        </div>

        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="resettlement">
          <div class="flex items-center gap-2">
            <i data-lucide="home" class="h-4 w-4 text-purple-500"></i>
            <span>Resettlement</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="resettlement"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="resettlement">
          <a href="/programmes/resettlement/governors-list" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="list" class="h-3.5 w-3.5 text-purple-400"></i>
            <span>Governors List</span>
          </a>
          <a href="/programmes/resettlement/commissioners-list" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="list-checks" class="h-3.5 w-3.5 text-purple-400"></i>
            <span>Commissioners List</span>
          </a>
        </div>

        <a href="/programmes/recertification" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-cog" class="h-4 w-4 text-purple-500"></i>
          <span>Recertification</span>
        </a>
        <a href="/programmes/regularization" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-up" class="h-4 w-4 text-purple-500"></i>
          <span>Conversion/Regularization</span>
        </a>
        
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="enumeration">
          <div class="flex items-center gap-2">
            <i data-lucide="file-down" class="h-4 w-4 text-purple-500"></i>
            <span>Land Property Enumeration</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="enumeration"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="enumeration">
          <a href="/programmes/enumeration/data-repository" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="database" class="h-3.5 w-3.5 text-purple-400"></i>
            <span>Data Repository</span>
          </a>
          <a href="/programmes/enumeration/migrate-data" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="file-input" class="h-3.5 w-3.5 text-purple-400"></i>
            <span>Migrate Data</span>
          </a>
        </div>
      </div>
    </div>

    <!-- 3. Information Products -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="infoProducts">
        <div class="flex items-center gap-2"> 
          <i data-lucide="file-output" class="6-5 w-6 module-icon-info-products text-indigo-600"></i>
          <span class="text-sm font-bold uppercase tracking-wider">3. Information Products</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="infoProducts"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="infoProducts">
        <a href="/documents/letter-of-administration" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-plus-2" class="h-4 w-4 text-indigo-500"></i>
          <span>Letter of Administration/Grant/Offer Letter</span>
        </a>
        <a href="/documents/occupancy-permit" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-warning" class="h-4 w-4 text-indigo-500"></i>
          <span>Occupancy Permit (OP)</span>
        </a>
        <a href="/documents/site-plan" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-text" class="h-4 w-4 text-indigo-500"></i>
          <span>Site Plan/Parcel Plan</span>
        </a>
        <a href="/documents/right-of-occupancy" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-check" class="h-4 w-4 text-indigo-500"></i>
          <span>Right of Occupancy</span>
        </a>
        <a href="/documents/certificate-of-occupancy" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-text" class="h-4 w-4 text-indigo-500"></i>
          <span>Certificate of Occupancy</span>
        </a>
      </div>
    </div>

    <!-- 4. Deeds -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="deeds">
        <div class="flex items-center gap-2"> 
          <i data-lucide="book-open" class="h-6 w-6 module-icon-instrument text-amber-600"></i>
          <span class="text-sm font-bold uppercase tracking-wider">4. Deeds</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="deeds"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="deeds">
        <a href="/instrument-capture" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-input" class="h-4 w-4 text-amber-500"></i>
          <span>Instrument Capture</span>
        </a>
        <a href="/instrument-registration" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="book-open" class="h-4 w-4 text-amber-500"></i>
          <span>Instrument Registration</span>
        </a>
        
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="cofoRegistration">
          <div class="flex items-center gap-2">
            <i data-lucide="file-badge" class="h-4 w-4 text-amber-500"></i>
            <span>CofO Registration</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="cofoRegistration"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="cofoRegistration">
          <a href="/instrument/cofo/regular" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="file-check" class="h-3.5 w-3.5 text-amber-400"></i>
            <span>Regular CofO</span>
          </a>
          <a href="/instrument/cofo/sectional" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="buildings" class="h-3.5 w-3.5 text-amber-400"></i>
            <span>Sectional Titling CofO</span>
          </a>
          <a href="/instrument/cofo/sltr" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="file-badge" class="h-3.5 w-3.5 text-amber-400"></i>
            <span>SLTR CofO</span>
          </a>
        </div>
        
        <a href="/property-records-assistant" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-search" class="h-4 w-4 text-amber-500"></i>
          <span>Property Records Assistant</span>
        </a>
        <a href="/instrument-registration-reports" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-bar-chart" class="h-4 w-4 text-amber-500"></i>
          <span>Instrument Registration Reports</span>
        </a>
      </div>
    </div>

    <!-- 5. Search -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="search">
        <div class="flex items-center gap-2"> 
          <i data-lucide="file-search" class="h-6 w-6 module-icon-legal-search text-cyan-600"></i>
          <span class="text-sm font-bold uppercase tracking-wider">5. Search</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="search"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="search">
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="legalSearch">
          <div class="flex items-center gap-2">
            <i data-lucide="scale" class="h-4 w-4 text-cyan-500"></i>
            <span>Legal Search</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="legalSearch"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="legalSearch">
          <a href="/legal-search/official" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="file-check-2" class="h-3.5 w-3.5 text-cyan-400"></i>
            <span>Official (for filing purpose)</span>
          </a>
          <a href="/legal-search/on-premise" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="building" class="h-3.5 w-3.5 text-cyan-400"></i>
            <span>On-Premise</span>
          </a>
          <a href="/legal-search/online" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="globe" class="h-3.5 w-3.5 text-cyan-400"></i>
            <span>Online</span>
          </a>
          <a href="/legal-search/reports" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="file-bar-chart" class="h-3.5 w-3.5 text-cyan-400"></i>
            <span>Legal Search Reports</span>
          </a>
        </div>
      </div>
    </div>

    <!-- 6. Revenue Management -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="revenue">
        <div class="flex items-center gap-2"> 
          <i data-lucide="banknote" class="h-5 w-5 text-emerald-600"></i>
          <span class="text-sm font-bold uppercase tracking-wider">6. Revenue Management</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="revenue"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="revenue">
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="billing">
          <div class="flex items-center gap-2">
            <i data-lucide="receipt" class="h-4 w-4 text-emerald-500"></i>
            <span>Billing</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="billing"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="billing">
          <a href="/revenue/billing/automated" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="cpu" class="h-3.5 w-3.5 text-emerald-400"></i>
            <span>Automated Billing</span>
          </a>
          <a href="/revenue/billing/legacy" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="history" class="h-3.5 w-3.5 text-emerald-400"></i>
            <span>Legacy Billing</span>
          </a>
        </div>
        
        <a href="/revenue/generate-receipt" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="receipt" class="h-4 w-4 text-emerald-500"></i>
          <span>Generate Receipt</span>
        </a>
        <a href="/revenue/land-use-charge" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="tag" class="h-4 w-4 text-emerald-500"></i>
          <span>Land Use Charge (LUC)</span>
        </a>
        <a href="/revenue/bill-balance" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="calculator" class="h-4 w-4 text-emerald-500"></i>
          <span>Bill Balance</span>
        </a>
      </div>
    </div>

    <!-- 7. Sectional Titling -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="sectionalTitling">
        <div class="flex items-center gap-2">
          <i data-lucide="building-2" class="h-5 w-5"></i>
          <span class="text-sm font-bold uppercase tracking-wider">7. Sectional Titling</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="sectionalTitling"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="sectionalTitling">
        <a href="{{ route('sectionaltitling.primary') }}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('sectionaltitling.primary') ? 'active' : '' }}">
          <i data-lucide="file-plus" class="h-4 w-4"></i>
          <span>Primary Applications</span>
        </a>
        <a href="{{ route('sectionaltitling.units') }}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('sectionaltitling.units') ? 'active' : '' }}">
          <i data-lucide="file-plus-2" class="h-4 w-4"></i>
          <span>Unit Applications</span>
        </a>
        <a href="{{route('programmes.field-data')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="clipboard-list" class="h-4 w-4"></i>
          <span>Field Data</span>
        </a>
        <a href="{{route('programmes.payments')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.payments') ? 'active' : '' }}">
          <i data-lucide="credit-card" class="h-4 w-4"></i>
          <span>Payments</span>
        </a>
        
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="stApprovals">
          <div class="flex items-center gap-2">
            <i data-lucide="check-circle" class="h-4 w-4"></i>
            <span>Approvals</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="stApprovals"></i>
        </div>
        
        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="stApprovals">
          <a href="{{route('programmes.approvals.other-departments')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.approvals.other-departments') ? 'active' : '' }}">
            <i data-lucide="building-2" class="h-3.5 w-3.5"></i>
            <span>Other Departments</span>
          </a>
          <a href="{{route('programmes.approvals.planning_recomm')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.approvals.planning_recomm') ? 'active' : '' }}">
            <i data-lucide="clipboard-check" class="h-3.5 w-3.5"></i>
            <span>Planning Recommendation</span>
          </a>
          <a href="{{route('programmes.approvals.director')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.approvals.director') ? 'active' : '' }}">
            <i data-lucide="stamp" class="h-3.5 w-3.5"></i>
            <span>Director's Approval</span>
          </a>
        </div>
        

        <a href="{{route('programmes.memo')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.memo') ? 'active' : '' }}">
          <i data-lucide="clipboard-list" class="h-3.5 w-3.5"></i>
          <span> Memo</span>
      </a>


      <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="eRegistry">
        <div class="flex items-center gap-2">
          <i data-lucide="database" class="h-3.5 w-3.5"></i>
          <span>Certificate</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="eRegistry"></i>
      </div>
      
      <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="eRegistry">
        <a href="{{route('programmes.rofo')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.rofo') ? 'active' : '' }}">
          <i data-lucide="folder" class="h-3.5 w-3.5"></i>
          <span>RofO</span>
        </a>
        <a href="{{route('programmes.certificates')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.certificates') ? 'active' : '' }}">
          <i data-lucide="file-cog" class="h-4 w-4 "></i>
          <span> CofO</span>
        </a>
    </div>



        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="stERegistry">
          <div class="flex items-center gap-2">
            <i data-lucide="database" class="h-4 w-4"></i>
            <span>e-Registry</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="stERegistry"></i>
        </div>
        
        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="stERegistry">
          <a href="/sectional-titling/e-registry/files" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="folder" class="h-3.5 w-3.5"></i>
            <span>Files</span>
          </a>
         
        </div>
        
        <a href="{{route('programmes.report')}}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('programmes.report') ? 'active' : '' }}">
          <i data-lucide="file-bar-chart" class="h-4 w-4"></i>
          <span>Reports</span>
        </a>
        
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="stGis">
          <div class="flex items-center gap-2">
            <i data-lucide="map" class="h-4 w-4"></i>
            <span>GIS</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="stGis"></i>
        </div>
        
        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="stGis">
          <a href="/sectional-titling/gis/system" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="server" class="h-3.5 w-3.5"></i>
            <span>System</span>
          </a>
          <a href="{{ route('map.index') }}" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200 {{ request()->routeIs('map.index') ? 'active' : '' }}">
            <i data-lucide="map-pin" class="h-3.5 w-3.5"></i>
            <span>Map</span>
          </a>
        </div>
      </div>
    </div>

    <!-- 8. SLTR/First Registration -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="sltr">
        <div class="flex items-center gap-2">
          <i data-lucide="file-search" class="h-5 w-5"></i>
          <span class="text-sm font-bold uppercase tracking-wider">8. SLTR/First Registration</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="sltr"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="sltr">
        <a href="/programmes/sltr/application" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-plus" class="h-4 w-4"></i>
          <span>Application</span>
        </a>
        <a href="/programmes/sltr/field-data" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="clipboard-list" class="h-4 w-4"></i>
          <span>Field Data</span>
        </a>
        <a href="/programmes/sltr/payments" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="credit-card" class="h-4 w-4"></i>
          <span>Payments</span>
        </a>
        
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="sltrApprovals">
          <div class="flex items-center gap-2">
            <i data-lucide="check-circle" class="h-4 w-4"></i>
            <span>Approvals</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="sltrApprovals"></i>
        </div>
        
        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="sltrApprovals">
          <a href="/programmes/sltr/approvals/other-departments" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="building-2" class="h-3.5 w-3.5"></i>
            <span>Other Departments</span>
          </a>
          <a href="/programmes/sltr/approvals/planning" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="clipboard-check" class="h-3.5 w-3.5"></i>
            <span>Planning Recommendation</span>
          </a>
          <a href="/programmes/sltr/approvals/director" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="stamp" class="h-3.5 w-3.5"></i>
            <span>Director's Approval</span>
          </a>
        </div>
        
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="sltrERegistry">
          <div class="flex items-center gap-2">
            <i data-lucide="database" class="h-4 w-4"></i>
            <span>e-Registry</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="sltrERegistry"></i>
        </div>
        
        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="sltrERegistry">
          <a href="/programmes/sltr/e-registry/files" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="folder" class="h-3.5 w-3.5"></i>
            <span>Files</span>
          </a>
          <a href="/programmes/sltr/e-registry/certificate" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="file-badge" class="h-3.5 w-3.5"></i>
            <span>Certificate</span>
          </a>
        </div>
        
        <a href="/programmes/sltr/reports" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-bar-chart" class="h-4 w-4"></i>
          <span>Reports</span>
        </a>
        
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="sltrGis">
          <div class="flex items-center gap-2">
            <i data-lucide="map" class="h-4 w-4"></i>
            <span>GIS</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="sltrGis"></i>
        </div>
        
        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="sltrGis">
          <a href="/programmes/sltr/gis/system" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="server" class="h-3.5 w-3.5"></i>
            <span>System</span>
          </a>
          <a href="/programmes/sltr/gis/map" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="map-pin" class="h-3.5 w-3.5"></i>
            <span>Map</span>
          </a>
        </div>
      </div>
    </div>

    <!-- 9. Lands -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="lands">
        <div class="flex items-center gap-2">
          <i data-lucide="file-input" class="h-5 w-5"></i>
          <span class="text-sm font-bold uppercase tracking-wider">9. Lands</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="lands"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="lands">
        <a href="/file-digital-registry/archive" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-archive" class="h-4 w-4"></i>
          <span>File Digital Archive – Doc-WARE</span>
        </a>
        <a href="/file-digital-registry/tracker" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-search" class="h-4 w-4"></i>
          <span>File Tracker/Tracking - RFID</span>
        </a>
        
        <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="edms">
          <div class="flex items-center gap-2">
            <i data-lucide="folder" class="h-4 w-4"></i>
            <span>EDMS</span>
          </div>
          <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="edms"></i>
        </div>

        <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="edms">
          <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="indexing">
            <div class="flex items-center gap-2">
              <i data-lucide="file-text" class="h-3.5 w-3.5"></i>
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
          
          <div class="sidebar-submodule-header flex items-center justify-between py-1.5 px-3 cursor-pointer rounded-md" data-section="scanning">
            <div class="flex items-center gap-2">
              <i data-lucide="scan" class="h-3.5 w-3.5"></i>
              <span>Scanning</span>
            </div>
            <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="scanning"></i>
          </div>
          
          <div class="pl-4 mt-1 mb-1 space-y-0.5 hidden" data-content="scanning">
            <a href="/file-digital-registry/upload" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
              <i data-lucide="file-up" class="h-3.5 w-3.5"></i>
              <span>Upload</span>
            </a>
            <a href="/file-digital-registry/download" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
              <i data-lucide="file-down" class="h-3.5 w-3.5"></i>
              <span>Download</span>
            </a>
          </div>
          
          <a href="/file-digital-registry/page-typing" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
            <i data-lucide="file-text" class="h-3.5 w-3.5"></i>
            <span>PageTyping</span>
          </a>
        </div>
      </div>
    </div>

    <!-- 10. Physical Planning -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="physicalPlanning">
        <div class="flex items-center gap-2">
          <i data-lucide="ruler" class="h-5 w-5"></i>
          <span class="text-sm font-bold uppercase tracking-wider">10. Physical Planning</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="physicalPlanning"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="physicalPlanning">
        <a href="/physical-planning/recommendation" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="clipboard-check" class="h-4 w-4"></i>
          <span>Planning Recommendation</span>
        </a>
        <a href="/physical-planning/approvals" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="check-circle" class="h-4 w-4"></i>
          <span>Approvals</span>
        </a>
        <a href="/physical-planning/reports" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-bar-chart" class="h-4 w-4"></i>
          <span>PP Reports</span>
        </a>
      </div>
    </div>

    <!-- 11. Survey -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="survey">
        <div class="flex items-center gap-2">
          <i data-lucide="compass" class="h-5 w-5"></i>
          <span class="text-sm font-bold uppercase tracking-wider">11. Survey</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="survey"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="survey">
        <a href="/survey/records" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="clipboard" class="h-4 w-4"></i>
          <span>Records</span>
        </a>
        <a href="/survey/gis" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="map" class="h-4 w-4"></i>
          <span>GIS</span>
        </a>
        <a href="/survey/approvals" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="check-circle" class="h-4 w-4"></i>
          <span>Approvals</span>
        </a>
        <a href="/survey/e-registry" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="database" class="h-4 w-4"></i>
          <span>E-Registry</span>
        </a>
        <a href="/survey/reports" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-bar-chart" class="h-4 w-4"></i>
          <span>Survey Reports</span>
        </a>
      </div>
    </div>

    <!-- 12. Cadastral -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="cadastral">
        <div class="flex items-center gap-2">
          <i data-lucide="map" class="h-5 w-5"></i>
          <span class="text-sm font-bold uppercase tracking-wider">12. Cadastral</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="cadastral"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="cadastral">
        <a href="/cadastral/records" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="clipboard" class="h-4 w-4"></i>
          <span>Records</span>
        </a>
        <a href="/cadastral/gis" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="map" class="h-4 w-4"></i>
          <span>GIS</span>
        </a>
        <a href="/cadastral/approvals" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="check-circle" class="h-4 w-4"></i>
          <span>Approvals</span>
        </a>
        <a href="/cadastral/e-registry" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="database" class="h-4 w-4"></i>
          <span>E-Registry</span>
        </a>
        <a href="/cadastral/reports" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="file-bar-chart" class="h-4 w-4"></i>
          <span>Cadastral Reports</span>
        </a>
      </div>
    </div>

    <!-- 13. Systems -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="systems">
        <div class="flex items-center gap-2"> 
          <i data-lucide="shield" class="h-5 w-5 module-icon-systems"></i>
          <span class="text-sm font-bold uppercase tracking-wider">13. Systems</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="systems"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="systems">
        <a href="/systems/caveat" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="shield-alert" class="h-4 w-4"></i>
          <span>Caveat</span>
        </a>
        <a href="/systems/encumbrance" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="lock" class="h-4 w-4"></i>
          <span>Encumbrance</span>
        </a>
      </div>
    </div>

    <!-- 14. Legacy Systems -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="legacy">
        <div class="flex items-center gap-2">
          <i data-lucide="hard-drive" class="h-5 w-5"></i>
          <span class="text-sm font-bold uppercase tracking-wider">14. Legacy Systems</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="legacy"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="legacy">
        <a href="/legacy-systems" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="database" class="h-4 w-4"></i>
          <span>Legacy Systems</span>
        </a>
      </div>
    </div>

    <!-- 15. System Admin -->
    <div class="py-1 px-3 mb-0.5 border-t border-slate-100">
      <div class="sidebar-module-header flex items-center justify-between py-2 px-3 mb-0.5 cursor-pointer hover:bg-slate-50 rounded-md" data-module="admin">
        <div class="flex items-center gap-2"> 
          <i data-lucide="cog" class="h-5 w-5 module-icon-admin"></i>
          <span class="text-sm font-bold uppercase tracking-wider">15. System Admin</span>
        </div>
        <i data-lucide="chevron-right" class="h-4 w-4 transition-transform duration-200" data-chevron="admin"></i>
      </div>

      <div class="pl-4 mt-1 space-y-0.5 hidden" data-content="admin">
        <a href="/admin/user-account" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="user-cog" class="h-4 w-4"></i>
          <span>User Account</span>
        </a>
        <a href="/admin/system-settings" class="sidebar-item flex items-center gap-2 py-2 px-3 rounded-md transition-all duration-200">
          <i data-lucide="settings" class="h-4 w-4"></i>
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
    
    // Close user menu when clicking outside - FIX: Added missing dot before 'contains'
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