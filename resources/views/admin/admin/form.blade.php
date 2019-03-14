<table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
    <tbody>
        <tr>
            <th width="20%">用户名</th>
            <td width="80%">
                @if(isset($info['username']))
                    <input type="text" style="width:300px" name="username" value="{{ $info['username'] }}"/>
                @else
                    <input type="text" style="width:300px" name="username" value=""/>
                @endif
                <br />
                <span class="ps s-validate-username">用户名不能为空</span>
            </td>
        </tr>

        <tr>
            <th width="20%">真实姓名</th>
            <td width="80%">
                @if(isset($info['realname']))
                    <input type="text" style="width:300px" name="realname" value="{{ $info['realname'] }}"/>
                @else
                    <input type="text" style="width:300px" name="realname" value=""/>
                @endif
                <br />
                <span class="ps s-validate-realname">真实姓名不能为空</span>
            </td>
        </tr>

        <tr>
            <th width="20%">登录密码</th>
            <td width="80%">
                <input type="password" style="width:300px" name="password" value=""/>
                <br />
                <span class="ps s-validate-password">@if(isset($info['id'])) 不修改密码则无需填写 @else 不填写默认为123456 @endif</span>
            </td>
        </tr>

        <tr>
            <th width="20%">所属角色</th>
            <td width="80%">
                <select name="role_id" style="margin-left: 10px;height:35px" @if(isset($info['role_id'])) default="{{ $info['role_id'] }}" @endif>
                    @foreach($roles as $vo)
                        <option value="{{ $vo['id'] }}">{{ $vo['role_name'] }}</option>
                    @endforeach
                </select>
                <br />
                <span class="ps s-validate-role_id">请选择所属角色</span>
            </td>
        </tr>

    </tbody>
</table>