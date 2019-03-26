<table id="Role_list1" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-m">
    <tr>
        <th width="20%">菜单名称</th>
        <td width="80%">
            @if(isset($info['name']))
                <input type="text" style="width:300px" name="name" value="{{ $info['name'] }}"/>
            @else
                <input type="text" style="width:300px" name="name" value=""/>
            @endif
            <br />
            <span class="ps s-validated-name">菜单名称不能为空</span>
        </td>
    </tr>
</table>
<div class="container">
    <!-- 自定义菜单 -->
    <h3>自定义菜单</h3>
    <div class="custom-menu-edit-con">
        <div class="hbox">
            <div class="inner-left">
                <div class="custom-menu-view-con">
                    <div class="custom-menu-view">
                        <div class="custom-menu-view__title">微信公众号</div>
                        <div class="custom-menu-view__body">
                            <div class="weixin-msg-list"><ul class="msg-con"></ul></div>
                        </div>
                        <div id="menuMain" class="custom-menu-view__footer">
                            <div class="custom-menu-view__footer__left"></div>
                            <div class="custom-menu-view__footer__right" ></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-right">
                <div class="cm-edit-after">
                    <div class="cm-edit-right-header b-b"><span id="cm-tit"></span> <a id="delMenu" class="pull-right" href="javascript:;">删除菜单</a></div>
                    <form class="form-horizontal wrapper-md" name="custom_form">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">菜单名称:</label><div class="col-sm-5">
                                <input name="custom_input_title" type="text" class="form-control" ng-model="menuname" value="" placeholder="" ng-maxlength="5"></div><div class="col-sm-5 help-block">
                                <div ng-show="custom_form.custom_input_title.$dirty&&custom_form.custom_input_title.$invalid-maxlength">字数不超过5个汉字或16个字符</div>
                                <div class="font_sml" style="display: none;">若无二级菜单，可输入20个汉字或60个字符</div>
                            </div>
                        </div>
                        <div class="form-group" id="radioGroup">
                            <label class="col-sm-2 control-label">菜单内容:</label>
                            <div class="col-sm-10 LebelRadio">
                                <label class="checkbox-inline"><input type="radio" name="radioBtn" value="sendmsg" checked> 发送消息</label>
                                <label class="checkbox-inline"><input type="radio" name="radioBtn" value="link"> 跳转网页</label>
                                <label class="checkbox-inline"><input type="radio" name="radioBtn" value="miniprogram"> 跳转小程序</label>
                            </div>
                        </div>
                    </form>

                    <div class="cm-edit-content-con" id="editMsg">
                        <div class="editTab">
                            <div class="editTab-heading">
                                <ul class="msg-panel__tab">
                                    <li class="msg-tab_item on">
                                        <span class="msg-icon msg-icon-tuwen"></span>
                                        图文消息
                                    </li>
                                </ul>
                            </div>
                            <div class="editTab-body">
                                <div class="msg-panel__context">
                                    <div class="msg-context__item">
                                        <div class="msg-panel__center msg-panel_select"  data-toggle="modal" data-target="#selectModal"><span class="message-plus">+</span><br>从素材库中选择</div>
                                    </div>
                                    <div class="msg-template"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cm-edit-content-con" id="editPage">
                        <div class="cm-edit-page">
                            <div class="row">
                                <label class="col-sm-6 control-label" style="text-align: left;">粉丝点击该菜单会跳转到以下链接:
                                </label>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 control-label" style="text-align: left;">页面地址:
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" name="url" class="form-control" placeholder="认证号才可手动输入地址">
                                    <span class="help-block">必填,必须是正确的URL格式</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cm-edit-content-con" id="editPage1">
                        <div class="cm-edit-page">
                            <div class="row">
                                <label class="col-sm-6 control-label" style="text-align: left;">粉丝点击该菜单会跳转对应小程序:
                                </label>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 control-label" style="text-align: left;">小程序appid:
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" name="appid" class="form-control" placeholder="小程序appid">
                                    <span class="help-block">必填，需要跳转的小程序appid</span>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 control-label" style="text-align: left;">小程序路径:
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" name="pagepath" class="form-control" placeholder="小程序路径">
                                    <span class="help-block">必填，需要跳转的小程序路径</span>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 control-label" style="text-align: left;">备用网页:
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" name="bakurl" class="form-control" placeholder="旧版微信客户端无法支持小程序，用户点击菜单时将会打开备用网页。">
                                    <span class="help-block">必填,必须是正确的URL格式</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cm-edit-before"><h5>点击左侧菜单进行操作</h5></div>
            </div>
        </div>
    </div>
    <div class="cm-edit-footer">
        {{ csrf_field() }}
        <button id="sortBtn" type="button" class="btn btn-default">菜单排序</button>
        <button id="sortBtnc" type="button" class="btn btn-default">完成排序</button>
        <button id="saveBtns" type="button" style="background-color: #138ed4 !important;" class="btn btn-info1">保存并发布</button>
    </div>
</div>