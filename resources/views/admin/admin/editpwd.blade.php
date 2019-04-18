@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style" style="display: none;">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ route('admin.index') }}">管理员列表</button>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ route('admin.create') }}">添加管理员</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">修改密码</div>
                <div class="Role_list">
                    <form id="submit-form" name="myform" action="" method="post">
                        <table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
                            <tbody>

                                <tr>
                                    <th width="20%">用户名</th>
                                    <td width="80%">
                                        <input type="text" style="width:300px" readonly disabled name="username" value="{{ Auth::guard('admin')->user()->username }}"/>
                                        <br />
                                        <span class="ps s-validate-password"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="20%">旧密码</th>
                                    <td width="80%">
                                        <input type="password" style="width:300px" name="old_password" value=""/>
                                        <br />
                                        <span class="ps s-validate-old_password"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="20%">新密码</th>
                                    <td width="80%">
                                        <input type="password" style="width:300px" name="password" value=""/>
                                        <br />
                                        <span class="ps s-validate-password"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="20%">确认密码</th>
                                    <td width="80%">
                                        <input type="password" style="width:300px" name="password1" value=""/>
                                        <br />
                                        <span class="ps s-validate-password"></span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="btn_operating">
                            {{ csrf_field() }}
                            <input  type="submit" class="btn btn-primary btn-submit"/>
                            <input  type="reset" class="btn btn-warning"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection