@extends('layouts.app')

@section('page-title', __('Sub-Applications'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page">{{ __('Sub-Applications') }}</li>
@endsection

@section('content')
    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
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

    <!-- Main Content Container -->
    <div class="container mx-auto mt-4 p-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ __('Sub-Applications') }}</h5>
                <table id="subRecordsTable" class="table table-striped dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-transform: none;    color: #005f16;">main Application ID</th>
                            <th style="text-transform: none;  color: #005f16;">ST FileNo</th>
                            <th style="text-transform: none; color: #005f16;">Original Owner</th>
                            <th style="text-transform: none; color: #005f16;">Unit Owner Name</th>
                            <th style="text-transform: none; color: #005f16;">Phone Number</th>
                            <th style="text-transform: none; color: #005f16;">Planning Rec.</th>
                            <th style="text-transform: none; color: #005f16;">Application Status</th>
                            <th style="text-transform: none; color: #005f16;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subApplications as $subApplication)
                            <tr>

                                <td>STM-2025-0001-{{ $subApplication->main_application_id }}</td>
                                <td>{{ $subApplication->fileno }}</td>
                                <td>
                                    @if ($subApplication->main_applicant_type === 'corporate')
                                        {{ $subApplication->main_corporate_name }}
                                    @elseif ($subApplication->main_applicant_type === 'multiple')
                                        @php
                                            $mainOwnerNames = $subApplication->main_multiple_owners_names;
                                            if (is_string($mainOwnerNames)) {
                                                $mainOwnerNames = json_decode($mainOwnerNames, true);
                                            }
                                            if (!is_array($mainOwnerNames)) {
                                                $mainOwnerNames = [$mainOwnerNames];
                                            }
                                            $mainOwnerNames = array_filter($mainOwnerNames);
                                        @endphp
                                        {{ is_array($mainOwnerNames) ? implode(', ', $mainOwnerNames) : $mainOwnerNames }}
                                    @else
                                        {{ $subApplication->main_first_name }} {{ $subApplication->main_middle_name }}
                                        {{ $subApplication->main_surname }}
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $multipleOwners = $subApplication->multiple_owners_names;
                                        $names = [];

                                        // Try to decode JSON; if it fails, split on commas.
                                        $decoded = json_decode($multipleOwners, true);
                                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                            $names = $decoded;
                                        } elseif (!empty($multipleOwners)) {
                                            $names = explode(',', $multipleOwners);
                                        } elseif ($subApplication->corporate_name) {
                                            $names = [$subApplication->corporate_name];
                                        } else {
                                            $names = [
                                                trim(
                                                    $subApplication->first_name .
                                                        ' ' .
                                                        $subApplication->middle_name .
                                                        ' ' .
                                                        $subApplication->surname,
                                                ),
                                            ];
                                        }

                                        // Clean up extra quotes/spaces
                                        $formattedNames = array_map(function ($name) {
                                            return preg_replace('/\s+/', ' ', trim($name, "\" \t\n\r\0\x0B"));
                                        }, $names);
                                    @endphp

                                    @if (count($formattedNames) > 1)
                                        <span>{{ $formattedNames[0] }}</span>
                                        <i class="fas fa-info-circle text-primary" style="cursor: pointer;"
                                            data-bs-toggle="tooltip" title="Click to view all names"
                                            onclick="showNames('{{ implode(', ', $formattedNames) }}')">
                                        </i>
                                    @else
                                        <span>{{ $formattedNames[0] }}</span>
                                    @endif
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
                                <td>{{ $subApplication->phone_number }}</td>
                                <td>{{ $subApplication->planning_recommendation_status }}</td>
                                <td>{{ $subApplication->application_status }}</td>
                                <td class="relative">
                                    <div class="relative inline-block dropdown-container">
                                        <!-- Dropdown Toggle Button -->
                                        <button type="button" class="dropdown-toggle p-2 bg-gray-200 hover:bg-gray-300 focus:outline-none border-2 border-gray-400">
                                            <i class="material-icons">more_vert</i>
                                        </button>
                                        <!-- Dropdown Menu -->
                                        <ul class="absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-lg hidden action-menu z-50 text-sm">
                                            <li>
                                                <button type="button"
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 dropdown-item"
                                                    data-id="{{ $subApplication->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#actionsModal">
                                                    <div class="flex items-center">
                                                        <i class="material-icons text-green-500 mr-3">payments</i>
                                                        <span>Payments</span>
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 dropdown-item"
                                                    data-id="{{ $subApplication->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#OtherApprovals">
                                                    <div class="flex items-center">
                                                        <i class="material-icons text-red-500 mr-3">app_registration</i>
                                                        <span>Other Approvals</span>
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 dropdown-item planning-rec-btn"
                                                    data-id="{{ $subApplication->id }}">
                                                    <div class="flex items-center">
                                                        <i class="material-icons text-blue-500 mr-3">assignment</i>
                                                        <span>Planning Recommendation</span>
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 dropdown-item decision-mother-btn"
                                                    data-id="{{ $subApplication->id }}"
                                                    data-file-no="{{ $subApplication->fileno }}">
                                                    <div class="flex items-center">
                                                        <i class="material-icons text-green-600 mr-3">check_circle</i>
                                                        <span>Director's Approval</span>
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" 
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#eRegistryModal" data-id="{{ $subApplication->id }}">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-th-large text-red-500" style="width: 18px;"></i>
                                                        <span class="ml-2">E-Registry</span>
                                                    </div>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 dropdown-item"
                                                    data-id="{{ $subApplication->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#certificateModal{{ $subApplication->id }}">
                                                    <div class="flex items-center">
                                                        <i class="material-icons text-amber-500 mr-3">description</i>
                                                        <span>Certificate</span>
                                                    </div>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    @include('sectionaltitling.sub_appmodals.payment')
    @include('sectionaltitling.sub_appmodals.finalbill')
    @include('sectionaltitling.sub_appmodals.OtherApprovals')
    @include('sectionaltitling.sub_appmodals.survey')
    @include('sectionaltitling.sub_appmodals.deeds')
    @include('sectionaltitling.sub_appmodals.planningrecommendation')
    <script>
        // Handle dropdown menus
        $(document).ready(function() {
            // Toggle dropdown on button click
            $(document).on('click', '.dropdown-toggle', function(e) {
                e.stopPropagation();
                const container = $(this).closest('.dropdown-container');
                const menu = container.find('.action-menu');
                
                // Close all other open menus first
                $('.action-menu').not(menu).addClass('hidden');
                
                // Toggle current menu
                menu.toggleClass('hidden');
            });
            
            // Close dropdown when clicking on an item
            $(document).on('click', '.dropdown-item', function() {
                // If it's a planning recommendation button, show confirmation first
                if ($(this).hasClass('planning-rec-btn')) {
                    showDepartmentConfirmation('planningRec');
                }
                
                // If it's a payments button, open the payments modal
                if ($(this).data('bs-target') === '#actionsModal') {
                    openPaymentsModal($(this).data('id'));
                }
                
                // Close the dropdown
                $(this).closest('.action-menu').addClass('hidden');
            });
            
            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown-container').length) {
                    $('.action-menu').addClass('hidden');
                }
            });
            
            // Handle E-Registry modal
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
                    text: 'E-Registry information saved successfully!'
                });
                
                // Close the modal
                $('#eRegistryModal').modal('hide');
            });
        });
    </script>
@endsection
