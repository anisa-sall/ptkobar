<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'idcustomer';
    public $timestamps = false;
    
    protected $fillable = [
        'namacustomer',
        'alamat',
    ];
}