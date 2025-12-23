@extends('layouts.app')

@section('title', 'Edit PO - PT. Kobar Indonesia')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Purchase Order</h4>
            </div>

            <div class="card-body">
                {{-- Notifikasi --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('po.update', $po->nopo) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- No PO (readonly) --}}
                    <div class="mb-3">
                        <label class="form-label">No. PO</label>
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ $po->nopo }}"
                               readonly>
                    </div>

                    {{-- Customer (editable) --}}
                    <div class="mb-3">
                        <label class="form-label">Customer <span class="text-danger">*</span></label>
                        <select name="idcustomer" class="form-select" required>
                           @foreach($customers as $customer)
    <option value="{{ $customer->idcustomer }}"
        {{ $po->idcustomer == $customer->idcustomer ? 'selected' : '' }}>
        {{ $customer->namacustomer }}
    </option>
@endforeach
                        </select>
                    </div>

                    {{-- Tanggal PO (editable) --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal PO <span class="text-danger">*</span></label>
                        <input type="date"
                               name="tglpo"
                               class="form-control"
                               value="{{ $po->tglpo }}"
                               required>
                    </div>

                    {{-- Delivery Schedule (editable) --}}
<div class="mb-3">
    <label class="form-label">
        Delivery Schedule <span class="text-danger">*</span>
    </label>

    <select name="deliveryschedule" class="form-select" required>
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
                '12' => 'Desember',
            ];

            // ambil bulan saja dari data lama (jika ada)
            $selected = date('m', strtotime($po->deliveryschedule));
        @endphp

        @foreach ($months as $key => $month)
            <option value="{{ $key }}"
                {{ $selected == $key ? 'selected' : '' }}>
                {{ $month }}
            </option>
        @endforeach
    </select>
</div>


                    {{-- Petugas (readonly) --}}
                    <div class="mb-4">
                        <label class="form-label">Petugas</label>
                        <input type="text"
       class="form-control bg-light"
       value="{{ $po->namapetugas ?? '-' }}"
       readonly>
                        <input type="hidden" name="idpetugas" value="{{ $po->idpetugas }}">
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('po.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
