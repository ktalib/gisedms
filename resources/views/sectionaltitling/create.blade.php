{{-- filepath: c:\wamp64\www\gisedms\resources\views\instruments\index.blade.php --}}

@extends('layouts.app')
@section('page-title')

@if(request()->query('landuse') === 'Residential')
{{__('Application for Sectional Titling Residential 
Main Application') }}

@elseif(request()->query('landuse') === 'Commercial')
{{__('Application for Sectional Titling Commercial Main Application') }}

@elseif(request()->query('landuse') === 'Industrial')
{{__('Application for Sectional Titling Industrial Main Application') }}

@endif

  
  
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Application Form') }}</li>
@endsection
@push('script-page')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        integrity="sha512-xmGTNt307zl7Vea/aEykoRJI5jhqeGGWj0Cz6HSuK5ts8vrcP9gaQepgs7axKkgU0vWjxnzCt8mrQvK81dnGuw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
        integrity="sha512-9UR1ynHntZub0OHUIWJvpaXJIRY6Kc6UPQwqEgu8IQD+aKHccWlbAZln+M/rejmUdjoLv2CmEepk8xeaLVgilg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <style>
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
    <script>
        if ($('#classic-editor').length > 0) {
            ClassicEditor.create(document.querySelector('#classic-editor')).catch((error) => {
                console.error(error);
            });
        }
        setTimeout(() => {
            feather.replace();
        }, 500);
    </script>
@endpush
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


    input:disabled {
        background-color: #bbbbbb;
        /* Light gray background color */
    }

    select:disabled {
        background-color: #bbbbbb;
        /* Light gray background color */
    }

    #myDiv {
        display: none;
        /* Initially hidden */
    }

    /* Custom styles for file information form */
    #myDiv {
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
</style>
  
@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body" style="width:100%">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                {{-- Add this section to display validation errors more prominently --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <h5>Please fix the following errors:</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" class="space-y-6" action="{{ route('sectionaltitling.storeMotherApp') }}" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Store landuse value in hidden input for JavaScript access --}}
                    <input type="hidden" id="landuse" name="landuse" value="{{ request()->query('landuse', '') }}">
                 
                    <div class="grid grid-cols-3 gap-2 mb-6">
                        <div>
                            <label for="fileNoPrefix" class="block text-sm font-medium text-gray-700 mb-1">File No
                                Prefix <span style="color:red">*</span></label>
                            <select id="fileNoPrefix" name="fileNoPrefix"
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                style="color: black;" onchange="updateFullFileNumber()">
                                <option value="">Select File Prefix</option>
                                    <option value="KNML">KNML</option>
                                    <option value="MNKL">MNKL</option>
                                    <option value="KN">KN</option>
                                    <option value="CON-COM">CON-COM</option>
                                    <option value="CON-RES">CON-RES</option>
                                    <option value="RES">RES</option>
                                    <option value="MLKN">MLKN</option>
                                    <option value="CON-AG">CON-AG</option>
                                    <option value="KNGP">KNGP</option>
                                    <option value="CON-IND">CON-IND</option>
                            </select>
                        </div>
                        <div>
                            <label for="fileNumber" class="block text-sm font-medium text-gray-700 mb-1">Number <span style="color:red">*</span></label>
                            <input type="text" id="fileNumber" name="fileNumber"
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="" placeholder="Enter file number"
                                style="color: black;" oninput="updateFullFileNumber()">
                        </div>
                        <input type="hidden" id="fileno" name="fileno" value="">
                        <div>
                            <label for="Previewflenumber" class="block text-sm font-medium text-gray-700 mb-1">Full File
                                Number</label>
                            <input type="text" id="Previewflenumber" name="Previewflenumber"
                                class="w-full p-2 border border-gray-300 bg-gray-100 font-medium rounded-md"
                                value="" disabled
                                style="color: black;">
                        </div>
                    </div>

              
 
                  

                    <div class="form-section">
                        <h2 class="section-title">Applicant Type <span style="color:red">*</span></h2>
                        <div class="flex gap-4">
                            <button type="button"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700"
                                onclick="setApplicantType('individual'); showIndividualFields()">Individual</button>
                            <button type="button"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700"
                                onclick="setApplicantType('corporate'); showCorporateFields()">Corporate Body</button>
                            <button type="button"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700"
                                onclick="setApplicantType('multiple'); showMultipleOwnersFields()">Multiple Owners</button>
                        </div>
                    </div>
                    <input type="hidden" name="applicant_type" id="applicantType" value="" >



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
                                            <label class="block text-sm font-medium text-gray-700">
                                                Title <span style="color:red">*</span>
                                            </label>
                                            <select id="applicantTitle" name="applicant_title"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                onchange="updateApplicantNamePreview()" >
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
                                            <label class="block text-sm font-medium text-gray-700">
                                                First Name <span style="color:red">*</span>
                                            </label>
                                            <input type="text" id="applicantName" name="first_name"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Enter first name" oninput="updateApplicantNamePreview()"
                                                >
                                        </div>

                                        <!-- Middle Name -->
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-gray-700">Middle Name
                                                (Optional)</label>
                                            <input type="text" id="applicantMiddleName" name="middle_name"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Enter middle name" oninput="updateApplicantNamePreview()">
                                        </div>

                                        <!-- Surname -->
                                        <div class="w-full col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">
                                                Surname <span style="color:red">*</span>
                                            </label>
                                            <input type="text" id="applicantSurname" name="surname"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Enter surname" oninput="updateApplicantNamePreview()"
                                                >
                                        </div>

                                        <!-- Name of Applicant -->
                                        <div class="w-full col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">Name of
                                                Applicant</label>
                                            <input type="text" id="applicantNamePreview" name="applicant_name_preview"
                                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                disabled>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right side - Photo Upload -->
                                <div class="w-[180px] flex-shrink-0">
                                    <div id="photoUploadContainer"
                                        class="relative w-[180px] h-[215px] border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50">
                                        <div id="photoPlaceholder"
                                            class="flex flex-col items-center justify-center text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <p class="text-sm">Upload Photo</p>
                                        </div>
                                        <img id="photoPreview" class="w-full h-full object-cover hidden" src="#"
                                            alt="">
                                        <button type="button" id="removePhotoBtn"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hidden hover:bg-red-600"
                                            onclick="removePhoto()">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                        <input type="file" id="photoUpload" name="passport" accept="image/*"
                                            class="absolute inset-0 opacity-0 cursor-pointer"
                                            onchange="previewPhoto(event)">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 text-center">Passport size photo (3.5 x 4.5 cm)
                                    </p>
                                </div>
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
                                            <label class="block text-sm font-medium text-gray-700">
                                                Name of Corporate Body <span style="color:red">*</span>
                                            </label>
                                            <input type="text" id="corporateName" name="corporate_name"
                                                class="w-full p-2 border border-gray-300 rounded-md"
                                                placeholder="Enter corporate body name" >
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">
                                                RC Number <span style="color:red">*</span>
                                            </label>
                                            <input type="text" id="rcNumber" name="rc_number"
                                                class="w-full p-2 border border-gray-300 rounded-md"
                                                placeholder="Enter RC number" >
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
                                   placeholder="Full Name" >
                        </div>
                        <div class="col-span-4">
                            <div class="relative">
                                <input type="file" name="multiple_owners_passport[]" 
                                       class="w-full p-2 border border-gray-300 rounded-md" 
                                       accept="image/*" 
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


                    
                  
                      
                       
                        @include('sectionaltitling.partials.contact_address')
                 
                 
                    <!-- Identification -->
                    <div class="form-section">
                        <h2 class="section-title">Identification</h2>
                        <div>
                            <h3 class="text-sm font-medium mb-4">5. Tick means of Identification (Attached) <span style="color:red">*</span></h3>
                            <div class="grid grid-cols-4 gap-4">
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="identification_type" value="national_id"
                                        class="radio-custom">
                                    <span class="text-sm">A. National ID</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="identification_type" value="voters_card"
                                        class="radio-custom">
                                    <span class="text-sm">B. Voters Card</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="identification_type" value="drivers_license"
                                        class="radio-custom">
                                    <span class="text-sm">C. Driver's License</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="identification_type" value="international_passport"
                                        class="radio-custom">
                                    <span class="text-sm">D. International Passport</span>
                                </label>
                                <div class="col-span-4 flex items-center space-x-3">
                                    <input type="radio" name="identification_type" value="others" class="radio-custom"
                                        id="identificationOthers"
                                        onchange="toggleOtherInput('identificationOthers', 'identificationOthersInput')">
                                    <span class="text-sm">E. Others (Specify)</span>
                                    <input type="text" id="identificationOthersInput" name="identification_others"
                                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex-1 hidden"
                                        placeholder="Specify other identification">
                                    <script>
                                        document.getElementById('identificationOthers').addEventListener('change', function() {
                                            const othersInput = document.getElementById('identificationOthersInput');
                                            if (this.checked) {
                                                othersInput.classList.remove('hidden');
                                            } else {
                                                othersInput.classList.add('hidden');
                                                othersInput.value = '';
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(request()->query('landuse') !== 'Residential')
                        <div class="form-section">
                            <h2 class="section-title">No Of Blocks <span style="color:red">*</span></h2>
                            <div>
                                <input type="text" name="NoOfBlocks"
                                    class="w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="No Of Blocks">
                            </div>
                        </div>
                        <div class="form-section">
                            <h2 class="section-title">No Of Sections (Floors) <span style="color:red">*</span></h2>
                            <div>
                                <input type="text" name="NoOfSections"
                                    class="w-full p-2 border border-gray-300 rounded-md"
                                    placeholder="No Of Sections (Floors)">
                            </div>
                        </div>

                    @endif
                  <br>
                    <!-- Types of commercial-->
                    @if(request()->query('landuse') === 'Commercial')
                    <div class="form-section">
                        <h2 class="section-title">Types of Commercial <span style="color:red">*</span></h2>
                         
                        <div class="bg-gray-50 p-4 rounded-md  grid grid-cols-4 gap-4">
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="commercial_type" value="Shopping Mall" class="radio-custom commercial-type-radio" required>
                                <span class="text-sm">Shopping Mall</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="commercial_type" value="Plaza" class="radio-custom commercial-type-radio" required>
                                <span class="text-sm">Plaza</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="commercial_type" value="Block of Offices" class="radio-custom commercial-type-radio" required>
                                <span class="text-sm">Block of Offices</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="commercial_type" value="Offices" class="radio-custom commercial-type-radio" required>
                                <span class="text-sm">Offices</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="commercial_type" value="Shops" class="radio-custom commercial-type-radio" required>
                                <span class="text-sm">Shops</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="commercial_type" value="Others" class="radio-custom" id="commercialTypeOthers" required>
                                <span class="text-sm">Others</span>
                            </label>
                            <div class="col-span-2" id="commercialTypeOthersContainer" style="display: none;">
                                <input type="text" id="commercialTypeOthersInput" name="commercial_type_others" 
                                       class="w-full p-2 border border-gray-300 rounded-md" 
                                       placeholder="Specify other type">
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Get all commercial type radio buttons
                            const commercialRadios = document.querySelectorAll('input[name="commercial_type"]');
                            const othersInput = document.getElementById('commercialTypeOthersContainer');
                            
                            // Add change event listener to each radio button
                            commercialRadios.forEach(radio => {
                                radio.addEventListener('change', function() {
                                    // Check if the "Others" option is selected
                                    if (this.id === 'commercialTypeOthers' && this.checked) {
                                        // Show the others input field
                                        othersInput.style.display = 'block';
                                        document.getElementById('commercialTypeOthersInput').required = true;
                                    } else {
                                        // Hide the others input field and clear its value
                                        othersInput.style.display = 'none';
                                        document.getElementById('commercialTypeOthersInput').value = '';
                                        document.getElementById('commercialTypeOthersInput').required = false;
                                    }
                                });
                            });
                        });
                    </script>
                    @endif

                  
                    @if(request()->query('landuse') === 'Industrial')
                        <div class="form-section">
                            <h2 class="section-title">Type of Industrial</h2>
                            <div class="grid grid-cols-4 gap-4">
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="industrial_type" value="Industrial Layout" class="checkbox-custom">
                                    <span class="text-sm">Industrial Layout</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="industrial_type" value="Industrial Estate" class="checkbox-custom">
                                    <span class="text-sm">Industrial Estate</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="industrial_type" value="Section" class="checkbox-custom">
                                    <span class="text-sm">Section</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="industrial_type" value="Others" class="checkbox-custom" id="industrialTypeOthers" onchange="toggleOtherInput('industrialTypeOthers', 'industrialTypeOthersInput')">
                                    <span class="text-sm">Others</span>
                                </label>
                                <div class="col-span-2" id="industrialTypeOthersContainer" style="display: none;">
                                    <input type="text" id="industrialTypeOthersInput" name="industrial_type_others" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Specify other type">
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const industrialOthersCheckbox = document.getElementById('industrialTypeOthers');
                                const industrialOthersInput = document.getElementById('industrialTypeOthersInput');
                                const industrialOthersContainer = document.getElementById('industrialTypeOthersContainer');

                                industrialOthersCheckbox.addEventListener('change', function() {
                                    if (this.checked) {
                                        industrialOthersContainer.style.display = 'block';
                                        industrialOthersInput.required = true;
                                    } else {
                                        industrialOthersContainer.style.display = 'none';
                                        industrialOthersInput.value = '';
                                        industrialOthersInput.required = false;
                                    }
                                });
                            });
                        </script>
                    @endif

                        @if(request()->query('landuse') === 'Residential')
                            @include('sectionaltitling.partials.residential')
                        @endif
 <hr>
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
                                    <label class="w-32 text-sm font-medium text-gray-700">Application Fee: <span style="color:red">*</span></label>
                                    <input type="number" name="application_fee" 
                                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter amount">
                                </div>
    
                                <!-- Processing Fee -->
                                <div class="flex items-center">
                                    <label class="w-32 text-sm font-medium text-gray-700">Processing Fee: <span style="color:red">*</span></label>
                                    <input type="number" name="processing_fee" 
                                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter amount">
                                </div>
                             
                                <!-- Site Plan Fee -->
                                <div class="flex items-center">
                                    <label class="w-32 text-sm font-medium text-gray-700">Site Plan Fee: <span style="color:red">*</span></label>
                                    <input type="number" name="site_plan_fee" 
                                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter amount">
                                </div>
    
                                <!-- Payment Date -->
                                <div class="flex items-center">
                                    <label class="w-32 text-sm font-medium text-gray-700">Payment Date: <span style="color:red">*</span></label>
                                    <input type="date" name="payment_date" 
                                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                                </div> 
                                
                                <div class="flex items-center">
                                    <label class="w-32 text-sm font-medium text-gray-700">Receipt No: <span style="color:red">*</span></label>
                                    <input type="text" name="receipt_number" 
                                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter receipt number">
                                </div>
                            </div>
                            
                          
    
                            <!-- Optional: Totals Section -->
                            <div class="border-t pt-6 mt-6">
                                <div class="flex justify-end items-center space-x-4">
                                    <span class="text-sm font-medium text-green-700">Total Amount:</span>
                                    <span class="text-lg font-bold text-green-700" id="totalAmount">₦0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <script>
                    // Calculate total amount when any fee input changes
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

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4">
                        <button type="reset"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50"
                            onclick="resetForm()">
                            Reset
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <script>
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


    function handleMultiplePhotos(event) {
        const files = event.target.files;
        const container = document.getElementById('ownersPhotoContainer');

        for (let file of files) {
            const reader = new FileReader();
            const photoDiv = document.createElement('div');
            photoDiv.className = 'relative border rounded-lg p-3 bg-white';

            photoDiv.innerHTML = `
                                        <div class="relative w-full aspect-square">
                                            <img src="#" class="w-full h-full object-cover rounded-lg" alt="Owner photo">
                                            <button type="button" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600" onclick="this.parentElement.parentElement.remove()">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    `;

            reader.onload = function(e) {
                photoDiv.querySelector('img').src = e.target.result;
            };

            reader.readAsDataURL(file);
            container.appendChild(photoDiv);
        }
    }


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

    function updateFullFileNumber() {
        const prefix = document.getElementById('fileNoPrefix').value;
        let number = document.getElementById('fileNumber').value.trim();
        let fullFileNumber = "N/A";
        
        if (prefix && number) {
            // Format number with leading zeros if needed
            if (!isNaN(number)) {
                // Convert to numeric to remove any leading zeros first
                number = parseInt(number, 10).toString();
                
                // Add leading zeros based on prefix
                if (prefix === "KN") {
                    // KNnumber format - no space, leading zeros
                    number = number.padStart(4, '0');
                    fullFileNumber = prefix + number;
                } else if (prefix === "CON-COM" || prefix === "CON-AG" || prefix === "CON-IND") {
                    // CON-COM-number, CON-AG-number, CON-IND-number format
                    number = number.padStart(5, '0');
                    fullFileNumber = prefix + "-" + number;
                } else if (prefix === "CON-RES" || prefix === "RES") {
                    // RES-number format
                    number = number.padStart(5, '0');
                    fullFileNumber = "RES-" + number;
                } else {
                    // KNML number, MNKL number, MLKN number, KNGP number format - space, 5 digits
                    number = number.padStart(5, '0');
                    fullFileNumber = prefix + " " + number;
                }
            } else {
                // If not a number, just concatenate according to format
                if (prefix === "KN") {
                    fullFileNumber = prefix + number;
                } else if (prefix === "CON-COM" || prefix === "CON-AG" || prefix === "CON-IND") {
                    fullFileNumber = prefix + "-" + number;
                } else if (prefix === "CON-RES" || prefix === "RES") {
                    fullFileNumber = "RES-" + number;
                } else {
                    fullFileNumber = prefix + " " + number;
                }
            }
        } else if (prefix) {
            fullFileNumber = prefix;
        } else if (number) {
            fullFileNumber = number;
        }
        
        document.getElementById('Previewflenumber').value = fullFileNumber;
        document.getElementById('fileno').value = fullFileNumber;
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', updateFullFileNumber);
</script>

    
 
@endsection
