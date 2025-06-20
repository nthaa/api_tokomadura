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

    public function toArray($request)
    {
        return[
            'id' => (int) $this->id,
            'nama' => $this->nama,
            'toko' => $this->toko,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
        ];
    }
}
