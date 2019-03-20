@extends('admin.public.layout')
@section('content')
<div class="page-content">
    <div class="Role_Manager_style">
        <div class="Manager_style">
            <div class="title_name">菜单列表</div>
            <a href="javascript:location.reload();" class="flash" title="刷新"></a>
            <button  type="button" class="btn btn-primary btn-redirect" name="{{ url('admin/config/config') }}">基本设置</button>
        </div>
        <div class="Manager_style">
            <div class="title_name">基本设置</div>
            <div class="Role_list">
                <form id="submit-form" name="myform" action="{{ url('admin/config/config') }}" method="POST">
                    <table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
                        <tbody>

                            <tr>
                                <th width="20%">网站标题</th>
                                <td width="80%">
                                    <input type="text" style="width:40%;" name="seo_title" value="{{ $info['seo_title'] }}">
                                    <br/><span class="ps">首页标题栏显示,不超过32个字符</span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">网站关键字</th>
                                <td width="80%">
                                    <input type="text" style="width:80%;" name="seo_keywords" value="{{ $info['seo_keywords'] }}">
                                    <br /><span class="ps">推荐3-5个关键词，关键词之间用英文逗号,分开</span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">网站描述</th>
                                <td width="80%">
                                    <textarea style="width:80%; height:100px;" name="seo_description">{{ $info['seo_description'] }}</textarea>
                                    <br><span class="ps">不超过255个字符，一般显示在搜索引擎首页描述里</span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">公司logo</th>
                                <td width="80%">
                                    <div class="y-onlinemanage">
                                        <div class="y-file-list">
                                            <ul class="clearfix">
                                                <ul class="s-file-list" id="logo">
                                                    @if(!empty($info['logo']))
                                                        <li class="file">
                                                            <div class="file-panel">
                                                                <span class="cancel">删除</span>
                                                            </div>
                                                            <div class="img">
                                                                <img src="{{ $info['logo'] }}" alt="">
                                                            </div>
                                                            <span class="icon"></span>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <li class="file y-addpho js-uploadBox" onclick="webuploader(1,'logo','tmp','');">
                                                    <div class="adp">
                                                        <h1>+</h1>
                                                        <p>上传图片</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <br />
                                    <span class="ps" >图片建议大小805*95</span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">ico图标</th>
                                <td width="80%">
                                    <div class="y-onlinemanage">
                                        <div class="y-file-list">
                                            <ul class="clearfix">
                                                <ul class="s-file-list" id="ico">
                                                    @if(!empty($info['ico']))
                                                        <li class="file">
                                                            <div class="file-panel">
                                                                <span class="cancel">删除</span>
                                                            </div>
                                                            <div class="img">
                                                                <img src="{{ $info['ico'] }}" alt="">
                                                            </div>
                                                            <span class="icon"></span>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <li class="file y-addpho js-uploadBox" onclick="webuploader(1,'ico','tmp','');">
                                                    <div class="adp">
                                                        <h1>+</h1>
                                                        <p>上传图片</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <br />
                                    <span class="ps" >图片建议大小805*95</span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">地址</th>
                                <td width="80%">
                                    <input type="text" style="width:40%;" name="address" value="{{ $info['address'] }}">
                                    <br /><span class="ps"></span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">电话</th>
                                <td width="80%">
                                    <input type="text" style="width:40%;" name="phone" value="{{ $info['phone'] }}">
                                    <br /><span class="ps"></span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">邮箱</th>
                                <td width="80%">
                                    <input type="text" style="width:40%;" name="email" value="{{ $info['email'] }}">
                                    <br /><span class="ps"></span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">版权所有</th>
                                <td width="80%">
                                    <textarea style="width:80%; height:100px;" name="copyright">{{ $info['copyright'] }}</textarea>
                                    <br /><span class="ps"></span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">其他代码</th>
                                <td width="80%">
                                    <textarea style="width:80%; height:100px;" name="other_code">{{ $info['other_code'] }}</textarea>
                                    <br /><span class="ps">可放置流量统计、百度商桥代码等</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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