<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Autentikasi - redirect ke login jika belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Konfigurasi pagination
        $records_per_page = $request->get('records_per_page', 10);
        
        // Ambil data dengan pagination
        $parts = Part::orderBy('namapart')
                     ->paginate($records_per_page);
        
        // Tambahkan parameter records_per_page ke pagination links
        $parts->appends(['records_per_page' => $records_per_page]);
        
        // Get success/error messages from session
        $success = Session::get('success');
        $success_type = Session::get('success_type');
        $error = Session::get('error');
        $error_type = Session::get('error_type');
        
        // Clear session messages after displaying
        Session::forget(['success', 'success_type', 'error', 'error_type']);
        
        // Get user data
        $user = Auth::user();
        $namapetugas = $user->namapetugas ?? 'Petugas';
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
           
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
           
        ];
        
        return view('part.index', compact(
            'parts', 
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
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Get user data
        $user = Auth::user();
        $namapetugas = $user->namapetugas ?? 'Petugas';
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
        
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
           
        ];
        
        return view('part.create', compact(
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
    public function store(Request $request)
{
    $request->validate([
        'nopart'   => 'required|unique:part,nopart',
        'namapart' => 'required',
        'harga'    => 'required',
    ]);

    // BERSIHKAN FORMAT RUPIAH
    $harga = preg_replace('/[^0-9]/', '', $request->harga);

    Part::create([
        'nopart'   => $request->nopart,
        'namapart' => $request->namapart,
        'harga'    => $harga,
    ]);

    return redirect()->route('part.index')
        ->with('success', 'Part berhasil ditambahkan');
}
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $part = Part::where('nopart', $id)->firstOrFail();
        
        // Get user data
        $user = Auth::user();
        $namapetugas = $user->namapetugas ?? 'Petugas';
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
     
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
           
        ];
        
        return view('part.edit', compact(
            'part',
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
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'namapart' => 'required',
            'harga' => 'required|numeric|min:0',
        ]);
        
        try {
            $part = Part::where('nopart', $id)->firstOrFail();
            $part->update([
                'namapart' => $request->namapart,
                'harga' => $request->harga,
            ]);
            
            Session::flash('success', 'Part berhasil diperbarui');
            Session::flash('success_type', 'global');
            
            return redirect()->route('part.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal memperbarui part: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        try {
            $part = Part::where('nopart', $id)->firstOrFail();
            $part->delete();
            
            Session::flash('success', 'Part berhasil dihapus');
            Session::flash('success_type', 'global');
            
            return redirect()->route('part.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal menghapus part: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return redirect()->route('part.index');
        }
    }
    
    /**
     * Function untuk check akses menu
     */
    public function hasAccess($menuName, $departemen, $menuAccess)
    {
        return isset($menuAccess[$menuName]) && in_array($departemen, $menuAccess[$menuName]);
    }
}