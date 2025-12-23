<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purchase order - PT. Kobar Indonesia</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
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

    .wrap-table th, .wrap-table td {
      font-size: 0.75rem;
      padding: 1rem 0.5rem;
    }
    .wrap-table .text-wrap {
        white-space: normal;
        word-break: break-word;
    }
    .wrap-table .btn-group-vertical {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .wrap-table .btn-sm {
        padding: 0.1rem 0.2rem;
        font-size: 0.5rem;
    }

    .btn-rounded-primary {
      background-color: #00327ee0;
      color: white;
      border: none;
      border-radius: 20px;
      padding: 4px 12px;
      font-weight: 500;
    }

    .btn-rounded-warning {
        background-color: #ffc107;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 4px 12px;
        font-weight: 500;
    }

    .btn-rounded-success {
        background-color: #198754;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 4px 10px;
        font-weight: 500;
    }

    .status-badge {
        border-radius: 20px;
        font-size: 0.55rem;
        font-weight: 600;
        text-align: center;
        display: inline-block;
        min-width: 50px;
        padding: 8px 9px;
    }
    /* Ubah ukuran font header tabel saja */
    #poTable thead th {
        font-size: 0.76rem;
    }
    #poTable tbody td {
      font-size: 0.68rem;
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

          @if(isset($menuAccess['customer']) && in_array($departemen, $menuAccess['customer']))
          <li class="nav-item" id="customer-menu">
              <a class="nav-link" href="{{ route('customer.index') }}">
                  <i class="menu-icon mdi mdi-account-search"></i>
                  <span class="menu-title">Customer</span>
              </a>
          </li>
          @endif
          @if(isset($menuAccess['part']) && in_array($departemen, $menuAccess['part']))
          <li class="nav-item ">
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
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12 grid-margin-sm stretch-card">
              <div class="card">
                <div class="card-body">                 
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <h4 class="card-title">Data Purchase Order</h4>
                      <p class="card-description mb-0">
                        Halaman Data Purchase Order PT. Kobar Indonesia
                      </p>
                    </div>
                    <a href="{{ route('po.create') }}" class="btn btn-primary d-flex align-items-center">
                      <span class="mdi mdi-plus me-2"></span>
                      Tambah PO
                    </a>
                  </div>
                  
                  <div class="d-flex justify-content-between align-items-end mb-3">
                    <div class="dt-length">
                      <label for="dt-length-0" class="form-label small mb-1">Show entries</label>
                      <select name="po_length" aria-controls="poTable" class="form-select form-select-sm" id="dt-length-0" style="width: auto;" onchange="changeRecordsPerPage(this.value)">
                        <option value="10" {{ $records_per_page == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $records_per_page == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $records_per_page == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $records_per_page == 100 ? 'selected' : '' }}>100</option>
                      </select>
                    </div>
                    <div class="dt-search">
                      <label for="dt-search-0" class="form-label small mb-1">Search : </label>
                      <input type="search" class="form-control form-control-sm" id="dt-search-0" placeholder="" aria-controls="poTable" style="width: 190px;">
                    </div>
                  </div>

                  <!-- NOTIFIKASI SUCCESS GLOBAL -->
                  @if(!empty($local_success) && $local_success_type === 'global')
                    <div class="alert-global success">
                      <i class="mdi mdi-check-circle"></i>
                      {{ htmlspecialchars($local_success) }}
                    </div>
                  @endif

                  <!-- NOTIFIKASI ERROR GLOBAL -->
                  @if(!empty($local_error) && $local_error_type === 'global')
                    <div class="alert-global error">
                      <i class="mdi mdi-alert-circle"></i>
                      {{ htmlspecialchars($local_error) }}
                    </div>
                  @endif

                  <div class="table-responsive">
                    <table class="table table-bordered table-hover wrap-table" id="poTable">
                        <thead>
                            <tr>
                                <th style="width: 20%;">No. PO</th>
                                <th style="width: 10%;">Customer</th>
                                <th style="width: 2%;">Tanggal</th>
                                <th style="width: 15%;">Delivery</th>
                                <th style="width: 2%;">Harga</th>
                                <th style="width: 4%;">Subtotal</th>
                                <th style="width: 4%;">PPN</th>
                                <th style="width: 3%;">Total</th>
                                <th style="width: 2%;">Petugas</th>
                                <th class="text-center" style="width: 2%;">Status</th>
                                <th class="text-center" style="width: 3%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($po_list) && count($po_list) > 0)
                                @foreach($po_list as $po)
                                    <tr>
                                        <td class="py-1"><strong class="text-wrap">{{ htmlspecialchars($po->nopo) }}</strong></td>
                                        <td class="text-wrap">{{ htmlspecialchars($po->namacustomer) }}</td>
                                        <td class="text-center">
                                            <?php 
                                                if (!function_exists('formatTanggalIndonesia')) {
                                                    function formatTanggalIndonesia($tanggal): string
                                                    {
                                                        if (empty($tanggal) || $tanggal === '0000-00-00') return '';
                                                        return date('d/m/Y', strtotime($tanggal));
                                                    }
                                                }
                                            ?>
                                            {{ !empty($po->tglpo) ? formatTanggalIndonesia($po->tglpo) : '' }}
                                        </td>
                                        <td class="text-wrap">
                                           @once
                                            <?php
                                            if (!function_exists('formatTanggalIndonesia')) {
                                                function formatTanggalIndonesia($tanggal): string
                                                {
                                                    if (empty($tanggal) || $tanggal === '0000-00-00') return '';
                                                    return date('d/m/Y', strtotime($tanggal));
                                                }
                                            }

                                            if (!function_exists('formatDeliveryScheduleIndonesia')) {
                                                function formatDeliveryScheduleIndonesia($tanggal): string
                                                {
                                                    if (empty($tanggal) || $tanggal === '0000-00-00') return '';

                                                    $bulan = [
                                                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                                    ];

                                                    $timestamp = strtotime($tanggal);
                                                    return $bulan[date('n', $timestamp)] . ' ' . date('Y', $timestamp);
                                                }
                                            }
                                            ?>
                                            @endonce
                                            {{ !empty($po->deliveryschedule) ? formatDeliveryScheduleIndonesia($po->deliveryschedule) : '' }}
                                        </td>
                                        <td>Rp {{ number_format($po->harga, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($po->subtotal, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($po->ppn, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($po->total, 0, ',', '.') }}</td>
                                        <td class="text-wrap text-center">
                                            {{ explode(' ', htmlspecialchars($po->namapetugas))[0] ?? '' }}
                                        </td>
                                        <td>
                                            @php
                                                // Tentukan class CSS berdasarkan status
                                                $status_class = '';
                                                switch ($po->status_po ?? 'OPEN') {
                                                    case 'OPEN':
                                                        $status_class = 'btn-rounded-primary';
                                                        break;
                                                    case 'PARTIAL':
                                                        $status_class = 'btn-rounded-warning';
                                                        break;
                                                    case 'CLOSED':
                                                        $status_class = 'btn-rounded-success';
                                                        break;
                                                    default:
                                                        $status_class = 'btn-rounded-primary';
                                                }
                                            @endphp
                                            <span class="status-badge {{ $status_class }}" style="display:flex; justify-content:center; align-items:center;">
                                                {{ $po->status_po ?? 'OPEN' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <!-- Button Detail -->
                                                <a href="{{ route('detailpo.index', ['nopo' => $po->nopo]) }}"
                                                   class="btn btn-sm btn-outline-info"
                                                   title="Lihat Detail"
                                                   style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>

                                                <!-- Button Edit -->
                                                <a href="{{ route('po.edit', ['purchase_order' => $po->nopo]) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Edit PO"
                                                   style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>

                                                <!-- Button Hapus -->
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $po->nopo }}"
                                                        title="Hapus PO"
                                                        style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="12" class="text-center py-3">Tidak ada data purchase order</td>
                                </tr>
                            @endif
                            <!-- Row untuk pesan pencarian tidak ditemukan -->
                            <tr id="no-search-result" style="display: none;">
                                <td colspan="12" class="text-center py-3">Tidak ada data PO yang sesuai dengan pencarian</td>
                            </tr>
                        </tbody>
                    </table>
                  </div>

                  <!-- MODAL KONFIRMASI HAPUS - DI LUAR TABLE -->
                  @if(!empty($po_list) && count($po_list) > 0)
                    @foreach($po_list as $po)
                      <div class="modal fade" id="deleteModal{{ $po->nopo }}" 
                          tabindex="-1" 
                          aria-labelledby="deleteModalLabel" 
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" style="max-width: 400px; margin: 0 auto;">
                              <div class="modal-content" style="max-height: 200px; overflow: hidden;">
                                  <div class="modal-header py-2" style="border-bottom: 1px solid #dee2e6;">
                                      <h6 class="modal-title fs-6 m-0">Konfirmasi Hapus</h6>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body py-2">
                                      <p class="m-0">Yakin ingin menghapus PO <strong>{{ $po->nopo }}</strong>?</p>
                                  </div>
                                  <div class="modal-footer py-2" style="border-top: 1px solid #ffffffff;">
                                      <button type="button" class="btn btn-secondary btn-sm rounded-1" data-bs-dismiss="modal">Batal</button>
                                      <form action="{{ route('po.destroy', $po->nopo) }}" method="POST" style="display: inline;">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-primary btn-sm rounded-1">Hapus</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endforeach
                  @endif

                  <nav aria-label="Page navigation example" class="mt-3">
                    <ul class="pagination justify-content-end mb-0">
                      <!-- Previous Button -->
                      <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="?page={{ $page - 1 }}&records_per_page={{ $records_per_page }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      
                      <!-- Page Numbers -->
                      @for ($i = 1; $i <= $total_pages; $i++)
                          <li class="page-item {{ $page == $i ? 'active' : '' }}">
                            <a class="page-link" href="?page={{ $i }}&records_per_page={{ $records_per_page }}">{{ $i }}</a>
                          </li>
                      @endfor
                      
                      <!-- Next Button -->
                      <li class="page-item {{ $page >= $total_pages ? 'disabled' : '' }}">
                        <a class="page-link" href="?page={{ $page + 1 }}&records_per_page={{ $records_per_page }}" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                    
                    <!-- Info Pagination -->
                     <div class="text-muted text-left mt-2 small">
                      Menampilkan {{ count($po_list) }} dari {{ $total_records }} data
                    </div>
                  </nav>
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
  // Function untuk mengubah jumlah records per page
  function changeRecordsPerPage(recordsPerPage) {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set('records_per_page', recordsPerPage);
      urlParams.set('page', 1); // Reset ke halaman 1
      window.location.href = '?' + urlParams.toString();
  }

  // Search functionality for PO - FIXED with consistent pagination info
  document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('dt-search-0');
      const table = document.querySelector('table');
      const tbody = table.querySelector('tbody');
      const dataRows = [];
      const noSearchResult = document.getElementById('no-search-result');
      const paginationInfo = document.querySelector('.text-muted.text-left.mt-2.small');
      const paginationNav = document.querySelector('.pagination');
      
      // Kumpulkan hanya baris data (bukan baris pesan)
      tbody.querySelectorAll('tr').forEach(row => {
          if (row.id !== 'no-search-result' && !row.querySelector('td')?.textContent.includes('Tidak ada data')) {
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
          
          // Sembunyikan pesan tidak ditemukan terlebih dahulu
          if (noSearchResult) {
              noSearchResult.style.display = 'none';
          }
          
          // Jika ada kata kunci pencarian
          if (searchTerm !== '') {
              dataRows.forEach(row => {
                  const cells = row.querySelectorAll('td');
                  let found = false;
                  
                  // Cari di kolom: nopo (index 1), namacustomer (index 2), namapetugas (index 9)
                  for (let i = 0; i < cells.length - 1; i++) {
                      if (cells[i]) {
                          const cellText = cells[i].textContent.toLowerCase();
                          if (cellText.includes(searchTerm)) {
                              found = true;
                              foundCount++;
                              break;
                          }
                      }
                  }
                  
                  row.style.display = found ? '' : 'none';
              });
              
              // Kelola tampilan pesan dan update info pagination
              if (foundCount === 0) {
                  // Tidak ada hasil ditemukan
                  if (noSearchResult) {
                      noSearchResult.style.display = '';
                  }
                  if (paginationInfo) {
                      paginationInfo.textContent = `Menampilkan 0 dari 0 data`;
                  }
              } else {
                  // Ada hasil ditemukan - format sama dengan search kosong
                  if (paginationInfo) {
                      paginationInfo.textContent = `Menampilkan ${foundCount} dari ${foundCount} data`;
                  }
              }
              
              // Sembunyikan pagination nav saat search aktif
              if (paginationNav) {
                  paginationNav.style.display = 'none';
              }
              
          } else {
                // Reset ke tampilan awal
                dataRows.forEach(row => {
                    row.style.display = '';
                });
                
                // Tampilkan kembali pagination nav
                if (paginationNav) {
                    paginationNav.style.display = 'flex';
                }

          }
      });
  });

  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 300) {
      $('.back-to-top').addClass('active');
    } else {
      $('.back-to-top').removeClass('active');
    }
  });
  
  $('.back-to-top').click(function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop: 0}, 300);
  });
  
  // Smooth scrolling for navigation links
  $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - 70
        }, 1000);
      }
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
          }, 5000); // 8 detik
      });
  });
</script>

</body>
</html>