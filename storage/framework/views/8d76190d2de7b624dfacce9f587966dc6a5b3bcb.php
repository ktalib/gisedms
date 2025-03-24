<?php $__env->startSection('title', trans('installer_messages.updater.final.title')); ?>
<?php $__env->startSection('container'); ?>
    <p class="paragraph text-center"><?php echo e(session('message')['message']); ?></p>
    <div class="buttons">
        <a href="<?php echo e(url('/')); ?>" class="button"><?php echo e(trans('installer_messages.updater.final.exit')); ?></a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master-update', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/vendor/installer/update/finished.blade.php ENDPATH**/ ?>