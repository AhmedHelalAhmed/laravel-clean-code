<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{

    public function authorize()
    {
        return true;
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
