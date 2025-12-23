<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table = 'part';
    protected $primaryKey = 'nopart';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false; // ⬅️ WAJIB

    protected $fillable = [
        'nopart',
        'namapart',
        'harga'
    ];
}