
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
            <div>
              

                <label for="particularsRegistrationNumber" class="block text-sm font-medium text-gray-700 mb-1">Particulars Registration Number</label>
                <input type="text" id="particularsRegistrationNumber" name="particularsRegistrationNumber"  class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-bold text-red-600 text-lg" value="<?php echo e($particularsRegistrationNumber); ?>" readonly>
            </div> 
            <div class="bg-gray-50 p-4 rounded-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">File Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="fileNumber" class="block text-sm font-medium text-gray-700 mb-1">File Number</label>
                        <input type="text" id="fileNumber" name="fileNumber" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="fileSuffix" class="block text-sm font-medium text-gray-700 mb-1">File Suffix</label>
                        <input type="text" id="fileSuffix" name="fileSuffix" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                        <input type="text" id="InstructionName" name="InstructionName" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo e($title); ?>" readonly>
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
                        <label for="lgaDistrict" class="block text-sm font-medium text-gray-700 mb-1">LGA/District</label>
                        <input type="text" id="lgaDistrict" name="lgaDistrict" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="plotNumberSize" class="block text-sm font-medium text-gray-700 mb-1">Plot Number & Size</label>
                        <input type="text" id="plotNumberSize" name="plotNumberSize" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="mt-4">
                    <label for="additionalPropertyAddress" class="block text-sm font-medium text-gray-700 mb-1">Property Address</label>
                    <textarea id="propertyAddress" name="propertyAddress" rows="3" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>

          

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Submit Registration
                </button>
            </div>
        </form> 
    
    </div>
    
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/instruments/DeedOfMortgage.blade.php ENDPATH**/ ?>