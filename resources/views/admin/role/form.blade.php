<table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
    <tbody>
        <tr>
            <th width="20%">角色名称</th>
            <td width="80%">
                @if(isset($info['role_name']))
                    <input type="text" style="width:300px" name="role_name" value="{{ $info['role_name'] }}"/>
                @else
                    <input type="text" style="width:300px" name="role_name" value=""/>
                @endif
                <br />
                <span class="ps s-validated-role_name">角色名称不能为空</span>
            </td>
        </tr>

        <tr>
            <th width="20%">角色描述</th>
            <td width="80%">
                <textarea style="width:80%; height:100px;" name="role_description">@if(isset($info['role_description'])){{ $info['role_description'] }}@endif</textarea>
                <br />
                <span class="ps s-validated-role_description">角色描述不能为空</span>
            </td>
        </tr>

        <tr>
            <th width="20%">权限资源</th>
            <td>
                <label>
                    <input id="all" type="checkbox"  value="" style="float: left;margin-left: 10px;"/>
                    <span style="float: left;">全选/反选</span>
                </label>
                <br/><br/>

                @foreach(right_group_rights() as $k=>$v)
                    @foreach($v['menu'] as $k1=>$v1)
                        <dl class="purview" style="margin-left: 10px;">
                            <dt style="width:15%;">
                                <label>
                                    <input class="all" type="checkbox" value=""/>
                                    <span>{{ $v1['name'] }}</span>
                                </label>
                            </dt>

                            <dt style="overflow: hidden;border-left: 1px solid #ddd;width: 75%;">
                                @foreach($v1['item'] as $k2=>$v2)
                                    <div class="s-right" style="border-bottom: 1px solid #ddd;">
                                        <label>
                                            <input class="all" type="checkbox" value=""/>
                                            <span>{{ $v2 }}</span>
                                        </label>

                                        <div style="margin-left: 20px;">
                                            @if(isset($v1[$k2.'_rights']))
                                                @foreach($v1[$k2.'_rights'] as $k3=>$v3)
                                                    <label>
                                                        <input name="right[]" type="checkbox" value="{{ $k3 }}" />
                                                        <span style="float: left;margin-right: 15px;">{{ $v3 }}</span>
                                                    </label>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </dt>
                        </dl>
                    @endforeach
                @endforeach
                <span class="ps">权限资源必选</span>
            </td>
        </tr>

    </tbody>
</table>
@push('footscripts')
    <script type="text/javascript">
        $(function(){
            $("#all").bind("click",function(){
                $("input[name='right[]']").each(function(){
                    if($(this).attr("checked")){
                        this.checked = false;
                    }else{
                        this.checked = true;
                    }
                });
            });
            $(".all").bind("click",function(){
                $(this).parents("dl.purview").find("input[name='right[]']").each(function(){
                    if($(this).attr("checked")){
                        this.checked = false;
                    }else{
                        this.checked = true;
                    }
                });
            });
        });
    </script>
@endpush