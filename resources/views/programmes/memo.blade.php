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
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold">Memo</h2>
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
                        <th class="table-header">FileNo</th>
                        
                        <th class="table-header">Owner</th>
                        <th class="table-header">LGA</th>
                        <th class="table-header">No. of Units</th>
                        <th class="table-header">Land Use</th>
                        <th class="table-header">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($motherApplications as $application)
                    <tr>
                        <td class="table-cell">{{ $application->fileno ?? 'N/A' }}</td>
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
                        <td class="table-cell">{{ $application->NoOfUnits ?? 'N/A' }}</td>
                        <td class="table-cell">{{ $application->land_use ?? 'N/A' }}</td>
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
                            <a href="{{ route('programmes.view_memo_primary', $application->id) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                              <i data-lucide="clipboard" class="w-4 h-4 text-amber-600"></i>
                              <span>View Memo</span>
                            </a>
                          </li>
                          <li>
                            <a href="" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                              <i data-lucide="pencil" class="w-4 h-4 text-green-600"></i>
                              <span>Edit Memo</span>
                            </a>
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
        <div class="flex justify-between items-center mb-6">
          <div>
            <h2 class="text-xl font-bold">Memo</h2>
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
        
        <div  >
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
                <tr>
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
                        <a href="{{route('programmes.view_memo' , $unitApplication->id)}}?action=generate" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="file-plus" class="w-4 h-4 text-indigo-600"></i>
                          <span>Generate Memo</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{route('programmes.view_memo' , $unitApplication->id)}}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="clipboard" class="w-4 h-4 text-amber-600"></i>
                          <span>View Memo</span>
                        </a>
                      </li>
                      <li>
                        <a href="" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="pencil" class="w-4 h-4 text-green-600"></i>
                          <span>Edit Memo</span>
                        </a>
                      </li>
                    </ul>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="8" class="table-cell text-center py-4 text-gray-500">No unit applications found</td>
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
  </script>
@endsection



