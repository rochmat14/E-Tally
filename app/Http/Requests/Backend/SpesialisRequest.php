<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SpesialisRequest extends FormRequest
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
            'nama_spesialis'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_spesialis.required' => 'Jenis Spesialis is required',
        ];
    }
}
