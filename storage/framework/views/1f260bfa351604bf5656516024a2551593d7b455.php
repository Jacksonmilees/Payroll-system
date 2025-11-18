<?php $__env->startSection('title', __('Leave Categories')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo __('LEAVE CATEGORY'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard'); ?> </a></li>
            <li><a><?php echo __('Setting'); ?></a></li>
            <li class="active"><?php echo __('Leave Categories'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Manage leave categories'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                
                <div  class="col-md-6">
                    <a href="<?php echo url('/setting/leave_categories/create'); ?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> <?php echo __('Add leave category'); ?></a>
                </div>
                <div  class="col-md-6">
                    <input type="text" id="myInput" class="form-control" placeholder="<?php echo __('Search..'); ?>">
                </div>
                <!-- Notification Box -->
                <div class="col-md-12">
                    <?php if(!empty(Session::get('message'))): ?>
                        <div class="alert alert-success alert-dismissible" id="notification_box">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-check"></i> <?php echo Session::get('message'); ?>

                        </div>
                    <?php elseif(!empty(Session::get('exception'))): ?>
                        <div class="alert alert-warning alert-dismissible" id="notification_box">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-warning"></i> <?php echo Session::get('exception'); ?>

                        </div>
                    <?php endif; ?>
                </div>
                <!-- /.Notification Box -->
                <div class="col-md-12 table-responsive">
                    <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo __('SL#'); ?></th>
                                <th><?php echo __('Category Name'); ?></th>
                                <th><?php echo __('Category Description'); ?></th>
                                <th class="text-center"><?php echo __('Added By'); ?></th>
                                <th class="text-center"><?php echo __('Added'); ?></th>
                                <th class="text-center"><?php echo __('Status'); ?></th>
                                <th class="text-center"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php ($sl = 1); ?>
                            <?php $__currentLoopData = $leave_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a href="<?php echo url('/setting/leave_categories/details/' . $leave_category['id']); ?>"><?php echo $sl++; ?></a></td>
                                <td><?php echo $leave_category['leave_category']; ?></td>
                                <td><?php echo str_limit($leave_category['leave_category_description'], 65); ?></td>
                                <td class="text-center"><?php echo $leave_category['name']; ?></td>
                                <td class="text-center"><?php echo date("d F Y", strtotime($leave_category['created_at'])); ?></td>
                                <td class="text-center">
                                <?php if($leave_category['publication_status'] == 1): ?>
                                    <span class="label label-success"><?php echo __('Published'); ?></span>
                                <?php else: ?>
                                <span class="label label-warning"><?php echo __('Unpublished'); ?></span>
                                <?php endif; ?>
                                </td>
                                <td class="text-center">
                                   <a href="<?php echo url('/setting/leave_categories/edit/' . $leave_category['id']); ?>"><i class="icon fa fa-edit"></i> <?php echo __('Edit'); ?></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>