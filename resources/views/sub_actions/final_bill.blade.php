<div class="bg-white border border-gray-200 rounded-lg shadow-sm">
    <div class="p-4">
      <!-- Header with two logos and title -->
      <div class="flex items-center justify-between mb-2">
        <div class="w-12 h-12">
          <img src="{{ asset('assets/logo/logo1.jpg') }}" alt="Kano State Logo" class="w-full h-full object-contain">
        </div>
        <div class="text-center">
          <h3 class="text-sm font-bold text-green-800">KANO STATE MINISTRY OF LAND AND PHYSICAL PLANNING</h3>
          <p class="text-xs font-medium text-red-600">SECTIONAL TITLE FINAL BILL</p>
        </div>
        <div class="w-12 h-12">
          <img src="{{ asset('assets/logo/logo3.jpeg') }}" alt="Ministry Logo" class="w-full h-full object-contain">
        </div>
      </div>
      
      
      <!-- Date -->
      <div class="text-right text-xs mb-4">
        <p>Wednesday, April 16, 2025</p>
      </div>
      
      <!-- Introduction -->
      <div class="mb-4">
        <p class="text-xs mb-2">Dear Sir/Madam,</p>
        <p class="text-xs">
          I am directed to inform you that the total cost of processing of your application for sectional 
          title located at <span class="font-medium">{{ $application->property_house_no ?? '' }} {{ $application->property_plot_no ?? '' }}, {{ $application->property_street_name ?? '' }}, {{ $application->property_district ?? '' }}, {{ $application->property_lga ?? '' }}</span> with the following particulars.
        </p>
      </div>
      
      <!-- Property Details -->
        <div class="mb-4">
        <div class="grid grid-cols-2 gap-2 text-xs">
          <div>
          <p><span class="font-medium">Form No:</span>{{$application->id}}</p>
          <p><span class="font-medium" id="display_file_no">File No:</span> {{$application->fileno}}</p>
          <p><span class="font-medium">Name of Section Owner:</span>{{ $application->applicant_title}} {{ $application->surname}} {{ $application->first_name}}</p>
          <p><span class="font-medium">Plot Size:{{ $application->plot_size}}</span> </p>
          <p><span class="font-medium">Land Use: {{ $application->land_use}}</span></p>
         <p><span class="font-medium">Location: {{ $application->property_house_no ?? '' }} {{ $application->property_plot_no ?? '' }}, {{ $application->property_street_name ?? '' }}, {{ $application->property_district ?? '' }}, {{ $application->property_lga ?? '' }}</span></p>
          <p><span class="font-medium">Approval Date: {{ $application->approval_date}}</span></p>
          </div>
          <div>

          </div>
        </div>
        </div>
      
      <!-- Fee Table -->
      <div class="border border-black mt-2">
        <table class="w-full text-xs bill-table">
          <thead>
            <tr class="border-b border-black">
             <th class="p-1.5 text-left border-r border-black">Land Use</th>
             <th class="p-1.5 text-left border-r border-black">Survey / Processing Fees</th>
             <th class="p-1.5 text-left">Dev. Charges ₦</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="p-1.5 border-r border-black">
                <p class="font-semibold">a.Residential Fees</p>
                <p class="pl-2">i.Processing Fee</p>
                <p class="font-semibold">b.Survey Fees</p>
                <p class="pl-2">i.Block of Flats</p>
                <p class="pl-2">ii.Apartment</p>
                <p class="font-semibold">c.Assignment Fees</p>
                <p class="font-semibold">d.Bill Balance</p>
                <p class="font-semibold">e.Commercial Fees</p>
                <p class="pl-2">i.Processing Fee</p>
                <p class="pl-2">ii.Survey Fees</p>
                <p class="pl-2">iii.Assignment Fees</p>
                <p class="pl-2">iv.Bill Balance</p>
              </td>
              <td class="p-1.5 border-r border-black" id="fee-col">
                <!-- Dynamically populated fees (static values as placeholders) -->
                <p id="res-processing-fee">N 20,000.00</p>
                <p id="res-survey-fee">N 50,000.00</p>
                <p id="res-assignment-fee">N 50,000.00</p>
                <p id="res-bill-balance">N 30,525.00</p>
              </td>
              <td class="p-1.5">
                <p id="dev-charges">—</p>
              </td>
            </tr>
            <tr class="border-t border-black">
              <td class="p-1.5 border-r border-black">One year Ground Rent</td>
              <td class="p-1.5 border-r border-black">N <span id="ground-rent-amount">0.00</span></td>
              <td class="p-1.5">N __________________</td>
            </tr>
            <tr class="border-t border-black">
              <td colspan="3" class="p-1.5">
                <p>TOTAL: ₦ <span id="final-bill-total">150,525.00</span> (<span id="final-bill-total-words">One Hundred Fifty Thousand Five Hundred Twenty-Five Naira Only</span>)</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!-- Ground Rent -->
      <div class="mb-4">
        <table class="bill-table">
          <tr>
            <td>One year Ground Rent</td>
            <td>₦ _____________</td>
            <td>₦ _____________</td>
          </tr>
        </table>
      </div>
      
      <!-- Total -->
      <div class="mb-4">
        <div class="flex justify-between items-center">
          <p class="text-sm font-bold">TOTAL:</p>
          <p class="text-sm font-bold">₦ 355,000.00</p>
        </div>
        <hr class="my-2 border-t border-gray-300">
      </div>
      
      <!-- Footer Text -->
      <div class="text-xs space-y-2 mb-4">
        <p>
          You are hereby directed to settle this bill promptly in order to accelerate the processing of your 
          application.
        </p>
        <p>
          <span class="font-medium">Note:</span> Documentary Payments can be made at the Checkout-Point and KANGIS 
          Cashier's Office.
        </p>
        <p>
          <span class="font-medium">Note:</span> Ensure that you obtain a duly acknowledged Revenue Receipt issued at the KANGIS 
          Office.
        </p>
        <p>Thank you.</p>
      </div>
      
      <!-- Action Buttons -->
      <div class="flex justify-between items-center mt-6">
        <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
          <i data-lucide="printer" class="w-3.5 h-3.5 mr-1.5"></i>
          Print Bill
        </button>
        
      </div>
    </div>
  </div>