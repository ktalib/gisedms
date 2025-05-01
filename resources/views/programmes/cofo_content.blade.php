<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Occupancy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            /* Hide everything by default */
            body * {
                visibility: hidden;
            }
            
            /* Show only the certificate */
            .certificate-container,
            .certificate-container * {
                visibility: visible;
            }
            
            /* Position the certificate at the top of the page */
            .certificate-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                padding: 1cm;
                margin: 0;
                box-shadow: none !important;
                background-color: white !important;
                page-break-inside: avoid;
                font-size: 0.9rem;
            }
            
            /* Ensure content fits on one page */
            @page {
                size: A4;
                margin: 0;
            }
            
            /* Reduce spacing to fit on one page */
            .mb-6 {
                margin-bottom: 0.75rem !important;
            }
            
            .space-y-2 > * + * {
                margin-top: 0.25rem !important;
            }
            
            .mt-10 {
                margin-top: 1rem !important;
            }
            
            /* Further optimization for single-page printing */
            .certificate-container {
                font-size: 0.8rem !important;
                padding: 0.5cm !important;
                line-height: 1.2 !important;
            }
            
            /* Drastically reduce margins and spacing */
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
            
            /* Make lists more compact */
            ol.list-decimal {
                padding-left: 1rem !important;
                margin-top: 0.1rem !important;
                margin-bottom: 0.1rem !important;
            }
            
            /* Reduce heading sizes */
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
            
            /* Compress signature section */
            .mt-10 p {
                margin-bottom: 0.1rem !important;
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
    </style>
</head>
<body class="bg-gray-100 p-4 md:p-8">
    <div class="certificate-metadata mb-4 bg-white p-4 rounded-md shadow-sm">
        <h2 class="text-lg font-bold mb-2">Certificate Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-500">Certificate Number</p>
                <p class="font-semibold">{{ $cofo->certificate_number ?? 'Not Generated' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">File Number</p>
                <p class="font-semibold">{{ $cofo->file_no ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Issue Date</p>
                <p class="font-semibold">{{ isset($cofo->issued_date) ? date('d M, Y', strtotime($cofo->issued_date)) : 'Not Issued' }}</p>
            </div>
        </div>
    </div>
    
    <div class="max-w-4xl mx-auto bg-white shadow-md p-8 certificate-container">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-xl font-bold">CERTIFICATE OF OCCUPANCY</h1>
            <h2 class="text-lg font-bold">FOR SECTIONAL TITLE</h2>
            <p>ST File No: <span class="highlight">{{ $cofo->file_no ?? 'N/A' }}</span></p>
            <p class="highlight">{{ $cofo->land_use ?? 'N/A' }} - P L O T N O :{{ $cofo->plot_no ?? 'N/A' }}, B L O C K N O :{{ $cofo->block_no ?? 'N/A' }}, F L O O R N O :{{ $cofo->floor_no ?? 'N/A' }}, F L A T N O :{{ $cofo->flat_no ?? 'N/A' }}</p>
        </div>
        
        <!-- Main Content -->
        <div class="mb-6">
            <p class="mb-2">This is to certify that: <span class="highlight">{{ $cofo->holder_name ?? 'N/A' }}</span></p>
            <p class="mb-2">Whose address is: <span class="highlight">{{ $cofo->holder_address ?? 'N/A' }}</span></p>
            <p class="mb-2">(hereinafter called the "holder," which terms shall include any person/persons in title)</p>
            <p class="mb-2">is hereby granted a right of occupancy for, and over the land described in the schedule, and more particularly in the plan printed hereto for a remaining term of <span class="highlight">{{ $cofo->remaining_term ?? '40' }} YEARS</span> commencing from the <span class="highlight">{{ isset($cofo->start_date) ? date('jS F, Y', strtotime($cofo->start_date)) : 'DATE OF COMMENCEMENT' }}</span> according to the true intent and meaning of the Land Use Act No. 6 of 1978 and subject to the provisions thereof and to the following special terms and conditions:</p>
        </div>
        
        <!-- Definition Section -->
        <div class="mb-6">
            <h3 class="text-center font-bold mb-2">DEFINITION OF SECTIONAL TITLING</h3>
            <ol class="list-decimal pl-6 space-y-2">
                <li>Exclusive Ownership of Units: The holder is granted exclusive ownership rights to their designated unit ("section") as outlined in the attached sectional title deed plan.</li>
                <li>Shared Ownership of Common Areas: The holder shares ownership of common/shared areas, including but not limited to hallways, gardens, parking lots, and other facilities, with other unit owners.</li>
                <li>Participation Quota: Each unit owner's financial responsibility for the maintenance and upkeep of shared property is determined by their "participation quota," calculated based on the size of their unit relative to the total building area.</li>
                <li>Body Corporate: The management and maintenance of shared/common areas shall be governed by a "Body Corporate," comprising all unit owners, which is responsible for ensuring compliance with statutory obligations and maintaining the property in good condition.</li>
                <li>Boundaries and Designations: The boundaries of each unit and the designation of common/shared areas are explicitly detailed in the sectional title deed plan attached hereto.</li>
            </ol>
        </div>
        
        <!-- Special Terms Section -->
        <div class="mb-6">
            <h3 class="text-center font-bold mb-2">SPECIAL TERMS AND CONDITIONS UNDER THE LAND USE ACT NO. 6 OF 1978</h3>
            <ol class="list-decimal pl-6 space-y-2">
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
        <div class="mt-10">
            <p class="mb-2">DATED This_________________________________ day of__________________________,</p>
            <p class="mb-6 text-center">20____________.</p>
            <p class="text-center mb-2">Given under my hand the day and year above written</p>
            <p class="text-center font-bold">{{ $cofo->signed_by ?? 'Alh. Abduljabbar Mohammed Umar' }}</p>
            <p class="text-center">{{ $cofo->signed_title ?? 'Honorable Commissioner of Land and Physical Planning' }}</p>
            <p class="text-center">Kano State, Nigeria</p>
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
            const container = document.querySelector('.certificate-container');
            const originalHeight = container.scrollHeight;
            const viewportHeight = window.innerHeight;
            
            if (originalHeight > viewportHeight * 0.9) {
                // Content might be too large, reduce font size slightly
                container.style.fontSize = '0.85rem';
            }
        };
    </script>
</body>
</html>