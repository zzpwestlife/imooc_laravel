@extends("admin.layout.main")

@section('add_css')

    {!! Html::style('/bower_components/blueimp-file-upload/css/jquery.fileupload.css') !!}
    {!! Html::style('/bower_components/blueimp-file-upload/css/jquery.fileupload-ui.css') !!}
    {!! Html::style('/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}

    <noscript>{!! Html::style('/bower_components/blueimp-file-upload/jquery.fileupload-noscript.css') !!}</noscript>
    <noscript>{!! Html::style('/bower_components/blueimp-file-upload/jquery.fileupload-ui-noscript.css') !!}</noscript>

@endsection

@section("content")
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@if(isset($file))编辑文件@else增加文件@endif</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/admin/files/store" method="POST" id="form-item">
                        {{csrf_field()}}
                        <div class="box-body">
                            <input type="hidden" value="{{$file->id or 0}}" name="id">

                            <div class="form-group col-sm-12">
                                <label for="user_id" class="control-label col-sm-2">选择上传者<span
                                            class="required-field">*</span></label>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <select id="user_id" name="user_id" class="form-control select2">
                                        <option value="">请选择</option>
                                        @foreach($users as $key => $value)
                                            <option value="{{$value->id}}"
                                                    @if($value->id == $file->user_id) selected
                                                    @endif>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="major_id" class="control-label col-sm-2">选择论坛<span
                                            class="required-field">*</span></label>

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <select id="major_id" name="major_id" class="form-control select2">
                                        <option value="">请选择</option>
                                        @foreach($majors as $key => $value)
                                            <option value="{{$value->id}}"
                                                    @if($value->id == $file->major_id) selected
                                                    @endif>@if(!empty($value->department)){{$value->department.'-'}}@endif{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{--<div class="form-group col-sm-12">--}}
                                {{--<label for="course_type" class="control-label col-sm-2">选择课程类型<span--}}
                                            {{--class="required-field">*</span></label>--}}

                                {{--<div class="col-sm-4 col-md-4 col-lg-4 switch">--}}
                                    {{--<input type="checkbox" id="course_type" name="course_type" value="1"--}}
                                           {{--@if($file->type==1) checked="checked"--}}
                                           {{--@endif data-on-text="公开课"--}}
                                           {{--data-off-text="专业课"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group col-sm-12">
                                <label for="file_type" class="control-label col-sm-2">选择文件类型<span
                                            class="required-field">*</span></label>

                                <div class="col-sm-4 col-md-4 col-lg-4 switch">
                                    <input type="checkbox" id="file_type" name="file_type" value="1"
                                           @if($file->category==1) checked="checked"
                                           @endif data-on-text="真题答案"
                                           data-off-text="资料"/>
                                </div>
                            </div>


                            {{--<div class="form-group col-sm-12" id="wrapper_upload_file">--}}
                                {{--<label for="input_file" class="control-label col-sm-2">文件<span--}}
                                            {{--class="required-field">*</span></label>--}}

                                {{--<div class="col-sm-4">--}}

                                    {{--<div id="media_file_preview" class="media-preview">--}}
                                        {{--@if ($file->filename)--}}
                                            {{--<span class="preview"><video src="{{$file->file_path}}" controls="controls">您的浏览器不支持 video 标签。</video></span>--}}
                                        {{--@else--}}
                                            {{--<img src="/images/nofile.png"--}}
                                                 {{--style="top:45px;height:160px;min-width:160px;max-width:320px">--}}
                                        {{--@endif--}}
                                    {{--</div>--}}

                                    {{--<div class="media-actions fileupload-buttonbar">--}}

                                        {{--<button type="button" title="取消"--}}
                                                {{--class="btn btn-default cancel">--}}
                                            {{--<i class="glyphicon glyphicon-remove"></i>--}}
                                            {{--<span class="hidden-xs">取消</span>--}}
                                        {{--</button>--}}

                                        {{--<div class="btn btn-primary btn-file" id="choose-file">--}}
                                            {{--<i class="glyphicon glyphicon-folder-open"></i>--}}
                                            {{--<span class="hidden-xs">选择</span>--}}
                                            {{--<input type="file" name="file" accept="*/*" title="选择文件" id="input_file"--}}
                                                   {{--class="">--}}
                                        {{--</div>--}}

                                        {{--<button type="submit" title="上传" id="btn_upload_file" style="display:none;"--}}
                                                {{--class="btn btn-success start">--}}
                                            {{--<i class="glyphicon glyphicon-upload"></i>--}}
                                            {{--<span>上传</span>--}}
                                        {{--</button>--}}

                                        {{--<input type="hidden" id="target_file_name" name="target_file_name">--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group col-sm-12">
                                <label for="filename" class="col-sm-2 control-label">文件名<span
                                            class="required-field">*</span></label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="filename" id="filename"
                                           value="@if(!empty($file)){{$file->filename}}@endif">
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="downloads" class="col-sm-2 control-label">下载量<span
                                            class="required-field">*</span></label>

                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="downloads" id="downloads"
                                           value="@if(!empty($file)){{$file->downloads}}@endif">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        @include("admin.layout.error")
                        <div class="box-footer" style="margin-left: 178px;">
                            <a class="btn btn-icon btn-default m-b-5" href="/admin/files"
                               title="取消">取消
                            </a>
                            &emsp;
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('add_script')

    {!! Html::script('/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}

    {!! Html::script('/bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js') !!}
    {!! Html::script('/bower_components/blueimp-load-image/js/load-image.all.min.js') !!}
    {!! Html::script('/bower_components/blueimp-canvas-to-blob/js/canvas-to-blob.min.js') !!}
    {!! Html::script('/bower_components/blueimp-file-upload/js/jquery.iframe-transport.js') !!}
    {!! Html::script('/bower_components/blueimp-file-upload/js/jquery.fileupload.js') !!}
    {!! Html::script('/bower_components/blueimp-file-upload/js/jquery.fileupload-process.js') !!}
    {!! Html::script('/bower_components/blueimp-file-upload/js/jquery.fileupload-image.js') !!}
    {!! Html::script('/bower_components/blueimp-file-upload/js/jquery.fileupload-audio.js') !!}
    {!! Html::script('/bower_components/blueimp-file-upload/js/jquery.fileupload-video.js') !!}
    {!! Html::script('/bower_components/blueimp-file-upload/js/jquery.fileupload-validate.js') !!}
    {!! Html::script('/bower_components/blueimp-file-upload/js/jquery.fileupload-ui.js') !!}
@endsection

@section('script')
    <!-- The template to display files available for upload -->
    {{--<script id="template-upload" type="text/x-tmpl">--}}

    {{--{% for (var i=0, file; file=o.files[i]; i++) { %}--}}
    {{--<div class="template-upload fade">--}}
    {{--<span class="preview"></span>--}}

    {{--<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">--}}
    {{--<div class="progress-bar progress-bar-success" style="width:0%;"></div>--}}
    {{--</div>--}}


    {{--<button class="btn btn-primary start" style="display:none;"></button>--}}
    {{--<button class="btn btn-warning cancel" style="display:none;"></button>--}}

    {{--</div>--}}

    {{--{% } %}--}}

    {{--</script>--}}

    <script type="text/javascript">
        $(document).ready(function () {
            $('#name').focus();
            $("#form-item").validate();
            $(".select2").select2({language: "zh-CN"});
            $("div.switch input[type=\"checkbox\"]").not("[data-switch-no-init]").bootstrapSwitch();

            // Initialize the jQuery File Upload widget:
            $('#wrapper_upload_file').fileupload({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: '/file/ajax-upload',
                autoUpload: false,
                paramName: "file",
                fileInput: $("#input_file"),
                filesContainer: $("#media_file_preview"),
                uploadTemplateId: 'template-upload',
//                downloadTemplateId: 'template-download-file',
                previewMaxWidth: 240,
                previewMaxHeight: 240,
                maxNumberOfFiles: 1,
                maxChunkSize: 1000000, // 1 MB
                acceptFileTypes: /(\.|\/)(mp4|mov)$/i

            })

                .bind('fileuploaddestroy', function (e, data) {
                    /* ... */
                    console.log("fileuploaddestroy");
                })
                .bind('fileuploaddestroyed', function (e, data) {
                    /* ... */
                    console.log("fileuploaddestroyed");
                })
                .on('fileuploadadded', function (e, data) {
                    /* ... */
                    console.log("fileuploadadded");

                    var currentFile = data.files[0];
                    adjustMediaPosition(currentFile);
                    // http://www.cnblogs.com/sunshq/p/4171490.html
                    // 给一个随机字符串作为文件名 与服务端配合使用 （主要为分块上传定制）
//                    var fn = Math.random().toString(36).substring(2);
//                    console.log(fn);
                    $("#target_file_name").val(currentFile.name);
                    $("#filename").val(currentFile.name);

                    $('#choose-file').hide();
                    $('#btn_upload_file').show();

                })
                .bind('fileuploadsent', function (e, data) {
                    /* ... */
                    console.log("fileuploadsent");
                })
                .bind('fileuploadcompleted', function (e, data) {
                    /* ... */
                    console.log("fileuploadcompleted");

                })
                .bind('fileuploadfailed', function (e, data) {
                    /* ... */
                    console.log("fileuploadfailed");
                })
                .bind('fileuploadfinished', function (e, data) {
                    /* ... */
                    console.log("fileuploadfinished");
                    var currentFile = data.files[0];
                    adjustMediaPosition(currentFile);
                    $('#btn_upload_file').hide();

                })
                .bind('fileuploadstarted', function (e) {
                    /* ... */
                    console.log("fileuploadstarted");
                })
                .bind('fileuploadstopped', function (e) {
                    /* ... */
                    console.log("fileuploadstopped");
                })

                .on('fileuploadadd', function (e, data) {
                    console.log("fileuploadadd");
                })
                .on('fileuploadsubmit', function (e, data) {
                    console.log("fileuploadsubmit");
                })
                .on('fileuploadsend', function (e, data) {
                    console.log("fileuploadsend");
                })
                .on('fileuploaddone', function (e, data) {
                    console.log("fileuploaddone");
                })
                .on('fileuploadfail', function (e, data) {
                    console.log("fileuploadfail");
                })
                .on('fileuploadalways', function (e, data) {
                    /* ... */
                    console.log("fileuploadalways");
                })
                .on('fileuploadprogress', function (e, data) {
                    /* ... */
                    console.log("fileuploadprogress");
                })
                .on('fileuploadprogressall', function (e, data) {
                    /* ... */
                    console.log("fileuploadprogressall");
                })
                .on('fileuploadstart', function (e) {
                    /* ... */
                    console.log("fileuploadstart");
                })
                .on('fileuploadstop', function (e) {
                    /* ... */
                    console.log("fileuploadstop");
                })
                .on('fileuploadchange', function (e, data) {
                    /* ... */
                    $("#media_file_preview").html("");

                    console.log("fileuploadchange");
                })
                .on('fileuploadpaste', function (e, data) {
                    /* ... */
                    console.log("fileuploadpaste");
                })
                .on('fileuploaddrop', function (e, data) {
                    /* ... */
                    console.log("fileuploaddrop");
                })
                .on('fileuploaddragover', function (e) {
                    /* ... */
                    console.log("fileuploaddragover");
                })
                .on('fileuploadchunksend', function (e, data) {
                    /* ... */
                    console.log("fileuploadchunksend");
                })
                .on('fileuploadchunkdone', function (e, data) {
                    /* ... */
                    console.log("fileuploadchunkdone");
                })
                .on('fileuploadchunkfail', function (e, data) {
                    /* ... */
                    console.log("fileuploadchunkfail");
                })
                .on('fileuploadchunkalways', function (e, data) {
                    /* ... */
                    console.log("fileuploadchunkalways");
                })
            ;

            //jQuery-File-Upload

            function adjustMediaPosition(currentFile) {
                if (currentFile.type) {
                    var mediaObj = $("#media_file_preview  span.preview file");
                    if (!mediaObj.length) {
                        mediaObj = $("#media_file_preview span.preview canvas");
                    }
                    setTimeout(function () {
                        var mediaHeight = mediaObj.innerHeight();
                        console.log(mediaHeight);
                        if (mediaHeight < 240) {
                            mediaObj.animate({"top": (240 - mediaHeight) / 2 + "px"});
                        }
                    }, 200);

                }
            }

        });
    </script>
@endsection