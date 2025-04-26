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
    document.getElementById('primary-deed').classList.add('hidden');
    document.getElementById('unit-deed').classList.add('hidden');
    
    // Reset all tab buttons
    document.getElementById('primary-deed-tab').classList.remove('bg-green-600', 'text-white');
    document.getElementById('primary-deed-tab').classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-200');
    document.getElementById('unit-deed-tab').classList.remove('bg-green-600', 'text-white');
    document.getElementById('unit-deed-tab').classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-200');
    
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
</script>

<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
    <!-- Payments Overview -->
   @include('programmes.partials.other_tabs')
      <!-- Payments Table -->
      <div class="flex space-x-3 mb-6">
        <button 
        onclick="showTab('primary-deed')"
        id="primary-deed-tab"
        class="flex items-center px-4 py-2 text-sm font-medium rounded-lg shadow-sm transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 bg-green-600 text-white hover:bg-green-700"
        >
        <span>Primary Application Deeds</span>
        </button>
        <button 
        onclick="showTab('unit-deed')"
        id="unit-deed-tab"
        class="flex items-center px-4 py-2 text-sm font-medium rounded-lg shadow-sm transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 bg-white text-gray-700 hover:bg-gray-50 border border-gray-200"
        >
        <span>Unit Application Deeds</span>
        </button>
    </div>  

      <!-- Primary Application Deeds -->
      <div id="primary-deed" class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-bold">Primary Application Deeds</h2>

          <div class="flex items-center space-x-4">
            <div class="relative">
              <select class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                <option>All...</option>
                <option>Registered</option>
                <option>Pending</option>
              </select>
              <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
            </div>
            
            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
              <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
              <span>Export</span>
            </button>
          </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="table-header">File No</th>
                  <th class="table-header">Owner</th>
                  <th class="table-header">Serial No</th>
                  <th class="table-header">Page No</th>
                  <th class="table-header">Volume No</th>
                  <th class="table-header">Deeds Time</th>
                  <th class="table-header">Deeds Date</th>
                  <th class="table-header">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($deeds as $deed)
                <tr>
                  <td class="table-cell">{{ $deed->Sectional_Title_File_No ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->owner_name ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->serial_no ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->page_no ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->volume_no ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->deeds_time ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->deeds_date ?? 'N/A' }}</td>
                  <td class="table-cell relative">
                    <!-- Dropdown Toggle Button -->
                    <button type="button" class="p-2 hover:bg-gray-100 focus:outline-none rounded-full" onclick="customToggleDropdown(this, event)">
                      <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                    </button>
                    
                    <!-- Dropdown Menu Primary Application Deeds -->
                    <ul class="fixed action-menu z-50 bg-white border rounded-lg shadow-lg hidden w-56">
                      <li>
                        <a href="{{ route('sectionaltitling.viewrecorddetail')}}?id={{$deed->application_id}}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
                          <span>View Application</span>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="file-text" class="w-4 h-4 text-green-600"></i>
                          <span>View Deed</span>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="printer" class="w-4 h-4 text-gray-600"></i>
                          <span>Print Deed</span>
                        </a>
                      </li>
                    </ul>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="8" class="table-cell text-center py-4 text-gray-500">No deed records found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
      </div>

      <!-- Unit Application Deeds -->
      <div id="unit-deed" class="bg-white rounded-md shadow-sm border border-gray-200 p-6 hidden">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-bold">Unit Application Deeds</h2>

          <div class="flex items-center space-x-4">
            <div class="relative">
              <select class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                <option>All...</option>
                <option>Registered</option>
                <option>Pending</option>
              </select>
              <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
            </div>
            
            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
              <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
              <span>Export</span>
            </button>
          </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="table-header">File No</th>
                  <th class="table-header">Owner</th>
                  <th class="table-header">Serial No</th>
                  <th class="table-header">Page No</th>
                  <th class="table-header">Volume No</th>
                  <th class="table-header">Deeds Time</th>
                  <th class="table-header">Deeds Date</th>
                  <th class="table-header">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($unitDeeds as $deed)
                <tr>
                  <td class="table-cell">{{ $deed->Sectional_Title_File_No ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->owner_name ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->serial_no ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->page_no ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->volume_no ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->deeds_time ?? 'N/A' }}</td>
                  <td class="table-cell">{{ $deed->deeds_date ?? 'N/A' }}</td>
                  <td class="table-cell relative">
                    <!-- Dropdown Toggle Button -->
                    <button type="button" class="p-2 hover:bg-gray-100 focus:outline-none rounded-full" onclick="customToggleDropdown(this, event)">
                      <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                    </button>
                    
                    <!-- Dropdown Menu Unit Application Deeds -->
                    <ul class="fixed action-menu z-50 bg-white border rounded-lg shadow-lg hidden w-56">
                      <li>
                        <a href="{{ route('sectionaltitling.viewrecorddetail_sub', $deed->sub_application_id) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
                          <span>View Unit Application</span>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="file-text" class="w-4 h-4 text-green-600"></i>
                          <span>View Deed</span>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                          <i data-lucide="printer" class="w-4 h-4 text-gray-600"></i>
                          <span>Print Deed</span>
                        </a>
                      </li>
                    </ul>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="8" class="table-cell text-center py-4 text-gray-500">No unit deed records found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
      </div>

    </div>
    
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>
@endsection

@section('scripts')
@endsection


