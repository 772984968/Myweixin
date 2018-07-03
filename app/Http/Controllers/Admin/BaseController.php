<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BaseController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin.auth');
    }

    //文件上传
    public function upload(Request $request)
    {
        $upload = new Upload();
        $upload->setInfo($request->file('file'));
        $file = $request->file('file');
        if ($upload->uploadImage() === true) {
            return response()->json(['code' => 1, 'msg' => '上传成功', 'src' => $upload->getUrl()]);

        };
        return response()->json(['code' => 0, 'msg' => $upload->error, 'data' => '']);

    }
    //返回数据
    public function json($data = [], $msg = '', $code = 200)
    {
        return response()->json(['code' => $code, 'msg' => '成功', 'data' => $data]);
    }
    //验证
    public function  checkValidate($request, $rules, $messages=[], $customAttributes=[]){
        $validator = Validator::make($request->all(),$rules,$messages,$customAttributes);
        if ($validator->fails()) {
            return $error=$validator->errors()->all()[0];
        }
        return true;
    }

}
