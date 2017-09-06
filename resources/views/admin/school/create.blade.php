@extends("admin.layout.main")

@section("content")
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">@if(isset($school->id))编辑学校@else增加学校@endif</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="/admin/school/store" method="POST" id="form-school">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">学校名</label>
                                    <input type="hidden" value="{{$school->id or 0}}" name="id">
                                    <input type="text" class="form-control" name="name" id="name" minlength="2" required
                                           value="@if(!empty($school)){{$school->name}}@endif">
                                </div>
                            </div>
                        @include('admin.layout.error')
                        <!-- /.box-body -->
                            <div class="box-footer">
                                <a class="btn btn-icon btn-default m-b-5" href="/admin/school"
                                   title="取消">
                                    取消
                                </a>
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#form-school").validate();
        });
    </script>
@endsection