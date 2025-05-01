@extends('layouts.app')

@section('page-title')
    {{ $pageTitle ?? __('Generate Memo') }}
@endsection

@section('content')
<div class="flex-1 overflow-auto bg-gray-50">
    <!-- Header -->
    @include($headerPartial ?? 'admin.header')
    
    <!-- Main Content -->
    <div class="p-6 max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            <div class="flex justify-between items-center p-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-white">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Generate Memo</h2>
                    <p class="text-sm text-gray-600 mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        File No: {{ $application->fileno }}
                    </p>
                </div>
                <a href="{{ route('programmes.memo') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-md transition-colors duration-150 ease-in-out border border-gray-300 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to List
                </a>
            </div>
            
            <form method="POST" action="{{ route('programmes.save_memo') }}" class="p-6 space-y-8">
                @csrf
                <input type="hidden" name="application_id" value="{{ $application->id }}">
                <input type="hidden" name="memo_type" value="primary">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Certificate Details -->
                    <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm">
                        <h3 class="font-semibold text-lg text-gray-800 border-b border-gray-200 pb-3 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Certificate Details
                        </h3>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">File/Certificate Number</label>
                                <input type="text" name="certificate_number" value="{{ $existingMemo->certificate_number ?? $application->fileno }}" 
                                   class="w-full p-2 border border-gray-300 rounded-md text-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Page Number</label>
                                <input type="text" name="page_no" value="{{ $existingMemo->page_no ?? ($landAdmin->page_no ?? '01') }}" 
                                   class="w-full p-2 border border-gray-300 rounded-md text-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Applicant Name</label>
                                <input type="text" name="applicant_name" value="{{ $existingMemo->applicant_name ?? $application->owner_name }}" 
                                   class="w-full p-2 border border-gray-300 rounded-md text-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Property Location</label>
                                <input type="text" name="property_location" 
                                    value="{{ $existingMemo->property_location ?? $application->property_street_name . ', ' . $application->property_district . ', ' . $application->property_lga }}" 
                                   class="w-full p-2 border border-gray-300 rounded-md text-sm">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tenure Details -->
                    <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm">
                        <h3 class="font-semibold text-lg text-gray-800 border-b border-gray-200 pb-3 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Tenure Details
                        </h3>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Commencement Date</label>
                                <input type="date" name="commencement_date" 
                                    value="{{ $existingMemo->commencement_date ?? ($application->approval_date ? date('Y-m-d', strtotime($application->approval_date)) : date('Y-m-d')) }}" 
                                   class="w-full p-2 border border-gray-300 rounded-md text-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Term (Years)</label>
                                <input type="number" name="term_years" value="{{ $existingMemo->term_years ?? $totalYears }}" 
                                   class="w-full p-2 border border-gray-300 rounded-md text-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Residual Years</label>
                                <input type="number" name="residual_years" value="{{ $existingMemo->residual_years ?? $residualYears }}" 
                                   class="w-full p-2 border border-gray-300 rounded-md text-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                                <input type="date" name="expiry_date" 
                                    value="{{ $existingMemo->expiry_date ?? ($expiryDate ? date('Y-m-d', strtotime($expiryDate)) : '') }}" 
                                   class="w-full p-2 border border-gray-300 rounded-md text-sm">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Planning Details -->
                <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm">
                    <h3 class="font-semibold text-lg text-gray-800 border-b border-gray-200 pb-3 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Planning Recommendation
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Planning Recommendation</label>
                            <textarea name="planner_recommendation" rows="4" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out hover:border-gray-400 resize-none">{{ $existingMemo->planner_recommendation ?? 'The application was referred to Physical Planning Department for planning, engineering as well as architectural views. The planners recommended the application because it is feasible, and the shops meet the minimum requirements for commercial titles. Moreover, the proposal is accessible and conforms with the existing commercial development in the area.' }}</textarea>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="bg-gray-50 rounded-md p-3 border border-gray-100 flex items-center">
                                <input type="checkbox" name="is_planning_recommended" value="1" 
                                    {{ $existingMemo && $existingMemo->is_planning_recommended ? 'checked' : '' }}
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded transition duration-150 ease-in-out">
                                <label class="ml-2 block text-sm text-gray-700">
                                    Planning Recommendation Approved
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Director Details -->
                <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-sm">
                    <h3 class="font-semibold text-lg text-gray-800 border-b border-gray-200 pb-3 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Director Details
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Director Name</label>
                            <input type="text" name="director_name" value="{{ $existingMemo->director_name ?? '' }}" 
                               class="w-full p-2 border border-gray-300 rounded-md text-sm">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Director Rank</label>
                            <input type="text" name="director_rank" value="{{ $existingMemo->director_rank ?? 'Director Section Titling' }}" 
                               class="w-full p-2 border border-gray-300 rounded-md text-sm">
                        </div>
                    </div>
                </div>
                
                <div class="pt-5 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('programmes.memo') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-md transition-colors duration-150 ease-in-out border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md transition-colors duration-150 ease-in-out border border-transparent shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Memo
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Page Footer -->
    @include($footerPartial ?? 'admin.footer')
</div>
@endsection
