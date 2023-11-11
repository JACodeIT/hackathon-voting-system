<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMemberRequest extends FormRequest
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
            'first_name'             => 'sometimes|string',
            'middle_name'            => 'nullable|string',
            'last_name'              => 'sometimes|string',
            'name_extension'         => 'nullable|string',
            'github_account'         => 'sometimes|string',
            'discord_username'       => 'sometimes|string',
            'user_id'                => 'sometimes|integer',
            'be_rating'              => 'sometimes|integer|between:1,10',
            'fe_rating'              => 'sometimes|integer|between:1,10',
            'ui_ux_rating'           => 'sometimes|integer|between:1,10',
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

            'be_rating.integer'              => 'BE rating must be an integer.',
            'fe_rating.integer'              => 'FE rating must be an integer.',
            'ui_ux_rating.integer'           => 'UI/UX rating must be an integer.',

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
