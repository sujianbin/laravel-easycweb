@include('vendor.ueditor.assets')


这里需要展示编辑器容器
<!-- 编辑器容器 -->
<script id="container" name="content" type="text/plain">这是内容</script>


<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>