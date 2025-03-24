<!DOCTYPE html>
<?php
    use App\Models\AuthPage;

    $settings = settings();
    $authPage = AuthPage::where('parent_id', 1)->first();
    $titles = $authPage && !empty($authPage->title) ? json_decode($authPage->title, true) : [];
    $descriptions = $authPage && !empty($authPage->description) ? json_decode($authPage->description, true) : [];
?>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(env('APP_NAME')); ?> - <?php echo $__env->yieldContent('tab-title'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="author" content="<?php echo e(!empty($settings['app_name']) ? $settings['app_name'] : env('APP_NAME')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(!empty($settings['app_name']) ? $settings['app_name'] : env('APP_NAME')); ?> - <?php echo $__env->yieldContent('page-title'); ?> </title>

    <meta name="title" content="<?php echo e($settings['meta_seo_title']); ?>">
    <meta name="keywords" content="<?php echo e($settings['meta_seo_keyword']); ?>">
    <meta name="description" content="<?php echo e($settings['meta_seo_description']); ?>">


    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($settings['meta_seo_title']); ?>">
    <meta property="og:description" content="<?php echo e($settings['meta_seo_description']); ?>">
    <meta property="og:image" content="<?php echo e(asset(Storage::url('upload/seo')) . '/' . $settings['meta_seo_image']); ?>">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($settings['meta_seo_title']); ?>">
    <meta property="twitter:description" content="<?php echo e($settings['meta_seo_description']); ?>">
    <meta property="twitter:image"
        content="<?php echo e(asset(Storage::url('upload/seo')) . '/' . $settings['meta_seo_image']); ?>">

    <link rel="icon" href="<?php echo e(asset(Storage::url('upload/logo')) . '/favicon.png'); ?>" type="image/x-icon" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        id="main-font-link" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/phosphor/duotone/style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-preset.css')); ?>" />
    <link href="<?php echo e(asset('css/custom.css')); ?> " rel="stylesheet">
</head>

<body data-pc-preset="<?php echo e($settings['accent_color']); ?>" data-pc-sidebar-theme="light"
    data-pc-sidebar-caption="<?php echo e($settings['sidebar_caption']); ?>" data-pc-direction="<?php echo e($settings['theme_layout']); ?>"
    data-pc-theme="<?php echo e($settings['theme_mode']); ?>">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <div class="auth-main">
        <div class="auth-wrapper v2">
            <div class="auth-form">
                <div class="logo">
                    <a href="<?php echo e(route('home')); ?>">
                        <img src="https://i.ibb.co/prJ1bYp9/Whats-App-Image-2025-02-21-at-5-25-59-AM.jpg" alt="logo" style="width: 150px; height: auto;" />
                      
                    </a>
<hr>
                    <P CLASS="TEXT-SECONDARY" STYLE="DISPLAY: INLINE;"><b>KLAS (KANO STATE LAND ADMIN SYSTEM)</b></P>
                    
                </div>

               

                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <?php if(!empty($authPage) && $authPage->section == 1): ?>
                <div class="auth-sidecontent">
                    <div class="p-3 px-lg-5 text-center">
                        <div id="carouselExampleIndicators" class="carousel slide carousel-dark"
                            data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                                        <h1><b><?php echo e($title); ?></b></h1>
                                        <p class="f-12 mt-4"><?php echo e($descriptions[$index] ?? ''); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="carousel-indicators position-relative">
                                <?php $__currentLoopData = $titles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="<?php echo e($index); ?>"
                                        class="<?php echo e($index == 0 ? 'active' : ''); ?>"
                                        aria-current="<?php echo e($index == 0 ? 'true' : 'false'); ?>"
                                        aria-label="Slide <?php echo e($index + 1); ?>"></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <img src="https://i.ibb.co/pSpyR5B/Whats-App-Image-2025-02-21-at-7-06-36-AM.jpg" alt="images"
                            class="img-fluid mt-3 w-75" />


                            

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/simplebar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/fonts/custom-font.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/pcoded.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('script-page'); ?>
    <script>
        font_change('Roboto');
    </script>
</body>

</html>
<?php /**PATH C:\wamp64\www\gisedms\resources\views/layouts/auth.blade.php ENDPATH**/ ?>