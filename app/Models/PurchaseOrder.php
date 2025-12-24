<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'po';
    protected $primaryKey = 'nopo';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; // ← TAMBAHKAN INI

    protected $fillable = [
        'nopo',
        'idcustomer',
        'idpetugas',
        'tglpo',
        'deliveryschedule'
    ];

    protected $casts = [
        'tglpo' => 'date',
        'deliveryschedule' => 'date'
    ];

    /**
     * Relationship dengan customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'idcustomer', 'idcustomer');
    }

    /**
     * Relationship dengan user (petugas)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'idpetugas', 'id');
    }

    /**
     * Relationship dengan detailpo
     */
    public function details()
    {
        return $this->hasMany(DetailPo::class, 'nopo', 'nopo');
    }

    /**
     * Relationship dengan suratjalan
     */
    public function suratJalans()
    {
        return $this->hasMany(SuratJalan::class, 'nopo', 'nopo');
    }

    /**
     * Scope untuk mendapatkan data PO dengan join dan perhitungan
     */
    public function scopeWithCalculations($query)
    {
        return $query->select(
            'po.nopo',
            'c.namacustomer',
            'po.tglpo',
            'po.deliveryschedule',
            'u.name as namapetugas',
            DB::raw('COALESCE(SUM(dp.quantity * pt.harga), 0) as subtotal'),
            DB::raw('COALESCE(SUM(dp.quantity * pt.harga * 0.12), 0) as ppn'),
            DB::raw('COALESCE(SUM(dp.quantity * pt.harga * 1.12), 0) as total'),
            DB::raw('MAX(pt.harga) as harga')
        )
        ->leftJoin('customer as c', 'po.idcustomer', '=', 'c.idcustomer')
        ->leftJoin('users as u', 'po.idpetugas', '=', 'u.id')
        ->leftJoin('detailpo as dp', 'po.nopo', '=', 'dp.nopo')
        ->leftJoin('part as pt', 'dp.nopart', '=', 'pt.nopart')
        ->groupBy('po.nopo', 'c.namacustomer', 'po.tglpo', 'po.deliveryschedule', 'u.name');
    }

    /**
     * Fungsi untuk mendapatkan status PO berdasarkan surat jalan
     */
    public function getStatusAttribute()
    {
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
        ", [$this->nopo]);

        $status_data = $status_data[0] ?? null;

        if (!$status_data || $status_data->total_detail == 0) {
            return 'OPEN';
        } elseif ($status_data->total_closed == $status_data->total_detail) {
            return 'CLOSED';
        } elseif ($status_data->total_open == $status_data->total_detail) {
            return 'OPEN';
        } else {
            return 'PARTIAL';
        }
    }

    /**
     * Cek apakah PO bisa dihapus
     */
    public function canDelete()
    {
        // PO bisa dihapus jika belum ada surat jalan
        // Detail PO akan dihapus terlebih dahulu di controller
        return !$this->suratJalans()->exists();
    }

    public static function formatTanggalIndonesia($tanggal)
    {
        if (empty($tanggal) || $tanggal == '0000-00-00') return '';
        
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        try {
            if ($tanggal instanceof \Carbon\Carbon || $tanggal instanceof \DateTime) {
                $timestamp = $tanggal->getTimestamp();
            } else {
                $timestamp = strtotime($tanggal);
            }
            
            $hari = date('d', $timestamp);
            $bulan_num = date('n', $timestamp);
            $tahun = date('Y', $timestamp);
            
            return $hari . ' ' . $bulan[$bulan_num] . ' ' . $tahun;
        } catch (\Exception $e) {
            return $tanggal;
        }
    }

    /**
     * Format delivery schedule Indonesia (Bulan Tahun)
     */
    public static function formatDeliveryScheduleIndonesia($tanggal)
    {
        if (empty($tanggal) || $tanggal == '0000-00-00') return '';
        
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        try {
            if ($tanggal instanceof \Carbon\Carbon || $tanggal instanceof \DateTime) {
                $timestamp = $tanggal->getTimestamp();
            } else {
                $timestamp = strtotime($tanggal);
            }
            
            $bulan_num = date('n', $timestamp);
            $tahun = date('Y', $timestamp);
            
            return $bulan[$bulan_num] . ' ' . $tahun;
        } catch (\Exception $e) {
            return $tanggal;
        }
    }
}