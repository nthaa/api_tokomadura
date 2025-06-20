<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSale extends Model
{
    /** @use HasFactory<\Database\Factories\TempSaleFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'product_id','nama', 'jumlah', 'harga', 'total'];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
