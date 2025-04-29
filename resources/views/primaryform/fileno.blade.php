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

    </style>
<div class="bg-green-50 border border-green-100 rounded-md p-4 mb-6 items-center">
    <div class="flex items-center mb-2">
      <i data-lucide="file" class="w-5 h-5 mr-2 text-green-600"></i>
      <span class="font-medium">File Number Information</span>
    </div>
    <p class="text-sm text-gray-600 mb-4">Select file number type and enter the details</p>
    
    <div class="bg-white p-2 rounded-md mb-4 flex space-x-2">
      <button type="button" class="tablinks active px-4 py-2 rounded-md hover:bg-gray-100" onclick="openFileTab(event, 'mlsFNo')">MLS</button>
      <button type="button" class="tablinks px-4 py-2 rounded-md hover:bg-gray-100"   onclick="openFileTab(event, 'kangisFileNo')">KANGIS</button>
      <button type="button" class="tablinks px-4 py-2 rounded-md hover:bg-gray-100"  onclick="openFileTab(event, 'NewKANGISFileno')">New KANGIS</button>
    </div>
    
  
   <div id="mlsFNo" class="tabcontent active">
    <p class="text-sm text-gray-600 mb-2">MLS File Number</p>
    <div class="grid grid-cols-3 gap-4 mb-3">
      <div>
        <label class="block text-sm mb-1">File Prefix</label>
        <div class="relative">
          <select class="w-full p-2 border border-gray-300 rounded-md appearance-none pr-8" id="mlsFileNoPrefix" name="mlsFileNoPrefix">
            <option>Select prefix</option>
            @foreach (['COM', 'RES', 'CON-COM', 'CON-RES', 'CON-AG', 'CON-IND'] as $prefix)
            <option value="{{ $prefix }}">{{ $prefix }}</option>
        @endforeach
          </select>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
          </div>
        </div>
      </div>
      <div>
        <label class="block text-sm mb-1">Serial Number</label>
        <input type="text" class="w-full p-2 border border-gray-300 rounded-md" id="mlsFileNumber" name="mlsFileNumber" placeholder="e.g. 2022-572" value="{{ isset($result) ? ($result->mlsFileNumber ?: '') : '' }}">
      </div>
       <div>
        <label class="block text-sm mb-1">Full FileNo</label>
        <input type="text" class="w-full p-2 border border-gray-300 rounded-md"   id="mlsPreviewFileNumber" name="mlsPreviewFileNumber"
        value="{{ isset($result) ? ($result->mlsFNo ?: '') : '' }}" readonly>
      </div>
    </div>
  </div>  

  <div id="kangisFileNo" class="tabcontent">
    <p class="text-sm text-gray-600 mb-2">KANGIS File Number</p>
    <div class="grid grid-cols-3 gap-4 mb-3">
      <div>
        <label class="block text-sm mb-1">File Prefix</label>
        <div class="relative">
          <select class="w-full p-2 border border-gray-300 rounded-md appearance-none pr-8"    id="kangisFileNoPrefix" name="kangisFileNoPrefix">
            <option value="">Select Prefix</option>
                        @foreach (['KNML', 'MNKL', 'MLKN', 'KNGP'] as $prefix)
                            <option value="{{ $prefix }}">{{ $prefix }}</option>
                        @endforeach
          </select>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
          </div>
        </div>
      </div>
      <div>
        <label class="block text-sm mb-1">Serial Number</label>
        <input type="text" class="w-full p-2 border border-gray-300 rounded-md" id="kangisFileNumber" name="kangisFileNumber" placeholder="e.g. 0001 or 2500">
      </div>
       <div>
        <label class="block text-sm mb-1">Full FileNo</label>
        <input type="text" class="w-full p-2 border border-gray-300 rounded-md"  id="kangisPreviewFileNumber" name="kangisPreviewFileNumber"
        value="{{ isset($result) ? ($result->kangisFileNo ?: '') : '' }}" readonly>
      </div>
    </div>
  </div> 

  <div id="NewKANGISFileno" class="tabcontent">
    <p class="text-sm text-gray-600 mb-2">
        New KANGIS File Number</p>
    <div class="grid grid-cols-3 gap-4 mb-3">
      <div>
        <label class="block text-sm mb-1">File Prefix</label>
        <div class="relative">
          <select class="w-full p-2 border border-gray-300 rounded-md appearance-none pr-8"  id="newKangisFileNoPrefix" name="newKangisFileNoPrefix">
        
            <option value="">Select Prefix</option>
            <option value="KN">KN</option>
          </select>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
          </div>
        </div>
      </div>
      <div>
        <label class="block text-sm mb-1">Serial Number</label>
        <input type="text" class="w-full p-2 border border-gray-300 rounded-md"  id="newKangisFileNumber" name="newKangisFileNumber" 
        placeholder="e.g. 1586" value="{{ isset($result) ? ($result->newKangisFileNumber ?: '') : '' }}">
      </div>
       <div>
        <label class="block text-sm mb-1">Full FileNo</label>
        <input type="text" class="w-full p-2 border border-gray-300 rounded-md"  id="newKangisPreviewFileNumber" name="newKangisPreviewFileNumber"
        value="{{ isset($result) ? ($result->NewKANGISFileno ?: '') : '' }}" readonly>
      </div>
    </div>
</div>
    
    <script>
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

    // Tab switching function
    function openFileTab(evt, tabName) {
        // Hide all tab content
        var tabcontent = document.getElementsByClassName("tabcontent");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.remove("active");
        }

        // Remove active class from all tab buttons
        var tablinks = document.getElementsByClassName("tablinks");
        for (var i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        // Show the current tab and add active class to the button
        document.getElementById(tabName).classList.add("active");
        evt.currentTarget.classList.add("active");
    }

    // Format MLS file number preview
    function updateMlsFileNumberPreview() {
        const prefixEl = document.getElementById('mlsFileNoPrefix');
        const numberEl = document.getElementById('mlsFileNumber');
        const previewEl = document.getElementById('mlsPreviewFileNumber');

        const prefix = prefixEl.value;
        let number = numberEl.value.trim();

        if (prefix && number) {
            previewEl.value = prefix + '-' + number;
        } else if (prefix) {
            previewEl.value = prefix;
        } else if (number) {
            previewEl.value = number;
        } else {
            previewEl.value = '';
        }
    }

    // Format KANGIS file number preview
    function updateKangisFileNumberPreview() {
        const prefixEl = document.getElementById('kangisFileNoPrefix');
        const numberEl = document.getElementById('kangisFileNumber');
        const previewEl = document.getElementById('kangisPreviewFileNumber');

        const prefix = prefixEl.value;
        let number = numberEl.value.trim();

        if (prefix && number) {
            // Pad to 5 digits
            number = number.padStart(5, '0');
            numberEl.value = number;
            previewEl.value = prefix + ' ' + number;
        } else if (prefix) {
            previewEl.value = prefix;
        } else if (number) {
            previewEl.value = number;
        } else {
            previewEl.value = '';
        }
    }

    // Format New KANGIS file number preview
    function updateNewKangisFileNumberPreview() {
        const prefixEl = document.getElementById('newKangisFileNoPrefix');
        const numberEl = document.getElementById('newKangisFileNumber');
        const previewEl = document.getElementById('newKangisPreviewFileNumber');

        const prefix = prefixEl.value;
        let number = numberEl.value.trim();

        if (prefix && number) {
            previewEl.value = prefix + number;
        } else if (prefix) {
            previewEl.value = prefix;
        } else if (number) {
            previewEl.value = number;
        } else {
            previewEl.value = '';
        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        // Initialize file number previews
        updateMlsFileNumberPreview();
        updateKangisFileNumberPreview();
        updateNewKangisFileNumberPreview();

        // Add event listeners for file number preview updates
        document.getElementById('mlsFileNoPrefix').addEventListener('change', updateMlsFileNumberPreview);
        document.getElementById('mlsFileNumber').addEventListener('input', updateMlsFileNumberPreview);

        document.getElementById('kangisFileNoPrefix').addEventListener('change', updateKangisFileNumberPreview);
        document.getElementById('kangisFileNumber').addEventListener('input', updateKangisFileNumberPreview);

        document.getElementById('newKangisFileNoPrefix').addEventListener('change',
            updateNewKangisFileNumberPreview);
        document.getElementById('newKangisFileNumber').addEventListener('input',
            updateNewKangisFileNumberPreview);


        updateMlsFileNumberPreview
    });
</script>
