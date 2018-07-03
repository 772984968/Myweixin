<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CartForm;
use App\Models\Cart;
class CartController extends AuthController
{

    //添加购物车
    public function store(CartForm $request){
        $data=$request->validated();
        $user_id=auth('api')->id();
        $cart=Cart::firstOrNew(['goods_id'=>$data['goods_id'],'user_id'=>$user_id]);
          if ($cart->id){
              //正数添加
              if ($data['goods_amount']>0){
                  $cart->increment('goods_amount',$data['goods_amount']);
                  //负数减少
              }elseif(($data['goods_amount']+$cart->goods_amount)>0){
                  $cart->increment('goods_amount',$data['goods_amount']);
                  //小于0删除
              }else{
                  $cart->delete();
                  return $this->arrayResponse();
              }
              if ($cart->update()){
                  return $this->arrayResponse();
              }
              return $this->response()->errorInternal('添加失败');

        }
        $cart->fill($data);
        $cart->user_id=$user_id;
        if ($data['goods_amount']>0&&$cart->save()){
            return $this->arrayResponse();
        }
        return $this->response()->errorInternal('添加失败');
    }

    //清空购物车
    public function destroy($id){
        if ($id) {
            if (Cart::where([['user_id', auth('api')->id()], ['goods_id' , $id]])->delete()) {
                return $this->arrayResponse();
            }
        }
        return $this->response()->errorInternal('系统错误，请重试');


    }
}
