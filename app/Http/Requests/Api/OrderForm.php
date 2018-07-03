<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OrderForm extends CommonForm
{

    public function rules()
    {
        return [
            'address_id' => 'required',
            'order_amount' => 'required',
            'goods_price' => 'required',
            'product'=>'required',
            'product.*.price' => 'required',
            'product.*.goods_id' => 'required',
            'product.*.amount' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'address_id.required' => '地址不能为空',
            'order_amount.required' => '订单数量不能为空',
            'goods_price.required' => '商品总价不能为空',
            'product.required' => '产品列表不能为空',
            'product.*.price.required' => '商品价格不能为空',
            'product.*.amount.required' => '商品数量不能为空',
            'product.*.goods_id.required' => '产品不能为空',
           ];
    }
}
