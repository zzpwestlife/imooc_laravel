@extends("admin.layout.main")

@section('css')

    <style type="text/css">
        .table > tbody > tr > td {
            vertical-align: middle;
        }

    </style>

@endsection

@section("content")
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">文件管理</h3>
            <a type="button" class="btn " href="/admin/files/create">增加文件</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="item_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="item-table" class="table table-bordered table-hover dataTable" role="grid"
                               aria-describedby="item_info">
                            <thead>
                            <tr role="row">
                                <th style="width: 10px">#</th>
                                <th>文件名</th>
                                <th>上传者</th>
                                <th>所属论坛</th>
                                <th>分类</th>
                                <th>公开课</th>
                                <th>文件状态</th>
                                <th>下载量</th>
                                {{--<th>添加时间</th>--}}
                                {{--<th>修改时间</th>--}}
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>


                            @if (count($files) > 0)
                                @foreach($files as $item)
                                    <tr>
                                        <td width="6%">{{$item->id}}</td>
                                        <td>{{$item->filename}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->major->name}}</td>
                                        <td>@if($item->category==1)资料@else真题答案@endif</td>
                                        <td>@if($item->type==1)专业课@else公开课@endif</td>
                                        <td>@if($item->status==1)有效@else无效@endif</td>
                                        <td>{{$item->downloads}}</td>
                                        {{--<td>{{$item->created_at->diffForHumans()}}</td>--}}
                                        {{--<td>{{$item->updated_at->diffForHumans()}}</td>--}}
                                        <td>
                                            <a class="btn btn-icon btn-default" data-toggle="tooltip"
                                               href="{{"/admin/files/create/".$item->id}}"
                                               title="编辑">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a class="btn btn-icon btn-danger btn-delete"
                                               data-toggle="tooltip"
                                               href="javascript:;" title="删除" data-operate-type="delete"
                                               data-item-id="{{$item->id}}" data-item-filename="{{$item->filename}}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="20">
                                        <div class="alert alert-warning" role="alert" style="text-align: center;">
                                            无相关信息
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    {{--<div class="col-sm-4 dataTables_info">--}}
                    {{--显示第1-20行，共444行--}}
                    {{--</div>--}}
                    <div class="col-sm-12">
                        {{$files->links()}}
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('script')
            <script type="text/javascript">

                $(document).ready(function () {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $('.btn-delete').click(function () {
                        var itemId = $(this).attr("data-item-id");
                        var itemName = $(this).attr("data-item-filename");
                        if (window.confirm('你确定要删除 ' + itemName + ' 吗？')) {
                            $.ajax({
                                type: "POST",
                                url: "/admin/files/delete",
                                data: {id: itemId},
                                dataType: "JSON",
                                success: function (data) {
                                    console.log(data);
                                    if (!0 != data.error) {
                                        return false;
                                    }
                                }
                            });
                            location.reload();
                        } else {
                            return false;
                        }
                    });

                    return false;
                });

            </script>
@endsection