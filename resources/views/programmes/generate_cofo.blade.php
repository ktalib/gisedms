@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Generate Certificate') }}
@endsection

@section('content')
<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
        <div class="bg-white rounded-md shadow-sm p-6">
            <h2 class="text-xl font-bold mb-6">Generate Certificate of Occupancy</h2>
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i data-lucide="info" class="w-5 h-5 text-blue-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            Please fill in all required fields to generate the Certificate of Occupancy.
                            Some fields are pre-populated based on the application data.
                        </p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('programmes.save_cofo') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Hidden fields -->
                <input type="hidden" name="sub_application_id" value="{{ $application->id }}">
                <input type="hidden" name="mother_application_id" value="{{ $application->mother_id }}">
                
                <!-- Form Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="font-semibold text-gray-700 mb-3">File Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="file_no" class="block text-sm font-medium text-gray-700 mb-1">File Number <span class="text-red-600">*</span></label>
                                    <input type="text" id="file_no" name="file_no" value="{{ $application->fileno }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="scheme_no" class="block text-sm font-medium text-gray-700 mb-1">Scheme Number</label>
                                    <input type="text" id="scheme_no" name="scheme_no" value="{{ $application->scheme_no }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="font-semibold text-gray-700 mb-3">Property Details</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="plot_no" class="block text-sm font-medium text-gray-700 mb-1">Plot Number</label>
                                    <input type="text" id="plot_no" name="plot_no" value="{{ $application->property_plot_no }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="block_no" class="block text-sm font-medium text-gray-700 mb-1">Block Number</label>
                                    <input type="text" id="block_no" name="block_no" value="{{ $application->block_number }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="floor_no" class="block text-sm font-medium text-gray-700 mb-1">Floor Number</label>
                                    <input type="text" id="floor_no" name="floor_no" value="{{ $application->floor_number }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="flat_no" class="block text-sm font-medium text-gray-700 mb-1">Unit/Flat Number</label>
                                    <input type="text" id="flat_no" name="flat_no" value="{{ $application->unit_number }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="land_use" class="block text-sm font-medium text-gray-700 mb-1">Land Use <span class="text-red-600">*</span></label>
                                    <select id="land_use" name="land_use" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="">Select Land Use</option>
                                        <option value="Residential" {{ $application->land_use == 'Residential' ? 'selected' : '' }}>Residential</option>
                                        <option value="Commercial" {{ $application->land_use == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                        <option value="Mixed Use" {{ $application->land_use == 'Mixed Use' ? 'selected' : '' }}>Mixed Use</option>
                                        <option value="Industrial" {{ $application->land_use == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="font-semibold text-gray-700 mb-3">Certificate Term Details</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date <span class="text-red-600">*</span></label>
                                    <input type="date" id="start_date" name="start_date" value="{{ $startDate }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="total_term" class="block text-sm font-medium text-gray-700 mb-1">Total Term (Years) <span class="text-red-600">*</span></label>
                                    <input type="number" id="total_term" name="total_term" value="{{ $totalYears }}" min="1" max="99"
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="font-semibold text-gray-700 mb-3">Title Holder Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="holder_name" class="block text-sm font-medium text-gray-700 mb-1">Holder Name <span class="text-red-600">*</span></label>
                                    <input type="text" id="holder_name" name="holder_name" value="{{ $application->owner_name }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="holder_address" class="block text-sm font-medium text-gray-700 mb-1">Holder Address <span class="text-red-600">*</span></label>
                                    <textarea id="holder_address" name="holder_address" rows="3" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $application->address }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="font-semibold text-gray-700 mb-3">Property Location</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="property_house_no" class="block text-sm font-medium text-gray-700 mb-1">House Number</label>
                                    <input type="text" id="property_house_no" name="property_house_no" value="{{ $application->property_house_no }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="property_street_name" class="block text-sm font-medium text-gray-700 mb-1">Street Name</label>
                                    <input type="text" id="property_street_name" name="property_street_name" value="{{ $application->property_street_name }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="property_district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
                                    <input type="text" id="property_district" name="property_district" value="{{ $application->property_district }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="property_lga" class="block text-sm font-medium text-gray-700 mb-1">Local Government Area</label>
                                    <input type="text" id="property_lga" name="property_lga" value="{{ $application->property_lga }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="property_state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                    <input type="text" id="property_state" name="property_state" value="{{ $application->property_state ?? 'Kano' }}" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h3 class="font-semibold text-gray-700 mb-3">Signatory Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="signed_by" class="block text-sm font-medium text-gray-700 mb-1">Signed By <span class="text-red-600">*</span></label>
                                    <input type="text" id="signed_by" name="signed_by" value="Alh. Abduljabbar Mohammed Umar" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                
                                <div>
                                    <label for="signed_title" class="block text-sm font-medium text-gray-700 mb-1">Signatory Title <span class="text-red-600">*</span></label>
                                    <input type="text" id="signed_title" name="signed_title" value="Honorable Commissioner of Land and Physical Planning" 
                                        class="border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('programmes.certificates') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Generate Certificate
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>
@endsection
