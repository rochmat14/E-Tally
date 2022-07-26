<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegistersFormRequest extends FormRequest
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
            'email'=>'email|unique:users|required|string|max:255',
            'password'=>'required|min:8',
            'confirm_password'=>'required_with:password|same:password|min:6',
            // 'univ_name'=>'required',
        ];
    }
}
