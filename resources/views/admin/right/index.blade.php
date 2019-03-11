@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ url('admin/rights/index') }}">权限列表</button>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ url('admin/rights/add') }}">添加权限</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">权限列表</div>
                <div class="Role_list">
                    <form action="" method="get">
                        <div class="controlsWrap">
                            <div class="mainWrap">
                                <section class="v-block">
                                    <label class="v-lab">资源名称</label>
                                    <input class="v-inp" type="text" name="name" value="{{ request()->input('name') }}" placeholder="资源名称" />
                                </section>
                                <section class="v-block">
                                    <label class="v-lab">所属分组</label>
                                    <select name="groups" class="v-sel" default="0">
                                        <option value="0">全部</option>
                                    </select>
                                </section>
                            </div>
                            <div class="RightWrap">
                                <button class="input-search" type="submit">搜索</button>
                            </div>
                        </div>
                    </form>
                    <table id="Role_list" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>选择</th>
                                <th>ID</th>
                                <th>名称</th>
                                <th>资源类型</th>
                                <th>所属分组</th>
                                <th>权限码</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $vo)
                                <tr>
                                    <td><input type="checkbox" name="checkbox" data-id="{{ $vo['id'] }}"/></td>
                                    <td>{{ $vo['id'] }}</td>
                                    <td>{{ $vo['name'] }}</td>
                                    <td>{{ $vo['type'] }}</td>
                                    <td>分组</td>
                                    <td>{{ $vo['right'] }}</td>
                                    <td class="edit_order" data-table="system_right" data-id="{{ $vo['id'] }}" data-value="{{ $vo['order_id'] }}" data-key="order_id">
                                        <span>{{ $vo['order_id'] }}</span>
                                        <input type="text" name="order_id" style="width: 60px;display: none;" class="edit_order_input" value="{$vo['order_id']}" />
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-redirect" name="{{ url('admin/rights/edit',['id'=>$vo['id']]) }}">修改</button>
                                        <button type="button" class="btn btn-warning btn-delete" name="{{ url('admin/rights/destory',['id'=>$vo['id']]) }}">删除</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $lists->links() }}
                    <div class="all-operate">
                        <label class="list-all-check"><input type="checkbox" id="checkbox"/><em>全选/反选</em></label>
                        <button id="mutidels" data-url="{{ url('admin/rights/destory') }}">批量删除</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection