<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Part;
use App\Models\DetailPurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPurchaseOrderController extends Controller
{
    /**
     * Display detail PO
     */
    
   
    public function index($nopo)
    {
        try {
            $po = PurchaseOrder::select('po.*', 'c.namacustomer', 'p.namapetugas')
                ->leftJoin('customer as c', 'po.idcustomer', '=', 'c.idcustomer')
                ->leftJoin('petugas as p', 'po.idpetugas', '=', 'p.idpetugas')
                ->where('po.nopo', $nopo)
                ->firstOrFail();

            $recordsPerPage = request('records_per_page', 10);

            $detailpo = DB::table('detailpo as dp')
                ->select(
                    'dp.nopo',
                    'dp.nopart',
                    'dp.quantity',
                    'dp.unit',
                    'dp.total',
                    'pt.namapart',
                    'pt.harga',
                    DB::raw('COALESCE(SUM(dsj.quantity), 0) as total_dikirim'),
                    DB::raw('(dp.quantity - COALESCE(SUM(dsj.quantity), 0)) as sisa_po')
                )
                ->leftJoin('part as pt', 'dp.nopart', '=', 'pt.nopart')
                ->leftJoin('suratjalan as sj', 'dp.nopo', '=', 'sj.nopo')
                ->leftJoin('detailsuratjalan as dsj', function ($join) {
                    $join->on('sj.nosuratjalan', '=', 'dsj.nosuratjalan')
                         ->on('dsj.nopart', '=', 'dp.nopart');
                })
                ->where('dp.nopo', $nopo)
                ->groupBy(
                    'dp.nopo',
                    'dp.nopart',
                    'dp.quantity',
                    'dp.unit',
                    'dp.total',
                    'pt.namapart',
                    'pt.harga'
                )
                ->orderBy('pt.namapart')
                ->paginate($recordsPerPage);

            $totalPo = DB::table('detailpo')
                ->where('nopo', $nopo)
                ->sum('total');

            return view('detailpo.index', compact(
                'po',
                'detailpo',
                'nopo',
                'recordsPerPage',
                'totalPo'
            ));

        } catch (\Exception $e) {
            return redirect()->route('po.index')
                ->with('error', 'Purchase Order tidak ditemukan.');
        }
    }

    /**
     * Show form create detail
     */
    public function create($nopo)
    {
        $po = PurchaseOrder::select('po.*', 'c.namacustomer')
            ->leftJoin('customer as c', 'po.idcustomer', '=', 'c.idcustomer')
            ->where('po.nopo', $nopo)
            ->first();

        if (!$po) {
            return redirect()->route('po.index')
                ->with('error', 'Purchase Order tidak ditemukan.');
        }

        // Unit dibuat dummy agar VIEW TIDAK ERROR
        $parts = Part::select(
            'nopart',
            'namapart',
            'harga',
            DB::raw("'pcs' as unit")
        )->orderBy('namapart', 'asc')->get();

        // HARUS object (bukan pluck)
        $existingParts = DB::table('detailpo')
            ->where('nopo', $nopo)
            ->select('nopart')
            ->get();

        return view('detailpo.create', compact(
            'po',
            'parts',
            'nopo',
            'existingParts'
        ));
    }

    /**
     * Store detail PO
     */
    public function store(Request $request, $nopo)
    {
        $request->validate([
            'nopart'   => 'required|exists:part,nopart',
            'quantity' => 'required|integer|min:1',
            'unit'     => 'required|string|max:10',
            'harga'    => 'required|numeric|min:1',
        ]);

        // CEK DUPLIKASI PART
        $exists = DB::table('detailpo')
            ->where('nopo', $nopo)
            ->where('nopart', $request->nopart)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Part sudah ada di PO ini');
        }

        // HITUNG TOTAL (BACKEND WAJIB)
        $total = (int) $request->quantity * (int) $request->harga;

        // INSERT TANPA TIMESTAMP & TANPA HARGA
        DB::table('detailpo')->insert([
            'nopo'     => $nopo,
            'nopart'   => $request->nopart,
            'quantity' => $request->quantity,
            'unit'     => $request->unit,
            'total'    => $total,
        ]);

        return redirect()
            ->route('detailpo.index', $nopo)
            ->with('success', 'Part berhasil ditambahkan');
    }

    /**
     * Edit detail PO
     */
    public function edit($nopo, $nopart)
{
    $detailpo = DetailPurchaseOrder::where('nopo', $nopo)
            ->where('nopart', $nopart)
            ->firstOrFail();

    // ⬇️ INI YANG KAMU LUPA
    $parts = Part::orderBy('namapart')->get();

   return view('detailpo.edit', compact('detailpo', 'parts'));
}

    /**
     * Update detail PO
     */
     public function update(Request $request, $nopo, $nopart)
{
    // VALIDASI
    $request->validate([
        'quantity' => 'required|integer|min:1',
        'unit'     => 'required|string|max:10',
    ]);

    // AMBIL DATA PART
    $part = Part::where('nopart', $nopart)->first();
    if (!$part) {
        return back()->with('error', 'Part tidak ditemukan');
    }

    // HITUNG TOTAL
    $total = $request->quantity * $part->harga;

    // UPDATE DATA
    $updated = DB::table('detailpo')
        ->where('nopo', $nopo)
        ->where('nopart', $nopart)
        ->update([
            'quantity' => $request->quantity,
            'unit'     => $request->unit,
            'total'    => $total,
        ]);

    // JIKA DATA TIDAK KETEMU
    if ($updated === 0) {
        return back()->with('error', 'Data tidak ditemukan atau tidak berubah');
    }

    // REDIRECT KE HALAMAN DETAIL
    return redirect()
        ->route('detailpo.index', $nopo)
        ->with('success', 'Detail PO berhasil diperbarui');
}


    /**
     * Destroy detail PO
     */
    public function destroy($nopo, $nopart)
    {
        DB::beginTransaction();

        try {
            $exists = DB::table('detailpo')
                ->where('nopo', $nopo)
                ->where('nopart', $nopart)
                ->exists();

            if (!$exists) {
                throw new \Exception('Detail PO tidak ditemukan');
            }

            $usedInSuratJalan = DB::table('detailsuratjalan as dsj')
                ->join('suratjalan as sj', 'dsj.nosuratjalan', '=', 'sj.nosuratjalan')
                ->where('sj.nopo', $nopo)
                ->where('dsj.nopart', $nopart)
                ->exists();

            if ($usedInSuratJalan) {
                throw new \Exception(
                    'Part tidak bisa dihapus karena sudah digunakan di Surat Jalan'
                );
            }

            DB::table('detailpo')
                ->where('nopo', $nopo)
                ->where('nopart', $nopart)
                ->delete();

            DB::commit();

            return redirect()
                ->route('detailpo.index', $nopo)
                ->with('success', 'Detail PO berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('detailpo.index', $nopo)
                ->with('error', $e->getMessage());
        }
    }
}
