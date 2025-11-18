
<?php $__env->startSection('title', __('NSSF Report')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo __('NSSF'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('NSSF'); ?></a></li>
            <li class="active"><?php echo __('NSSF'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('NSSF Report'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
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
            <div id="printable_area" class="col-md-12 table-responsive">
                   <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="12%"><?php echo __(' PAYROLL NUMBER'); ?></th>
                                <th><?php echo __(' SURNAME'); ?></th>
                                <th><?php echo __(' OTHER NAMES'); ?></th>
                                <th><?php echo __(' ID NO'); ?></th>
                                <th><?php echo __(' KRA PIN'); ?></th>
                                <th><?php echo __(' NSSF NO'); ?></th>
                                <th><?php echo __(' GROSS PAY'); ?></th>
                                <th><?php echo __(' AMOUNT'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php $sl = 1; ?>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $allowance = $employee['house_rent_allowance'] + $employee['medical_allowance'] + $employee['special_allowance'] + $employee['other_allowance'];
                                $gross_salary= $employee['basic_salary'] + $allowance;
                            ?>
                            <tr>
                                <td><?php echo $employee['employee_id']; ?></td>
                                <td><?php echo $employee['name']; ?></td>
                                <td><?php echo $employee['mother_name'] .' '.$employee['father_name']; ?></td>
                                <td><?php echo $employee['id_number']; ?></td>
                                <td><?php echo $employee['kra_no']; ?></td>
                                <td><?php echo $employee['nssf_no']; ?></td>
                                <td><?php echo $gross_salary; ?></td>
                                <td><?php echo ($gross_salary <= 36000 ? $gross_salary * 6 / 100 : 2160); ?></td>
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