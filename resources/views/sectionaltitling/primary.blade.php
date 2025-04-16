@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING  MODULE') }}
@endsection


@include('sectionaltitling.partials.assets.css')
@section('content')
    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        @include('admin.header')
        <!-- Dashboard Content -->
        <div class="p-6">
            <!-- Stats Cards -->
            @include('sectionaltitling.partials.statistic.statistic_card')
            <!-- Tabs -->
            @include('sectionaltitling.partials.tabs')
      
            <!-- Primary Applications Overview - Screenshot 129 -->
            @include('sectionaltitling.partials.statistic.PrimaryApplications')
            <!-- Primary Applications Table -->
            <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Primary Applications</h2>

                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <select
                                class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                                <option>All...</option>
                                <option>Approved</option>
                                <option>Pending</option>
                                <option>Declined</option>
                            </select>
                            <i data-lucide="chevron-down"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                        </div>

                        <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
                            <i data-lucide="upload" class="w-4 h-4 text-gray-600"></i>
                            <span>Import Field Data</span>
                        </button>

                        <button class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md">
                            <i data-lucide="download" class="w-4 h-4 text-gray-600"></i>
                            <span>Export</span>
                        </button>

                        <div class="relative">
                            <button onclick="toggleDropdown(event)" class="flex items-center space-x-2 px-4 py-2 bg-gray-900 text-white rounded-md">
                                <i data-lucide="file-plus" class="w-4 h-4"></i>
                                <span>New Primary Application</span>
                                <i data-lucide="chevron-down" class="w-4 h-4 ml-2"></i>
                            </button>
                            <div class="absolute mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden dropdown-menu">
                                <a href="{{ route('primaryform.index') }}?landuse=Residential" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                    <i data-lucide="home" class="w-4 h-4 text-blue-500 mr-2"></i>
                                    Residential
                                </a>
                                <a href="{{ route('primaryform.index') }}?landuse=Commercial" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                    <i data-lucide="briefcase" class="w-4 h-4 text-green-500 mr-2"></i>
                                    Commercial
                                </a>
                                <a href="{{ route('primaryform.index') }}?landuse=Industrial" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                    <i data-lucide="factory" class="w-4 h-4 text-red-500 mr-2"></i>
                                    Industrial
                                </a>
                            </div>
                        </div>

                  
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="table-header">ID</th>
                                <th class="table-header">File No</th>
                                <th class="table-header">Property</th>
                                <th class="table-header">Type</th>
                                <th class="table-header">Landuse</th>
                                <th class="table-header">Owner</th>
                                <th class="table-header">Units</th>
                                <th class="table-header">Date</th>
                                <th class="table-header">Planning</th>
                                <th class="table-header">Director</th>
                                <th class="table-header">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($PrimaryApplications as $PrimaryApplication)
                                <tr>
                                    <td class="table-cell">{{ $PrimaryApplication->id }}</td>
                                    <td class="table-cell">{{ $PrimaryApplication->fileno }}</td>
                                    <td class="table-cell">{{ $PrimaryApplication->property_plot_no }}
                                        {{ $PrimaryApplication->property_street_name }}, {{ $PrimaryApplication-> property_lga}}</td>
                                    <td class="table-cell">{{ $PrimaryApplication->applicant_type }}</td>
                                    <td class="table-cell">{{ $PrimaryApplication->land_use }}</td>
                                    <td class="table-cell">
                                        <div class="flex items-center">
                                            <div
                                                class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-gray-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <span>
                                                @if ($PrimaryApplication->corporate_name)
                                                    {{ $PrimaryApplication->corporate_name }}
                                                @elseif($PrimaryApplication->multiple_owners_names)
                                                    @php
                                                        $ownerNames = json_decode(
                                                            $PrimaryApplication->multiple_owners_names,
                                                            true,
                                                        );
                                                        $firstOwner = $ownerNames[0] ?? 'Unknown Owner';
                                                    @endphp
                                                    {{ $firstOwner }}
                                                    <span class="ml-1 cursor-pointer text-blue-500"
                                                        onclick="showFullNames({{ $PrimaryApplication->multiple_owners_names }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </span>
                                                @elseif($PrimaryApplication->first_name || $PrimaryApplication->surname)
                                                    {{ $PrimaryApplication->applicant_title }}
                                                    {{ $PrimaryApplication->first_name }}
                                                    {{ $PrimaryApplication->surname }}
                                                @else
                                                    Unknown Owner
                                                @endif
                                            </span>
                                        </div>
                                    </td>
                                    <td class="table-cell">{{ $PrimaryApplication->NoOfUnits }}</td>
                                    <td class="table-cell">
                                        {{ \Carbon\Carbon::parse($PrimaryApplication->created_at)->format('Y-m-d') }}</td>
                                    <td class="table-cell">
                                        <span
                                            class="badge badge-{{ strtolower($PrimaryApplication->planning_recommendation_status) }}">
                                            {{ $PrimaryApplication->planning_recommendation_status }}
                                        </span>
                                    </td>
                                    <td class="table-cell">
                                        <span
                                            class="badge badge-{{ strtolower($PrimaryApplication->application_status) }}">
                                            {{ $PrimaryApplication->application_status }}
                                        </span>
                                    </td>
                                    <td class="table-cell">
                                        <button class="text-gray-400 hover:text-gray-600">
                                            <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                                          </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-between items-center mt-6 text-sm">
                    <div class="text-gray-500">Showing 5 of 68 applications</div>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-1 border border-gray-200 rounded-md flex items-center">
                            <i data-lucide="chevron-left" class="w-4 h-4 mr-1"></i>
                            <span>Previous</span>
                        </button>
                        <button class="px-3 py-1 border border-gray-200 rounded-md flex items-center">
                            <span>Next</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('admin.footer')
    </div>

    <script>
        function showFullNames(owners) {
            if (Array.isArray(owners) && owners.length > 0) {
                Swal.fire({
                    title: 'Full Names of Multiple Owners',
                    text: 'The following names are associated with this application:',
                    html: '<ul>' + owners.map(name => `<li>${name}</li>`).join('') + '</ul>',
                    icon: 'info',
                    confirmButtonText: 'Close'
                });
            } else {
                Swal.fire({
                    title: 'Full Names of Multiple Owners',
                    text: 'No owners available',
                    icon: 'info',
                    confirmButtonText: 'Close'
                });
            }
        }

     
        function toggleDropdown(event) {
            const dropdown = event.currentTarget.nextElementSibling;
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    
</script>
@endsection
