<?php
namespace App\Http\Requests\Admin;
class ProductForm extends CommonForm
{

    public function rules()
    {
        return [
            'goods_name'=>'required'
        ];
    }

    public function messages(){
        return [
            'goods_name.required'=>'商品名称不能为空',
        ];


    }
}
