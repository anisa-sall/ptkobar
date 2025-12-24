<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;

    protected $table = 'suratjalan';
    protected $primaryKey = 'nosuratjalan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nosuratjalan',
        'nopo',
        'idcustomer',
        'tglpengiriman',
        'nopol',
        'idpetugas'
    ];

    protected $casts = [
        'tglpengiriman' => 'date'
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
    public function petugas()
    {
        return $this->belongsTo(User::class, 'idpetugas', 'id');
    }

    /**
     * Relationship dengan kendaraan
     */
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nopol', 'nopol');
    }

    /**
     * Relationship dengan purchase order
     */
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'nopo', 'nopo');
    }

    /**
     * Relationship dengan detail surat jalan
     */
    public function details()
    {
        return $this->hasMany(DetailSuratJalan::class, 'nosuratjalan', 'nosuratjalan');
    }

    /**
     * Cek apakah surat jalan bisa dihapus
     */
    public function canDelete()
    {
        // Bisa dihapus jika tidak memiliki detail
        return !$this->details()->exists();
    }

    /**
     * Get total quantity semua part di surat jalan ini
     */
    public function getTotalQuantityAttribute()
    {
        return $this->details()->sum('quantity');
    }

    /**
     * Get total harga semua part di surat jalan ini
     */
    public function getTotalHargaAttribute()
    {
        $total = 0;
        foreach ($this->details as $detail) {
            $total += $detail->quantity * ($detail->part->harga ?? 0);
        }
        return $total;
    }
}