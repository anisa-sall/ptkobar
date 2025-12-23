<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'detailpo';

    protected $fillable = [
        'nopo',
        'namapart',
        'harga',
        'quantity',
        'total',
        'unit',
        'status'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'total' => 'decimal:2',
        'quantity' => 'integer'
    ];

    /**
     * Relationship dengan purchase order
     */
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

  
    
    
    
    // Relasi ke Part
    public function part()
    {
        return $this->belongsTo(Part::class, 'nopart', 'nopart');
    }
    
    public function index($nopo)
    {
        try {
            // Ambil data PO beserta detail items-nya
            $po = PurchaseOrder::with(['details', 'details.part']) 
                ->where('nopo', $nopo)
                ->firstOrFail();
                
            // Ambil data detail PO untuk tabel bawah (dengan pagination)
            $recordsPerPage = request('records_per_page', 10);
            
            $detailpo = DetailPurchaseOrder::with(['part', 'suratJalanDetails'])
                ->where('nopo', $nopo)
                ->paginate($recordsPerPage);

            return view('detailpo.index', compact('po', 'detailpo', 'nopo', 'recordsPerPage'));
                
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('po.index')
                ->with('error', 'Purchase Order tidak ditemukan')
                ->with('error_type', 'global');
        }
    }
    
}