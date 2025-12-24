<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use App\Models\DetailSuratJalan;
use App\Models\PurchaseOrder;
use App\Models\DetailPo;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DetailSuratJalanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of detail surat jalan.
     */
    public function index(Request $request, $nosuratjalan)
    {
        // Get user data
        $user = Auth::user();
        $namapetugas = $user->name ?? 'Petugas';
        $email = $user->email ?? 'email@example.com';
        $departemen = $user->departemen ?? '';
        
        // Get Surat Jalan data
        $suratjalan = SuratJalan::with(['customer', 'kendaraan', 'petugas', 'purchaseOrder'])
            ->where('nosuratjalan', $nosuratjalan)
            ->first();
            
        if (!$suratjalan) {
            Session::flash('error', 'Surat Jalan tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('suratjalan.index');
        }
        
        // Konfigurasi pagination
        $records_per_page = $request->get('records_per_page', 10);
        
        // Query detail surat jalan
        $details = DetailSuratJalan::with('part')
            ->where('nosuratjalan', $nosuratjalan)
            ->orderBy('nopart')
            ->paginate($records_per_page);
        
        // Get session messages
        $success = Session::get('success');
        $success_type = Session::get('success_type');
        $error = Session::get('error');
        $error_type = Session::get('error_type');
        
        // Clear session messages
        Session::forget(['success', 'success_type', 'error', 'error_type']);
        
        // Menu access configuration
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager']
        ];
        
        $namadepan = explode(' ', $namapetugas)[0];
        
        return view('detailsuratjalan.index', compact(
            'suratjalan',
            'details',
            'records_per_page',
            'success',
            'success_type',
            'error',
            'error_type',
            'namapetugas',
            'email',
            'departemen',
            'namadepan',
            'menuAccess'
        ));
    }

    /**
     * Show the form for creating a new detail surat jalan.
     */
    public function create($nosuratjalan)
    {
        // Get user data
        $user = Auth::user();
        $namapetugas = $user->name ?? 'Petugas';
        $email = $user->email ?? 'email@example.com';
        $departemen = $user->departemen ?? '';
        $namadepan = explode(' ', $namapetugas)[0];
        
        // Menu access configuration
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager']
        ];
        
        // Get Surat Jalan data
        $suratjalan = SuratJalan::with('purchaseOrder')
            ->where('nosuratjalan', $nosuratjalan)
            ->first();
            
        if (!$suratjalan) {
            Session::flash('error', 'Surat Jalan tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('suratjalan.index');
        }
        
        // Get available parts from PO yang belum dikirim semua
        $availableParts = DetailPo::select(
                'detailpo.nopart',
                'part.namapart',
                'part.harga',
                'detailpo.quantity as po_quantity',
                'detailpo.unit',
                DB::raw('COALESCE(SUM(dsj.quantity), 0) as total_dikirim'),
                DB::raw('(detailpo.quantity - COALESCE(SUM(dsj.quantity), 0)) as sisa_po')
            )
            ->leftJoin('part', 'detailpo.nopart', '=', 'part.nopart')
            ->leftJoin('suratjalan as sj', 'detailpo.nopo', '=', 'sj.nopo')
            ->leftJoin('detailsuratjalan as dsj', function($join) use ($nosuratjalan) {
                $join->on('sj.nosuratjalan', '=', 'dsj.nosuratjalan')
                     ->on('detailpo.nopart', '=', 'dsj.nopart')
                     ->where('dsj.nosuratjalan', '!=', $nosuratjalan);
            })
            ->where('detailpo.nopo', $suratjalan->nopo)
            ->groupBy('detailpo.nopart', 'part.namapart', 'part.harga', 'detailpo.quantity', 'detailpo.unit')
            ->havingRaw('(detailpo.quantity - COALESCE(SUM(dsj.quantity), 0)) > 0')
            ->orderBy('part.namapart')
            ->get();
        
        return view('detailsuratjalan.create', compact(
            'suratjalan',
            'availableParts',
            'namapetugas',
            'email',
            'departemen',
            'namadepan',
            'menuAccess'
        ));
    }

    /**
     * Store a newly created detail surat jalan in storage.
     */
    public function store(Request $request, $nosuratjalan)
    {
        // Validasi input
        $request->validate([
            'nopart' => 'required|exists:part,nopart',
            'quantity' => 'required|integer|min:1'
        ]);
        
        DB::beginTransaction();
        
        try {
            // Get Surat Jalan
            $suratjalan = SuratJalan::where('nosuratjalan', $nosuratjalan)->first();
            if (!$suratjalan) {
                throw new \Exception('Surat Jalan tidak ditemukan');
            }
            
            // Cek apakah part sudah ada di detail surat jalan ini
            $existingDetail = DetailSuratJalan::where('nosuratjalan', $nosuratjalan)
                ->where('nopart', $request->nopart)
                ->first();
                
            if ($existingDetail) {
                $partName = Part::where('nopart', $request->nopart)->first()->namapart ?? $request->nopart;
                throw new \Exception("Part $partName sudah ada dalam Surat Jalan ini.");
            }
            
            // Cek sisa PO untuk part ini
            $poDetail = DetailPo::select(
                    'detailpo.quantity as po_quantity',
                    DB::raw('COALESCE(SUM(dsj.quantity), 0) as total_dikirim')
                )
                ->leftJoin('suratjalan as sj', 'detailpo.nopo', '=', 'sj.nopo')
                ->leftJoin('detailsuratjalan as dsj', function($join) use ($nosuratjalan) {
                    $join->on('sj.nosuratjalan', '=', 'dsj.nosuratjalan')
                         ->on('detailpo.nopart', '=', 'dsj.nopart')
                         ->where('dsj.nosuratjalan', '!=', $nosuratjalan);
                })
                ->where('detailpo.nopo', $suratjalan->nopo)
                ->where('detailpo.nopart', $request->nopart)
                ->groupBy('detailpo.quantity')
                ->first();
            
            if (!$poDetail) {
                throw new \Exception('Part tidak ditemukan dalam Purchase Order terkait.');
            }
            
            $sisa_po = $poDetail->po_quantity - $poDetail->total_dikirim;
            
            if ($request->quantity > $sisa_po) {
                throw new \Exception("Quantity melebihi sisa PO. Sisa PO: $sisa_po, Quantity yang dimasukkan: {$request->quantity}");
            }
            
            // Create new detail surat jalan
            DetailSuratJalan::create([
                'nosuratjalan' => $nosuratjalan,
                'nopart' => $request->nopart,
                'quantity' => $request->quantity
            ]);
            
            DB::commit();
            
            Session::flash('success', 'Detail Part berhasil ditambahkan ke Surat Jalan');
            Session::flash('success_type', 'global');
            
            return redirect()->route('detailsuratjalan.index', $nosuratjalan);
        } catch (\Exception $e) {
            DB::rollBack();
            
            Session::flash('error', 'Gagal menambahkan Detail Part: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified detail surat jalan.
     */
    public function edit($nosuratjalan, $nopart)
    {
        // Get user data
        $user = Auth::user();
        $namapetugas = $user->name ?? 'Petugas';
        $email = $user->email ?? 'email@example.com';
        $departemen = $user->departemen ?? '';
        $namadepan = explode(' ', $namapetugas)[0];
        
        // Menu access configuration
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager']
        ];
        
        // Get detail surat jalan
        $detail = DetailSuratJalan::with('part')
            ->where('nosuratjalan', $nosuratjalan)
            ->where('nopart', $nopart)
            ->first();
            
        if (!$detail) {
            Session::flash('error', 'Detail Surat Jalan tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('detailsuratjalan.index', $nosuratjalan);
        }
        
        // Get Surat Jalan data
        $suratjalan = SuratJalan::where('nosuratjalan', $nosuratjalan)->first();
        
        // Get available quantity from PO
        $poDetail = DetailPo::select(
                'detailpo.quantity as po_quantity',
                DB::raw('COALESCE(SUM(dsj.quantity), 0) as total_dikirim')
            )
            ->leftJoin('suratjalan as sj', 'detailpo.nopo', '=', 'sj.nopo')
            ->leftJoin('detailsuratjalan as dsj', function($join) use ($nosuratjalan) {
                $join->on('sj.nosuratjalan', '=', 'dsj.nosuratjalan')
                     ->on('detailpo.nopart', '=', 'dsj.nopart')
                     ->where('dsj.nosuratjalan', '!=', $nosuratjalan);
            })
            ->where('detailpo.nopo', $suratjalan->nopo)
            ->where('detailpo.nopart', $nopart)
            ->groupBy('detailpo.quantity')
            ->first();
        
        $max_quantity = 0;
        if ($poDetail) {
            $max_quantity = $poDetail->po_quantity - $poDetail->total_dikirim + $detail->quantity;
        }
        
        return view('detailsuratjalan.edit', compact(
            'suratjalan',
            'detail',
            'max_quantity',
            'namapetugas',
            'email',
            'departemen',
            'namadepan',
            'menuAccess'
        ));
    }

    /**
     * Update the specified detail surat jalan in storage.
     */
    public function update(Request $request, $nosuratjalan, $nopart)
    {
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        DB::beginTransaction();
        
        try {
            // Get detail surat jalan
            $detail = DetailSuratJalan::where('nosuratjalan', $nosuratjalan)
                ->where('nopart', $nopart)
                ->first();
                
            if (!$detail) {
                throw new \Exception('Detail Surat Jalan tidak ditemukan');
            }
            
            // Get Surat Jalan
            $suratjalan = SuratJalan::where('nosuratjalan', $nosuratjalan)->first();
            
            // Cek sisa PO untuk part ini (tidak termasuk quantity yang sedang diedit)
            $poDetail = DetailPo::select(
                    'detailpo.quantity as po_quantity',
                    DB::raw('COALESCE(SUM(CASE WHEN dsj.nosuratjalan != ? THEN dsj.quantity ELSE 0 END), 0) as total_dikirim_lain')
                )
                ->leftJoin('suratjalan as sj', 'detailpo.nopo', '=', 'sj.nopo')
                ->leftJoin('detailsuratjalan as dsj', function($join) {
                    $join->on('sj.nosuratjalan', '=', 'dsj.nosuratjalan')
                         ->on('detailpo.nopart', '=', 'dsj.nopart');
                })
                ->where('detailpo.nopo', $suratjalan->nopo)
                ->where('detailpo.nopart', $nopart)
                ->groupBy('detailpo.quantity')
                ->setBindings([$nosuratjalan])
                ->first();
            
            if (!$poDetail) {
                throw new \Exception('Part tidak ditemukan dalam Purchase Order terkait.');
            }
            
            $max_allowed = $poDetail->po_quantity - $poDetail->total_dikirim_lain;
            
            if ($request->quantity > $max_allowed) {
                throw new \Exception("Quantity melebihi sisa PO. Maksimum yang diizinkan: $max_allowed");
            }
            
            // Update detail surat jalan
            $detail->update([
                'quantity' => $request->quantity
            ]);
            
            DB::commit();
            
            Session::flash('success', 'Detail Part berhasil diperbarui');
            Session::flash('success_type', 'global');
            
            return redirect()->route('detailsuratjalan.index', $nosuratjalan);
        } catch (\Exception $e) {
            DB::rollBack();
            
            Session::flash('error', 'Gagal memperbarui Detail Part: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

    /**
     * Remove the specified detail surat jalan from storage.
     */
    public function destroy($nosuratjalan, $nopart)
    {
        try {
            // Get detail surat jalan
            $detail = DetailSuratJalan::where('nosuratjalan', $nosuratjalan)
                ->where('nopart', $nopart)
                ->first();
                
            if (!$detail) {
                Session::flash('error', 'Detail Surat Jalan tidak ditemukan');
                Session::flash('error_type', 'global');
                return redirect()->route('detailsuratjalan.index', $nosuratjalan);
            }
            
            // Hapus detail surat jalan
            $detail->delete();
            
            Session::flash('success', 'Detail Part berhasil dihapus dari Surat Jalan');
            Session::flash('success_type', 'global');
            
            return redirect()->route('detailsuratjalan.index', $nosuratjalan);
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal menghapus Detail Part: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return redirect()->route('detailsuratjalan.index', $nosuratjalan);
        }
    }
}