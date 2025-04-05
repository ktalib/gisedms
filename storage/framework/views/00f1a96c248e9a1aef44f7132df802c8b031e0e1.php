<?php
    $admin_logo = getSettingsValByName('company_logo');
?>
<?php
    $admin_logo = getSettingsValByName('company_logo');
    $ids = parentId();
    $authUser = \App\Models\User::find($ids);
    $subscription = \App\Models\Subscription::find($authUser->subscription);
    $routeName = \Request::route()->getName();
    $pricing_feature_settings = getSettingsValByIdName(1, 'pricing_feature');
?>
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <img src="https://i.ibb.co/prJ1bYp9/Whats-App-Image-2025-02-21-at-5-25-59-AM.jpg" alt="logo" style="width: 150px; height: auto;" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-tachometer-alt"></i></span>
                        <span class="pc-mtext"><?php echo e(__('DASHBOARD')); ?></span>
                    </a>
                </li>

                <?php if(\Auth::user()->assign_role == 'owner' || strpos(\Auth::user()->assign_role, 'Customer Management') !== false): ?>

                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-users"></i></span>
                        <span class="pc-mtext"><?php echo e(__('CUSTOMER MANAGEMENT')); ?></span>
                        <span class="pc-arrow"><i class="fas fa-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link"><?php echo e(__('Person')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Individual')); ?></a></li>
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Group')); ?></a></li>
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Family')); ?></a></li>
                            </ul>
                        </li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Corporate')); ?></a></li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link"><?php echo e(__('Customer Manager')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Appointment')); ?></a></li>
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Appointment Calendar')); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php endif; ?> 


                <?php if(\Auth::user()->assign_role == 'owner' || strpos(\Auth::user()->assign_role, 'Programmes -') !== false): ?>
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-briefcase"></i></span>
                        <span class="pc-mtext"><?php echo e(__('PROGRAMMES')); ?></span>
                        <span class="pc-arrow"><i class="fas fa-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link"><?php echo e(__('Allocation')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Governors List')); ?></a></li>
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Commissioners List')); ?></a></li>
                            </ul>
                        </li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link"><?php echo e(__('Resettlement')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Governors List')); ?></a></li>
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Commissioners List')); ?></a></li>
                            </ul>
                        </li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Recertification')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('SLTR/First Registration')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Regularization/Conversion')); ?></a></li>
                        <li class="pc-item"><a href="<?php echo e(route('sectionaltitling.index')); ?>" class="pc-link"><?php echo e(__('Sectional Titling')); ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>



                <?php if(\Auth::user()->assign_role == 'owner' || strpos(\Auth::user()->assign_role, 'Information Products -') !== false): ?>

                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-info-circle"></i></span>
                        <span class="pc-mtext"><?php echo e(__('INFORMATION PRODUCTS')); ?></span>
                        <span class="pc-arrow"><i class="fas fa-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Letter of Administration/Grant/Offer Letter')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Occupancy Permit (OP)')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Site Plan/Parcel Plan')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Right of Occupancy')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Certificate of Occupancy')); ?></a></li>
                    </ul>
                </li>

                <?php endif; ?>

                <?php if(\Auth::user()->assign_role == 'owner' || 
                    strpos(\Auth::user()->assign_role, 'Instrument Registration') !== false || 
                    strpos(\Auth::user()->assign_role, 'Property Records Assistant') !== false): ?>
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-folder"></i></span>
                        <span class="pc-mtext"><?php echo e(__('INSTRUMENT REGISTRATION')); ?></span>
                        <span class="pc-arrow"><i class="fas fa-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a href="<?php echo e(route('instruments.index')); ?>" class="pc-link active"><?php echo e(__('Instrument Registration')); ?></a></li>
                        <li class="pc-item"><a href="<?php echo e(route('propertycard.create')); ?>" class="pc-link"><?php echo e(__('Property Card Assistant')); ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if(\Auth::user()->assign_role == 'owner' || 
                    strpos(\Auth::user()->assign_role, 'Legal Search - On-premise Official') !== false || 
                    strpos(\Auth::user()->assign_role, 'Legal Search - On-premise Commercial') !== false): ?>
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-search"></i></span>
                        <span class="pc-mtext"><?php echo e(__('SEARCH')); ?></span>
                        <span class="pc-arrow"><i class="fas fa-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item pc-hasmenu">
                            <a href="<?php echo e(route('note.index')); ?>" class="pc-link"><?php echo e(__('Official Purpose ')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                        </li> 
                        <li class="pc-item pc-hasmenu">
                            <a href="<?php echo e(route('note.index')); ?>" class="pc-link"><?php echo e(__('On-Premises')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                        </li> 
                        <li class="pc-item pc-hasmenu">
                            <a href="<?php echo e(route('note.index')); ?>" class="pc-link"><?php echo e(__('Online')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if(\Auth::user()->assign_role == 'owner' || 
                    strpos(\Auth::user()->assign_role, 'Revenue Management - Billing') !== false ||
                    strpos(\Auth::user()->assign_role, 'Revenue Management - Receipt') !== false || 
                    strpos(\Auth::user()->assign_role, 'Revenue Management - LUC') !== false || 
                    strpos(\Auth::user()->assign_role, 'Revenue Management - Bill Balance') !== false): ?>
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-money-bill-wave"></i></span>
                        <span class="pc-mtext"><?php echo e(__('REVENUE MANAGEMENT')); ?></span>
                        <span class="pc-arrow"><i class="fas fa-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link"><?php echo e(__('Billing')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Automated Billing')); ?></a></li>
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Legacy Billing')); ?></a></li>
                            </ul>
                        </li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Generate Receipt')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Land Use Charge (LUC)')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Bill Balance')); ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if(\Auth::user()->assign_role == 'owner' || 
                    strpos(\Auth::user()->assign_role, 'File Digital Registry - File Tracking') !== false ||
                    strpos(\Auth::user()->assign_role, 'File Digital Registry - Indexing') !== false ||
                    strpos(\Auth::user()->assign_role, 'File Digital Registry - Scanning') !== false ||
                    strpos(\Auth::user()->assign_role, 'File Digital Registry - Pagetyping') !== false): ?>
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-folder-open"></i></span>
                        <span class="pc-mtext"><?php echo e(__('FILE DIGITAL REGISTRY')); ?></span>
                        <span class="pc-arrow"><i class="fas fa-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('E-Registry')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('File Tracker/Tracking')); ?></a></li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link"><?php echo e(__('Indexing')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('File Indexing Assistant')); ?></a></li>
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Print File Labels')); ?></a></li>
                            </ul>
                        </li>
                        <li class="pc-item pc-hasmenu">
                            <a href="#" class="pc-link"><?php echo e(__('Scanning')); ?><span class="pc-arrow"><i class="fas fa-chevron-right"></i></span></a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Upload')); ?></a></li>
                                <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Download')); ?></a></li>
                            </ul>
                        </li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('PageTyping')); ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if(\Auth::user()->assign_role == 'owner' || 
                    strpos(\Auth::user()->assign_role, 'Systems - Caveat') !== false ||
                    strpos(\Auth::user()->assign_role, 'Systems - Encumbrance') !== false): ?>
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-layer-group"></i></span>
                        <span class="pc-mtext"><?php echo e(__('SYSTEMS')); ?></span>
                        <span class="pc-arrow"><i class="fas fa-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Caveat')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('Encumbrance')); ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if(\Auth::user()->assign_role == 'owner' || 
                    strpos(\Auth::user()->assign_role, 'Legacy Systems') !== false): ?>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-archive"></i></span>
                        <span class="pc-mtext"><?php echo e(__('LEGACY SYSTEMS')); ?></span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if(\Auth::user()->assign_role == 'owner' || 
                    strpos(\Auth::user()->assign_role, 'System Admin') !== false || 
                    strpos(\Auth::user()->assign_role, 'Super Admin') !== false): ?>
                <li class="pc-item pc-hasmenu">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-cogs"></i></span>
                        <span class="pc-mtext"><?php echo e(__('SYSTEM ADMIN')); ?></span>
                        <span class="pc-arrow"><i class="fas fa-chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('User Account')); ?></a></li>
                        <li class="pc-item"><a href="#" class="pc-link"><?php echo e(__('System Settings')); ?></a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if(\Auth::user()->assign_role == 'owner' || 
                    strpos(\Auth::user()->assign_role, 'Management I') !== false ||
                    strpos(\Auth::user()->assign_role, 'Management II') !== false): ?>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-user-cog"></i></span>
                        <span class="pc-mtext"><?php echo e(__('MANAGEMENT')); ?></span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\wamp64\www\gisedms\resources\views/admin/menu.blade.php ENDPATH**/ ?>