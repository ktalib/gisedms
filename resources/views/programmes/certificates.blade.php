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
            <h2 class="text-xl font-bold mb-6">ST  Certificate of Occupancy Management</h2>
            
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
                    <p class="text-3xl font-bold text-gray-800 mt-2" id="total-count">{{ count($approvedUnitApplications) }}</p>
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
                                <th class="table-header">Scheme No</th>
                                <th class="table-header">Unit Owner</th>
                                <th class="table-header">LGA</th>
                                <th class="table-header">Block/Floor/Unit</th>
                                <th class="table-header">Land Use</th>
                                <th class="table-header">Certificate Status</th>
                                <th class="table-header">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(count($approvedUnitApplications) > 0)
                                @foreach($approvedUnitApplications as $application)
                                    <tr>
                                        <td class="table-cell">{{ $application->fileno }}</td> 
                                        <td class="table-cell">{{ $application->scheme_no }}</td>
                                        <td class="table-cell">{{ $application->owner_name }}</td>
                                        <td class="table-cell">{{ $application->property_lga }}</td>
                                        <td class="table-cell">
                                            Block: {{ $application->block_number ?? 'N/A' }}, 
                                            Floor: {{ $application->floor_number ?? 'N/A' }}, 
                                            Unit: {{ $application->unit_number ?? 'N/A' }}
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
                                              <button type="button" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2" onclick="openCertificateModal('{{ $application->id }}')">
                                                <i data-lucide="file-text" class="w-4 h-4 text-green-500"></i>
                                                <span>Generate Front Page</span>
                                              </button>
                                            </li>
                                            <li>
                                              <button type="button" class="w-full text-left px-4 py-2 flex items-center space-x-2 text-gray-400 cursor-not-allowed pointer-events-none bg-gray-50" onclick="openCertificateModal('{{ $application->id }}')">
                                                <i data-lucide="file-text" class="w-4 h-4 text-gray-300"></i>
                                                <span>View Front Page</span>
                                              </button>
                                            </li>
                                            <li>
                                              <a href="#" class="w-full text-left px-4 py-2 flex items-center space-x-2 text-gray-400 cursor-not-allowed pointer-events-none bg-gray-50">
                                                <i data-lucide="map" class="w-4 h-4 text-gray-300"></i>
                                                <span>View TDP</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class="w-full text-left px-4 py-2 flex items-center space-x-2 text-gray-400 cursor-not-allowed pointer-events-none bg-gray-50">
                                                <i data-lucide="file-text" class="w-4 h-4 text-gray-300"></i>
                                                <span>View CofO</span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="#" class="w-full text-left px-4 py-2 flex items-center space-x-2 text-gray-400 cursor-not-allowed pointer-events-none bg-gray-50">
                                                <i data-lucide="printer" class="w-4 h-4 text-gray-300"></i>
                                                <span>Print CofO</span>
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
                                    <td colspan="7" class="table-cell text-center py-4">No approved applications found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Certificate Issuance Modal -->
    <div id="certificate-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity backdrop-blur-sm"></div>
        
        <div class="relative bg-white rounded-xl shadow-2xl max-w-3xl w-full p-8 z-10">
          <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h3 class="text-2xl font-bold text-gray-800">Issue Certificate of Occupancy</h3>
            <button type="button" onclick="closeCertificateModal()" class="text-gray-400 hover:text-gray-700 transition-colors duration-200 rounded-full p-2 hover:bg-gray-100">
              <i data-lucide="x" class="w-5 h-5"></i>
            </button>
          </div>
          
          <form id="certificate-form" class="space-y-6">
            <input type="hidden" id="application-id">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="block text-sm font-medium text-gray-700 mb-1">Certificate Number</label>
                <input type="text" id="certificate-number" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-25 bg-white">
                <p class="mt-1 text-xs text-gray-500">Unique identifier for this certificate</p>
              </div>
              
              <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="block text-sm font-medium text-gray-700 mb-1">Issue Date</label>
                <input type="date" id="issue-date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-25 bg-white">
                <p class="mt-1 text-xs text-gray-500">Official date of certificate issuance</p>
              </div>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
              <label class="block text-sm font-medium text-gray-700 mb-1">Authorized Officer</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i data-lucide="user" class="h-5 w-5 text-gray-400"></i>
                </div>
                <input type="text" id="authorized-officer" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-25 bg-white">
              </div>
              <p class="mt-1 text-xs text-gray-500">Name of the government official authorizing this certificate</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
              <label class="block text-sm font-medium text-gray-700 mb-1">Certificate Comments</label>
              <div class="relative">
                <div class="absolute top-3 left-3 pointer-events-none">
                  <i data-lucide="message-square" class="h-5 w-5 text-gray-400"></i>
                </div>
                <textarea id="certificate-comments" rows="3" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-25 bg-white" placeholder="Add any relevant notes about this certificate..."></textarea>
              </div>
            </div>
            
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
              <label class="block text-sm font-medium text-gray-700 mb-2">Upload Signed Certificate (PDF)</label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md bg-white">
                <div class="space-y-1 text-center">
                  <i data-lucide="upload-cloud" class="mx-auto h-12 w-12 text-gray-400"></i>
                  <div class="flex text-sm text-gray-600">
                    <label for="certificate-file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                      <span>Upload a file</span>
                      <input id="certificate-file" type="file" class="sr-only" accept=".pdf">
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs text-gray-500">PDF up to 10MB</p>
                </div>
              </div>
            </div>
            
            <div class="flex justify-end space-x-4 pt-4 border-t">
              <button type="button" onclick="closeCertificateModal()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                Cancel
              </button>
              <button type="button" onclick="issueCertificate()" class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                Issue Certificate
              </button>
            </div>
          </form>
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
        document.getElementById('filter-status').selectedIndex = 0;
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
        const status = document.getElementById('filter-status').value;
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
            const landUseCell = row.querySelector('td:nth-child(5)').textContent.trim();
            const statusCell = row.querySelector('td:nth-child(6)').textContent.trim();
            const rowText = row.textContent.toLowerCase();
            
            // Hide row by default, then check if it meets filter criteria
            let showRow = true;
            
            // Apply land use filter
            if (landUse && landUseCell !== landUse) {
                showRow = false;
            }
            
            // Apply status filter
            if (status && !statusCell.includes(status)) {
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
            
            // Apply date filter (if implemented in the backend)
            // This would require date information in the table
            
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
            const statusCell = row.querySelector('td:nth-child(6)').textContent.trim();
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
    
    // Make the land use filter work
    document.getElementById('filter-land-use-mobile').addEventListener('change', function() {
        const landUse = this.value;
        const rows = document.querySelectorAll('#certificates-table tbody tr');
        
        rows.forEach(row => {
            if (!landUse) {
                row.style.display = '';
                return;
            }
            
            const landUseCell = row.querySelector('td:nth-child(5)').textContent.trim();
            row.style.display = landUseCell === landUse ? '' : 'none';
        });
    });
    
    // Sync the two land use filters
    document.getElementById('filter-land-use').addEventListener('change', function() {
        document.getElementById('filter-land-use-mobile').value = this.value;
    });
    
    document.getElementById('filter-land-use-mobile').addEventListener('change', function() {
        document.getElementById('filter-land-use').value = this.value;
    });
</script>
@endsection

