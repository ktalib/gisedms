
<?php $__env->startSection('page-title'); ?>
    <?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item" aria-current="page"> <?php echo e($title); ?></li>
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

    @media print {
        body {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    .red-box {
        border: 1px solid #c41e3a;
        color: #c41e3a;
    }
</style>
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <br>
    <br>
    <div class="max-w-4xl mx-auto bg-white p-6 shadow-md container mx-auto mt-4 p-4">
        <!-- 2x2 Grid of Certificates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Certificate 1 -->


            <?php for($i = 0; $i < 4; $i++): ?>
                <div class="border border-gray-300 p-2 bg-white">
                    <div class="flex justify-between items-center mb-2">
                        <!-- Nigerian Coat of Arms -->
                        <div class="w-16">

                            <div class="flex flex-col items-center">
                                <img src="https://i.ibb.co/60m0yNx7/Whats-App-Image-2025-02-28-at-4-01-36-PM-1.jpg"
                                    alt="Nigerian Coat of Arms" class="w-12 h-12 object-contain  ">
                            </div>
                        </div>

                        <!-- Registration Number -->
                        <div class="text-center">
                            <p class="text-sm font-bold">458669</p>
                        </div>

                        <!-- Official Seal -->
                        <div class="w-16">
                            <div
                                class="w-12 h-12 rounded-full border-2 border-gray-400 flex items-center justify-center mx-auto">
                                <div class="w-10 h-10 rounded-full border border-gray-400 flex items-center justify-center">
                                    <img src="https://i.ibb.co/prw0q9jx/Whats-App-Image-2025-02-28-at-4-01-36-PM.jpg"
                                        alt="Nigerian Coat of Arms" class="w-12 h-12 object-contain  ">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="text-center mb-2">
                        <h2 class="text-xs font-bold">CONFIRMATION OF REGISTRATION OF INSTRUMENT</h2>
                    </div>

                    <!-- Red Box 1 -->
                    <div class="red-box p-2 mb-2 text-[10px] leading-tight">
                        <p>THIS POWER OF ATTORNEY WAS DELIVERED TO ME FOR REGISTRATION BY</p>
                        <p class="font-bold">MUSA  ORALETE OF DALA L.G.A</p>
                        <p>AT 12 O'CLOCK IN THE AFTERNOON</p>
                        <p>ON THE 7TH DAY OF MARCH 2025</p>
                        <p class="text-center mt-1">REGISTRAR OF DEEDS
                        </p>
                        <div class="mt-2">
                            <p>Signature: -------------------------------------------------------------------------</p>
                            <br><br>
                            <p>Date: ------------------------------------------------------------------------------------</p>
                        </div>
                        <br>
                        <br>

                        <!-- Land Deeds Registry Office -->
                        <div class="text-center text-[10px] mb-2">
                            <p class="font-bold" style="color:black">DEEDS REGISTRY </p>

                            <p class="font-bold" style="color:black">MDEEDS DEPARTMENT</p>
                                <p class="font-bold" style="color:black">
                                MINISTRY OF LANDS AND PHYSICAL PLANNING
                                </p>
                            <p class="font-bold " style="color:black">KANO STATE</p>
                        </div>
                    </div>



                    <!-- Red Box 2 -->
                    <div class="red-box p-2 mb-2 text-[10px] leading-tight">
                        <p>THIS POWER OF ATTORNEY IS REGISTERED AS</p>
                        <br>
                        <p>NO <strong>42</strong> AT PAGE <strong>42</strong> IN VOLUME <strong>277</strong></p>
                        <br>
                        <p>OF THE MINISTRY OF LAND AND PHYSICAL PLANNING</p>
                        <br>
                        <p>AT KANO STATE</p>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-between items-center text-[8px]">
                        <p>Generated by Kano State Land Admin System (KLAS)</p>
                        <div class="w-4 h-4 rounded-full bg-red-700 flex items-center justify-center text-white text-[6px]">
                           <img src="https://i.ibb.co/pSpyR5B/Whats-App-Image-2025-02-21-at-7-06-36-AM.jpg">
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
 
           
          
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/instruments/Coroi.blade.php ENDPATH**/ ?>