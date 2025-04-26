<div class="relative dropdown-container">
   <!-- Dropdown Toggle Button -->
   <button type="button" class="dropdown-toggle p-2 hover:bg-gray-100 focus:outline-none rounded-full" onclick="customToggleDropdown(this, event)">
      <i data-lucide="more-horizontal" class="w-5 h-5"></i>
   </button>
   <!-- Dropdown Menu -->
   <ul class="fixed action-menu z-50 bg-white border rounded-lg shadow-lg hidden w-56">
      <li> 
         <a href="{{ route('sectionaltitling.viewrecorddetail_sub', $app->id) }}" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
         <i data-lucide="eye" class="w-4 h-4 text-blue-600"></i>
         <span>View Record</span>
         </a>
      </li>
   <li>
      <button type="button" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2 payment-btn"
         data-id="{{ $app->id }}">
      <i data-lucide="pencil" class="w-4 h-4 text-green-500"></i>
      <span>Edit Record</span>
      </button>
   </li>
      <li>
         <button type="button" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2"
            data-id="{{ $app->id }}" onclick="openOtherApprovalsModal('{{ $app->id }}')">
         <i data-lucide="trash-2" class="w-4 h-4 text-red-500"></i>
         <span>Delete Record</span>
         </button>
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


