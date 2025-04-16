<script>
    // Initialize Lucide icons
    lucide.createIcons();

    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded - initializing form handling');

        // Step navigation
        const nextStep1 = document.getElementById('nextStep1');
        const nextStep2 = document.getElementById('nextStep2');
        const backStep2 = document.getElementById('backStep2');
        const backStep3 = document.getElementById('backStep3');

        // Form sections
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const step3 = document.getElementById('step3');

        if (nextStep1) {
            nextStep1.addEventListener('click', function(e) {
                e.preventDefault();
                step1.classList.remove('active');
                step2.classList.add('active');
            });
        }

        if (nextStep2) {
            nextStep2.addEventListener('click', function(e) {
                e.preventDefault();
                step2.classList.remove('active');
                step3.classList.add('active');
            });
        }

        if (backStep2) {
            backStep2.addEventListener('click', function(e) {
                e.preventDefault();
                step2.classList.remove('active');
                step1.classList.add('active');
            });
        }

        if (backStep3) {
            backStep3.addEventListener('click', function(e) {
                e.preventDefault();
                step3.classList.remove('active');
                step2.classList.add('active');
            });
        }

        // Close modal buttons
        document.getElementById('closeModal').addEventListener('click', function() {
            // In a real application, this would close the modal
            alert('Application process canceled');
        });

        document.getElementById('closeModal2').addEventListener('click', function() {
            // In a real application, this would close the modal
            alert('Application process canceled');
        });

        document.getElementById('closeModal3').addEventListener('click', function() {
            // In a real application, this would close the modal
            alert('Application process canceled');
        });

        // Update the contact address display when address fields change
        const addressFields = ['ownerHouseNo', 'ownerStreetName', 'ownerDistrict', 'ownerLga', 'ownerState'];
        
        addressFields.forEach(field => {
            const element = document.getElementById(field);
            if (element) {
                element.addEventListener('input', updateContactAddress);
            }
        });

        function updateContactAddress() {
            const houseNo = document.getElementById('ownerHouseNo')?.value || '';
            const streetName = document.getElementById('ownerStreetName')?.value || '';
            const district = document.getElementById('ownerDistrict')?.value || '';
            const lga = document.getElementById('ownerLga')?.value || '';
            const state = document.getElementById('ownerState')?.value || '';
            
            const fullAddress = [houseNo, streetName, district, lga, state].filter(Boolean).join(', ');
            
            // Update the display and hidden field
            const addressDisplay = document.getElementById('fullContactAddress');
            const hiddenAddressField = document.getElementById('contactAddressDisplay');
            
            if (addressDisplay) addressDisplay.textContent = fullAddress;
            if (hiddenAddressField) hiddenAddressField.value = fullAddress;
        }
        
        // Initialize address display
        updateContactAddress();

        // Form submission handling
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Log the form data before submission for debugging
                console.log('Form submission - preparing to submit form');
                
                // Check for file inputs and log them
                const fileInputs = form.querySelectorAll('input[type="file"]');
                fileInputs.forEach(input => {
                    if (input.files && input.files.length > 0) {
                        console.log(`File input ${input.name} has ${input.files.length} file(s)`, {
                            name: input.files[0].name,
                            type: input.files[0].type,
                            size: input.files[0].size
                        });
                    }
                });
            });
        }

        // Enhance document file upload handling
        function enhanceFileUploads() {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.files && this.files.length > 0) {
                        const fileInfo = {
                            name: this.files[0].name,
                            type: this.files[0].type,
                            size: this.files[0].size
                        };
                        console.log(`File selected for ${this.name}:`, fileInfo);
                        
                        // Also update any related UI elements
                        const nameElement = document.getElementById(`${this.id}_name`);
                        if (nameElement) {
                            nameElement.textContent = this.files[0].name;
                        }
                    }
                });
            });
        }
        
        // Initialize enhanced file uploads
        enhanceFileUploads();
    });

    // Function to update file name display
    function updateFileName(input, labelId) {
        const fileName = input.files[0]?.name;
        if (fileName) {
            document.getElementById(input.id + '_name').textContent = fileName;
            document.getElementById(labelId).innerHTML = '<span>Change Document</span>';
            
            // Log for debugging
            console.log(`File selected for ${input.name}:`, {
                name: fileName,
                type: input.files[0].type,
                size: input.files[0].size
            });
        }
    }
</script>
