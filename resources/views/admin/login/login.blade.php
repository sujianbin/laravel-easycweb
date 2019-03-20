<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统登录</title>
    <meta name="keywords" content="后台登录">
    <meta name="description" content="后台登录">
    <meta name="author" content="sujianbin.com,sujianbin891547860@163.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/admin/login.css') }}?v=1">
    <script type="text/javascript" src="{{ URL::asset('js/admin/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugin/layer/layer.js') }}"></script>
    <link rel="shortcut icon" href="{{ URL::asset('images/admin/favicon.ico') }}">
</head>
<body>
<div class="login">
    <div class="title">后台管理系统</div>
    <div class="login_m">
        <form name="myform" action="" method="post" id="loginForm">
            <div class="login_boder">
                <div class="login_padding">
                    <label>
                        <input type="text" name="username" placeholder="请输入账号" class="txt_input txt_input2" autocomplete="off" value=''/>
                    </label>
                    <label>
                        <input size="" type="password" name="pwd" onpaste="return false" ondrop="return false" class="txt_input txt_input2" autocomplete="off" placeholder="请输入密码"/>
                    </label>
                    <label>
                        <input type="text" name="code" class="txt_input txt_input2" style="width: 50%;" placeholder="验证码" oncontextmenu="return false" onpaste="return false" />
                        <span class="code" style="float: right;">
				            	<img src="{{ captcha_src() }}" width="140" height="37" onclick="vertify();">
				            </span>
                    </label>
                    <div class="rem_sub">
                        <label>
                            {!! csrf_field() !!}
                            <input type="submit" id="s-login" class="sub_button" name="button" value="登录" style="opacity: 0.7;">
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function(){
        var w = $(".title").width()/2;
        $(".title").css("margin-left","-"+w+"px");
        $("#loginForm").on("submit",function(){
            $("#s-login").attr("disabled",true);
            var username = $("input[name=username]").val(),
                pwd = $("input[name=pwd]").val(),
                code = $("input[name=code]").val();
            if($.trim(username) == ''){
                layer.msg("用户名不能为空");
                $("#s-login").removeAttr("disabled");
                return false;
            }else if($.trim(pwd) == ''){
                layer.msg("密码不能为空");
                $("#s-login").removeAttr("disabled");
                return false;
            }else if($.trim(code) == ''){
                layer.msg("验证码不能为空");
                $("#s-login").removeAttr("disabled");
                return false;
            }else{
                $.ajax({
                    url:'{{ url("admin/login") }}',
                    type:'POST',
                    data:$("#loginForm").serialize(),
                    dataType:'json',
                    success:function(data){
                        if(data.code == 200){
                            layer.msg('验证成功', {
                                icon: 16,shade: 0.01
                            },1000);
                            setTimeout(function(){
                                location.href = '{{ url('admin/index') }}';
                            },1000);
                        }else{
                            layer.msg(data.msg);
                            //if(data.code == 101) vertify();
                            vertify();
                            $("#s-login").removeAttr("disabled");
                        }
                    },
                    error:function(e){
                        //console.info(e);
                        vertify();
                        layer.msg("请求失败，请稍后重试！");
                        $("#s-login").removeAttr("disabled");
                    }
                });
            }
            return false;
        });
    });
    function vertify(){
        $(".code").find("img").attr("src","{{ captcha_src() }}&num="+Math.random());
    }
</script>
</html>