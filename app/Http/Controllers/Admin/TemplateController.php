<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
abstract class TemplateController extends BaseController
{

    public function index(Request $request)
    {
        if ($request->ajax()){
          return response()->json($this->getData($request));
        }


        $data['title'] = $this->getTitle();// 标题
        $data['config'] = $this->config;//获取配置
        return view('admin.template.index', compact('data'));
    }

    abstract function getTitle();
    //获取数据
    public function getData($request){
        $model= $this->model;
        $limit=$request->limit??'10';
        $count=$model->count();
        $paginate=$model->paginate($limit);
        $data=$paginate->toArray();
        return  $data=['code'=>0,'msg'=>'','count'=>$count,'data'=>$data['data']];
     }

    public function destroy(Request $request,$id)
    {

        if (is_numeric($id)){
            if ($this->model::destroy($id)){
                return response()->json(['code'=>200,'msg'=>'删除成功']);
            }else{

                return response()->json(['code'=>400,'msg'=>'删除失败']);
            }
        }
        $data=$request->all();
        foreach ($data as $vo){
            $data=json_decode($vo);
        }
        foreach ($data as $vo){
            $ids[]=$vo->id;
        }

        if($this->model::destroy($ids)){
            return response()->json(['code'=>200,'msg'=>'删除成功']);
        }else{
            return response()->json(['code'=>400,'msg'=>'删除失败']);
        }
    }
    //展示编辑页
    public function edit($id){
        $model=$this->model::find($id);
        $config = $this->config;//获取配置
        return view('admin.'.''.$this->config['edit'],compact('model','config'));
    }
    //展示创建页
    public function create(){
        $config = $this->config;//获取配置
        return view('admin.'.$this->config['create'],compact('config'));
    }

}
