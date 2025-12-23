<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tambah Part - PT. Kobar Indonesia</title>
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

  /* Style untuk input harga dengan format Rupiah */
  .input-group-text {
      background-color: #f8f9fa;
      border-right: none;
  }
  
  .rupiah-input {
      border-left: none;
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
            <h3 class="welcome-text text-white fw-bold">PT. Kobar Indonesia</h3>
            <h4 class="welcome-sub-text text-light"> Sustainable Metal Solutions for Your Supply Reliability </h4>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="{{ asset('images/faces/face30.png') }}" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown border-0" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="{{ asset('images/faces/face30.png') }}" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->namapetugas ?? 'Petugas' }}</p>
                <p class="fw-light text-muted mb-0">{{ Auth::user()->email ?? 'email@example.com' }}</p>
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
                    <a href="{{ route('logout') }}" class="btn btn-primary btn-sm rounded-1">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper"> 
      <nav class="sidebar sidebar-offcanvas sidebar-dark" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(isset($menuAccess['customer']) && in_array(Auth::user()->departemen ?? '', $menuAccess['customer']))
             <li class="nav-item" id="customer-menu">
              <a class="nav-link" href="{{ route('customer.index') }}">
                  <i class="menu-icon mdi mdi-account-search"></i>
                  <span class="menu-title">Customer</span>
              </a>
          </li>
            @endif
          @if(isset($menuAccess['part']) && in_array($departemen, $menuAccess['part']))
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('part.index') }}">
                    <i class="menu-icon mdi mdi-cube-outline"></i>
                    <span class="menu-title">Part</span>
                </a>
            </li>
            @endif
          @if(isset($menuAccess['petugas']) && in_array($departemen, $menuAccess['petugas']))
            <li class="nav-item">
                <a class="nav-link" href="#">
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
                <a class="nav-link" href="#">
                    <i class="menu-icon mdi mdi-file-document"></i>
                    <span class="menu-title">Purchase Order</span>
                </a>
            </li>
            @endif
          @if(isset($menuAccess['suratjalan']) && in_array($departemen, $menuAccess['suratjalan']))
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="menu-icon mdi mdi-file-find"></i>
                    <span class="menu-title">Surat Jalan</span>
                </a>
            </li>
            @endif
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">                 
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <h4 class="card-title">Tambah Part</h4>
                      <p class="card-description mb-0">
                        Halaman Tambah Data Part PT. Kobar Indonesia
                      </p>
                    </div>
                    
                  </div>

                  <!-- NOTIFIKASI SUCCESS GLOBAL -->
                  @if(session('success') && session('success_type') === 'global')
                      <div class="alert-global success">
                          <i class="mdi mdi-check-circle"></i>
                          {{ session('success') }}
                      </div>
                  @endif

                  <!-- NOTIFIKASI ERROR GLOBAL -->
                  @if(session('error') && session('error_type') === 'global')
                      <div class="alert-global error">
                          <i class="mdi mdi-alert-circle"></i>
                          {{ session('error') }}
                      </div>
                  @endif

                  <!-- FORM TAMBAH PART -->
                  <form method="POST" action="{{ route('part.store') }}">
                    @csrf
                    
                    <div class="row">
                      <div class="col-md-12">
                       <div class="mb-3">
  <label class="form-label">Nomor Part *</label>
  <input type="text" class="form-control @error('nopart') is-invalid @enderror"
         name="nopart" value="{{ old('nopart') }}" required>
  @error('nopart')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Nama Part *</label>
  <input type="text" class="form-control @error('namapart') is-invalid @enderror"
         name="namapart" value="{{ old('namapart') }}" required>
  @error('namapart')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">Harga (Rp) *</label>
  <div class="input-group">
    <span class="input-group-text">Rp</span>
    <input type="text"
           class="form-control @error('harga') is-invalid @enderror"
           name="harga"
           id="harga"
           value="{{ old('harga') }}"
           oninput="formatRupiah(this)"
           required>
    @error('harga')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

                        <div class="d-flex gap-2">
                          <button type="submit" class="btn btn-primary">
                            <i></i>Simpan
                          </button>
                          <button type="reset" class="btn btn-light">
                            <i ></i>Reset
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
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
  <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>

  <script>
  // Cek pathname dan tambahkan class active jika mengandung 'part'
  if (window.location.pathname.includes('part')) {
      const partMenu = document.querySelector('a[href*="part"]');
      if (partMenu) {
          partMenu.parentElement.classList.add('active');
      }
  }
  </script>

  <script>
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

  <script>
  // Format Rupiah untuk input harga
  function formatRupiah(input) {
      // Hapus semua karakter selain angka
      let value = input.value.replace(/\D/g, '');
      
      // Format dengan titik sebagai pemisah ribuan
      if (value.length > 0) {
          value = parseInt(value).toLocaleString('id-ID');
      }
      
      // Set nilai kembali ke input
      input.value = value;
  }

  // Form validation
  document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('form');
      
      form.addEventListener('submit', function(e) {
          const nomorPart = document.getElementById('nomor_part').value.trim();
          const namaPart = document.getElementById('nama_part').value.trim();
          const harga = document.getElementById('harga').value.trim();
          
          if (!nomorPart) {
              e.preventDefault();
              alert('Nomor Part harus diisi');
              document.getElementById('nomor_part').focus();
              return false;
          }
          
          if (!namaPart) {
              e.preventDefault();
              alert('Nama Part harus diisi');
              document.getElementById('nama_part').focus();
              return false;
          }
          
          if (!harga) {
              e.preventDefault();
              alert('Harga harus diisi');
              document.getElementById('harga').focus();
              return false;
          }
          
          // Konversi harga ke format numerik sebelum submit
          const hargaNumerik = harga.replace(/\./g, '');
          // Buat input hidden untuk mengirim harga dalam format numerik
          const hiddenInput = document.createElement('input');
          hiddenInput.type = 'hidden';
          hiddenInput.name = 'harga_numerik';
          hiddenInput.value = hargaNumerik;
          form.appendChild(hiddenInput);
      });
  });
  </script>
</body>
</html>