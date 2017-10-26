@extends("admin.layout.main")
@section('add_css')
    <style type="text/css">
        /*.toolbar {*/
        /*border: 1px solid #ccc;*/
        /*}*/

        /*.text {*/
        /*border: 1px solid #ccc;*/
        /*height: 400px;*/
        /*}*/
    </style>
@endsection

@section("content")
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@if(isset($post->id))编辑帖子@else增加帖子@endif</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" id="form-item">
                        {{csrf_field()}}
                        <div class="box-body">

                            <div class="form-group col-sm-12">
                                <label for="forum_id" class="control-label col-sm-2">选择论坛<span
                                            class="required-field">*</span></label>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <select id="forum_id" name="forum_id" class="form-control select2">
                                        <option value="">请选择</option>
                                        @foreach($forums as $key => $value)
                                            <option value="{{$value->id}}"
                                                    @if($value->id == $post->forum_id) selected
                                                    @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="user_id" class="control-label col-sm-2">选择作者<span
                                            class="required-field">*</span></label>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <select id="user_id" name="user_id" class="form-control select2">
                                        <option value="">请选择</option>
                                        @foreach($users as $key => $value)
                                            <option value="{{$value->id}}"
                                                    @if($value->id == $post->user_id) selected
                                                    @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  col-sm-12">
                                <label for="content" class="col-sm-2 control-label">帖子内容<span
                                            class="required-field">*</span></label>

                                <div class="col-sm-10">
                                    <input type="hidden" value="{{$post->id or 0}}" name="id">
                                    <div id="editor">
                                        @if(!empty($post)){{$post->content}}@endif
                                    </div>
                                    {{--<div id="editor-header" class="toolbar">--}}
                                    {{--</div>--}}
                                    {{--<div style="padding: 5px 0; color: #ccc">请输入内容</div>--}}
                                    {{--<div id="editor-content" class="text"> <!--可使用 min-height 实现编辑区域自动增加高度-->--}}
                                    {{--</div>--}}
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        @include("admin.layout.error")
                        <div class="box-footer" style="margin-left: 268px;">
                            <a class="btn btn-icon btn-default m-b-5" href="/admin/posts"
                               title="取消">取消
                            </a>
                            &emsp;
                            <button type="button" class="btn btn-primary btn-save">提交</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript" src="/bower_components/wangEditor/release/wangEditor.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#name').focus();
            $("#form-item").validate();
            $(".select2").select2({language: "zh-CN"});

            var E = window.wangEditor;
            var editor = new E('#editor');
//            var editor = new E('#editor-header', '#editor-content');  // 两个参数也可以传入 elem 对象，class 选择器
            // 自定义菜单配置
//            editor.customConfig.menus = [
//                'head',  // 标题
//                'bold',  // 粗体
//                'italic',  // 斜体
//                'underline',  // 下划线
//                'strikeThrough',  // 删除线
//                'foreColor',  // 文字颜色
//                'backColor',  // 背景颜色
//                'link',  // 插入链接
//                'list',  // 列表
//                'justify',  // 对齐方式
//                'quote',  // 引用
//                'emoticon',  // 表情
//                'image',  // 插入图片
//                'table',  // 表格
//                'video',  // 插入视频
//                'code',  // 插入代码
//                'undo',  // 撤销
//                'redo'  // 重复
//            ];
//            editor.customConfig.uploadImgServer = '/uploads/posts';  // 上传图片到服务器
            // 将图片大小限制为 1M
            editor.customConfig.uploadImgMaxSize = 1024 * 1024;
            // 限制一次最多上传 5 张图片
            editor.customConfig.uploadImgMaxLength = 5;
            editor.customConfig.uploadImgShowBase64 = true;   // 使用 base64 保存图片
            // 隐藏“网络图片”tab
            editor.customConfig.showLinkImg = false;
            editor.customConfig.zIndex = 1;
            editor.create();

            $('button.btn-save').click(function () {
                var forumId = $('#forum_id').val();
                var userId = $('#user_id').val();
                console.log(editor.txt.html());
                $.ajax({
                    type: "POST",
                    url: "/admin/posts/store",
                    data: {
                        'forum_id': forumId,
                        'user_id': userId,
                        'content': editor.txt.html()
                    },
                    dataType: "JSON",
                    beforeSend: null,
                    success: function (data) {
                        if (0 == data.status) {
                            //  1秒之后执行
                            setTimeout('location.href = "/admin/posts";', 1000);
                        } else {
                        }
                    }
                });
            });
        });
    </script>
@endsection