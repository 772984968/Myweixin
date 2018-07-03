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
            <legend>查看评价</legend>
        </fieldset>
        <form class="layui-form" action="" method="post">

            <div class="layui-form-item">
                <label class="layui-form-label">用户ID</label>
                <div class="layui-input-block">
                    <input type="text"  id="date1" autocomplete="off" class="layui-input" value="{{$model->user->name}}" disabled="">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品ID</label>
                <div class="layui-input-block">
                    <input type="text"  id="date1" autocomplete="off" class="layui-input" value="{{$model->goods->goods_name}}" disabled="">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">订单ID</label>
                <div class="layui-input-block">
                    <input type="text"  id="date1" autocomplete="off" class="layui-input" value="{{$model->order->id}}" disabled="">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否匿名评论</label>
                <div class="layui-input-block">
                    <input type="checkbox" @if($model->hidden)checked="" @endif value="1" lay-text="是|否"
                           name="is_new" lay-skin="switch"
                           lay-filter="switchTest" title="开关" disabled>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">评论内容</label>
                <div class="layui-input-block">
                    <textarea class="layui-textarea" disabled="disabled">{{$model->content}}</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">评价图片</label>
                <div class="layui-input-block">
                    @foreach($model->images as $vo)
                        <img src="{{$vo->image}}">
                @endforeach

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
                    type:'POST',
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