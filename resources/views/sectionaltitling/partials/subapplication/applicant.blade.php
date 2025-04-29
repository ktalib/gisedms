<div  class="mb-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <!-- Applicant Type Section -->
              
                <input type="hidden" id="applicantType">

                <!-- Personal Information Section -->
                <div class="mb-10" id="individualFields" style="display: none;">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Personal Information</h2>
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <!-- Left side - Personal Details -->
                            <div class="md:col-span-3">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <!-- Title -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Title <span class="text-red-500">*</span>
                                        </label>
                                        <select id="applicantTitle" name="applicant_title"
                                            class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm"
                                            onchange="updateApplicantNamePreview()">
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
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            First Name <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="applicantName" name="first_name"
                                            class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm"
                                            placeholder="Enter first name" oninput="updateApplicantNamePreview()">
                                    </div>

                                    <!-- Middle Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Middle Name (Optional)
                                        </label>
                                        <input type="text" id="applicantMiddleName" name="middle_name"
                                            class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm"
                                            placeholder="Enter middle name" oninput="updateApplicantNamePreview()">
                                    </div>

                                    <!-- Surname -->
                                    <div class="md:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Surname <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="applicantSurname" name="surname"
                                            class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm"
                                            placeholder="Enter surname" oninput="updateApplicantNamePreview()">
                                    </div>
                               
                                    <!-- Name of Applicant -->
                                    <div class="md:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Name of Applicant
                                        </label>
                                        <input type="text" id="applicantNamePreview" name="applicant_name_preview"
                                            class="w-full py-3 px-4 bg-gray-100 border border-gray-300 rounded-lg shadow-sm font-medium text-gray-800"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Right side - Photo Upload -->
                            <div>
                                <div id="photoUploadContainer"
                                    class="relative w-full h-[215px] border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 hover:bg-gray-100 transition-colors">
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
                                    <img id="photoPreview" class="w-full h-full object-cover rounded-lg hidden" src="#"
                                        alt="">
                                    <button type="button" id="removePhotoBtn"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hidden hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400"
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
                                <p class="text-xs text-gray-500 mt-2 text-center">Passport size photo (3.5 x 4.5 cm)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Corporate Body Information -->
                <div class="mb-10" id="corporateFields" style="display: none;">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Corporate Body Information</h2>
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Name of Corporate Body <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="corporateName" name="corporate_name"
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm"
                                    placeholder="Enter corporate body name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    RC Number <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="rcNumber" name="rc_number"
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm"
                                    placeholder="Enter RC number">
                            </div>
                        </div>
                    </div>
                </div>      
                
                <!-- Multiple Owners Information -->
                <div class="mb-10" id="multipleOwnersFields" style="display: none;">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Multiple Owners Information</h2>
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <div id="ownersContainer" class="space-y-4">
                            <!-- Dynamic rows will be inserted here -->
                        </div>
                        <div class="mt-6">
                            <button type="button" onclick="addOwnerRow()" 
                                class="flex items-center px-4 py-2 bg-green-600 text-white rounded-md text-sm font-medium transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Owner
                            </button>
                        </div>
                    </div>
                </div>
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
            row.className = 'grid grid-cols-12 gap-4 p-4';
            
            row.innerHTML = `  
                <div class="col-span-7">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="multiple_owners_names[]" 
                           class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm" 
                           placeholder="Enter full name">
                </div>
                <div class="col-span-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Passport Photo</label>
                    <div class="relative">
                        <input type="file" name="multiple_owners_passport[]" 
                               class="w-full py-2.5 px-4 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:outline-none" 
                               accept="image/*" 
                               onchange="previewOwnerPhoto(event, '${rowId}')">
                        <img class="owner-preview hidden w-16 h-16 object-cover mt-2 rounded-md shadow-sm" src="#" alt="Preview">
                    </div>
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    <button type="button" onclick="removeOwnerRow('${rowId}')" 
                            class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            `;
            
            container.appendChild(row);
            ownerRowCount++;
        }

        function removeOwnerRow(rowId) {
            const row = document.getElementById(rowId);
            if (row) {
                row.classList.add('opacity-0', 'scale-95');
                row.style.transition = 'all 200ms ease-in-out';
                
                setTimeout(() => {
                    row.remove();
                }, 200);
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

        function showMultipleOwnersFields() {
            document.getElementById('individualFields').style.display = 'none';
            document.getElementById('corporateFields').style.display = 'none';
            document.getElementById('multipleOwnersFields').style.display = 'block';
            
            // Clear existing rows
            document.getElementById('ownersContainer').innerHTML = '';
            // Add first row
            addOwnerRow();
        }

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

        // Initialize the handlers when the document loads
        document.addEventListener('DOMContentLoaded', function() {
            // Any initialization code can go here
        });

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

        function setApplicantType(type) {
            document.getElementById('applicantType').value = type;
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
            
            // Add hidden input for the full name to be used in form submission and summary
            let fullnameInput = document.getElementById('fullname');
            if (!fullnameInput) {
                fullnameInput = document.createElement('input');
                fullnameInput.type = 'hidden';
                fullnameInput.id = 'fullname';
                fullnameInput.name = 'fullname';
                document.querySelector('form').appendChild(fullnameInput);
            }
            fullnameInput.value = applicantName.trim();
        }
    </script>

