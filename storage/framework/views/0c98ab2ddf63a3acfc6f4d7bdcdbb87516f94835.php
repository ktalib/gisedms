
 <?php $__env->startSection('page-title', __('Sub-Applications')); ?>
 <?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"><?php echo e(__('Sub-Applications')); ?></li>
 <?php $__env->stopSection(); ?>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
 <!-- DataTables CSS -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
 <?php $__env->startSection('content'); ?>
    <style>
     body {
        zoom: 88%;
     }
 

     .record-group {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 1rem;
     }
 

     .record-group h3 {
        font-size: 1.125rem;
        margin-bottom: 1rem;
     }
 

     .modal-dialog-scrollable .modal-content {
        max-height: 90vh;
     }
 

     .modal-xl {
        max-width: 1140px;
     }
 

     .modal-backdrop {
        background-color: transparent;
     }
 

     /* Add this line */
    </style>
    <div class="container mx-auto mt-4 p-4">
     <div class="card shadow-sm">
        <div class="card-body">
         <h5 class="card-title"><?php echo e(__('Sub-Applications')); ?></h5>
         <table id="subRecordsTable" class="table table-striped dt-responsive nowrap" style="width:100%">
            <thead>
             <tr>
            
                <th style="text-transform: none;">Main Application ID</th>
                <th style="text-transform: none;">fileno</th>
                <th style="text-transform: none;">Owner Name</th>
                <th style="text-transform: none;">Phone Number</th>
                <th style="text-transform: none;">Application Status</th>
                <th style="text-transform: none;">Actions</th>
             </tr>
            </thead>
            <tbody>
             <?php $__currentLoopData = $subApplications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subApplication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                 
                 <td>STM-2025-000<?php echo e($subApplication->main_application_id); ?></td>
                 <td><?php echo e($subApplication->fileno); ?></td>
                 <td> <?php if($subApplication->multiple_owners_names): ?>
                    <?php
                     $ownerNames = json_decode($subApplication->multiple_owners_names);
                    ?>
                    <?php if(is_array($ownerNames)): ?>
                     <?php echo e(implode(', ', $ownerNames)); ?>

                    <?php else: ?>
                     <?php echo e($subApplication->multiple_owners_names); ?>

                    <?php endif; ?>
                   <?php elseif($subApplication->corporate_name): ?>
                    <?php echo e($subApplication->corporate_name); ?>

                   <?php else: ?>
                    <?php echo e($subApplication->first_name); ?> <?php echo e($subApplication->middle_name); ?> <?php echo e($subApplication->surname); ?>

                   <?php endif; ?></td>
                 <td><?php echo e($subApplication->phone_number); ?></td>
                 <td><?php echo e($subApplication->application_status); ?></td>
                 <td>
                    <div class="d-flex flex-column">
                     <a href=" " class="btn btn-info mb-1"  disabled>
                        <i class="fa fa-th"></i> Action
                     </a>
                     <!-- New Certificate Button -->
                     <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal"
                        data-bs-target="#certificateModal<?php echo e($subApplication->id); ?>">
                        Certificate
                     </button>
                     <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal"
                        data-bs-target="#viewPrintAcceptanceModal<?php echo e($subApplication->id); ?>">
                        View & Print Acceptance
                     </button>
                    </div>
                 </td>
                </tr>
 
              
                <!-- Certificate Modal -->
                <div class="modal" id="certificateModal<?php echo e($subApplication->id); ?>" tabindex="-1"
                 aria-labelledby="certificateModalLabel<?php echo e($subApplication->id); ?>" aria-hidden="true">
                 <div class="modal-dialog  modal-dialog-centered modal-lg">
                    <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="certificateModalLabel<?php echo e($subApplication->id); ?>">Certificate Actions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div class="container">
                         <div class="row row-cols-2 g-4">
                            <div class="col">
                             <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal"
                                data-bs-target="#viewTDPModal<?php echo e($subApplication->id); ?>">
                                <i class="fa fa-eye"></i> View TDP
                             </button>
                            </div>
                            <div class="col">
                             <button type="button" class="btn btn-secondary btn-sm w-100" data-bs-toggle="modal"
                                data-bs-target="#printTDPModal<?php echo e($subApplication->id); ?>">
                                <i class="fa fa-print"></i> Print TDP
                             </button>
                            </div>
                            <div class="col">
                             <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal"
                                data-bs-target="#viewCofOModal<?php echo e($subApplication->id); ?>">
                                <i class="fa fa-eye"></i> View CofO
                             </button>
                            </div>
                            <div class="col">
                             <button type="button" class="btn btn-secondary btn-sm w-100" data-bs-toggle="modal"
                                data-bs-target="#printCofOModal<?php echo e($subApplication->id); ?>">
                                <i class="fa fa-print"></i> Print CofO
                             </button>
                            </div>
                            <!-- Add more buttons as needed -->
                         </div>
                        </div>
                     </div>
                    </div>
                 </div>
                </div>
 
                  <!-- View TDP Modal -->
 

                <div class="modal fade" id="viewTDPModal<?php echo e($subApplication->id); ?>" tabindex="-1"
                 aria-labelledby="viewTDPModalLabel<?php echo e($subApplication->id); ?>" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                    <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="viewTDPModalLabel<?php echo e($subApplication->id); ?>">View TDP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div id="viewTDPContainer<?php echo e($subApplication->id); ?>" style="height: 80vh;"></div>
                     </div>
                    </div>
                 </div>
                </div>
 

             
                 <!-- Print TDP Modal -->
                <div class="modal fade" id="printTDPModal<?php echo e($subApplication->id); ?>" tabindex="-1"
                 aria-labelledby="printTDPModalLabel<?php echo e($subApplication->id); ?>" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                    <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="printTDPModalLabel<?php echo e($subApplication->id); ?>">Print TDP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div id="printTDPContainer<?php echo e($subApplication->id); ?>" style="height: 80vh;"></div>
                     </div>
                    </div>
                 </div>
                </div>
 

                <!-- View CofO Modal -->
                <div class="modal fade" id="viewCofOModal<?php echo e($subApplication->id); ?>" tabindex="-1"
                 aria-labelledby="viewCofOModalLabel<?php echo e($subApplication->id); ?>" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                    <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="viewCofOModalLabel<?php echo e($subApplication->id); ?>">View CofO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div id="viewCofOContainer<?php echo e($subApplication->id); ?>" style="height: 80vh;"></div>
                     </div>
                    </div>
                 </div>
                </div>
 

                <!-- Print CofO Modal -->
                <div class="modal fade" id="printCofOModal<?php echo e($subApplication->id); ?>" tabindex="-1"
                 aria-labelledby="printCofOModalLabel<?php echo e($subApplication->id); ?>" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                    <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="printCofOModalLabel<?php echo e($subApplication->id); ?>">Print CofO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div id="printCofOContainer<?php echo e($subApplication->id); ?>" style="height: 80vh;"></div>
                     </div>
                    </div>
                 </div>
                </div>
 

 

                <!-- View & Print Acceptance Modal -->
                <div class="modal fade" id="viewPrintAcceptanceModal<?php echo e($subApplication->id); ?>" tabindex="-1"
                 aria-labelledby="viewPrintAcceptanceModalLabel<?php echo e($subApplication->id); ?>" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="viewPrintAcceptanceModalLabel<?php echo e($subApplication->id); ?>">View & Print
                         Acceptance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div class="container">
                         <iframe id="acceptanceIframe<?php echo e($subApplication->id); ?>"
                            src="<?php echo e(route('sectionaltitling.AcceptLetter')); ?>" style="width:100%; height:500px;"
                            frameborder="0"></iframe>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary"
                         onclick="printIframe('acceptanceIframe<?php echo e($subApplication->id); ?>')">Print</button>
                     </div>
                    </div>
                 </div>
                </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 

            </tbody>
         </table>
        </div>
     </div>
    </div>
    <center>
 

    </center>
 

 

    <script>
     function printIframe(frameId) {
        const iframe = document.getElementById(frameId);
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
     }
    </script>
 

 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.8/pdfobject.min.js"></script>
    <script>
     <?php $__currentLoopData = $subApplications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subApplication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        // Initialize PDFObject for each modal
        PDFObject.embed("<?php echo e(asset('storage/uploads/Sectional Title TDP for Usamn Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf')); ?>",
         "#viewTDPContainer<?php echo e($subApplication->id); ?>");
        PDFObject.embed("<?php echo e(asset('storage/uploads/Sectional Title TDP for Usamn Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf')); ?>",
         "#printTDPContainer<?php echo e($subApplication->id); ?>");
        PDFObject.embed("<?php echo e(asset('storage/uploads/Sectional Title CofO for Usman Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf')); ?>",
         "#viewCofOContainer<?php echo e($subApplication->id); ?>");
        PDFObject.embed("<?php echo e(asset('storage/uploads/Sectional Title CofO for Usman Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf')); ?>",
         "#printCofOContainer<?php echo e($subApplication->id); ?>");
 

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
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
 

 <?php $__env->stopSection(); ?>
 

 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 <script>
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
 </script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/sectionaltitling/sub_applications.blade.php ENDPATH**/ ?>