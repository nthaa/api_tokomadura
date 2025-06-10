<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanToko extends Model
{
    /** @use HasFactory<\Database\Factories\PengaturanTokoFactory> */
    use HasFactory;
    protected $fillable = [
        'nama_toko',
        'alamat',
        'no_telp',
    ];
}
