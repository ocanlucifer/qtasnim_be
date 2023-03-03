<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ReportTransaksiRequest extends FormRequest
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
            'c_search'      => [
                'string',
                'max:255',
                "regex:/^([^\"!'\*\\\]*)$/"
            ],
            'search'        => [
                'string',
                'max:255',
                "regex:/^([^\"!'\*\\\]*)$/"
            ],
            'c_sort'        => [
                'string',
                'max:255',
                "regex:/^([^\"!'\*\\\]*)$/"
            ],
            'sort'          => [
                'string',
                'max:255',
                "regex:/^([^\"!'\*\\\]*)$/"
            ],
            'tgl_awal'      => 'date',
            'tgl_akhir'      => 'date',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'validator'   => $validator->errors()
        ], 422));
    }
}
