@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ route('role.index') }}">角色列表</button>
                <button  type="button" class="btn btn-primary btn-redirect btn-current" name="{{ route('role.create') }}">添加角色</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">编辑角色</div>
                <div class="Role_list">
                    <form name="myform" action="{{ route('role.store') }}" method="post">
                        <table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
                            <tbody>
                            <tr>
                                <th width="20%">角色名称</th>
                                <td width="80%"><input type="text" style="width:300px" name="role_name" value=""/>
                                    <br />
                                    <span class="ps">角色名称不能为空</span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">角色描述</th>
                                <td width="80%"><textarea style="width:80%; height:100px;" name="role_description"></textarea><br /><span class="ps">角色描述不能为空</span></td>
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
                                                <span>小说管理</span>
                                            </label>
                                        </dt>

                                        <dt style="overflow: hidden;border-left: 1px solid #ddd;">
                                            <label>
                                                <input class="all" type="checkbox" value=""/>
                                                <span>小说管理</span>
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
                                                <input class="all" type="checkbox" value=""/>
                                                <span>小说管理</span>
                                            </label>
                                        </dt>

                                        <dt style="overflow: hidden;border-left: 1px solid #ddd;">
                                            <label>
                                                <input class="all" type="checkbox" value=""/>
                                                <span>小说管理</span>
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

                                    <span class="ps">权限资源必选</span>
                            </tr>
                            </tbody>
                        </table>

                        <div class="btn_operating">
                            <input  type="submit" class="btn btn-primary btn-submit"/>
                            <input  type="reset" class="btn btn-warning"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
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