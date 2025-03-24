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