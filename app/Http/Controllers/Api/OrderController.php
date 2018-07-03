<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\OrderForm;
use App\Models\Model;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends AuthController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Order();

    }
    //订单列表
    public function index(Request $request){
        $model=Order::with('orderStatus')->where('user_id',auth('api')->id());
        if (!empty($request->input('order_status_id'))){
            $model->where('order_status_id',$request->input('order_status_id'));
        }
        $status=$model->paginate();
        return  $this->arrayResponse($status);
    }
    //添加订单
    public function store(OrderForm $request){
        $faker=app(\Faker\Generator::class);
        $data=$request->validated();
        $model=$this->model;
        $model->goods_sn=$faker->uuid;
        $model->order_status_id=1;
        $model->user_id=auth('api')->id();
        $model->fill($data);
        $orderProduct=$data['product'];
        DB::beginTransaction();
        try{
            $model->save();
            foreach ($orderProduct as $key=> $vo){
                $orderProduct[$key]['order_id']=$model->id;
            }
            OrderProduct::insert($orderProduct);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return $this->response()->errorInternal($exception);
        }
        return $this->arrayResponse();
    }

    //取消订单
    public function destroy($id){
        $order=Order::findOrFail($id);
        $this->authorize('delete',$order);
        if (Order::destroy($id)){
            return $this->arrayResponse();
        }
        return $this->response()->errorInternal('删除失败');

    }
}
