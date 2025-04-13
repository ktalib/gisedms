<!doctype html>
@php
    $settings = settings();

@endphp
<html lang="en">
<!-- [Head] start -->
@include('admin.head')

<!-- [Head] end -->
<!-- [Body] Start -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body data-pc-preset="{{ $settings['accent_color'] }}" data-pc-sidebar-theme="light"
    data-pc-sidebar-caption="{{ $settings['sidebar_caption'] }}" data-pc-direction="{{ $settings['theme_layout'] }}"
    data-pc-theme="{{ $settings['theme_mode'] }}">
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
    @include('admin.menu')
    <!-- [ Sidebar Menu ] end --> 
    <!-- [ Header Topbar ] start -->
    @include('admin.header')
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
                                <h5 class="m-b-10"> @yield('page-title')</h5>
                            </div>
                        </div>
                        <div class="col-auto">
                            <ul class="breadcrumb">
                                @yield('breadcrumb')
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


            <!-- [ Main Content ] start -->
            
            @include('admin.content')

            <!-- [ Main Content ] end -->
        </div>
    </div>

    <!-- [ Main Content ] end -->
    @include('admin.footer')

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
