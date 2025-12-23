@extends('layouts.app')

@section('content')


<div class="container-fluid px-4" style="background:#f1f3f5; min-height:100vh;">

    <div class="card shadow-sm border-0 rounded-4 mx-auto mt-4" style="max-width: 900px;">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-1">Form Ubah Detail Purchase Order</h5>
            <p class="text-muted mb-4">
                Halaman Ubah Data Detail Purchase Order PT. Kobar Indonesia
            </p>

            <form method="POST"
                  action="{{ route('detailpo.update', [$detailpo->nopo, $detailpo->nopart]) }}">
                @csrf
                @method('PUT')

                {{-- STYLE --}}
                <style>
                    .input-white {
                        background-color: #ffffff !important;
                        font-weight: normal;
                    }
                    .input-gray {
                        background-color: #e9ecef !important;
                        font-weight: 600;
                    }
                </style>

                {{-- BARIS 1 --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Part</label>
                    <input type="text"
                           class="form-control input-white"
                           value="{{ $detail->part->namapart ?? '-' }}"
                           readonly>
                </div>

                {{-- BARIS 2 --}}
                <div class="row g-3 mb-3">

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Quantity</label>
                        <input type="number"
                               name="quantity"
                               id="quantity"
                               class="form-control input-white"
                               value="{{ $detailpo->quantity }}"
                               min="1" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Unit</label>
                        <input type="text"
                               name="unit"
                               class="form-control input-white"
                               value="{{ $detailpo->unit }}"
                               readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="text"
                               class="form-control input-gray"
                               value="{{ number_format($detail->part->harga ?? 0, 0, ',', '.') }}"
                               readonly>
                    </div>

                </div>

                {{-- BARIS 3 --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">Total</label>
                    <input type="text"
                           id="total"
                           class="form-control input-gray"
                           value="{{ number_format($detailpo->total, 0, ',', '.') }}"
                           readonly>
                </div>

                {{-- HIDDEN HARGA ASLI --}}
                <input type="hidden" id="harga_asli"
                       value="{{ $detail->part->harga ?? 0 }}">

                {{-- BUTTON --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4 rounded-3">
                        Update
                    </button>

                    <a href="{{ route('detailpo.index', $detailpo->nopo) }}"
                       class="btn btn-secondary px-4 rounded-3">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- SCRIPT HITUNG TOTAL REALTIME --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const qtyInput   = document.getElementById('quantity');
    const hargaInput = document.getElementById('harga_asli');
    const totalInput = document.getElementById('total');

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    function hitungTotal() {
        const qty   = parseInt(qtyInput.value) || 0;
        const harga = parseInt(hargaInput.value) || 0;
        const total = qty * harga;

        totalInput.value = formatRupiah(total);
    }

    qtyInput.addEventListener('input', hitungTotal);
});
</script>
@endsection