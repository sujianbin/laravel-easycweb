@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ route('role.index') }}">角色列表</button>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ route('role.create') }}">添加角色</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">角色列表</div>
                <div class="Role_list">
                    <span style="float: right;color: red;margin-bottom: 5px;">超级管理员权限不可修改和删除</span>
                    <table id="Role_list" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>选择</th>
                                <th>ID</th>
                                <th>角色名称</th>
                                <th>描述</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $vo)
                                <tr>
                                    <td><input type="checkbox" name="checkbox" data-id="{{ $vo['id'] }}"/></td>
                                    <td>{{ $vo['id'] }}</td>
                                    <td>{{ $vo['role_name'] }}</td>
                                    <td>{{ $vo['role_description'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-redirect">修改</button>
                                        @if($vo['id'] != 1)
                                            <button type="button" class="btn btn-warning btn-delete" data-id="{{ $vo['id'] }}" name="{{ route('role.destroy',['id'=>$vo['id']]) }}">删除</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $lists->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection