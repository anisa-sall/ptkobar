<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'departemen',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $searchTerm)
    {
        if (!$searchTerm) {
            return $query;
        }
        
        return $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', "%{$searchTerm}%")
              ->orWhere('email', 'like', "%{$searchTerm}%")
              ->orWhere('departemen', 'like', "%{$searchTerm}%");
        });
    }

    /**
     * Get menu access configuration
     */
    public static function getMenuAccessConfig()
    {
        return [
            'customer' => ['Marketing', 'Manager'],
            'part' => ['Marketing', 'Manager'],
            'petugas' => ['Manager'],
            'kendaraan' => ['PPIC', 'Manager'],
            'po' => ['Marketing', 'PPIC', 'Finance', 'Manager'],
            'suratjalan' => ['PPIC', 'Finance', 'Manager']
        ];
    }

    /**
     * Validasi departemen yang diperbolehkan
     */
    public static function getAllowedDepartemen()
    {
        return ['Marketing', 'PPIC', 'Finance', 'Manager'];
    }
}