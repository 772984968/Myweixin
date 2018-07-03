<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends BaseController
{
    public function __construct()
    {
        return ;
    }

    //登陆页
    public  function index(){
        return view('admin.login.index');
    }
    /**
     *用户登陆
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(AdminLogin $request)
    {
        $credentials=[
            'username'=>$request->username,
            'password'=>$request->password,
        ];
         if (auth('admin')->attempt($credentials)){
               flash('登陆成功')->success();
           return redirect(route('index'));
        }else{
            flash('账户与密码不匹配')->error();
        return    redirect()->route('login');

        }

       return  view('admin.index.index');

    }


    /**
     * 用户退出
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth('admin')->logout();
        return   redirect()->route('login');

    }
}
