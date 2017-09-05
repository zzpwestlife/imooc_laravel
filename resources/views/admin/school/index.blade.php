@extends("admin.layout.main")

@section('actions')
    <a class="btn btn-icon btn-primary m-b-5" href="{{url("/live/home/update")}}"> <i class="fa fa-plus"></i></a>
    <button class="btn btn-icon btn-danger m-b-5 btn-batch-delete" data-operate-type="batch-delete"><i
                class="fa fa-trash"></i></button>
@endsection
@section('panel-header')
    <div class="panel-group">
        <div class="panel panel-default" style="border: none;">
            <div class="pane``l-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" href="#wrapper_search"
                       aria-expanded="true">
                        搜索相关
                    </a>
                </h4>
            </div>
            <div id="wrapper_search" class="panel-collapse collapse"
                 aria-expanded="false">
                <div class="panel-body">
                    <div class="portlet-heading">
                        <form id="frm_search_info" class="text-dark form-horizontal" action="">
                            <input type="hidden" value=""/>
                            <div class="form-group col-sm-4 pull-left">
                                <label for="title" class="control-label col-sm-4">标题</label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="title" name="title" maxlength="10"
                                           placeholder=" 请输入关键字" value="{{$searchCondition['title'] or ''}}"/>

                                </div>
                            </div>

                            <div class="form-group col-sm-4 pull-left">
                                <button type="button" class="btn btn-default m-l-10" id="btn_clear">清空</button>
                                <button type="button" class="btn btn-primary m-l-10" id="btn_search">搜索</button>
                            </div>


                            <div class="form-group col-sm-4 pull-left">


                            </div>
                            <div class="clearfix"></div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @if(count($schools)>0)
                <form id="frm_item_info" action="">
                    <div class="table-responsive form-group" style="border-bottom: 1px solid #ddd;">
                        <table class="table table-success">
                            <thead>
                            <tr>
                                <th style="padding-left: 32px;">
                                    <div class="ckbox ckbox-default">
                                        <input type="checkbox" value="1" id="checkbox_all">
                                        <label for="checkbox_all" title="多选" data-toggle="tooltip"
                                               data-placement="right"></label>
                                    </div>
                                </th>
                                <th>标题</th>
                                <th>图片</th>
                                <th>描述</th>
                                <th>点击数</th>
                                <th>虚拟人数</th>
                                <th>允许评论</th>
                                <th>时间段</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($schools))
                                @foreach($schools as $index => $item)
                                    <tr>
                                        <td width="10%">
                                            <div class="checkbox">
                                                <label class="cr-styled">
                                                    <input class="chk-item" type="checkbox" name="item_id[]"
                                                           value="{{$item['id']}}">
                                                    <i class="fa"></i>
                                                    {{$item['id']}}
                                                </label>
                                            </div>
                                        </td>
                                        <td id="item_title_{{$item['id']}}" width="15%">{{$item['title']}}</td>
                                        {{--<td>--}}
                                        {{--<div class="thumb-image-preview">--}}
                                        {{--@if($item['picture'])--}}
                                        {{--<a href="javascript:;"--}}
                                        {{--title="" data-gallery>--}}
                                        {{--<img src="/images/loaders/loader6.gif"--}}
                                        {{--data-src="{{$item['picture_path']}}"--}}
                                        {{--alt="">--}}
                                        {{--</a>--}}
                                        {{--@endif--}}
                                        {{--</div>--}}
                                        {{--</td>--}}
                                        {{--<td style="text-align: left;">--}}
                                        {{--<div class="text-preview" id="content_{{$item['id']}}">--}}
                                        {{--{{$item['description']}}--}}
                                        {{--</div>--}}
                                        {{--</td>--}}
                                        {{--<td> @if(empty($item['view_count'])) 0 @else{{$item['view_count']}}@endif</td>--}}
                                        {{--<td> @if(empty($item['virtual_count']))--}}
                                        {{--0 @else{{$item['virtual_count']}}@endif</td>--}}
                                        {{--<td>{{$item['is_comment']?"是":"否"}}</td>--}}
                                        {{--<td>{{date("y-m-d H:i",$item['start_date'])}} <br/>--}}
                                        {{--{{date("y-m-d H:i",$item['end_date'])}}</td>--}}
                                        {{--<td style="width: 15%;">--}}
                                        {{--<a class="btn btn-icon btn-default btn-custom m-b-5" data-toggle="tooltip"--}}
                                        {{--href="{{"/live/home/update/".$item['id']}}"--}}
                                        {{--title="编辑">--}}
                                        {{--<i class="fa fa-edit"></i>--}}
                                        {{--</a>--}}

                                        {{--@if ($item['is_subject'] == 0)--}}
                                        {{--<a class="btn btn-icon btn-danger btn-custom m-b-5 btn-delete"--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--href="javascript:;" title="删除" data-operate-type="delete"--}}
                                        {{--data-item-id="{{$item['id']}}">--}}
                                        {{--<i class="fa fa-trash"></i>--}}
                                        {{--</a>--}}
                                        {{--@endif--}}
                                        {{--<a class="btn btn-icon btn-default btn-custom m-b-5"--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--href="{{"/live/message?&search=live_id|:".$item['id']}}" title="消息管理"--}}
                                        {{--data-operate-type="messagelist"--}}
                                        {{--data-item-id="{{$item['id']}}">--}}
                                        {{--<i class="fa fa-th-list"></i>--}}
                                        {{--</a>--}}
                                        {{--<a class="btn btn-icon btn-default btn-custom m-b-5"--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--href="{{"/live/comment?&search=live_id|:".$item['id']}}" title="评论管理"--}}
                                        {{--data-operate-type="comment"--}}
                                        {{--data-item-id="{{$item['id']}}">--}}
                                        {{--<i class="fa fa-comments-o"></i>--}}
                                        {{--</a>--}}
                                        {{--<a class="btn btn-icon btn-default btn-custom m-b-5 btn-push"--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--href="javascript:;" title="苹果推送" data-operate-type="ios_push"--}}
                                        {{--data-item-id="{{$item['id']}}">--}}
                                        {{--<i class="fa fa-apple"></i>--}}
                                        {{--</a>--}}

                                        {{--<a class="btn btn-icon btn-success btn-custom m-b-5 btn-push "--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--href="javascript:;" title="安卓推送" data-operate-type="android_push"--}}
                                        {{--data-item-id="{{$item['id']}}">--}}
                                        {{--<i class="fa fa-android"></i>--}}
                                        {{--</a>--}}
                                        {{--@if ($item['is_subject'] == 1)--}}
                                        {{--<a class="btn btn-icon btn-info btn-custom m-b-5"--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--href="{{"/live/subtopic?&search=live_id|:".$item['id']}}"--}}
                                        {{--title="话题管理"--}}
                                        {{--data-operate-type="subtopic"--}}
                                        {{--data-item-id="{{$item['id']}}">--}}
                                        {{--<i class="fa fa-list-ol"></i>--}}
                                        {{--</a>--}}
                                        {{--@endif--}}

                                        {{--<a class="btn btn-icon btn-success btn-custom m-b-5"--}}
                                        {{--data-toggle="tooltip" target="_blank"--}}
                                        {{--href="/setting/push_content/update?type=live&object_id={{$item['id']}}"--}}
                                        {{--title="新版推送">--}}
                                        {{--<i class="fa fa-send"></i>--}}
                                        {{--</a>--}}

                                        {{--@if(in_array($item['open_type'],[4,5]))--}}

                                        {{--<a id="clipboard_{{$item['id']}}"--}}
                                        {{--class="btn btn-icon btn-purple btn-custom m-b-5 btn-clipboard"--}}
                                        {{--href="javascript:;"--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--data-clipboard-text="{{$item['aliyun_push_url']}}"--}}
                                        {{--title="复制推流地址">--}}
                                        {{--<i class="fa fa-clipboard"></i>--}}
                                        {{--</a>--}}

                                        {{--<a--}}
                                        {{--class="btn btn-icon btn-inverse btn-custom m-b-5 btn-record"--}}
                                        {{--href="javascript:;"--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--data-operate-type="record"--}}
                                        {{--data-item-id="{{$item['id']}}"--}}
                                        {{--title="从录制信息中生成回放">--}}
                                        {{--<i class="fa fa-file-video-o"></i>--}}
                                        {{--</a>--}}

                                        {{--<a--}}
                                        {{--class="btn btn-icon btn-info btn-custom m-b-5 btn-vod"--}}
                                        {{--href="javascript:;"--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--data-operate-type="vod"--}}
                                        {{--data-item-id="{{$item['id']}}"--}}
                                        {{--title="从点播文件中生成回放">--}}
                                        {{--<i class="fa fa-file-video-o"></i>--}}
                                        {{--</a>--}}

                                        {{--@endif--}}

                                        {{--@if ($item['is_subject'] == 0)--}}
                                        {{--@if ($item['status'] == 0)--}}
                                        {{--<a class="btn btn-icon btn-primary btn-custom m-b-5 btn-play"--}}
                                        {{--data-toggle="tooltip"--}}
                                        {{--href="javascript:;" title="点击开始直播" data-operate-type="play"--}}
                                        {{--data-item-id="{{$item['id']}}">--}}
                                        {{--<i class="fa fa-play"></i>--}}
                                        {{--</a>--}}
                                        {{--@elseif($item['status'] == 1)--}}
                                        {{--<a class="btn btn-icon btn-primary btn-custom m-b-5 btn-stop"--}}
                                        {{--data-toggle="tooltip" href="javascript:;" title="点击结束直播"--}}
                                        {{--data-operate-type="stop"--}}
                                        {{--data-item-id="{{$item['id']}}">--}}
                                        {{--<i class="fa fa-stop"></i>--}}
                                        {{--</a>--}}
                                        {{--@endif--}}
                                        {{--@endif--}}

                                        {{--</td>--}}
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-warning" role="alert" style="text-align: center;">
                                            无相关信息
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    {{$schools->links()}}
                </form>
            @else

            @endif
            <div class="hidden-box" style="display: none;">
                <input type="hidden" id="operate_type" value="">
                <input type="hidden" id="will_operate_item_id" value="">
            </div>

        </div>
    </div>
@endsection
{{--@section('add_script')--}}
{{--{!! Html::script('/bower_components/jquery-validation/dist/jquery.validate.min.js') !!}--}}
{{--{!! Html::script('/bower_components/jquery-form/jquery.form.js') !!}--}}
{{--{!! Html::script('/bower_components/moment/min/moment.min.js') !!}--}}
{{--{!! Html::script('/bower_components/moment/locale/zh-cn.js') !!}--}}
{{--推送--}}
{{--{!! Html::script('/bower_components/moment/min/moment.min.js') !!}--}}
{{--{!! Html::script('/bower_components/moment/locale/zh-cn.js') !!}--}}
{{--{!! Html::script('/bower_components/clipboard/dist/clipboard.min.js') !!}--}}
{{--{!! Html::script('/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}--}}
{{--{!! Html::script('/js/push/push_init.js') !!}--}}
{{--@endsection--}}
{{--@section('script')--}}
{{--<script type="text/javascript">--}}

{{--$(function () {--}}

{{--var CONST_OPERATE_TYPE_PLAY = 'play';--}}
{{--var CONST_OPERATE_TYPE_STOP = 'stop';--}}
{{--var CONST_OPERATE_TYPE_RECORD = 'record';--}}
{{--var CONST_OPERATE_TYPE_VOD = 'vod';--}}

{{--$(".select2").select2({language: "zh-CN", 'theme': "bootstrap"});--}}

{{--// 全选效果--}}
{{--$("#checkbox_all").checkAll();--}}

{{--$('.datetimepicker').datetimepicker({--}}
{{--format: 'YYYY-MM-DD',--}}
{{--showClear: true,--}}
{{--showClose: true,--}}
{{--//            sideBySide:true,--}}
{{--locale: 'zh-cn'--}}
{{--});--}}

{{--var clipboard = new Clipboard('.btn-clipboard');--}}
{{--clipboard.on('success', function (e) {--}}
{{--//                console.info('Action:', e.action);--}}
{{--//                console.info('Text:', e.text);--}}
{{--//                console.info('Trigger:', e.trigger);--}}
{{--notify("提示", "已将地址复制至剪切板", {type: "success"});--}}
{{--//                $("#"+e.trigger.id).tooltip({title:"已复制",placement:'bottom'});--}}
{{--e.clearSelection();--}}
{{--});--}}

{{--clipboard.on('error', function (e) {--}}
{{--notify("提示", "复制失败，请换个浏览器试试<br>或点开详情页手动复制", {type: "warning"});--}}
{{--//                console.error('Action:', e.action);--}}
{{--//                console.error('Trigger:', e.trigger);--}}
{{--});--}}

{{--// 删除--}}
{{--//            $("button.btn-batch-delete").actionDelete({modelName: "Live"});--}}
{{--$("button.btn-batch-delete").actionDelete({"requestUrl": "{{route("live.home.ajax-delete")}}"});--}}

{{--// 图片预览--}}
{{--$("div.thumb-image-preview img").thumbImagePreview();--}}

{{--// 操作按钮 开始 结束--}}
{{--$('.btn-play,.btn-stop,.btn-record,.btn-vod').click(function () {--}}

{{--var data = $(this).data();--}}
{{--var itemId = data.itemId;--}}
{{--var operateType = data.operateType;--}}
{{--var confirmTitle = '';--}}
{{--var itemHtml = '';--}}

{{--$("#operate_type").val(operateType);--}}
{{--$("#will_operate_item_id").val(itemId);--}}

{{--if (CONST_OPERATE_TYPE_RECORD == operateType) {--}}
{{--confirmTitle = "加载中";--}}
{{--$(".modal .modal-title").html(confirmTitle);--}}
{{--modalViewToLoading();--}}
{{--actionRecord('display', itemId);--}}
{{--} else if (CONST_OPERATE_TYPE_VOD == operateType) {--}}
{{--confirmTitle = "加载中";--}}
{{--$(".modal .modal-title").html(confirmTitle);--}}
{{--modalViewToLoading();--}}
{{--actionVod('display', itemId);--}}
{{--} else {--}}
{{--if (CONST_OPERATE_TYPE_PLAY == operateType) {--}}
{{--confirmTitle = "确认要 开始 直播吗";--}}
{{--} else if (CONST_OPERATE_TYPE_STOP == operateType) {--}}
{{--confirmTitle = "确认要 结束 直播吗";--}}
{{--}--}}
{{--var it = $("#item_title_" + itemId).html();--}}
{{--if ($.isEmptyObject(it)) {--}}
{{--it = "无标题-ID为" + itemId;--}}
{{--}--}}
{{--itemHtml = "<p style='color:red;'>" + it + "</p>";--}}
{{--modalViewToSmall();--}}
{{--$(".modal .modal-title").html(confirmTitle);--}}
{{--$(".modal .modal-body").html(itemHtml);--}}
{{--}--}}

{{--$('#commonModal').modal();--}}

{{--});--}}

{{--// 模态框中的确定按钮 执行不同操作--}}
{{--$("body").delegate(".modal button.btn-confirm", "click", function () {--}}
{{--var operateType = $("#operate_type").val();--}}
{{--var operateItemId = $("#will_operate_item_id").val();--}}

{{--if (CONST_OPERATE_TYPE_RECORD == operateType) {--}}
{{--actionRecord('confirm', operateItemId);--}}
{{--} else if (CONST_OPERATE_TYPE_VOD == operateType) {--}}
{{--actionVod('confirm', operateItemId);--}}
{{--} else {--}}
{{--if (CONST_OPERATE_TYPE_PLAY == operateType) {--}}
{{--actionControl("confirm", operateItemId, 1);--}}
{{--} else if (CONST_OPERATE_TYPE_STOP == operateType) {--}}
{{--actionControl("confirm", operateItemId, 2);--}}
{{--}--}}
{{--modalViewToLoading();--}}
{{--}--}}

{{--});--}}

{{--// 搜索 录制索引文件--}}
{{--$("body").delegate(".modal #btn_search", "click", function () {--}}
{{--var operateType = $("#operate_type").val();--}}
{{--var operateItemId = $("#will_operate_item_id").val();--}}

{{--var loadingHtml = '<tr><td colspan="10"><div  style="clear: both;text-align: center;"><img src="/images/loaders/loader6.gif" alt="loading"></div></td></tr>';--}}
{{--$(".modal .modal-body #data_content").html(loadingHtml);--}}

{{--if (CONST_OPERATE_TYPE_VOD == operateType) {--}}
{{--actionVod('display', operateItemId);--}}
{{--} else if (CONST_OPERATE_TYPE_RECORD == operateType) {--}}
{{--actionRecord('display', operateItemId);--}}
{{--}--}}

{{--});--}}

{{--});--}}

{{--/**--}}
{{--* 开始和结束操作--}}
{{--* @param type--}}
{{--* @param operateItemId--}}
{{--* @param control--}}
{{--*/--}}
{{--function actionControl(type, operateItemId, control) {--}}

{{--if ('confirm' == type) {--}}
{{--var status = 0;--}}
{{--if (1 == control) {--}}
{{--status = 1; // 变成1 直播中 --}}
{{--} else if (2 == control) {--}}
{{--status = 2; // 变成2 已结束--}}
{{--}--}}

{{--$.ajax({--}}
{{--type: 'POST',--}}
{{--url: "/live/home/ajax-play-or-stop",--}}
{{--data: {--}}
{{--'status': status,--}}
{{--'id': operateItemId--}}
{{--},--}}
{{--dataType: 'JSON',--}}
{{--success: function (result, textStatus, jqXHR) {--}}
{{--if (0 == result.status) {--}}
{{--notifySuccess();--}}
{{--setTimeout("location.reload();", 1500);--}}
{{--} else {--}}
{{--notify("提示", result.msg, {type: "warning"});--}}
{{--}--}}
{{--},--}}
{{--error: function (jqXHR, textStatus, errorThrown) {--}}
{{--notifyFailed();--}}
{{--}--}}
{{--});--}}
{{--}--}}

{{--}--}}

{{--/**--}}
{{--* 录制文件的操作--}}
{{--* @param type--}}
{{--* @param operateItemId--}}
{{--*/--}}
{{--function actionRecord(type, operateItemId) {--}}

{{--if ('display' == type) {--}}

{{--var startDate = $(".modal #start_date").val();--}}
{{--var endDate = $(".modal #end_date").val();--}}
{{--var it = $("#item_title_" + operateItemId).html();--}}
{{--if ($.isEmptyObject(it)) {--}}
{{--it = "无标题-ID为" + operateItemId;--}}
{{--}--}}
{{--it = it + " 的录制文件";--}}

{{--$.ajax({--}}
{{--type: 'GET',--}}
{{--url: "/live/home/ajax-record-index-files",--}}
{{--data: {--}}
{{--'id': operateItemId,--}}
{{--'start_date': startDate,--}}
{{--'end_date': endDate--}}
{{--},--}}
{{--dataType: 'JSON',--}}
{{--success: function (result, textStatus, jqXHR) {--}}
{{--if (0 == result.status) {--}}
{{--var data = result.data;--}}
{{--notify("提示", "操作成功！", {type: "success", modal_show: true});--}}

{{--var files = data.index_files;--}}
{{--if ($.isEmptyObject(files)) {--}}
{{--files = null;--}}
{{--}--}}
{{--var cParams = {--}}
{{--'files': files--}}
{{--};--}}
{{--var contentHtml = template('template_for_record_files_content', cParams);--}}

{{--var params = {--}}
{{--'start_date': data.conditions.start_date,--}}
{{--'end_date': data.conditions.end_date,--}}
{{--'live_id': data.conditions.live_id,--}}
{{--'file_content': contentHtml,--}}
{{--};--}}
{{--template.defaults.escape = false;--}}
{{--var filesHtml = template('template_for_record_files', params);--}}
{{--template.defaults.escape = true;--}}
{{--modalViewToLarge();--}}
{{--$(".modal .modal-title").html(it);--}}
{{--$(".modal .modal-body").html(filesHtml);--}}
{{--$('.modal .datetimepicker').datetimepicker({--}}
{{--format: 'YYYY-MM-DD',--}}
{{--widgetPositioning: {--}}
{{--horizontal: 'auto',--}}
{{--vertical: 'bottom'--}}
{{--},--}}
{{--showClear: true,--}}
{{--showClose: true,--}}
{{--locale: 'zh-cn'--}}
{{--});--}}

{{--} else if (2 == result.status) {--}}
{{--notify("提示", result.msg, {type: "warning", modal_show: true});--}}
{{--var nodataHtml = ['<tr>',--}}
{{--'<td colspan="20">',--}}
{{--'<div class="alert alert-warning" role="alert" style="text-align: center;">',--}}
{{--'时间间隔不能超过 4 天',--}}
{{--'</div>',--}}
{{--'</td>',--}}
{{--'</tr>'].join('');--}}
{{--$(".modal .modal-body #data_content").html(nodataHtml);--}}
{{--}--}}
{{--else {--}}
{{--notify("提示", result.msg, {type: "warning"});--}}
{{--}--}}
{{--},--}}
{{--error: function (jqXHR, textStatus, errorThrown) {--}}
{{--notifyFailed();--}}
{{--}--}}
{{--});--}}

{{--} else if ('confirm' == type) {--}}

{{--var $checked = $(".modal input[name='item_id[]']:checked");--}}
{{--if (!$checked.length) {--}}
{{--notify("提示", "请选择需要操作的记录", {type: "warning", modal_show: true});--}}
{{--return;--}}
{{--}--}}

{{--var frmData = $('.modal #frm_item_info').serialize();--}}
{{--frmData += "&id=" + operateItemId;--}}
{{--$(".modal .modal-title").html("保存中");--}}
{{--modalViewToLoading();--}}
{{--$.ajax({--}}
{{--type: 'POST',--}}
{{--url: "/live/home/ajax-save-record-index-files",--}}
{{--data: frmData,--}}
{{--dataType: 'JSON',--}}
{{--success: function (result, textStatus, jqXHR) {--}}
{{--if (0 == result.status) {--}}
{{--var data = result.data;--}}
{{--notifySuccess();--}}


{{--} else {--}}
{{--notify("提示", result.msg, {type: "warning"});--}}
{{--}--}}
{{--},--}}
{{--error: function (jqXHR, textStatus, errorThrown) {--}}
{{--notifyFailed();--}}
{{--}--}}
{{--});--}}

{{--}--}}

{{--}--}}

{{--/**--}}
{{--* 点播文件的操作--}}
{{--* @param type--}}
{{--* @param operateItemId--}}
{{--*/--}}
{{--function actionVod(type, operateItemId) {--}}

{{--if ('display' == type) {--}}

{{--var startDate = $(".modal #start_date").val();--}}
{{--var endDate = $(".modal #end_date").val();--}}
{{--var it = $("#item_title_" + operateItemId).html();--}}
{{--if ($.isEmptyObject(it)) {--}}
{{--it = "无标题-ID为" + operateItemId;--}}
{{--}--}}
{{--it = "为 " + it + " 选择点播文件";--}}

{{--$.ajax({--}}
{{--type: 'GET',--}}
{{--url: "/live/home/ajax-vod-files",--}}
{{--data: {--}}
{{--'id': operateItemId,--}}
{{--'start_date': startDate,--}}
{{--'end_date': endDate--}}
{{--},--}}
{{--dataType: 'JSON',--}}
{{--success: function (result, textStatus, jqXHR) {--}}
{{--if (0 == result.status) {--}}
{{--var data = result.data;--}}
{{--notify("提示", "操作成功！", {type: "success", modal_show: true});--}}

{{--var files = data.index_files;--}}
{{--if ($.isEmptyObject(files)) {--}}
{{--files = null;--}}
{{--}--}}
{{--var cParams = {--}}
{{--'files': files--}}
{{--};--}}
{{--var contentHtml = template('template_for_vod_files_content', cParams);--}}

{{--var params = {--}}
{{--'start_date': data.conditions.start_date,--}}
{{--'end_date': data.conditions.end_date,--}}
{{--'live_id': data.conditions.live_id,--}}
{{--'file_content': contentHtml,--}}
{{--};--}}
{{--template.defaults.escape = false;--}}
{{--var filesHtml = template('template_for_vod_files', params);--}}
{{--template.defaults.escape = true;--}}
{{--modalViewToLarge();--}}
{{--$(".modal .modal-title").html(it);--}}
{{--$(".modal .modal-body").html(filesHtml);--}}
{{--$('.modal .datetimepicker').datetimepicker({--}}
{{--format: 'YYYY-MM-DD',--}}
{{--widgetPositioning: {--}}
{{--horizontal: 'auto',--}}
{{--vertical: 'bottom'--}}
{{--},--}}
{{--showClear: true,--}}
{{--showClose: true,--}}
{{--locale: 'zh-cn'--}}
{{--});--}}

{{--} else {--}}
{{--notify("提示", result.msg, {type: "warning"});--}}
{{--}--}}
{{--},--}}
{{--error: function (jqXHR, textStatus, errorThrown) {--}}
{{--notifyFailed();--}}
{{--}--}}
{{--});--}}

{{--} else if ('confirm' == type) {--}}

{{--var $checked = $(".modal input[name='item_id[]']:checked");--}}
{{--if (!$checked.length) {--}}
{{--notify("提示", "请选择需要操作的记录", {type: "warning", modal_show: true});--}}
{{--return;--}}
{{--}--}}

{{--var frmData = $('.modal #frm_item_info').serialize();--}}
{{--frmData += "&id=" + operateItemId;--}}
{{--$(".modal .modal-title").html("保存中");--}}
{{--modalViewToLoading();--}}
{{--$.ajax({--}}
{{--type: 'POST',--}}
{{--url: "/live/home/ajax-save-vod-files",--}}
{{--data: frmData,--}}
{{--dataType: 'JSON',--}}
{{--success: function (result, textStatus, jqXHR) {--}}
{{--if (0 == result.status) {--}}
{{--var data = result.data;--}}
{{--notifySuccess();--}}
{{--} else {--}}
{{--notify("提示", result.msg, {type: "warning"});--}}
{{--}--}}
{{--},--}}
{{--error: function (jqXHR, textStatus, errorThrown) {--}}
{{--notifyFailed();--}}
{{--}--}}
{{--});--}}

{{--}--}}

{{--}--}}

{{--// 搜索 按钮--}}
{{--searchWithParams('/live/home?page=1');--}}

{{--//推送--}}
{{--var push = new PushOperate();--}}
{{--push.init('live');--}}

{{--</script>--}}
{{--@endsection--}}