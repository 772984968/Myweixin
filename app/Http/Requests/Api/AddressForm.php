<?php

namespace App\Http\Requests\Api;
class addressForm extends CommonForm
{


    public function rules()
    {
        return [
            'name' => 'required',
            'phone'=>'regex:/^1[34578][0-9]{9}$/',
            'province' => 'required',
            'city' => 'required',
            'area' => 'required',
            'detail_address' => 'required',
            'default' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '收货人名字不能为空',
            'phone.regex' => '手机号码格式不正确',
            'province.required' => '省区不能为空',
            'city.required' => '城市不能为空',
            'area.required' => '区域不能为空',
            'detail_address.required' => '详细收货地址不能为空',
            'default.required' => '默认值不能为空',
        ];
    }
}
