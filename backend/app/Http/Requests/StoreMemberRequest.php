<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMemberRequest extends FormRequest
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
            'first_name'             => 'required|string',
            'middle_name'            => 'nullable|string',
            'last_name'              => 'required|string',
            'name_extension'         => 'nullable|string',
            'github_account'         => 'required|string',
            'discord_username'       => 'required|string',
            'user_id'                => 'required|integer',
            'be_rating'              => 'required|integer|between:1,10',
            'fe_rating'              => 'required|integer|between:1,10',
            'ui_ux_rating'           => 'required|integer|between:1,10'
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
            'first_name.required'             => 'First name is required.',
            'last_name.required'              => 'Last name is required.',
            'github_account.required'         => 'Github account is required.',
            'discord_username.required'       => 'Discord username is required.',
            'user_id.required'                => 'User id is required.',
            'be_rating.required'              => 'BE rating is required.',
            'fe_rating.required'              => 'FE rating is required.',
            'ui_ux_rating.required'           => 'UI/UX rating is required.',

            'be_rating.between'              => 'BE rating must be between 1 and 10.',
            'fe_rating.between'              => 'FE rating must be between 1 and 10.',
            'ui_ux_rating.between'           => 'UI/UX rating must be between 1 and 10.',
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

     /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'first_name' => 'trim|capitalize|escape',
            'last_name' => 'trim|capitalize|escape'
        ];
    }
}
