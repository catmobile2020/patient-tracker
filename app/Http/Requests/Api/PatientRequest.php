<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'name'=>'required',
            'city_id'=>'required|exists:cities,id',
            'country_id'=>'required|exists:countries,id',
            'hospital_id'=>'required|exists:hospitals,id',
            'doctor_id'=>'required|exists:doctors,id',
        ];
    }
}
