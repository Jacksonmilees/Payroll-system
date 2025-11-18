
<?php $__env->startSection('title', __('NHIF Report')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo __('SHIF'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('NHIF'); ?></a></li>
            <li class="active"><?php echo __('NHIF Report'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('SHIF Report'); ?></h3>

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
                    <div class="row">
                        <div class="col-md-12" style="margin: 10px 0;">
                            
                            <h5><b>EMPLOYER NAME</b>   SOL POINT BASE LTD</h5>
                            <h5>
                                <b>MONTH OF CONTRIBUTION</b>   <?php echo date('F Y '); ?>

                            </h5>
                        </div>
                    </div>
                        <thead>
                            <tr>
                                <th width="10%"><?php echo __(' PAYROLL NO'); ?></th>
                                <th><?php echo __(' FIRST NAME'); ?></th>
                                <th><?php echo __(' LAST NAME'); ?></th>
                                <th><?php echo __(' ID NO'); ?></th>
                                <th><?php echo __(' SHIF NO'); ?></th>
                                <th><?php echo __(' SHIF Amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php $sl = 1; ?>
                            <?php $total = 0; ?>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $nhif = $employee['nhif'];
                            ?>
                            <tr>
                                <td><?php echo $employee['employee_id']; ?></td>
                                <td><?php echo $employee['name']; ?></td>
                                <td><?php echo $employee['mother_name'] .' '.$employee['father_name']; ?></td>
                                <td><?php echo $employee['id_number']; ?></td>
                                <td><?php echo $employee['nhif_no']; ?></td>
                                <td><?php echo $employee['basic_salary'] * 2.75 / 100; ?></td>
                                <?php $total += $employee['basic_salary'] * 2.75 / 100; ?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                            </tr>
                            <tr class="info">
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td><strong><?php echo __('Total:'); ?></strong></td>
                              <td><?php echo $total; ?></td>
                            </tr>
                        </tfoot>
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