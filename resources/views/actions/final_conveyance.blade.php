@extends('layouts.app')
@section('page-title')
    {{ __('SECTIONAL TITLING  MODULE') }}
@endsection

<style>

   
    .tab-content {
      display: none;
    }
    .tab-content.active {
      display: block;
    }
    .tab-button {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      padding: 0.5rem 1rem;
      border-radius: 0.25rem;
      cursor: pointer;
      transition: background-color 0.2s;
    }
    .tab-button.active {
      background-color: #f3f4f6;
      font-weight: 500;
    }
    .tab-button:hover:not(.active) {
      background-color: #f9fafb;
    }
  </style>
@include('sectionaltitling.partials.assets.css')
@section('content')
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        @include('admin.header')
        <!-- Dashboard Content -->
        <div class="p-6">
        
            <div class="bg-white rounded-md shadow-sm border border-gray-200 p-6">
              

                <div class="modal-content p-6">
                    <div class="flex justify-between items-center mb-4">
                     
                      <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <i data-lucide="x" class="w-5 h-5"></i>
                      </button>
                    </div>
                    
                    <div class="py-2">
                      <div class="flex items-center justify-between mb-4">
                        <div>
                          <h3 class="text-sm font-medium">{{$application->land_use }} Property</h3>
                          <p class="text-xs text-gray-500">
                            Application ID: {{$application->applicationID}} | File No: {{$application->fileno }}  
                          </p>
                        </div>
                        <div class="text-right">
                          <h3 class="text-sm font-medium">{{$application->applicant_title }} {{$application->first_name }} {{$application->surname }}</h3>
                          <p class="text-xs text-gray-500">
                          <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                            {{$application->land_use }}
                          </span>
                          </p>
                        </div>
                      </div>
                
                      <!-- Tabs Navigation -->
                      
                  

                      <div class="grid grid-cols-3 gap-2 mb-4">
                        <button class="tab-button active" data-tab="initial">
                          <i data-lucide="banknote" class="w-3.5 h-3.5 mr-1.5"></i>
                          Add Buyers
                        </button>
                        <button class="tab-button" data-tab="detterment">
                          <i data-lucide="calculator" class="w-3.5 h-3.5 mr-1.5"></i>
                         Buyers List
                        </button>
                        <button class="tab-button" data-tab="final">
                          <i data-lucide="file-check" class="w-3.5 h-3.5 mr-1.5"></i>
                          Final Conveyance Agreement
                        </button>
                      </div>
                
                      <!-- Survey Tab -->
                    <div id="initial-tab" class="tab-content active">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                            <div class="p-4 border-b">
                                <h3 class="text-sm font-medium">Add Buyers</h3>
                            </div>
                            <div class="p-4 space-y-4">
                                <input type="hidden" id="application_id" value="{{$application->id}}">
                                <input type="hidden" name="fileno" value="{{$application->fileno}}">
                                
                                <div id="buyers-container">
                                    <div class="flex items-start space-x-2 mb-4 buyer-entry">
                                        <div class="grid grid-cols-3 gap-4 flex-grow">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    Title <span class="text-red-500">*</span>
                                                </label>
                                                <select name="applicant_title[]"
                                                    class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm">
                                                    <option value="" disabled selected>Select title</option>
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Chief">Chief</option>
                                                    <option value="Master">Master</option>
                                                    <option value="Capt">Capt</option>
                                                    <option value="Coln">Coln</option>
                                                    <option value="Pastor">Pastor</option>
                                                    <option value="King">King</option>
                                                    <option value="Prof">Prof</option>
                                                    <option value="Dr.">Dr.</option>
                                                    <option value="Alhaji">Alhaji</option>
                                                    <option value="Alhaja">Alhaja</option>
                                                    <option value="High Chief">High Chief</option>
                                                    <option value="Lady">Lady</option>
                                                    <option value="Bishop">Bishop</option>
                                                    <option value="Senator">Senator</option>
                                                    <option value="Messr">Messr</option>
                                                    <option value="Honorable">Honorable</option>
                                                    <option value="Miss">Miss</option>
                                                    <option value="Rev.">Rev.</option>
                                                    <option value="Barr.">Barr.</option>
                                                    <option value="Arc.">Arc.</option>
                                                    <option value="Sister">Sister</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="buyer-name" class="block text-sm font-medium text-gray-700 mb-2">Buyer Name</label>
                                                <input type="text" name="buyer_name[]" placeholder="Enter Buyer Name" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm">
                                            </div>
                                            <div>
                                                <label for="unit-no" class="block text-sm font-medium text-gray-700 mb-2">Unit No</label>
                                                <input type="text" name="unit_no[]" placeholder="Enter Unit No" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm">
                                            </div>
                                        </div>
                                        <button type="button" class="remove-buyer bg-red-500 text-white p-1.5 rounded-md hover:bg-red-600 flex items-center justify-center mt-8">
                                            <i data-lucide="x" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <button type="button" id="add-more-buyers" class="flex items-center px-3 py-1.5 text-xs bg-blue-500 text-white rounded-md hover:bg-blue-600 mt-2">
                                    <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Add Buyer
                                </button>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const buyersContainer = document.getElementById('buyers-container');
                                        const addMoreButton = document.getElementById('add-more-buyers');

                                        addMoreButton.addEventListener('click', function () {
                                            const newBuyerEntry = document.createElement('div');
                                            newBuyerEntry.classList.add('flex', 'items-start', 'space-x-2', 'mb-4', 'buyer-entry');
                                            newBuyerEntry.innerHTML = `
                                                <div class="grid grid-cols-3 gap-4 flex-grow">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Title <span class="text-red-500">*</span>
                                                        </label>
                                                        <select name="applicant_title[]"
                                                            class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm">
                                                            <option value="" disabled selected>Select title</option>
                                                            <option value="Mr.">Mr.</option>
                                                            <option value="Mrs.">Mrs.</option>
                                                            <option value="Chief">Chief</option>
                                                            <option value="Master">Master</option>
                                                            <option value="Capt">Capt</option>
                                                            <option value="Coln">Coln</option>
                                                            <option value="Pastor">Pastor</option>
                                                            <option value="King">King</option>
                                                            <option value="Prof">Prof</option>
                                                            <option value="Dr.">Dr.</option>
                                                            <option value="Alhaji">Alhaji</option>
                                                            <option value="Alhaja">Alhaja</option>
                                                            <option value="High Chief">High Chief</option>
                                                            <option value="Lady">Lady</option>
                                                            <option value="Bishop">Bishop</option>
                                                            <option value="Senator">Senator</option>
                                                            <option value="Messr">Messr</option>
                                                            <option value="Honorable">Honorable</option>
                                                            <option value="Miss">Miss</option>
                                                            <option value="Rev.">Rev.</option>
                                                            <option value="Barr.">Barr.</option>
                                                            <option value="Arc.">Arc.</option>
                                                            <option value="Sister">Sister</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="buyer-name" class="block text-sm font-medium text-gray-700 mb-2">Buyer Name</label>
                                                        <input type="text" name="buyer_name[]" placeholder="Enter Buyer Name" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm">
                                                    </div>
                                                    <div>
                                                        <label for="unit-no" class="block text-sm font-medium text-gray-700 mb-2">Unit No</label>
                                                        <input type="text" name="unit_no[]" placeholder="Enter Unit No" class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm">
                                                    </div>
                                                </div>
                                                <button type="button" class="remove-buyer bg-red-500 text-white p-1.5 rounded-md hover:bg-red-600 flex items-center justify-center mt-8">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            `;
                                            buyersContainer.appendChild(newBuyerEntry);
                                            lucide.createIcons(); // Reinitialize icons
                                            initializeRemoveButtons();
                                        });

                                        function initializeRemoveButtons() {
                                            const removeButtons = document.querySelectorAll('.remove-buyer');
                                            removeButtons.forEach(button => {
                                                button.addEventListener('click', function () {
                                                    this.parentElement.remove();
                                                });
                                            });
                                        }

                                        initializeRemoveButtons();
                                    });
                                </script>
                                
                                <hr class="my-4">

                                <div class="flex justify-between items-center">
                                    <div class="flex gap-2">
                                        <button class="flex items-center px-3 py-1.5 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                                            <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                            Back
                                        </button>
                                        <button class="flex items-center px-3 py-1.5 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                                            <i data-lucide="pencil" class="w-3.5 h-3.5 mr-1.5"></i>
                                            Edit
                                        </button>
                                        <button class="flex items-center px-3 py-1.5 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800">
                                            <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                      <!-- Detterment Bill Tab -->
                      <div id="detterment-tab" class="tab-content">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                          <div class="p-4 border-b">
                            <h3 class="text-sm font-medium">Buyers List  </h3>
                            <p class="text-xs text-gray-500"> </p>
                          </div>
                          <input type="hidden" id="application_id" value="{{$application->id}}">
                      <input type="hidden" name="fileno" value="{{$application->fileno}}">
                          <div class="p-4 space-y-4">
                            <div class="overflow-x-auto">
                                @if(isset($application) && $application->conveyance)
                                    @php
                                        $conveyanceData = json_decode($application->conveyance, true);
                                    @endphp
                                    <div class="mt-4 bg-white shadow rounded-lg overflow-hidden">
                                        <div class="p-4 border-b border-gray-200 bg-gray-50">
                                            <h3 class="text-lg font-semibold text-gray-800">List Of Buyers</h3>
                                        </div>
                                        
                                        @if(isset($conveyanceData['records']) && is_array($conveyanceData['records']))
                                            <div class="p-4">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SN</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buyer Name</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit No.</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach($conveyanceData['records'] as $index => $record)
                                                        <tr class="hover:bg-gray-50">
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $record['buyerName'] ?? '' }}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record['sectionNo'] ?? '' }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @elseif(isset($conveyanceData['buyerName']) && isset($conveyanceData['sectionNo']))
                                            <div class="p-4">
                                                <div class="bg-gray-50 p-3 rounded border">
                                                    <p class="mb-1"><span class="font-medium text-gray-700">Buyer Name:</span> {{ $conveyanceData['buyerName'] }}</p>
                                                    <p><span class="font-medium text-gray-700">Section No:</span> {{ $conveyanceData['sectionNo'] }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="p-4">
                                                <p class="text-center text-gray-500 py-4">No conveyance records found.</p>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="mt-4 bg-white shadow rounded-lg p-6 text-center text-gray-500">
                                        No buyer information available for this application.
                                    </div>
                                @endif
                            </div>
                
                     
                            <hr class="my-4">
                
                            <div class="flex justify-between items-center">
                           
                              <div class="flex gap-2">
                            
                                <button class="flex items-center px-3 py-1 text-xs bg-white text-black p-2 border border-gray-500 rounded-md hover:bg-gray-800">
                            <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                     
                                Back
                                </button>    
                                
                                <button class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800">
                                    <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
                                     
                                Submit
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                
                      <!-- Final Bill Tab -->
                      <div id="final-tab" class="tab-content">
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                          <div class="p-4 border-b">
                            <h3 class="text-sm font-medium">Final Conveyance Agreement</h3>
                            <p class="text-xs text-gray-500"></p>
                          </div>
                          <input type="hidden" id="application_id" value="{{$application->id}}">
                         <input type="hidden" name="fileno" value="{{$application->fileno}}">
                         <div class="container mx-auto p-4 bg-gray-100 rounded shadow">
                            <header class="text-center mb-6">
                     
                                <h1 class="text-xl font-bold mb-1">FINAL CONVEYANCE AGREEMENT</h1>
                                <p class="text-sm">(For Sectional Titling and Decommissioning of Original Certificate of Occupancy)</p>
                            </header>
                        
                            <main>
                                <section class="mb-6">
                                    <p class="mb-2">This Final Conveyance Agreement is made this [Insert Date], between:</p>
                                    <ul class="list-none pl-6 mb-4">
                                        <li class="mb-1">- The Original Owner: 
                                            @if(isset($application))
                                                @if($application->corporate_name)
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
                                            @if(isset($application))
                                                {{ trim($application->property_house_no . ' ' . $application->property_plot_no . ' ' . $application->property_street_name . ', ' . $application->property_district) }}
                                            @else
                                                [Insert Property Address]
                                            @endif
                                        </li>
                                        <li class="mb-1">- Decommissioned Certificate of Occupancy (CofO) Number: 
                                            @if(isset($application))
                                                {{ $application->fileno ?? '[No CofO Number Available]' }}
                                            @else
                                                [Insert Original CofO No.]
                                            @endif
                                        </li>
                                        <li class="mb-1">- Total Land Area: 
                                            @if(isset($application) && $application->plot_size)
                                                {{ $application->plot_size }} Square Meters
                                            @else
                                                [Insert Size in Square Meters]
                                            @endif
                                        </li>
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
                                                <td class="border border-gray-400 p-2">
                                                    @if(isset($application))
                                                        {{ $application->fileno ?? '[No Data]' }}
                                                    @else
                                                        [Insert Value]
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-400 p-2">Plot Number</td>
                                                <td class="border border-gray-400 p-2">
                                                    @if(isset($application))
                                                        {{ $application->property_plot_no ?? '[No Data]' }}
                                                    @else
                                                        [Insert Value]
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-400 p-2">Block Number</td>
                                                <td class="border border-gray-400 p-2">
                                                    @if(isset($application))
                                                        {{ $application->property_house_no ?? '[No Data]' }}
                                                    @else
                                                        [Insert Value]
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-400 p-2">Approved Plan Number</td>
                                                <td class="border border-gray-400 p-2">
                                                    @if(isset($application))
                                                        {{ $application->scheme_no ?? '[No Data]' }}
                                                    @else
                                                        [Insert Value]
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-400 p-2">Survey Plan No.</td>
                                                <td class="border border-gray-400 p-2">
                                                    @if(isset($application))
                                                        {{ $application->scheme_no ?? '[No Data]' }}
                                                    @else
                                                        [Insert Value]
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-400 p-2">Surveyed By</td>
                                                <td class="border border-gray-400 p-2">
                                                    @if(isset($application))
                                                        {{ $application->revenue_accountant ?? '[No Data]' }}
                                                    @else
                                                        [Insert Value]
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-400 p-2">Layout Name</td>
                                                <td class="border border-gray-400 p-2">
                                                    @if(isset($application))
                                                        {{ $application->property_district ?? '[No Data]' }}
                                                    @else
                                                        [Insert Value]
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-400 p-2">District Name</td>
                                                <td class="border border-gray-400 p-2">
                                                    @if(isset($application))
                                                        {{ $application->property_district ?? '[No Data]' }}
                                                    @else
                                                        [Insert Value]
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-400 p-2">Local Government Area (LGA)</td>
                                                <td class="border border-gray-400 p-2">
                                                    @if(isset($application))
                                                        {{ $application->property_lga ?? '[No Data]' }}
                                                    @else
                                                        [Insert Value]
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </section>
                        
                                
                        
                                @if(isset($application) && $application->conveyance)
                                    @php
                                        $conveyanceData = json_decode($application->conveyance, true);
                                    @endphp
                                    <div class="mt-4 p-4 bg-white shadow">
                                        <h3 class="text-lg font-bold mb-2">Final Conveyance Records</h3>
                                        
                                        @if(isset($conveyanceData['records']) && is_array($conveyanceData['records']))
                                            <table class="w-full border-collapse mb-4">
                                                <thead>
                                                    <tr>
                                                        <th class="border border-gray-400 p-2 text-left">SN</th>
                                                        <th class="border border-gray-400 p-2 text-left">BUYER NAME</th>
                                                        <th class="border border-gray-400 p-2 text-left">UNIT NO.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($conveyanceData['records'] as $index => $record)
                                                    <tr>
                                                        <td class="border border-gray-400 p-2">{{ $index + 1 }}</td>
                                                        <td class="border border-gray-400 p-2">{{ $record['buyerName'] ?? '' }}</td>
                                                        <td class="border border-gray-400 p-2">{{ $record['sectionNo'] ?? '' }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @elseif(isset($conveyanceData['buyerName']) && isset($conveyanceData['sectionNo']))
                                            <!-- Fallback for the old single-record format -->
                                            <p><strong>Buyer Name:</strong> {{ $conveyanceData['buyerName'] }}</p>
                                            <p><strong>Section No:</strong> {{ $conveyanceData['sectionNo'] }}</p>
                                        @else
                                            <p>No conveyance records found.</p>
                                        @endif
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
                    
                    
                            <hr class="my-4">
                
                            <div class="flex justify-between items-center">
                                <div class="flex gap-2">
                                    <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-white hover:bg-gray-50">
                                    <i data-lucide="undo-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                    Back
                                    </button>
                                    
                                    <button class="flex items-center px-3 py-1 text-xs border border-gray-300 rounded-md bg-sky-900 hover:bg-gray-50">
                                    <i data-lucide="folder-git-2" class="w-3.5 h-3.5 mr-1.5"></i>
                                    EDMS
                                    </button>
                                 
                                    <button class="flex items-center px-3 py-1 text-xs bg-green-700 text-white rounded-md hover:bg-gray-800">
                                        <i data-lucide="send-horizontal" class="w-3.5 h-3.5 mr-1.5"></i>
                                        Submit
                                    </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                <!-- Footer -->
                @include('admin.footer')
            </div>
            <script>
                // Initialize Lucide icons
                lucide.createIcons();
                
                // Tab switching functionality
                document.addEventListener('DOMContentLoaded', function() {
                  const tabButtons = document.querySelectorAll('.tab-button');
                  const tabContents = document.querySelectorAll('.tab-content');
                  
                  tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                      const tabId = this.getAttribute('data-tab');
                      
                      // Deactivate all tabs
                      tabButtons.forEach(btn => btn.classList.remove('active'));
                      tabContents.forEach(content => content.classList.remove('active'));
                      
                      // Activate selected tab
                      this.classList.add('active');
                      document.getElementById(`${tabId}-tab`).classList.add('active');
                    });
                  });
                  
                  // Close modal button
                  document.getElementById('closeModal').addEventListener('click', function() {
                    // In a real application, this would close the modal
                    alert('Modal closed');
                  });
                });
              </script>
    
        @endsection


  