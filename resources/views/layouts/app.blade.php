<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Dashboard - PT. Kobar Indonesia')</title>
    
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    
    <!-- Plugin css for this page -->
    @yield('plugin-css')
    <!-- End plugin css for this page -->
    
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/ptkobarnobgnew.png') }}" />
    
    <style>
    .sidebar {
        background: #232227 !important;
        background-color: #232227 !important;
        color: #ffffff !important;
    }

    .sidebar .nav-link {
        color: #ffffff !important;
    }

    .sidebar .nav-item.active .nav-link {
        background: rgba(255,255,255,0.1) !important;
    }

    .sidebar .menu-icon {
        color: #ffffff !important;
    }

    .sidebar .menu-arrow {
        color: #ffffff !important;
    }

    .sidebar .nav-category {
        color: rgba(255, 255, 255, 0.7) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
    }

    .sidebar .nav-item.active > .nav-link {
        border-left-color: #0025f7ab !important;
        background: rgba(255, 255, 255, 0.05) !important;
        color: #ffffff !important;
    }

    .sidebar .nav-item.active > .nav-link .menu-icon,
    .sidebar .nav-item.active > .nav-link .menu-title,
    .sidebar .nav-item.active > .nav-link .menu-arrow {
        color: #ffffff !important;
    }

    .sidebar .nav-item .nav-link {
        transition: border-left 0.2s ease !important;
        border-left: 3px solid transparent !important;
        border-radius: 0 !important;
    }

    .sidebar .nav-item:hover .nav-link {
        border-left-color: #ffffff !important;
    }

    .sidebar .nav-item.active .nav-link {
        border-left-color: #0025f7ab !important;
        background: rgba(255, 255, 255, 0.05) !important;
    }

    /* TAMBAHAN UNTUK ICON HOVER BIRU */
    .sidebar .nav-item:hover .nav-link .menu-icon {
        color: #2196F3 !important;
    }

    .sidebar .nav-item:hover .nav-link .mdi,
    .sidebar .nav-item:hover .nav-link .ti,
    .sidebar .nav-item:hover .nav-link .typcn,
    .sidebar .nav-item:hover .nav-link .icon {
        color: #2196F3 !important;
    }
    </style>
    
    @yield('styles')
</head>
<body>
    <div class="container-scroller"> 
        <!-- partial:partials/_navbar.html -->
        @include('layouts.partials.navbar')
        <!-- partial -->
        
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
                    <div class="sidebar-bg-options selected" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <!-- partial -->
            
            <!-- partial:partials/_sidebar.html -->
            @include('layouts.partials.sidebar')
            <!-- partial -->
            
            <div class="main-panel">
                @yield('content')
                
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.
                        </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            Copyright © {{ date('Y') }}. All rights reserved.
                        </span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    
    <!-- Plugin js for this page -->
    @yield('plugin-js')
    <!-- End plugin js for this page -->
    
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    
    @yield('scripts')
</body>
</html>