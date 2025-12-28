<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\DetailPoController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\DetailSuratJalanController;
use App\Http\Controllers\PrintSuratJalanController;


// ========== ROUTE UTAMA ==========
Route::get('/', function () {
    return view('welcome'); // PASTIKAN mengarah ke welcome.blade.php
})->name('home');

// User routes dengan middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

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
// 1. ROUTE DETAILPO DULU (lebih spesifik)
Route::prefix('purchase-order/{nopo}/detail')->name('detailpo.')
    ->where(['nopo' => '.*'])
    ->group(function () {
        Route::get('/', [DetailPoController::class, 'index'])->name('index');
        Route::get('/create', [DetailPoController::class, 'create'])->name('create');
        Route::post('/', [DetailPoController::class, 'store'])->name('store');
        Route::get('/{nopart}/edit', [DetailPoController::class, 'edit'])->name('edit');
        Route::put('/{nopart}', [DetailPoController::class, 'update'])->name('update');
        Route::delete('/{nopart}', [DetailPoController::class, 'destroy'])->name('destroy');
    })->middleware('auth');

// 2. ROUTE PO SETELAHNYA (kurang spesifik)
Route::prefix('purchase-order')->name('po.')->group(function () {
    Route::get('/', [PurchaseOrderController::class, 'index'])->name('index');
    Route::get('/create', [PurchaseOrderController::class, 'create'])->name('create');
    Route::post('/', [PurchaseOrderController::class, 'store'])->name('store');
    
    // Route PO lainnya DENGAN .* pattern
    Route::get('/{nopo}/edit', [PurchaseOrderController::class, 'edit'])->name('edit')->where('nopo', '.*');
    Route::get('/{nopo}/details', [PurchaseOrderController::class, 'getDetails'])->name('details')->where('nopo', '.*');
    Route::put('/{nopo}', [PurchaseOrderController::class, 'update'])->name('update')->where('nopo', '.*');
    Route::delete('/{nopo}', [PurchaseOrderController::class, 'destroy'])->name('destroy')->where('nopo', '.*');
})->middleware('auth');
 // ========== PRINT ROUTES ==========
    // Gunakan path yang berbeda dari surat-jalan prefix
     Route::get('/surat-jalan/{nosuratjalan}/print', function($nosuratjalan) {
        // Decode URL karena parameter mengandung slash (/)
        $decoded = urldecode($nosuratjalan);
        return redirect()->route('suratjalan.print.preview', $decoded);
    })->where('nosuratjalan', '.*')->name('suratjalan.print.redirect');
    
    Route::get('/surat-jalan/{nosuratjalan}/pdf', function($nosuratjalan) {
        $decoded = urldecode($nosuratjalan);
        return redirect()->route('suratjalan.pdf', $decoded);
    })->where('nosuratjalan', '.*')->name('suratjalan.pdf.redirect');
    
    // ========== ROUTE PRINT BARU ==========
    Route::get('/cetak-surat-jalan/{nosuratjalan}', [PrintSuratJalanController::class, 'preview'])
        ->name('suratjalan.print.preview')
        ->where('nosuratjalan', '.*');
    
    Route::get('/pdf-surat-jalan/{nosuratjalan}', [PrintSuratJalanController::class, 'pdf'])
        ->name('suratjalan.pdf')
        ->where('nosuratjalan', '.*');
    
    Route::get('/print-surat-jalan/{nosuratjalan}', [PrintSuratJalanController::class, 'print'])
        ->name('suratjalan.print-only')
        ->where('nosuratjalan', '.*');
 // Route detail surat jalan
    Route::prefix('surat-jalan/{nosuratjalan}/detail')->name('detailsuratjalan.')
        ->where(['nosuratjalan' => '.*'])  // ← INI YANG PERLU DITAMBAH!
        ->group(function () {
            Route::get('/', [DetailSuratJalanController::class, 'index'])->name('index');
            Route::get('/create', [DetailSuratJalanController::class, 'create'])->name('create');
            Route::post('/', [DetailSuratJalanController::class, 'store'])->name('store');
            Route::get('/{nopart}/edit', [DetailSuratJalanController::class, 'edit'])->name('edit');
            Route::put('/{nopart}', [DetailSuratJalanController::class, 'update'])->name('update');
            Route::delete('/{nopart}', [DetailSuratJalanController::class, 'destroy'])->name('destroy');
        })->middleware('auth');
       // Surat Jalan routes
    Route::prefix('surat-jalan')->name('suratjalan.')->group(function () {
    Route::get('/', [SuratJalanController::class, 'index'])->name('index');
    Route::get('/create', [SuratJalanController::class, 'create'])->name('create');
    Route::post('/', [SuratJalanController::class, 'store'])->name('store');
    
    // ROUTE AJAX ← PASTIKAN INI SEBELUM WILDCARD!
    Route::get('/getPosByCustomer/{idcustomer}', [SuratJalanController::class, 'getPosByCustomer'])->name('getPosByCustomer');
    
    // ROUTE UTAMA SURAT JALAN dengan constraint .* ← SETELAH ROUTE SPESIFIK
    Route::get('/{nosuratjalan}/edit', [SuratJalanController::class, 'edit'])->name('edit')->where('nosuratjalan', '.*');
    Route::get('/{nosuratjalan}/cetak', [SuratJalanController::class, 'cetak'])->name('cetak')->where('nosuratjalan', '.*');
    Route::put('/{nosuratjalan}', [SuratJalanController::class, 'update'])->name('update')->where('nosuratjalan', '.*');
    Route::delete('/{nosuratjalan}', [SuratJalanController::class, 'destroy'])->name('destroy')->where('nosuratjalan', '.*');
    })->middleware('auth');
    
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

    Route::post('confirm-password', [App\Http\Controllers\Auth\ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

    // Tambahkan route ini dalam grup suratjalan
// Route::get('/suratjalan/get-po-by-customer', [SuratJalanController::class, 'getPOByCustomer'])
   // ->name('suratjalan.getPOByCustomer');
});