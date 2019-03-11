<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>每日看书</title>
        <meta name="keywords" content="每日看书">
        <meta name="description" content="每日看书">
        <meta name="author" content="stafish">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta content="yes" name="apple-mobile-web-app-capable">
        <meta content="yes" name="apple-touch-fullscreen">
        <meta content="telephone=no,email=no" name="format-detection">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/admin/style.css') }}?v=1.0">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugin/webuploader/css/phoselect.css') }}">
        <link rel="shortcut icon" href="{{ URL::asset('images/admin/favicon.ico') }}">
        <script type="text/javascript" src="{{ URL::asset('js/admin/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugin/layer/layer.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugin/My97DatePicker/WdatePicker.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugin/highcharts/highcharts.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugin/highcharts/exporting.js') }}"></script>
        <script type="text/javascript" charset="utf-8" src="{{ URL::asset('plugin/UEditor/ueditor.config.js') }}"></script>
        <script type="text/javascript" charset="utf-8" src="{{ URL::asset('plugin/UEditor/ueditor.all.js') }}"></script>
        <script type="text/javascript" charset="utf-8" src="{{ URL::asset('plugin/UEditor/lang/zh-cn/zh-cn.js') }}"></script>
        @stack('headscripts')
    </head>
    <body>
        @yield('content')
    </body>
    @include("admin.public.js")
    @stack('footscripts')
</html>