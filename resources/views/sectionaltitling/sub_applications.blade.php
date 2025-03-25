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
                        <td>STM-2025-000{{ $subApplication->main_application_id }}</td>
                        <td>{{ $subApplication->fileno }}</td>
                        <td>
                           @if ($subApplication->multiple_owners_names)
                              @php
                                 $ownerNames = json_decode($subApplication->multiple_owners_names);
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
                        <td>
                           <div class="d-flex flex-column">
                                <button type="button" class="btn btn-info mb-1" data-bs-toggle="modal"
                                  data-bs-target="#actionsModal{{ $subApplication->id }}">
                                  <i class="fa fa-th"></i> Action
                                </button>
                                <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal"
                                data-bs-target="#certificateModal{{ $subApplication->id }}">
                                <i class="fa fa-certificate"></i>
                              </button>
                                <!-- Actions Modal -->
                                <div class="modal fade" id="actionsModal{{ $subApplication->id }}" tabindex="-1"
                                  aria-labelledby="actionsModalLabel{{ $subApplication->id }}" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                         <h5 class="modal-title" id="actionsModalLabel{{ $subApplication->id }}">Actions</h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                           aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                         <div class="container">
                                           <div class="row row-cols-3 g-3">
                                             <!-- E-Registry Button -->
                                             <div class="col">
                                                <button type="button" class="btn btn-primary w-100"
                                                  data-bs-toggle="modal"
                                                  data-bs-target="#eRegistryModal{{ $subApplication->id }}">
                                                  <i class="fa fa-book"></i> E-Registry
                                                </button>
                                             </div>

                                             <!-- View & Print Acceptance Button -->
                                             <div class="col">
                                                <button type="button" class="btn btn-primary w-100"
                                                  data-bs-toggle="modal"
                                                  data-bs-target="#viewPrintAcceptanceModal{{ $subApplication->id }}">
                                                 View Acceptance
                                                </button>
                                             </div>

                                             <!-- Generate Bill Button -->
                                             <div class="col">
                                                <button type="button" class="btn btn-danger w-100 generate-bill"
                                                  data-id="{{ $subApplication->id }}"
                                                  data-main_fileno="{{ $subApplication->main_fileno }}"
                                                  data-fileno="{{ $subApplication->fileno }}"
                                                  data-applicant-title="{{ $subApplication->applicant_title }}"
                                                  data-owner-name="@if ($subApplication->multiple_owners_names){{ $subApplication->multiple_owners_names }}@elseif ($subApplication->corporate_name){{ $subApplication->corporate_name }}@else{{ $subApplication->applicant_title }} {{ $subApplication->first_name }} {{ $subApplication->surname }} {{ $subApplication->middle_name }}@endif"
                                                  data-plot-house-no="{{ $subApplication->plot_house_no }}"
                                                  data-plot-street-name="{{ $subApplication->plot_street_name }}"
                                                  data-owner-district="{{ $subApplication->owner_district }}"
                                                  data-address="{{ $subApplication->address }}"
                                                  data-plot_size="{{ $subApplication->plot_size }}"
                                                  data-land_use="{{ $subApplication->land_use }}"
                                                  data-approval-date="{{ $subApplication->approval_date }}">
                                                  <i class="fa fa-file-invoice-dollar"></i> Generate Bill
                                                </button>
                                             </div>
                                              <div class="col">
                                                  <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal"
                                                    data-bs-target="#viewTDPModal{{ $subApplication->id }}">
                                                    <i class="fa fa-eye"></i> View TDP
                                                  </button>
                                                </div>
                                                <div class="col">
                                                  <button type="button" class="btn btn-secondary btn-sm w-100" data-bs-toggle="modal"
                                                    data-bs-target="#printTDPModal{{ $subApplication->id }}">
                                                    <i class="fa fa-print"></i> Print TDP
                                                  </button>
                                                </div>
                                                <div class="col">
                                                  <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal"
                                                    data-bs-target="#viewCofOModal{{ $subApplication->id }}">
                                                    <i class="fa fa-eye"></i> View CofO
                                                  </button>
                                                </div>
                                                <div class="col">
                                                  <button type="button" class="btn btn-secondary btn-sm w-100" data-bs-toggle="modal"
                                                    data-bs-target="#printCofOModal{{ $subApplication->id }}">
                                                    <i class="fa fa-print"></i> Print CofO
                                                  </button>
                                                </div>
                                           </div>
                                         </div>
                                       </div>
                                    </div>
                                  </div>
                                </div>
                           </div>
                        </td>
                     </tr>

                     <!-- Certificate Modal -->
                     <div class="modal" id="certificateModal{{ $subApplication->id }}" tabindex="-1"
                        aria-labelledby="certificateModalLabel{{ $subApplication->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="certificateModalLabel{{ $subApplication->id }}">Certificate Actions</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div class="container">
                                    <div class="row row-cols-2 g-4">
                                       <div class="col">
                                          <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal"
                                             data-bs-target="#viewTDPModal{{ $subApplication->id }}">
                                             <i class="fa fa-eye"></i> View TDP
                                          </button>
                                       </div>
                                       <div class="col">
                                          <button type="button" class="btn btn-secondary btn-sm w-100" data-bs-toggle="modal"
                                             data-bs-target="#printTDPModal{{ $subApplication->id }}">
                                             <i class="fa fa-print"></i> Print TDP
                                          </button>
                                       </div>
                                       <div class="col">
                                          <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal"
                                             data-bs-target="#viewCofOModal{{ $subApplication->id }}">
                                             <i class="fa fa-eye"></i> View CofO
                                          </button>
                                       </div>
                                       <div class="col">
                                          <button type="button" class="btn btn-secondary btn-sm w-100" data-bs-toggle="modal"
                                             data-bs-target="#printCofOModal{{ $subApplication->id }}">
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
                                    <div class="mb-3">
                                       <label class="form-label">Registry Number</label>
                                       <input type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                       <label class="form-label">Registration Date</label>
                                       <input type="date" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                       <label class="form-label">Registered By</label>
                                       <input type="text" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                       <label class="form-label">Comments</label>
                                       <textarea class="form-control" rows="3"></textarea>
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
</script>
