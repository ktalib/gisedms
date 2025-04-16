<div class="flex space-x-6 border-b border-gray-200 mb-8">
    <a href="{{ route('sectionaltitling.index') }}" class="tab {{ request()->routeIs('sectionaltitling.index') ? 'active' : '' }}">Overview</a>
    <a href="#" class="tab">Customer Care</a>
    <a href="{{ route('sectionaltitling.primary') }}" class="tab {{ request()->routeIs('sectionaltitling.primary') ? 'active' : '' }}">Primary Applications</a>
    <a href="{{ route('sectionaltitling.secondary') }}" class="tab {{ request()->routeIs('sectionaltitling.secondary') ? 'active' : '' }}">Secondary Applications</a>
    <a href="#" class="tab">Planning</a>
    <a href="#" class="tab">Survey</a>
    <a href="#" class="tab">Operations</a>
    <a href="#" class="tab">Body Corporate</a>
</div>
