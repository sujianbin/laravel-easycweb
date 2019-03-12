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
            <th width="28%">权限资源</th>
            <td>
                <label>
                    <input id="all" type="checkbox"  value="" style="float: left;margin-left: 10px;"/>
                    <span style="float: left;">全选/反选</span>
                </label>
                <br/><br/>

                <dl class="purview" style="margin-left: 10px;">
                    <dt>
                        <label>
                            <input class="all" type="checkbox" value=""/>
                            <span>全选/反选（小说管理）</span>
                        </label>
                    </dt>

                    <dd>
                        <label>
                            <input name="right[]" type="checkbox" value="1" />
                            <span style="float: left;margin-right: 15px;">添加</span>
                        </label>
                        <label>
                            <input name="right[]" type="checkbox" value="1" />
                            <span style="float: left;margin-right: 15px;">修改</span>
                        </label>
                    </dd>
                </dl>

                <dl class="purview" style="margin-left: 10px;">
                    <dt>
                        <label>
                            <input class="all" type="checkbox"  value=""/>
                            <span>全选/反选（会员管理）</span>
                        </label>
                    </dt>

                    <dd>
                        <label>
                            <input name="right[]" type="checkbox" value="1" />
                            <span style="float: left;margin-right: 15px;">删除</span>
                        </label>
                        <label>
                            <input name="right[]" type="checkbox" value="1" />
                            <span style="float: left;margin-right: 15px;">修改</span>
                        </label>
                    </dd>
                </dl>

                <span class="ps">权限资源必选</span>
            </td>
        </tr>
    </tbody>
</table>