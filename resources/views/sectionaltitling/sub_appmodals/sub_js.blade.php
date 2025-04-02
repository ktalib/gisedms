
<script>
    // Global variable to store the selected application ID
    var selectedApplicationId = null;

    // Function to set the selected application ID
    function setSelectedApplicationId(id) {
        console.log('Setting selected application ID to:', id);
        selectedApplicationId = id;

        // You can also update any other attributes that need the application ID
        const bettermentFeeButton = document.getElementById('bettermentFeeButton');
        if (bettermentFeeButton) {
            bettermentFeeButton.setAttribute('data-id', id);
        }
    }

    // Make sure the loadBillingData function uses the correct ID
    function loadBillingData(applicationId) {
        console.log('Loading billing data for application ID:', applicationId);
        if (!applicationId) {
            console.error('No application ID provided!');
      
            return;
        }

        document.getElementById('application_id').value = applicationId;

        // Show loading state
        const inputs = document.querySelectorAll('#financeForm input:not([type="hidden"]):not([name="_token"])');
        inputs.forEach(input => {
            input.value = 'Loading...';
            if (input.type === 'number') input.value = '';
        });

        // Use relative URL with the route name
        fetch(`{{ url('/') }}/sectionaltitling/get-billing-data2/${applicationId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Received billing data:', data);
                // Populate form fields with the retrieved data
                document.getElementById('receipt_number').value = data.receipt_number || '';
                document.getElementById('payment_date').value = data.payment_date ? new Date(data.payment_date)
                    .toISOString().split('T')[0] : '';
                document.getElementById('application_fee').value = data.application_fee || '';
                document.getElementById('processing_fee').value = data.processing_fee || '';
                document.getElementById('site_plan_fee').value = data.site_plan_fee || '';
                calculateTotal();
            })
            .catch(error => {
                console.error('Error fetching billing data:', error);
                // Clear loading state
                inputs.forEach(input => {
                    input.value = '';
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: `Failed to load billing data. Error: ${error.message}`
                });
            });
    }

    // Ensure the event is attached to the select element for decision changes.
    $('#decision').on('change', function() {
        if ($(this).val() === 'decline') {
            $('#declineReasonGroup').show();
        } else {
            $('#declineReasonGroup').hide();
        }
    });
 

    function printIframe(frameId) {
        const iframe = document.getElementById(frameId);
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    }




    @foreach ($subApplications as $subApplication)
        // Initialize PDFObject for each modal
        PDFObject.embed(
            "{{ asset('storage/uploads/Sectional Title TDP for Usamn Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf') }}",
            "#viewTDPContainer{{ $subApplication->id }}");
        PDFObject.embed(
            "{{ asset('storage/uploads/Sectional Title TDP for Usamn Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf') }}",
            "#printTDPContainer{{ $subApplication->id }}");
        PDFObject.embed(
            "{{ asset('storage/uploads/Sectional Title CofO for Usman Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf') }}",
            "#viewCofOContainer{{ $subApplication->id }}");
        PDFObject.embed(
            "{{ asset('storage/uploads/Sectional Title CofO for Usman Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf') }}",
            "#printCofOContainer{{ $subApplication->id }}");

        function viewTDP() {
            // Implement view TDP functionality
            alert('View TDP clicked');
        }

        function printTDP() {
            // Implement print TDP functionality
            alert('Print TDP clicked');
        }

        function viewCofO() {
            // Implement view CofO functionality
            alert('View CofO clicked');
        }

        function printCofO() {
            // Implement print CofO functionality
            alert('Print CofO clicked');
        }
    @endforeach


    $(document).ready(function() {
        // ...existing DataTables and other code...

        // Handle Approve button click
        $('.approve-btn').on('click', function() {
            const id = $(this).data('id');
            const fileno = $(this).data('fileno');
            $('#approveId').val(id);
            $('#approveFileno').val(fileno);
            $('#approveModal').modal('show');
        });

        // Approve form submission via AJAX
        $('#approveForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#approveId').val();
            const fileno = $('#approveFileno').val();
            $.ajax({
                url: "{{ route('sectionaltitling.approveSubApplication') }}",
                type: 'POST',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#approveModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Approved',
                        text: response.message
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'An error occurred.'
                    });
                }
            });
        });

        // Handle Decline button click
        $('.decline-btn').on('click', function() {
            const id = $(this).data('id');
            $('#declineId').val(id);
            $('#declineReason').val('');
            $('#declineModal').modal('show');
        });

        // Decline form submission via AJAX
        $('#declineForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#declineId').val();
            const reason = $('#declineReason').val();
            $.ajax({
                url: "{{ route('sectionaltitling.declineSubApplication') }}",
                type: 'POST',
                data: {
                    id: id,
                    reason: reason,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#declineModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Declined',
                        text: response.message
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'An error occurred.'
                    });
                }
            });
        });
    });
 
    $(document).ready(function() {
        $('#subRecordsTable').DataTable({
            responsive: true,
            pageLength: 100,
            lengthMenu: [100, 5, 10, 25, 50],
            columnDefs: [{
                responsivePriority: 1,
                targets: [0, 5]
            }, {
                responsivePriority: 2,
                targets: [1, 2]
            }]
        });
    });

    $(document).ready(function() {
        // Toggle decline reason visibility
        $('#decisionFormSub input[name="decision"]').on('change', function() {
            if ($(this).val() === 'decline') {
                $('#declineReasonGroup').show();
            } else {
                $('#declineReasonGroup').hide();
            }
        });

        // Open decision modal when either approve or decline button is clicked
        $('.approve-btn, .decline-btn').on('click', function() {
            const subId = $(this).data('id');
            $('#decisionSubId').val(subId);
            // Reset: default to approve and hide decline field
            $('#decApprove').prop('checked', true);
            $('#declineReasonGroup').hide();
            // Set current datetime as default
            const now = new Date().toISOString().slice(0, 16);
            $('#approvalDateSub').val(now);
            $('#decisionModalSub').modal('show');
        });

        // Submit decision via AJAX
        $('#decisionFormSub').on('submit', function(e) {
            e.preventDefault();
            const subId = $('#decisionSubId').val();
            const decision = $('#decisionFormSub input[name="decision"]:checked').val();
            const approvalDate = $('#approvalDateSub').val();
            const comments = $('#declineReasonSub').val();
            $.ajax({
                url: "{{ route('sectionaltitling.decisionSubApplication') }}",
                type: "POST",
                data: {
                    id: subId,
                    decision: decision,
                    approval_date: approvalDate,
                    comments: comments,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#decisionModalSub').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: (decision === 'approve' ? 'Approved' : 'Declined'),
                        text: response.message
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'An error occurred.'
                    });
                }
            });
        });
    });

    function showDepartmentConfirmation(department) {
        if (department === 'planningRec') {
            $('#planningRecommendationModal').modal('show');
            return;
        }
        $(`#${department}Modal`).modal('show'); // Ensure the modal ID matches
    }

    function toggleDropdown(button) {
        const dropdown = button.parentElement.querySelector('.action-menu');
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }


    function handleSelectChange(value) {
        if (value === 'architectural') {
            $('#architecturalModal').modal('show');
        } else if (value === 'planningRec') {
            Swal.fire({
                title: "Approve Application?",
                text: "Do you want to generate the planning recommendation document?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, approve it!",
                cancelButtonText: "No, cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Generate the planning recommendation document.
                    showPrintModal();
                }
            });
        }
    }

    function showPrintModal() {
        $('#printModal').modal('show');
    }


    $(document).ready(function() {
        // Show/hide for planning recommendation modal
        $('input[name="decision"]').change(function() {
            if ($(this).val() === 'decline') {
                $('#declineReasonGroup').show();
            } else {
                $('#declineReasonGroup').hide();
            }
        });

        // Open planning recommendation modal
        $('.planning-recommendation-btn').on('click', function() {
            const now = new Date().toISOString().slice(0, 16);
            $('#approvalDate').val(now);
            $('#planningRecommendationModal').modal('show');
        });

        // Submit planning recommendation form via AJAX
        $('#planningRecommendationForm').on('submit', function(e) {
            e.preventDefault();
            const decision = $('input[name="decision"]:checked').val();
            const approval_date = $('#approvalDate').val();
            const comments = $('#declineReason').val();
            // Add your AJAX call here to submit the form data
            $('#planningRecommendationModal').modal('hide');
            Swal.fire('Success', 'Planning recommendation submitted successfully!', 'success');
        });
    });


    document.querySelectorAll('input[name="submit_design"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const designFields = document.getElementById('designFields');
            designFields.style.display = this.value === 'yes' ? 'block' : 'none';

            // Toggle required attribute on inputs
            designFields.querySelectorAll('input').forEach(input => {
                input.required = this.value === 'yes';
            });
        });
    });

    $('input[name="submit_design"]').change(function() {
        $('#architecturalSubmitBtn').prop('disabled', this.value === 'no');
    });


    $(document).ready(function() {
        // Show/hide for main application modal
        $('input[name="decision"]').change(function() {
            if ($(this).val() === 'decline') {
                $('#declineReasonMotherGroup').show();
            } else {
                $('#declineReasonMotherGroup').hide();
            }
        });
        // Open decision modal for main application when decision-mother-btn is clicked
        $('.decision-mother-btn').on('click', function() {
            const id = $(this).data('id');
            $('#decisionMotherId').val(id);
            $('#dmmApprove').prop('checked', true);
            $('#declineReasonMotherGroup').hide();
            const now = new Date().toISOString().slice(0, 16);
            $('#approvalDateMother').val(now);
            $('#decisionModalMother').modal('show');
        });
        // Submit decision for main application via AJAX
        $('#decisionFormMother').on('submit', function(e) {
            e.preventDefault();
            const id = $('#decisionMotherId').val();
            const decision = $('input[name="decision"]:checked').val();
            const approval_date = $('#approvalDateMother').val();
            const comments = $('#declineReasonMother').val();
            $.ajax({
                url: "{{ route('sectionaltitling.decisionMotherApplication') }}",
                type: 'POST',
                data: {
                    id: id,
                    decision: decision,
                    approval_date: approval_date,
                    comments: comments,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#decisionModalMother').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: (decision == 'approve' ? 'Approved' : 'Declined'),
                        text: response.message
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'An error occurred.'
                    });
                }



            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM fully loaded");



        // Second approach: Clean up any delegated handlers to avoid conflicts
        $(document).off('click', '.generate-bill');
    });

    function openPaymentsModal(id) {
        setSelectedApplicationId(id);
        loadBillingData(id);
        
        // Update the bill iframe src when opening the modal
        const billFrame = document.getElementById('billFrame');
        if (billFrame) {
            console.log('Loading bill for ID:', id);
            billFrame.src = "{{ url('/sectionaltitling/generate-bill') }}/" + id;
        }
    }

    // Add this function to manually display the bill
    function generateBill(id) {
        $('#generateBillModal').modal('show');
        const billFrame = document.getElementById('billFrame');
        if (billFrame) {
            console.log('Loading bill for ID:', id);
            billFrame.src = "{{ url('/sectionaltitling/generate-bill') }}/" + id;
        }
    }

    function printBill() {
        const iframe = document.getElementById('billFrame');
        if (iframe && iframe.contentWindow) {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        } else {
            console.error('Cannot access iframe or its content window');
        }
    }
</script>