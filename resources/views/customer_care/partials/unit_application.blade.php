<div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold">Secondary Applications - Customer Care</h2>
    
    <div class="flex items-center space-x-4">
      <div class="relative">
        <select id="secondaryStatusFilter" class="pl-4 pr-8 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
          <option value="all">All...</option>
          <option value="approved">Approved</option>
          <option value="in-progress">In Progress</option>
          <option value="pending">Pending</option>
          <option value="rejected">Rejected</option>
        </select>
        <i data-lucide="chevron-down" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
      </div>
      
      <div class="relative">
        <button id="openSecondaryMessageMenuBtn" class="flex items-center space-x-2 px-4 py-2 border border-gray-200 rounded-md hover:bg-gray-50">
          <i data-lucide="send" class="w-4 h-4 text-gray-600"></i>
          <span>Outreach</span>
          <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
        </button>
        <div id="secondaryMessageTypeMenu" class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-10">
          <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            <!-- Individual Outreach Options -->
            <div class="px-3 py-1 text-xs font-semibold text-gray-500 border-b">Individual Outreach</div>
            <button onclick="promptForIndividualOutreach('call', 'secondary')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
              <i data-lucide="phone" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Call a Customer
            </button>
            <button onclick="promptForIndividualOutreach('sms', 'secondary')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
              <i data-lucide="message-square" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Send SMS
            </button>
            <button onclick="promptForIndividualOutreach('email', 'secondary')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
              <i data-lucide="mail" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Send Email
            </button>
            
            <!-- Divider -->
            <div class="border-t border-gray-100 my-1"></div>
            
            <!-- Bulk Outreach Options -->
            <div class="px-3 py-1 text-xs font-semibold text-gray-500 border-b"></div>
            <button onclick="openBulkSmsModal('secondary')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
              <i data-lucide="message-square" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Send Bulk SMS
            </button>
            <button onclick="openBulkEmailModal('secondary')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
              <i data-lucide="mail" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> Send Bulk Email
            </button>
            <button onclick="openBulkWhatsAppModal('secondary')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left" role="menuitem">
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
            <input type="checkbox" id="selectAllSecondaryCheckbox" class="form-checkbox h-4 w-4" onclick="toggleSelectAll('secondary')">
          </th>
          <th class="table-header whitespace-normal px-1 w-[15%]">ST FileNo</th>
          <th class="table-header whitespace-normal px-1 w-[20%]">Name</th>
          <th class="table-header whitespace-normal px-1 w-[15%]">Passport</th>
          <th class="table-header whitespace-normal px-1 w-[15%]">Phone Number</th>
          <th class="table-header whitespace-normal px-1 w-[20%]">Contact Address</th>
          <th class="table-header whitespace-normal px-1 w-[10%]">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($secondaryApplicationsData ?? [] as $unit)
          <tr>
            <td class="px-1 py-4 text-center">
              <input type="checkbox" class="form-checkbox h-4 w-4 secondary-customer-checkbox" value="{{ $unit->id }}" 
                     data-name="{{ 
                        $unit->applicant_type == 'individual' 
                          ? (($unit->applicant_title ?? '') . ' ' . ($unit->first_name ?? '') . ' ' . ($unit->surname ?? ''))
                          : ($unit->applicant_type == 'corporate' 
                              ? ($unit->corporate_name ?? '') 
                              : implode(', ', json_decode($unit->multiple_owners_names ?? '[]', true) ?? []))
                     }}"
                     data-type="secondary"
                     onclick="toggleCustomerSelection(this, 'secondary')">
            </td>
            <td class="px-1 py-4">{{ $unit->fileno ?? 'N/A' }}</td>
            <td class="px-1 py-4">
              @if($unit->applicant_type == 'individual')
                {{ $unit->applicant_title ?? '' }} {{ $unit->first_name ?? '' }} {{ $unit->surname ?? '' }}
              @elseif($unit->applicant_type == 'corporate')
                {{ $unit->corporate_name ?? '' }}
              @elseif($unit->applicant_type == 'multiple')
                @php
                  $names = json_decode($unit->multiple_owners_names, true) ?? [];
                  echo implode(', ', $names);
                @endphp
              @endif
            </td>
            <td class="px-1 py-4">
              @if($unit->applicant_type == 'individual' || $unit->applicant_type == 'corporate')
                @if($unit->passport)
                  <img src="{{ asset('storage/app/public/' . $unit->passport) }}" alt="Passport" class="h-12 w-12 rounded-full object-cover">
                @else
                  <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-xs text-gray-500">No Image</span>
                  </div>
                @endif
              @elseif($unit->applicant_type == 'multiple')
                @php
                  $passports = json_decode($unit->multiple_owners_passport, true) ?? [];
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
            <td class="px-1 py-4">{{ $unit->phone_number ?? 'N/A' }}</td>
            <td class="px-1 py-4">{{ $unit->address ?? 'N/A' }}</td>
            <td class="px-1 py-4">
              @include('customer_care.partials.action', ['customer' => $unit, 'type' => 'secondary'])
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="px-1 py-4 text-center text-gray-500">No secondary application data found</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="flex justify-between items-center mt-6 text-sm">
    <div class="text-gray-500">Showing {{ count($secondaryApplicationsData ?? []) }} of {{ count($secondaryApplicationsData ?? []) }} secondary applications</div>
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
