
<?php $__env->startSection('title', __('Edit '.$title)); ?>
<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo __(strtoupper($title)); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __(' Dashboard'); ?></a></li>
            <li><a href="<?php echo url('/hrm/'.$type); ?>"><?php echo __('Manage '.$title); ?></a></li>
            <li class="active"><?php echo __('Edit '.$title); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Edit '.$title); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="<?php echo url('/hrm/'.$type.'/update/' . $deduction['id']); ?>" method="post" name="deduction_add_form">
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
                                <p class="text-yellow"><?php echo __('Enter deduction details. All field are required.'); ?> </p>
                            <?php endif; ?>
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                            <label for="user_id"><?php echo __('Employee Name'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('user_id') ? ' has-error' : ''; ?> has-feedback">
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="" selected disabled><?php echo __('Select one'); ?></option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('user_id')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('user_id'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                            <input type="hidden" value="<?php echo $type; ?>" name="type">

                            <!-- /.form-group -->
                            <label for="deduction_name"><?php echo __($title.' Name'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('deduction_name') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="deduction_name" id="deduction_name" class="form-control" value="<?php echo $deduction['deduction_name']; ?>" placeholder="<?php echo __('Enter '.$title. ' name..'); ?>">
                                <?php if($errors->has('deduction_name')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('deduction_name'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="deduction_month"><?php echo __($title.' Month'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('deduction_month') ? ' has-error' : ''; ?> has-feedback">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="deduction_month" class="form-control pull-right" value="<?php echo $deduction['deduction_month']; ?>" id="monthpicker2">
                                </div>
                                <?php if($errors->has('deduction_month')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('deduction_month'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="deduction_amount"><?php echo __($title.' Amount'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('deduction_amount') ? ' has-error' : ''; ?> has-feedback">
                                <input type="number" name="deduction_amount" id="deduction_amount" class="form-control" value="<?php echo $deduction['deduction_amount']; ?>" placeholder="<?php echo __('Enter '.$title.' name..'); ?>">
                                <?php if($errors->has('deduction_amount')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('deduction_amount'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                            
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <label for="deduction_description"><?php echo __($title.' Description'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('deduction_description') ? ' has-error' : ''; ?> has-feedback">
                                <textarea class="textarea text-description" name="deduction_description" id="deduction_description" placeholder="<?php echo __('Enter '.$title.' description..'); ?>"><?php echo $deduction['deduction_description']; ?></textarea>
                                <?php if($errors->has('deduction_description')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('deduction_description'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        
                        <!--<div class="col-md-12">-->
                        <!--    <div class="card-body">   -->
                        <!--              <div class="form-group<?php echo $errors->has('deduction_description') ? ' has-error' : ''; ?> has-feedback">-->
                        <!--                <label class='checkbox-inline'>-->
                        <!--                  <input type="checkbox" name="house_leavy" value="1.5" <?php echo $deduction['house_leavy'] == 1.5 ? 'checked' :''; ?>>-->
                        <!--                  House Leavy-->
                        <!--                </label>-->
                        <!--                <?php if($errors->has('house_leavy')): ?>-->
                        <!--                <span class="help-block">-->
                        <!--                    <strong><?php echo $errors->first('house_leavy'); ?></strong>-->
                        <!--                </span>-->
                        <!--                <?php endif; ?>-->
                        <!--              </div>-->
                        <!--        </div>-->
                            <!-- /.form-group -->
                        <!--</div>-->
                        <!-- /.col -->
                        
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?php echo url('/hrm/'.$type); ?>" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> <?php echo __('Cancel'); ?></a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-edit"></i> <?php echo __('Update '.$title); ?></button>
                </div>
            </form>
        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['deduction_add_form'].elements['user_id'].value = "<?php echo $deduction['user_id']; ?>";
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>