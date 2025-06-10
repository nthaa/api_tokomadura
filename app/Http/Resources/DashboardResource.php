<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
     public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'total_pendapatan' => (int) $this->total_pendapatan,
            'total_pengeluaran' => (int) $this->total_pengeluaran,
            'total_suppliers' => (int) $this->total_suppliers,
            'total_products' => (int) $this->total_products,

        ];
    }
}
