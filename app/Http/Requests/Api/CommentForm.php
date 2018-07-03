<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CommentForm extends CommonForm
{

    public function rules()
    {
        return [
            'content' => 'required|digits_between:8,100',
            'order_id'=>'required',
            'hidden' => 'required',
            'goods_id' => 'required',
            'goods_rank' => 'required',
          ];
    }
    public function messages()
    {
        return [
            'content.required' => '内容不能为空',
            'content.digits_between' => '评价内容需8-100个字符之间',
            'order.required' => '订单不能为空',
            'hidden.required' => '是否匿名选项不能为空',
            'goods_id.required' => '商品ID不能为空',
            'goods_rank.required' => '评价分数不能为空',
        ];
    }
}
