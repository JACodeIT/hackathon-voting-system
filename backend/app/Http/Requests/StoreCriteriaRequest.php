<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCriteriaRequest extends FormRequest
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
            'min_rating' => 'required|numeric',
            'max_rating' => 'required|numeric',
            'percentage_value' => 'required|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'min_rating.required'           => 'Minimum Rating is required.',
            'max_rating.required'           => 'Maxmimum Rating is required.',
            'percentage_value.required'     => 'Percentage Value is required.',

            'min_rating.numeric'            => 'Minimum Rating is invalid.',
            'max_rating.numeric'            => 'Maximum Rating is invalid.',
            'percentage_value.integer'      => 'Percentage Value is invalid.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

}
