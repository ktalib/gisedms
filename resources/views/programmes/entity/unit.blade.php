@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING  MODULE') }}
@endsection

 
@section('content')
<div class="flex-1 overflow-auto">
    <!-- Header -->
   @include('admin.header')
    <!-- Dashboard Content -->
    <div class="p-6">
<!-- Tab Navigation -->
@include('sectionaltitling.partials.tabs')
<div class="mb-6">
    <div class="flex border-b border-gray-200">
        <button id="primaryTab" class="px-6 py-3 border-b-2 border-blue-500 text-blue-600 font-medium text-sm focus:outline-none">
            Primary Applications
        </button>
        <button id="secondaryTab" class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm focus:outline-none">
            Secondary Applications
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const primaryTab = document.getElementById('primaryTab');
        const secondaryTab = document.getElementById('secondaryTab');
        
        primaryTab.addEventListener('click', function() {
            primaryTab.classList.add('border-blue-500', 'text-blue-600');
            primaryTab.classList.remove('border-transparent', 'text-gray-500');
            secondaryTab.classList.add('border-transparent', 'text-gray-500');
            secondaryTab.classList.remove('border-blue-500', 'text-blue-600');
            // Add AJAX call or page reload logic here to load primary applications
        });
        
        secondaryTab.addEventListener('click', function() {
            secondaryTab.classList.add('border-blue-500', 'text-blue-600');
            secondaryTab.classList.remove('border-transparent', 'text-gray-500');
            primaryTab.classList.add('border-transparent', 'text-gray-500');
            primaryTab.classList.remove('border-blue-500', 'text-blue-600');
            // Add AJAX call or page reload logic here to load secondary applications
        });
    });
</script>

    <div id="primaryTabContent" class="block">
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-bold">Customer Care</h2>
          
          <div class="flex items-center space-x-4">
            <div class="relative">
              <select id="statusFilter" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                <option value="all">All...</option>
                <option value="approved">Approved</option>
                <option value="in-progress">In Progress</option>
                <option value="pending">Pending</option>
                <option value="rejected">Rejected</option>
              </select>
              <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
            </div>
            
            <button id="openBulkSmsBtn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md hover:bg-gray-50" onclick="openBulkSmsModal()">
              <i data-lucide="message-square" class="w-4 h-4 text-gray-600"></i>
              <span>Send Bulk SMS</span>
            </button>
          </div>
        </div>
        
        <div class="w-full">
          <table class="w-full table-auto divide-y divide-gray-200">
            <thead>
              <tr class="text-xs">
                <th class="table-header whitespace-normal px-1 w-[5%]">
                  <input type="checkbox" id="selectAllCheckbox" class="form-checkbox h-4 w-4" onclick="toggleSelectAll()">
                </th>
                <th class="table-header whitespace-normal px-1 w-[5%]">ID</th>
                <th class="table-header whitespace-normal px-1 w-[8%]">File No</th>
                <th class="table-header whitespace-normal px-1 w-[10%]">Property</th>
                <th class="table-header whitespace-normal px-1 w-[7%]">Type</th>
                <th class="table-header whitespace-normal px-1 w-[8%]">Land Use</th>
                <th class="table-header whitespace-normal px-1 w-[12%]">Owner</th>
                <th class="table-header whitespace-normal px-1 w-[7%]">Units</th>
                <th class="table-header whitespace-normal px-1 w-[8%]">Date</th>
                <th class="table-header whitespace-normal px-1 w-[10%]">Planning</th>
                <th class="table-header whitespace-normal px-1 w-[10%]">Status</th>
 
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse($customerCareData as $customer)
                <tr>
                  <td class="px-1 py-4 text-center">
                    <input type="checkbox" class="form-checkbox h-4 w-4 customer-checkbox" value="{{ $customer->id }}" 
                           data-name="{{ 
                              $customer->applicant_type == 'individual' 
                                ? (($customer->applicant_title ?? '') . ' ' . ($customer->first_name ?? '') . ' ' . ($customer->surname ?? ''))
                                : ($customer->applicant_type == 'corporate' 
                                    ? ($customer->corporate_name ?? '') 
                                    : implode(', ', json_decode($customer->multiple_owners_names ?? '[]', true) ?? []))
                           }}"
                           onclick="toggleCustomerSelection(this)">
                  </td>
                 
                  <td class="px-1 py-4"> </td>
             
                  <td class="px-1 py-4">
                    @include('customer_care.partials.action', ['customer' => $customer])
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="px-1 py-4 text-center text-gray-500">No customer data found</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="flex justify-between items-center mt-6 text-sm">
          <div class="text-gray-500">Showing {{ count($customerCareData) }} of {{ count($customerCareData) }} applications</div>
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

      <div  id='secondaryTabContent' class="hidden">
         
      @include('customer_care.partials.unit_application')
      
      </div>
    </div>
    <!-- Footer -->
    @include('admin.footer')
  </div>
  
  <!-- Include the modals -->
  
@endsection
