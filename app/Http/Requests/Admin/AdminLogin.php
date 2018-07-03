<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class AdminLogin extends FormRequest
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
            'username'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',

        ];
    }
    public function messages(){

        return [
            'username.required'=>'用户名必须',
            'password.required'=>'密码必须',
            'captcha.required'=>'验证码必须',
            'captcha.captcha'=>'请输入正确的验证码',
        ];

    }
}
