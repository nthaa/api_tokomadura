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
        
        return[
            'id' => $this->id,
            'supplier_id' => $this->supplier_id,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'purchase_details' => PurchaseDetailResource::collection($this->purchaseDetails),
        ];
    }
}
