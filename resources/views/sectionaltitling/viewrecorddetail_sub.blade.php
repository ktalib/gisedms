@extends('layouts.app')

@section('page-title', __('Sub-Application Details'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('sectionaltitling.index') }}">{{ __('Sub-Applications') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('View Details') }}</li>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">ST FileNo - {{ $application->fileno ?? 'N/A' }}</h4>
                </div>
                <div class="card-body">
                    <!-- Main Application Details -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-users mr-2"></i> Original Owner Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>File No:</strong> <span class="text-primary">{{ $application->mother_fileno ?? 'N/A' }}</span></p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Form ID:</strong> STM-2025-000{{ $application->main_application_id ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Owner Type:</strong> {{ ucfirst($application->mother_applicant_type ?? 'N/A') }}</p>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p><strong>Original Owner(s):</strong></p>
                                    @if ($application->mother_applicant_type == 'corporate')
                                        <div class="alert alert-info">
                                            <p><i class="fas fa-building mr-2"></i> {{ $application->mother_corporate_name ?? 'N/A' }} (RC: {{ $application->mother_rc_number ?? 'N/A' }})</p>
                                        </div>
                                    @elseif ($application->mother_applicant_type == 'multiple' && !empty($application->mother_multiple_owners_names_array))
                                        <div class="alert alert-info">
                                            <i class="fas fa-users mr-2"></i> 
                                            <ul class="mb-0 list-unstyled">
                                                @foreach($application->mother_multiple_owners_names_array as $ownerName)
                                                    <li>{{ $ownerName }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            <p><i class="fas fa-user mr-2"></i> {{ $application->mother_applicant_title ?? '' }} {{ $application->mother_first_name ?? '' }} {{ $application->mother_middle_name ?? '' }} {{ $application->mother_surname ?? '' }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Original Owner Passport Photos -->
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p><strong>Photo Identification:</strong></p>
                                    @if ($application->mother_applicant_type == 'multiple')
                                        @php
                                            $motherPassports = !empty($application->mother_multiple_owners_passport) 
                                                ? json_decode($application->mother_multiple_owners_passport, true) 
                                                : [];
                                            
                                            // If decoding failed or it's not in the expected format
                                            if (json_last_error() !== JSON_ERROR_NONE || !is_array($motherPassports)) {
                                                $motherPassports = [];
                                            }
                                        @endphp
                                        
                                        @if(!empty($motherPassports))
                                            <div class="row">
                                                @foreach($motherPassports as $index => $passport)
                                                    <div class="col-md-3 mb-3">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                @if(is_string($passport) && !empty($passport))
                                                                    <img src="{{ asset('storage/app/public/passports/' . $passport) }}" 
                                                                         alt="Owner {{ $index + 1 }}" 
                                                                         class="img-thumbnail mb-2" 
                                                                         style="max-width: 150px; height: auto;">
                                                                @elseif(is_array($passport) && !empty($passport['photo']))
                                                                    <img src="{{ asset('storage/app/public/passports/' . $passport['photo']) }}" 
                                                                         alt="{{ $passport['name'] ?? 'Owner ' . ($index + 1) }}" 
                                                                         class="img-thumbnail mb-2" 
                                                                         style="max-width: 150px; height: auto;">
                                                                    <h6>{{ $passport['name'] ?? ('Owner ' . ($index + 1)) }}</h6>
                                                                @else
                                                                    <div class="avatar-placeholder mb-2">
                                                                        <i class="fas fa-user fa-3x"></i>
                                                                    </div>
                                                                    <h6>Owner {{ $index + 1 }}</h6>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-light">
                                                <p><i class="fas fa-info-circle mr-2"></i> No passport photos available for multiple owners</p>
                                            </div>
                                        @endif
                                    @elseif(!empty($application->mother_passport))
                                        <div class="text-center mt-2">
                                            <img src="{{ asset('storage/app/public/' . $application->mother_passport) }}" 
                                                 alt="Original Owner Passport" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 150px;">
                                        </div>
                                    @else
                                        <div class="alert alert-light">
                                            <p><i class="fas fa-info-circle mr-2"></i> No passport photo available</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <p><strong>Land Use:</strong> {{ ucfirst($application->mother_land_use ?? 'N/A') }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Plot Size:</strong> {{ $application->mother_plot_size ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Phone:</strong> {{ $application->mother_phone_number ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sub-Application Details -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-file-alt mr-2"></i> Unit Owner Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Block Number:</strong> {{ $application->block_number ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Section Number (Floor):</strong> {{ $application->floor_number ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Unit Number:</strong> {{ $application->unit_number ?? 'N/A' }}</p>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p><strong>Unit Owner(s):</strong></p>
                                    @if ($application->applicant_type == 'corporate')
                                        <div class="alert alert-info">
                                            <p><i class="fas fa-building mr-2"></i> {{ $application->corporate_name ?? 'N/A' }} (RC: {{ $application->rc_number ?? 'N/A' }})</p>
                                        </div>
                                    @elseif ($application->applicant_type == 'multiple' && !empty($application->multiple_owners_names_array))
                                        <div class="alert alert-info">
                                            <i class="fas fa-users mr-2"></i> 
                                            <ul class="mb-0 list-unstyled">
                                                @foreach($application->multiple_owners_names_array as $ownerName)
                                                    <li>{{ $ownerName }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        
                                        @if(!empty($application->multiple_owners_data_array))
                                        <div class="mt-3">
                                            <p><strong>Owner Details:</strong></p>
                                            <div class="row">
                                                @foreach($application->multiple_owners_data_array as $ownerData)
                                                    <div class="col-md-4 mb-3">
                                                        <div class="card">
                                                            <div class="card-body text-center">
                                                                @if(!empty($ownerData['photo']))
                                                                    <img src="{{ asset('storage/app/public/' . $ownerData['photo']) }}" 
                                                                         alt="{{ $ownerData['name'] }}" 
                                                                         class="img-thumbnail mb-2" 
                                                                         style="max-width: 150px;">
                                                                @else
                                                                    <div class="avatar-placeholder mb-2">
                                                                        <i class="fas fa-user fa-3x"></i>
                                                                    </div>
                                                                @endif
                                                                <h6>{{ $ownerData['name'] ?? 'N/A' }}</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        <div class="alert alert-info">
                                            <p><i class="fas fa-user mr-2"></i> {{ $application->applicant_title ?? '' }} {{ $application->first_name ?? '' }} {{ $application->middle_name ?? '' }} {{ $application->surname ?? '' }}</p>
                                        </div>
                                        
                                        @if(!empty($application->passport))
                                            <div class="text-center mt-2">
                                                <img src="{{ asset('storage/app/public/' . $application->passport) }}" 
                                                     alt="Passport Photo" 
                                                     class="img-thumbnail" 
                                                     style="max-width: 150px;">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <p><strong>Phone Number:</strong> {{ $application->phone_number ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Email:</strong> {{ $application->email ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Address:</strong> {{ $application->address ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Application Status -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-clipboard-check mr-2"></i> Application Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Planning Recommendation:</strong> 
                                       <span class="badge {{ $application->planning_recommendation_status === 'Approved' ? 'bg-success' : 'bg-warning' }}">
                                           {{ $application->planning_recommendation_status ?? 'Pending' }}
                                       </span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Application Status:</strong> 
                                       <span class="badge {{ $application->application_status === 'Approved' ? 'bg-success' : 'bg-warning' }}">
                                           {{ $application->application_status ?? 'Processing' }}
                                       </span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Approval Date:</strong> 
                                        {{ $application->approval_date ? date('F j, Y', strtotime($application->approval_date)) : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <p><strong>Application Fee:</strong> ₦{{ number_format($application->application_fee ?? 0, 2) }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Processing Fee:</strong> ₦{{ number_format($application->processing_fee ?? 0, 2) }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Site Plan Fee:</strong> ₦{{ number_format($application->site_plan_fee ?? 0, 2) }}</p>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p><strong>Payment Date:</strong> 
                                        {{ $application->payment_date ? date('F j, Y', strtotime($application->payment_date)) : 'N/A' }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Receipt Number:</strong> {{ $application->receipt_number ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Property Details -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-home mr-2"></i> Property Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Property Location:</strong> {{ $application->property_location ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Land Use:</strong> {{ ucfirst($application->land_use ?? 'N/A') }}</p>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <p><strong>Comments:</strong> {{ $application->comments ?? 'No comments' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="text-center mt-4">
                        <a href="{{ route('sectionaltitling.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Back to List
                        </a>
                        
                        {{-- <a href="{{ route('generateSubBill', ['id' => $application->id]) }}" target="_blank" class="btn btn-primary">
                            <i class="fas fa-file-invoice-dollar mr-1"></i> Generate Bill
                        </a> --}}
                        
                        @if($application->application_status === 'Approved')
                        <a href="#" class="btn btn-success">
                            <i class="fas fa-certificate mr-1"></i> Certificate
                        </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
