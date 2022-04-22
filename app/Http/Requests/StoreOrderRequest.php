<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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

            'details' => 'required',
            'client' => 'required',

        ];
    }

    public function messages()
    {
        return [

            'details.required' => 'Details Field cant be Empty',
            'client.required' => 'Client field cant be Empty',
        ];
    }


}
