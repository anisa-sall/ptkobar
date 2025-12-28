<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tambah Detail Surat Jalan - PT. Kobar Indonesia</title>
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

  /* PERBAIKAN UNTUK DROPDOWN DEPARTEMEN */
    select.form-control {
        color: #000 !important;
        background-color: #fff !important;
    }

    select.form-control option {
        color: #000 !important;
        background-color: #fff !important;
    }

    /* Untuk placeholder yang terlihat samar */
    select.form-control:invalid {
        color: #6c757d !important;
    }

    select.form-control:valid {
        color: #000 !important;
    }

    /* Pastikan dropdown terlihat jelas saat hover dan focus */
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
            <h4 class="welcome-sub-text text-light">Sustainable Metal Solutions for Your Supply Reliability </h4>
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
          @php
              function hasAccess($menuName, $departemen, $menuAccess) {
                  return isset($menuAccess[$menuName]) && in_array($departemen, $menuAccess[$menuName]);
              }
          @endphp
          
          @if (hasAccess('customer', $departemen, $menuAccess))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('customer.index') }}">
                  <i class="menu-icon mdi mdi-account-search"></i>
                  <span class="menu-title">Customer</span>
              </a>
          </li>
          @endif
          
          @if (hasAccess('part', $departemen, $menuAccess))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('part.index') }}">
              <i class="menu-icon mdi mdi mdi-cube-outline"></i>
              <span class="menu-title">Part</span>
            </a>
          </li>
          @endif
          
          @if (hasAccess('petugas', $departemen, $menuAccess))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
              <i class="menu-icon mdi mdi-account-check"></i>
              <span class="menu-title">Petugas</span>
            </a>
          </li>
          @endif
          
          @if (hasAccess('kendaraan', $departemen, $menuAccess))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('kendaraan.index') }}">
              <i class="menu-icon mdi mdi-car"></i>
              <span class="menu-title">Kendaraan</span>
            </a>
          </li>
          @endif
          
          @if (hasAccess('po', $departemen, $menuAccess))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('po.index') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Purchase Order</span>
            </a>
          </li>
          @endif
          
          <!-- MENU STOK PART DIHAPUS -->
          
          @if (hasAccess('suratjalan', $departemen, $menuAccess))
          <li class="nav-item active" id="suratjalan-menu">
            <a class="nav-link" href="{{ route('suratjalan.index') }}">
              <i class="menu-icon mdi mdi-file-find"></i>
              <span class="menu-title">Surat Jalan</span>
            </a>
          </li>
          @endif
          
          <!-- MENU INVOICE DIHAPUS -->
          
          <!-- MENU LAPORAN DIHAPUS -->
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!-- Notifikasi -->
          @if(session('error_type') == 'global' && session('error'))
          <div class="alert-global error">
              <i class="mdi mdi-alert-circle-outline"></i>
              {{ session('error') }}
          </div>
          @endif
          
          @if(session('success_type') == 'global' && session('success'))
          <div class="alert-global success">
              <i class="mdi mdi-check-circle-outline"></i>
              {{ session('success') }}
          </div>
          @endif
          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <h4 class="card-title">Tambah Part ke Surat Jalan</h4>
                      <p class="card-description">
                        Halaman Tambah Data Detail Surat Jalan PT. Kobar Indonesia
                      </p>
                    </div>
                  </div>
                  
                  <!-- NOTIFIKASI ERROR -->
                  @if(session('error') && session('error_type') === 'global')
                  <div class="alert-global error mb-3">
                      <i class="mdi mdi-alert-circle"></i>
                      {{ session('error') }}
                  </div>
                  @endif

                  @if($errors->any())
                  <div class="alert-global error mb-3">
                    <i class="mdi mdi-alert-circle"></i>
                    @foreach($errors->all() as $error)
                      {{ $error }}<br>
                    @endforeach
                  </div>
                  @endif
                  
                  <form class="forms-sample" method="POST" action="{{ route('detailsuratjalan.store', $suratjalan->nosuratjalan) }}">
                    @csrf
                    
                    <div class="form-group">
                      <label for="nopart">Pilih Part</label>
                      <select class="form-control" id="nopart" name="nopart" required onchange="updatePartInfo()"
                              style="color: #000000 !important; background-color: #ffffff !important; border: 1px solid #ced4da !important;">
                        <option value="" disabled selected style="color: #6c757d !important; background-color: #ffffff !important;">Pilih Part</option>
                        @if($availableParts->count() > 0)
                          @foreach($availableParts as $part)
                            <option value="{{ $part->nopart }}" 
                              data-nama="{{ $part->namapart }}"
                              data-harga="{{ $part->harga }}"
                              data-unit="{{ $part->unit }}"
                              data-sisa="{{ $part->sisa_po }}"
                              data-po_qty="{{ $part->po_quantity }}"
                              data-terkirim="{{ $part->total_dikirim }}">
                              {{ $part->nopart }} - {{ $part->namapart }} (Sisa PO: {{ $part->sisa_po }} {{ $part->unit }})
                            </option>
                          @endforeach
                        @else
                          <option value="" disabled selected style="color: #6c757d !important; background-color: #ffffff !important;">
                            Tidak ada part yang tersedia (Semua part sudah dikirim)
                          </option>
                        @endif
                      </select>
                    </div>
                    
                    <!-- INFO PART TERPILIH -->
                    <div class="card mb-4" id="partInfoCard" style="display: none; border: 1px solid #dee2e6; border-radius: 8px;">
                      <div class="card-body">
                        <h6 class="card-title mb-3">Informasi Part</h6>
                        <div class="row">
                          <div class="col-md-6">
                            <p><strong>Nama Part:</strong> <span id="infoNama">-</span></p>
                            <p><strong>Harga:</strong> Rp <span id="infoHarga">0</span></p>
                            <p><strong>Unit:</strong> <span id="infoUnit">-</span></p>
                          </div>
                          <div class="col-md-6">
                            <p><strong>Quantity di PO:</strong> <span id="infoPoQty">0</span> <span id="infoUnit2">-</span></p>
                            <p><strong>Sudah Dikirim:</strong> <span id="infoTerkirim">0</span> <span id="infoUnit3">-</span></p>
                            <p><strong>Sisa PO:</strong> <span id="infoSisa" class="fw-bold">0</span> <span id="infoUnit4">-</span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="quantity">Quantity</label>
                          <input type="number" class="form-control" id="quantity" name="quantity" 
                                 placeholder="0" min="1" required oninput="validateQuantity()">
                          <small class="text-muted">Stok tersedia: <span id="maxQuantity">0</span> <span id="maxUnit"></span></small>
                          <div class="text-danger small mt-1" id="quantityError"></div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="keterangan">Keterangan</label>
                          <input type="text" class="form-control" id="keterangan" name="keterangan" 
                                 placeholder="Masukkan keterangan (opsional)" 
                                 value="{{ old('keterangan') }}">
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary me-2" id="submitBtn">Submit</button>
                    <a href="{{ route('detailsuratjalan.index', $suratjalan->nosuratjalan) }}" class="btn btn-light">Cancel</a>
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
    // Cek pathname dan tambahkan class active jika mengandung 'suratjalan' atau 'detailsuratjalan'
    const currentPath = window.location.pathname;
    const suratjalanMenu = document.getElementById('suratjalan-menu');
    
    if (currentPath.includes('suratjalan') || currentPath.includes('detailsuratjalan')) {
        if (suratjalanMenu) {
            suratjalanMenu.classList.add('active');
        }
    }

    let maxQuantity = 0;
    let unit = '';

    function updatePartInfo() {
        const select = document.getElementById('nopart');
        const selectedOption = select.options[select.selectedIndex];
        const card = document.getElementById('partInfoCard');
        
        if (selectedOption.value !== '') {
            // Tampilkan card info
            card.style.display = 'block';
            
            // Update informasi
            document.getElementById('infoNama').textContent = selectedOption.getAttribute('data-nama');
            document.getElementById('infoHarga').textContent = parseFloat(selectedOption.getAttribute('data-harga')).toLocaleString('id-ID');
            document.getElementById('infoUnit').textContent = selectedOption.getAttribute('data-unit');
            document.getElementById('infoUnit2').textContent = selectedOption.getAttribute('data-unit');
            document.getElementById('infoUnit3').textContent = selectedOption.getAttribute('data-unit');
            document.getElementById('infoUnit4').textContent = selectedOption.getAttribute('data-unit');
            
            const poQty = parseInt(selectedOption.getAttribute('data-po_qty'));
            const terkirim = parseInt(selectedOption.getAttribute('data-terkirim'));
            const sisa = parseInt(selectedOption.getAttribute('data-sisa'));
            
            document.getElementById('infoPoQty').textContent = poQty.toLocaleString('id-ID');
            document.getElementById('infoTerkirim').textContent = terkirim.toLocaleString('id-ID');
            document.getElementById('infoSisa').textContent = sisa.toLocaleString('id-ID');
            
            // Set max quantity
            maxQuantity = sisa;
            unit = selectedOption.getAttribute('data-unit');
            document.getElementById('maxQuantity').textContent = maxQuantity.toLocaleString('id-ID');
            document.getElementById('maxUnit').textContent = unit;
            
            // Reset quantity
            document.getElementById('quantity').value = '';
            document.getElementById('quantityError').textContent = '';
        } else {
            // Sembunyikan card info
            card.style.display = 'none';
            maxQuantity = 0;
            unit = '';
            document.getElementById('maxQuantity').textContent = '0';
            document.getElementById('maxUnit').textContent = '-';
        }
        
        validateQuantity();
    }

    function validateQuantity() {
        const quantityInput = document.getElementById('quantity');
        const quantity = parseInt(quantityInput.value);
        const errorElement = document.getElementById('quantityError');
        const submitBtn = document.getElementById('submitBtn');
        
        if (isNaN(quantity) || quantity < 1) {
            errorElement.textContent = 'Quantity harus minimal 1';
            submitBtn.disabled = true;
            submitBtn.classList.add('disabled');
            return false;
        }
        
        if (quantity > maxQuantity) {
            errorElement.textContent = `Quantity tidak boleh melebihi sisa PO (${maxQuantity} ${unit})`;
            submitBtn.disabled = true;
            submitBtn.classList.add('disabled');
            return false;
        }
        
        errorElement.textContent = '';
        submitBtn.disabled = false;
        submitBtn.classList.remove('disabled');
        return true;
    }

    // Validasi form sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!validateQuantity()) {
            e.preventDefault();
            return false;
        }
        
        const partSelect = document.getElementById('nopart');
        if (partSelect.value === '') {
            e.preventDefault();
            alert('Silakan pilih part terlebih dahulu');
            return false;
        }
    });

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
            }, 8000);
        });
    });
  </script>
</body>
</html>