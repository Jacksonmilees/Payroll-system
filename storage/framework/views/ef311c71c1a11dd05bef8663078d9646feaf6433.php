
<?php $__env->startSection('title', __('Manage Increment')); ?>

<?php $__env->startSection('main_content'); ?>


<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo __('INCREMENT'); ?>

    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
      <li><a><?php echo __('Increment'); ?></a></li>
      <li class="active"><?php echo __('Manage Increment'); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo __('Manage Increment'); ?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
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
        <div class="col-md-12">


          <form class="form-horizontal" action="<?php echo url('/hrm/payroll/increment/store'); ?>" method="post">
            <?php echo csrf_field(); ?>




            <div class="form-group<?php echo $errors->has('user_id') ? ' has-error' : ''; ?>">
              <label for="user_id" class="col-sm-3 control-label"><?php echo __('Employee Name'); ?></label>
              <div class="col-sm-6">
                <select name="emp_id" id="user_id" class="form-control">
                  <option value=""><?php echo __('Select One'); ?></option>
                  <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo $employee['id']; ?>"><strong><?php echo $employee['name']; ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php if($errors->has('user_id')): ?>
                  <span class="help-block">
                    <strong><?php echo $errors->first('user_id'); ?></strong>
                  </span>
                  <?php endif; ?>
                </div>
              </div>
              <!-- /.end group -->
              <div class="form-group<?php echo $errors->has('salary_month') ? ' has-error' : ''; ?>">
                <label for="salary_month" class="col-sm-3 control-label"><?php echo __('Select Month'); ?></label>
                <div class="col-sm-6">
                  <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" name="date" id="monthpicker" class="form-control pull-right" value="<?php echo old('salary_month'); ?>" id="datepicker">
                    <?php if($errors->has('salary_month')): ?>
                    <span class="help-block">
                      <strong><?php echo $errors->first('salary_month'); ?></strong>
                    </span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

               <div class="form-group<?php echo $errors->has('user_id') ? ' has-error' : ''; ?>">
              <label for="user_id" class="col-sm-3 control-label"><?php echo __('Increment Amount'); ?></label>
              <div class="col-sm-6">
               <input type="text" name="amount" class="form-control" placeholder="<?php echo __('Amount'); ?>">
                </div>
              </div>

              <div class="form-group<?php echo $errors->has('user_id') ? ' has-error' : ''; ?>">
              <label for="user_id" class="col-sm-3 control-label"><?php echo __('Increment Purpose'); ?></label>
              <div class="col-sm-6">
               <textarea type="text" name="incr_purpose" class="form-control"></textarea>
                </div>
              </div>
              <!-- /.end group -->
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-arrow-right"></i><?php echo __('Add Increment'); ?> </button>
                </div>
              </div>
              <!-- /.end group -->
            </form>
            <!-- /. end form -->
          </div>
          <!-- /. end col -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix"></div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>