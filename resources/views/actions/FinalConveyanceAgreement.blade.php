<div id="final-tab" class="tab-content">
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
        <div class="p-4 border-b">
            <h3 class="text-sm font-medium">Final Conveyance Agreement</h3>
            <p class="text-xs text-gray-500"></p>
        </div>
        <input type="hidden" id="application_id" value="{{ $application->id }}">
        <input type="hidden" name="fileno" value="{{ $application->fileno }}">
        <div class="container mx-auto p-4 bg-gray-100 rounded shadow" id="printable-content">
            <header class="text-center mb-6">
                <h1 class="text-xl font-bold mb-1">FINAL CONVEYANCE AGREEMENT</h1>
                <p class="text-sm">(For Sectional Titling and Decommissioning of Original Certificate of Occupancy)</p>
            </header>

            <main>
                <section class="mb-6">
                    <p class="mb-2">This Final Conveyance Agreement is made this [Insert Date], between:</p>
                    <ul class="list-none pl-6 mb-4">
                        <li class="mb-1">- The Original Owner:
                            @if (isset($application))
                                @if ($application->corporate_name)
                                    {{ $application->corporate_name }}
                                @elseif($application->multiple_owners_names)
                                    {{ is_array(json_decode($application->multiple_owners_names, true))
                                        ? implode(', ', json_decode($application->multiple_owners_names, true))
                                        : $application->multiple_owners_names }}
                                @else
                                    {{ trim($application->first_name . ' ' . $application->middle_name . ' ' . $application->surname) }}
                                @endif
                            @else
                                [Insert Name]
                            @endif
                        </li>
                        <li class="mb-1">- Property Location:
                            @if (isset($application))
                                {{ trim($application->property_house_no . ' ' . $application->property_plot_no . ' ' . $application->property_street_name . ', ' . $application->property_district) }}
                            @else
                                [Insert Property Address]
                            @endif
                        </li>
                        <li class="mb-1">- Decommissioned Certificate of Occupancy (CofO) Number:
                            @if (isset($application))
                                {{ $application->fileno ?? '[No CofO Number Available]' }}
                            @else
                                [Insert Original CofO No.]
                            @endif
                        </li>
                        <li class="mb-1">- Total Land Area:
                            @if (isset($application) && $application->plot_size)
                                {{ $application->plot_size }} Square Meters
                            @else
                                [Insert Size in Square Meters]
                            @endif
                        </li>
                    </ul>

                    <p class="mb-2">This document serves as an official agreement between the original titleholder of
                        the
                        property and the new sectional owners following the decommissioning of the original CofO
                        and the subsequent fragmentation of the property into individual sectional units.</p>

                    <p class="mb-2">This conveyance is made in accordance with the Kano State Ministry of Land and
                        Physical
                        Planning under the provisions of:</p>

                    <ul class="list-none pl-6 mb-4">
                        <li class="mb-1">• The Kano State Sectional and Systematic Land Titling and Registration Law,
                            2024.</li>
                        <li class="mb-1">• Relevant State Urban Development and Planning Laws regulating land
                            subdivision.</li>
                        <li class="mb-1">• National Land Tenure Policies on sectional ownership and property
                            registration.</li>
                    </ul>
                </section>

                <section class="mb-6">
                    <h2 class="text-base font-bold mb-2">PROPERTY DETAILS</h2>
                    <table class="w-full border-collapse mb-4">
                        <tbody>
                            <tr>
                                <td class="border border-gray-400 p-2 w-1/2">Original CofO No.</td>
                                <td class="border border-gray-400 p-2">
                                    @if (isset($application))
                                        {{ $application->fileno ?? '[No Data]' }}
                                    @else
                                        [Insert Value]
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-400 p-2">Plot Number</td>
                                <td class="border border-gray-400 p-2">
                                    @if (isset($application))
                                        {{ $application->property_plot_no ?? '[No Data]' }}
                                    @else
                                        [Insert Value]
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-400 p-2">Block Number</td>
                                <td class="border border-gray-400 p-2">
                                    @if (isset($application))
                                        {{ $application->property_house_no ?? '[No Data]' }}
                                    @else
                                        [Insert Value]
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-400 p-2">Approved Plan Number</td>
                                <td class="border border-gray-400 p-2">
                                    @if (isset($application))
                                        {{ $application->scheme_no ?? '[No Data]' }}
                                    @else
                                        [Insert Value]
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-400 p-2">Survey Plan No.</td>
                                <td class="border border-gray-400 p-2">
                                    @if (isset($application))
                                        {{ $application->scheme_no ?? '[No Data]' }}
                                    @else
                                        [Insert Value]
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-400 p-2">Surveyed By</td>
                                <td class="border border-gray-400 p-2">
                                    @if (isset($application))
                                        {{ $application->revenue_accountant ?? '[No Data]' }}
                                    @else
                                        [Insert Value]
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-400 p-2">Layout Name</td>
                                <td class="border border-gray-400 p-2">
                                    @if (isset($application))
                                        {{ $application->property_district ?? '[No Data]' }}
                                    @else
                                        [Insert Value]
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-400 p-2">District Name</td>
                                <td class="border border-gray-400 p-2">
                                    @if (isset($application))
                                        {{ $application->property_district ?? '[No Data]' }}
                                    @else
                                        [Insert Value]]
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="border border-gray-400 p-2">Local Government Area (LGA)</td>
                                <td class="border border-gray-400 p-2">
                                    @if (isset($application))
                                        {{ $application->property_lga ?? '[No Data]' }}
                                    @else
                                        [Insert Value]
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="mb-6">
                    <h2 class="text-base font-bold mb-2">TERMS & CONDITIONS</h2>
                    <ol class="list-decimal pl-6 mb-4">
                        <li class="mb-1"><span class="font-semibold">Decommissioning of the Original CofO:</span> The
                            original CofO for the entire property is officially nullified.</li>
                        <li class="mb-1"><span class="font-semibold">Issuance of New Certificates:</span> Each buyer
                            will receive a new CofO specific to their sectional unit.</li>
                        <li class="mb-1"><span class="font-semibold">Ownership Responsibilities:</span> Buyers agree
                            to abide by all land use regulations under Kano State Law.</li>
                        <li class="mb-1"><span class="font-semibold">Validity & Legal Standing:</span> This agreement
                            is legally binding.</li>
                        <li class="mb-1"><span class="font-semibold">Dispute Resolution:</span> Any disputes shall be
                            resolved under the applicable laws of Kano State.</li>
                    </ol>
                </section>

                <section class="mb-6">
                    <h2 class="text-base font-bold mb-2">SIGNATORIES & ENDORSEMENTS</h2>

                    <div class="mb-6">
                        <p class="font-semibold mb-1">Original Property Owner:</p>
                        <p class="mb-1">Name: ________________________________________</p>
                        <p class="mb-1">Signature: ____________________________________</p>
                        <p class="mb-1">Date: ________________________________________</p>
                    </div>

                    <div class="mb-6">
                        <p class="font-semibold mb-1">Witness (Legal Representative of the Owner):</p>
                        <p class="mb-1">Name: ________________________________________</p>
                        <p class="mb-1">Signature: ____________________________________</p>
                        <p class="mb-1">Date: ________________________________________</p>
                    </div>

                    <div class="mb-6">
                        <p class="font-semibold mb-1">Representative, Kano State Ministry of Land & Physical Planning:
                        </p>
                        <p class="mb-1">Name: ________________________________________</p>
                        <p class="mb-1">Signature: ____________________________________</p>
                        <p class="mb-1">Designation: __________________________________</p>
                        <p class="mb-1">Date: ________________________________________</p>
                    </div>
                </section>

                <section class="mb-6">
                    <h2 class="text-base font-bold mb-2">OFFICIAL STAMP & SEAL</h2>
                    <div class="border border-gray-400 p-8 text-center text-gray-400">[Insert Official Ministry Seal &
                        Stamp Here]</div>
                </section>
                
                <!-- Final Conveyance Records Section starts on a new page -->
                @if (isset($application) && $application->conveyance)
                    @php
                        $conveyanceData = json_decode($application->conveyance, true);
                    @endphp
                    
                    @if ((isset($conveyanceData['records']) && is_array($conveyanceData['records']) && count($conveyanceData['records']) > 0) || 
                         (isset($conveyanceData['buyerName']) && isset($conveyanceData['sectionNo'])))
                        <!-- Only add page break if there are records to display -->
                        <div class="page-break"></div>
                        
                        <div class="mt-4 p-4 bg-white shadow conveyance-records-section">
                            <h3 class="text-lg font-bold mb-2">BUYS LIST</h3>

                            @if (isset($conveyanceData['records']) && is_array($conveyanceData['records']))
                                <table class="w-full border-collapse mb-4">
                                    <thead>
                                        <tr>
                                            <th class="border border-gray-400 p-2 text-left">SN</th>
                                            <th class="border border-gray-400 p-2 text-left">BUYER NAME</th>
                                            <th class="border border-gray-400 p-2 text-left">UNIT NO.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($conveyanceData['records'] as $index => $record)
                                            <tr>
                                                <td class="border border-gray-400 p-2">{{ $index + 1 }}</td>
                                                <td class="border border-gray-400 p-2">{{ $record['buyerName'] ?? '' }}
                                                </td>
                                                <td class="border border-gray-400 p-2">{{ $record['sectionNo'] ?? '' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @elseif(isset($conveyanceData['buyerName']) && isset($conveyanceData['sectionNo']))
                                <!-- Fallback for the old single-record format -->
                                <p><strong>Buyer Name:</strong> {{ $conveyanceData['buyerName'] }}</p>
                                <p><strong>Section No:</strong> {{ $conveyanceData['sectionNo'] }}</p>
                            @endif
                        </div>
                    @else
                        <div class="mt-4 p-4 bg-white shadow">
                            <p>No buys list found.</p>
                        </div>
                    @endif
                @endif
            </main>
        </div>

        <hr class="my-4">

        <div class="flex justify-between items-center">
            <div class="flex gap-2">
                <a href="{{ route('sectionaltitling.primary') }}"
                    class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                    <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                    Back
                </a>

                <button id="print-conveyance"
                    class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-blue-600 text-white hover:bg-blue-700">
                    <i data-lucide="printer" class="w-3.5 h-3.5 mr-1.5"></i>
                    Print Agreement
                </button>

                <button
                    class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-sky-900 text-white hover:bg-sky-800">
                    <i data-lucide="folder-git-2" class="w-3.5 h-3.5 mr-1.5"></i>
                    EDMS
                </button>

                <button
                    class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-green-800">
                    <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add print styles at the end of your document -->
<style id="print-styles">
    @media print {
        body * {
            visibility: hidden;
        }

        #printable-content,
        #printable-content * {
            visibility: visible;
        }

        #printable-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background-color: white !important;
            margin: 0;
            padding: 10px;
            font-size: 10pt;
        }
        
        /* Header styling */
        #printable-content header {
            margin-bottom: 0.5rem !important;
        }
        
        #printable-content header h1 {
            font-size: 14pt !important;
            margin-bottom: 0 !important;
        }
        
        #printable-content header p {
            font-size: 8pt !important;
            margin-top: 0 !important;
        }
        
        /* Section & element spacing */
        #printable-content section {
            margin-bottom: 6pt !important;
        }
        
        #printable-content .mb-6 {
            margin-bottom: 0.4rem !important;
        }
        
        #printable-content .mb-4 {
            margin-bottom: 0.3rem !important;
        }
        
        #printable-content .mb-2 {
            margin-bottom: 0.15rem !important;
        }
        
        #printable-content .mb-1 {
            margin-bottom: 0.1rem !important;
        }
        
        /* Text sizing */
        #printable-content p, 
        #printable-content li {
            font-size: 9pt !important;
            margin-bottom: 0.1rem !important;
            line-height: 1.2 !important;
        }
        
        #printable-content h2 {
            font-size: 10pt !important;
            margin-top: 6pt !important;
            margin-bottom: 2pt !important;
        }
        
        /* Table styling */
        #printable-content table {
            margin-bottom: 0.3rem !important;
        }
        
        #printable-content table td,
        #printable-content table th {
            padding: 2px !important;
            font-size: 8pt !important;
        }
        
        /* Signature sections */
        #printable-content .p-8 {
            padding: 0.5rem !important;
        }

        .no-print,
        .no-print * {
            display: none !important;
        }
        
        /* Page break control - only break before content, not empty pages */
        @page {
            size: A4;
            margin: 0.3cm;
        }
        
        .page-break {
            page-break-before: always;
            page-break-after: auto;
            break-before: page;
            break-after: auto;
        }
        
        /* Control record section page breaks */
        .conveyance-records-section {
            page-break-before: auto; /* Let the page-break div handle this */
            break-before: auto;
        }
        
        /* Prevent orphaned headers */
        .conveyance-records-section h3 {
            page-break-after: avoid;
            break-after: avoid;
        }
        
        /* Table headers repeat on multi-page tables */
        .conveyance-records-section thead {
            display: table-header-group;
        }
        
        /* Try to keep rows together */
        .conveyance-records-section tr {
            page-break-inside: avoid;
            break-inside: avoid;
        }
    }
</style>

<script>
    // Add this to your existing DOMContentLoaded or in a separate script tag
    document.addEventListener('DOMContentLoaded', function() {
        const printButton = document.getElementById('print-conveyance');
        if (printButton) {
            printButton.addEventListener('click', function() {
                const printContent = document.getElementById('printable-content');
                const originalContents = document.body.innerHTML;

                // Open a new window for printing
                const printWindow = window.open('', '_blank');
                printWindow.document.write('<html><head><title>Final Conveyance Agreement</title>');
                printWindow.document.write('<style>');
                printWindow.document.write(`
/* Base styling */
body { 
    font-family: Arial, sans-serif; 
    margin: 5px; 
    padding: 0;
    font-size: 10pt; 
}

/* Table styling */
table { 
    border-collapse: collapse; 
    width: 100%; 
    margin-bottom: 0.3rem;
}

table, th, td { 
    border: 1px solid #ddd; 
}

td, th { 
    padding: 2px; 
    text-align: left; 
    font-size: 8pt;
    line-height: 1.2;
}

/* Headers */
h1 { 
    font-size: 14pt; 
    margin-top: 8px;
    margin-bottom: 0px;
}

h2 { 
    font-size: 10pt; 
    margin-top: 6px;
    margin-bottom: 2px;
}

h3 { 
    font-size: 9pt; 
    margin-top: 5px;
    margin-bottom: 2px;
}

/* Spacing */
.mb-1 { margin-bottom: 0.1rem; }
.mb-2 { margin-bottom: 0.15rem; }
.mb-4 { margin-bottom: 0.3rem; }
.mb-6 { margin-bottom: 0.4rem; }

/* Text styling */
.font-semibold { font-weight: 600; }
.font-bold { font-weight: 700; }
.text-center { text-align: center; }
.text-lg { font-size: 10pt; }
.text-xl { font-size: 11pt; }
.text-base { font-size: 9pt; }
.text-sm { font-size: 8pt; }

/* Container styling */
.border { border: 1px solid #e2e8f0; }
.p-4 { padding: 0.3rem; }
.p-8 { padding: 0.5rem; }
.pl-6 { padding-left: 0.5rem; }
.shadow { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
.bg-white { background-color: #ffffff; }
.bg-gray-100 { background-color: #f7fafc; }
.rounded { border-radius: 0.1rem; }

/* Header styling */
header { 
    margin-bottom: 0.5rem; 
    text-align: center;
}

/* List styling */
ul, ol {
    margin-top: 0.1rem;
    margin-bottom: 0.3rem;
    padding-left: 1rem;
}

/* Page breaking */
.page-break { 
    page-break-before: always;
    page-break-after: auto;
    break-before: page;
    break-after: auto;
}

/* Set page margins */
@page {
    size: A4;
    margin: 0.3cm;
}

/* Control record section - let page-break handle this instead */
.conveyance-records-section {
    page-break-before: auto;
    break-before: auto;
}

/* Table header settings */
thead { display: table-header-group; }
tr { page-break-inside: avoid; break-inside: avoid; }

/* Prevent orphaned headers */
h3 {
    page-break-after: avoid;
    break-after: avoid;
}

/* Print settings */
@media print {
    body { margin: 0; }
    .no-print { display: none !important; }
}

/* Text and paragraph settings */
p, li {
    font-size: 9pt;
    line-height: 1.2;
    margin-top: 0.1rem;
    margin-bottom: 0.1rem;
}
`);
                printWindow.document.write('</style>');
                printWindow.document.write('</head><body>');
                printWindow.document.write(printContent.innerHTML);
                printWindow.document.write('</body></html>');

                printWindow.document.close();
                printWindow.focus();

                // Print after resources are loaded
                printWindow.onload = function() {
                    printWindow.print();
                    printWindow.onafterprint = function() {
                        printWindow.close();
                    };
                };
            });
        }
    });
</script>
