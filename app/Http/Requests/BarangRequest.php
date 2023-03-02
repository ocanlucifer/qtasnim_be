<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BarangRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'kode_barang'           => 'required|string|max:6|unique:barangs,kode_barang,' . $this->route('barang'),
            'nama_barang'           => 'required|string|max:6|unique:barangs,nama_barang,' . $this->route('barang'),
            'stock'                 => 'required|numeric|min:0',
            'satuan'                => 'required|string|max:50',
            'jenis_barang_id'       => [
                'required',
                'integer',
                'exists:jenis_barangs,id'
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'validator'   => $validator->errors()
        ], 422));
    }
}
