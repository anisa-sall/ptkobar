@extends('layouts.app')

@section('content')
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h4 class="card-title">Edit Surat Jalan</h4>
                                        <p class="card-description mb-0">
                                            Form edit data Surat Jalan
                                        </p>
                                    </div>
                                    
                                    </a>
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

                                @if(!isset($suratjalan) || !$suratjalan)
                                    <div class="alert-global error mb-3">
                                        <i class="mdi mdi-alert-circle"></i>
                                        Data Surat Jalan tidak ditemukan
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('suratjalan.index') }}" class="btn btn-primary">
                                            Kembali ke Daftar Surat Jalan
                                        </a>
                                    </div>
                                @else
                                   <!-- TAMBAHKAN DI SINI: Field No. Surat Jalan (Read-Only) -->
    
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label">No. Surat Jalan</label>
                <input type="text" class="form-control" 
                       value="{{ $suratjalan->nosuratjalan }}" 
                       readonly>

            </div>
        </div>
   
                                    <form method="POST" action="{{ route('suratjalan.update', $suratjalan->nosuratjalan) }}">
    @csrf
    @method('PUT')
                                        
                                        <div class="row mb-3">
                                         <div class="col-md-12">
    <div class="form-group">
        <label for="nopo" class="form-label">No. PO <span class="text-danger"></span></label>
        <select class="form-control" id="nopo" name="nopo" required>
            <option value="">Pilih No. PO</option>
            @if(isset($pos) && count($pos) > 0)
                @foreach($pos as $po)
                    <option value="{{ $po->nopo }}" {{ old('nopo', $suratjalan->nopo) == $po->nopo ? 'selected' : '' }}>
                        {{ $po->nopo }}
                    </option>
                @endforeach
            @else
                <option value="">Tidak ada PO untuk customer ini</option>
            @endif
        </select>
        @error('nopo')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
                                  

                                      
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="idcustomer" class="form-label">Customer <span class="text-danger"></span></label>
                                                    <select class="form-control" id="idcustomer" name="idcustomer" required>
                                                        <option value="">Pilih Customer</option>
                                                        @foreach($customers as $customer)
                                                            <option value="{{ $customer->idcustomer }}" {{ old('idcustomer', $suratjalan->idcustomer) == $customer->idcustomer ? 'selected' : '' }}>
                                                                {{ $customer->namacustomer }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('idcustomer')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                         
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="tglpengiriman" class="form-label">Tanggal Pengiriman <span class="text-danger"></span></label>
                                                    <input type="date" class="form-control" id="tglpengiriman" name="tglpengiriman" 
                                                           value="{{ old('tglpengiriman', $suratjalan->tglpengiriman ? \Carbon\Carbon::parse($suratjalan->tglpengiriman)->format('Y-m-d') : '') }}" required>
                                                    @error('tglpengiriman')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nopol" class="form-label">Kendaraan <span class="text-danger"></span></label>
                                                    <select class="form-control" id="nopol" name="nopol" required>
                                                        <option value="">Pilih Kendaraan</option>
                                                        @foreach($kendaraans as $kendaraan)
                                                            <option value="{{ $kendaraan->nopol }}" {{ old('nopol', $suratjalan->nopol) == $kendaraan->nopol ? 'selected' : '' }}>
                                                                {{ $kendaraan->namakendaraan }} ({{ $kendaraan->nopol }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('nopol')
                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                    @enderror
                                             
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="idpetugas" class="form-label">Petugas</label>
                                                    <input type="text" class="form-control" id="idpetugas" 
                                                           value="{{ $suratjalan->petugas->namapetugas ?? $namapetugas }}" readonly>
                                                    <input type="hidden" name="idpetugas" value="{{ $suratjalan->idpetugas }}">
                                                </div>
                                            </div>
                                        </div>

                                                                <div class="d-flex justify-content-start mt-4">
                            <button type="submit" class="btn btn-primary me-2">
                               
                                               
                                                Submit
                                            </button>
                                            <a href="{{ route('suratjalan.index') }}" class="btn btn-light">
                                                Cancel
                                            </a>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection