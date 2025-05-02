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

            @if($existingRofo && $existingRofo->rofo_no)
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            ST ROFO No: <strong>{{ $existingRofo->rofo_no }}</strong>
                        </p>
                    </div>
                </div>
            </div>
            @endif
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
            
            <form id="rofoForm" action="{{ route('programmes.save_rofo') }}" method="POST" class="space-y-6">
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
                                <input type="text" name="owner_name" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" value="{{ $rofo->owner_name }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" value="{{ $rofo->address }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Property Information -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="font-semibold text-lg mb-4 text-green-700">Property Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Shop/House No</label>
                                <input type="text" name="shop_house_no" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" 
                                    value="{{ $existingRofo->shop_house_no ?? $rofo->property_house_no }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Floor No</label>
                                <input type="text" name="floor_no" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" 
                                    value="{{ $existingRofo->floor_no ?? $rofo->floor_number }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" 
                                    value="{{ $existingRofo->location ?? ($rofo->property_house_no . ' ' . $rofo->property_plot_no . ' ' . $rofo->property_street_name . ' ' . $rofo->property_district) }}" readonly>
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
                                <input type="text" name="plot_no" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" 
                                    value="{{ $existingRofo->plot_no ?? $rofo->property_plot_no }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Block No</label>
                                <input type="text" name="block_no" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" 
                                    value="{{ $existingRofo->block_no ?? $rofo->block_number }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Plan No</label>
                                <input type="text" name="plan_no" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" 
                                    value="{{ $existingRofo->plan_no ?? ($surveyRecord->approved_plan_no ?? '') }}" readonly>
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
                                <input type="number" name="ground_rent" step="0.01" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" readonly
                                    value="{{ $existingRofo->ground_rent ?? ($finalBill->ground_rent ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Development Charges (₦)</label>
                                <input type="number" name="development_charges" step="0.01" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" readonly
                                    value="{{ $existingRofo->development_charges ?? ($finalBill->dev_charges ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Survey/Processing Fees (₦)</label>
                                <input type="number" name="survey_processing_fees" step="0.01" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" readonly
                                    value="{{ $existingRofo->survey_processing_fees ?? (($finalBill->survey_fee ?? 0) + ($finalBill->processing_fee ?? 0)) }}">
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
                                    value="{{ $existingRofo->term_years ?? '' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Purpose</label>
                                <input type="text" name="purpose" class="w-full p-2 border border-gray-300 rounded-md text-sm bg-gray-100" readonly
                                    value="{{ $existingRofo->purpose ?? $rofo->land_use }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Value of Improvements</label>
                                <input type="text" name="improvement_value" class="w-full p-2 border border-gray-300 rounded-md text-sm" required
                                    value="{{ $existingRofo->improvement_value ?? '' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Improvement Time Limit (Years)</label>
                                <input type="number" name="improvement_time_limit" class="w-full p-2 border border-gray-300 rounded-md text-sm" required
                                    value="{{ $existingRofo->improvement_time_limit ?? '' }}">
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
                                @if(!$existingRofo)
                                    <div class="bg-blue-50 border-l-4 border-blue-500 p-3 mb-3">
                                        <p class="text-sm text-blue-700">
                                            <strong>Next ROFO Number:</strong> {{ $nextRofoNo ?? 'ST/ROFO/'.date('Y').'/0001' }}
                                        </p>
                                        <p class="text-sm text-gray-600 italic mt-1">
                                            This number will be automatically assigned when you generate the ROFO.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('programmes.rofo') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancel
                    </a>
                    <button id="submitButton" type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 disabled:opacity-50 disabled:bg-gray-400 disabled:cursor-not-allowed">
                        {{ $existingRofo ? 'Update' : 'Generate' }} ROFO
                    </button>
                </div>
                
                <div id="validationMessage" class="mt-4 text-red-500 text-sm hidden">
                    Please fill in all required fields before generating the ROFO.
                </div>
            </form>
        </div>
    </div>
    
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>

<style>
    .required-field::after {
        content: "*";
        color: red;
        margin-left: 4px;
    }
    
    .invalid-field {
        border-color: red !important;
    }
    
    /* Enhanced button styling */
    button:disabled {
        opacity: 0.5;
        background-color: #9ca3af !important; /* Gray-400 */
        cursor: not-allowed;
        color: #f3f4f6 !important; /* Gray-100 */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all required inputs
        const form = document.getElementById('rofoForm');
        const requiredInputs = form.querySelectorAll('input[required]');
        const submitButton = document.getElementById('submitButton');
        const validationMessage = document.getElementById('validationMessage');
        
        // Add required field indicators to labels
        requiredInputs.forEach(input => {
            const label = input.previousElementSibling;
            if (label && label.tagName === 'LABEL') {
                label.classList.add('required-field');
            }
        });
        
        // Function to validate all required fields
        function validateForm() {
            let valid = true;
            let invalidFields = [];
            
            requiredInputs.forEach(input => {
                // Remove previous validation styling
                input.classList.remove('invalid-field');
                
                if (!input.value.trim()) {
                    valid = false;
                    input.classList.add('invalid-field');
                    
                    // Get field name from label
                    const label = input.previousElementSibling;
                    if (label && label.tagName === 'LABEL') {
                        invalidFields.push(label.textContent.trim());
                    }
                }
                
                // Additional validation for numeric fields
                if (input.type === 'number' && input.value.trim()) {
                    const numValue = parseFloat(input.value);
                    if (isNaN(numValue)) {
                        valid = false;
                        input.classList.add('invalid-field');
                    }
                }
            });
            
            // Show/hide validation message
            if (!valid) {
                validationMessage.classList.remove('hidden');
            } else {
                validationMessage.classList.add('hidden');
            }
            
            return valid;
        }
        
        // Check validation on page load
        submitButton.disabled = !validateForm();
        
        // Add change event listeners to all required inputs
        requiredInputs.forEach(input => {
            input.addEventListener('input', function() {
                submitButton.disabled = !validateForm();
            });
            
            // Also validate on blur (when user leaves the field)
            input.addEventListener('blur', function() {
                validateForm();
            });
        });
        
        // Prevent form submission if validation fails
        form.addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
                // Scroll to the first invalid field
                const firstInvalid = form.querySelector('.invalid-field');
                if (firstInvalid) {
                    firstInvalid.focus();
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    });
</script>
@endsection
