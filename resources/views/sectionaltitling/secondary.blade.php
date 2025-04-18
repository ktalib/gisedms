@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING  MODULE') }}
@endsection


@include('sectionaltitling.partials.assets.css')
@section('content')
<div class="flex-1 overflow-auto">
    <!-- Header -->
   @include('admin.header')
    <!-- Dashboard Content -->
    <div class="p-6">
      <!-- Stats Cards -->
        
     @include('sectionaltitling.partials.statistic.statistic_card')

      <!-- Tabs -->
      @include('sectionaltitling.partials.tabs')
      <!-- SecondaryApplications Overview  -->
      @include('sectionaltitling.partials.statistic.SecondaryApplications')
      <!-- Secondary Applications Table - Screenshot 135 -->
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-bold">Secondary Applications</h2>
          
          <div class="flex items-center space-x-4">
            <div class="relative">
              <select class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                <option>All...</option>
                <option>Approved</option>
                <option>In Progress</option>
                <option>Pending</option>
                <option>Rejected</option>
              </select>
              <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
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
              <button class="flex items-center space-x-2 px-4 py-2 bg-gray-900 text-white rounded-md">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>New Secondary Application</span>
              </button>
            </div>
          </div>
        </div>
        
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
            <th class="table-header">Primary App ID</th>
            <th class="table-header">Primary File No</th>
            <th class="table-header">ST File No</th>
            <th class="table-header">Land Use</th>
            <th class="table-header">Original Owner</th>
            <th class="table-header">Unit Owner Name</th>
            <th class="table-header">Unit</th>
            <th class="table-header">Phone Number</th>
            <th class="table-header">Planning Rec.</th>
            <th class="table-header">Application Status</th>
            <th class="table-header">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($SecondaryApplications as $app)
              <tr>
            <td class="table-cell">ST-2025-0{{ $app->main_application_id ?? 'N/A' }}</td>
            <td class="table-cell">{{ $app->mother_fileno ?? 'N/A' }}</td>
            <td class="table-cell">{{ $app->fileno ?? 'N/A' }}</td>
            <td class="table-cell">{{ $app->land_use ?? 'N/A' }}</td>
            <td class="table-cell">
              <div class="flex items-center">
            @if(!empty($app->mother_corporate_name))
            <div class="w-6 h-6 rounded-full bg-purple-200 flex items-center justify-center mr-2">
              <i data-lucide="building" class="w-3 h-3 text-purple-500"></i>
            </div>
            <div>
              <span>{{ $app->mother_corporate_name }}</span>
               
            </div>
            @elseif(!empty($app->mother_multiple_owners_names))
            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center mr-2">
              <i data-lucide="users" class="w-3 h-3 text-gray-500"></i>
            </div>
            <div>
              <span>
                @php
                  $names = $app->mother_multiple_owners_names;
                  $decoded = [];
                  if (!empty($names)) {
                    $decoded = is_array($names) ? $names : json_decode($names, true);
                    if (!is_array($decoded)) $decoded = [];
                  }
                  echo !empty($decoded) && isset($decoded[0]) ? $decoded[0] : '';
                @endphp
              </span>
              @if(!empty($decoded))
              <span class="ml-1 cursor-pointer text-blue-500"
                    onclick='showFullNames(@json($decoded))'>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </span>
              @endif
            </div>
            @else
            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center mr-2">
              <i data-lucide="user" class="w-3 h-3 text-gray-500"></i>
            </div>
            <span>{{ $app->mother_applicant_title ?? '' }} {{ $app->mother_first_name ?? '' }} {{ $app->mother_surname ?? '' }}</span>
            @endif
              </div>
            </td>
            <td class="table-cell">
              <div class="flex items-center">
            @if(!empty($app->corporate_name))
            <div class="w-6 h-6 rounded-full bg-purple-200 flex items-center justify-center mr-2">
              <i data-lucide="building" class="w-3 h-3 text-purple-500"></i>
            </div>
            <div>
              <span>{{ $app->corporate_name }}</span>
        
            </div>
            @elseif(!empty($app->multiple_owners_names))
            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center mr-2">
              <i data-lucide="users" class="w-3 h-3 text-gray-500"></i>
            </div>
            <div class="flex items-center">
              <span>
                @php
                  $names = $app->multiple_owners_names;
                  // Try to decode as JSON, fallback to CSV
                  $decoded = [];
                  if (!empty($names)) {
                    if (is_array($names)) {
                      $decoded = $names;
                    } else {
                      $tryJson = json_decode($names, true);
                      if (is_array($tryJson)) {
                        $decoded = $tryJson;
                      } else {
                        // Remove quotes and split by comma for CSV
                        $decoded = array_map('trim', str_getcsv($names));
                      }
                    }
                  }
                  echo !empty($decoded) && isset($decoded[0]) ? $decoded[0] : '';
                @endphp
              </span>
              @if(!empty($decoded))
              <span class="ml-1 cursor-pointer text-blue-500"
                    onclick='showFullNames(@json($decoded))'>
                <i data-lucide="info" class="h-4 w-4 inline"></i>
              </span>
              @endif
            </div>
            @else
            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center mr-2">
              <i data-lucide="user" class="w-3 h-3 text-gray-500"></i>
            </div>
            <span>{{ $app->applicant_title ?? '' }} {{ $app->first_name ?? '' }} {{ $app->surname ?? '' }}</span>
            @endif
              </div>
            </td>
            <td class="table-cell">{{ $app->unit_number ?? 'N/A' }}</td>
            <td class="table-cell">{{ $app->phone_number ?? 'N/A' }}</td>
            <td class="table-cell">
              <span class="badge badge-{{ strtolower($app->planning_recommendation_status) === 'approved' ? 'approved' : (strtolower($app->planning_recommendation_status) === 'rejected' ? 'rejected' : (strtolower($app->planning_recommendation_status) === 'in progress' ? 'progress' : 'pending')) }}">
            {{ $app->planning_recommendation_status ?? 'Pending' }}
              </span>
            </td>
            <td class="table-cell">
              <span class="badge badge-{{ strtolower($app->application_status) === 'approved' ? 'approved' : (strtolower($app->application_status) === 'rejected' ? 'rejected' : (strtolower($app->application_status) === 'in progress' ? 'progress' : 'pending')) }}">
            {{ $app->application_status ?? 'Pending' }}
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
          <div class="text-gray-500">Showing 5 of 180 applications</div>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
window.showFullNames = function(owners) {
  if (!Array.isArray(owners)) {
    owners = [];
  }
  if (owners.length > 0) {
    Swal.fire({
      title: 'Full Names of Multiple Owners',
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
</script>
