<script type="text/javascript">
    /*刷新*/
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // 调整默认选择内容
        $("select").each(function (index, element) {
            $(element).find("option[value='"+$(this).attr('default')+"']").attr('selected','selected');
        });

        //表单搜索
        $("#input-search").bind('click',function () {
            $("input[name=export]").val(0);
            $("#searchForm").submit();
        });

        //表单导出
        $("#export").bind('click',function () {
            $("input[name=export]").val(1);
            $("#searchForm").submit();
        });

        //打开弹出层
        $(".btn-open").bind('click',function () {
            layer.closeAll();
            var url = $(this).attr('name');
            var title = $(this).attr('title');
            layer.open({
                type: 2,
                title: title,
                shadeClose: true,//开启遮罩关闭
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['70%', '80%'],
                content: url
            });
        });

        //添加和修改跳转方法
        $(".btn-redirect").click(function () {
            var url = $(this).attr('name');
            location.href = url;
            //loadUrl(url);
        });

        //页面刷新
        $(".flash").bind("click",function () {
            var iframe = $(window.parent.document).find("#iframe");
            var url = iframe.attr("src");
            loadUrl(url);
        });

        //删除跳转方法
        $(".btn-delete").click(function () {
            var url = $(this).attr('name');
            layer.confirm('你确定要删除吗？', function(index){
                location.href = url;
                layer.close(index);
            });
        });

        // $(function(){
        // 	if($.browser.msie && $.browser.version<=7.0) {
        // 	    alert('你的IE版本太低，请使用IE8以上IE版本或者使用Chrome内核的浏览器！');
        // 	}
        // });

        //排序数字点击显示
        $(".edit_order").on('click',"span",function () {
            $(this).siblings("input").show();
            $(this).hide();
            $(this).siblings("input").focus();
        });

        //排序触发input
        $(".edit_order").on('blur',"input",function () {
            $(this).hide();
            var table = $(this).parent().data("table");
            var key = $(this).parent().data("key");
            var id = $(this).parent().data("id");
            var value = $(this).val();
            var valueold = $(this).parent().data("value");
            var parent = $(this).parent(".edit_order");
            parent.html("").text("").append('<span style="width:40px;"><img src="{{ URL::asset('images/admin/loading.gif') }}"/></span>');
            $.ajax({
                type:'POST',
                url:'{{ url("admin.index.setFieldValue") }}',
                data:{table:table,key:key,value:value,id:id},
                dataType:'json',
                success:function(data){
                    if(data.code == 0){
                        layer.msg('操作成功',{icon:1,time:800});
                        parent.html("").text("").append('<span>'+value+'</span><input type="text" style="display: none;width: 60px;" name="order_id" value="'+value+'" />');
                    }else{
                        layer.msg('操作失败',{icon:2,time:800});
                        parent.html("").text("").append('<span>'+valueold+'</span><input type="text" style="display: none;width: 60px;" name="order_id" value="'+valueold+'" />');
                    }
                },
                error:function(e){
                    console.info(e);
                    layer.msg('请求失败，请稍后重试！');
                }
            });
        });

        //ajax显示触发
        $(".edit_show").on('click',"span",function () {
            if($(this).attr("class") == 'span-no'){
                var value = 1;
            }else{
                var value = 0;
            }
            var table = $(this).parent().data("table");
            var key = $(this).parent().data("key");
            var id = $(this).parent().data("id");
            var parent = $(this).parent(".edit_show");
            parent.html("").text("").append('<span style="width:40px;"><img src="{{ URL::asset('images/admin/loading.gif') }}"/></span>');
            $.ajax({
                type:'POST',
                url:'{{ url("admin.index.setFieldValue") }}',
                data:{table:table,key:key,value:value,id:id},
                dataType:'json',
                success:function(data){
                    if(data.code == 0){
                        layer.msg('操作成功',{icon:1,time:800});
                        if(value == 0){
                            parent.html("").text("").append('<span class="span-no"><img src="{{ URL::asset('images/admin/cancel.png') }}"/></span>');
                        }else{
                            parent.html("").text("").append('<span class="span-yes"><img src="{{ URL::asset('images/admin/yes.png') }}"/></span>');
                        }
                    }else{
                        layer.msg('操作失败',{icon:2,time:800});
                        if(value == 1){
                            parent.html("").text("").append('<span class="span-no"><img src="{{ URL::asset('images/admin/cancel.png') }}"/></span>');
                        }else{
                            parent.html("").text("").append('<span class="span-yes"><img src="{{ URL::asset('images/admin/yes.png') }}"/></span>');
                        }
                    }
                },
                error:function(e){
                    console.info(e);
                    layer.msg('请求失败，请稍后重试！');
                }
            });
        });

        //全选
        $("#checkbox").bind('click',function () {
            $("input[name=checkbox],input[name='checkbox[]']").each(function () {
                if($(this).prop("checked")){
                    $(this).prop("checked",'');
                }else{
                    $(this).prop("checked","checked");
                }
            });
        });

        //批量删除
        $("#mutidels").bind('click',function () {
            var ids = '';
            $("input[name=checkbox]").each(function () {
                if($(this).prop("checked")){
                    ids += ',' + $(this).data("id");
                }
            });
            var url = $(this).data("url");
            if(ids == ''){
                layer.msg('请选择要删除的数据',{icon:2,time:2000});
            }else{
                ids = ids.substr(1);
                layer.confirm('确定删除所选吗?', {
                        btn: ['是','否']
                    },
                    function(){
                        location.href = url + "?id=" + ids;
                    });
            }
        });

        //批量导出
        $("#mutiexcel").bind('click',function () {
            var ids = '';
            $("input[name=checkbox]").each(function () {
                if($(this).prop("checked")){
                    ids += ',' + $(this).data("id");
                }
            });
            var url = $(this).data("url");
            if(ids == ''){
                layer.confirm('确定导出所有数据吗?', {
                        btn: ['是','否']
                    },
                    function(){
                        location.href = url + "?ids=" + ids;
                    });
            }else{
                ids = ids.substr(1);
                layer.confirm('确定导出所选数据吗?', {
                        btn: ['是','否']
                    },
                    function(){
                        location.href = url + "?ids=" + ids;
                    });
            }
        });

        //开关特效
        $(".radio-box input").bind("click",function () {
            $(this).parent("label").toggleClass("selected").siblings("label").toggleClass("selected");
            $(this).parent("label").parent(".radio-box").find("label.selected").find("input").attr("checked",true);
        });

        //表单提交
        $("#submit-form").bind('submit', function () {
            $.ajax({
                type:$(this).attr('method') ? $(this).attr('method') : 'POST',
                url:$(this).attr('action'),
                data:$("#submit-form").serialize(),
                dataType:'json',
                success:function (data) {
                    if(data === true){
                        layer.msg('操作成功');
                        setTimeout(function () {
                            location.reload();
                        },1500);
                    }else{
                        if(data.code == 200){
                            layer.msg(data.msg);
                            setTimeout(function () {
                                location.reload();
                            },1500);
                        }else if(data.code == 101){
                            layer.msg(data.msg);
                        }else{
                            layer.msg('保存失败');
                        }
                    }
                },
                error:function (e) {
                    var message = $.parseJSON(e.responseText);
                    $(".ps").hide();
                    layer.msg(message.message);
                    $.each(message.errors,function (i,v) {
                        $(".s-validate-"+i).text(v[0]).show();
                    });
                }
            });
            return false;
        });
    });

    //加载条
    function loadUrl(url){
        var iframe = $(window.parent.document).find("#iframe");
        iframe.attr("src",url);
        iframe.hide();
        $(window.parent.document).find('#loader_container').css({"display":"block","visibility":"visible"});
        pos = 0;
        dir = 2;
        len = 0;
        window.clearInterval(parent.t_id);
        //window.parent.clearInterval(parent.t_id);
        parent.t_id = setInterval(window.parent.animate,20);
    }
    /*
     * 上传图片 后台专用
     * @access  public
     * @null int 一次上传图片多少张
     * @elementid string 上传成功后返回路径插入指定ID元素内
     * @path  string 指定上传保存文件夹,默认存在resources/upload/temp/目录
     * @callback string  回调函数(单张图片返回保存路径字符串，多张则为路径数组 )
     */
    function webuploader(num,elementId,path,callback){
        var upload_url = "{{ url('admin.upload.uploadPicture') }}" + '?num=' + num + '&elementId=' + elementId + '&path=' + path + '&callback=' + callback;
        layer.open({
            type: 2,
            title: '上传图片',
            shadeClose: true,//开启遮罩关闭
            shade: false,
            maxmin: true, //开启最大化最小化按钮
            area: ['50%', '60%'],
            content: upload_url
        });
    }
</script>