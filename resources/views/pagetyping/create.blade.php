@extends('layouts.app')
@section('page-title')
    {{ __('Page Typing Assistant Interface') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Page Typing') }}</li>
@endsection

<style>
    .app-window {
        border: 1px solid #F3F2F2FF;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .toolbar-button {
        background-color: #e0e0e0;
        border: 1px solid #a0a0a0;
        padding: 2px 4px;
        font-size: 12px;
    }

    .toolbar-button:hover {
        background-color: #d0d0d0;
    }

    .tab {
        border: 1px solid #a0a0a0;
        border-bottom: none;
        background-color: #e0e0e0;
        padding: 2px 8px;
        font-size: 12px;
    }

    .tab.active {
        background-color: #f0f0f0;
    }

    .thumbnail {
        border: 1px solid #a0a0a0;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table-header {
        background-color: #e0e0e0;
        border: 1px solid #a0a0a0;
        font-weight: bold;
        font-size: 12px;
    }

    .status-bar {
        background-color: #0078d7;
        color: white;
        font-size: 12px;
        padding: 2px 8px;
    }

    .dropdown2 {
        border: 1px solid #a0a0a0;
        background-color: white;
        font-size: 12px;
        padding: 1px;
    }

    .action-button {
        background-color: #ffd700;
        border: 1px solid #a0a0a0;
        padding: 2px 8px;
        font-size: 12px;
    }

    .action-button:hover {
        background-color: #ffcc00;
    }

    .refresh-button {
        background-color: #e0e0e0;
        border: 1px solid #a0a0a0;
        padding: 2px 8px;
        font-size: 12px;
    }

    .refresh-button:hover {
        background-color: #d0d0d0;
    }

    .zoom-control {
        display: flex;
        align-items: center;
        font-size: 12px;
    }

    .slider {
        -webkit-appearance: none;
        appearance: none;
        height: 2px;
        background: #d3d3d3;
        outline: none;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 10px;
        height: 20px;
        background: #a0a0a0;
        cursor: pointer;
    }

    .slider::-moz-range-thumb {
        width: 10px;
        height: 20px;
        background: #a0a0a0;
        cursor: pointer;
    }

    .material-icons {
        font-size: 16px;
        line-height: 1;
    }

    .material-icons.md-18 {
        font-size: 18px;
    }

    .material-icons.md-24 {
        font-size: 24px;
    }


    .form-input,
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
    }

    .tabcontent {
        display: none;
    }

    .tabcontent.active {
        display: block;
    }
</style>

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="container mx-auto">
                        <div class="app-window max-w-6xl mx-auto bg-gray-200">
                            <!-- Title Bar -->

                            <!-- Toolbar -->
                            <div class="flex flex-wrap gap-1 p-2 border-b border-gray-400">
                                <div class="flex gap-4">
                                    <div class="flex flex-col gap-1">
                                        <button class="toolbar-button flex items-center">
                                            <span class="material-icons mr-1 text-blue-600">check</span>
                                            Select All
                                        </button>
                                        <button class="toolbar-button flex items-center">
                                            <span class="material-icons mr-1 text-red-500">clear</span>
                                            Clear All
                                        </button>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <button class="toolbar-button flex items-center">
                                            <span class="material-icons mr-1 text-purple-600">apps</span>
                                            Set Combo
                                        </button>
                                        <button class="toolbar-button flex items-center">
                                            <span class="material-icons mr-1 text-red-500">clear</span>
                                            Clear Combo
                                        </button>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <button class="toolbar-button flex items-center">
                                            <span class="material-icons mr-1 text-red-600">delete</span>
                                            Delete Image File
                                        </button>

                                        <button class="toolbar-button flex items-center">
                                            <span class="material-icons mr-1 text-green-600">check_circle</span>
                                            Set Page Type
                                        </button>
                                    </div>

                                    <div class="flex flex-col gap-1">
                                        <button class="toolbar-button flex items-center">
                                            <span class="material-icons mr-1 text-indigo-600">keyboard_arrow_left</span>
                                            Move First
                                        </button>
                                        <button class="toolbar-button flex items-center">
                                            <span class="material-icons mr-1 text-indigo-600">keyboard_arrow_right</span>
                                            Move Last
                                        </button>
                                    </div>


                                    <div class="flex  flex-col gap-1">
                                        <button
                                            class="toolbar-button rounded-full w-8 h-8 flex items-center justify-center">
                                            <span class="material-icons text-green-600">arrow_drop_up</span>
                                        </button>
                                        <button
                                            class="toolbar-button rounded-full w-8 h-8 flex items-center justify-center">
                                            <span class="material-icons  text-green-600">arrow_drop_down</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="zoom-control flex-grow ml-4">
                                    <span class="mr-2">25%</span>
                                    <input type="range" id="zoomRange" min="25" max="300" value="100" class="slider flex-grow mx-2" oninput="updateZoomValue(this.value)">
                                    <span id="zoomValue" class="ml-2">100%</span>
                                    <span class="ml-2">300%</span>
                                </div>
                             


                            </div>

                            <!-- Main Content Area -->
                            <div class="flex flex-col md:flex-row">
                                <!-- Left Panel -->
                                <div class="w-full md:w-1/2 p-2">
                                    <!-- Page Type Selector -->
                                    <div class="flex items-center mb-2">
                                        <span class="text-xs mr-2">Page Type</span>
                                        <select class="dropdown2 text-xs flex-grow">
                                            <option>Select Page Type</option>
                                        </select>
                                    </div>

                                    <!-- Table -->
                                    <div class="border border-gray-400 bg-white h-64 overflow-auto">
                                        <table class="w-full text-xs">
                                            <thead>
                                                <tr>
                                                    <th class="table-header px-2 py-1 text-left">File Name</th>
                                                    <th class="table-header px-2 py-1 text-left">Combo</th>
                                                    <th class="table-header px-2 py-1 text-left">S/No</th>
                                                    <th class="table-header px-2 py-1 text-left">Page Type</th>
                                                    <th class="table-header px-2 py-1 text-left">Page Sub-Type</th>
                                                    <th class="table-header px-2 py-1 text-left">File Size</th>
                                                    <th class="table-header px-2 py-1 text-left">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Table content would go here -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Scanning Folder Info -->
                                    <!-- <div class="text-xs mt-2">
                                      <span>Scanning folder: \\pc201\ABIAGIS\Digitization1 - Scanning\0 - Scan Uploading</span>
                                    </div> -->

                                    <!-- File Options -->
                                    <div class="mt-4">
                                        <div class="text-xs font-bold">File Options</div>
                                        <div class="border border-gray-400 bg-gray-200 p-1">
                                            <!-- <div class="text-xs font-bold">AB-PF-S.LAC</div>
                                         -->
                                            <!-- Tabs -->
                                            <div class="flex">
                                                <div class="tab active">File Selection</div>
                                                <div class="tab">File Search</div>
                                                <div class="tab">Files List</div>
                                                <div class="tab">Folder Settings</div>
                                            </div>

                                            <!-- Tab Content -->
                                            <div class="border border-gray-400 bg-white p-2">


                                                <div class="mb-4">



                                                    <!-- Tab Content -->
                                                    <div class="border border-gray-400 bg-white p-2">
                                                        <div class="text-xs font-bold mb-2">Select File Number</div>

                                                        <div class="mb-4">

                                                            <div class="flex gap-2">
                                                                <div class="mb-4">


                                                                    <!-- Tab navigation - shortened buttons -->
                                                                    <div class="tab flex space-x-1 mb-2">
                                                                        <button
                                                                            class="tablinks active px-2 py-1 text-xs font-medium rounded-t shadow-sm border border-b-0 bg-white"
                                                                            onclick="openFileTab(event, 'mlsFNo')">MLS</button>
                                                                        <button
                                                                            class="tablinks px-2 py-1 text-xs font-medium rounded-t shadow-sm border border-b-0"
                                                                            onclick="openFileTab(event, 'kangisFileNo')">KANGIS</button>
                                                                        <button
                                                                            class="tablinks px-2 py-1 text-xs font-medium rounded-t shadow-sm border border-b-0"
                                                                            onclick="openFileTab(event, 'NewKANGISFileno')">New
                                                                            KANGIS</button>
                                                                    </div>


                                                                    <!-- MLS File Number Tab -->
                                                                    <div id="mlsFNo" class="tabcontent active">
                                                                        <div class="flex mb-1">
                                                                            <div class="w-3/4 grid grid-cols-3 gap-1">
                                                                                <select class="form-select p-2"
                                                                                    id="mlsFileNoPrefix"
                                                                                    name="mlsFileNoPrefix">
                                                                                    <option value="">File Prefix
                                                                                    </option>
                                                                                    @foreach (['COM', 'RES', 'CON-COM', 'CON-RES', 'CON-AG', 'CON-IND'] as $prefix)
                                                                                        <option value="{{ $prefix }}">
                                                                                            {{ $prefix }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <input type="text" class="form-input p-2"
                                                                                    id="mlsFileNumber" name="mlsFileNumber"
                                                                                    placeholder="e.g. 2022-572"
                                                                                    value="{{ isset($result) ? ($result->mlsFileNumber ?: '') : '' }}">
                                                                                <input type="text" class="form-input p-2"
                                                                                    id="mlsPreviewFileNumber"
                                                                                    name="mlsPreviewFileNumber"
                                                                                    value="{{ isset($result) ? ($result->mlsFNo ?: '') : '' }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- KANGIS File Number Tab -->
                                                                    <div id="kangisFileNo" class="tabcontent">

                                                                        <div class="flex mb-1">
                                                                            <div class="w-3/4 grid grid-cols-3 gap-1">
                                                                                <select class="form-select p-2"
                                                                                    id="kangisFileNoPrefix"
                                                                                    name="kangisFileNoPrefix">
                                                                                    <option value="">File Prefix
                                                                                    </option>
                                                                                    @foreach (['KNML', 'MNKL', 'MLKN', 'KNGP'] as $prefix)
                                                                                        <option
                                                                                            value="{{ $prefix }}">
                                                                                            {{ $prefix }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <input type="text"
                                                                                    class="form-input p-2"
                                                                                    id="kangisFileNumber"
                                                                                    name="kangisFileNumber"
                                                                                    placeholder="e.g. 04367"
                                                                                    value="{{ isset($result) ? ($result->kangisFileNumber ?: '') : '' }}">
                                                                                <input type="text"
                                                                                    class="form-input p-2"
                                                                                    id="kangisPreviewFileNumber"
                                                                                    name="kangisPreviewFileNumber"
                                                                                    value="{{ isset($result) ? ($result->kangisFileNo ?: '') : '' }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- New KANGIS File Number Tab -->
                                                                    <div id="NewKANGISFileno" class="tabcontent">

                                                                        <div class="flex mb-1">
                                                                            <div class="w-3/4 grid grid-cols-3 gap-1">
                                                                                <select class="form-select p-2"
                                                                                    id="newKangisFileNoPrefix"
                                                                                    name="newKangisFileNoPrefix">
                                                                                    <option value="">File Prefix
                                                                                    </option>
                                                                                    <option value="KN">KN</option>
                                                                                </select>
                                                                                <input type="text"
                                                                                    class="form-input p-2"
                                                                                    id="newKangisFileNumber"
                                                                                    name="newKangisFileNumber"
                                                                                    placeholder="e.g. 1586"
                                                                                    value="{{ isset($result) ? ($result->newKangisFileNumber ?: '') : '' }}">
                                                                                <input type="text"
                                                                                    class="form-input p-2"
                                                                                    id="newKangisPreviewFileNumber"
                                                                                    name="newKangisPreviewFileNumber"
                                                                                    value="{{ isset($result) ? ($result->NewKANGISFileno ?: '') : '' }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="flex justify-between items-center">
                                                    <div class="flex items-center gap-2">
                                                        <button class="action-button">Load Scan(s)</button>
                                                         
                                                    </div>
                                                    <button class="refresh-button">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Panel (Preview) -->
                                <div class="w-full md:w-1/2 p-2">
                                    <div class="border border-gray-400 bg-white h-full flex flex-col">
                                        <!-- Top Thumbnails -->
                                        <div class="flex justify-between p-2">
                                            <div class="thumbnail w-16 h-16">
                                                <span class="material-icons md-24 text-gray-400">insert_photo</span>
                                            </div>
                                            <div class="thumbnail w-16 h-16">
                                                <span class="material-icons md-24 text-gray-400">insert_photo</span>
                                            </div>
                                        </div>

                                        <!-- Side Thumbnails -->
                                        <div class="flex justify-between flex-grow">
                                            <div class="flex flex-col justify-center">
                                                <div class="thumbnail w-12 h-16 mb-2">
                                                    <span class="material-icons md-24 text-gray-400">insert_photo</span>
                                                </div>
                                                <div class="thumbnail w-12 h-16">
                                                    <span class="material-icons md-24 text-gray-400">insert_photo</span>
                                                </div>
                                            </div>
                                            <div class="flex flex-col justify-center">
                                                <div class="thumbnail w-12 h-16 mb-2">
                                                    <span class="material-icons md-24 text-gray-400">insert_photo</span>
                                                </div>
                                                <div class="thumbnail w-12 h-16">
                                                    <span class="material-icons md-24 text-gray-400">insert_photo</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bottom Controls -->
                                        <div class="p-2">

                                            <div class="flex justify-between">
                                                <button
                                                    class="toolbar-button rounded-full w-8 h-8 flex items-center justify-center">
                                                    <span class="material-icons  text-gray-400">insert_photo</span>
                                                </button>
                                                <div class="flex gap-2">
                                                    <div class="thumbnail w-12 h-8">
                                                        <span class="material-icons text-gray-400">insert_photo</span>
                                                    </div>
                                                    <div class="thumbnail w-12 h-8">
                                                        <span class="material-icons text-gray-400">insert_photo</span>
                                                    </div>
                                                    <div class="thumbnail w-12 h-8">
                                                        <span class="material-icons text-gray-400">insert_photo</span>
                                                    </div>
                                                </div>
                                                <button
                                                    class="toolbar-button rounded-full w-8 h-8 flex items-center justify-center">
                                                    <span class="material-icons  text-gray-400">insert_photo</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- file number js  -->
    @include('filescanning.filenumber_js')

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
           
        // function updateZoomValue(value) {
        //     document.getElementById('zoomValue').textContent = value + '%';
 
        //     var container = document.querySelector('.app-window');
        //     if (container) {
        //         container.style.transform = 'scale(' + value/100 + ')';
        //         container.style.transformOrigin = '0 0';
        //     }
        // }
    </script>
@endsection
