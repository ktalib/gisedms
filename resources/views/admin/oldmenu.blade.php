@php
    $admin_logo = getSettingsValByName('company_logo');
@endphp
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <img src="https://i.ibb.co/prJ1bYp9/Whats-App-Image-2025-02-21-at-5-25-59-AM.jpg" alt="logo" style="width: 150px; height: auto;" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>{{ __('Dashboard') }}</label>
                    <i class="ti ti-dashboard"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">{{ __('Overview') }}</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>{{ __('Document Management') }}</label>
                    <i class="ti ti-folder"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-upload"></i></span>
                        <span class="pc-mtext">{{ __('Upload New Document') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file"></i></span>
                        <span class="pc-mtext">{{ __('All Documents') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-scan"></i></span>
                        <span class="pc-mtext">{{ __('Scanned Documents') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-tag"></i></span>
                        <span class="pc-mtext">{{ __('Indexed Documents') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-cloud-upload"></i></span>
                        <span class="pc-mtext">{{ __('Bulk Uploads') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-search"></i></span>
                        <span class="pc-mtext">{{ __('Pagetyping') }}</span>
                    </a>
                </li>
                <li class="pc-item pc caption">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-folder"></i></span>
                        <span class="pc-mtext">{{ __('Property Card Data Capture') }}</span>
                    </a>
                </li>
               

                <li class="pc-item pc-caption">
                    <label>{{ __('Search & Retrieval') }}</label>
                    <i class="ti ti-search"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-search"></i></span>
                        <span class="pc-mtext">{{ __('Quick Search') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-search"></i></span>
                        <span class="pc-mtext">{{ __('Advanced Search') }}</span>
                    </a>
                </li>    
                
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-search"></i></span>
                        <span class="pc-mtext">{{ __('Legal Search') }}</span>
                    </a>
                </li>
               
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-clock"></i></span>
                        <span class="pc-mtext">{{ __('Recent Searches') }}</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>{{ __('Document Security & Access Control') }}</label>
                    <i class="ti ti-lock"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user"></i></span>
                        <span class="pc-mtext">{{ __('User Roles & Permissions') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-lock"></i></span>
                        <span class="pc-mtext">{{ __('Confidential Documents') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-list"></i></span>
                        <span class="pc-mtext">{{ __('Audit Logs') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-shield"></i></span>
                        <span class="pc-mtext">{{ __('Encryption Settings') }}</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>{{ __('Approval Workflow') }}</label>
                    <i class="ti ti-check"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-time"></i></span>
                        <span class="pc-mtext">{{ __('Pending Approvals') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-check"></i></span>
                        <span class="pc-mtext">{{ __('Approved Documents') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-close"></i></span>
                        <span class="pc-mtext">{{ __('Rejected Documents') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-pencil"></i></span>
                        <span class="pc-mtext">{{ __('E-Signature Requests') }}</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>{{ __('Notifications & Alerts') }}</label>
                    <i class="ti ti-bell"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-email"></i></span>
                        <span class="pc-mtext">{{ __('Email & SMS Alerts') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-alert"></i></span>
                        <span class="pc-mtext">{{ __('Expiration Alerts') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-at"></i></span>
                        <span class="pc-mtext">{{ __('User Mentions') }}</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>{{ __('Reports & Analytics') }}</label>
                    <i class="ti ti-bar-chart"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-pie-chart"></i></span>
                        <span class="pc-mtext">{{ __('Usage Reports') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file"></i></span>
                        <span class="pc-mtext">{{ __('Document Status Reports') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-download"></i></span>
                        <span class="pc-mtext">{{ __('Download History') }}</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>{{ __('Printing & Exporting') }}</label>
                    <i class="ti ti-printer"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-printer"></i></span>
                        <span class="pc-mtext">{{ __('Print Documents') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-pdf"></i></span>
                        <span class="pc-mtext">{{ __('Download PDFs') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-printer"></i></span>
                        <span class="pc-mtext">{{ __('Batch Printing') }}</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>{{ __('System Settings') }}</label>
                    <i class="ti ti-settings"></i>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-settings"></i></span>
                        <span class="pc-mtext">{{ __('General Settings') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-hdd"></i></span>
                        <span class="pc-mtext">{{ __('Storage Management') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-backup"></i></span>
                        <span class="pc-mtext">{{ __('Backup & Restore') }}</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-api"></i></span>
                        <span class="pc-mtext">{{ __('API Integrations') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
