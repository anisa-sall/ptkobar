<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purchase Order - PT. Kobar Indonesia</title>
  
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/ptkobarnobgnew.png') }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  
  <style>
    /* Copy semua style dari file PHP native */
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

    .sidebar.mobile-sidebar .nav-item.active .nav-link,
    .sidebar.sidebar-collapse .nav-item.active .nav-link,
    .sidebar.show .nav-item.active .nav-link {
      border-left-color: #0025f7ab !important;
      background: rgba(255, 255, 255, 0.05) !important;
    }

    .sidebar .sub-menu .nav-item.active .nav-link {
      border-left-color: #0025f7ab !important;
      background: rgba(255, 255, 255, 0.05) !important;
    }

    .sidebar .nav-item:hover .nav-link {
      background: rgba(255, 255, 255, 0.05) !important;
      color: #0025f7ab !important;
      border-left-color: #ffffff !important;
    }

    .sidebar .menu-title {
      font-weight: bold !important;
    }
    
    .sidebar .nav-item.active > .nav-link:hover .menu-title {
      color: #0824c2e1 !important;
    }

    .sidebar .nav-item.active > .nav-link:hover .menu-icon,
    .sidebar .nav-item.active > .nav-link:hover .menu-arrow {
      color: #ffffff !important;
    }

    .sidebar.show .nav-item:hover .menu-title {
      color: #ffffff !important;
    }

    .sidebar.show .nav-item:hover .menu-icon {
      color: #ffffff !important;
    }

    .sidebar .sub-menu .nav-item:hover .nav-link {
      background: rgba(255, 255, 255, 0.05) !important;
      color: #0025f7ab !important;
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

    select.form-control {
      color: #000 !important;
      background-color: #fff !important;
    }

    select.form-control option {
      color: #000 !important;
      background-color: #fff !important;
    }

    select.form-control:invalid {
      color: #6c757d !important;
    }

    select.form-control:valid {
      color: #000 !important;
    }

    select.form-control:hover,
    select.form-control:focus {
      color: #000 !important;
      background-color: #fff !important;
      border-color: #0025f7ab !important;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- Navbar -->
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
            <h3 class="welcome-text text-white fw-bold">PT. Kobar Indonesia</h3>
            <h4 class="welcome-sub-text text-light">Sustainable Metal Solutions for Your Supply Reliability</h4>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="{{ asset('images/faces/face30.png') }}" alt="Profile image">
            </a>
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

    <!-- MODAL LOGOUT -->
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

    <!-- Sidebar dan Main Content -->
    <div class="container-fluid page-body-wrapper"> 
      <nav class="sidebar sidebar-offcanvas sidebar-dark" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          @if(isset($menuAccess['customer']) && in_array($departemen, $menuAccess['customer']))
          <li class="nav-item">
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
          <li class="nav-item active">
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
      
      <!-- Main Content -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Purchase Order Baru</h4>
                  <p class="card-description">
                    Halaman Tambah Data Purchase Order PT. Kobar Indonesia
                  </p>
                  
                  <!-- NOTIFIKASI -->
                  @if(session('success') && session('success_type') === 'global')
                    <div class="alert-global success mb-3">
                      <i class="mdi mdi-check-circle"></i>
                      {{ session('success') }}
                    </div>
                  @endif
                  
                  @if(session('error') && session('error_type') === 'global')
                    <div class="alert-global error mb-3">
                      <i class="mdi mdi-alert-circle"></i>
                      {{ session('error') }}
                    </div>
                  @endif
                  
                  <form class="forms-sample" method="POST" action="{{ route('po.store') }}">
                    @csrf
                    <div class="form-group">
                      <label for="nopo">No. PO</label>
                      <input type="text" class="form-control @error('nopo') is-invalid @enderror" 
                             id="nopo" name="nopo" placeholder="Masukkan No. PO" 
                             value="{{ old('nopo') }}" required>
                      @error('nopo')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    
                    <div class="form-group">
                      <label for="idcustomer">Customer</label>
                      <select class="form-control @error('idcustomer') is-invalid @enderror" 
                              id="idcustomer" name="idcustomer" required>
                        <option value="" disabled selected hidden>Pilih Customer</option>
                        @foreach($customers as $customer)
                          <option value="{{ $customer->idcustomer }}" 
                            {{ old('idcustomer') == $customer->idcustomer ? 'selected' : '' }}>
                            {{ $customer->namacustomer }}
                          </option>
                        @endforeach
                      </select>
                      @error('idcustomer')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tglpo">Tanggal PO</label>
                          <input type="date" class="form-control @error('tglpo') is-invalid @enderror" 
                                 id="tglpo" name="tglpo" value="{{ old('tglpo') }}" required>
                          @error('tglpo')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="deliveryschedule">Delivery Schedule</label>
                          <input type="month" class="form-control @error('deliveryschedule') is-invalid @enderror" 
                                 id="deliveryschedule" name="deliveryschedule" 
                                 value="{{ old('deliveryschedule') }}" required>
                          @error('deliveryschedule')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="petugas">Petugas</label>
                      <input type="text" class="form-control" id="petugas" name="petugas" 
                             value="{{ $namapetugas }}" readonly>
                      <small class="form-text text-muted small" style="font-size: 0.7rem;">
                        Petugas terdeteksi otomatis dari sistem login
                      </small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="{{ route('po.index') }}" class="btn btn-secondary">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Footer -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
          </div>
        </footer>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>

  <script>
    // Hapus notifikasi global setelah 5 detik
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