<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use App\Models\DetailSuratJalan;
use App\Models\Customer;
use App\Models\Kendaraan;
use App\Models\Part;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintSuratJalanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan halaman preview cetak surat jalan
     */
    public function preview($nosuratjalan)
{
    // Ambil data surat jalan
    $suratjalan = SuratJalan::with(['customer', 'kendaraan', 'petugas', 'details.part'])
        ->where('nosuratjalan', $nosuratjalan)
        ->firstOrFail();

    // Ambil user yang login
    $user = Auth::user();
    $nama_prepared = $user->name ?? '';

    // Format tanggal
    $tanggal = $suratjalan->tglpengiriman ?? $suratjalan->created_at;
    $bulan_indonesia = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $tanggal_format = '';
    if ($tanggal) {
        $date = \Carbon\Carbon::parse($tanggal);
        $tanggal_format = $date->format('d') . ' ' . $bulan_indonesia[$date->format('n')] . ' ' . $date->format('Y');
    }

    // PERBAIKAN: Gunakan asset() untuk path, bukan file_exists dengan path fisik
    $logo_path = asset('images/ptkobarlogo.png');
    $stamp_path = asset('images/logokobarbaru1.png');
    
    // Atau cek file dengan public_path()
    $logo_exists = file_exists(public_path('images/ptkobarlogo.png'));
    $stamp_exists = file_exists(public_path('images/logokobarbaru1.png'));

    return view('suratjalan.print', compact(
        'suratjalan',
        'nama_prepared',
        'tanggal_format',
        'logo_path',        // ← TAMBAHKAN INI
        'stamp_path',       // ← TAMBAHKAN INI
        'logo_exists',      // ← TAMBAHKAN INI
        'stamp_exists'      // ← TAMBAHKAN INI
    ));
}

    /**
     * Generate PDF surat jalan
     */
    public function pdf($nosuratjalan)
    {
        // Ambil data surat jalan
        $suratjalan = SuratJalan::with(['customer', 'kendaraan', 'petugas', 'details.part'])
            ->where('nosuratjalan', $nosuratjalan)
            ->firstOrFail();

        // Ambil user yang login
        $user = Auth::user();
        $nama_prepared = $user->name ?? '';

        // Format tanggal
        $tanggal = $suratjalan->tglpengiriman ?? $suratjalan->created_at;
        $bulan_indonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $tanggal_format = '';
        if ($tanggal) {
            $date = \Carbon\Carbon::parse($tanggal);
            $tanggal_format = $date->format('d') . ' ' . $bulan_indonesia[$date->format('n')] . ' ' . $date->format('Y');
        }

        $data = [
    'suratjalan' => $suratjalan,
    'nama_prepared' => $nama_prepared,
    'tanggal_format' => $tanggal_format,
];

        $pdf = Pdf::loadView('suratjalan.pdf', $data)
            ->setPaper('a4', 'landscape')
            ->setOption('margin-top', 10)
            ->setOption('margin-right', 10)
            ->setOption('margin-bottom', 10)
            ->setOption('margin-left', 10);

        return $pdf->download('SuratJalan-' . $nosuratjalan . '.pdf');
    }

    /**
     * Cetak langsung ke printer
     */
    public function print($nosuratjalan)
    {
        // Ambil data surat jalan
        $suratjalan = SuratJalan::with(['customer', 'kendaraan', 'petugas', 'details.part'])
            ->where('nosuratjalan', $nosuratjalan)
            ->firstOrFail();

        $user = Auth::user();
        $nama_prepared = $user->name ?? '';

        // Format tanggal
        $tanggal = $suratjalan->tglpengiriman ?? $suratjalan->created_at;
        $bulan_indonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $tanggal_format = '';
        if ($tanggal) {
            $date = \Carbon\Carbon::parse($tanggal);
            $tanggal_format = $date->format('d') . ' ' . $bulan_indonesia[$date->format('n')] . ' ' . $date->format('Y');
        }

        $logo_path = public_path('images/ptkobarlogo.png');
        $stamp_path = public_path('images/logokobarbaru1.png');

        return view('suratjalan.print-only', compact(
            'suratjalan',
            'nama_prepared',
            'tanggal_format',
            'logo_path',
            'stamp_path'
        ));
    }
}