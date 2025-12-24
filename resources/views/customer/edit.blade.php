<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Customer - PT. Kobar Indonesia</title>
  <!-- CSS Plugins -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <link rel="shortcut icon" type="image/png" href="{{ asset('images/ptkobarnobgnew.png') }}" />
  <style>
    .sidebar { background: #232227 !important; color: #ffffff !important; }
    .sidebar .nav-link { color: #ffffff !important; }
    .sidebar .nav-item.active > .nav-link { background: rgba(255,255,255,0.05) !important; color: #ffffff !important; border-left-color: #0025f7ab !important; }
    .sidebar .menu-icon, .sidebar .menu-title { color: #ffffff !important; }
    .sidebar .nav-item:hover .nav-link { background: rgba(255,255,255,0.05) !important; color: #0025f7ab !important; border-left-color: #ffffff !important; }
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
            </div>
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
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

  <!-- Logout Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
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

  <div class="container-fluid page-body-wrapper">

    <!-- Sidebar -->
    <nav class="sidebar sidebar-offcanvas sidebar-dark" id="sidebar">
      <ul class="nav">
        <li class="nav-item" id="dashboard-menu">
          <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>

        <li class="nav-item active" id="customer-menu">
          <a class="nav-link" href="{{ route('customer.index') }}">
            <i class="menu-icon mdi mdi-account-search"></i>
            <span class="menu-title">Customer</span>
          </a>
        </li>

        <li class="nav-item" id="part-menu">
          <a class="nav-link" href="{{ route('part.index') }}">
            <i class="menu-icon mdi mdi-cube-outline"></i>
            <span class="menu-title">Part</span>
          </a>
        </li>

        <li class="nav-item" id="petugas-menu">
         
        </li>

        <li class="nav-item" id="kendaraan-menu">
         
        </li>

        <li class="nav-item" id="po-menu">
          <a class="nav-link" href="{{ route('po.index') }}">
            <i class="menu-icon mdi mdi-file-document"></i>
            <span class="menu-title">Purchase Order</span>
          </a>
        </li>

        <li class="nav-item" id="suratjalan-menu">
          
        </li>
      </ul>
    </nav>

    <!-- Main Panel -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Form Customer</h4>
                <p class="card-description">Halaman Ubah Data Customer PT. Kobar Indonesia</p>

                @if(session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form class="forms-sample" method="POST" action="{{ route('customer.update', $customer->idcustomer) }}">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                    <label for="namacustomer">Nama Customer</label>
                    <input type="text" class="form-control" id="namacustomer" name="namacustomer"
                           value="{{ old('namacustomer', $customer->namacustomer) }}" placeholder="Nama Customer" required>
                  </div>

                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" rows="6" class="form-control" style="height:150px;" required>{{ old('alamat', $customer->alamat) }}</textarea>
                  </div>

                  <button type="submit" class="btn btn-primary me-2">Update</button>
                  <a href="{{ route('customer.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a>.</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021.</span>
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

<!-- Aktifkan menu Customer -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.sidebar .nav-item').forEach(item => item.classList.remove('active'));
      document.getElementById('customer-menu').classList.add('active');
  });
</script>

</body>
</html>
