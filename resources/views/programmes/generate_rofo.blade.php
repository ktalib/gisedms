@extends('layouts.app')

@section('page-title')
    {{ $PageTitle ?? __('Generate RofO') }}
@endsection

@section('content')
<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6">
        <div class="bg-white rounded-md shadow-md p-6 max-w-5xl mx-auto">
            <div class="mb-6">
                @if(request()->has('edit') && request()->edit == 'yes')
                    <h2 class="text-2xl font-bold text-gray-800">Edit Right of Occupancy (RofO)</h2>
                    <p class="text-gray-600">Modify the details below to update the Right of Occupancy document.</p>
                @else
                    <h2 class="text-2xl font-bold text-gray-800">Generate Right of Occupancy (RofO)</h2>
                    <p class="text-gray-600">Fill out the form below to generate a Right of Occupancy document.</p>
                @endif
            </div>
            
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            <form action="{{ route('programmes.save_rofo') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="sub_application_id" value="{{ $rofo->id }}">
                <input type="hidden" name="application_id" value="{{ $rofo->main_application_id }}">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Applicant Information -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="font-semibold text-lg mb-4 text-green-700">Unit Owner Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Unit Owner Name</label>
                                <input type="text" class="w-full p-2 border border-gray-300 rounded-md text-sm" value="{{ $rofo->owner_name }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" class="w-full p-2 border border-gray-300 rounded-md text-sm" value="{{ $rofo->address }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Property Information -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="font-semibold text-lg mb-4 text-green-700">Property Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Shop/House No</label>
                                <input type="text" name="shop_house_no" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->shop_house_no ?? $rofo->property_house_no }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Floor No</label>
                                <input type="text" name="floor_no" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->floor_no ?? $rofo->floor_number }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" class="w-full p-2 border border-gray-300 rounded-md text-sm" required
                                    value="{{ $existingRofo->location ?? ($rofo->property_house_no . ' ' . $rofo->property_plot_no . ' ' . $rofo->property_street_name . ' ' . $rofo->property_district) }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Plot Information -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="font-semibold text-lg mb-4 text-green-700">Plot Details</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Plot No</label>
                                <input type="text" name="plot_no" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->plot_no ?? $rofo->property_plot_no }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Block No</label>
                                <input type="text" name="block_no" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->block_no ?? $rofo->block_number }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Plan No</label>
                                <input type="text" name="plan_no" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->plan_no ?? '' }}">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dates -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="font-semibold text-lg mb-4 text-green-700">Dates</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Application Date</label>
                                <input type="date" name="application_date" class="w-full p-2 border border-gray-300 rounded-md text-sm" required
                                    value="{{ $existingRofo->application_date ?? Carbon\Carbon::now()->toDateString() }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Approval Date</label>
                                <input type="date" name="approval_date" class="w-full p-2 border border-gray-300 rounded-md text-sm" required
                                    value="{{ $existingRofo->approval_date ?? ($rofo->approval_date ?? Carbon\Carbon::now()->toDateString()) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Signed Date</label>
                                <input type="date" name="signed_date" class="w-full p-2 border border-gray-300 rounded-md text-sm" required
                                    value="{{ $existingRofo->signed_date ?? Carbon\Carbon::now()->toDateString() }}">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fees -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="font-semibold text-lg mb-4 text-green-700">Fees</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ground Rent (₦)</label>
                                <input type="number" name="ground_rent" step="0.01" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->ground_rent ?? '0.00' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Development Charges (₦)</label>
                                <input type="number" name="development_charges" step="0.01" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->development_charges ?? '0.00' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Survey/Processing Fees (₦)</label>
                                <input type="number" name="survey_processing_fees" step="0.01" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->survey_processing_fees ?? '0.00' }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Terms -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="font-semibold text-lg mb-4 text-green-700">Terms and Conditions</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Term (Years)</label>
                                <input type="number" name="term_years" class="w-full p-2 border border-gray-300 rounded-md text-sm" required
                                    value="{{ $existingRofo->term_years ?? '40' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Purpose</label>
                                <input type="text" name="purpose" class="w-full p-2 border border-gray-300 rounded-md text-sm" required
                                    value="{{ $existingRofo->purpose ?? $rofo->land_use }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Value of Improvements</label>
                                <input type="text" name="improvement_value" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->improvement_value ?? '' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Improvement Time Limit (Years)</label>
                                <input type="number" name="improvement_time_limit" class="w-full p-2 border border-gray-300 rounded-md text-sm" 
                                    value="{{ $existingRofo->improvement_time_limit ?? '2' }}">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Signatory -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="font-semibold text-lg mb-4 text-green-700">Approver Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Commissioner's Name</label>
                                <input type="text" name="commissioner_name" class="w-full p-2 border border-gray-300 rounded-md text-sm" required
                                    value="{{ $existingRofo->commissioner_name ?? 'HONOURABLE COMMISSIONER' }}">
                            </div>
                            <div class="mt-8">
                                <p class="text-sm text-gray-600 italic">
                                    The ROFO number will be automatically generated in the format ST/ROFO/YYYY/0001
                                </p>
                                @if($existingRofo && $existingRofo->rofo_no)
                                    <p class="text-sm font-semibold mt-2">Current ROFO Number: {{ $existingRofo->rofo_no }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('programmes.rofo') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        {{ $existingRofo ? 'Update' : 'Generate' }} ROFO
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>
@endsection
