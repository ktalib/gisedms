<div class="relative dropdown-container" 
     x-data="{ 
        open: false, 
        top: '0px', 
        left: '0px', 
        position: 'above',
        updatePosition() {
            if (!this.open) return;
            
            const rect = this.$el.querySelector('.dropdown-toggle').getBoundingClientRect();
            const menuHeight = this.$refs.dropdown.offsetHeight;
            const viewportHeight = window.innerHeight;
            
            // Calculate space above and below
            const spaceAbove = rect.top;
            const spaceBelow = viewportHeight - rect.bottom;
            
            // Determine optimal position based on available space
            if (spaceBelow >= menuHeight || spaceBelow > spaceAbove) {
                this.top = `${rect.bottom + 5}px`;
            } else {
                this.top = `${rect.top - menuHeight - 5}px`;
            }
            
            // Calculate horizontal position
            const menuWidth = this.$refs.dropdown.offsetWidth;
            let calculatedLeft = rect.left - menuWidth + rect.width;
            
            // Prevent dropdown from going off the left edge
            if (calculatedLeft < 10) {
                calculatedLeft = 10;
            }
            
            this.left = `${calculatedLeft}px`;
        }
     }"
     x-init="$watch('open', value => {
        if (value) {
            $nextTick(() => updatePosition());
            window.addEventListener('scroll', updatePosition);
            window.addEventListener('resize', updatePosition);
        } else {
            window.removeEventListener('scroll', updatePosition);
            window.removeEventListener('resize', updatePosition);
        }
     })">
   <!-- Dropdown Toggle Button -->
   <button type="button" class="dropdown-toggle p-2 hover:bg-gray-100 focus:outline-none rounded-full" 
     @click.stop="
       open = !open;
       if (open) {
           $nextTick(() => updatePosition());
       }
     ">
      <i data-lucide="more-horizontal" class="w-5 h-5"></i>
   </button>
   <!-- Dropdown Menu -->
   <ul x-ref="dropdown" x-show="open" 
       @click.outside="open = false" 
       x-bind:style="`position: fixed; top: ${top}; left: ${left};`"
       class="action-menu z-50 bg-white border rounded-lg shadow-lg w-56" 
       style="display: none;">

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
          <span>Create Unit Application</span>
          </a>
       </li>
       @endif
      @if(($PrimaryApplication->planning_recommendation_status == 'Pending' && $PrimaryApplication->application_status == 'Pending') || !isset($PrimaryApplication->sub_applications) || count($PrimaryApplication->sub_applications) === 0)
      <li class="opacity-50 cursor-not-allowed">
         <a href="#" class="w-full text-left px-4 py-2 flex items-center space-x-2">
         <i data-lucide="list" class="w-4 h-4 text-gray-500"></i>
         <span>View Unit Application(s)</span>
         </a>
      </li>
      @else
      <li>
         <a href="{{ route('sectionaltitling.sub_applications') }}?main_application_id={{ $PrimaryApplication->id }}" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
         <i data-lucide="list" class="w-4 h-4 text-blue-600"></i>
         <span>View Unit Application(s)</span>
         </a>
      </li>
      @endif
   </ul>
 </div>
