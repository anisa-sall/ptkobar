<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSuratJalan extends Model
{
    use HasFactory;

    protected $table = 'detailsuratjalan';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nosuratjalan',
        'nopart',
        'quantity'
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