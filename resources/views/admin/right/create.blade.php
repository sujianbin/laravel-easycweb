@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ url('admin/rights') }}">权限列表</button>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ url('admin/rights/create') }}">添加权限</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">添加权限</div>
                <div class="Role_list">
                    <form id="submit-form" name="myform" action="{{ route('rights.store') }}" method="post">
                        @include("admin.right.form")
                        <div class="btn_operating">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary btn-submit"/>
                            <input type="reset" class="btn btn-warning"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection