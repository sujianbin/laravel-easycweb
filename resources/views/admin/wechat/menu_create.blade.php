@extends('admin.public.layout')
@push('headscripts')
    <link rel="stylesheet" href="{{ URL::asset('plugin/menu/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugin/menu/assets/css/font-awesome.min.css') }}">
    <!-- 自定义样式 -->
    <link rel="stylesheet" href="{{ URL::asset('plugin/menu/assets/css/wx-custom.css') }}">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
@endpush
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ route('menu.index') }}">公众号菜单列表</button>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ route('menu.create') }}">添加公众号菜单</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">添加公众号菜单</div>
                <div class="Role_list">
                    @include("admin.wechat.menu_form")
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footscripts')
    <script type="text/javascript">
        //显示自定义按钮组
        var obj = {"menu":{"button":[]}} ;
    </script>
    <script src="{{ URL::asset('plugin/menu/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ URL::asset('plugin/menu/assets/js/bootstrap.min.js') }}"></script>
    <!-- 自定义菜单排序 -->
    <script src="{{ URL::asset('plugin/menu/assets/js/Sortable.js') }}"></script>
    <script src="{{ URL::asset('plugin/menu/assets/js/menu.js') }}"></script>
    <script type="text/javascript">
        //保存
        function saveAjax(){
            var name = $("input[name=name]").val();
            if(!name){
                layer.alert("菜单名称不能为空");
            }else{
                $.ajax({
                    type: "POST",
                    url: "{{ route('menu.store') }}",
                    data : {
                        "menu" :JSON.stringify(obj) ,//先将对象转换为字符串再传给后台
                        "name" : name
                    },
                    dataType : "json",
                    beforeSend:function(){
                        layer.msg('菜单设置中', {
                            icon: 16
                            ,shade: 0.01
                            ,time:false
                        });
                    },
                    success : function(data) {
                        console.info(data);
                        if (data.errcode=='0') {
                            layer.msg('发布成功！',{icon:1,time:1500});
                            setTimeout(function(){
                                location.reload();
                            },1500);
                        } else {
                            layer.alert("发布失败，错误代码:"+data.errcode+"，错误提示："+data.errmsg);
                        }
                    },
                    error:function(e){
                        console.info(e);
                        layer.alert("请求失败");
                    }
                });
            }
        }
    </script>
    <div id="selectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span></button>
                    <h4 class="modal-title">选择图片</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="1" class="col-xs-4">
                            <div class="panel panel-default">
                                <div class="panel-heading msg-date">
                                    3月25日
                                </div>
                                <div class="panel-body">
                                    <h5 class="msg-title">如何使用？</h5>
                                    <div class="msg-img"><img src="/images/admin/bg.jpg" alt=""></div>
                                    <p class="msg-text">在当前系统添加微信素材，程序会自动通过关键字回复，请自行去实现（我太懒）！</p>
                                </div>
                                <div class="mask-bg"><div class="mask-icon"><i class="icon-ok"></i></div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info ensure">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <div id="reminderModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span></button>
                    <h4 class="modal-title">温馨提示</h4>
                </div>
                <div class="modal-body">
                    <h5>添加子菜单后，一级菜单的内容将被清除。确定添加子菜单？</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info reminder">确定</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
    <div id="abnormalModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span></button>
                    <h4 class="modal-title">温馨提示</h4>
                </div>
                <div class="modal-body">
                    <h5>数据异常</h5>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-info reminder">确定</button> -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
@endpush