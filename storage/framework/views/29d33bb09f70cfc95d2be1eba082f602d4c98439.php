

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('APPLICATION FOR SECTIONAL TITLING COMMERCIAL MODULE')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('APPLICATION FOR SECTIONAL TITLING COMMERCIAL MODULE')); ?></li>
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.14/iconfont/material-icons.min.css">
    
    
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

        input,
        textarea,
        select {
            text-transform: uppercase;
        }
       
 
        .button-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    justify-content: center;
    width: fit-content;
    margin: 0 auto;
}

.bttn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    color: #4a5568;
    background-color: white;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 10px;
    border: none;
    cursor: pointer;
    width: 180px;
    height: 40px;
    text-align: left;
}

.bttn i {
    margin-left: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
}

/* Hover effects with icon-specific glows */
.bttn:hover {
    transform: translateY(-2px);
}

.bttn:hover[onclick*="finance"] {
    box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
}

.bttn:hover[onclick*="planning"] {
    box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);
}

.bttn:hover[onclick*="survey"] {
    box-shadow: 0 4px 8px rgba(255, 152, 0, 0.3);
}

.bttn:hover[onclick*="lands"] {
    box-shadow: 0 4px 8px rgba(156, 39, 176, 0.3);
}

.bttn:hover[onclick*="generateBettermentBill"] {
    box-shadow: 0 4px 8px rgba(233, 30, 99, 0.3);
}

.bttn:hover[onclick*="generateBill"] {
    box-shadow: 0 4px 8px rgba(63, 81, 181, 0.3);
}
   
    </style>

    <div class="container mx-auto mt-4 p-4">

        <div class="container">


            <div class="d-flex justify-content-between mb-3">
                <a href="<?php echo e(route('sectionaltitling.create')); ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Create Application
                </a>
                <a href="<?php echo e(route('sectionaltitling.sub_applications')); ?>" class="btn btn-secondary">
                    <i class="fa fa-list"></i> View Sub Applications
                </a>
            </div>
            <div>
                <div class="card shadow-sm" style="width:100%">




                    <div class="card-body">
                        <h5 class="card-title">Sectional Titling Applications</h5>
                        <table id="recordsTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="text-transform: none;">Application ID</th>
                                    <th style="text-transform: none;">File No</th>
                                    <th style="text-transform: none;">Original Owner Name</th>
                                    <th style="text-transform: none;">Date</th>
                                    <th style="text-transform: none;">Planning Rec.</th>
                                    <th style="text-transform: none;">Application Status</th>
                                    
                                    <th style="text-transform: none;">Phone</th>
                                    <th style="text-transform: none;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $Main_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>STM-2025-000-<?php echo e($application->id); ?></td>
                                        <td><?php echo e($application->fileno); ?></td>
                                        <td>
                                            <?php if($application->multiple_owners_names): ?>
                                                <?php echo e($application->multiple_owners_names); ?>

                                            <?php elseif($application->corporate_name): ?>
                                                <?php echo e($application->corporate_name); ?>

                                            <?php else: ?>
                                                <?php echo e($application->first_name); ?> <?php echo e($application->middle_name); ?>

                                                <?php echo e($application->surname); ?>

                                            <?php endif; ?>

                                        </td>
                                        <td><?php echo e($application->created_at); ?></td>
                                        
                                         <td><?php echo e($application->planning_recommendation_status); ?></td>
                                         <td><?php echo e($application->application_status); ?></td>
                                        <td><?php echo e($application->phone_number); ?></td>
                                        <td class="relative">
                                            <div class="relative inline-block">
                                                <!-- Dropdown Toggle Button -->
                                                <button onclick="toggleDropdown(this)" class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none border-2 border-gray-400">
                                                    <i class="fas fa-ellipsis-h text-gray-600"></i> <!-- Three Horizontal Dots Icon -->
                                                </button>
                                        
                                                <!-- Dropdown Menu -->
                                                <ul class="absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-lg hidden action-menu z-50">

                                                      <!-- New Planning Recommendation Item -->
                                                      <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center"
                                                            onclick="showDepartmentConfirmation('planningRec')"
                                                            data-id="<?php echo e($application->id); ?>">
                                                            <i class="fas fa-clipboard-check text-blue-500 mr-2"></i> Planning Recommendation
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center decision-mother-btn"
                                                            data-id="<?php echo e($application->id); ?>">
                                                            <i class="fas fa-check-circle text-green-500 mr-2"></i> Director's Approval
                                                        </button>
                                                    </li>
                                                    
                                                    <?php if($application->application_status == 'Approved'): ?>
                                                        <li>
                                                            <a href="<?php echo e(route('sectionaltitling.sub_application', [
                                                                'application_id' => $application->id,
                                                                'owner_name' => $application->corporate_name
                                                                    ? $application->corporate_name
                                                                    : ($application->multiple_owners_names
                                                                        ? $application->multiple_owners_names
                                                                        : $application->first_name . ' ' . $application->middle_name . ' ' . $application->surname),
                                                                'fileno' => $application->fileno,
                                                                'passport' => $application->passport,
                                                                'formID' => $application->id,
                                                                'address' => $application->address,
                                                                'plot_house_no' => $application->plot_house_no,
                                                                'plot_plot_no' => $application->plot_plot_no,
                                                                'plot_street_name' => $application->plot_street_name,
                                                                'plot_district' => $application->plot_district,
                                                                'property_location' =>
                                                                    $application->plot_district . ' ' . $application->plot_street_name . ' ' . $application->plot_plot_no,
                                                            ])); ?>" class="block px-4 py-2 hover:bg-gray-100 flex items-center">
                                                                <i class="fas fa-plus-square text-green-500 mr-2"></i> Create ST Record
                                                            </a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li class="opacity-50 cursor-not-allowed">
                                                            <a href="#" class="block px-4 py-2 flex items-center">
                                                                <i class="fas fa-plus-square text-gray-500 mr-2"></i> Create ST Record (Disabled)
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                        
                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center open-actions-modal"
                                                            data-id="<?php echo e($application->id); ?>" data-bs-toggle="modal" data-bs-target="#actionsModal">
                                                            <i class="fas fa-th-large text-red-500 mr-2"></i> Actions
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center"
                                                            data-bs-toggle="modal" data-bs-target="#viewActionsModal">
                                                            <i class="fas fa-eye text-yellow-500 mr-2"></i> View Receipt & Plans
                                                        </button>
                                                    </li>
                                                    <li>
                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Actions Modal -->
           <!-- MODAL -->

        <div class="modal fade" id="actionsModal" tabindex="-1" aria-labelledby="actionsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width:400px;">
            <div class="modal-content">
                <div class="modal-header" style="height: 30px;">
                <h5 class="modal-title" id="actionsModalLabel">Available Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body" style="background-color: #f1f1f1;">
                <style>
                    .button-grid .bttn {
                    padding: 6px 12px;
                    font-size: 10px;
                    white-space: nowrap;
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 40px;
                    }
                    .button-grid {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 10px;
                    justify-content: center;
                    }
                    .bttn i {
                    margin-left: 8px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    }
                </style>
                <div>
                    <div class="button-grid">
                    <!-- Row 1 -->
                    <button class="bttn purple-shadow" onclick="showDepartmentConfirmation('finance')">
                        Payments
                        <i class="material-icons" style="color: #4CAF50;">payments</i>
                    </button>
                    <button class="bttn" onclick="showDepartmentConfirmation('planning')">
                        Physical Planning
                        <i class="material-icons" style="color: #2196F3;">location_city</i>
                    </button>
                    <button class="bttn pink-shadow" onclick="showDepartmentConfirmation('survey')">
                        Survey
                        <i class="material-icons" style="color: #FF9800;">map</i>
                    </button>
                    <button class="bttn purple-shadow" onclick="showDepartmentConfirmation('lands')">
                        Lands
                        <i class="material-icons" style="color: #9C27B0;">landscape</i>
                    </button>
                    <button class="bttn pink-shadow"
                        data-id="<?php echo e($application->id); ?>"
                        data-fileno="<?php echo e($application->fileno); ?>"
                        data-applicant_title="<?php echo e($application->applicant_title); ?>"
                        data-owner-name="<?php echo e($application->corporate_name ?? $application->multiple_owners_names ?? ($application->first_name . ' ' . $application->middle_name . ' ' . $application->surname)); ?>"
                        data-plot-house-no="<?php echo e($application->plot_house_no); ?>"
                        data-plot-street-name="<?php echo e($application->plot_street_name); ?>"
                        data-owner-district="<?php echo e($application->owner_district); ?>"
                        data-approval-date="<?php echo e($application->approval_date); ?>"
                        data-address="<?php echo e($application->address); ?>"
                        data-plot_size="<?php echo e($application->plot_size); ?>"
                        data-land_use="<?php echo e($application->land_use); ?>"
                        onclick="showDepartmentConfirmation('generateBettermentBill')">
                        GEN BETTERMENT FEE
                        <i class="material-icons" style="color: #E91E63;">receipt_long</i>
                    </button>
                    <button class="bttn blue-shadow" onclick="showDepartmentConfirmation('generateBill')">
                        Generate Final Bill
                        <i class="material-icons" style="color: #3F51B5;">receipt</i>
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>



  
 
<div class="modal fade" id="generateBettermentBillModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Betterment Fee Bill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="bettermentPdfViewer" style="width:100%; height:600px;"></div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.min.js"></script>
                <script>
                    PDFObject.embed("<?php echo e(asset('storage/uploads/betterment_bill.pdf')); ?>", "#bettermentPdfViewer");
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printBettermentBill()">Print Betterment Bill</button>
            </div>
        </div>
    </div>
</div>
<script>
    function printBettermentBill() {
        const pdfFrame = document.createElement('iframe');
        pdfFrame.style.display = 'none';
        pdfFrame.src = "<?php echo e(asset('storage/uploads/betterment_bill.pdf')); ?>";
        document.body.appendChild(pdfFrame);
        pdfFrame.contentWindow.focus();
        pdfFrame.contentWindow.print();
        document.body.removeChild(pdfFrame);
    }
</script>

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
                                    <div class="col">
                                        <button type="button" class="btn btn-primary w-100"
                                            data-bs-toggle="modal" data-bs-target="#viewSurveyPlanModal">
                                            <i class="fa fa-eye"></i><br>View Survey Plan
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-success w-100"
                                            data-bs-toggle="modal" data-bs-target="#viewArchitecturalDesignModal">
                                            <i class="fa fa-eye"></i><br>View Architectural Design
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <button type="button" class="btn btn-warning w-100"
                                            data-bs-toggle="modal" data-bs-target="#viewReceiptModal">
                                            <i class="fa fa-eye"></i><br>View Receipt
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-info w-100" 
                                            data-bs-toggle="modal" data-bs-target="#viewLandModal">
                                            <i class="fa fa-eye"></i><br>View Scanned File
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <button type="button" class="btn btn-danger w-100"
                                            data-bs-toggle="modal" data-bs-target="#viewBettermentBillModal">
                                            <i class="fa fa-file-invoice"></i><br>Betterment Bill
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-secondary w-100"
                                            data-bs-toggle="modal" data-bs-target="#viewFinalBillModal">
                                            <i class="fa fa-file-invoice-dollar"></i><br>Final Bill
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <center>
                                <img src="https://i.ibb.co/8gxB59Cs/Whats-App-Image-2025-03-15-at-7-43-13-PM.jpg"
                                    class="img-fluid" alt="Survey Plan" style="cursor: zoom-in;">
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <center>
                                <img src="https://i.ibb.co/fd6bqjyH/Whats-App-Image-2025-03-15-at-7-43-51-PM.jpg"
                                    class="img-fluid d-block mx-auto zoomable" alt="Architectural Design"
                                    style="cursor: zoom-in;">
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <center>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="pdf-viewer" style="width:100%; height:600px;"></div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.min.js"></script>
                            <script>
                                PDFObject.embed("<?php echo e(asset('storage/uploads/PAL526.pdf')); ?>", "#pdf-viewer");
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="financeForm">

                                <div class="mb-3">
                                    <label class="form-label">Receipt No</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Decision</label>
                                    <select class="form-select" required>
                                        <option value="" disabled selected>Select Decision</option>
                                        <option value="approve">Approve</option>
                                        <option value="decline">Decline</option>
                                    </select>
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
                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                                    <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        OK
                                        <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                                    </button>
                                    <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                        Edit
                                        <i class="material-icons" style="color: #9E9E9E;">edit</i>
                                    </button>
                                    <button type="button" class="bttn blue-shadow" onclick="showDepartmentConfirmation('planningRec')" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                        Planning Rec.
                                        <i class="material-icons" style="color: #2196F3;">assignment</i>
                                    </button>
                                    <button type="button" class="bttn yellow-shadow" onclick="showDepartmentConfirmation('architectural')" style="box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);">
                                        Arch. Design
                                        <i class="material-icons" style="color: #FFC107;">architecture</i>
                                    </button>
                                    <button type="submit" class="bttn green-shadow" disabled style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        Submit
                                        <i class="material-icons" style="color: #4CAF50;">send</i>
                                    </button>
                                </div>
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
                                    <label class="form-label">Decision</label>
                                    <select class="form-select" required>
                                        <option value="" disabled selected>Select Decision</option>
                                        <option value="approve">Approve</option>
                                        <option value="decline">Decline</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Approved By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                            <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                OK
                                <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                            </button>
                            <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                Edit
                                <i class="material-icons" style="color: #9E9E9E;">edit</i>
                            </button>
                            <button type="button" class="bttn blue-shadow" onclick="showDepartmentConfirmation('planningRec')" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                Planning Rec.
                                <i class="material-icons" style="color: #2196F3;">assignment</i>
                            </button>
                            <button type="button" class="bttn yellow-shadow" onclick="showDepartmentConfirmation('architectural')" style="box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);">
                                Arch. Design
                                <i class="material-icons" style="color: #FFC107;">architecture</i>
                            </button>
                            <button type="submit" class="bttn green-shadow" disabled style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                Submit
                                <i class="material-icons" style="color: #4CAF50;">send</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

             
            <div class="modal fade" id="surveyModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Survey Department Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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

                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                                    <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        OK
                                        <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                                    </button>
                                    <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                        Edit
                                        <i class="material-icons" style="color: #9E9E9E;">edit</i>
                                    </button>
                                    <button type="button" class="bttn blue-shadow" onclick="showDepartmentConfirmation('planningRec')" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                        Planning Rec.
                                        <i class="material-icons" style="color: #2196F3;">assignment</i>
                                    </button>
                                    <button type="button" class="bttn yellow-shadow" onclick="showDepartmentConfirmation('architectural')" style="box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);">
                                        Arch. Design
                                        <i class="material-icons" style="color: #FFC107;">architecture</i>
                                    </button>
                                    <button type="submit" class="bttn green-shadow" disabled style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        Submit
                                        <i class="material-icons" style="color: #4CAF50;">send</i>
                                    </button>
                                </div>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                                    <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        OK
                                        <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                                    </button>
                                    <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                        Edit
                                        <i class="material-icons" style="color: #9E9E9E;">edit</i>
                                    </button>
                                    <button type="button" class="bttn blue-shadow" onclick="showDepartmentConfirmation('planningRec')" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                        Planning Rec.
                                        <i class="material-icons" style="color: #2196F3;">assignment</i>
                                    </button>
                                    <button type="button" class="bttn yellow-shadow" onclick="showDepartmentConfirmation('architectural')" style="box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);">
                                        Arch. Design
                                        <i class="material-icons" style="color: #FFC107;">architecture</i>
                                    </button>
                                    <button type="submit" class="bttn green-shadow" disabled style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        Submit
                                        <i class="material-icons" style="color: #4CAF50;">send</i>
                                    </button>
                                </div>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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

                                <div class="mb-3">
                                    <label class="form-label">Submit architectural design?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="submit_design" id="submit_yes" value="yes" required>
                                        <label class="form-check-label" for="submit_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="submit_design" id="submit_no" value="no">
                                        <label class="form-check-label" for="submit_no">No</label>
                                    </div>
                                </div>

                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                                    <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        OK
                                        <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                                    </button>
                                    <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                        Edit
                                        <i class="material-icons" style="color: #9E9E9E;">edit</i>
                                    </button>
                                    <button type="button" class="bttn blue-shadow" onclick="showDepartmentConfirmation('planningRec')" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                        Planning Rec.
                                        <i class="material-icons" style="color: #2196F3;">assignment</i>
                                    </button>
                                    <button type="button" class="bttn yellow-shadow" onclick="showDepartmentConfirmation('architectural')" style="box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);">
                                        Arch. Design
                                        <i class="material-icons" style="color: #FFC107;">architecture</i>
                                    </button>
                                    <button type="submit" class="bttn green-shadow" disabled style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        Submit
                                        <i class="material-icons" style="color: #4CAF50;">send</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Generate Bill Modal -->
            <div class="modal fade" id="generateBillModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Generate Bill</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="billContent">
                                <iframe src="<?php echo e(route('sectionaltitling.generate_bill')); ?>" style="width: 100%; height: 600px;" id="billFrame"></iframe>
                            </div>
                        </div>
                        <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                            <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                Close
                                <i class="material-icons" style="color: #9E9E9E;">close</i>
                            </button>
                            <button type="button" class="bttn blue-shadow" onclick="printBill()" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                Print Bill
                                <i class="material-icons" style="color: #3F51B5;">print</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add E-Registry Modal -->
            <div class="modal fade" id="eRegistryModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">E-Registry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="eRegistryForm">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">E-Registry ID</label>
                                            <input type="text" class="form-control" value="26"  disabled>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">FILE NAME</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Fileno</label>
                                            <input type="text" class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">File Location</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">File Commissioning Date</label>
                                            <input type="date" class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Decommissioning Date</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                                    <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        OK
                                        <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                                    </button>
                                    <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                        Edit
                                        <i class="material-icons" style="color: #9E9E9E;">edit</i>
                                    </button>
                                    <button type="button" class="bttn blue-shadow" onclick="showDepartmentConfirmation('planningRec')" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                        Planning Rec.
                                        <i class="material-icons" style="color: #2196F3;">assignment</i>
                                    </button>
                                    <button type="button" class="bttn yellow-shadow" onclick="showDepartmentConfirmation('architectural')" style="box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);">
                                        Arch. Design
                                        <i class="material-icons" style="color: #FFC107;">architecture</i>
                                    </button>
                                    <button type="submit" class="bttn green-shadow" disabled style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);">
                                        Submit
                                        <i class="material-icons" style="color: #4CAF50;">send</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Record Details Modal -->
            <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="recordModalLabel">INSTRUMENT DETAILS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                function printBill() {
                    const iframe = document.getElementById('billFrame');
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();
                }

                $(document).ready(function() {
                    $('#recordsTable').DataTable({
                        responsive: true,
                        pageLength: 30,
                        lengthMenu: [5, 10, 30, 50, 100],
                        columnDefs: [{
                                responsivePriority: 1,
                                targets: [0, 3, 4]
                            },
                            {
                                responsivePriority: 2,
                                targets: [1, 2]
                            }
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

                    $('.generate-bill').on('click', function() {
                        const applicationId = $(this).data('id');
                        const fileno = $(this).data('fileno');
                        const applicantTitle = $(this).data('applicant_title');
                        const ownerName = $(this).data('owner-name');
                        const plotHouseNo = $(this).data('plot-house-no');
                        const plotStreetName = $(this).data('plot-street-name');
                        const ownerDistrict = $(this).data('owner-district');
                        const address = $(this).data('address');
                        const approvalDate = $(this).data('approval-date');
                        const plotSize = $(this).data('plot_size');
                        const landUse = $(this).data('land_use');

                        const url = `<?php echo e(route('sectionaltitling.generate_bill')); ?>?id=${applicationId}&fileno=${fileno}&applicant_title=${applicantTitle}&owner_name=${ownerName}&address=${address}&plot_house_no=${plotHouseNo}&plot_street_name=${plotStreetName}&owner_district=${ownerDistrict}&approval_date=${approvalDate}&plot_size=${plotSize}&land_use=${landUse}`;
                        $('#billFrame').attr('src', url);
                        $('#generateBillModal').modal('show');
                    });

                    // Add this inside the existing document.ready function
                    $('input[name="submit_design"]').change(function() {
                        $('#architecturalSubmitBtn').prop('disabled', this.value === 'no');
                    });

                });

                function showDepartmentConfirmation(department) {
                    if (department === 'planningRec') {
                        $('#planningRecommendationModal').modal('show');
                        return;
                    }
                    const departmentNames = {
                        finance: 'Finance',
                        planning: 'Physical Planning',
                        knupda: 'KNUPDA',
                        survey: 'Survey',
                        Lands: 'Lands',
                        architectural: 'Architectural Design',
                        generateBill: 'Generate Bill'
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
                ['finance', 'planning', 'knupda', 'survey', 'Lands', 'architectural', 'generateBill'].forEach(dept => {
                    $(`#${dept}Form`).on('submit', function(e) {
                        e.preventDefault();
                        $(`#${dept}Modal`).modal('hide');
                        Swal.fire('Success', 'Approval submitted successfully!', 'success');
                    });
                });



                function toggleDropdown(button) {
    let menu = button.nextElementSibling;
    document.querySelectorAll(".action-menu").forEach(m => {
        if (m !== menu) m.classList.add("hidden");
    });
    menu.classList.toggle("hidden");

    // Close dropdown when clicking outside
    document.addEventListener("click", function (event) {
        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add("hidden");
        }
    });
}

            </script>

            <!-- Global Decision Modal for Main Applications -->
            <div class="modal fade" id="decisionModalMother" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="decisionFormMother">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Decision</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="decisionMotherId">
                                <div class="mb-3">
                                    <label class="form-label">Decision</label><br>
                                    <input type="radio" name="decision" value="approve" id="dmmApprove" checked>
                                    <label for="dmmApprove">Approve</label>
                                    <input type="radio" name="decision" value="decline" id="dmmDecline" class="ms-3">
                                    <label for="dmmDecline">Decline</label>
                                </div>
                                <div class="mb-3" id="declineReasonMotherGroup" style="display:none;">
                                    <label for="declineReasonMother" class="form-label">Reason For Decline</label>
                                    <textarea class="form-control" id="declineReasonMother" name="comments"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="approvalDateMother" class="form-label">Approval Date</label>
                                    <input type="datetime-local" class="form-control" id="approvalDateMother" name="approval_date" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit Decision</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
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
                        const now = new Date().toISOString().slice(0,16);
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
                            url: "<?php echo e(route('sectionaltitling.decisionMotherApplication')); ?>",
                            type: 'POST',
                            data: {
                                id: id,
                                decision: decision,
                                approval_date: approval_date,
                                comments: comments,
                                _token: "<?php echo e(csrf_token()); ?>"
                            },
                            success: function(response) {
                                $('#decisionModalMother').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: (decision=='approve' ? 'Approved' : 'Declined'),
                                    text: response.message
                                }).then(() => { location.reload(); });
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
            </script>

    </div>        </div>
        </div>
    </div>

<!-- Planning Recommendation Modal -->
<div class="modal fade" id="planningRecommendationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Planning Recommendation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="planningRecommendationForm">
                     
                    <div class="mb-3">
                        <label class="form-label">Decision</label><br>
                        <input type="radio" name="decision" value="approve" id="prApprove" checked>
                        <label for="prApprove">Approve</label>
                        <input type="radio" name="decision" value="decline" id="prDecline" class="ms-3">
                        <label for="prDecline">Decline</label>
                    </div>
                    <div class="mb-3" id="declineReasonGroup" style="display:none;">
                        <label for="declineReason" class="form-label">Reason For Decline</label>
                        <textarea class="form-control" id="declineReason" name="comments"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="approvalDate" class="form-label">Approval/Decline Date</label>
                        <input type="datetime-local" class="form-control" id="approvalDate" name="approval_date" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-info" onclick="showPrintModal()">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Print Modal -->
<div class="modal fade" id="printModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Print Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="printContent">
                    <!-- Content from the screenshot goes here -->
                    <div class="print-section">
                        <p><strong>PERMANENT SECRETARY</strong></p>
                        <p>Kindly find Page 01 in an application for sectional titling in respect of a property (plaza) covered by Certificate of Occupancy No. COM/2025/0001 situated at Kantin Kwari market in the name of <strong>ABDULLAHI USMAN ADAMU</strong></p>
                        <p>As well as change of name to various shop owners as per attached on the application.</p>
                        <p>The application was referred to Physical Planning Department for planning, engineering as well as architectural views. Subsequently, the planners at page 01 recommended the application, because the application is feasible, and the shops meet the minimum requirements for commercial titles. Moreover, the proposals as submitted and conforms with the existing commercial development in the area.</p>
                        <p>However, the recommendation is based on the recommended site plan at page 01 and architectural design at page 01 and back cover with the following measurements:</p>
                        <p>Meanwhile, the title was granted for commercial purposes for a term of 40 years commencing from 01/01/2025 and has a residual term of 20 to expire.</p>
                        <p>In view of the above, you may kindly wish to recommend the following for approval of the Honorable Commissioner:</p>
                        <ol>
                            <li>Consider and approve the application for Sectional Titling over plot 01 situated at Kantin Kwari covered by Certificate of Occupancy No. COM/2025/0001 in favor of <strong>ABDULLAHI USMAN ADAMU</strong></li>
                            <li>Consider and approve the change of name of various shop owners as per provisions of the Bill.</li>
                            <li>Consider and approve the Revocation of old Certificate of Occupancy COM/2025/0001 to pave the way for new Sectional Titles to the new owners.</li>
                        </ol>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px;">
                            <div>
                                <p>Name:___________________________</p>
                                <p>Rank: ___________________________</p>
                                <p>Sign: ___________________________</p>
                                <p>Date: ___________________________</p>
                            </div>
                            <div>
                         

                                <p>Counter Sign: ___________________________</p>
                                <p style="white-space: pre-line;">                  <strong>Director Section Titling</strong></p>
                                <p>Date: ___________________________</p>
                            </div>
                        </div>
                        <div style="margin-top: 20px;">
                            <p><strong>HONOURABLE COMMISSIONER</strong></p>
                            <hr style="width: 100%; text-align: left; margin-left: 0;">
                            <p>The application is hereby recommended for your kind approval, please.</p>
                            <br>
                            <p>Date: ______2025.</p>
                        </div>
                            <div style=" justify-content: end;">
                                <div style="text-align: right;">
                            <p>___________________________</p>
                            <p><strong>Permanent Secretary</strong></p>
                            </div>
                            </div>
                            
                        
                        <div style="margin-top: 20px;">
                            <p><strong>PERMANENT SECRETARY</strong></p>
                            <hr style="width: 100%; text-align: left; margin-left: 0;">
                            <p>The application is hereby APPROVED/NOT APPROVED.</p>
                            <p>Date: __________________2025.</p>
                            <div style="text-align: right;">
                            <p>___________________________</p>
                            <p> <strong>HONOURABLE COMMISSIONER. </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printContent()">Print</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showPrintModal() {
        $('#printModal').modal('show');
    }

    function printContent() {
        var printContents = document.getElementById('printContent').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>

<script>
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
            const now = new Date().toISOString().slice(0,16);
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/sectionaltitling/index.blade.php ENDPATH**/ ?>