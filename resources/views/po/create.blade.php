@extends('layouts.app')

@section('title', 'Tambah PO - PT. Kobar Indonesia')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Tambah Purchase Order</h4>
            </div>
            <div class="card-body">
                <!-- Notifikasi -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Debug info untuk petugas -->
                @if(Auth::check())
                    <div class="alert alert-info d-none">
                        <small>Debug Info: User ID = {{ Auth::id() }}, Name = {{ Auth::user()->name }}</small>
                    </div>
                @endif

                <form action="{{ route('po.store') }}" method="POST">
                    @csrf

                    <!-- No. PO -->
                    <div class="mb-3">
                        <label for="nopo" class="form-label">No. PO <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nopo') is-invalid @enderror" 
                               id="nopo" 
                               name="nopo" 
                               value="{{ old('nopo') }}"
                               placeholder="Contoh: PO-001-2024"
                               required>
                        @error('nopo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Customer -->
                    <div class="mb-3">
                        <label for="idcustomer" class="form-label">Customer <span class="text-danger">*</span></label>
                        <select class="form-control @error('idcustomer') is-invalid @enderror" 
                                id="idcustomer" 
                                name="idcustomer" 
                                required>
                            <option value="">Pilih Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->idcustomer }}" 
                                    {{ old('idcustomer') == $customer->idcustomer ? 'selected' : '' }}>
                                    {{ $customer->namacustomer }}
                                </option>
                            @endforeach
                        </select>
                        @error('idcustomer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal PO -->
                    <div class="mb-3">
                        <label for="tglpo" class="form-label">Tanggal PO <span class="text-danger">*</span></label>
                        <input type="date" 
                               class="form-control @error('tglpo') is-invalid @enderror" 
                               id="tglpo" 
                               name="tglpo" 
                               value="{{ old('tglpo', date('Y-m-d')) }}"
                               required>
                        @error('tglpo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Delivery Schedule -->
<div class="mb-3">
    <label for="deliveryschedule" class="form-label">
        Delivery Schedule <span class="text-danger">*</span>
    </label>

    <select class="form-control @error('deliveryschedule') is-invalid @enderror"
            id="deliveryschedule"
            name="deliveryschedule"
            required>
        <option value="">Pilih Bulan Delivery</option>

        @php
            $months = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember'
            ];
        @endphp

        @foreach($months as $key => $month)
            <option value="{{ $key }}"
                {{ old('deliveryschedule') == $key ? 'selected' : '' }}>
                {{ $month }}
            </option>
        @endforeach
    </select>

    @error('deliveryschedule')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


                    <!-- Petugas (readonly) -->
                    <div class="mb-4">
                        <label class="form-label">Petugas</label>
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control bg-light" 
                                   value="{{ Auth::user()->namapetugas ?? Auth::user()->name }}" 
                                   readonly
                                   disabled>
                            <span class="input-group-text bg-light">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <small class="text-muted">Petugas terdeteksi otomatis dari akun login</small>
                        
                        <!-- Input hidden untuk idpetugas -->
                        <input type="hidden" 
                               name="idpetugas" 
                               value="{{ Auth::id() }}">
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('po.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan PO
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set min date untuk tanggal PO (hari ini)
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tglpo').min = today;
        
        // Auto focus ke input pertama
        document.getElementById('nopo').focus();
        
        // Validasi form sebelum submit
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // Cek jika idpetugas kosong
            const idpetugasInput = document.querySelector('input[name="idpetugas"]');
            if (!idpetugasInput || !idpetugasInput.value) {
                e.preventDefault();
                alert('Error: Petugas tidak terdeteksi. Silakan login ulang.');
                return false;
            }
            
            // Tampilkan loading
            const submitBtn = document.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
        });
    });
</script>
@endsection