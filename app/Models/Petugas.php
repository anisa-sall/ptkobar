<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas'; // pastikan sesuai nama tabel
    protected $primaryKey = 'idpetugas'; // kalau bukan id
}
