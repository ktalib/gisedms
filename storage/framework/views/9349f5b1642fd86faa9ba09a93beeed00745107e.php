

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Application Form (Main)')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Application Form')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="<?php echo e(asset('assets/js/plugins/ckeditor/classic/ckeditor.js')); ?>"></script>

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
<?php $__env->stopPush(); ?>
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

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body" style="width:100%">
            <form id="applicationForm" class="space-y-6">
                <!-- Personal Information -->
                <div class="form-section">
                    <h2 class="section-title">Personal Information</h2>
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="text-sm font-medium mb-2">Photo Upload</h3>
                        <div class="flex flex-col md:flex-row gap-6">
                            <div>
                                <div class="flex gap-4 items-start">
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700">Title</label>
                                        <select id="applicantTitle" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required onchange="updateApplicantNamePreview()">
                                            <option value="" disabled selected>Select title</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Chief">Chief</option>
                                            <option value="Master">Master</Master</option>
                                            <option value="Capt">Capt</option>
                                            <option value="Coln">Coln</option>
                                            <option value="Pastor">Pastor</option>
                                            <option value="King">King</option>
                                            <option value="Prof">Prof</option>
                                            <option value="Dr.">Dr.</option>
                                            <option value="Alhaji">Alhaji</option>
                                            <option value="Alhaja">Alhaja</option>
                                            <option value="High Chief">High Chief</option>
                                            <option value="Lady">Lady</Lady</option>
                                            <option value="Bishop">Bishop</option>
                                            <option value="Senator">Senator</Senator</option>
                                            <option value="Messr">Messr</option>
                                            <option value="Honorable">Honorable</Honorable</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Rev.">Rev.</Rev.</option>
                                            <option value="Barr.">Barr.</Barr.</option>
                                            <option value="Arc.">Arc.</Arc.</option>
                                            <option value="Sister">Sister</Sister</option>
                                            <option value="Mazi">Mazi</Mazi</option>
                                            <option value="H.R.H Eze">H.R.H Eze</option>
                                            <option value="Arch. Bishop">Arch. Bishop</option>
                                            <option value="Elder">Elder</Elder</option>
                                            <option value="Ven.">Ven.</Ven.</option>
                                            <option value="Engr.">Engr.</Engr.</option>
                                            <option value="Deacon">Deacon</Deacon</option>
                                            <option value="Prophet">Prophet</Prophet</option>
                                            <option value="Sir">Sir</Sir</option>
                                            <option value="ASP">ASP</ASP</option>
                                            <option value="Ambassador">Ambassador</Ambassador</option>
                                            <option value="Inspector">Inspector</Inspector</option>
                                            <option value="Deaconess">Deaconess</Deaconess</option>
                                            <option value="Dame">Dame</Dame</option>
                                            <option value="Leutenant">Leutenant</Leutenant</option>
                                            <option value="Commander">Commander</Commander</option>
                                            <option value="Surveyor">Surveyor</Surveyor</option>
                                            <option value="Nze">Nze</Nze</option>
                                            <option value="Other">Other</Other>
                                        </select>
                                    </div>
<br>
     <br>
     <br>
                                    <div class="flex gap-6 items-start">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700">Surname</label>
                                            <input type="text" id="applicantSurname" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter applicant surname" oninput="updateApplicantNamePreview()">
                                        </div>


                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                                        <input type="text" id="applicantName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Enter applicant name" oninput="updateApplicantNamePreview()">
                                    </div>
                                    
                                </div>
                               
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700">Middle Name (Optional)</label>
                                        <input type="text" id="applicantMiddleName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter applicant middle name" oninput="updateApplicantNamePreview()">
                                    </div>
                                </div>
                                <div class="flex gap-4 items-start">
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700">1. Name of Applicant</label>
                                        <input type="text" id="applicantNamePreview" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="w-[180px]">
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
                                    <input type="file" id="photoUpload" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewPhoto(event)">
                                </div>
                                <p class="text-xs text-gray-500 mt-2 text-center">Passport size photo (3.5 x 4.5 cm)</p>
                            </div>

                            <script>
                                function updateApplicantNamePreview() {
                                    const title = document.getElementById('applicantTitle').value;
                                    const surname = document.getElementById('applicantSurname').value;
                                    const name = document.getElementById('applicantName').value;
                                    const middleName = document.getElementById('applicantMiddleName').value;
                                    let applicantName = '';

                                    if (title) {
                                        applicantName += title + ' ';
                                    }
                                    if (surname) {
                                        applicantName += surname + ' ';
                                    }
                                    if (name) {
                                        applicantName += name + ' ';
                                    }
                                    if (middleName) {
                                        applicantName += middleName;
                                    }

                                    document.getElementById('applicantNamePreview').value = applicantName.trim();
                                }
                            </script>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="form-section flex-1 space-y-4">
                    <h3 class="section-title">Contact Information</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">2. Address</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Enter address">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">3. Phone Number(s)</label>
                        <div class="grid grid-cols-3 gap-4">
                            <input type="text" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Enter phone number 1 ">
                            <input type="text" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter phone number 2  (Optional)">
                            <input type="text" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter phone number 3  (Optional)">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">4. Email Address</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Enter email address">
                    </div>
                </div>

                <!-- Identification -->
                <div class="form-section">
                    <h2 class="section-title">Identification</h2>
                    <div>
                        <h3 class="text-sm font-medium mb-4">5. Tick means of Identification (Attached)</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom">
                                <span class="text-sm">A. National ID</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom">
                                <span class="text-sm">B. Voters Card</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom">
                                <span class="text-sm">C. Driver's License</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom">
                                <span class="text-sm">D. International Passport</span>
                            </label>
                            <div class="col-span-2 flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom" id="identificationOthers" onchange="toggleOtherInput('identificationOthers', 'identificationOthersInput')">
                                <span class="text-sm">E. Others (Specify)</span>
                                <input type="text" id="identificationOthersInput" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex-1" disabled placeholder="Specify other identification">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="form-section">
                    <h2 class="section-title">Property Details</h2>
                    <!-- Type of Residential -->
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h3 class="text-sm font-medium mb-4">6. Type of Residential</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom">
                                <span class="text-sm">A. Block of Flats</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom">
                                <span class="text-sm">B. Housing Estate</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom">
                                <span class="text-sm">C. Fragmented GRA</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom">
                                <span class="text-sm">D. Apartment</span>
                            </label>
                            <div class="col-span-2 flex items-center space-x-3">
                                <input type="checkbox" class="checkbox-custom" id="residentialOthers" onchange="toggleOtherInput('residentialOthers', 'residentialOthersInput')">
                                <span class="text-sm">E. Others (Specify)</span>
                                <input type="text" id="residentialOthersInput" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex-1" disabled placeholder="Specify other residential type">
                            </div>
                        </div>
                    </div>

                    <!-- Property Location -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-medium">Property Location</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">7. House No</label>
                                <input type="text" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter house number">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Floor No</label>
                                <input type="text" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter floor number">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">9. Location of the Property:</label>
                            <input type="text" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="Enter property location">
                        </div>
                    </div>

                    <!-- Type of Ownership -->
                    <div class="mt-6">
                        <h3 class="text-sm font-medium mb-4">8. Type of Ownership:</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="ownership" value="gift" class="radio-custom" checked>
                                <span class="text-sm">A. Gift</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="ownership" value="inheritance" class="radio-custom">
                                <span class="text-sm">B. Inheritance</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="ownership" value="purchase" class="radio-custom">
                                <span class="text-sm">C. Purchase</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="ownership" value="government" class="radio-custom">
                                <span class="text-sm">D. Government</span>
                            </label>
                        </div>
                    </div>

                    <!-- Architectural Design -->
                    <div class="mt-6">
                        <h3 class="text-sm font-medium mb-4">10. Do you have Architectural Design?</h3>
                        <div class="flex space-x-6">
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="architectural" value="yes" class="radio-custom">
                                <span class="text-sm">YES</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="radio" name="architectural" value="no" class="radio-custom" checked>
                                <span class="text-sm">NO</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="form-section">
                    <h2 class="section-title">Additional Information</h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">11. Write any Comment that will assist in Processing the Application:</label>
                        <textarea class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 min-h-[100px]" placeholder="Enter comment"></textarea>
                    </div>
                </div>

                <!-- GROUP 5: OFFICIAL USE ONLY -->
                <div class="form-section bg-gray-200 shadow-md rounded-md">
                    <h3 class="section-title bg-gray-700 text-white px-6 py-3 rounded-t-md">FOR OFFICIAL USE ONLY</h3>
                    <div class="p-6 space-y-6">
                        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-2">
                            <span class="font-medium text-gray-700">Application fee:</span>
                            <div class="flex-1 border-b-2 border-gray-400 min-w-[100px]"></div>
                            <span class="font-medium text-gray-700">has been paid on</span>
                            <div class="flex-1 border-b-2 border-gray-400 min-w-[100px]"></div>
                        </div>
                        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-2">
                            <span class="font-medium text-gray-700">On Receipt No:</span>
                            <div class="flex-1 border-b-2 border-gray-400 min-w-[100px]"></div>
                            <span class="font-medium text-gray-700">of</span>
                            <div class="flex-1 border-b-2 border-gray-400 min-w-[100px]"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                            <div class="space-y-2">
                                <div class="h-20 border-b-2 border-gray-400"></div>
                                <p class="text-center font-medium text-gray-700">Revenue Accountant</p>
                            </div>
                            <div class="space-y-2">
                                <div class="h-20 border-b-2 border-gray-400"></div>
                                <p class="text-center font-medium text-gray-700">Date</p>
                            </div>
                        </div>
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
<?php $__env->stopSection(); ?>

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

    // Reset form
    function resetForm() {
        document.getElementById('applicationForm').reset();
        removePhoto();
        document.getElementById('identificationOthersInput').disabled = true;
        document.getElementById('residentialOthersInput').disabled = true;
    }

    // Form submission
    document.getElementById('applicationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const formDataObj = {};
        
        formData.forEach((value, key) => {
            formDataObj[key] = value;
        });
        
        const photoFile = document.getElementById('photoUpload').files[0];
        if (photoFile) {
            formDataObj.photoFileName = photoFile.name;
        }
        
        console.log('Form data:', formDataObj);
        alert('Form submitted successfully!');
        resetForm();
    });
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/application_mother/create.blade.php ENDPATH**/ ?>