<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Occupancy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Certificate container styling */
        .certificate-container {
            /* background-image: url('{{ asset('storage/upload/cofo/cofo.jpeg') }}'); */
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            width: 21cm; /* A4 width */
            height: 29.7cm; /* A4 height */
            margin: 0 auto;
            padding: 5.5cm 2.5cm 3cm 2.5cm; /* Increased top padding to move content down */
            box-sizing: border-box;
        }

        /* Content wrapper to ensure proper positioning */
        .certificate-content {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        
        /* Title header styling with better positioning */
        .certificate-header {
            margin-top: 1.5cm; /* Add extra space at the top to push down the title */
            text-align: center;
            margin-bottom: 1cm;
        }
        
        @media print {
            body * {
                visibility: hidden;
            }
            
            .certificate-container,
            .certificate-container * {
                visibility: visible;
            }
            
            .certificate-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 21cm;
                height: 29.7cm;
                margin: 0;
                padding: 3cm 2.5cm;
                box-shadow: none !important;
                page-break-inside: avoid;
            }
            
            @page {
                size: A4;
                margin: 0;
            }
            
            /* Optimize spacing for printing */
            .mb-6 {
                margin-bottom: 0.5rem !important;
            }
            
            .mb-2 {
                margin-bottom: 0.1rem !important;
            }
            
            .space-y-2 > * + * {
                margin-top: 0.1rem !important;
            }
            
            .mt-10 {
                margin-top: 0.5rem !important;
            }
            
            ol.list-decimal {
                padding-left: 1rem !important;
                margin-top: 0.1rem !important;
                margin-bottom: 0.1rem !important;
            }
            
            h1 {
                font-size: 1.2rem !important;
                margin-bottom: 0.2rem !important;
            }
            
            h2 {
                font-size: 1.1rem !important;
                margin-bottom: 0.2rem !important;
            }
            
            h3 {
                font-size: 1rem !important;
                margin-bottom: 0.2rem !important;
            }
            
            .certificate-metadata {
                display: none !important;
            }
        }
        
        .highlight {
            text-transform: uppercase;
            font-weight: bold;
        }
        
        /* Print button styles */
        .print-button:hover {
            background-color: #1e429f;
        }

        /* Font size adjustments for better fit */
        .certificate-content {
            font-size: 0.9rem;
        }
        
        .certificate-content h1 {
            font-size: 1.4rem;
        }
        
        .certificate-content h2 {
            font-size: 1.2rem;
        }
        
        .certificate-content h3 {
            font-size: 1rem;
        }
        
        /* List styles to ensure proper indentation */
        .certificate-content ol.list-decimal {
            padding-left: 1.5rem;
        }
        
        /* Ensure proper spacing between sections */
        .content-section {
            margin-bottom: 1rem;
        }
        
        /* Passport photo styling */
        .passport-photo {
            position: absolute;
            top: -0.5cm; /* Moved higher up from 0.1cm */
            right: 0;
            width: 100px;
            height: 100px;
            border: 1px solid #000;
            overflow: hidden;
        }
        
        .passport-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-gray-100 p-4 md:p-8">
    <div class="certificate-metadata mb-4 bg-white p-4 rounded-md shadow-sm">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            <div class="md:col-span-3 mb-2">
            <a href="javascript:history.back()" class="bg-blue-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
            </div>
        </div>
    </div>

@php
    // Get the unit owner information from subapplications where fileno matches
    $unit_owner = DB::connection('sqlsrv')->table('subapplications')
        ->where('fileno', $cofo->file_no)
        ->first();
    
    // If no unit owner is found, set passport to default
    if (!$unit_owner) {
        $unit_owner = (object)['passport' => 'default-passport.jpg'];
    }
@endphp

    <div class="max-w-4xl mx-auto certificate-container">
        <div class="certificate-content">
            <!-- Header - Updated with new certificate-header class -->
            <div class="certificate-header content-section relative">
                <!-- Passport Photo -->
                <div class="passport-photo">
                    <img src="{{ asset('storage/app/public/' . ($unit_owner->passport ?? 'default-passport.jpg')) }}" alt="Passport Photo">
                   
                </div> 
           
                <h1 class="text-xl font-bold">CERTIFICATE OF OCCUPANCY</h1>
                <h2 class="text-lg font-bold">FOR SECTIONAL TITLE</h2>
                <p>ST File No: <span class="highlight">{{ $cofo->file_no ?? 'N/A' }}</span></p>
                <p class="highlight">{{ $cofo->land_use ?? 'N/A' }} - PLOT NO :{{ $cofo->plot_no ?? 'N/A' }}, B L O C K N O :{{ $cofo->block_no ?? 'N/A' }}, F L O O R N O :{{ $cofo->floor_no ?? 'N/A' }}, F L A T N O :{{ $cofo->flat_no ?? 'N/A' }}</p>
            </div>
            
            <!-- Main Content -->
            <div class="mb-6 content-section">
                <p class="mb-2">This is to certify that: <span class="highlight">{{ $cofo->holder_name ?? 'N/A' }}</span></p>
                <p class="mb-2">Whose address is: <span class="highlight">{{ $cofo->holder_address ?? 'N/A' }}</span></p>
                <p class="mb-2">(hereinafter called the "holder," which terms shall include any person/persons in title)</p>
                <p class="mb-2">is hereby granted a right of occupancy for, and over the land described in the schedule, and more particularly in the plan printed hereto for a remaining term of <span class="highlight">{{ $cofo->remaining_term ?? '40' }} YEARS</span> commencing from the <span class="highlight">{{ isset($cofo->start_date) ? date('jS F, Y', strtotime($cofo->start_date)) : 'DATE OF COMMENCEMENT' }}</span> according to the true intent and meaning of the Land Use Act No. 6 of 1978 and subject to the provisions thereof and to the following special terms and conditions:</p>
            </div>
            
            <!-- Definition Section -->
            <div class="mb-6 content-section">
                <h3 class="text-center font-bold mb-2">DEFINITION OF SECTIONAL TITLING</h3>
                <ol class="list-decimal pl-6 space-y-1">
                    <li>Exclusive Ownership of Units: The holder is granted exclusive ownership rights to their designated unit ("section") as outlined in the attached sectional title deed plan.</li>
                    <li>Shared Ownership of Common Areas: The holder shares ownership of common/shared areas, including but not limited to hallways, gardens, parking lots, and other facilities, with other unit owners.</li>
                    <li>Participation Quota: Each unit owner's financial responsibility for the maintenance and upkeep of shared property is determined by their "participation quota," calculated based on the size of their unit relative to the total building area.</li>
                    <li>Body Corporate: The management and maintenance of shared/common areas shall be governed by a "Body Corporate," comprising all unit owners, which is responsible for ensuring compliance with statutory obligations and maintaining the property in good condition.</li>
                    <li>Boundaries and Designations: The boundaries of each unit and the designation of common/shared areas are explicitly detailed in the sectional title deed plan attached hereto.</li>
                </ol>
            </div>
            
            <!-- Special Terms Section -->
            <div class="mb-6 content-section">
                <h3 class="text-center font-bold mb-2">SPECIAL TERMS AND CONDITIONS UNDER THE LAND USE ACT NO. 6 OF 1978</h3>
                <ol class="list-decimal pl-6 space-y-1">
                    <li>Ground Rent: Pay revised ground rent annually or as prescribed by the Governor.</li>
                    <li>Rates and Impositions: Pay all rates, utilities, and impositions charged on the land or buildings.</li>
                    <li>Survey Fees: Pay all survey fees and charges due for the preparation, registration, and issuance of this certificate.</li>
                    <li>Development Obligations: Erect and complete approved buildings within two years from the commencement of occupancy.</li>
                    <li>Maintenance: Maintain all buildings and surroundings in good repair and sanitary condition.</li>
                    <li>Surrender of Property: Deliver the land and buildings in good condition upon expiration of the term.</li>
                    <li>Construction Restrictions: Do not erect or alter buildings without prior approval.</li>
                    <li>Inspection Rights: Permit the Governor or authorized officers to inspect the property at reasonable hours.</li>
                    <li>Alienation Restrictions: Do not sell, mortgage, or transfer occupancy rights without the Governor's consent.</li>
                    <li>Land Use: Use the land only for <span class="highlight">{{ $cofo->land_use ?? 'SPECIFIED' }}</span> purposes.</li>
                    <li>Compliance: Adhere to the Land Use Act and all rules and regulations laid down by Kano State Government.</li>
                    <li>Rent Revision: Ground rent may be revised every five years; notice will be provided one month in advance.</li>
                    <li>Breach of Terms: Failure to comply with terms allows the Governor to reclaim the property without prejudice to legal remedies.</li>
                </ol>
            </div>
            
            <!-- Signature Section -->
            <div class="mt-8 content-section">
                <p class="mb-1 whitespace-nowrap font-bold">DATED This______________________________________ day of__________________________________, 20__________________________________________________________</p>
               
                <p class="text-center mb-2">Given under my hand the day and year above written</p>  
                <p class="text-center mb-2">above written</p>
                
                <div class="flex justify-end mt-20">
                    <div class="text-right">
                        <div class="border-t border-black w-50 mb-2"></div>
                        <p mb-1>{{ $cofo->signed_by ?? 'Alh. Abba Kabir Yusuf' }}</p>
                        <p>{{ $cofo->signed_title ?? 'His Excellency Executive Governor' }}</p>
                        <p>Kano State, Nigeria</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <button class="no-print bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 mx-auto block" onclick="printCertificate()">Print Certificate</button>
    </div>
    <script>
        function printCertificate() {
            // Focus on the main content for better printing
            document.querySelector('.certificate-container').focus();
            // Print the document
            window.print();
        }
        
        // Initialize page when loaded
        window.onload = function() {
            // Adjust font size dynamically if content is too large
            const container = document.querySelector('.certificate-content');
            const containerHeight = document.querySelector('.certificate-container').clientHeight;
            const contentHeight = container.scrollHeight;
            
            if (contentHeight > containerHeight - 100) { // Leave some margin
                const scaleFactor = Math.min(0.9, (containerHeight - 100) / contentHeight);
                container.style.fontSize = (parseFloat(getComputedStyle(container).fontSize) * scaleFactor) + 'px';
            }
        };
    </script>
</body>
</html>