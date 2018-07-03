<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelController extends TemplateController
{
    protected $model;
    public $config=[
        "title"=>'等级管理',
        'index'=>'level.index',//首页
        'create'=>'level.create',//创建
        'store'=>'level.store',//创建保存
        'show'=>'level.show',//查看
        'edit'=>'level.edit',//编辑
        'update'=>'level.update',//编辑保存
        'delete'=>'level.destroy',//删除
         ];
    public function __construct()
    {
        $this->model= new Level();

    }

    public function create(){
        return view('admin.level.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->checkValidate($request,[
            'level'=>'required',
        ],[
            'level.required'=>'等级不能为空',
        ]);
         if ($data!==true) {
             return response()->json(['code' => 400, 'msg' => $data]);
         }
         $this->model->level=$request->level;
         if ($this->model->save()){
          return response()->json(['code' => 200, 'msg' => '添加成功']);
         }

    }


    public function edit($id)
    {
         $level=Level::find($id);
         $data['config'] = $this->config;//获取配置
         return view('admin.level.edit',compact('level','data'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$this->checkValidate($request,[
            'level'=>'required',
        ],[
            'level.required'=>'等级不能为空',
        ]);
        if ($data!==true) {
             return response()->json(['code' => 400, 'msg' => $data]);
        }
        $model=$this->model->find($id);
        $model->level=$request->level;
        if ($model->save()){
            return response()->json(['code' => 200, 'msg' => '修改成功']);
        }else{
            return response()->json(['code' => 400, 'msg' => '修改失败']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function getTitle()
        {
            return[[
                ['type'=>'checkbox'],
                ['field'=>'id','title'=>'ID','sort'=>'true'],
                ['field'=>'level','title'=>'等级'],
                ['field'=>'right','title'=>'数据操作','align'=>'center','toolbar'=>'#barDemo','width'=>300]
                ]];
        }
       }
