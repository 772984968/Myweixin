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
                        <h5>商品列表</h5>
                        <div class="ibox-tools">
                            <a class="" href="javascript:location.replace(location.href);">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>

                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        @if(isset($data['config']['create']))
                            <div class="layui-btn-group">
                                <button class="layui-btn layui-btn-sm" onclick="layer_show('添加商品','{{route($data['config']['create'])}}')" href="javascript:void(0);">
                                    <i class="layui-icon" ></i>
                                </button>
                                <button class="layui-btn layui-btn-sm">
                                    <i class="layui-icon"></i>
                                </button>
                            </div>
                        @endif
                    <!--
                                       <div class="demoTable">  搜索：
                                           <div class="layui-input-inline" >


                                               <select name="search" lay-verify="" class="layui-input">
                                                  <option value=""></option>
                                               </select>

                        </div>
                        <div class="layui-inline">
                            <input class="layui-input" name="id" id="demoReload" autocomplete="off">
                        </div>
                        <button class="layui-btn" data-type="reload">搜索</button>
                    </div>-->
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
    {{--表格模板--}}
    <script type="text/html" id="categoryTpl">
        @{{d.category.name}}
    </script>
    <script type="text/html" id="thumbTpl">

       <img src="@{{d.goods_thumb}}" width="150" height="150" >

    </script>
    <script type="text/html" id="checkSaleTpl">

        <input type="checkbox" name="is_on_sale" value="@{{d.id}}" lay-skin="switch" lay-text="是|否" lay-filter="saleDemo" @{{ d.is_on_sale ==1 ? 'checked' : '' }}>

    </script>

    <script>
        layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element'], function(){
            var laydate = layui.laydate //日期
                ,laypage = layui.laypage //分页
            layer = layui.layer //弹层
                ,table = layui.table //表格
                ,form = layui.form;//表单
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
                    var url="{{route($data['config']['show'],['id'=>':id'])}}".replace(':id',data.id);
                    layer_show("查看详情",url);
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
                if(obj.event==='showImage'){
                    layer.open({
                        type: 1,
                        title: false,
                        offset: 'auto',
                        closeBtn: 0,
                        skin: 'layui-layer-nobg', //没有背景色
                        shadeClose: true,
                        content: '<img  src='+data.goods_thumb+'>'
                    });

                }
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
            //监听上下架操作
            form.on('switch(saleDemo)', function(obj){
                $.ajax({
                    url:"{{route('product.switchSale')}}",
                    type:'POST',
                    dataType:'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        id:this.value,
                        switch:obj.elem.checked
                    },
                    success:function(data){
                        if(data.code=='200'){
                            layer.tips('修改成功',obj.othis);
                        }else{
                            layer.msg(data.msg,{icon:5});
                        }
                    },
                    error:function(data){
                        layer.msg('数据发送失败',{icon:5});
                    }
                });

                //layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);

            });
        });
    </script>
    <script type="text/javascript">
        function layer_show(title,url){
            var index=layer.open({
                type: 2,//类型
                title: title,
                anim: 2 ,//打开方式
               // area: ['800px', '600px'],
                content:url
            });
            layer.full(index);
        }
    </script>

@stop
