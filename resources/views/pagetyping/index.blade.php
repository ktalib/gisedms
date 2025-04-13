 

    <!-- Tab Content -->
    <div class="border border-gray-400 bg-white p-2">
        <div class="text-xs font-bold mb-2">Select File Number</div>

        <div class="mb-4">
            <div class="text-xs mb-1">New File Number</div>
            <div class="flex gap-2">
                <div class="mb-4">
                    <label class="text-xs mb-1 block">File Number</label>

                    <!-- Tab navigation - shortened buttons -->
                    <div class="tab flex space-x-1 mb-2">
                        <button
                            class="tablinks active px-2 py-1 text-xs font-medium rounded-t shadow-sm border border-b-0 bg-white"
                            onclick="openFileTab(event, 'mlsFNo')">MLS</button>
                        <button class="tablinks px-2 py-1 text-xs font-medium rounded-t shadow-sm border border-b-0"
                            onclick="openFileTab(event, 'kangisFileNo')">KANGIS</button>
                        <button class="tablinks px-2 py-1 text-xs font-medium rounded-t shadow-sm border border-b-0"
                            onclick="openFileTab(event, 'NewKANGISFileno')">New KANGIS</button>
                    </div>


                    <!-- MLS File Number Tab -->
                    <div id="mlsFNo" class="tabcontent active">
                        <div class="flex mb-1">
                            <div class="w-3/4 grid grid-cols-3 gap-1">
                                <select class="form-select p-2" id="mlsFileNoPrefix" name="mlsFileNoPrefix">
                                    <option value="">File Prefix</option>
                                    @foreach (['COM', 'RES', 'CON-COM', 'CON-RES', 'CON-AG', 'CON-IND'] as $prefix)
                                        <option value="{{ $prefix }}">{{ $prefix }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-input p-2" id="mlsFileNumber" name="mlsFileNumber"
                                    placeholder="e.g. 2022-572"
                                    value="{{ isset($result) ? ($result->mlsFileNumber ?: '') : '' }}">
                                <input type="text" class="form-input p-2" id="mlsPreviewFileNumber"
                                    name="mlsPreviewFileNumber"
                                    value="{{ isset($result) ? ($result->mlsFNo ?: '') : '' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- KANGIS File Number Tab -->
                    <div id="kangisFileNo" class="tabcontent">

                        <div class="flex mb-1">
                            <div class="w-3/4 grid grid-cols-3 gap-1">
                                <select class="form-select p-2" id="kangisFileNoPrefix" name="kangisFileNoPrefix">
                                    <option value="">File Prefix</option>
                                    @foreach (['KNML', 'MNKL', 'MLKN', 'KNGP'] as $prefix)
                                        <option value="{{ $prefix }}">{{ $prefix }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-input p-2" id="kangisFileNumber"
                                    name="kangisFileNumber" placeholder="e.g. 04367"
                                    value="{{ isset($result) ? ($result->kangisFileNumber ?: '') : '' }}">
                                <input type="text" class="form-input p-2" id="kangisPreviewFileNumber"
                                    name="kangisPreviewFileNumber"
                                    value="{{ isset($result) ? ($result->kangisFileNo ?: '') : '' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- New KANGIS File Number Tab -->
                    <div id="NewKANGISFileno" class="tabcontent">

                        <div class="flex mb-1">
                            <div class="w-3/4 grid grid-cols-3 gap-1">
                                <select class="form-select p-2" id="newKangisFileNoPrefix" name="newKangisFileNoPrefix">
                                    <option value="">File Prefix</option>
                                    <option value="KN">KN</option>
                                </select>
                                <input type="text" class="form-input p-2" id="newKangisFileNumber"
                                    name="newKangisFileNumber" placeholder="e.g. 1586"
                                    value="{{ isset($result) ? ($result->newKangisFileNumber ?: '') : '' }}">
                                <input type="text" class="form-input p-2" id="newKangisPreviewFileNumber"
                                    name="newKangisPreviewFileNumber"
                                    value="{{ isset($result) ? ($result->NewKANGISFileno ?: '') : '' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          
        </div>
    </div>
 
