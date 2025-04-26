<div class="bg-white rounded-md shadow-sm border border-gray-200 p-4 mb-6">
    <div class="flex flex-wrap items-center justify-between">
        <h3 class="text-md font-medium text-gray-700 mb-2 sm:mb-0">Report Date Filter</h3>
        <div class="flex flex-wrap items-center space-x-2">
            <select id="unit-date-range-preset" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                <option value="all" selected>All Time</option>
                <option value="7days">Last 7 Days</option>
                <option value="30days">Last 30 Days</option>
                <option value="custom">Custom Range</option>
            </select>
            
            <div id="unit-custom-date-range" class="hidden flex items-center space-x-2">
                <input type="date" id="unit-date-from" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <span>to</span>
                <input type="date" id="unit-date-to" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button id="unit-apply-custom-range" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Apply</button>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Total Unit Applications</h3>
        <div class="mt-2 flex justify-between items-end">
            <p class="text-3xl font-bold text-gray-800">{{ $totalUnitApplications ?? 0 }}</p>
            <div class="flex items-center text-green-600">
                <i data-lucide="file-text" class="w-5 h-5"></i>
            </div>
        </div>
    </div>
    

    <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Planning Recommendation</h3>
        <div class="mt-2 flex justify-between items-end">
            <div>
                <div class="flex items-center space-x-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>
                    <span class="text-sm text-gray-600">Approved: {{ $approvedUnitPlanningRecommendations ?? 0 }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-yellow-500"></span>
                    <span class="text-sm text-gray-600">Pending: {{ $pendingUnitPlanningRecommendations ?? 0 }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-sm text-gray-600">Declined: {{ $DeclinedUnitPlanningRecommendations ?? 0 }}</span>
                </div>
            </div>
            <div class="flex items-center text-purple-600">
                <i data-lucide="clipboard-check" class="w-5 h-5"></i>
            </div>
        </div>
    </div>


    <div class="stat-card bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-sm font-medium text-gray-500">Director's Approval</h3>
        <div class="mt-2 flex justify-between items-end">
            <div>
                <div class="flex items-center space-x-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>
                    <span class="text-sm text-gray-600">Approved: {{ $approvedUnitApplications ?? 0 }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-yellow-500"></span>
                    <span class="text-sm text-gray-600">Pending: {{ $pendingUnitApplications ?? 0 }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-sm text-gray-600">Declined: {{ $DeclinedUnitApplications ?? 0 }}</span>
                </div>
            </div>
            <div class="flex items-center text-blue-600">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
        </div>
    </div>
    
</div>

<!-- Charts Section -->
<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Unit Application Status</h3>
        <div id="unit-application-status-chart" style="height: 250px;"></div>
    </div>
    
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Monthly Unit Applications</h3>
        <div id="unit-monthly-trend-chart" style="height: 250px;"></div>
    </div>
</div>

<!-- Applicant Type & Land Use Charts -->
<div class="grid grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Unit Applications by Applicant Type</h3>
        <div id="unit-applicant-type-chart" style="height: 250px;"></div>
    </div>
    
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-4">
        <h3 class="text-md font-medium text-gray-700 mb-4">Unit Applications by Land Use</h3>
        <div id="unit-land-use-chart" style="height: 250px;"></div>
    </div>
</div>

<!-- Unit Applications Table -->
<div id="unit-content" class="p-6">
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Unit Application Report</h2>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <select id="unit-filter" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                        <option value="all">All Applications</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                        <option value="Declined">Declined</option>
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                </div>
{{--                 
                <button id="print-unit-btn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
                    <i data-lucide="printer" class="w-4 h-4 text-gray-600"></i>
                    <span>Print</span>
                </button>
                
                <button id="export-unit-btn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
                    <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
                    <span>Export</span>
                </button> --}}
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table id="unit-applications-table" class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="table-header">File No</th>
                        <th class="table-header">Unit Owner</th>
                        <th class="table-header">LGA</th>
                        <th class="table-header">Block/Floor/Unit</th>
                       
                        <th class="table-header">Planning Recomm Approval</th>
                        <th class="table-header">Director's Approval</th>
                        <th class="table-header">Created On</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if(isset($unitApplications) && count($unitApplications) > 0)
                        @foreach($unitApplications as $application)
                            <tr>
                                <td class="table-cell">{{ $application->fileno }}</td>
                                <td class="table-cell">{{ $application->owner_name }}</td>
                                <td class="table-cell">{{ $application->property_lga }}</td>
                                <td class="table-cell">
                                    Block: {{ $application->block_number ?? 'N/A' }}, 
                                    Floor: {{ $application->floor_number ?? 'N/A' }}, 
                                    Unit: {{ $application->unit_number ?? 'N/A' }}
                                </td>
                         
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
                                    @if($application->application_status == 'Approved')
                                        <span class="badge badge-approved">Approved</span>
                                    @elseif($application->application_status == 'Declined')
                                        <span class="badge badge-declined">Declined</span>
                                    @else
                                        <span class="badge badge-pending">Pending</span>
                                    @endif
                                </td>
                                <td class="table-cell">{{ $application->created_at ? \Carbon\Carbon::parse($application->created_at)->format('d M, Y') : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="table-cell text-center py-4">No unit applications found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Store the original data for filtering
        const originalUnitApplications = {!! json_encode($unitApplications ?? []) !!};
        let filteredUnitApplications = [...originalUnitApplications];
        
        // Date range filter functionality for unit applications
        const unitDateRangePreset = document.getElementById('unit-date-range-preset');
        const unitCustomDateRange = document.getElementById('unit-custom-date-range');
        const unitDateFrom = document.getElementById('unit-date-from');
        const unitDateTo = document.getElementById('unit-date-to');
        const unitApplyCustomRange = document.getElementById('unit-apply-custom-range');
        
        // References to charts for updating
        let unitStatusChart, unitMonthlyTrendChart, unitApplicantTypeChart, unitLandUseChart;
        
        // Set default dates for the custom range
        const today = new Date();
        unitDateTo.valueAsDate = today;
        
        const thirtyDaysAgo = new Date();
        thirtyDaysAgo.setDate(today.getDate() - 30);
        unitDateFrom.valueAsDate = thirtyDaysAgo;
        
        // Show/hide custom date range inputs based on selection
        unitDateRangePreset.addEventListener('change', function() {
            if (this.value === 'custom') {
                unitCustomDateRange.classList.remove('hidden');
            } else {
                unitCustomDateRange.classList.add('hidden');
                applyUnitDateFilter(this.value);
            }
        });
        
        // Apply custom date range filter
        unitApplyCustomRange.addEventListener('click', function() {
            applyUnitDateFilter('custom');
        });
        
        // Function to apply date filter to all unit report elements
        function applyUnitDateFilter(filterType) {
            let startDate, endDate;
            const today = new Date();
            
            // Set the date range based on filter type
            switch(filterType) {
                case '7days':
                    startDate = new Date();
                    startDate.setDate(today.getDate() - 7);
                    endDate = today;
                    break;
                case '30days':
                    startDate = new Date();
                    startDate.setDate(today.getDate() - 30);
                    endDate = today;
                    break;
                case 'custom':
                    startDate = new Date(unitDateFrom.value);
                    endDate = new Date(unitDateTo.value);
                    // Add 1 day to end date to include the end date in the range
                    endDate.setDate(endDate.getDate() + 1);
                    break;
                default: // 'all'
                    // Reset to original data
                    filteredUnitApplications = [...originalUnitApplications];
                    updateAllUnitReportElements();
                    
                    // Reset the DataTable filter if it exists
                    if ($.fn.DataTable.isDataTable('#unit-applications-table')) {
                        $('#unit-applications-table').DataTable().search('').columns().search('').draw();
                    }
                    return;
            }
            
            // Filter the applications based on date range
            filteredUnitApplications = originalUnitApplications.filter(app => {
                if (!app.created_at) return false;
                
                const appDate = new Date(app.created_at);
                return appDate >= startDate && appDate <= endDate;
            });
            
            // Update all report elements with filtered data
            updateAllUnitReportElements();
            
            // Apply filter to DataTable if it exists
            if ($.fn.DataTable.isDataTable('#unit-applications-table')) {
                const table = $('#unit-applications-table').DataTable();
                
                // Clear any existing search/filter
                table.search('').columns().search('').draw();
                
                // Create array of filtered file numbers for more reliable filtering
                const filteredFileNos = filteredUnitApplications.map(app => app.fileno);
                
                // Re-draw the table with only visible rows that match our filtered IDs
                table.rows().every(function() {
                    const rowData = this.data();
                    const fileNo = rowData[0]; // Assuming file number is in the first column
                    
                    // Find if this row's application exists in our filtered data
                    const matchingApp = filteredUnitApplications.find(app => app.fileno === fileNo);
                    
                    // Show/hide row based on match
                    if (matchingApp) {
                        this.nodes().to$().show();
                    } else {
                        this.nodes().to$().hide();
                    }
                });
                
                // Update DataTable info display
                table.draw(false); // false to keep current pagination
            }
        }
        
        // Update all unit report elements with filtered data
        function updateAllUnitReportElements() {
            updateUnitStatCards();
            updateUnitCharts();
        }
        
        // Update unit statistical cards - Fixed selectors
        function updateUnitStatCards() {
            // Calculate updated statistics
            const totalApps = filteredUnitApplications.length;
            const approvedApps = filteredUnitApplications.filter(app => app.application_status === 'Approved').length;
            const declinedApps = filteredUnitApplications.filter(app => app.application_status === 'Declined').length;
            const pendingApps = totalApps - approvedApps - declinedApps;
            
            const approvedPlanningRecs = filteredUnitApplications.filter(app => app.planning_recommendation_status === 'Approved').length;
            const declinedPlanningRecs = filteredUnitApplications.filter(app => app.planning_recommendation_status === 'Declined').length;
            const pendingPlanningRecs = totalApps - approvedPlanningRecs - declinedPlanningRecs;
            
            // Update stat cards with new values - Fix selectors
            document.querySelector('.stat-card:nth-child(1) .text-3xl').textContent = totalApps;
            
            // Director's Approval stat card
            const directorCard = document.querySelector('.stat-card:nth-child(2)');
            if (directorCard) {
                const directorStats = directorCard.querySelectorAll('.flex.items-center.space-x-2');
                if (directorStats.length >= 3) {
                    directorStats[0].querySelector('.text-sm.text-gray-600').textContent = `Approved: ${approvedApps}`;
                    directorStats[1].querySelector('.text-sm.text-gray-600').textContent = `Pending: ${pendingApps}`;
                    directorStats[2].querySelector('.text-sm.text-gray-600').textContent = `Declined: ${declinedApps}`;
                }
            }
            
            // Planning Recommendation stat card
            const planningCard = document.querySelector('.stat-card:nth-child(3)');
            if (planningCard) {
                const planningStats = planningCard.querySelectorAll('.flex.items-center.space-x-2');
                if (planningStats.length >= 3) {
                    planningStats[0].querySelector('.text-sm.text-gray-600').textContent = `Approved: ${approvedPlanningRecs}`;
                    planningStats[1].querySelector('.text-sm.text-gray-600').textContent = `Pending: ${pendingPlanningRecs}`;
                    planningStats[2].querySelector('.text-sm.text-gray-600').textContent = `Declined: ${declinedPlanningRecs}`;
                }
            }
        }
        
        // Update all unit charts with filtered data
        function updateUnitCharts() {
            // Update unit application status donut chart
            if (unitStatusChart) {
                const approvedApps = filteredUnitApplications.filter(app => app.application_status === 'Approved').length;
                const declinedApps = filteredUnitApplications.filter(app => app.application_status === 'Declined').length;
                const pendingApps = filteredUnitApplications.length - approvedApps - declinedApps;
                
                unitStatusChart.updateSeries([approvedApps, pendingApps, declinedApps]);
            }
            
            // Update unit monthly trend chart
            if (unitMonthlyTrendChart) {
                const monthlyData = getMonthlyTrendData(filteredUnitApplications);
                unitMonthlyTrendChart.updateOptions({
                    xaxis: {
                        categories: monthlyData.labels
                    }
                });
                unitMonthlyTrendChart.updateSeries([{
                    name: 'Unit Applications',
                    data: monthlyData.values
                }]);
            }
            
            // Update unit applicant type chart
            if (unitApplicantTypeChart) {
                const individual = filteredUnitApplications.filter(app => app.applicant_type === 'individual').length;
                const corporate = filteredUnitApplications.filter(app => app.applicant_type === 'corporate').length;
                const multiple = filteredUnitApplications.filter(app => app.applicant_type === 'multiple').length;
                
                unitApplicantTypeChart.updateSeries([individual, corporate, multiple]);
            }
            
            // Update unit land use chart
            if (unitLandUseChart) {
                const residential = filteredUnitApplications.filter(app => app.land_use === 'Residential').length;
                const commercial = filteredUnitApplications.filter(app => app.land_use === 'Commercial').length;
                const industrial = filteredUnitApplications.filter(app => app.land_use === 'Industrial').length;
                const mixedUse = filteredUnitApplications.filter(app => app.land_use === 'Mixed Use').length;
                
                unitLandUseChart.updateSeries([residential, commercial, industrial, mixedUse]);
            }
        }
        
        // Helper function to calculate monthly trend data from filtered applications
        function getMonthlyTrendData(applications) {
            const monthlyCount = {};
            
            applications.forEach(app => {
                if (!app.created_at) return;
                
                const month = new Date(app.created_at).toISOString().substring(0, 7); // YYYY-MM format
                monthlyCount[month] = (monthlyCount[month] || 0) + 1;
            });
            
            // Sort months chronologically
            const sortedMonths = Object.keys(monthlyCount).sort();
            const monthlyValues = sortedMonths.map(month => monthlyCount[month]);
            
            return {
                labels: sortedMonths,
                values: monthlyValues
            };
        }
        
        // Initialize charts if ApexCharts is available
        if (typeof ApexCharts !== 'undefined') {
            // Unit Application Status Donut Chart
            const unitStatusChartOptions = {
                series: [
                    {{ $approvedUnitApplications ?? 0 }}, 
                    {{ $pendingUnitApplications ?? 0 }}, 
                    {{ $DeclinedUnitApplications ?? 0 }}
                ],
                chart: {
                    type: 'donut',
                    height: 250
                },
                labels: ['Approved', 'Pending', 'Declined'],
                colors: ['#10B981', '#F59E0B', '#EF4444'],
                legend: {
                    position: 'bottom'
                }
            };
            
            unitStatusChart = new ApexCharts(document.querySelector("#unit-application-status-chart"), unitStatusChartOptions);
            unitStatusChart.render();
            
            // Monthly Trend Line Chart for Unit Applications (Changed from bar to line)
            const unitMonthlyTrendOptions = {
                series: [{
                    name: 'Unit Applications',
                    data: {!! json_encode($unitApplicationCountByMonth ?? []) !!}
                }],
                chart: {
                    type: 'line',
                    height: 250,
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 4
                },
                xaxis: {
                    categories: {!! json_encode($unitMonthLabels ?? []) !!},
                    labels: {
                        rotate: -45,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                colors: ['#EC4899'],
                yaxis: {
                    title: {
                        text: 'Number of Unit Applications'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " applications"
                        }
                    }
                }
            };
            
            unitMonthlyTrendChart = new ApexCharts(document.querySelector("#unit-monthly-trend-chart"), unitMonthlyTrendOptions);
            unitMonthlyTrendChart.render();
            
            // Applicant Type Donut Chart for Unit Applications
            const unitApplicantTypeData = {
                'Individual': {{ collect($unitApplications ?? [])->where('applicant_type', 'individual')->count() }},
                'Corporate Body': {{ collect($unitApplications ?? [])->where('applicant_type', 'corporate')->count() }},
                'Multiple Owners': {{ collect($unitApplications ?? [])->where('applicant_type', 'multiple')->count() }}
            };
            
            const unitApplicantTypeChartOptions = {
                series: Object.values(unitApplicantTypeData),
                chart: {
                    type: 'donut',
                    height: 250
                },
                labels: Object.keys(unitApplicantTypeData),
                colors: ['#8B5CF6', '#EC4899', '#F59E0B'],
                legend: {
                    position: 'bottom'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            
            unitApplicantTypeChart = new ApexCharts(document.querySelector("#unit-applicant-type-chart"), unitApplicantTypeChartOptions);
            unitApplicantTypeChart.render();
            
            // Land Use Donut Chart for Unit Applications
            const unitLandUseData = {
                'Residential': {{ collect($unitApplications ?? [])->where('land_use', 'Residential')->count() }},
                'Commercial': {{ collect($unitApplications ?? [])->where('land_use', 'Commercial')->count() }},
                'Industrial': {{ collect($unitApplications ?? [])->where('land_use', 'Industrial')->count() }},
                'Mixed Use': {{ collect($unitApplications ?? [])->where('land_use', 'Mixed Use')->count() }}
            };
            
            const unitLandUseChartOptions = {
                series: Object.values(unitLandUseData),
                chart: {
                    type: 'donut',
                    height: 250
                },
                labels: Object.keys(unitLandUseData),
                colors: ['#3B82F6', '#10B981', '#F97316', '#A855F7'],
                legend: {
                    position: 'bottom'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            
            unitLandUseChart = new ApexCharts(document.querySelector("#unit-land-use-chart"), unitLandUseChartOptions);
            unitLandUseChart.render();
        }
        
        // Setup DataTable if available
        if (typeof $.fn.DataTable !== 'undefined') {
            $('#unit-applications-table').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        }
        
        // Setup filter functionality
        $('#unit-filter').on('change', function() {
            const filterValue = $(this).val();
            let table = $('#unit-applications-table').DataTable();
            
            if (filterValue === 'all') {
                table.search('').columns().search('').draw();
            } else if (filterValue === 'approved') {
                table.column(4).search('Approved').draw();
            } else if (filterValue === 'pending') {
                table.column(4).search('Pending').draw();
            } else if (filterValue === 'Declined') {
                table.column(4).search('Declined').draw();
            }
        });
        
        // Print button functionality
        $('#print-unit-btn').on('click', function() {
            window.print();
        });
        
        // Export functionality is handled by DataTables buttons
    });
</script>
