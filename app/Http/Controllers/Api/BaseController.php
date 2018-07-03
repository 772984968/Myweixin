<?php
namespace App\Http\Controllers\Api;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Dingo\Api\Exception\StoreResourceFailedException;
use Validator;
class BaseController extends  Controller{
    use Helpers;
    //表单检查
    public function  checkValidate($request, $rules, $messages=[], $customAttributes=[]){
        $validator = Validator::make($request->all(),$rules,$messages,$customAttributes);
        if ($validator->fails()) {
            throw new StoreResourceFailedException('Validation Error', $validator->errors());
        }
        return $validator->getData();
    }
    //统一响应
    public function arrayResponse($data=[],$message='success',$status=200){
        return $this->response()->array(
            [
                'message' => $message,
                'status_code' => $status,
                'data'=>$data,

            ]
        );
    }
}
