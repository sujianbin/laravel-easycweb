@extends('admin.public.layout')
@push('headscripts')
    <script type="text/javascript" src="{{ URL::asset('js/admin/index.js') }}?v=3"></script>
    <script type="text/javascript">
        document.write('<div id="loader_container"><div id="loader"><div align="center">页面组件加载中……<br />首次加载可能会花费一分钟，请稍候...</div><div id="loader_bg"><div id="progress"> </div></div></div></div>');
        var pos = 0;
        var dir = 2;
        var len = 0;
    </script>
@endpush
@section('content')
    <div class="header">
        <div class="header-left">每日看书</div>
        <div class="header-middle">
            <ul>
                @foreach (right_group() as $k=>$vo)
                    @if ($loop->first)
                        <li class="curr" data-c="menu-{{ $k }}"> {{ $vo['name'] }}</li>
                    @else
                        <li data-c="menu-{{ $k }}"> {{ $vo['name'] }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="header-right">
            <div class="header-right-top"> <em class="time"></em><span class="author">欢迎使用,{{ Auth::guard('admin')->user()->username }}</span></div>
            <div class="header-right-nav">
                <ul>
                    <li><a href='javascript:;' id="change-password" name="{{ url('admin/admin/editPwd') }}" title="修改密码">修改密码</a></li>
                    <li><a href='{{ url('admin/logout') }}' id="exit-system" title="退出系统">退出系统</a></li>
                    <li><a href='javascript:;' id="clear-flash" title="清除缓存">清除缓存</a></li>
                    <li><a href='/' target="_blank" title="网站首页">网站首页</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="left">
        <div class="left-top">让10亿国人每日看书</div>
        <div class="nav-list">
            <ul>
                @foreach (right_group() as $k=>$vo)
                    @foreach ($vo['menu'] as $v1)
                        <li class="menu-{{ $k }} @if (!$loop->parent->first) c-hide @endif">
                            @if(count($v1['item']) == 1)
                                <a href="{{ $v1['action'][key($v1['item'])]['url'] }}" class="{{ $v1['icon'] }}">{{ $v1['name'] }}</a>
                            @else
                                <a href="javascript:;" class="{{ $v1['icon'] }}">{{ $v1['name'] }}</a>
                                <ul class="submenu">
                                    @foreach ($v1['item'] as $k2=>$v2)
                                        <li>
                                            <a href="javascript:;" name="{{ $v1['action'][$k2]['url'] }}" title="{{ $v2 }}" class="iframeurl">{{ $v2 }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
    <div class="right">
        <div class="right-top"><a href="/">首页</a>><span class="next-a">系统首页</span></div>
        <iframe id="iframe" onload="remove_loading();" frameborder="0" src="{{ url('admin/centos') }}"></iframe>
    </div>
    <div class="hide" title="隐藏"></div>
@endsection
@push('footscripts')
    <script type="text/javascript">
        $(".header-middle").on("click","li",function(){
            $(this).addClass("curr");
            $(".nav-list>ul>li").addClass("c-hide");
            $("."+$(this).data("c")).removeClass("c-hide");
            $(this).siblings("li").removeClass("curr");
        });
    </script>
@endpush