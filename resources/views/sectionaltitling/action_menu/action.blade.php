<div class="relative dropdown-container">
   <!-- Dropdown Toggle Button -->
   <button type="button" class="dropdown-toggle p-2 hover:bg-gray-100 focus:outline-none rounded-full" onclick="customToggleDropdown(this, event)">
      <i data-lucide="more-horizontal" class="w-5 h-5"></i>
   </button>
   <!-- Dropdown Menu -->
   <ul class="fixed action-menu z-50 bg-white border rounded-lg shadow-lg hidden w-56">
      <li>
         <a href="{{ route('sectionaltitling.viewrecorddetail')}}?id={{$PrimaryApplication->id}}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
          <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
          <span>View Application</span>
          </a>
       </li>
    <li>
      <a  href="{{ route('actions.payments', ['id' => $PrimaryApplication->id]) }}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
       <i data-lucide="credit-card" class="w-4 h-4 text-green-500"></i>
       <span>Payments</span>
      </a>
    </li>
       <li>
          <a  href="{{ route('actions.other-departments', ['id' => $PrimaryApplication->id]) }}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
          <i data-lucide="layout-grid" class="w-4 h-4 text-red-500"></i>
          <span>Other Departments</span>
       </a>
       </li>
       <li>
          <button type="button" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2"
             onclick="openERegistryModal('{{ $PrimaryApplication->id }}')">
          <i data-lucide="database" class="w-4 h-4 text-red-500"></i>
          <span>e-Registry</span>
          </button>
       </li>
       <li>
         <a  href="{{ route('actions.recommendation', ['id' => $PrimaryApplication->id]) }}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
          <i data-lucide="clipboard-check" class="w-4 h-4 text-blue-500"></i>
          <span>Planning Recommendation</span>
         </a>
       </li>
      <li>
         <a href="{{ route('actions.director-approval', ['id' => $PrimaryApplication->id]) }}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
         <i data-lucide="check-circle" class="w-4 h-4 text-green-500"></i>
         <span>Director's Approval</span>
         </a>
      </li>
       </li>
       <li>
         <a  href="{{ route('actions.final-conveyance', ['id' => $PrimaryApplication->id]) }}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
          <i data-lucide="file-text" class="w-4 h-4 text-orange-500"></i>
          <span>Final Conveyance</span>
         </a>
       <li>
       </li>
       @if ($PrimaryApplication->application_status == 'Approved')
       <li>
          <a href="{{ route('sectionaltitling.sub_application', [
             'application_id' => $PrimaryApplication->id,
             'land_use' => $PrimaryApplication->land_use,
             ]) }}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
          <i data-lucide="plus-square" class="w-4 h-4 text-green-500"></i>
          <span>Create Unit Application</span>
          </a>
       </li>
       @else
       <li class="opacity-50 cursor-not-allowed">
          <a href="#" class="w-full text-left px-4 py-2 flex items-center space-x-2">
          <i data-lucide="plus-square" class="w-4 h-4 text-gray-500"></i>
          <span>Create Unit Application (Disabled)</span>
          </a>
       </li>
       @endif
       <li>
          <a href="{{ route('sectionaltitling.sub_applications') }}?main_application_id={{ $PrimaryApplication->id }}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
          <i data-lucide="list" class="w-4 h-4 text-blue-600"></i>
          <span> View Unit Application(s)</span>
          </a>
       </li>
   </ul>
 </div>

<script>
function customToggleDropdown(button, event) {
   event.stopPropagation();
   const dropdown = button.closest('.dropdown-container').querySelector('.action-menu');
   
   // Toggle visibility
   dropdown.classList.toggle('hidden');
   
   if (!dropdown.classList.contains('hidden')) {
      // Get button position
      const rect = button.getBoundingClientRect();
      
      // Position dropdown above the button
      dropdown.style.top = (rect.top - dropdown.offsetHeight - 5) + 'px';
      dropdown.style.left = (rect.left - dropdown.offsetWidth + rect.width) + 'px';
      
      // Check if dropdown would appear off the top of the screen
      if (rect.top - dropdown.offsetHeight < 0) {
         // If so, position it below the button instead
         dropdown.style.top = (rect.bottom + 5) + 'px';
      }
   }
}

// Close dropdown when clicking outside
document.addEventListener('click', function (event) {
   const dropdowns = document.querySelectorAll('.action-menu');
   dropdowns.forEach(dropdown => {
      if (!dropdown.contains(event.target) && 
         !dropdown.previousElementSibling?.contains(event.target)) {
         dropdown.classList.add('hidden');
      }
   });
});
</script>
