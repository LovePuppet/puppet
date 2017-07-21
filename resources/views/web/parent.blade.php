<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="keywords" content="长城宽带金融">
    <meta name="description" content="长城宽带金融" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link type="text/css" rel="stylesheet" href="{{ asset('/web/css/style.css') }}" />
    @yield('head_css')
</head>
<body>
    @yield('content')
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/web/js/flexible.js') }}"></script>
    <script src="{{ asset('/js/tools.js') }}"></script>
    @yield('foot_js')
</body>
</html>
