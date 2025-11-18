<?php $__env->startSection('title', __('Role Edit')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo __('ROLE'); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('Setting'); ?></a></li>
            <li><a href="<?php echo url('/setting/role-types'); ?>"><?php echo __('Role'); ?></a></li>
            <li class="active"><?php echo __('Edit role'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Edit role'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle=tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="<?php echo route('setting.role.update', $role->id); ?>" method="post" role="form">
              <?php echo method_field('PATCH'); ?>

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
                        <p class="text-yellow"><?php echo __('Enter role type details. All field are required.'); ?> </p>
                        <?php endif; ?>
                    </div>
                    <!-- /.Notification Box -->

                    <div class="col-md-6">
                        <label for="name"><?php echo __('Name of Role'); ?> <span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('name') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $role->name; ?>">
                            <?php if($errors->has('name')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('name'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <!-- /.form-group -->
                        <label for="display_name"><?php echo __('Display Name'); ?> <span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('display_name') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="display_name" id="display_name" class="form-control" value="<?php echo $role->display_name; ?>">
                            <?php if($errors->has('display_name')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('display_name'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <!-- /.form-group -->
                        <label for="description"><?php echo __('Description '); ?><span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('description') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="description" id="description" class="form-control" value="<?php echo $role->description; ?>">
                            <?php if($errors->has('description')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('description'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-12">
                        <label for="description"><?php echo __('Permissions'); ?> <span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('permission[]') ? ' has-error' : ''; ?> has-feedback">
                         <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <input type="checkbox" <?php echo in_array($permission->id,$role_permissions)?"checked":""; ?>   name="permission[]" value="<?php echo $permission->id; ?>" > <?php echo $permission->name; ?> <br>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
                     <!-- /.form-group -->
                 </div>
                 <!-- /.col -->
             </div>
             <!-- /.row -->
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
            <a href="<?php echo route('setting.role.index'); ?>" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i><?php echo __('Cancel'); ?> </a>
            <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-edit"></i> <?php echo __('Update Role'); ?></button>
        </div>
    </form>
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>