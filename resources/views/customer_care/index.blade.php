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
            
            <div class="relative">
              <button id="openMessageMenuBtn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md hover:bg-gray-50">
                <i data-lucide="send" class="w-4 h-4 text-gray-600"></i>
                <span>Outreach</span>
                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
              </button>
              <div id="messageTypeMenu" class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-10">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                  <!-- Individual Outreach Options -->
                  <div class="px-3 py-1 text-xs font-semibold text-gray-500 border-b">Individual Outreach</div>
                  <button onclick="promptForIndividualOutreach('call')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
                    <i data-lucide="phone" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Call a Customer
                  </button>
                  <button onclick="promptForIndividualOutreach('sms')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
                    <i data-lucide="message-square" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Send SMS
                  </button>
                  <button onclick="promptForIndividualOutreach('email')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
                    <i data-lucide="mail" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Send Email
                  </button>
                  
                  <!-- Divider -->
                  <div class="border-t border-gray-100 my-1"></div>
                  
                  <!-- Bulk Outreach Options -->
                  <div class="px-3 py-1 text-xs font-semibold text-gray-500 border-b"></div>
                  <button onclick="openBulkSmsModal()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
                    <i data-lucide="message-square" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Send Bulk SMS
                  </button>
                  <button onclick="openBulkEmailModal()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
                    <i data-lucide="mail" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Send Bulk Email
                  </button>
                  <button onclick="openBulkWhatsAppModal()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
                    <i data-lucide="message-circle" class="inline-block w-4 h-4 mr-2 text-green-500"></i> Send WhatsApp
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="w-full">
          <table class="w-full table-auto divide-y divide-gray-200">
            <thead>
              <tr class="text-xs">
                <th class="table-header whitespace-normal px-1 w-[5%]">
                  <input type="checkbox" id="selectAllCheckbox" class="form-checkbox h-4 w-4" onclick="toggleSelectAll()">
                </th>
                <th class="table-header whitespace-normal px-1 w-[25%]">Name</th>
                <th class="table-header whitespace-normal px-1 w-[15%]">Passport</th>
                <th class="table-header whitespace-normal px-1 w-[15%]">Phone Number</th>
                <th class="table-header whitespace-normal px-1 w-[20%]">Contact Address</th>
                <th class="table-header whitespace-normal px-1 w-[15%]">Email Address</th>
                <th class="table-header whitespace-normal px-1 w-[10%]">Actions</th>
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
                  <td class="px-1 py-4">
                    @if($customer->applicant_type == 'individual')
                      {{ $customer->applicant_title ?? '' }} {{ $customer->first_name ?? '' }} {{ $customer->surname ?? '' }}
                    @elseif($customer->applicant_type == 'corporate')
                      {{ $customer->corporate_name ?? '' }}
                    @elseif($customer->applicant_type == 'multiple')
                      @php
                        $names = json_decode($customer->multiple_owners_names, true) ?? [];
                        echo implode(', ', $names);
                      @endphp
                    @endif
                  </td>
                  <td class="px-1 py-4">
                    @if($customer->applicant_type == 'individual' || $customer->applicant_type == 'corporate')
                      @if($customer->passport)
                        <img src="{{ asset('storage/app/public/' . $customer->passport) }}" alt="Passport" class="h-12 w-12 rounded-full object-cover">
                      @else
                        <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                          <span class="text-xs text-gray-500">No Image</span>
                        </div>
                      @endif
                    @elseif($customer->applicant_type == 'multiple')
                      @php
                        $passports = json_decode($customer->multiple_owners_passport, true) ?? [];
                      @endphp
                      @if(count($passports) > 0)
                        <div class="flex -space-x-2">
                          @foreach(array_slice($passports, 0, 3) as $passport)
                            <img src="{{ asset('storage/app/public/' . $passport) }}" alt="Passport" class="h-8 w-8 rounded-full border border-white object-cover">
                          @endforeach
                          @if(count($passports) > 3)
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center border border-white">
                              <span class="text-xs text-gray-500">+{{ count($passports) - 3 }}</span>
                            </div>
                          @endif
                        </div>
                      @else
                        <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                          <span class="text-xs text-gray-500">No Images</span>
                        </div>
                      @endif
                    @endif
                  </td>
                  <td class="px-1 py-4">{{ $customer->phone_number ?? 'N/A' }}</td>
                  <td class="px-1 py-4">{{ $customer->address ?? 'N/A' }}</td>
                  <td class="px-1 py-4">{{ $customer->email ?? 'N/A' }}</td>
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
  @include('customer_care.partials.call_modal')
  @include('customer_care.partials.sms_modal')
  @include('customer_care.partials.email_modal')
  @include('customer_care.partials.whatsapp_modal')
  @include('customer_care.partials.bulk_sms_modal')
  @include('customer_care.partials.bulk_email_modal')
  @include('customer_care.partials.bulk_whatsapp_modal')
  @include('customer_care.partials.js')

@endsection
