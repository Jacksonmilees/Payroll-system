
<?php $__env->startSection('title', __('Leave Application Lists')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo __('Leave Reports'); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('Leave'); ?></a></li>
            <li class="active"><?php echo __('Leave Application lists'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Leave Application lists'); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="my-2">
                        <form action="<?php echo URL::current();; ?>" method="GET">
                            <div class="mb-3" style="display: flex;">
                                <input type="date" class="form-control" style="margin: 10px;" name="start_date" value="<?php echo request()->start_date ?? ''; ?>">
                                <input type="date" class="form-control" style="margin: 10px;" name="end_date" value="<?php echo request()->end_date ?? ''; ?>">
                                <button class="btn btn-primary" style="margin: 10px;" type="submit">GET</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br>
                <div id="printable_area" class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo __('SL'); ?></th>
                                <th><?php echo __('Name'); ?></th>
                                <th><?php echo __('ID'); ?></th>
                                <th><?php echo __('Designation'); ?></th> 
                                <th><?php echo __('Applied Leave (Approved)'); ?></th>
                                <th><?php echo __('Requested Leave'); ?></th>
                                <th><?php echo __('Total Leave'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php ($sl = 1); ?>
                            <?php ($total_leave = 0); ?>
                            <?php ($total_requested_leave = 0); ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $user->name; ?></td>
                                <td><?php echo $user->employee_id; ?></td>
                                <td><?php echo $user->designation; ?></td>
                                <td>
                                    <?php $__currentLoopData = $applied_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applied_leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user->id == $applied_leave->created_by): ?>
                                    <?php echo $applied_leave->leave_application; ?>

                                    <?php ($total_leave += $applied_leave->leave_application); ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </td>
                                <td>
                                    <?php $__currentLoopData = $requested_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requested_leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user->id == $requested_leave->created_by): ?>
                                    <?php echo $requested_leave->leave_application; ?>

                                    <?php ($total_requested_leave += $requested_leave->leave_application); ?>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td>
                                    <?php echo $total_leave+$total_requested_leave; ?>

                                    <?php ($total_leave = 0); ?>
                                    <?php ($total_requested_leave = 0); ?>
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