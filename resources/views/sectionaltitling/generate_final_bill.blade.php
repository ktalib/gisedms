<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KANGIS Sectional Title Bill</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            .page {
                width: 210mm;
                height: 297mm;
                padding: 10mm;
            }
            .no-break {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body class="bg-white font-sans text-sm">
    <div class="page max-w-[210mm] mx-auto p-8 bg-white shadow-none print:shadow-none relative">
        <!-- Background Watermark -->
        <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none overflow-hidden" style="top: -520px;">
            <div>
            <div>
                <img src="{{ asset('assets/logo/logo3.jpeg') }}" alt="KANGIS Logo"  style="width: 200px; height: 200px; object-fit: contain;">
            </div>
            </div>
        </div>

        <!-- Header -->
        <div class="flex justify-between items-center mb-4 relative z-10">
            <img src="{{ asset('assets/logo/logo1.jpg') }}" alt="Kano State Coat of Arms" class="w-16 h-16 object-contain">
            <div class="text-center mt-20">
            <h1 class="text-lg font-bold">KANO STATE
                MINISTRY OF LAND AND PHYSICAL PLANNING</h1>
           
            <h3 class="text-sm font-semibold mt-1">Application for Sectional Titling</h3>
            </div>
            <img src="{{ asset('assets/logo/logo3.jpeg') }}" alt="KANGIS Logo" class="w-16 h-16 object-contain">
        </div>

        <!-- Date -->
        <div class="text-right mb-4">
            <p>{{ $approval_date ?? now()->format('Y-m-d') }}</p>
        </div>

        <!-- Content -->
        <div class="space-y-2 text-sm">
            <p>Dear Sir/Madame,</p>
            
            <p class="text-sm">I am directed to inform you that the total cost of processing of your application for Sectional Title located at 
                <span class="italic">{{ $property_location ?? '' }}</span> 
                with the following particulars;
            </p>
            
            <div class="space-y-0.5 text-sm">
                <p> FormID: <span class="italic">STM-2025-000{{ $id ?? '' }}</span></p>
                <p>FileNo: <span class="italic">{{ $fileno ?? '' }}</span></p>
                <p>Name of Section Owner: <span class="italic">{{ $owner_name ?? '' }}</span></p>
                <p>Plot Size: <span class="italic">{{ $plot_size ?? '' }}</span></p>
                <p>Landuse: <span class="italic">{{ $land_use ?? '' }}</span></p>
                <p>Location: <span class="italic">{{ $property_location ?? '' }}</span></p>
                <p>Approval Date: <span class="italic">{{ $approval_date ?? now()->format('Y-m-d') }}</span></p>
                <p>is at <span class="italic">₦{{ number_format($total ?? 0, 2) }} ({{ $total_words ?? '' }})</span>, see breakdown of cost below.</p>
            </div>
            
            <!-- Fee Table -->
            <div class="border border-black mt-2 no-break">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-black">
                            <th class="p-1.5 text-left border-r border-black">Land Use</th>
                            <th class="p-1.5 text-left border-r border-black">Survey / Processing Fees</th>
                            <th class="p-1.5 text-left">Dev. Charges N</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs">
                        <tr>
                            <td class="p-1.5 border-r border-black align-top">
                                <p class="font-semibold">a.Residential Fees</p>
                                <p class="pl-2">i.Processing Fee</p>
                                <p class="font-semibold">b.Survey Fees</p>
                                <p class="pl-2">i.Block of Flats</p>
                                <p class="pl-2">ii.Appartment</p>
                                <p class="font-semibold">c.Assignment Fees</p>
                                <p class="font-semibold">d.Bill Balance</p>
                                <p class="font-semibold">e.Commercial Fees</p>
                                <p class="pl-2">i.Processing Fee</p>
                                <p class="pl-2">ii.Survey Fees</p>
                                <p class="pl-2">iii.Assignment Fees</p>
                                <p class="pl-2">iv.Bill Balance</p>
                            </td>
                            <td class="p-1.5 border-r border-black align-top">
                                <p>&nbsp;</p>
                                <p>{{ strtolower($land_use ?? '') == 'residential' ? 'N 20,000.00K' : '—' }}</p>
                                <p>&nbsp;</p>
                                @if(strtolower($land_use ?? '') == 'residential')
                                    @if(isset($NoOfUnits) && $NoOfUnits > 1)
                                        <p>N 50,000.00K</p>
                                        <p>—</p>
                                    @else
                                        <p>—</p>
                                        <p>N 70,000.00K</p>
                                    @endif
                                @else
                                    <p>—</p>
                                    <p>—</p>
                                @endif
                                <p>{{ strtolower($land_use ?? '') == 'residential' ? 'N 50,000.00' : '—' }}</p>
                                <p>{{ strtolower($land_use ?? '') == 'residential' ? 'N 30,525.00K' : '—' }}</p>
                                <p>&nbsp;</p>
                                <p>{{ strtolower($land_use ?? '') != 'residential' ? 'N 50,000.00K' : '—' }}</p>
                                <p>{{ strtolower($land_use ?? '') != 'residential' ? 'N 100,000.00K' : '—' }}</p>
                                <p>{{ strtolower($land_use ?? '') != 'residential' ? 'N 100,000.00K' : '—' }}</p>
                                <p>{{ strtolower($land_use ?? '') != 'residential' ? 'N 30,525.00K' : '—' }}</p>
                            </td>
                            <td class="p-1.5 align-top">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr class="border-t border-black">
                            <td class="p-1.5 border-r border-black">One year Ground Rent</td>
                            <td class="p-1.5 border-r border-black">N {{ number_format($ground_rent ?? 0, 2) }}</td>
                            <td class="p-1.5">N________________</td>
                        </tr>
                        <tr class="border-t border-black">
                            <td colspan="3" class="p-1.5">
                                <p>TOTAL&nbsp;&nbsp;&nbsp;₦ {{ number_format($total ?? 0, 2) }} ({{ $total_words ?? '' }})</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Payment Instructions -->
            <div class="mt-2 text-sm">
                <p>
                    You are hereby advised to settle this bill promptly in order to accelerate the processing of your
                    Certificate of Occupancy. Payments can be made at the One-Stop-Shop and all KANGIS designated
                    banks. Ensure that you obtain a duly acknowledged Revenue Receipt issued at the KANGIS Office
                    after concluding payment of the billed amount.
                </p>
                
                <p class="mt-2">Thank you.</p>
                
                <!-- Signatures -->
                <div class="flex justify-between mt-8">
                    <div class="border-t border-gray-500 w-64 text-center">
                        <p class="mt-1 text-xs">Date & Signature of Revenue Officer</p>
                    </div>
                    <div class="border-t border-gray-500 w-64 text-center">
                        <p class="mt-1 text-xs">Date & Stamp of Receiving Bank</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>