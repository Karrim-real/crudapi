<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
           'client' => 'required',
           'details' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'client.required' => 'Client field must cant be empty',
            'details.required' => 'Details Field cant be empty'
        ];
    }
}
