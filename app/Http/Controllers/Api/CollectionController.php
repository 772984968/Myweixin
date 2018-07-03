<?php

namespace App\Http\Controllers\Api;

use App\Models\Idiom;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends AuthController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Collection();

    }

    //收藏列表
    public function index()
    {
        $user_id = auth('api')->id();
        $colletcs = Collection::where('user_id', $user_id)->with('goods')->get();
        if ($colletcs) {
            return $this->arrayResponse($colletcs);
        }
        return $this->arrayResponse();
    }

    //添加收藏
    public function store(Request $request)
    {
        $data = $this->checkValidate($request, [
            'goods_id' => 'required',
        ]);
        $model = Collection::where(['user_id' => auth('api')->id(), 'goods_id' => $data['goods_id']])->first();
        if ($model) {
            $this->response()->error("该商品已在收藏列表中", 402);
        }
        $this->model->user_id = auth('api')->id();
        $this->model->goods_id = $data['goods_id'];
        if ($this->model->save()) {
            return $this->arrayResponse();
        } else {
            return $this->response()->errorInternal('系统错误，请重试');
        };
    }

    //添加收藏
    public function destroy($id)
    {
        if ($id) {
            if ($this->model::where([['user_id', auth('api')->id()], ['goods_id' , $id]])->delete()) {
                return $this->arrayResponse();
            }
        }
        return $this->response()->errorInternal('系统错误，请重试');
    }

}
