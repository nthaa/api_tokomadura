<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'id' => (int) $this->id,
            'nama_produk' => $this->nama_produk,
            'harga_beli' => (int) $this->harga_beli,
            'harga_jual' => (int) $this->harga_jual,
            'stok' => (int) $this->stok,
            'satuan' => $this->satuan,
            'barcode' => $this->barcode,
        ];
    }
}
