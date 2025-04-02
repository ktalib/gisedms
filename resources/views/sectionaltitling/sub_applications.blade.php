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
                            <th style="text-transform: none; background-color:   color: #005f16;">ST FileNo</th>
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
                                    <div class="relative inline-block">
                                        <!-- Dropdown Toggle Button -->
                                        <button onclick="toggleDropdown(this)"
                                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none border-2 border-gray-400">
                                            <i class="material-icons">more_horiz</i>
                                        </button>
                                        <!-- Dropdown Menu -->
                                        <ul
                                            class="absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-lg hidden action-menu z-50 text-sm">

                                            <li>
                                                <button type="button"
                                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center"
                                                    data-id="{{ $subApplication->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#actionsModal"
                                                    onclick="openPaymentsModal('{{ $subApplication->id }}')">
                                                    <i class="material-icons text-green-500 mr-3">payments</i>
                                                    <span>Payments</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center"
                                                    data-id="{{ $subApplication->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#OtherApprovals">
                                                    <i class="material-icons text-red-500 mr-3">app_registration</i>
                                                    <span>Other Approvals</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center"
                                                    onclick="showDepartmentConfirmation('planningRec')"
                                                    data-id="{{ $subApplication->id }}">
                                                    <i class="material-icons text-blue-500 mr-3">assignment</i>
                                                    <span>Planning Recommendation</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center decision-mother-btn"
                                                    data-id="{{ $subApplication->id }}"
                                                    data-fileno="{{ $subApplication->fileno }}">
                                                    <i class="material-icons text-green-600 mr-3">check_circle</i>
                                                    <span>Director's Approval</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center"
                                                    data-id="{{ $subApplication->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#certificateModal{{ $subApplication->id }}">
                                                    <i class="material-icons text-amber-500 mr-3">description</i>
                                                    <span>Certificate</span>
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
    @include('sectionaltitling.sub_appmodals.genBetterment')
    @include('sectionaltitling.sub_appmodals.certificats')
    @include('sectionaltitling.sub_appmodals.printAcceptance')
    @include('sectionaltitling.sub_appmodals.eregistry')
    @include('sectionaltitling.sub_appmodals.director')
    @include('sectionaltitling.partials.sub_initailbill')
    @include('sectionaltitling.sub_appmodals.sub_js')
@endsection
