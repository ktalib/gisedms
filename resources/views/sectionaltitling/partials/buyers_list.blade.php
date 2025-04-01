<div class="container mx-auto p-4 bg-gray-100 rounded shadow">
        <header class="text-center mb-6">
 
            <h1 class="text-xl font-bold mb-1">FINAL CONVEYANCE AGREEMENT</h1>
            <p class="text-sm">(For Sectional Titling and Decommissioning of Original Certificate of Occupancy)</p>
        </header>
    
        <main>
            <section class="mb-6">
                <p class="mb-2">This Final Conveyance Agreement is made this [Insert Date], between:</p>
                <ul class="list-none pl-6 mb-4">
                    <li class="mb-1">- The Original Owner: [Insert Name]</li>
                    <li class="mb-1">- Property Location: [Insert Property Address]</li>
                    <li class="mb-1">- Decommissioned Certificate of Occupancy (CofO) Number: [Insert Original CofO No.]</li>
                    <li class="mb-1">- Total Land Area: [Insert Size in Square Meters]</li>
                </ul>
    
                <p class="mb-2">This document serves as an official agreement between the original titleholder of the
                    property and the new sectional owners following the decommissioning of the original CofO
                    and the subsequent fragmentation of the property into individual sectional units.</p>
                
                <p class="mb-2">This conveyance is made in accordance with the Kano State Ministry of Land and Physical
                    Planning under the provisions of:</p>
                
                <ul class="list-none pl-6 mb-4">
                    <li class="mb-1">• The Kano State Sectional and Systematic Land Titling and Registration Law, 2024.</li>
                    <li class="mb-1">• Relevant State Urban Development and Planning Laws regulating land subdivision.</li>
                    <li class="mb-1">• National Land Tenure Policies on sectional ownership and property registration.</li>
                </ul>
            </section>
    
            <section class="mb-6">
                <h2 class="text-base font-bold mb-2">PROPERTY DETAILS</h2>
                <table class="w-full border-collapse mb-4">
                    <tbody>
                        <tr>
                            <td class="border border-gray-400 p-2 w-1/2">Original CofO No.</td>
                            <td class="border border-gray-400 p-2">[Insert Value]</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2">Plot Number</td>
                            <td class="border border-gray-400 p-2">[Insert Value]</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2">Block Number</td>
                            <td class="border border-gray-400 p-2">[Insert Value]</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2">Approved Plan Number</td>
                            <td class="border border-gray-400 p-2">[Insert Value]</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2">Survey Plan No.</td>
                            <td class="border border-gray-400 p-2">[Insert Value]</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2">Surveyed By</td>
                            <td class="border border-gray-400 p-2">[Insert Value]</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2">Layout Name</td>
                            <td class="border border-gray-400 p-2">[Insert Value]</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2">District Name</td>
                            <td class="border border-gray-400 p-2">[Insert Value]</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2">Local Government Area (LGA)</td>
                            <td class="border border-gray-400 p-2">[Insert Value]</td>
                        </tr>
                    </tbody>
                </table>
            </section>
    
            <section class="mb-6">
                <h2 class="text-base font-bold mb-2">LIST OF BUYERS & ALLOCATED SECTIONS</h2>
                <table class="w-full border-collapse mb-4">
                    <thead>
                        <tr>
                            <th class="border border-gray-400 p-2 text-left">SN</th>
                            <th class="border border-gray-400 p-2 text-left">BUYER NAME</th>
                            <th class="border border-gray-400 p-2 text-left">SECTION NO.</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                       
                        <tr>
                            <td class="border border-gray-400 p-2">7</td>
                            <td class="border border-gray-400 p-2">FARIDA ABUBAKAR MUHAMMAD</td>
                            <td class="border border-gray-400 p-2">[Unit No.]</td>
                        </tr>
                      
                    </tbody>
                </table>
            </section>
    
            @if(isset($application) && $application->conveyance)
                @php
                    $conveyanceData = json_decode($application->conveyance, true);
                @endphp
                <div class="mt-4 p-4 bg-white shadow">
                    <h3 class="text-lg font-bold mb-2">Final Conveyance Record</h3>
                    <p><strong>Buyer Name:</strong> {{ $conveyanceData['buyerName'] ?? '' }}</p>
                    <p><strong>Section No:</strong> {{ $conveyanceData['sectionNo'] ?? '' }}</p>
                </div>
            @endif
    
            <section class="mb-6">
                <h2 class="text-base font-bold mb-2">TERMS & CONDITIONS</h2>
                <ol class="list-decimal pl-6 mb-4">
                    <li class="mb-1"><span class="font-semibold">Decommissioning of the Original CofO:</span> The original CofO for the entire property is officially nullified.</li>
                    <li class="mb-1"><span class="font-semibold">Issuance of New Certificates:</span> Each buyer will receive a new CofO specific to their sectional unit.</li>
                    <li class="mb-1"><span class="font-semibold">Ownership Responsibilities:</span> Buyers agree to abide by all land use regulations under Kano State Law.</li>
                    <li class="mb-1"><span class="font-semibold">Validity & Legal Standing:</span> This agreement is legally binding.</li>
                    <li class="mb-1"><span class="font-semibold">Dispute Resolution:</span> Any disputes shall be resolved under the applicable laws of Kano State.</li>
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
                    <p class="font-semibold mb-1">Representative, Kano State Ministry of Land & Physical Planning:</p>
                    <p class="mb-1">Name: ________________________________________</p>
                    <p class="mb-1">Signature: ____________________________________</p>
                    <p class="mb-1">Designation: __________________________________</p>
                    <p class="mb-1">Date: ________________________________________</p>
                </div>
            </section>
    
            <section class="mb-6">
                <h2 class="text-base font-bold mb-2">OFFICIAL STAMP & SEAL</h2>
                <div class="border border-gray-400 p-8 text-center text-gray-400">[Insert Official Ministry Seal & Stamp Here]</div>
            </section>
        </main>
    </div>
