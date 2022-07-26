<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PageEditFormRequest extends FormRequest
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
            'name' => 'required',
            'slug' => 'required|unique:kk_pages,slug,'.$this->id
        ];

        foreach($this->request->get('name') as $key => $val)
        {
            $rules['name.'.$key] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $languages = LaravelLocalization::getSupportedLocales();
        $messages = [];
        foreach($this->request->get('name') as $key => $val)
        {
            $messages['title.'.$key.'.required'] = 'The field labeled "Title ('.$languages[$key]['name'].')" is required.';
        }
        return $messages;
    }
}
