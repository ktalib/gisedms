@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Data View') }}
@endsection

@section('styles')

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
    }
  </style>

<!-- Add the script at the beginning of the content section to ensure it's loaded before the buttons -->
<script>
  function showTab(tabId) {
    // Hide all tab contents
    document.getElementById('primary-survey').classList.add('hidden');
    document.getElementById('unit-survey').classList.add('hidden');
    
    // Reset all tab buttons
    document.getElementById('primary-survey-tab').classList.remove('bg-green-600', 'text-white');
    document.getElementById('primary-survey-tab').classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-200');
    document.getElementById('unit-survey-tab').classList.remove('bg-green-600', 'text-white');
    document.getElementById('unit-survey-tab').classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-200');
    
    // Show selected tab content
    document.getElementById(tabId).classList.remove('hidden');
    
    // Highlight active tab button
    document.getElementById(tabId + '-tab').classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-200');
    document.getElementById(tabId + '-tab').classList.add('bg-green-600', 'text-white');
  }
  
  // Add dropdown toggle functionality
  function customToggleDropdown(button, event) {
    event.stopPropagation();
    
    // Close all other open dropdowns first
    const allMenus = document.querySelectorAll('.action-menu');
    allMenus.forEach(menu => {
      if (menu !== button.nextElementSibling && !menu.classList.contains('hidden')) {
        menu.classList.add('hidden');
      }
    });
    
    // Toggle the clicked dropdown
    const menu = button.nextElementSibling;
    menu.classList.toggle('hidden');
    
    // Position the dropdown near the button
    if (!menu.classList.contains('hidden')) {
      const rect = button.getBoundingClientRect();
      menu.style.top = rect.bottom + 'px';
      menu.style.left = (rect.left - menu.offsetWidth + rect.width) + 'px';
    }
  }
  
  // Close dropdowns when clicking outside
  document.addEventListener('click', function(event) {
    const allMenus = document.querySelectorAll('.action-menu');
    allMenus.forEach(menu => {
      menu.classList.add('hidden');
    });
  });
</script>

<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
    <!-- Payments Overview -->
   @include('programmes.partials.other_tabs')
      <!-- Payments Table -->
  
      <!-- Primary Application Surveys -->
    <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Lands</h2>
        </div>
        
        <div class="flex flex-col items-center justify-center py-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-yellow-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Under Construction</h3>
            <p class="text-gray-600 max-w-md">
                The Land section is currently being developed. Please check back later for updates.
            </p>
        </div>
    </div>
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>
@endsection

@section('scripts')
@endsection


