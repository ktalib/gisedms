
<?php $__env->startSection('page-title'); ?>
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e(__('Instrument Registration Module')); ?> <?php echo e($title); ?></li>
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
    </style>
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    


    <div class="container mx-auto mt-4 p-4">
 
        <form class="space-y-6" action="<?php echo e(route('instruments.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <!-- File Information -->
        
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="fileNumber" class="block text-sm font-medium text-gray-700 mb-1">File Number</label>
                    <input type="text" id="fileNumber" name="fileNumber" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="mt-2">
                        <button type="button" id="generateFileNumber" class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                            Generate New File Number (Optional)
                        </button>
                    </div>
                </div>
                <div>
                    <label for="fileSuffix" class="block text-sm font-medium text-gray-700 mb-1">File Suffix</label>
                    <input type="text" id="fileSuffix" name="fileSuffix" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
               
                <div>
                    <label for="rootTitleRegNo" class="block text-sm font-medium text-gray-700 mb-1">Root Title Reg No</label>
                    <input type="text" id="rootTitleRegNo" name="rootTitleRegNo" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="mt-2">
                        <button type="button" id="generateRootTitleRegNo" class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                            Generate Root Title Reg Particulars (Optional)
                        </button>
                    </div>
                </div>
        
            </div>
         
            <!-- Mortgagor & Mortgagee Information -->
            <div class="bg-gray-50 p-4 rounded-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Mortgagor & Mortgagee Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label for="mortgagorName" class="block text-sm font-medium text-gray-700 mb-1">Mortgagor Name</label>
                            <input type="text" id="mortgagorName" name="mortgagorName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="mortgagorAddress" class="block text-sm font-medium text-gray-700 mb-1">Mortgagor Address</label>
                            <textarea id="mortgagorAddress" name="mortgagorAddress" rows="3" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="mortgageeName" class="block text-sm font-medium text-gray-700 mb-1">Mortgagee Name</label>
                            <input type="text" id="mortgageeName" name="mortgageeName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="mortgageeAddress" class="block text-sm font-medium text-gray-700 mb-1">Mortgagee Address</label>
                            <textarea id="mortgageeAddress" name="mortgageeAddress" rows="3" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loan Details -->
            <div class="bg-gray-50 p-4 rounded-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Loan Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="loanAmount" class="block text-sm font-medium text-gray-700 mb-1">Loan Amount</label>
                        <input type="number" id="loanAmount" name="loanAmount" step="0.01" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="interestRate" class="block text-sm font-medium text-gray-700 mb-1">Interest Rate (%)</label>
                        <input type="number" id="interestRate" name="interestRate" step="0.01" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (Months)</label>
                        <input type="number" id="duration" name="duration" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Instrument Details -->
            <div class="bg-gray-50 p-4 rounded-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Instrument Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="InstructionName" class="block text-sm font-medium text-gray-700 mb-1">Instruction Name</label>
                        <input type="text" id="instructionName" name="instructionName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo e($title); ?>" readonly>
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
                        <label for="surveyInfo" class="block text-sm font-medium text-gray-700 mb-1">Survey Info</label>
                        <input type="checkbox" id="surveyInfo" name="surveyInfo" class="h-6 w-6 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
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
                        <label for="plotNumber" class="block text-sm font-medium text-gray-700 mb-1">Plot Number</label>
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
            </div>
   <br>
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Submit Registration
                </button>
            </div>
        </form> 
    </div>
    <script>
        document.getElementById('generateFileNumber').addEventListener('click', function() {
            const regNo = '<?php echo e($regNo); ?>';
            const newFileNumber = 'KN' + regNo;
            const newFileSuffix = 'NewKANGISFileNo';

          
            document.getElementById('fileNumber').value = newFileNumber;
            document.getElementById('fileSuffix').value = newFileSuffix;
        });

        document.getElementById('generateRootTitleRegNo').addEventListener('click', function()
        {
            const rootTitleRegNo = '<?php echo e($RootTitleRegNo); ?>';
            document.getElementById('rootTitleRegNo').value = rootTitleRegNo;
        });


    
    </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/instruments/deedOfMortgage.blade.php ENDPATH**/ ?>