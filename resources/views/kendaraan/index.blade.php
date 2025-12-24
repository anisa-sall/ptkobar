<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kendaraan - PT. Kobar Indonesia</title>
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
          <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
            <img src="{{ asset('images/ptkobarnobgnew.png') }}" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}">
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
                <p class="mb-1 mt-3 font-weight-semibold">{{ $namapetugas ?? 'Petugas' }}</p>
                <p class="fw-light text-muted mb-0">{{ $email ?? 'email@example.com' }}</p>
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
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <!-- TAMBAHKAN PHP CODE DI SINI SEBELUM MENGGUNAKAN FUNCTION -->
          @php
            // Definisikan fungsi hasAccess di sini
            function hasAccess($menuName, $departemen, $menuAccess) {
                return isset($menuAccess[$menuName]) && in_array($departemen, $menuAccess[$menuName]);
            }
            
            // Definisikan menuAccess
            $menuAccess = [
                'customer' => ['Marketing', 'Manager'],
                'part' => ['Marketing', 'Manager'],
                'petugas' => ['Manager'],
                'kendaraan' => ['PPIC', 'Manager'],
                'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
                'stok' => ['PPIC', 'Manager'],
                'suratjalan' => ['PPIC', 'Finance', 'Manager'],
                'invoice' => ['Finance', 'Manager'],
                'laporan' => ['Finance', 'Manager']
            ];
            
            // Ambil departemen dari session
            $departemen = session('departemen', '');
          @endphp
          
          @if(hasAccess('customer', $departemen, $menuAccess))
          <li class="nav-item" id="customer-menu">
              <a class="nav-link" href="{{ route('customer.index') }}">
                  <i class="menu-icon mdi mdi-account-search"></i>
                  <span class="menu-title">Customer</span>
              </a>
          </li>
          @endif
          
          @if(hasAccess('part', $departemen, $menuAccess))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('part.index') }}">
              <i class="menu-icon mdi mdi mdi-cube-outline"></i>
              <span class="menu-title">Part</span>
            </a>
          </li>
          @endif
          
          @if(hasAccess('petugas', $departemen, $menuAccess))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
              <i class="menu-icon mdi mdi-account-check"></i>
              <span class="menu-title">Petugas</span>
            </a>
          </li>
          @endif
          
          @if(hasAccess('kendaraan', $departemen, $menuAccess))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('kendaraan.index') }}">
              <i class="menu-icon mdi mdi-car"></i>
              <span class="menu-title">Kendaraan</span>
            </a>
          </li>
          @endif
          
          @if(hasAccess('po', $departemen, $menuAccess))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('po.index') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Purchase Order</span>
            </a>
          </li>
          @endif
          
          @if(hasAccess('suratjalan', $departemen, $menuAccess))
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
                      <h4 class="card-title">Data Kendaraan</h4>
                      <p class="card-description mb-0">
                        Halaman Data Kendaraan PT. Kobar Indonesia
                      </p>
                    </div>
                    <a href="{{ route('kendaraan.create') }}" class="btn btn-primary d-flex align-items-center">
                      <span class="mdi mdi-plus me-2"></span>
                      Tambah Kendaraan
                    </a>
                  </div>
                  
                  <!-- ... SISA KODE INDEX ANDA TETAP SAMA ... -->
                  <div class="d-flex justify-content-between align-items-end mb-3">
                    <div class="dt-length">
                      <label for="dt-length-0" class="form-label small mb-1">Show entries</label>
                      <select name="kendaraan_length" aria-controls="kendaraanTable" class="form-select form-select-sm" id="dt-length-0" style="width: auto;" onchange="changeRecordsPerPage(this.value)">
                        <option value="10" {{ $records_per_page == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $records_per_page == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $records_per_page == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $records_per_page == 100 ? 'selected' : '' }}>100</option>
                      </select>
                    </div>
                    <div class="dt-search">
                      <label for="dt-search-0" class="form-label small mb-1">Search : </label>
                      <input type="search" class="form-control form-control-sm" id="dt-search-0" placeholder="" aria-controls="kendaraanTable" style="width: 190px;">
                    </div>
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

                  <div class="table-responsive">
                    <table class="table table-bordered  table-hover table-sm small" id="kendaraanTable">
                      <thead>
                        <tr>
                          <th style="width: 5%;">No.</th>
                          <th style="width: 25%;">No. Polisi</th>
                          <th style="width: 25%;">Nama Kendaraan</th>
                          <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                         @if ($kendaraan_list->count() > 0)
                          @php
                            $counter = ($kendaraan_list->currentPage() - 1) * $kendaraan_list->perPage() + 1;
                          @endphp
                          @foreach ($kendaraan_list as $kendaraan)
                            <tr>
                              <td>{{ $counter }}</td>
                              <td class="py-1">{{ $kendaraan->nopol }}</td>
                              <td>{{ $kendaraan->namakendaraan }}</td>
                              <td class="text-center">
                                  <div class="d-flex gap-2 justify-content-center">
                                      <a href="{{ route('kendaraan.edit', urlencode($kendaraan->nopol)) }}" class="btn btn-sm btn-outline-primary">
                                          <i class="bi bi-pencil-fill"></i>
                                      </a>
                                      <button type="button" class="btn btn-sm btn-outline-danger" 
                                          data-bs-toggle="modal" 
                                          data-bs-target="#deleteModal{{ preg_replace('/[^a-zA-Z0-9]/', '', $kendaraan->nopol) }}">
                                          <i class="bi bi-trash-fill"></i>
                                      </button>
                                  </div>
                              </td>
                            </tr>
                            @php $counter++ @endphp
                          @endforeach
                        @else
                          <tr>
                            <td colspan="4" class="text-center py-3">Tidak ada data kendaraan</td>
                          </tr>
                        @endif
                        <!-- Row untuk pesan pencarian tidak ditemukan -->
                        <tr id="no-search-result" style="display: none;">
                          <td colspan="4" class="text-center py-3">Tidak ada data kendaraan yang sesuai dengan pencarian</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>


                  <!-- MODAL KONFIRMASI HAPUS - DI LUAR TABLE -->
                  @if ($kendaraan_list->count() > 0)
                      @foreach ($kendaraan_list as $kendaraan)
                          @php
                          // Buat ID modal yang aman (hapus karakter non-alphanumeric)
                          $safe_nopol = preg_replace('/[^a-zA-Z0-9]/', '', $kendaraan->nopol);
                          $modal_id = 'deleteModal' . $safe_nopol;
                          @endphp
                          <div class="modal fade" id="{{ $modal_id }}" 
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
                                          <p class="m-0">Yakin ingin menghapus kendaraan <strong>{{ $kendaraan->nopol }}</strong>?</p>
                                      </div>
                                      <div class="modal-footer py-2" style="border-top: 1px solid #ffffffff;">
                                          <button type="button" class="btn btn-secondary btn-sm rounded-1" data-bs-dismiss="modal">Batal</button>
                                          <form action="{{ route('kendaraan.destroy', urlencode($kendaraan->nopol)) }}" method="POST" style="display: inline;">
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
                       <li class="page-item {{ $kendaraan_list->currentPage() <= 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $kendaraan_list->previousPageUrl() }}&records_per_page={{ $records_per_page }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      
                      <!-- Page Numbers -->
                       @for ($i = 1; $i <= $kendaraan_list->lastPage(); $i++)
                        <li class="page-item {{ $kendaraan_list->currentPage() == $i ? 'active' : '' }}">
                          <a class="page-link" href="{{ $kendaraan_list->url($i) }}&records_per_page={{ $records_per_page }}">{{ $i }}</a>
                        </li>
                      @endfor
                      
                      <!-- Next Button -->
                      <li class="page-item {{ $kendaraan_list->currentPage() >= $kendaraan_list->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $kendaraan_list->nextPageUrl() }}&records_per_page={{ $records_per_page }}" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                    
                    <!-- Info Pagination -->
                     <div class="text-muted text-left mt-2 small">
                      Menampilkan {{ $kendaraan_list->count() }} dari {{ $kendaraan_list->total() }} data
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

  // Search functionality for KENDARAAN - FIXED with consistent pagination info
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
                    
                    // Cari di kolom: nopol (index 1), namakendaraan (index 2)
                    for (let i = 1; i < 3; i++) {
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
                // Jika search kosong, kembalikan ke normal
                if (paginationInfo) {
                    const currentCount = {{ $kendaraan_list->count() }};
                    const totalRecords = {{ $kendaraan_list->total() }};
                    paginationInfo.textContent = `Menampilkan ${currentCount} dari ${totalRecords} data`;
                }
                
                // Tampilkan kembali pagination
                if (paginationNav) {
                    paginationNav.style.display = 'flex';
                }
            }
        });
    });
  </script>

    <script>
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
          }, 5000); // 8 detik
      });
  });
  </script>

</body>
</html>