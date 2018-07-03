@extends('admin.layouts.admin')
@section('_meta')
    @include('admin.layouts._meta')
    <link href="{{asset('admin/css/login.min.css')}}" rel="stylesheet">

@endsection
@section('title', '用户登陆')
@section('content')
    <body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-7">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        <h1></h1>
                    </div>
                    <div class="m-b"></div>
                    <h4>欢迎使用 <strong> 商城后台</strong></h4>
                    <ul class="m-b">
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势一</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势二</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势三</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势四</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势五</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-5">
                @include('admin.message._error')
                <form method="post" action="{{route('login')}}">
                    {{ csrf_field() }}
                    <h4 class="no-margins">登录：</h4>
                    <p class="m-t-md">登录商城后台</p>
                    <input type="text" class="form-control uname" placeholder="用户名" name="username" value="{{old('username')}}" />
                    <input type="password" class="form-control pword m-b" name="password" placeholder="密码" />
                    <input type="text" class="form-control pword m-b" placeholder="验证码" name="captcha" value=""/><img src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()">

                    <button class="btn btn-success btn-block">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2015 All Rights Reserved. H+
            </div>
        </div>
    </div>
    @component('admin/public/footer')

    @endsection
    @section('script')
        @include('admin.layouts._script')
    @stop

