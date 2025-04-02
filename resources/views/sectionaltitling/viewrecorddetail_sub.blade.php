{{-- filepath: c:\wamp64\www\gisedms\resources\views\sectionaltitling\viewrecorddetail.blade.php --}}
@extends('layouts.app')
@section('page-title')
    {{ __('APPLICATION FOR SECTIONAL TITLING COMMERCIAL RECORD DETAILS') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('APPLICATION FOR SECTIONAL TITLING COMMERCIAL RECORD DETAILS') }}
    </li>
@endsection

@section('content')
    <div class="container mx-auto mt-4 p-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gray-50 border-b border-gray-200 py-3 px-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Record Details</h2>
                    <div class="flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        Application Status    {{ $application->application_status ?? 'Pending' }}
                        </span>
                        <span class="bg-{{ $application->planning_recommendation_status == 'Approved' ? 'green' : ($application->planning_recommendation_status == 'Rejected' ? 'red' : 'yellow') }}-100 
                               text-{{ $application->planning_recommendation_status == 'Approved' ? 'green' : ($application->planning_recommendation_status == 'Rejected' ? 'red' : 'yellow') }}-800 
                               text-xs font-medium px-2.5 py-0.5 rounded-full">
                            Planning Recommendation: {{ $application->planning_recommendation_status ?? 'Pending' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="bg-white p-6">
                    <!-- File Info and Status -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <strong class="block font-medium text-gray-700 mb-1">File Number:</strong>
                                    <span class="text-gray-900 text-lg">{{ $application->fileno ?? 'N/A' }}</span>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <strong class="block font-medium text-gray-700 mb-1">Application Type:</strong>
                                    <span class="text-gray-900 text-lg">{{ ucfirst($application->applicant_type ?? 'N/A') }}</span>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <strong class="block font-medium text-gray-700 mb-1">Application Date:</strong>
                                    <span class="text-gray-900">{{ $application->created_at ? date('d M Y', strtotime($application->created_at)) : 'N/A' }}</span>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <strong class="block font-medium text-gray-700 mb-1">Approval Date:</strong>
                                    <span class="text-gray-900">{{ $application->approval_date ? date('d M Y', strtotime($application->approval_date)) : 'Pending' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <!-- Passport Photo Section -->
                            <div class="text-center">
                                <div class="mb-2 border border-gray-300 rounded-lg overflow-hidden inline-block">
                                    @if(isset($application->passport) && !empty($application->passport))
                                        <img src="{{ asset('storage/app/public/'.$application->passport) }}" alt="Applicant Photo" class="w-36 h-36 object-cover">
                                    @else
                                        <div class="w-36 h-36 bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-500 text-sm">No Photo Available</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600">Applicant Photo</p>
                            </div>
                        </div>
                    </div>

                    <!-- Applicant Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Applicant Information</h3>
                        
                        @if($application->applicant_type == 'individual')
                            <!-- Individual Applicant(s) -->
                            <div class="bg-gray-50 p-4 rounded-lg mb-4">
                                <strong class="block font-medium text-gray-700 mb-2">Primary Applicant:</strong>
                                <div class="flex items-center">
                                    <div class="mr-4">
                                        @if(isset($application->passport) && !empty($application->passport))
                                            <img src="{{ asset('storage/app/public/'.$application->passport) }}" alt="Primary Applicant" class="w-16 h-16 object-cover rounded-full border border-gray-300">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                                <span class="text-gray-500 text-xs">No Photo</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-gray-900 font-medium">{{ $application->applicant_title ?? '' }} {{ $application->first_name ?? '' }} {{ $application->middle_name ?? '' }} {{ $application->surname ?? '' }}</p>
                                        <p class="text-gray-600 text-sm">{{ $application->email ?? 'N/A' }} </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Co-Applicants (if any) -->
                            @if(isset($application->co_applicants) && !empty($application->co_applicants))
                                <strong class="block font-medium text-gray-700 mb-2">Co-Applicants:</strong>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($application->co_applicants as $co_applicant)
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="mr-4">
                                                @if(isset($co_applicant->passport_photo) && !empty($co_applicant->passport_photo))
                                                    <img src="{{ asset('storage/'.$co_applicant->passport_photo) }}" alt="Co-Applicant" class="w-12 h-12 object-cover rounded-full border border-gray-300">
                                                @else
                                                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                                        <span class="text-gray-500 text-xs">No Photo</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-gray-900">{{ $co_applicant->title ?? '' }} {{ $co_applicant->name ?? 'N/A' }}</p>
                                                <p class="text-gray-600 text-sm">{{ $co_applicant->email ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        @elseif($application->applicant_type == 'corporate')
                            <!-- Corporate Applicant -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <strong class="block font-medium text-gray-700 mb-1">Corporate Name:</strong>
                                    <span class="text-gray-900">{{ $application->corporate_name ?? 'N/A' }}</span>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <strong class="block font-medium text-gray-700 mb-1">RC Number:</strong>
                                    <span class="text-gray-900">{{ $application->rc_number ?? 'N/A' }}</span>
                                </div>
                            </div>
                            
                            <!-- Corporate Representatives (if any) -->
                            @if(isset($application->representatives) && !empty($application->representatives))
                                <div class="mt-4">
                                    <strong class="block font-medium text-gray-700 mb-2">Corporate Representatives:</strong>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($application->representatives as $rep)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex items-center">
                                                <div class="mr-4">
                                                    @if(isset($rep->passport_photo) && !empty($rep->passport_photo))
                                                        <img src="{{ asset('storage/'.$rep->passport_photo) }}" alt="Representative" class="w-12 h-12 object-cover rounded-full border border-gray-300">
                                                    @else
                                                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                                            <span class="text-gray-500 text-xs">No Photo</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="text-gray-900">{{ $rep->name ?? 'N/A' }}</p>
                                                    <p class="text-gray-600 text-sm">{{ $rep->position ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif

                        <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                            <strong class="block font-medium text-gray-700 mb-1">Contact Information:</strong>
                            <div class="text-gray-900">
                                <div>{{ $application->address ?? 'N/A' }}</div>
                                <div>
                                    Phone: 
                                    @if(isset($application->phone_number))
                                        @php
                                            $phoneNumbers = explode(',', $application->phone_number);
                                        @endphp
                                        @if(count($phoneNumbers) > 1)
                                            @foreach($phoneNumbers as $phoneNumber)
                                                {{ trim($phoneNumber) }}@if(!$loop->last), @endif
                                            @endforeach
                                        @else
                                            {{ $application->phone_number ?? 'N/A' }}
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </div>
                                <div>Email: {{ $application->email ?? 'N/A' }}</div>
                            </div>
                        </div>
                        
                        <!-- Multiple Owners Section -->
                        @if(isset($application->multiple_owners_names) && !empty($application->multiple_owners_names))
                            <div class="mt-4">
                                <strong class="block font-medium text-gray-700 mb-2">Multiple Owners:</strong>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @php
                                        $ownerNames = is_array($application->multiple_owners_names) 
                                            ? $application->multiple_owners_names 
                                            : json_decode($application->multiple_owners_names, true);
                                            
                                        $ownerPassports = is_array($application->multiple_owners_passport)
                                            ? $application->multiple_owners_passport
                                            : json_decode($application->multiple_owners_passport, true);
                                    @endphp
                                    
                                    @foreach($ownerNames as $key => $ownerName)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex items-center">
                                                <div class="mr-4">
                                                    @if(isset($ownerPassports[$key]) && !empty($ownerPassports[$key]))
                                                        <img src="{{ asset('storage/app/public/'.$ownerPassports[$key]) }}" 
                                                             alt="Owner Photo" 
                                                             class="w-16 h-16 object-cover rounded-full border border-gray-300">
                                                    @else
                                                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                                            <span class="text-gray-500 text-xs">No Photo</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="text-gray-900 font-medium">{{ $ownerName }}</p>
                                                    <p class="text-gray-600 text-sm">Owner {{ $key + 1 }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Property Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Property Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <strong class="block font-medium text-gray-700 mb-1">Land Use:</strong>
                                <span class="text-gray-900">{{ ucfirst($application->land_use ?? 'N/A') }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <strong class="block font-medium text-gray-700 mb-1">Plot Size:</strong>
                                <span class="text-gray-900">{{ $application->plot_size ?? 'N/A' }} sqm</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <strong class="block font-medium text-gray-700 mb-1">Number of Units:</strong>
                                <span class="text-gray-900">{{ $application->NoOfUnits ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                            <strong class="block font-medium text-gray-700 mb-1">Property  Location:</strong>
                            <span class="text-gray-900">
                                House/Plot No: {{ $application->plot_house_no ?? '' }} {{ $application->plot_plot_no ?? '' }},
                                {{ $application->plot_street_name ?? '' }},
                                {{ $application->plot_district ?? '' }}
                            </span>
                        </div>
                    </div>

                    <!-- Financial Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Initial Bill</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <strong class="block font-medium text-gray-700 mb-1">Application Fee:</strong>
                                <span class="text-gray-900">₦{{ number_format($application->application_fee ?? 0, 2) }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <strong class="block font-medium text-gray-700 mb-1">Processing Fee:</strong>
                                <span class="text-gray-900">₦{{ number_format($application->processing_fee ?? 0, 2) }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <strong class="block font-medium text-gray-700 mb-1">Site Plan Fee:</strong>
                                <span class="text-gray-900">₦{{ number_format($application->site_plan_fee ?? 0, 2) }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <strong class="block font-medium text-gray-700 mb-1">Receipt Number:</strong>
                                <span class="text-gray-900">{{ $application->receipt_number ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <strong class="block font-medium text-gray-700 mb-1">Payment Date:</strong>
                                <span class="text-gray-900">{{ $application->payment_date ? date('d M Y', strtotime($application->payment_date)) : 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <strong class="block font-medium text-gray-700 mb-1">Total Fees:</strong>
                                <span class="text-gray-900 font-bold">₦{{ 
                                    number_format(
                                        ($application->application_fee ?? 0) + 
                                        ($application->processing_fee ?? 0) + 
                                        ($application->site_plan_fee ?? 0), 2) 
                                }}</span>
                            </div>
                        </div>
                    </div>

                    @if($application->comments)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Comments</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700">
                                {{ $application->comments }}
                            </p>
                        </div>
                    </div>
                    @endif

                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('sectionaltitling.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md transition duration-150 ease-in-out flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to List
                        </a>
                        
                         
                        {{-- <button onclick="window.print()" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-md transition duration-150 ease-in-out flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                            </svg>
                            Print Record
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
