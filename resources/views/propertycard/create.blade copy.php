{{-- filepath: c:\wamp64\www\gisedms\resources\views\propertycard\index.blade.php --}}
@extends('layouts.app')
@section('page-title')
Property Records Assistant
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Property Records Assistant') }} </li>
@endsection
@push('script-page')
    <script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
   
@endpush
<style>
    .modal {
        transition: opacity 0.25s ease;
    }

    body {
        font-family: Arial, sans-serif;
    }

    .header-cell {
        cursor: pointer;
    }

    .header-cell:hover {
        background-color: #f3f4f6;
    }
    
    

    label {
       color: #000000;
       font-weight: bold;
    }

    /* fields case sensitive */
    input[type="text"] {
        text-transform: uppercase;
    }


</style>

@section('content')
    <div class="container mx-auto mt-4 p-4">

        
        <div >
      
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

            <div class="modal-container bg-white w-11/12 md:max-w-4xl mx-auto rounded-md shadow-lg z-50 overflow-y-auto">
                <!-- Modal Header -->
                <div class="bg-gray-100 p-3 border-b flex justify-between items-center"> 
                    <div class="flex items-center space-x-2">
                        <button id="firstButton" class="p-1 hover:text-blue-600" title="First Record">
                            <i data-lucide="chevrons-left" style="color: black;"></i>
                        </button>
                        <button id="previousButton" class="p-1 text-gray-600 hover:text-blue-600" title="Previous">
                            <i data-lucide="chevron-left" style="color: black;"></i>
                        </button>
                        <p id="recordCounter" class="text-lg font-semibold text-gray-700">{{ isset($result) ? $result->id : '' }} of {{$recordCount}}</p>
                        <button id="nextButton" class="p-1 text-gray-600 hover:text-blue-600" title="Next">
                            <i data-lucide="chevron-right" style="color: black;"></i>
                        </button>
                        <button id="lastButton" class="p-1 text-gray-600 hover:text-blue-600" title="Last Record">
                            <i data-lucide="chevrons-right" style="color: black;"></i>
                        </button>
                    </div>
                    <div class="flex space-x-2">
                        <button class="p-1 bg-red-600 text-white hover:bg-red-700" title="Delete">
                            <i data-lucide="trash-2" style="color: black;"></i>
                        </button>
                        <button class="p-1 bg-green-600 text-white hover:bg-green-700" title="Add" onclick="window.location.href='{{ route('propertycard.create') }}'" >
                            <i data-lucide="plus" style="color: black;"></i>
                        </button>
                        <button class="p-1 bg-blue-600 text-white hover:bg-blue-700" title="Edit">
                            <i data-lucide="edit" style="color: black;"></i>
                        </button>
                    </div>
                </div>
                <!-- Modal Content -->
                <div class="p-2">
                    <form method="POST" action="{{ route('propertycard.saveRecord') }}" id="propertyCardForm">
                        @csrf
                        <input type="hidden" id="currentRecordId" name="currentRecordId" value="{{ isset($result) ? $result->id : '' }}">
                        <input type="hidden" name="data_source" value="property_records">
                        <div class="grid grid-cols-3 gap-2">
                            <!-- Left Section -->
                            <div class="col-span-2">
                                <div class="mb-2">
                                    <div class="mb-1 font-bold text-red-600 text-sm uppercase">Property Records Assistant</div>

                                </div>

                                <div class="grid grid-cols-3 gap-2 mb-6">
                                    <div>
                                        <label for="fileNoPrefix" class="block text-sm font-medium text-gray-700 mb-1">File No Prefix</label>
                                        <select id="fileNoPrefix" name="fileNoPrefix" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" style="color: black;">
                                            <option value="">Select File Prefix</option>
                                            @foreach(['KNML', 'MNKL', 'KN', 'CON-COM', 'CON-RES', 'RES', 'MLKN', 'CON-AG', 'KNGP', 'CON-IND'] as $prefix)
                                                <option value="{{ $prefix }}" {{ (isset($result) && isset($result->fileNoPrefix) && $result->fileNoPrefix == $prefix) ? 'selected' : '' }}>
                                                    {{ $prefix }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="fileNumber" class="block text-sm font-medium text-gray-700 mb-1">Number</label>
                                        <input type="text" id="fileNumber" name="fileNumber" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ isset($result) ? ($result->fileNumber ?: 'N/A') : 'N/A' }}" style="color: black;">
                                    </div>
                                    <div>
                                        <label for="Previewflenumber" class="block text-sm font-medium text-gray-700 mb-1">Full File Number</label>
                                        <input type="text" id="Previewflenumber" name="Previewflenumber" class="w-full p-2 border border-gray-300 bg-gray-100 font-medium rounded-md" value="{{ isset($result) ? ($result->kangisFileNo ?: 'N/A') : 'N/A' }}" readonly style="color: black;">
                                    </div>
                                </div>
                                <script>
                                    function updateFileNumberColor() {
                                        const prefixEl = document.getElementById('fileNoPrefix');
                                        const numberEl = document.getElementById('fileNumber');
                                        const previewEl = document.getElementById('Previewflenumber');

                                     

                                        const prefix = prefixEl.value;
                                        const number = numberEl.value.trim();
                                        const preview = previewEl.value.trim();

                                        // Change to red only when all fields are filled and valid
                                        if (prefix && number && preview && preview !== 'N/A') {
                                            // Validate format based on prefix
                                            let isValid = true;
                                            if (prefix === "KN") {
                                                isValid = /^\d+$/.test(number);
                                            } else if (["KNML", "MNKL", "MLKN", "KNGP"].includes(prefix)) {
                                                isValid = /^\d{5}$/.test(number);
                                            } else if (prefix.includes('-') || ["CON-COM", "CON-RES", "CON-AG", "CON-IND", "RES"].includes(prefix)) {
                                                isValid = number.length > 0;
                                            }

                                            if (isValid) {
                                                prefixEl.style.color = 'red';
                                                numberEl.style.color = 'red';
                                                previewEl.style.color = 'red';
                                            }
                                        }
                                    }

                                    // Call the function initially to set default colors
                                    document.addEventListener('DOMContentLoaded', updateFileNumberColor);

                                    // Add event listeners
                                    document.getElementById('fileNoPrefix').addEventListener('change', updateFileNumberColor);
                                    document.getElementById('fileNumber').addEventListener('input', updateFileNumberColor);
                                </script>

                                <div class="grid grid-cols-6 gap-2 mb-2">
                                    <div class="col-span-2">
                                        <label for="oldTitleSerialNo" class="block text-xs text-gray-600 mb-1">Serial No</label>
                                        <input type="text" id="oldTitleSerialNo" name="oldTitleSerialNo" class="w-full border rounded p-1 text-xs" value="{{ isset($result) ? ($result->oldTitleSerialNo ?: 'N/A') : 'N/A' }}" />
                                    </div>
                                    <div class="col-span-2">
                                        <label for="oldTitlePageNo" class="block text-xs text-gray-600 mb-1">Page</label>
                                        <input type="text" id="oldTitlePageNo" name="oldTitlePageNo" class="w-full border rounded p-1 text-xs" value="{{ isset($result) ? ($result->oldTitlePageNo ?: 'N/A') : 'N/A' }}" />
                                    </div>
                                    <div class="col-span-2">
                                        <label for="oldTitleVolumeNo" class="block text-xs text-gray-600 mb-1">Vol</label>
                                        <input type="text" id="oldTitleVolumeNo" name="oldTitleVolumeNo" class="w-full border rounded p-1 text-xs" value="{{ isset($result) ? ($result->oldTitleVolumeNo ?: 'N/A') : 'N/A' }}" />
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label for="description" class="block text-xs text-gray-600 mb-1">Description</label>
                                    <input type="text" id="description" name="description" class="w-full border rounded p-1 text-xs" value="{{ isset($result) ? ($result->description ?: 'N/A') : 'N/A' }}"  />
                                </div>

                                <div class="grid grid-cols-6 gap-2 mb-2">
                                    <div class="col-span-3">
                                        <label for="lgaName" class="block text-xs text-gray-600 mb-1">Lgsa Or City</label>
                                        <input type="text" id="lgaName" name="lgaName" class="w-full border rounded p-1 text-xs" value="{{ isset($result) ? ($result->lgaName ?: 'N/A') : 'N/A' }}" />
                                    </div>
                                    <div class="col-span-3">
                                        <label for="plotNo" class="block text-xs text-gray-600 mb-1">Plot No</label>
                                        <input type="text" id="plotNo" name="plotNo" class="w-full border rounded p-1 text-xs" value="{{ isset($result) ? ($result->plotNo ?: 'N/A') : 'N/A' }}" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <div>
                                        <label for="originalAllottee" class="block text-xs text-gray-600 mb-1">Assignor</label>
                                        <input type="text" id="originalAllottee" name="originalAllottee" class="w-full border rounded p-1 text-xs" value="{{ isset($result) ? ($result->originalAllottee ?: 'N/A') : 'N/A' }}" />
                                    </div>
                                    <div>
                                        <label for="currentAllottee" class="block text-xs text-gray-600 mb-1">Assignee</label>
                                        <input type="text" id="currentAllottee" name="currentAllottee" class="w-full border rounded p-1 text-xs" value="{{ isset($result) ? ($result->currentAllottee ?: 'N/A') : 'N/A' }}" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-2 mb-2">
                                    <div>
                                        <label for="instrument" class="block text-xs text-gray-600 mb-1 ">Instrument</label>
                                        <div class="relative">
                                            <select id="instrument" class="w-full border rounded p-1 pr-6 appearance-none text-xs">
                                                <option></option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-700">
                                                <svg class="h-3 w-3" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="layoutName" class="block text-xs text-gray-600 mb-1 ">Layout</label>
                                        <div class="relative">
                                            <select id="layoutName" name="layout" class="w-full border rounded p-1 pr-6 appearance-none text-xs">
                                                <option value="">{{ isset($result) ? ($result->layoutName ?: 'N/A') : 'N/A' }}</option>
                                               
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-700">
                                                <svg class="h-3 w-3" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="schedule" class="block text-xs text-gray-600 mb-1 ">Schedule</label>
                                        <div class="relative">
                                            <select id="schedule" class="w-full border rounded p-1 pr-6 appearance-none text-xs" disabled>
                                                <option></option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-700">
                                                <svg class="h-3 w-3" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Section -->
                            <div class="col-span-1">
                                <span class="text-right">Quick Search / Filter</span>
                                <div class="border rounded">
                                    <div class="mb-1">
                                        <input type="checkbox" id="schedule" class="mr-1 schedule-checkbox" />
                                        <label for="schedule" class="text-xs">Schedule</label>
                                        <div class="relative mt-1">
                                            <select class="w-full border rounded p-1 pr-6 appearance-none text-xs schedule-input" disabled>
                                                <option></option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-700">
                                                <svg class="h-3 w-3" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-1">
                                        <input type="checkbox" id="lgsa" class="mr-1 lgsa-checkbox" />
                                        <label for="lgsa" class="text-xs">Lgsa</label>
                                        <div class="relative mt-1">
                                            <input type="text" id="lgaName" name="lgaName" class="w-full border rounded p-1 text-xs lgsa-input" value="{{ request('lgaName') }}" disabled />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-700">
                                                <svg class="h-3 w-3" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="mb-1">
                                        <input type="checkbox" id="layout" class="mr-1 layout-checkbox" />
                                        <label for="layout" class="text-xs">Layout</label>
                                        <div class="relative mt-1">
                                            <input type="text" id="layoutName" name="layoutName" class="w-full border rounded p-1 text-xs layout-input" value="{{ request('layoutName') }}" disabled />
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-gray-700">
                                                <svg class="h-3 w-3" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="mb-1">
                                        <input type="checkbox" id="grantor" class="mr-1 grantor-checkbox" />
                                        <label for="grantor" class="text-xs">Assignor</label>
                                        <input type="text" id="Assignor" name="originalAllottee" class="w-full border rounded p-1 mt-1 text-xs grantor-input" value="{{ request('originalAllottee') }}" disabled />
                                    </div>

                                    <div class="mb-1">
                                        <input type="checkbox" id="Assignee" class="mr-1 grantee-checkbox" />
                                        <label for="Assignee" class="text-xs">Assignee</label>
                                        <input type="text" id="Assignee" name="currentAllottee" class="w-full border rounded p-1 mt-1 text-xs grantee-input" value="{{ request('currentAllottee') }}" disabled />
                                    </div>

                                    {{-- <div class="mb-1">
                                        <input type="checkbox" id="numberPageVol" class="mr-1 number-page-vol-checkbox" />
                                        <label for="numberPageVol" class="text-xs">No. / Page / Vol.</label>
                                        <div class="grid grid-cols-3 gap-1 mt-1">
                                            <div>
                                                <label class="block text-xs text-gray-600 mb-0.5">No.</label>
                                                <input type="text" id="oldTitleSerialNo" name="oldTitleSerialNo" class="w-full border rounded p-1 text-xs number-input" value="{{ request('oldTitleSerialNo') }}" disabled />
                                            </div>
                                            <div>
                                                <label class="block text-xs text-gray-600 mb-0.5">Page</label>
                                                <input type="text" id="oldTitlePageNo" name="oldTitlePageNo" class="w-full border rounded p-1 text-xs page-input" value="{{ request('oldTitlePageNo') }}" disabled />
                                            </div>
                                            <div>
                                                <label class="block text-xs text-gray-600 mb-0.5">Vol.</label>
                                                <input type="text" id="oldTitleVolumeNo" name="oldTitleVolumeNo" class="w-full border rounded p-1 text-xs volume-input" value="{{ request('oldTitleVolumeNo') }}" disabled />
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="mb-2">
                                        <input type="checkbox" id="mlsfNoCheckbox" class="mr-1" />
                                        <label for="mlsfNoCheckbox" class="text-xs">Enable MLS File #</label>
                                        <div class="relative mt-1">
                                            <input type="text" id="mlsfNo" name="mlsfNo" class="w-full border rounded p-1 text-xs" value="{{ request('mlsfNo') }}" disabled />
                                        </div>
                                    </div>

                                    <div class="mb-1">
                                        <input type="checkbox" id="kangisFileNoCheckbox" class="mr-1" />
                                        <label for="kangisFileNoCheckbox" class="text-xs">Enable Kangis File #</label>
                                        <input type="text" id="kangisFileNo" name="kangisFileNo" class="w-full border rounded p-1 text-xs" value="{{ request('kangisFileNo') }}" disabled />
                                    </div>
                                    <div class="flex justify-between">
                                        <button type="submit" id="findButton" formaction="{{ route('propertycard.search') }}" class="p-0.5 border rounded flex items-center space-x-1 w-20 bg-green-600 text-white justify-center">
                                            <span class="text-[10px]">Find</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </button>

                                        <button type="button" id="saveButton" class="p-0.5 border rounded flex items-center space-x-1 w-20 bg-blue-600 text-white justify-center">
                                            <span class="text-[10px]">Save</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2zM12 19l-4-4h3V9h2v6h3l-4 4z" />
                                            </svg>
                                        </button>

                                        <button type="button" id="refreshButton" class="p-0.5 border rounded flex items-center space-x-1 w-20 bg-red-600 text-white justify-center">
                                            <span class="text-[10px]">Refresh</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M20 4l-8 8M12 12l-8 8" />
                                            </svg>
                                        </button>
                                    </div>

                                    <script>
                                    document.getElementById('refreshButton').addEventListener('click', function() {
                                        // Reset all form fields
                                        const form = document.getElementById('propertyCardForm');
                                        const inputs = form.querySelectorAll('input[type="text"], select');
                                        inputs.forEach(input => {
                                            input.value = 'N/A';
                                        });

                                        // Reset record counter
                                        document.getElementById('recordCounter').innerText = "0 of {{$recordCount}}";
                                        document.getElementById('currentRecordId').value = '';

                                        // Clear file number fields
                                        document.getElementById('fileNoPrefix').value = '';
                                        document.getElementById('fileNumber').value = '';
                                        const previewElement = document.getElementById('Previewflenumber');
                                        if (previewElement) {
                                            previewElement.value = 'N/A';
                                        }

                                        // Reset checkbox states and disable inputs
                                        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                                        checkboxes.forEach(checkbox => {
                                            checkbox.checked = false;
                                            const inputClass = checkbox.id.replace('Checkbox', '-input');
                                            const relatedInputs = document.getElementsByClassName(inputClass);
                                            Array.from(relatedInputs).forEach(input => {
                                                input.disabled = true;
                                            });
                                        });
                                    });
                                    </script>
                                </div>
                            </form>
                        </div>
                    </div>

                  
                </div>
            </div>
        </div>

    </div>

    <!-- Property Card Records Table -->
  

     <script>
      
            // Function to update the preview
            function updatePreview() {
                const prefix = document.getElementById('fileNoPrefix').value;
                const number = document.getElementById('fileNumber').value.trim();
                const mlsfNoValue = document.getElementById('mlsfNo').value.trim();
                const kangisFileNoValue = document.getElementById('kangisFileNo').value.trim();
                let previewValue = '';

                if (mlsfNoValue && kangisFileNoValue) {
                    previewValue = `MLS File #: ${mlsfNoValue} | Kangis File #: ${kangisFileNoValue}`;
                } else {
                    let baseFileNo = prefix;
                    if (number) {
                        if (prefix === "KN") {
                            previewValue = /^\d+$/.test(number) ? prefix + String(number).padStart(4, '0') : prefix + number;
                        } else if (prefix === "KNML" || prefix === "MNKL" || prefix === "MLKN" || prefix === "KNGP") {
                            previewValue = /^\d+$/.test(number) ? prefix + " " + String(number).padStart(5, '0') : prefix + " " + number;
                        } else if (prefix.includes('-') || prefix === "CON-COM" || prefix === "CON-RES" || prefix === "CON-AG" || prefix === "CON-IND" || prefix === "RES") {
                            previewValue = prefix + "-" + number;
                        } else {
                            previewValue = prefix + " " + number;
                        }
                    }
                    previewValue = previewValue || 'N/A';
                }
                document.getElementById('Previewflenumber').value = previewValue;
            }
        
            // Initialize preview on page load
            document.addEventListener('DOMContentLoaded', function() {
                updatePreview();
            });
        
            // Event listeners for real-time updates
            document.getElementById('fileNoPrefix').addEventListener('change', updatePreview);
            document.getElementById('fileNumber').addEventListener('input', updatePreview);
            document.getElementById('mlsfNo').addEventListener('input', updatePreview);
            document.getElementById('kangisFileNo').addEventListener('input', updatePreview);
        
            // Event listener for the Enter File Number button
            document.getElementById('enterFileNumber').addEventListener('click', function() {
                let fileNumber = document.getElementById('fileNumber');
                let fileNoPrefix = document.getElementById('fileNoPrefix');
        
                // Enable fields
                fileNumber.disabled = false;
                fileNoPrefix.disabled = false;
        
                // Clear values
                fileNumber.value = '';
                fileNoPrefix.value = '';
        
                // Hide temp options
                fileNoPrefix.querySelector('option[value="TempfileNoPrefix"]').style.display = 'none';
        
                // Clear the preview value when the Enter File Number button is clicked
                document.getElementById('Previewflenumber').value = '';
        
                // Set focus to the prefix field
                fileNoPrefix.focus();
            });
        
            // Event listener for the Enter Root Title button
            document.getElementById('enterRootTitleRegNo').addEventListener('click', function() {
                let rootTitleRegNo = document.getElementById('rootTitleRegNo');
                rootTitleRegNo.disabled = false;
                rootTitleRegNo.value = '';
                rootTitleRegNo.focus();
            });


            // Event listener for the Find button to search for a record
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('findButton').addEventListener('click', function() {
            console.log('Find button clicked'); // Debug log

            const lgaName = document.getElementById('lgaName').value;
            const layoutName = document.getElementById('layoutName').value;
            const Assignor = document.getElementById('Assignor').value;
            const Assignee = document.getElementById('Assignee').value;
            const oldTitleSerialNo = document.getElementById('oldTitleSerialNo').value;
            const oldTitlePageNo = document.getElementById('oldTitlePageNo').value;
            const oldTitleVolumeNo = document.getElementById('oldTitleVolumeNo').value;
            const mlsfNo = document.getElementById('mlsfNo').value;
            const kangisFileNo = document.getElementById('kangisFileNo').value;

            const data = {
                lgaName,
                layoutName,
                Assignor,
                Assignee,
                oldTitleSerialNo,
                oldTitlePageNo,
                oldTitleVolumeNo,
                mlsfNo,
                kangisFileNo,
                _token: '{{ csrf_token() }}'
            };

            console.log('Data to be sent:', data); // Debug log

            fetch('{{ route('propertycard.search') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': data._token
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                console.log('Response received:', response); // Debug log
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data); // Debug log
                if (data) {
                    document.getElementById('fileNoPrefix').value = data.fileNoPrefix;
                    document.getElementById('fileNumber').value = data.fileNumber;
                    document.getElementById('Previewflenumber').value = data.Previewflenumber;
                    document.getElementById('oldTitleSerialNo').value = data.oldTitleSerialNo;
                    document.getElementById('oldTitlePageNo').value = data.oldTitlePageNo;
                    document.getElementById('oldTitleVolumeNo').value = data.oldTitleVolumeNo;
                    document.getElementById('lgaName').value = data.lgaName;
                    document.getElementById('layoutName').value = data.layoutName;
                    document.getElementById('Assignor').value = data.Assignor;
                    document.getElementById('Assignee').value = data.Assignee;
                    document.getElementById('mlsfNo').value = data.mlsfNo;
                    document.getElementById('kangisFileNo').value = data.kangisFileNo;
                } else {
                    alert('No matching record found.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while searching for the record.');
            });
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const kangisFileNo = document.getElementById('kangisFileNo').value;
        console.log('Searching for:', kangisFileNo);

        fetch('{{ route('propertycard.search') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                kangisFileNo: kangisFileNo
            })
        })
        .then(response => response.json())
        .then(response => {
            console.log('Response:', response);
            
            if (response.success && response.data) {
                const data = response.data;
                // Update all form fields with received data
                document.getElementById('kangisFileNo').value = data.kangisFileNo || '';
                document.getElementById('plotNo').value = data.plotNo || '';
                document.getElementById('lgaName').value = data.lgaName || '';
                document.getElementById('layoutName').value = data.layoutName || '';
                document.getElementById('oldTitleSerialNo').value = data.oldTitleSerialNo || '';
                document.getElementById('oldTitlePageNo').value = data.oldTitlePageNo || '';
                document.getElementById('oldTitleVolumeNo').value = data.oldTitleVolumeNo || '';
                document.getElementById('Assignor').value = data.originalAllottee || '';
                document.getElementById('Assignee').value = data.currentAllottee || '';
                
                // Enable fields that have data
                if (data.lgaName) document.getElementById('lgaName').disabled = false;
                if (data.layoutName) document.getElementById('layoutName').disabled = false;
                if (data.oldTitleSerialNo) document.getElementById('oldTitleSerialNo').disabled = false;
                if (data.oldTitlePageNo) document.getElementById('oldTitlePageNo').disabled = false;
                if (data.oldTitleVolumeNo) document.getElementById('oldTitleVolumeNo').disabled = false;
                if (data.originalAllottee) document.getElementById('Assignor').disabled = false;
                if (data.currentAllottee) document.getElementById('Assignee').disabled = false;

                // Check corresponding checkboxes for fields that have data
                if (data.lgaName) document.querySelector('.lgsa-checkbox').checked = true;
                if (data.layoutName) document.querySelector('.layout-checkbox').checked = true;
                if (data.originalAllottee) document.querySelector('.grantor-checkbox').checked = true;
                if (data.currentAllottee) document.querySelector('.grantee-checkbox').checked = true;
            } else {
                alert('No matching record found for ' + kangisFileNo);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error searching for record');
        });
    });
});
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Enable/disable inputs based on checkbox state
    document.querySelectorAll('.schedule-checkbox, .lgsa-checkbox, .layout-checkbox, .grantor-checkbox, .grantee-checkbox, .number-page-vol-checkbox, #mlsfNoCheckbox, #kangisFileNoCheckbox').forEach(function(element) {
        element.addEventListener('change', function() {
            let input;
            if (this.id === 'mlsfNoCheckbox') {
                input = document.getElementById('mlsfNo');
            } else if (this.id === 'kangisFileNoCheckbox') {
                input = document.getElementById('kangisFileNo');
            } else if (this.classList.contains('number-page-vol-checkbox')) {
                document.querySelectorAll('.number-input, .page-input, .volume-input').forEach(function(npvInput) {
                    npvInput.disabled = !element.checked;
                });
                return;
            } else {
                const inputClass = this.classList[1].replace('-checkbox', '-input');
                document.querySelectorAll('.' + inputClass).forEach(function(inputElement) {
                    inputElement.disabled = !element.checked;
                });
                return;
            }
            input.disabled = !this.checked;
        });
    });
});
 
// New event listener to handle Save button submission
document.getElementById('saveButton').addEventListener('click', function() {
    var form = document.getElementById('propertyCardForm');
    var formData = new FormData(form);
    fetch('{{ route('propertycard.saveRecord') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => {
       if (!response.ok) {
           throw new Error('Network response was not ok, status: ' + response.status);
       }
       return response.json();
    })
    .then(data => {
       if (data.success) {
           Swal.fire({
               icon: 'success',
               title: 'Success',
               text: 'Record saved successfully.'
           });
           form.reset(); // clear form fields
       } else {
           console.error('Save failed with data:', data);
           Swal.fire({
               icon: 'error',
               title: 'Error',
               text: 'Saving failed.'
           });
       }
    })
    .catch(error => {
       console.error('Error occurred during saveRecord fetch:', error);
       Swal.fire({
           icon: 'error',
           title: 'Error',
           text: 'Error occurred: ' + error.message
       });
    });
});

// Add navigation event listeners for Previous and Next buttons
document.getElementById('previousButton').addEventListener('click', function() {
    const currentId = document.getElementById('currentRecordId').value;
    fetch("{{ route('propertycard.navigate') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ direction: 'previous', currentId: currentId })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Update hidden field and record counter
            document.getElementById('currentRecordId').value = data.id;
            document.getElementById('recordCounter').innerText = data.id + " of " + data.recordCount;
            
            // Update form fields (use similar mapping as in the search method)
            document.getElementById('fileNoPrefix').value = data.fileNoPrefix;
            document.getElementById('fileNumber').value = data.fileNumber;
            document.getElementById('Previewflenumber').value = data.kangisFileNo;
            document.getElementById('oldTitleSerialNo').value = data.oldTitleSerialNo;
            document.getElementById('oldTitlePageNo').value = data.oldTitlePageNo;
            document.getElementById('oldTitleVolumeNo').value = data.oldTitleVolumeNo;
            document.getElementById('lgaName').value = data.lgaName;
            document.getElementById('layoutName').value = data.layoutName;
            document.getElementById('Assignor').value = data.originalAllottee;
            document.getElementById('Assignee').value = data.currentAllottee;
            document.getElementById('mlsfNo').value = data.mlsfNo;
            document.getElementById('kangisFileNo').value = data.kangisFileNo;
            document.getElementById('plotNo').value = data.plotNo;
            document.getElementById('description').value = data.description;
        } else {
            alert("No previous record available");
        }
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById('nextButton').addEventListener('click', function() {
    const currentId = document.getElementById('currentRecordId').value;
    fetch("{{ route('propertycard.navigate') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ direction: 'next', currentId: currentId })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Update hidden field and record counter display
            document.getElementById('currentRecordId').value = data.id;
            document.getElementById('recordCounter').innerText = data.id + " of " + data.recordCount;
            
            // Update form fields similarly
            document.getElementById('fileNoPrefix').value = data.fileNoPrefix;
            document.getElementById('fileNumber').value = data.fileNumber;
            document.getElementById('Previewflenumber').value = data.kangisFileNo;
            document.getElementById('oldTitleSerialNo').value = data.oldTitleSerialNo;
            document.getElementById('oldTitlePageNo').value = data.oldTitlePageNo;
            document.getElementById('oldTitleVolumeNo').value = data.oldTitleVolumeNo;
            document.getElementById('lgaName').value = data.lgaName;
            document.getElementById('layoutName').value = data.layoutName;
            document.getElementById('Assignor').value = data.originalAllottee;
            document.getElementById('Assignee').value = data.currentAllottee;
            document.getElementById('mlsfNo').value = data.mlsfNo;
            document.getElementById('kangisFileNo').value = data.kangisFileNo;
            document.getElementById('plotNo').value = data.plotNo;
            document.getElementById('description').value = data.description;
        } else {
            alert("No next record available");
        }
    })
    .catch(error => console.error('Error:', error));
});

// Add these event listeners after your existing navigation code
document.getElementById('firstButton').addEventListener('click', function() {
    fetch("{{ route('propertycard.navigate') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ direction: 'first' })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            updateFormWithRecord(data);
        } else {
            alert("Could not load first record");
        }
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById('lastButton').addEventListener('click', function() {
    fetch("{{ route('propertycard.navigate') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ direction: 'last' })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            updateFormWithRecord(data);
        } else {
            alert("Could not load last record");
        }
    })
    .catch(error => console.error('Error:', error));
});

// Add this helper function to avoid code duplication
function updateFormWithRecord(data) {
    document.getElementById('currentRecordId').value = data.id;
    document.getElementById('recordCounter').innerText = data.id + " of " + data.recordCount;
    
    document.getElementById('fileNoPrefix').value = data.fileNoPrefix;
    document.getElementById('fileNumber').value = data.fileNumber;
    document.getElementById('Previewflenumber').value = data.kangisFileNo;
    document.getElementById('oldTitleSerialNo').value = data.oldTitleSerialNo;
    document.getElementById('oldTitlePageNo').value = data.oldTitlePageNo;
    document.getElementById('oldTitleVolumeNo').value = data.oldTitleVolumeNo;
    document.getElementById('lgaName').value = data.lgaName;
    document.getElementById('layoutName').value = data.layoutName;
    document.getElementById('Assignor').value = data.originalAllottee;
    document.getElementById('Assignee').value = data.currentAllottee;
    document.getElementById('mlsfNo').value = data.mlsfNo;
    document.getElementById('kangisFileNo').value = data.kangisFileNo;
    document.getElementById('plotNo').value = data.plotNo;
    document.getElementById('description').value = data.description;
}
</script>
 
<script>
document.getElementById('findButton').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent form submission
    
    const searchData = {};
    
    // Only include enabled fields that have values
    if (!document.getElementById('mlsfNo').disabled) {
        const mlsfNo = document.getElementById('mlsfNo').value;
        if (mlsfNo && mlsfNo !== 'N/A') searchData.mlsfNo = mlsfNo;
    }
    
    if (!document.getElementById('kangisFileNo').disabled) {
        const kangisFileNo = document.getElementById('kangisFileNo').value;
        if (kangisFileNo && kangisFileNo !== 'N/A') searchData.kangisFileNo = kangisFileNo;
    }
    
    if (!document.getElementById('oldTitleSerialNo').disabled) {
        const serialNo = document.getElementById('oldTitleSerialNo').value;
        if (serialNo && serialNo !== 'N/A') searchData.oldTitleSerialNo = serialNo;
    }
    
    if (!document.getElementById('oldTitlePageNo').disabled) {
        const pageNo = document.getElementById('oldTitlePageNo').value;
        if (pageNo && pageNo !== 'N/A') searchData.oldTitlePageNo = pageNo;
    }
    
    if (!document.getElementById('oldTitleVolumeNo').disabled) {
        const volumeNo = document.getElementById('oldTitleVolumeNo').value;
        if (volumeNo && volumeNo !== 'N/A') searchData.oldTitleVolumeNo = volumeNo;
    }
    
    if (!document.getElementById('lgaName').disabled) {
        const lgaName = document.getElementById('lgaName').value;
        if (lgaName && lgaName !== 'N/A') searchData.lgaName = lgaName;
    }
    
    if (!document.getElementById('Assignor').disabled) {
        const assignor = document.getElementById('Assignor').value;
        if (assignor && assignor !== 'N/A') searchData.originalAllottee = assignor;
    }
    
    if (!document.getElementById('Assignee').disabled) {
        const assignee = document.getElementById('Assignee').value;
        if (assignee && assignee !== 'N/A') searchData.currentAllottee = assignee;
    }

    // Add CSRF token
    searchData._token = '{{ csrf_token() }}';

    console.log('Search data:', searchData); // Debug log

    // Only proceed if we have at least one search criterion
    if (Object.keys(searchData).length > 1) { // >1 because we always have _token
        fetch('{{ route('propertycard.search') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': searchData._token
            },
            body: JSON.stringify(searchData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the form fields with the returned data
                updateFormFields(data);
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'No matching records found',
                    text: data.message || 'No matching record found.'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while searching'
            });
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Please enable and enter at least one search criterion'
        });
    }
});
 
// Add this helper function to update form fields
function updateFormFields(data) {
    const record = data.data; // Access the data object

    const fields = {
        'fileNoPrefix': 'fileNoPrefix',
        'fileNumber': 'fileNumber',
        'Previewflenumber': 'kangisFileNo', //Previewflenumber is displaying kangisFileNo
        'oldTitleSerialNo': 'oldTitleSerialNo',
        'oldTitlePageNo': 'oldTitlePageNo',
        'oldTitleVolumeNo': 'oldTitleVolumeNo',
        'lgaName': 'lgaName',
        'layoutName': 'layoutName',
        'plotNo': 'plotNo',
        'description': 'description',
        'Assignor': 'originalAllottee', // Corrected mapping
        'Assignee': 'currentAllottee',  // Corrected mapping
        'mlsfNo': 'mlsfNo',
        'kangisFileNo': 'kangisFileNo'
    };

    for (const inputField in fields) {
        if (fields.hasOwnProperty(inputField)) {
            const dataField = fields[inputField];
            const element = document.getElementById(inputField);
            if (element && record[dataField] !== null && record[dataField] !== undefined) {
                element.value = record[dataField];
            } else if (element) {
                element.value = 'N/A'; // Set to "N/A" if data is null or undefined
            }
        }
    }

    // Update the record counter
    const recordCounter = document.getElementById('recordCounter');
    if (recordCounter && record.id) {
        recordCounter.innerText = record.id + " of " + '{{$recordCount}}';
        document.getElementById('currentRecordId').value = record.id;
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set initial record counter value
    const recordCounter = document.getElementById('recordCounter');
    if (recordCounter && !document.getElementById('currentRecordId').value) {
        recordCounter.innerText = "0 of {{$recordCount}}";
    }

    // Function to set text color based on input value
    function setInputTextColor(inputElement) {
        if (!['fileNoPrefix', 'fileNumber', 'Previewflenumber'].includes(inputElement.id) && 
            inputElement.value && inputElement.value !== 'N/A' && inputElement.value !== 'NULL' && inputElement.value !== '') {
            inputElement.style.color = 'red';
        } else {
            inputElement.style.color = 'red'; // Change default color to red
        }
    }

    // Apply initial text color to all input fields except excluded ones
    const inputFields = document.querySelectorAll('input[type="text"], select');
    inputFields.forEach(function(inputElement) {
        if (!['fileNoPrefix', 'fileNumber', 'Previewflenumber'].includes(inputElement.id)) {
            setInputTextColor(inputElement);
        }
    });

    // Add event listener to input fields to change text color on input
    inputFields.forEach(function(inputElement) {
        if (!['fileNoPrefix', 'fileNumber', 'Previewflenumber'].includes(inputElement.id)) {
            inputElement.addEventListener('input', function() {
                setInputTextColor(this);
            });
        }
    });

    function updateFormFields(data) {
        const record = data.data;

        const fields = {
            'oldTitleSerialNo': 'oldTitleSerialNo',
            'oldTitlePageNo': 'oldTitlePageNo', 
            'oldTitleVolumeNo': 'oldTitleVolumeNo',
            'lgaName': 'lgaName',
            'layoutName': 'layoutName',
            'plotNo': 'plotNo',
            'description': 'description',
            'Assignor': 'originalAllottee',
            'Assignee': 'currentAllottee', 
            'mlsfNo': 'mlsfNo',
            'kangisFileNo': 'kangisFileNo'
        };

        for (const inputField in fields) {
            if (fields.hasOwnProperty(inputField)) {
                const dataField = fields[inputField];
                const element = document.getElementById(inputField);
                if (element && record[dataField] !== null && record[dataField] !== undefined) {
                    element.value = record[dataField];
                } else if (element) {
                    element.value = 'N/A';
                }
                if (element) {
                    setInputTextColor(element);
                }
            }
        }
        
        const recordCounter = document.getElementById('recordCounter');
        if (recordCounter && record.id) {
            recordCounter.innerText = record.id + " of " + '{{$recordCount}}';
            document.getElementById('currentRecordId').value = record.id;
        }
    }

    document.getElementById('findButton').addEventListener('click', function(e) {
        // ...existing code...
    });
});
</script>

@endsection
