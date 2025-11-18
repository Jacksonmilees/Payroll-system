
<?php $__env->startSection('title', __('NOC/Certificate Add')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo __('NOC/Certificate Add'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('HRM'); ?></a></li>
            <li><a href="<?php echo url('/setting/leave_categories'); ?>"><?php echo __('NOC'); ?></a></li>
            <li class="active"><?php echo __('Add NOC/Certificate Add'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Add NOC/Certificate'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="<?php echo url('/hrm/noc/store'); ?>" method="post" name="leave_category_add_form">
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
                                <p class="text-yellow"><?php echo __('Enter the All field are required.'); ?> </p>
                            <?php endif; ?>
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">

                             <!-- /.form-group -->
                            <label for="publication_status"><?php echo __('Employee'); ?><span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select name="empid" class="form-control">
                                    <?php $employees=\App\User::all()->where('access_label',2);?>
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo $emp->id; ?>">[<?php echo $emp->employee_id; ?>] <?php echo $emp->name; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <!-- /.form-group -->
                           
                            <!-- /.form-group -->
                            <label for="publication_status"><?php echo __('Type'); ?><span class="text-danger">*</span></label>
                            <div class="form-group">
                                <select name="category" class="form-control">
                                    <option value="1"><?php echo __('NOC'); ?></option>
                                    <option value="2"><?php echo __('Experience Certificate'); ?></option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <label><?php echo __('Description'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <textarea class="textarea text-description" name="details" placeholder="<?php echo __('Enter description..'); ?>"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                         <div class="col-md-12">
                            <label><?php echo __('Bottom'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <textarea class="textarea text-description" name="bottom" placeholder="<?php echo __('Enter bottom description'); ?>"></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->


                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> <?php echo __('Save'); ?> </button>

                    <button type="button" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i><?php echo __('Cancel'); ?> </button>
                </div>
            </form>
        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['leave_category_add_form'].elements['publication_status'].value = "<?php echo old('publication_status'); ?>";
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>