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
        body { zoom: 90%; }
        .record-group { border: 1px solid #dee2e6; border-radius: 0.375rem; padding: 1rem; margin-bottom: 1rem; }
        .record-group h3 { font-size: 1.125rem; margin-bottom: 1rem; }
        .modal-dialog-scrollable .modal-content { max-height: 90vh; }
        .modal-xl { max-width: 1140px; }
    </style>

    <div class="container mx-auto mt-4 p-4">

        <div class="container">
            <div class="container py-4">
                <div class="card shadow-sm">
                    <div class="card-body" style="width:100%">
                        <table id="recordsTable" class="table table-striped dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Application ID</th>
                                    <th>Owner Name</th>
                                    <th>Scheme No</th>
                                    <th>Approval Date</th>
                                    <th>Application Status</th>
                                    <th>Phone Number</th>
                                    <th>Total Units</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>FNO-001</td>
                                    <td>John Doe</td>
                                    <td>Jane Doe</td>
                                    <td>2023-01-01</td>
                                    <td>Registration</td>
                                    <td>2023-01-02</td>
                                    <td>Plot A</td>
                                    <td>
                                        <button type="button" class="btn btn-info open-actions-modal" data-id="1" data-bs-toggle="modal" data-bs-target="#actionsModal">
                                            <i class="fa fa-th"></i> Actions
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Actions Modal -->
            <div class="modal fade" id="actionsModal" tabindex="-1" aria-labelledby="actionsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="actionsModalLabel">Available Actions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-primary w-100 view-record" data-id="1">
                                            <i class="fa fa-eye"></i><br>View
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-success w-100">
                                            <i class="fa fa-edit"></i><br>Edit
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-warning w-100">
                                            <i class="fa fa-address-card"></i><br>Generate Reg No
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button class="btn btn-secondary w-100">
                                            <i class="fa fa-print"></i><br>Print CoR
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-danger w-100">
                                            <i class="fa fa-trash"></i><br>Delete
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-info w-100">
                                            <i class="fa fa-info-circle"></i><br>Details
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-dark w-100">
                                            <i class="fa fa-download"></i><br>Download
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-light w-100">
                                            <i class="fa fa-share"></i><br>Share
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-outline-primary w-100">
                                            <i class="fa fa-copy"></i><br>Duplicate
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-outline-secondary w-100">
                                            <i class="fa fa-flag"></i><br>Flag
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-outline-success w-100">
                                            <i class="fa fa-check"></i><br>Approve
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-outline-danger w-100">
                                            <i class="fa fa-times"></i><br>Reject
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-outline-info w-100">
                                            <i class="fa fa-comment"></i><br>Comment
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-outline-dark w-100">
                                            <i class="fa fa-cog"></i><br>Settings
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-outline-warning w-100">
                                            <i class="fa fa-bell"></i><br>Notify
                                        </button>
                                    </div>
                                    <div class="col-3 text-center mb-3">
                                        <button type="button" class="btn btn-outline-primary w-100">
                                            <i class="fa fa-envelope"></i><br>Message
                                        </button>
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
            <script>
                $(document).ready(function() {
                    $('#recordsTable').DataTable({
                        responsive: true,
                        pageLength: 100,
                        lengthMenu: [100, 5, 10, 25, 50],
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