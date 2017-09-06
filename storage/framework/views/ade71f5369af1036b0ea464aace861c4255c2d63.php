<?php $__env->startSection("content"); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">增加学校</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="/admin/school/store" method="POST" id="form-school">
                            <?php echo e(csrf_field()); ?>

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">学校名</label>
                                    <input type="hidden" value="<?php echo e(isset($school->id) ? $school->id : 0); ?>" name="id">
                                    <input type="text" class="form-control" name="name" id="name" minlength="2" required
                                           value="<?php if(!empty($school)): ?><?php echo e($school->name); ?><?php endif; ?>">
                                </div>
                            </div>
                        <?php echo $__env->make('admin.layout.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#form-school").validate();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.main", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>