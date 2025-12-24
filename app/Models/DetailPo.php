<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailPo extends Model
{
    use HasFactory;

    protected $table = 'detailpo';
    
    // TAMBAHKAN PRIMARY KEY COMPOSITE
    protected $primaryKey = ['nopo', 'nopart'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nopo',
        'nopart',
        'quantity',
        'unit',
        'total'
    ];

    /**
     * Set the keys for a save update query.
     * Ini penting untuk composite key
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    /**
     * Relationship dengan PO
     */
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'nopo', 'nopo');
    }

    /**
     * Relationship dengan part
     */
    public function part()
    {
        return $this->belongsTo(Part::class, 'nopart', 'nopart');
    }

    /**
     * Relationship dengan detail surat jalan melalui PO
     */
    public function detailSuratJalans()
    {
        return $this->hasMany(DetailSuratJalan::class, 'nopart', 'nopart');
    }

    /**
     * Hitung total yang sudah dikirim untuk part ini di PO tertentu
     * TAPI TAMBAHKAN ACCESSOR BARU AGAR TIDAK BENTROK
     */
    public function getCalculatedTotalDikirimAttribute()
    {
        return DB::table('detailsuratjalan')
            ->join('suratjalan', 'detailsuratjalan.nosuratjalan', '=', 'suratjalan.nosuratjalan')
            ->where('suratjalan.nopo', $this->nopo)
            ->where('detailsuratjalan.nopart', $this->nopart)
            ->sum('detailsuratjalan.quantity');
    }

    /**
     * Hitung sisa PO untuk part ini
     * TAMBAHKAN ACCESSOR BARU
     */
    public function getCalculatedSisaPoAttribute()
    {
        return $this->quantity - $this->calculated_total_dikirim;
    }

    /**
     * Get status untuk part ini
     * TAMBAHKAN ACCESSOR BARU
     */
    public function getCalculatedStatusAttribute()
    {
        $total_dikirim = $this->calculated_total_dikirim;
        
        if ($total_dikirim == 0) {
            return 'OPEN';
        } elseif ($this->calculated_sisa_po > 0) {
            return 'PARTIAL';
        } else {
            return 'CLOSED';
        }
    }

    /**
     * Get class untuk status
     * TAMBAHKAN ACCESSOR BARU
     */
    public function getCalculatedStatusClassAttribute()
    {
        $status = $this->calculated_status;
        
        switch ($status) {
            case 'OPEN':
                return 'btn-rounded-primary';
            case 'PARTIAL':
                return 'btn-rounded-warning';
            case 'CLOSED':
                return 'btn-rounded-success';
            default:
                return 'btn-rounded-secondary';
        }
    }
}