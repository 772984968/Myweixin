<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ActivityForm;
use App\Http\Requests\Admin\CommonForm;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends TemplateController
{
    protected $model;
    public $config=[
        'index'=>'activity.index',//首页
        'create'=>'activity.create',//创建
        'store'=>'activity.store',//创建保存
        // 'show'=>'activity.show',//查看
        'edit'=>'activity.edit',//编辑
        'update'=>'activity.update',//编辑保存
        'delete'=>'activity.destroy',//删除
    ];
    public function __construct()
    {
        $this->model= new Activity();

    }

    public function store(ActivityForm $request){
        $model=$this->model;
        $model->fill($request->validated());
        if ($model->save()){
            return $this->json();
        }
    }
    public function update(ActivityForm $request, $id){
        $model=$this->model->find($id);
        $model->fill($request->validated());
        if ($model->save()){
            return $this->json();
        }
    }
    function getTitle()
    {
            return[[
            ['type'=>'checkbox'],
            ['field'=>'id','title'=>'ID','sort'=>'true'],
            ['field'=>'title','title'=>'标题'],
            ['field'=>'title_url','title'=>'标题图片'],
            ['field'=>'explanation','title'=>'活动描述'],
            ['field'=>'start_time','title'=>'开始时间'],
            ['field'=>'end_time','title'=>'结束时间'],
            ['field'=>'right','title'=>'数据操作','align'=>'center','toolbar'=>'#barDemo','width'=>300]
        ]];
    }
}
