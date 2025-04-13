<script>
    // File number preview update functionality
    function updateFileNumberPreview() {
        const prefixEl = document.getElementById('fileNoPrefix');
        const numberEl = document.getElementById('fileNumber');
        const previewEl = document.getElementById('Previewflenumber');

        const prefix = prefixEl.value;
        let number = numberEl.value.trim();

        // Set placeholder based on selected prefix
        if (prefix) {
            if (['KNML', 'MNKL', 'MLKN', 'KNGP'].includes(prefix)) {
                numberEl.placeholder = "e.g. 00001";
            } else if (prefix === "KN") {
                numberEl.placeholder = "e.g. 0001";
            } else if (['CON-COM', 'CON-RES', 'CON-AG', 'CON-IND', 'RES'].includes(prefix)) {
                numberEl.placeholder = "e.g. 01";
            } else {
                numberEl.placeholder = "Format example";
            }
        }

        // Format the number based on the prefix
        if (prefix && number) {
            if (['KNML', 'MNKL', 'MLKN', 'KNGP'].includes(prefix)) {
                // Ensure 5-digit format with leading zeros
                number = number.padStart(5, '0');
                numberEl.value = number;
                previewEl.value = prefix + ' ' + number;
            } else if (prefix === "KN") {
                previewEl.value = prefix + number;
            } else if (['CON-COM', 'CON-RES', 'CON-AG', 'CON-IND', 'RES'].includes(prefix)) {
                previewEl.value = prefix + '-' + number;
            } else {
                previewEl.value = prefix + '/' + number;
            }
        } else if (prefix) {
            previewEl.value = prefix;
        } else if (number) {
            previewEl.value = number;
        } else {
            previewEl.value = '';
        }

        // Validation based on prefix
        let isValid = true;
        if (prefix === "KN") {
            isValid = /^\d+$/.test(number);
        } else if (["KNML", "MNKL", "MLKN", "KNGP"].includes(prefix)) {
            isValid = /^\d{5}$/.test(number);
        } else if (['CON-COM', 'CON-RES', 'CON-AG', 'CON-IND', 'RES'].includes(prefix)) {
            isValid = /^\d+$/.test(number);
        }

        if (prefix && number && isValid) {
            prefixEl.style.color = 'red';
            numberEl.style.color = 'red';
            previewEl.style.color = 'red';
        } else {
            prefixEl.style.color = '';
            numberEl.style.color = '';
            previewEl.style.color = '';
        }
    }

    // AJAX form submissions
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize file number preview
        updateFileNumberPreview();

        // Add event listeners for file number preview updates
        document.getElementById('fileNoPrefix').addEventListener('change', updateFileNumberPreview);
        document.getElementById('fileNumber').addEventListener('input', updateFileNumberPreview);

        // Save CofO button click handler
        document.getElementById('saveCofOBtn').addEventListener('click', function(e) {
            e.preventDefault();

            const formData = new FormData(document.getElementById('fileIndexForm'));

            // Display loading indicator
            Swal.fire({
                title: 'Saving...',
                text: 'Please wait while we save the Certificate of Occupancy data',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send AJAX request
            fetch('{{ route('fileindex.save-cofo') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            confirmButtonColor: '#3b82f6'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message,
                            confirmButtonColor: '#3b82f6'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An unexpected error occurred. Please try again.',
                        confirmButtonColor: '#3b82f6'
                    });
                });
        });

        // Main Save button click handle
     
    });
// Save Property Transaction button click handler - fixed version
const saveTransactionBtn = document.getElementById('savePropertyTransactionBtn');
        console.log('Transaction button found:', saveTransactionBtn);
        
        if (saveTransactionBtn) {
            saveTransactionBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Save Transaction button clicked'); // Debug log
                
                const formData = new FormData(document.getElementById('fileIndexForm'));

                // Display loading indicator
                Swal.fire({
                    title: 'Saving...',
                    text: 'Please wait while we save the Property Transaction data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Send AJAX request with improved error handling
                fetch('{{ route('fileindex.save-transaction') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            return response.text().then(text => {
                                throw new Error('Server error: ' + response.status + ' - ' + text);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                confirmButtonColor: '#3b82f6'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.message || 'Unknown error occurred',
                                confirmButtonColor: '#3b82f6'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An unexpected error occurred: ' + error.message,
                            confirmButtonColor: '#3b82f6'
                        });
                    });
            });
        } else {
            console.error('Save Transaction button not found in the DOM');
        }
    // Function to toggle input fields based on checkbox state
    function toggleInput(checkbox, inputId) {
        const input = document.querySelector(`[name="${inputId}"]`);
        if (checkbox.checked) {
            input.removeAttribute('disabled');
        } else {
            input.setAttribute('disabled', 'disabled');
        }
    }


//form


    document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 4;
    
    const form = document.getElementById('wizard-form');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    // Initialize
    updateProgressBar();
    
    // Next button click
    nextBtn.addEventListener('click', function() {
        if (currentStep < totalSteps) {
            currentStep++;
            updateUI();
            
            if (currentStep === totalSteps) {
                // Update summary on the confirmation step
                updateSummary();
            }
        }
    });
    
    // Previous button click
    prevBtn.addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            updateUI();
        }
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Form submitted successfully!');
        // Here you would typically send the data to your server
    });
    
    // Update UI based on current step
    function updateUI() {
        // Hide all steps
        document.querySelectorAll('.step-content').forEach(step => {
            step.classList.add('hidden');
        });
        
        // Show current step
        document.querySelector(`.step-content[data-step="${currentStep}"]`).classList.remove('hidden');
        
        // Update buttons
        if (currentStep === 1) {
            prevBtn.classList.add('hidden');
        } else {
            prevBtn.classList.remove('hidden');
        }
        
        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }
        
        // Update progress indicators
        updateProgressBar();
    }
    
    // Update progress bar and step indicators
    function updateProgressBar() {
        // Update step indicators
        document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
            const step = index + 1;
            if (step < currentStep) {
                // Completed steps
                indicator.classList.remove('bg-gray-300');
                indicator.classList.add('bg-emerald-500');
                indicator.innerHTML = '✓';
            } else if (step === currentStep) {
                // Current step
                indicator.classList.remove('bg-gray-300');
                indicator.classList.add('bg-emerald-500');
                indicator.innerHTML = step;
            } else {
                // Future steps
                indicator.classList.remove('bg-emerald-500');
                indicator.classList.add('bg-gray-300');
                indicator.innerHTML = step;
            }
        });
        
        // Update progress lines
        document.querySelectorAll('.step-line-progress').forEach((line, index) => {
            if (index < currentStep - 1) {
                line.style.width = '100%';
            } else {
                line.style.width = '0%';
            }
        });
    }
    
    // Update summary on confirmation step
    function updateSummary() {
        document.getElementById('summary-name').textContent = `${document.getElementById('firstName').value} ${document.getElementById('lastName').value}`;
        document.getElementById('summary-dob').textContent = document.getElementById('dob').value;
        document.getElementById('summary-email').textContent = document.getElementById('email').value;
        document.getElementById('summary-phone').textContent = document.getElementById('phone').value;
        document.getElementById('summary-address').textContent = document.getElementById('address').value;
        document.getElementById('summary-username').textContent = document.getElementById('username').value;
    }
});
</script>