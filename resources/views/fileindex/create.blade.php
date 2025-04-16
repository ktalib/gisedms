@extends('layouts.app')
@section('page-title')
    {{ __(' File Indexing Assistant') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __(' File Indexing Assistant') }}</li>
@endsection
@push('script-page')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#64748b',
                    }
                }
            }
        }
    </script>
@endpush

@section('content')
    <style>
           .tab {
        overflow: hidden;

    }

    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 10px 16px;
        transition: 0.3s;
        font-size: 14px;
    }

    .tab button:hover {
        background-color: #ddd;
    }

    .tab button.active {
        background-color: #ccc;
    }

    .tabcontent {
        display: none;
    }

    .tabcontent.active {
        display: block;
    }

          
    
    .transaction-section {
                            margin-bottom: 1.5rem;
                            padding: 1rem;
                            border: 1px solid #e5e7eb;
                            border-radius: 0.5rem;
                            background-color: #f9fafb;
                            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
                        }
                        .transaction-section h3 {
                            font-size: 1rem;
                            font-weight: 600;
                            color: #374151;
                            margin-bottom: 0.75rem;
                            padding-bottom: 0.5rem;
                            border-bottom: 1px solid #e5e7eb;
                        }
                        .transaction-checkbox {
                            display: flex;
                            align-items: center;
                            margin-bottom: 0.75rem;
                        }
                        .transaction-checkbox input[type="checkbox"] {
                            height: 1rem;
                            width: 1rem;
                            margin-right: 0.5rem;
                        }
    </style>

    <div class="container mx-auto mt-4 p-4">






        <div class="bg-white rounded-lg shadow-lg w-full   overflow-hidden">
            <!-- Progress Bar -->
            <div class="px-8 pt-8">
                <div class="flex justify-between mb-6">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold step-indicator"
                            data-step="1">1</div>
                        <span class="text-sm mt-2">Indexing</span>
                    </div>
                    <div class="flex-1 flex items-center mx-4">
                        <div class="h-1 w-full bg-gray-200 step-line">
                            <div class="h-1 bg-emerald-500 step-line-progress" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step-indicator"
                            data-step="2">2</div>
                        <span class="text-sm mt-2">Certificate of Occupancy</span>
                    </div>
                    <div class="flex-1 flex items-center mx-4">
                        <div class="h-1 w-full bg-gray-200 step-line">
                            <div class="h-1 bg-emerald-500 step-line-progress" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step-indicator"
                            data-step="3">3</div>
                        <span class="text-sm mt-2">Property Transaction</span>
                    </div>
                    <div class="flex-1 flex items-center mx-4">
                        <div class="h-1 w-full bg-gray-200 step-line">
                            <div class="h-1 bg-emerald-500 step-line-progress" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step-indicator"
                            data-step="4">4</div>
                        <span class="text-sm mt-2">Search and Filter</span>
                    </div>
                </div>
            </div>

            <!-- Form Steps -->
            <form id="wizard-form" class="p-8">
                <!-- Step 1:File Indexing -->
                <div class="step-content" data-step="1">
                    <h2 class="text-2xl font-bold mb-6">File Indexing Details</h2>
                    
                    <div class="bg-white p-6 rounded-lg border border-gray-200 mb-6 shadow-sm">
                        <label class="text-sm font-medium text-gray-700 mb-2 block">File Number</label>

                        <!-- Modern tab navigation -->
                        <div class="tab flex mb-4 border-b border-gray-200">
                            <button type="button"
                                class="tablinks active px-4 py-2 text-sm font-medium border-b-2 border-emerald-500 text-emerald-600"
                                onclick="openFileTab(event, 'mlsFNo')">MLS</button>
                            <button type="button"
                                class="tablinks px-4 py-2 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                onclick="openFileTab(event, 'kangisFileNo')">KANGIS</button>
                            <button type="button"
                                class="tablinks px-4 py-2 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                                onclick="openFileTab(event, 'NewKANGISFileno')">New KANGIS</button>
                        </div>

                        <!-- Streamlined tab content -->
                        <div>
                            <!-- MLS File Number Tab -->
                            <div id="mlsFNo" class="tabcontent active">
                                <div class="grid grid-cols-3 gap-2">
                                    <div>
                                        <select class="w-full px-2 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm" 
                                            id="mlsFileNoPrefix" name="mlsFileNoPrefix">
                                            <option value="">Select Prefix</option>
                                            @foreach (['COM', 'RES', 'CON-COM', 'CON-RES', 'CON-AG', 'CON-IND'] as $prefix)
                                                <option value="{{ $prefix }}">{{ $prefix }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-xs text-gray-500 mt-1">File prefix</p>
                                    </div>
                                    <div>
                                        <input type="text" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm" 
                                            id="mlsFileNumber" name="mlsFileNumber" 
                                            placeholder="e.g. 2022-572" value="{{ isset($result) ? ($result->mlsFileNumber ?: '') : '' }}">
                                        <p class="text-xs text-gray-500 mt-1">File number</p>
                                    </div>
                                    <div>
                                        <input type="text" 
                                            class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-600 font-medium" 
                                            id="mlsPreviewFileNumber" name="mlsPreviewFileNumber"
                                            value="{{ isset($result) ? ($result->mlsFNo ?: '') : '' }}" readonly>
                                        <p class="text-xs text-gray-500 mt-1">Complete file ID</p>
                                    </div>
                                </div>
                            </div>

                            <!-- KANGIS File Number Tab -->
                            <div id="kangisFileNo" class="tabcontent">
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm" 
                                            id="kangisFileNoPrefix" name="kangisFileNoPrefix">
                                            <option value="">Select Prefix</option>
                                            @foreach (['KNML', 'MNKL', 'MLKN', 'KNGP'] as $prefix)
                                                <option value="{{ $prefix }}">{{ $prefix }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-xs text-gray-500 mt-1">File prefix</p>
                                    </div>
                                    <div>
                                        <input type="text" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm" 
                                            id="kangisFileNumber" name="kangisFileNumber" 
                                            placeholder="e.g. 04367" value="{{ isset($result) ? ($result->kangisFileNumber ?: '') : '' }}">
                                        <p class="text-xs text-gray-500 mt-1">File number</p>
                                    </div>
                                    <div>
                                        <input type="text" 
                                            class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-600 font-medium" 
                                            id="kangisPreviewFileNumber" name="kangisPreviewFileNumber"
                                            value="{{ isset($result) ? ($result->kangisFileNo ?: '') : '' }}" readonly>
                                        <p class="text-xs text-gray-500 mt-1">Complete file ID</p>
                                    </div>
                                </div>
                            </div>

                            <!-- New KANGIS File Number Tab -->
                            <div id="NewKANGISFileno" class="tabcontent">
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm" 
                                            id="newKangisFileNoPrefix" name="newKangisFileNoPrefix">
                                            <option value="">Select Prefix</option>
                                            <option value="KN">KN</option>
                                        </select>
                                        <p class="text-xs text-gray-500 mt-1">File prefix</p>
                                    </div>
                                    <div>
                                        <input type="text" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-sm" 
                                            id="newKangisFileNumber" name="newKangisFileNumber" 
                                            placeholder="e.g. 1586" value="{{ isset($result) ? ($result->newKangisFileNumber ?: '') : '' }}">
                                        <p class="text-xs text-gray-500 mt-1">File number</p>
                                    </div>
                                    <div>
                                        <input type="text" 
                                            class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm text-gray-600 font-medium" 
                                            id="newKangisPreviewFileNumber" name="newKangisPreviewFileNumber"
                                            value="{{ isset($result) ? ($result->NewKANGISFileno ?: '') : '' }}" readonly>
                                        <p class="text-xs text-gray-500 mt-1">Complete file ID</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <!-- Row 1 -->
                            <div>
                                <label for="fileTitle" class="block text-sm font-medium text-gray-700 mb-1">File Title</label>
                                <input type="text" id="fileTitle" name="fileTitle" placeholder="Enter File Title"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            </div>
                            <div>
                                <label for="otherFileNo" class="block text-sm font-medium text-gray-700 mb-1">Other File No</label>
                                <input type="text" id="otherFileNo" name="otherFileNo" placeholder="Enter Other File No"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            </div>
                            <div>
                                <label for="otherFileNo1" class="block text-sm font-medium text-gray-700 mb-1">Additional File No</label>
                                <input type="text" id="otherFileNo1" name="otherFileNo1" placeholder="Enter Additional File No"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            </div>

                            <!-- Row 2 -->
                            <div>
                                <label for="batchNo" class="block text-sm font-medium text-gray-700 mb-1">Batch No</label>
                                <input type="text" id="batchNo" name="batchNo" placeholder="Enter Batch No"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            </div>
                            <div>
                                <label for="plotNo" class="block text-sm font-medium text-gray-700 mb-1">Plot No</label>
                                <input type="text" id="plotNo" name="plotNo" placeholder="Enter Plot No"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            </div>
                            <div>
                                <label for="fileLease" class="block text-sm font-medium text-gray-700 mb-1">File Lease</label>
                                <input type="text" id="fileLease" name="fileLease" placeholder="Enter File Lease"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-center">
                                <input type="checkbox" id="fileCoOwned" name="fileCoOwned"
                                    class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                                <label for="fileCoOwned" class="text-sm text-gray-700">File Co-Owned</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="fileHasTransaction" name="fileHasTransaction"
                                    class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                                <label for="fileHasTransaction" class="text-sm text-gray-700">File Has Transaction</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="fileHasCertificateOfOccupancy"
                                    name="fileHasCertificateOfOccupancy"
                                    class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2"
                                    checked>
                                <label for="fileHasCertificateOfOccupancy" class="text-sm text-gray-700">File Has Certificate
                                    of Occupancy</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="fileMerged" name="fileMerged"
                                    class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                                <label for="fileMerged" class="text-sm text-gray-700">File Merged</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="fileSubdivided" name="fileSubdivided"
                                    class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                                <label for="fileSubdivided" class="text-sm text-gray-700">File Subdivided</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Certificate of Occupancy -->
                <div class="step-content hidden" data-step="2">
                    <h2 class="text-2xl font-bold mb-6">Certificate of Occupancy</h2>
                    
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6 shadow-sm">
                        <div class="grid grid-cols-3 gap-4">
                            <!-- Certificate of Occupancy Radio Buttons -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Certificate of Occupancy</label>
                                <div class="flex items-center">
                                    <input type="radio" name="occupancy" value="Yes" checked
                                        class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                                    <span class="text-sm mr-4">Yes</span>
                                    <input type="radio" name="occupancy" value="No"
                                        class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                                    <span class="text-sm">No</span>
                                </div>
                            </div>

                            <!-- Empty placeholder columns -->
                            <div></div>
                            <div></div>
                            
                            <!-- Serial Number -->
                            <div>
                                <label for="oldTitleSerialNo" class="block text-sm font-medium text-gray-700 mb-1">Serial No</label>
                                <input type="text" id="oldTitleSerialNo" name="oldTitleSerialNo"
                                    placeholder="Enter Serial No"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>

                            <!-- Page Number -->
                            <div>
                                <label for="oldTitlePageNo" class="block text-sm font-medium text-gray-700 mb-1">Page No</label>
                                <input type="text" id="oldTitlePageNo" name="oldTitlePageNo" 
                                    placeholder="Enter Page No"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                            
                            <!-- Volume Number -->
                            <div>
                                <label for="oldTitleVolumeNo" class="block text-sm font-medium text-gray-700 mb-1">Vol No</label>
                                <input type="text" id="oldTitleVolumeNo" name="oldTitleVolumeNo"
                                    placeholder="Enter Volume No"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                            
                            <!-- Land Use Type -->
                            <div>
                                <label for="landUse" class="block text-sm font-medium text-gray-700 mb-1">Landuse Type</label>
                                <input type="text" id="landUse" name="landUse" 
                                    placeholder="Enter Landuse Type"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                            
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" id="title" name="title" 
                                    placeholder="Enter Title"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>

                            <!-- Plot Description -->
                            <div>
                                <label for="plotDescription" class="block text-sm font-medium text-gray-700 mb-1">Plot Description</label>
                                <input type="text" id="plotDescription" name="plotDescription"
                                    placeholder="Enter Plot Description"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>

                            <!-- Ground Rent -->
                            <div>
                                <label for="groundRent" class="block text-sm font-medium text-gray-700 mb-1">Ground Rent</label>
                                <input type="text" id="groundRent" name="groundRent" 
                                    placeholder="Enter Ground Rent"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>

                            <!-- Registration Date -->
                            <div>
                                <label for="deedsDate" class="block text-sm font-medium text-gray-700 mb-1">Reg. Date</label>
                                <input type="text" id="deedsDate" name="deedsDate" 
                                    placeholder="Enter Registration Date"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>

                            <!-- Tenancy -->
                            <div>
                                <label for="tenancy" class="block text-sm font-medium text-gray-700 mb-1">Tenancy</label>
                                <input type="text" id="tenancy" name="tenancy" 
                                    placeholder="Enter Tenancy"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Property Transaction -->
                <div class="step-content hidden" data-step="3">
                    <h2 class="text-2xl font-bold mb-6">Property Transaction</h2>
                    
           
                    <!-- Grant/Lease Section -->
                    <div class="transaction-section">
                        <div >
               
                            <div class="flex">
                                <input type="checkbox" name="customer" value="Customer" class="mr-2">
                                <span>Customer</span>
                            </div>
                        </div>
                        <div>
    
                            <div class="flex">
                                <input type="checkbox" name="statutory" value="Statutory" class="mr-2">
                                <span>Statutory</span>
                            </div>
                        </div>
                                  <br>
                        <h3>Grant/Lease</h3>
                        <div class="transaction-checkbox">
                            <input type="checkbox" name="grantLease" id="grantLease" class="mr-2" 
                                   onchange="toggleGrantLeaseInputs(this)">
                            <label for="grantLease" class="text-sm font-medium text-gray-700">Enable Grant/Lease</label>
                        </div>
                        
                        <div class="grid grid-cols-4 gap-4 mt-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Grantor</label>
                                <input type="text" name="grantor" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Grantor" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Grantee</label>
                                <input type="text" name="grantee"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Grantee" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="text" name="grantLeaseDate"  
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Date" disabled>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                                <input type="text" name="grantLeaseRegParticulars"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Registration Particulars" disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Section -->
                    <div class="transaction-section">
                        <h3>Assignment</h3>
                        <div class="transaction-checkbox">
                            <input type="checkbox" name="enableAssignment" id="enableAssignment" class="mr-2"
                                   onchange="toggleAssignmentInputs(this)">
                            <label for="enableAssignment" class="text-sm font-medium text-gray-700">Enable Assignment</label>
                        </div>
                        
                        <div class="grid grid-cols-4 gap-4 mt-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Assignment</label>
                                <input type="text" name="assignment" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Assignment">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="text" name="assignmentDate" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Date">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                                <input type="text" name="assignmentRegParticulars" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Registration Particulars">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Assignor</label>
                                <input type="text" name="assignorName" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Assignor Name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Assignee</label>
                                <input type="text" name="assignee" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Assignee">
                            </div>
                        </div>
                    </div>

                    <!-- Mortgage Section -->
                    <div class="transaction-section">
                        <h3>Mortgage</h3>
                        <div class="transaction-checkbox">
                            <input type="checkbox" name="enableMortgage" id="enableMortgage" class="mr-2"
                                   onchange="toggleMortgageInputs(this)">
                            <label for="enableMortgage" class="text-sm font-medium text-gray-700">Enable Mortgage</label>
                        </div>
                        
                        <div class="grid grid-cols-4 gap-4 mt-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mortgage</label>
                                <input type="text" name="mortgage" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Mortgage">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="text" name="mortgageDate" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Date">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                                <input type="text" name="mortgageRegParticulars" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Registration Particulars">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mortgagor</label>
                                <input type="text" name="mortgagor" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Mortgagor">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mortgagee</label>
                                <input type="text" name="mortgagee" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Mortgagee">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Third Party</label>
                                <input type="text" name="thirdParty" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Third Party">
                            </div>
                        </div>
                    </div>

                    <!-- Surrender Section -->
                    <div class="transaction-section">
                        <h3>Surrender</h3>
                        <div class="transaction-checkbox">
                            <input type="checkbox" name="enableSurrender" id="enableSurrender" class="mr-2"
                                   onchange="toggleSurrenderInputs(this)">
                            <label for="enableSurrender" class="text-sm font-medium text-gray-700">Enable Surrender</label>
                        </div>
                        
                        <div class="grid grid-cols-4 gap-4 mt-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Surrender</label>
                                <input type="text" name="surrender" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Surrender">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="text" name="surrenderDate" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Date">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                                <input type="text" name="surrenderRegParticulars" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Registration Particulars">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Surrenderor</label>
                                <input type="text" name="surrenderor" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Surrenderor">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Surrenderee</label>
                                <input type="text" name="surrenderee" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Surrenderee">
                            </div>
                        </div>
                    </div>

                    <!-- Sub-Lease Section -->
                    <div class="transaction-section">
                        <h3>Sub-Lease</h3>
                        <div class="transaction-checkbox">
                            <input type="checkbox" name="enableSubLease" id="enableSubLease" class="mr-2"
                                   onchange="toggleSubLeaseInputs(this)">
                            <label for="enableSubLease" class="text-sm font-medium text-gray-700">Enable Sub-Lease</label>
                        </div>
                        
                        <div class="grid grid-cols-4 gap-4 mt-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sub-Lease</label>
                                <input type="text" name="subLease" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Sub-Lease">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="text" name="subLeaseDate" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Date">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                                <input type="text" name="subLeaseRegParticulars" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Registration Particulars">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lessor</label>
                                <input type="text" name="lessor" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Lessor">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lessee</label>
                                <input type="text" name="lessee" disabled
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Lessee">
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Section -->
                    <div class="transaction-section">
                        {{-- <h3>Additional Information</h3> --}}
                        <div class="grid grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Instrument</label>
                                <input type="text" name="instrument"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                    placeholder="Enter Instrument">
                            </div>
                            <div class="col-span-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                                <div class="flex space-x-2">
                                    <input type="text" name="Period[]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="From">
                                    <input type="text" name="Period[]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="To">
                                    <input type="text" name="Period[]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Duration">
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function toggleAssignmentInputs(checkbox) {
                            const assignmentInputs = document.querySelectorAll('input[name="assignment"], input[name="assignmentDate"], input[name="assignmentRegParticulars"], input[name="assignorName"], input[name="assignee"]');
                            assignmentInputs.forEach(input => {
                                input.disabled = !checkbox.checked;
                            });
                        }

                        function toggleSurrenderInputs(checkbox) {
                            const surrenderInputs = document.querySelectorAll('input[name="surrender"], input[name="surrenderDate"], input[name="surrenderRegParticulars"], input[name="surrenderor"], input[name="surrenderee"]');
                            surrenderInputs.forEach(input => {
                                input.disabled = !checkbox.checked;
                            });
                        }

                        function toggleSubLeaseInputs(checkbox) {
                            const subLeaseInputs = document.querySelectorAll('input[name="subLease"], input[name="subLeaseDate"], input[name="subLeaseRegParticulars"], input[name="lessor"], input[name="lessee"]');
                            subLeaseInputs.forEach(input => {
                                input.disabled = !checkbox.checked;
                            });
                        }
                    </script>
                </div>

                <!-- Step 4: search and filrter -->
                <div class="step-content hidden" data-step="4">
                    <h2 class="text-2xl font-bold mb-6">Search and Filter</h2>
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="titleType" class="block text-sm font-medium text-gray-700 mb-1">Title
                                    Type</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableTitleType"
                                        onchange="toggleInput(this, 'titleType')" class="mr-2">
                                    <input type="text" id="titleType" name="titleType" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Title Type">
                                </div>
                            </div>
                            <div>
                                <label for="landUseType" class="block text-sm font-medium text-gray-700 mb-1">Land Use
                                    Type</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableLandUseType"
                                        onchange="toggleInput(this, 'landUseType')" class="mr-2">
                                    <input type="text" id="landUseType" name="landUseType" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Land Use Type">
                                </div>
                            </div>
                            <div>
                                <label for="lga" class="block text-sm font-medium text-gray-700 mb-1">LGA</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableLGA" onchange="toggleInput(this, 'lga')"
                                        class="mr-2">
                                    <input type="text" id="lga" name="lga" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="LGA">
                                </div>
                            </div>
                          
                            <div>
                                <label for="newKANGISFileNo" class="block text-sm font-medium text-gray-700 mb-1">New
                                    KANGIS File No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableNewKANGISFileNo"
                                        onchange="toggleInput(this, 'newKANGISFileNo')" class="mr-2">
                                    <input type="text" id="newKANGISFileNo" name="newKANGISFileNo" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="New KANGIS File No">
                                </div>
                            </div>
                            <div>
                                <label for="kagisFileNo" class="block text-sm font-medium text-gray-700 mb-1">KAGIS File
                                    No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableKAGISFileNo"
                                        onchange="toggleInput(this, 'kagisFileNo')" class="mr-2">
                                    <input type="text" id="kagisFileNo" name="kagisFileNo" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="KAGIS File No">
                                </div>
                            </div>
                            <div>
                                <label for="mlsFileNo" class="block text-sm font-medium text-gray-700 mb-1">MLS File
                                    No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableMLSFileNo"
                                        onchange="toggleInput(this, 'mlsFileNo')" class="mr-2">
                                    <input type="text" id="mlsFileNo" name="mlsFileNo" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="MLS File No">
                                </div>
                            </div>
                            <div>
                                <label for="categoryCode" class="block text-sm font-medium text-gray-700 mb-1">Category
                                    Code</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableCategoryCode"
                                        onchange="toggleInput(this, 'categoryCode')" class="mr-2">
                                    <input type="text" id="categoryCode" name="categoryCode" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Category Code">
                                </div>
                            </div>
                            <div>
                                <label for="batchNo2" class="block text-sm font-medium text-gray-700 mb-1">Batch
                                    No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableBatchNumber"
                                        onchange="toggleInput(this, 'batchNo2')" class="mr-2">
                                    <input type="text" id="batchNo2" name="batchNo2" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Batch No">
                                </div>
                            </div>
                            <div>
                                <label for="plotNo2" class="block text-sm font-medium text-gray-700 mb-1">Plot No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enablePlotNum" onchange="toggleInput(this, 'plotNo2')"
                                        class="mr-2">
                                    <input type="text" id="plotNo2" name="plotNo2" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Plot No">
                                </div>
                            </div>
                            <div>
                                <label for="typeForm2" class="block text-sm font-medium text-gray-700 mb-1">Type
                                    Form</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableTypeForm"
                                        onchange="toggleInput(this, 'typeForm2')" class="mr-2">
                                    <input type="text" id="typeForm2" name="typeForm2" disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500"
                                        placeholder="Type Form">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button type="button" id="prevBtn"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 hidden">Previous</button>
                    <div class="flex-1"></div>
                    <button type="button" id="nextBtn"
                        class="px-6 py-2 bg-emerald-500 text-white rounded-md hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500">Next
                        Step</button>
                    <button type="submit" id="submitBtn"
                        class="px-6 py-2 bg-emerald-500 text-white rounded-md hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 hidden">Submit</button>
                </div>
            </form>
        </div>










    </div>
    <script>
        function toggleGrantLeaseInputs(checkbox) {
            const inputs = [
                document.querySelector('input[name="grantor"]'),
                document.querySelector('input[name="grantee"]'),
                document.querySelector('input[name="grantLeaseDate"]'),
                document.querySelector('input[name="grantLeaseRegParticulars"]')
            ];
            
            inputs.forEach(input => {
                input.disabled = !checkbox.checked;
            });
        }

        function toggleMortgageInputs(checkbox) {
                                const mortgageInputs = document.querySelectorAll('input[name="mortgage"], input[name="mortgageDate"], input[name="mortgageRegParticulars"], input[name="mortgagor"], input[name="mortgagee"], input[name="thirdParty"]');
                                mortgageInputs.forEach(input => {
                                    input.disabled = !checkbox.checked;
                                });
                            }
        </script>
        
    @include('filescanning.filenumber_js')
    @include('fileindex.ajax');
@endsection
