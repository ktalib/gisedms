@extends('layouts.app')
@section('page-title')
    {{ __('APPLICATION FOR SECTIONAL TITLING  MODULE') }}
@endsection
 
@include('sectionaltitling.partials.assets.css')  
@section('content')
   
<div class="flex-1 overflow-auto">
    <!-- Header -->
    <div class="p-6 bg-white border-b border-gray-200">
      <div class="flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-bold">Sectional Titling Module (STM)</h1>
          <p class="text-gray-500">Process CofO for individually owned sections of multi-unit developments</p>
        </div>
        <div class="flex items-center space-x-4">
          <div class="relative">
            <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
            <input
              type="text"
              placeholder="Search applications..."
              class="pl-10 pr-4 py-2 border border-gray-200 rounded-md w-64 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>
          <div class="relative">
            <i data-lucide="bell" class="w-5 h-5"></i>
            <span class="absolute -top-1 -right-1 bg-orange-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
              2
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Dashboard Content -->
    <div class="p-6">
      <!-- Stats Cards - Screenshot 122 -->
   @include('sectionaltitling.partials.statistic.statistic_card')

      <!-- Tabs -->
    @include('sectionaltitling.partials.tabs')
      <!-- Sectional Titling Mandate - Screenshot 122 -->
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-bold mb-2">Sectional Titling Mandate</h2>
        <p class="text-gray-500 text-sm mb-4">Department overview and responsibilities</p>
        
        <p class="text-gray-700 mb-4">
          The Sectional Titling Department is responsible for processing Certificates of Occupancy (CofO) for individually owned sections of multi-unit developments (e.g., plazas, story buildings, offices, apartments) in both 2D/3D formats, ensuring the capture of ownership rights over individual units and common property governed by a Body Corporate.
        </p>
      </div>

      <!-- Service Areas - Screenshot 123 -->
      <div class="grid grid-cols-4 gap-4 mb-8">
        <div class="service-card">
          <div class="flex flex-col items-center mb-4">
            <i data-lucide="users" class="w-10 h-10 text-gray-700 mb-2"></i>
            <h3 class="text-lg font-medium">Customer Care</h3>
          </div>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Receive applications</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Process payments</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Collect documents</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Digital archiving</span>
            </li>
          </ul>
        </div>

        <div class="service-card">
          <div class="flex flex-col items-center mb-4">
            <i data-lucide="layout-grid" class="w-10 h-10 text-gray-700 mb-2"></i>
            <h3 class="text-lg font-medium">Planning</h3>
          </div>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Field validations</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Compliance checks</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Architectural reviews</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Plan approvals</span>
            </li>
          </ul>
        </div>

        <div class="service-card">
          <div class="flex flex-col items-center mb-4">
            <i data-lucide="map-pin" class="w-10 h-10 text-gray-700 mb-2"></i>
            <h3 class="text-lg font-medium">Survey</h3>
          </div>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Field mapping</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Plan digitization</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Reference numbers</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>3D coordinates</span>
            </li>
          </ul>
        </div>

        <div class="service-card">
          <div class="flex flex-col items-center mb-4">
            <i data-lucide="settings" class="w-10 h-10 text-gray-700 mb-2"></i>
            <h3 class="text-lg font-medium">Operations</h3>
          </div>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Process Applications</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Deed Registration</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>Generate CofO</span>
            </li>
            <li class="flex items-start">
              <i data-lucide="check" class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5"></i>
              <span>3D Modelling</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Application Flow - Screenshot 124 -->
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-bold mb-2">Application Flow</h2>
        <p class="text-gray-500 text-sm mb-6">Sectional titling application process</p>
        
        <div class="grid grid-cols-2 gap-6">
          <!-- Primary Application -->
          <div class="bg-white rounded-md border border-gray-200 p-6">
            <div class="flex items-center mb-4">
              <i data-lucide="file-text" class="w-6 h-6 text-gray-700 mr-2"></i>
              <h3 class="text-lg font-medium">Primary Application</h3>
            </div>
            
            <p class="text-gray-600 mb-4">
              Submitted by the original property owner or developer to initiate sectional titling for the entire property.
            </p>
            
            <ul class="space-y-3 mb-6">
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Property details and documentation</span>
              </li>
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Proposed unit layout and floor plans</span>
              </li>
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Define unit details and common property</span>
              </li>
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Generate participation quota</span>
              </li>
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Submit for departmental review</span>
              </li>
            </ul>
            
            <button class="w-full bg-gray-900 text-white py-3 rounded-md flex items-center justify-center">
              <i data-lucide="file-text" class="w-5 h-5 mr-2"></i>
              Create Primary Application
            </button>
          </div>
          
          <!-- Secondary Application -->
          <div class="bg-white rounded-md border border-gray-200 p-6">
            <div class="flex items-center mb-4">
              <i data-lucide="home" class="w-6 h-6 text-gray-700 mr-2"></i>
              <h3 class="text-lg font-medium">Secondary Application</h3>
            </div>
            
            <p class="text-gray-600 mb-4">
              Submitted by individual unit buyers to claim ownership of specific sections within the property.
            </p>
            
            <ul class="space-y-3 mb-6">
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Applicant information</span>
              </li>
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Select/confirm specific unit</span>
              </li>
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Upload proof of purchase</span>
              </li>
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Submit identity and supporting documents</span>
              </li>
              <li class="flex items-start">
                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5"></i>
                <span>Generate individual CofO upon approval</span>
              </li>
            </ul>
            
            <button class="w-full bg-gray-900 text-white py-3 rounded-md flex items-center justify-center">
              <i data-lucide="home" class="w-5 h-5 mr-2"></i>
              Create Secondary Application
            </button>
          </div>
        </div>
      </div>

      <!-- Recent Applications and Workflow Status - Screenshot 125 -->
      <div class="grid grid-cols-3 gap-6 mb-8">
        <!-- Recent Applications -->
        <div class="col-span-2 bg-white rounded-md shadow-sm border border-gray-200 p-6">
          <div class="flex justify-between items-center mb-4">
            <div>
              <h2 class="text-xl font-bold">Recent Applications</h2>
              <p class="text-gray-500 text-sm">Latest sectional title applications</p>
            </div>
            <button class="flex items-center space-x-1 px-3 py-1.5 border border-gray-200 rounded-md text-sm">
              <i data-lucide="filter" class="w-4 h-4"></i>
              <span>Filter</span>
            </button>
          </div>

          <div class="overflow-hidden rounded-md border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="table-header">FileNo</th>
                  <th class="table-header">Type</th>
                  <th class="table-header">Property/Unit</th>
                  <th class="table-header">Applicant</th>
                  <th class="table-header">Status</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach($Primary as $primary)
                <tr>
                  <td class="table-cell text-green-700">{{ $primary->fileno }}</td>
                  <td class="table-cell">
                    <span class="badge badge-primary">Primary</span>
                  </td>
                  <td class="table-cell">{{ $primary->NoOfUnits }} Units</td>
                  <td class="table-cell">
                    <div class="flex items-center">
                      <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                        <i data-lucide="user" class="w-4 h-4 text-gray-500"></i>
                      </div>
                      <div>
                        @if(!empty($primary->applicant_title) && !empty($primary->first_name) && !empty($primary->surname))
                          {{ $primary->applicant_title }} {{ $primary->first_name }} {{ $primary->surname }}
                        @elseif(!empty($primary->corporate_name))
                          {{ $primary->corporate_name }}
                        @elseif(!empty($primary->multiple_owners_names))
                          @php
                            $names = is_string($primary->multiple_owners_names) ? json_decode($primary->multiple_owners_names, true) : $primary->multiple_owners_names;
                          @endphp
                          @if(is_array($names) && count($names) > 0)
                            {{ $names[0] }}
                            <button 
                              class="text-blue-500 underline text-sm" 
                              onclick="showFullNames({{ json_encode($names) }})"
                            >
                              <i data-lucide="info" class="w-4 h-4 inline"></i>
                            </button>
                          @else
                            N/A
                          @endif
                        @else
                          N/A
                        @endif
                      </div>

                      <script>
                        function showFullNames(names) {
                          Swal.fire({
                            title: 'Full Names of Multiple Owners',
                            text: 'The following names are associated with this application:',
                            html: '<ul>' + names.map(name => `<li>${name}</li>`).join('') + '</ul>',
                            icon: 'info',
                            confirmButtonText: 'Close'
                          });
                        }
                      </script>
                    </div>
                  </td>
                  <td class="table-cell">
                    <span class="badge badge-{{ strtolower($primary->application_status) }}">
                      {{ $primary->application_status }}
                    </span>
                  </td>
                </tr>
                @endforeach
                
                @foreach($Secondary as $secondary)
                <tr>
                  <td class="table-cell text-green-700">{{ $secondary->fileno }}</td>
                  <td class="table-cell">
                    <span class="badge badge-primary">Secondary</span>
                  </td>
                  <td class="table-cell">Unit {{ $secondary->unit_number }}</td>
                  <td class="table-cell">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                            <i data-lucide="user" class="w-4 h-4 text-gray-500"></i>
                          </div>
                      <div class="flex items-center">
                        @if(!empty($secondary->applicant_title) && !empty($secondary->first_name) && !empty($secondary->surname))
                          {{ $secondary->applicant_title }} {{ $secondary->first_name }} {{ $secondary->surname }}
                        @elseif(!empty($secondary->corporate_name))
                          {{ $secondary->corporate_name }}
                        @elseif(!empty($secondary->multiple_owners_names))
                          @php
                            $names = is_string($secondary->multiple_owners_names) ? explode(',', str_replace('"', '', $secondary->multiple_owners_names)) : $secondary->multiple_owners_names;
                          @endphp
                          @if(is_array($names) && count($names) > 0)
                            {{ $names[0] }}
                            <button 
                              class="text-blue-500 underline text-sm ml-2" 
                              onclick="showFullNames({{ json_encode($names) }})"
                            >
                              <i data-lucide="info" class="w-4 h-4 inline"></i>
                            </button>
                          @else
                            N/A
                          @endif
                        @else
                          N/A
                        @endif
                      </div>

                      <script>
                        function showFullNames(names) {
                          Swal.fire({
                            title: 'Full Names of Multiple Owners',
                            html: '<ul>' + names.map(name => `<li>${name}</li>`).join('') + '</ul>',
                            icon: 'info',
                            confirmButtonText: 'Close'
                          });
                        }
                      </script>
                    </div>
                  </td>
                  <td class="table-cell">
                    <span class="badge badge-{{ strtolower($secondary->application_status) }}">
                      {{ $secondary->application_status }}
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="mt-4 text-center">
            <button class="text-blue-600 flex items-center mx-auto">
              <span>View All Applications</span>
              <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
            </button>
          </div>
        </div>
        
        <!-- Workflow Status -->
        <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
          <h2 class="text-xl font-bold mb-2">Workflow Status</h2>
          <p class="text-gray-500 text-sm mb-6">Current status of applications by unit</p>
          
          <!-- Customer Care -->
          <div class="mb-4">
            <div class="flex justify-between mb-1">
              <div class="flex items-center">
                <i data-lucide="users" class="w-4 h-4 mr-2 text-gray-500"></i>
                <span>Customer Care</span>
              </div>
              <span class="font-medium">42 applications</span>
            </div>
            <div class="progress-bar">
              <div class="progress-bar-fill progress-bar-blue" style="width: 42%"></div>
            </div>
          </div>
          
          <!-- Planning -->
          <div class="mb-4">
            <div class="flex justify-between mb-1">
              <div class="flex items-center">
                <i data-lucide="layout-grid" class="w-4 h-4 mr-2 text-gray-500"></i>
                <span>Planning</span>
              </div>
              <span class="font-medium">28 applications</span>
            </div>
            <div class="progress-bar">
              <div class="progress-bar-fill progress-bar-blue" style="width: 28%"></div>
            </div>
          </div>
          
          <!-- Survey -->
          <div class="mb-4">
            <div class="flex justify-between mb-1">
              <div class="flex items-center">
                <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-gray-500"></i>
                <span>Survey</span>
              </div>
              <span class="font-medium">15 applications</span>
            </div>
            <div class="progress-bar">
              <div class="progress-bar-fill progress-bar-blue" style="width: 15%"></div>
            </div>
          </div>
          
          <!-- Operations -->
          <div class="mb-6">
            <div class="flex justify-between mb-1">
              <div class="flex items-center">
                <i data-lucide="settings" class="w-4 h-4 mr-2 text-gray-500"></i>
                <span>Operations</span>
              </div>
              <span class="font-medium">15 applications</span>
            </div>
            <div class="progress-bar">
              <div class="progress-bar-fill progress-bar-blue" style="width: 15%"></div>
            </div>
          </div>
          
          <!-- Processing Time -->
          <h3 class="font-medium mb-2">Processing Time</h3>
          
          <div class="mb-2">
            <div class="flex justify-between mb-1">
              <span class="text-gray-600">Average</span>
              <span class="font-medium">14 days</span>
            </div>
          </div>
          
          <div class="mb-2">
            <div class="flex justify-between mb-1">
              <span class="text-gray-600">Fastest</span>
              <span class="font-medium">3 days</span>
            </div>
          </div>
          
          <div class="mb-2">
            <div class="flex justify-between mb-1">
              <span class="text-gray-600">Slowest</span>
              <span class="font-medium">45 days</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="p-6 border-t border-gray-200 flex justify-between items-center text-sm text-gray-500 mt-auto">
      <div>© 2025 Land Admin System. All rights reserved.</div>
      <div class="flex items-center">
        <span class="mr-2">LAAD-Sys</span>
        <div class="bg-green-500 text-white px-2 py-1 rounded text-xs flex items-center">
          <span class="mr-1">Land Admin System</span>
        </div>
      </div>
    </div>
  </div>

@endsection