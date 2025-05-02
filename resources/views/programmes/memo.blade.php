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
    /* Tooltip/popup styles */
    .tooltip {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }
    
    .tooltip .tooltip-content {
      visibility: hidden;
      width: 220px;
      background-color: #fff;
      color: #333;
      text-align: left;
      border-radius: 6px;
      padding: 10px;
      position: absolute;
      z-index: 1000;
      bottom: 125%;
      left: 50%;
      margin-left: -110px;
      opacity: 0;
      transition: opacity 0.3s;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      border: 1px solid #e5e7eb;
    }
    
    .tooltip .tooltip-content::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #fff transparent transparent transparent;
    }
    
    .tooltip:hover .tooltip-content {
      visibility: visible;
      opacity: 1;
    }
    
    .info-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      height: 16px;
      width: 16px;
      background-color: #e5e7eb;
      color: #4b5563;
      border-radius: 50%;
      font-size: 10px;
      margin-left: 4px;
      cursor: pointer;
    }

    /* Dropdown menu styles */
    .action-menu {
      position: absolute;
      top: 100%;
      right: 0;
      z-index: 50;
      min-width: 200px;
      max-width: 100%;
      background: white;
      border-radius: 0.375rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      border: 1px solid #e5e7eb;
    }

    .table-cell.relative {
      position: relative;
    }

    @media (max-width: 640px) {
      .action-menu {
        position: fixed;
        left: 50%;
        transform: translateX(-50%);
        top: auto;
        bottom: 20px;
        right: auto;
        width: 90%;
      }
    }

    
    /* Filter toggle styles */
    .filter-container {
        display: none;
        transition: all 0.3s ease;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .filter-container.show {
        display: block;
    }
  </style>
<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
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
     
        <div  class="bg-white rounded-md shadow-sm border border-gray-200 p-6">

              <!-- Filter Toggle and Export Buttons -->
        <div class="flex justify-between items-center mb-4">
          <div class="flex items-center space-x-2">
              <button id="toggleFilters" class="flex items-center space-x-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                  <i data-lucide="filter" class="w-4 h-4"></i>
                  <span>Filters</span>
              </button>
              
              <!-- Add search bar that's always visible -->
              <div class="relative">
                  <input 
                      type="text" 
                      id="searchInput" 
                      placeholder="Search records..." 
                      class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 w-64"
                  >
                  <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
              </div>
          </div>
          
          <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
              <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
              <span>Export</span>
          </button>
      </div>
      
      <!-- Filters Container (Hidden by Default) -->
      <div id="filterContainer" class="filter-container mb-6">
          <div class="flex flex-wrap items-center gap-4 w-full">
              <!-- Land Use Filter -->
              <div class="relative min-w-[160px]">
                  <label for="landUseFilter" class="block text-xs font-medium text-gray-700 mb-1">Land Use</label>
                  <select id="landUseFilter" class="pl-4 pr-8 py-2 w-full border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 appearance-none">
                      <option value="">All</option>
                      <option value="Residential">Residential</option>
                      <option value="Commercial">Commercial</option>
                      <option value="Industrial">Industrial</option>
                      <option value="Mixed Use">Mixed Use</option>
                  </select>
                  <i data-lucide="chevron-down" class="absolute right-3 top-[60%] transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
              </div>
              
              <!-- Date Range Filter -->
              <div class="flex flex-col sm:flex-row gap-3">
                  <div>
                      <label for="dateFrom" class="block text-xs font-medium text-gray-700 mb-1">Date From</label>
                      <input type="date" id="dateFrom" class="pl-4 pr-2 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                  </div>
                  <div>
                      <label for="dateTo" class="block text-xs font-medium text-gray-700 mb-1">Date To</label>
                      <input type="date" id="dateTo" class="pl-4 pr-2 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                  </div>
              </div>
              
              <!-- Apply and Reset Buttons -->
              <div class="flex items-end space-x-2">
                  <button id="applyFilter" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                      Apply Filters
                  </button>
                  <button id="resetFilter" class="border border-gray-300 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-md">
                      Reset
                  </button>
              </div>
          </div>
      </div>
      
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold">Memo</h2>
                    <p class="text-sm text-gray-600 mt-1">Primary Application</p>
                  </div>
            
            </div>
            
            <div class="overflow-x-auto">
                <table id="primaryApplicationTable" class="min-w-full divide-y divide-gray-200">
                  <thead>
                    <tr>
                        <th class="table-header">FileNo</th>
                        <th class="table-header">CofO No</th>
                        <th class="table-header">Owner</th>
                        <th class="table-header">LGA</th>
                        <th class="table-header">Land Use</th>
                        <th class="table-header">Term</th>
                        <th class="table-header">Commencement Date</th>
                        <th class="table-header">Residual Term</th>
                        <th class="table-header">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($motherApplications as $application)
                    @php
                        // Fetch memo data if it exists
                        $memoData = DB::connection('sqlsrv')->table('memos')
                            ->where('application_id', $application->id)
                            ->where('memo_type', 'primary')
                            ->first();
                            
                        // Calculate terms if not in memo
                        $startDate = \Carbon\Carbon::parse($application->approval_date ?? now());
                        $totalYears = $memoData->term_years ?? 40; // Default value
                        $currentYear = now()->year;
                        $elapsedYears = $currentYear - $startDate->year;
                        $residualYears = $memoData->residual_years ?? max(0, $totalYears - $elapsedYears);
                        $commencementDate = $memoData->commencement_date ?? $application->approval_date ?? now();
                        
                        // Format the date for display
                        $formattedCommencementDate = date('d M Y', strtotime($commencementDate));
                    @endphp
                    <tr>
                        <td class="table-cell">{{ $application->fileno ?? 'N/A' }}</td>
                        <td class="table-cell">
                            @if(isset($memoData->certificate_number))
                                {{ $memoData->certificate_number }}
                            @else
                            <span class="font-medium" style="color: #d97706; white-space: nowrap;">N/A</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            @if(!empty($application->multiple_owners_names) && json_decode($application->multiple_owners_names))
                                @php
                                    $owners = json_decode($application->multiple_owners_names);
                                    $firstOwner = isset($owners[0]) ? $owners[0] : 'N/A';
                                    $allOwners = json_encode($owners);
                                @endphp
                                {{ $firstOwner }}
                                <span class="info-icon" onclick="showOwners({{ $allOwners }})">i</span>
                            @else
                                {{ $application->owner_name ?? 'N/A' }}
                            @endif
                        </td>
                        <td class="table-cell">{{ $application->property_lga ?? 'N/A' }}</td>
                        <td class="table-cell">{{ $application->land_use ?? 'N/A' }}</td>
                        <td class="table-cell">
                            @if($memoData)
                                {{ $totalYears }} Years
                            @else
                            <span class="font-medium" style="color: #d97706; white-space: nowrap;">N/A</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            @if($memoData)
                                {{ $formattedCommencementDate }}
                            @else
                                <span class="font-medium" style="color: #d97706">N/A</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            @if($memoData)
                                {{ $residualYears }} Years
                            @else
                              <span class="font-medium" style="color: #d97706; white-space: nowrap;">N/A</span>
                            @endif
                        </td>
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
                              <span>View Record</span>
                            </a>
                          </li>
                          <li>
                            <a href="" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                              <i data-lucide="pencil" class="w-4 h-4 text-amber-600"></i>
                              <span>Edit Record</span>
                            </a>
                          </li>
                          <li>
                            <a href="{{ route('programmes.generate_memo', $application->id) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                              <i data-lucide="file-plus" class="w-4 h-4 text-indigo-600"></i>
                              <span>Generate Memo</span>
                            </a>
                          </li>
                            <li>
                            @if($memoData)
                              <a href="{{ route('programmes.view_memo_primary', $application->id) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                              <i data-lucide="clipboard" class="w-4 h-4 text-amber-600"></i>
                              <span>View Memo</span>
                              </a>
                            @else
                              <span class="block w-full text-left px-4 py-2 text-gray-400 flex items-center space-x-2 cursor-not-allowed" title="Memo has not been generated yet">
                              <i data-lucide="clipboard" class="w-4 h-4"></i>
                              <span>View Memo</span>
                              </span>
                            @endif
                            </li>
                            <li>
                            @if($memoData)
                              <a href="{{ route('programmes.generate_memo', $application->id) }}?edit=yes" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                              <i data-lucide="pencil" class="w-4 h-4 text-green-600"></i>
                              <span>Edit Memo</span>
                              </a>
                            @else
                              <span class="block w-full text-left px-4 py-2 text-gray-400 flex items-center space-x-2 cursor-not-allowed" title="Memo has not been generated yet">
                              <i data-lucide="pencil" class="w-4 h-4"></i>
                              <span>Edit Memo</span>
                              </span>
                            @endif
                            </li>
                        </ul>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="table-cell text-center py-4 text-gray-500">No primary survey records found</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
          </div>
      </div>
     
        
      <!-- Unit Application  -->
    <div id="unit-survey" class="hidden">
       
      <div  class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <!-- Add Filter Toggle and Export Buttons for Unit Applications -->
        <div class="flex justify-between items-center mb-4">
          <div class="flex items-center space-x-2">
              <button id="toggleUnitFilters" class="flex items-center space-x-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                  <i data-lucide="filter" class="w-4 h-4"></i>
                  <span>Filters</span>
              </button>
              
              <!-- Add search bar that's always visible -->
              <div class="relative">
                  <input 
                      type="text" 
                      id="unitSearchInput" 
                      placeholder="Search records..." 
                      class="pl-10 pr-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 w-64"
                  >
                  <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
              </div>
          </div>
          
          <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
              <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
              <span>Export</span>
          </button>
        </div>
        
        <!-- Filters Container for Unit Applications (Hidden by Default) -->
        <div id="unitFilterContainer" class="filter-container mb-6">
          <div class="flex flex-wrap items-center gap-4 w-full">
              <!-- Land Use Filter -->
              <div class="relative min-w-[160px]">
                  <label for="unitLandUseFilter" class="block text-xs font-medium text-gray-700 mb-1">Land Use</label>
                  <select id="unitLandUseFilter" class="pl-4 pr-8 py-2 w-full border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 appearance-none">
                      <option value="">All</option>
                      <option value="Residential">Residential</option>
                      <option value="Commercial">Commercial</option>
                      <option value="Industrial">Industrial</option>
                      <option value="Mixed Use">Mixed Use</option>
                  </select>
                  <i data-lucide="chevron-down" class="absolute right-3 top-[60%] transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
              </div>
              
              <!-- Scheme Number Filter -->
              <div class="relative min-w-[160px]">
                  <label for="schemeNoFilter" class="block text-xs font-medium text-gray-700 mb-1">Scheme Number</label>
                  <input type="text" id="schemeNoFilter" class="pl-4 pr-2 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
              </div>
              
              <!-- Apply and Reset Buttons -->
              <div class="flex items-end space-x-2">
                  <button id="applyUnitFilter" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                      Apply Filters
                  </button>
                  <button id="resetUnitFilter" class="border border-gray-300 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-md">
                      Reset
                  </button>
              </div>
          </div>
        </div>
        
        <div class="flex justify-between items-center mb-6">
          <div>
            <h2 class="text-xl font-bold">Memo</h2>
            <p class="text-sm text-gray-600 mt-1">Unit Application</p>
          </div>
        </div>
        
        <div>
            <table id="unitApplicationTable" class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="table-header">ST FileNo</th>
                  <th class="table-header">SchemeNo</th>
                  <th class="table-header">Unit Owner</th>
                  <th class="table-header">LGA</th>
                  <th class="table-header">Block/Floor/Unit</th>
                  <th class="table-header">Land Use</th>
                  <th class="table-header">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($subapplications as $unitApplication)
                <tr data-land-use="{{ strtolower($unitApplication->land_use ?? '') }}" data-scheme-no="{{ strtolower($unitApplication->scheme_no ?? '') }}" data-search="{{ strtolower($unitApplication->fileno . ' ' . $unitApplication->scheme_no . ' ' . ($unitApplication->owner_name ?? '') . ' ' . ($unitApplication->property_lga ?? '')) }}">
                  <td class="table-cell">{{ $unitApplication->fileno ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $unitApplication->scheme_no ?? 'N/A' }}</td>
                  <td class="table-cell">
                      @if(!empty($unitApplication->multiple_owners_names) && json_decode($unitApplication->multiple_owners_names))
                          @php
                              $owners = json_decode($unitApplication->multiple_owners_names);
                              $firstOwner = isset($owners[0]) ? $owners[0] : 'N/A';
                              $allOwners = json_encode($owners);
                          @endphp
                          {{ $firstOwner }}
                          <span class="info-icon" onclick="showOwners({{ $allOwners }})">i</span>
                      @else
                          {{ $unitApplication->owner_name ?? 'N/A' }}
                      @endif
                  </td>
                  <td class="table-cell">{{ $unitApplication->property_lga ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $unitApplication->block_number ?? '' }}/{{ $unitApplication->floor_number ?? '' }}/{{ $unitApplication->unit_number ?? '' }}</td>
                  <td class="table-cell">{{ $unitApplication->land_use ?? 'N/A' }}</td>
           
                  <td class="table-cell relative">
                    <!-- Dropdown Toggle Button -->
                    <button type="button" class="p-2 hover:bg-gray-100 focus:outline-none rounded-full" onclick="customToggleDropdown(this, event)">
                      <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                    </button>
                    
                    <!-- Dropdown Menu Unit Application Surveys -->
                    <ul class="action-menu z-50 bg-white border rounded-lg shadow-lg hidden w-56">
                      <li>
                        <a href="{{ route('sectionaltitling.viewrecorddetail_sub', $unitApplication->id) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
                          <span>View Record</span>
                        </a>
                      </li>
                      <li>
                        <a href="" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="pencil" class="w-4 h-4 text-amber-600"></i>
                          <span>Edit Record</span>
                        </a>
                      </li>
                       
                      <li>
                        <a href="{{ route('programmes.view_memo_primary', $unitApplication->main_application_id) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="clipboard" class="w-4 h-4 text-amber-600"></i>
                          <span>View Memo</span>
                        </a>
                      </li>
                       
                    </ul>
                  </td>
                </tr>
                @empty
                <tr id="emptyUnitRow">
                  <td colspan="8" class="table-cell text-center py-4 text-gray-500">No unit applications found</td>
                </tr>
                @endforelse
                <tr id="noUnitRecordsRow" style="display: none;">
                  <td colspan="8" class="table-cell text-center py-4 text-gray-500">No matching records found</td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
      </div>
    </div>
    
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
  </div>
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
  
  function showOwners(owners) {
    let ownersList = '';
    owners.forEach(owner => {
      ownersList += `<li>${owner}</li>`;
    });
    
    Swal.fire({
      title: 'All Owners',
      html: `<ul class="text-left list-disc list-inside">${ownersList}</ul>`,
      icon: 'info',
      confirmButtonText: 'Close',
      confirmButtonColor: '#10B981'
    });
  }
  
  // Existing customToggleDropdown function (if it exists)
  function customToggleDropdown(button, event) {
    // Prevent the click from propagating to the document
    event.stopPropagation();
    
    // Close all other dropdowns first
    document.querySelectorAll('.action-menu').forEach(menu => {
      menu.classList.add('hidden');
    });
    
    // Toggle the visibility of the dropdown menu
    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle('hidden');
    
    // Ensure correct positioning for all screen sizes
    if (window.innerWidth <= 640) {
      // Mobile view - bottom centered
      dropdown.style.position = 'fixed';
      dropdown.style.left = '50%';
      dropdown.style.transform = 'translateX(-50%)';
      dropdown.style.bottom = '20px';
      dropdown.style.top = 'auto'; 
      dropdown.style.right = 'auto';
    } else {
      // Desktop view - position relative to button
      dropdown.style.position = 'absolute';
      dropdown.style.top = '100%';
      dropdown.style.right = '0';
      dropdown.style.left = 'auto';
      dropdown.style.transform = 'none';
    }
  }
  
  // Close dropdowns when clicking elsewhere
  document.addEventListener('click', function() {
    document.querySelectorAll('.action-menu').forEach(menu => {
      menu.classList.add('hidden');
    });
  });


   // Table filtering functionality
   document.addEventListener('DOMContentLoaded', function() {
    // Primary application filtering
    const toggleFiltersBtn = document.getElementById('toggleFilters');
    const filterContainer = document.getElementById('filterContainer');
    const applyFilterBtn = document.getElementById('applyFilter');
    const resetFilterBtn = document.getElementById('resetFilter');
    const landUseFilter = document.getElementById('landUseFilter');
    const dateFromFilter = document.getElementById('dateFrom');
    const dateToFilter = document.getElementById('dateTo');
    const searchInput = document.getElementById('searchInput');
    
    // Unit application filtering
    const toggleUnitFiltersBtn = document.getElementById('toggleUnitFilters');
    const unitFilterContainer = document.getElementById('unitFilterContainer');
    const applyUnitFilterBtn = document.getElementById('applyUnitFilter');
    const resetUnitFilterBtn = document.getElementById('resetUnitFilter');
    const unitLandUseFilter = document.getElementById('unitLandUseFilter');
    const schemeNoFilter = document.getElementById('schemeNoFilter');
    const unitSearchInput = document.getElementById('unitSearchInput');
    
    // Primary filters visibility
    if (toggleFiltersBtn) {
        toggleFiltersBtn.addEventListener('click', function() {
            filterContainer.classList.toggle('show');
        });
    }
    
    // Unit filters visibility
    if (toggleUnitFiltersBtn) {
        toggleUnitFiltersBtn.addEventListener('click', function() {
            unitFilterContainer.classList.toggle('show');
        });
    }
    
    // Apply primary filters
    if (applyFilterBtn) {
        applyFilterBtn.addEventListener('click', function() {
            filterPrimaryTable();
        });
    }
    
    // Reset primary filters
    if (resetFilterBtn) {
        resetFilterBtn.addEventListener('click', function() {
            if (landUseFilter) landUseFilter.value = '';
            if (dateFromFilter) dateFromFilter.value = '';
            if (dateToFilter) dateToFilter.value = '';
            filterPrimaryTable();
        });
    }
    
    // Apply unit filters
    if (applyUnitFilterBtn) {
        applyUnitFilterBtn.addEventListener('click', function() {
            filterUnitTable();
        });
    }
    
    // Reset unit filters
    if (resetUnitFilterBtn) {
        resetUnitFilterBtn.addEventListener('click', function() {
            if (unitLandUseFilter) unitLandUseFilter.value = '';
            if (schemeNoFilter) schemeNoFilter.value = '';
            filterUnitTable();
        });
    }
    
    // Apply search on typing with small delay for primary table
    let primarySearchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(primarySearchTimeout);
            primarySearchTimeout = setTimeout(function() {
                filterPrimaryTable();
            }, 300);
        });
    }
    
    // Apply search on typing with small delay for unit table
    let unitSearchTimeout;
    if (unitSearchInput) {
        unitSearchInput.addEventListener('input', function() {
            clearTimeout(unitSearchTimeout);
            unitSearchTimeout = setTimeout(function() {
                filterUnitTable();
            }, 300);
        });
    }
    
    // Filter function for primary applications table
    function filterPrimaryTable() {
        const tableRows = document.querySelectorAll('#primaryApplicationTable tbody tr:not(#noRecordsRow):not(#emptyRow)');
        const noRecordsRow = document.getElementById('noRecordsRow') || document.createElement('tr');
        const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
        
        let visibleRowCount = 0;
        
        tableRows.forEach(row => {
            let showRow = true;
            
            // Apply search filter if specified
            if (searchTerm) {
                const rowText = row.textContent.toLowerCase();
                if (!rowText.includes(searchTerm)) {
                    showRow = false;
                }
            }
            
            // Apply land use filter if specified
            if (showRow && landUseFilter && landUseFilter.value) {
                const landUseCell = row.querySelector('td:nth-child(5)'); // Land Use column
                if (landUseCell && !landUseCell.textContent.toLowerCase().includes(landUseFilter.value.toLowerCase())) {
                    showRow = false;
                }
            }
            
            // Apply date filters if specified
            if (showRow && dateFromFilter && dateFromFilter.value) {
                const dateCell = row.querySelector('td:nth-child(7)'); // Commencement Date column
                if (dateCell) {
                    const dateText = dateCell.textContent.trim();
                    if (dateText !== 'N/A') {
                        const rowDate = new Date(dateText);
                        const filterDate = new Date(dateFromFilter.value);
                        if (rowDate < filterDate) {
                            showRow = false;
                        }
                    }
                }
            }
            
            if (showRow && dateToFilter && dateToFilter.value) {
                const dateCell = row.querySelector('td:nth-child(7)'); // Commencement Date column
                if (dateCell) {
                    const dateText = dateCell.textContent.trim();
                    if (dateText !== 'N/A') {
                        const rowDate = new Date(dateText);
                        const filterDate = new Date(dateToFilter.value);
                        if (rowDate > filterDate) {
                            showRow = false;
                        }
                    }
                }
            }
            
            // Show or hide row based on filters
            row.style.display = showRow ? '' : 'none';
            
            if (showRow) {
                visibleRowCount++;
            }
        });
        
        // Add a "no records" message if needed
        if (visibleRowCount === 0 && tableRows.length > 0) {
            // Create the row if it doesn't exist
            if (!document.getElementById('noRecordsRow')) {
                const tbody = document.querySelector('#primaryApplicationTable tbody');
                const noMatchRow = document.createElement('tr');
                noMatchRow.id = 'noRecordsRow';
                noMatchRow.innerHTML = `<td colspan="9" class="table-cell text-center py-4 text-gray-500">No matching records found</td>`;
                tbody.appendChild(noMatchRow);
            } else {
                document.getElementById('noRecordsRow').style.display = '';
            }
        } else if (document.getElementById('noRecordsRow')) {
            document.getElementById('noRecordsRow').style.display = 'none';
        }
    }
    
    // Filter function for unit applications table
    function filterUnitTable() {
        const tableRows = document.querySelectorAll('#unitApplicationTable tbody tr:not(#noUnitRecordsRow):not(#emptyUnitRow)');
        const noRecordsRow = document.getElementById('noUnitRecordsRow');
        const emptyRow = document.getElementById('emptyUnitRow');
        const searchTerm = unitSearchInput ? unitSearchInput.value.toLowerCase().trim() : '';
        
        let visibleRowCount = 0;
        
        tableRows.forEach(row => {
            let showRow = true;
            
            // Apply search filter if specified
            if (searchTerm) {
                const rowText = row.textContent.toLowerCase();
                if (!rowText.includes(searchTerm)) {
                    showRow = false;
                }
            }
            
            // Apply land use filter if specified
            if (showRow && unitLandUseFilter && unitLandUseFilter.value) {
                const landUseCell = row.querySelector('td:nth-child(6)'); // Land Use column
                if (landUseCell && !landUseCell.textContent.toLowerCase().includes(unitLandUseFilter.value.toLowerCase())) {
                    showRow = false;
                }
            }
            
            // Apply scheme number filter if specified
            if (showRow && schemeNoFilter && schemeNoFilter.value) {
                const schemeNoCell = row.querySelector('td:nth-child(2)'); // Scheme No column
                if (schemeNoCell && !schemeNoCell.textContent.toLowerCase().includes(schemeNoFilter.value.toLowerCase())) {
                    showRow = false;
                }
            }
            
            // Show or hide row based on filters
            row.style.display = showRow ? '' : 'none';
            
            if (showRow) {
                visibleRowCount++;
            }
        });
        
        // Show "no records" message if no rows match the filters
        if (noRecordsRow) {
            if (visibleRowCount === 0 && tableRows.length > 0) {
                noRecordsRow.style.display = '';
                if (emptyRow) emptyRow.style.display = 'none';
            } else {
                noRecordsRow.style.display = 'none';
                if (emptyRow) emptyRow.style.display = tableRows.length === 0 ? '' : 'none';
            }
        }
    }
  });
  </script>
@endsection



