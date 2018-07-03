<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    @yield('_meta')
    <title>@yield('title', '后台首页') - 商城后台</title>
   </head>
<body>
{{--内容--}}
@yield('content')
{{--脚本--}}
@yield('script')
</body>
</html>