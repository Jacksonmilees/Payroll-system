<?php $__env->startSection('title', __('Provident Funds')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?php echo __('PROVIDENT FUND'); ?>  
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
      <li><a><?php echo __('Provident Fund'); ?></a></li>
      <li class="active"><?php echo __('Provident Funds'); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Manage Salary Payment'); ?></h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="row">
              
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
              <div class="col-md-12">
                <div id="printable_area" class="table-responsive">
                  <table class="table table-bordered">
                  <thead>
                     <tr class="bg-info">
                      <th><?php echo __('sl'); ?></th>
                      <th><?php echo __('Employee Name'); ?></th>
                      <th><?php echo __('ID'); ?></th>
                      <th><?php echo __('Designation'); ?></th>
                      <th><?php echo __('Subscription Amount'); ?></th>
                      <th><?php echo __('Contribution Amount'); ?></th>
                      <th><?php echo __('Total Provident Funds'); ?></th>
                
                    </tr>
                  </thead>
                  <tbody id="myTable">
                    <?php ($sl = 1); ?>
                    <?php ($total = 0); ?>
                    <?php ($total_provident_fund  = 0); ?>
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <?php $__currentLoopData = $provident_funds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provident_fund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($employee['id'] == $provident_fund->user_id): ?>
                      <?php ($total += $provident_fund->total_provident_fund); ?>
                      <?php ($total_provident_fund = $provident_fund->total_provident_fund); ?>
                      <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <td><?php echo $sl++; ?></td>
                      <td><?php echo $employee['name']; ?></td>
                      <td><?php echo $employee['employee_id']; ?></td>
                      <td><?php echo $employee['designation']; ?></td>
                      <td><?php echo $total_provident_fund/2; ?></td>
                      <td><?php echo $total_provident_fund/2; ?></td>
                      <td><?php echo $total_provident_fund; ?></td>


                      <!--<td><p class="text-warning">Unpaid</p></td>-->
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tr>
                    <td colspan="7"> &nbsp; </td>
                  </tr>
                  <tr class="info">
                    <td colspan="5"> &nbsp; </td>
                    <td><strong><?php echo __('Total:'); ?></strong></td>
                    <td><?php echo $total; ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /. end col -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"></div>
          <!-- /.box-footer -->
        </div>
      </div>
      <!-- /.box -->
    </div>

  </div>
  <!-- /.end.row -->
</section>
<!-- /.content -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>