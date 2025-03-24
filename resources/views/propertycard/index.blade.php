{{-- filepath: c:\wamp64\www\gisedms\resources\views\propertycard\index.blade.php --}}
@extends('layouts.app')
@section('page-title')
    {{ __('Property Records') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Property Records') }}</li>
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
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

           
        
            <div  >
                <div class="card shadow-sm" style="width:100%">

                
                
                     
                    <div class="card-body" >
                        <h5 class="card-title">Property Records</h5>
                        <table id="recordsTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                     
                                    <th style="text-transform: none;">MLSF No</th> 
                                      <th style="text-transform: none;">kangisFileNo</th>
                                    <th style="text-transform: none;">Current Allottee</th>
                                    <th style="text-transform: none;">Land Use</th>
                                    <th style="text-transform: none;">District</th>
                                    <th style="text-transform: none;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($Property_records as $Property_record)
                                

                                <!-- View Modal for each record -->
                                <div class="modal fade" id="viewModal{{ $Property_record->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $Property_record->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewModalLabel{{ $Property_record->id }}">Property Record Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-4"><strong>MLSF No:</strong> {{ $Property_record->mlsfNo ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Kangis File No:</strong> {{ $Property_record->kangisFileNo ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Plot No:</strong> {{ $Property_record->plotNo ?? 'N/A' }}</div>
                                                    
                                                    <div class="col-md-4"><strong>Block No:</strong> {{ $Property_record->blockNo ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Approved Plan No:</strong> {{ $Property_record->approvedPlanNo ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>TP Plan No:</strong> {{ $Property_record->tpPlanNo ?? 'N/A' }}</div>
                                                    
                                                    <div class="col-md-4"><strong>Surveyed By:</strong> {{ $Property_record->surveyedBy ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Layout Name:</strong> {{ $Property_record->layoutName ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>District:</strong> {{ $Property_record->districtName ?? 'N/A' }}</div>
                                                    
                                                    <div class="col-md-4"><strong>LGA:</strong> {{ $Property_record->lgaName ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Title Serial No:</strong> {{ $Property_record->oldTitleSerialNo ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Title Page No:</strong> {{ $Property_record->oldTitlePageNo ?? 'N/A' }}</div>
                                                    
                                                    <div class="col-md-4"><strong>Title Volume No:</strong> {{ $Property_record->oldTitleVolumeNo ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Deeds Date:</strong> {{ $Property_record->deedsDate ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Certificate Date:</strong> {{ $Property_record->certificateDate ?? 'N/A' }}</div>
                                                    
                                                    <div class="col-md-6"><strong>Original Allottee:</strong> {{ $Property_record->originalAllottee ?? 'N/A' }}</div>
                                                    <div class="col-md-6"><strong>Address:</strong> {{ $Property_record->addressOfOriginalAllottee ?? 'N/A' }}</div>
                                                    
                                                    <div class="col-md-4"><strong>Title Issued Year:</strong> {{ $Property_record->titleIssuedYear ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Change of Ownership:</strong> {{ $Property_record->changeOfOwnership ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Reason for Change:</strong> {{ $Property_record->reasonForChange ?? 'N/A' }}</div>
                                                    
                                                    <div class="col-md-6"><strong>Current Allottee:</strong> {{ $Property_record->currentAllottee ?? 'N/A' }}</div>
                                                    <div class="col-md-6"><strong>Current Address:</strong> {{ $Property_record->addressOfCurrentAllottee ?? 'N/A' }}</div>
                                                    
                                                    <div class="col-md-4"><strong>Current Title:</strong> {{ $Property_record->titleOfCurrentAllottee ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Year Owned:</strong> {{ $Property_record->currentYearTitleOwned ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Phone:</strong> {{ $Property_record->phoneNo ?? 'N/A' }}</div>
                                                    
                                                    <div class="col-md-4"><strong>Land Use:</strong> {{ $Property_record->landUse ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Specific Use:</strong> {{ $Property_record->specifically ?? 'N/A' }}</div>
                                                    <div class="col-md-4"><strong>Area (Hectares):</strong> {{ $Property_record->areaInHectares ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach --}}
                            </tbody>
                        </table>
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
            processing: true,
            serverSide: true,
            ajax: '{{ route('propertycard.data') }}',
            columns: [
                { data: 'mlsfNo', name: 'mlsfNo' },
                { data: 'kangisFileNo', name: 'kangisFileNo' },
                { data: 'currentAllottee', name: 'currentAllottee' },
                { data: 'landUse', name: 'landUse' },
                { data: 'districtName', name: 'districtName' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            responsive: true,
            pageLength: {{ $pageLength }},
            lengthMenu: [{{ $pageLength }}, 5, 10, 25, 50],
            columnDefs: [
                { responsivePriority: 1, targets: [0, 3, 4] },
                { responsivePriority: 2, targets: [1, 2] }
            ]
        });
    });
</script>
        </div>
    </div>
@endsection