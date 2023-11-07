<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEventsRequest extends FormRequest
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
            'organizer_id'              => 'required|integer',
            'topic'                     => 'required|string',
            'description'               => 'required|string',
            'start_date'                => 'required|date_format:Y-m-d|before:tomorrow',
            'end_date'                  => 'required|date_format:Y-m-d|after:today',
            'announcement_date'         => 'required|date_format:Y-m-d|after:today',
            'status'                    => 'required|string',
            'venue'                     => 'required|string',
            'address_line_1'            => 'nullable|string',
            'address_line_2'            => 'nullable|string',
            'brgy_address'              => 'nullable|string',
            'complete_address'          => 'nullable|string',
            'banner_url'                => 'sometimes|url',
            'isGroup'                   => 'required|boolean',
            'number_of_members'         => 'required|integer',
            'member_can_vote'           => 'required|boolean',
            'public_can_vote'           => 'required|boolean',
            'member_numbers_of_vote'    => 'required|integer',
            'public_numbers_of_vote'    => 'required|integer',
            'judge_vote_percentage'     => 'required|integer',
            'member_vote_percentage'    => 'required|integer',
            'public_vote_percentage'    => 'required|integer',
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
            'organizer_id.required'             => 'Organizer is required.',
            'topic.required'                    => 'Topic is required.',
            'description.required'              => 'Description is required.',
            'start_date.required'               => 'Start date is required.',
            'end_date.rqeuired'                 => 'End date is required.',
            'announcement_date.required'        => 'Announcement date is required.',
            'status.required'                   => 'Status is required.',
            'banner_url.url'                    => 'Banner URL must be a valid URL.',
            'isGroup.required'                  => 'Group is required.',
            'venue.required'                    => 'Venue is required.',
            'number_of_members.required'        => 'Number of members is required.',
            'member_can_vote.required'          => 'Member can vote is required.',
            'public_can_vote.required'          => 'Public can vote is required.',
            'member_numbers_of_vote.required'   => 'Maximum number of votes per member is required.',
            'public_numbers_of_vote.required'   => 'Maximum number of votes per public is required.',
            'judge_vote_percentage.required'    => 'Judge vote percentage is required.',
            'member_vote_percentage.required'   => 'Member vote percentage is required.',
            'public_vote_percentage.required'   => 'Public vote percentage is required.',

            'start_date.date_format'            => 'Start date must be in YYYY-MM-DD format.',
            'end_date.date_format'              => 'End date must be in YYYY-MM-DD format.',
            'announcement_date.date_format'     => 'Announcement date must be in YYYY-MM-DD format.',

            'start_date.before'                 => 'Start date must be before end date.',
            'end_date.after'                    => 'End date must be after start date.',
            'announcement_date.after'           => 'Announcement date must be after start date.',
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
            'topic' => 'trim|capitalize|escape',
            'description' => 'trim|capitalize|escape'
        ];
    }
}
