<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'nama' => $this->nama,
            'toko' => $this->toko,
            'alamat' => $this->alamat,
            'nomor_telp' => $this->no_telp,
        ];
    }
}
