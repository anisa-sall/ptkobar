<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Detail Purchase Order - PT. Kobar Indonesia</title>
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

  /* Style untuk badge status */
  .btn-rounded-primary {
      background-color: #00327ee0;
      color: white;
      border: none;
      border-radius: 20px;
      padding: 4px 12px;
      font-weight: 500;
      font-size: 0.75rem;
  }

  .btn-rounded-warning {
      background-color: #ffc107;
      color: white;
      border: none;
      border-radius: 20px;
      padding: 4px 12px;
      font-weight: 500;
      font-size: 0.75rem;
  }

  .btn-rounded-success {
      background-color: #198754;
      color: white;
      border: none;
      border-radius: 20px;
      padding: 4px 12px;
      font-weight: 500;
      font-size: 0.75rem;
  }
  
  /* Ubah ukuran font header tabel saja */
  #detailpoTable thead th {
      font-size: 0.70rem;
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
            <!-- <h2 class="welcome-text text-white">PT. Kobar Indonesia</span></h2> -->
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
                <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name ?? 'User' }}</p>
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
              <i class="menu-icon mdi mdi mdi-cube-outline"></i>
              <span class="menu-title">Part</span>
            </a>
          </li>
          @endif
          @if(isset($menuAccess['petugas']) && in_array($departemen, $menuAccess['petugas']))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('petugas.index') }}">
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
          <li class="nav-item" id="po-menu">
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
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  {{-- HEADER --}}
                  <div class="d-flex justify-content-between align-items-center mb-4">
                      <div>
                          <h5 class="fw-bold mb-1">Data Detail Purchase Order</h5>
                          <small class="text-muted">
                              Halaman Data Detail Purchase Order PT. Kobar Indonesia
                          </small>
                      </div>

                      <a href="{{ route('detailpo.create', $po->nopo) }}"
                         class="btn btn-primary d-flex align-items-center">
                          <span class="mdi mdi-plus me-2"></span>
                          Tambah Part
                      </a>
                  </div>

                  {{-- NOTIFIKASI --}}
                  @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                          <i class="mdi mdi-check-circle me-2"></i>
                          {{ session('success') }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @endif

                  @if(session('error'))
                      <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                          <i class="mdi mdi-alert-circle me-2"></i>
                          {{ session('error') }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @endif

                  {{-- INFO PO --}}
                  <div class="border border-primary rounded p-4 mb-4">
                      <div class="row g-3">

                          <div class="col-md-6">
                              <label class="form-label text-primary fw-semibold">No. PO</label>
                              <input type="text" class="form-control" value="{{ $po->nopo }}" readonly>
                          </div>

                          <div class="col-md-6">
                              <label class="form-label text-primary fw-semibold">Customer</label>
                              <input type="text" class="form-control"
                                     value="{{ $po->namacustomer }}" readonly>
                          </div>

                          <div class="col-md-6">
                              <label class="form-label text-primary fw-semibold">Tgl PO</label>
                              <input type="text" class="form-control"
                                     value="{{ \Carbon\Carbon::parse($po->tglpo)->format('d F Y') }}"
                                     readonly>
                          </div>

                          <div class="col-md-6">
                              <label class="form-label text-primary fw-semibold">Delivery Schedule</label>
                              <input type="text" class="form-control"
                                     value="{{ $po->deliveryschedule_formatted ?? '-' }}"
                                     readonly>
                          </div>

                      </div>
                  </div>

                  {{-- TOOLBAR TABLE --}}
                  <div class="d-flex justify-content-between align-items-end mb-3">
                    <div class="dt-length">
                      <label for="records-per-page" class="form-label small mb-1">Show entries</label>
                      <select name="records_per_page" id="records-per-page" class="form-select form-select-sm" style="width: auto;" onchange="changeRecordsPerPage(this.value)">
                        <option value="10" {{ request('records_per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('records_per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('records_per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('records_per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                      </select>
                    </div>
                    <div class="dt-search">
                      <label for="search-detail" class="form-label small mb-1">Search : </label>
                      <input type="search" class="form-control form-control-sm" id="search-detail" placeholder="Cari nama part..." style="width: 190px;">
                    </div>
                  </div>

                  {{-- TABLE --}}
                  <div class="table-responsive">
                      <table class="table table-hover align-middle" id="detailpoTable">
                          <thead class="table-light">
                              <tr class="text-center">
                                  <th width="5%">No</th>
                                  <th>Nama Part</th>
                                  <th width="12%">Harga</th>
                                  <th width="8%">Qty</th>
                                  <th width="12%">Total</th>
                                  <th width="8%">Unit</th>
                                  <th width="10%">Status</th>
                                  <th width="10%">Aksi</th>
                              </tr>
                          </thead>

                          <tbody>
                          @if ($detailpo->count() > 0)
                              @php
                                  $counter = ($detailpo->currentPage() - 1) * $detailpo->perPage() + 1;
                              @endphp

                              @foreach ($detailpo as $detail)
                                  @php
                                      // Hitung status berdasarkan total_dikirim dan sisa_po
                                      $totalDikirim = $detail->total_dikirim ?? 0;
                                      $sisaPo = $detail->sisa_po ?? $detail->quantity;
                                      
                                      if ($totalDikirim == 0) {
                                          $status = 'OPEN';
                                          $statusClass = 'btn-rounded-primary';
                                      } elseif ($sisaPo > 0) {
                                          $status = 'PARTIAL';
                                          $statusClass = 'btn-rounded-warning';
                                      } else {
                                          $status = 'CLOSED';
                                          $statusClass = 'btn-rounded-success';
                                      }
                                  @endphp
                              <tr>
                                  <td class="text-center">{{ $counter }}</td>
                                  <td>{{ $detail->namapart }}</td>

                                  <td class="text-end">
                                      Rp {{ number_format($detail->harga,0,',','.') }}
                                  </td>

                                  <td class="text-center">{{ $detail->quantity }}</td>

                                  <td class="text-end">
                                      Rp {{ number_format($detail->total,0,',','.') }}
                                  </td>

                                  <td class="text-center">{{ $detail->unit }}</td>

                                  <td class="text-center">
                                      <span class="badge {{ $statusClass }} px-3 py-1">
                                          {{ $status }}
                                      </span>
                                  </td>

                                  {{-- AKSI (SAMA DENGAN CUSTOMER) --}}
                                  <td class="text-center">
                                      <div class="d-flex gap-2 justify-content-center">

                                          {{-- EDIT --}}
                                          <a href="{{ route('detailpo.edit', [$detail->nopo, $detail->nopart]) }}"
                                             class="btn btn-sm btn-outline-primary">
                                              <i class="bi bi-pencil-fill"></i>
                                          </a>

                                          {{-- HAPUS --}}
                                          <button type="button"
                                                  class="btn btn-sm btn-outline-danger"
                                                  data-bs-toggle="modal"
                                                  data-bs-target="#deleteModal{{ $detail->nopart }}">
                                              <i class="bi bi-trash-fill"></i>
                                          </button>

                                      </div>
                                  </td>
                              </tr>
                              @php $counter++ @endphp
                              @endforeach
                          @else
                              <tr>
                                  <td colspan="8" class="text-center py-3 text-muted">
                                      Data detail PO belum ada
                                  </td>
                              </tr>
                          @endif
                          </tbody>
                      </table>
                  </div>

                  {{-- PAGINATION --}}
                  <div class="mt-3">
                      {{ $detailpo->appends(['records_per_page' => request('records_per_page', 10)])->links() }}
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
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ date('Y') }}. PT. Kobar Indonesia. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  {{-- MODAL HAPUS (DI LUAR TABLE) --}}
  @if ($detailpo->count() > 0)
  @foreach ($detailpo as $detail)
  <div class="modal fade"
       id="deleteModal{{ $detail->nopart }}"
       tabindex="-1"
       aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
          <div class="modal-content">

              <div class="modal-header py-2">
                  <h6 class="modal-title">Konfirmasi Hapus</h6>
                  <button class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body py-2 text-center">
                  Yakin ingin menghapus part
                  <strong>{{ $detail->namapart }}</strong> ?
              </div>

              <div class="modal-footer py-2">
                  <button class="btn btn-secondary btn-sm"
                          data-bs-dismiss="modal">
                      Batal
                  </button>

                  <form action="{{ route('detailpo.destroy', [$detail->nopo, $detail->nopart]) }}"
                        method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-primary btn-sm">
                          Hapus
                      </button>
                  </form>
              </div>

          </div>
      </div>
  </div>
  @endforeach
  @endif

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
    // Cek pathname dan tambahkan class active jika mengandung 'po'
    if (window.location.pathname.includes('po') || window.location.pathname.includes('detailpo')) {
        document.getElementById('po-menu').classList.add('active');
    }

    // Function untuk mengubah jumlah records per page
    function changeRecordsPerPage(recordsPerPage) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('records_per_page', recordsPerPage);
        urlParams.set('page', 1); // Reset ke halaman 1
        window.location.href = '?' + urlParams.toString();
    }

    // Search functionality for Detail PO
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-detail');
        const table = document.getElementById('detailpoTable');
        const tbody = table.querySelector('tbody');
        const dataRows = [];
        const noSearchResult = document.getElementById('no-search-result');
        
        // Kumpulkan hanya baris data
        tbody.querySelectorAll('tr').forEach(row => {
            if (!row.querySelector('td')?.textContent.includes('Data detail PO belum ada')) {
                dataRows.push(row);
            }
        });

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let foundCount = 0;
            
            // Reset semua baris data
            dataRows.forEach(row => {
                row.style.display = '';
            });
            
            // Sembunyikan pesan tidak ditemukan jika ada
            const existingNoResult = document.getElementById('no-search-result');
            if (existingNoResult) {
                existingNoResult.style.display = 'none';
            }
            
            // Jika ada kata kunci pencarian
            if (searchTerm !== '') {
                dataRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    let found = false;
                    
                    // Cari di kolom nama part (index 1)
                    if (cells[1]) {
                        const cellText = cells[1].textContent.toLowerCase();
                        if (cellText.includes(searchTerm)) {
                            found = true;
                            foundCount++;
                        }
                    }
                    
                    row.style.display = found ? '' : 'none';
                });
                
                if (foundCount === 0) {
                    // Tampilkan row "tidak ditemukan" jika belum ada
                    let noResultRow = document.getElementById('no-search-result');
                    if (!noResultRow) {
                        noResultRow = document.createElement('tr');
                        noResultRow.id = 'no-search-result';
                        noResultRow.innerHTML = `
                            <td colspan="8" class="text-center py-3 text-muted">
                                Tidak ada data detail PO yang sesuai dengan pencarian
                            </td>
                        `;
                        tbody.appendChild(noResultRow);
                    }
                    noResultRow.style.display = '';
                }
            } else {
                // Jika search kosong, sembunyikan row "tidak ditemukan"
                const noResultRow = document.getElementById('no-search-result');
                if (noResultRow) {
                    noResultRow.style.display = 'none';
                }
            }
        });
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
            }, 5000);
        });
    });
  </script>

</body>
</html>