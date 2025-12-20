<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check session
        if (!Session::has('idpetugas')) {
            return redirect()->route('login');
        }
        
        // Handle logout
        if ($request->has('logout') && $request->logout == 'true') {
            Session::flush();
            return redirect('/');
        }

        // Ambil data session
        $namapetugas = Session::get('namapetugas', 'Petugas');
        $email = Session::get('email', 'email@example.com');
        
        // Jika belum ada di session, ambil dari database
        if (!Session::has('namapetugas') || !Session::has('email')) {
            $idpetugas = Session::get('idpetugas');
            $petugas = DB::table('petugas')->where('idpetugas', $idpetugas)->first();
            
            if ($petugas) {
                $namapetugas = $petugas->namapetugas ?? "Petugas";
                $email = $petugas->email ?? "email@example.com";
                
                Session::put('namapetugas', $namapetugas);
                Session::put('email', $email);
                Session::put('departemen', $petugas->departemen ?? '');
            }
        }

        // Konfigurasi pagination
        $records_per_page = $request->get('records_per_page', 10);
        
        // Gunakan pagination Laravel
        $kendaraan_list = DB::table('kendaraan')
            ->select('nopol', 'namakendaraan')
            ->orderBy('nopol')
            ->paginate($records_per_page);
        
        // Tambahkan parameter records_per_page ke pagination links
        $kendaraan_list->appends(['records_per_page' => $records_per_page]);

        // Ambil hanya kata pertama dari nama
        $namadepan = explode(' ', $namapetugas)[0];
        
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'stok' => ['PPIC', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
            'invoice' => ['Finance', 'Manager'],
            'laporan' => ['Finance', 'Manager']
        ];

        // Session messages
        $success = Session::get('success', '');
        $success_type = Session::get('success_type', '');
        $error = Session::get('error', '');
        $error_type = Session::get('error_type', '');
        
        // Clear session messages
        Session::forget(['error', 'error_type', 'success', 'success_type']);

        return view('kendaraan.index', compact(
            'error',
            'error_type',
            'success',
            'success_type',
            'namapetugas',
            'email',
            'namadepan',
            'menuAccess',
            'kendaraan_list',
            'records_per_page'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Check session - JANGAN DIHAPUS
    if (!Session::has('idpetugas')) {
        return redirect()->route('login');
    }
    
    // Ambil data session - JANGAN DIHAPUS
    $namapetugas = Session::get('namapetugas', 'Petugas');
    $email = Session::get('email', 'email@example.com');
    $namadepan = explode(' ', $namapetugas)[0];
    
    // TAMBAHKAN INI: Ambil departemen dari session
    $departemen = Session::get('departemen', '');
    
    $menuAccess = [
        'customer' => ['Marketing', 'Manager'],
        'part' => ['Marketing', 'Manager'],
        'petugas' => ['Manager'],
        'kendaraan' => ['PPIC', 'Manager'],
        'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
        'stok' => ['PPIC', 'Manager'],
        'suratjalan' => ['PPIC', 'Finance', 'Manager'],
        'invoice' => ['Finance', 'Manager'],
        'laporan' => ['Finance', 'Manager']
    ];

    // TAMBAHKAN $departemen ke compact()
    return view('kendaraan.create', compact(
        'namapetugas',
        'email',
        'namadepan',
        'menuAccess',
        'departemen' // INI YANG DITAMBAHKAN
    ));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check session
        if (!Session::has('idpetugas')) {
            return redirect()->route('login');
        }
        
        // Validasi
        $request->validate([
            'nopol' => 'required|string|max:20|unique:kendaraan,nopol',
            'namakendaraan' => 'required|string|max:100',
        ]);

        try {
            DB::table('kendaraan')->insert([
                'nopol' => $request->nopol,
                'namakendaraan' => $request->namakendaraan,
            ]);

            Session::flash('success', 'Kendaraan berhasil ditambahkan');
            Session::flash('success_type', 'global');
            
            return redirect()->route('kendaraan.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal menambahkan kendaraan: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nopol)
    {
        // Check session
        if (!Session::has('idpetugas')) {
            return redirect()->route('login');
        }
        
        // Decode nopol jika perlu
        $nopol = urldecode($nopol);
        
        // Ambil data kendaraan
        $kendaraan = DB::table('kendaraan')->where('nopol', $nopol)->first();
        
        if (!$kendaraan) {
            Session::flash('error', 'Kendaraan tidak ditemukan');
            Session::flash('error_type', 'global');
            return redirect()->route('kendaraan.index');
        }

        // Ambil data session
        $namapetugas = Session::get('namapetugas', 'Petugas');
        $email = Session::get('email', 'email@example.com');
        $namadepan = explode(' ', $namapetugas)[0];
        
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'stok' => ['PPIC', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
            'invoice' => ['Finance', 'Manager'],
            'laporan' => ['Finance', 'Manager']
        ];

        return view('kendaraan.edit', compact(
            'kendaraan',
            'namapetugas',
            'email',
            'namadepan',
            'menuAccess'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nopol)
    {
        // Check session
        if (!Session::has('idpetugas')) {
            return redirect()->route('login');
        }
        
        // Decode nopol jika perlu
        $nopol = urldecode($nopol);
        
        // Validasi
        $request->validate([
            'nopol' => 'required|string|max:20|unique:kendaraan,nopol,' . $nopol . ',nopol',
            'namakendaraan' => 'required|string|max:100',
        ]);

        try {
            DB::table('kendaraan')
                ->where('nopol', $nopol)
                ->update([
                    'nopol' => $request->nopol,
                    'namakendaraan' => $request->namakendaraan,
                ]);

            Session::flash('success', 'Kendaraan berhasil diperbarui');
            Session::flash('success_type', 'global');
            
            return redirect()->route('kendaraan.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal memperbarui kendaraan: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nopol)
    {
        // Check session
        if (!Session::has('idpetugas')) {
            return redirect()->route('login');
        }
        
        // Decode nopol jika perlu
        $nopol = urldecode($nopol);
        
        try {
            DB::table('kendaraan')->where('nopol', $nopol)->delete();
            
            Session::flash('success', 'Kendaraan berhasil dihapus');
            Session::flash('success_type', 'global');
            
            return redirect()->route('kendaraan.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal menghapus kendaraan: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return redirect()->route('kendaraan.index');
        }
    }
}