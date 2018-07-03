<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goods;
use Illuminate\Http\Request;

class ProductController extends TemplateController
{

    protected $model;
    public $config=[
        "title"=>'产品管理',
        'index'=>'product.index',//首页
        'create'=>'product.create',//创建
        'store'=>'product.store',//创建保存
        'show'=>'product.show',//查看
        'edit'=>'product.edit',//编辑
        'update'=>'product.update',//编辑保存
        'delete'=>'product.destroy',//删除
    ];
    public function __construct()
    {
        $this->model= new Goods();

    }

    public function index(Request $request)
    {

        if ($request->ajax()){
            return response()->json($this->getData($request));
        }


        $data['title'] = $this->getTitle();// 标题
        $data['config'] = $this->config;//获取配置

        return view('admin.product.index', ['data'=>$data]);

    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    //表格标题
    function getTitle()
    {
        return [[
            ['type' => 'checkbox'],
            ['field' => 'id', 'title' => 'ID', 'sort' => 'true'],
            ['field' => 'category_id', 'title' => '所属分类'],
            ['field' => 'goods_thumb', 'title' => '商品货号'],
            ['field' => 'goods_name', 'title' => '商品名称'],
            ['field' => 'goods_number', 'title' => '商品库存','sort'=>'true'],
            ['field' => 'market_price', 'title' => '市场售价','sort'=>'true'],
            ['field' => 'shop_price', 'title' => '本店价格', 'sort' => 'true'],
            ['field' => 'promote_price', 'title' => '促销价格', 'sort' => 'true'],
            ['field' => 'is_no_sale', 'title' => '是否上架'],
            ['field' => 'sales_sum', 'title' => '销售数量','sort'=>'true'],
            ['field' => 'right', 'title' => '数据操作', 'align' => 'center', 'toolbar' => '#barDemo', 'width' => 300]
        ]];

    }
    //表格数据
    //获取数据
    public function getData($request){
        $model= $this->model;
        $limit=$request->limit??'10';
        $count=$model->count();
        $paginate=$model->paginate($limit);
        $data=$paginate->toArray();
        return  $data=['code'=>0,'msg'=>'','count'=>$count,'data'=>$data['data']];
    }
}
