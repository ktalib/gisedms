<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php if(trim($__env->yieldContent('template_title'))): ?><?php echo $__env->yieldContent('template_title'); ?> | <?php endif; ?> <?php echo e(trans('installer_messages.updater.title')); ?></title>
        <link rel="icon" type="image/png" href="<?php echo e(asset('installer/img/favicon/favicon-16x16.png')); ?>" sizes="16x16"/>
        <link rel="icon" type="image/png" href="<?php echo e(asset('installer/img/favicon/favicon-32x32.png')); ?>" sizes="32x32"/>
        <link rel="icon" type="image/png" href="<?php echo e(asset('installer/img/favicon/favicon-96x96.png')); ?>" sizes="96x96"/>
        <link href="<?php echo e(asset('installer/css/style.min.css')); ?>" rel="stylesheet"/>
        <?php echo $__env->yieldContent('style'); ?>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <div class="master">
            <div class="box">
                <div class="header">
                    <h1 class="header__title"><?php echo $__env->yieldContent('title'); ?></h1>
                </div>
                <ul class="step">
                    <li class="step__divider"></li>
                    <li class="step__item <?php echo e(isActive('LaravelUpdater::final')); ?>">
                        <i class="step__icon fa fa-database" aria-hidden="true"></i>
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item <?php echo e(isActive('LaravelUpdater::overview')); ?>">
                        <i class="step__icon fa fa-reorder" aria-hidden="true"></i>
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item <?php echo e(isActive('LaravelUpdater::welcome')); ?>">
                        <i class="step__icon fa fa-refresh" aria-hidden="true"></i>
                    </li>
                    <li class="step__divider"></li>
                </ul>
                <div class="main">
                    <?php echo $__env->yieldContent('container'); ?>
                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\wamp64\www\gisedms\resources\views/vendor/installer/layouts/master-update.blade.php ENDPATH**/ ?>