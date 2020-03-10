<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TargetRequest extends FormRequest
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
            'hospital_id'=>'required|exists:hospitals,id',
            'number'=>'required|integer|min:0',
            'year'=>'required|integer',
            'month'=>'required|integer|min:1|max:12',
        ];
    }
}
