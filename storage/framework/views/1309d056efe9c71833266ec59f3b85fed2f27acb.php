<?php $__env->startSection('actions'); ?>
    <a class="btn btn-icon btn-primary m-b-5" href="<?php echo e(url("/live/home/update")); ?>"> <i class="fa fa-plus"></i></a>
    <button class="btn btn-icon btn-danger m-b-5 btn-batch-delete" data-operate-type="batch-delete"><i
                class="fa fa-trash"></i></button>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('panel-header'); ?>
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
                                           placeholder=" 请输入关键字" value="<?php echo e(isset($searchCondition['title']) ? $searchCondition['title'] : ''); ?>"/>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if(count($schools)>0): ?>
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
                            <?php if(count($schools)): ?>
                                <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td width="10%">
                                            <div class="checkbox">
                                                <label class="cr-styled">
                                                    <input class="chk-item" type="checkbox" name="item_id[]"
                                                           value="<?php echo e($item['id']); ?>">
                                                    <i class="fa"></i>
                                                    <?php echo e($item['id']); ?>

                                                </label>
                                            </div>
                                        </td>
                                        <td id="item_title_<?php echo e($item['id']); ?>" width="15%"><?php echo e($item['title']); ?></td>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        
                                        
                                        
                                        
                                        
                                        

                                        

                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        

                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        

                                        
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-warning" role="alert" style="text-align: center;">
                                            无相关信息
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo e($schools->links()); ?>

                </form>
            <?php else: ?>

            <?php endif; ?>
            <div class="hidden-box" style="display: none;">
                <input type="hidden" id="operate_type" value="">
                <input type="hidden" id="will_operate_item_id" value="">
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>




























































































































































































































































































































































































































<?php echo $__env->make("admin.layout.main", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>