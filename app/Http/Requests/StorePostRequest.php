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
            'address' => Rule::exists('address', 'id')->where(function (Builder $builder) {
                return $builder->where('user_id', $this->user()->id);
            }),
            'body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'custom message for required',
            'address.exists' => '...',
        ];
    }

    // email address exists to user override attribute name
    public function attribute()
    {
        return [
            'email' => 'email address',

        ];
    }

}
