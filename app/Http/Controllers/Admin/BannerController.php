<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends TemplateController
{

    protected $model;
    public $config=[
        "title"=>'Banner管理',
        'index'=>'banner.index',//首页
        'create'=>'banner.create',//创建
        'store'=>'banner.store',//创建保存
       // 'show'=>'banner.show',//查看
        'edit'=>'banner.edit',//编辑
        'update'=>'banner.update',//编辑保存
        'delete'=>'banner.destroy',//删除
    ];
    public function __construct()
    {
        $this->model= new Banner();

    }
    public function index(Request $request)
    {
        if ($request->ajax()){
            return response()->json($this->getData($request));
        }
        $data['title'] = $this->getTitle();// 标题
        $data['config'] = $this->config;//获取配置
        return view('admin.banner.index', compact('data'));
    }

    public function store(Request $request){
        $model = $this->model;
        $data=array_filter($request->all());
        $model->fill($data);
        if ($model->save()) {
              return response()->json(['code' => 200, 'msg' => '添加成功']);
        } else {
            return response()->json(['code' => 400, 'msg' => '添加失败']);
        }
    }
    public function update(Request $request,$id){
        $model = $this->model->find($id);
        $model->status=0;
        $data=array_filter($request->all());
        $model->fill($data);
        if ($model->save()) {
            return response()->json(['code' => 200, 'msg' => '添加成功']);
        } else {
            return response()->json(['code' => 400, 'msg' => '添加失败']);
        }

    }
    //表格标题
    function getTitle()
    {
        return [[
            ['type' => 'checkbox'],
            ['field' => 'id', 'title' => 'ID', 'sort' => 'true'],
            ['field' => 'name', 'title' => '名字'],
            ['field' => 'status', 'title' => '状态','sort'=>'true','templet'=>'statusTpl'],
            ['field' => 'right', 'title' => '数据操作', 'align' => 'center', 'toolbar' => '#barDemo', 'width' => 300]
        ]];

    }
}
