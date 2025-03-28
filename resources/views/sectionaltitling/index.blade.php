{{-- filepath: c:\wamp64\www\gisedms\resources\views\instruments\index.blade.php --}}
@extends('layouts.app')
@section('page-title')
    {{ __('APPLICATION FOR SECTIONAL TITLING COMMERCIAL MODULE') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('APPLICATION FOR SECTIONAL TITLING COMMERCIAL MODULE') }}</li>
@endsection
@push('script-page')
    <script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>

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
@endpush



@section('content')
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
    </style>

    <div class="container mx-auto mt-4 p-4">

        <div class="container">


            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('sectionaltitling.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Create Application
                </a>
                <a href="{{ route('sectionaltitling.sub_applications') }}" class="btn btn-secondary">
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
                                @foreach ($Main_application as $application)
                                    <tr>
                                        <td>STM-2025-000-{{ $application->id }}</td>
                                        <td>{{ $application->fileno }}</td>
                                        <td>
                                            @if ($application->multiple_owners_names)
                                                {{ $application->multiple_owners_names }}
                                            @elseif ($application->corporate_name)
                                                {{ $application->corporate_name }}
                                            @else
                                                {{ $application->first_name }} {{ $application->middle_name }}
                                                {{ $application->surname }}
                                            @endif

                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($application->created_at)->format('Y-m-d') }}</td>
                                         <td>{{ $application->planning_recommendation_status }}</td>
                                         <td>{{ $application->application_status }}</td>
                                        <td>{{ $application->phone_number }}</td>
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
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center open-actions-modal"
                                                            data-id="{{ $application->id }}" data-bs-toggle="modal" data-bs-target="#actionsModal">
                                                            <i class="material-icons mr-2" style="color: #4CAF50;">payments</i>
                                                            Payments
                                                        </button>

                                                        <li>
                                                            <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center open-OtherApprovals-modal"
                                                                data-id="{{ $application->id }}" data-bs-toggle="modal" data-bs-target="#OtherApprovals">
                                                                <i class="fas fa-th-large text-red-500 mr-2"></i> 
                                                                Other Approvals
                                                            </button>
                                                        </li>


                                                    </li>

                                                      <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center"
                                                            onclick="showDepartmentConfirmation('planningRec')"
                                                            data-id="{{ $application->id }}">
                                                            <i class="fas fa-clipboard-check text-blue-500 mr-2"></i> Planning Recommendation
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center decision-mother-btn"
                                                            data-id="{{ $application->id }}">
                                                            <i class="fas fa-check-circle text-green-500 mr-2"></i> Director's Approval
                                                        </button>
                                                    </li>
                                                    
                                                  
                                        
                                                    {{-- <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center open-actions-modal"
                                                            data-id="{{ $application->id }}">
                                                            <i class="fas fa-th-large text-red-500 mr-2"></i> Actions
                                                        </button>
                                                    </li>  
                                                     --}}
                                                    <li>
                                                        <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center"
                                                            data-bs-toggle="modal" data-bs-target="#eRegistryModal" data-id="{{ $application->id }}">
                                                            <i class="fas fa-th-large text-red-500 mr-2"></i> E-Registry
                                                        </button>
                                                    </li>

                                                    @if ($application->application_status == 'Approved')
                                                        <li>
                                                            <a href="{{ route('sectionaltitling.sub_application', [
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
                                                            ]) }}" class="block px-4 py-2 hover:bg-gray-100 flex items-center">
                                                                <i class="fas fa-plus-square text-green-500 mr-2"></i> Create ST Record
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li class="opacity-50 cursor-not-allowed">
                                                            <a href="#" class="block px-4 py-2 flex items-center">
                                                                <i class="fas fa-plus-square text-gray-500 mr-2"></i> Create ST Record (Disabled)
                                                            </a>
                                                        </li>
                                                    @endif
                                                    
                                                    <li>
                                                         
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
            <!-- Actions Modal -->
           <!-- MODAL -->

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
                        onclick="showDepartmentConfirmation('finance')">
                        Initiate Bill
                        <i class="material-icons" style="color: #4CAF50;">account_balance</i>
                   
                  
                    <button class="bttn pink-shadow"
                        data-id="{{ $application->id }}"
                        data-fileno="{{ $application->fileno }}"
                        data-applicant_title="{{ $application->applicant_title }}"
                        data-owner-name="{{ $application->corporate_name ?? $application->multiple_owners_names ?? ($application->first_name . ' ' . $application->middle_name . ' ' . $application->surname) }}"
                        data-plot-house-no="{{ $application->plot_house_no }}"
                        data-plot-street-name="{{ $application->plot_street_name }}"
                        data-owner-district="{{ $application->owner_district }}"
                        data-approval-date="{{ $application->approval_date }}"
                        data-address="{{ $application->address }}"
                        data-plot_size="{{ $application->plot_size }}"
                        data-land_use="{{ $application->land_use }}"
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
                    PDFObject.embed("{{ asset('storage/uploads/betterment_bill.pdf') }}", "#bettermentPdfViewer", {
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
                    <button class="bttn purple-shadow" onclick="showDepartmentConfirmation('lands')">
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

            

           
  

           

<!-- Deeds Modal -->
<div class="modal fade" id="deedsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deeds</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deedsForm">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Serial No</label>
                            <input type="text" class="form-control" value="10" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Page No</label>
                            <input type="text" class="form-control" value="10" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Volume NO</label>
                            <input type="text" class="form-control" value="1" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Deeds Time</label>
                            <input type="text" class="form-control" value="12:00 PM" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deeds Date</label>
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled>
                        </div>
                    </div> 
                    
                    <div class="modal-footer" style="background-color: #f1f1f1;">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow" data-bs-dismiss="modal" aria-label="Close"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 150px; height: 40px;">
                                Close
                                <i class="material-icons" style="color: #c70707; font-size: 16px;">cancel</i>
                            </button>
                             
                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 150px; height: 40px;">
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

            <!-- Department Approval Modals -->
            <div class="modal fade" id="financeModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Initial Bill</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="financeForm">
                                <!-- Receipt Details Section -->
                                <div class="row mb-4">
                                    <h6>Receipt Details</h6>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="form-label">Receipt No</label>
                                            <input type="text" class="form-control" name="receipt_no" value="REC-2025-001" disabled>
                                        </div>
                                        <div>
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" name="receipt_date" value="<?php echo date('Y-m-d'); ?>" disabled>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fees Section -->
                                <div class="row mb-4">
                                    <h6>Fees</h6>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="form-label">Application Fee (₦)</label>
                                            <input type="number" min="0" step="0.01" class="form-control" name="application_amount" value="10000" disabled>
                                        </div>
                                        <div>
                                            <label class="form-label">Processing Fee (₦)</label>
                                            <input type="number" min="0" step="0.01" class="form-control" name="processing_amount" value="15000" disabled>
                                        </div>
                                        <div>
                                            <label class="form-label">Site Plan Fee (₦)</label>
                                            <input type="number" min="0" step="0.01" class="form-control" name="site_plan_amount" value="20000" disabled>
                                        </div>
                                        <div>
                                            <label class="form-label">Total Amount (₦)</label>
                                            <input type="number" class="form-control" id="totalAmount" value="45000" readonly disabled>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Amount (Calculated automatically) -->
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Total Amount (₦)</label>
                                        <input type="number" class="form-control" id="totalAmount" value="45000" readonly disabled>
                                    </div>
                                </div>       

                                <div class="modal-footer" style="background-color: #f1f1f1;">
                                    <div style="display: grid; grid-template-columns: 1fr auto; gap: 8px; width: 100%;">
                                        <button type="button" class="bttn green-shadow" data-bs-dismiss="modal" aria-label="Close"
                                            style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 6px 12px; width: 150px; height: 40px;">
                                            Close
                                            <i class="material-icons" style="color: #c70707; font-size: 16px;">cancel</i>
                                        </button>
                                         
                                        <button type="submit" class="bttn green-shadow"
                                            style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 8px 12px; width: 150px; height: 40px;">
                                            Submit
                                            <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <script>
                            document.getElementById('financeForm').addEventListener('input', function(e) {
                                if (e.target.type === 'number') {
                                    calculateTotal();
                                }
                            });

                            function calculateTotal() {
                                const applicationAmount = parseFloat(document.querySelector('[name="application_amount"]').value) || 0;
                                const processingAmount = parseFloat(document.querySelector('[name="processing_amount"]').value) || 0;
                                const sitePlanAmount = parseFloat(document.querySelector('[name="site_plan_amount"]').value) || 0;
                                
                                const total = applicationAmount + processingAmount + sitePlanAmount;
                                document.getElementById('totalAmount').value = total.toFixed(2);
                            }
                            </script>
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

                                    <!-- Second row -->
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
                                <iframe src="{{ route('sectionaltitling.generate_bill') }}" style="width: 100%; height: 600px;" id="billFrame"></iframe>
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
            <div class="modal fade" id="eRegistryModal" tabindex="-1" aria-labelledby="eRegistryModalLabel" aria-hidden="true">
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
                                            <label class="form-label">File Number</label>
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
                                <div class="modal-footer" style="background-color: #f1f1f1; display: flex; justify-content: space-between; padding-top: 20px; padding-right: 20px; padding-left: 20px;">
                                    <button type="button" class="bttn green-shadow" onclick="showDepartmentConfirmation('ok')" style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); transform: translateY(-5px);">
                                        OK
                                        <i class="material-icons" style="color: #4CAF50;">check_circle</i>
                                    </button>
                                    <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')" style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); margin-right: 10px; transform: translateY(-5px);">
                                        Edit
                                        <i class="material-icons" style="color: #9E9E9E;">edit</i>
                                    </button>
                                    <button type="submit" class="bttn green-shadow"
                                    style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px; transform: translateY(-5px);">
                                    Submit
                                    <i class="material-icons" style="color: #4CAF50; font-size: 16px;">send</i>
                                </button>
                                </div>
                            </form>
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

                        const url = `{{ route('sectionaltitling.generate_bill') }}?id=${applicationId}&fileno=${fileno}&applicant_title=${applicantTitle}&owner_name=${ownerName}&address=${address}&plot_house_no=${plotHouseNo}&plot_street_name=${plotStreetName}&owner_district=${ownerDistrict}&approval_date=${approvalDate}&plot_size=${plotSize}&land_use=${landUse}`;
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

            </script>

            <!-- Global Decision Modal for Main Applications -->
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
                            url: "{{ route('sectionaltitling.decisionMotherApplication') }}",
                            type: 'POST',
                            data: {
                                id: id,
                                decision: decision,
                                approval_date: approval_date,
                                comments: comments,
                                _token: "{{ csrf_token() }}"
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
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; width: 100%;">
                            <button type="button" class="bttn green-shadow" 
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;" data-bs-dismiss="modal">
                                Cancel
                                <i class="material-icons" style="color: #f44336; font-size: 16px;">cancel</i>
                            </button>
                            <button type="button" class="bttn gray-shadow" onclick="showDepartmentConfirmation('edit')"
                                style="box-shadow: 0 4px 8px rgba(158, 158, 158, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;">
                                Submit
                                <i class="material-icons" style="color: #9E9E9E; font-size: 16px;">edit</i>
                            </button>
                            <button type="submit" class="bttn green-shadow"
                                style="box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3); font-size: 12px; padding: 4px 8px; width: 120px;"  onclick="showPrintModal()">
                                Print
                                <i class="material-icons" style="color: #4CAF50; font-size: 16px;">print</i>
                            </button>
                        </div>
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

<script>
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
@endsection