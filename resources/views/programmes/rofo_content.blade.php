<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Land Grant/Conveyance Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="print-styles.css">
    <style>
        .checkbox {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 1px solid #000;
            margin-right: 8px;
            vertical-align: middle;
        }

        /* Print-specific styles */
@media print {
  @page {
    size: A4 portrait;
    margin: 1cm;
  }

  html,
  body {
    width: 210mm; /* A4 width */
    height: 297mm; /* A4 height */
    margin: 0;
    padding: 0;
  }

  body {
    background-color: white !important;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
    color-adjust: exact !important;
    color: black !important;
  }

  .no-print {
    display: none !important;
  }

  /* Ensure each page fits on A4 */
  #first-page,
  #second-page {
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    overflow: hidden;
    page-break-after: always;
    padding: 1cm !important;
    border: none !important;
  }

  /* Preserve colors in print */
  .border-green-500 {
    border-color: #10b981 !important;
  }

  .border-black {
    border-color: #000000 !important;
  }

  /* Ensure proper spacing */
  .mb-8 {
    margin-bottom: 1.5rem !important;
  }

  /* Fix table layout for printing */
  table {
    width: 100% !important;
    table-layout: fixed;
  }

  /* Ensure checkboxes print properly */
  .checkbox {
    border: 1px solid #000 !important;
    background-color: white !important;
  }

  /* Ensure text is black for better printing */
  p,
  span,
  div,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  li,
  td,
  th {
    color: black !important;
  }
}

/* Additional styles for the document */
.print-buttons {
  margin: 1rem 0;
  display: flex;
  justify-content: center;
  gap: 0.5rem;
}

/* Preview modal styles */
#preview-modal {
  position: fixed;
  inset: 0;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 50;
  display: flex;
  align-items: center;
  justify-content: center;
}

    </style>
</head>
<body class="bg-gray-100 p-4 md:p-8">

    <a href="javascript:history.back()" class="bg-blue-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back
    </a>
    <br> <br> <br> 
    <div class="max-w-4xl mx-auto bg-white shadow-md">
        <!-- First Page -->
       
        <div id="first-page" class="p-6 border border-gray-300 mb-8">
            <div class="text-xl font-bold mb-6">TO</div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Left Box -->
                <div class="border border-black p-4">
                    <div class="mb-2">
                        <label class="font-bold">NAME: <span class="font-bold">{{ $rofo->applicant_title ?? '' }}  {{ $rofo->first_name ?? '' }} {{ $rofo->middle_name ?? '' }} {{ $rofo->surname ?? 'N/A' }}</span></label>
                        <div class="border-b border-black mt-1 mb-4"></div>
                    </div>
                    
                    <div class="mb-2">
                        <label class="font-bold">ADDRESS: <span class="font-bold">{{ $rofo->address ?? '' }}</span></label>
                        <div class="border-b border-black mt-1 mb-4"></div>
                    </div>
                    
                    <div class="border-b border-black mb-4"></div>
                    
                    <div class="border-b border-black"></div>
                </div>
                
                <!-- Right Box -->
                <div class="border border-black p-4">
                    <div class="mb-2">
                        <label class="font-bold">ROFO NO.</label>
                        <span class="ml-2 font-bold">{{ $rofoData->rofo_no ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="mb-2">
                        <label class="font-bold">SHOP/HOUSE NO.</label>
                        <span class="ml-2 border-b  font-bold">{{ $rofoData->shop_house_no ?? $rofo->property_house_no ?? 'N/A' }}&nbsp;</span>
                    </div>
                    
                    <div class="mb-2">
                        <label class="font-bold">FLOOR NO.</label>
                        <span class="ml-2 border-b     font-bold">{{ $rofoData->floor_no ?? $rofo->floor_number ?? 'N/A' }}&nbsp;</span>
                    </div>
                    
                    <div class="mb-2">
                        <label class="font-bold">LOCATION.</label>
                        <span class="ml-2 border-b   font-bold">{{ $rofoData->location ?? 'N/A' }}&nbsp;</span>
                    </div>
                </div>
            </div>
            
            <!-- Terms of Offer Section -->
            <div class="border border-black p-4 mb-8">
                <h2 class="text-center text-xl font-bold mb-4">TERMS OF OFFER OF GRANT/CONVEYANCE OF APPROVAL</h2>
                
                <p class="mb-4">Reference to your application dated <span class="font-bold">{{ isset($rofoData->application_date) ? \Carbon\Carbon::parse($rofoData->application_date)->format('d/m/Y') : 'N/A' }}</span> I am directed to inform you that, The Governor of Kano State has approved the Grant of a Right of occupancy to you over a shop/plot No <span class="font-bold">{{ $rofoData->plot_no ?? $rofo->property_plot_no ?? 'N/A' }}</span> Block No <span class="font-bold">{{ $rofoData->block_no ?? $rofo->block_number ?? 'N/A' }}</span> Floor No <span class="font-bold">{{ $rofoData->floor_no ?? $rofo->floor_number ?? 'N/A' }}</span> Situated at <span class="font-bold">{{ $rofoData->location ?? 'N/A' }}</span> as per plan No <span class="font-bold">{{ $rofoData->plan_no ?? 'N/A' }}</span> on the following conditions.</p>
                
                <ol class="list-decimal pl-6 mb-4 space-y-2">
                    <li>Payment of
                        <ol class="list-[lower-latin] pl-6 space-y-2">
                            <li>Ground rent ₦<span class="font-bold">{{ number_format($rofoData->ground_rent ?? 0, 2) }}</span></li>
                            <li>Development Charges <span class="font-bold">{{ number_format($rofoData->development_charges ?? 0, 2) }}</span> (payable only once)</li>
                            <li>Survey and processing fees <span class="font-bold">{{ number_format($rofoData->survey_processing_fees ?? 0, 2) }}</span></li>
                        </ol>
                    </li>
                    
                    <li>
                        <ol class="list-[lower-latin] pl-6 space-y-2">
                            <li>Term <span class="font-bold">{{ $rofoData->term_years ?? 40 }}</span> years</li>
                            <li>Purpose <span class="font-bold">{{ $rofoData->purpose ?? $rofo->land_use ?? 'N/A' }}</span></li>
                            <li>Value of improvements thereon <span class="font-bold">{{ $rofoData->improvement_value ?? 'N/A' }}</span> Within <span class="font-bold">{{ $rofoData->improvement_time_limit ?? 2 }}</span> years</li>
                        </ol>
                    </li>
                    
                    <li>Not to alienate the Right of Occupancy in part or whole without the written consent of the Governor</li>
                    
                    <li>To be responsible for the development, maintenance and general beautifications of the frontage of the subject property</li>
                    
                    <li>Not to erect or permit to be erected on the subject land any building or development except in accordance with plans and specifications approved by the state Planning Authority in the case of urban areas or the ministry of Land and Physical Planning the case of rural areas.</li>
                    
                    <li>To Complete Development on Land Within <span class="font-bold">{{ $rofoData->improvement_time_limit ?? 2 }}</span> Years</li>
                    
                    <li>To become joint owner of the common property of the sectional Title land and actively participate in all quotas that benefit or burden sections</li>
                    
                    <li>To exclusively use certain parts and share undivided sections of the common property e.g. Garage, Garden, Parking space, Storeroom among others.</li>
                    
                    <li>This letter of Grant must be returned immediately duly accepted with the required fees to enable production of C OF O, otherwise the offer lapses.</li>
                </ol>
                
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div>
                        <div class="border-b border-black mb-2"></div>
                        <div class="font-bold">{{ $rofoData->commissioner_name ?? 'HONOURABLE COMMISIONER' }}</div>
                    </div>
                    
                    <div>
                        <div class="border-b border-black mb-2"></div>
                        <div class="font-bold">{{ \Carbon\Carbon::parse($rofoData->signed_date ?? now())->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Second Page -->
        <div id="second-page" class="p-6 border-4 border-green-500 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Left Box -->
                <div class="border-2 border-green-500 p-4 rounded-tr-3xl rounded-bl-3xl">
                    <p class="font-bold">The Honorable Commissioner</p>
                    <p class="font-bold">Ministry of Land and Physical Planning</p>
                </div>
                
                <!-- Right Box -->
                <div class="border border-black p-4">
                    <div class="border-b border-black mb-4"></div>
                    <div class="border-b border-black mb-4"></div>
                    <div class="flex">
                        <span class="font-bold">Date</span>
                        <div class="border-b border-black flex-grow ml-2"></div>
                    </div>
                </div>
            </div>
            
            <!-- Acceptance Letter Section -->
            <div class="mb-8">
                <h2 class="text-center text-xl font-bold mb-4">ACCEPTANCE LETTER</h2>
                <p class="text-center mb-6">Reference to the offer of Grant, I hereby accept the terms and condition of the grant of right of occupancy as conveyed to me by your overleaf quoted letter.</p>
                
                <!-- Fee Table -->
                <div class="border border-black mb-6">
                    <table class="w-full border-collapse">
                        <tr>
                            <th class="border border-black p-2 text-left">Land Use</th>
                            <th class="border border-black p-2 text-left">Survey / Processing Fees</th>
                            <th class="border border-black p-2 text-left">Dev. Charges ₦</th>
                        </tr>
                        <tr>
                            <td class="border border-black p-2">
                                <p class="font-bold">a.Residential Fees</p>
                                <p class="pl-4">i.Processing Fee</p>
                                <p class="font-bold">b.Survey Fees</p>
                                <p class="pl-4">i.Block of Flats</p>
                                <p class="pl-4">ii.Appartment</p>
                                <p class="font-bold">c.Assignment Fees</p>
                                <p class="font-bold">d.Bill Balance</p>
                                <p class="font-bold">e.Commercial Fees</p>
                                <p class="pl-4">i.Processing Fee</p>
                                <p class="pl-4">ii.Survey Fees</p>
                                <p class="pl-4">iii.Assignment Fees</p>
                                <p class="pl-4">iv.Bill Balance</p>
                            </td>
                            <td class="border border-black p-2">
                                <p>&nbsp;</p>
                                <p>₦ 20,000.00K</p>
                                <p>&nbsp;</p>
                                <p>₦ 50,000.00K</p>
                                <p>₦ 70,000.00K</p>
                                <p>₦ 50,000.00</p>
                                <p>₦ 30,525.00K</p>
                                <p>&nbsp;</p>
                                <p>₦ 50,000.00K</p>
                                <p>₦ 100,000.00K</p>
                                <p>₦ 100,000.00K</p>
                                <p>₦ 30,525.00K</p>
                            </td>
                            <td class="border border-black p-2">
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2">One year Ground Rent</td>
                            <td class="border border-black p-2">₦ <span class="font-bold">{{ number_format($rofoData->ground_rent ?? 0, 2) }}</span></td>
                            <td class="border border-black p-2">₦ <span class="font-bold">{{ number_format($rofoData->ground_rent ?? 0, 2) }}</span></td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2" colspan="3">
                                <p>TOTAL ₦ <span class="font-bold">{{ number_format(($rofoData->ground_rent ?? 0) + ($rofoData->development_charges ?? 0) + ($rofoData->survey_processing_fees ?? 0), 2) }}</span></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <!-- Checkboxes -->
                <div class="mb-6 space-y-4">
                    <div class="flex items-start">
                        <div class="checkbox border-2 border-green-500"></div>
                        <p>I require the Director Survey to carry out the land survey for me</p>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="checkbox border-2 border-green-500"></div>
                        <p>I require a licensed Surveyor to carry out the land survey for me</p>
                    </div>
                </div>
                
                <!-- Note Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border border-black p-2">
                        <p class="font-bold">*NOTE</p>
                        <p>APPLICANT TO RETAIN ORIGINAL AND RETURN 2</p>
                        <p>COPIES AFTER SIGNING HIS/HER ACCEPTANCE OF THE</p>
                    </div>
                    
                    <div class="border border-black p-2">
                        <div class="border-b border-black mt-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="print-buttons no-print flex gap-2 justify-center my-4">
        <button onclick="printROFO()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Print ROFO
        </button>
    </div>
    
    <!-- Hidden iframe for printing purposes -->
    <iframe id="print-frame" style="display:none;"></iframe>
    
    <script>
        function printROFO() {
            // Get the iframe
            const iframe = document.getElementById('print-frame');
            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            
            // Get our content
            const firstPage = document.getElementById('first-page').innerHTML;
            const secondPage = document.getElementById('second-page').innerHTML;
            
            // Write the custom print-only HTML to the iframe with simplified, more direct styling
            iframeDoc.open();
            iframeDoc.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>ROFO Document</title>
                    <style>
                        @page { 
                            size: A4 portrait !important; 
                            margin: 1cm !important; 
                        }
                        
                        html, body { 
                            width: 210mm !important;
                            font-family: Arial, sans-serif !important; 
                            margin: 0 !important; 
                            padding: 0 !important;
                            color: black !important;
                        }
                        
                        * {
                            color: black !important;
                            box-sizing: border-box !important;
                        }
                        
                        #page1 {
                            padding: 1cm !important;
                            page-break-after: always !important;
                        }
                        
                        #page2 {
                            padding: 0.7cm !important;
                            font-size: 0.95em !important;
                        }
                        
                        .grid {
                            display: grid !important;
                            grid-template-columns: 1fr 1fr !important;
                            gap: 0.8rem !important;
                        }
                        
                        .border, .border-black {
                            border: 1px solid black !important;
                        }
                        
                        .border-green-500, .border-4 {
                            border: 2px solid #10B981 !important;
                        }
                        
                        .border-b {
                            border-bottom: 1px solid black !important;
                        }
                        
                        .rounded-tr-3xl {
                            border-top-right-radius: 1.5rem !important;
                        }
                        
                        .rounded-bl-3xl {
                            border-bottom-left-radius: 1.5rem !important;
                        }
                        
                        .mb-2 { margin-bottom: 0.5rem !important; }
                        .mb-4 { margin-bottom: 1rem !important; }
                        .mb-6 { margin-bottom: 1.5rem !important; }
                        .mb-8 { margin-bottom: 2rem !important; }
                        
                        .p-2 { padding: 0.5rem !important; }
                        .p-4 { padding: 1rem !important; }
                        .p-6 { padding: 1.5rem !important; }
                        
                        .text-center { text-align: center !important; }
                        .font-bold { font-weight: bold !important; }
                        
                        table {
                            width: 100% !important;
                            border-collapse: collapse !important;
                            margin-bottom: 1rem !important;
                        }
                        
                        table, th, td {
                            border: 1px solid black !important;
                        }
                        
                        th, td {
                            padding: 0.4rem !important;
                            text-align: left !important;
                        }
                        
                        .checkbox {
                            display: inline-block !important;
                            width: 14px !important;
                            height: 14px !important;
                            border: 1px solid black !important;
                            margin-right: 6px !important;
                            vertical-align: middle !important;
                        }
                        
                        ol {
                            margin-left: 1.5rem !important;
                            padding-left: 0 !important;
                        }
                        
                        li {
                            margin-bottom: 0.5rem !important;
                        }
                        
                        /* Fixed positioning to ensure proper layout */
                        #page2 p {
                            margin-top: 0.2rem !important;
                            margin-bottom: 0.2rem !important;
                        }
                        
                        /* Reduce font-size further for table content on second page */
                        #page2 table {
                            font-size: 0.9em !important;
                        }
                        
                        #page2 table td p {
                            margin: 1px 0 !important;
                            line-height: 1.1 !important;
                        }
                    </style>
                </head>
                <body>
                    <div id="page1">${firstPage}</div>
                    <div id="page2">${secondPage}</div>
                </body>
                </html>
            `);
            iframeDoc.close();
            
            // Increase timeout to ensure styles are loaded
            setTimeout(function() {
                try {
                    // Focus and print
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();
                } catch (e) {
                    console.error("Printing failed:", e);
                    alert("Printing failed. Please try again.");
                }
            }, 1000); // Increased timeout to 1 second
        }
    </script>
</body>
</html>
