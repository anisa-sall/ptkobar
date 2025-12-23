@extends('layouts.app')

@section('title', 'Tambah Customer - PT. Kobar Indonesia')

@section('content')
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Customer</h4>
                <p class="card-description mb-4">
                    Form penambahan data customer PT. Kobar Indonesia
                </p>

                {{-- ERROR VALIDASI --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- NOTIFIKASI SUCCESS GLOBAL -->
                @if (!empty($success) && $success_type === 'global')
                    <div class="alert-global success mb-4">
                        <i class="mdi mdi-check-circle"></i>
                        {{ $success }}
                    </div>
                @endif

                <!-- NOTIFIKASI ERROR GLOBAL -->
                @if (!empty($error) && $error_type === 'global')
                    <div class="alert-global error mb-4">
                        <i class="mdi mdi-alert-circle"></i>
                        {{ $error }}
                    </div>
                @endif

                <form action="{{ route('customer.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="namacustomer" class="form-label">Nama Customer <span class="text-danger">*</span></label>
                        <input type="text"
                               name="namacustomer"
                               id="namacustomer"
                               class="form-control"
                               placeholder="Masukkan nama customer"
                               value="{{ old('namacustomer') }}"
                               required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat"
                                  id="alamat"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Masukkan alamat customer"
                                  required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('customer.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-hide notifications after 5 seconds
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
        
        // Focus on first input field
        document.getElementById('namacustomer')?.focus();
    });
</script>
@endsection