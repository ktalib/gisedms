<!doctype html>
<?php
    $settings = settings();

?>
<html lang="en">
<!-- [Head] start -->
<?php echo $__env->make('admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- [Head] end -->
<!-- [Body] Start -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body data-pc-preset="<?php echo e($settings['accent_color']); ?>" data-pc-sidebar-theme="light"
    data-pc-sidebar-caption="<?php echo e($settings['sidebar_caption']); ?>" data-pc-direction="<?php echo e($settings['theme_layout']); ?>"
    data-pc-theme="<?php echo e($settings['theme_mode']); ?>">
    <!-- [ Pre-loader ] start -->
    <style>
          input:disabled {
        background-color: #ececec; /* Light gray background color */   
        }

        select:disabled {
        background-color: #ececec; /* Light gray background color */   
        }
        
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        #preloader img {
            width: 100px; /* Adjust the size as needed */
            height: auto;
        }

        body.loading {
            overflow: hidden;
        }

        body.loading .pc-container {
            filter: blur(5px);
        }
    </style>
    <div id="preloader">
        <img src="http://localhost/gisedms/storage/upload/logo/1.png" alt="Loading...">
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var preloader = document.getElementById('preloader');
            document.body.classList.add('loading');
            setTimeout(function() {
                preloader.style.display = 'none';
                document.body.classList.remove('loading');
            }, 1000); // Adjust the time as needed
        });
    </script>
    <!-- [ Pre-loader ] End -->
        
        
    <!-- [ Sidebar Menu ] start -->
    <?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- [ Sidebar Menu ] end --> 
    <!-- [ Header Topbar ] start -->
    <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- [ Header ] end -->
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="page-header-title">
                                <h5 class="m-b-10"> <?php echo $__env->yieldContent('page-title'); ?></h5>
                            </div>
                        </div>
                        <div class="col-auto">
                            <ul class="breadcrumb">
                                <?php echo $__env->yieldContent('breadcrumb'); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            
            <?php echo $__env->make('admin.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- [ Main Content ] end -->
        </div>
    </div>

    <!-- [ Main Content ] end -->
    <?php echo $__env->make('admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="modal fade" id="customModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="body">
                </div>
            </div>
        </div>
    </div>
</body>
<!-- [Body] end -->

</html>
<?php /**PATH C:\wamp64\www\gisedms\resources\views/layouts/app.blade.php ENDPATH**/ ?>