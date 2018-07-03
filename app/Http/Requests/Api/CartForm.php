<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CartForm extends CommonForm
{

    public function rules()
    {
        return [
            'goods_id' => 'required',
            'goods_amount'=>'required',
            'goods_price' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'goods_id.required' => '商品ID不能为空',
            'goods_price.required' => '商品单价不能为空',
            'goods_amount.required' => '商品数量不能为空',

        ];
    }
}
