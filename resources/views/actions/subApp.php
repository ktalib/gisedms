@extends('layouts.app')
@section('page-title')
{{ __('SECTIONAL TITLING  MODULE') }}
@endsection

<style>
    .ck-editor__editable {
        min-height: 200px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    textarea,
    select {
        min-height: 55px;
        background-color: #fdfdfd;
    }

    input:disabled,
    select:disabled,
    textarea:disabled {
        background-color: #bbbbbb;
    }

    #myDiv {
        display: none;
        transition: all 0.3s ease-in-out;
    }

    select,
    input {
        transition: all 0.2s ease-in-out;
    }

    select:focus,
    input:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    #Previewflenumber {
        font-family: monospace;
        letter-spacing: 0.05em;
    }

    .bootstrap-tagsinput {
        width: 100%;
        padding: 0.5rem;
        border-radius: 0.375rem;
        min-height: 55px;
        background-color: #fdfdfd;
    }

    .bootstrap-tagsinput .tag {
        background-color: #3b82f6;
        color: white;
        padding: 3px 7px;
        border-radius: 3px;
        margin-right: 4px;
    }
</style>
@include('sectionaltitling.partials.assets.css')
@section('content')
<!-- Main Content -->
<div class="flex-1 overflow-auto">
    <!-- Header -->
    @include('admin.header')
    <!-- Dashboard Content -->
    <div class="p-6">

        <!-- Tabs -->
        @include('sectionaltitling.partials.tabs')


        <!-- Primary Applications Table -->
        <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
            <div class="container py-4">
                <div class="card shadow-sm">
                    <div class="card-body" style="width:100%">
                        <form id="subApplicationForm" method="POST" action="{{ route('sectionaltitling.storesub') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <!-- Main Application Reference -->


                            <div class="form-section">
                                <h2 class="section-title">Main Application Reference</h2>
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <label class="block text-sm font-medium text-gray-700">Main Application ID</label>
                                    <input type="text" id="mainApplicationId" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled>

                                    <input type="hidden" name="main_application_id" id="mainApplicationId1" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                                    <input type="hidden" name="file_no" id="fileNo2" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <p class="text-xs text-gray-500 mt-1">This field links your sub-application to a valid main application.</p>
                                    <!-- Updated display container for main application data -->
                                    <div id="mainApplicationData" class="mt-4 space-y-2">
                                        <p><strong>Owner Name:</strong> <span id="mainApplicationOwner" class="ml-2"></span></p>
                                        <p><strong>File Number:</strong> <span id="fileNo" class="ml-2"></span></p>
                                        <p><strong>Form ID:</strong> <span id="formId" class="ml-2"></span></p>
                                        <p><strong>Property Location:</strong> <span id="propertyLocation" class="ml-2"></span></p>
                                        <p><strong>Number of Units:</strong> <span id="mainApplicationNoOfUnits" class="ml-2"></span></p>
                                        @php
                                        $mainApplicationId = request()->get('application_id');
                                        // Fetch the number of units from the mother_applications table
                                        $motherApplication = DB::connection('sqlsrv')->table('mother_applications')->where('id', $mainApplicationId)->first();
                                        $totalUnitsInMotherApp = $motherApplication ? $motherApplication->NoOfUnits : 0;

                                        // Count the number of sub-applications linked to the main application
                                        $totalSubApplications = DB::connection('sqlsrv')->table('subapplications')->where('main_application_id', $mainApplicationId)->count();

                                        // Calculate the remaining units
                                        $remainingUnits = $totalUnitsInMotherApp - $totalSubApplications;
                                        @endphp

                                        <p>
                                            <strong>Remaining Units:</strong>
                                            <span class="ml-2 font-semibold text-green-500">
                                                {{ $remainingUnits }}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                            </div>



                            <div class="form-section">
                                <h2 class="section-title">Applicant Type</h2>
                                <div class="flex gap-4">
                                    <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700" onclick="showIndividualFields(); setApplicantType('individual')">Individual</button>
                                    <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700" onclick="showCorporateFields(); setApplicantType('corporate')">Corporate Body</button>
                                    <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700" onclick="showMultipleOwnersFields(); setApplicantType('multiple')">Multiple Owners</button>
                                </div>
                            </div>
                            <input type="hidden" name="applicant_type" id="applicantType" value="">

                            <div class="form-section" style="display: none;">

                                <!-- Replace the existing file prefix, year, and serial number section with this code -->
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <!-- Prefix Selection -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">File Prefix</label>
                                            <input type="text" id="filePrefix" name="file_prefix"
                                                class="w-full p-2 border border-gray-300 rounded-md bg-gray-100"
                                                value="{{ $prefix }}" readonly>
                                            <!-- Hidden input for land use -->
                                            <input type="hidden" id="landUse" value="{{ request()->get('land_use') }}">
                                        </div>

                                        <!-- Year Selection (Current Year) -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Year</label>
                                            <input type="text" id="fileYear"
                                                class="w-full p-2 border border-gray-300 rounded-md bg-gray-100"
                                                value="{{ $currentYear }}" readonly>
                                            <!-- Hidden input for Year -->
                                            <input type="hidden" id="fileYearHidden" name="file_year" value="{{ $currentYear }}">
                                        </div>

                                        <!-- Serial Number -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Serial Number</label>
                                            <input type="text" id="serialNumber"
                                                class="w-full p-2 border border-gray-300 rounded-md bg-gray-100"
                                                value="{{ $formattedSerialNumber }}" readonly>

                                            <!-- Hidden input for Serial Number -->
                                            <input type="text" id="serialNumberHidden" name="serial_number" value="{{ $formattedSerialNumber }}">
                                        </div>
                                    </div>

                                    <!-- Full File Number Preview -->
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-gray-700">Full File Number</label>
                                        <input type="text" id="fileNumberPreview"
                                            class="w-full p-2 border border-gray-300 rounded-md bg-gray-100"
                                            value="{{ $prefix }}-{{ $currentYear }}-{{ $formattedSerialNumber }}" readonly>
                                        <input type="hidden" id="hiddenFileNumber" name="fileno"
                                            value="{{ $prefix }}-{{ $currentYear }}-{{ $formattedSerialNumber }}">
                                    </div>
                                </div>

                                <script>
                                    // No need for the DOM-loaded script for prefix since it's now set server-side
                                    // We can keep a simplified version of the script just to ensure the full number is properly formatted
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Set the file number preview initially
                                        const prefix = document.getElementById('filePrefix').value;
                                        const year = document.getElementById('fileYear').value;
                                        const serial = document.getElementById('serialNumber').value;

                                        const fullFileNumber = `${prefix}-${year}-${serial}`;
                                        document.getElementById('fileNumberPreview').value = fullFileNumber;
                                        document.getElementById('hiddenFileNumber').value = fullFileNumber;
                                    });
                                </script>
                            </div>



                            <!-- Personal Information -->
                            <div class="form-section" id="individualFields" style="display: none;">
                                <h2 class="section-title">Personal Information</h2>
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                        <!-- Left side - Personal Details -->
                                        <div class="md:col-span-3">
                                            <div class="grid grid-cols-3 gap-4">
                                                <!-- Title -->
                                                <div class="w-full">
                                                    <label class="block text-sm font-medium text-gray-700">Title</label>
                                                    <select id="applicantTitle" name="applicant_title" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" onchange="updateApplicantNamePreview()">
                                                        <option value="" disabled selected>Select title</option>
                                                        <option value="Mr.">Mr.</option>
                                                        <option value="Mrs.">Mrs.</option>
                                                        <option value="Chief">Chief</option>
                                                        <option value="Master">Master</option>
                                                        <option value="Capt">Capt</option>
                                                        <option value="Coln">Coln</option>
                                                        <option value="Pastor">Pastor</option>
                                                        <option value="King">King</option>
                                                        <option value="Prof">Prof</option>
                                                        <option value="Dr.">Dr.</option>
                                                        <option value="Alhaji">Alhaji</option>
                                                        <option value="Alhaja">Alhaja</option>
                                                        <option value="High Chief">High Chief</option>
                                                        <option value="Lady">Lady</option>
                                                        <option value="Bishop">Bishop</option>
                                                        <option value="Senator">Senator</option>
                                                        <option value="Messr">Messr</option>
                                                        <option value="Honorable">Honorable</option>
                                                        <option value="Miss">Miss</option>
                                                        <option value="Rev.">Rev.</option>
                                                        <option value="Barr.">Barr.</option>
                                                        <option value="Arc.">Arc.</option>
                                                        <option value="Sister">Sister</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>

                                                <!-- First Name -->
                                                <div class="w-full">
                                                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                                                    <input type="text" id="applicantName" name="first_name" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter first name" oninput="updateApplicantNamePreview()">
                                                </div>

                                                <!-- Middle Name -->
                                                <div class="w-full">
                                                    <label class="block text-sm font-medium text-gray-700">Middle Name (Optional)</label>
                                                    <input type="text" id="applicantMiddleName" name="middle_name" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter middle name" oninput="updateApplicantNamePreview()">
                                                </div>

                                                <!-- Surname -->
                                                <div class="w-full col-span-3">
                                                    <label class="block text-sm font-medium text-gray-700">Surname</label>
                                                    <input type="text" id="applicantSurname" name="surname" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter surname" oninput="updateApplicantNamePreview()">
                                                </div>

                                                <!-- Name of Applicant -->
                                                <div class="w-full col-span-3">
                                                    <label class="block text-sm font-medium text-gray-700">Name of Applicant</label>
                                                    <input type="text" id="applicantNamePreview" name="applicant_name_preview" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right side - Photo Upload -->
                                        <div class="w-[180px] flex-shrink-0">
                                            <div id="photoUploadContainer" class="relative w-[180px] h-[215px] border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50">
                                                <div id="photoPlaceholder" class="flex flex-col items-center justify-center text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <p class="text-sm">Upload Photo</p>
                                                </div>
                                                <img id="photoPreview" class="w-full h-full object-cover hidden" src="#" alt="">
                                                <button type="button" id="removePhotoBtn" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hidden hover:bg-red-600" onclick="removePhoto()">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                                <input type="file" id="photoUpload" name="passport" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewPhoto(event)">
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2 text-center">Passport size photo (3.5 x 4.5 cm)</p>
                                        </div>

                                        <script>
                                            function updateApplicantNamePreview() {
                                                const title = document.getElementById('applicantTitle').value;
                                                const name = document.getElementById('applicantName').value;
                                                const middleName = document.getElementById('applicantMiddleName').value;
                                                const surname = document.getElementById('applicantSurname').value;
                                                let applicantName = '';

                                                if (title) {
                                                    applicantName += title + ' ';
                                                }
                                                if (name) {
                                                    applicantName += name + ' ';
                                                }
                                                if (middleName) {
                                                    applicantName += middleName + ' ';
                                                }
                                                if (surname) {
                                                    applicantName += surname;
                                                }

                                                document.getElementById('applicantNamePreview').value = applicantName.trim();
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <!-- Corporate Body Information -->
                            <div class="form-section" id="corporateFields" style="display: none;">
                                <h2 class="section-title">Corporate Body Information</h2>
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                        <!-- Left side -->
                                        <div class="md:col-span-3">
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Name of Corporate Body</label>
                                                    <input type="text" id="corporateName" name="corporate_name" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter corporate body name">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">RC Number</label>
                                                    <input type="text" id="rcNumber" name="rc_number" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter RC number">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <!-- Multiple Owners Information -->
                            <div class="form-section" id="multipleOwnersFields" style="display: none;">
                                <h2 class="section-title">Multiple Owners Information</h2>
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <div id="ownersContainer">
                                        <!-- Dynamic rows will be inserted here -->
                                    </div>
                                    <div class="mt-4">
                                        <button type="button" onclick="addOwnerRow()" class="px-4 py-2 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700">
                                            <i class="fas fa-plus"></i> Add Owner
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <script>
                                let ownerRowCount = 0;

                                function addOwnerRow() {
                                    const container = document.getElementById('ownersContainer');
                                    const rowId = `owner-row-${ownerRowCount}`;

                                    const row = document.createElement('div');
                                    row.id = rowId;
                                    row.className = 'grid grid-cols-12 gap-4 mb-4 items-center';

                                    row.innerHTML = `
                                        <div class="col-span-6">
                                            <input type="text" name="multiple_owners_names[]" 
                                                   class="w-full p-2 border border-gray-300 rounded-md" 
                                                   placeholder="Full Name" required>
                                        </div>
                                        <div class="col-span-4">
                                            <div class="relative">
                                                <input type="file" name="multiple_owners_passport[]" 
                                                       class="w-full p-2 border border-gray-300 rounded-md" 
                                                       accept="image/*" required
                                                       onchange="previewOwnerPhoto(event, '${rowId}')">
                                                <img class="owner-preview hidden w-16 h-16 object-cover mt-2 rounded-md" src="#" alt="Preview">
                                            </div>
                                        </div>
                                        <div class="col-span-2 flex justify-end">
                                            <button type="button" onclick="removeOwnerRow('${rowId}')" 
                                                    class="px-3 py-2 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    `;

                                    container.appendChild(row);
                                    ownerRowCount++;
                                }

                                function removeOwnerRow(rowId) {
                                    const row = document.getElementById(rowId);
                                    if (row) {
                                        row.remove();
                                    }
                                }

                                function previewOwnerPhoto(event, rowId) {
                                    const file = event.target.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        const row = document.getElementById(rowId);
                                        const preview = row.querySelector('.owner-preview');

                                        reader.onload = function(e) {
                                            preview.src = e.target.result;
                                            preview.classList.remove('hidden');
                                        }
                                        reader.readAsDataURL(file);
                                    }
                                }

                                // Add initial row when multiple owners is selected
                                function showMultipleOwnersFields() {
                                    document.getElementById('individualFields').style.display = 'none';
                                    document.getElementById('corporateFields').style.display = 'none';
                                    document.getElementById('multipleOwnersFields').style.display = 'block';

                                    // Clear existing rows
                                    document.getElementById('ownersContainer').innerHTML = '';
                                    // Add first row
                                    addOwnerRow();
                                }
                            </script>

                            <!-- Contact Information -->
                            @include('sectionaltitling.partials.contact_address')
                            <!-- Identification -->
                            <div class="form-section">
                                <h2 class="section-title">Identification</h2>
                                <div>
                                    <h3 class="text-sm font-medium mb-4">5. Tick means of Identification (Attached)</h3>
                                    <div class="grid grid-cols-2 gap-4">
                                        <label class="flex items-center space-x-3">
                                            <input type="radio" name="identification_type" value="national_id" class="radio-custom">
                                            <span class="text-sm">A. National ID</span>
                                        </label>
                                        <label class="flex items-center space-x-3">
                                            <input type="radio" name="identification_type" value="voters_card" class="radio-custom">
                                            <span class="text-sm">B. Voters Card</span>
                                        </label>
                                        <label class="flex items-center space-x-3">
                                            <input type="radio" name="identification_type" value="drivers_license" class="radio-custom">
                                            <span class="text-sm">C. Driver's License</span>
                                        </label>
                                        <label class="flex items-center space-x-3">
                                            <input type="radio" name="identification_type" value="international_passport" class="radio-custom">
                                            <span class="text-sm">D. International Passport</span>
                                        </label>
                                        <div class="col-span-2 flex items-center space-x-3">
                                            <input type="radio" name="identification_type" value="others" class="radio-custom" id="identificationOthers" onchange="toggleOtherInput('identificationOthers', 'identificationOthersInput')">
                                            <span class="text-sm">E. Others (Specify)</span>
                                            <input type="text" id="identificationOthersInput" name="identification_others" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex-1" disabled placeholder="Specify other identification">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Property/Unit Details -->
                            <div class="form-section">
                                <h2 class="section-title">Unit Details</h2>
                                <div class="bg-gray-50 p-4 rounded-md space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Block No</label>
                                            <input type="text" name="block_number" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter block number">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Section No (Floor) </label>
                                            <input type="text" name="floor_number" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter floor number">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Unit No</label>
                                            <input type="text" name="unit_number" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter unit number">
                                        </div>
                                    </div>
                                    <div>

                                    </div>
                                    <div style="display: none;">
                                        <label class="block text-sm font-medium text-gray-700">Ownership Details</label>
                                        <p class="text-xs text-gray-500 mb-2">Type of ownership based on application type</p>
                                        <input type="text" name="ownership" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mb-2" readonly>
                                        <label class="block text-sm font-medium text-gray-700">Property Location</label>
                                        <textarea name="property_location" id="propertyLocation" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Enter property location" disabled></textarea>
                                    </div>
                                </div>
                            </div>

                            @include('sectionaltitling.types.ownership')
                            @include('sectionaltitling.types.commercial')
                            @include('sectionaltitling.types.residential')
                            @include('sectionaltitling.types.industrial')

                            <!-- Additional Information -->
                            <div class="form-section">
                                <h2 class="section-title">Additional Information</h2>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Comments</label>
                                    <textarea name="comments" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 min-h-[100px]" placeholder="Enter any comments"></textarea>
                                </div>
                            </div>
                            <div class="form-section bg-gray-200 shadow-md rounded-md">
                                <h3 class="section-title bg-gray-700 text-white px-6 py-3 rounded-t-md">Initial Bill</h3>
                                <div class="p-6 space-y-6">
                                    <!-- Fee Grid Layout -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Application Fee -->
                                        <div class="flex items-center">
                                            <label class="w-32 text-sm font-medium text-gray-700">Application Fee:</label>
                                            <input type="number" name="application_fee"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                                placeholder="Enter amount">
                                        </div>

                                        <!-- Processing Fee -->
                                        <div class="flex items-center">
                                            <label class="w-32 text-sm font-medium text-gray-700">Processing Fee:</label>
                                            <input type="number" name="processing_fee"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                                placeholder="Enter amount">
                                        </div>

                                        <!-- Site Plan Fee -->
                                        <div class="flex items-center">
                                            <label class="w-32 text-sm font-medium text-gray-700">Site Plan Fee:</label>
                                            <input type="number" name="site_plan_fee"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                                placeholder="Enter amount">
                                        </div>

                                        <div class="flex items-center">
                                            <label class="w-32 text-sm font-medium text-gray-700">Payment Date:</label>
                                            <input type="date" name="payment_date"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                                        </div>


                                        <!-- Receipt Section -->
                                        <div class="border-t pt-6">
                                            <div class="flex items-center">
                                                <label class="w-32 text-sm font-medium text-gray-700">Receipt No:</label>
                                                <input type="text" name="receipt_number"
                                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                                                    placeholder="Enter receipt number">
                                            </div>
                                        </div>

                                        <!-- Optional: Totals Section -->
                                        <div class="border-t pt-6 mt-4">
                                            <div class="flex justify-end items-center space-x-4">
                                                <span class="text-sm font-medium text-green-700">Total Amount:</span>
                                                <span class="text-lg font-bold text-green-700" id="totalAmount">₦0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <!-- Form Actions -->
                                <div class="flex justify-end space-x-4" style="tex">
                                    <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50" onclick="resetSubForm()">
                                        Reset
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                                        Submit Sub-Application
                                    </button>

                                </div>
                                <br><br>
                        </form>
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
        // Function to get URL parameters
        function getUrlParams() {
            let params = {};
            const searchParams = new URLSearchParams(window.location.search);
            for (let [key, value] of searchParams) {
                params[key] = decodeURIComponent(value);
            }
            return params;
        }

        // Get URL parameters
        const params = getUrlParams();

        // Populate the fields
        if (params.application_id) {
            document.getElementById('mainApplicationId').value = 'STM-2025-000-' + params.application_id;
        }

        if (params.NoOfUnits) {
            document.getElementById('mainApplicationNoOfUnits').textContent = params.NoOfUnits;
        }

        if (params.land_use) {
            document.getElementById('landUse').value = params.land_use;
        }
        if (params.application_id) {
            document.getElementById('mainApplicationId1').value = params.application_id;
        }

        // Handle owner name based on type
        if (params.owner_name) {
            document.getElementById('mainApplicationOwner').textContent = params.owner_name.trim();
        } else if (params.corporate_name) {
            document.getElementById('mainApplicationOwner').textContent = params.corporate_name.trim();
        } else if (params.multiple_owners_names) {
            document.getElementById('mainApplicationOwner').textContent = params.multiple_owners_names.trim();
        }

        if (params.fileno) {
            document.getElementById('fileNo').textContent = params.fileno;
        }

        if (params.fileno) {
            document.getElementById('fileNo2').value = params.fileno;
        }
        if (params.formID) {
            document.getElementById('formId').textContent = '000' + params.formID;
        }

        // Join property location fields
        const propertyLocation = [
            params.plot_house_no,
            params.plot_plot_no,
            params.plot_street_name,
            params.plot_district
        ].filter(Boolean).join(' ');

        if (propertyLocation) {
            document.getElementById('propertyLocation').textContent = propertyLocation;
            // Update the ownership details property location
            document.querySelector('textarea[name="property_location"]').value = propertyLocation;
        }

        // Update ownership value based on applicant type
        const ownershipInput = document.querySelector('input[name="ownership"]');
        if (params.corporate_name) {
            ownershipInput.value = "Corporate Owner";
        } else if (params.multiple_owners_names) {
            ownershipInput.value = "Multiple Owners";
        } else {
            ownershipInput.value = "Individual Owner";
        }
    });

    // Photo upload preview functionality
    function previewPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const photoPreview = document.getElementById('photoPreview');
                const photoPlaceholder = document.getElementById('photoPlaceholder');
                const removePhotoBtn = document.getElementById('removePhotoBtn');

                photoPreview.src = e.target.result;
                photoPreview.classList.remove('hidden');
                photoPlaceholder.classList.add('hidden');
                removePhotoBtn.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Remove photo functionality
    function removePhoto() {
        const photoUpload = document.getElementById('photoUpload');
        const photoPreview = document.getElementById('photoPreview');
        const photoPlaceholder = document.getElementById('photoPlaceholder');
        const removePhotoBtn = document.getElementById('removePhotoBtn');

        photoUpload.value = '';
        photoPreview.src = '#';
        photoPreview.classList.add('hidden');
        photoPlaceholder.classList.remove('hidden');
        removePhotoBtn.classList.add('hidden');
    }

    // Toggle "Other" input fields
    function toggleOtherInput(checkboxId, inputId) {
        const checkbox = document.getElementById(checkboxId);
        const input = document.getElementById(inputId);
        input.disabled = !checkbox.checked;
        if (!checkbox.checked) {
            input.value = '';
        }
    }



    // Updated event listeners to enable/disable "Others" input fields based on selection:
    document.querySelectorAll('input[name="identificationType"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const othersInput = document.getElementById('identificationOthersInput');
            if (document.getElementById('identificationOthers').checked) {
                othersInput.disabled = false;
            } else {
                othersInput.disabled = true;
                othersInput.value = '';
            }
        });
    });

    document.querySelectorAll('input[name="residentialType"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const othersInput = document.getElementById('residentialOthersInput');
            if (document.getElementById('residentialOthers').checked) {
                othersInput.disabled = false;
            } else {
                othersInput.disabled = true;
                othersInput.value = '';
            }
        });
    });

    // Form submission



    // Replace the duplicate event listeners with this single updated version:
    function initializeRadioHandlers() {
        // For Identification Type
        document.querySelectorAll('input[name="identificationType"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const othersInput = document.getElementById('identificationOthersInput');
                othersInput.disabled = !document.getElementById('identificationOthers').checked;
                if (othersInput.disabled) {
                    othersInput.value = '';
                }
            });
        });

        // For Residential Type 
        document.querySelectorAll('input[name="residentialType"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const othersInput = document.getElementById('residentialOthersInput');
                othersInput.disabled = !document.getElementById('residentialOthers').checked;
                if (othersInput.disabled) {
                    othersInput.value = '';
                }
            });
        });
    }

    // Initialize the handlers when the document loads
    document.addEventListener('DOMContentLoaded', initializeRadioHandlers);

    function showIndividualFields() {
        clearOtherFields('individualFields');
        document.getElementById('individualFields').style.display = 'block';
        document.getElementById('corporateFields').style.display = 'none';
        document.getElementById('multipleOwnersFields').style.display = 'none';
    }

    function showCorporateFields() {
        clearOtherFields('corporateFields');
        document.getElementById('individualFields').style.display = 'none';
        document.getElementById('corporateFields').style.display = 'block';
        document.getElementById('multipleOwnersFields').style.display = 'none';
    }

    function showMultipleOwnersFields() {
        clearOtherFields('multipleOwnersFields');
        document.getElementById('individualFields').style.display = 'none';
        document.getElementById('corporateFields').style.display = 'none';
        document.getElementById('multipleOwnersFields').style.display = 'block';
    }

    function clearOtherFields(exceptId) {
        const fields = ['individualFields', 'corporateFields', 'multipleOwnersFields'];
        fields.forEach(id => {
            if (id !== exceptId) {
                document.getElementById(id).querySelectorAll('input, select, textarea').forEach(input => {
                    input.value = '';
                });
            }
        });
    }

    // Initialize tagsinput with custom options
    $(document).ready(function() {
        $('#multipleOwnersNames').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44], // Enter and comma
            tagClass: 'badge bg-primary'
        });

        // Example of how to add pre-populated names
        var exampleOwners = [
            "Mr. Kator Issac",
            "Mr. Kunle Olaniyan",
            "Mrs. Beatrice Emeka"
        ];

        exampleOwners.forEach(function(owner) {
            $('#multipleOwnersNames').tagsinput('add', owner);
        });
    });




    function previewOwnerPhoto(event, containerId) {
        const container = document.getElementById(containerId);
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = container.querySelector('.photo-preview');
                const placeholder = container.querySelector('.photo-placeholder');
                const removeBtn = container.querySelector('.remove-photo-btn');

                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                removeBtn.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function removeOwnerPhoto(containerId) {
        const container = document.getElementById(containerId);
        const preview = container.querySelector('.photo-preview');
        const placeholder = container.querySelector('.photo-placeholder');
        const removeBtn = container.querySelector('.remove-photo-btn');
        const fileInput = container.querySelector('input[type="file"]');

        fileInput.value = '';
        preview.src = '#';
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
        removeBtn.classList.add('hidden');
    }

    function updatePlotFullAddress() {
        const houseNo = document.getElementById('plotHouseNo').value;
        const plotNo = document.getElementById('plotPlotNo').value;
        const streetName = document.getElementById('plotStreetName').value;
        const district = document.getElementById('plotDistrict').value;
        const fullAddress = `${houseNo} ${plotNo} ${streetName} ${district}`.trim();
        document.getElementById('plotFullAddress').value = fullAddress;
    }

    function updateOwnerFullAddress() {
        const houseNo = document.getElementById('ownerHouseNo').value;
        const plotNo = document.getElementById('ownerPlotNo').value;
        const streetName = document.getElementById('ownerStreetName').value;
        const district = document.getElementById('ownerDistrict').value;
        const fullAddress = `${houseNo} ${plotNo} ${streetName} ${district}`.trim();
        document.getElementById('ownerFullAddress').value = fullAddress;
    }

    // Applicant type selection

    function setApplicantType(type) {
        document.getElementById('applicantType').value = type;
    }


    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('input', calculateTotal);
    });

    function calculateTotal() {
        const applicationFee = parseFloat(document.querySelector('input[name="application_fee"]').value) || 0;
        const processingFee = parseFloat(document.querySelector('input[name="processing_fee"]').value) || 0;
        const sitePlanFee = parseFloat(document.querySelector('input[name="site_plan_fee"]').value) || 0;

        const total = applicationFee + processingFee + sitePlanFee;
        document.getElementById('totalAmount').textContent = `₦${total.toFixed(2)}`;
    }
</script>
@endsection