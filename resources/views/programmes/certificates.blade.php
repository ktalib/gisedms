@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Data View') }}
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
    .badge-issued {
      background-color: #dbeafe;
      color: #2563eb;
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
      position: relative;
      overflow: visible !important;
    }

</style>

<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
        <div class="bg-white rounded-md shadow-sm p-6">
            <h2 class="text-xl font-bold mb-6">ST Certificate of Occupancy Management</h2>
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i data-lucide="info" class="w-5 h-5 text-blue-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            This dashboard shows all approved applications that are eligible for ST Certificate of Occupancy issuance.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Advanced Filter Controls - Moved here -->
            <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4 mb-6">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                    <h3 class="text-lg font-medium">Filter Certificates</h3>
                    <div class="flex items-center space-x-2">
                        <div class="relative">
                            <input type="text" id="search-certificates" placeholder="Search..." class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i data-lucide="search" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                        </div>
                        <button type="button" id="show-advanced-filters" class="border border-gray-300 rounded-md py-2 px-4 flex items-center space-x-2 hover:bg-gray-50">
                            <i data-lucide="filter" class="w-4 h-4 text-gray-500"></i>
                            <span>Advanced Filters</span>
                        </button>
                    </div>
                </div>
                
                <!-- Advanced Filter Section - Initially Hidden -->
                <div id="advanced-filter-section" class="hidden border-t border-gray-200 pt-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Date Range Filter -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Date Range</label>
                            <div class="flex items-center space-x-2">
                                <div class="relative flex-1">
                                    <input type="date" id="date-from" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <span class="text-xs text-gray-500 mt-1 block">From</span>
                                </div>
                                <div class="relative flex-1">
                                    <input type="date" id="date-to" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <span class="text-xs text-gray-500 mt-1 block">To</span>
                                </div>
                            </div>
                        </div>
                        
                       <div></div>
                        
                        <!-- Land Use Filter -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Land Use</label>
                            <div class="relative">
                                <select id="filter-land-use" class="border border-gray-300 rounded-md py-2 px-4 pr-8 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                                    <option value="">All Land Uses</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Industrial">Industrial</option>
                                    <option value="Mixed Use">Mixed Use</option>
                                   
                                </select>
                                <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                            </div>
                        </div>
                        
                        <!-- Certificate Status Filter -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Certificate Generation</label>
                            <div class="relative">
                                <select id="filter-generation" class="border border-gray-300 rounded-md py-2 px-4 pr-8 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                                    <option value="">All</option>
                                    <option value="Generated">Generated</option>
                                    <option value="Not Generated">Not Generated</option>
                                </select>
                                <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filter Actions -->
                    <div class="flex justify-end mt-4 space-x-2">
                        <button type="button" id="reset-filters" class="border border-gray-300 rounded-md py-2 px-4 text-sm text-gray-700 hover:bg-gray-50">
                            Reset Filters
                        </button>
                        <button type="button" id="apply-filters" class="bg-blue-600 border border-transparent rounded-md py-2 px-4 text-sm text-white hover:bg-blue-700">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-gray-500 text-sm font-medium">Total Eligible Applications</h3>
                        <span class="text-blue-500 bg-blue-100 p-2 rounded-full">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </span>
                    </div>
                    <p class="text-3xl font-bold text-gray-800 mt-2" id="total-count">{{ collect($approvedUnitApplications)->where('planning_recommendation_status', 'Approved')->where('application_status', 'Approved')->count() }}</p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-gray-500 text-sm font-medium">Generated Certificates</h3>
                        <span class="text-green-500 bg-green-100 p-2 rounded-full">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                        </span>
                    </div>
                    <p class="text-3xl font-bold text-gray-800 mt-2" id="generated-count">{{ collect($approvedUnitApplications)->where('certificate_issued', true)->count() }}</p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-gray-500 text-sm font-medium">Not Generated</h3>
                        <span class="text-yellow-500 bg-yellow-100 p-2 rounded-full">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </span>
                    </div>
                    <p class="text-3xl font-bold text-gray-800 mt-2" id="not-generated-count">{{ collect($approvedUnitApplications)->where('certificate_issued', '!=', true)->count() }}</p>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium">Approved Applications Eligible for Certificate</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table id="certificates-table" class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="table-header">File No</th>
                                <th class="table-header">CofONo </th>
                                <th class="table-header">Scheme No</th>
                                <th class="table-header">Unit Owner</th>
                                <th class="table-header">LGA</th>
                                <th class="table-header">Block/Floor/Unit</th>
                                <th class="table-header">Land Use</th>
                                <th class="table-header">Cofo Status</th>
                              
                                <th class="table-header">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(count($approvedUnitApplications) > 0)
                                @foreach($approvedUnitApplications as $application)
                                    <tr>
                                        <td class="table-cell">{{ $application->fileno }}</td> 
                                        <td class="table-cell">{{ $application->certificate_number ?? 'N/A' }}</td>
                                        <td class="table-cell">{{ $application->scheme_no }}</td>
                                        <td class="table-cell">{{ $application->owner_name }}</td>
                                        <td class="table-cell">{{ $application->property_lga }}</td>
                                        <td class="table-cell">
                                          {{ $application->block_number ?? 'N/A' }}/{{ $application->floor_number ?? 'N/A' }}/{{ $application->unit_number ?? 'N/A' }}
                                        </td>
                                        <td class="table-cell">{{ $application->land_use }}</td>
                                        <td class="table-cell">
                                            @if($application->application_status == 'Approved' && $application->planning_recommendation_status == 'Approved')
                                                @if(isset($application->certificate_issued) && $application->certificate_issued)
                                                    <span class="badge badge-issued">Generated</span>
                                                @else
                                                    <span class="badge badge-pending">Not Generated</span>
                                                @endif
                                            @else
                                                <span class="badge badge-declined">Not Eligible</span>
                                            @endif
                                        </td>
                                      
                                        <td class="table-cell">
                                        <div class="relative dropdown-container">
                                          <!-- Dropdown Toggle Button -->
                                          <button type="button" class="dropdown-toggle p-2 hover:bg-gray-100 focus:outline-none rounded-full" onclick="customToggleDropdown(this, event)">
                                            <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                                          </button>
                                          <!-- Dropdown Menu -->
                                          <ul class="fixed action-menu z-50 bg-white border rounded-lg shadow-lg hidden w-56">
                                            <li>
                                              <a href="#" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                                                <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
                                                <span>View Application</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class="w-full text-left px-4 py-2 flex items-center space-x-2 text-gray-400 cursor-not-allowed pointer-events-none bg-gray-50">
                                                <i data-lucide="edit" class="w-4 h-4 text-gray-300"></i>
                                                <span>Update Record</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="{{route('programmes.generate_cofo', $application->id)}}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                                                <i data-lucide="file-text" class="w-4 h-4 text-green-500"></i>
                                                <span> Generate Front Page</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="{{route('programmes.view_cofo', $application->id)}}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2 {{ !$application->certificate_issued ? 'text-gray-400 cursor-not-allowed pointer-events-none bg-gray-50' : '' }}">
                                                <i data-lucide="file-text" class="w-4 h-4 {{ $application->certificate_issued ? 'text-blue-500' : 'text-gray-300' }}"></i>
                                                <span>View Certificate</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class="w-full text-left px-4 py-2 flex items-center space-x-2 text-gray-400 cursor-not-allowed pointer-events-none bg-gray-50">
                                                <i data-lucide="map" class="w-4 h-4 text-gray-300"></i>
                                                <span>View TDP</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="{{ $application->certificate_issued ? route('programmes.view_cofo', $application->id) : '#' }}" class="w-full text-left px-4 py-2 flex items-center space-x-2 {{ !$application->certificate_issued ? 'text-gray-400 cursor-not-allowed pointer-events-none bg-gray-50' : '' }}">
                                                <i data-lucide="printer" class="w-4 h-4 {{ $application->certificate_issued ? 'text-green-500' : 'text-gray-300' }}"></i>
                                                <span>Print Certificate</span>
                                              </a>
                                            </li>
                                          </ul>
                                        </div>
                                       
                                       <script>
                                       function customToggleDropdown(button, event) {
                                          event.stopPropagation();
                                          const dropdown = button.closest('.dropdown-container').querySelector('.action-menu');
                                          
                                          // Toggle visibility
                                          dropdown.classList.toggle('hidden');
                                          
                                          if (!dropdown.classList.contains('hidden')) {
                                             // Get button position
                                             const rect = button.getBoundingClientRect();
                                             
                                             // Position dropdown above the button
                                             dropdown.style.top = (rect.top - dropdown.offsetHeight - 5) + 'px';
                                             dropdown.style.left = (rect.left - dropdown.offsetWidth + rect.width) + 'px';
                                             
                                             // Check if dropdown would appear off the top of the screen
                                             if (rect.top - dropdown.offsetHeight < 0) {
                                                // If so, position it below the button instead
                                                dropdown.style.top = (rect.bottom + 5) + 'px';
                                             }
                                          }
                                       }
                                       
                                       // Close dropdown when clicking outside
                                       document.addEventListener('click', function (event) {
                                          const dropdowns = document.querySelectorAll('.action-menu');
                                          dropdowns.forEach(dropdown => {
                                             if (!dropdown.contains(event.target) && 
                                                !dropdown.previousElementSibling?.contains(event.target)) {
                                                dropdown.classList.add('hidden');
                                             }
                                          });
                                       });
                                       </script>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="table-cell text-center py-4">No approved applications found</td>
                                </tr>
                            @endif
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
    function toggleDropdown(event) {
        event.stopPropagation();
        const dropdownMenu = event.currentTarget.nextElementSibling;
        if (dropdownMenu) {
            dropdownMenu.classList.toggle('hidden');
        }
    }

    document.addEventListener('click', () => {
        const dropdownMenus = document.querySelectorAll('.dropdown-menu');
        dropdownMenus.forEach(menu => menu.classList.add('hidden'));
    });

    // Toggle advanced filter section
    document.getElementById('show-advanced-filters').addEventListener('click', function() {
        const filterSection = document.getElementById('advanced-filter-section');
        filterSection.classList.toggle('hidden');
    });
    
    // Reset filters
    document.getElementById('reset-filters').addEventListener('click', function() {
        document.getElementById('date-from').value = '';
        document.getElementById('date-to').value = '';
        document.getElementById('filter-land-use').selectedIndex = 0;
        document.getElementById('filter-generation').selectedIndex = 0;
        document.getElementById('search-certificates').value = '';
        
        // Reset table to show all rows
        const rows = document.querySelectorAll('#certificates-table tbody tr');
        rows.forEach(row => {
            row.style.display = '';
        });
    });
    
    // Apply filters
    document.getElementById('apply-filters').addEventListener('click', function() {
        const dateFrom = document.getElementById('date-from').value;
        const dateTo = document.getElementById('date-to').value;
        const landUse = document.getElementById('filter-land-use').value;
        const generation = document.getElementById('filter-generation').value;
        const searchText = document.getElementById('search-certificates').value.toLowerCase();
        
        // Get all table rows
        const rows = document.querySelectorAll('#certificates-table tbody tr');
        
        // Filter rows based on criteria
        let totalVisible = 0;
        let generatedVisible = 0;
        let notGeneratedVisible = 0;
        
        rows.forEach(row => {
            const landUseCell = row.querySelector('td:nth-child(6)').textContent.trim();
            const statusCell = row.querySelector('td:nth-child(7)').textContent.trim();
            const rowText = row.textContent.toLowerCase();
            
            // Hide row by default, then check if it meets filter criteria
            let showRow = true;
            
            // Apply land use filter
            if (landUse && landUseCell !== landUse) {
                showRow = false;
            }
            
            // Apply generation filter
            if (generation && !statusCell.includes(generation)) {
                showRow = false;
            }
            
            // Apply search filter
            if (searchText && !rowText.includes(searchText)) {
                showRow = false;
            }
            
            // Show or hide row based on filter results
            row.style.display = showRow ? '' : 'none';
            
            // Count visible rows for stats
            if (showRow) {
                totalVisible++;
                if (statusCell.includes('Generated')) {
                    generatedVisible++;
                } else if (statusCell.includes('Not Generated')) {
                    notGeneratedVisible++;
                }
            }
        });
        
        // Update the statistics counts
        document.getElementById('total-count').textContent = totalVisible;
        document.getElementById('generated-count').textContent = generatedVisible;
        document.getElementById('not-generated-count').textContent = notGeneratedVisible;
    });
    
    // Connect the search box to filter as you type
    document.getElementById('search-certificates').addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        const rows = document.querySelectorAll('#certificates-table tbody tr');
        
        let totalVisible = 0;
        let generatedVisible = 0;
        let notGeneratedVisible = 0;
        
        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            const statusCell = row.querySelector('td:nth-child(7)').textContent.trim();
            const isVisible = rowText.includes(searchText);
            
            row.style.display = isVisible ? '' : 'none';
            
            // Count visible rows for stats
            if (isVisible) {
                totalVisible++;
                if (statusCell.includes('Generated')) {
                    generatedVisible++;
                } else if (statusCell.includes('Not Generated')) {
                    notGeneratedVisible++;
                }
            }
        });
        
        // Update the statistics counts
        document.getElementById('total-count').textContent = totalVisible;
        document.getElementById('generated-count').textContent = generatedVisible;
        document.getElementById('not-generated-count').textContent = notGeneratedVisible;
    });
</script>
@endsection



