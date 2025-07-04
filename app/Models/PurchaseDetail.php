<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseDetailFactory> */
    use HasFactory;
    protected $fillable = ['purchase_id','product_id','harga_beli','jumlah', 'total',];

    // Relasi ke Purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
