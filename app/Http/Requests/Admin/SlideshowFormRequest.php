<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SlideshowFormRequest extends FormRequest
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
            // 'title' => 'required',
            // 'button_text' => 'required',
            'url' => 'required',
            'sort_order' => 'required|numeric',
            'image' => 'image|max:5000|mimes:jpeg,jpg,bmp,png,PNG'
        ];

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

        foreach($this->request->get('button_text') as $key => $val)
        {
            $messages['button_text.'.$key.'.required'] = 'The field labeled "Button Text ('.$languages[$key]['name'].')" is required.';
        }
        return $messages;
    }
}
