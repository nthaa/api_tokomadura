<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;
    protected $fillable = ['user_id','total_harga','diterima', 'kembali', 'tanggal', 'jam'];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
