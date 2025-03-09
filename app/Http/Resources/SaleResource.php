<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    // public function toArray(Request $request): array
    public function toArray($request)
    {

        return[
            'id' => $this->id,
            'diterima' => $this->diterima,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'sale_details' => SaleDetailResource::collection($this->saleDetails),
        ];
    }

}

