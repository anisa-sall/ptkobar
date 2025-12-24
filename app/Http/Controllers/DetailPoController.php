<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\DetailPo;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DetailPoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $nopo)
    {
        // JANGAN GUNAKAN urldecode() di sini karena Laravel sudah otomatis decode
        // ketika route pattern menggunakan ->where('nopo', '.*')
        
        // Get user data dari Auth
        $user = Auth::user();
        $namapetugas = $user->name ?? 'Petugas';
        $email = $user->email ?? 'email@example.com';
        $departemen = $user->departemen ?? '';
        
        // Konfigurasi pagination
        $records_per_page = $request->get('records_per_page', 10);
        $page = $request->get('page', 1);
        
        // Ambil data PO - TANPA urldecode()
        $po = PurchaseOrder::with(['customer', 'user'])
            ->where('nopo', $nopo)
            ->first();
            
        if (!$po) {
            Session::flash('error', 'Purchase Order ' . $nopo . ' tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('po.index');
        }
        
        // Query untuk detailpo dengan status perhitungan
        $detailpoQuery = DetailPo::select(
                'detailpo.nopo',
                'detailpo.nopart',
                'detailpo.quantity',
                'detailpo.unit',
                'detailpo.total',
                'part.namapart',
                'part.harga',
                DB::raw('COALESCE(SUM(detailsuratjalan.quantity), 0) as total_dikirim'),
                DB::raw('(detailpo.quantity - COALESCE(SUM(detailsuratjalan.quantity), 0)) as sisa_po')
            )
            ->leftJoin('part', 'detailpo.nopart', '=', 'part.nopart')
            ->leftJoin('suratjalan', 'detailpo.nopo', '=', 'suratjalan.nopo')
            ->leftJoin('detailsuratjalan', function($join) {
                $join->on('suratjalan.nosuratjalan', '=', 'detailsuratjalan.nosuratjalan')
                     ->on('detailpo.nopart', '=', 'detailsuratjalan.nopart');
            })
            ->where('detailpo.nopo', $po->nopo) // Gunakan nopo dari $po
            ->groupBy(
                'detailpo.nopo',
                'detailpo.nopart',
                'detailpo.quantity',
                'detailpo.unit',
                'detailpo.total',
                'part.namapart',
                'part.harga'
            )
            ->orderBy('detailpo.nopo')
            ->orderBy('part.namapart');
            
        // Hitung total records untuk pagination
        $total_records = $detailpoQuery->count();
        $detailpo_list = $detailpoQuery->paginate($records_per_page, ['*'], 'page', $page);
        
        // Tambahkan status untuk setiap detail
        foreach ($detailpo_list as $detail) {
            $quantity_po = $detail->quantity;
            $total_dikirim = $detail->total_dikirim;
            $sisa_po = $detail->sisa_po;
            
            if ($total_dikirim == 0) {
                $detail->status = 'OPEN';
                $detail->status_class = 'btn-rounded-primary';
            } elseif ($sisa_po > 0) {
                $detail->status = 'PARTIAL';
                $detail->status_class = 'btn-rounded-warning';
            } else {
                $detail->status = 'CLOSED';
                $detail->status_class = 'btn-rounded-success';
            }
            
            $detail->sisa_po = $sisa_po;
        }
        
        // Get session messages
        $success = Session::get('success');
        $success_type = Session::get('success_type');
        $error = Session::get('error');
        $error_type = Session::get('error_type');
        
        // Clear session messages
        Session::forget(['success', 'success_type', 'error', 'error_type']);
        
        // Menu access configuration (TANPA stok dan invoice)
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager']
        ];
        
        $namadepan = explode(' ', $namapetugas)[0];
        
        return view('detailpo.index', compact(
            'po',
            'detailpo_list',
            'records_per_page',
            'page',
            'total_records',
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
     * Show the form for creating a new resource.
     */
    public function create($nopo)
    {
        // TANPA urldecode()
        $po = PurchaseOrder::where('nopo', $nopo)->first();
        
        if (!$po) {
            Session::flash('error', 'Purchase Order ' . $nopo . ' tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('po.index');
        }
        
        $user = Auth::user();
        $namapetugas = $user->name ?? 'Petugas';
        $email = $user->email ?? 'email@example.com';
        $departemen = $user->departemen ?? '';
        $namadepan = explode(' ', $namapetugas)[0];
        
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager']
        ];
        
        $parts = Part::orderBy('namapart')->get();
        
        return view('detailpo.create', compact(
            'po',
            'parts',
            'namapetugas',
            'email',
            'departemen',
            'namadepan',
            'menuAccess'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $nopo)
    {
        // TANPA urldecode()
        $request->validate([
            'nopart' => 'required|exists:part,nopart',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required',
            'harga' => 'required|numeric|min:0'
        ]);
        
        // Ambil data PO
        $po = PurchaseOrder::where('nopo', $nopo)->first();
        
        if (!$po) {
            Session::flash('error', 'Purchase Order ' . $nopo . ' tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('po.index');
        }
        
        // Cek apakah part sudah ada di PO ini
        $existing = DetailPo::where('nopo', $po->nopo)
            ->where('nopart', $request->nopart)
            ->first();
            
        if ($existing) {
            $partName = Part::where('nopart', $request->nopart)->value('namapart');
            Session::flash('error', 'Part ' . $partName . ' sudah ada dalam Purchase Order ini. Tidak dapat menambahkan item yang sama.');
            Session::flash('error_type', 'global');
            return back()->withInput();
        }
        
        try {
            DB::beginTransaction();
            
            // Hitung total untuk detailpo
            $harga_part = $request->harga;
            $quantity = $request->quantity;
            $total_detail = $harga_part * $quantity;
            
            // Insert detail PO
            DetailPo::create([
                'nopo' => $po->nopo,
                'nopart' => $request->nopart,
                'quantity' => $quantity,
                'unit' => $request->unit,
                'total' => $total_detail
            ]);
            
            // Hitung ulang subtotal, PPN, dan total untuk PO
            $subtotal = DetailPo::where('nopo', $po->nopo)->sum('total');
            $ppn = $subtotal * 0.12; // PPN 12%
            $total_po = $subtotal + $ppn;
            
            // Ambil harga dari part untuk update harga di PO
            $part = Part::where('nopart', $request->nopart)->first();
            $harga_po = $part ? $part->harga : 0;
            
            // Update PO dengan nilai yang dihitung
            $po->update([
                'harga' => $harga_po,
                'subtotal' => $subtotal,
                'ppn' => $ppn,
                'total' => $total_po
            ]);
            
            DB::commit();
            
            Session::flash('success', 'Detail Part berhasil ditambahkan ke Purchase Order');
            Session::flash('success_type', 'global');
            
            return redirect()->route('detailpo.index', $nopo);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Gagal menambahkan detail PO: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nopo, $nopart)
    {
        // TANPA urldecode()
        $detail = DetailPo::with('part', 'purchaseOrder.customer')
            ->where('nopo', $nopo)
            ->where('nopart', $nopart)
            ->first();
        
        if (!$detail) {
            Session::flash('error', 'Detail PO tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('detailpo.index', $nopo);
        }
        
        $user = Auth::user();
        $namapetugas = $user->name ?? 'Petugas';
        $email = $user->email ?? 'email@example.com';
        $departemen = $user->departemen ?? '';
        $namadepan = explode(' ', $namapetugas)[0];
        
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager']
        ];
        
        $parts = Part::orderBy('namapart')->get();
        
        return view('detailpo.edit', compact(
            'detail',
            'parts',
            'namapetugas',
            'email',
            'departemen',
            'namadepan',
            'menuAccess'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nopo, $nopart)
    {
        // TANPA urldecode()
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'unit' => 'required',
            'nopart' => 'required|exists:part,nopart'
        ]);
        
        $detail = DetailPo::where('nopo', $nopo)
            ->where('nopart', $nopart)
            ->first();
        
        if (!$detail) {
            Session::flash('error', 'Detail PO tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('detailpo.index', $nopo);
        }
        
        // Cek apakah ada surat jalan yang terkait
        $hasSuratJalan = DB::table('suratjalan')
            ->join('detailsuratjalan', 'suratjalan.nosuratjalan', '=', 'detailsuratjalan.nosuratjalan')
            ->where('suratjalan.nopo', $detail->nopo)
            ->where('detailsuratjalan.nopart', $nopart)
            ->exists();
        
        if ($hasSuratJalan) {
            Session::flash('error', 'Tidak dapat mengubah karena part sudah ada di surat jalan');
            Session::flash('error_type', 'global');
            return back()->withInput();
        }
        
        try {
            DB::beginTransaction();
            
            $new_nopart = $request->nopart;
            $quantity = $request->quantity;
            $unit = $request->unit;
            
            // Ambil harga part yang baru
            $part = Part::where('nopart', $new_nopart)->first();
            $harga_part = $part ? $part->harga : 0;
            $total_detail = $harga_part * $quantity;
            
            // Jika nopart berubah
            if ($new_nopart != $nopart) {
                // Cek apakah part baru sudah ada di PO ini
                $existing = DetailPo::where('nopo', $detail->nopo)
                    ->where('nopart', $new_nopart)
                    ->exists();
                
                if ($existing) {
                    throw new \Exception('Part yang baru sudah ada dalam PO ini');
                }
                
                // Hapus yang lama
                $detail->delete();
                
                // Buat yang baru
                DetailPo::create([
                    'nopo' => $detail->nopo,
                    'nopart' => $new_nopart,
                    'quantity' => $quantity,
                    'unit' => $unit,
                    'total' => $total_detail
                ]);
            } else {
                // Update yang lama
                $detail->update([
                    'quantity' => $quantity,
                    'unit' => $unit,
                    'total' => $total_detail
                ]);
            }
            
            // Hitung ulang subtotal, PPN, dan total untuk PO
            $subtotal = DetailPo::where('nopo', $detail->nopo)->sum('total');
            $ppn = $subtotal * 0.12;
            $total_po = $subtotal + $ppn;
            
            // Update PO
            $po = PurchaseOrder::where('nopo', $detail->nopo)->first();
            if ($po) {
                $po->update([
                    'subtotal' => $subtotal,
                    'ppn' => $ppn,
                    'total' => $total_po
                ]);
            }
            
            DB::commit();
            
            Session::flash('success', 'Detail PO berhasil diperbarui');
            Session::flash('success_type', 'global');
            
            return redirect()->route('detailpo.index', $nopo);
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Gagal memperbarui detail PO: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nopo, $nopart)
    {
        // TANPA urldecode()
        $detail = DetailPo::where('nopo', $nopo)
            ->where('nopart', $nopart)
            ->first();
        
        if (!$detail) {
            Session::flash('error', 'Detail PO tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('detailpo.index', $nopo);
        }
        
        // Cek apakah ada surat jalan yang terkait
        $hasSuratJalan = DB::table('suratjalan')
            ->join('detailsuratjalan', 'suratjalan.nosuratjalan', '=', 'detailsuratjalan.nosuratjalan')
            ->where('suratjalan.nopo', $detail->nopo)
            ->where('detailsuratjalan.nopart', $nopart)
            ->exists();
        
        if ($hasSuratJalan) {
            Session::flash('error', 'Tidak dapat menghapus karena part sudah ada di surat jalan');
            Session::flash('error_type', 'global');
            return redirect()->route('detailpo.index', $nopo);
        }
        
        try {
            DB::beginTransaction();
            
            $detail->delete();
            
            // Hitung ulang subtotal, PPN, dan total untuk PO
            $subtotal = DetailPo::where('nopo', $detail->nopo)->sum('total');
            $ppn = $subtotal * 0.12;
            $total_po = $subtotal + $ppn;
            
            // Update PO
            $po = PurchaseOrder::where('nopo', $detail->nopo)->first();
            if ($po) {
                $po->update([
                    'subtotal' => $subtotal,
                    'ppn' => $ppn,
                    'total' => $total_po
                ]);
            }
            
            DB::commit();
            
            Session::flash('success', 'Part berhasil dihapus dari Purchase Order');
            Session::flash('success_type', 'global');
            
            return redirect()->route('detailpo.index', $nopo);
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Gagal menghapus part: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return redirect()->route('detailpo.index', $nopo);
        }
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}