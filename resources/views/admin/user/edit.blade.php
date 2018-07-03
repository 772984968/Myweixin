@extends('admin.layouts.admin')
{{--meta、css--}}
@section('_meta')
    @include('admin.layouts._meta')
    <link href="{{asset('admin/plugins/layui/css/layui.css')}}" rel="stylesheet">
@endsection
{{--title--}}
@section('title', '后台管理系统')
{{--coentent 主题内容--}}
@section('content')
    <body>
<div class="layui-container"layui-bg-gray>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>编辑用户</legend>
    </fieldset>
    <form class="layui-form" action="{{route('user.update',[$user->id])}}" method="post">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">名字</label>
            <div class="layui-input-block">
                <input type="text" lay-verify=""  value="{{$user->name}}" name="name"
                       placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">登陆名</label>
            <div class="layui-input-block">
                <input type="text" lay-verify=""  value="{{$user->username}}" name="username"
                       placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮件</label>
            <div class="layui-input-block">
                <input type="text" lay-verify=""  value="{{$user->email}}" name="email"
                       placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">积分</label>
            <div class="layui-input-block">
                <input type="text" lay-verify=""  value="{{$user->credits}}" name="credits"
                       placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">电话</label>
            <div class="layui-input-block">
                <input type="text" lay-verify=""  value="{{$user->phone}}" name="phone"
                       placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="password" lay-verify=""  value="{{$user->password}}" name="password"
                       placeholder="" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>

            </div>
        </div>
    </form>
</div>
</body>

@endsection
{{--script 代码和js--}}
@section('script')
    @include('admin.layouts._script')
    <script src="{{asset('admin/plugins/layui/layui.all.js')}}"></script>
    <script>
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(formDemo)', function(formdata){
                var url=$('.layui-form').attr('action');
                $.ajax({
                    url:url,
                    type:'PUT',
                    dataType:'json',
                    data:formdata.field,
                    success:function(data){
                        if(data.code=='200'){
                            layer.msg(data.msg,{icon:1,time:1*1000},function(){
                                var index = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(index);
                            });
                        }else{
                            layer.msg(data.msg,{icon:5});
                        }
                    },
                    error:function(data){
                        layer.msg('数据发送失败',{icon:5});
                    }
                });
                return false;
            });
        });
    </script>
@stop
