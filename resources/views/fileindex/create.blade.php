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
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                                <div class="w-1/4 text-xs">File No:</div>
                                <input type="text" value="LUM-9852" class="form-input w-3/4 bg-gray-100 p-2" readonly>
                            </div>
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">File Title:</div>
                                <input type="text" value="INTERSTATE COMMERCE CENTER" class="form-input w-3/4 p-2">
                            </div>
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">Location Title:</div>
                                <select class="form-select w-3/4 p-2">
                                    <option>Masterfile</option>
                                </select>
                            </div>
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">Other FileNo:</div>
                                <div class="w-3/4 flex">
                                    <input type="text" value="LUM/9852" class="form-input w-1/2 p-2">
                                </div>
                            </div>
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">Other FileNo:</div>
                                <div class="w-3/4 flex">
                                    <input type="text" value="9852" class="form-input w-1/4 mx-1 p-2">
                                    <input type="text" value="9852" class="form-input w-1/4 mx-1 p-2">
                                   
                                </div>
                            </div> 
                            
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">Batch No:</div>
                                <div class="w-3/4 flex">
                                    <input type="text"  class="form-input w-1/4 mx-1 p-2">
                                    <input type="text"   class="form-input w-1/4 mx-1 p-2" placeholder="Plot No:">
                                   
                                </div>
                            </div>
                            
                        </div>
        
                        <!-- Checkboxes -->
                        <div class="grid grid-cols-2 gap-1 mb-2">
                            <div class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                <span class="text-xs">File Co-Owned</span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                <span class="text-xs">File Has Transaction</span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" checked class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                <span class="text-xs">File Has Certificate of Occupancy</span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                <span class="text-xs">File Category</span>
                                <select class="form-select ml-1 w-1/2 p-2">
                                    <option>TAL</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                <span class="text-xs">File Sub-Category</span>
                                <select class="form-select ml-1 w-1/2 p-2">
                                    <option>Corporate North</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                <span class="text-xs">File Merged</span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                <span class="text-xs">File Subdivided</span>
                            </div>
                        </div>
         
        
                        <!-- File Lease -->
                        <div class="mb-2">
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">File Lease:</div>
                                <input type="text" value="CHIC-9852-9852-9001-9001-ABCDEFGHIJKL" class="form-input w-3/4 p-2" readonly>
                            </div>
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">Certificate of Occupancy:</div>
                                <div class="w-3/4 flex items-center">
                                    <input type="radio" name="occupancy" checked class="w-4 h-4 text-primary focus:ring-primary mr-2">
                                    <span class="text-sm mr-4">Yes</span>
                                    <input type="radio" name="occupancy" class="w-4 h-4 text-primary focus:ring-primary mr-2">
                                    <span class="text-sm">No</span>
                                </div>
                            </div>
                        </div>
        
                        <!-- Registry Info -->
                        <div class="mb-2">
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">Serial No:</div>
                                <input type="text" class="form-input w-1/4 p-2">
                                <div class="w-1/4 text-xs pl-4">Title:</div>
                                <input type="text" class="form-input w-1/4 p-2">
                            </div>
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">Reg. Page:</div>
                                <input type="text" class="form-input w-1/4 p-2">
                                <div class="w-1/4 text-xs pl-4">Landuse Type:</div>
                                <input type="text" class="form-input w-1/4 p-2">
                            </div>
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">Covenant:</div>
                                <input type="text" class="form-input w-1/4 p-2">
                                <div class="w-1/4 text-xs pl-4">Plot Description:</div>
                                <input type="text" class="form-input w-1/4 p-2">
                            </div>
                            <div class="flex mb-1">
                                <div class="w-1/4 text-xs">Lease Period:</div>
                                <input type="text" class="form-input w-1/4 p-2">
                                <div class="flex items-center w-1/4 pl-4">
                                    <span class="text-xs mr-2">year(s)</span>
                                    <span class="text-xs">Reg. Date:</span>
                                </div>
                                <input type="text" class="form-input w-1/4 p-2">
                            </div>
                            
                            <div >
                                <button class="bg-primary text-white px-3 py-1 rounded text-xs flex items-center">
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
                                    <input type="checkbox"  class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">Customer</span>
                                </div>
                            </div>
                            
                            <div>
                                
                                <div class="flex items-center mt-1">
                                    <input type="checkbox"  class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">Statutory</span>
                                </div>
                            </div>
                            
                            <div>
                                <div class="text-xs font-bold">Property Transation</div>
                                <div class="flex items-center mt-1">
                                    <input type="checkbox" checked class="w-4 h-4 text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs">Grant/Lease</span>
                                </div>
                            </div>
        
        
                            <div>
                                <div class="text-xs font-bold">Search Filter</div>
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Grantor</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                            
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">TitleType</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                  
                                    <span class="text-xs w-24">Grantee</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Land use Type</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Assignment</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">LGA</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div>
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Category Code</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    
                                    <span class="text-xs w-24">Assignor</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">NewKANGISFileNo</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    
                                    <span class="text-xs w-24">Assignee</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                            
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">KAGISFileNO</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Mortgage</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">MLSFileNo</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                   
                                    <span class="text-xs w-24">Mortgagor</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Batch #</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    
                                    <span class="text-xs w-24">Mortgagee</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Plot No</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                   
                                    <span class="text-xs w-24">Third Party</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>  
                            
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Type Form</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                        
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Surrenderor</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div> 
                            
                            <div class="flex items-center"></div>
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                  
                                    <span class="text-xs w-24">Surrenderee</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                            
                            <div class="flex items-center"></div>
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                    <input type="checkbox" class="text-primary focus:ring-primary rounded mr-2">
                                    <span class="text-xs w-24">Sub-Lease</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                            
                            <div class="flex items-center"></div>
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                   
                                    <span class="text-xs w-24">Lessor</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                            
                            <div class="flex items-center"></div>
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                   
                                    <span class="text-xs w-24">Instrument</span>
                                </div>
                                <input type="text" class="form-input w-1/2 p-2">
                            </div>
                            
                            
                            <div class="flex items-center"></div>
                            <div class="flex items-center">
                                <div class="flex items-center w-1/2">
                                  
                                    <span class="text-xs w-24">Period</span>
                                </div>
                                <div class="flex w-1/2">
                                    <input type="text" class="form-input w-1/3 p-2 mr-1">
                                    <input type="text" class="form-input w-1/3 p-2 mr-1">
                                    <input type="text" class="form-input w-1/3 p-2">
                                </div>
                            </div>
        
                            <div >
                                 
                            </div>
                        </div>
                  
                        
        
        
                        <!-- Bottom Buttons -->
                        <div class="flex justify-between mt-4">
                            
                            <div class="flex">
                                 
                                <button class="bg-primary text-white border border-primary p-2 rounded-md shadow-sm hover:bg-blue-600 flex items-center">
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
        </div>
    </div>


    </div>
@endsection
