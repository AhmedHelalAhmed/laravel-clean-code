<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required',

            'body' => 'required',
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

    /*
    to resolve te problem user_id does not exists
    in $request->validated()
    merge it as you inject it in the middleware
     */
    public function validated()
    {
        if ($this->user_id) {
            return array_merge($this->validator->validated(), [
                'user_id' => $this->user_id,
            ]);
        }

        return parent::validated();
    }

}
