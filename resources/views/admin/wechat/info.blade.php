@extends('admin.public.layout')
@section('content')
    <div class="page-content">
        <div class="Role_Manager_style">
            <div class="Manager_style">
                <div class="title_name">菜单列表</div>
                <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                <button  type="button" class="btn btn-primary btn-redirect" name="{{ url('admin/wechat/info') }}">基本信息</button>
            </div>
            <div class="Manager_style">
                <div class="title_name">基本信息</div>
                <div class="Role_list">
                    <form id="submit-form" name="myform" action="" method="POST">
                        <table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
                            <tbody>

                                <tr>
                                    <th width="20%">APPID</th>
                                    <td width="80%">
                                            <input type="text" style="width:40%;" name="APPID" value="{{ env('WECHAT_OFFICIAL_ACCOUNT_APPID') }}" readonly/>
                                        <br/><span class="ps"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="20%">SECRET</th>
                                    <td width="80%">
                                        <input type="text" style="width:40%;" name="SECRET" value="{{ env('WECHAT_OFFICIAL_ACCOUNT_SECRET') }}" readonly/>
                                        <br/><span class="ps"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="20%">TOKEN</th>
                                    <td width="80%">
                                        <input type="text" style="width:40%;" name="TOKEN" value="{{ env('WECHAT_OFFICIAL_ACCOUNT_TOKEN') }}" readonly/>
                                        <br/><span class="ps"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="20%">AES_KEY</th>
                                    <td width="80%">
                                        <input type="text" style="width:40%;" name="AES_KEY" value="{{ env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY') }}" readonly/>
                                        <br/><span class="ps"></span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection