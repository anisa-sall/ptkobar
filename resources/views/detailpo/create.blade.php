@extends('layouts.app')

@section('title', 'Tambah Detail PO')

@section('content')

<div class="content-wrapper">

    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-1">Form Tambah Detail Purchase Order Baru</h5>
                    <p class="text-muted mb-4">
                        Halaman Tambah Data Detail Purchase Order PT. Kobar Indonesia
                    </p>

                    <form action="{{ route('detailpo.store', $nopo) }}" method="POST">
                        @csrf

                        <div class="border rounded p-4">

                            {{-- Nama Part --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Part</label>
                                <select name="nopart" id="nopart" class="form-control" required>
                                    <option value="">-- Pilih Part --</option>
                                    @foreach ($parts as $p)
                                        <option value="{{ $p->nopart }}"
                                                data-harga="{{ $p->harga }}"
                                                data-unit="{{ $p->unit }}">
                                            {{ $p->namapart }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Quantity --}}
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Quantity</label>
                                    <input type="number" name="quantity" id="quantity"
                                           class="form-control" value="1" min="1" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Unit</label>
                                    <input type="text" name="unit" id="unit"
                                           class="form-control" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Harga</label>
                                    <input type="number" name="harga" id="harga"
                                           class="form-control" readonly>
                                </div>
                            </div>

                            {{-- Total --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Total</label>
                                <input type="text" id="total" class="form-control" readonly>
                            </div>

                            {{-- Button --}}
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4">
                                    Submit
                                </button>
                                <a href="{{ route('detailpo.index', $nopo) }}"
                                   class="btn btn-secondary px-4">
                                    Cancel
                                </a>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
