<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogEditFormRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'slug' => 'required|unique:kk_blogs,slug,'.$this->id,
            //'image' => 'image|max:500|mimes:jpeg,jpg,bmp,png,PNG'
        ];

        foreach($this->request->get('title') as $key => $val)
        {
            $rules['title.'.$key] = 'required';
        }

        foreach($this->request->get('description') as $key => $val)
        {
            $rules['description.'.$key] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $languages = LaravelLocalization::getSupportedLocales();
        $messages = [];
        foreach($this->request->get('title') as $key => $val)
        {
            $messages['title.'.$key.'.required'] = 'The field labeled "Title ('.$languages[$key]['name'].')" is required.';
        }

        foreach($this->request->get('description') as $key => $val)
        {
            $messages['description.'.$key.'.required'] = 'The field labeled "Description ('.$languages[$key]['name'].')" is required.';
        }
        return $messages;
    }
}
