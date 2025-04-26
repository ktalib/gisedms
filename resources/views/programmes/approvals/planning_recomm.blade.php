@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Data View') }}
@endsection

@section('styles')

@endsection

@section('content')
<style>

    .badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.25rem 0.5rem;
      border-radius: 0.25rem;
      font-size: 0.75rem;
      font-weight: 500;
    }
    .badge-approved {
      background-color: #d1fae5;
      color: #059669;
    }
    .badge-pending {
      background-color: #fef3c7;
      color: #d97706;
    }
    .badge-declined {
      background-color: #fee2e2;
      color: #dc2626;
    }
    .table-header {
      background-color: #f9fafb;
      font-weight: 500;
      color: rgb(13, 136, 13);
      text-align: left;
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #e5e7eb;
    }
    .table-cell {
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #e5e7eb;
    }
  </style>

<!-- Add the script at the beginning of the content section to ensure it's loaded before the buttons -->
<script>
  function showTab(tabId) {
    // Hide all tab contents
    document.getElementById('primary-survey').classList.add('hidden');
    document.getElementById('unit-survey').classList.add('hidden');
    
    // Reset all tab buttons
    document.getElementById('primary-survey-tab').classList.remove('bg-green-600', 'text-white');
    document.getElementById('primary-survey-tab').classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-200');
    document.getElementById('unit-survey-tab').classList.remove('bg-green-600', 'text-white');
    document.getElementById('unit-survey-tab').classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-200');
    
    // Show selected tab content
    document.getElementById(tabId).classList.remove('hidden');
    
    // Highlight active tab button
    document.getElementById(tabId + '-tab').classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-200');
    document.getElementById(tabId + '-tab').classList.add('bg-green-600', 'text-white');
  }
  
  // Add dropdown toggle functionality
  function customToggleDropdown(button, event) {
    event.stopPropagation();
    
    // Close all other open dropdowns first
    const allMenus = document.querySelectorAll('.action-menu');
    allMenus.forEach(menu => {
      if (menu !== button.nextElementSibling && !menu.classList.contains('hidden')) {
        menu.classList.add('hidden');
      }
    });
    
    // Toggle the clicked dropdown
    const menu = button.nextElementSibling;
    menu.classList.toggle('hidden');
    
    // Position the dropdown near the button
    if (!menu.classList.contains('hidden')) {
      const rect = button.getBoundingClientRect();
      menu.style.top = rect.bottom + 'px';
      menu.style.left = (rect.left - menu.offsetWidth + rect.width) + 'px';
    }
  }
  
  // Close dropdowns when clicking outside
  document.addEventListener('click', function(event) {
    const allMenus = document.querySelectorAll('.action-menu');
    allMenus.forEach(menu => {
      menu.classList.add('hidden');
    });
  });
  
  // Add table filtering functionality
  function filterTable(tableId, status) {
    const table = document.getElementById(tableId);
    const rows = table.getElementsByTagName('tr');
    
    // Skip header row (index 0)
    for (let i = 1; i < rows.length; i++) {
      const statusCell = rows[i].getElementsByTagName('td')[2]; // Status is in the 3rd column
      
      if (statusCell) {
        const statusText = statusCell.textContent.trim();
        
        if (status === 'All...' || statusText.includes(status)) {
          rows[i].style.display = '';
        } else {
          rows[i].style.display = 'none';
        }
      }
    }
  }
  
  // Initialize filtering when the page loads
  document.addEventListener('DOMContentLoaded', function() {
    // Set up event listeners for the filter dropdowns
    const primaryFilter = document.getElementById('primaryStatusFilter');
    const unitFilter = document.getElementById('unitStatusFilter');
    
    if (primaryFilter) {
      primaryFilter.addEventListener('change', function() {
        filterTable('primaryApplicationTable', this.value);
      });
    }
    
    if (unitFilter) {
      unitFilter.addEventListener('change', function() {
        filterTable('unitApplicationTable', this.value);
      });
    }
  });
</script>

<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
    <!-- Payments Overview -->
 
   <div class="grid grid-cols-3 gap-4 mb-6">
    <div class="stat-card">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-gray-600 font-medium">Total Planning Recommendations</h3>
        <i data-lucide="file-text" class="text-gray-400 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold">{{ $totalPrimaryApplications + $totalUnitApplications }}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="info" class="text-blue-500 w-4 h-4 mr-1"></i>
        <span class="text-blue-500">All Recommendations in system</span>
      </div>
    </div>
     
    <div class="stat-card">
      <div class="flex justify-between items-start mb-4">
        <h3 class="text-gray-600 font-medium">Primary Planning  Recommendations</h3>
      
        <i data-lucide="home" class="text-gray-400 w-5 h-5"></i>
      </div>
      <div class="text-3xl font-bold">{{ $totalPrimaryApplications }}</div>
      <div class="flex items-center mt-2 text-sm">
        <i data-lucide="check-circle" class="text-green-500 w-4 h-4 mr-1"></i>
        <span class="text-green-500">{{ $approvedPrimaryApplications }} Approved</span>
        <i data-lucide="x-circle" class="text-red-500 w-4 h-4 ml-3 mr-1"></i>
        <span class="text-red-500">{{ $rejectedPrimaryApplications }} Declined</span>
        <i data-lucide="clock" class="text-amber-500 w-4 h-4 ml-3 mr-1"></i>
        <span class="text-amber-500">{{ $pendingPrimaryApplications ?? ($totalPrimaryApplications - $approvedPrimaryApplications - $rejectedPrimaryApplications) }} Pending</span>
      </div>
    </div>

     
<div class="stat-card">
    <div class="flex justify-between items-start mb-4">
      <h3 class="text-gray-600 font-medium">Unit Planning  Recommendations</h3>
      <i data-lucide="layers" class="text-gray-400 w-5 h-5"></i>
    </div>
    <div class="text-3xl font-bold">{{ $totalUnitApplications }}</div>
    <div class="flex items-center mt-2 text-sm">
      <i data-lucide="check-circle" class="text-green-500 w-4 h-4 mr-1"></i>
      <span class="text-green-500">{{ $approvedUnitApplications }} Approved</span>
      <i data-lucide="x-circle" class="text-red-500 w-4 h-4 ml-3 mr-1"></i>
      <span class="text-red-500">{{ $rejectedUnitApplications }} Declined</span>
      <i data-lucide="clock" class="text-amber-500 w-4 h-4 ml-3 mr-1"></i>
      <span class="text-amber-500">{{ $pendingUnitApplications ?? ($totalUnitApplications - $approvedUnitApplications - $rejectedUnitApplications) }} Pending</span>
    </div>
  </div>

   </div>
      <!-- Payments Table -->
      <div class="flex space-x-3 mb-6">
        <button 
        onclick="showTab('primary-survey')"
        id="primary-survey-tab"
        class="flex items-center px-4 py-2 text-sm font-medium rounded-lg shadow-sm transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 bg-green-600 text-white hover:bg-green-700"
        >
        <span>Primary Applications</span>
        </button>
        <button 
        onclick="showTab('unit-survey')"
        id="unit-survey-tab"
        class="flex items-center px-4 py-2 text-sm font-medium rounded-lg shadow-sm transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 bg-white text-gray-700 hover:bg-gray-50 border border-gray-200"
        >
        <span>Unit Applications</span>
        </button>
    </div>  

      <!-- Primary Application  -->
      <div id="primary-survey">
        @include('programmes.partials.planning_report')
        <div  class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold">Planning Recommendations</h2>
                    <p class="text-sm text-gray-600 mt-1">Primary Application</p>
                  </div>
              <div class="flex items-center space-x-4">
                <div class="relative">
                  <select id="primaryStatusFilter" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                    <option>All...</option>
                    <option>Approved</option>
                    <option>Pending</option>
                    <option>Declined</option>
                  </select>
                  <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                </div>
                
                <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
                  <i data-lucide="upload" class="w-4 h-4 text-gray-600"></i>
                  <span>Import</span>
                </button>
                
                <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
                  <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
                  <span>Export</span>
                </button>
              </div>
            </div>
            
            <div class="overflow-x-auto">
                <table id="primaryApplicationTable" class="min-w-full divide-y divide-gray-200">
                  <thead>
                    <tr>
                        <th class="table-header">File No</th>
                        <th class="table-header">Owner</th>
                        <th class="table-header">Status</th>
                        <th class="table-header">Approval/Declined Date</th>
                        <th class="table-header">Comment</th>
                        <th class="table-header">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($applications as $application)
                    <tr>
                        <td class="table-cell">{{ $application->fileno ?? 'N/A' }}</td>
                        <td class="table-cell">{{ $application->owner_name ?? 'N/A' }}</td>
                        <td class="table-cell">
                            @if($application->planning_recommendation_status == 'Approved')
                                <span class="badge badge-approved">Approved</span>
                            @elseif($application->planning_recommendation_status == 'Declined')
                                <span class="badge badge-declined">Declined</span>
                            @else
                                <span class="badge badge-pending">Pending</span>
                            @endif
                        </td> 
                        <td class="table-cell">
                            @if($application->planning_approval_date)
                                {{ \Carbon\Carbon::parse($application->planning_approval_date)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="table-cell">{{ $application->comments ?? 'N/A' }}</td>
                       
                    
                      <td class="table-cell relative">
                        <!-- Dropdown Toggle Button -->
                        <button type="button" class="p-2 hover:bg-gray-100 focus:outline-none rounded-full" onclick="customToggleDropdown(this, event)">
                          <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                        </button>
                        
                        <!-- Dropdown Menu Primary Application Surveys -->
                        <ul class="fixed action-menu z-50 bg-white border rounded-lg shadow-lg hidden w-56">
                          <li>
                            <a href="{{ route('sectionaltitling.viewrecorddetail')}}?id={{$application->id}}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                              <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
                              <span>View Application</span>
                            </a>
                          </li>
                             <li>
                                <a href="{{ route('actions.recommendation', ['id' => $application->id]) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                                    <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
                                    <span>View Planning Recommendation</span>
                                </a>
                            </li>
                    
                        </ul>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="11" class="table-cell text-center py-4 text-gray-500">No primary survey records found</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
          </div>
      </div>
     

      <!-- Unit Application  -->
    <div id="unit-survey" class="hidden">
        @include('programmes.partials.unit_planning_report')
      <div  class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
          <div>
            <h2 class="text-xl font-bold">Planning Recommendations</h2>
            <p class="text-sm text-gray-600 mt-1">Unit Application</p>
          </div>

          <div class="flex items-center space-x-4">
            <div class="relative">
              <select id="unitStatusFilter" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                <option>All...</option>
                <option>Approved</option>
                <option>Pending</option>
                <option>Declined</option>
              </select>
              <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
            </div>
            
            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
              <i data-lucide="upload" class="w-4 h-4 text-gray-600"></i>
              <span>Import</span>
            </button>
            
            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
              <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
              <span>Export</span>
            </button>
          </div>
        </div>
        
        <div class="overflow-x-auto">
            <table id="unitApplicationTable" class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="table-header">File No</th>
                  <th class="table-header">Owner</th>
                  <th class="table-header">Status</th>
                  <th class="table-header">Approval/Declined Date</th>
                  <th class="table-header">Comment</th>
                  <th class="table-header">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($unitApplications as $unitApplication)
                <tr>
                  <td class="table-cell">{{ $unitApplication->fileno ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $unitApplication->owner_name ?? 'N/A' }}</td>
                  <td class="table-cell">
                    @if($unitApplication->planning_recommendation_status == 'Approved')
                      <span class="badge badge-approved">Approved</span>
                    @elseif($unitApplication->planning_recommendation_status == 'Declined')
                      <span class="badge badge-declined">Declined</span>
                    @else
                      <span class="badge badge-pending">Pending</span>
                    @endif
                  </td>
                <td class="table-cell">
                    @if($unitApplication->planning_approval_date)
                        {{ \Carbon\Carbon::parse($unitApplication->planning_approval_date)->format('d/m/Y') }}
                    @else
                        N/A
                    @endif
                </td>
                  <td class="table-cell">{{ $unitApplication->comments ?? 'N/A' }}</td>
                  <td class="table-cell relative">
                    <!-- Dropdown Toggle Button -->
                    <button type="button" class="p-2 hover:bg-gray-100 focus:outline-none rounded-full" onclick="customToggleDropdown(this, event)">
                      <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                    </button>
                    
                    <!-- Dropdown Menu Unit Application Surveys -->
                    <ul class="fixed action-menu z-50 bg-white border rounded-lg shadow-lg hidden w-56">
                      <li>
                        <a href="{{ route('sectionaltitling.viewrecorddetail_sub', $unitApplication->id) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
                          <span>View Unit Application</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{ route('actions.recommendation', ['id' => $unitApplication->id]) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
                          <span>View Planning Recommendation</span>
                        </a>
                      </li>
                     
                    </ul>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="table-cell text-center py-4 text-gray-500">No unit applications found</td>
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
@endsection

@section('scripts')
@endsection


