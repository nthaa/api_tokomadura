<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'product_id' => $this->product_id,
            'nama_produk' => $this->product->nama_produk ?? 'Produk tidak ditemukan',
            'jumlah' => $this->jumlah,
            'harga_jual_trx' => $this->harga_jual_trx,
            'subtotal' => $this->jumlah * $this->harga_jual_trx,
        ];
    }
}
