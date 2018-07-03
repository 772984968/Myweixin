<?php

namespace App\Http\Controllers\Api;

use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends BaseController
{
    //最新商品
    public function is_new(Request $request)
    {
        $limit = $request->input('limit') ?? 10;
        $goods = Goods::where('is_new', 1)->with('images')->paginate($limit);
        return $this->arrayResponse($goods);
    }

    //推荐商品
    public function is_hot(Request $request)
    {
        $limit = $request->input('limit') ?? 10;
        $goods = Goods::where('is_hot', 1)->with('images')->paginate($limit);
        return $this->arrayResponse($goods);
    }

    //商品详情
    public function detail(Request $request)
    {

        $data=$this->checkValidate($request,
            [
                'product_id'=>'required'
            ]
            );
        $rs=Goods::with('images')->where('is_on_sale',1)->find($data['product_id']);
        if ($rs){
            return $this->arrayResponse($rs);
        }
        else{
            return $this->response()->errorNotFound('商品不存在或已下架');

        }



    }
}
