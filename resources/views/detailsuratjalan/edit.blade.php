@extends('layouts.app')

@section('content')
<style>
/* ========== CSS DARI PHP NATIVE ========== */
.card {
    border: 1px solid #dee2e6 !important;
    border-radius: 8px !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important;
}

.card-body {
    padding: 1.5rem !important;
}

.card-title {
    font-size: 1.25rem !important;
    font-weight: 600 !important;
    color: #2c3e50 !important;
    margin-bottom: 0.5rem !important;
}

.card-description {
    color: #6c757d !important;
    font-size: 0.9rem !important;
    margin-bottom: 0.5rem !important;
}

.form-group {
    margin-bottom: 1.5rem !important;
}

.form-label {
    font-weight: 500 !important;
    color: #495057 !important;
    margin-bottom: 0.5rem !important;
    font-size: 0.95rem !important;
}

.form-control {
    border: 1px solid #ced4da !important;
    border-radius: 4px !important;
    padding: 0.5rem 0.75rem !important;
    font-size: 0.95rem !important;
}

.form-control:focus {
    border-color: #3b71ca !important;
    box-shadow: 0 0 0 0.2rem rgba(59, 113, 202, 0.25) !important;
}

.btn {
    padding: 0.5rem 1rem !important;
    font-size: 0.95rem !important;
    border-radius: 4px !important;
    font-weight: 500 !important;
}

.btn-primary {
    background-color: #3b71ca !important;
    border-color: #3b71ca !important;
}

.btn-light {
    background-color: #f8f9fa !important;
    border-color: #dee2e6 !important;
    color: #495057 !important;
}

.text-muted {
    font-size: 0.85rem !important;
    color: #6c757d !important;
}

/* Info Card */
.card.mb-4 {
    background-color: #f8f9fa !important;
    border: 1px solid #dee2e6 !important;
}

.card.mb-4 .card-body {
    padding: 1rem !important;
}

.card.mb-4 h6 {
    font-size: 1rem !important;
    font-weight: 600 !important;
    color: #2c3e50 !important;
}
</style>

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- HEADER SEDERHANA SEPERTI PHP NATIVE -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 class="card-title">Form Ubah Detail Surat Jalan</h4>
                            <p class="card-description mb-0">
                                Halaman Ubah Data Detail Surat Jalan PT. Kobar Indonesia
                            </p>
                            <p class="text-muted mb-0">
                              
                            </p>
                        </div>
                
                        </a>
                    </div>

                    <!-- NOTIFIKASI ERROR -->
                    @if(session('error') && session('error_type') === 'global')
                        <div class="alert alert-danger">
                            <i class="mdi mdi-alert-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('detailsuratjalan.update', [$suratjalan->nosuratjalan, urlencode($detail->nopart)]) }}">
                        @csrf
                        @method('PUT')
                      
                <!-- GANTI bagian ini -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-label">Part</label>
            <div class="form-control bg-light">
                @if($detail->part)
                    {{ $detail->part->namapart }}
                    
                @else
                    <strong>{{ $detail->nopart }}</strong>
                @endif
            </div>
            <input type="hidden" name="nopart_real" value="{{ $detail->nopart }}">
        </div>
    </div>
</div>
                            
                        <!-- QUANTITY & KETERANGAN - SEJALAR SEPERTI PHP NATIVE -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity" class="form-label">Quantity <span class="text-danger"></span></label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" 
                                           min="1" max="{{ $max_quantity }}" 
                                           value="{{ old('quantity', $detail->quantity) }}" required>
                                    <small class="text-muted">Stok tersedia: {{ number_format($max_quantity, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            
                            <!-- KETERANGAN SEPERTI PHP NATIVE -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" 
                                           value="{{ old('keterangan', $detail->keterangan) }}" 
                                           placeholder="Masukkan keterangan (opsional)">
                                </div>
                            </div>
                            </div>
                      

                        <!-- BUTTONS SEPERTI PHP NATIVE -->
                        <div class="d-flex justify-content-start mt-4">
                            <button type="submit" class="btn btn-primary me-2">
                                Update
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
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const quantityInput = document.getElementById('quantity');
    const maxQuantity = {{ $max_quantity ?? 0 }};
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const quantity = parseInt(quantityInput.value) || 0;
        
        if (quantity <= 0) {
            alert('Quantity harus lebih dari 0');
            return false;
        }
        
        if (maxQuantity > 0 && quantity > maxQuantity) {
            alert(`Quantity melebihi batas maksimum. Maksimum: ${maxQuantity}`);
            return false;
        }
        
        // Tampilkan loading atau konfirmasi
        if (confirm('Apakah anda yakin ingin mengupdate detail ini?')) {
            this.submit();
        }
    });
    
    // Validasi real-time
    quantityInput.addEventListener('input', function() {
        const quantity = parseInt(this.value) || 0;
        
        if (maxQuantity > 0 && quantity > maxQuantity) {
            this.style.borderColor = '#dc3545';
            this.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.25)';
            
            // Tampilkan pesan error
            let errorElement = document.getElementById('quantity-error');
            if (!errorElement) {
                errorElement = document.createElement('div');
                errorElement.id = 'quantity-error';
                errorElement.className = 'text-danger mt-1';
                errorElement.style.fontSize = '0.85rem';
                this.parentNode.appendChild(errorElement);
            }
            errorElement.textContent = `⚠ Maksimum: ${maxQuantity}`;
        } else {
            this.style.borderColor = '#ced4da';
            this.style.boxShadow = 'none';
            
            const errorElement = document.getElementById('quantity-error');
            if (errorElement) {
                errorElement.remove();
            }
        }
    });
});
</script>
@endsection