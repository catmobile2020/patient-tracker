<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
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
        $rules = [
            'name'=>'required',
            'type'=>'required',
            'rheuma'=>'required|between:0,100',
            'crdio'=>'required|min:0|max:100',
            'pulmo'=>'required|between:0,100',
            'city_id'=>'required|exists:cities,id',
            'country_id'=>'required|exists:countries,id',
        ];
        if ($this->request->get('type') == 'coe')
        {
            $rules['pah_expert'] ='required|between:0,1';
            $rules['rhc'] ='required|between:0,1';
            $rules['rwe'] ='required|between:0,1';
        }else
        {
            $rules['echo'] ='required|between:0,1';
            $rules['pah_attentive'] ='required|between:0,1';
        }
        return $rules;
    }
}
