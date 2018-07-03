<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Models\BannerImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerImagesController extends TemplateController
{
    protected $model;
    public $config = [
        "title" => 'banner图片管理',
        'index' => 'bannerImages.index',//首页
        'create' => 'bannerImages.create',//创建
        'store' => 'bannerImages.store',//创建保存
        'show' => 'bannerImages.show',//查看
        'edit' => 'bannerImages.edit',//编辑
        'update' => 'bannerImages.update',//编辑保存
        'delete' => 'bannerImages.destroy',//删除
    ];
    public function __construct(BannerImages $images)
    {
        $this->model = $images;

    }

    //展示创建页
    public function create(){
        $config = $this->config;//获取配置
        $banner=Banner::all();
        return view('admin.'.$this->config['create'],compact('config','banner'));
    }
    //展示编辑页
    public function edit($id){
        $model=$this->model::find($id);
        $config = $this->config;//获取配置
        $banner=Banner::all();
        return view('admin.'.''.$this->config['edit'],compact('model','config','banner'));
    }
    //添加
    public function store(Request $request)
    {
        $model = $this->model;
        $data=array_filter($request->all());
        $model->fill($data);
        if ($model->save()) {
            return response()->json(['code' => 200, 'msg' => '添加成功']);
        } else {
            return response()->json(['code' => 400, 'msg' => '添加失败']);
        }


    }
    //添加
    public function update(Request $request,$id)
    {
        $model = $this->model->find($id);
        $model->fill($request->all());
        if ($model->update()) {
            return response()->json(['code' => 200, 'msg' => '修改成功']);
        } else {
            return response()->json(['code' => 400, 'msg' => '修改失败']);
        }


    }
    function getTitle()
    {
        return [[
            ['type' => 'checkbox'],
            ['field' => 'id', 'title' => 'ID', 'sort' => 'true'],
            ['field' => 'banner_id', 'title' => '所属banner','templet'=>'#categoryTpl'],
            ['field' => 'title', 'title' => '标题'],
            ['field' => 'link', 'title' => '链接','width'=>300],
            ['field' => 'image', 'title' => '图片地址', 'sort' => 'true'],
            ['field' => 'sort', 'title' => '排序', 'sort' => 'true'],
            ['field' => 'right', 'title' => '数据操作', 'align' => 'center', 'toolbar' => '#barDemo', 'width' => 300]
        ]];

    }
}
