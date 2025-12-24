<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Detail Purchase Order - PT. Kobar Indonesia</title>
  
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
      padding: 4px 12px;
      font-weight: 500;
    }

    .status-badge {
      border-radius: 20px;
      font-size: 0.6rem;
      font-weight: 800;
      text-align: center;
      display: inline-block;
      min-width: 50px;
      padding: 8px 5px;
    }
    
    #detailpoTable thead th {
      font-size: 0.8rem;
    }
    
    #detailpoTable tbody td {
      font-size: 0.75rem;
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
            <div class="col-sm-12 grid-margin-sm stretch-card">
              <div class="card">
                <div class="card-body">                 
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                      <h4 class="card-title">Data Detail Purchase Order</h4>
                      <p class="card-description mb-0">
                        Halaman Data Detail Purchase Order PT. Kobar Indonesia
                      </p>
                    </div>
                    <!-- PERBAIKAN: Gunakan $po->nopo untuk create -->
                    <a href="{{ route('detailpo.create', $po->nopo) }}" class="btn btn-primary d-flex align-items-center">
                      <span class="mdi mdi-plus me-2"></span>
                      Tambah Part
                    </a>
                  </div>

                  <!-- NOTIFIKASI SUCCESS GLOBAL -->
                  @if (!empty($success) && $success_type === 'global')
                    <div class="alert-global success">
                      <i class="mdi mdi-check-circle"></i>
                      {{ $success }}
                    </div>
                  @endif

                  <!-- NOTIFIKASI ERROR GLOBAL -->
                  @if (!empty($error) && $error_type === 'global')
                    <div class="alert-global error">
                      <i class="mdi mdi-alert-circle"></i>
                      {{ $error }}
                    </div>
                  @endif

                  <div class="card-body border border-primary border-2 rounded-2">
                    <div class="form-group row">
                      <div class="col-6">
                        <label class="text-primary fw-bold">No. PO</label>
                        <div id="the-basics">
                          <input class="typeahead border-primary" type="text" 
                            value="{{ $po->nopo }}" disabled>
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="text-primary fw-bold">Customer</label>
                        <div id="bloodhound">
                          <input class="typeahead border-primary" type="text" 
                            value="{{ $po->customer->namacustomer ?? '' }}" disabled>
                        </div>
                      </div>
                      <div class="col-6 mt-2">
                        <label class="text-primary fw-bold">Tgl PO</label>
                        <div id="the-basics">
                          <input class="typeahead border-primary" type="text" 
                            value="{{ $po->tglpo ? \App\Models\PurchaseOrder::formatTanggalIndonesia($po->tglpo) : '' }}" 
                            disabled>
                        </div>
                      </div>
                      <div class="col-6 mt-2">
                        <label class="text-primary fw-bold">Delivery Schedule</label>
                        <div id="bloodhound">
                          <input class="typeahead border-primary" type="text" 
                            value="{{ $po->deliveryschedule ? \App\Models\PurchaseOrder::formatDeliveryScheduleIndonesia($po->deliveryschedule) : '' }}" 
                            disabled>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="mt-4">
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
                  </div>

                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm small" id="detailpoTable" style="font-size: 0.85rem;">
                      <thead>
                        <tr>
                          <th style="width: 10%;">No.</th>
                          <th style="width: 20%;">Nama Part</th>
                          <th style="width: 15%;">Harga</th>
                          <th style="width: 10%;">Quantity</th>
                          <th style="width: 10%;">Total</th>
                          <th style="width: 5%;">Unit</th>
                          <th class="text-center" style="width: 10%;">Status</th>
                          <th class="text-center" style="width: 9%;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if ($detailpo_list->count() > 0)
                          @php
                            $counter = ($detailpo_list->currentPage() - 1) * $detailpo_list->perPage() + 1;
                          @endphp
                          @foreach ($detailpo_list as $detail)
                            {{-- DEBUG: Tampilkan semua field detail --}}
                            {{--
                            <tr style="display: none;">
                              <td colspan="8">
                                <small class="text-danger">
                                  Debug Detail:<br>
                                  nopo: {{ $detail->nopo }}<br>
                                  nopart: {{ $detail->nopart }}<br>
                                  quantity: {{ $detail->quantity }}<br>
                                  harga: {{ $detail->harga }}<br>
                                  total: {{ $detail->total ?? 'null' }}<br>
                                  total_detail: {{ $detail->total_detail ?? 'null' }}<br>
                                  total_dikirim: {{ $detail->total_dikirim ?? 'null' }}<br>
                                  sisa_po: {{ $detail->sisa_po ?? 'null' }}
                                </small>
                              </td>
                            </tr>
                            --}}
                            
                            <tr>
                              <td>{{ $counter }}</td>
                              <td>{{ $detail->namapart ?? '-' }}</td>
                              <td>Rp {{ number_format($detail->harga ?? 0, 0, ',', '.') }}</td>
                              <td>{{ number_format($detail->quantity, 0, ',', '.') }}</td>
                              <td>
                                {{-- COBA DUA KEMUNGKINAN --}}
                                @php
                                  // Coba total_detail dulu (alias dari query)
                                  $totalValue = $detail->total_detail ?? $detail->total ?? 0;
                                  
                                  // Kalau masih 0, hitung manual
                                  if ($totalValue == 0 && isset($detail->quantity) && isset($detail->harga)) {
                                    $totalValue = $detail->quantity * $detail->harga;
                                  }
                                @endphp
                                Rp {{ number_format($totalValue, 0, ',', '.') }}
                              </td>
                              <td>{{ $detail->unit }}</td>
                              <td>
                                <span class="status-badge {{ $detail->status_class }}" style="display:flex; justify-content:center; align-items:center;">
                                  {{ $detail->status }}
                                </span>
                                @if ($detail->status === 'PARTIAL')
                                  <p style="text-align:center;">
                                    <small class="form-text text-muted small" style="font-size: 0.7rem">
                                      Tersisa: {{ $detail->sisa_po ?? 0 }}
                                    </small>
                                  </p>
                                @endif
                              </td>
                              <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                  <a href="{{ route('detailpo.edit', ['nopo' => $po->nopo, 'nopart' => $detail->nopart]) }}" 
                                    class="btn btn-sm btn-outline-primary" 
                                    title="Edit Detail"
                                    style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
                                    <i class="bi bi-pencil-fill"></i>
                                  </a>
                                  <button type="button" 
                                    class="btn btn-sm btn-outline-danger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteDetailModal{{ preg_replace('/[^a-zA-Z0-9]/', '', $detail->nopo . $detail->nopart) }}"
                                    title="Hapus Detail"
                                    style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
                                    <i class="bi bi-trash-fill"></i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                            @php $counter++; @endphp
                          @endforeach
                        @else
                          <tr>
                            <td colspan="8" class="text-center py-3">Tidak ada data detail purchase order</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>

                  <!-- MODAL KONFIRMASI HAPUS DETAIL -->
                  @if ($detailpo_list->count() > 0)
                    @foreach ($detailpo_list as $detail)
                      @php
                        $safe_id = preg_replace('/[^a-zA-Z0-9]/', '', $detail->nopo . $detail->nopart);
                        $modal_id = 'deleteDetailModal' . $safe_id;
                        
                        // Cek apakah part ini sudah ada di detail surat jalan
                        $has_detail_suratjalan = \Illuminate\Support\Facades\DB::table('suratjalan')
                          ->join('detailsuratjalan', 'suratjalan.nosuratjalan', '=', 'detailsuratjalan.nosuratjalan')
                          ->where('suratjalan.nopo', $detail->nopo)
                          ->where('detailsuratjalan.nopart', $detail->nopart)
                          ->exists();
                          
                        $can_delete_part = !$has_detail_suratjalan;
                      @endphp
                      
                      <div class="modal fade" id="{{ $modal_id }}" 
                        tabindex="-1" 
                        aria-labelledby="deleteDetailModalLabel" 
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 450px; margin: 0 auto;">
                          <div class="modal-content">
                            <div class="modal-header py-2" style="border-bottom: 1px solid #dee2e6;">
                              <h6 class="modal-title fs-6 m-0">
                                {{ $can_delete_part ? 'Konfirmasi Hapus' : 'Part Tidak Dapat Dihapus' }}
                              </h6>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body py-3">
                              @if ($has_detail_suratjalan)
                                <!-- Modal untuk part yang sudah ada di detail surat jalan -->
                                <div class="text-center">
                                  <i class="mdi mdi-alert-circle text-warning mb-2" style="font-size: 2rem;"></i>
                                  <p class="m-0 mb-2" style="font-size: 0.74rem;">Part <strong>{{ $detail->namapart }}</strong> sudah tercatat dalam Surat Jalan terkait PO ini.</p>
                                  <p class="m-0 text-danger fw-bold" style="font-size: 0.64rem;">
                                    Hapus part dari Surat Jalan terlebih dahulu sebelum menghapus dari PO
                                  </p>
                                </div>
                                <div class="text-center mt-3">
                                  @if ($departemen == 'Manager')
                                    @php
                                      // Ambil nomor surat jalan terkait
                                      $surat_jalan = \Illuminate\Support\Facades\DB::table('suratjalan')
                                        ->join('detailsuratjalan', 'suratjalan.nosuratjalan', '=', 'detailsuratjalan.nosuratjalan')
                                        ->where('suratjalan.nopo', $detail->nopo)
                                        ->where('detailsuratjalan.nopart', $detail->nopart)
                                        ->select('suratjalan.nosuratjalan')
                                        ->first();
                                    @endphp
                                    <a href="{{ $surat_jalan ? route('detailsuratjalan.index', $surat_jalan->nosuratjalan) : route('suratjalan.index', ['nopo' => $po->nopo]) }}" 
                                      class="btn btn-primary btn-sm rounded-1" style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">
                                      <i class="mdi mdi-file-find me-1" style="font-size: 0.8rem;"></i>Kelola Detail Surat Jalan
                                    </a>
                                  @endif
                                </div>
                              @else
                                <!-- Modal untuk part yang belum ada di detail surat jalan -->
                                <div class="text-center">
                                  <p class="m-0 mb-2">Yakin ingin menghapus part <strong>{{ $detail->namapart }}</strong> dari PO <strong>{{ $detail->nopo }}</strong>?</p>
                                </div>
                              @endif
                            </div>
                            
                            <!-- FOOTER MODAL - HANYA TAMPIL JIKA BISA DIHAPUS -->
                            @if ($can_delete_part)
                              <div class="modal-footer py-2" style="border-top: 1px solid #ffffffff;">
                                <!-- PERBAIKAN: Gunakan $po->nopo untuk destroy -->
                                <form action="{{ route('detailpo.destroy', ['nopo' => $po->nopo, 'nopart' => $detail->nopart]) }}" method="POST" style="width: 100%;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-primary btn-sm rounded-1 w-100">
                                    Hapus Part
                                  </button>
                                </form>
                              </div>
                            @endif
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif

                  <!-- Pagination -->
                  <nav aria-label="Page navigation example" class="mt-3">
                    <ul class="pagination justify-content-end mb-0">
                      <!-- Previous Button -->
                      <li class="page-item {{ $detailpo_list->currentPage() <= 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $detailpo_list->previousPageUrl() }}&records_per_page={{ $records_per_page }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      
                      <!-- Page Numbers -->
                      @for ($i = 1; $i <= $detailpo_list->lastPage(); $i++)
                        <li class="page-item {{ $detailpo_list->currentPage() == $i ? 'active' : '' }}">
                          <a class="page-link" href="{{ $detailpo_list->url($i) }}&records_per_page={{ $records_per_page }}">{{ $i }}</a>
                        </li>
                      @endfor
                      
                      <!-- Next Button -->
                      <li class="page-item {{ $detailpo_list->currentPage() >= $detailpo_list->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $detailpo_list->nextPageUrl() }}&records_per_page={{ $records_per_page }}" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                    
                    <!-- Info Pagination -->
                    <div class="text-muted text-left mt-2 small">
                      Menampilkan {{ $detailpo_list->count() }} dari {{ $total_records }} data
                    </div>
                  </nav>
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
    // Function untuk mengubah jumlah records per page
    function changeRecordsPerPage(recordsPerPage) {
      const urlParams = new URLSearchParams(window.location.search);
      urlParams.set('records_per_page', recordsPerPage);
      urlParams.set('page', 1);
      window.location.href = '?' + urlParams.toString();
    }

    // Search functionality for Detail PO
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('dt-search-0');
      const table = document.querySelector('#detailpoTable');
      const tbody = table.querySelector('tbody');
      const dataRows = [];
      const noSearchResult = document.getElementById('no-search-result');
      const paginationInfo = document.querySelector('.text-muted.text-left.mt-2.small');
      const paginationNav = document.querySelector('.pagination');
      
      // Kumpulkan hanya baris data
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
        
        // Sembunyikan pesan tidak ditemukan
        if (noSearchResult) {
          noSearchResult.style.display = 'none';
        }
        
        // Jika ada kata kunci pencarian
        if (searchTerm !== '') {
          dataRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let found = false;
            
            // Cari di kolom: namapart (index 1), status (index 6)
            for (let i = 1; i <= 1; i++) {
              if (cells[i]) {
                const cellText = cells[i].textContent.toLowerCase();
                if (cellText.includes(searchTerm)) {
                  found = true;
                  break;
                }
              }
            }
            
            // Cari juga di kolom status (hanya jika belum ketemu di kolom sebelumnya)
            if (!found && cells[6]) {
              const statusText = cells[6].textContent.toLowerCase();
              if (statusText.includes(searchTerm)) {
                found = true;
              }
            }
            
            if (found) {
              foundCount++;
            }
            
            row.style.display = found ? '' : 'none';
          });
          
          // Kelola tampilan pesan
          if (foundCount === 0) {
            if (noSearchResult) {
              noSearchResult.style.display = '';
            }
            if (paginationInfo) {
              paginationInfo.textContent = `Menampilkan 0 dari 0 data`;
            }
          } else {
            if (paginationInfo) {
              paginationInfo.textContent = `Menampilkan ${foundCount} dari ${foundCount} data`;
            }
          }
          
          // Sembunyikan pagination
          if (paginationNav) {
            paginationNav.style.display = 'none';
          }
          
        } else {
          // Jika search kosong, kembalikan ke normal
          if (paginationInfo) {
            const totalRecords = {{ $total_records }};
            const currentCount = {{ $detailpo_list->count() }};
            paginationInfo.textContent = `Menampilkan ${currentCount} dari ${totalRecords} data`;
          }
          
          // Tampilkan kembali pagination
          if (paginationNav) {
            paginationNav.style.display = 'flex';
          }
        }
      });
    });

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