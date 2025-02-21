<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = ['nama_produk', 'harga_beli', 'harga_jual', 'stok', 'satuan', 'barcode'];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
