
<h3>正文编辑 :</h3>

<!-- 加载编辑器的容器 -->
<script id="container_editor" name="content" type="text/plain">正文</script>
<!-- 配置文件 -->
<script type="text/javascript" src="{{config('app.url')}}/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{config('app.url')}}/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container_editor');
    @if(isset($article))
{{--    --}}
        window.onload = function(){
            ue.addListener("ready", function () {
                // editor准备好之后才可以使用
                ue.setContent('{!! str_replace("\n","<br>",$article->content)!!}');
            });
    };
        @endif
</script>


<button style="margin-top: 30px" id="edit_post">提交</button>