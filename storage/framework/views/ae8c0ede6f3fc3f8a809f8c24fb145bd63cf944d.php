
<?php $__env->startSection('page-title'); ?>
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Instrument Registration Module')); ?>  <?php echo e($title); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/ckeditor/classic/ckeditor.js')); ?>"></script>
    <script>
        if ($('#classic-editor').length > 0) {
            ClassicEditor.create(document.querySelector('#classic-editor')).catch((error) => {
                console.error(error);
            });
        }
        setTimeout(() => {
            feather.replace();
        }, 500);
    </script>
<?php $__env->stopPush(); ?>
<style>
     
        .ck-editor__editable {
            min-height: 200px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            min-height: 40px;
        }

       

        #myDiv {
    display: none; /* Initially hidden */
    }
   /* Custom styles for file information form */
#myDiv {
  transition: all 0.3s ease-in-out;
}

select,
input {
  transition: all 0.2s ease-in-out;
}

select:focus,
input:focus {
  transform: translateY(-1px);
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

#Previewflenumber {
  font-family: monospace;
  letter-spacing: 0.05em;
}


    </style>
<?php $__env->startSection('content'); ?>

    <div class="container mx-auto mt-4 p-4">
 
        <form class="space-y-6" action="<?php echo e(route('instruments.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <!-- File Information -->

            <div class="bg-gray-50 p-4 rounded-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">File Information</h2>
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M18 8a6 6 0 11-12 0 6 6 0 0112 0zm-6 8a8 8 0 100-16 8 8 0 000 16zm-1-11a1 1 0 112 0v4a1 1 0 01-2 0V5zm1 8a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                Please provide the File Number by selecting the File Prefix and Suffix (if applicable). Click 'ENABLE FILE DETAILS', then click 'Enter File Number' to create a new file number. Additionally, you may enter Root Title Registration particulars.
                            </p>
                        </div>
                    </div>
                </div>
                
                <button type="button" id="myButton" class="mb-4 px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">ENABLE FILE DETAILS</button>
                
                <!-- First grid: Prefix & Suffix - 2 columns -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6" id="myDiv" style="display: none;">
                    <div>
                        <label for="fileNoPrefix" class="block text-sm font-medium text-gray-700 mb-1">File No Prefix</label>
                        <select id="fileNoPrefix" name="fileNoPrefix" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled>
                            <option value="TempfileNoPrefix">KN</option>
                            <option value="">Select File Prefix</option>
                            <option value="KNML">KNML</option>
                            <option value="MNKL">MNKL</option>
                            <option value="KN">KN</option>
                            <option value="CON-COM">CON-COM</option>
                            <option value="CON-RES">CON-RES</option>
                        </select>
                    </div>
                    <div>
                        <label for="fileNoSuffix" class="block text-sm font-medium text-gray-700 mb-1">File No Suffix</label>
                        <select id="fileNoSuffix" name="fileNoSuffix" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled>
                            <option value="TempfileNoSuffix">TEMP</option>
                            <option value="">Select File Suffix</option>
                            <option value="COM">COM</option>
                            <option value="RES">RES</option>
                        </select>
                    </div>
                    
                    <!-- Second grid: Number & Full file number - 2 columns -->
                    <div>
                        <label for="fileNumber" class="block text-sm font-medium text-gray-700 mb-1">Number</label>
                        <input type="number" id="fileNumber" name="fileNumber" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo e($tempFileNumber); ?>" disabled>
                        <div class="mt-2">
                            <button type="button" id="enterFileNumber" class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                                Enter File Number
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <label for="Previewflenumber" class="block text-sm font-medium text-gray-700 mb-1">Full File Number</label>
                        <input type="text" id="Previewflenumber" class="w-full p-2 border border-gray-300 bg-gray-100 font-medium text-gray-800 rounded-md" value="KN/00001/TEMP" disabled>
                    </div>
                </div>
                
                <!-- Root Title section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="rootTitleRegNo" class="block text-sm font-medium text-gray-700 mb-1">Root Title Reg No</label>
                        <input type="text" id="rootTitleRegNo" name="rootTitleRegNo" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="0/0/0" disabled>
                        <div class="mt-2">
                            <button type="button" id="enterRootTitleRegNo" class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                                Enter Root Title Reg Particulars
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            


            <!-- Grantor & Grantee Information -->
            <div class="bg-gray-50 p-4 rounded-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Grantor & Grantee Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label for="grantorName" class="block text-sm font-medium text-gray-700 mb-1">Grantor Name</label>
                            <input type="text" id="grantorName" name="grantorName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="grantorAddress" class="block text-sm font-medium text-gray-700 mb-1">Grantor Address</label>
                            <textarea id="grantorAddress" name="grantorAddress" rows="3" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="granteeName" class="block text-sm font-medium text-gray-700 mb-1">Grantee Name</label>
                            <input type="text" id="granteeName" name="granteeName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="granteeAddress" class="block text-sm font-medium text-gray-700 mb-1">Grantee Address</label>
                            <textarea id="granteeAddress" name="granteeAddress" rows="3" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instrument Details -->
            <div class="bg-gray-50 p-4 rounded-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Instrument Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="instrumentName" class="block text-sm font-medium text-gray-700 mb-1">Instrument Name</label>
                        <input type="text" id="instrumentName" name="instrumentName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="Power of Attorney" readonly>
                    </div>
                    <div>
                        <label for="instrumentDate" class="block text-sm font-medium text-gray-700 mb-1">Instrument Date</label>
                        <input type="date" id="instrumentDate" name="instrumentDate" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo e(date('Y-m-d')); ?>">
                    </div>
                    


                </div>
            </div>

            <!-- Solicitor Information -->
            <div class="bg-gray-50 p-4 rounded-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Solicitor Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="solicitorName" class="block text-sm font-medium text-gray-700 mb-1">Solicitor Name</label>
                        <input type="text" id="solicitorName" name="solicitorName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="solicitorAddress" class="block text-sm font-medium text-gray-700 mb-1">Solicitor Address</label>
                        <textarea id="solicitorAddress" name="solicitorAddress" rows="3" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Property Details -->
            <div class="bg-gray-50 p-4 rounded-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Property Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="surveyPlanNo" class="block text-sm font-medium text-gray-700 mb-1">Survey Plan No</label>
                        <input type="text" id="surveyPlanNo" name="surveyPlanNo" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="lga" class="block text-sm font-medium text-gray-700 mb-1">LGA</label>
                        <select id="lga" name="lga" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select LGA</option>
                            <option value="Ajingi">Ajingi</option>
                            <option value="Albasu">Albasu</option>
                            <option value="Bagwai">Bagwai</option>
                            <option value="Bebeji">Bebeji</option>
                            <option value="Bichi">Bichi</option>
                            <option value="Bunkure">Bunkure</option>
                            <option value="Dala">Dala</option>
                            <option value="Dambatta">Dambatta</option>
                            <option value="Dawakin-Kudu">Dawakin-Kudu</option>
                            <option value="Dawakin-Tofa">Dawakin-Tofa</option>
                            <option value="Doguwa">Doguwa</option>
                            <option value="Fagge">Fagge</option>
                            <option value="Gabasawa">Gabasawa</option>
                            <option value="Garko">Garko</option>
                            <option value="Garun-Mallam">Garun-Mallam</option>
                            <option value="Gaya">Gaya</option>
                            <option value="Gezawa">Gezawa</option>
                            <option value="Gwale">Gwale</option>
                            <option value="Gwarzo">Gwarzo</option>
                            <option value="Kabo">Kabo</option>
                            <option value="Kano-Municipal">Kano-Municipal</option>
                            <option value="Karaye">Karaye</option>
                            <option value="Kibiya">Kibiya</option>
                            <option value="Kiru">Kiru</option>
                            <option value="Kumbotso">Kumbotso</option>
                            <option value="Kunchi">Kunchi</option>
                            <option value="Kura">Kura</option>
                            <option value="Madobi">Madobi</option>
                            <option value="Makoda">Makoda</option>
                            <option value="Minjibir">Minjibir</option>
                            <option value="Nasarawa">Nasarawa</option>
                            <option value="Rano">Rano</option>
                            <option value="Rimin-Gado">Rimin-Gado</option>
                            <option value="Rogo">Rogo</option>
                            <option value="Shanono">Shanono</option>
                            <option value="Sumaila">Sumaila</option>
                            <option value="Takai">Takai</option>
                            <option value="Tarauni">Tarauni</option>
                            <option value="Tofa">Tofa</option>
                            <option value="Tsanyawa">Tsanyawa</option>
                            <option value="Tudun-Wada">Tudun-Wada</option>
                            <option value="Ungogo">Ungogo</option>
                            <option value="Warawa">Warawa</option>
                            <option value="Wudil">Wudil</option>
                        </select>
                    </div>
                    <div>
                        <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
                        <input type="text" id="district" name="district" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div> 
                    
                    <div>
                        <label for="plotNumber" class="block text-sm font-medium text-gray-700 mb-1">Plot Number </label>
                        <input type="text" id="plotNumber" name="plotNumber" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Size</label>
                        <input type="text" id="size" name="size" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="additionalPropertyAddress" class="block text-sm font-medium text-gray-700 mb-1">Property Address</label>
                    <textarea id="additionalPropertyAddress" name="PropertyAddress" rows="3" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>   
                
                <div class="mt-4">
                    <label for="propertyDescription" class="block text-sm font-medium text-gray-700 mb-1">Property Description</label>
                    <textarea id="propertyDescription" name="propertyDescription" rows="3" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>

            <!-- Receipt Information -->
       

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Submit Registration
                </button>
            </div>
        </form>
    
    
    </div>
    
    <script>
        // Toggle visibility of the file information div
        document.getElementById('myButton').addEventListener('click', function() {
            const div = document.getElementById('myDiv');
            if (div.style.display === 'none') {
                div.style.display = 'grid';
               // this.textContent = 'Hide File Number';
            } else {
                div.style.display = 'none';
               // this.textContent = 'Show File Number';
            }
        });
   
            // Function to update the preview
            function updatePreview() {
                const prefix = document.getElementById('fileNoPrefix').value;
                const number = document.getElementById('fileNumber').value;
                const suffix = document.getElementById('fileNoSuffix').value;
        
                // Default values for prefix and suffix (if empty)
                let prefixValue = prefix === "TempfileNoPrefix" ? "KN" : prefix;
                let suffixValue = suffix === "TempfileNoSuffix" ? "TEMP" : suffix;
        
                // Format the number with leading zeros, or handle empty case
                let formattedNumber = number ? String(number): '';
        
                // Format the preview value with slashes, or handle empty case
                let previewValue = '';
                if (prefixValue && formattedNumber && suffixValue) {
                    previewValue = `${prefixValue}/${formattedNumber}/${suffixValue}`;
                } else if (prefixValue && !formattedNumber && suffixValue){
                    previewValue = `${prefixValue}//${suffixValue}`;
                } else if (prefixValue && formattedNumber && !suffixValue){
                    previewValue = `${prefixValue}/${formattedNumber}/`;
                } else if (!prefixValue && formattedNumber && suffixValue){
                    previewValue = `/${formattedNumber}/${suffixValue}`;
                } else if (prefixValue && !formattedNumber && !suffixValue){
                    previewValue = `${prefixValue}//`;
                } else if (!prefixValue && formattedNumber && !suffixValue){
                    previewValue = `/${formattedNumber}/`;
                } else if (!prefixValue && !formattedNumber && suffixValue){
                    previewValue = `//${suffixValue}`;
                }
        
                // Update the preview field
                document.getElementById('Previewflenumber').value = previewValue;
            }
        
            // Initialize preview on page load
            document.addEventListener('DOMContentLoaded', function() {
                // Set the preview directly without calling updatePreview
                document.getElementById('Previewflenumber').value = "KN/TEMP/0001";
            });
        
            // Event listeners for real-time updates
            document.getElementById('fileNoPrefix').addEventListener('change', updatePreview);
            document.getElementById('fileNumber').addEventListener('input', updatePreview);
            document.getElementById('fileNoSuffix').addEventListener('change', updatePreview);
        
            // Event listener for the Enter File Number button
            document.getElementById('enterFileNumber').addEventListener('click', function() {
                let fileNumber = document.getElementById('fileNumber');
                let fileNoPrefix = document.getElementById('fileNoPrefix');
                let fileNoSuffix = document.getElementById('fileNoSuffix');
        
                // Enable fields
                fileNumber.disabled = false;
                fileNoPrefix.disabled = false;
                fileNoSuffix.disabled = false;
        
                // Clear values
                fileNumber.value = '';
                fileNoPrefix.value = '';
                fileNoSuffix.value = '';
        
                // Hide temp options
                fileNoPrefix.querySelector('option[value="TempfileNoPrefix"]').style.display = 'none';
                fileNoSuffix.querySelector('option[value="TempfileNoSuffix"]').style.display = 'none';
        
                // Clear the preview value when the Enter File Number button is clicked
                document.getElementById('Previewflenumber').value = '';
        
                // Set focus to the prefix field
                fileNoPrefix.focus();
            });
        
            // Event listener for the Enter Root Title button
            document.getElementById('enterRootTitleRegNo').addEventListener('click', function() {
                let rootTitleRegNo = document.getElementById('rootTitleRegNo');
                rootTitleRegNo.disabled = false;
                rootTitleRegNo.value = '';
                rootTitleRegNo.focus();
            });


            const button = document.getElementById('myButton');
const div = document.getElementById('myDiv');

</script>
      
           <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/instruments/powerOfAttorney.blade.php ENDPATH**/ ?>