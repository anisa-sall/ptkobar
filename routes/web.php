<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SuratJalanController;

// ========== ROUTE UTAMA ==========
Route::get('/', function () {
    return view('welcome'); // PASTIKAN mengarah ke welcome.blade.php
})->name('home');

// ========== OVERRIDE AUTH ROUTES ==========
// Login routes
Route::get('/login', function () {
    return redirect()->route('login'); // Biarkan ke auth.login default
})->middleware('guest')->name('login.page');

// ========== DASHBOARD & PROTECTED ROUTES ==========
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Customer routes
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::post('/', [CustomerController::class, 'store'])->name('store');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
    });
    
    // Part routes  
    Route::prefix('part')->name('part.')->group(function () {
        Route::get('/', [PartController::class, 'index'])->name('index');
        Route::get('/create', [PartController::class, 'create'])->name('create');
        Route::post('/', [PartController::class, 'store'])->name('store');
        Route::get('/{part}/edit', [PartController::class, 'edit'])->name('edit');
        Route::put('/{part}', [PartController::class, 'update'])->name('update');
        Route::delete('/{part}', [PartController::class, 'destroy'])->name('destroy');
    });
    
    // Petugas routes
    Route::prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/', [PetugasController::class, 'index'])->name('index');
        Route::get('/create', [PetugasController::class, 'create'])->name('create');
        Route::post('/', [PetugasController::class, 'store'])->name('store');
        Route::get('/{petugas}/edit', [PetugasController::class, 'edit'])->name('edit');
        Route::put('/{petugas}', [PetugasController::class, 'update'])->name('update');
        Route::delete('/{petugas}', [PetugasController::class, 'destroy'])->name('destroy');
    });
    
    // Kendaraan routes
    Route::prefix('kendaraan')->name('kendaraan.')->group(function () {
        Route::get('/', [KendaraanController::class, 'index'])->name('index');
        Route::get('/create', [KendaraanController::class, 'create'])->name('create');
        Route::post('/', [KendaraanController::class, 'store'])->name('store');
        Route::get('/{kendaraan}/edit', [KendaraanController::class, 'edit'])->name('edit');
        Route::put('/{kendaraan}', [KendaraanController::class, 'update'])->name('update');
        Route::delete('/{kendaraan}', [KendaraanController::class, 'destroy'])->name('destroy');
    });
    
    // Purchase Order routes
    Route::prefix('purchase-order')->name('po.')->group(function () {
        Route::get('/', [PurchaseOrderController::class, 'index'])->name('index');
        Route::get('/create', [PurchaseOrderController::class, 'create'])->name('create');
        Route::post('/', [PurchaseOrderController::class, 'store'])->name('store');
        Route::get('/{purchase_order}', [PurchaseOrderController::class, 'show'])->name('show');
        Route::get('/{purchase_order}/edit', [PurchaseOrderController::class, 'edit'])->name('edit');
        Route::put('/{purchase_order}', [PurchaseOrderController::class, 'update'])->name('update');
        Route::delete('/{purchase_order}', [PurchaseOrderController::class, 'destroy'])->name('destroy');
        Route::get('/{purchase_order}/print', [PurchaseOrderController::class, 'print'])->name('print');
    });
    
    // Surat Jalan routes
    Route::prefix('surat-jalan')->name('suratjalan.')->group(function () {
        Route::get('/', [SuratJalanController::class, 'index'])->name('index');
        Route::get('/create', [SuratJalanController::class, 'create'])->name('create');
        Route::post('/', [SuratJalanController::class, 'store'])->name('store');
        Route::get('/{surat_jalan}', [SuratJalanController::class, 'show'])->name('show');
        Route::get('/{surat_jalan}/edit', [SuratJalanController::class, 'edit'])->name('edit');
        Route::put('/{surat_jalan}', [SuratJalanController::class, 'update'])->name('update');
        Route::delete('/{surat_jalan}', [SuratJalanController::class, 'destroy'])->name('destroy');
        Route::get('/{surat_jalan}/print', [SuratJalanController::class, 'print'])->name('print');
    });
});

// ========== AUTH ROUTES (JANGAN GUNAKAN require) ==========
// Include auth routes secara manual
Route::prefix('')->group(function () {
    // Authentication Routes...
    Route::get('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
                ->name('login')
                ->middleware('guest');

    Route::post('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

    Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
                ->name('logout')
                ->middleware('auth');

    // Registration Routes...
    Route::get('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
                ->name('register')
                ->middleware('guest');

    Route::post('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
                ->middleware('guest');

    // Password Reset Routes...
    Route::get('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
                ->name('password.request')
                ->middleware('guest');

    Route::post('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
                ->name('password.email')
                ->middleware('guest');

    Route::get('reset-password/{token}', [App\Http\Controllers\Auth\NewPasswordController::class, 'create'])
                ->name('password.reset')
                ->middleware('guest');

    Route::post('reset-password', [App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
                ->name('password.update')
                ->middleware('guest');

    // Email Verification Routes...
    Route::get('verify-email', [App\Http\Controllers\Auth\EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice')
                ->middleware('auth');

    Route::get('verify-email/{id}/{hash}', [App\Http\Controllers\Auth\VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [App\Http\Controllers\Auth\EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

    // Password Confirmation Routes...
    Route::get('confirm-password', [App\Http\Controllers\Auth\ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm')
                ->middleware('auth');

    Route::post('confirm-password', [App\Http\Controllers\Auth\ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');
});