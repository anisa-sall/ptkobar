<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Customer - PT. Kobar Indonesia</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/ptkobarnobgnew.png') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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

  /* Category text */
  .sidebar .nav-category {
    color: rgba(255, 255, 255, 0.7) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
  }

  /* PERBAIKAN UNTUK HAMBURGER MENU */

  /* Pastikan selector lebih spesifik */
  .sidebar .nav-item.active > .nav-link {
      border-left-color: #0025f7ab  !important;
      background: rgba(255, 255, 255, 0.05) !important;
      color: #ffffff !important;
  }

  /* Untuk icon dan text dalam state active */
  .sidebar .nav-item.active > .nav-link .menu-icon,
  .sidebar .nav-item.active > .nav-link .menu-title,
  .sidebar .nav-item.active > .nav-link .menu-arrow {
      color: #ffffff !important;
  }


  /* Jika hamburger menu menggunakan class berbeda */
  .sidebar.mobile-sidebar .nav-item.active .nav-link,
  .sidebar.sidebar-collapse .nav-item.active .nav-link,
  .sidebar.show .nav-item.active .nav-link {
      border-left-color: #0025f7ab  !important;
      background: rgba(255, 255, 255, 0.05) !important;
      
  }

  /* Tambahkan juga untuk sub-menu items */
  .sidebar .sub-menu .nav-item.active .nav-link {
      border-left-color: #0025f7ab  !important;
      background: rgba(255, 255, 255, 0.05) !important;
  }

  /* HOVER EFFECT - PUTIH TRANSPARAN SEPERTI DI GAMBAR */
  .sidebar .nav-item:hover .nav-link {
      background: rgba(255, 255, 255, 0.05) !important;
      color: #0025f7ab !important;
      border-left-color: #ffffff !important;
  }

  .sidebar .menu-title {
    font-weight: bold !important;
  }
  
  /* Hanya target menu title saja */
  .sidebar .nav-item.active > .nav-link:hover .menu-title {
      color: #0824c2e1 !important;
  }

  /* Pastikan icon dan arrow tetap putih */
  .sidebar .nav-item.active > .nav-link:hover .menu-icon,
  .sidebar .nav-item.active > .nav-link:hover .menu-arrow {
      color: #ffffff !important;
  }

  /* Menu title saat hamburger menu aktif (terbuka) */
  .sidebar.show .nav-item:hover .menu-title {
      color: #ffffff !important;
  }

  /* Menu icon saat hamburger menu aktif (terbuka) */
  .sidebar.show .nav-item:hover .menu-icon {
      color: #ffffff !important;
  }

  /* Untuk sub-menu items pada hover */
  .sidebar .sub-menu .nav-item:hover .nav-link {
      background: rgba(255, 255, 255, 0.05) !important;
      color: #0025f7ab !important;
      
  }
  
  /* SUPER MINIMAL - ONLY BORDER CHANGE */
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

    /* STYLE UNTUK NOTIFIKASI GLOBAL (KHUSUS DUA NOTIFIKASI) */
  .alert-global {
      padding: 12px 16px;
      margin: 0 0 20px 0;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      border: 1px solid;
      animation: slideDown 0.3s ease-out;
  }

  .alert-global.error {
      background: #FEF2F2;
      color: #DC2626;
      border-color: #FECACA;
  }

  .alert-global.success {
      background: #F0FDF4;
      color: #16A34A;
      border-color: #BBF7D0;
  }

  .alert-global i {
      font-size: 16px;
  }

  @keyframes slideDown {
      from {
          opacity: 0;
          transform: translateY(-10px);
      }
      to {
          opacity: 1;
          transform: translateY(0);
      }
  }

  /* STYLE DEFAULT UNTUK NOTIFIKASI LAINNYA */
  .alert-default {
      padding: 0;
      margin: 0 0 16px 0;
      font-size: 14px;
      font-weight: 500;
      color: #dc2626;
      text-align: center;
      animation: fadeIn 0.3s ease-out;
  }

  @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
  }
  /* Ubah ukuran font header tabel saja */
  #customerTable thead th {
      font-size: 0.70rem;
  }
  
  </style>
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