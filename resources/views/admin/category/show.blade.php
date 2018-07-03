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
    <span class="text-navy" style="font-size: larger">
        @if($category)
            {{$category->name}}
        @else
            顶级菜单
            @endif
    </span>
    @if($category)
        <button class="layui-btn layui-btn-sm" onclick="layer_show('查看','{{route('category.detail',['id'=>$category->id])}}')"><i class="layui-icon">查看</i></button>
        <button class="layui-btn layui-btn-sm" onclick="layer_show('编辑','{{route('category.edit',['id'=>$category->id])}}')"><i class="layui-icon"></i></button>
        <button class="layui-btn layui-btn-sm" onclick="layer_show('添加','{{route('category.create',['id'=>$category->id])}}')"><i class="layui-icon">添加子类</i></button>
    @else
        <button class="layui-btn layui-btn-sm" onclick="layer_show('添加','{{route('category.create')}}')"><i class="layui-icon">添加子类</i></button>

    @endif
           <table class="layui-hide" id="demo" lay-filter="basedemo"></table>
                        <script type="text/html" id="barDemo">

                            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>


                            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>


                            <a class="layui-btn layui-btn-xs layui-btn-danger  layui-btn-mini" lay-event="del">删除</a>

                        </script>





    </body>
@endsection
{{--script 代码和js--}}
@section('script')
    @include('admin.layouts._script')
    <script src="{{asset('admin/plugins/layui/layui.all.js')}}"></script>
    <script>
        layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element'], function(){
            var laydate = layui.laydate //日期
                ,laypage = layui.laypage //分页
            layer = layui.layer //弹层
                ,table = layui.table //表格
            //执行一个 table 实例
            table.render({
                elem: '#demo'
                ,cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                ,id:'testReload'
                ,url: "{{route('category.show',['id'=>$category?$category->id:0])}}" //数据接口
                ,page: true //开启分页
                ,cols:@json($data['title'])
                ,even: true

            });
            //监听工具条
            table.on('tool(basedemo)', function(obj){
                var data = obj.data;
                if(obj.event === 'detail'){
                   var url="{{route('category.detail',['id'=>'abc'])}}".replace('abc',data.id);
                    layer_show("查看详情",url);
                } else if(obj.event === 'del'){
                    layer.confirm('真的删除么?所有子类也将会删除！', function(index){
                        //向服务端发送删除指令
                        var   url="{{route('category.destroy',':id')}}".replace(':id',data.id);
                        $.ajax({
                            url:url,
                            type:'DELETE',
                            dataType:'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{
                                id:data.id
                            },
                            success:function(data){
                                if(data.code=='200'){
                                    layer.msg(data.msg,{icon:1,time:1*1000},function(){
                                        obj.del();
                                        layer.close(index);
                                    });
                                }else{
                                    layer.msg(data.msg,{icon:5});
                                }
                            },
                            error:function(data){
                                layer.msg('数据发送失败',{icon:5});
                            }
                        });

                    });
                } else if(obj.event === 'edit'){
                   var url="{{route('category.edit',['id'=>'abc'])}}".replace('abc',data.id);
                    layer_show("编辑",url);
                    //  layer.alert('编辑行：<br>'+ JSON.stringify(data))


                }
            });
            //批量删除
            $('.demoTable2 .layui-btn').on('click', function(){
                var checkStatus = table.checkStatus('testReload')
                    ,data = checkStatus.data;
                if(data!=''){
                    $.ajax({
                        url:"",
                        type:'DELETE',
                        dataType:'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            data:JSON.stringify(data),
                        },
                        success:function(data){
                            if(data.code=='200'){
                                layer.msg(data.msg,{icon:1,time:1*1000},function(){
                                    location.replace(location.href);
                                    layer.close(index);
                                });
                            }else{
                                layer.msg(data.msg,{icon:5});
                            }
                        },
                        error:function(data){
                            layer.msg('数据发送失败',{icon:5});
                        }
                    });
                }
            });

        });
    </script>
    <script type="text/javascript">
        function layer_show(title,url){
            var index=layer.open({
                type: 2,//类型
                title: title,
                anim: 2 ,//打开方式
             //   maxmin: true, //开启最大化最小化按钮
              //  area: ['800px', '600px'],
                content:url
            });
            layer.full(index);
        }
    </script>
@stop
