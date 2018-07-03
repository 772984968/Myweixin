@extends('admin.layouts.admin')
@section('_meta')
    @include('admin.layouts._meta')
    @endsection
@section('title', '后台首页')
@section('content')
    <body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
    @include('admin/public/_menu')
    <!--左侧导航结束-->
        <!--右侧部分开始-->
    @include('admin/public/wrapper')

    <!--右侧部分结束-->
        <!--右侧边栏开始-->
    @include('admin/public/right_sidebar')
    <!--右侧边栏结束-->
    </div>
@endsection
@section('script')
    @include('admin.layouts._script')
    <script src="{{asset('admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/layer/layer.min.js')}}"></script>
    <script src="{{asset('admin/js/hplus.min.js?v=4.1.0')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/contabs.min.js')}}"></script>
    <script src="{{'admin/js/plugins/pace/pace.min.js'}}"></script>
@stop

