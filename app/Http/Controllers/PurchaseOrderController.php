<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Customer;
use App\Models\User;
use App\Models\Part;
use App\Models\DetailPo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get user data dari Auth
        $user = Auth::user();
        $namapetugas = $user->name ?? 'Petugas';
        $email = $user->email ?? 'email@example.com';
        $departemen = $user->departemen ?? '';
        
        // Konfigurasi pagination
        $records_per_page = $request->get('records_per_page', 10);
        
        // Query utama PO dengan scope
        $pos = PurchaseOrder::withCalculations()
            ->orderBy('po.tglpo', 'desc')
            ->paginate($records_per_page);
        
        // Tambahkan status untuk setiap PO
        foreach ($pos as $po) {
            $po->status_po = $po->status;
        }
        
        // Get session messages
        $success = Session::get('success');
        $success_type = Session::get('success_type');
        $error = Session::get('error');
        $error_type = Session::get('error_type');
        
        // Clear session messages
        Session::forget(['success', 'success_type', 'error', 'error_type']);
        
        // Menu access configuration (tanpa stok, invoice, laporan)
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager']
        ];
        
        $namadepan = explode(' ', $namapetugas)[0];
        
        return view('purchaseorder.index', compact(
            'pos', 
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
     * Show the form for creating a new resource.
     */
    public function create()
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
        
        // Ambil data customer dan part untuk dropdown
        $customers = Customer::orderBy('namacustomer')->get();
        $parts = Part::orderBy('namapart')->get();
        
        return view('purchaseorder.create', compact(
            'namapetugas',
            'email',
            'departemen',
            'namadepan',
            'menuAccess',
            'customers',
            'parts'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input TANPA parts
        $request->validate([
            'nopo' => 'required|unique:po,nopo',
            'idcustomer' => 'required|exists:customer,idcustomer',
            'tglpo' => 'required|date',
            'deliveryschedule' => 'required|date',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Create new PO
            $po = PurchaseOrder::create([
                'nopo' => $request->nopo,
                'idcustomer' => $request->idcustomer,
                'idpetugas' => Auth::id(),
                'tglpo' => $request->tglpo,
                'deliveryschedule' => $request->deliveryschedule,
            ]);
            
            DB::commit();
            
            Session::flash('success', 'Purchase Order berhasil ditambahkan');
            Session::flash('success_type', 'global');
            
            // REDIRECT KE HALAMAN DETAILPO UNTUK MENAMBAH PARTS
            return redirect()->route('detailpo.index', $po->nopo);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            Session::flash('error', 'Gagal menambahkan Purchase Order: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nopo)
    {
        // Get PO dengan details
        $po = PurchaseOrder::with(['details'])
            ->where('nopo', $nopo)
            ->first();
        
        if (!$po) {
            Session::flash('error', 'Purchase Order tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('po.index');
        }
        
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
        
        // Ambil data customer dan part untuk dropdown
        $customers = Customer::orderBy('namacustomer')->get();
        $parts = Part::orderBy('namapart')->get();
        
        return view('purchaseorder.edit', compact(
            'po',
            'customers',
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
    public function update(Request $request, $nopo)
    {
        // Validasi input TANPA parts (karena parts diupdate terpisah)
        $request->validate([
            'idcustomer' => 'required|exists:customer,idcustomer',
            'tglpo' => 'required|date',
            'deliveryschedule' => 'required|date',
        ]);
        
        DB::beginTransaction();
        
        try {
            $po = PurchaseOrder::where('nopo', $nopo)->first();
            if (!$po) {
                throw new \Exception('Purchase Order tidak ditemukan');
            }
            
            $po->update([
                'idcustomer' => $request->idcustomer,
                'tglpo' => $request->tglpo,
                'deliveryschedule' => $request->deliveryschedule,
            ]);
            
            DB::commit();
            
            Session::flash('success', 'Purchase Order berhasil diperbarui');
            Session::flash('success_type', 'global');
            
            return redirect()->route('po.index');
        } catch (\Exception $e) {
            DB::rollBack();
            
            Session::flash('error', 'Gagal memperbarui Purchase Order: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

    /**
 * Remove the specified resource from storage.
 */
public function destroy($nopo)
{
    try {
        // Decode URL parameter
        $nopo = urldecode($nopo);
        
        $po = PurchaseOrder::where('nopo', $nopo)->first();
        
        if (!$po) {
            Session::flash('error', 'Purchase Order tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('po.index');
        }
        
        // Cek apakah ada surat jalan terkait
        $hasSuratJalan = \Illuminate\Support\Facades\DB::table('suratjalan')
            ->where('nopo', $nopo)
            ->exists();
        
        if ($hasSuratJalan) {
            Session::flash('error', 'PO tidak dapat dihapus karena sudah memiliki surat jalan terkait');
            Session::flash('error_type', 'global');
            return redirect()->route('po.index');
        }
        
        DB::beginTransaction();
        
        try {
            // 1. Hapus detail PO terlebih dahulu (jika ada)
            $detailDeleted = DetailPo::where('nopo', $nopo)->delete();
            
            // 2. Hapus PO setelah detail dihapus
            $poDeleted = $po->delete();
            
            if (!$poDeleted) {
                throw new \Exception('Gagal menghapus Purchase Order');
            }
            
            DB::commit();
            
            Session::flash('success', 'Purchase Order berhasil dihapus');
            Session::flash('success_type', 'global');
            
            return redirect()->route('po.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e; // Re-throw untuk ditangkap oleh catch luar
        }
        
    } catch (\Exception $e) {
        // Rollback sudah dilakukan di inner try-catch
        Session::flash('error', 'Gagal menghapus Purchase Order: ' . $e->getMessage());
        Session::flash('error_type', 'global');
        
        return redirect()->route('po.index');
    }
}

    /**
     * Get PO details for AJAX
     */
    public function getDetails($nopo)
    {
        $nopo = urldecode($nopo);
        
        $details = DetailPo::with('part')
            ->where('nopo', $nopo)
            ->get()
            ->map(function($detail) {
                return [
                    'nopart' => $detail->nopart,
                    'namapart' => $detail->part->namapart ?? '',
                    'harga' => $detail->part->harga ?? 0,
                    'quantity' => $detail->quantity,
                    'subtotal' => $detail->quantity * ($detail->part->harga ?? 0)
                ];
            });
            
        return response()->json($details);
    }
}