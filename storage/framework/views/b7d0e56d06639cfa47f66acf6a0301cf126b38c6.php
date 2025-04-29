            
            <?php $__env->startSection('page-title'); ?>
            <?php echo e(__('SECTIONAL TITLING  MODULE')); ?>

            <?php $__env->stopSection(); ?>
            <?php echo $__env->make('sectionaltitling.sub_app_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('sectionaltitling.partials.assets.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php $__env->startSection('content'); ?>
            <!-- Main Content -->
            <div class="flex-1 overflow-auto">
            <!-- Header -->
            <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Dashboard Content -->
            <div class="p-6">

                

                <?php
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
              ?>

                <!-- Primary Applications Table -->
                <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
                    <div class="container py-4">
                        <div class="modal-content">
                            <!-- Step 1: Basic Information -->
                            
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
                                      <h3 class="text-lg font-bold items-center">Application for Sectional Titling - Secondary Application</h3>
                                    </div>
                                    <div class="flex items-center">
                                      <span class="text-gray-600 mr-2">Land Use:</span>
                                      <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm"><?php echo e($motherApplication->land_use ?? 'N/A'); ?></span>
                                    </div>
                                  </div>
                                  <p class="text-gray-600 mt-1">Complete the form below to submit a new secondary application for sectional titling</p>
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
                                   <div class="flex items-center">
                                    <div class="step-circle inactive-tab flex items-center justify-center">4</div>
                                  </div>
                                  <div class="ml-4">Step 1</div>
                                </div>
                        
                                <div class="mb-6">
                                  <div class="text-right text-sm text-gray-500">CODE: ST FORM - 1</div>
                                  <hr class="my-4">
                                  <?php
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
                                  ?>
                                  
                                  <form id="subApplicationForm" method="POST" action="<?php echo e(route('secondaryform.save')); ?>" enctype="multipart/form-data" class="space-y-6">
                                    <?php echo csrf_field(); ?>
                                    
                                    
                                  <div class="mb-6">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Main Application Reference</h2>
                                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5">
                                      <div class="flex items-center justify-between mb-4">
                                        <div>
                                          <label class="block text-sm font-medium text-gray-700 mb-1">Main Application ID</label>
                                          <div class="flex items-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card-icon lucide-id-card"><path d="M16 10h2"/><path d="M16 14h2"/><path d="M6.17 15a3 3 0 0 1 5.66 0"/><circle cx="9" cy="11" r="2"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg> 

                                              <?php echo e($motherApplication->applicationID ?? 'N/A'); ?>

                                            </span>
                                          </div>            
                                          <input type="hidden" name="main_application_id" value="<?php echo e($motherApplication->applicationID ?? ''); ?>">
                                         
                                        </div>
                                        <div class="flex items-center">
                                          <span class="px-3 py-1 text-sm rounded-full <?php echo e($remainingUnits > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                            <?php echo e($remainingUnits); ?> units remaining
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
                                              <span class="font-medium"><?php echo e($motherApplication->applicant_type ?? 'N/A'); ?></span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Name:</span>
                                              <span class="font-medium">
                                                <?php echo e($motherApplication->applicant_title ?? ''); ?> 
                                                <?php echo e($motherApplication->first_name ?? ''); ?> 
                                                <?php echo e($motherApplication->surname ?? ''); ?>

                                              </span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Form ID:</span>
                                              <span class="font-medium"><?php echo e($motherApplication->id ?? 'N/A'); ?></span>
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
                                              <span class="font-medium"><?php echo e($motherApplication->fileno ?? 'N/A'); ?></span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Land Use:</span>
                                              <span class="font-medium"><?php echo e($motherApplication->land_use ?? 'N/A'); ?></span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Property Location:</span>
                                              <span class="font-medium"><?php echo e($propertyLocation ?: 'N/A'); ?></span>
                                            </div>
                                            <div class="flex">
                                              <span class="text-gray-500 w-36">Total Units:</span>
                                              <span class="font-medium"><?php echo e($totalUnitsInMotherApp); ?></span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <!-- Progress indicator -->
                                      <div class="mt-5 pt-4 border-t border-gray-200">
                                        <div class="flex items-center">
                                          <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <?php $progressPercent = $totalUnitsInMotherApp > 0 ? (($totalSubApplications / $totalUnitsInMotherApp) * 100) : 0; ?>
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo e($progressPercent); ?>%"></div>
                                          </div>
                                          <span class="ml-3 text-sm text-gray-600"><?php echo e($totalSubApplications); ?>/<?php echo e($totalUnitsInMotherApp); ?> units registered</span>
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

                                  <?php echo $__env->make('sectionaltitling.partials.subapplication.applicant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                  

                                  <div class="bg-gray-50 p-4 rounded-md mb-6">
                        
                                     
                                   
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                     
                                       
                                        <div style="display: none">
                                          <input type="text"   class="w-full p-2 border border-gray-300 rounded-md"  name="prefix" value="<?php echo e($prefix); ?>" >
                                          <input type="text"   class="w-full p-2 border border-gray-300 rounded-md"  name="year" value="<?php echo e($currentYear); ?>"  >
                                          <input type="text"   class="w-full p-2 border border-gray-300 rounded-md"  name="serial_number" value="<?php echo e($formattedSerialNumber); ?>"  >
                                            <input type="text"  class="w-full p-2 border border-gray-300 rounded-md"  name="fileno" value="<?php echo e($prefix); ?>-<?php echo e($currentYear); ?>-<?php echo e($formattedSerialNumber); ?>" >
                                        </div> 
                                        
                                        
                                        <div>
                                            <label class="block text-sm mb-1">Scheme No</label>
                                            <input type="text" id="schemeName" class="w-full p-2 border border-gray-300 rounded-md"    name="scheme_no" placeholder="enter scheme number. eg: ST/SP/0001">
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
                                    <?php echo $__env->make('sectionaltitling.types.ownership', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('sectionaltitling.types.commercial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('sectionaltitling.types.residential', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('sectionaltitling.types.industrial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
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
                        
                            <!-- Step 2:shared areas -->
                            <?php echo $__env->make('sectionaltitling.partials.subapplication.sharedareas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                             <!-- Step 3: Application documents -->
                            <?php echo $__env->make('sectionaltitling.partials.subapplication.documents', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <!-- Step 4: Application Summary -->
                            <?php echo $__env->make('sectionaltitling.partials.subapplication.summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           

                          </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php echo $__env->make('admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <script>
 // Initialize Lucide icons
      lucide.createIcons();
    
    // Form navigation
    document.addEventListener('DOMContentLoaded', function() {
      const step1 = document.getElementById('step1');
      const step2 = document.getElementById('step2');
      const step3 = document.getElementById('step3');
      const step4 = document.getElementById('step4');
      
      const nextStep1 = document.getElementById('nextStep1');
      const nextStep2 = document.getElementById('nextStep2');
      const nextStep3 = document.getElementById('nextStep3');
      const backStep2 = document.getElementById('backStep2');
      const backStep3 = document.getElementById('backStep3');
      const backStep4 = document.getElementById('backStep4');
      
      // Function to safely add event listeners
      function addSafeEventListener(element, event, callback) {
        if (element) {
          element.addEventListener(event, callback);
        }
      }
      
      // Next from Step 1 to Step 2
      addSafeEventListener(nextStep1, 'click', function(e) {
        e.preventDefault();
        step1.classList.remove('active-tab');
        step2.classList.add('active-tab');
        
        // Update step indicator (optional)
        document.querySelectorAll('.step-circle')[0].classList.remove('active-tab');
        document.querySelectorAll('.step-circle')[0].classList.add('inactive-tab');
        document.querySelectorAll('.step-circle')[1].classList.remove('inactive-tab');
        document.querySelectorAll('.step-circle')[1].classList.add('active-tab');
      });
      
      // Next from Step 2 to Step 3
      addSafeEventListener(nextStep2, 'click', function(e) {
        e.preventDefault();
        step2.classList.remove('active-tab');
        step3.classList.add('active-tab');
        
        // Update step indicator (optional)
        document.querySelectorAll('.step-circle')[1].classList.remove('active-tab');
        document.querySelectorAll('.step-circle')[1].classList.add('inactive-tab');
        document.querySelectorAll('.step-circle')[2].classList.remove('inactive-tab');
        document.querySelectorAll('.step-circle')[2].classList.add('active-tab');
      });
      
      // Next from Step 3 to Step 4
      addSafeEventListener(nextStep3, 'click', function(e) {
        e.preventDefault();
        step3.classList.remove('active-tab');
        step4.classList.add('active-tab');
        
        // Update step indicator (optional)
        document.querySelectorAll('.step-circle')[2].classList.remove('active-tab');
        document.querySelectorAll('.step-circle')[2].classList.add('inactive-tab');
        document.querySelectorAll('.step-circle')[3].classList.remove('inactive-tab');
        document.querySelectorAll('.step-circle')[3].classList.add('active-tab');
      });
      
      // Back from Step 2 to Step 1
      addSafeEventListener(backStep2, 'click', function(e) {
        e.preventDefault();
        step2.classList.remove('active-tab');
        step1.classList.add('active-tab');
        
        // Update step indicator (optional)
        document.querySelectorAll('.step-circle')[1].classList.remove('active-tab');
        document.querySelectorAll('.step-circle')[1].classList.add('inactive-tab');
        document.querySelectorAll('.step-circle')[0].classList.remove('inactive-tab');
        document.querySelectorAll('.step-circle')[0].classList.add('active-tab');
      });
      
      // Back from Step 3 to Step 2
      addSafeEventListener(backStep3, 'click', function(e) {
        e.preventDefault();
        step3.classList.remove('active-tab');
        step2.classList.add('active-tab');
        
        // Update step indicator (optional)
        document.querySelectorAll('.step-circle')[2].classList.remove('active-tab');
        document.querySelectorAll('.step-circle')[2].classList.add('inactive-tab');
        document.querySelectorAll('.step-circle')[1].classList.remove('inactive-tab');
        document.querySelectorAll('.step-circle')[1].classList.add('active-tab');
      });
      
      // Back from Step 4 to Step 3
      addSafeEventListener(backStep4, 'click', function(e) {
        e.preventDefault();
        step4.classList.remove('active-tab');
        step3.classList.add('active-tab');
        
        // Update step indicator (optional)
        document.querySelectorAll('.step-circle')[3].classList.remove('active-tab');
        document.querySelectorAll('.step-circle')[3].classList.add('inactive-tab');
        document.querySelectorAll('.step-circle')[2].classList.remove('inactive-tab');
        document.querySelectorAll('.step-circle')[2].classList.add('active-tab');
      });
      
      // Submit form from Step 4
      document.getElementById('submitApplication').addEventListener('click', function(e) {
        // Submit the form
        document.getElementById('subApplicationForm').submit();
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
      
      document.getElementById('closeModal4').addEventListener('click', function() {
        // In a real application, this would close the modal
        alert('Application process canceled');
      });
    });  
     </script>

   <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/sectionaltitling/sub_application.blade.php ENDPATH**/ ?>