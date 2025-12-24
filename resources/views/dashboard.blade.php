<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard - PT. Kobar Indonesia</title>
  
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  
  <!-- Dashboard specific plugins -->
  <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('js/select.dataTables.min.css') }}">
  
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
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row navbar-dark bg-dark">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start bg-dark">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu text-white"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/ptkobarnobgnew.png') }}" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/ptkobarnobgnew.png') }}" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text text-white">Selamat Datang, <span class="text-white fw-bold">{{ Auth::check() ? Auth::user()->name : 'User' }}</span></h1>
                <h4 class="welcome-sub-text text-light">Your performance summary this week </h4>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="{{ asset('images/faces/face30.png') }}" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown border-0" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="{{ asset('images/faces/face30.png') }}" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold">{{ $namapetugas }}</p>
                <p class="fw-light text-muted mb-0">{{ $email }}</p>
              </div>
              <a class="dropdown-item" style="border-bottom: none;" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                  <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>

    <!-- MODAL KONFIRMASI LOGOUT -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px; margin: 0 auto;">
            <div class="modal-content" style="max-height: 200px; overflow: hidden;">
                <div class="modal-header py-2" style="border-bottom: 1px solid #dee2e6;">
                    <h6 class="modal-title fs-6 m-0">Konfirmasi Logout</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-2">
                    <p class="m-0">Yakin ingin keluar dari aplikasi?</p>
                </div>
                <div class="modal-footer py-2" style="border-top: 1px solid #ffffffff;">
                <button type="button" class="btn btn-secondary btn-sm rounded-1" data-bs-dismiss="modal">Batal</button>
                
                <!-- UBAH INI: dari <a> tag menjadi form -->
                <form method="POST" action="{{ route('logout') }}" id="logoutForm" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm rounded-1">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper"> 
      <nav class="sidebar sidebar-offcanvas sidebar-dark" id="sidebar">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(isset($menuAccess['customer']) && in_array($departemen, $menuAccess['customer']))
          <li class="nav-item" id="customer-menu">
              <a class="nav-link" href="{{ route('customer.index') }}">
                  <i class="menu-icon mdi mdi-account-search"></i>
                  <span class="menu-title">Customer</span>
              </a>
          </li>
          @endif
          @if(isset($menuAccess['part']) && in_array($departemen, $menuAccess['part']))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('part.index') }}">
              <i class="menu-icon mdi mdi-cube-outline"></i>
              <span class="menu-title">Part</span>
            </a>
          </li>
          @endif
          @if(isset($menuAccess['petugas']) && in_array($departemen, $menuAccess['petugas']))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
              <i class="menu-icon mdi mdi-account-check"></i>
              <span class="menu-title">Petugas</span>
            </a>
          </li>
          @endif
          @if(isset($menuAccess['kendaraan']) && in_array($departemen, $menuAccess['kendaraan']))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('kendaraan.index') }}">
              <i class="menu-icon mdi mdi-car"></i>
              <span class="menu-title">Kendaraan</span>
            </a>
          </li>
          @endif
          @if(isset($menuAccess['po']) && in_array($departemen, $menuAccess['po']))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('po.index') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Purchase Order</span>
            </a>
          </li>
          @endif
          @if(isset($menuAccess['suratjalan']) && in_array($departemen, $menuAccess['suratjalan']))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('suratjalan.index') }}">
              <i class="menu-icon mdi mdi-file-find"></i>
              <span class="menu-title">Surat Jalan</span>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <!-- CONTENT DASHBOARD -->
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="statistics-details d-flex align-items-center justify-content-between">
                                            <!-- METRIK 1 (Your Today's Work) -->
                                            <div>
                                                <p class="statistics-title">Your Today's Work</p>
                                                <h3 class="rate-percentage" id="user-today-work">{{ $today_count ?? 0 }}</h3>
                                                <p class="text-success d-flex">
                                                    <i class="mdi mdi-check-circle"></i>
                                                    <span id="today-change">+0%</span>
                                                </p>
                                            </div>

                                            <!-- METRIK 2 (Your This Week) -->
                                            <div>
                                                <p class="statistics-title">Your This Week</p>
                                                <h3 class="rate-percentage" id="user-this-week">{{ $this_week ?? 0 }}</h3>
                                                <p class="text-warning d-flex">
                                                    <i class="mdi mdi-calendar-week"></i>
                                                    <span id="week-change">0%</span>
                                                </p>
                                            </div>

                                            <!-- METRIK 3 (Your Efficiency) -->
                                            <div>
                                                <p class="statistics-title">{{ $efficiency_title ?? 'Your Efficiency' }}</p>
                                                <h3 class="rate-percentage">{{ $efficiency_value ?? '0%' }}</h3>
                                                <p class="{{ $efficiency_color ?? 'text-muted' }} d-flex">
                                                    <i class="mdi {{ $efficiency_icon ?? 'mdi-speedometer' }}"></i>
                                                    <span>{{ $efficiency_subtext ?? '0/0' }}</span>
                                                </p>
                                            </div>

                                            <!-- METRIK 4: Your PO Value -->
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Your PO Value</p>
                                                <h3 class="rate-percentage" id="user-po-value">Rp 2.5 jt</h3>
                                                <p class="text-warning d-flex">
                                                    <i class="mdi mdi-cash"></i>
                                                    <span id="po-value-change">Medium</span>
                                                </p>
                                            </div>

                                            <!-- METRIK 5: Your Accuracy -->
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Your Data Accuracy</p>
                                                <h3 class="rate-percentage" id="user-accuracy">92%</h3>
                                                <p class="text-success d-flex">
                                                    <i class="mdi mdi-check-decagram"></i>
                                                    <span id="accuracy-change">Excellent</span>
                                                </p>
                                            </div>

                                            <!-- METRIK 6: Your Activity Score -->
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Your Activity Score</p>
                                                <h3 class="rate-percentage" id="user-score">85</h3>
                                                <p class="text-success d-flex">
                                                    <i class="mdi mdi-star-circle"></i>
                                                    <span id="score-change">Excellent</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="row">
                                    <div class="col-lg-8 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="d-sm-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">Data Surat Jalan Keluar</h4>
                                                                <div id="performance-date-range" class="text-muted small mt-1" style="font-size: 0.7rem;">
                                                                    Periode: ({{ $current_week_range ?? '14 Jan - 20 Jan' }}) - ({{ $last_week_range ?? '7 Jan - 13 Jan' }})
                                                                </div>
                                                            </div>
                                                            <div id="performance-line-legend"></div>
                                                        </div>
                                                        <div class="chartjs-wrapper mt-5">
                                                            <canvas id="performaneLine"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                <div class="card bg-primary card-rounded">
                                                    <div class="card-body pb-0">
                                                        <h4 class="card-title card-title-dash text-white mb-4">Status Summary Invoice</h4>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p class="status-summary-ight-white mb-1">Invoices This Month</p>
                                                                <h2 class="text-info">{{ $invoice_count ?? 0 }}</h2>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="status-summary-chart-wrapper pb-4">
                                                                    <canvas id="status-summary"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="circle-progress-width">
                                                                        <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-small text-muted mb-2">Critical Stock</p>
                                                                        <h4 class="mb-0 fw-bold">{{ $critical_percentage ?? 0 }}%</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div class="circle-progress-width">
                                                                        <div id="visitperday" class="progressbar-js-circle pr-2"></div>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-small text-muted mb-2">Restocking</p>
                                                                        <h4 class="mb-0 fw-bold">{{ $restock_items ?? 0 }}</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-8 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="col-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="d-sm-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">Data Penjualan Part</h4>
                                                                <p class="card-subtitle card-subtitle-dash">Analisis penjualan part berdasarkan nominal dan tren per bulan</p>
                                                            </div>
                                                            <div>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" 
                                                                            type="button" 
                                                                            id="dropdownMenuButton2" 
                                                                            data-bs-toggle="dropdown" 
                                                                            aria-haspopup="true" 
                                                                            aria-expanded="false">
                                                                        <span id="selected-part-name">
                                                                            {{ $selected_part_name ?? 'Pilih Part' }}
                                                                        </span>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2" style="max-height: 300px; overflow-y: auto;">
                                                                        <h6 class="dropdown-header">Daftar Part</h6>
                                                                        @if(!empty($parts))
                                                                            @foreach($parts as $part)
                                                                                <a class="dropdown-item select-part" 
                                                                                href="{{ url('/dashboard?selected_part=' . urlencode($part->nopart)) }}">
                                                                                    {{ $part->namapart }}
                                                                                </a>
                                                                            @endforeach
                                                                        @else
                                                                            <a class="dropdown-item text-muted">Tidak ada data part</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                            <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                                <h2 class="me-2 fw-bold" id="total-current-year">
                                                                    Rp {{ number_format($total_current_year ?? 0, 0, ',', '.') }}
                                                                </h2>
                                                                <h4 class="me-2">Tahun {{ date('Y') }}</h4>
                                                                @if(isset($has_comparison_data) && $has_comparison_data && isset($percentage_change))
                                                                    <h4 class="{{ $percentage_class ?? 'text-muted' }}" id="percentage-change">
                                                                        ({{ ($percentage_change >= 0 ? '+' : '') . number_format($percentage_change, 1) }}%)
                                                                    </h4>
                                                                @else
                                                                    <h4 class="text-muted" id="percentage-change">(+0.0%)</h4>
                                                                @endif
                                                            </div>
                                                            <div class="me-3">
                                                                <div id="marketing-overview-legend"></div>
                                                            </div>
                                                        </div>
                                                        <div class="chartjs-bar-wrapper mt-3">
                                                            <canvas id="marketingOverview"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="col-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                                    <h4 class="card-title card-title-dash">Status Purchase Order</h4>
                                                                </div>
                                                                <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                                                                <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
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
  <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>
  <!-- End plugin js for this page -->
  
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  
  <!-- Dashboard scripts -->
  <script src="{{ asset('js/dashboard.js') }}?v={{ time() }}"></script>
  <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>

  <script>
  // Data untuk JavaScript charts
  var dynamicDoughnutData = {
      labels: {!! json_encode($po_status_labels ?? ['OPEN', 'PARTIAL', 'CLOSED']) !!},
      datasets: [{
          data: {!! json_encode($po_status_data ?? [0, 0, 0]) !!},
          backgroundColor: {!! json_encode($po_status_colors_array ?? ['#1F3BB3', '#FDD0C7', '#52CDFF']) !!},
          borderWidth: 2,
          hoverOffset: 15
      }]
  };

  var statusSummaryChartData = {
      labels: {!! json_encode($status_labels ?? ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI']) !!},
      data: {!! json_encode($status_data ?? [0, 0, 0, 0, 0, 0]) !!}
  };

  var marketOverviewChartData = {
      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      currentYearData: {!! json_encode($current_year_data ?? []) !!},
      lastYearData: {!! json_encode($last_year_data ?? []) !!},
      selectedPart: "{{ $selected_part_id ?? '' }}",
      selectedPartName: "{{ $selected_part_name ?? 'Pilih Part' }}",
      totalCurrentYear: {{ $total_current_year ?? 0 }},
      totalLastYear: {{ $total_last_year ?? 0 }},
      currentYear: {{ date('Y') }},
      lastYear: {{ date('Y') - 1 }},
      hasComparisonData: {{ isset($has_comparison_data) ? 'true' : 'false' }},
      percentageChange: {{ $percentage_change ?? 0 }},
      percentageClass: "{{ $percentage_class ?? 'text-success' }}"
  };

  var performanceLineChartData = {
      labels: {!! json_encode($days_of_week ?? ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT']) !!},
      currentWeekData: {!! json_encode($current_week_data ?? []) !!},
      lastWeekData: {!! json_encode($last_week_data ?? []) !!},
      currentWeekRange: "{{ $current_week_range ?? '' }}",
      lastWeekRange: "{{ $last_week_range ?? '' }}"
  };

  // HAPUS NOTIFIKASI GLOBAL SETELAH 8 DETIK
  document.addEventListener('DOMContentLoaded', function() {
      const globalAlerts = document.querySelectorAll('.alert-global');
      
      globalAlerts.forEach(function(alert) {
          setTimeout(() => {
              alert.style.opacity = '0';
              alert.style.transform = 'translateY(-10px)';
              alert.style.transition = 'all 0.3s ease-out';
              
              setTimeout(() => {
                  if (alert.parentNode) {
                      alert.remove();
                  }
              }, 300);
          }, 5000);
      });
  });
  </script>
</body>
</html>