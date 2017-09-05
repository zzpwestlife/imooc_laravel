<?php $__env->startSection('css'); ?>

    <style type="text/css">
        .table > tbody > tr > td {
            vertical-align: middle;
        }

    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">学校列表</h3>
                    </div>
                    <a type="button" class="btn " href="/admin/schools/create">增加学校</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>学校名</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            <?php if(count($schools) > 0): ?>
                                <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item->id); ?></td>
                                        <td><?php echo e($item->name); ?></td>
                                        <td><?php echo e($item->created_at); ?></td>
                                        <td>
                                            <a class="btn btn-icon btn-default" data-toggle="tooltip"
                                               href="<?php echo e("/admin/school/update/".$item->id); ?>"
                                               title="编辑">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a class="btn btn-icon btn-info"
                                               data-toggle="tooltip"
                                               href="<?php echo e("/admin/major?school_id=".$item->id); ?>"
                                               title="学院专业管理">
                                                <i class="fa fa-list-ol"></i>
                                            </a>

                                            <a class="btn btn-icon btn-danger resource-delete"
                                               data-toggle="tooltip" title='删除' delete-url="/admin/school/<?php echo e($item->id); ?>"
                                               href="#">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="20">
                                        <div class="alert alert-warning" role="alert" style="text-align: center;">
                                            无相关信息
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <?php echo e($schools->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">

        $(function () {

            $(".select2").select2({language: "zh-CN", 'theme': "bootstrap"});

            // 全选效果
            $("#checkbox_all").checkAll();

            // 搜索 按钮
            searchWithParams('/live/home?page=1');
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.main", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>