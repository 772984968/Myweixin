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
     <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 >类型树</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                     <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display: block;">
                <div style="display: inline-block;overflow: auto;">
                    <ul id="demo1">
                    </ul>
                </div>
            </div>
        </div>
    </div>
     <div class="col-sm-9">
         <div class="ibox float-e-margins">
             <div class="ibox-title">
                 <h5>子类列表</h5>
                 <div class="ibox-tools">
                     <a class="collapse-link">
                         <i class="fa fa-chevron-up"></i>
                     </a>
                     <a class="close-link">
                         <i class="fa fa-times"></i>
                     </a>
                 </div>
             </div>
             <div class="ibox-content" style="display: block;">
                 <iframe class="J_iframe" name="iframe0" width="100%" height="800px;" src="{{route('category.show',['id'=>0])}}" frameborder="0" data-id="" seamless></iframe>
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
        //Demo
        layui.use(['tree', 'layer'], function(){
            var layer = layui.layer
                ,$ = layui.jquery;

            layui.tree({
                elem: '#demo1' //指定元素
                ,target: '_blank' //是否新选项卡打开（比如节点返回href才有效）
                ,skin: 'shihuang'
                ,click: function(item){ //点击节点回调
/*
                    layer.msg('当前节名称：'+ item.name + '<br>全部参数：'+ JSON.stringify(item));
                    console.log(item);*/
                    var   url="{{route('category.show',[':id'])}}".replace(':id',item.id);

                    $('.J_iframe').attr('src',url);
                }
               ,nodes:@json($nodes)
            });

        });
    </script>
@stop