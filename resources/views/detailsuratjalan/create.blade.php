@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 class="card-title">Tambah Part ke Surat Jalan</h4>
                            <p class="card-description mb-0">
                                Halaman Tambah Data Detail Surat Jalan PT. Kobar Indonesia 
                            </p>
                            <p class="text-muted mb-0">
                               
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

                    <form method="POST" action="{{ route('detailsuratjalan.store', $suratjalan->nosuratjalan) }}">
                        @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nopart" class="form-label">Pilih Part <span class="text-danger"></span></label>
                                    <select class="form-control" id="nopart" name="nopart" required onchange="updatePartInfo()">
                                        <option value="">Pilih Part</option>
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
                                            <option value="">Tidak ada part yang tersedia (Semua part sudah dikirim)</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- INFO PART TERPILIH -->
                        <div class="card mb-4" id="partInfoCard" style="display: none;">
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
                        <div class="row mb-4"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity" class="form-label">Quantity <span class="text-danger"></span></label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" 
                                           min="1" value="{{ old('quantity') }}" required
                                           oninput="validateQuantity()">
                                    <small class="text-muted">Stok tersedia: <span id="maxQuantity">0</span> <span id="maxUnit"></span></small>
                                    <div class="text-danger small mt-1" id="quantityError"></div>
                                </div>
                            </div>
                
                        <!-- TAMBAHKAN KETERANGAN (OPSIONAL) -->
  <div class="col-md-6">
    <div class="form-group">
        <label for="keterangan" class="form-label">Keterangan</label>
       <input type="text" class="form-control" id="keterangan" name="keterangan" 
       placeholder="Masukkan keterangan (opsional)" 
       value="{{ old('keterangan') }}">
    </div>
</div>
</div>
                        <div class="d-flex justify-content-start mt-4">
                            <button type="submit" class="btn btn-primary me-2" id="submitBtn">
                                Submit
                            </button>
                            <a href="{{ route('detailsuratjalan.index', $suratjalan->nosuratjalan) }}" class="btn btn-light">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
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
</script>
@endpush