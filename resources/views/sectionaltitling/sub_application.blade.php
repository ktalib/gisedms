            @extends('layouts.app')
            @section('page-title')
            {{ __('SECTIONAL TITLING  MODULE') }}
            @endsection

            <style>
            .ck-editor__editable {
            min-height: 200px;
            }

            input[type="text"],
            input[type="number"],
            input[type="date"],
            textarea,
            select {
            min-height: 55px;
            background-color: #fdfdfd;
            }

            input:disabled,
            select:disabled,
            textarea:disabled {
            background-color: #bbbbbb;
            }

            #myDiv {
            display: none;
            transition: all 0.3s ease-in-out;
            }
            select,
            input {
            transition: all 0.2s ease-in-out;
            }
            select:focus,
            input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
            #Previewflenumber {
            font-family: monospace;
            letter-spacing: 0.05em;
            }
            .bootstrap-tagsinput {
            width: 100%;
            padding: 0.5rem;
            border-radius: 0.375rem;
            min-height: 55px;
            background-color: #fdfdfd;
            }

            .bootstrap-tagsinput .tag {
            background-color: #3b82f6;
            color: white;
            padding: 3px 7px;
            border-radius: 3px;
            margin-right: 4px;

            }


   
            .step-circle {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            }
            .step-circle.active-tab {
            background-color: #10b981;
            color: white;
            }
            .step-circle.inactive-tab {
            background-color: #f3f4f6;
            color: #6b7280;
            }
            .form-section {
            display: none;
            }
            .form-section.active-tab {
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
            </style>
            @include('sectionaltitling.partials.assets.css')
            @section('content')
            <!-- Main Content -->
            <div class="flex-1 overflow-auto">
            <!-- Header -->
            @include('admin.header')
            <!-- Dashboard Content -->
            <div class="p-6">

                <!-- Tabs -->
                @include('sectionaltitling.partials.tabs')

                @php
                $mainApplicationId = request()->get('application_id');
                // Fetch data from the mother_applications table
                $motherApplication = DB::connection('sqlsrv')->table('mother_applications')->where('id', $mainApplicationId)->first();
                $totalUnitsInMotherApp = $motherApplication ? $motherApplication->NoOfUnits : 0;

                // Count the number of sub-applications linked to the main application
                $totalSubApplications = DB::connection('sqlsrv')->table('subapplications')->where('main_application_id', $mainApplicationId)->count();

                // Calculate the remaining units
                $remainingUnits = $totalUnitsInMotherApp - $totalSubApplications;

                // Get property location
                $propertyLocation = '';
                if ($motherApplication) {
                  $locationParts = array_filter([
                    $motherApplication->property_plot_no ?? null,
                    $motherApplication->property_street_name ?? null,
                    $motherApplication->property_district ?? null
                  ]);
                  $propertyLocation = implode(', ', $locationParts);
                }
              @endphp

                <!-- Primary Applications Table -->
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <div class="container py-4">
                        <div class="modal-content">
                            <!-- Step 1: Basic Information -->
                            <form id="subApplicationForm" method="POST" action="{{ route('sectionaltitling.storesub') }}" enctype="multipart/form-data" class="space-y-6">
                              @csrf
                            <div class="form-section active-tab" id="step1">
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
                                      <h3 class="text-lg font-bold items-center">Application for Sectional Titling - Unit Application</h3>
                                    </div>
                                    <div class="flex items-center">
                                      <span class="text-gray-600 mr-2">Land Use:</span>
                                      <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">{{ $motherApplication->land_use ?? 'N/A' }}</span>
                                    </div>
                                  </div>
                                  <p class="text-gray-600 mt-1">Complete the form below to submit a new primary application for sectional titling</p>
                                </div>
                        
                                <div class="flex items-center mb-6">
                                  <div class="flex items-center mr-4">
                                    <div class="step-circle active-tab flex items-center justify-center">1</div>
                                  </div>
                                  <div class="flex items-center mr-4">
                                    <div class="step-circle inactive-tab flex items-center justify-center">2</div>
                                  </div>
                                  <div class="flex items-center">
                                    <div class="step-circle inactive-tab flex items-center justify-center">3</div>
                                  </div>
                                  <div class="ml-4">Step 1</div>
                                </div>
                        
                                <div class="mb-6">
                                  <div class="text-right text-sm text-gray-500">CODE: ST FORM - 1</div>
                                  <hr class="my-4">
                                  @php
                                    $mainApplicationId = request()->get('application_id');
                                    // Fetch data from the mother_applications table
                                    $motherApplication = DB::connection('sqlsrv')->table('mother_applications')->where('id', $mainApplicationId)->first();
                                    $totalUnitsInMotherApp = $motherApplication ? $motherApplication->NoOfUnits : 0;

                                    // Count the number of sub-applications linked to the main application
                                    $totalSubApplications = DB::connection('sqlsrv')->table('subapplications')->where('main_application_id', $mainApplicationId)->count();

                                    // Calculate the remaining units
                                    $remainingUnits = $totalUnitsInMotherApp - $totalSubApplications;

                                    // Get property location
                                    $propertyLocation = '';
                                    if ($motherApplication) {
                                      $locationParts = array_filter([
                                        $motherApplication->property_plot_no ?? null,
                                        $motherApplication->property_street_name ?? null,
                                        $motherApplication->property_district ?? null
                                      ]);
                                      $propertyLocation = implode(', ', $locationParts);
                                    }
                                  @endphp

                                  <div class="mb-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Main Application Reference</h2>
                                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5">
                                      <div class="flex items-center justify-between mb-4">
                                        <div>
                                          <label class="block text-sm font-medium text-gray-700 mb-1">Main Application ID</label>
                                          <input type="text" id="mainApplicationId" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ $mainApplicationId }}" disabled>
                                          <input type="hidden" name="main_application_id" value="{{ $mainApplicationId }}">
                                         
                                        </div>
                                        <div class="flex items-center">
                                          <span class="px-3 py-1 text-sm rounded-full {{ $remainingUnits > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $remainingUnits }} units remaining
                                          </span>
                                        </div>
                                      </div>

                                      <!-- Main Application Details -->
                                      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
                                        <!-- Applicant Information -->
                                        <div class="bg-gray-50 p-4 rounded-md">
                                          <h3 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Applicant Information
                                          </h3>
                                          <div class="space-y-2 text-sm">
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Applicant Type:</span>
                                              <span class="font-medium">{{ $motherApplication->applicant_type ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Name:</span>
                                              <span class="font-medium">
                                                {{ $motherApplication->applicant_title ?? '' }} 
                                                {{ $motherApplication->first_name ?? '' }} 
                                                {{ $motherApplication->surname ?? '' }}
                                              </span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Form ID:</span>
                                              <span class="font-medium">{{ $motherApplication->id ?? 'N/A' }}</span>
                                            </div>
                                          </div>
                                        </div>

                                        <!-- Property Information -->
                                        <div class="bg-gray-50 p-4 rounded-md">
                                          <h3 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            Property Information
                                          </h3>
                                          <div class="space-y-2 text-sm">
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">File Number:</span>
                                              <span class="font-medium">{{ $motherApplication->fileno ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Land Use:</span>
                                              <span class="font-medium">{{ $motherApplication->land_use ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Property Location:</span>
                                              <span class="font-medium">{{ $propertyLocation ?: 'N/A' }}</span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Total Units:</span>
                                              <span class="font-medium">{{ $totalUnitsInMotherApp }}</span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <!-- Progress indicator -->
                                      <div class="mt-5 pt-4 border-t border-gray-200">
                                        <div class="flex items-center">
                                          <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            @php $progressPercent = $totalUnitsInMotherApp > 0 ? (($totalSubApplications / $totalUnitsInMotherApp) * 100) : 0; @endphp
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progressPercent }}%"></div>
                                          </div>
                                          <span class="ml-3 text-sm text-gray-600">{{ $totalSubApplications }}/{{ $totalUnitsInMotherApp }} units registered</span>
                                        </div>
                                      </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">This sub-application will be linked to the main application referenced above.</p>
                                  </div>    
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
                                    </div>
                                    
                                    <! -- Right column (1/3 width) -->
                                  </div>

                                  @include('primaryform.applicant')
                                  

                                  <div class="bg-gray-50 p-4 rounded-md mb-6">
                        
                                     
                                   
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                     
                                        <div>
                                            <label class="block text-sm mb-1">Scheme No</label>
                                            <input type="text" id="schemeName" class="w-full p-2 border border-gray-300 rounded-md"  " name="scheme_no" placeholder="enter scheme number. eg: ST/SP/0001">
                                        </div>
                                    </div>
                                  </div>

                                    <div class="bg-gray-50 p-4 rounded-md mb-6">
                        
                                    <div class="mb-4">
                                    <p class="text-sm mb-1">Unit Owner's Address</p>
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm mb-1">House No.</label>
                                            <input type="text" id="ownerHouseNo" class="w-full p-2 border border-gray-300 rounded-md" placeholder="House No." name="address_house_no">
                                        </div>
                                        <div>
                                            <label class="block text-sm mb-1">Street Name</label>
                                            <input type="text" id="ownerStreetName" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Street Name" name="address_street_name">
                                        </div>
                                    </div>
                
                                    <div class="grid grid-cols-3 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm mb-1">District</label>
                                            <input type="text" id="ownerDistrict" class="w-full p-2 border border-gray-300 rounded-md" placeholder="District" name="address_district">
                                        </div>
                                        <div>
                                            <label class="block text-sm mb-1">LGA</label>
                                            <input type="text" id="ownerLga" class="w-full p-2 border border-gray-300 rounded-md" placeholder="LGA" name="address_lga">
                                        </div>
                                        <div>
                                            <label class="block text-sm mb-1">State</label>
                                            <input type="text" id="ownerState" class="w-full p-2 border border-gray-300 rounded-md" placeholder="eg: Kano"  name="address_state">
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
                                 
                                <div class="bg-gray-50 p-4 rounded-md grid grid-cols-2 gap-6 mb-6">
                                    <!-- Left column -->
                                    <div>
                                        <label class="block mb-2 font-medium">Means of identification</label>
                                        <div class="grid grid-cols-1 gap-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="identification_type" class="mr-2" value="national id" checked>
                                        <span>National ID</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="identification_type" class="mr-2" value="drivers license">
                                        <span>Driver's License</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="identification_type" class="mr-2" value="others">
                                        <span>Others</span>
                                    </label>
                                        </div>
                                    </div>
                                    
                                    <!-- Right column -->
                                    <div>
                                        <div class="h-6"></div> <!-- Spacer to align with left column label -->
                                        <div class="grid grid-cols-1 gap-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="identification_type" class="mr-2" value="voters card">
                                        <span>Voter's Card</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="identification_type" class="mr-2" value="international passport">
                                        <span>International Passport</span>
                                    </label>
                                        </div>
                                    </div>
                                    </div>            
                        
                                  <div class="bg-gray-50 p-4 rounded-md mb-6">
                                    <h3 class="font-medium mb-4">Unit Details</h3>
                                    @include('sectionaltitling.types.ownership')
                                    @include('sectionaltitling.types.commercial')
                                    @include('sectionaltitling.types.residential')
                                    @include('sectionaltitling.types.industrial')
                                    
                                    <div class="grid grid-cols-3 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Block No</label>
                                            <input type="text" name="block_number" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter block number">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Section No (Floor) </label>
                                            <input type="text" name="floor_number" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter floor number">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Unit No</label>
                                            <input type="text" name="unit_number" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter unit number">
                                        </div>
                                    </div>
                                    
                                   
        
                                
                                   </div>
                        
                                   <div class="bg-gray-50 p-4 rounded-md mb-6">
                                    <label for="application_comment" class="block text-sm font-medium text-gray-700 mb-2">. Write any comment that will assist in processing the application</label>
                                    <textarea id="application_comment" name="application_comment" rows="3" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Add any comments or notes here..."></textarea>
                                  </div>
                        
                                  <div class="bg-gray-50 p-4 rounded-md mb-6">
                                    <h3 class="font-medium text-center mb-4">INITIAL BILL</h3>
                                    
                                    <div class="grid grid-cols-3 gap-4 mb-4">
                                      <div>
                                        <label class="flex items-center text-sm mb-1">
                                          <i data-lucide="file-text" class="w-4 h-4 mr-1 text-green-600"></i>
                                          Application fee (₦)
                                        </label>
                                        <input type="number" name="application_fee" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter application fee">
                                      </div>
                                      <div>
                                        <label class="flex items-center text-sm mb-1">
                                          <i data-lucide="file-check" class="w-4 h-4 mr-1 text-green-600"></i>
                                          Processing fee (₦)
                                        </label>
                                        <input  type="number" name="processing_fee" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter processing fee">
                                      </div>
                                      <div>
                                        <label class="flex items-center text-sm mb-1">
                                          <i data-lucide="map" class="w-4 h-4 mr-1 text-green-600"></i>
                                          Site Plan (₦)
                                        </label>
                                        <input type="text" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter site plan fee">
                                      </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center mb-4">
                                      <div class="flex items-center">
                                        <i data-lucide="file-text" class="w-4 h-4 mr-1 text-green-600"></i>
                                        <span>Total:</span>
                                      </div>
                                      <span class="font-bold">₦0.00</span>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                      <div>
                                        <label class="flex items-center text-sm mb-1">
                                          <i data-lucide="calendar" class="w-4 h-4 mr-1 text-green-600"></i>
                                          has been paid on
                                        </label>
                                        <input type="date" name="payment_date" class="w-full p-2 border border-gray-300 rounded-md" value="2025-04-15">
                                      </div>
                                      <div>
                                        <label class="flex items-center text-sm mb-1">
                                          <i data-lucide="receipt" class="w-4 h-4 mr-1 text-green-600"></i>
                                          with receipt No.
                                        </label>
                                        <input type="text"  name="receipt_number" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter receipt number">
                                      </div>
                                    </div>
                                  </div> 
                                  
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
                                      <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Residential</span>
                                    </div>
                                  </div>
                                  <p class="text-gray-600">Complete the form below to submit a new primary application for sectional titling</p>
                                </div>
                        
                                <div class="flex items-center mb-8">
                                  <div class="flex items-center mr-4">
                                    <div class="step-circle inactive-tab">1</div>
                                  </div>
                                  <div class="flex items-center mr-4">
                                    <div class="step-circle active-tab">2</div>
                                  </div>
                                  <div class="flex items-center">
                                    <div class="step-circle inactive-tab">3</div>
                                  </div>
                                  <div class="ml-4">Step 2</div>
                                </div>
                        
                                <div class="mb-6">
                                  <div class="flex items-start mb-4">
                                    <i data-lucide="file-text" class="w-5 h-5 mr-2 text-green-600"></i>
                                    <span class="font-medium">Required Documents</span>
                                  </div>
                                  
                                  <div class="bg-blue-50 border border-blue-100 rounded-md p-4 mb-6">
                                    <div class="flex items-start">
                                      <i data-lucide="info" class="w-5 h-5 mr-2 text-blue-500 mt-0.5"></i>
                                      <div>
                                        <h4 class="font-medium text-blue-800">Document Requirements</h4>
                                        <p class="text-sm text-blue-600">Please upload all required documents. Acceptable formats are PDF, JPG, and PNG. Maximum file size is 5MB per document.</p>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="grid grid-cols-2 gap-6 mb-6">
                                    <div class="border border-gray-200 rounded-md p-4">
                                      <h4 class="font-medium mb-2">Application Letter</h4>
                                      <p class="text-sm text-gray-600 mb-4">Formal letter requesting sectional titling</p>
                                      
                                      <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                                        <div class="flex justify-center mb-2">
                                          <i data-lucide="upload" class="w-6 h-6 text-gray-400"></i>
                                        </div>
                                        <div class="flex justify-center">
                                          <button class="flex items-center text-blue-600">
                                            <span>Upload Document</span>
                                          </button>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">PDF, JPG or PNG (max. 5MB)</p>
                                      </div>
                                    </div>
                                    
                                    <div class="border border-gray-200 rounded-md p-4">
                                      <h4 class="font-medium mb-2">Building Plan</h4>
                                      <p class="text-sm text-gray-600 mb-4">Approved building plan with architectural details</p>
                                      
                                      <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                                        <div class="flex justify-center mb-2">
                                          <i data-lucide="upload" class="w-6 h-6 text-gray-400"></i>
                                        </div>
                                        <div class="flex justify-center">
                                          <button class="flex items-center text-blue-600">
                                            <span>Upload Document</span>
                                          </button>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">PDF, JPG or PNG (max. 5MB)</p>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="grid grid-cols-2 gap-6 mb-6">
                                    <div class="border border-gray-200 rounded-md p-4">
                                      <h4 class="font-medium mb-2">Architectural Design</h4>
                                      <p class="text-sm text-gray-600 mb-4">Detailed architectural design of the property</p>
                                      
                                      <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                                        <div class="flex justify-center mb-2">
                                          <i data-lucide="upload" class="w-6 h-6 text-gray-400"></i>
                                        </div>
                                        <div class="flex justify-center">
                                          <button class="flex items-center text-blue-600">
                                            <span>Upload Document</span>
                                          </button>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">PDF, JPG or PNG (max. 5MB)</p>
                                      </div>
                                    </div>
                                    
                                    <div class="border border-gray-200 rounded-md p-4">
                                      <h4 class="font-medium mb-2">Ownership Document</h4>
                                      <p class="text-sm text-gray-600 mb-4">Proof of ownership (CofO, deed, etc.)</p>
                                      
                                      <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                                        <div class="flex justify-center mb-2">
                                          <i data-lucide="upload" class="w-6 h-6 text-gray-400"></i>
                                        </div>
                                        <div class="flex justify-center">
                                          <button class="flex items-center text-blue-600">
                                            <span>Upload Document</span>
                                          </button>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">PDF, JPG or PNG (max. 5MB)</p>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="flex justify-between mt-8">
                                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-md" id="backStep2">Back</button>
                                    <div class="flex items-center">
                                      <span class="text-sm text-gray-500 mr-4">Step 2 of 3</span>
                                      <button class="px-4 py-2 bg-black text-white rounded-md" id="nextStep2">Next</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        
                            <!-- Step 3: Application Summary -->
                            <div class="form-section" id="step3">
                              <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                  <h2 class="text-xl font-bold text-center text-gray-800">MINISTRY OF LAND AND PHYSICAL PLANNING</h2>
                                  <button id="closeModal3" class="text-gray-500 hover:text-gray-700">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                  </button>
                                </div>
                                
                                <div class="mb-6">
                                  <div class="flex items-center mb-2">
                                    <i data-lucide="file-text" class="w-5 h-5 mr-2 text-green-600"></i>
                                    <h3 class="text-lg font-bold">Application for Sectional Titling - Main Application</h3>
                                    <div class="ml-auto flex items-center">
                                      <span class="text-gray-600 mr-2">Land Use:</span>
                                      <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Residential</span>
                                    </div>
                                  </div>
                                  <p class="text-gray-600">Complete the form below to submit a new primary application for sectional titling</p>
                                </div>
                        
                                <div class="flex items-center mb-8">
                                  <div class="flex items-center mr-4">
                                    <div class="step-circle inactive-tab">1</div>
                                  </div>
                                  <div class="flex items-center mr-4">
                                    <div class="step-circle inactive-tab">2</div>
                                  </div>
                                  <div class="flex items-center">
                                    <div class="step-circle active-tab">3</div>
                                  </div>
                                  <div class="ml-4">Step 3</div>
                                </div>
                        
                                <div class="mb-6">
                                  <div class="flex items-start mb-4">
                                    <i data-lucide="file-text" class="w-5 h-5 mr-2 text-green-600"></i>
                                    <span class="font-medium">Application Summary</span>
                                  </div>
                                  
                                  <div class="border border-gray-200 rounded-md p-6 mb-6">
                                    <div class="grid grid-cols-2 gap-6">
                                      <div>
                                        <h4 class="font-medium mb-4">Applicant Information</h4>
                                        <table class="w-full text-sm">
                                          <tr>
                                            <td class="py-1 text-gray-600">Applicant Type:</td>
                                            <td class="py-1 font-medium">Individual</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">Name:</td>
                                            <td class="py-1 font-medium">Mr. Clement Joseph</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">Email:</td>
                                            <td class="py-1 font-medium">clemzy689@gmail.com</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">Phone:</td>
                                            <td class="py-1 font-medium">07032228984</td>
                                          </tr>
                                        </table>
                                      </div>
                                      
                                      <div>
                                        <h4 class="font-medium mb-4">Unit Information</h4>
                                        <table class="w-full text-sm">
                                          <tr>
                                            <td class="py-1 text-gray-600">Type of Residence:</td>
                                            <td class="py-1 font-medium">Detached House</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">Block No:</td>
                                            <td class="py-1 font-medium">7</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">Section (Floor) No:</td>
                                            <td class="py-1 font-medium">Not provided</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">Unit No:</td>
                                            <td class="py-1 font-medium">5</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">Unit Type:</td>
                                            <td class="py-1 font-medium">Not provided</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">File Number:</td>
                                            <td class="py-1 font-medium">CON-COM-2019-296</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">Land Use:</td>
                                            <td class="py-1 font-medium">Residential</td>
                                          </tr>
                                          <tr>
                                            <td class="py-1 text-gray-600">Primary Application ID:</td>
                                            <td class="py-1 font-medium">Not provided</td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="mb-6">
                                    <h4 class="font-medium mb-4">Address Information</h4>
                                    <table class="w-full text-sm">
                                      <tr>
                                        <td class="py-1 text-gray-600 w-1/4">House No:</td>
                                        <td class="py-1 font-medium">79</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600">Street Name:</td>
                                        <td class="py-1 font-medium">Umudagu road</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600">District:</td>
                                        <td class="py-1 font-medium">Not provided</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600">LGA:</td>
                                        <td class="py-1 font-medium">Not provided</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600">State:</td>
                                        <td class="py-1 font-medium">Kano</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600">Complete Address:</td>
                                        <td class="py-1 font-medium">79 Umudagu road, , , Kano</td>
                                      </tr>
                                    </table>
                                  </div>
                                  
                                  <div class="mb-6">
                                    <div class="flex items-start mb-4">
                                      <i data-lucide="file-text" class="w-5 h-5 mr-2 text-green-600"></i>
                                      <span class="font-medium">Payment Information</span>
                                    </div>
                                    <table class="w-full text-sm">
                                      <tr>
                                        <td class="py-1 text-gray-600 w-1/4">Application Fee:</td>
                                        <td class="py-1 font-medium">₦2,000</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600">Processing Fee:</td>
                                        <td class="py-1 font-medium">₦20,000</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600">Site Plan Fee:</td>
                                        <td class="py-1 font-medium">₦24,000</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600 font-medium">Total:</td>
                                        <td class="py-1 font-bold">₦46,000.00</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600">Receipt Number:</td>
                                        <td class="py-1 font-medium">RC-20478</td>
                                      </tr>
                                      <tr>
                                        <td class="py-1 text-gray-600">Payment Date:</td>
                                        <td class="py-1 font-medium">4/15/2025</td>
                                      </tr>
                                    </table>
                                  </div>
                                  
                                  <div class="mb-6">
                                    <h4 class="font-medium mb-4">Uploaded Documents</h4>
                                    <div class="grid grid-cols-2 gap-4">
                                      <div class="flex items-center">
                                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        <span>Application Letter</span>
                                      </div>
                                      <div class="flex items-center">
                                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        <span>Building Plan</span>
                                      </div>
                                      <div class="flex items-center">
                                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        <span>Architectural Design</span>
                                      </div>
                                      <div class="flex items-center">
                                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        <span>Ownership Document</span>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="flex justify-between mt-8">
                                    <div class="flex space-x-4">
                                      <button class="px-4 py-2 bg-white border border-gray-300 rounded-md" id="backStep3">Back</button>
                                      <button class="px-4 py-2 bg-white border border-gray-300 rounded-md flex items-center">
                                        <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                                        Print Application Slip
                                      </button>
                                    </div>
                                    <div class="flex items-center">
                                      <span class="text-sm text-gray-500 mr-4">Step 3 of 3</span>
                                      <button class="px-4 py-2 bg-black text-white rounded-md">Submit Application</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('admin.footer')
            </div>

            <script>
 // Initialize Lucide icons
 lucide.createIcons();
    
    // Form navigation
    document.addEventListener('DOMContentLoaded', function() {
      const step1 = document.getElementById('step1');
      const step2 = document.getElementById('step2');
      const step3 = document.getElementById('step3');
      
      const nextStep1 = document.getElementById('nextStep1');
      const nextStep2 = document.getElementById('nextStep2');
      const backStep2 = document.getElementById('backStep2');
      const backStep3 = document.getElementById('backStep3');
      
      // Next from Step 1 to Step 2
      nextStep1.addEventListener('click', function() {
        step1.classList.remove('active-tab');
        step2.classList.add('active-tab');
      });
      
      // Next from Step 2 to Step 3
      nextStep2.addEventListener('click', function() {
        step2.classList.remove('active-tab');
        step3.classList.add('active-tab');
      });
      
      // Back from Step 2 to Step 1
      backStep2.addEventListener('click', function() {
        step2.classList.remove('active-tab');
        step1.classList.add('active-tab');
      });
      
      // Back from Step 3 to Step 2
      backStep3.addEventListener('click', function() {
        step3.classList.remove('active-tab');
        step2.classList.add('active-tab');
      });
      
      // Close modal buttons
      document.getElementById('closeModal').addEventListener('click', function() {
        // In a real application, this would close the modal
        alert('Application process canceled');
      });
      
      document.getElementById('closeModal2').addEventListener('click', function() {
        // In a real application, this would close the modal
        alert('Application process canceled');
      });
      
      document.getElementById('closeModal3').addEventListener('click', function() {
        // In a real application, this would close the modal
        alert('Application process canceled');
      });
    });
            </script>

   @endsection
