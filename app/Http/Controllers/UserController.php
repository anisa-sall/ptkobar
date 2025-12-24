<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Cek user yang login
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Cek akses menu 'petugas' - hanya Manager yang bisa akses
        $menuAccess = User::getMenuAccessConfig();
        
        if (!isset($menuAccess['petugas']) || !in_array($user->departemen, $menuAccess['petugas'])) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Hanya Manager yang dapat mengakses halaman ini.');
        }

        // Get parameters
        $records_per_page = $request->get('records_per_page', 10);
        $search = $request->get('search', '');

        // Debug: Cek total user di database
        $totalUsers = DB::table('users')->count();
        
        // Query user kecuali user yang sedang login
        $users = User::where('id', '!=', $user->id)
                    ->when($search, function($query, $searchTerm) {
                        return $query->search($searchTerm);
                    })
                    ->orderBy('name', 'asc')
                    ->paginate($records_per_page);

        // Debug info
        // dd([
        //     'user_id' => $user->id,
        //     'total_users' => $totalUsers,
        //     'filtered_users' => $users->total(),
        //     'current_page_users' => $users->count(),
        //     'query' => $users->toSql()
        // ]);

        // Data untuk view
        return view('petugas.index', [
            'users' => $users,
            'records_per_page' => $records_per_page,
            'search' => $search,
            'namapetugas' => $user->name,
            'email' => $user->email,
            'departemen' => $user->departemen,
            'menuAccess' => $menuAccess,
            'totalUsersInDb' => $totalUsers
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Cek akses menu 'petugas' - hanya Manager yang bisa hapus
        $menuAccess = User::getMenuAccessConfig();
        
        if (!isset($menuAccess['petugas']) || !in_array($user->departemen, $menuAccess['petugas'])) {
            return redirect()->route('users.index')
                ->with('error', 'Akses ditolak.')
                ->with('error_type', 'global');
        }

        // Cegah penghapusan diri sendiri
        if ($user->id == $id) {
            return redirect()->route('users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.')
                ->with('error_type', 'global');
        }

        try {
            $userToDelete = User::findOrFail($id);
            
            // Debug: Cek data yang akan dihapus
            // dd($userToDelete);
            
            $userToDelete->delete();

            return redirect()->route('users.index')
                ->with('success', 'Petugas berhasil dihapus.')
                ->with('success_type', 'global');
        } catch (\Exception $e) {
            // Debug: Tampilkan error
            // dd($e->getMessage());
            
            return redirect()->route('users.index')
                ->with('error', 'Gagal menghapus: ' . $e->getMessage())
                ->with('error_type', 'global');
        }
    }
}