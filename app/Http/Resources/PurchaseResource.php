<?php

namespace App\Http\Resources;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    // public function toArray(Request $request): array
    public function toArray($request)
{
    return [
        'id' => $this->id,
        'supplier_id' => $this->supplier_id,
        'supplier_nama' => $this->supplier->nama ?? '-',
        'tanggal' => $this->tanggal,
        'jam' => $this->jam,
        'items' => $this->purchaseDetails->map(function ($item) {
            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'nama_produk' => $item->product->nama_produk ?? '-',
                'harga_beli' => $item->harga_beli,
                'jumlah' => $item->jumlah,
                'total' => $item->total,
            ];
        }),
    ];
}

}
