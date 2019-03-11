<table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
    <tbody>
        <tr>
            <th width="20%">资源名称</th>
            <td width="80%">
                @if(isset($info['name']))
                    <input type="text" style="width:300px" name="name" value="{{ $info['name'] }}"/>
                @else
                    <input type="text" style="width:300px" name="name" value=""/>
                @endif
                <br />
                <span class="ps s-validate-name">资源名称不能为空</span>
            </td>
        </tr>

        <tr>
            <th width="20%">所属分组</th>
            <td width="80%">
                <select name="group" style="margin-left: 10px;height:35px" @if(isset($info['group'])) default="{{ $info['group'] }}" @endif>
                    @foreach (right_group() as $k=>$v)
                        <optgroup label="|--{{ $v['name'] }}">
                            @foreach ($v['menu'] as $k1=>$v1)
                                <optgroup label="|----{{ $v1['name'] }}">
                                    @foreach ($v1['item'] as $k2=>$v2)
                                        <option value="{{ $k.'@'.$k1.'@'.$k2 }}">|------{{ $v2 }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                <br />
                <span class="ps s-validate-group">请选择所属分组</span>
            </td>
        </tr>

        <tr>
            <th width="20%">权重</th>
            <td width="80%">
                @if(isset($info['order_id']))
                    <input type="text" style="width:56px;text-align: center;" name="order_id" value="{{ $info['order_id'] }}"/>
                @else
                    <input type="text" style="width:56px;text-align: center;" name="order_id" value="1000"/>
                @endif
                <br />
                <span class="ps s-validate-order_id">权重必须为1-999999之间的数字</span>
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

                    @if(isset($info['right']))
                        @foreach(explode(';',$info['right']) as $v)
                            <tr width="900" class="move">
                                <td style="float: left;">
                                    <input type="text" style="width: 500px;" class="s-right" name="right[]" value="{{ $v }}"/>
                                </td>
                                <td>
                                    <input type="button" class="btnOther" onclick="del_item(this)" value="取消"/>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </table>
                <span class="ps s-validate-right">权限码不能为空</span>
            </td>
        </tr>

    </tbody>
</table>
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
                data:{},
                dataType:'json',
                success:function (data) {
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
                    },
                    dataType:'json',
                    success:function(data){
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