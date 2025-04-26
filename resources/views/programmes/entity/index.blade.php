@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING MODULE') }}
@endsection

@section('content')
<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include('admin.header')
    <!-- Dashboard Content -->
    <div class="p-6">
        <!-- Tab Navigation -->
        @include('sectionaltitling.partials.tabs')
        
        <!-- Main Tabs (Primary/Unit) -->
        <div class="mb-6">
            <div class="flex border-b border-gray-200">
                <button id="primaryTab" class="px-6 py-3 border-b-2 border-blue-500 text-blue-600 font-medium text-sm focus:outline-none">
                    Primary Applications <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $primaryStats['total'] }}</span>
                </button>
                <button id="unitTab" class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm focus:outline-none">
                    Unit Applications <span class="ml-2 bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $unitStats['total'] }}</span>
                </button>
            </div>
        </div>

        <!-- Primary Applications Content -->
        <div id="primaryTabContent" class="block">
            <!-- Primary Applications Report Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Applications</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $primaryStats['total'] }}</h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i data-lucide="file-text" class="h-6 w-6 text-blue-600"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Individual</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $primaryStats['individual'] }}</h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i data-lucide="user" class="h-6 w-6 text-green-600"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $primaryStats['total'] > 0 ? ($primaryStats['individual'] / $primaryStats['total'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Body Corporate</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $primaryStats['corporate'] }}</h3>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i data-lucide="building" class="h-6 w-6 text-purple-600"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $primaryStats['total'] > 0 ? ($primaryStats['corporate'] / $primaryStats['total'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Multiple Owners</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $primaryStats['multiple'] }}</h3>
                        </div>
                        <div class="bg-amber-100 p-3 rounded-full">
                            <i data-lucide="users" class="h-6 w-6 text-amber-600"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-amber-600 h-2 rounded-full" style="width: {{ $primaryStats['total'] > 0 ? ($primaryStats['multiple'] / $primaryStats['total'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sub Tabs for Primary Applications -->
            <div class="mb-4 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button id="primary-individual-tab" class="inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 border-blue-500 text-blue-600 active" role="tab" aria-controls="primary-individual" aria-selected="true">
                            <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                            Individual <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $primaryStats['individual'] }}</span>
                        </button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button id="primary-corporate-tab" class="inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300" role="tab" aria-controls="primary-corporate" aria-selected="false">
                            <i data-lucide="building" class="w-4 h-4 mr-2"></i>
                            Body Corporate <span class="ml-2 bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $primaryStats['corporate'] }}</span>
                        </button>
                    </li>
                    <li role="presentation">
                        <button id="primary-multiple-tab" class="inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300" role="tab" aria-controls="primary-multiple" aria-selected="false">
                            <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                            Multiple Owners <span class="ml-2 bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $primaryStats['multiple'] }}</span>
                        </button>
                    </li>
                </ul>
            </div>
            
            <!-- Primary Sub Tab Contents -->
            <div id="primary-individual" class="block" role="tabpanel" aria-labelledby="primary-individual-tab">
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Individual Applicants</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto divide-y divide-gray-200">
                            <thead>
                                <tr class="text-xs">
                                    
                                    <th class="table-header whitespace-normal px-1 w-[8%]">FileNo</th>
                                    <th class="table-header whitespace-normal px-1 w-[10%]">Property</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Type</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Land Use</th>
                                    <th class="table-header whitespace-normal px-1 w-[12%]">Owner</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Units</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($individualApplications as $app)
                                <tr>
                                    
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->fileno }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->property_street_name ?? 'N/A' }}, {{ $app->property_lga ?? 'N/A' }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">Individual</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->land_use }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->owner_name }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->NoOfUnits ?? 0 }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                                
                                
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-1 py-4 text-center text-gray-500">No individual applications found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div id="primary-corporate" class="hidden" role="tabpanel" aria-labelledby="primary-corporate-tab">
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Corporate Applicants</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto divide-y divide-gray-200">
                            <thead>
                                <tr class="text-xs">
                                    
                                    <th class="table-header whitespace-normal px-1 w-[8%]">FileNo</th>
                                    <th class="table-header whitespace-normal px-1 w-[10%]">Property</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Type</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Land Use</th>
                                    <th class="table-header whitespace-normal px-1 w-[12%]">Owner</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Units</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($corporateApplications as $app)
                                <tr>
                                 
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->fileno }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->property_street_name ?? 'N/A' }}, {{ $app->property_lga ?? 'N/A' }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">Corporate</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->land_use }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->owner_name }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->NoOfUnits ?? 0 }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                               
                           
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-1 py-4 text-center text-gray-500">No corporate applications found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div id="primary-multiple" class="hidden" role="tabpanel" aria-labelledby="primary-multiple-tab">
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Multiple Owners</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto divide-y divide-gray-200">
                            <thead>
                                <tr class="text-xs">
                                  
                                    <th class="table-header whitespace-normal px-1 w-[8%]">FileNo</th>
                                    <th class="table-header whitespace-normal px-1 w-[10%]">Property</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Type</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Land Use</th>
                                    <th class="table-header whitespace-normal px-1 w-[12%]">Owner</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Units</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Date</th>
                           
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($multipleApplications as $app)
                                <tr>
                                    
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->fileno }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->property_street_name ?? 'N/A' }}, {{ $app->property_lga ?? 'N/A' }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">Multiple</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->land_use }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->owner_name }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->NoOfUnits ?? 0 }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                            
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-1 py-4 text-center text-gray-500">No applications with multiple owners found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit Applications Content -->
        <div id="unitTabContent" class="hidden">
            <!-- Unit Applications Report Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Units</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $unitStats['total'] }}</h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i data-lucide="file-text" class="h-6 w-6 text-blue-600"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Individual</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $unitStats['individual'] }}</h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i data-lucide="user" class="h-6 w-6 text-green-600"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $unitStats['total'] > 0 ? ($unitStats['individual'] / $unitStats['total'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Body Corporate</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $unitStats['corporate'] }}</h3>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i data-lucide="building" class="h-6 w-6 text-purple-600"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $unitStats['total'] > 0 ? ($unitStats['corporate'] / $unitStats['total'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Multiple Owners</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $unitStats['multiple'] }}</h3>
                        </div>
                        <div class="bg-amber-100 p-3 rounded-full">
                            <i data-lucide="users" class="h-6 w-6 text-amber-600"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-amber-600 h-2 rounded-full" style="width: {{ $unitStats['total'] > 0 ? ($unitStats['multiple'] / $unitStats['total'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sub Tabs for Unit Applications -->
            <div class="mb-4 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button id="unit-individual-tab" class="inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 border-blue-500 text-blue-600 active" role="tab" aria-controls="unit-individual" aria-selected="true">
                            <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                            Individual <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $unitStats['individual'] }}</span>
                        </button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button id="unit-corporate-tab" class="inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300" role="tab" aria-controls="unit-corporate" aria-selected="false">
                            <i data-lucide="building" class="w-4 h-4 mr-2"></i>
                            Body Corporate <span class="ml-2 bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $unitStats['corporate'] }}</span>
                        </button>
                    </li>
                    <li role="presentation">
                        <button id="unit-multiple-tab" class="inline-flex items-center px-4 py-2 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300" role="tab" aria-controls="unit-multiple" aria-selected="false">
                            <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                            Multiple Owners <span class="ml-2 bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $unitStats['multiple'] }}</span>
                        </button>
                    </li>
                </ul>
            </div>
            
            <!-- Unit Sub Tab Contents -->
            <div id="unit-individual" class="block" role="tabpanel" aria-labelledby="unit-individual-tab">
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Individual Unit Applicants</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto divide-y divide-gray-200">
                            <thead>
                                <tr class="text-xs">
                                    
                                    <th class="table-header whitespace-normal px-1 w-[8%]">ST FileNo</th>
                                    <th class="table-header whitespace-normal px-1 w-[10%]">Property</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Type</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Land Use</th>
                                    <th class="table-header whitespace-normal px-1 w-[12%]">Unit Owner</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Units</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Date</th>
          
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($unitIndividualApplications as $app)
                                <tr>
                                     
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->fileno }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->property_location ?? 'N/A' }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">Individual</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->land_use }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->owner_name }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">1</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                      
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-1 py-4 text-center text-gray-500">No individual unit applications found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div id="unit-corporate" class="hidden" role="tabpanel" aria-labelledby="unit-corporate-tab">
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Corporate Unit Applicants</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto divide-y divide-gray-200">
                            <thead>
                                <tr class="text-xs">
                                    
                                    <th class="table-header whitespace-normal px-1 w-[8%]">ST FileNo</th>
                                    <th class="table-header whitespace-normal px-1 w-[10%]">Property</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Type</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Land Use</th>
                                    <th class="table-header whitespace-normal px-1 w-[12%]">Unit Owner</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Units</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Date</th>
    
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($unitCorporateApplications as $app)
                                <tr>
                                    
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->fileno }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->property_location ?? 'N/A' }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">Corporate</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->land_use }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->owner_name }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">1</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                              
                               
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-1 py-4 text-center text-gray-500">No corporate unit applications found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div id="unit-multiple" class="hidden" role="tabpanel" aria-labelledby="unit-multiple-tab">
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Multiple Owners Unit Applications</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto divide-y divide-gray-200">
                            <thead>
                                <tr class="text-xs">
                                   
                                    <th class="table-header whitespace-normal px-1 w-[8%]">ST FileNo</th>
                                    <th class="table-header whitespace-normal px-1 w-[10%]">Property</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Type</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Land Use</th>
                                    <th class="table-header whitespace-normal px-1 w-[12%]">Unit Owner</th>
                                    <th class="table-header whitespace-normal px-1 w-[7%]">Units</th>
                                    <th class="table-header whitespace-normal px-1 w-[8%]">Date</th>
                           
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($unitMultipleApplications as $app)
                                <tr>
                                     
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->fileno }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->property_location ?? 'N/A' }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">Multiple</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->land_use }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ $app->owner_name }}</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">1</td>
                                    <td class="px-1 py-2 text-sm text-gray-900">{{ date('d-m-Y', strtotime($app->created_at)) }}</td>
                             
                              
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-1 py-4 text-center text-gray-500">No unit applications with multiple owners found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('admin.footer')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Main tabs (Primary/Unit)
        const primaryTab = document.getElementById('primaryTab');
        const unitTab = document.getElementById('unitTab');
        const primaryTabContent = document.getElementById('primaryTabContent');
        const unitTabContent = document.getElementById('unitTabContent');
        
        // Primary sub-tabs
        const primaryIndividualTab = document.getElementById('primary-individual-tab');
        const primaryCorporateTab = document.getElementById('primary-corporate-tab');
        const primaryMultipleTab = document.getElementById('primary-multiple-tab');
        const primaryIndividualContent = document.getElementById('primary-individual');
        const primaryCorporateContent = document.getElementById('primary-corporate');
        const primaryMultipleContent = document.getElementById('primary-multiple');
        
        // Unit sub-tabs
        const unitIndividualTab = document.getElementById('unit-individual-tab');
        const unitCorporateTab = document.getElementById('unit-corporate-tab');
        const unitMultipleTab = document.getElementById('unit-multiple-tab');
        const unitIndividualContent = document.getElementById('unit-individual');
        const unitCorporateContent = document.getElementById('unit-corporate');
        const unitMultipleContent = document.getElementById('unit-multiple');
        
        // Main tab switching
        primaryTab.addEventListener('click', function() {
            primaryTab.classList.add('border-blue-500', 'text-blue-600');
            primaryTab.classList.remove('border-transparent', 'text-gray-500');
            unitTab.classList.add('border-transparent', 'text-gray-500');
            unitTab.classList.remove('border-blue-500', 'text-blue-600');
            
            primaryTabContent.classList.remove('hidden');
            primaryTabContent.classList.add('block');
            unitTabContent.classList.remove('block');
            unitTabContent.classList.add('hidden');
        });
        
        unitTab.addEventListener('click', function() {
            unitTab.classList.add('border-blue-500', 'text-blue-600');
            unitTab.classList.remove('border-transparent', 'text-gray-500');
            primaryTab.classList.add('border-transparent', 'text-gray-500');
            primaryTab.classList.remove('border-blue-500', 'text-blue-600');
            
            unitTabContent.classList.remove('hidden');
            unitTabContent.classList.add('block');
            primaryTabContent.classList.remove('block');
            primaryTabContent.classList.add('hidden');
        });
        
        // Primary sub-tab switching
        primaryIndividualTab.addEventListener('click', function() {
            setActiveTab(primaryIndividualTab, [primaryCorporateTab, primaryMultipleTab]);
            showContent(primaryIndividualContent, [primaryCorporateContent, primaryMultipleContent]);
        });
        
        primaryCorporateTab.addEventListener('click', function() {
            setActiveTab(primaryCorporateTab, [primaryIndividualTab, primaryMultipleTab]);
            showContent(primaryCorporateContent, [primaryIndividualContent, primaryMultipleContent]);
        });
        
        primaryMultipleTab.addEventListener('click', function() {
            setActiveTab(primaryMultipleTab, [primaryIndividualTab, primaryCorporateTab]);
            showContent(primaryMultipleContent, [primaryIndividualContent, primaryCorporateContent]);
        });
        
        // Unit sub-tab switching
        unitIndividualTab.addEventListener('click', function() {
            setActiveTab(unitIndividualTab, [unitCorporateTab, unitMultipleTab]);
            showContent(unitIndividualContent, [unitCorporateContent, unitMultipleContent]);
        });
        
        unitCorporateTab.addEventListener('click', function() {
            setActiveTab(unitCorporateTab, [unitIndividualTab, unitMultipleTab]);
            showContent(unitCorporateContent, [unitIndividualContent, unitMultipleContent]);
        });
        
        unitMultipleTab.addEventListener('click', function() {
            setActiveTab(unitMultipleTab, [unitIndividualTab, unitCorporateTab]);
            showContent(unitMultipleContent, [unitIndividualContent, unitCorporateContent]);
        });
        
        // Helper functions
        function setActiveTab(activeTab, inactiveTabs) {
            activeTab.classList.add('border-blue-500', 'text-blue-600');
            activeTab.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
            
            inactiveTabs.forEach(tab => {
                tab.classList.remove('border-blue-500', 'text-blue-600');
                tab.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
            });
        }
        
        function showContent(activeContent, inactiveContents) {
            activeContent.classList.remove('hidden');
            activeContent.classList.add('block');
            
            inactiveContents.forEach(content => {
                content.classList.remove('block');
                content.classList.add('hidden');
            });
        }
        
        // Initialize Lucide icons (if using them)
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
@endsection
