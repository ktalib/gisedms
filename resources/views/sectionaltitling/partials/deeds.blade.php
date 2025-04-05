@php
    // Initialize application data variable to be used globally in this view
    $applicationData = null;
    
    // If we have an application ID in the input field, fetch the data
    if (request()->has('application_id')) {
        $applicationId = request()->input('application_id');
        $applicationData = DB::connection('sqlsrv')
            ->table('dbo.mother_applications')
            ->where('id', $applicationId)
            ->first();
    }
@endphp

<!-- Display application info if we have data -->
@if($applicationData)
<div class="alert alert-info mb-3">
    <strong>Application Info:</strong> 
    <p>ID: {{ $applicationData->id }}</p>
    @if(isset($applicationData->first_name) || isset($applicationData->surname))
    <p>Applicant: {{ $applicationData->first_name ?? '' }} {{ $applicationData->surname ?? '' }}</p>
    @elseif(isset($applicationData->multiple_owners_names))
    <p>Applicant: {{ $applicationData->multiple_owners_names }}</p>
    @elseif(isset($applicationData->corporate_name))
    <p>Applicant: {{ $applicationData->corporate_name }}</p>
    @endif
    @if(isset($applicationData->fileno))
    <p>File No: {{ $applicationData->fileno }}</p>
    @endif
</div>
@endif

<div class="modal fade" id="landsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lands</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="landsForm">
                    <div class="mb-3">
                        <label for="landsFileNo" class="form-label">File No</label>
                        <input type="text" class="form-control" id="landsFileNo" name="landsFileNo" required>
                    </div>
                    <div class="mb-3">
                        <label for="landsFileName" class="form-label">File Name</label>
                        <input type="text" class="form-control" id="landsFileName" name="landsFileName" required>
                    </div>
                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;"
                                onclick="showDepartmentConfirmation('ok')">
                                OK
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">check_circle</i>
                            </button>
                            <button type="button" class="bttn gray-shadow"
                                style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;"
                                onclick="openFile()">
                                EDMS
                                <i class="material-icons" style="color: #2196F3; font-size: 16px;">folder_open</i>
                            </button>
                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                Submit
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deedsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deeds</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="deedsForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="current-application-id" name="application_id" value="{{ request()->input('application_id', '') }}">
                    
                    @if($applicationData)
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Applicant Name</label>
                            <input type="text" class="form-control" readonly
                                value="@if(isset($applicationData->multiple_owners_names)){{ $applicationData->multiple_owners_names }}@elseif(isset($applicationData->corporate_name)){{ $applicationData->corporate_name }}@else{{ ($applicationData->first_name ?? '') . ' ' . ($applicationData->surname ?? '') }}@endif">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">File No</label>
                            <input type="text" class="form-control" readonly
                                value="{{ $applicationData->fileno ?? '' }}">
                        </div>
                    </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Serial No</label>
                            <input type="text" class="form-control" name="serial_no">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Page No</label>
                            <input type="text" class="form-control" name="page_no">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Volume NO</label>
                            <input type="text" class="form-control" name="volume_no">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Deeds Time</label>
                            <input type="text" class="form-control" name="deeds_time">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deeds Date</label>
                            <input type="date" class="form-control" name="deeds_date">
                        </div>
                    </div>

                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow" data-bs-dismiss="modal" aria-label="Close"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 150px; height: 40px;">
                                Close
                                <i class="material-icons" style="color: #c70707; font-size: 16px;">cancel</i>
                            </button>

                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 150px; height: 40px;">
                                Submit
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="surveyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Survey Department Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="surveyForm">
                    <div class="row g-3">
                        <!-- First row -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Survey By</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>

                        <!-- Second row - Drawn By -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Drawn By</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>

                        <!-- Third row - Checked By -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Checked By</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>

                        <!-- Fourth row - Approved By -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Approved By</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#viewSurveyPlanModal">
                            <i class="material-icons" style="font-size: 16px; vertical-align: middle;">map</i> View
                            Survey Plan
                        </button>

                    </div>

                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow"
                                onclick="showDepartmentConfirmation('ok')"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                OK
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">check_circle</i>
                            </button>
                            <button type="button" class="bttn gray-shadow"
                                onclick="showDepartmentConfirmation('edit')"
                                style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                Edit
                                <i class="material-icons" style="color: #9E9E9E; font-size: 16px;">edit</i>
                            </button>
                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                Submit
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- View Survey Plan Modal -->
<div class="modal fade" id="viewSurveyPlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Survey Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Dummy image for demonstration -->
                <div class="text-center">
                    <img src="{{ asset(Storage::url('uploads')) . '/survey.jpeg' }}" alt="Survey Plan"
                        class="img-fluid">
                </div>
            </div>
            <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal"
                    style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                    Close
                    <i class="material-icons" style="color: #9E9E9E;">close</i>
                </button>
                <button type="button" class="bttn blue-shadow" onclick="printSurveyPlan()"
                    style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                    Print Survey Plan
                    <i class="material-icons" style="color: #3F51B5;">print</i>
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $('#deedsForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true).text('Sending...');
        $.ajax({
            url: '{{ route('deeds.insert') }}',
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                submitBtn.prop('disabled', false).text('Submit');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Deed data inserted successfully',
                }).then(() => {
                    $('#deedsModal').modal('hide');
                    // Reload page to show updated data
                    location.reload();
                });
            },
            error: function(err) {
                console.error("Error submitting deed data:", err);
                submitBtn.prop('disabled', false).text('Submit');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error submitting deed data. Check console for details.',
                });
            }
        });
    });

    // Function to open deeds modal with application ID
    function openDeedsModal(applicationId) {
        // Set the application ID in the hidden input
        document.getElementById('current-application-id').value = applicationId;
        
        // Update URL to include application ID as a query parameter
        const url = new URL(window.location.href);
        url.searchParams.set('application_id', applicationId);
        window.history.replaceState({}, '', url);
        
        // Fetch application data via AJAX to populate form fields dynamically
        $.ajax({
            url: '{{ route('deeds.getDeedsDublicate') }}',
            method: 'GET',
            data: { application_id: applicationId },
            success: function(response) {
                // Refresh the page with the new URL to show the application info
                location.reload();
            },
            error: function(err) {
                console.error("Error fetching application data:", err);
            }
        });
    }

    // Automatically set the current application ID when clicking on a table row
    document.querySelectorAll('#recordsTable tbody tr').forEach(row => {
        row.addEventListener('click', function() {
            const applicationId = this.getAttribute('data-id'); // Use the data-id attribute for the database ID
            document.getElementById('current-application-id').value = applicationId;
        });
    });

    function printSurveyPlan() {
        // Create a new window with just the image content
        const printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Survey Plan</title></head><body>');
        printWindow.document.write('<img src="{{ asset('storage/uploads/survey.jpeg') }}" style="width: 100%;">');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }

    // Automatically set the current application ID when clicking on a table row
    document.querySelectorAll('#recordsTable tbody tr').forEach(row => {
        row.addEventListener('click', function() {
            const applicationId = this.getAttribute('data-id'); // Use the data-id attribute for the database ID
            document.getElementById('current-application-id').value = applicationId;
        });
    });
</script>
