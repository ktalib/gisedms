

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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
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
                    
                    .payments .bttn {
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

                    .payments-grid {
                    display: grid;
                    grid-template-columns: repeat(1, 1fr);
                    gap: 10px;
                    justify-content: center;
                    }

                    .bttn i {
                    margin-left: 8px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    }
                    th {
                        font-size: bold;
                    }
       </style>
    <!-- External JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.8/pdfobject.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Comprehensive fix for modal backdrop issues
        $(document).on('hidden.bs.modal', '.modal', function () {
            removeBackdrop();
        });

        // Function to clean up modal artifacts
        function removeBackdrop() {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $('body').attr('style', $('body').attr('style')?.replace(/overflow:\s*hidden/i, ''));
        }

        // Additional cleanup on any modal close/hide event
        $(document).on('hide.bs.modal', '.modal', function() {
            setTimeout(removeBackdrop, 150);
        });

        // Global close method that can be called manually if needed
        window.closeModal = function(modalId) {
            $(modalId).modal('hide');
            setTimeout(removeBackdrop, 150);
        };

        // Initial check and periodic cleanup
        $(document).ready(function() {
            removeBackdrop();
            
            // Periodic check for lingering backdrops when no modals are visible
            setInterval(function() {
                if ($('.modal.show').length === 0 && $('.modal-backdrop').length > 0) {
                    removeBackdrop();
                }
            }, 500);
        });
    </script>

    <div class="container mx-auto mt-4 p-4">

        <div class="container">


            <div class="d-flex justify-content-between mb-3">
                
                <div class="d-flex">
                    <a href="#" class="btn btn-success me-2" id="createAppBtn">
                        <i class="fa fa-plus"></i> Create Application
                    </a>

                    <div class="dropdown d-none ms-2" id="selectLanduseDropdown">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-plus"></i>Select Landuse Type
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?php echo e(route('sectionaltitling.create')); ?>?landuse=Residential">
                                    <i class="fas fa-home me-2" style="color: blue;"></i> Residential
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('sectionaltitling.create')); ?>?landuse=Commercial">
                                    <i class="fas fa-building me-2" style="color: green;"></i> Commercial
                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('sectionaltitling.create')); ?>?landuse=Industrial">
                                    <i class="fas fa-industry me-2" style="color: orange;"></i> Industrial
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const createAppBtn = document.getElementById('createAppBtn');
                        const selectLanduseDropdown = document.getElementById('selectLanduseDropdown');
                        
                        createAppBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            selectLanduseDropdown.classList.remove('d-none');
                            selectLanduseDropdown.classList.add('d-inline-block');
                        });
                    });
                </script>


                <a href="<?php echo e(route('sectionaltitling.sub_applications')); ?>" class="btn btn-secondary">
                    <i class="fa fa-list"></i> View Sub Applications
                </a>
            </div>
            <div>
                <div class="card shadow-sm" style="width:100%">



                    <div class="card-body">
                        <h5 class="card-title">Sectional Titling Applications</h5>
                        <table id="recordsTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                            <thead >
                                <tr>
                                    <th style="text-transform: none; color: #005f16; text-align: center;">Application ID</th>
                                    <th style="text-transform: none; color: #005f16; text-align: center;">File No</th>
                                    <th style="text-transform: none; color: #005f16; text-align: center;">Owner</th>
                                    <th style="text-transform: none; color: #005f16; text-align: center;">Date</th>
                                    <th style="text-transform: none; color: #005f16; text-align: center;">Planning Rec.</th>
                                    <th style="text-transform: none; color: #005f16; text-align: center;">Application Status</th>
                                    <th style="text-transform: none; color: #005f16; text-align: center;">Landuse</th>
                                    <th style="text-transform: none; color: #005f16; text-align: center;">Phone</th>
                                    <th style="text-transform: none; color: #005f16; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $Main_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        
                                        
                                        <td><a href="<?php echo e(route('sectionaltitling.sub_applications')); ?>?main_application_id=<?php echo e($application->id); ?>">STM-2025-000-0<?php echo e($application->id); ?> </a></td>
                                       
                                        <td><?php echo e($application->fileno); ?></td>
                                        <td>
                                            <?php
                                                $multipleOwners = $application->multiple_owners_names;
                                                $names = [];

                                                // Try to decode JSON; if it fails, split on commas.
                                                $decoded = json_decode($multipleOwners, true);
                                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                                    $names = $decoded;
                                                } elseif (!empty($multipleOwners)) {
                                                    $names = explode(',', $multipleOwners);
                                                } elseif ($application->corporate_name) {
                                                    $names = [$application->corporate_name];
                                                } else {
                                                    $names = [trim($application->first_name . ' ' . $application->middle_name . ' ' . $application->surname)];
                                                }

                                                // Clean up extra quotes/spaces
                                                $formattedNames = array_map(function($name) {
                                                    return preg_replace('/\s+/', ' ', trim($name, "\" \t\n\r\0\x0B"));
                                                }, $names);
                                            ?>

                                            <?php if(count($formattedNames) > 1): ?>
                                                <span><?php echo e($formattedNames[0]); ?></span>
                                                <i class="fas fa-info-circle text-primary"
                                                   style="cursor: pointer;"
                                                   data-bs-toggle="tooltip"
                                                   title="Click to view all names"
                                                   onclick="showNames('<?php echo e(implode(', ', $formattedNames)); ?>')">
                                                </i>
                                            <?php else: ?>
                                                <span><?php echo e($formattedNames[0]); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <script>
                                            function showNames(names) {
                                                Swal.fire({
                                                    title: 'All Multiple Owner Names',
                                                    html: names.split(',').map(name => `<p>${name.trim().replace(/\s+/g, ' ')}</p>`).join(''),
                                                    icon: 'info',
                                                    confirmButtonText: 'Close'
                                                });
                                            }
                                        </script>
                                        <td><?php echo e(\Carbon\Carbon::parse($application->created_at)->format('Y-m-d')); ?></td>
                                         <td><?php echo e($application->planning_recommendation_status); ?></td>
                                         <td><?php echo e($application->application_status); ?></td>
                                        <td><?php echo e($application->land_use); ?></td>
                                        <td>
                                            <?php
                                                $phoneNumbers = explode(',', $application->phone_number);
                                                $formattedPhoneNumbers = array_map(function($phone) {
                                                    return preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', preg_replace('/[^0-9]/', '', $phone));
                                                }, $phoneNumbers);
                                            ?>
                                            <?php if(count($formattedPhoneNumbers) > 1): ?>
                                                <span><?php echo e($formattedPhoneNumbers[0]); ?></span>
                                                <i class="fas fa-info-circle text-primary" style="cursor: pointer;" data-bs-toggle="tooltip" title="Click to view all phone numbers" onclick="showPhoneNumbers('<?php echo e(implode(', ', $formattedPhoneNumbers)); ?>')"></i>
                                            <?php else: ?>
                                                <span><?php echo e($formattedPhoneNumbers[0]); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <script>
                                            function showPhoneNumbers(phoneNumbers) {
                                                Swal.fire({
                                                    title: 'Phone Numbers',
                                                    html: phoneNumbers.split(',').map(phone => `<p>${phone.trim()}</p>`).join(''),
                                                    icon: 'info',
                                                    confirmButtonText: 'Close'
                                                });
                                            }
                                        </script>
                                        <td class="relative">
                                            <div class="relative inline-block">
                                                
                                                <!-- Dropdown Toggle Button -->
                                                <button onclick="toggleDropdown(this)" class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none border-2 border-gray-400">
                                                    <i class="fas fa-ellipsis-h text-gray-600"></i>
                                                </button>
                                            
                                                <!-- Dropdown Menu -->
                                                <ul class="absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-lg hidden action-menu z-50">
                                        <a href="<?php echo e(route('sectionaltitling.viewrecorddetail')); ?>?id=<?php echo e($application->id); ?>" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                                                            <i class="material-icons text-blue-600" style="font-size: 18px;">visibility</i>
                                                            <span>View Record Details</span>
                                                </a>
                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2"
                                                            data-id="<?php echo e($application->id); ?>" data-bs-toggle="modal" data-bs-target="#actionsModal" onclick="setSelectedApplicationId(<?php echo e($application->id); ?>)">
                                                            <i class="material-icons text-green-500" style="font-size: 18px;">payments</i>
                                                            <span>Payments</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2"
                                                            data-id="<?php echo e($application->id); ?>" data-bs-toggle="modal" data-bs-target="#OtherApprovals">
                                                            <i class="fas fa-th-large text-red-500" style="width: 18px;"></i>
                                                            <span>Other Approvals</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2"
                                                            onclick="showDepartmentConfirmation('planningRec')"
                                                            data-id="<?php echo e($application->id); ?>">
                                                            <i class="fas fa-clipboard-check text-blue-500" style="width: 18px;"></i>
                                                            <span>Planning Recommendation</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2 decision-mother-btn"
                                                            data-id="<?php echo e($application->id); ?>">
                                                            <i class="fas fa-check-circle text-green-500" style="width: 18px;"></i>
                                                            <span>Director's Approval</span>
                                                        </button>
                                                    </li>
                                                     <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2" data-bs-toggle="modal" data-bs-target="#finalConveyanceModal" data-id="<?php echo e($application->id); ?>">
                                                            <i class="fas fa-file-invoice-dollar text-orange-500" style="width: 18px;"></i>
                                                            <span>Final Conveyance</span>
                                                        </button>

                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2"
                                                            data-bs-toggle="modal" data-bs-target="#eRegistryModal" data-id="<?php echo e($application->id); ?>">
                                                            <i class="fas fa-th-large text-red-500" style="width: 18px;"></i>
                                                            <span>E-Registry</span>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        
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
                                                                'NoOfUnits' => $application->NoOfUnits ?? 0,
                                                                'land_use' => $application->land_use,
                                                                'address' => $application->address,
                                                                'plot_house_no' => $application->plot_house_no,
                                                                'plot_plot_no' => $application->plot_plot_no,
                                                                'plot_street_name' => $application->plot_street_name,
                                                                'plot_district' => $application->plot_district,
                                                                'property_location' =>
                                                                    $application->plot_district . ' ' . $application->plot_street_name . ' ' . $application->plot_plot_no,
                                                            ])); ?>" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center space-x-2">
                                                                <i class="fas fa-plus-square text-green-500" style="width: 18px;"></i>
                                                                <span>Create ST Record</span>
                                                            </a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li class="opacity-50 cursor-not-allowed">
                                                            <a href="#" class="block w-full text-left px-4 py-2 flex items-center space-x-2">
                                                                <i class="fas fa-plus-square text-gray-500" style="width: 18px;"></i>
                                                                <span>Create ST Record (Disabled)</span>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
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

        <!-- Final Conveyance Modal -->
        <div class="modal fade" id="finalConveyanceModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Final Conveyance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="finalConveyanceForm">
                    <!-- Hidden field for application id -->
                    <input type="hidden" name="application_id" id="finalConveyanceApplicationId" value="">
                    <div id="conveyanceInputsContainer">
                    <div class="conveyance-input-group mb-3 grid grid-cols-2 gap-4">
                        <div>
                        <label for="buyerName1" class="form-label">Buyer Name</label>
                        <input type="text" class="form-control" id="buyerName1" name="buyerName[]" required>
                        </div>
                        <div>
                        <label for="sectionNo1" class="form-label">Section No.</label>
                        <input type="text" class="form-control" id="sectionNo1" name="sectionNo[]" required>
                        </div>
                    </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="addConveyanceInputButton">
                    Add More
                    <i class="material-icons" style="color: #3F51B5;">add</i>
                    </button>
                    <hr>
                    <br>
                    <div class="modal-footer" style="background-color: #f1f1f1; display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; padding: 10px 20px;">
                   
                        <button type="submit" class="bttn green-shadow" style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px;">
                            Submit
                            <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                        </button>
                        <button type="button" class="bttn blue-shadow" data-bs-toggle="modal" data-bs-target="#buyersListModal" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3); font-size: 12px; padding: 6px 12px;">
                            Buyers List
                            <i class="material-icons" style="color: #3F51B5; font-size: 16px;">group</i>
                        </button>

                     
                    </div>
                </form>

                <script>
                    $(document).ready(function() {
                        $('#finalConveyanceModal').on('show.bs.modal', function(event) {
                            const button = $(event.relatedTarget);
                            const applicationId = button.data('id');
                            $('#finalConveyanceApplicationId').val(applicationId);
                            console.log('Setting application ID to:', applicationId);
                        });
                    });

                    document.getElementById('addConveyanceInputButton').addEventListener('click', function() {
                    const container = document.getElementById('conveyanceInputsContainer');
                    const inputCount = container.querySelectorAll('.conveyance-input-group').length + 1;

                    const newInputGroup = document.createElement('div');
                    newInputGroup.classList.add('conveyance-input-group', 'mb-3', 'grid', 'grid-cols-2', 'gap-4');
                    newInputGroup.innerHTML = `
                        <div>
                        <label for="buyerName${inputCount}" class="form-label">Buyer Name</label>
                        <input type="text" class="form-control" id="buyerName${inputCount}" name="buyerName[]" required>
                        </div>
                        <div>
                        <label for="sectionNo${inputCount}" class="form-label">Section No.</label>
                        <input type="text" class="form-control" id="sectionNo${inputCount}" name="sectionNo[]" required>
                        </div>
                    `;
                    container.appendChild(newInputGroup);
                    });

                    document.getElementById('finalConveyanceForm').addEventListener('submit', function(e){
                        e.preventDefault();
                        const appId = document.getElementById('finalConveyanceApplicationId').value;
                        
                        if (!appId) {
                            alert('Application ID is missing. Please try again.');
                            return;
                        }
                        
                        const buyerNames = document.querySelectorAll('input[name="buyerName[]"]');
                        const sectionNos = document.querySelectorAll('input[name="sectionNo[]"]');
                        
                        // Create an array of all conveyance records
                        const records = [];
                        for (let i = 0; i < buyerNames.length; i++) {
                            if (buyerNames[i].value && sectionNos[i].value) {
                                records.push({
                                    buyerName: buyerNames[i].value,
                                    sectionNo: sectionNos[i].value
                                });
                            }
                        }
                        
                        // Send all records as a single object
                        const requestData = {
                            application_id: parseInt(appId),
                            conveyance: {
                                records: records
                            }
                        };
                        
                        console.log('Sending conveyance data:', requestData);
                        
                        fetch("<?php echo e(route('conveyance.update')); ?>", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                            },
                            body: JSON.stringify(requestData)
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.text().then(text => { 
                                    try {
                                        const jsonError = JSON.parse(text);
                                        throw new Error(jsonError.message || text);
                                    } catch (e) {
                                        throw new Error(text);
                                    }
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message
                            });
                            $('#finalConveyanceModal').modal('hide');
                            // Optionally, refresh the page or update the UI to reflect the changes
                            location.reload(); // Uncomment this line to refresh the page
                        })
                        .catch(err => {
                            console.error('Error:', err);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: err.message || 'An error occurred while saving the conveyance data.'
                            });
                            
                        });
                    });
                </script>
                </div>
            </div>
            </div>
        </div>



<!-- Buyers List Modal -->
<div class="modal fade" id="buyersListModal" tabindex="-1" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title">Buyers List</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $__env->make('sectionaltitling.partials.buyers_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
            </div>
            <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: space-between;">
                 <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                      Close
                      <i class="material-icons" style="color: #5a0000;">close</i>
                 </button>
                 <button type="button" class="bttn blue-shadow" onclick="printBuyersList()" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                      Print Buyers List
                      <i class="material-icons" style="color: #3F51B5;">print</i>
                 </button>
            </div>
      </div>
 </div>
</div>

<script>
 function printBuyersList() {
      const modalContent = document.querySelector('#buyersListModal .modal-body').innerHTML;
      const printWindow = window.open('', '_blank');
      printWindow.document.write(`
            <html>
                 <head>
                      <title>Buyers List</title>
                      <style>
                            body { font-family: Arial, sans-serif; margin: 20px; }
                            h5 { text-align: center; margin-bottom: 20px; }
                      </style>
                 </head>
                 <body>
                      <h5>Buyers List</h5>
                      ${modalContent}
                 </body>
            </html>
      `);
      printWindow.document.close();
      printWindow.focus();
      printWindow.print();
      printWindow.close();
 }
</script>

        <div class="modal fade" id="actionsModal" tabindex="-1" aria-labelledby="actionsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width:210px;">
            <div class="modal-content">
                <div class="modal-header" style="height: 30px;">
                <h5 class="modal-title" id="actionsModalLabel">Payments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                </div>
                <div class="modal-body" style="background-color: #f1f1f1;">
          
                <div>
                    <div class="payments-grid">
                    <!-- Row 1 -->
                    <button class="bttn purple-shadow" data-bs-toggle="modal" data-bs-target="#financeModal"
                        onclick="loadBillingData(selectedApplicationId)" id="initialBillButton">
                        Initial Bill
                        <i class="material-icons" style="color: #4CAF50;">account_balance</i>
                    </button>
                  
                    <button class="bttn pink-shadow" id="bettermentFeeButton"
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
                    PDFObject.embed("<?php echo e(asset('storage/uploads/betterment_bill.pdf')); ?>", "#bettermentPdfViewer", {
                        pdfOpenParams: {
                            zoom: "80" // Set default zoom to 80%
                        }
                    });
                </script>
            </div>

            <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                    Close
                    <i class="material-icons" style="color: #9E9E9E;">close</i>
                </button>
                <button type="button" class="bttn blue-shadow" onclick="printBettermentBill()" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                    Print Betterment Bill
                    <i class="material-icons" style="color: #3F51B5;">print</i>
                </button>
            </div>

             
        </div>
    </div>
</div>
 


            <!-- View Actions Modal -->
            <div class="modal fade" id="viewActionsModal" tabindex="-1" aria-labelledby="viewActionsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
                <div class="modal-content">
                    <div class="modal-header" style="height: 30px;">
                    <h5 class="modal-title" id="actionsModalLabel">View Receipts and Plans</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                    </div>
                    <div class="modal-body" style="background-color: #f1f1f1;">
            <div>
                <div class="button-grid">
                <!-- Row 1 -->
                <button class="bttn purple-shadow" data-bs-toggle="modal" data-bs-target="#viewSurveyPlanModal">
                    View Survey Plan
                    <i class="material-icons" style="color: #4CAF50;">map</i>
                </button>
                
                <button class="bttn" data-bs-toggle="modal" data-bs-target="#architecturalModal">
                    View Architectural Design
                    <i class="material-icons" style="color: #2196F3;">architecture</i>
                </button>
                <button class="bttn pink-shadow" data-bs-toggle="modal" data-bs-target="#viewReceiptModal">
                    View Receipt
                    <i class="material-icons" style="color: #FF9800;">receipt</i>
                </button>
                <button class="bttn purple-shadow" data-bs-toggle="modal" data-bs-target="#viewLandModal">
                    View Scanned File
                    <i class="material-icons" style="color: #9C27B0;">description</i>
                </button>
                
                </div>
            </div>
                    </div>
                </div>
                </div>
            </div>
    

            <div class="modal fade" id="OtherApprovals" tabindex="-1" aria-labelledby="actionsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width:230px;">
                <div class="modal-content">
                    <div class="modal-header" style="height: 30px;">
                    <h5 class="modal-title" id="actionsModalLabel">Other Approvals</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                    </div>
                    <div class="modal-body" style="background-color: #f1f1f1;">
              
                    <div>
                        <div class="button-grid">
                        <!-- Row 1 -->
                        <button class="bttn purple-shadow" data-bs-toggle="modal" data-bs-target="#landsModal">
                            Lands
                            <i class="material-icons" style="color: #9C27B0;">landscape</i>
                        </button>

                        <button class="bttn pink-shadow" onclick="showDepartmentConfirmation('survey')">
                            Survey
                            <i class="material-icons" style="color: #FF9800;">map</i>
                        </button>
                        
                        <button class="bttn purple-shadow" onclick="showDepartmentConfirmation('deeds')">
                            Deeds
                            <i class="material-icons" style="color: #15af2f;">gavel</i>
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            

                        <!-- Lands Modal -->
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
                                                        style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;" onclick="showDepartmentConfirmation('ok')">
                                                        OK
                                                        <i class="material-icons" style="color: #4CAF50; font-size: 16px;">check_circle</i>
                                                    </button>
                                                    <button type="button" class="bttn gray-shadow" 
                                                        style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;" onclick="openFile()">
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

         <!-- Deeds Modal -->
         <?php echo $__env->make('sectionaltitling.partials.deeds', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Initial Bill Approval Modals -->
       <?php echo $__env->make('sectionaltitling.partials.initailbill', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         


             
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
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewSurveyPlanModal">
                                        <i class="material-icons" style="font-size: 16px; vertical-align: middle;">map</i> View Survey Plan
                                    </button>

                                </div>

                                <div class="modal-footer" style="background-color: #f1f1f1;">
                                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                                        <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" 
                                            style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                            OK
                                            <i class="material-icons" style="color: #4CAF50; font-size: 16px;">check_circle</i>
                                        </button>
                                        <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')"
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
                                                        <img src="https://via.placeholder.com/800x600?text=Survey+Plan+Example" alt="Survey Plan" class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                                                    <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                                        Close
                                                        <i class="material-icons" style="color: #9E9E9E;">close</i>
                                                    </button>
                                                    <button type="button" class="bttn blue-shadow" onclick="printSurveyPlan()" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                                        Print Survey Plan
                                                        <i class="material-icons" style="color: #3F51B5;">print</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function printSurveyPlan() {
                                            // Create a new window with just the image content
                                            const printWindow = window.open('', '_blank');
                                            printWindow.document.write('<html><head><title>Survey Plan</title></head><body>');
                                            printWindow.document.write('<img src="https://via.placeholder.com/800x600?text=Survey+Plan+Example" style="width: 100%;">');
                                            printWindow.document.write('</body></html>');
                                            printWindow.document.close();
                                            printWindow.focus();
                                            printWindow.print();
                                            printWindow.close();
                                        }
                                    </script>

            <!-- Generate Bill Modal -->
            <div class="modal fade" id="generateBillModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Generate Final  Bill</h5>
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
        <?php echo $__env->make('sectionaltitling.partials.eRegistry', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Add Architectural Modal -->


    </div>    
 </div>
 </div>
 </div>

 <div class="modal fade" id="decisionModalMother" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="decisionFormMother">
                <div class="modal-header">
                    <h5 class="modal-title">Director's Approval</h5>
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


                        <input type="radio" name="decision" value="Pedding" id="dmmDecline" class="ms-3">
                        <label for="dmmDecline">Pedding</label>
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
                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: space-between; padding: 0 20px;">
                    <button type="button" class="bttn green-shadow" 
                        style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;" data-bs-dismiss="modal">
                        Cancel
                        <i class="material-icons" style="color: #d80000; font-size: 16px;">cancel</i>
                    </button>
                    <button type="submit" class="bttn green-shadow"
                        style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                        Submit
                        <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                    </button>
                    <button type="button" class="bttn blue-shadow" onclick="$('#decisionModalMother').modal('hide'); $('#generateBillModal').modal('show')"
                        style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                        Final Bill
                        <i class="material-icons" style="color: #3F51B5; font-size: 16px;">receipt</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Planning Recommendation Modal -->
<div class="modal fade" id="planningRecommendationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">  
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
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="approvalDate" class="form-label">Approval/Decline Date</label>
                            <input type="datetime-local" class="form-control" id="approvalDate" name="approval_date" required>
                        </div>
                        <div>
                            <label class="form-label">....</label>
                            <select class="form-select" required onchange="handleSelectChange(this.value)">
                                <option value="" disabled selected>Select</option>
                                <option value="architectural">Architectural Design</option>
                                <option value="planningRec">Planning Recommendation</option>
                            </select>
                        </div>
                        <!-- Empty cells to complete a 2x2 grid -->
                        <div></div>
                        <div></div>
                    </div>

                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow" 
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 120px;" data-bs-dismiss="modal">
                                Cancel
                                <i class="material-icons" style="color: #f44336; font-size: 16px;">cancel</i>
                            </button>
                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 120px;" onclick="showPrintModal(); return false;">
                                Submit
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                            </button>
                            <button type="button" class="bttn gray-shadow" 
                                style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 6px 12px; width: 140px;" onclick="showGenDocumentModal(); return false;">
                                Gen & Print
                                <i class="material-icons" style="color: #2196F3; font-size: 16px;">description</i>
                            </button>
                            <button type="button" class="bttn blue-shadow"
                                style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3); font-size: 12px; padding: 6px 12px; width: 140px;" onclick="showGenBillModal(); return false;">
                                Gen & Print Bill
                                <i class="material-icons" style="color: #FF9800; font-size: 16px;">receipt</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

   <!-- Dummy Modals for Gen & Print and Gen & Print Bill -->
                    <!-- Generated Document Modal -->
                    <div class="modal fade" id="genDocumentModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Generated Document</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="genDocumentContent" style="min-height: 300px; padding: 20px; border: 1px solid #ddd;">
                                        <h4 class="text-center mb-4">PLANNING RECOMMENDATION DOCUMENT</h4>
                                        <p>This is a sample generated document for the planning recommendation.</p>
                                        <p>Application ID: <strong>STM-2025-000-0X</strong></p>
                                        <p>Applicant: <strong>SAMPLE APPLICANT NAME</strong></p>
                                        <p>File No: <strong>SAMPLE-FILE-NO</strong></p>
                                        <p>Date: <strong><?php echo e(date('Y-m-d')); ?></strong></p>
                                        <p class="mt-4">The application has been reviewed and is recommended for approval.</p>
                                        <div class="row mt-5">
                                            <div class="col-6">
                                                <p>_________________________</p>
                                                <p>Planning Officer</p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p>_________________________</p>
                                                <p>Director</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                                    <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                        Close
                                        <i class="material-icons" style="color: #9E9E9E;">close</i>
                                    </button>
                                    <button type="button" class="bttn blue-shadow" onclick="printGenDocument()" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                        Print Document
                                        <i class="material-icons" style="color: #3F51B5;">print</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Generated Bill Modal -->
                    <div class="modal fade" id="genBillModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Generated Bill</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="genBillContent" style="min-height: 300px; padding: 20px; border: 1px solid #ddd;">
                                        <h4 class="text-center mb-4">BILL FOR PAYMENT</h4>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <p><strong>Bill No:</strong> BILL-2025-001</p>
                                                <p><strong>Date:</strong> <?php echo e(date('Y-m-d')); ?></p>
                                                <p><strong>File No:</strong> SAMPLE-FILE-NO</p>
                                            </div>
                                            <div class="col-6">
                                                <p><strong>Applicant:</strong> SAMPLE APPLICANT NAME</p>
                                                <p><strong>Application Type:</strong> Sectional Titling</p>
                                                <p><strong>Status:</strong> Pending Payment</p>
                                            </div>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Description</th>
                                                    <th class="text-end">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Application Fee</td>
                                                    <td class="text-end">₦ 10,000.00</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Processing Fee</td>
                                                    <td class="text-end">₦ 25,000.00</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Document Fee</td>
                                                    <td class="text-end">₦ 5,000.00</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-end"><strong>Total</strong></td>
                                                    <td class="text-end"><strong>₦ 40,000.00</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="mt-4">
                                            <p>Please make payment within 14 days from the date of this bill.</p>
                                            <p>Payment should be made to the Accounts Department.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                                    <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                                        Close
                                        <i class="material-icons" style="color: #9E9E9E;">close</i>
                                    </button>
                                    <button type="button" class="bttn blue-shadow" onclick="printGenBill()" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                                        Print Bill
                                        <i class="material-icons" style="color: #3F51B5;">print</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function showGenDocumentModal() {
                            $('#planningRecommendationModal').modal('hide');
                            $('#genDocumentModal').modal('show');
                        }
                        
                        function showGenBillModal() {
                            $('#planningRecommendationModal').modal('hide');
                            $('#genBillModal').modal('show');
                        }
                        
                        function printGenDocument() {
                            const content = document.getElementById('genDocumentContent').innerHTML;
                            const printWindow = window.open('', '_blank');
                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Planning Recommendation Document</title>
                                        <style>
                                            body { font-family: Arial, sans-serif; margin: 20px; }
                                            h4 { text-align: center; margin-bottom: 20px; }
                                            .row { display: flex; }
                                            .col-6 { width: 50%; }
                                            .text-end { text-align: right; }
                                            .mt-4, .mt-5 { margin-top: 2rem; }
                                        </style>
                                    </head>
                                    <body>
                                        ${content}
                                    </body>
                                </html>
                            `);
                            printWindow.document.close();
                            printWindow.focus();
                            setTimeout(() => {
                                printWindow.print();
                                printWindow.close();
                            }, 500);
                        }
                        
                        function printGenBill() {
                            const content = document.getElementById('genBillContent').innerHTML;
                            const printWindow = window.open('', '_blank');
                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Bill for Payment</title>
                                        <style>
                                            body { font-family: Arial, sans-serif; margin: 20px; }
                                            h4 { text-align: center; margin-bottom: 20px; }
                                            .row { display: flex; }
                                            .col-6 { width: 50%; }
                                            table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                                            table, th, td { border: 1px solid #ddd; }
                                            th, td { padding: 8px; text-align: left; }
                                            .text-end { text-align: right; }
                                            .mt-4 { margin-top: 2rem; }
                                        </style>
                                    </head>
                                    <body>
                                        ${content}
                                    </body>
                                </html>
                            `);
                            printWindow.document.close();
                            printWindow.focus();
                            setTimeout(() => {
                                printWindow.print();
                                printWindow.close();
                            }, 500);
                        }
                    </script>
<!-- Print Modal -->
<div class="modal fade" id="printModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Planning Recommendation</h5>
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
                                <p><strong>HONOURABLE COMMISSIONER. </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: center;">
                <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3);">
                    Close
                    <i class="material-icons" style="color: #9E9E9E;">close</i>
                </button>
                <button type="button" class="bttn blue-shadow" onclick="printContent()" style="box-shadow: 0 4px 8px rgba(33, 150, 243, 0.3);">
                    Print Bill
                    <i class="material-icons" style="color: #3F51B5;">print</i>
                </button>
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
                    <div class="row g-3">
                        <div class="col-12">
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

                        <div id="designFields" style="display: none;">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Drawn By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Approved By</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="background-color: #f1f1f1;">
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                                <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" 
                                    style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                    OK
                                    <i class="material-icons" style="color: #4CAF50; font-size: 16px;">check_circle</i>
                                </button>
                                <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')"
                                    style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                    Edit
                                    <i class="material-icons" style="color: #9E9E9E; font-size: 16px;">edit</i>
                                </button>
                                <button type="submit" class="bttn green-shadow"
                                    style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                    Submit
                                    <i class="material-icons" style="color: #eeeeee; font-size: 16px;">send</i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                </form>
                 
               
            </div>
        </div>
    </div>
</div>

<!-- New Modal for View Record Details -->
<div class="modal fade" id="viewRecordDetailModal" tabindex="-1" aria-labelledby="viewRecordDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewRecordDetailModalLabel">Record Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="recordDetailContent">
        <!-- Content will be loaded via AJAX -->
        <div class="text-center">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="bttn gray-shadow" data-bs-dismiss="modal">
          Close
          <i class="material-icons" style="color: #9E9E9E;">close</i>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript to load record details -->
<script>
function loadRecordDetails(id) {
  fetch(`<?php echo e(url('record/details')); ?>/${id}`)
    .then(response => response.text())
    .then(html => {
      document.getElementById('recordDetailContent').innerHTML = html;
    })
    .catch(error => {
      console.error('Error loading record details:', error);
      document.getElementById('recordDetailContent').innerHTML = '<p class="text-danger">Failed to load details.</p>';
    });
}
</script>

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

                  // Use the route with ID parameter
                  const url = "<?php echo e(route('sectionaltitling.generate_bill', '')); ?>/" + applicationId;
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
              if (department === 'generateBill') {
                  // Get the selected application ID for the bill
                  const url = "<?php echo e(route('sectionaltitling.generate_bill', '')); ?>/" + selectedApplicationId;
                  $('#billFrame').attr('src', url);
                  $('#generateBillModal').modal('show');
                  return;
              }
              $(`#${department}Modal`).modal('show'); // Ensure the modal ID matches
          }

          


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
    
    function handleSelectChange(value) {
        if(value === 'architectural') {
            $('#architecturalModal').modal('show');
        } else if(value === 'planningRec') {
            Swal.fire({
                title: "Approve Application?",
                text: "Do you want to generate the planning recommendation document?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, approve it!",
                cancelButtonText: "No, cancel"
            }).then((result) => {
                if(result.isConfirmed) {
                    // Generate the planning recommendation document.
                    showPrintModal();
                }
            });
        }
    }

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
</script>

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
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No application ID selected. Please try again.'
            });
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
        fetch(`<?php echo e(url('/')); ?>/sectionaltitling/get-billing-data/${applicationId}`)
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
                document.getElementById('payment_date').value = data.payment_date ? new Date(data.payment_date).toISOString().split('T')[0] : '';
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
</script>

<script>
    // Handle E-Registry modal
    $(document).ready(function() {
        // When E-Registry modal is about to be shown, populate it with data
        $('#eRegistryModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget); // Button that triggered the modal
            const applicationId = button.data('id'); // Extract application ID from data-id attribute
            
            // Find the corresponding application row in the table
            const row = button.closest('tr');
            
            // Extract data from the row
            const fileNo = row.find('td:eq(1)').text().trim(); // File Number is in the second column
            
            // Get the owner name
            let ownerName = row.find('td:eq(2)').text().trim(); // Owner Name is in the third column
            // Remove any tooltip indicators or extra content
            ownerName = ownerName.replace(/\s*\(.*?\)\s*/g, '').trim();
            
            // Set values in the modal
            $('#eRegistryId').val(applicationId);
            $('#eRegistryFileName').val(ownerName);
            $('#eRegistryFileNo').val(fileNo);
            
            // Set current date as default for commissioning date
            const today = new Date().toISOString().split('T')[0];
            $('#eRegistryCommissionDate').val(today);
        });
        
        // Handle form submission
        $('#eRegistryForm').on('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const registryData = {
                application_id: $('#eRegistryId').val(),
                file_location: $('#eRegistryFileLocation').val(),
                commission_date: $('#eRegistryCommissionDate').val(),
                decommission_date: $('#eRegistryDecommissionDate').val()
            };
            
            // Here you would normally send this data to the server
            // For now, just show a success message
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'E-Registry information saved successfully!'
            });
            
            // Close the modal
            $('#eRegistryModal').modal('hide');
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/sectionaltitling/index.blade.php ENDPATH**/ ?>