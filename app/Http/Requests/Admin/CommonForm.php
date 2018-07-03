<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

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
        throw new ValidationException($validator,response(
            $this->formatErrors($validator)));
    }
    protected function formatErrors(Validator $validator)
    {
       $message = $validator->errors()->all();
        $result = [
            'msg' => $message[0],
            'code' => 400
        ];
        return $result;
    }
 }
