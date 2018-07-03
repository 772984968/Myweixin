<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CommonForm extends FormRequest
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
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationHttpException($validator->errors());
    }
}
