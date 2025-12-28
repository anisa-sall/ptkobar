<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSuratJalan extends Model
{
    use HasFactory;

    protected $table = 'detailsuratjalan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nosuratjalan',
        'nopart',
        'quantity',
        'keterangan'
    ];

    /**
     * Relationship dengan surat jalan
     */
    public function suratJalan()
    {
        return $this->belongsTo(SuratJalan::class, 'nosuratjalan', 'nosuratjalan');
    }

    /**
     * Relationship dengan part
     */
    public function part()
    {
        return $this->belongsTo(Part::class, 'nopart', 'nopart');
    }
}