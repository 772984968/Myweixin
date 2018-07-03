<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends TemplateController
{
    protected $model;
    public $config = [
        "title" => '评论管理',
        'index' => 'comment.index',//首页
      //  'create' => 'comment.create',//创建
        'store' => 'comment.store',//创建保存
        'show' => 'comment.show',//查看
      //  'edit' => 'comment.edit',//编辑
        'update' => 'comment.update',//编辑保存
        'delete' => 'comment.destroy',//删除
    ];

    public function __construct(Comment $comment)
    {
        $this->model = $comment;

    }
    public function index(Request $request)
    {
        if ($request->ajax()){
            return response()->json($this->getData($request));
        }


        $data['title'] = $this->getTitle();// 标题
        $data['config'] = $this->config;//获取配置
        return view('admin.'.$this->config['index'], compact('data'));
    }
    function getTitle()
    {
        return [[
            ['type' => 'checkbox'],
            ['field' => 'id', 'title' => 'ID', 'sort' => 'true'],
            ['field' => 'user_id', 'title' => '用户','templet'=>'#userTpl'],
            ['field' => 'goods_id', 'title' => '商品','templet'=>'#goodsTpl'],
            ['field' => 'content', 'title' => '内容','width'=>700],
            ['field' => 'created_at', 'title' => '评价时间','sort'=>'true'],
            ['field' => 'check', 'title' => '审核状态','templet'=>'#checkTpl'],
            ['field' => 'right', 'title' => '数据操作', 'align' => 'center', 'toolbar' => '#barDemo', 'width' => 300]
        ]];

    }
    //获取数据
    public function getData($request){
        $model= $this->model;
        $limit=$request->limit??'10';
        $count=$model->count();
        $paginate=$model->with('user','goods')->orderByDesc('created_at')->paginate($limit);
        $data=$paginate->toArray();
        return  $data=['code'=>0,'msg'=>'','count'=>$count,'data'=>$data['data']];
    }
    public function show($id)
    {
        $model=$this->model::with('images','user','order')->find($id);
        $config = $this->config;//获取配置
        return view('admin.'.''.$this->config['show'],compact('model','config'));
    }
    //开启审核
    public function switchSale(Request $request){
        if ($request->ajax()){
            $id=$request->input('id');
            $switch=$request->input('switch');
            $switch=$switch?1:0;
            if (Comment::where('id',$id)->update(['check'=>$switch])){
                return $this->json();
            }
            return $this->json([],'',400);

        }

    }


}
