{{-- filepath: c:\wamp64\www\gisedms\resources\views\instruments\index.blade.php --}}
@extends('layouts.app')
@section('page-title')
    {{ __('APPLICATION FOR SECTIONAL TITLING COMMERCIAL MODULE') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('APPLICATION FOR SECTIONAL TITLING COMMERCIAL MODULE') }}</li>
@endsection
@push('script-page')
    <script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>

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



@section('content')
<!-- ...existing head code... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <style>
        body { zoom: 88%; }
        .record-group { border: 1px solid #dee2e6; border-radius: 0.375rem; padding: 1rem; margin-bottom: 1rem; }
        .record-group h3 { font-size: 1.125rem; margin-bottom: 1rem; }
        .modal-dialog-scrollable .modal-content { max-height: 90vh; }
        .modal-xl { max-width: 1140px; }
        .modal-backdrop { background-color: transparent; } /* Add this line */

        input,
        textarea,
        select {
            text-transform: uppercase;
        }
        
    </style>

    <div class="container mx-auto mt-4 p-4">

        <div class="container">

           
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('sectionaltitling.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Create Application
            </a>
            <a href="{{ route('sectionaltitling.sub_applications') }}" class="btn btn-secondary">
                <i class="fa fa-list"></i> View Sub Applications
            </a>
        </div>
            <div  >
                <div class="card shadow-sm" style="width:100%">

                
                
                     
                    <div class="card-body" >
                        <h5 class="card-title">Sectional Titling Applications</h5>
                        <table id="recordsTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-transform: none;">Application ID</th>
                                    <th style="text-transform: none;">File No</th>
                                    <th style="text-transform: none;">Original Owner Name</th>
                                    <th style="text-transform: none;">Date</th>
                                    <th style="text-transform: none;">Application Status</th>
                                    <th style="text-transform: none;">Phone</th>
                                    <th style="text-transform: none;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Main_application as $application)
                                <tr>
                                    <td>STM-2025-000-{{ $application->id }}</td>
                                    <td>{{ $application->fileno }}</td>
                                    <td>
                                        @if($application->multiple_owners_names)
                                            {{ $application->multiple_owners_names }}
                                            
                                            @elseif ($application->corporate_name)
                                            {{ $application->corporate_name }}
                                            @else
                                                {{ $application->first_name }} {{ $application->middle_name }} {{ $application->surname }}
                                            @endif
                                        
                                    </td>
                                    <td>{{ $application->created_at}}</td>
                                    <td>{{ $application->application_status }}</td>
                                    <td>{{ $application->phone_number }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @if($application->application_status == 'Approved')
                                            <a href="{{ route('sectionaltitling.sub_application', [
                                                'application_id'      => $application->id,
                                                'owner_name'          => $application->corporate_name ? $application->corporate_name : ($application->multiple_owners_names ? $application->multiple_owners_names : $application->first_name . ' ' . $application->middle_name . ' ' . $application->surname),
                                                'fileno'           => $application->fileno,
                                                'passport'            => $application->passport,
                                                'formID'              => $application->id,
                                                'address'             => $application->address,
                                                'plot_house_no'       => $application->plot_house_no,
                                                'plot_plot_no'        => $application->plot_plot_no,
                                                'plot_street_name'    => $application->plot_street_name,
                                                'plot_district'       => $application->plot_district,
                                                'property_location'   => $application->plot_district . ' ' . $application->plot_street_name . ' ' . $application->plot_plot_no
                                            ]) }}" class="btn btn-icon btn-secondary" data-bs-toggle="tooltip" title="Create ST Record">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            @else
                                            <button class="btn btn-icon btn-secondary disabled" style="opacity: 0.5;" data-bs-toggle="tooltip" title="Create ST Record">
                                                <i class="fa fa-plus"></i>
                                            </button>                               
                                            @endif

                                            <button type="button" class="btn btn-icon btn-info open-actions-modal" data-id="{{ $application->id }}" data-bs-toggle="modal" data-bs-target="#actionsModal" data-bs-toggle="tooltip" title="Actions">
                                                <i class="fa fa-th"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-icon btn-secondary" data-bs-toggle="modal" data-bs-target="#viewActionsModal" data-bs-toggle="tooltip" title="View Receipt & Plans">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Actions Modal -->
            <div class="modal" id="actionsModal" tabindex="-1" aria-labelledby="actionsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="actionsModalLabel">Available Actions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <h1>Action Buttons</h1>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-primary w-100" onclick="showDepartmentConfirmation('finance')">
                                            <i class="fa fa-money-bill"></i><br>Finance
                                        </button>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-success w-100" onclick="showDepartmentConfirmation('planning')">
                                            <i class="fa fa-building"></i><br>Physical Planning
                                        </button>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-warning w-100" onclick="showDepartmentConfirmation('knupda')">
                                            <i class="fa fa-landmark"></i><br>KNUPDA
                                        </button>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-info w-100" onclick="showDepartmentConfirmation('survey')">
                                            <i class="fa fa-map"></i><br>Survey
                                        </button>
                                    </div> 
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-info bg-black w-100" onclick="showDepartmentConfirmation('Lands')">
                                            <i class="fa fa-map"></i><br>Lands
                                        </button>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-secondary w-100" onclick="showDepartmentConfirmation('architectural')">
                                            <i class="fa fa-pencil-ruler"></i><br>Architectural Design
                                        </button>
                                    </div>
                              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Actions Modal -->
            <div class="modal" id="viewActionsModal" tabindex="-1" aria-labelledby="viewActionsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewActionsModalLabel">View Actions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-primary w-100 btn-sm" data-bs-toggle="modal" data-bs-target="#viewSurveyPlanModal">
                                            <i class="fa fa-eye"></i><br>View Survey Plan
                                        </button>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-success w-100 btn-sm" data-bs-toggle="modal" data-bs-target="#viewArchitecturalDesignModal">
                                            <i class="fa fa-eye"></i><br>View Architectural Design
                                        </button>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-warning w-100 btn-sm" data-bs-toggle="modal" data-bs-target="#viewReceiptModal">
                                            <i class="fa fa-eye"></i><br>View Receipt
                                        </button>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <button type="button" class="btn btn-info w-100 btn-sm" data-bs-toggle="modal" data-bs-target="#viewLandModal">
                                            <i class="fa fa-eye"></i><br>view scanned file
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Survey Plan Modal -->
            <div class="modal fade" id="viewSurveyPlanModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Survey Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <center>
                       <img src="https://i.ibb.co/8gxB59Cs/Whats-App-Image-2025-03-15-at-7-43-13-PM.jpg" class="img-fluid" alt="Survey Plan" style="cursor: zoom-in;">
                    </center>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Architectural Design Modal -->
            <div class="modal fade" id="viewArchitecturalDesignModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Architectural Design</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <certer>
                            <img src="https://i.ibb.co/fd6bqjyH/Whats-App-Image-2025-03-15-at-7-43-51-PM.jpg" 
  class="img-fluid d-block mx-auto zoomable" alt="Architectural Design" style="cursor: zoom-in;">
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Receipt Modal -->
            <div class="modal fade" id="viewReceiptModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Receipt</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <certer>
                            <img src="https://i.ibb.co/MDyrWyM/Whats-App-Image-2025-03-15-at-7-46-32-PM.jpg" 
  class="img-fluid d-block mx-auto zoomable" alt="Receipt" style="cursor: zoom-in;">
</center>
                        </div>
                    </div>
                </div>
            </div>

            <style>
              .zoomable {
                transition: transform 0.3s ease;
              }
              .zoomable:hover {
                transform: scale(1.2);
              }
            </style>

            <!-- View Land Modal -->
            <div class="modal fade" id="viewLandModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">view scanned file</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="pdf-viewer" style="width:100%; height:600px;"></div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.min.js"></script>
                            <script>
                                PDFObject.embed("{{ asset('storage/uploads/PAL526.pdf') }}", "#pdf-viewer");
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            
           
      

            <!-- Department Approval Modals -->
            <div class="modal fade" id="financeModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Finance Department Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="financeForm">
                                
                                <div class="mb-3">
                                    <label class="form-label">Receipt No</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Amount (₦)</label>
                                    <input type="number" min="0" step="0.01" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Approved By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="planningModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Physical Planning Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="planningForm">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Approved By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="knupdaModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">KNUPDA Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="knupdaForm">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Approved By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Submit</button>
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
                               
                                <div class="mb-3">
                                    <label class="form-label">Survey By</label>
                                    <input type="text" class="form-control" required>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Approved By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="LandsModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Lands Department Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="LandsForm">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Approved By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="architecturalModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Architectural Design Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="architecturalForm">
                                <div class="mb-3">
                                    <label class="form-label">Drawn By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Approved By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-secondary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showDepartmentConfirmation(department) {
                    const departmentNames = {
                        finance: 'Finance',
                        planning: 'Physical Planning',
                        knupda: 'KNUPDA',
                        survey: 'Survey',
                        Lands: 'Lands',
                        architectural: 'Architectural Design'
                    };

                    Swal.fire({
                        title: `${departmentNames[department]} Department Approval`,
                        text: 'Are you sure you want to proceed with the approval?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, proceed',
                        cancelButtonText: 'No, cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#actionsModal').modal('hide');
                            $(`#${department}Modal`).modal('show');
                        }
                    });
                }

                // Handle form submissions
                ['finance', 'planning', 'knupda', 'survey', 'Lands', 'architectural'].forEach(dept => {
                    $(`#${dept}Form`).on('submit', function(e) {
                        e.preventDefault();
                        $(`#${dept}Modal`).modal('hide');
                        Swal.fire('Success', 'Approval submitted successfully!', 'success');
                    });
                });
            </script>
            <!-- Record Details Modal -->
            <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="recordModalLabel">INSTRUMENT DETAILS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="recordDetails">
                                <div class="record-group">
                                    <h3>Basic Information</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><strong>File No:</strong> FNO-001</p>
                                            <p><strong>Grantor:</strong> John Doe</p>
                                        </div>
                                        <div class="col-6">
                                            <p><strong>Grantee:</strong> Jane Doe</p>
                                            <p><strong>Registration Date:</strong> 2023-01-01</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- jQuery and DataTables JS -->
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <!-- SweetAlert2 -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                $(document).ready(function() {
                    $('#recordsTable').DataTable({
                        responsive: true,
                        pageLength: 30,
                        lengthMenu: [5, 10, 30, 50, 100],
                        columnDefs: [
                            { responsivePriority: 1, targets: [0, 3, 4] },
                            { responsivePriority: 2, targets: [1, 2] }
                        ]
                    });

                    $('.view-record').on('click', function() {
                        const detailsHtml = `
                            <div class="record-group">
                                <h3>Basic Information</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <p><strong>File No:</strong> FNO-001</p>
                                        <p><strong>Grantor:</strong> John Doe</p>
                                    </div>
                                    <div class="col-6">
                                        <p><strong>Grantee:</strong> Jane Doe</p>
                                        <p><strong>Registration Date:</strong> 2023-01-01</p>
                                    </div>
                                </div>
                            </div>`;
                        $('#recordDetails').html(detailsHtml);
                        const recordModal = new bootstrap.Modal(document.getElementById('recordModal'));
                        recordModal.show();
                    });
                });
            </script>
        </div>
    </div>
@endsection