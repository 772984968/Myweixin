<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ResetPasswordForm;
use App\Models\Comment;
use App\Models\Idiom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use function MongoDB\BSON\toJSON;
use EasyWeChat;

class UserController extends AuthController
{
    public function __construct()
    {
        return parent::__construct();
    }

    //绑定微信信息
    public function setInfo(Request $request)
    {
        $user = auth('api')->user();
        $this->checkValidate($request,
            [
                'nickName' => 'required',
            ]);
        if ($request->has('nickName')) {
            $user->name = $request->input('nickName');
        }
        if ($request->has('phone')) {
            $user->phone = $request->input('phone');
        }
        if ($user->save()) {
            return $this->arrayResponse();
        }
        return $this->response()->errorInternal('系统错误，请重试');
    }

    //用户中心
    public function index()
    {
        $user = auth('api')->user();
        return $this->arrayResponse($user, 'success', '200');
    }


    //个人评价列表
    public function comment()
    {
        $user = auth('api')->user();
        $comment=Comment::with('images')->where('user_id',$user->id)->paginate();
        return $this->arrayResponse($comment, 'success', '200');
    }

    //更新信息
    public function update(Request $request)
    {
        $data = $request->all();
        $user = auth('api')->user();
        $user->fill($data);
        if ($user->save()) {
            return $this->arrayResponse($user, 'success', '200');
        };
    }

    //重置密码
    public function resetPassword(ResetPasswordForm $request)
    {
        $data = $request->validated();
        $user = auth('api')->user();
        if (!auth('api')->attempt(['password'=>$data['old_password'],'username'=>$user->username])) {
            return $this->response()->error('原密码不正确',400);
        }
        $user->password = bcrypt($data['password']);
        if ($user->save()){
            return $this->arrayResponse([], '修改成功', '200');
        }
        return $this->response()->error('修改失败');

    }

    //小程序登陆
    public function weappStore(Request $request)
    {
        $rs = $this->checkValidate($request,
            [
                'code' => 'required|string',
            ]);
        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($rs['code']);
        //  $data['openid']='othXi5PiFWC3ZNolCkSCUgkZCQy';
        //   $data['session_key']='6kAO6sfsgoGU0MjBxsah8A==';

        // 如果结果错误，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code 不正确');
        }
        // 找到 openid 对应的用户
        $user = User::where('weapp_openid', $data['openid'])->first();
        $attributes['weixin_session_key'] = $data['session_key'];
        if (!$user) {
            $attributes['weapp_openid'] = $data['openid'];
            $user = User::create($attributes);
        } else {
            $user->update($attributes);
        }
        //更新用户信息
        $token = auth('api')->login($user);
        // 为对应用户创建 JWT
        return $this->respondWithToken($token);
    }

}
