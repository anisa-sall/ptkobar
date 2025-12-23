<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'po';
    protected $primaryKey = 'nopo';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nopo',
        'idcustomer',
        'tglpo',
        'deliveryschedule',
        'idpetugas',
        'status_po'
    ];

    protected $dates = ['tglpo', 'deliveryschedule'];

    public $timestamps = false;

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'idcustomer', 'idcustomer');
    }

    // Relasi ke Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'idpetugas', 'idpetugas');
    }

    

    // Accessor untuk format tanggal
    public function getTglpoFormattedAttribute()
    {
        if (empty($this->tglpo) || $this->tglpo == '0000-00-00') return '';
        return date('d/m/Y', strtotime($this->tglpo));
    }

    // Accessor untuk format delivery schedule
    public function getDeliveryscheduleFormattedAttribute()
    {
        if (empty($this->deliveryschedule) || $this->deliveryschedule == '0000-00-00') return '';
        
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        $timestamp = strtotime($this->deliveryschedule);
        $tahun = date('Y', $timestamp);
        $bulan_num = date('n', $timestamp);
        
        return $bulan[$bulan_num] . ' ' . $tahun;
    }

    // Method untuk menghitung subtotal
    public function getSubtotalAttribute()
    {
        $subtotal = 0;
        foreach ($this->detailPo as $detail) {
            if ($detail->part) {
                $subtotal += $detail->quantity * $detail->part->harga;
            }
        }
        return $subtotal;
    }

    // Method untuk menghitung PPN
    public function getPpnAttribute()
    {
        return $this->subtotal * 0.12;
    }

    // Method untuk menghitung total
    public function getTotalAttribute()
    {
        return $this->subtotal + $this->ppn;
    }

    // Method untuk mendapatkan harga tertinggi dari detail
    public function getHargaTertinggiAttribute()
    {
        $harga = 0;
        foreach ($this->detailPo as $detail) {
            if ($detail->part && $detail->part->harga > $harga) {
                $harga = $detail->part->harga;
            }
        }
        return $harga;
    }

    // Method untuk cek status PO
    public function checkStatus()
    {
        $total_detail = $this->detailPo->count();
        
        if ($total_detail == 0) {
            return 'OPEN';
        }
        
        // Hitung total yang sudah dikirim via surat jalan
        $total_closed = 0;
        $total_open = 0;
        
        foreach ($this->detailPo as $detail) {
            $total_dikirim = 0;
            
            // Hitung quantity yang sudah dikirim melalui surat jalan
            foreach ($this->suratJalan as $sj) {
                foreach ($sj->detailSuratJalan as $dsj) {
                    if ($dsj->nopart == $detail->nopart) {
                        $total_dikirim += $dsj->quantity;
                    }
                }
            }
            
            if ($total_dikirim == 0) {
                $total_open++;
            } elseif ($total_dikirim == $detail->quantity) {
                $total_closed++;
            }
        }
        
        if ($total_closed == $total_detail) {
            return 'CLOSED';
        } elseif ($total_open == $total_detail) {
            return 'OPEN';
        } else {
            return 'PARTIAL';
        }
    }

    // Scope untuk filter
    public function scopeFilterByCustomer($query, $customerId)
    {
        return $query->where('idcustomer', $customerId);
    }

    public function scopeFilterByDate($query, $startDate, $endDate)
    {
        return $query->whereBetween('tglpo', [$startDate, $endDate]);
    }

    public function scopeFilterByStatus($query, $status)
    {
        // Implementasi filter by status jika diperlukan
        return $query;
    }

    
    
    // Tambahkan ini untuk relasi ke detailpo
    public function detailPurchaseOrders()
    {
        return $this->hasMany(DetailPurchaseOrder::class, 'nopo', 'nopo');
    }
    
    // Atau jika ingin tetap menggunakan nama 'details'
    public function details()
    {
        return $this->hasMany(DetailPurchaseOrder::class, 'nopo', 'nopo');
    }
    
   public function detailPo()
{
    return $this->hasMany(
        \App\Models\DetailPurchaseOrder::class,
        'nopo',   // foreign key di tabel detailpo
        'nopo'    // primary key di tabel po
    );
}

    
}