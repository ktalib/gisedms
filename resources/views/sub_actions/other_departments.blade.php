@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING  MODULE') }}
@endsection

<style>

   
    .tab-content {
      display: none;
    }
    .tab-content.active {
      display: block;
    }
    .tab-button {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    .tab-button.active {
      background-color: #f3f4f6;
      font-weight: 500;
    }
    .tab-button:hover:not(.active) {
      background-color: #f9fafb;
    }
  </style>
@include('sectionaltitling.partials.assets.css')
@section('content')
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        @include('admin.header')
        <!-- Dashboard Content -->
        <div class="p-6">
           
          
            <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
              

                <div class="modal-content p-6">
                    <div class="flex justify-between items-center mb-4">
                      <h2 class="text-lg font-medium">Other Departments</h2>
                      <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <i data-lucide="x" class="w-5 h-5"></i>
                      </button>
                    </div>
                    
                    <div class="py-2">
                      <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                        <!-- Primary Application Info (First, as requested) -->
                        <div class="flex items-center mb-3">
                          <div class="bg-blue-100 text-blue-800 rounded-full p-1 mr-2">
                            <i data-lucide="file-check" class="w-4 h-4"></i>
                          </div>
                          <div>
                            <h3 class="text-sm font-medium text-blue-800">Primary Application</h3>
                            <p class="text-xs text-gray-700">
                              {{ $application->primary_applicant_title ?? '' }} {{ $application->primary_first_name ?? '' }} {{ $application->primary_surname ?? '' }}
                              <span class="inline-flex items-center px-2 py-0.5 ml-1 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                <i data-lucide="link" class="w-3 h-3 mr-1"></i>File No: {{ $application->primary_fileno ?? 'N/A' }}
                              </span>
                            </p>
                          </div>
                        </div>
                        
                        <!-- Current Application Info -->
                        <div class="flex justify-between items-center border-t border-gray-200 pt-3">
                          <div>
                            <h3 class="text-sm font-medium">{{ $application->land_use ?? 'Property' }}</h3>
                            <p class="text-xs text-gray-600 mt-1">
                              File No: <span class="font-medium">{{ $application->fileno ?? 'N/A' }}</span>
                            </p>
                          </div>
                          <div class="text-right">
                            <h3 class="text-sm font-medium">{{ $application->applicant_title ?? '' }} {{ $application->surname ?? '' }} {{ $application->first_name ?? '' }}</h3>
                            <p class="text-xs text-gray-600 mt-1">Applicant</p>
                          </div>
                        </div>
                      </div>
                
                      <!-- Tabs Navigation -->
                      
                  

                      <div class="grid grid-cols-3 gap-2 mb-4">
                        <button class="tab-button active" data-tab="initial">
                          <i data-lucide="banknote" class="w-3.5 h-3.5 mr-1.5"></i>
                          SURVEY
                        </button>
                        <button class="tab-button" data-tab="detterment">
                          <i data-lucide="calculator" class="w-3.5 h-3.5 mr-1.5"></i>
                         DEEDS
                        </button>
                        <button class="tab-button" data-tab="final">
                          <i data-lucide="file-check" class="w-3.5 h-3.5 mr-1.5"></i>
                          LANDS
                        </button>
                      </div>

                  <form id="survey-form" method="POST">
                      @csrf
                      <!-- Survey Tab -->
                      <div id="initial-tab" class="tab-content active">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                          <div class="p-4 border-b">
                            <h3 class="text-sm font-medium">Survey</h3>
                            <p class="text-xs text-gray-500">Fill in the survey details for the property</p>
                          </div>
                          <div class="p-4 space-y-4">
                            <input type="hidden" id="application_id" name="application_id" value="{{$application->id}}">
                            <input type="hidden" name="fileno" value="{{$application->fileno}}">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="survey-by" class="text-xs font-medium block">
                                        Survey By
                                    </label>
                                    <input id="survey-by" name="survey_by" type="text" placeholder="Enter surveyor's name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label for="survey-date" class="text-xs font-medium block">
                                        Date
                                    </label>
                                    <input id="survey-date" name="survey_by_date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                            </div>
                
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="drawn-by" class="text-xs font-medium block">
                                        Drawn By
                                    </label>
                                    <input id="drawn-by" name="drawn_by" type="text" placeholder="Enter drafter's name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label for="drawn-date" class="text-xs font-medium block">
                                        Date
                                    </label>
                                    <input id="drawn-date" name="drawn_by_date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                            </div>
                
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="checked-by" class="text-xs font-medium block">
                                        Checked By
                                    </label>
                                    <input id="checked-by" name="checked_by" type="text" placeholder="Enter checker name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label for="checked-date" class="text-xs font-medium block">
                                        Date
                                    </label>
                                    <input id="checked-date" name="checked_by_date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                            </div>
                
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="approved-by" class="text-xs font-medium block">
                                        Approved By
                                    </label>
                                    <input id="approved-by" name="approved_by" type="text" placeholder="Enter approver's name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label for="approved-date" class="text-xs font-medium block">
                                        Date
                                    </label>
                                    <input id="approved-date" name="approved_by_date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                            </div>
                
                            <hr class="my-4">
                
                            <div class="flex justify-between items-center">
                               
                              <div class="flex gap-2">
                                <a href="{{route('sectionaltitling.primary')}}" class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                                  <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                  Back
                                  </a>
                                <button type="button" class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                                  <i data-lucide="map" class="w-3.5 h-3.5 mr-1.5"></i>
                                View Survey Plan
                                </button>      
                                <button type="button" class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                                  <i data-lucide="pencil" class="w-3.5 h-3.5 mr-1.5"></i>
                                  Edit
                                </button>
                                <button type="button" id="submit-survey" class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800">
                                    <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
                                    Submit
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>

                      <!-- Deeds Tab -->
                      <form id="deeds-form" method="POST">
                          @csrf
                          <div id="detterment-tab" class="tab-content">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                              <div class="p-4 border-b">
                                <h3 class="text-sm font-medium">Deeds</h3>
                                <p class="text-xs text-gray-500"> </p>
                              </div>
                              <input type="hidden" name="application_id" value="{{$application->id}}">
                              <input type="hidden" name="fileno" value="{{$application->fileno}}">
                              <div class="p-4 space-y-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="space-y-2">
                                        <label for="serial-no" class="text-xs font-medium block">
                                            Serial No
                                        </label>
                                        <input id="serial-no" name="serial_no" type="text" placeholder="Enter Serial No" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                    </div>
                                    <div class="space-y-2">
                                        <label for="page-no" class="text-xs font-medium block">
                                            Page No
                                        </label>
                                        <input id="page-no" name="page_no" type="text" placeholder="Enter Page No" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                    </div>
                                    <div class="space-y-2">
                                        <label for="volume-no" class="text-xs font-medium block">
                                            Volume No
                                        </label>
                                        <input id="volume-no" name="volume_no" type="text" placeholder="Enter Volume No" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                    </div>
                                </div>
                    
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label for="deeds-time" class="text-xs font-medium block">
                                            Deeds Time
                                        </label>
                                        <input id="deeds-time" name="deeds_time" type="time" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                    </div>
                                    <div class="space-y-2">
                                        <label for="deeds-date" class="text-xs font-medium block">
                                            Deeds Date
                                        </label>
                                        <input id="deeds-date" name="deeds_date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                    </div>
                                </div>
                                <hr class="my-4">
                    
                                <div class="flex justify-between items-center">
                               
                                  <div class="flex gap-2">
                                    <a  href="{{route('sectionaltitling.secondary')}}" class="flex items-center px-3 py-1 text-xs bg-white text-black p-2 border border-gray-500 rounded-md hover:bg-gray-800">
                                      <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                      Back
                                    </a>    
                                     
                                    
                                    <button type="button" id="submit-deeds" class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800">
                                        <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
                                         Submit
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </form>
                
                      <!-- Final Bill Tab -->
                      <div id="final-tab" class="tab-content">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                          <div class="p-4 border-b">
                            <h3 class="text-sm font-medium">Lands</h3>
                            <p class="text-xs text-gray-500"></p>
                          </div>
                          <input type="hidden" id="application_id" value="{{$application->id}}">
                      <input type="hidden" name="fileno" value="{{$application->fileno}}">
                          <div class="p-4 space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="file-no" class="text-xs font-medium block">
                                        File No
                                    </label>
                                    <input id="file-no" type="text" placeholder="Enter File No" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label for="file-name" class="text-xs font-medium block">
                                        File Name
                                    </label>
                                    <input id="file-name" type="text" placeholder="Enter File Name" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                            </div>
                
                            {{-- <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="land-type" class="text-xs font-medium block">
                                        Land Type
                                    </label>
                                    <input id="land-type" type="text" placeholder="Enter Land Type" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label for="land-size" class="text-xs font-medium block">
                                        Land Size
                                    </label>
                                    <input id="land-size" type="text" placeholder="Enter Land Size" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                            </div>
                 --}}
                            <hr class="my-4">
                
                            <div class="flex justify-between items-center">
                                <div class="flex gap-2">
                                    >
                                    
                                    <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-sky-900 hover:bg-gray-50">
                                    <i data-lucide="folder-git-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                    EDMS
                                    </button>
                                 
                                    <button class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800">
                                        <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
                                        Submit
                                    </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                <!-- Footer -->
                @include('admin.footer')
            </div>
            
            <!-- SweetAlert CDN -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
            <script>
                // Initialize Lucide icons
                lucide.createIcons();
                
                // Tab switching functionality
                document.addEventListener('DOMContentLoaded', function() {
                  const tabButtons = document.querySelectorAll('.tab-button');
                  const tabContents = document.querySelectorAll('.tab-content');
                  
                  tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                      const tabId = this.getAttribute('data-tab');
                      
                      // Deactivate all tabs
                      tabButtons.forEach(btn => btn.classList.remove('active'));
                      tabContents.forEach(content => content.classList.remove('active'));
                      
                      // Activate selected tab
                      this.classList.add('active');
                      document.getElementById(`${tabId}-tab`).classList.add('active');
                    });
                  });
                  
                  // Close modal button
                  document.getElementById('closeModal').addEventListener('click', function() {
                    // In a real application, this would close the modal
                    alert('Modal closed');
                  });
                  
                  // Survey form submission
                  document.getElementById('submit-survey').addEventListener('click', function(e) {
                      e.preventDefault();
                      
                      // Show loading message
                      Swal.fire({
                          title: 'Processing...',
                          text: 'Submitting survey information',
                          allowOutsideClick: false,
                          didOpen: () => {
                              Swal.showLoading();
                          }
                      });
                      
                      // Get the form data
                      const form = document.getElementById('survey-form');
                      const formData = new FormData(form);
                      
                      // Send AJAX request
                      fetch('{{ route("sub-actions.store-survey") }}', {
                          method: 'POST',
                          body: formData,
                          headers: {
                              'X-CSRF-TOKEN': '{{ csrf_token() }}'
                              // Don't set Accept header to force browser's default content negotiation
                          },
                          credentials: 'same-origin'
                      })
                      .then(response => {
                          // First check if response is ok
                          if (!response.ok) {
                              return response.text().then(text => {
                                  throw new Error('Server error: ' + text);
                              });
                          }
                          
                          // Try to parse as JSON, but handle text responses too
                          const contentType = response.headers.get('content-type');
                          if (contentType && contentType.includes('application/json')) {
                              return response.json();
                          } else {
                              return response.text().then(text => {
                                  return { success: true, message: 'Operation completed', text: text };
                              });
                          }
                      })
                      .then(data => {
                          // Show success message
                          Swal.fire({
                              icon: 'success',
                              title: 'Success!',
                              text: data.message || 'Survey information submitted successfully',
                              confirmButtonColor: '#3085d6'
                          });
                      })
                      .catch(error => {
                          // Show error message
                          console.error('Error:', error);
                          Swal.fire({
                              icon: 'error',
                              title: 'Submission Failed',
                              text: 'There was an error submitting the survey information. Please try again.',
                              confirmButtonColor: '#3085d6'
                          });
                      });
                  });
                  
                  // Deeds form submission
                  document.getElementById('submit-deeds').addEventListener('click', function(e) {
                      e.preventDefault();
                      
                      // Show loading message
                      Swal.fire({
                          title: 'Processing...',
                          text: 'Submitting deeds information',
                          allowOutsideClick: false,
                          didOpen: () => {
                              Swal.showLoading();
                          }
                      });
                      
                      // Get the form data
                      const form = document.getElementById('deeds-form');
                      const formData = new FormData(form);
                      
                      // Send AJAX request
                      fetch('{{ route("sub-actions.store-deeds") }}', {
                          method: 'POST',
                          body: formData,
                          headers: {
                              'X-CSRF-TOKEN': '{{ csrf_token() }}'
                              // Don't set Accept header to force browser's default content negotiation
                          },
                          credentials: 'same-origin'
                      })
                      .then(response => {
                          // First check if response is ok
                          if (!response.ok) {
                              return response.text().then(text => {
                                  throw new Error('Server error: ' + text);
                              });
                          }
                          
                          // Try to parse as JSON, but handle text responses too
                          const contentType = response.headers.get('content-type');
                          if (contentType && contentType.includes('application/json')) {
                              return response.json();
                          } else {
                              return response.text().then(text => {
                                  return { success: true, message: 'Operation completed', text: text };
                              });
                          }
                      })
                      .then(data => {
                          // Show success message
                          Swal.fire({
                              icon: 'success',
                              title: 'Success!',
                              text: data.message || 'Deeds information submitted successfully',
                              confirmButtonColor: '#3085d6'
                          });
                      })
                      .catch(error => {
                          // Show error message
                          console.error('Error:', error);
                          Swal.fire({
                              icon: 'error',
                              title: 'Submission Failed',
                              text: 'There was an error submitting the deeds information. Please try again.',
                              confirmButtonColor: '#3085d6'
                          });
                      });
                  });
                });
              </script>
    
        @endsection


