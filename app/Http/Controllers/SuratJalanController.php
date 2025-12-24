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

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get user data
        $user = Auth::user();
        $namapetugas = $user->name ?? 'Petugas';
        $email = $user->email ?? 'email@example.com';
        $departemen = $user->departemen ?? '';
        
        // Konfigurasi pagination
        $records_per_page = $request->get('records_per_page', 10);
        
        // Query utama Surat Jalan
        $suratjalans = SuratJalan::select(
                'suratjalan.nosuratjalan',
                'suratjalan.nopo',
                'customer.namacustomer',
                'suratjalan.tglpengiriman',
                'kendaraan.namakendaraan',
                'users.name as namapetugas'
            )
            ->leftJoin('customer', 'suratjalan.idcustomer', '=', 'customer.idcustomer')
            ->leftJoin('users', 'suratjalan.idpetugas', '=', 'users.id')
            ->leftJoin('kendaraan', 'suratjalan.nopol', '=', 'kendaraan.nopol')
            ->orderBy('suratjalan.tglpengiriman', 'desc')
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
        
        return view('suratjalan.index', compact(
            'suratjalans',
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
        
        // Get data for dropdowns
        $customers = Customer::orderBy('namacustomer')->get();
        $kendaraans = Kendaraan::orderBy('namakendaraan')->get();
        
        // Initialize variables
        $selected_customer = request('idcustomer');
        $pos = [];
        
        // Jika ada customer yang dipilih, ambil PO-nya yang berstatus OPEN atau PARTIAL
        if ($selected_customer) {
            $pos = PurchaseOrder::where('idcustomer', $selected_customer)
                ->get()
                ->filter(function($po) {
                    // Filter hanya PO dengan status OPEN atau PARTIAL
                    return in_array($po->status, ['OPEN', 'PARTIAL']);
                })
                ->map(function($po) {
                    return [
                        'nopo' => $po->nopo,
                        'status' => $po->status
                    ];
                })
                ->values();
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
            'pos'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nosuratjalan' => 'required|unique:suratjalan,nosuratjalan',
            'idcustomer' => 'required|exists:customer,idcustomer',
            'nopo' => 'required|exists:po,nopo',
            'tglpengiriman' => 'required|date',
            'nopol' => 'required|exists:kendaraan,nopol'
        ]);
        
        DB::beginTransaction();
        
        try {
            // Cek apakah PO sudah CLOSED
            $po = PurchaseOrder::where('nopo', $request->nopo)->first();
            
            if ($po->status === 'CLOSED') {
                throw new \Exception("Tidak dapat membuat Surat Jalan karena PO No. {$request->nopo} sudah berstatus CLOSED. Semua part sudah dikirim.");
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
     * Display the specified resource.
     */
    public function show($nosuratjalan)
    {
        // Get Surat Jalan dengan relasi
        $suratjalan = SuratJalan::with(['customer', 'kendaraan', 'petugas', 'purchaseOrder'])
            ->where('nosuratjalan', $nosuratjalan)
            ->first();
            
        if (!$suratjalan) {
            Session::flash('error', 'Surat Jalan tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('suratjalan.index');
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
        
        return view('suratjalan.show', compact(
            'suratjalan',
            'namapetugas',
            'email',
            'departemen',
            'namadepan',
            'menuAccess'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nosuratjalan)
    {
        // Get Surat Jalan
        $suratjalan = SuratJalan::where('nosuratjalan', $nosuratjalan)->first();
        
        if (!$suratjalan) {
            Session::flash('error', 'Surat Jalan tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('suratjalan.index');
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
        
        // Get data for dropdowns
        $customers = Customer::orderBy('namacustomer')->get();
        $kendaraans = Kendaraan::orderBy('namakendaraan')->get();
        $pos = PurchaseOrder::where('idcustomer', $suratjalan->idcustomer)->get();
        
        return view('suratjalan.edit', compact(
            'suratjalan',
            'customers',
            'kendaraans',
            'pos',
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
    public function update(Request $request, $nosuratjalan)
    {
        // Validasi input
        $request->validate([
            'idcustomer' => 'required|exists:customer,idcustomer',
            'nopo' => 'required|exists:po,nopo',
            'tglpengiriman' => 'required|date',
            'nopol' => 'required|exists:kendaraan,nopol'
        ]);
        
        try {
            // Cek apakah Surat Jalan ada
            $suratjalan = SuratJalan::where('nosuratjalan', $nosuratjalan)->first();
            if (!$suratjalan) {
                throw new \Exception('Surat Jalan tidak ditemukan');
            }
            
            // Update Surat Jalan
            $suratjalan->update([
                'idcustomer' => $request->idcustomer,
                'nopo' => $request->nopo,
                'tglpengiriman' => $request->tglpengiriman,
                'nopol' => $request->nopol
            ]);
            
            Session::flash('success', 'Surat Jalan berhasil diperbarui');
            Session::flash('success_type', 'global');
            
            return redirect()->route('suratjalan.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal memperbarui Surat Jalan: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nosuratjalan)
    {
        try {
            $suratjalan = SuratJalan::where('nosuratjalan', $nosuratjalan)->first();
            
            if (!$suratjalan) {
                Session::flash('error', 'Surat Jalan tidak ditemukan');
                Session::flash('error_type', 'global');
                return redirect()->route('suratjalan.index');
            }
            
            $suratjalan->delete();
            
            Session::flash('success', 'Surat Jalan berhasil dihapus');
            Session::flash('success_type', 'global');
            
            return redirect()->route('suratjalan.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal menghapus Surat Jalan: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return redirect()->route('suratjalan.index');
        }
    }

    /**
     * Cetak Surat Jalan
     */
    public function cetak($nosuratjalan)
    {
        $suratjalan = SuratJalan::with(['customer', 'kendaraan', 'petugas', 'purchaseOrder'])
            ->where('nosuratjalan', $nosuratjalan)
            ->first();
            
        if (!$suratjalan) {
            Session::flash('error', 'Surat Jalan tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('suratjalan.index');
        }
        
        return view('suratjalan.cetak', compact('suratjalan'));
    }

    /**
     * Get available POs for selected customer
     */
    public function getPosByCustomer($idcustomer)
    {
        $pos = PurchaseOrder::where('idcustomer', $idcustomer)
            ->get()
            ->filter(function($po) {
                return in_array($po->status, ['OPEN', 'PARTIAL']);
            })
            ->map(function($po) {
                return [
                    'nopo' => $po->nopo,
                    'status' => $po->status
                ];
            })
            ->values();
            
        return response()->json($pos);
    }
}