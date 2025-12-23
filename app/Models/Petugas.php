<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $table = 'petugas';
    protected $primaryKey = 'idpetugas';
    public $timestamps = false;
    
    protected $fillable = [
        'namapetugas',
        'email',
        'departemen',
        'password',
    ];
    
    protected $hidden = [
        'password',
    ];
}