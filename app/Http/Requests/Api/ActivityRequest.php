<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'=>'required',
            'subtype'=>'required',
            'date'=>'required',
            'city_id'=>'required|exists:cities,id',
            'speciality'=>'required|array|min:1',
            'speciality.*'=>'required',
            'no_attendees'=>'required|array|min:1',
            'no_attendees.*'=>'required',
            'speakers'=>'required|array|min:1',
            'speakers.*'=>'array',
            'speakers.*.type'=>'required',
            'speakers.*.name'=>'required',
            'speakers.*.speaker_type'=>'required',
            'speakers.*.speciality'=>'required',
        ];
    }
}
