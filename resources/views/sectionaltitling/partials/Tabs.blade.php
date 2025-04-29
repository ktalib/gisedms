<div class="bg-white rounded-lg shadow-md border border-gray-200">
    <div class="px-2 py-1">
        <div class="border-b border-gray-200">
            <nav class="flex flex-wrap items-center justify-center md:space-x-4 lg:space-x-6">
                {{-- Overview --}}
                <a href="{{ route('sectionaltitling.index') }}" class="group flex flex-col items-center py-3 px-3 {{ request()->routeIs('sectionaltitling.index') ? 'border-b-2 border-blue-500' : 'hover:bg-gray-50 rounded-md' }}">
                    <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('sectionaltitling.index') ? 'bg-blue-100 text-blue-600' : 'text-blue-500 group-hover:text-blue-600' }} rounded-full mb-1">
                        <i data-lucide="home" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium {{ request()->routeIs('sectionaltitling.index') ? 'text-blue-600' : 'text-gray-700 group-hover:text-blue-600' }}">Overview</span>
                </a>

                {{-- Customer Care --}}
                <a href="{{ route('customer-care.index') }}" class="group flex flex-col items-center py-3 px-3 {{ request()->routeIs('customer-care.index') ? 'border-b-2 border-green-500' : 'hover:bg-gray-50 rounded-md' }}">
                    <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('customer-care.index') ? 'bg-green-100 text-green-600' : 'text-green-500 group-hover:text-green-600' }} rounded-full mb-1">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium {{ request()->routeIs('customer-care.index') ? 'text-green-600' : 'text-gray-700 group-hover:text-green-600' }}">Customer Care</span>
                </a>

                {{-- Primary --}}
                <a href="{{ route('sectionaltitling.primary') }}" class="group flex flex-col items-center py-3 px-3 {{ request()->routeIs('sectionaltitling.primary') ? 'border-b-2 border-purple-500' : 'hover:bg-gray-50 rounded-md' }}">
                    <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('sectionaltitling.primary') ? 'bg-purple-100 text-purple-600' : 'text-purple-500 group-hover:text-purple-600' }} rounded-full mb-1">
                        <i data-lucide="file" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium {{ request()->routeIs('sectionaltitling.primary') ? 'text-purple-600' : 'text-gray-700 group-hover:text-purple-600' }}">Primary</span>
                </a>

                {{-- Units --}}
                <a href="{{ route('sectionaltitling.secondary') }}" class="group flex flex-col items-center py-3 px-3 {{ request()->routeIs('sectionaltitling.secondary') ? 'border-b-2 border-gray-700' : 'hover:bg-gray-50 rounded-md' }}">
                    <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('sectionaltitling.secondary') ? 'bg-gray-200 text-gray-700' : 'text-gray-500 group-hover:text-gray-700' }} rounded-full mb-1">
                        <i data-lucide="files" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium {{ request()->routeIs('sectionaltitling.secondary') ? 'text-gray-700' : 'text-gray-700 group-hover:text-gray-700' }}">Units</span>
                </a>

                {{-- Planning --}}
                <a href="#" class="group flex flex-col items-center py-3 px-3 hover:bg-gray-50 rounded-md">
                    <div class="flex items-center justify-center w-8 h-8 text-red-500 group-hover:text-red-600 rounded-full mb-1">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-red-600">Planning</span>
                </a>

                {{-- Survey --}}
                <a href="#" class="group flex flex-col items-center py-3 px-3 hover:bg-gray-50 rounded-md">
                    <div class="flex items-center justify-center w-8 h-8 text-amber-500 group-hover:text-amber-600 rounded-full mb-1">
                        <i data-lucide="ruler" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-amber-600">Survey</span>
                </a>

                {{-- Entities --}}
                <a href="{{ route('programmes.entity') }}" class="group flex flex-col items-center py-3 px-3 {{ request()->routeIs('programmes.entity') ? 'border-b-2 border-indigo-500' : 'hover:bg-gray-50 rounded-md' }}">
                    <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('programmes.entity') ? 'bg-indigo-100 text-indigo-600' : 'text-indigo-500 group-hover:text-indigo-600' }} rounded-full mb-1">
                        <i data-lucide="building" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium {{ request()->routeIs('programmes.entity') ? 'text-indigo-600' : 'text-gray-700 group-hover:text-indigo-600' }}">Entities</span>
                </a>

                {{-- Operations --}}
                <a href="#" class="group flex flex-col items-center py-3 px-3 hover:bg-gray-50 rounded-md">
                    <div class="flex items-center justify-center w-8 h-8 text-teal-500 group-hover:text-teal-600 rounded-full mb-1">
                        <i data-lucide="settings" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700 group-hover:text-teal-600">Operations</span>
                </a>
            </nav>
        </div>
    </div>
</div>

<br>
<br>