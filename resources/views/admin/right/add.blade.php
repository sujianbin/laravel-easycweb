@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ url('admin/rights/index') }}">权限列表</button>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ url('admin/rights/add') }}">添加权限</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">添加权限</div>
                <div class="Role_list">
                    <form id="submit-form" name="myform" action="{{ url('admin.rights.update') }}" method="post">
                        <table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
                            <tbody>

                                <tr>
                                    <th width="20%">资源名称</th>
                                    <td width="80%"><input type="text" style="width:300px" name="name" value=""/>
                                        <br />
                                        <span class="ps">资源名称不能为空</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="20%">所属分组</th>
                                    <td width="80%">
                                        <select name="group" style="margin-left: 10px;height:35px">

                                        </select>
                                        <br />
                                        <span class="ps">请选择所属分组</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="20%">排序</th>
                                    <td width="80%"><input type="text" name="order_id" value="1000" style="width:56px;text-align: center;">
                                        <br />
                                        <span class="ps">排序必须为1-999999之间的数字</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="20%">权限码操作</th>
                                    <td width="80%">
                                        <select name="controller" style="margin-left: 10px;height:35px">
                                            <option value="">请选择控制器</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="28%">方法集合</th>
                                    <td>
                                        <label>
                                            <input id="all" type="checkbox"  value="" style="float: left;margin-left: 10px;"/>
                                            <span style="float: left;" >全选/反选</span>
                                        </label>
                                        <br/><br/>

                                        <dl class="purview" style="margin-left: 10px;border-right: none;">

                                            <dd style="border-left:none;" id="s-method-list">

                                            </dd>

                                        </dl>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="20%" style="text-align: center;">权限码</td>
                                    <td width="80%">
                                        <table class="gridtable" style="margin-left: 10px;border:1px solid #E0D7D7;">
                                            <tr width="900"><th width="202">权限码</th><th>操作</th></tr>

                                            <tr width="900" class="move">
                                                <td style="float: left;">
                                                    <input type="text" style="width: 500px;" class="s-right" name="right[]" value="1"/>
                                                </td>
                                                <td>
                                                    <input type="button" class="btnOther" onclick="del_item(this)" value="取消"/>
                                                </td>
                                            </tr>

                                            <tr width="900" class="move">
                                                <td style="float: left;">
                                                    <input type="text" style="width: 500px;" class="s-right" name="right[]" value="2"/>
                                                </td>
                                                <td>
                                                    <input type="button" class="btnOther" onclick="del_item(this)" value="取消"/>
                                                </td>
                                            </tr>

                                        </table>
                                        <span class="ps">权限码不能为空</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="btn_operating">
                            <input type="submit" class="btn btn-primary btn-submit"/>
                            <input type="reset" class="btn btn-warning"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footscripts')
    <script type="text/javascript">
        $("#all").bind("click",function(){
            $("#s-method-list").find("input").each(function(){
                if($(this).attr("checked")){
                    this.checked = false;
                }else{
                    this.checked = true;
                }
            });
            add_item();
        });
        function add_item(){
            var c = $("select[name=controller] option:selected").val(),
                a = [],
                html = '';
            $('.gridtable .s-right').each(function(i,o){
                if($(o).val() != ''){
                    a.push($(o).val());
                }
            });
            $("#s-method-list").find("input").each(function(){
                if($(this).attr("checked")){
                    var m = $(this).val();
                    var v = c + '@' + m;
                    if($.inArray(v,a) === -1){
                        html += '<tr width="900" class="move">'+
                            '<td style="float: left;">'+
                            '<input type="text" style="width: 500px;" class="s-right" name="right[]" value="'+v+'"/>'+
                            '</td>'+
                            '<td>'+
                            '<input type="button" class="btnOther" onclick="del_item(this)" value="取消"/>'+
                            '</td>'+
                            '</tr>';
                    }
                }else{
                    var m = $(this).val();
                    var v = c + '@' + m;
                    if($.inArray(v,a) != -1){
                        del_item("input[name='right[]'][value='"+v+"']");
                    }
                }
            });
            $(".gridtable").append(html);
        }

        function del_item(e){
            $(e).parents("tr.move").remove();
        }

        $(function(){
            $.ajax({
                type:'POST',
                url:"{{ url('admin/rights/getAllController') }}",
                data:{
                    _token:'{{ csrf_token() }}'
                },
                dataType:'json',
                success:function (data) {
                    console.info(data);
                    $.each(data, function (i,v) {
                        $("select[name=controller]").append('<option value="'+v+'">'+v+'</option>');
                    });
                },
                error:function (e) {
                    console.info(e);
                    layer.msg('请求失败');
                }
            });

            $("select[name=controller]").bind("change",function(){
                var c = $(this).val();
                $.ajax({
                    url:"{{ url('admin/rights/getControllerMethod') }}",
                    type:'POST',
                    data:{
                        controller:c,
                        _token:'{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(data){
                        console.info(data);
                        var html = '';
                        $.each(data, function (i,v) {
                            html += '<label onclick="add_item();"> <input type="checkbox" value="'+v+'" /><span style="float: left;margin-right: 15px;">'+v+'</span> </label>';
                        });
                        $("#s-method-list").html(html);
                    },
                    error:function(e){
                        console.info(e);
                        layer.msg('请求失败');
                    }
                });
            });
        });
    </script>
@endpush