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
                                    @if(isset($info['seo_title']))
                                        <input type="text" style="width:40%;" name="seo_title" value="{{ $info['seo_title'] }}" />
                                    @else
                                        <input type="text" style="width:40%;" name="seo_title" value="" />
                                    @endif
                                    <br/><span class="ps">首页标题栏显示,不超过32个字符</span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">网站关键字</th>
                                <td width="80%">
                                    @if(isset($info['seo_keywords']))
                                        <input type="text" style="width:80%;" name="seo_keywords" value="{{ $info['seo_keywords'] }}" />
                                    @else
                                        <input type="text" style="width:80%;" name="seo_keywords" value="" />
                                    @endif
                                    <br /><span class="ps">推荐3-5个关键词，关键词之间用英文逗号,分开</span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">网站描述</th>
                                <td width="80%">
                                    @if(isset($info['seo_description']))
                                        <textarea style="width:80%; height:100px;" name="seo_description">{{ $info['seo_description'] }}</textarea>
                                    @else
                                        <textarea style="width:80%; height:100px;" name="seo_description"></textarea>
                                    @endif
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
                                                    @if(isset($info['logo']) && !empty($info['logo']))
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
                                                <li class="file y-addpho js-uploadBox" onclick="webuploader(1,'logo','config','');">
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
                                                <li class="file y-addpho js-uploadBox" onclick="webuploader(1,'ico','config','');">
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
                                <th width="20%">多图(测试)</th>
                                <td width="80%">
                                    <div class="y-onlinemanage">
                                        <label style="color: red;">*拖动图片可排序</label>
                                        <div class="y-file-list">
                                            <ul class="clearfix">
                                                <ul class="s-file-list" id="goods_image">
                                                    @if(isset($info['goods_image']) && !empty($info['goods_image']))
                                                        @foreach (explode(';',$info['goods_image']) as $v)
                                                            <li class="file">
                                                                <div class="file-panel">
                                                                    <span class="cancel">删除</span>
                                                                </div>
                                                                <div class="img">
                                                                    <img src="{{ $v }}" alt="">
                                                                </div>
                                                                <input type="hidden" name="goods_image[]" value="{$v}" />
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <script type="text/javascript">
                                                    layer.ready(function(){
                                                        layer.photos({
                                                            photos: $("#goods_image"),
                                                            anim: 0 //0-6的选择，指定弹出图片动画类型，默认随机
                                                        });
                                                    });
                                                </script>
                                                <li class="file y-addpho js-uploadBox" onclick="webuploader(20,'goods_image','goods','');">
                                                    <div class="adp">
                                                        <h1>+</h1>
                                                        <p>上传多图</p>
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
                                <th width="20%">编辑器（测试）</th>
                                <td width="80%">
                                    <div class="content">
                                        <script id="detail" name="detail" type="text/plain"></script>
                                        <br />
                                        <span class="ps">编辑器内容测试</span>
                                        <script type="text/javascript">
                                            var ue = UE.getEditor('detail');
                                            ue.ready(function() {
                                                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                                            });
                                        </script>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">地址</th>
                                <td width="80%">
                                    @if(isset($info['address']))
                                        <input type="text" style="width:40%;" name="address" value="{{ $info['address'] }}" />
                                    @else
                                        <input type="text" style="width:40%;" name="address" value="" />
                                    @endif
                                    <br /><span class="ps"></span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">电话</th>
                                <td width="80%">
                                    @if(isset($info['phone']))
                                        <input type="text" style="width:40%;" name="phone" value="{{ $info['phone'] }}" />
                                    @else
                                        <input type="text" style="width:40%;" name="phone" value="" />
                                    @endif
                                    <br /><span class="ps"></span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">邮箱</th>
                                <td width="80%">
                                    @if(isset($info['email']))
                                        <input type="text" style="width:40%;" name="email" value="{{ $info['email'] }}" />
                                    @else
                                        <input type="text" style="width:40%;" name="email" value="" />
                                    @endif
                                    <br /><span class="ps"></span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">版权所有</th>
                                <td width="80%">
                                    @if(isset($info['copyright']))
                                        <textarea style="width:80%; height:100px;" name="copyright">{{ $info['copyright'] }}</textarea>
                                    @else
                                        <textarea style="width:80%; height:100px;" name="copyright"></textarea>
                                    @endif
                                    <br /><span class="ps"></span>
                                </td>
                            </tr>

                            <tr>
                                <th width="20%">其他代码</th>
                                <td width="80%">
                                    @if(isset($info['other_code']))
                                        <textarea style="width:80%; height:100px;" name="other_code">{{ $info['other_code'] }}</textarea>
                                    @else
                                        <textarea style="width:80%; height:100px;" name="other_code"></textarea>
                                    @endif
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