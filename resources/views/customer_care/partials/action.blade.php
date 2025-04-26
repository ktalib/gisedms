<div class="flex space-x-2">
  <!-- Call Action -->
  <button onclick="openCallModal({{ $customer->id }}, '{{ $type ?? 'primary' }}')" 
      class="p-1 text-gray-500 hover:text-blue-600 rounded-full hover:bg-gray-100" 
      title="Call Customer">
    <i data-lucide="phone" class="w-4 h-4 text-blue-500"></i>
  </button>
  
  <!-- SMS Action -->
  <button onclick="openSmsModal({{ $customer->id }}, '{{ $type ?? 'primary' }}')" 
      class="p-1 text-gray-500 hover:text-blue-600 rounded-full hover:bg-gray-100" 
      title="Send SMS">
    <i data-lucide="message-square" class="w-4 h-4 text-purple-500"></i>
  </button>
  
  <!-- WhatsApp Action -->
  <button onclick="openWhatsAppModal({{ $customer->id }}, '{{ $type ?? 'primary' }}')" 
      class="p-1 text-gray-500 hover:text-green-600 rounded-full hover:bg-gray-100" 
      title="Send WhatsApp">
     
    <i class="fa-brands fa-whatsapp"  class="w-4 h-4 text-green-500" style="color:green"></i>
  </button>
  
  <!-- Email Action -->
  <button onclick="openEmailModal({{ $customer->id }}, '{{ $type ?? 'primary' }}')" 
      class="p-1 text-gray-500 hover:text-blue-600 rounded-full hover:bg-gray-100" 
      title="Send Email">
    <i data-lucide="mail" class="w-4 h-4 text-red-500"></i>
  </button>
  
  <!-- More Actions Dropdown -->
  <div class="relative" x-data="{ open: false }">
    <button @click="open = !open" 
        class="p-1 text-gray-500 hover:text-blue-600 rounded-full hover:bg-gray-100"
        title="More Actions">
      <i data-lucide="more-vertical" class="w-4 h-4 text-gray-600"></i>
    </button>
    
    <div x-show="open" 
       @click.away="open = false"
       class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
      <div class="py-1">
        <a href="{{ route('customer-care.view-application', ['id' => $customer->id]) }}?type={{ $type ?? 'primary' }}" 
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          <i data-lucide="file-text" class="inline-block w-4 h-4 mr-2 text-blue-500"></i> View Application
        </a>
        
        <a href="{{ route('customer-care.open-file', ['id' => $customer->id]) }}?type={{ $type ?? 'primary' }}" 
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          <i data-lucide="folder-open" class="inline-block w-4 h-4 mr-2 text-amber-500"></i> Open File
        </a>
      </div>
    </div>
  </div>
</div>
