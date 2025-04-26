<div class="flex space-x-6 border-b border-gray-200 mb-8">
    <div class="tab {{ request()->routeIs('programmes.approvals.other-departments*') ? 'active' : '' }}">
      <a href="{{ route('programmes.approvals.other-departments') }}">Survey</a>
    </div>
    <div class="tab {{ request()->routeIs('programmes.approvals.deeds*') ? 'active' : '' }}">
      <a href="{{ route('programmes.approvals.deeds') }}">Deeds</a>
    </div>
  
    <div class="tab {{ request()->routeIs('programmes.approvals.lands*') ? 'active' : '' }}">
      <a href="{{ route('programmes.approvals.lands') }}">
        Lands
      </a>
      </div>
 
  </div>