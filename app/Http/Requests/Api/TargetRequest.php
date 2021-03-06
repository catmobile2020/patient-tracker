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
            'product'=>'required|in:opsumit,uptravi,tracleer',
            'number'=>'required|integer|min:0',
            'year'=>'required|integer|digits:4',
            'month'=>'required|integer|min:1|max:12',
        ];
    }
}
