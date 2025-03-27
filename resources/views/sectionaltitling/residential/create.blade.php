{{-- filepath: c:\wamp64\www\gisedms\resources\views\instruments\index.blade.php --}}
 
@extends('layouts.app')
@section('page-title')
    {{ __('Residential Main Application Form (Mother)') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Residential Main Application Form') }}</li>
@endsection
@push('script-page')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt307zl7Vea/aEykoRJI5jhqeGGWj0Cz6HSuK5ts8vrcP9gaQepgs7axKkgU0vWjxnzCt8mrQvK81dnGuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZub0OHUIWJvpaXJIRY6Kc6UPQwqEgu8IQD+aKHccWlbAZln+M/rejmUdjoLv2CmEepk8xeaLVgilg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
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
        background-color: #bbbbbb; /* Light gray background color */   
        }

        select:disabled {
        background-color: #bbbbbb; /* Light gray background color */   
        }

        #myDiv {
    display: none; /* Initially hidden */
    }
   /* Custom styles for file information form */
 #myDiv {
transition: all 0.3s ease-in-out;

      }  
     h2 {
        font-weight: bold;
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
            <form method="POST" class="space-y-6" action="{{ route('sectionaltitling.residential.store') }}" enctype="multipart/form-data">
                @csrf
           
                <div class="form-section">
                    <h2 class="section-title">Applicant Type</h2>
                    <div class="flex gap-4">
                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700" onclick="setApplicantType('individual'); showIndividualFields()">Individual</button>
                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700" onclick="setApplicantType('corporate'); showCorporateFields()">Corporate Body</button>
                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700" onclick="setApplicantType('multiple'); showMultipleOwnersFields()">Multiple Owners</button>
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
                                        <select id="applicantTitle" name="applicant_title" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"  onchange="updateApplicantNamePreview()" >
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
                                        <input type="text" id="applicantName" name="first_name" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"  placeholder="Enter first name" oninput="updateApplicantNamePreview()" >
                                    </div>

                                    <!-- Middle Name -->
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-gray-700">Middle Name (Optional)</label>
                                        <input type="text" id="applicantMiddleName" name="middle_name" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter middle name" oninput="updateApplicantNamePreview()">
                                    </div>

                                    <!-- Surname -->
                                    <div class="w-full col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Surname <span style="color:red">*</span>
                                        </label>
                                        <input type="text" id="applicantSurname" name="surname" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"  placeholder="Enter surname" oninput="updateApplicantNamePreview()" >
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
                                        <label class="block text-sm font-medium text-gray-700">
                                            Name of Corporate Body <span style="color:red">*</span>
                                        </label>
                                        <input type="text" id="corporateName" name="corporate_name" class="w-full p-2 border border-gray-300 rounded-md"  placeholder="Enter corporate body name" >
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">
                                            RC Number <span style="color:red">*</span>
                                        </label>
                                        <input type="text" id="rcNumber" name="rc_number" class="w-full p-2 border border-gray-300 rounded-md"  placeholder="Enter RC number" >
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
                        <div class="space-y-4">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Names of Owners</label>
                                <input type="text" id="multipleOwnersNames" name="multiple_owners_names" 
                                       class="tagsinput"
                                       value=""
                                       data-role="tagsinput"
                                       placeholder="Type name and press enter">
                                <small class="text-red-500">Type each name and press enter or comma to add multiple owners</small>
                            </div>
                            
                            <div class="mt-4">
                                <input type="file" id="multiplePhotosUpload" name="multiple_owners_passport[]" multiple accept="image/*" class="hidden" onchange="handleMultiplePhotos(event)">
                                <label for="multiplePhotosUpload" class="cursor-pointer inline-block px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                                    Upload Multiple Photos
                                </label>
                                <div id="ownersPhotoContainer" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                                </div>
                            </div>

                            <script>
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
                            </script>
                        </div>
                    </div>
                </div>
            

                

                <!-- Contact Information -->
                <div class="form-section flex-1 space-y-4">
                    <h3 class="section-title">Contact Information</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            2.Contact Address <span style="color:red">*</span>
                        </label>
                        <input type="text" name="address" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"  placeholder="Enter address" >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            3. Phone Number(s) <span style="color:red">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-4">
                            <input type="text" name="phone_number_1" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"  placeholder="Enter phone number 1 " >
                            <input type="text" name="phone_number_1" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter phone number 2  (Optional)">
                            <input type="text" name="phone_number_1" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter phone number 3  (Optional)">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            4. Email Address <span style="color:red">*</span>
                        </label>
                        <input type="text" name="email" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"  placeholder="Enter email address" >
                    </div>
                </div>

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

              <br>
                <!-- Type of Residential -->
                <div class="form-section">
                    <h2 class="section-title">Type of Residential</h2>
                    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-3 gap-4">
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="residential_type" value="block_of_flats" class="radio-custom">
                            <span class="text-sm">Block of Flats</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="residential_type" value="housing_estate" class="radio-custom">
                            <span class="text-sm">Housing Estate</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="residential_type" value="fragmented_layout" class="radio-custom">
                            <span class="text-sm">Fragmented Layout</span>
                        </label>
                        
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="residential_type" value="terrace" class="radio-custom">
                            <span class="text-sm">Terrace</span>
                        </label>
                    </div>
                </div>
 
                <div class="form-section">
                    <h2 class="section-title">House and Floor Number</h2>
                    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">House Number</label>
                            <input type="text" name="house_number" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter house number">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Floor Number</label>
                            <input type="text" name="floor_number" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter floor number">
                        </div>
                    </div>
                </div>
                <br>
           

                <!-- Type of Ownership -->
                <div class="form-section">
                    <h2 class="section-title">Type of Ownership</h2>
                    <div class="bg-gray-50 p-4 rounded-md grid grid-cols-2 md:grid-cols-4 gap-4">
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="ownership_type" value="gift" class="radio-custom">
                            <span class="text-sm">Gift</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="ownership_type" value="inheritance" class="radio-custom">
                            <span class="text-sm">Inheritance</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="ownership_type" value="purchase" class="radio-custom">
                            <span class="text-sm">Purchase</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="ownership_type" value="government" class="radio-custom">
                            <span class="text-sm">Government</span>
                        </label>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="section-title">No Of Units</h2>
                    <div class="bg-gray-50 p-4 rounded-md">
                        <input type="text" id="noOfUnits" name="no_of_units" class="w-full p-2 border border-gray-300 rounded-md" placeholder="No Of Units">
                    </div>
                </div>
                <!-- Plot Address -->
                <div class="form-section">
                    <h2 class="section-title">Plot Address</h2>
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">House No</label>
                                <input type="text" id="plotHouseNo" name="plot_house_no" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter house number" oninput="updatePlotFullAddress()">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Plot No</label>
                                <input type="text" id="plotPlotNo" name="plot_plot_no" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter plot number" oninput="updatePlotFullAddress()">
                            </div>

                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Street Name</label>
                                <input type="text" id="plotStreetName" name="plot_street_name" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter street name" oninput="updatePlotFullAddress()">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">District</label>
                                <input type="text" id="plotDistrict" name="plot_district" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter district" oninput="updatePlotFullAddress()">
                            </div>
                            <div class="md:col-span-4">
                                <label class="block text-sm font-medium text-gray-700">Full Address</label>
                                <input type="text" id="plotFullAddress" name="plot_full_address" class="w-full p-2 border border-gray-300 rounded-md" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Owner Address -->
                <div class="form-section">
                    <h2 class="section-title">Owner Address</h2>
                    <div class="bg-gray-50 p-4 rounded-md">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">House No</label>
                                <input type="text" id="ownerHouseNo" name="owner_house_no" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter house number" oninput="updateOwnerFullAddress()">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Plot No</label>
                                <input type="text" id="ownerPlotNo" name="owner_plot_no" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter plot number" oninput="updateOwnerFullAddress()">
                            </div>
                           
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Street Name</label>
                                <input type="text" id="ownerStreetName" name="owner_street_name" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter street name" oninput="updateOwnerFullAddress()">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">District</label>
                                <input type="text" id="ownerDistrict" name="owner_district" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter district" oninput="updateOwnerFullAddress()">
                            </div>
                            <div class="md:col-span-4">
                                <label class="block text-sm font-medium text-gray-700">Full Address</label>
                                <input type="text" id="ownerFullAddress" name="owner_full_address" class="w-full p-2 border border-gray-300 rounded-md" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="form-section">
                    <h2 class="section-title">Additional Information</h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">11. Write any Comment that will assist in Processing the Application:</label>
                        <textarea name="additional_comments" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 min-h-[100px]" placeholder="Enter comment"></textarea>
                    </div>
                </div>
 
                <!-- Form Actions -->
                <div class="flex justify-end space-x-4">
                    <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50" onclick="resetForm()">
                        Reset
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

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
</script>
 