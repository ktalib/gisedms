<?php $__env->startSection('title', trans('installer_messages.updater.welcome.title')); ?>
<?php $__env->startSection('container'); ?>
    <p class="paragraph text-center"><?php echo e(trans_choice('installer_messages.updater.overview.message', $numberOfUpdatesPending, ['number' => $numberOfUpdatesPending])); ?></p>
    <div class="buttons">
        <a href="<?php echo e(route('LaravelUpdater::database')); ?>" class="button"><?php echo e(trans('installer_messages.updater.overview.install_updates')); ?></a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master-update', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\gisedms\resources\views/vendor/installer/update/overview.blade.php ENDPATH**/ ?>