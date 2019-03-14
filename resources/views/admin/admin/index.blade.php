@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ route('admin.index') }}">管理员列表</button>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ route('admin.create') }}">添加管理员</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">管理员列表</div>
                <div class="Role_list">
                    <table id="Role_list" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>选择</th>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>真实姓名</th>
                                <th>所属角色</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $vo)
                                <tr>
                                    <td><input type="checkbox" name="checkbox" data-id="{{ $vo['id'] }}"/></td>
                                    <td>{{ $vo['id'] }}</td>
                                    <td>{{ $vo['username'] }}</td>
                                    <td>{{ $vo['realname'] }}</td>
                                    <td>{{ $vo->role->role_name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-redirect" name="{{ route('admin.edit',['id'=>$vo['id']]) }}">修改</button>
                                        <button type="button" class="btn btn-warning btn-delete" name="{{ url('admin/admin/destory',['id'=>$vo['id']]) }}">删除</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $lists->links() }}
                    <div class="all-operate">
                        <label class="list-all-check"><input type="checkbox" id="checkbox"/><em>全选/反选</em></label>
                        <button id="mutidels" data-url="{{ url('admin/admin/destory') }}">批量删除</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection