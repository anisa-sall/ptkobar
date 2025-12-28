@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 grid-margin-sm stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 class="card-title">Data Detail Surat Jalan</h4>
                            <p class="card-description mb-0">
                               Halaman Data Detail Surat Jalan PT. Kobar Indonesia 
                            </p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('suratjalan.print.preview', $suratjalan->nosuratjalan) }}" 
                               target="_blank" 
                               
                            </a>
                            <a href="{{ route('suratjalan.pdf', $suratjalan->nosuratjalan) }}" 
                               target="_blank" 
                               
                            </a>
                            <a href="{{ route('detailsuratjalan.create', $suratjalan->nosuratjalan) }}" 
                               class="btn btn-primary d-flex align-items-center">
                                <span class="mdi mdi-plus me-2"></span>
                                Tambah Part
                            </a>
                        </div>
                    </div>

                    <!-- NOTIFIKASI SUCCESS GLOBAL -->
                    @if(!empty($success) && $success_type === 'global')
                        <div class="alert-global success">
                            <i class="mdi mdi-check-circle"></i>
                            {{ $success }}
                        </div>
                    @endif

                    <!-- NOTIFIKASI ERROR GLOBAL -->
                    @if(!empty($error) && $error_type === 'global')
                        <div class="alert-global error">
                            <i class="mdi mdi-alert-circle"></i>
                            {{ $error }}
                        </div>
                    @endif

                    <!-- CARD HEADER INFORMASI - SAMA DENGAN PHP NATIVE -->
                    <div class="card mb-4" style="border: 2px solid #3b71ca !important; border-radius: 8px !important; padding: 1.25rem;">
                        <div class="card-body py-3">
                            <div class="form-group row">
                                <div class="col-6">
                                    <label class="text-primary fw-bold">No. Surat Jalan</label>
                                    <input type="text" class="form-control border-primary" 
                                           value="{{ $suratjalan->nosuratjalan }}" 
                                           style="border-color: #3b71ca !important; background-color: #ffffff; cursor: not-allowed;"
                                           disabled>
                                </div>
                                <div class="col-6">
                                    <label class="text-primary fw-bold">No. PO</label>
                                    <input type="text" class="form-control border-primary" 
                                           value="{{ $suratjalan->nopo ?? '-' }}" 
                                           style="border-color: #3b71ca !important; background-color: #ffffff; cursor: not-allowed;"
                                           disabled>
                                </div>
                                <div class="col-6 mt-3">
                                    <label class="text-primary fw-bold">Customer</label>
                                    <input type="text" class="form-control border-primary" 
                                           value="{{ $suratjalan->customer->namacustomer ?? '-' }}" 
                                           style="border-color: #3b71ca !important; background-color: #ffffff; cursor: not-allowed;"
                                           disabled>
                                </div>
                                <div class="col-6 mt-3">
                                    <label class="text-primary fw-bold">Tanggal Pengiriman</label>
                                    <input type="text" class="form-control border-primary" 
                                           value="{{ $suratjalan->tglpengiriman ? \Carbon\Carbon::parse($suratjalan->tglpengiriman)->format('d/m/Y') : '-' }}" 
                                           style="border-color: #3b71ca !important; background-color: #ffffff; cursor: not-allowed;"
                                           disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CONTROLS UNTUK SEARCH DAN ENTRIES -->
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <div class="dt-length">
                            <label for="dt-length-0" class="form-label small mb-1">Show entries</label>
                            <select name="details_length" aria-controls="detailsTable" 
                                    class="form-select form-select-sm" 
                                    id="dt-length-0" 
                                    style="width: auto;" 
                                    onchange="changeRecordsPerPage(this.value)">
                                <option value="10" {{ $records_per_page == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $records_per_page == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $records_per_page == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $records_per_page == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                        <div class="dt-search">
                            <label for="dt-search-0" class="form-label small mb-1">Search : </label>
                            <input type="search" class="form-control form-control-sm" 
                                   id="dt-search-0" 
                                   placeholder="" 
                                   aria-controls="detailsTable" 
                                   style="width: 190px;">
                        </div>
                    </div>

                    <!-- TABEL DETAIL PART - SAMA DENGAN PHP NATIVE -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm small" 
                               id="detailsTable" 
                               style="font-size: 0.85rem;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;" class="text-center">No.</th>
                                    <th style="width: 20%;" class="text-wrap">No. Part</th>
                                    <th style="width: 30%;" class="text-wrap">Nama Part</th>
                                    <th style="width: 15%;" class="text-center">Quantity</th>
                                    <th style="width: 15%;" class="text-wrap">Keterangan</th>
                                    <th class="text-center" style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($details->count() > 0)
                                    @php
                                        $counter = ($details->currentPage() - 1) * $details->perPage() + 1;
                                    @endphp
                                    @foreach($details as $detail)
                                        <tr>
                                            <td class="text-center">{{ $counter }}</td>
                                            <td class="text-wrap">{{ $detail->nopart }}</td>
                                            <td class="text-wrap">{{ $detail->part->namapart ?? '-' }}</td>
                                            <td class="text-center">{{ number_format($detail->quantity, 0, ',', '.') }}</td>
                                            <td class="text-wrap">{{ $detail->keterangan ?? '-' }}</td>
                                            <td class="text-center">
                                                <div class="d-flex gap-1 justify-content-center">
                                                    <!-- Button Edit -->
                                                    <a href="{{ route('detailsuratjalan.edit', [$suratjalan->nosuratjalan, $detail->nopart]) }}" 
                                                       class="btn btn-sm btn-outline-primary" 
                                                       title="Edit Quantity"
                                                       style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <!-- Button Hapus -->
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteDetailModal{{ preg_replace('/[^a-zA-Z0-9]/', '', $detail->nopart) }}"
                                                            title="Hapus Part"
                                                            style="padding: 0.15rem 0.4rem; font-size: 0.75rem;">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $counter++; @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-3">Belum ada part dalam Surat Jalan ini</td>
                                    </tr>
                                @endif
                                <!-- Row untuk pesan pencarian tidak ditemukan -->
                                <tr id="no-search-result" style="display: none;">
                                    <td colspan="6" class="text-center py-3">Tidak ada data part yang sesuai dengan pencarian</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- MODAL KONFIRMASI HAPUS DETAIL -->
                    @if($details->count() > 0)
                        @foreach($details as $detail)
                            @php
                                $safe_nopart = preg_replace('/[^a-zA-Z0-9]/', '', $detail->nopart);
                                $modal_id = 'deleteDetailModal' . $safe_nopart;
                            @endphp
                            
                            <div class="modal fade" id="{{ $modal_id }}" 
                                tabindex="-1" 
                                aria-labelledby="deleteDetailModalLabel" 
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="max-width: 450px; margin: 0 auto;">
                                    <div class="modal-content">
                                        <div class="modal-header py-2" style="border-bottom: 1px solid #dee2e6;">
                                            <h6 class="modal-title fs-6 m-0">Konfirmasi Hapus Part</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body py-3">
                                            <div class="text-center">
                                                <p class="m-0 mb-2">Yakin ingin menghapus part dari Surat Jalan?</p>
                                                <p class="m-0 fw-bold">Part: {{ $detail->nopart }}</p>
                                                <p class="m-0">Nama: {{ $detail->part->namapart ?? '-' }}</p>
                                                <p class="m-0">Quantity: {{ number_format($detail->quantity, 0, ',', '.') }}</p>
                                                <p class="m-0 text-danger fw-bold" style="font-size: 0.7rem;">
                                                    Part akan dihapus dari Surat Jalan ini
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer py-2" style="border-top: 1px solid #dee2e6;">
                                            <form action="{{ route('detailsuratjalan.destroy', [$suratjalan->nosuratjalan, $detail->nopart]) }}" method="POST" class="w-100">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary btn-sm rounded-1 w-100">
                                                    Hapus Part
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <!-- Pagination -->
                    <nav aria-label="Page navigation example" class="mt-3">
                        {{ $details->appends(['records_per_page' => $records_per_page])->links() }}
                        
                        <!-- Info Pagination -->
                        <div class="text-muted text-left mt-2 small">
                            Menampilkan {{ $details->count() }} dari {{ $details->total() }} data
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* NOTIFIKASI GLOBAL - SAMA DENGAN PHP NATIVE */
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

/* Tabel styling - SAMA DENGAN PHP NATIVE */
.table.table-bordered.table-hover.table-sm {
    font-size: 0.85rem !important;
    border-collapse: collapse;
}

.table.table-bordered.table-hover.table-sm thead th {
    font-size: 0.75rem !important;
    font-weight: 600;
    background-color: #f8f9fa;
    vertical-align: middle;
    padding: 0.5rem;
    border: 1px solid #dee2e6;
}

.table.table-bordered.table-hover.table-sm tbody td {
    padding: 0.5rem;
    vertical-align: middle;
    border: 1px solid #dee2e6;
}

/* Pagination styling - SAMA DENGAN PHP NATIVE */
.pagination.justify-content-end.mb-0 {
    margin-bottom: 0.5rem !important;
}

.text-muted.text-left.mt-2.small {
    font-size: 0.8rem !important;
    color: #6c757d !important;
}

/* Button styling konsisten dengan PHP Native */
.btn-sm {
    padding: 0.15rem 0.4rem !important;
    font-size: 0.75rem !important;
}
</style>
@endpush

@push('scripts')
<script>
    // Function untuk mengubah jumlah records per page - SAMA DENGAN PHP NATIVE
    function changeRecordsPerPage(recordsPerPage) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('records_per_page', recordsPerPage);
        urlParams.set('page', 1);
        window.location.href = '?' + urlParams.toString();
    }

    // Search functionality - SAMA DENGAN PHP NATIVE
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('dt-search-0');
        const table = document.querySelector('#detailsTable');
        const tbody = table.querySelector('tbody');
        const dataRows = [];
        const noSearchResult = document.getElementById('no-search-result');
        const paginationInfo = document.querySelector('.text-muted.text-left.mt-2.small');
        const paginationNav = document.querySelector('.pagination');
        
        // Kumpulkan hanya baris data
        tbody.querySelectorAll('tr').forEach(row => {
            if (row.id !== 'no-search-result' && 
                !row.querySelector('td')?.textContent.includes('Belum ada')) {
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
                    
                    // Cari di kolom: nopart (index 1), namapart (index 2), keterangan (index 4)
                    for (let i = 1; i <= 4; i++) {
                        if (i === 3) continue; // Skip kolom quantity
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
                
                // Sembunyikan pagination nav saat search aktif
                if (paginationNav) {
                    paginationNav.style.display = 'none';
                }
                
            } else {
                // Jika search kosong, kembalikan ke normal
                if (paginationInfo) {
                    const currentCount = {{ $details->count() }};
                    const totalRecords = {{ $details->total() }};
                    paginationInfo.textContent = `Menampilkan ${currentCount} dari ${totalRecords} data`;
                }
                
                // Tampilkan kembali pagination
                if (paginationNav) {
                    paginationNav.style.display = 'flex';
                }
            }
        });
    });

    // HAPUS NOTIFIKASI GLOBAL SETELAH 8 DETIK - SAMA DENGAN PHP NATIVE
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
@endpush