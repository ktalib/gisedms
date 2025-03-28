@extends('layouts.app')
@section('page-title', __('Sub-Applications'))
@section('breadcrumb')
   <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
   <li class="breadcrumb-item" aria-current="page">{{ __('Sub-Applications') }}</li>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.14/iconfont/material-icons.min.css">
@section('content')
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
   font-weight: bold;
   color: #4a5568;
   background-color: white;
   transition: all 0.3s ease;
   text-transform: capitalize;
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
      <div class="card shadow-sm">
         <div class="card-body">
            <h5 class="card-title">{{ __('Sub-Applications') }}</h5>
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
                  @foreach ($subApplications as $subApplication)
                     <tr>
                        <td>STM-2025-000-{{ $subApplication->main_application_id }}</td>
                        <td>{{ $subApplication->fileno }}</td>
                        <td>
                           @if ($subApplication->multiple_owners_names)
                                @php
                                  $ownerNames = $subApplication->multiple_owners_names;
                                  if (!is_array($ownerNames)) {
                                      $ownerNames = json_decode("[$ownerNames]");
                                  }
                                  $ownerNames = array_map(function($name) {
                                    return trim($name, '"');
                                  }, $ownerNames ?? []);
                                @endphp
                              @if (is_array($ownerNames))
                                 {{ implode(', ', $ownerNames) }}
                              @else
                                 {{ $subApplication->multiple_owners_names }}
                              @endif
                           @elseif ($subApplication->corporate_name)
                              {{ $subApplication->corporate_name }}
                           @else
                              {{ $subApplication->first_name }} {{ $subApplication->middle_name }} {{ $subApplication->surname }}
                           @endif
                        </td>
                        <td>{{ $subApplication->phone_number }}</td>
                        <td>{{ $subApplication->application_status }}</td>
                        <td class="relative">
                           <div class="relative inline-block">
                            <!-- Dropdown Toggle Button -->
                           <button onclick="toggleDropdown(this)" class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 focus:outline-none border-2 border-gray-400">
                             <i class="material-icons">more_horiz</i>
                           </button>
                            <!-- Dropdown Menu -->
                            <ul class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg hidden action-menu z-50">
                             <li>
                              <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center"
                              onclick="showDepartmentConfirmation('planningRec')"
                              data-id="{{ $subApplication->id }}">
                              <i class="fas fa-clipboard-check text-blue-500 mr-2"></i> Planning Recommendation
                          </button>
                            </li>
                             <li>
                               <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center text-sm approve-btn" data-id="{{ $subApplication->id }}" data-fileno="{{ $subApplication->fileno }}">
                                 <i class="material-icons text-success me-2">check_circle</i> Director's Approval
                               </button>
                              </li>

                              <li>
                               <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center text-sm" data-bs-toggle="modal" data-bs-target="#actionsModal{{ $subApplication->id }}" @if($subApplication->application_status != 'Approved') disabled @endif>
                                 <i class="material-icons text-danger me-2">apps</i> Actions
                               </button>
                              </li>

                              <li>
                               <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center text-sm generate-bill" data-id="{{ $subApplication->id }}" data-main_fileno="{{ $subApplication->main_fileno }}" data-fileno="{{ $subApplication->fileno }}" data-applicant-title="{{ $subApplication->applicant_title }}" data-owner-name="@if ($subApplication->multiple_owners_names){{ $subApplication->multiple_owners_names }}@elseif ($subApplication->corporate_name){{ $subApplication->corporate_name }}@else{{ $subApplication->applicant_title }} {{ $subApplication->first_name }} {{ $subApplication->surname }} {{ $subApplication->middle_name }}@endif" data-plot-house-no="{{ $subApplication->plot_house_no }}" data-plot-street-name="{{ $subApplication->plot_street_name }}" data-owner-district="{{ $subApplication->owner_district }}" data-address="{{ $subApplication->address }}" data-plot_size="{{ $subApplication->plot_size }}" data-land_use="{{ $subApplication->land_use }}" data-approval-date="{{ $subApplication->approval_date }}" @if($subApplication->application_status != 'Approved') disabled @endif>
                                 <i class="material-icons me-2">receipt</i> Generate Bill
                               </button>
                              </li>
                             
                              <li>
                               <button type="button" class="block w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center text-sm" data-bs-toggle="modal" data-bs-target="#certificateModal{{ $subApplication->id }}" @if($subApplication->application_status != 'Approved') disabled @endif>
                                 <i class="material-icons text-warning me-2">verified</i> Certificate
                               </button>
                              </li>
                              
                            </ul>
                           </div>
                        </td>
                     </tr>


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

                     <!-- Certificate Modal -->
                      <div class="modal fade" id="certificateModal{{ $subApplication->id }}" tabindex="-1"
                        aria-labelledby="certificateModalLabel{{ $subApplication->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width:300px;">
                           <div class="modal-content">
                             <div class="modal-header" style="height: 30px;">
                               <h5 class="modal-title" id="certificateModalLabel{{ $subApplication->id }}">Certificate Actions</h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    <button class="bttn" data-bs-toggle="modal" data-bs-target="#viewTDPModal{{ $subApplication->id }}">
                                      View TDP
                                      <i class="material-icons" style="color: #4CAF50;">visibility</i>
                                    </button>
                                    <button class="bttn" data-bs-toggle="modal" data-bs-target="#printTDPModal{{ $subApplication->id }}">
                                      Print TDP
                                      <i class="material-icons" style="color: #2196F3;">print</i>
                                    </button>
                                    <button class="bttn" data-bs-toggle="modal" data-bs-target="#viewCofOModal{{ $subApplication->id }}">
                                      View CofO
                                      <i class="material-icons" style="color: #FF9800;">visibility</i>
                                    </button>
                                    <button class="bttn" data-bs-toggle="modal" data-bs-target="#printCofOModal{{ $subApplication->id }}">
                                      Print CofO
                                      <i class="material-icons" style="color: #9C27B0;">print</i>
                                    </button>
                                 </div>
                               </div>
                             </div>
                           </div>
                        </div>
                      </div>

                   

                     <!-- View TDP Modal -->
                     <div class="modal fade" id="viewTDPModal{{ $subApplication->id }}" tabindex="-1"
                        aria-labelledby="viewTDPModalLabel{{ $subApplication->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="viewTDPModalLabel{{ $subApplication->id }}">View TDP</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div id="viewTDPContainer{{ $subApplication->id }}" style="height: 80vh;"></div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Print TDP Modal -->
                     <div class="modal fade" id="printTDPModal{{ $subApplication->id }}" tabindex="-1"
                        aria-labelledby="printTDPModalLabel{{ $subApplication->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="printTDPModalLabel{{ $subApplication->id }}">Print TDP</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div id="printTDPContainer{{ $subApplication->id }}" style="height: 80vh;"></div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- View CofO Modal -->
                     <div class="modal fade" id="viewCofOModal{{ $subApplication->id }}" tabindex="-1"
                        aria-labelledby="viewCofOModalLabel{{ $subApplication->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="viewCofOModalLabel{{ $subApplication->id }}">View CofO</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div id="viewCofOContainer{{ $subApplication->id }}" style="height: 80vh;"></div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Print CofO Modal -->
                     <div class="modal fade" id="printCofOModal{{ $subApplication->id }}" tabindex="-1"
                        aria-labelledby="printCofOModalLabel{{ $subApplication->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="printCofOModalLabel{{ $subApplication->id }}">Print CofO</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div id="printCofOContainer{{ $subApplication->id }}" style="height: 80vh;"></div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- View & Print Acceptance Modal -->
                     <div class="modal fade" id="viewPrintAcceptanceModal{{ $subApplication->id }}" tabindex="-1"
                        aria-labelledby="viewPrintAcceptanceModalLabel{{ $subApplication->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="viewPrintAcceptanceModalLabel{{ $subApplication->id }}">View & Print Acceptance</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div class="container">
                                    <iframe id="acceptanceIframe{{ $subApplication->id }}"
                                       src="{{ route('sectionaltitling.AcceptLetter') }}" style="width:100%; height:500px;"
                                       frameborder="0"></iframe>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <button type="button" class="btn btn-primary"
                                    onclick="printIframe('acceptanceIframe{{ $subApplication->id }}')">Print</button>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Add E-Registry Modal -->
                     <div class="modal fade" id="eRegistryModal{{ $subApplication->id }}" tabindex="-1"
                        aria-labelledby="eRegistryModalLabel{{ $subApplication->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="eRegistryModalLabel{{ $subApplication->id }}">E-Registry</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                                <div class="modal-body">
                                  <form>
                                    <div class="row">
                                       <div class="col-md-6 mb-3">
                                         <label class="form-label">Registry Number</label>
                                         <input type="text" class="form-control" required>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                         <label class="form-label">Registration Date</label>
                                         <input type="date" class="form-control" required>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6 mb-3">
                                         <label class="form-label">Registered By</label>
                                         <input type="text" class="form-control" required>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                         <label class="form-label">Comments</label>
                                         <textarea class="form-control" rows="3"></textarea>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                                    <iframe src="" style="width: 100%; height: 600px;" id="billFrame"></iframe>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <button type="button" class="btn btn-primary" onclick="printBill()">Print Bill</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <center>
   </center>

   <!-- Global Decision Modal for Sub-Applications -->
   <div class="modal fade" id="decisionModalSub" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <form id="decisionFormSub">
               <div class="modal-header">
                  <h5 class="modal-title">Confirm Decision</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="id" id="decisionSubId">
                  <div class="mb-3">
                     <label for="decision" class="form-label">Decision</label>
                     <select name="decision" id="decision" class="form-control">
                        <option value="approve" selected>Approve</option>
                        <option value="decline">Decline</option>
                     </select>
                  </div>
                  <div class="mb-3" id="declineReasonGroup" style="display:none;">
                     <label for="declineReasonSub" class="form-label">Reason For Decline</label>
                     <textarea class="form-control" id="declineReasonSub" name="comments"></textarea>
                  </div>
                  <div class="mb-3">
                     <label for="approvalDateSub" class="form-label">Approval/Decline Date</label>
                     <input type="datetime-local" class="form-control" id="approvalDateSub" name="approval_date" required>
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
      // Ensure the event is attached to the select element for decision changes.
      $('#decision').on('change', function() {
         if ($(this).val() === 'decline') {
            $('#declineReasonGroup').show();
         } else {
            $('#declineReasonGroup').hide();
         }
      });
   </script>
   <script>
      function printIframe(frameId) {
         const iframe = document.getElementById(frameId);
         iframe.contentWindow.focus();
         iframe.contentWindow.print();
      }
   </script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.8/pdfobject.min.js"></script>
   <script>
      @foreach ($subApplications as $subApplication)
         // Initialize PDFObject for each modal
         PDFObject.embed("{{ asset('storage/uploads/Sectional Title TDP for Usamn Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf') }}",
            "#viewTDPContainer{{ $subApplication->id }}");
         PDFObject.embed("{{ asset('storage/uploads/Sectional Title TDP for Usamn Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf') }}",
            "#printTDPContainer{{ $subApplication->id }}");
         PDFObject.embed("{{ asset('storage/uploads/Sectional Title CofO for Usman Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf') }}",
            "#viewCofOContainer{{ $subApplication->id }}");
         PDFObject.embed("{{ asset('storage/uploads/Sectional Title CofO for Usman Adamu PLOT NO-2, BLOCK NO-3, FLOOR NO-2, FLAT NO-1_KN0010.pdf') }}",
            "#printCofOContainer{{ $subApplication->id }}");

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
      @endforeach
   </script>

   <!-- SweetAlert2 -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- jQuery already included -->
   <script>
      $(document).ready(function() {
         // ...existing DataTables and other code...

         // Handle Approve button click
         $('.approve-btn').on('click', function() {
            const id = $(this).data('id');
            const fileno = $(this).data('fileno');
            $('#approveId').val(id);
            $('#approveFileno').val(fileno);
            $('#approveModal').modal('show');
         });

         // Approve form submission via AJAX
         $('#approveForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#approveId').val();
            const fileno = $('#approveFileno').val();                        
            $.ajax({
               url: "{{ route('sectionaltitling.approveSubApplication') }}",
               type: 'POST',
               data: {
                  id: id,
                  _token: "{{ csrf_token() }}"
               },
               success: function(response) {
                  $('#approveModal').modal('hide');
                  Swal.fire({
                     icon: 'success',
                     title: 'Approved',
                     text: response.message
                  }).then(() => {
                     location.reload();
                  });
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

         // Handle Decline button click
         $('.decline-btn').on('click', function() {
            const id = $(this).data('id');
            $('#declineId').val(id);
            $('#declineReason').val('');
            $('#declineModal').modal('show');
         });

         // Decline form submission via AJAX
         $('#declineForm').on('submit', function(e) {
            e.preventDefault();
            const id = $('#declineId').val();
            const reason = $('#declineReason').val();
            $.ajax({
               url: "{{ route('sectionaltitling.declineSubApplication') }}",
               type: 'POST',
               data: {
                  id: id,
                  reason: reason,
                  _token: "{{ csrf_token() }}"
               },
               success: function(response) {
                  $('#declineModal').modal('hide');
                  Swal.fire({
                     icon: 'success',
                     title: 'Declined',
                     text: response.message
                  }).then(() => {
                     location.reload();
                  });
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

   <script>
      function printBill() {
         const iframe = document.getElementById('billFrame');
         iframe.contentWindow.focus();
         iframe.contentWindow.print();
      }

      $(document).ready(function() {
         // ...existing code...

         $('.generate-bill').on('click', function() {
            const applicationId = $(this).data('id');
            const mainFileno = $(this).data('main_fileno');
            const fileno = $(this).data('fileno');
            const applicantTitle = $(this).data('applicant-title');
            const ownerName = $(this).data('owner-name');
            const plotHouseNo = $(this).data('plot-house-no');
            const plotStreetName = $(this).data('plot-street-name');
            const ownerDistrict = $(this).data('owner-district');
            const address = $(this).data('address');
            const plotSize = $(this).data('plot_size');
            const landUse = $(this).data('land_use');
            const approvalDate = $(this).data('approval-date');

            const url = `{{ route('sectionaltitling.generate_bill') }}?id=${applicationId}&main_fileno=${mainFileno}&fileno=${fileno}&applicant_title=${applicantTitle}&owner_name=${ownerName}&plot_house_no=${plotHouseNo}&plot_street_name=${plotStreetName}&owner_district=${ownerDistrict}&address=${address}&plot_size=${plotSize}&land_use=${landUse}&approval_date=${approvalDate}`;
            $('#billFrame').attr('src', url);
            $('#generateBillModal').modal('show');
         });
      });
   </script>
@endsection

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
 
   $(document).ready(function() {
      // Toggle decline reason visibility
      $('#decisionFormSub input[name="decision"]').on('change', function() {
         if ($(this).val() === 'decline') {
            $('#declineReasonGroup').show();
         } else {
            $('#declineReasonGroup').hide();
         }
      });
      
      // Open decision modal when either approve or decline button is clicked
      $('.approve-btn, .decline-btn').on('click', function() {
         const subId = $(this).data('id');
         $('#decisionSubId').val(subId);
         // Reset: default to approve and hide decline field
         $('#decApprove').prop('checked', true);
         $('#declineReasonGroup').hide();
         // Set current datetime as default
         const now = new Date().toISOString().slice(0,16);
         $('#approvalDateSub').val(now);
         $('#decisionModalSub').modal('show');
      });
      
      // Submit decision via AJAX
      $('#decisionFormSub').on('submit', function(e) {
         e.preventDefault();
         const subId = $('#decisionSubId').val();
         const decision = $('#decisionFormSub input[name="decision"]:checked').val();
         const approvalDate = $('#approvalDateSub').val();
         const comments = $('#declineReasonSub').val();
         $.ajax({
            url: "{{ route('sectionaltitling.decisionSubApplication') }}",
            type: "POST",
            data: {
               id: subId,
               decision: decision,
               approval_date: approvalDate,
               comments: comments,
               _token: "{{ csrf_token() }}"
            },
            success: function(response) {
               $('#decisionModalSub').modal('hide');
               Swal.fire({
                  icon: 'success',
                  title: (decision === 'approve' ? 'Approved' : 'Declined'),
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
 
   function showDepartmentConfirmation(department) {
                    if (department === 'planningRec') {
                        $('#planningRecommendationModal').modal('show');
                        return;
                    }
                    $(`#${department}Modal`).modal('show'); // Ensure the modal ID matches
                }

function toggleDropdown(button) {
  const dropdown = button.parentElement.querySelector('.action-menu');
  if (dropdown) {
    dropdown.classList.toggle('hidden');
  }
}


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

                            $('input[name="submit_design"]').change(function() {
                        $('#architecturalSubmitBtn').prop('disabled', this.value === 'no');
                    });
        
        </script>
