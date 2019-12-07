<?php

namespace App\Http\Requests;

class StorePostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',

            'body' => 'required',

            'image' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'custom message for required',
        ];
    }

    // email address exists to user override attribute name
    public function attribute()
    {
        return [
            'body' => 'post content',
        ];
    }

}
