@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING  MODULE') }}
@endsection

<style>
    .tab-content {
      display: none;
    }
    .tab-content.active {
      display: block;
    }
    .tab-button {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    .tab-button.active {
      background-color: #f3f4f6;
      font-weight: 500;
    }
    .tab-button:hover:not(.active) {
      background-color: #f9fafb;
    }
</style>
@include('sectionaltitling.partials.assets.css')
@section('content')
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        @include('admin.header')
        <!-- Dashboard Content -->
        <div class="p-6">
            <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                <div class="modal-content p-6">
                    <div class="flex justify-between items-center mb-4">
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>
                    
                    <div class="py-2">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-sm font-medium">{{$application->land_use }} Property</h3>
                                <p class="text-xs text-gray-500">
                                    Application ID: {{$application->applicationID}} | File No: {{$application->fileno }}  
                                </p>
                            </div>
                            <div class="text-right">
                                <h3 class="text-sm font-medium">{{$application->applicant_title }} {{$application->first_name }} {{$application->surname }}</h3>
                                <p class="text-xs text-gray-500">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        {{$application->land_use }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    
                        <!-- Tabs Navigation -->
                        <div class="grid grid-cols-3 gap-2 mb-4">
                            <button class="tab-button active" data-tab="initial">
                                <i data-lucide="banknote" class="w-3.5 h-3.5 mr-1.5"></i>
                                Add Buyers
                            </button>
                            <button class="tab-button" data-tab="detterment">
                                <i data-lucide="calculator" class="w-3.5 h-3.5 mr-1.5"></i>
                                Buyers List
                            </button>
                            <button class="tab-button" data-tab="final">
                                <i data-lucide="file-check" class="w-3.5 h-3.5 mr-1.5"></i>
                                Final Conveyance Agreement
                            </button>
                        </div>
                    
                        <!-- Add Buyers Tab -->
                        <div id="initial-tab" class="tab-content active">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                <div class="p-4 border-b">
                                    <h3 class="text-sm font-medium">Add Buyers</h3>
                                </div>
                                <form id="add-buyers-form">
                                    <div class="p-4 space-y-4">
                                        <input type="hidden" id="application_id" value="{{$application->id}}">
                                        <input type="hidden" name="fileno" value="{{$application->fileno}}">
                                        
                                        <div id="buyers-container">
                                            <div class="flex items-start space-x-2 mb-4 buyer-entry">
                                                <div class="grid grid-cols-3 gap-4 flex-grow">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Title <span class="text-red-500">*</span>
                                                        </label>
                                                        <select name="applicant_title[]"
                                                            class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm">
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
                                                    <div>
                                                        <label for="buyer-name" class="block text-sm font-medium text-gray-700 mb-2">Buyer Name</label>
                                                        <input type="text" name="buyer_name[]" placeholder="Enter Buyer Name" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm">
                                                    </div>
                                                    <div>
                                                        <label for="unit-no" class="block text-sm font-medium text-gray-700 mb-2">Unit No</label>
                                                        <input type="text" name="unit_no[]" placeholder="Enter Unit No" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm">
                                                    </div>
                                                </div>
                                                <button type="button" class="remove-buyer bg-red-500 text-white p-1.5 rounded-md hover:bg-red-600 flex items-center justify-center mt-8">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <button type="button" id="add-more-buyers" class="flex items-center px-3 py-1.5 text-xs bg-blue-500 text-white rounded-md hover:bg-blue-600 mt-2">
                                            <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add Buyer
                                        </button>
                                        
                                        <hr class="my-4">

                                        <div class="flex justify-between items-center">
                                            <div class="flex gap-2">
                                                <a href="{{route('sectionaltitling.primary')}}" class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                                                    <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                                    Back
                                                 </a>
                                                <button type="reset" id="reset" class="flex items-center px-3 py-1.5 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                                                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5 mr-1.5"></i>
                                                    Reset
                                                </button>
                                                
                                                <button type="submit" class="flex items-center px-3 py-1.5 text-xs bg-green-700 text-white rounded-md hover:bg-green-800">
                                                    <i data-lucide="save" class="w-3.5 h-3.5 mr-1.5"></i>
                                                    Save Buyers
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    
                        <!-- Buyers List Tab -->
                        <div id="detterment-tab" class="tab-content">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                <div class="p-4 border-b">
                                    <h3 class="text-sm font-medium">Buyers List</h3>
                                    <p class="text-xs text-gray-500"></p>
                                </div>
                                <input type="hidden" id="application_id" value="{{$application->id}}">
                                <input type="hidden" name="fileno" value="{{$application->fileno}}">
                                <div class="p-4 space-y-4">
                                    <div class="overflow-x-auto" id="buyers-list-container">
                                        <!-- Dynamic content will be loaded here -->
                                        <div class="text-center text-gray-500 py-4">Loading buyers list...</div>
                                    </div>
                                
                                    <hr class="my-4">
                            
                                    <div class="flex justify-between items-center">
                                        <div class="flex gap-2">
                                            <a href="{{route('sectionaltitling.primary')}}" class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                                                <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                                Back
                                             </a>   
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Final Conveyance Agreement Tab -->
                         @include('actions.FinalConveyanceAgreement')
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('admin.footer')
    </div>
            
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-tab');
                    
                    // Deactivate all tabs
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    
                    // Activate selected tab
                    this.classList.add('active');
                    document.getElementById(`${tabId}-tab`).classList.add('active');
                });
            });
            
            // Close modal button
            document.getElementById('closeModal').addEventListener('click', function() {
                window.location.href = "{{ route('sectionaltitling.primary') }}";
            });
            
            // Add AJAX form submission for buyers
            const addBuyersForm = document.getElementById('add-buyers-form');
            
            if (addBuyersForm) {
                addBuyersForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const applicationId = document.getElementById('application_id').value;
                    const records = [];
                    
                    // Collect all buyer entries
                    const buyerEntries = document.querySelectorAll('.buyer-entry');
                    
                    buyerEntries.forEach(entry => {
                        const title = entry.querySelector('select[name="applicant_title[]"]').value;
                        const name = entry.querySelector('input[name="buyer_name[]"]').value;
                        const unitNo = entry.querySelector('input[name="unit_no[]"]').value;
                        
                        if (name && unitNo) {
                            records.push({
                                buyerTitle: title,
                                buyerName: name,
                                sectionNo: unitNo
                            });
                        }
                    });
                    
                    if (records.length === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: 'Please add at least one buyer with name and unit number'
                        });
                        return;
                    }
                    
                    // Show loading state
                    Swal.fire({
                        title: 'Saving buyers...',
                        html: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Send AJAX request
                    fetch('{{ route("conveyance.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            application_id: applicationId,
                            records: records
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Buyers information saved successfully',
                                confirmButtonText: 'View Buyers List'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Switch to the buyers list tab
                                    document.querySelector('[data-tab="detterment"]').click();
                                    // Refresh the buyers list
                                    loadBuyersList();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Failed to save buyers information'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred'
                        });
                    });
                });
            }
            
            // Function to load buyers list
            function loadBuyersList() {
                const applicationId = document.getElementById('application_id').value;
                
                fetch(`{{ url('conveyance') }}/${applicationId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            renderBuyersList(data.records);
                        } else {
                            console.error('Error:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
            
            // Function to render buyers list
            function renderBuyersList(records) {
                const buyersListContainer = document.getElementById('buyers-list-container');
                if (!buyersListContainer) return;
                
                if (records.length === 0) {
                    buyersListContainer.innerHTML = '<div class="p-4 text-center text-gray-500">No buyers added yet.</div>';
                    return;
                }
                
                let html = `
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SN</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buyer Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit No.</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                `;
                
                records.forEach((record, index) => {
                    html += `
                    <tr class="hover:bg-gray-50" data-index="${index}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${record.buyerTitle || ''} ${record.buyerName || ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${record.sectionNo || ''}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button class="edit-buyer text-blue-600 hover:text-blue-900 mr-2" data-index="${index}">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                        <button class="delete-buyer text-red-600 hover:text-red-900" data-index="${index}">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                        </td>
                    </tr>
                    `;
                });
                
                html += `
                    </tbody>
                    </table>
                `;
                
                buyersListContainer.innerHTML = html;
                lucide.createIcons(); // Reinitialize icons
                
                // Add event listeners for edit and delete buttons
                attachBuyerActionsListeners(records);
            }
            
            // Function to attach event listeners to edit and delete buttons
            function attachBuyerActionsListeners(records) {
                // Edit buyer
                document.querySelectorAll('.edit-buyer').forEach(button => {
                    button.addEventListener('click', function() {
                    const index = this.getAttribute('data-index');
                    const record = records[index];
                    
                    Swal.fire({
                        title: 'Edit Buyer',
                        html: `
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <select id="buyer-title" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm">
                            <option value="Mr." ${record.buyerTitle === 'Mr.' ? 'selected' : ''}>Mr.</option>
                            <option value="Mrs." ${record.buyerTitle === 'Mrs.' ? 'selected' : ''}>Mrs.</option>
                            <option value="Chief" ${record.buyerTitle === 'Chief' ? 'selected' : ''}>Chief</option>
                            <option value="Miss" ${record.buyerTitle === 'Miss' ? 'selected' : ''}>Miss</option>
                            <option value="Dr." ${record.buyerTitle === 'Dr.' ? 'selected' : ''}>Dr.</option>
                            <option value="Prof" ${record.buyerTitle === 'Prof' ? 'selected' : ''}>Prof</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Buyer Name</label>
                            <input id="buyer-name"  name="buyer_name[]" type="text" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm" value="${record.buyerName || ''}">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unit No</label>
                            <input id="unit-no" name="unit_no[]" type="text" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm" value="${record.sectionNo || ''}">
                        </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Update',
                        confirmButtonColor: '#10B981',
                        preConfirm: () => {
                        const buyerTitle = document.getElementById('buyer-title').value;
                        const buyerName = document.getElementById('buyer-name').value;
                        const unitNo = document.getElementById('unit-no').value;
                        
                        if (!buyerName || !unitNo) {
                            Swal.showValidationMessage('Buyer name and unit number are required');
                            return false;
                        }
                        
                        return { buyerTitle, buyerName, unitNo };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                        // Update the record
                        records[index] = {
                            buyerTitle: result.value.buyerTitle,
                            buyerName: result.value.buyerName,
                            sectionNo: result.value.unitNo
                        };
                        
                        // Save the updated records
                        updateBuyersData(records);
                        }
                    });
                    });
                });
                
                // Delete buyer
                document.querySelectorAll('.delete-buyer').forEach(button => {
                    button.addEventListener('click', function() {
                    const index = this.getAttribute('data-index');
                    
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This buyer will be removed from the list.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#EF4444',
                        cancelButtonColor: '#6B7280',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                        // Remove the record
                        records.splice(index, 1);
                        
                        // Save the updated records
                        updateBuyersData(records);
                        }
                    });
                    });
                });
            }
            
            // Function to update buyers data
            function updateBuyersData(records) {
                const applicationId = document.getElementById('application_id').value;
                
                // Show loading state
                Swal.fire({
                    title: 'Updating...',
                    html: 'Please wait...',
                    allowOutsideClick: false,
                    didOpen: () => {
                    Swal.showLoading();
                    }
                });
                
                // Send AJAX request
                fetch('{{ route("conveyance.update") }}', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                    application_id: applicationId,
                    records: records
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Buyers information updated successfully'
                    });
                    // Refresh the buyers list
                    renderBuyersList(records);
                    } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Failed to update buyers information'
                    });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred'
                    });
                });
            }
            
            // Load buyers list when detterment tab is clicked
            document.querySelector('[data-tab="detterment"]').addEventListener('click', loadBuyersList);
            
            // Add functionality to refresh buyers list button
            const refreshButton = document.getElementById('refresh-buyers-list');
            if (refreshButton) {
                refreshButton.addEventListener('click', loadBuyersList);
            }
            
            // Initialize the remove buttons for buyers
            function initializeRemoveButtons() {
                const removeButtons = document.querySelectorAll('.remove-buyer');
                removeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        this.parentElement.remove();
                    });
                });
            }
            
            // Initialize the add more buyers button
            const addMoreButton = document.getElementById('add-more-buyers');
            if (addMoreButton) {
                addMoreButton.addEventListener('click', function() {
                    const newBuyerEntry = document.createElement('div');
                    newBuyerEntry.classList.add('flex', 'items-start', 'space-x-2', 'mb-4', 'buyer-entry');
                    newBuyerEntry.innerHTML = `
                        <div class="grid grid-cols-3 gap-4 flex-grow">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Title <span class="text-red-500">*</span>
                                </label>
                                <select name="applicant_title[]"
                                    class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm">
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
                            <div>
                                <label for="buyer-name" class="block text-sm font-medium text-gray-700 mb-2">Buyer Name</label>
                                <input type="text" name="buyer_name[]" placeholder="Enter Buyer Name" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm">
                            </div>
                            <div>
                                <label for="unit-no" class="block text-sm font-medium text-gray-700 mb-2">Unit No</label>
                                <input type="text" name="unit_no[]" placeholder="Enter Unit No" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm">
                            </div>
                        </div>
                        <button type="button" class="remove-buyer bg-red-500 text-white p-1.5 rounded-md hover:bg-red-600 flex items-center justify-center mt-8">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    `;
                    document.getElementById('buyers-container').appendChild(newBuyerEntry);
                    lucide.createIcons(); // Reinitialize icons
                    initializeRemoveButtons();
                });
            }
            
            // Initialize remove buttons
            initializeRemoveButtons();
        });
    </script>
@endsection


