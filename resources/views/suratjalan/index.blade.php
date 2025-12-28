@extends('layouts.app')

@section('content')
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12 grid-margin-sm stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h4 class="card-title">Data Surat Jalan</h4>
                                        <p class="card-description mb-0">
                                            Halaman Data Surat Jalan PT. Kobar Indonesia
                                        </p>
                                    </div>
                                    <a href="{{ route('suratjalan.create') }}" class="btn btn-primary d-flex align-items-center">
                                        <span class="mdi mdi-plus me-2"></span>
                                        Tambah Surat Jalan
                                    </a>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-end mb-3">
                                    <div class="dt-length">
                                        <label for="dt-length-0" class="form-label small mb-1">Show entries</label>
                                        <select name="suratjalan_length" aria-controls="suratjalanTable" class="form-select form-select-sm" id="dt-length-0" style="width: auto;" onchange="changeRecordsPerPage(this.value)">
                                            <option value="10" {{ $records_per_page == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ $records_per_page == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ $records_per_page == 50 ? 'selected' : '' }}>50</option>
                                            <option value="100" {{ $records_per_page == 100 ? 'selected' : '' }}>100</option>
                                        </select>
                                    </div>
                                    <div class="dt-search">
                                        <label for="dt-search-0" class="form-label small mb-1">Search : </label>
                                        <input type="search" class="form-control form-control-sm" id="dt-search-0" placeholder="" aria-controls="suratjalanTable" style="width: 190px;">
                                    </div>
                                </div>

                                <!-- NOTIFIKASI SUCCESS GLOBAL -->
                                @if(session('success') && session('success_type') === 'global')
    <div class="alert-global success mb-3">
        <i class="mdi mdi-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

                                <!-- NOTIFIKASI ERROR GLOBAL -->
                            @if(session('error') && session('error_type') === 'global')
    <div class="alert-global error mb-3">
        <i class="mdi mdi-alert-circle"></i>
        {{ session('error') }}
    </div>
@endif

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover wrap-table" id="suratjalanTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%;">No. Surat Jalan</th>
                                                <th style="width: 15%;" class="text-wrap">No. PO</th>
                                                <th style="width: 16%;" class="text-wrap">Customer</th>
                                                <th style="width: 13%;" class="text-wrap">Tanggal</th>
                                                <th style="width: 15%;" class="text-wrap">Kendaraan</th>
                                                <th style="width: 10%;" class="text-center">Petugas</th>
                                                <th class="text-center" style="width: 16%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($suratjalans->count() > 0)
                                                @foreach($suratjalans as $sj)
                                                    <tr>
                                                        <td class="py-1"><strong class="text-wrap">{{ $sj->nosuratjalan }}</strong></td>
                                                        <td class="text-wrap"><strong>{{ $sj->nopo }}</strong></td>
                                                        <td class="text-wrap">{{ $sj->namacustomer }}</td>
                                                        <td class="text-wrap">
                                                            @if($sj->tglpengiriman)
                                                               {{ date('d F Y', strtotime($sj->tglpengiriman)) }}
                                                            @endif
                                                        </td>
                                                        <td class="text-wrap">{{ $sj->namakendaraan }}</td>
                                                        <td class="text-wrap text-center">
                                                            @php
                                                                $nama_petugas = explode(' ', $sj->namapetugas)[0] ?? $sj->namapetugas;
                                                            @endphp
                                                            {{ $nama_petugas }}
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex gap-1 justify-content-center">
                                                                <!-- Button Print -->
        <a href="{{ route('suratjalan.print.preview', $sj->nosuratjalan) }}" 
           target="_blank"
           class="btn btn-sm btn-outline-success" 
           title="Cetak Surat Jalan"
           style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
            <i class="mdi mdi-printer"></i>
        </a>
<!-- Button Detail -->
<a href="{{ route('detailsuratjalan.index', $sj->nosuratjalan) }}" 
   class="btn btn-sm btn-outline-info" 
   title="Lihat Detail"
   style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
    <i class="mdi mdi-eye"></i> <!-- PAKAI mdi -->
</a>
<!-- ALTERNATIF 1: URL langsung -->
<a href="/surat-jalan/{{ urlencode($sj->nosuratjalan) }}/edit" 
   class="btn btn-sm btn-outline-primary" 
   title="Edit Surat Jalan"
    style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
    <i class="mdi mdi-pencil"></i>
</a>
<!-- Button Hapus -->
<button type="button" 
        class="btn btn-sm btn-outline-danger" 
        data-bs-toggle="modal" 
        data-bs-target="#deleteSuratjalanModal{{ preg_replace('/[^a-zA-Z0-9]/', '', $sj->nosuratjalan) }}"
        title="Hapus Surat Jalan"
        style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
    <i class="mdi mdi-delete"></i> <!-- PAKAI mdi -->
</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center py-3">Tidak ada data surat jalan</td>
                                                </tr>
                                            @endif
                                            <!-- Row untuk pesan pencarian tidak ditemukan -->
                                            <tr id="no-search-result" style="display: none;">
                                                <td colspan="7" class="text-center py-3">Tidak ada data surat jalan yang sesuai dengan pencarian</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- MODAL KONFIRMASI HAPUS SURAT JALAN -->
                                @if($suratjalans->count() > 0)
                                    @foreach($suratjalans as $sj)
                                        @php
                                            $safe_nosuratjalan = preg_replace('/[^a-zA-Z0-9]/', '', $sj->nosuratjalan);
                                            $modal_id = 'deleteSuratjalanModal' . $safe_nosuratjalan;
                                        @endphp
                                        
                                        <div class="modal fade" id="{{ $modal_id }}" 
                                            tabindex="-1" 
                                            aria-labelledby="deleteSuratjalanModalLabel" 
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 450px; margin: 0 auto;">
                                                <div class="modal-content">
                                                    <div class="modal-header py-2" style="border-bottom: 1px solid #dee2e6;">
                                                        <h6 class="modal-title fs-6 m-0">
                                                            {{ $sj->can_delete ? 'Konfirmasi Hapus' : 'Surat Jalan Tidak Dapat Dihapus' }}
                                                        </h6>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body py-3">
                                                        @if(!$sj->can_delete)
                                                            <!-- Modal untuk Surat Jalan yang memiliki detail-->
                                                            <div class="text-center">
                                                                <i class="mdi mdi-alert-circle text-warning mb-2" style="font-size: 2rem;"></i>
                                                                <p class="m-0 mb-2">Surat Jalan <strong>{{ $sj->nosuratjalan }}</strong> tidak dapat dihapus.</p>
                                                                <p class="m-0 text-danger fw-bold" style="font-size: 0.7rem;">
                                                                    @php
                                                                        $has_detail = $sj->details()->exists();
                                                                    @endphp
                                                                    @if($has_detail)
                                                                        Hapus semua detail Surat Jalan terlebih dahulu
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="text-center mt-3">
                                                                @if($has_detail)
                                                                    <a href="{{ route('detailsuratjalan.index', $sj->nosuratjalan) }}" class="btn btn-primary btn-sm rounded-1" style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">
                                                                        <i class="mdi mdi-playlist-check me-1" style="font-size: 0.8rem;"></i>Kelola Detail Surat Jalan
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <!-- Modal untuk Surat Jalan tanpa detail -->
                                                            <div class="text-center">
                                                                <p class="m-0 mb-2">Yakin ingin menghapus Surat Jalan <strong>{{ $sj->nosuratjalan }}</strong>?</p>
                                                                <p class="m-0 text-danger fw-bold" style="font-size: 0.7rem;">Data Surat Jalan akan dihapus permanen</p>
                                                                @if($sj->namacustomer)
                                                                    <p class="m-0 text-black fw-bold" style="font-size: 0.75rem;">Customer: {{ $sj->namacustomer }}</p>
                                                                @endif
                                                                @if($sj->tglpengiriman)
                                                                    <p class="m-0 text-black fw-bold" style="font-size: 0.75rem;">
                                                                        Tanggal: {{ \Carbon\Carbon::parse($sj->tglpengiriman)->format('d/m/Y') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- FOOTER MODAL - HANYA TAMPIL JIKA BISA DIHAPUS -->
                                                    @if($sj->can_delete)
                                                        <div class="modal-footer py-2" style="border-top: 1px solid #ffffffff;">
                                                            <form action="{{ route('suratjalan.destroy', $sj->nosuratjalan) }}" method="POST" class="w-100">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-primary btn-sm rounded-1 w-100">
                                                                    Hapus Surat Jalan
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
                                    {{-- Pagination Links dengan query string --}}
                                    {{ $suratjalans->appends(['records_per_page' => $records_per_page])->links() }}
                                    
                                    <!-- Info Pagination -->
                                    <div class="text-muted text-left mt-2 small">
                                        Menampilkan {{ $suratjalans->count() }} dari {{ $suratjalans->total() }} data
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Function untuk mengubah jumlah records per page
    function changeRecordsPerPage(recordsPerPage) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('records_per_page', recordsPerPage);
        urlParams.set('page', 1); // Reset ke halaman 1
        window.location.href = '?' + urlParams.toString();
    }

    // Search functionality for SURAT JALAN
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
            if (searchTerm === '') {
                if (paginationInfo) {
                    const totalRecords = {{ $suratjalans->total() }};  {{-- UBAH --}}
                    const currentCount = {{ $suratjalans->count() }};   {{-- UBAH --}}
                    paginationInfo.textContent = `Menampilkan ${currentCount} dari ${totalRecords} data`;
                    
                    // Cari di semua kolom kecuali kolom aksi
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
                // Jika search kosong, kembalikan ke normal
                if (paginationInfo) {
                    const totalRecords = {{ $suratjalans->total() }};
                    const currentCount = {{ $suratjalans->count() }};
                    paginationInfo.textContent = `Menampilkan ${currentCount} dari ${totalRecords} data`;
                }
                
                // Tampilkan kembali pagination
                if (paginationNav) {
                    paginationNav.style.display = 'flex';
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
@endpush