@extends('admin.layouts.admin')
@section('_meta')
    @include('admin.layouts._meta')
@endsection
@section('title', '欢迎页')
@section('content')
    <body class="gray-bg">
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-sm-12">
            <blockquote class="text-warning" style="font-size:14px">欢迎您回来…
           </blockquote>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        </div>

@endsection
    @section('script')
        @include('admin.layouts._script')
    @stop




