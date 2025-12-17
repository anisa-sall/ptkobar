<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Tambahkan validasi departemen
        $request->validate([
            'departemen' => ['required', 'string', 'in:Marketing,PPIC,Finance,Manager'],
        ]);

        // Cari user berdasarkan email DAN departemen
        $user = \App\Models\User::where('email', $request->email)
            ->where('departemen', $request->departemen)
            ->first();

        // Jika user tidak ditemukan atau password salah
        if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => __('Email, departemen, atau password salah.'),
            ])->onlyInput('email');
        }

        // Login user
        Auth::login($user, $request->boolean('remember'));

        // $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // TAMBAHKAN INI untuk pastikan semua session terhapus
        session()->flush();
        
        // Redirect ke halaman utama (welcome)
        return redirect('/');
    }
}
