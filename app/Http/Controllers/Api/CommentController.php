<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CommentForm;
use App\Models\Comment;
use App\Models\CommentImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends AuthController

{
    protected $model;
    public function __construct()
    {
        $this->middleware('auth:api')->except(['show']);
        $this->model=new Comment();
    }

    //评价列表
    public function show(Request $request,$goods_id){

        $limit=$request->input('limit')??10;
        $com=Comment::with('user','goods')->where('check',1)->where('goods_id',$goods_id)->paginate($limit);
        return $this->arrayResponse($com);
    }
    //评价商品
    public function store(CommentForm $request){
        $data=$request->all();
        $user_id=auth('api')->id();
        $model=$this->model;
        $model->fill($data);
        $model->user_id=$user_id;
        if ($model->save()){
            if (isset($data['images'])){
                foreach ($data['images']as  $vo){
                    CommentImage::create([
                        'comment_id'=>$model->id,
                        'image'=>$vo,
                    ]);
                }
            }
            return $this->arrayResponse();
        }

        return $this->response()->errorInternal('评论失败，稍后重试！');
    }
}
