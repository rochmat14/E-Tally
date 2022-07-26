<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name'=>'required',
            'bill_of_lading_id'=>'required',
            'product_satuan'=>'required',
            'product_category'=>'required',
            'total'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Product Name is required',
            'product_satuan.required' => 'Satuan is required',
            'product_category.required' => 'Product Category is required',
            'total'=>'total is required',
        ];
    }
}
