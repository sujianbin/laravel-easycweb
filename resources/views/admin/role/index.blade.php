@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ url('admin/role/index') }}">角色列表</button>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ url('admin/role/add') }}">添加角色</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">角色列表</div>
                <div class="Role_list">
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
                                        <button type="button" class="btn btn-primary btn-redirect" name="{{ url('admin/role/edit',['id'=>$vo['id']]) }}">修改</button>
                                        <button type="button" class="btn btn-warning btn-delete" name="{{ url('admin/role/destory',['id'=>$vo['id']]) }}">删除</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $lists->links() }}
                    <div class="all-operate">
                        <label class="list-all-check"><input type="checkbox" id="checkbox"/><em>全选/反选</em></label>
                        <button id="mutidels" data-url="{{ url('admin/role/destory') }}">批量删除</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection