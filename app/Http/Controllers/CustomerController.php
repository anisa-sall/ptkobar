<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Konfigurasi pagination
        $records_per_page = $request->get('records_per_page', 10);
        
        $customers = Customer::orderBy('namacustomer')
            ->paginate($records_per_page);
        
        // Get user data dari table users (Auth::user())
        $user = Auth::user();
        $namapetugas = $user ? $user->name : 'Petugas'; // Ganti namapetugas dengan name
        $email = $user ? $user->email : 'email@example.com';
        $departemen = $user ? $user->departemen : '';
        
        // Get session messages
        $error = Session::get('error');
        $error_type = Session::get('error_type');
        $success = Session::get('success');
        $success_type = Session::get('success_type');
        
        // Clear session messages
        Session::forget(['error', 'error_type', 'success', 'success_type']);
        
        // Menu access tanpa invoice, laporan, stok
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
        ];
        
        return view('customer.index', compact(
            'customers',
            'namapetugas',
            'email',
            'error',
            'error_type',
            'success',
            'success_type',
            'records_per_page',
            'menuAccess',
            'departemen'
        ));
    }

    public function create()
    {
        // Get user data
        $user = Auth::user();
        $namapetugas = $user ? $user->name : 'Petugas';
        $email = $user ? $user->email : 'email@example.com';
        $departemen = $user ? $user->departemen : '';
        
        // Menu access tanpa invoice, laporan, stok
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
        ];

        return view('customer.create', compact('menuAccess', 'departemen', 'namapetugas', 'email'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namacustomer' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        try {
            Customer::create([
                'namacustomer' => $request->namacustomer,
                'alamat' => $request->alamat,
            ]);
            
            Session::flash('success', 'Customer berhasil ditambahkan');
            Session::flash('success_type', 'global');
            
            return redirect()->route('customer.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal menambahkan customer: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

    public function show($id)
    {
        // Optional: jika ingin menampilkan detail customer
        $customer = Customer::findOrFail($id);

        // Get user data
        $user = Auth::user();
        $namapetugas = $user ? $user->name : 'Petugas';
        $email = $user ? $user->email : 'email@example.com';
        $departemen = $user ? $user->departemen : '';
        
        // Menu access tanpa invoice, laporan, stok
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
        ];

        return view('customer.show', compact('customer', 'menuAccess', 'departemen', 'namapetugas', 'email'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        // Get user data
        $user = Auth::user();
        $namapetugas = $user ? $user->name : 'Petugas';
        $email = $user ? $user->email : 'email@example.com';
        $departemen = $user ? $user->departemen : '';
        
        // Menu access tanpa invoice, laporan, stok
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
        ];

        return view('customer.edit', compact('customer', 'menuAccess', 'departemen', 'namapetugas', 'email'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namacustomer' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        try {
            $customer = Customer::findOrFail($id);
            $customer->update([
                'namacustomer' => $request->namacustomer,
                'alamat' => $request->alamat,
            ]);
            
            Session::flash('success', 'Customer berhasil diupdate');
            Session::flash('success_type', 'global');
            
            return redirect()->route('customer.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal mengupdate customer: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            
            Session::flash('success', 'Customer berhasil dihapus');
            Session::flash('success_type', 'global');
            
            return redirect()->route('customer.index');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal menghapus customer: ' . $e->getMessage());
            Session::flash('error_type', 'global');
            
            return back();
        }
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $records_per_page = $request->get('records_per_page', 10);
        
        $customers = Customer::where('namacustomer', 'like', '%' . $search . '%')
            ->orWhere('alamat', 'like', '%' . $search . '%')
            ->orderBy('namacustomer')
            ->paginate($records_per_page);
        
        // Get user data
        $user = Auth::user();
        $namapetugas = $user ? $user->name : 'Petugas';
        $email = $user ? $user->email : 'email@example.com';
        $departemen = $user ? $user->departemen : '';
        
        // Menu access
        $menuAccess = [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager'],
        ];
        
        return view('customer.index', compact(
            'customers', 
            'search', 
            'records_per_page',
            'menuAccess',
            'departemen',
            'namapetugas',
            'email'
        ));
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}