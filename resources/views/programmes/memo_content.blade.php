<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
            /* Regular styling */
            .highlight {
                font-weight: bold;
                background-color: transparent;
            }
            
            /* Print-specific styling */
        @media print {
            /* Set up for A4 page */
            @page {
                size: A4;
                margin: 10mm; /* Standard margin for A4 */
            }
            
            /* Hide everything by default */
            body * {
                visibility: hidden;
            }
            
            /* Only show the memo content */
            .memo-content, .memo-content * {
                visibility: visible;
            }
            
            /* Position the memo for proper A4 printing */
            .memo-content {
                position: absolute;
                left: 0;
                top: 0;
                width: 210mm;
                max-height: 297mm;
                background-color: white;
                padding: 0;
                margin: 0;
                font-size: 9pt; /* Even smaller font for better fit */
                line-height: 1.1; /* Even tighter line spacing */
            }
            
            /* Adjust spacing to fit on one page */
            .memo-content .space-y-4 {
                margin-top: 0.2rem;
                margin-bottom: 0.2rem;
            }
            
            .memo-content .my-6 {
                margin-top: 0.2rem;
                margin-bottom: 0.2rem;
            }
            
            .memo-content .mt-8 {
                margin-top: 0.3rem;
            }
            
            .memo-content .mb-6 {
                margin-bottom: 0.2rem;
            }
            
            /* Reduce list spacing */
            .memo-content ol {
                margin-top: 0;
                margin-bottom: 0;
                padding-left: 1rem; /* Adjust padding for better alignment */
            }
            
            .memo-content .space-y-2 > * {
                margin-top: 0;
                margin-bottom: 0;
            }
            
            /* Reduce gap in grid */
            .memo-content .gap-4 {
                gap: 0.5rem; /* Reduce grid gap further */
            }
            
            .memo-content .text-center {
                margin-top: 0;
                margin-bottom: 0;
            }
            
            /* Ensure highlight color prints */
            .highlight {
                font-weight: bold !important;
                background-color: transparent !important;
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            
            /* Hide the print button when printing */
            #printButton {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center p-4 md:p-8">
    

        <br>
        <br>
        <br>
        <div class="text-center mb-6">
            <h1 class="font-bold text-lg md:text-xl underline">PERMANENT SECRETARY</h1>
        </div>

        <div class="space-y-4 text-sm md:text-base">
            <p>
                Kindly find  <span class="highlight">page  {{ $landAdmin->page_no ?? 'N/A' }}</span> is an application for sectional titling in respect of a property (plaza) covered by Certificate of Occupancy No. <span class="highlight">{{ $memo->fileno ?? 'N/A' }}</span> situated at  {{ $memo->property_street_name ?? '' }} {{ $memo->property_district ? ', '.$memo->property_district : '' }}   {{ $memo->property_state ? ', '.$memo->property_state : '' }} in the name of <span class="highlight">{{ $memo->applicant_title ?? '' }} {{ $memo->first_name ?? '' }} {{ $memo->middle_name ?? '' }} {{ $memo->surname ?? 'N/A' }}</span>
            </p>
            <p>
                As well as change of name to various shop owners as per attached on the application.
            </p>
    
            <p>
                The application was referred to Physical Planning Department for planning, engineering as well as architectural views. Subsequently, the planners at  <span class="highlight">page  {{ $landAdmin->page_no ?? 'N/A' }}</span> recommended the application, because the application is feasible, and the shops meet the minimum requirements for commercial titles. Moreover, the proposal is accessible and conforms with the existing commercial development in the area.
            </p>
    
            <p>
                However, the recommendation is based on the recommended site plan at <span class="highlight">page {{ $landAdmin->page_no ?? 'N/A' }}</span> and architectural design at <span class="highlight">page  {{ $landAdmin->page_no ?? 'N/A' }}</span> and back cover with the following measurements:
            </p>
    
            <div class="my-6"></div>
    
            <p>
                Meanwhile, the title was granted for commercial purposes for a term of <span class="highlight">{{ $totalYears ?? '40' }}</span> years commencing from <span class="highlight">{{ $memo->approval_date ? date('d/m/Y', strtotime($memo->approval_date)) : 'N/A/N/A/2025' }}</span> and has a residual term of <span class="highlight">{{ $residualYears ?? '20' }}</span> years to expire.
            </p>
    
            <p>
                In view of the above, you may kindly wish to recommend the following for approval of the Honorable Commissioner.
            </p>
    
            <ol class="list-none space-y-2 pl-4 md:pl-8">
                <li>
                    a) Consider and approve the application for Sectional Titling over plot <span class="highlight">{{ $memo->property_plot_no ?? 'N/A' }}</span> situated at <span class="highlight">{{ $memo->property_street_name ?? '' }} {{ $memo->property_district ? ', '.$memo->property_district : '' }}  </span> covered by Certificate of Occupancy No. <span class="highlight">{{ $memo->fileno ?? 'N/A' }}</span> in Favor of <span class="highlight">{{ $memo->applicant_title ?? '' }}  {{ $memo->first_name ?? '' }} {{ $memo->middle_name ?? '' }} {{ $memo->surname ?? 'N/A' }}</span>
                </li>
                <li>
                    b) Consider and approve the change of name of various shop owners as per provisions of the Bill.
                </li>
                <li>
                    c) Consider and approve the Revocation of old Certificate of Occupancy <span class="highlight">{{ $memo->fileno ?? 'N/A' }}</span> to pave the way for new Sectional Titles to the new owners.
                </li>
            </ol>
    
            <!-- Signature Section -->
            <div class="grid grid-cols-2 gap-4 mt-8">
                <div>
                    <p>Name: - _________________________</p>
                    <p class="mt-4">Rank: _____________________________</p>
                    <p>Sign: _______________________________</p>
                    <p>Date: ______________________________</p>
                </div>
                <div>
                    <p>Counter Sign: -__________________</p>
                    <p class="text-right font-bold">Director Section Titling</p>
                    <p class="mt-4">Date: __________________________</p>
                </div>
            </div>
    
            <!-- Commissioner Section -->
            <div class="mt-8">
                <p class="font-bold">HONOURABLE COMMISSIONER</p>
                <p>The application is hereby recommended for your kind approval, please.</p>
                <div class="flex justify-between mt-2">
                    <p>Date: ______2025.</p>
                    <p class="border-t border-black pt-1 text-center w-48">Permanent Secretary</p>
                </div>
            </div>
    
            <!-- Final Approval Section -->
            <div class="mt-8">
                <p class="font-bold">PERMANENT SECRETARY</p>
                <p>The application is hereby APPROVED/NOT APPROVED.</p>
                <div class="flex justify-between mt-2">
                    <p>Date: __________________2025.</p>
                    <p class="border-t border-black pt-1 text-center w-64">HONOURABLE COMMISSIONER.</p>
                </div>
            </div>
            
            <!-- Print Button - Hidden when printing -->
            <div class="mt-12 text-center no-print">
                <button id="printButton" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                    Print Memo
                </button>
            </div>
        </div>
    </div>

    <!-- Print JavaScript Function -->
    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });
    </script>
</body>
</html>