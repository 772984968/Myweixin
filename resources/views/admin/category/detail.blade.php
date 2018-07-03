@extends('admin.layouts.admin')
@section('_meta')
    @include('admin.layouts._meta')
    <link href="{{asset('admin/plugins/layui/css/layui.css')}}" rel="stylesheet">
@endsection
@section('title', '后台管理')
@section('content')
    <body>
    <div class="layui-container"layui-bg-gray>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">

        </fieldset>
             {{ csrf_field() }}
            <div class="layui-form-item">
                <label class="layui-form-label">名称</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="{{$category->name}}" name="category_name"
                           placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="{{$category->sort}}" name="sort"
                           placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">创建时间</label>
                <div class="layui-input-block">
                    <input type="text" lay-verify=""  value="{{$category->created_at}}" name="sort"
                           placeholder="" autocomplete="off" class="layui-input">
                </div>
            </div>

    </div>
    </body>

    @endsection
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
        <script>
            layui.use('laydate', function(){
                var laydate = layui.laydate;
                //执行一个laydate实例
                laydate.render({
                    elem: '#start_time', //指定元素
                    type:'datetime'
                });
                //执行一个laydate实例
                laydate.render({
                    elem: '#end_time', //指定元素
                    type:'datetime'
                });
            });
        </script>
        <script>
            layui.use('upload', function() {
                var $ = layui.jquery
                    , upload = layui.upload;

                //普通图片上传
                var uploadInst = upload.render({
                    elem: '#upload'
                    , url: "{{route('upload')}}"
                    ,headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , before: function (obj) {
                        //预读本地文件示例，不支持ie8
                        obj.preview(function (index, file, result) {
                            $('#demo1').attr('src', result); //图片链接（base64）
                        });
                    }
                    , done: function (res) {
                        //如果上传失败
                        if (res.code ==0) {
                            return layer.msg(res.msg);
                        }
                        $('input[name="title_url"]').val(res.src);
                        return layer.msg('上传成功');
                    }
                    , error: function () {
                        //演示失败状态，并实现重传
                        var demoText = $('#demoText');
                        demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                        demoText.find('.demo-reload').on('click', function () {
                            uploadInst.upload();
                        });
                    }
                });
            });
        </script>
    @stop

