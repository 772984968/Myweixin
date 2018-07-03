<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use App\Models\Feedback;
use Illuminate\Http\Request;
class CommonController extends AuthController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['banner']);
    }
    //意见反馈
    public function feedback(Request $request){
       $data= $this->checkValidate($request,[
            'user_id'=>'required',
            'content'=>'required|min:8',
        ]);
        if (Feedback::create($data)){
            return $this->arrayResponse();
        }else{
            return $this->response()->errorInternal('系统错误，请稍后重试');
        };
    }

    //Banner列表
    public function banner(){
        $banner=Banner::with('images')->where('status',1)->get();
        return $this->arrayResponse($banner);
    }


}
