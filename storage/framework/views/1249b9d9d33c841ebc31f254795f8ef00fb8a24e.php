

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
            ajax: '<?php echo e(route('propertycard.data')); ?>',
            columns: [
                { data: 'mlsfNo', name: 'mlsfNo' },
                { data: 'kangisFileNo', name: 'kangisFileNo' },
                { data: 'currentAllottee', name: 'currentAllottee' },
                { data: 'landUse', name: 'landUse' },
                { data: 'districtName', name: 'districtName' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            responsive: true,
            pageLength: <?php echo e($pageLength); ?>,
            lengthMenu: [<?php echo e($pageLength); ?>, 5, 10, 25, 50],
            columnDefs: [
                { responsivePriority: 1, targets: [0, 3, 4] },
                { responsivePriority: 2, targets: [1, 2] }
            ]
        });
    });
</script>
 
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/propertycard/index.blade.php ENDPATH**/ ?>