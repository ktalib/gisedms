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
        /* .form-input,
        .form-select {
            border: 1px solid #cbd5e1;
            background-color: #fff;
            height: 2.5rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
            padding: 0 0.5rem;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .nav-button {
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .nav-button:hover {
            background-color: #e2e8f0;
        }

        .table-header {
            background-color: #f1f5f9;
            font-weight: 500;
            text-align: left;
            padding: 0.5rem;
            border: 1px solid #cbd5e1;
        }

        .table-cell {
            border: 1px solid #e2e8f0;
            padding: 0.5rem;
        }

        .highlighted-row {
            background-color: #3b82f6;
            color: white;
        }

        .material-icons {
            font-size: 18px;
        } */
    </style>

    <div class="container mx-auto mt-4 p-4">






        <div class="bg-white rounded-lg shadow-lg w-full   overflow-hidden">
            <!-- Progress Bar -->
            <div class="px-8 pt-8">
                <div class="flex justify-between mb-6">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold step-indicator" data-step="1">1</div>
                        <span class="text-sm mt-2">Indexing</span>
                    </div>
                    <div class="flex-1 flex items-center mx-4">
                        <div class="h-1 w-full bg-gray-200 step-line">
                            <div class="h-1 bg-emerald-500 step-line-progress" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step-indicator" data-step="2">2</div>
                        <span class="text-sm mt-2">Certificate of Occupancy</span>
                    </div>
                    <div class="flex-1 flex items-center mx-4">
                        <div class="h-1 w-full bg-gray-200 step-line">
                            <div class="h-1 bg-emerald-500 step-line-progress" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step-indicator" data-step="3">3</div>
                        <span class="text-sm mt-2">Property Transaction</span>
                    </div>
                    <div class="flex-1 flex items-center mx-4">
                        <div class="h-1 w-full bg-gray-200 step-line">
                            <div class="h-1 bg-emerald-500 step-line-progress" style="width: 0%"></div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold step-indicator" data-step="4">4</div>
                        <span class="text-sm mt-2">Search and Filter</span>
                    </div>
                </div>
            </div>
    
            <!-- Form Steps -->
            <form id="wizard-form" class="p-8">
                <!-- Step 1: Personal Information -->
                <div class="step-content" data-step="1">
                    <h2 class="text-2xl font-bold mb-6">File Indexing Details</h2>
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Row 1 -->
                        <div>
                            <label for="fileTitle" class="block text-sm font-medium text-gray-700 mb-1">File Title</label>
                            <input type="text" id="fileTitle" name="fileTitle" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label for="locationTitle" class="block text-sm font-medium text-gray-700 mb-1">Location Title</label>
                            <select id="locationTitle" name="locationTitle" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <option>Select Location Title</option>
                            </select>
                        </div>
                        <div>
                            <label for="otherFileNo" class="block text-sm font-medium text-gray-700 mb-1">Other File No</label>
                            <input type="text" id="otherFileNo" name="otherFileNo" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        
                        <!-- Row 2 -->
                        <div>
                            <label for="otherFileNo1" class="block text-sm font-medium text-gray-700 mb-1">Other File No (Additional)</label>
                            <input type="text" id="otherFileNo1" name="otherFileNo1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label for="batchNo" class="block text-sm font-medium text-gray-700 mb-1">Batch No</label>
                            <input type="text" id="batchNo" name="batchNo" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Batch No">
                        </div>
                        <div>
                            <label for="plotNo" class="block text-sm font-medium text-gray-700 mb-1">Plot No</label>
                            <input type="text" id="plotNo" name="plotNo" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Plot No">
                        </div>
                  
                           
                        
                        <div>
                            <label for="fileCategory" class="block text-sm font-medium text-gray-700 mb-1">File Category</label>
                            <div class="flex items-center">
                                <input type="checkbox" id="fileCategoryCheckbox" name="fileCategoryCheckbox" class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded ">
                                <select id="fileCategorySelect" name="fileCategorySelect" class="ml-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                    <option>Select File Category</option>
                                </select>
                            </div>
                        </div>
    
                        <div>
                            <label for="fileSubCategory" class="block text-sm font-medium text-gray-700 mb-1">Sub-Category</label>
                            <div class="flex items-center">
                                <input type="checkbox" id="fileSubCategoryCheckbox" name="fileSubCategoryCheckbox" class="text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded">
                                <select id="fileSubCategorySelect" name="fileSubCategorySelect" class="ml-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                    <option>Select Sub-Category</option>
                                </select>
                            </div>
                        </div>
    
                        <div>
                            <label for="fileLease" class="block text-sm font-medium text-gray-700 mb-1">File Lease</label>
                            <input type="text" id="fileLease" name="fileLease" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        
                        <!-- Row 3 - File Category and Sub-Category -->
                        <div>
                            <div class="flex items-center mb-1"></div>
                        </div>
                        <div>
                            <!-- Empty field for future use -->
                        </div>
                        <div>
                            <!-- Empty field for future use -->
                        </div>
                    </div>
    
              
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="fileCoOwned" name="fileCoOwned" class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                            <label for="fileCoOwned" class="text-sm text-gray-700">File Co-Owned</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="fileHasTransaction" name="fileHasTransaction" class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                            <label for="fileHasTransaction" class="text-sm text-gray-700">File Has Transaction</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="fileHasCertificateOfOccupancy" name="fileHasCertificateOfOccupancy" class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2" checked>
                            <label for="fileHasCertificateOfOccupancy" class="text-sm text-gray-700">File Has Certificate of Occupancy</label>
                        </div>
       
                        <div class="flex items-center">
                            <input type="checkbox" id="fileMerged" name="fileMerged" class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                            <label for="fileMerged" class="text-sm text-gray-700">File Merged</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="fileSubdivided" name="fileSubdivided" class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                            <label for="fileSubdivided" class="text-sm text-gray-700">File Subdivided</label>
                        </div>
                    </div>
    
            
                </div>
    
                <!-- Step 2: Contact Details -->
                <div class="step-content hidden" data-step="2">
                    <h2 class="text-2xl font-bold mb-6">Certificate of Occupancy</h2>
                    <div class="grid grid-cols-3 gap-4">
                        <!-- File Lease -->
                        
    
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Certificate of Occupancy</label>
                            <div class="flex items-center">
                                <input type="radio" name="occupancy" value="Yes" checked class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                                <span class="text-sm mr-4">Yes</span>
                                <input type="radio" name="occupancy" value="No" class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded mr-2">
                                <span class="text-sm">No</span>
                            </div>
                        </div>
    
                        <div>
                            <label for="fileLease" class="block text-sm font-medium text-gray-700">File Lease</label>
                            <input type="text" id="fileLease" name="fileLease" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div></div>
                      
                        <div>
                            <label for="oldTitleSerialNo" class="block text-sm font-medium text-gray-700 mb-1">Serial No</label>
                            <input type="text" id="oldTitleSerialNo" name="oldTitleSerialNo" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                       
    
                        <div>
                            <label for="oldTitlePageNo" class="block text-sm font-medium text-gray-700 mb-1">Page No</label>
                            <input type="text" id="oldTitlePageNo" name="oldTitlePageNo" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label for="oldTitleVolumeNo" class="block text-sm font-medium text-gray-700 mb-1">Vol No</label>
                            <input type="text" id="oldTitleVolumeNo" name="oldTitleVolumeNo" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label for="landUse" class="block text-sm font-medium text-gray-700 mb-1">Landuse Type</label>
                            <input type="text" id="landUse" name="landUse" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" id="title" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        
    
                        <div>
                            <label for="plotDescription" class="block text-sm font-medium text-gray-700 mb-1">Plot Description</label>
                            <input type="text" id="plotDescription" name="plotDescription" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <div>
                            <label for="groundRent" class="block text-sm font-medium text-gray-700 mb-1">Ground Rent</label>
                            <input type="text" id="groundRent" name="groundRent" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <div>
                            <label for="deedsDate" class="block text-sm font-medium text-gray-700 mb-1">Reg. Date</label>
                            <input type="text" id="deedsDate" name="deedsDate" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <div>
                            <label for="tenancy" class="block text-sm font-medium text-gray-700 mb-1">Tenancy</label>
                            <input type="text" id="tenancy" name="tenancy" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <div class="col-span-3 text-center">
                            <button type="button" id="saveCofOBtn" class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                <span class="material-icons mr-1" style="font-size: 14px;">save</span>
                                Save CofO
                            </button>
                        </div>
                    </div>
                </div>
    
                <!-- Step 3: Property Transaction -->
                <div class="step-content hidden" data-step="3">
                    <h2 class="text-2xl font-bold mb-6">Property Transaction</h2>
                    <div class="grid grid-cols-4 gap-4">
                        <!-- Row 1 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                            <div class="flex">
                                <input type="checkbox" name="customer" value="Customer" class="mr-2">
                                <span>Customer</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Statutory</label>
                            <div class="flex">
                                <input type="checkbox" name="statutory" value="Statutory" class="mr-2">
                                <span>Statutory</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Grant/Lease</label>
                            <div class="flex">
                                <input type="checkbox" checked name="grantLease" value="grantLease" class="mr-2">
                                <span>Grant/Lease</span>
                            </div>
                        </div>
                    <dvi></dvi>
                        <!-- Row 2 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Grantor</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="enableGrantor" onchange="toggleInput(this, 'grantor')" class="mr-2">
                                <input type="text" name="grantor" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Grantee</label>
                            <input type="text" name="grantee" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                      
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="enableAssignment" onchange="toggleInput(this, 'assignment')" class="mr-2">
                                <input type="text" name="assignment" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                        </div>
    
    
    
    
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="enableAssignment" onchange="toggleInput(this, 'assignment')" class="mr-2">
                                <input type="text" name="assignment" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                        </div>
    
                        <!-- Row 3 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assignment</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="enableAssignment" onchange="toggleInput(this, 'assignment')" class="mr-2">
                                <input type="text" name="assignment" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="text" name="assignmentDate" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                            <input type="text" name="assignmentRegParticulars" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assignor</label>
                            <input type="text" name="assignorName" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <!-- Row 4 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assignee</label>
                            <input type="text" name="assignee" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div></div> <div></div> <div></div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mortgage</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="enableMortgage" onchange="toggleInput(this, 'mortgage')" class="mr-2">
                                <input type="text" name="mortgage" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="text" name="mortgageDate" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <!-- Row 5 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                            <input type="text" name="mortgageRegParticulars" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mortgagor</label>
                            <input type="text" name="mortgagor" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mortgagee</label>
                            <input type="text" name="mortgagee" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <!-- Row 6 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Third Party</label>
                            <input type="text" name="thirdParty" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <div></div><div></div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surrender</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="enableSurrenderor" onchange="toggleInput(this, 'surrenderor')" class="mr-2">
                                <input type="text" name="surrenderor" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="text" name="surrenderDate" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <!-- Row 7 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                            <input type="text" name="surrenderRegParticulars" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surrenderor</label>
                            <input type="text" name="surrenderor" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surrenderee</label>
                            <input type="text" name="surrenderee" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div></div> <div></div> <div></div>
                        <!-- Row 8 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sub-Lease</label>
                            <div class="flex items-center">
                                <input type="checkbox" name="enableSubLease" onchange="toggleInput(this, 'subLease')" class="mr-2">
                                <input type="text" name="subLease" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="text" name="subLeaseDate" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Reg Particulars</label>
                            <input type="text" name="subLeaseRegParticulars" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <!-- Row 9 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Lessor</label>
                            <input type="text" name="lessor" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Lessee</label>
                            <input type="text" name="lessor" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Instrument</label>
                            <input type="text" name="instrument" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
    
                        <!-- Row 10 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                            <div class="flex">
                                <input type="text" name="Period[]" class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <input type="text" name="Period[]" class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                <input type="text" name="Period[]" class="w-1/3 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            </div>
                        </div>
                        <div></div>
                        <div></div>
                    </div>
    
                    <!-- <div class="text-center mt-4">
                        <button type="button" id="savePropertyTransactionBtn" class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <span>save</span>
                            Save Transaction
                        </button>
                    </div> -->
                </div>
    
                <!-- Step 4: search and filrter -->
                <div class="step-content hidden" data-step="4">
                    <h2 class="text-2xl font-bold mb-6">Search and Filter</h2>
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="titleType" class="block text-sm font-medium text-gray-700 mb-1">Title Type</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableTitleType" onchange="toggleInput(this, 'titleType')" class="mr-2">
                                    <input type="text" id="titleType" name="titleType" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Title Type">
                                </div>
                            </div>
                            <div>
                                <label for="landUseType" class="block text-sm font-medium text-gray-700 mb-1">Land Use Type</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableLandUseType" onchange="toggleInput(this, 'landUseType')" class="mr-2">
                                    <input type="text" id="landUseType" name="landUseType" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Land Use Type">
                                </div>
                            </div>
                            <div>
                                <label for="lga" class="block text-sm font-medium text-gray-700 mb-1">LGA</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableLGA" onchange="toggleInput(this, 'lga')" class="mr-2">
                                    <input type="text" id="lga" name="lga" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="LGA">
                                </div>
                            </div>
                            <div>
                                <label for="categoryCode" class="block text-sm font-medium text-gray-700 mb-1">Category Code</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableCategoryCode" onchange="toggleInput(this, 'categoryCode')" class="mr-2">
                                    <input type="text" id="categoryCode" name="categoryCode" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Category Code">
                                </div>
                            </div>
                            <div>
                                <label for="newKANGISFileNo" class="block text-sm font-medium text-gray-700 mb-1">New KANGIS File No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableNewKANGISFileNo" onchange="toggleInput(this, 'newKANGISFileNo')" class="mr-2">
                                    <input type="text" id="newKANGISFileNo" name="newKANGISFileNo" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="New KANGIS File No">
                                </div>
                            </div>
                            <div>
                                <label for="kagisFileNo" class="block text-sm font-medium text-gray-700 mb-1">KAGIS File No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableKAGISFileNo" onchange="toggleInput(this, 'kagisFileNo')" class="mr-2">
                                    <input type="text" id="kagisFileNo" name="kagisFileNo" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="KAGIS File No">
                                </div>
                            </div>
                            <div>
                                <label for="mlsFileNo" class="block text-sm font-medium text-gray-700 mb-1">MLS File No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableMLSFileNo" onchange="toggleInput(this, 'mlsFileNo')" class="mr-2">
                                    <input type="text" id="mlsFileNo" name="mlsFileNo" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="MLS File No">
                                </div>
                            </div>
                            <div>
                                <label for="batchNo2" class="block text-sm font-medium text-gray-700 mb-1">Batch No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableBatchNumber" onchange="toggleInput(this, 'batchNo2')" class="mr-2">
                                    <input type="text" id="batchNo2" name="batchNo2" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Batch No">
                                </div>
                            </div>
                            <div>
                                <label for="plotNo2" class="block text-sm font-medium text-gray-700 mb-1">Plot No</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enablePlotNum" onchange="toggleInput(this, 'plotNo2')" class="mr-2">
                                    <input type="text" id="plotNo2" name="plotNo2" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Plot No">
                                </div>
                            </div>
                            <div>
                                <label for="typeForm2" class="block text-sm font-medium text-gray-700 mb-1">Type Form</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="enableTypeForm" onchange="toggleInput(this, 'typeForm2')" class="mr-2">
                                    <input type="text" id="typeForm2" name="typeForm2" disabled class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Type Form">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button type="button" id="prevBtn" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 hidden">Previous</button>
                    <div class="flex-1"></div>
                    <button type="button" id="nextBtn" class="px-6 py-2 bg-emerald-500 text-white rounded-md hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500">Next Step</button>
                    <button type="submit" id="submitBtn" class="px-6 py-2 bg-emerald-500 text-white rounded-md hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 hidden">Submit</button>
                </div>
            </form>
        </div>










    </div>

    @include('fileindex.ajax');
@endsection
