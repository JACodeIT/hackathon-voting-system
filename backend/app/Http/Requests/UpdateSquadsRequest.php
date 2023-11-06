<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Http\Request;

class UpdateSquadsRequest extends FormRequest
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
        // var_dump($squad = $this->route('squad'));
        // exit();
        $squad = $this->route('squad');
        return [
            'leader_id' => 'required|integer',
            'name'      => 'sometimes|string|unique:squads,name,'.$squad
        ];
    }

    public function messages(): array
    {
        return [
            'leader_id.required'    => 'Organizer is required.',
            'name.required'         => 'Topic is required.',
            'name.unique'           => 'Squad name has already been taken.',
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
