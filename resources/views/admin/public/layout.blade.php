<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{{ cache('config')['seo_title'] }}</title>
        <meta name="keywords" content="{{ cache('config')['seo_keywords'] }}">
        <meta name="description" content="{{ cache('config')['seo_description'] }}">
        <meta name="author" content="stafish">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta content="yes" name="apple-mobile-web-app-capable">
        <meta content="yes" name="apple-touch-fullscreen">
        <meta content="telephone=no,email=no" name="format-detection">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/admin/style.css') }}?v=1.1">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugin/webuploader/css/phoselect.css') }}">
        <link rel="shortcut icon" href="{{ cache('config')['ico'] }}">
        <script type="text/javascript" src="{{ URL::asset('js/admin/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('plugin/menu/assets/js/jquery-1.11.1.min.js') }}"></script>
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
    <script type="text/javascript" src="{{ URL::asset('js/admin/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $(".s-file-list").sortable({cursor:'move'});
            $(".s-file-list").disableSelection();
            $(".s-file-list").on("click","span.cancel",function(){
                $(this).parents("li.file").remove();
            });
        });
    </script>
</html>