

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Instruments Registration Module')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Instruments Registration Module')); ?></li>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

<div class="container mx-auto mt-4 p-4">
     
     

    <!-- Button to open the modal -->
    <button id="registerButton" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Register New Instrument</button>

  
     
 <hr>
 <br>
 <div class="container">
 
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    
  
    
    <!-- Custom CSS -->
    <style>
        body {
  zoom: 90%;
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
        .record-field {
            margin-bottom: 0.75rem;
        }
        .record-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6c757d;
        }
        .record-value {
            font-size: 0.875rem;
        }
        .modal-dialog-scrollable .modal-content {
            max-height: 90vh;
        }
        .modal-xl {
            max-width: 1140px;
        }
    </style>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <div class="container py-4">
       
        
        <div class="card shadow-sm">
            <div class="card-body" style="width:100%">
                <!-- Simplified Table with fewer columns -->
                <table id="recordsTable" class="table table-striped dt-responsive nowrap" >
                    <thead>
                        <tr>
                        <th style="text-transform: none;">File No</th>
                        <th style="text-transform: none;">Grantor</th>
                        <th style="text-transform: none;">Grantee</th>
                        <th style="text-transform: none;">Registration Date</th>
                        <th style="text-transform: none;">Transaction Type</th>
                        <th style="text-transform: none;">Entry Date</th>
                        <th style="text-transform: none;">Plot Description</th>
                        <th style="text-transform: none;">Reg No</th>
                        <th style="text-transform: none;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $instruments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instrument): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($instrument->fileNoPrefix ?? 'N/A'); ?>0<?php echo e($instrument->fileNumber ?? 'N/A'); ?></td>
                                <td><?php echo e($instrument->GrantorName ?? 'N/A'); ?></td>
                                <td><?php echo e($instrument->GranteeName ?? 'N/A'); ?></td>
                        
                                <td><?php echo e($instrument->instrumentDate ?? 'N/A'); ?></td>
                                <td><?php echo e($instrument->instrumentName ?? 'N/A'); ?></td>
                                <td><?php echo e($instrument->instrumentDate ?? 'N/A'); ?></td>
                                <td><?php echo e($instrument->propertyDescription ?? 'N/A'); ?></td>
                                <td><?php echo e($instrument->regNo ?? 'N/A'); ?></td>
                            <td>
                                <button type="button" class="btn btn-info open-actions-modal" data-bs-toggle="modal" data-bs-target="#actionsModal" data-id="<?php echo e($instrument->id ?? ''); ?>">
                                    <i class="fa fa-th"></i> Actions
                                </button>
                            </td>

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
                                          <!-- 1st Row -->
                                          <div class="col-3 text-center mb-3">
                                            <button type="button" class="btn btn-primary w-100 view-record" data-id="<?php echo e($instrument->id ?? ''); ?>">
                                              <i class="fa fa-eye"></i><br>View
                                            </button>
                                          </div>
                                          <div class="col-3 text-center mb-3">
                                            <button type="button" class="btn btn-success w-100">
                                              <i class="fa fa-edit"></i><br>Edit
                                            </button>
                                          </div>
                                          <div class="col-3 text-center mb-3">
                                                                                
<form action="<?php echo e(route('instruments.update', $instrument->id ?? 0)); ?>" method="POST" onsubmit="return false;" id="generateForm">
    <?php echo csrf_field(); ?>
    <input type="hidden" id="particularsRegistrationNumber" name="particularsRegistrationNumber" class="" value="<?php echo e($particularsRegistrationNumber); ?>">
    <button type="button" class="btn btn-warning w-100 generate-particulars" onclick="confirmGenerate()">
        <i class="fa fa-address-card"></i><br> Generate Reg No
    </button>
</form>

<script>
function confirmGenerate() {
    Swal.fire({
        title: 'Generate Registration Number?',
        text: "Are you sure you want to generate a new registration number?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, generate it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('generateForm').submit();
        }
    });
}
</script>
                                        </div>
                                          <div class="col-3 text-center mb-3">
                                            <?php if(!$instrument->particularsRegistrationNumber): ?>
                                              <button class="btn w-100" style="background-color: #bbbbbb; color: white;" disabled>
                                                <i class="fa fa-print"></i><br>Print CoR
                                              </button>
                                            <?php else: ?>
                                              <a href="<?php echo e(route('instruments.Coroi')); ?>" class="btn btn-secondary w-100">
                                                <i class="fa fa-print"></i><br>Print CoR
                                              </a>
                                            <?php endif; ?>
                                          </div>

                                          <!-- 2nd Row -->
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

                                          <!-- 3rd Row -->
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

                                          <!-- 4th Row -->
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
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Record Details Modal -->
    <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <H5 CLASS="MODAL-TITLE" ID="RECORDMODALLABEL">INSTRUMENT DETAILS</H5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="recordDetails">
                        <!-- Modal content will be loaded here dynamically -->
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
            // Initialize DataTables
            $('#recordsTable').DataTable({
                responsive: true,
                pageLength: 100,
                lengthMenu: [100, 5, 10, 25, 50],
                columnDefs: [
                    { responsivePriority: 1, targets: [0, 3, 4] }, // File No, Instrument Name, Actions
                    { responsivePriority: 2, targets: [1, 2] }, // File Suffix, Reg No
                ]
            });
            
            // Handle View Record button click
            $('.view-record').on('click', function() {
                const recordId = $(this).data('id');
                
                // In a real application, you would fetch the record details via AJAX
                // For this example, we'll use the data already in the page
                const row = $(this).closest('tr');
                const fileNumber = row.find('td:eq(0)').text();
                const instrumentName = row.find('td:eq(3)').text();
                
                // Set modal title
                //$('#recordModalLabel').text('Record Details: ' + fileNumber + ' - ' + instrumentName);
                
                // Get all data for this record
                // In a real application, you would fetch this via AJAX
                // For this example, we'll simulate it with the data from the current row
                
                // Find the matching record in the original data
                <?php $__currentLoopData = $instruments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instrument): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    if (<?php echo e($instrument->id ?? 0); ?> == recordId) {
                        // Build the record details HTML
                        let detailsHtml = `
                            <div class="record-group">
                                <h3>Basic Information</h3>
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">NewKANGISFileno</div>
                                            <div class="record-value"><?php echo e($instrument->fileNoPrefix ?? 'N/A'); ?>0<?php echo e($instrument->fileNumber ?? 'N/A'); ?></div>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">kangisFileNo</div>
                                            <div class="record-value">N/A</div>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">mlsfNo</div>
                                            <div class="record-value">N/A</div>
                                        </div>
                                    </div>



                                  
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Registration Number</div>
                                            <div class="record-value"><?php echo e($instrument->regNo ?? 'N/A'); ?></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Particulars Reg No</div>
                                            <div class="record-value"><?php echo e($instrument->particularsRegistrationNumber ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                              <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Root Title Reg Particulars</div>
                                            <div class="record-value"><?php echo e($instrument->RootTitleRegNo ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Instrument Name</div>
                                            <div class="record-value"><?php echo e($instrument->instrumentName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Instrument Date</div>
                                            <div class="record-value"><?php echo e($instrument->instrumentDate ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-group">
                                <h3>Grantor/Grantee Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Grantor Name</div>
                                            <div class="record-value"><?php echo e($instrument->GrantorName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Grantor Address</div>
                                            <div class="record-value"><?php echo e($instrument->GrantorAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Grantee Name</div>
                                            <div class="record-value"><?php echo e($instrument->GranteeName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Grantee Address</div>
                                            <div class="record-value"><?php echo e($instrument->GranteeAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-group">
                                <h3>Mortgage Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Mortgagor Name</div>
                                            <div class="record-value"><?php echo e($instrument->mortgagorName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Mortgagor Address</div>
                                            <div class="record-value"><?php echo e($instrument->mortgagorAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Mortgagee Name</div>
                                            <div class="record-value"><?php echo e($instrument->mortgageeName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Mortgagee Address</div>
                                            <div class="record-value"><?php echo e($instrument->mortgageeAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Loan Amount</div>
                                            <div class="record-value"><?php echo e($instrument->loanAmount ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Interest Rate</div>
                                            <div class="record-value"><?php echo e($instrument->interestRate ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Duration</div>
                                            <div class="record-value"><?php echo e($instrument->duration ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-group">
                                <h3>Assignment Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Assignor Name</div>
                                            <div class="record-value"><?php echo e($instrument->assignorName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Assignor Address</div>
                                            <div class="record-value"><?php echo e($instrument->assignorAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Assignee Name</div>
                                            <div class="record-value"><?php echo e($instrument->assigneeName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Assignee Address</div>
                                            <div class="record-value"><?php echo e($instrument->assigneeAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-group">
                                <h3>Lease Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Lessor Name</div>
                                            <div class="record-value"><?php echo e($instrument->lessorName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Lessor Address</div>
                                            <div class="record-value"><?php echo e($instrument->lessorAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Lessee Name</div>
                                            <div class="record-value"><?php echo e($instrument->lesseeName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Lessee Address</div>
                                            <div class="record-value"><?php echo e($instrument->lesseeAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Lease Period</div>
                                            <div class="record-value"><?php echo e($instrument->leasePeriod ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Lease Terms</div>
                                            <div class="record-value"><?php echo e($instrument->leaseTerms ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-group">
                                <h3>Property Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Property Description</div>
                                            <div class="record-value"><?php echo e($instrument->propertyDescription ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Property Address</div>
                                            <div class="record-value"><?php echo e($instrument->propertyAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Property Details</div>
                                            <div class="record-value"><?php echo e($instrument->propertyDetails ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Original Plot Details</div>
                                            <div class="record-value"><?php echo e($instrument->originalPlotDetails ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">New SubDivided Plot Details</div>
                                            <div class="record-value"><?php echo e($instrument->newSubDividedPlotDetails ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Merged Plot Information</div>
                                            <div class="record-value"><?php echo e($instrument->mergedPlotInformation ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Survey Plan No</div>
                                            <div class="record-value"><?php echo e($instrument->surveyPlanNo ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">LGA</div>
                                            <div class="record-value"><?php echo e($instrument->lga ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">District</div>
                                            <div class="record-value"><?php echo e($instrument->district ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Size</div>
                                            <div class="record-value"><?php echo e($instrument->size ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Plot Number</div>
                                            <div class="record-value"><?php echo e($instrument->plotNumber ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="record-group">
                                <h3>Other Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Surrendering Party Name</div>
                                            <div class="record-value"><?php echo e($instrument->surrenderingPartyName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Receiving Party Name</div>
                                            <div class="record-value"><?php echo e($instrument->receivingPartyName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Consideration Amount</div>
                                            <div class="record-value"><?php echo e($instrument->considerationAmount ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Changes Variations</div>
                                            <div class="record-value"><?php echo e($instrument->changesVariations ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Heir Beneficiary Details</div>
                                            <div class="record-value"><?php echo e($instrument->heirBeneficiaryDetails ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Original Property Owner Details</div>
                                            <div class="record-value"><?php echo e($instrument->originalPropertyOwnerDetails ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Assent Terms</div>
                                            <div class="record-value"><?php echo e($instrument->assentTerms ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Releasor Name</div>
                                            <div class="record-value"><?php echo e($instrument->releasorName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Releasee Name</div>
                                            <div class="record-value"><?php echo e($instrument->releaseeName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Release Terms</div>
                                            <div class="record-value"><?php echo e($instrument->releaseTerms ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Solicitor Name</div>
                                            <div class="record-value"><?php echo e($instrument->solicitorName ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Solicitor Address</div>
                                            <div class="record-value"><?php echo e($instrument->solicitorAddress ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Created At</div>
                                            <div class="record-value"><?php echo e($instrument->created_at ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="record-field">
                                            <div class="record-label">Updated At</div>
                                            <div class="record-value"><?php echo e($instrument->updated_at ?? 'N/A'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        $('#recordDetails').html(detailsHtml);
                        
                        // Show the modal
                        const recordModal = new bootstrap.Modal(document.getElementById('recordModal'));
                        recordModal.show();
                    }
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            });
        });

    
                                    
    </script>
  
  <?php echo $__env->make('instruments.instrument-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
 
    <!-- The Modal -->
  

   


    </div>
 
 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/instruments/index.blade.php ENDPATH**/ ?>