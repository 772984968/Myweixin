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

    <body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link" href="javascript:location.replace(location.href);">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>

                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_data_tables.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_data_tables.html#">选项1</a>
                                </li>
                                <li><a href="table_data_tables.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        @if(isset($data['config']['create']))
                            <div class="">
                                <a onclick="layer_show('添加','{{route($data['config']['create'])}}')" href="javascript:void(0);" class="btn btn-primary glyphicon glyphicon-plus "></a>
                            </div>
                        @endif

                        <div class="demoTable">  搜索：
                            <div class="layui-input-inline" >
                                <select name="search" lay-verify="" class="layui-input">
                                    <option value="name">成语搜索</option>
                                    <option value="level">等级搜索</option>
                                </select>

                            </div>
                            <div class="layui-inline">
                                <input class="layui-input" name="id" id="demoReload" autocomplete="off">
                            </div>
                            <button class="layui-btn" data-type="reload">搜索</button>
                        </div>
                        <div  class="layui-btn-group demoTable2">
                            <button class="layui-btn layui-btn-danger" data-type="getCheckData">删除</button>
                        </div>
                        <table class="layui-hide" id="demo" lay-filter="basedemo"></table>
                        <script type="text/html" id="barDemo">
                            @if(isset($data['config']['show']))
                            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
                            @endif
                            @if(isset($data['config']['edit']))
                            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                            @endif
                            @if(isset($data['config']['delete']))
                            <a class="layui-btn layui-btn-xs layui-btn-danger  layui-btn-mini" lay-event="del">删除</a>
                            @endif
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                ,url: "{{route($data['config']['index'])}}" //数据接口
                ,page: true //开启分页
                ,cols:@json($data['title'])
                ,even: true

            });
            //监听工具条
            table.on('tool(basedemo)', function(obj){
                var data = obj.data;
                if(obj.event === 'detail'){
                    layer.msg('ID：'+ data.id + ' 的查看操作');
                } else if(obj.event === 'del'){
                    layer.confirm('真的删除行么', function(index){
                        //向服务端发送删除指令
                        var   url="{{route($data['config']['delete'],":id")}}".replace(':id',data.id);
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
                            @if(isset($data['config']['edit']))
                    var url="{{route($data['config']['edit'],":id")}}"
                    url=url.replace(':id',data.id);
                    layer_show("编辑",url);
                    //  layer.alert('编辑行：<br>'+ JSON.stringify(data))
                    @endif

                }
            });
            //搜索重载
            $('.demoTable .layui-btn').on('click', function(){
                var options=$("select[name='search']").val();
                var values=$("#demoReload").val();
                //方法重载
                table.reload('testReload', {
                    where: {
                        //设定异步数据接口的额外参数，任意设
                        [options]:values,
                    }
                    ,page: {
                        curr: 1 //重新从第 1 页开始
                    }
                });
            });




            //批量删除
            $('.demoTable2 .layui-btn').on('click', function(){
                var checkStatus = table.checkStatus('testReload')
                    ,data = checkStatus.data;
                if(data!=''){
                    $.ajax({
                        url:"{{route($data['config']['delete'],":id")}}",
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
            layer.open({
                type: 2,//类型
                title: title,
                anim: 2 ,//打开方式
                maxmin: true, //开启最大化最小化按钮
                area: ['800px', '600px'],
                content:url
            });
        }
    </script>

@stop
