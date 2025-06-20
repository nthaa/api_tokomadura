<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'nama_produk' => 'required|unique:products,nama_produk,' . $this->product?->id,
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0|gt:harga_beli',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|in:pcs,karton',
            'barcode' => 'nullable|string|max:50|unique:products,barcode,' . $this->product?->id,
        ];
    }
}
