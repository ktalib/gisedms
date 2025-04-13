@extends('layouts.app')
@section('page-title')
    {{ __('Scanning Assistant Interface') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item" aria-current="page"> {{ __('Scanning Assistant Interface ') }}</li>
@endsection

<style>
    /* Tab styles */
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

    .scanner-preview {
        max-width: 100%;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
        margin-top: 10px;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="container mx-auto">
                        <div class="bg-gray-100 border border-gray-400 rounded shadow-md w-full max-w-3xl mx-auto">
                            <!-- Header -->
                            <div class="flex justify-between items-center px-4 py-2 border-b border-gray-300">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                        <path fill-rule="evenodd"
                                            d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </div>
                                <div>
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <!-- File Number Section -->
                                <div class="mb-4">
                                    <label class="text-xs mb-1 block">File Number</label>

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
                                            onclick="openFileTab(event, 'NewKANGISFileno')">New KANGIS</button>
                                    </div>

                                    <div class="flex">
                                        <!-- MLS File Number Tab -->
                                        <div id="mlsFNo" class="tabcontent active">
                                            <div class="flex mb-1">
                                                <div class="w-3/4 grid grid-cols-3 gap-1">
                                                    <select class="form-select p-2" id="mlsFileNoPrefix"
                                                        name="mlsFileNoPrefix">
                                                        <option value="">File Prefix</option>
                                                        @foreach (['COM', 'RES', 'CON-COM', 'CON-RES', 'CON-AG', 'CON-IND'] as $prefix)
                                                            <option value="{{ $prefix }}">{{ $prefix }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" class="form-input p-2" id="mlsFileNumber"
                                                        name="mlsFileNumber" placeholder="e.g. 2022-572"
                                                        value="{{ isset($result) ? ($result->mlsFileNumber ?: '') : '' }}">
                                                    <input type="text" class="form-input p-2" id="mlsPreviewFileNumber"
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
                                                    <select class="form-select p-2" id="kangisFileNoPrefix"
                                                        name="kangisFileNoPrefix">
                                                        <option value="">File Prefix</option>
                                                        @foreach (['KNML', 'MNKL', 'MLKN', 'KNGP'] as $prefix)
                                                            <option value="{{ $prefix }}">{{ $prefix }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" class="form-input p-2" id="kangisFileNumber"
                                                        name="kangisFileNumber" placeholder="e.g. 04367"
                                                        value="{{ isset($result) ? ($result->kangisFileNumber ?: '') : '' }}">
                                                    <input type="text" class="form-input p-2"
                                                        id="kangisPreviewFileNumber" name="kangisPreviewFileNumber"
                                                        value="{{ isset($result) ? ($result->kangisFileNo ?: '') : '' }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- New KANGIS File Number Tab -->
                                        <div id="NewKANGISFileno" class="tabcontent">

                                            <div class="flex mb-1">
                                                <div class="w-3/4 grid grid-cols-3 gap-1">
                                                    <select class="form-select p-2" id="newKangisFileNoPrefix"
                                                        name="newKangisFileNoPrefix">
                                                        <option value="">File Prefix</option>
                                                        <option value="KN">KN</option>
                                                    </select>
                                                    <input type="text" class="form-input p-2" id="newKangisFileNumber"
                                                        name="newKangisFileNumber" placeholder="e.g. 1586"
                                                        value="{{ isset($result) ? ($result->newKangisFileNumber ?: '') : '' }}">
                                                    <input type="text" class="form-input p-2"
                                                        id="newKangisPreviewFileNumber" name="newKangisPreviewFileNumber"
                                                        value="{{ isset($result) ? ($result->NewKANGISFileno ?: '') : '' }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                        <button
                                            class="bg-gray-200 border border-gray-400 rounded-r px-2 py-1 text-xs">Browse...</button>
                                            <div class="flex ml-2">
                                              <button class="bg-gray-200 border border-gray-400 rounded p-1 mx-1">
                                                <i class="material-icons" style="color: #065c2b;">scanner</i>
                                              </button>
                                              <button class="bg-gray-200 border border-gray-400 rounded p-1 mx-1">
                                                <i class="material-icons" style="color: rgb(5, 126, 120);">refresh</i>
                                              </button>
                                              <button class="bg-gray-200 border border-gray-400 rounded p-1 mx-1">
                                                <i class="material-icons" style="color: rgb(8, 85, 8);">download</i>
                                              </button>
                                            </div>
                                    </div>
                                </div>

                                <!-- Scan Names Section -->
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <div>
                                        <label class="text-xs block">Last A3 Scan Name:</label>
                                    </div>
                                    <div>
                                        <label class="text-xs block">Last A4 Scan Name:</label>
                                    </div>
                                </div>

                                <!-- Scanner Info Section -->
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="text-xs">
                                        <span>A3 Scanner: </span>
                                        <span class="text-red-600 font-bold">0 scans</span>
                                    </div>
                                    <div class="text-xs">
                                        <span>A4 Scanner: </span>
                                        <span class="text-red-600 font-bold">0 scans</span>
                                    </div>
                                </div>

                                <!-- Counters Section -->
                                <div class="mt-2">
                                    <div class="text-xs mb-1">Scan Counters</div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="text-xs">
                                            <div>Current Session: 0</div>
                                        </div>
                                        <div class="text-xs">
                                            <div>Current File: 0</div>
                                        </div>
                                    </div>
                                </div>

                                <div id="scanPreviewContainer" class="scanner-preview hidden"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/scanner.js') }}"></script>
    <!-- file number js  -->
    @include('filescanning.filenumber_js')
@endsection
