<?php $__env->startSection('title', __('Employee')); ?>
<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php echo __('Employees Report'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('Employee'); ?></a></li>
            <li class="active"><?php echo __('Employees Report'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Employees List'); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                 <div class="col-md-6">
                    <div class="my-2">
                        <form action="<?php echo URL::current();; ?>" method="GET">
                            <div class="mb-3" style="display: flex;">
                                <input type="date" class="form-control" style="margin-top: 10px;" name="start_date" value="<?php echo request()->start_date ?? ''; ?>">
                                <input type="date" class="form-control" style="margin: 10px;" name="end_date" value="<?php echo request()->end_date ?? ''; ?>">
                                <button class="btn btn-primary" style="margin: 10px;" type="submit">GET</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- /.Notification Box -->
                <div id="printable_area" class="col-md-12 table-responsive">
                    <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo __(' EMP-NO'); ?></th>
                                <th><?php echo __(' EMP Full Name'); ?></th>
                                <th><?php echo __(' ID No'); ?></th>
                                <th><?php echo __(' Designation'); ?></th>
                                <th><?php echo __(' Gender'); ?></th>
                                <th><?php echo __(' D.O.B'); ?></th>
                                <th><?php echo __(' NSSF No'); ?></th>
                                <th><?php echo __(' NHIF No'); ?></th>
                                <th><?php echo __(' KRA PIN'); ?></th>
                                <th><?php echo __(' Bank Name'); ?></th>
                                <th><?php echo __(' Account No'); ?></th>
                                <th class="text-center"><?php echo __('Added'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo sprintf('%04s', $employee['employee_id']); ?></td>
                                <td><?php echo $employee['name'].' '.$employee['mother_name'] .' '.$employee['father_name']; ?></td>
                                <td><?php echo $employee['id_number']; ?></td>
                                <td><?php echo $employee['designation']; ?></td>
                                <td><?php echo ($employee['gender']=='m') ? 'Male' : 'Female'; ?></td>
                                <td><?php echo date("d F Y", strtotime($employee['date_of_birth'])); ?></td>
                                <td><?php echo $employee['nssf_no']; ?></td>
                                <td><?php echo $employee['nhif_no']; ?></td>
                                <td><?php echo $employee['kra_no']; ?></td>
                                <td><?php echo $employee['bank_name']; ?></td>
                                <td><?php echo $employee['bank_acc_no']; ?></td>
                                <td class="text-center"><?php echo date("d F Y", strtotime($employee['created_at'])); ?></td>
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