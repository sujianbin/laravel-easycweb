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
                <li class="menu-system"><a href="{{ url('admin/index') }}" class="icon-home on" title="系统首页">系统首页</a></li>
                <li class="menu-system">
                    <a href="javascript:;" class="icon-menu">权限管理</a>
                    <ul class="submenu">
                        <li>
                            <a href="javascript:;" name="{{ url('admin/admin/admin') }}" title="管理员管理" class="iframeurl">管理员管理</a>
                        </li>
                        <li>
                            <a href="javascript:;" name="{{ url('admin/role/role') }}" title="角色管理" class="iframeurl">角色管理</a>
                        </li>
                        <li>
                            <a href="javascript:;" name="{{ url('admin/rights/rights') }}" title="权限管理" class="iframeurl">权限管理</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-system">
                    <a href="javascript:;" class="icon-menu">小说管理</a>
                    <ul class="submenu">
                        <li>
                            <a href="javascript:;" name="{{ url('admin/novel/area') }}" title="发布区域" class="iframeurl">发布区域</a>
                        </li>
                        <li>
                            <a href="javascript:;" name="{{ url('admin/novel/item') }}" title="小说分类" class="iframeurl">小说分类</a>
                        </li>
                        <li>
                            <a href="javascript:;" name="{{ url('admin/novel/banner') }}" title="小说轮播" class="iframeurl">小说轮播</a>
                        </li>
                        <li>
                            <a href="javascript:;" name="{{ url('admin/novel/index') }}" title="小说列表" class="iframeurl">小说列表</a>
                        </li>
                        <li>
                            <a href="javascript:;" name="{{ url('admin/novel/recover') }}" title="小说回收" class="iframeurl">小说回收</a>
                        </li>
                        <li>
                            <a href="javascript:;" name="{{ url('admin/novel/comment') }}" title="评论管理" class="iframeurl">评论管理</a>
                        </li>
                    </ul>
                </li>
                @if (isset($leftMenu) && count($leftMenu) > 0)
                    @foreach ($leftMenu as $k=>$vo)
                        @foreach ($vo as $v1)
                            <li class="menu-{{ $k }} @if ($k != 'system') c-hide @endif">
                                <a href="javascript:;" class="icon-{{ $v1['icon'] }}">{{ $v1['title'] }}</a>
                                <ul class="submenu">
                                    @foreach ($v1['child'] as $v2)
                                        <li>
                                            @if (isset($v2['param']))
                                                <a href="javascript:;" name="{{ url($v2['url'],$v2['param']) }}" title="{{ $v2['title'] }}" class="iframeurl">{{ $v2['title'] }}</a>
                                            @else
                                                <a href="javascript:;" name="{{ url($v2['url']) }}" title="{{ $v2['title'] }}" class="iframeurl">{{ $v2['title'] }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    @endforeach
                @endif
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