<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'total_harga' => 'required|numeric|min:0',
            'diterima' => 'required|numeric|min:0',
            'kembali' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
            'jam' => 'required|string',

            // Jika update juga item sale_details
            'items' => 'sometimes|array|min:1',
            'items.*.product_id' => 'required_with:items|integer|exists:products,id',
            'items.*.jumlah' => 'required_with:items|integer|min:1',
            'items.*.harga_jual_trx' => 'required_with:items|integer|min:0',

        ];
    }
}
