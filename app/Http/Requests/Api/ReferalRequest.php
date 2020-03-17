<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ReferalRequest extends FormRequest
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
            'city_id'=>'required|exists:cities,id',
            'country_id'=>'required|exists:countries,id',
            'hospital_id'=>'required|exists:hospitals,id',
            'doctor_id'=>'required|exists:doctors,id',
            'to_hospital'=>'required|exists:hospitals,id',
            'to_doctor'=>'required|exists:doctors,id',
        ];
    }
}
