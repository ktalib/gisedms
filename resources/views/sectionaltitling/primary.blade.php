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
            @include('sectionaltitling.partials.tabs')
      <br>
            {{-- <!-- Stats Cards --> --}}
            @include('sectionaltitling.partials.statistic.statistic_card')
            <!-- Tabs -->
          
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
                        <button style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #fff8f1; border: 2px solid #f97316; border-radius: 0.375rem; cursor: pointer; transition: background-color 0.2s ease;">
                            <i data-lucide="upload" style="width: 1rem; height: 1rem; color: #ea580c;"></i>
                            <span style="font-weight: 500; color: #ea580c;">Import Field Data</span>
                        </button>

                        <style>
                            button:hover {
                                background-color: #fed7aa;
                            }
                        </style>

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
                                <a href="{{ route('primaryform.index') }}?landuse=Mixed" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                    <i data-lucide="layers" class="w-4 h-4 text-purple-500 mr-2"></i>
                                    Mixed 
                                </a>
                            </div>
                        </div>

                  
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="table-header text-green-500">ID</th>
                                <th class="table-header text-green-500">File No</th>
                                <th class="table-header text-green-500">Property</th>
                                <th class="table-header text-green-500">Type</th>
                                <th class="table-header text-green-500">Land Use</th>
                                <th class="table-header text-green-500">Owner</th>
                                <th class="table-header text-green-500">Units</th>
                                <th class="table-header text-green-500">Date</th>
                                <th class="table-header text-green-500">Planning</th>
                                <th class="table-header text-green-500">Status</th>
                                <th class="table-header text-green-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($PrimaryApplications as $PrimaryApplication)
                                <tr>
                                    <td class="table-cell">ST-2025-0{{ $PrimaryApplication->id }}</td> 
                                    <td class="table-cell">{{ $PrimaryApplication->fileno }}</td>
                                     
                                    <td class="table-cell">
                                        <div class="truncate max-w-[150px]" title="{{ $PrimaryApplication->property_plot_no }} {{ $PrimaryApplication->property_street_name }}, {{ $PrimaryApplication->property_lga }}">
                                            {{ $PrimaryApplication->property_plot_no }} {{ $PrimaryApplication->property_street_name }}, {{ $PrimaryApplication->property_lga }}
                                        </div>
                                    </td>
                                    <td class="table-cell">
                                        @if ($PrimaryApplication->commercial_type)
                                            {{ $PrimaryApplication->commercial_type }}
                                        @elseif ($PrimaryApplication->industrial_type)
                                            {{ $PrimaryApplication->industrial_type }}
                                        @elseif ($PrimaryApplication->mixed_type)
                                            {{ $PrimaryApplication->mixed_type }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="table-cell">{{ $PrimaryApplication->land_use }}</td>
                                    <td class="table-cell">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-2">
                                                @if ($PrimaryApplication->passport)
                                                    <img src="{{ asset('storage/app/public/' . $PrimaryApplication->passport) }}" 
                                                         alt="Passport" 
                                                         class="w-full h-full rounded-full object-cover cursor-pointer"
                                                         onclick="showPassportPreview('{{ asset('storage/app/public/' . $PrimaryApplication->passport) }}', 'Owner Passport')">
                                                @elseif ($PrimaryApplication->multiple_owners_passport)
                                                    @php
                                                        $passports = json_decode($PrimaryApplication->multiple_owners_passport, true);
                                                        $firstPassport = $passports[0] ?? null;
                                                    @endphp
                                                    @if ($firstPassport)
                                                        <img src="{{ asset('storage/app/public/' . $firstPassport) }}" 
                                                             alt="Passport" 
                                                             class="w-full h-full rounded-full object-cover cursor-pointer"
                                                             onclick="showMultipleOwners({{ $PrimaryApplication->multiple_owners_names }}, {{ $PrimaryApplication->multiple_owners_passport }})">
                                                    @endif
                                                @endif
                                            </div>
                                            <span class="truncate max-w-[120px]">
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
                                                        onclick="showMultipleOwners({{ $PrimaryApplication->multiple_owners_names }}, {{ $PrimaryApplication->multiple_owners_passport }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </span>
                                                @elseif($PrimaryApplication->first_name || $PrimaryApplication->surname)
                                                    {{ $PrimaryApplication->first_name }} {{ $PrimaryApplication->surname }}
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
                                        <div class="flex items-center">
                                            <span class="badge badge-{{ strtolower($PrimaryApplication->planning_recommendation_status) }}">
                                                {{ $PrimaryApplication->planning_recommendation_status }}
                                            </span>
                                            @if($PrimaryApplication->planning_recommendation_status == 'Declined')
                                                <i data-lucide="info" class="w-4 h-4 ml-1 text-blue-500 cursor-pointer" 
                                                   onclick="showDeclinedInfo(event, 'Planning Recommendation', {{ json_encode($PrimaryApplication->recomm_comments) }}, {{ json_encode($PrimaryApplication->director_comments) }})"></i>
                                            @endif
                                        </div>
                                    </td>  
                                    <td class="table-cell">
                                        <div class="flex items-center">
                                            <span class="badge badge-{{ strtolower($PrimaryApplication->application_status) }}">
                                                {{ $PrimaryApplication->application_status }}
                                            </span>
                                            @if($PrimaryApplication->application_status == 'Declined')
                                                <i data-lucide="info" class="w-4 h-4 ml-1 text-blue-500 cursor-pointer" 
                                                   onclick="showDeclinedInfo(event, 'Application Status', {{ json_encode($PrimaryApplication->recomm_comments) }}, {{ json_encode($PrimaryApplication->director_comments) }})"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-cell overflow-visible relative">
                                        @include('sectionaltitling.action_menu.action')
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
   
@include('sectionaltitling.action_modals.eRegistry_modal') 

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



        function showPassportPreview(imageSrc, title) {
                                                Swal.fire({
                                                    title: title,
                                                    html: `<img src="${imageSrc}" class="img-fluid" style="max-height: 400px;">`,
                                                    width: 'auto',
                                                    showCloseButton: true,
                                                    showConfirmButton: false
                                                });
                                            }
                                              
                                            function showMultipleOwners(owners, passports) {
                                                if (Array.isArray(owners) && owners.length > 0) {
                                                    let htmlContent = '<div class="grid grid-cols-3 gap-4" style="max-width: 600px;">';
                                                    
                                                    owners.forEach((name, index) => {
                                                        const passport = Array.isArray(passports) && passports[index] 
                                                            ? `<img src="{{ asset('storage/app/public/') }}/${passports[index]}" 
                                                                 class="w-24 h-32 object-cover mx-auto border-2 border-gray-300" 
                                                                 style="object-position: center top;">` 
                                                            : '<div class="w-24 h-32 bg-gray-300 mx-auto flex items-center justify-center"><span>No Image</span></div>';
                                                        
                                                        htmlContent += `
                                                            <div class="flex flex-col items-center">
                                                                <div class="passport-container bg-blue-50 p-2 rounded">
                                                                    ${passport}
                                                                    <p class="text-center text-sm font-medium mt-1">${name}</p>
                                                                </div>
                                                            </div>
                                                        `;
                                                    });
                                                    
                                                    htmlContent += '</div>';
                                                    
                                                    Swal.fire({
                                                        title: 'Multiple Owners',
                                                        html: htmlContent,
                                                        width: 'auto',
                                                        showCloseButton: true,
                                                        showConfirmButton: false
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        title: 'Multiple Owners',
                                                        text: 'No owners available',
                                                        icon: 'info',
                                                        confirmButtonText: 'Close'
                                                    });
                                                }
                                            }
                                            
                                            function showDeclinedInfo(event, title, recommComments, directorComments) {
                                                event.stopPropagation();
                                                
                                                let htmlContent = '<div class="text-left">';
                                                if (recommComments) {
                                                    htmlContent += `
                                                        <div class="mb-3">
                                                            <h3 class="font-bold text-gray-700">Recommendation Comments:</h3>
                                                            <p class="text-gray-600 mt-1 p-2 bg-gray-100 rounded">${recommComments}</p>
                                                        </div>
                                                    `;
                                                }
                                                
                                                if (directorComments) {
                                                    htmlContent += `
                                                        <div>
                                                            <h3 class="font-bold text-gray-700">Director Comments:</h3>
                                                            <p class="text-gray-600 mt-1 p-2 bg-gray-100 rounded">${directorComments}</p>
                                                        </div>
                                                    `;
                                                }
                                                
                                                if (!recommComments && !directorComments) {
                                                    htmlContent += '<p>No comments available.</p>';
                                                }
                                                
                                                htmlContent += '</div>';
                                                
                                                Swal.fire({
                                                    title: `Declined: ${title}`,
                                                    html: htmlContent,
                                                    icon: 'info',
                                                    width: 'auto',
                                                    showCloseButton: true,
                                                    showConfirmButton: true,
                                                    confirmButtonText: 'Close'
                                                });
                                            }
    </script>
@endsection
