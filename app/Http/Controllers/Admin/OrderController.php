<?php

namespace App\Http\Controllers\Admin;

use App\Models\Goods;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends TemplateController
{
    protected $model;
    public $config = [
        "title" => '订单管理',
        'index' => 'order.index',//首页
      //  'create' => 'order.create',//创建
        'store' => 'order.store',//创建保存
        'show' => 'order.show',//查看
        'edit' => 'order.edit',//编辑
        'update' => 'order.update',//编辑保存
     //   'delete' => 'order.destroy',//删除
    ];

    public function __construct(Order $order)
    {
        $this->model = $order;

    }

    public function show($id)
    {
        $model=$this->model::with('user','orderStatus')->find($id);

        $goods=OrderProduct::where('order_id',$model->id)->with('goods')->get();
        $config = $this->config;//获取配置
        return view('admin.'.''.$this->config['show'],compact('model','config','goods'));
    }
    //更改订单状态
    public function update(Request $request, $id)
    {

        $model = Order::find($id);
        $model->order_status_id=$request->input('order_status_id');
        if ($model->save()) {
            return response()->json(['code' => 200, 'msg' => '修改成功']);
        } else {
            return response()->json(['code' => 400, 'msg' => '修改失败']);
        }


    }
    public function index(Request $request)
    {
        if ($request->ajax()){
            return response()->json($this->getData($request));
        }


        $data['title'] = $this->getTitle();// 标题
        $data['config'] = $this->config;//获取配置
        return view('admin.order.index', compact('data'));
    }
    //展示编辑页
    public function edit($id){
        $model=$this->model::find($id);
        $config = $this->config;//获取配置
        //获取类型
        $status=OrderStatus::all();
        return view('admin.'.''.$this->config['edit'],compact('model','config','status'));
    }
    //获取数据
    public function getData($request){
        $model= $this->model;
        $limit=$request->limit??'10';
        $count=$model->count();
        $paginate=$model->with('user','orderStatus')->paginate($limit);
        $data=$paginate->toArray();
        return  $data=['code'=>0,'msg'=>'','count'=>$count,'data'=>$data['data']];
    }


    //表格标题
    function getTitle()
    {
        return [[
            ['type' => 'checkbox'],
            ['field' => 'id', 'title' => 'ID', 'sort' => 'true'],
            ['field' => 'goods_sn', 'title' => '订单号'],
            ['field' => 'user_id', 'title' => '用户名','templet'=>'#userTpl'],
            ['field' => 'order_status_id', 'title' => '订单状态','templet'=>'#statusTpl'],
            ['field' => 'goods_price', 'title' => '商品总额', 'sort' => 'true'],
            ['field' => 'pay_price', 'title' => '支付金额', 'sort' => 'true'],
            ['field' => 'created_at', 'title' => '创建时间','templet'=>'#checkSaleTpl'],
            ['field' => 'right', 'title' => '数据操作', 'align' => 'center', 'toolbar' => '#barDemo', 'width' => 300]
        ]];

    }
}
