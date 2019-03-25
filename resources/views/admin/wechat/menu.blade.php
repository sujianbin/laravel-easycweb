@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ route('menu.index') }}">公众号菜单列表</button>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ route('menu.create') }}">添加公众号菜单</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">公众号菜单列表</div>
                <div class="Role_list">
                    <table id="Role_list" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>菜单名称</th>
                                <th>是否生效</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $vo)
                                <tr>
                                    <td>{{ $vo['id'] }}</td>
                                    <td>{{ $vo['name'] }}</td>
                                    <td>
                                        @if($vo['status'] == 1)
                                            <span style="color: #079200!important;">菜单生效中</span>
                                        @else
                                            <a href="{{ url('admin/wechat/menuEffective',['id'=>$vo['id']]) }}" style="color: #428bca!important;">生效并置顶</a>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-redirect" name="{{ route('menu.edit',['id'=>$vo['id']]) }}">修改</button>
                                        <button type="button" class="btn btn-warning btn-delete" name="{{ route('menu.destroy',['id'=>$vo['id']]) }}">删除</button>
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