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
body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }
        .form-input, .form-select {
            border: 1px solid #cbd5e1;
            background-color: #fff;
            height: 2rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
            padding: 0 0.5rem;
        }
        .form-input:focus, .form-select:focus {
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
        }
    </style>

    <div class="container mx-auto mt-4 p-4">

        <div class="container">
            <form id="fileIndexForm">
                @csrf
                <div class="max-w-6xl mx-auto bg-white border border-gray-200 shadow-lg rounded-md overflow-hidden">
                    <!-- Header -->
                    <div class="flex items-center bg-gradient-to-r from-primary to-blue-400 p-2 text-white shadow-md">
                        <div class="flex items-center">
                            <span class="material-icons mr-2">description</span>
                            <span class="text-sm font-bold">File Indexing Assistant</span>
                        </div>
                        <div class="ml-auto">
                            <button class="text-white hover:bg-blue-600 p-1 rounded">
                                <span class="material-icons">close</span>
                            </button>
                        </div>
                    </div>
            
                    <!-- Navigation Buttons -->
                    <div class="flex p-2 bg-white border-b border-gray-200 shadow-sm">
                        <button class="nav-button mr-1" title="Previous">
                            <span class="material-icons">arrow_back</span>
                        </button>
                        <button class="nav-button mr-1" title="Next">
                            <span class="material-icons">arrow_forward</span>
                        </button>
                       <!--  <button class="nav-button mr-1" title="Up">
                            <span class="material-icons">arrow_upward</span>
                        </button>
                        <button class="nav-button mr-1" title="Down">
                            <span class="material-icons">arrow_downward</span>
                        </button> -->
                        <button class="nav-button mr-1" title="Refresh">
                            <span class="material-icons">refresh</span>
                        </button>
                        <button class="nav-button mr-1" title="Save">
                            <span class="material-icons">check</span>
                        </button>
                        <button class="nav-button mr-1" title="Cancel">
                            <span class="material-icons">close</span>
                        </button>
                        <button class="nav-button mr-1" title="Settings">
                            <span class="material-icons">settings</span>
                        </button>
                    </div>
            
                    <!-- Main Content -->
                    <div class="flex">
                        <!-- Left Column -->
                        <div class="w-1/2 p-2">
                            <!-- File Registry Details -->
                            <div class="mb-4 bg-white p-3 rounded-md shadow-sm">
                                <div class="text-sm font-bold mb-2 text-gray-700">File Registry Details</div>
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">FileNo:</div>
                                    <div class="w-3/4 grid grid-cols-3 gap-1">
                                        <select class="form-select p-2" id="fileNoPrefix" name="fileNoPrefix">
                                            <option value="">Select File Prefix</option>
                                            @foreach(['KNML', 'MNKL', 'KN', 'CON-COM', 'CON-RES', 'RES', 'MLKN', 'CON-AG', 'KNGP', 'CON-IND'] as $prefix)
                                                <option value="{{ $prefix }}" {{ (isset($result) && isset($result->fileNoPrefix) && $result->fileNoPrefix == $prefix) ? 'selected' : '' }}>
                                                    {{ $prefix }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-input p-2" id="fileNumber" name="fileNumber" 
                                              placeholder="Format example" 
                                              value="{{ isset($result) ? ($result->fileNumber ?: '') : '' }}">
                                        <input type="text" class="form-input p-2" id="Previewflenumber" name="Previewflenumber" value="{{ isset($result) ? ($result->kangisFileNo ?: '') : '' }}" readonly>
                                    </div>
                                </div>
                                                             
                               

                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">File Title:</div>
                                    <input type="text" name="fileTitle" value="INTERSTATE COMMERCE CENTER" class="form-input w-3/4 p-2">
                                </div>
                              
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">Location Title:</div>
                                    <select name="locationTitle" class="form-select w-3/4 p-2">
                                        <option>Masterfile</option>
                                    </select>
                                </div>
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">Other FileNo:</div>
                                    <div class="w-3/4 flex">
                                        <input type="text" name="otherFileNo"  class="form-input w-1/2 p-2">
                                    </div>
                                </div>
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">Other FileNo:</div>
                                    <div class="w-3/4 flex">
                                        <input type="text" name="otherFileNo1" value="9852" class="form-input w-1/4 mx-1 p-2">
                                        <input type="text" name="otherFileNo2" value="9852" class="form-input w-1/4 mx-1 p-2">
                                       
                                    </div>
                                </div> 
                                
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">Batch No:</div>
                                    <div class="w-3/4 flex">
                                        <input type="text" name="batchNo" class="form-input w-1/4 mx-1 p-2">
                                        <input type="text" name="plotNo" class="form-input w-1/4 mx-1 p-2" placeholder="Plot No:">
                                       
                                    </div>
                                </div>
                                
                            </div>
            
                            <!-- Checkboxes -->
                            <div class="grid grid-cols-2 gap-1 mb-2">
                                <div class="flex items-center">
                                    <input type="checkbox" name="fileCoOwned" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">File Co-Owned</span>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="fileHasTransaction" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">File Has Transaction</span>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" checked name="fileHasCertificateOfOccupancy" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">File Has Certificate of Occupancy</span>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="fileCategory" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">File Category</span>
                                    <select name="fileCategorySelect" class="form-select ml-1 w-1/2 p-2">
                                        <option>TAL</option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="fileSubCategory" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">File Sub-Category</span>
                                    <select name="fileSubCategorySelect" class="form-select ml-1 w-1/2 p-2">
                                        <option>Corporate North</option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="fileMerged" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">File Merged</span>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="fileSubdivided" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">File Subdivided</span>
                                </div>
                            </div>
             
            
                            <!-- File Lease -->
                            <div class="mb-2">
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">File Lease:</div>
                                    <input type="text" name="fileLease"   class="form-input w-3/4 p-2" readonly>
                                </div>
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">Certificate of Occupancy:</div>
                                    <div class="w-3/4 flex items-center">
                                        <input type="radio" name="occupancy" value="Yes" checked class="w-4 h-4 text-primary focus:ring-primary mr-2">
                                        <span class="text-sm mr-4">Yes</span>
                                        <input type="radio" name="occupancy" value="No" class="w-4 h-4 text-primary focus:ring-primary mr-2">
                                        <span class="text-sm">No</span>
                                    </div>
                                </div>
                            </div>
            
                            <!-- Registry Info -->
                            <div class="mb-2">
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">Serial No:</div>
                                    <input type="text" name="serialNo" class="form-input w-1/4 p-2">
                                    <div class="w-1/4 text-xs pl-4">Title:</div>
                                    <input type="text" name="title" class="form-input w-1/4 p-2">
                                </div>
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">Reg. Page:</div>
                                    <input type="text" name="regPage" class="form-input w-1/4 p-2">
                                    <div class="w-1/4 text-xs pl-4">Landuse Type:</div>
                                    <input type="text" name="landuseType" class="form-input w-1/4 p-2">
                                </div>
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">Covenant:</div>
                                    <input type="text" name="covenant" class="form-input w-1/4 p-2">
                                    <div class="w-1/4 text-xs pl-4">Plot Description:</div>
                                    <input type="text" name="plotDescription" class="form-input w-1/4 p-2">
                                </div>
                                <div class="flex mb-1">
                                    <div class="w-1/4 text-xs">Lease Period:</div>
                                    <input type="text" name="leasePeriod" class="form-input w-1/4 p-2">
                                    <div class="flex items-center w-1/4 pl-4">
                                        <span class="text-xs mr-2">year(s)</span>
                                        <span class="text-xs">Reg. Date:</span>
                                    </div>
                                    <input type="text" name="regDate" class="form-input w-1/4 p-2">
                                </div>
                                
                                <div >
                                    <button type="button" id="saveCofOBtn" class="bg-primary text-white px-3 py-1 rounded text-xs flex items-center">
                                        <span class="material-icons mr-1" style="font-size: 14px;">save</span>
                                        Save CofO
                                    </button>
                                </div>
                            </div>
                        </div>
            
                        <!-- Right Column -->
            
                        
                        <div class="w-1/2 p-2">
                            <!-- Property Tabs/Search -->
                             
                            <div class="grid grid-cols-2 gap-3 mb-4">
            
                                <div>
                                     
                                    <div class="flex items-center mt-1">
                                        <input type="checkbox" name="customer" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs">Customer</span>
                                    </div>
                                </div>
                                
                                <div>
                                    
                                    <div class="flex items-center mt-1">
                                        <input type="checkbox" name="statutory" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs">Statutory</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="text-xs font-bold">Property Transation</div>
                                    <div class="flex items-center mt-1">
                                        <input type="checkbox" checked name="grantLease" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs">Grant/Lease</span>
                                    </div>
                                </div>
            
            
                                <div>
                                    <div class="text-xs font-bold">Search Filter</div>
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="grantor" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Grantor</span>
                                    </div>
                                    <input type="text" name="grantorText" class="form-input w-1/2 p-2">
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="titleType" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">TitleType</span>
                                    </div>
                                    <input type="text" name="titleTypeText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                      
                                        <span class="text-xs w-24">Grantee</span>
                                    </div>
                                    <input type="text" name="grantee" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="landUseType" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Land use Type</span>
                                    </div>
                                    <input type="text" name="landUseTypeText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="assignment" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Assignment</span>
                                    </div>
                                    <input type="text" name="assignmentText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="lga" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">LGA</span>
                                    </div>
                                    <input type="text" name="lgaText" class="form-input w-1/2 p-2">
                                </div>
                            
                              
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="categoryCode" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Category Code</span>
                                    </div>
                                    <input type="text" name="categoryCodeText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        
                                        <span class="text-xs w-24">Assignor</span>
                                    </div>
                                    <input type="text" name="assignor" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="newKANGISFileNo" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">NewKANGISFileNo</span>
                                    </div>
                                    <input type="text" name="newKANGISFileNoText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        
                                        <span class="text-xs w-24">Assignee</span>
                                    </div>
                                    <input type="text" name="assignee" class="form-input w-1/2 p-2">
                                </div>
                                
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="kagisFileNo" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">KAGISFileNO</span>
                                    </div>
                                    <input type="text" name="kagisFileNoText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="mortgage" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Mortgage</span>
                                    </div>
                                    <input type="text" name="mortgageText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="mlsFileNo" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">MLSFileNo</span>
                                    </div>
                                    <input type="text" name="mlsFileNoText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                       
                                        <span class="text-xs w-24">Mortgagor</span>
                                    </div>
                                    <input type="text" name="mortgagor" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="batchNumber" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Batch #</span>
                                    </div>
                                    <input type="text" name="batchNumberText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        
                                        <span class="text-xs w-24">Mortgagee</span>
                                    </div>
                                    <input type="text" name="mortgagee" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="plotNum" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Plot No</span>
                                    </div>
                                    <input type="text" name="plotNumText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                       
                                        <span class="text-xs w-24">Third Party</span>
                                    </div>
                                    <input type="text" name="thirdParty" class="form-input w-1/2 p-2">
                                </div>  
                                
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="typeForm" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Type Form</span>
                                    </div>
                                    <input type="text" name="typeFormText" class="form-input w-1/2 p-2">
                                </div>
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="surrenderor" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Surrenderor</span>
                                    </div>
                                    <input type="text" name="surrenderorText" class="form-input w-1/2 p-2">
                                </div> 
                                
                                 
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                      
                                        <span class="text-xs w-24">Surrenderee</span>
                                    </div>
                                    <input type="text" name="surrenderee" class="form-input w-1/2 p-2">
                                </div>
                                
                             
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                        <input type="checkbox" name="subLease" class="text-primary focus:ring-primary rounded mr-2">
                                        <span class="text-xs w-24">Sub-Lease</span>
                                    </div>
                                    <input type="text" name="subLeaseText" class="form-input w-1/2 p-2">
                                </div>
                                
                            
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                       
                                        <span class="text-xs w-24">Lessor</span>
                                    </div>
                                    <input type="text" name="lessor" class="form-input w-1/2 p-2">
                                </div>
                                
                                 
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                       
                                        <span class="text-xs w-24">Instrument</span>
                                    </div>
                                    <input type="text" name="instrument" class="form-input w-1/2 p-2">
                                </div>
                                
                                
                                 
                                <div class="flex items-center">
                                    <div class="flex items-center w-1/2">
                                      
                                        <span class="text-xs w-24">Period</span>
                                    </div>
                                    <div class="flex w-1/2">
                                        <input type="text" name="periodStart" class="form-input w-1/3 p-2 mr-1">
                                        <input type="text" name="periodEnd" class="form-input w-1/3 p-2 mr-1">
                                        <input type="text" name="periodDuration" class="form-input w-1/3 p-2">
                                    </div>
                                </div>
            
                                <div >
                                     
                                </div>
                            </div>
                      
                            
            
            
                            <!-- Bottom Buttons -->
                            <div class="flex justify-between mt-4">
                                
                                <div class="flex">
                                     
                                    <button type="button" id="saveFormBtn" class="bg-primary text-white border border-primary p-2 rounded-md shadow-sm hover:bg-blue-600 flex items-center">
                                        <span class="material-icons mr-1">save</span>
                                        <span class="text-xs">Save</span>
                                    </button>
                                </div>
                            </div>
            
                            <!-- Bottom Icons -->
                            <div class="flex justify-end mt-2">
                                <button class="bg-white border border-gray-200 p-2 rounded-md shadow-sm hover:bg-gray-50 mx-1">
                                    <span class="material-icons text-red-500">picture_as_pdf</span>
                                </button>
                                <button class="bg-white border border-gray-200 p-2 rounded-md shadow-sm hover:bg-gray-50 mx-1">
                                    <span class="material-icons text-gray-700">settings</span>
                                </button>
                                <button class="bg-white border border-gray-200 p-2 rounded-md shadow-sm hover:bg-gray-50 mx-1">
                                    <span class="material-icons text-gray-700">print</span>
                                </button>
                                <button class="bg-white border border-gray-200 p-2 rounded-md shadow-sm hover:bg-gray-50 mx-1" title="Find File Cabin">
                                    <span class="material-icons text-blue-500">file_present</span>
                                </button>
                            </div>
                        </div>
            
            
            
                    </div>
            
                   
                   
                </div>
            </form>
        </div>
    </div>


    </div>

    <script>
        // File number preview update functionality
        function updateFileNumberPreview() {
            const prefixEl = document.getElementById('fileNoPrefix');
            const numberEl = document.getElementById('fileNumber');
            const previewEl = document.getElementById('Previewflenumber');

            const prefix = prefixEl.value;
            let number = numberEl.value.trim();
            
            // Set placeholder based on selected prefix
            if (prefix) {
                if (['KNML', 'MNKL', 'MLKN', 'KNGP'].includes(prefix)) {
                    numberEl.placeholder = "e.g. 00001";
                } else if (prefix === "KN") {
                    numberEl.placeholder = "e.g. 0001";
                } else if (['CON-COM', 'CON-RES', 'CON-AG', 'CON-IND', 'RES'].includes(prefix)) {
                    numberEl.placeholder = "e.g. 01";
                } else {
                    numberEl.placeholder = "Format example";
                }
            }
            
            // Format the number based on the prefix
            if (prefix && number) {
                if (['KNML', 'MNKL', 'MLKN', 'KNGP'].includes(prefix)) {
                    // Ensure 5-digit format with leading zeros
                    number = number.padStart(5, '0');
                    numberEl.value = number;
                    previewEl.value = prefix + ' ' + number;
                } else if (prefix === "KN") {
                    previewEl.value = prefix + number;
                } else if (['CON-COM', 'CON-RES', 'CON-AG', 'CON-IND', 'RES'].includes(prefix)) {
                    previewEl.value = prefix + '-' + number;
                } else {
                    previewEl.value = prefix + '/' + number;
                }
            } else if (prefix) {
                previewEl.value = prefix;
            } else if (number) {
                previewEl.value = number;
            } else {
                previewEl.value = '';
            }
            
            // Validation based on prefix
            let isValid = true;
            if (prefix === "KN") {
                isValid = /^\d+$/.test(number);
            } else if (["KNML", "MNKL", "MLKN", "KNGP"].includes(prefix)) {
                isValid = /^\d{5}$/.test(number);
            } else if (['CON-COM', 'CON-RES', 'CON-AG', 'CON-IND', 'RES'].includes(prefix)) {
                isValid = /^\d+$/.test(number);
            }

            if (prefix && number && isValid) {
                prefixEl.style.color = 'red';
                numberEl.style.color = 'red';
                previewEl.style.color = 'red';
            } else {
                prefixEl.style.color = '';
                numberEl.style.color = '';
                previewEl.style.color = '';
            }
        }

        // AJAX form submissions
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize file number preview
            updateFileNumberPreview();
            
            // Add event listeners for file number preview updates
            document.getElementById('fileNoPrefix').addEventListener('change', updateFileNumberPreview);
            document.getElementById('fileNumber').addEventListener('input', updateFileNumberPreview);
            
            // Save CofO button click handler
            document.getElementById('saveCofOBtn').addEventListener('click', function(e) {
                e.preventDefault();
                
                const formData = new FormData(document.getElementById('fileIndexForm'));
                
                // Display loading indicator
                Swal.fire({
                    title: 'Saving...',
                    text: 'Please wait while we save the Certificate of Occupancy data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Send AJAX request
                fetch('{{ route("fileindex.save-cofo") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            confirmButtonColor: '#3b82f6'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message,
                            confirmButtonColor: '#3b82f6'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An unexpected error occurred. Please try again.',
                        confirmButtonColor: '#3b82f6'
                    });
                });
            });
            
            // Main Save button click handler
            document.getElementById('saveFormBtn').addEventListener('click', function(e) {
                e.preventDefault();
                
                const formData = new FormData(document.getElementById('fileIndexForm'));
                
                // Display loading indicator
                Swal.fire({
                    title: 'Saving...',
                    text: 'Please wait while we save the form data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Send AJAX request
                fetch('{{ route("fileindex.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            confirmButtonColor: '#3b82f6'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message,
                            confirmButtonColor: '#3b82f6'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An unexpected error occurred. Please try again.',
                        confirmButtonColor: '#3b82f6'
                    });
                });
            });
        });
    </script>

@endsection
