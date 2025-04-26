@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING  MODULE') }}
@endsection


@include('sectionaltitling.partials.assets.css')

@section('content')
<style>
  
    .step-circle {
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 500;
    }
    .step-circle.active {
      background-color: #10b981;
      color: white;
    }
    .step-circle.inactive {
      background-color: #f3f4f6;
      color: #6b7280;
    }
    .form-section {
      display: none;
    }
    .form-section.active {
      display: block;
    }
    .upload-box {
      border: 2px dashed #e5e7eb;
      border-radius: 0.375rem;
      padding: 1.5rem;
      text-align: center;
      cursor: pointer;
      transition: border-color 0.2s;
    }
    .upload-box:hover {
      border-color: #3b82f6;
    }

    .tab {
        overflow: hidden;

    }

    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 10px 16px;
        transition: 0.3s;
        font-size: 14px;
    }

    .tab button:hover {
        background-color: #ddd;
    }

    .tab button.active {
        background-color: #ccc;
    }

    .tabcontent {
        display: none;
    }

    .tabcontent.active {
        display: block;
    }

    /* Loading overlay styles */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        display: none;
    }
    
    .loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

</style>
<div class="flex-1 overflow-auto">
    <!-- Header -->
   @include('admin.header')
    <!-- Dashboard Content -->
    <div class="p-6">
 

      <!-- Stats Cards -->
        
 
      <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
        <div class="modal-content">
            <!-- Loading Overlay -->
            <div id="loadingOverlay" class="loading-overlay">
                <div class="loader"></div>
                <div class="text-white ml-3">Processing your request...</div>
            </div>
            
            <form id="primaryForm" method="POST" action="{{ route('primaryform.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Step 1: Basic Information -->

              
                <div class="form-section active" id="step1">
                  <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                      <h2 class="text-xl font-bold text-gray-800">MINISTRY OF LAND AND PHYSICAL PLANNING</h2>
                      <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <i data-lucide="x" class="w-5 h-5"></i>
                      </button>
                    </div>
                    
                    <div class="mb-6">
                      <div class="flex items-center justify-between">
                        <div class="flex items-center">
                          <i data-lucide="file-text" class="w-5 h-5 mr-2 text-green-600"></i>
                          <h3 class="text-lg font-bold">Application for Sectional Titling - Main Application</h3>
                        </div>
                        <div class="flex items-center">
                          <span class="text-gray-600 mr-2">Land Use:</span>
                          <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                            
                            @if (request()->query('landuse') === 'Commercial')
                              Commercial
                            @elseif (request()->query('landuse') === 'Residential')
                                Residential
                            @elseif (request()->query('landuse') === 'Industrial')
                                Industrial
                            @else
                                Mixed Use
                            @endif 
                          </span>
                        </div>
                      </div>
                      <p class="text-gray-600 mt-1">Complete the form below to submit a new primary application for sectional titling</p>
                    </div>
            
                    <div class="flex items-center mb-6">
                      <div class="flex items-center mr-4">
                        <div class="step-circle active flex items-center justify-center">1</div>
                      </div>
                      <div class="flex items-center mr-4">
                        <div class="step-circle inactive flex items-center justify-center">2</div>
                      </div>
                      <div class="flex items-center">
                        <div class="step-circle inactive flex items-center justify-center">3</div>
                      </div>
                      <div class="ml-4">Step 1</div>
                    </div>
            
                    <div class="mb-6">
                      <div class="text-right text-sm text-gray-500">CODE: ST FORM - 1</div>
                      <hr class="my-4">
                      
                      <div class="grid grid-cols-3 gap-6 mb-6">
                        <!-- Left column (2/3 width) -->
                        <div class="col-span-2">
                          <div class="mb-6">
                            <label class="block mb-2 font-medium">Applicant Type</label>
                            <div class="flex space-x-6">
                              <label class="flex items-center">
                                <input type="radio" name="applicantType" class="mr-2" value="individual"  onclick="setApplicantType('individual'); showIndividualFields()">
                                <span>Individual</span>
                              </label>
                              <label class="flex items-center">
                                <input type="radio" name="applicantType" class="mr-2" value="corporate" onclick="setApplicantType('corporate'); showCorporateFields()">
                                <span>Corporate Body</span>
                              </label>
                              <label class="flex items-center">
                                <input type="radio" name="applicantType" class="mr-2" value="multiple" onclick="setApplicantType('multiple'); showMultipleOwnersFields()">
                                <span>Multiple Owners</span>
                              </label>
                            </div>
                          </div>
                          <input type="hidden" name="land_use" value="{{ request()->query('landuse') === 'Commercial' ? 'Commercial' : (request()->query('landuse') === 'Residential' ? 'Residential' : (request()->query('landuse') === 'Industrial' ? 'Industrial' : 'Mixed Use')) }}">
                      @include('primaryform.fileno')
                            
                        </div>
                        </div>
     
 
                   
                      </div>
            
                     @include('primaryform.applicant')
    
                      <div class="mb-6">
                 
                        
                        <div class="mb-4">
                        <p class="text-sm mb-1">Owner's Address</p>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm mb-1">House No.</label>
                                <input type="text" id="ownerHouseNo" class="w-full p-2 border border-gray-300 rounded-md" placeholder="House No." name="address_house_no">
                            </div>
                            <div>
                                <label class="block text-sm mb-1">Street Name</label>
                                <input type="text" id="ownerStreetName" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Street Name" name="owner_street_name">
                            </div>
                        </div>
    
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm mb-1">District</label>
                                <input type="text" id="ownerDistrict" class="w-full p-2 border border-gray-300 rounded-md" placeholder="District" name="owner_district">
                            </div>
                            <div>
                                <label class="block text-sm mb-1">LGA</label>
                                <input type="text" id="ownerLga" class="w-full p-2 border border-gray-300 rounded-md" placeholder="LGA" name="owner_lga">
                            </div>
                            <div>
                                <label class="block text-sm mb-1">State</label>
                                <input type="text" id="ownerState" class="w-full p-2 border border-gray-300 rounded-md" placeholder="eg: Kano"  name="owner_state">
                            </div>
                        </div>
                               <input type="hidden" name="address" id="contactAddressDisplay">    
                        <div class="mb-4">
                            <label class="block text-sm mb-1">Contact Address:</label>
                            <div id="contactAddressDisplay" class="p-2 bg-gray-50 border border-gray-200 rounded-md">
                                <span id="fullContactAddress"></span>
                            </div>
                        </div>
     
                          <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                              <label class="block text-sm mb-1">Phone No. 1</label>
                              <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter phone number" name="phone_number[]">
                            </div>
                            <div>
                              <label class="block text-sm mb-1">Phone No. 2</label>
                              <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter alternate phone" name="phone_number[]">
                            </div>
                          </div>
                          
                          <div>
                            <label class="block text-sm mb-1">Email Address</label>
                            <input type="email" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter email address" name="owner_email">
                          </div>
                        </div>
                      </div>
    
                      <div class="grid grid-cols-2 gap-6 mb-6">
                        <!-- Left column -->
                        <div>
                          <label class="block mb-2 font-medium">Means of identification</label>
                          <div class="grid grid-cols-1 gap-2">
                            <label class="flex items-center">
                              <input type="radio" name="idType" class="mr-2" value="national_id" checked>
                              <span>National ID</span>
                            </label>
                            <label class="flex items-center">
                              <input type="radio" name="idType" class="mr-2" value="drivers_license">
                              <span>Driver's License</span>
                            </label>
                            <label class="flex items-center">
                              <input type="radio" name="idType" class="mr-2" value="others">
                              <span>Others</span>
                            </label>
                          </div>
                        </div>
                        
                        <!-- Right column -->
                        <div>
                          <div class="h-6"></div> <!-- Spacer to align with left column label -->
                          <div class="grid grid-cols-1 gap-2">
                            <label class="flex items-center">
                              <input type="radio" name="idType" class="mr-2" value="voters_card">
                              <span>Voter's Card</span>
                            </label>
                            <label class="flex items-center">
                              <input type="radio" name="idType" class="mr-2" value="international_passport">
                              <span>International Passport</span>
                            </label>
                          </div>
                        </div>
                      </div>
            
                     


                        <div class="mb-6">
                        <h3 class="font-medium mb-4">Property Details</h3>
                        
                        @include('primaryform.types.commercial')
                        @include('primaryform.types.residential')
                        @include('primaryform.types.industrial')
                        
                        <div class="grid grid-cols-3 gap-4 mb-4">
                          <div>
                          <label class="block text-sm mb-1">No. of Units</label>
                          <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter number of units" name="units_count">
                          </div>
                          <div>
                          <label class="block text-sm mb-1">No. of Blocks</label>
                          <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter number of blocks" name="blocks_count">
                          </div>
                          <div>
                          <label class="block text-sm mb-1">No. of Sections (Floors)</label>
                          <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter number of floors" name="sections_count">
                          </div>
                        </div>
                        
                        <h4 class="font-medium mb-2 mt-4">Property Address</h4>
                        <div class="grid grid-cols-3 gap-4 mb-4">
                          <div>
                          <label class="block text-sm mb-1">House No.</label>
                          <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter house number" name="property_house_no">
                          </div>
                          <div>
                          <label class="block text-sm mb-1">Plot No.</label>
                          <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter plot number" name="property_plot_no">
                          </div>
                          <div>
                          <label class="block text-sm mb-1">Street Name</label>
                          <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter street name" name="property_street_name">
                          </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mb-4">
                          <div>
                          <label class="block text-sm mb-1">District</label>
                          <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter district" name="property_district">
                          </div>
                          <div>
                          <label class="block text-sm mb-1">LGA</label>
                          <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter LGA" name="property_lga">
                          </div>
                          <div>
                          <label class="block text-sm mb-1">State</label>
                          <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter state" name="property_state">
                          </div>
                        </div>
                        </div>
                      @include('primaryform.types.ownership')
                      <div class="mb-4">
                        <label class="block text-sm mb-1">Write any comments that will assist in processing the application</label>
                        <textarea class="w-full p-2 border border-gray-300 rounded-md" rows="4" placeholder="Enter any additional comments or information" name="comments"></textarea>
                      </div>
                      @include('primaryform.initial_bill')
                   
                
                      <div class="flex justify-between mt-8">
                        <button class="px-4 py-2 bg-white border border-gray-300 rounded-md">Cancel</button>
                        <div class="flex items-center">
                          <span class="text-sm text-gray-500 mr-4">Step 1 of 3</span>
                          <button class="px-4 py-2 bg-black text-white rounded-md" id="nextStep1">Next</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            
                <!-- Step 2: Required Documents -->
                <div class="form-section" id="step2">
                  <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                      <h2 class="text-xl font-bold text-center text-gray-800">MINISTRY OF LAND AND PHYSICAL PLANNING</h2>
                      <button id="closeModal2" class="text-gray-500 hover:text-gray-700">
                        <i data-lucide="x" class="w-5 h-5"></i>
                      </button>
                    </div>
                    
                    <div class="mb-6">
                      <div class="flex items-center mb-2">
                        <i data-lucide="file-text" class="w-5 h-5 mr-2 text-green-600"></i>
                        <h3 class="text-lg font-bold">Application for Sectional Titling - Main Application</h3>
                        <div class="ml-auto flex items-center">
                          <span class="text-gray-600 mr-2">Land Use:</span>
                          <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                            @if (request()->query('landuse') === 'Commercial')
                              Commercial
                            @elseif (request()->query('landuse') === 'Residential')
                                Residential
                            @elseif (request()->query('landuse') === 'Industrial')
                                Industrial
                            @else
                                Mixed Use
                            @endif 
                        </span>
                        </div>
                      </div>
                      <p class="text-gray-600">Complete the form below to submit a new primary application for sectional titling</p>
                    </div>
            
                    <div class="flex items-center mb-8">
                      <div class="flex items-center mr-4">
                        <div class="step-circle inactive">1</div>
                      </div>
                      <div class="flex items-center mr-4">
                        <div class="step-circle active">2</div>
                      </div>
                      <div class="flex items-center">
                        <div class="step-circle inactive">3</div>
                      </div>
                      <div class="ml-4">Step 2</div>
                    </div>
            
                   @include('primaryform.documents')
                  </div>
                </div>
            
                <!-- Step 3: Application Summary -->
             @include('primaryform.summary')
            </form>
          </div>
      </div>
    </div>

    <!-- Footer -->
    @include('admin.footer')
  </div>

<!-- Print Template (Hidden) -->
@include('primaryform.print')
@include('primaryform.js')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('primaryForm');
        const loadingOverlay = document.getElementById('loadingOverlay');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading overlay
            loadingOverlay.style.display = 'flex';
            
            // Wait for 3 seconds before submitting the form
            setTimeout(function() {
                form.submit();
            }, 3000);
        });
    });
</script>

@endsection
