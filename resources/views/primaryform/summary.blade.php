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
          <div class="step-circle inactive">1</div>
        </div>
        <div class="flex items-center mr-4">
          <div class="step-circle inactive">2</div>
        </div>
        <div class="flex items-center">
          <div class="step-circle active">3</div>
        </div>
        <div class="ml-4">Step 3</div>
      </div>

      <div class="mb-6" id="application-summary">
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
                  <td class="py-1 font-medium" id="summary-applicant-type">-</td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Name:</td>
                  <td class="py-1 font-medium" id="summary-name">-</td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Email:</td>
                  <td class="py-1 font-medium" id="summary-email">-</td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Phone:</td>
                  <td class="py-1 font-medium" id="summary-phone">-</td>
                </tr>
              </table>
            </div>
            
            <div>
              <h4 class="font-medium mb-4">Unit Information</h4>
              <table class="w-full text-sm">
                <tr>
                  <td class="py-1 text-gray-600">Type of Residence:</td>
                  <td class="py-1 font-medium" id="summary-residence-type">-</td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Block No:</td>
                  <td class="py-1 font-medium" id="summary-blocks">-</td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Section (Floor) No:</td>
                  <td class="py-1 font-medium" id="summary-sections">-</td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Unit No:</td>
                  <td class="py-1 font-medium" id="summary-units">-</td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">File Number:</td>
                  <td class="py-1 font-medium" id="summary-file-number">-</td>
                </tr>
                <tr>
                  <td class="py-1 text-gray-600">Land Use:</td>
                  <td class="py-1 font-medium">Residential</td>
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
              <td class="py-1 font-medium" id="summary-house-no">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Street Name:</td>
              <td class="py-1 font-medium" id="summary-street-name">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">District:</td>
              <td class="py-1 font-medium" id="summary-district">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">LGA:</td>
              <td class="py-1 font-medium" id="summary-lga">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">State:</td>
              <td class="py-1 font-medium" id="summary-state">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Complete Address:</td>
              <td class="py-1 font-medium" id="summary-full-address">-</td>
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
              <td class="py-1 font-medium" id="summary-application-fee">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Processing Fee:</td>
              <td class="py-1 font-medium" id="summary-processing-fee">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Site Plan Fee:</td>
              <td class="py-1 font-medium" id="summary-site-plan-fee">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600 font-medium">Total:</td>
              <td class="py-1 font-bold" id="summary-total-fee">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Receipt Number:</td>
              <td class="py-1 font-medium" id="summary-receipt-number">-</td>
            </tr>
            <tr>
              <td class="py-1 text-gray-600">Payment Date:</td>
              <td class="py-1 font-medium" id="summary-payment-date">-</td>
            </tr>
          </table>
        </div>
        
        <div class="mb-6">
          <h4 class="font-medium mb-4">Uploaded Documents</h4>
          <div class="grid grid-cols-2 gap-4" id="summary-documents">
            <!-- Documents will be populated dynamically -->
          </div>
        </div>
        
        <div class="flex justify-between mt-8">
          <div class="flex space-x-4">
            <button type="button" class="px-4 py-2 bg-white border border-gray-300 rounded-md" id="backStep3">Back</button>
            <button type="button" class="px-4 py-2 bg-white border border-gray-300 rounded-md flex items-center" id="printApplicationSlip">
              <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
              Print Application Slip
            </button>
          </div>
          <div class="flex items-center">
            <span class="text-sm text-gray-500 mr-4">Step 3 of 3</span>
            <button type="submit" class="px-4 py-2 bg-black text-white rounded-md">Submit Application</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Function to update the application summary
      function updateApplicationSummary() {
        // Applicant Information
        const applicantType = document.querySelector('input[name="applicantType"]:checked')?.value || '-';
        const title = document.querySelector('select[name="applicant_title"]').value || '';
        const fullName = document.querySelector('input[name="fullname"]').value || '-';
        const email = document.querySelector('input[name="owner_email"]').value || '-';
        const phone1 = document.querySelectorAll('input[name="phone_number[]"]')[0]?.value || '-';
        const phone2 = document.querySelectorAll('input[name="phone_number[]"]')[1]?.value || '';
        const phones = [phone1, phone2].filter(Boolean).join(', ');
        
        // Address Information
        const houseNo = document.querySelector('input[name="address_house_no"]').value || '-';
        const streetName = document.querySelector('input[name="owner_street_name"]').value || '-';
        const district = document.querySelector('input[name="owner_district"]').value || '-';
        const lga = document.querySelector('input[name="owner_lga"]').value || '-';
        const state = document.querySelector('input[name="owner_state"]').value || '-';
        const fullAddress = `${houseNo} ${streetName}, ${district}, ${lga}, ${state}`.replace(/,\s*-/g, '');
        
        // Property Details
        const residenceType = document.querySelector('input[name="residenceType"]:checked')?.value || '-';
        const unitsCount = document.querySelector('input[name="units_count"]').value || '-';
        const blocksCount = document.querySelector('input[name="blocks_count"]').value || '-';
        const sectionsCount = document.querySelector('input[name="sections_count"]').value || '-';
        
        // File Number - Get active file number from the active tab
        let fileNumber = '-';
        const activeFileTab = document.querySelector('.tabcontent.active');
        if (activeFileTab) {
          const tabId = activeFileTab.id;
          if (tabId === 'mlsFNo') {
            fileNumber = document.getElementById('mlsPreviewFileNumber').value || '-';
          } else if (tabId === 'kangisFileNo') {
            fileNumber = document.getElementById('kangisPreviewFileNumber').value || '-';
          } else if (tabId === 'NewKANGISFileno') {
            fileNumber = document.getElementById('newKangisPreviewFileNumber').value || '-';
          }
        }
        
        // Payment Information
        const appFee = parseFloat(document.querySelector('input[name="application_fee"]').value || 0);
        const procFee = parseFloat(document.querySelector('input[name="processing_fee"]').value || 0);
        const sitePlanFee = parseFloat(document.querySelector('input[name="site_plan_fee"]').value || 0);
        const totalFee = appFee + procFee + sitePlanFee;
        const receiptNumber = document.querySelector('input[name="receipt_number"]').value || '-';
        const paymentDate = document.querySelector('input[name="payment_date"]').value || '-';
        
        // Format currency
        const formatCurrency = (amount) => {
          return '₦' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        };
        
        // Update summary fields
        document.getElementById('summary-applicant-type').textContent = applicantType;
        document.getElementById('summary-name').textContent = title + ' ' + fullName;
        document.getElementById('summary-email').textContent = email;
        document.getElementById('summary-phone').textContent = phones;
        
        document.getElementById('summary-residence-type').textContent = residenceType;
        document.getElementById('summary-units').textContent = unitsCount;
        document.getElementById('summary-blocks').textContent = blocksCount;
        document.getElementById('summary-sections').textContent = sectionsCount;
        document.getElementById('summary-file-number').textContent = fileNumber;
        
        document.getElementById('summary-house-no').textContent = houseNo;
        document.getElementById('summary-street-name').textContent = streetName;
        document.getElementById('summary-district').textContent = district;
        document.getElementById('summary-lga').textContent = lga;
        document.getElementById('summary-state').textContent = state;
        document.getElementById('summary-full-address').textContent = fullAddress;
        
        document.getElementById('summary-application-fee').textContent = formatCurrency(appFee);
        document.getElementById('summary-processing-fee').textContent = formatCurrency(procFee);
        document.getElementById('summary-site-plan-fee').textContent = formatCurrency(sitePlanFee);
        document.getElementById('summary-total-fee').textContent = formatCurrency(totalFee);
        document.getElementById('summary-receipt-number').textContent = receiptNumber;
        document.getElementById('summary-payment-date').textContent = paymentDate;
        
        // Collect and display uploaded documents
        const documentsContainer = document.getElementById('summary-documents');
        documentsContainer.innerHTML = '';
        
        // Check which documents have been uploaded
        const documents = [
          { name: 'Application Letter', id: 'application-letter-input' },
          { name: 'Building Plan', id: 'building-plan-input' },
          { name: 'Architectural Design', id: 'architectural-design-input' },
          { name: 'Ownership Document', id: 'ownership-document-input' }
        ];
        
        documents.forEach(doc => {
          const input = document.getElementById(doc.id);
          const isUploaded = input && input.files && input.files.length > 0;
          
          const docElement = document.createElement('div');
          docElement.className = 'flex items-center';
          
          const statusDot = document.createElement('span');
          statusDot.className = `inline-block w-2 h-2 ${isUploaded ? 'bg-green-500' : 'bg-red-500'} rounded-full mr-2`;
          
          const docName = document.createElement('span');
          docName.textContent = doc.name;
          
          docElement.appendChild(statusDot);
          docElement.appendChild(docName);
          documentsContainer.appendChild(docElement);
        });
      }
      
      // Initialize Print Application Slip functionality
      function initializePrintFunctionality() {
        const printButton = document.getElementById('printApplicationSlip');
        
        if (printButton) {
          printButton.addEventListener('click', function() {
            // Copy summary data to print template
            document.getElementById('print-app-id').textContent = 'APP-' + Math.floor(Math.random() * 100000);
            document.getElementById('print-date').textContent = new Date().toLocaleDateString();
            document.getElementById('print-applicant-type').textContent = document.getElementById('summary-applicant-type').textContent;
            document.getElementById('print-name').textContent = document.getElementById('summary-name').textContent;
            document.getElementById('print-email').textContent = document.getElementById('summary-email').textContent;
            document.getElementById('print-phone').textContent = document.getElementById('summary-phone').textContent;
            document.getElementById('print-address').textContent = document.getElementById('summary-full-address').textContent;
            document.getElementById('print-residence-type').textContent = document.getElementById('summary-residence-type').textContent;
            document.getElementById('print-units').textContent = document.getElementById('summary-units').textContent;
            document.getElementById('print-blocks').textContent = document.getElementById('summary-blocks').textContent;
            document.getElementById('print-sections').textContent = document.getElementById('summary-sections').textContent;
            document.getElementById('print-file-number').textContent = document.getElementById('summary-file-number').textContent;
            document.getElementById('print-application-fee').textContent = document.getElementById('summary-application-fee').textContent;
            document.getElementById('print-processing-fee').textContent = document.getElementById('summary-processing-fee').textContent;
            document.getElementById('print-site-plan-fee').textContent = document.getElementById('summary-site-plan-fee').textContent;
            document.getElementById('print-total-fee').textContent = document.getElementById('summary-total-fee').textContent;
            document.getElementById('print-receipt-number').textContent = document.getElementById('summary-receipt-number').textContent;
            document.getElementById('print-payment-date').textContent = document.getElementById('summary-payment-date').textContent;
            
            // Copy documents
            const printDocsContainer = document.getElementById('print-documents');
            printDocsContainer.innerHTML = '';
            
            const uploadedDocs = document.getElementById('summary-documents').children;
            for (let i = 0; i < uploadedDocs.length; i++) {
              const docDiv = document.createElement('div');
              docDiv.style.marginBottom = '5px';
              
              const docStatus = uploadedDocs[i].querySelector('span:first-child').classList.contains('bg-green-500') ? '✓' : '✗';
              const docName = uploadedDocs[i].querySelector('span:last-child').textContent;
              
              docDiv.innerHTML = `<span style="display:inline-block; width:20px; text-align:center;">${docStatus}</span> ${docName}`;
              printDocsContainer.appendChild(docDiv);
            }
            
            // Open print dialog
            const printContent = document.getElementById('printTemplate').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
              <html>
                <head>
                  <title>Application Slip</title>
                  <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    @media print {
                      body { margin: 0; padding: 0; }
                    }
                  </style>
                </head>
                <body>${printContent}</body>
              </html>
            `);
            
            printWindow.document.close();
            setTimeout(() => {
              printWindow.print();
            }, 500);
          });
        }
      }
      
      // Button event to populate summary and navigate to step 3
      const nextStep2Button = document.getElementById('nextStep2');
      if (nextStep2Button) {
        nextStep2Button.addEventListener('click', function() {
          updateApplicationSummary();
        });
      }
      
      // Also update summary when moving from step 1 to step 2
      const nextStep1Button = document.getElementById('nextStep1');
      if (nextStep1Button) {
        nextStep1Button.addEventListener('click', function() {
          updateApplicationSummary();
        });
      }
      
      // Initialize print functionality
      initializePrintFunctionality();
    });
  </script>