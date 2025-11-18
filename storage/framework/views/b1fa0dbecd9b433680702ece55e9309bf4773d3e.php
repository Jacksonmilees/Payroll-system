
<?php $__env->startSection('title', __('Add Loan/Credit')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo __('LOAN/CREDIT'); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard'); ?> </a></li>
            <li><a href="<?php echo url('/hrm/loans'); ?>"><?php echo __('Manage Loan/Credit'); ?></a></li>
            <li class="active"><?php echo __('Add Loan/Credit'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Add Loan/Credit'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="<?php echo url('/hrm/loans/store'); ?>" method="post" name="loan_add_form">
                <?php echo csrf_field(); ?>

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
                            <?php else: ?>
                                <p class="text-yellow"><?php echo __('Enter loan details. All field are required.'); ?> </p>
                            <?php endif; ?>
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                            <label for="user_id"><?php echo __('Employee Name '); ?><span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('user_id') ? ' has-error' : ''; ?> has-feedback">
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="" selected disabled><?php echo __('Select one'); ?></option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo $user['id']; ?>"><?php echo $user['name'].' '.$user['father_name']; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('user_id')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('user_id'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="loan_name"><?php echo __('Loan Name'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('loan_name') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="loan_name" id="loan_name" class="form-control" value="<?php echo old('loan_name'); ?>" placeholder="<?php echo __('Enter loan name..'); ?>">
                                <?php if($errors->has('loan_name')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('loan_name'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="number_of_installments"><?php echo __('Number of Installment'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('number_of_installments') ? ' has-error' : ''; ?> has-feedback">
                                    <input type="text" name="number_of_installments" class="form-control pull-right" value="<?php echo old('number_of_installments'); ?>" id="number_of_installments" placeholder="<?php echo __('Enter number of installment'); ?>">
                                <?php if($errors->has('number_of_installments')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('number_of_installments'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="loan_amount"><?php echo __('Loan Amount '); ?><span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('loan_amount') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="loan_amount" id="loan_amount" class="form-control" value="<?php echo old('loan_amount'); ?>" placeholder="<?php echo __('Enter loan name..'); ?>">
                                <?php if($errors->has('loan_amount')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('loan_amount'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                            
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <label for="loan_description"><?php echo __('Loan Description'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('loan_description') ? ' has-error' : ''; ?> has-feedback">
                                <textarea class="textarea text-description" name="loan_description" id="loan_description" placeholder="<?php echo __('Enter loan description..'); ?>"><?php echo old('loan_description'); ?></textarea>
                                <?php if($errors->has('loan_description')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('loan_description'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?php echo url('/hrm/loans'); ?>" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> <?php echo __('Cancel'); ?></a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> <?php echo __('Add loan'); ?></button>
                </div>
            </form>
        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['loan_add_form'].elements['user_id'].value = "<?php echo old('user_id'); ?>";
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>