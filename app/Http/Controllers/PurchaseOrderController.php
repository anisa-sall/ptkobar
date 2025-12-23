<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PurchaseOrderController extends Controller
{

    public function index(Request $request)
    {
        // Session notification handling (mimic native PHP)
        $local_error = '';
        $local_error_type = '';
        $local_success = '';
        $local_success_type = '';

        if (Session::has('error')) {
            $local_error = Session::get('error');
            $local_error_type = Session::get('error_type', '');
            Session::forget(['error', 'error_type']);
        }

        if (Session::has('success')) {
            $local_success = Session::get('success');
            $local_success_type = Session::get('success_type', '');
            Session::forget(['success', 'success_type']);
        }

        // Check authentication
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get user data
        $user = Auth::user();
        $namapetugas = $user->namapetugas ?? "Petugas";
        $email = $user->email ?? "email@example.com";
        $departemen = $user->departemen ?? '';
        $namadepan = explode(' ', $namapetugas)[0];

        // Format tanggal functions
        function formatTanggalIndonesia($tanggal) {
            if (empty($tanggal) || $tanggal == '0000-00-00') return '';
            
            return date('d/m/Y', strtotime($tanggal));
        }

        function formatDeliveryScheduleIndonesia($tanggal) {
            if (empty($tanggal) || $tanggal == '0000-00-00') return '';
            
            $bulan = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            
            $timestamp = strtotime($tanggal);
            $tahun = date('Y', $timestamp);
            $bulan_num = date('n', $timestamp);
            
            return $bulan[$bulan_num] . ' ' . $tahun;
        }

        // Pagination configuration
        $records_per_page = $request->get('records_per_page', 10);
        $page = $request->get('page', 1);
        $start_from = ($page - 1) * $records_per_page;

        // Calculate total records
        $total_records = DB::table('po')->count();
        $total_pages = ceil($total_records / $records_per_page);

        // Get PO data with joins
        $po_list = DB::table('po')
            ->leftJoin('customer as c', 'po.idcustomer', '=', 'c.idcustomer')
            ->leftJoin('petugas as p', 'po.idpetugas', '=', 'p.idpetugas')
            ->leftJoin('detailpo as dp', 'po.nopo', '=', 'dp.nopo')
            ->leftJoin('part as pt', 'dp.nopart', '=', 'pt.nopart')
            ->select(
                'po.nopo',
                'c.namacustomer',
                'po.tglpo',
                'po.deliveryschedule',
                'p.namapetugas',
                DB::raw('MAX(pt.harga) as harga'),
                DB::raw('SUM(dp.quantity * pt.harga) as subtotal'),
                DB::raw('SUM(dp.quantity * pt.harga) * 0.12 as ppn'),
                DB::raw('SUM(dp.quantity * pt.harga) * 1.12 as total')
            )
            ->groupBy('po.nopo', 'c.namacustomer', 'po.tglpo', 'po.deliveryschedule', 'p.namapetugas')
            ->orderBy('po.tglpo', 'DESC')
            ->skip($start_from)
            ->take($records_per_page)
            ->get();

        // Calculate status for each PO
        foreach ($po_list as $po) {
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
                
                $po->status_po = $status_po;
            }
        }

        // Menu access configuration (REMOVED invoice, stok, laporan)
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager']
        ];

        // Function to check access
        function hasAccess($menuName, $departemen, $menuAccess) {
            return isset($menuAccess[$menuName]) && in_array($departemen, $menuAccess[$menuName]);
        }

        // Check for detail and surat jalan existence for each PO
        foreach ($po_list as $po) {
            $po->has_detail = DB::table('detailpo')->where('nopo', $po->nopo)->exists();
            $po->has_surat_jalan = DB::table('suratjalan')->where('nopo', $po->nopo)->exists();
        }

        return view('po.index', compact(
            'po_list',
            'total_records',
            'total_pages',
            'page',
            'records_per_page',
            'namapetugas',
            'email',
            'departemen',
            'namadepan',
            'local_error',
            'local_error_type',
            'local_success',
            'local_success_type',
            'menuAccess'
        ));
    }
    public function create()
{
    // Cek login
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Data user
    $user = Auth::user();
    $namapetugas = $user->namapetugas ?? 'Petugas';
    $email = $user->email ?? 'email@example.com';
    $departemen = $user->departemen ?? '';

    // Data dropdown
    $customers = DB::table('customer')
        ->orderBy('namacustomer', 'asc')
        ->get();

    $parts = DB::table('part')
        ->orderBy('namapart', 'asc')
        ->get();

    $petugasList = DB::table('petugas')
        ->orderBy('namapetugas', 'asc')
        ->get();

    // Generate NO PO sederhana
    $lastPo = DB::table('po')
        ->orderBy('tglpo', 'desc')
        ->first();

    $noUrut = 1;
    if ($lastPo && preg_match('/^(\d+)/', $lastPo->nopo, $match)) {
        $noUrut = (int)$match[1] + 1;
    }

    $noPo = str_pad($noUrut, 3, '0', STR_PAD_LEFT) . '/PO/' . date('Y');

    // Menu access configuration
    $menuAccess = [
        'customer' => ['Marketing', 'Manager'],
        'part' => ['Marketing', 'Manager'],
        'petugas' => ['Manager'],
        'kendaraan' => ['PPIC', 'Manager'],
        'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
        'suratjalan' => ['PPIC', 'Finance', 'Manager']
    ];

    // Default delivery month = bulan saat ini
    $defaultDeliveryMonth = date('m');

    return view('po.create', compact(
        'customers',
        'parts',
        'petugasList',
        'noPo',
        'namapetugas',
        'email',
        'departemen',
        'menuAccess',
        'defaultDeliveryMonth'
    ));
}
   public function store(Request $request)
{
    // Validasi
    $request->validate([
        'nopo' => 'required|unique:po,nopo',
        'idcustomer' => 'required|exists:customer,idcustomer',
        'tglpo' => 'required|date',
        'delivery_month' => 'required|integer|min:1|max:12', // hanya bulan 1-12
        'idpetugas' => 'required|exists:users,id'
    ], [
        'nopo.required' => 'No. PO harus diisi',
        'nopo.unique' => 'No. PO sudah digunakan',
        'idcustomer.required' => 'Customer harus dipilih',
        'tglpo.required' => 'Tanggal PO harus diisi',
        'delivery_month.required' => 'Bulan delivery harus dipilih',
        'delivery_month.integer' => 'Bulan harus angka',
        'delivery_month.min' => 'Bulan minimal 1 (Januari)',
        'delivery_month.max' => 'Bulan maksimal 12 (Desember)',
        'idpetugas.required' => 'Petugas tidak terdeteksi, silakan login ulang'
    ]);

    try {
        // Ambil tahun dari tanggal PO
        $year = date('Y', strtotime($request->tglpo));
        $month = str_pad($request->delivery_month, 2, '0', STR_PAD_LEFT);
        
        // Format untuk database: YYYY-MM (tahun-bulan saja)
        // Tanggal 01 akan diisi otomatis di database atau bisa kita set
        $deliverySchedule = $year . '-' . $month;
        
        // Simpan data
        $po = PurchaseOrder::create([
            'nopo' => $request->nopo,
            'idcustomer' => $request->idcustomer,
            'tglpo' => $request->tglpo,
            'deliveryschedule' => $deliverySchedule, // Format: YYYY-MM
            'idpetugas' => $request->idpetugas,
        ]);

        return redirect()->route('po.index')
            ->with('success', 'PO berhasil ditambahkan!');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal menambahkan PO: ' . $e->getMessage())
            ->withInput();
    }
}
   public function edit($nopo)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $po = DB::table('po')
        ->leftJoin('customer', 'po.idcustomer', '=', 'customer.idcustomer')
        ->leftJoin('petugas', 'po.idpetugas', '=', 'petugas.idpetugas')
        ->select(
            'po.*',
            'customer.namacustomer',
            'petugas.namapetugas'
        )
        ->where('po.nopo', $nopo)
        ->first();

    if (!$po) {
        return redirect()->route('po.index')
            ->with('error', 'Data PO tidak ditemukan');
    }

    $customers = DB::table('customer')
        ->orderBy('namacustomer', 'asc')
        ->get();
        
    // Menu access configuration
    $menuAccess = [
        'customer' => ['Marketing', 'Manager'],
        'part' => ['Marketing', 'Manager'],
        'petugas' => ['Manager'],
        'kendaraan' => ['PPIC', 'Manager'],
        'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
        'suratjalan' => ['PPIC', 'Finance', 'Manager']
    ];

    // Format delivery schedule untuk display (bulan saja)
    if ($po->deliveryschedule) {
        $deliveryMonth = date('m', strtotime($po->deliveryschedule));
        $po->delivery_month = $deliveryMonth;
    } else {
        $po->delivery_month = date('m'); // default bulan ini
    }

    return view('po.edit', compact('po', 'customers', 'menuAccess'));
}

public function update(Request $request, $nopo)
{
    // Validasi
    $request->validate([
        'idcustomer' => 'required|exists:customer,idcustomer',
        'tglpo' => 'required|date',
        'deliveryschedule' => 'required|date_format:Y-m',
    ], [
        'idcustomer.required' => 'Customer harus dipilih',
        'tglpo.required' => 'Tanggal PO harus diisi',
        'deliveryschedule.required' => 'Delivery schedule harus dipilih',
    ]);

    try {
        $po = PurchaseOrder::where('nopo', $nopo)->firstOrFail();

        $po->update([
            'idcustomer' => $request->idcustomer,
            'tglpo' => $request->tglpo,
            'deliveryschedule' => $request->deliveryschedule . '-01',
        ]);

        return redirect()->route('po.index')
            ->with('success', 'PO berhasil diperbarui');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal update PO: ' . $e->getMessage())
            ->withInput();
    }
}

public function destroy(PurchaseOrder $purchase_order)
{
    // hapus detail PO dulu (kalau ada)
    if (method_exists($purchase_order, 'details')) {
        $purchase_order->details()->delete();
    }

    // hapus PO
    $purchase_order->delete();

    return redirect()
        ->route('po.index')
        ->with('success', 'Purchase Order berhasil dihapus');
}

    public function show($nopo)
{
    // Cek login
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Get user data
    $user = Auth::user();
    $namapetugas = $user->namapetugas ?? "Petugas";
    $email = $user->email ?? "email@example.com";
    $departemen = $user->departemen ?? '';
    $namadepan = explode(' ', $namapetugas)[0];

    // Format tanggal functions (sama seperti di index())
    if (!function_exists('formatTanggalIndonesia')) {
        function formatTanggalIndonesia($tanggal) {
            if (empty($tanggal) || $tanggal == '0000-00-00') return '';
            return date('d/m/Y', strtotime($tanggal));
        }
    }

    if (!function_exists('formatDeliveryScheduleIndonesia')) {
        function formatDeliveryScheduleIndonesia($tanggal) {
            if (empty($tanggal) || $tanggal == '0000-00-00') return '';
            
            $bulan = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            
            $timestamp = strtotime($tanggal);
            $tahun = date('Y', $timestamp);
            $bulan_num = date('n', $timestamp);
            
            return $bulan[$bulan_num] . ' ' . $tahun;
        }
    }

    // Get PO data
    $po_data = DB::table('po')
        ->leftJoin('customer as c', 'po.idcustomer', '=', 'c.idcustomer')
        ->leftJoin('petugas as p', 'po.idpetugas', '=', 'p.idpetugas')
        ->select(
            'po.*',
            'c.namacustomer',
            'p.namapetugas'
        )
        ->where('po.nopo', $nopo)
        ->first();

    if (!$po_data) {
        Session::flash('error_type', 'global');
        Session::flash('error', 'Purchase Order tidak ditemukan.');
        return redirect()->route('po.index');
    }

    // Pagination configuration UNTUK DETAIL PO
    $records_per_page = request()->get('records_per_page', 10);
    $page = request()->get('page', 1);
    $start_from = ($page - 1) * $records_per_page;

    // Hitung total records UNTUK DETAIL PO
    $total_records = DB::table('detailpo')->where('nopo', $nopo)->count();
    $total_pages = ceil($total_records / $records_per_page);

    // Ambil data detailpo dengan pagination
    $detailpo_list = DB::table('detailpo as dp')
        ->leftJoin('part as pt', 'dp.nopart', '=', 'pt.nopart')
        ->select(
            'dp.*',
            'pt.namapart',
            'pt.harga',
            DB::raw('(dp.quantity * pt.harga) as subtotal')
        )
        ->where('dp.nopo', $nopo)
        ->orderBy('dp.nopart', 'asc')
        ->skip($start_from)
        ->take($records_per_page)
        ->get();

    // Hitung total semua item untuk PO ini
    $total_po = DB::table('detailpo as dp')
        ->leftJoin('part as pt', 'dp.nopart', '=', 'pt.nopart')
        ->select(DB::raw('SUM(dp.quantity * pt.harga) as total'))
        ->where('dp.nopo', $nopo)
        ->first();

    $total_po_amount = $total_po->total ?? 0;
    $ppn = $total_po_amount * 0.12;
    $grand_total = $total_po_amount + $ppn;

    // Menu access configuration
    $menuAccess = [
        'customer' => ['Marketing', 'Manager'],
        'part' => ['Marketing', 'Manager'],
        'petugas' => ['Manager'],
        'kendaraan' => ['PPIC', 'Manager'],
        'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
        'suratjalan' => ['PPIC', 'Finance', 'Manager']
    ];

    // Function to check access
    function hasAccess($menuName, $departemen, $menuAccess) {
        return isset($menuAccess[$menuName]) && in_array($departemen, $menuAccess[$menuName]);
    }

    // Check for surat jalan existence
    $has_surat_jalan = DB::table('suratjalan')->where('nopo', $nopo)->exists();

    // ============ TAMBAHKAN KODE INI ============
    // Untuk tampilan index, kita perlu $po_list (daftar PO)
    // Ambil PO list seperti di method index() tapi tanpa pagination
    // atau bisa juga ambil PO yang sedang dilihat saja
    $po_list = DB::table('po')
        ->leftJoin('customer as c', 'po.idcustomer', '=', 'c.idcustomer')
        ->leftJoin('petugas as p', 'po.idpetugas', '=', 'p.idpetugas')
        ->leftJoin('detailpo as dp', 'po.nopo', '=', 'dp.nopo')
        ->leftJoin('part as pt', 'dp.nopart', '=', 'pt.nopart')
        ->select(
            'po.nopo',
            'c.namacustomer',
            'po.tglpo',
            'po.deliveryschedule',
            'p.namapetugas',
            DB::raw('MAX(pt.harga) as harga'),
            DB::raw('SUM(dp.quantity * pt.harga) as subtotal'),
            DB::raw('SUM(dp.quantity * pt.harga) * 0.12 as ppn'),
            DB::raw('SUM(dp.quantity * pt.harga) * 1.12 as total')
        )
        ->where('po.nopo', $nopo)  // Hanya ambil PO yang sedang dilihat
        ->groupBy('po.nopo', 'c.namacustomer', 'po.tglpo', 'po.deliveryschedule', 'p.namapetugas')
        ->get();

    // Calculate status untuk PO ini
    foreach ($po_list as $po) {
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
        ", [$po->nopo]);

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
            
            $po->status_po = $status_po;
        }
        
        // Check for detail and surat jalan existence
        $po->has_detail = DB::table('detailpo')->where('nopo', $po->nopo)->exists();
        $po->has_surat_jalan = DB::table('suratjalan')->where('nopo', $po->nopo)->exists();
    }
    // ============ END TAMBAHKAN ============
    // Kirim SEMUA variabel yang diperlukan ke po.index
    return view('po.index', compact(
        'po_list',           // ← HARUS ADA untuk menghindari error count()
        'po_data',           // Data PO yang sedang dilihat
        'detailpo_list',     // List detail PO
        'total_po_amount',
        'ppn',
        'grand_total',
        'nopo',
        'page',
        'records_per_page',
        'total_records',
        'total_pages',
        'namapetugas',
        'email',
        'departemen',
        'namadepan',
        'menuAccess',
        'has_surat_jalan'
    ));
}
}