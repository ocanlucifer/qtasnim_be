<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TransaksiDetailRequest extends FormRequest
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
            'transaksi_id'       => [
                'required',
                'integer',
                'exists:transaksis,id'
            ],
            'barang_id'       => [
                'required',
                'integer',
                'exists:barangs,id'
            ],
            'qty_jual'              => 'required|numeric|min:0',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'validator'   => $validator->errors()
        ], 422));
    }
}
