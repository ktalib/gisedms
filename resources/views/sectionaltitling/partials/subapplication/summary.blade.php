<div class="form-section" id="step4">
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
            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">{{ $motherApplication->land_use ?? 'N/A' }}</span>
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
         <div class="flex items-center mr-4">
          <div class="step-circle inactive-tab">3</div>
        </div>
        <div class="flex items-center  mr-4">
          <div class="step-circle active-tab">4</div>
        </div>
        <div class="ml-4">Step 4</div>
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
                  <td class="py-1 font-medium" id="summary-applicant-type">
                    <span id="applicantTypeDisplay">Individual</span>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Name:</td>
                  <td class="py-1 font-medium" id="summary-applicant-name">
                    <span id="applicantNameDisplay"></span>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Email:</td>
                  <td class="py-1 font-medium" id="summary-applicant-email">
                    <span id="emailDisplay"></span>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Phone:</td>
                  <td class="py-1 font-medium" id="summary-applicant-phone">
                    <span id="phoneDisplay"></span>
                  </td>
                </tr>
              </table>
            </div>
            
            <div>
              <h4 class="font-medium mb-4">Unit Information</h4>
              <table class="w-full text-sm">
                <tr>
                  <td class="py-1 text-gray-600">Type of Residence:</td>
                  <td class="py-1 font-medium" id="summary-residence-type">
                    <span id="residenceTypeDisplay">Detached House</span>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Block No:</td>
                  <td class="py-1 font-medium" id="summary-block-no">
                    <span id="blockNumberDisplay"></span>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Section (Floor) No:</td>
                  <td class="py-1 font-medium" id="summary-floor-no">
                    <span id="floorNumberDisplay"></span>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Unit No:</td>
                  <td class="py-1 font-medium" id="summary-unit-no">
                    <span id="unitNumberDisplay"></span>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Unit Type:</td>
                  <td class="py-1 font-medium" id="summary-unit-type"></td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">File Number:</td>
                  <td class="py-1 font-medium" id="summary-file-number">
                    <span id="fileNumberDisplay">{{ $motherApplication->fileno ?? 'N/A' }}</span>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Land Use:</td>
                  <td class="py-1 font-medium" id="summary-land-use">
                    <span id="landUseDisplay">{{ $motherApplication->land_use ?? 'N/A' }}</span>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Primary Application ID:</td>
                  <td class="py-1 font-medium" id="summary-primary-app-id">
                    <span id="primaryAppIdDisplay">{{ $motherApplication->applicationID ?? 'N/A' }}</span>
                  </td>
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
              <td class="py-1 font-medium" id="summary-house-no">
                <span id="houseNoDisplay"></span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Street Name:</td>
              <td class="py-1 font-medium" id="summary-street-name">
                <span id="streetNameDisplay"></span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">District:</td>
              <td class="py-1 font-medium" id="summary-district">
                <span id="districtDisplay"></span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">LGA:</td>
              <td class="py-1 font-medium" id="summary-lga">
                <span id="lgaDisplay"></span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">State:</td>
              <td class="py-1 font-medium" id="summary-state">
                <span id="stateDisplay"></span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Complete Address:</td>
              <td class="py-1 font-medium" id="summary-complete-address">
                <span id="completeAddressDisplay"></span>
              </td>
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
              <td class="py-1 font-medium" id="summary-application-fee">
                <span id="applicationFeeDisplay">₦0</span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Processing Fee:</td>
              <td class="py-1 font-medium" id="summary-processing-fee">
                <span id="processingFeeDisplay">₦0</span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Site Plan Fee:</td>
              <td class="py-1 font-medium" id="summary-site-plan-fee">
                <span id="sitePlanFeeDisplay">₦0</span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600 font-medium">Total:</td>
              <td class="py-1 font-bold" id="summary-total-fee">
                <span id="totalFeeDisplay">₦0</span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Receipt Number:</td>
              <td class="py-1 font-medium" id="summary-receipt-number">
                <span id="receiptNumberDisplay"></span>
              </td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Payment Date:</td>
              <td class="py-1 font-medium" id="summary-payment-date">
                <span id="paymentDateDisplay"></span>
              </td>
            </tr>
          </table>
        </div>
        
        <div class="mb-6">
          <h4 class="font-medium mb-4">Uploaded Documents</h4>
          <div class="grid grid-cols-2 gap-4">
            <div class="flex items-center">
              <span id="applicationLetterIndicator" class="inline-block w-2 h-2 bg-red-500 rounded-full mr-2"></span>
              <span>Application Letter</span>
            </div>
            <div class="flex items-center">
              <span id="buildingPlanIndicator" class="inline-block w-2 h-2 bg-red-500 rounded-full mr-2"></span>
              <span>Building Plan</span>
            </div>
            <div class="flex items-center">
              <span id="architecturalDesignIndicator" class="inline-block w-2 h-2 bg-red-500 rounded-full mr-2"></span>
              <span>Architectural Design</span>
            </div>
            <div class="flex items-center">
              <span id="ownershipDocumentIndicator" class="inline-block w-2 h-2 bg-red-500 rounded-full mr-2"></span>
              <span>Ownership Document</span>
            </div>
          </div>
        </div>
        
        <div class="flex justify-between mt-8">
          <div class="flex space-x-4">
            <button class="px-4 py-2 bg-white border border-gray-300 rounded-md" id="backStep3">Back</button>
            <button type="button" id="printApplicationBtn" class="px-4 py-2 bg-white border border-gray-300 rounded-md flex items-center">
              <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
              Print Application Slip
            </button>
          </div>
          <div class="flex items-center">
            <span class="text-sm text-gray-500 mr-4">Step 4 of 4</span>
            <button type="submit" id="submitApplication" class="px-4 py-2 bg-black text-white rounded-md">Submit Application</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Print Application Slip Template (hidden by default) -->
<div id="printTemplate" class="hidden">
  <div class="print-container">
    <div class="print-header">
      <div class="text-center">
        <h1 class="text-xl font-bold mb-1">MINISTRY OF LAND AND PHYSICAL PLANNING</h1>
        <h2 class="text-lg font-semibold mb-4">APPLICATION FOR SECTIONAL TITLING</h2>
        <div class="border-b-2 border-black mb-6"></div>
      </div>
    </div>

    <div class="print-body">
      <div class="mb-4">
        <h3 class="text-lg font-bold mb-2">Application Receipt</h3>
        <div class="flex justify-between mb-2">
          <span>Application ID: <span id="print-application-id">{{ $motherApplication->applicationID ?? 'N/A' }}</span></span>
          <span>Date: <span id="print-date"></span></span>
        </div>
        <div class="flex justify-between">
          <span>File Number: <span id="print-file-number">{{ $motherApplication->fileno ?? 'N/A' }}</span></span>
          <span>Land Use: <span id="print-land-use">{{ $motherApplication->land_use ?? 'N/A' }}</span></span>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-6 mb-4">
        <div>
          <h4 class="font-medium mb-2 border-b border-gray-300 pb-1">Applicant Information</h4>
          <table class="w-full text-sm">
            <tr>
              <td class="py-1 text-gray-600 w-1/3">Applicant Type:</td>
              <td class="py-1 font-medium" id="print-applicant-type"></td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Name:</td>
              <td class="py-1 font-medium" id="print-applicant-name"></td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Email:</td>
              <td class="py-1 font-medium" id="print-email"></td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Phone:</td>
              <td class="py-1 font-medium" id="print-phone"></td>
            </tr>
          </table>
        </div>
        
        <div>
          <h4 class="font-medium mb-2 border-b border-gray-300 pb-1">Unit Information</h4>
          <table class="w-full text-sm">
            <tr>
              <td class="py-1 text-gray-600 w-1/2">Type of Residence:</td>
              <td class="py-1 font-medium" id="print-residence-type"></td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Block No:</td>
              <td class="py-1 font-medium" id="print-block-no"></td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Section (Floor) No:</td>
              <td class="py-1 font-medium" id="print-floor-no"></td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Unit No:</td>
              <td class="py-1 font-medium" id="print-unit-no"></td>
            </tr>
          </table>
        </div>
      </div>

      <div class="mb-4">
        <h4 class="font-medium mb-2 border-b border-gray-300 pb-1">Address Information</h4>
        <table class="w-full text-sm">
          <tr>
            <td class="py-1 text-gray-600 w-1/4">Complete Address:</td>
            <td class="py-1 font-medium" id="print-complete-address"></td>
          </tr>
        </table>
      </div>
      
      <div class="mb-6">
        <h4 class="font-medium mb-2 border-b border-gray-300 pb-1">Payment Information</h4>
        <table class="w-full text-sm">
          <tr>
            <td class="py-1 text-gray-600 w-1/4">Application Fee:</td>
            <td class="py-1 font-medium" id="print-application-fee"></td>
          </tr>
          <tr>
            <td class="py-1 text-gray-600">Processing Fee:</td>
            <td class="py-1 font-medium" id="print-processing-fee"></td>
          </tr>
          <tr>
            <td class="py-1 text-gray-600">Site Plan Fee:</td>
            <td class="py-1 font-medium" id="print-site-plan-fee"></td>
          </tr>
          <tr>
            <td class="py-1 text-gray-600 font-medium">Total:</td>
            <td class="py-1 font-bold" id="print-total-fee"></td>
          </tr>
          <tr>
            <td class="py-1 text-gray-600">Receipt Number:</td>
            <td class="py-1 font-medium" id="print-receipt-number"></td>
          </tr>
          <tr>
            <td class="py-1 text-gray-600">Payment Date:</td>
            <td class="py-1 font-medium" id="print-payment-date"></td>
          </tr>
        </table>
      </div>

      <div class="mb-6 grid grid-cols-2 gap-4">
        <div>
          <h4 class="font-medium mb-2 border-b border-gray-300 pb-1">Required Documents</h4>
          <ul class="list-disc pl-5">
            <li class="py-1" id="print-doc-application-letter">Application Letter</li>
            <li class="py-1" id="print-doc-building-plan">Building Plan</li>
            <li class="py-1" id="print-doc-architectural-design">Architectural Design</li>
            <li class="py-1" id="print-doc-ownership-document">Ownership Document</li>
          </ul>
        </div>
        <div>
          <h4 class="font-medium mb-2 border-b border-gray-300 pb-1">For Official Use Only</h4>
          <div class="mt-4">
            <div class="border-t border-gray-300 pt-4 mt-4">
              <div class="text-center">
                <p>Signature & Stamp</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="print-footer mt-6 text-center text-sm">
      <p>This is an official application receipt. Please keep for your records.</p>
      <p>Application submitted on: <span id="print-submission-date"></span></p>
    </div>
  </div>
</div>

<style>
  @media print {
    body * {
      visibility: hidden;
    }
    #printTemplate, #printTemplate * {
      visibility: visible;
    }
    #printTemplate {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      display: block !important;
    }
    .print-container {
      padding: 20px;
    }
    .no-print {
      display: none;
    }
  }
</style>

<script>
// Function to update the summary
function updateApplicationSummary() {
  // Applicant Information
  const applicantType = document.querySelector('input[name="applicantType"]:checked')?.value || 'Individual';
  document.getElementById('applicantTypeDisplay').textContent = applicantType.charAt(0).toUpperCase() + applicantType.slice(1);
  
  // Name display logic
  if (applicantType === 'individual') {
    const title = document.getElementById('applicantTitle')?.value || '';
    const firstName = document.getElementById('applicantName')?.value || '';
    const middleName = document.getElementById('applicantMiddleName')?.value || '';
    const surname = document.getElementById('applicantSurname')?.value || '';
    
    let fullName = '';
    if (title) fullName += title + ' ';
    if (firstName) fullName += firstName + ' ';
    if (middleName) fullName += middleName + ' ';
    if (surname) fullName += surname;
    
    document.getElementById('applicantNameDisplay').textContent = fullName.trim();
  } else if (applicantType === 'corporate') {
    document.getElementById('applicantNameDisplay').textContent = document.getElementById('corporateName')?.value || 'N/A';
  } else if (applicantType === 'multiple') {
    // For multiple owners, we could show the first owner or a count
    const ownerInputs = document.querySelectorAll('input[name="multiple_owners_names[]"]');
    if (ownerInputs.length > 0) {
      document.getElementById('applicantNameDisplay').textContent = 
        ownerInputs[0].value + (ownerInputs.length > 1 ? ` + ${ownerInputs.length - 1} more` : '');
    } else {
      document.getElementById('applicantNameDisplay').textContent = 'Multiple Owners';
    }
  }
  
  // Email and Phone
  document.getElementById('emailDisplay').textContent = document.querySelector('input[name="owner_email"]')?.value || 'N/A';
  const phoneInputs = document.querySelectorAll('input[name="phone_number[]"]');
  const phoneNumber = phoneInputs[0]?.value || 'N/A';
  document.getElementById('phoneDisplay').textContent = phoneNumber;
  
  // Unit Information
  // Determine residence type based on land use
  let residenceType = '';
  const landUse = document.getElementById('landUseDisplay').textContent;
  
  if (landUse.includes('Residential') || landUse.includes('Mixed')) {
    residenceType = document.querySelector('input[name="residence_type"]:checked')?.value || 'N/A';
  } else if (landUse.includes('Commercial')) {
    residenceType = document.querySelector('input[name="commercial_type"]:checked')?.value || 'N/A';
  } else if (landUse.includes('Industrial')) {
    residenceType = document.querySelector('input[name="industrial_type"]:checked')?.value || 'N/A';
  }
  
  document.getElementById('residenceTypeDisplay').textContent = residenceType;
  document.getElementById('blockNumberDisplay').textContent = document.querySelector('input[name="block_number"]')?.value || 'N/A';
  document.getElementById('floorNumberDisplay').textContent = document.querySelector('input[name="floor_number"]')?.value || 'N/A';
  document.getElementById('unitNumberDisplay').textContent = document.querySelector('input[name="unit_number"]')?.value || 'N/A';
  
  // Address Information
  const houseNo = document.querySelector('input[name="address_house_no"]')?.value || '';
  const streetName = document.querySelector('input[name="address_street_name"]')?.value || '';
  const district = document.querySelector('input[name="address_district"]')?.value || '';
  const lga = document.querySelector('input[name="address_lga"]')?.value || '';
  const state = document.querySelector('input[name="address_state"]')?.value || '';
  
  document.getElementById('houseNoDisplay').textContent = houseNo || 'N/A';
  document.getElementById('streetNameDisplay').textContent = streetName || 'N/A';
  document.getElementById('districtDisplay').textContent = district || 'N/A';
  document.getElementById('lgaDisplay').textContent = lga || 'N/A';
  document.getElementById('stateDisplay').textContent = state || 'N/A';
  
  // Construct complete address
  const addressParts = [houseNo, streetName, district, lga, state].filter(part => part);
  const completeAddress = addressParts.join(', ');
  document.getElementById('completeAddressDisplay').textContent = completeAddress || 'N/A';
  
  // Payment Information
  const applicationFee = parseFloat(document.querySelector('input[name="application_fee"]')?.value || 0);
  const processingFee = parseFloat(document.querySelector('input[name="processing_fee"]')?.value || 0);
  const sitePlanFee = parseFloat(document.querySelector('input[name="site_plan_fee"]')?.value || 0);
  
  document.getElementById('applicationFeeDisplay').textContent = '₦' + applicationFee.toLocaleString();
  document.getElementById('processingFeeDisplay').textContent = '₦' + processingFee.toLocaleString();
  document.getElementById('sitePlanFeeDisplay').textContent = '₦' + sitePlanFee.toLocaleString();
  
  const totalFee = applicationFee + processingFee + sitePlanFee;
  document.getElementById('totalFeeDisplay').textContent = '₦' + totalFee.toLocaleString() + '.00';
  
  document.getElementById('receiptNumberDisplay').textContent = document.querySelector('input[name="receipt_number"]')?.value || 'N/A';
  
  // Format date
  const paymentDateInput = document.querySelector('input[name="payment_date"]')?.value;
  let formattedDate = 'N/A';
  if (paymentDateInput) {
    const date = new Date(paymentDateInput);
    formattedDate = new Intl.DateTimeFormat('en-US', {
      month: 'numeric',
      day: 'numeric',
      year: 'numeric'
    }).format(date);
  }
  document.getElementById('paymentDateDisplay').textContent = formattedDate;
  
  // Documents
  updateDocumentIndicators();
}

// Update document indicators based on file uploads
function updateDocumentIndicators() {
  const documents = [
    { id: 'application_letter', indicator: 'applicationLetterIndicator' },
    { id: 'building_plan', indicator: 'buildingPlanIndicator' },
    { id: 'architectural_design', indicator: 'architecturalDesignIndicator' },
    { id: 'ownership_document', indicator: 'ownershipDocumentIndicator' }
  ];
  
  documents.forEach(doc => {
    const fileInput = document.getElementById(doc.id);
    const indicator = document.getElementById(doc.indicator);
    
    if (fileInput && fileInput.files && fileInput.files.length > 0) {
      indicator.classList.remove('bg-red-500');
      indicator.classList.add('bg-green-500');
    } else {
      indicator.classList.remove('bg-green-500');
      indicator.classList.add('bg-red-500');
    }
  });
}

// Initialize form event listeners to update summary
document.addEventListener('DOMContentLoaded', function() {
  // Update summary when the "Next" button on step 3 is clicked
  const nextStep3Button = document.getElementById('nextStep3');
  if (nextStep3Button) {
    nextStep3Button.addEventListener('click', updateApplicationSummary);
  }
  
  // Set up event listeners for form fields to update address preview
  const addressFields = ['ownerHouseNo', 'ownerStreetName', 'ownerDistrict', 'ownerLga', 'ownerState'];
  addressFields.forEach(fieldId => {
    const field = document.getElementById(fieldId);
    if (field) {
      field.addEventListener('input', function() {
        const houseNo = document.getElementById('ownerHouseNo').value;
        const streetName = document.getElementById('ownerStreetName').value;
        const district = document.getElementById('ownerDistrict').value;
        const lga = document.getElementById('ownerLga').value;
        const state = document.getElementById('ownerState').value;
        
        const parts = [houseNo, streetName, district, lga, state].filter(part => part);
        const fullAddress = parts.join(', ');
        
        document.getElementById('fullContactAddress').textContent = fullAddress;
        document.getElementById('contactAddressDisplay').value = fullAddress;
      });
    }
  });
  
  // Listen to changes in fee fields to update total
  const feeFields = ['application_fee', 'processing_fee', 'site_plan_fee'];
  feeFields.forEach(fieldName => {
    const field = document.querySelector(`input[name="${fieldName}"]`);
    if (field) {
      field.addEventListener('input', function() {
        const applicationFee = parseFloat(document.querySelector('input[name="application_fee"]')?.value || 0);
        const processingFee = parseFloat(document.querySelector('input[name="processing_fee"]')?.value || 0);
        const sitePlanFee = parseFloat(document.querySelector('input[name="site_plan_fee"]')?.value || 0);
        
        const totalFee = applicationFee + processingFee + sitePlanFee;
        const totalFeeEl = document.querySelector('.flex.justify-between.items-center.mb-4 span.font-bold');
        if (totalFeeEl) {
          totalFeeEl.textContent = '₦' + totalFee.toLocaleString() + '.00';
        }
      });
    }
  });
  
  // Add print functionality
  document.getElementById('printApplicationBtn').addEventListener('click', function() {
    // Populate the print template with current values
    document.getElementById('print-date').textContent = new Date().toLocaleDateString();
    document.getElementById('print-submission-date').textContent = new Date().toLocaleString();
    
    // Applicant Information
    document.getElementById('print-applicant-type').textContent = document.getElementById('applicantTypeDisplay').textContent;
    document.getElementById('print-applicant-name').textContent = document.getElementById('applicantNameDisplay').textContent;
    document.getElementById('print-email').textContent = document.getElementById('emailDisplay').textContent;
    document.getElementById('print-phone').textContent = document.getElementById('phoneDisplay').textContent;
    
    // Unit Information
    document.getElementById('print-residence-type').textContent = document.getElementById('residenceTypeDisplay').textContent;
    document.getElementById('print-block-no').textContent = document.getElementById('blockNumberDisplay').textContent;
    document.getElementById('print-floor-no').textContent = document.getElementById('floorNumberDisplay').textContent;
    document.getElementById('print-unit-no').textContent = document.getElementById('unitNumberDisplay').textContent;
    
    // Address Information
    document.getElementById('print-complete-address').textContent = document.getElementById('completeAddressDisplay').textContent;
    
    // Payment Information
    document.getElementById('print-application-fee').textContent = document.getElementById('applicationFeeDisplay').textContent;
    document.getElementById('print-processing-fee').textContent = document.getElementById('processingFeeDisplay').textContent;
    document.getElementById('print-site-plan-fee').textContent = document.getElementById('sitePlanFeeDisplay').textContent;
    document.getElementById('print-total-fee').textContent = document.getElementById('totalFeeDisplay').textContent;
    document.getElementById('print-receipt-number').textContent = document.getElementById('receiptNumberDisplay').textContent;
    document.getElementById('print-payment-date').textContent = document.getElementById('paymentDateDisplay').textContent;
    
    // Document status
    const docElements = [
      { id: 'applicationLetterIndicator', printId: 'print-doc-application-letter' },
      { id: 'buildingPlanIndicator', printId: 'print-doc-building-plan' },
      { id: 'architecturalDesignIndicator', printId: 'print-doc-architectural-design' },
      { id: 'ownershipDocumentIndicator', printId: 'print-doc-ownership-document' }
    ];
    
    docElements.forEach(doc => {
      const indicator = document.getElementById(doc.id);
      const printElement = document.getElementById(doc.printId);
      
      if (indicator.classList.contains('bg-green-500')) {
        printElement.innerHTML = printElement.innerHTML + ' <span class="text-green-600">(Uploaded)</span>';
      } else {
        printElement.innerHTML = printElement.innerHTML + ' <span class="text-red-600">(Not Uploaded)</span>';
      }
    });
    
    // Trigger print
    window.print();
  });
});
</script>
