<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>图片上传</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/admin/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugin/webuploader/webuploader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugin/webuploader/css/phoselect.css') }}">
    <script type="text/javascript" src="{{ URL::asset('js/admin/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugin/webuploader/webuploader.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/admin/upload.js') }}?v=1.0"></script>
    <script type="text/javascript" src="{{ URL::asset('plugin/layer/layer.js') }}"></script>
</head>
<body>
<div class="y-upload-box">
    <div class="y-cen">
        <div class="y-manage">
            <div class="pho-m-type">
                <a class="tpy-btn cur" href="javascript:void(0);">本地上传</a>
            </div>
            <!-- 本地上传 -->
            <div class="js-yTab y-con-tab" style="display: block;">
                <!-- 上传盒子box -->
                <div id="wrapper">
                    <div id="y-container">
                        <div id="uploader">
                            <div class="queueList">
                                <div id="dndArea" class="placeholder">
                                    <div class="upload-btn-b" id="filePicker"></div>
                                    <p>或将照片拖到这里，单次最多可选{{ $info['num'] }}张</p >
                                </div>
                            </div>
                            <div class="statusBar" style="display:none;">
                                <div class="progress">
                                    <span class="text">0%</span>
                                    <span class="percentage"></span>
                                </div><div class="info"></div>
                                <div class="btns">
                                    <div id="filePicker2"></div>
                                    <div class="uploadBtn">开始上传</div>
                                    <a class="saveBtn" href="#">确定使用</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / 上传盒子box -->
                <!-- 上传后的 -->
                <div class="y-btn-blk" style="display: none;">
                    <a class="y-btn y-btn-default js-y-upload-close" href="#">取消</a>
                    <a class="y-btn y-btn-line" href="#">确定使用</a>
                </div>
                <div class="y-onlinemanage" style="display: none;">
                    <div class="y-file-list mark">
                        <ul class="clearfix">
                            <li class="file checked">
                                <div class="file-panel">
                                    <span class="cancel">删除</span>
                                </div>
                                <div class="img">
                                    <img src="{{ URL::asset('plugin/webuploader/image/pic.jpg') }}" alt="">
                                </div>
                                <span class="icon"></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- / 上传后的 -->
            </div>
            <!-- / 本地上传 -->
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var delPath = "{{ $info['deleteUrl'] }}";
    // 添加全局站点信息
    function webuploader(){
        // 实例化
        uploader = WebUploader.create({
            auto: true,//自动上传
            formData: {
                _token:'{{ csrf_token() }}'
            },
            duplicate: true,
            pick: {
                id: '#filePicker',
                label: '点击选择图片'
            },
            dnd: '#uploader .queueList',
            paste: document.body,

            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png,ico',
                mimeTypes: 'image/*'
            },

            // swf文件路径
            swf: "{{ URL::asset('webuploader/Uploader.swf') }}",

            disableGlobalDnd: true,

            chunked: true,
            server: "{{ $info['uploadUrl'] }}",
            fileNumLimit: "{{ $info['num'] }}",
            fileSizeLimit: 200 * 1024 * 1024,        // 200 M
            fileSingleSizeLimit: 2 * 1024 * 1024,    // 2 M
            fileVal:"file"
        });
        return uploader;
    }

    /*点击保存按钮时
     *判断允许上传数，检测是单一文件上传还是组文件上传
     *如果是单一文件，上传结束后将地址存入$input元素
     *如果是组文件上传，则创建input样式，添加到$input后面
     *隐藏父框架，清空列队，移除已上传文件样式*/
    $(".statusBar .saveBtn").click(function(){
        var callback = "{{ $info['callback'] }}";
        var num = "{{ $info['num'] }}";
        if(callback != "undefined"){
            var picture_tmp = [];
            if(num > 1){
                $("input[name^='picture_tmp']").each(function(index,dom){
                    picture_tmp[index] = dom.value;
                });
            }else{
                picture_tmp = $("input[name^='picture_tmp']").val();
            }
            eval('window.parent.'+callback+'(picture_tmp)');
            window.parent.layer.closeAll();
            return;
        }else{
            var elementId = "{{ $info['input'] }}";
            var picture_tmp = "";
            if(num > 1){
                $("input[name^='picture_tmp']").each(function(){
                    picture_tmp += '<li class="file">'+
                        '<div class="file-panel">'+
                        '<span class="cancel">删除</span>'+
                        '</div>'+
                        '<div class="img">'+
                        '<img src="' + this.value + '" alt="">'+
                        '</div>'+
                        '<input type="hidden" name="{{ $info['input'] }}[]" value="' + this.value + '" />'+
                        '</li>';
                });
                $(window.parent.document).find("#{{ $info['input'] }}").append(picture_tmp);
            }else{
                picture_tmp = '<li class="file">'+
                    '<div class="file-panel">'+
                    '<span class="cancel">删除</span>'+
                    '</div>'+
                    '<div class="img">'+
                    '<img src="' + $("input[name^='picture_tmp']").val() + '" alt=""></a>'+
                    '</div>'+
                    '<input type="hidden" name="{{ $info['input'] }}" value="' + $("input[name^='picture_tmp']").val() + '" />'+
                    '</li>';
                $(window.parent.document).find("#{{ $info['input'] }}").html(picture_tmp);
            }
        }
        window.parent.layer.closeAll();
    });

    //tabs(".y-manage .pho-m-type .tpy-btn",".js-yTab");
    /*tabs切换*/
    function tabs(chkObj,toggleObj){
        if ($(chkObj).length<=0 || $(toggleObj).length<=0){
            return false;
        }else{
            $(chkObj).click(function(){
                var i = $(this).index();
                $(this).addClass("cur").siblings().removeClass("cur");
                $(toggleObj).hide();
                $(toggleObj+":eq("+i+")").show();
            });
        }
    }

    /* 在线管理 */
    $(".js-uploadBox").click(function(){
        $(".y-upload-msk").add(".y-upload-box").fadeIn();
    });

    $(".js-y-upload-close").add(".y-upload-msk").click(function (){
        $(".y-upload-msk").add(".y-upload-box").fadeOut();
    });

    //删除
    $(".y-onlinemanage .file .cancel").click(function(){
        $(this).parents(".file").remove();
    });

    //添加当前选中状态
    $(".y-onlinemanage .mark .file").click(function(){
        $(this).siblings().removeClass("checked");
        $(this).toggleClass("checked");
    });
</script>
</body>
</html>