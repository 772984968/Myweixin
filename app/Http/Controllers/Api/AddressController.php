<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressForm;

class AddressController extends AuthController
{
    protected  $model;
    public function __construct(Address $address)
    {
        parent::__construct();
        $this->model=$address;
    }

    //地址列表
    public function index(){
        $user=auth('api')->user();
        $rs=Address::where('user_id',$user->id)->get();
        return  $this->arrayResponse($rs);

    }
    //添加地址
    public function store(AddressForm $request){
        $model=$this->model;
        $rs=$request->validated();
        $user_id=auth('api')->id();
        $model->fill($rs);

        $model->user_id=$user_id;
        if ($rs['default']==1){
            Address::where('user_id',$user_id)->update(['default'=>0]);
        }
          if ($model->save()){
            return $this->arrayResponse();
        }
        return $this->response()->errorInternal('系统错误');
    }
    //地址详情
    public function show($id){
        return $this->arrayResponse(Address::findOrFail($id));
    }
    //修改地址
    public function update(AddressForm $request,$id){

        $model=Address::findOrFail($id);
        $this->authorize('delete',$model);
        $rs=$request->validated();
        $model->fill($rs);
        $user_id=auth('api')->id();
        if ($rs['default']==1){
            Address::where('user_id',$user_id)->update(['default'=>0]);
        }
        if ($model->update()){
            return $this->arrayResponse();
        }
        return $this->response()->errorInternal('系统错误');



    }
    //删除地址
    public function destroy($id){
        $address=Address::findOrFail($id);
        $this->authorize('delete',$address);
        if (Address::destroy($id)){
        return $this->arrayResponse();
        };
        return $this->response()->errorInternal('删除失败');

    }
}
