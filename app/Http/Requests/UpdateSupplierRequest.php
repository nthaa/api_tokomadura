<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'nama'     => 'required|max:100',
            'toko'     => 'required|unique:suppliers,toko,' . $this->supplier?->id,
            'no_telp'  => 'required|max:15|unique:suppliers,no_telp,' . $this->supplier?->id,
            'alamat'   => 'required|string'
        ];
    }
}
