<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use App\Models\PurchaseOrder;
use App\Models\Customer;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SuratJalanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ... method index() tetap sama ...

    /**
     * Show the form for creating a new resource.
     */
public function index(Request $request)
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
    
    // Get records per page from request or use default
    $records_per_page = $request->get('records_per_page', 10);
    
    // Get all Surat Jalan with related data - TAMBAHKAN JOIN DISINI!
    $suratjalans = SuratJalan::select('suratjalan.*', 
        'customer.namacustomer',
        'kendaraan.namakendaraan',
        'users.name as namapetugas')
        ->leftJoin('customer', 'suratjalan.idcustomer', '=', 'customer.idcustomer')
        ->leftJoin('kendaraan', 'suratjalan.nopol', '=', 'kendaraan.nopol')
        ->leftJoin('users', 'suratjalan.idpetugas', '=', 'users.id')
        ->orderBy('suratjalan.created_at', 'desc')
        ->paginate($records_per_page);
    
    return view('suratjalan.index', compact(
        'namapetugas',
        'email',
        'departemen',
        'namadepan',
        'menuAccess',
        'suratjalans',
        'records_per_page'
    ));
}

    public function create(Request $request)
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
        
        // Get data for dropdowns
        $customers = Customer::orderBy('namacustomer')->get();
        $kendaraans = Kendaraan::orderBy('namakendaraan')->get();
        
        // Initialize PO options
        $po_options = [];
        $selected_customer = old('idcustomer', $request->input('idcustomer'));
        
        // Jika ada customer yang dipilih, ambil PO-nya yang berstatus OPEN atau PARTIAL
        if ($selected_customer) {
            // AMBIL SEMUA PO DARI CUSTOMER
            $allPos = PurchaseOrder::where('idcustomer', $selected_customer)->get();
            
            // FILTER SECARA MANUAL BERDASARKAN STATUS YANG DIHITUNG
            foreach ($allPos as $po) {
                $nopo = $po->nopo;
                
                // HITUNG STATUS PO (PERSIS SEPERTI DI PHP NATIVE)
                $status_data = DB::select("
                    SELECT 
                        COUNT(*) as total_detail,
                        SUM(CASE WHEN total_dikirim = 0 THEN 1 ELSE 0 END) as total_open,
                        SUM(CASE WHEN total_dikirim = quantity THEN 1 ELSE 0 END) as total_closed
                    FROM (
                        SELECT 
                            dp.quantity,
                            COALESCE((
                                SELECT SUM(dsj.quantity) 
                                FROM detailsuratjalan dsj 
                                JOIN suratjalan sj ON dsj.nosuratjalan = sj.nosuratjalan 
                                WHERE sj.nopo = dp.nopo AND dsj.nopart = dp.nopart
                            ), 0) as total_dikirim
                        FROM detailpo dp 
                        WHERE dp.nopo = ?
                    ) as detail_status
                ", [$nopo]);
                
                if (!empty($status_data)) {
                    $status = $status_data[0];
                    
                    // TENTUKAN STATUS PO
                    if ($status->total_detail == 0) {
                        $status_po = 'OPEN';
                    } elseif ($status->total_closed == $status->total_detail) {
                        $status_po = 'CLOSED';
                    } elseif ($status->total_open == $status->total_detail) {
                        $status_po = 'OPEN';
                    } else {
                        $status_po = 'PARTIAL';
                    }
                    
                    // Hanya tambahkan PO jika statusnya OPEN atau PARTIAL (bukan CLOSED)
                    if (in_array($status_po, ['OPEN', 'PARTIAL'])) {
                        $po_options[$nopo] = $nopo . ' (Status: ' . $status_po . ')';
                    }
                }
            }
        }
        
        return view('suratjalan.create', compact(
            'namapetugas',
            'email',
            'departemen',
            'namadepan',
            'menuAccess',
            'customers',
            'kendaraans',
            'selected_customer',
            'po_options'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Jika ini adalah form partial submit (hanya untuk menampilkan PO)
        if ($request->input('submit_type') == 'partial') {
            return redirect()->route('suratjalan.create')->withInput();
        }
        
        // Validasi input untuk submit final
        $request->validate([
            'nosuratjalan' => 'required|unique:suratjalan,nosuratjalan',
            'idcustomer' => 'required|exists:customer,idcustomer',
            'nopo' => 'required|exists:po,nopo',
            'tglpengiriman' => 'required|date',
            'nopol' => 'required|exists:kendaraan,nopol'
        ]);
        
        DB::beginTransaction();
        
        try {
            // Cek apakah PO sudah CLOSED (logika persis seperti PHP native)
            $nopo = $request->nopo;
            
            $status_data = DB::select("
                SELECT 
                    COUNT(*) as total_detail,
                    SUM(CASE WHEN total_dikirim = 0 THEN 1 ELSE 0 END) as total_open,
                    SUM(CASE WHEN total_dikirim = quantity THEN 1 ELSE 0 END) as total_closed
                FROM (
                    SELECT 
                        dp.quantity,
                        COALESCE((
                            SELECT SUM(dsj.quantity) 
                            FROM detailsuratjalan dsj 
                            JOIN suratjalan sj ON dsj.nosuratjalan = sj.nosuratjalan 
                            WHERE sj.nopo = dp.nopo AND dsj.nopart = dp.nopart
                        ), 0) as total_dikirim
                    FROM detailpo dp 
                    WHERE dp.nopo = ?
                ) as detail_status
            ", [$nopo]);
            
            if (!empty($status_data)) {
                $status = $status_data[0];
                
                // Tentukan status PO
                if ($status->total_detail == 0) {
                    $status_po = 'OPEN';
                } elseif ($status->total_closed == $status->total_detail) {
                    $status_po = 'CLOSED';
                } elseif ($status->total_open == $status->total_detail) {
                    $status_po = 'OPEN';
                } else {
                    $status_po = 'PARTIAL';
                }
                
                // Jika PO sudah CLOSED, tidak bisa buat Surat Jalan
                if ($status_po === 'CLOSED') {
                    throw new \Exception("Tidak dapat membuat Surat Jalan karena PO No. $nopo sudah berstatus CLOSED. Semua part sudah dikirim.");
                }
            }
            
            // Create new Surat Jalan
            $suratjalan = SuratJalan::create([
                'nosuratjalan' => $request->nosuratjalan,
                'nopo' => $request->nopo,
                'idcustomer' => $request->idcustomer,
                'tglpengiriman' => $request->tglpengiriman,
                'nopol' => $request->nopol,
                'idpetugas' => Auth::id()
            ]);
            
            DB::commit();
            
            Session::flash('success', 'Surat Jalan berhasil ditambahkan');
            Session::flash('success_type', 'global');
            
            // Redirect ke detail surat jalan untuk menambahkan item
            return redirect()->route('detailsuratjalan.index', $suratjalan->nosuratjalan);
        } catch (\Exception $e) {
            DB::rollBack();
            
            Session::flash('error', 'Gagal menambahkan Surat Jalan: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

/**
 * Show the form for editing the specified resource.
 */
/**
 * Show the form for editing the specified resource.
 */
public function edit($id)
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
    
    // Find the Surat Jalan (gunakan nosuratjalan)
    $suratjalan = SuratJalan::where('nosuratjalan', $id)->first();
    
    if (!$suratjalan) {
        Session::flash('error', 'Data Surat Jalan tidak ditemukan');
        Session::flash('error_type', 'global');
        return redirect()->route('suratjalan.index');
    }
    
    // Get data for dropdowns
    $customers = Customer::orderBy('namacustomer')->get();
    $kendaraans = Kendaraan::orderBy('namakendaraan')->get();
    
    // Get PO options (semua PO dari customer ini)
    $pos = PurchaseOrder::where('idcustomer', $suratjalan->idcustomer)
        ->orderBy('nopo')
        ->get();
    
    return view('suratjalan.edit', compact(
        'namapetugas',
        'email',
        'departemen',
        'namadepan',
        'menuAccess',
        'suratjalan',
        'customers',
        'kendaraans',
        'pos'
    ));
}

/**
 * Update the specified resource in storage.
 */
/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    $request->validate([
        'nopo' => 'required|exists:po,nopo',
        'idcustomer' => 'required|exists:customer,idcustomer',
        'nopol' => 'required|exists:kendaraan,nopol',
        'tglpengiriman' => 'required|date'
    ]);

    DB::beginTransaction();

    try {
        $suratjalan = SuratJalan::where('nosuratjalan', $id)->firstOrFail();

        $suratjalan->update([
            'nopo' => $request->nopo,
            'idcustomer' => $request->idcustomer,
            'nopol' => $request->nopol,
            'tglpengiriman' => $request->tglpengiriman,
            'idpetugas' => Auth::id()
        ]);

        DB::commit();

        return redirect()->route('suratjalan.index')
            ->with('success', 'Surat Jalan berhasil diperbarui');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()
            ->with('error', $e->getMessage());
    }
}

    /**
     * Get available POs for selected customer (untuk AJAX)
     */
    public function getPosByCustomer($idcustomer)
    {
        // Logika persis seperti di method create()
        $po_options = [];
        $allPos = PurchaseOrder::where('idcustomer', $idcustomer)->get();
        
        foreach ($allPos as $po) {
            $nopo = $po->nopo;
            
            $status_data = DB::select("
                SELECT 
                    COUNT(*) as total_detail,
                    SUM(CASE WHEN total_dikirim = 0 THEN 1 ELSE 0 END) as total_open,
                    SUM(CASE WHEN total_dikirim = quantity THEN 1 ELSE 0 END) as total_closed
                FROM (
                    SELECT 
                        dp.quantity,
                        COALESCE((
                            SELECT SUM(dsj.quantity) 
                            FROM detailsuratjalan dsj 
                            JOIN suratjalan sj ON dsj.nosuratjalan = sj.nosuratjalan 
                            WHERE sj.nopo = dp.nopo AND dsj.nopart = dp.nopart
                        ), 0) as total_dikirim
                    FROM detailpo dp 
                    WHERE dp.nopo = ?
                ) as detail_status
            ", [$nopo]);
            
            if (!empty($status_data)) {
                $status = $status_data[0];
                
                if ($status->total_detail == 0) {
                    $status_po = 'OPEN';
                } elseif ($status->total_closed == $status->total_detail) {
                    $status_po = 'CLOSED';
                } elseif ($status->total_open == $status->total_detail) {
                    $status_po = 'OPEN';
                } else {
                    $status_po = 'PARTIAL';
                }
                
                if (in_array($status_po, ['OPEN', 'PARTIAL'])) {
                    $po_options[] = [
                        'nopo' => $nopo,
                        'status' => $status_po
                    ];
                }
            }
        }
        
        return response()->json($po_options);
    }
}