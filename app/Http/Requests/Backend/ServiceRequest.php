<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'service_title'=>'required',
            'qty'=>'required',
            'price_service'=>'required'
        ];


    }

    public function messages()
    {
        return [
            'service_title.required' => 'Service Title is required',
            'qty.required' => 'Qty is required',
            'price_service.required' => 'Price Service is required',
        ];
    }
}