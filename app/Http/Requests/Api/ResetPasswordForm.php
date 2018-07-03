<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordForm extends CommentForm
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'old_password.required' => '旧密码不能为空',
            'password.required' => '新密码不能为空',
            'password.confirmed' => '两次密码不一致',
            'password_confirmation.required'=>'确认密码不能为空',
          ];
    }
}
