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
                            
@php
$surveyRecord = DB::connection('sqlsrv')->table('surveyCadastralRecord')
  ->where('sub_application_id', $application->id)
  ->first();
@endphp

                <div class="modal-content p-6">
                    <div class="flex justify-between items-center mb-4">
                      <h2 class="text-lg font-medium">Planning Recommendation</h2>
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
                            <h3 class="text-sm font-medium text-blue-800">Original Owner</h3>
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
                            <p class="text-xs text-gray-600 mt-1">Unit Owner</p>
                          </div>
                            

                        </div>
                      </div>
                      <!-- Tabs Navigation -->
                      
                  

                      <div class="grid grid-cols-3 gap-2 mb-4">

                        <button class="tab-button active" data-tab="detterment">
                          <i data-lucide="calculator" class="w-3.5 h-3.5 mr-1.5"></i>
                         Architectural Design
                        </button>


                        <button class="tab-button" data-tab="initial">
                          <i data-lucide="banknote" class="w-3.5 h-3.5 mr-1.5"></i>
                          Approve Recommendation
                        </button>
                       
                        <button class="tab-button" data-tab="final">
                          <i data-lucide="file-check" class="w-3.5 h-3.5 mr-1.5"></i>
                          Planning Recommendation

                        </button>
                      </div>
                

                      @include('sub_actions.architecturaldesign')
                      <!-- Survey Tab -->
                      
                      <div id="initial-tab" class="tab-content">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                          <div class="p-4 border-b">
                            <h3 class="text-sm font-medium">Approve Recommendation</h3>
                          </div>
                          <form id="planningRecommendationForm">
                          
                            <!-- CSRF token for Laravel -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="p-4 space-y-4">
                            <input type="hidden" id="application_id" value="{{$application->id}}">
                           <input type="hidden" name="fileno" value="{{$application->fileno}}">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-xs font-medium block">
                                        Decision
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="decision" value="approve" class="form-radio" checked>
                                            <span class="ml-2 text-sm">Approve</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="decision" value="decline" class="form-radio">
                                            <span class="ml-2 text-sm">Decline</span>
                                        </label>

                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="approval-date" class="text-xs font-medium block">
                                        Approval/Decline Date
                                    </label>
                                    <input id="approval-date" type="date" class="w-full p-2 border border-gray-300 rounded-md text-sm">
                                </div>
                            </div>
                
                            <div class="grid grid-cols-1 gap-4">
                                <div id="reasonContainer" class="space-y-2" style="display: none;">
                                    <label for="comments" class="text-xs font-medium block">
                                        Reason
                                    </label>
                                    <textarea id="comments" rows="4" placeholder="Enter reason for declining" class="w-full p-2 border border-gray-300 rounded-md text-sm"></textarea>
                                </div>
                            </div>
                
                            <hr class="my-4">
                
                            <div class="flex justify-between items-center">
                               
                              <div class="flex gap-2">
                                <a  href="{{route('sectionaltitling.secondary')}}" class="flex items-center px-3 py-1 text-xs bg-white text-black p-2 border border-gray-500 rounded-md hover:bg-gray-800">
                                  <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                  Back
                                </a>    
                                
                                  
                                <button id="planningRecommendationSubmitBtn" type="submit" class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800">
                                    <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
                                    Submit
                                </button>
                              </div>
                            </div>
                          </div>

                        </form>
                        </div>
                      </div>
                        

                    
                            
                      
                
                      <!-- Final Bill Tab -->
                      <div id="final-tab" class="tab-content">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                          <div class="p-4 border-b">
                            <h3 class="text-sm font-medium">Planning Recommendation</h3>
                            <p class="text-xs text-gray-500"></p>
                          </div>
                          <input type="hidden" id="application_id" value="{{$application->id}}">
                      <input type="hidden" name="fileno" value="{{$application->fileno}}">
                          <div class="p-4 space-y-4">
                             
                            @include('sub_actions.planning_recomm')
                            <hr class="my-4">
                
                            <div class="flex justify-between items-center">
                                <div class="flex gap-2">
                                  <a  href="{{route('sectionaltitling.secondary')}}" class="flex items-center px-3 py-1 text-xs bg-white text-black p-2 border border-gray-500 rounded-md hover:bg-gray-800">
                                    <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                    Back
                                  </a>    
                                  
                                    
                                 
                                 
                                    <button id="print-planning-recommendation" class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800">
                                        <i data-lucide="printer-check" class="w-3.5 h-3.5 mr-1.5"></i>
                                        Print
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
                  
                  // Print Planning Recommendation
                  document.getElementById('print-planning-recommendation').addEventListener('click', function() {
                    // Get the planning recommendation content
                    const planningContent = document.querySelector('#final-tab [data-planning-content]') || 
                                           document.querySelector('#final-tab');
                    
                    // Create a new window for printing
                    const printWindow = window.open('', '_blank');
                    
                    // Write the HTML content to the new window
                    printWindow.document.write(`
                      <!DOCTYPE html>
                      <html>
                      <head>
                        <title>Planning Recommendation</title>
                        <link href="https://cdn.tailwindcss.com" rel="stylesheet">
                        <style>
                          body {
                            background-color: #c6e4f9;
                            font-family: Arial, sans-serif;
                          }
                          table {
                            border-collapse: collapse;
                            width: 100%;
                          }
                          th, td {
                            border: 1px solid #718096;
                            padding: 8px;
                            text-align: left;
                          }
                          th {
                            background-color: #cbd5e0;
                          }
                          @media print {
                            body {
                              background-color: white;
                            }
                            .no-print {
                              display: none;
                            }
                          }
                        </style>
                      </head>
                      <body class="min-h-screen p-8 mx-auto max-w-3xl">
                        ${planningContent.innerHTML}
                      </body>
                      </html>
                    `);
                    
                    // Finalize the document
                    printWindow.document.close();
                    
                    // Wait for resources to load then print
                    printWindow.onload = function() {
                      printWindow.focus();
                      printWindow.print();
                      // Close the window after printing (optional)
                      // printWindow.close();
                    };
                  });

                  // Toggle reason field based on decision
                  const decisionRadios = document.querySelectorAll('input[name="decision"]');
                  const reasonContainer = document.getElementById('reasonContainer');
                  
                  decisionRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                      if (this.value === 'decline') {
                        reasonContainer.style.display = 'block';
                      } else {
                        reasonContainer.style.display = 'none';
                      }
                    });
                  });
                });

                function showPreloader() {
        Swal.fire({
            title: 'Processing...',
            html: 'Approval',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    function hidePreloader() {
        Swal.close();
    }


                 // Add form submission via AJAX with SweetAlert and preloader
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('planningRecommendationForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show preloader
            showPreloader();
            
            // Disable submit button - Use querySelector as fallback if ID not found
            const submitBtn = document.getElementById('planningRecommendationSubmitBtn');
            if (submitBtn) {
                submitBtn.disabled = true;
            }
            
            const formData = new FormData(form);
            const applicationId = document.getElementById('application_id').value; // Use existing ID
            const decision = document.querySelector('input[name="decision"]:checked').value;
            const approvalDate = document.getElementById('approval-date').value; // Match the actual ID
            let comments = document.getElementById('comments').value; // Match the actual ID
            
            // AJAX request
            fetch('{{ route("sub-actions.update-planning-recommendation") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    application_id: applicationId,
                    status: decision,
                    approval_date: approvalDate,
                    comments: comments
                })
            })
            .then(response => response.json())
            .then(data => {
                // Hide preloader
                hidePreloader();
                
                // Enable submit button
                document.getElementById('planningRecommendationSubmitBtn').disabled = false;
                
                if (data.success) {
                    // Show success message with SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Planning recommendation updated successfully!',
                        confirmButtonColor: '#10B981'
                    }).then((result) => {
                        // Refresh the page directly without calling undefined function
                        location.reload();
                    });
                } else {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Something went wrong!',
                        confirmButtonColor: '#EF4444'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Hide preloader
                hidePreloader();
                
                // Enable submit button
                document.getElementById('planningRecommendationSubmitBtn').disabled = false;
                
                // Show error with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating planning recommendation.',
                    confirmButtonColor: '#EF4444'
                });
            });
        });
    });
              </script>
    
        @endsection


