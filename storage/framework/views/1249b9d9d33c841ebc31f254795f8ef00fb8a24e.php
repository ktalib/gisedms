

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Property Records')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Property Records')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/ckeditor/classic/ckeditor.js')); ?>"></script>

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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- ...existing head code... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.14/iconfont/material-icons.min.css">
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
                               <!-- Dynamic data loaded via DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
           
            <!-- Reusable View Modal -->
            <div class="modal fade" id="viewRecordModal" tabindex="-1" aria-labelledby="viewRecordModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewRecordModalLabel">Property Record Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3" id="recordDetails">
                                <div class="col-12 text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p>Loading record details...</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="printRecordBtn">Print Record</button>
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
    // Add toggleDropdown function
    function toggleDropdown(button, event) {
        event.stopPropagation();
        // Find the dropdown menu related to this button
        const dropdownMenu = button.nextElementSibling;
        
        // Close all other open dropdowns first
        document.querySelectorAll('.action-menu').forEach(menu => {
            if (menu !== dropdownMenu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });
        
        // Toggle the current dropdown
        dropdownMenu.classList.toggle('hidden');
    }
    
    // Close all dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        document.querySelectorAll('.action-menu').forEach(menu => {
            if (!menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });
    });
    
    $(document).ready(function() {
        // Check if pageLength is defined, otherwise use default
        const pageLength = <?php echo e($pageLength ?? 50); ?>;
        let retryCount = 0;
        const maxRetries = 2;
        
        function initDataTable(useFallback = false) {
            // If a DataTable already exists, destroy it first
            if ($.fn.DataTable.isDataTable('#recordsTable')) {
                $('#recordsTable').DataTable().destroy();
            }
            
            // Clear any existing alerts
            $('.datatable-alert').remove();
            
            // Add a loading message
            $('.card-title').after('<div class="alert alert-info datatable-alert mt-2">Loading property records...</div>');
            
            $('#recordsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: useFallback ? '<?php echo e(route("propertycard.data.fallback")); ?>' : '<?php echo e(route("propertycard.data")); ?>',
                    error: function(xhr, error, thrown) {
                        console.error('DataTables Ajax Error:', error, thrown);
                        console.log('XHR Status:', xhr.status);
                        console.log('XHR Response:', xhr.responseText);
                        
                        // Remove the loading message
                        $('.datatable-alert').remove();
                        
                        // Show error message
                        $('.card-title').after('<div class="alert alert-danger datatable-alert mt-2">Error loading data: ' + thrown + '</div>');
                        
                        if (retryCount < maxRetries && !useFallback) {
                            retryCount++;
                            $('.card-title').after('<div class="alert alert-warning datatable-alert mt-2">Retrying... Attempt ' + retryCount + ' of ' + maxRetries + '</div>');
                            
                            // Wait 2 seconds before retrying
                            setTimeout(function() {
                                if (retryCount === maxRetries) {
                                    // On last retry, use fallback
                                    initDataTable(true);
                                } else {
                                    // Otherwise retry normal route
                                    initDataTable(false);
                                }
                            }, 2000);
                        } else if (!useFallback) {
                            // If we've exhausted retries and not using fallback yet, try the fallback
                            $('.card-title').after('<div class="alert alert-warning datatable-alert mt-2">Trying fallback data source...</div>');
                            initDataTable(true);
                        } else {
                            // If even the fallback fails, show a final error and initialize with empty data
                            $('.datatable-alert').remove();
                            $('.card-title').after('<div class="alert alert-danger datatable-alert mt-2">All data sources failed. Please check server logs for details.</div>');
                            
                            // Initialize with empty data
                            $('#recordsTable').DataTable({
                                data: [],
                                columns: [
                                    { title: "MLSF No", data: null, defaultContent: "N/A" },
                                    { title: "Kangis File No", data: null, defaultContent: "N/A" },
                                    { title: "Current Allottee", data: null, defaultContent: "N/A" },
                                    { title: "Land Use", data: null, defaultContent: "N/A" },
                                    { title: "District", data: null, defaultContent: "N/A" },
                                    { title: "Actions", data: null, defaultContent: "N/A" }
                                ]
                            });
                        }
                    },
                    dataSrc: function(json) {
                        // Remove the loading message on success
                        $('.datatable-alert').remove();
                        
                        if (useFallback) {
                            $('.card-title').after('<div class="alert alert-warning datatable-alert mt-2">Using fallback data. Some features may be limited.</div>');
                        } else {
                            $('.card-title').after('<div class="alert alert-success datatable-alert mt-2">Data loaded successfully.</div>');
                            // Auto-hide success message after 3 seconds
                            setTimeout(function() {
                                $('.alert-success.datatable-alert').fadeOut();
                            }, 3000);
                        }
                        
                        return json.data;
                    }
                },
                columns: [
                    { data: 'mlsfNo', name: 'mlsfNo' },
                    { data: 'kangisFileNo', name: 'kangisFileNo' },
                    { data: 'currentAllottee', name: 'currentAllottee' },
                    { data: 'landUse', name: 'landUse' },
                    { data: 'districtName', name: 'districtName' },
                    { 
                        data: null, 
                        name: 'actions', 
                        orderable: false, 
                        searchable: false,
                        render: function(data, type, row) {
                            return '<div class="relative inline-block dropdown-container">' +
                                '<button type="button" class="dropdown-toggle p-2 bg-gray-200 hover:bg-gray-300 focus:outline-none border-2 border-gray-400" onclick="toggleDropdown(this, event)">' +
                                    '<i class="material-icons">more_vert</i>' +
                                '</button>' +
                                '<ul class="absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-lg hidden action-menu z-50 text-sm">' +
                                    '<li>' +
                                    '<button class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center view-record" data-id="' + row.id + '" title="View Record">' +
                                        '<i class="material-icons text-blue-500 mr-3">visibility</i>' +
                                        '<span>View Record</span>' +
                                    '</button>' +
                                    '</li>' +
                                    '<li>' +
                                    '<button class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center edit-record" data-id="' + row.id + '" title="Edit Record">' +
                                        '<i class="material-icons text-green-500 mr-3">edit</i>' +
                                        '<span>Edit Record</span>' +
                                    '</button>' +
                                    '</li>' +
                                    '<li>' +
                                    '<button class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center delete-record" data-id="' + row.id + '" title="Delete Record">' +
                                        '<i class="material-icons text-red-500 mr-3">delete</i>' +
                                        '<span>Delete Record</span>' +
                                    '</button>' +
                                    '</li>' +
                                '</ul>' +
                                   '</div>';
                        }
                    }
                ],
                responsive: true,
                pageLength: pageLength,
                lengthMenu: [pageLength, 5, 10, 25, 50],
                columnDefs: [
                    { responsivePriority: 1, targets: [0, 3, 4] },
                    { responsivePriority: 2, targets: [1, 2] }
                ],
                drawCallback: function() {
                    // Initialize view record buttons
                    $('.view-record').on('click', function() {
                        const recordId = $(this).data('id');
                        showRecordDetails(recordId);
                    });
                }
            });
        }
        
        // Function to show record details in modal
        function showRecordDetails(recordId) {
            // Set loading state
            $('#recordDetails').html(
            '<div class="col-12 text-center">' +
                '<div class="spinner-border text-primary" role="status">' +
                '<span class="visually-hidden">Loading...</span>' +
                '</div>' +
                '<p>Loading record details...</p>' +
            '</div>'
            );
            
            // Show the modal
            $('#viewRecordModal').modal('show');
            
            // Fetch record details from server
            $.ajax({
            url: '<?php echo e(route("propertycard.getRecordDetails")); ?>',
            method: 'GET',
            data: { id: recordId },
            success: function(response) {
                if (response.success) {
                const record = response.data;
                let detailsHtml = '';

                // Enhanced UI using Bootstrap Cards
                detailsHtml += '<style>';
                detailsHtml += '.detail-card { margin-bottom: 1rem; }';
                detailsHtml += '.detail-card .card-header { background-color: #06002065; color: white; font-size: 1.1rem; padding: 0.25rem 0.75rem; }';
                detailsHtml += '.detail-card .card-body { background-color: #f8f9fc; }';
                detailsHtml += '</style>';

                // Property Details Group
                detailsHtml += '<div class="card detail-card">';
                detailsHtml +=   '<div class="card-header">Property Details</div>';
                detailsHtml +=   '<div class="card-body"><div class="row">';
                detailsHtml +=     '<div class="col-md-4"><strong>MLSF No:</strong> ' + (record.mlsfNo || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Kangis File No:</strong> ' + (record.kangisFileNo || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Plot No:</strong> ' + (record.plotNo || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Area (Hectares):</strong> ' + (record.areaInHectares || 'N/A') + '</div>';
                detailsHtml +=   '</div></div>';
                detailsHtml += '</div>';



                      // Title Information Group
                      detailsHtml += '<div class="card detail-card">';
                detailsHtml +=   '<div class="card-header">Title Information</div>';
                detailsHtml +=   '<div class="card-body"><div class="row">';
                detailsHtml +=     '<div class="col-md-4"><strong>Title Serial No:</strong> ' + (record.oldTitleSerialNo || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Title Page No:</strong> ' + (record.oldTitlePageNo || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Title Volume No:</strong> ' + (record.oldTitleVolumeNo || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4 mt-2"><strong>Deeds Date:</strong> ' + (record.deedsDate || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4 mt-2"><strong>Certificate Date:</strong> ' + (record.certificateDate || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4 mt-2"><strong>Title Issued Year:</strong> ' + (record.titleIssuedYear || 'N/A') + '</div>';

                detailsHtml +=     '<div class="col-md-12"><strong>Reg Particulars:</strong> ' 
                           + (record.oldTitleSerialNo ? record.oldTitleSerialNo : 'N/A') + '/' 
                           + (record.oldTitlePageNo ? record.oldTitlePageNo : 'N/A') + '/' 
                           + (record.oldTitleVolumeNo ? record.oldTitleVolumeNo : 'N/A') + '</div>';
                detailsHtml +=   '</div></div>';
                detailsHtml += '</div>';

                // Plan Details Group
                detailsHtml += '<div class="card detail-card">';
                detailsHtml +=   '<div class="card-header">Plan Details</div>';
                detailsHtml +=   '<div class="card-body"><div class="row">';
                detailsHtml +=     '<div class="col-md-4"><strong>Block No:</strong> ' + (record.blockNo || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Approved Plan No:</strong> ' + (record.approvedPlanNo || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>TP Plan No:</strong> ' + (record.tpPlanNo || 'N/A') + '</div>';
                detailsHtml +=   '</div></div>';
                detailsHtml += '</div>';

                // Survey & Location Group
                detailsHtml += '<div class="card detail-card">';
                detailsHtml +=   '<div class="card-header">Survey & Location</div>';
                detailsHtml +=   '<div class="card-body"><div class="row">';
                detailsHtml +=     '<div class="col-md-4"><strong>Surveyed By:</strong> ' + (record.surveyedBy || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Layout Name:</strong> ' + (record.layoutName || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>District:</strong> ' + (record.districtName || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4 mt-2"><strong>LGA:</strong> ' + (record.lgaName || 'N/A') + '</div>';
                detailsHtml +=   '</div></div>';
                detailsHtml += '</div>';

          
                // Ownership History Group
                detailsHtml += '<div class="card detail-card">';
                detailsHtml +=   '<div class="card-header">Ownership History</div>';
                detailsHtml +=   '<div class="card-body"><div class="row">';
                detailsHtml +=     '<div class="col-md-6"><strong>Original Allottee:</strong> ' + (record.originalAllottee || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-6"><strong>Original Address:</strong> ' + (record.addressOfOriginalAllottee || 'N/A') + '</div>';
                detailsHtml +=   '</div></div>';
                detailsHtml += '</div>';

                // Current Ownership Group
                detailsHtml += '<div class="card detail-card">';
                detailsHtml +=   '<div class="card-header">Current Ownership</div>';
                detailsHtml +=   '<div class="card-body"><div class="row">';
                detailsHtml +=     '<div class="col-md-4"><strong>Current Allottee:</strong> ' + (record.currentAllottee || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Current Address:</strong> ' + (record.addressOfCurrentAllottee || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Current Title:</strong> ' + (record.titleOfCurrentAllottee || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4 mt-2"><strong>Year Owned:</strong> ' + (record.currentYearTitleOwned || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4 mt-2"><strong>Phone:</strong> ' + (record.phoneNo || 'N/A') + '</div>';
                detailsHtml +=   '</div></div>';
                detailsHtml += '</div>';

                // Land Use Group
                detailsHtml += '<div class="card detail-card">';
                detailsHtml +=   '<div class="card-header">Land Use</div>';
                detailsHtml +=   '<div class="card-body"><div class="row">';
                detailsHtml +=     '<div class="col-md-4"><strong>Land Use:</strong> ' + (record.landUse || 'N/A') + '</div>';
                detailsHtml +=     '<div class="col-md-4"><strong>Specific Use:</strong> ' + (record.specifically || 'N/A') + '</div>';
                detailsHtml +=   '</div></div>';
                detailsHtml += '</div>';

                // Append a Print Record button
               

                $('#recordDetails').html(detailsHtml);
                
                // Attach the print functionality
                $('#printRecordBtn').on('click', function() {
                    // Capture the record details and open a new window for printing
                    var printContents = document.getElementById('recordDetails').innerHTML;
                    var printWindow = window.open('', '', 'height=600,width=800');
                    printWindow.document.write('<html><head><title>Print Record</title>');
                    // Optional: include any required styles for printing
                    printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">');
                    printWindow.document.write('</head><body>');
                    printWindow.document.write(printContents);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
                });
                } else {
                $('#recordDetails').html('<div class="text-center text-danger">Error loading record: ' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                $('#recordDetails').html('<div class="text-center text-danger">Error loading record: ' + error + '</div>');
                console.error('Failed to load record details:', error);
            }
            });
        }
        
        // Initialize the DataTable
        initDataTable();
    });
</script>
 
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/propertycard/index.blade.php ENDPATH**/ ?>