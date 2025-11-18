
<?php $__env->startSection('title', __('Update Profile')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo __('PROFILE'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard'); ?> </a></li>
            <li class="active"><?php echo __('Update Profile'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Update Profile'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <form action="<?php echo url('/profile/update-profile'); ?>" method="post" name="user_edit_form" enctype="multipart/form-data">
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
                            <p class="text-yellow"><?php echo __('You can update your profile. All'); ?> (<span class="text-danger">*</span>) <?php echo __('field are required.'); ?> </p>
                            <?php endif; ?>
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                            <label for="name"><?php echo __('Full Name'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('name') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="name" id="name" class="form-control" value="<?php echo $user['name']; ?>" placeholder="<?php echo __('Enter name..'); ?>">
                                <?php if($errors->has('name')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('name'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="email"><?php echo __('Email'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group has-feedback">
                                <input type="text" id="email" class="form-control" value="<?php echo $user['email']; ?>" disabled>
                            </div>
                            <!-- /.form-group -->

                            <label for="contact_no_one"><?php echo __('Contact No'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('contact_no_one') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="contact_no_one" id="contact_no_one" class="form-control" value="<?php echo $user['contact_no_one']; ?>" placeholder="<?php echo __('Enter contact no..'); ?>">
                                <?php if($errors->has('contact_no_one')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('contact_no_one'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="web"><?php echo __('Web'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('web') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="web" id="web" class="form-control" value="<?php echo $user['web']; ?>" placeholder="<?php echo __('Enter contact no..'); ?>">
                                <?php if($errors->has('web')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('web'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="avatar"><?php echo __('Profile Picture'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('avatar') ? ' has-error' : ''; ?> has-feedback">
                                <input type="file" name="avatar" id="avatar" class="form-control">
                                <input type="hidden" name="previous_avater" value="<?php echo $user['avatar']; ?>">
                                <?php if($errors->has('avatar')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('avatar'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                        </div>
                        <!-- /.col -->

                        <div class="col-md-6">
                            <label for="present_address"><?php echo __('Present Address'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('present_address') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="present_address" id="present_address" class="form-control" value="<?php echo $user['present_address']; ?>" placeholder="<?php echo __('Enter contact no..'); ?>">
                                <?php if($errors->has('present_address')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('present_address'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="permanent_address"><?php echo __('Permanent Address'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('permanent_address') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="<?php echo $user['permanent_address']; ?>" placeholder="<?php echo __('Enter contact no..'); ?>">
                                <?php if($errors->has('permanent_address')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('permanent_address'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="gender"><?php echo __('Gender'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('gender') ? ' has-error' : ''; ?> has-feedback">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="" selected disabled><?php echo __('Select one'); ?></option>
                                    <option value="m"><?php echo __('Male'); ?></option>
                                    <option value="f"><?php echo __('Female'); ?></option>
                                </select>
                                <?php if($errors->has('gender')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('gender'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->

                            <label for="datepicker"><?php echo __('Date of Birth'); ?></label>
                            <div class="form-group<?php echo $errors->has('date_of_birth') ? ' has-error' : ''; ?> has-feedback">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="date_of_birth" class="form-control pull-right" value="<?php echo $user['date_of_birth']; ?>" id="datepicker">
                                </div>
                                <?php if($errors->has('date_of_birth')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('date_of_birth'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <?php if(!empty($user['avatar'])): ?>
                            <img src="<?php echo url('/public/profile_picture/' . $user['avatar']); ?>" alt="$user['avatar']" class="img-responsive img-thumbnail">
                            <?php else: ?>
                            <img src="<?php echo url('/public/profile_picture/blank_profile_picture.png'); ?>" alt="blank_profile_picture" class="img-responsive img-thumbnail">
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-edit"></i> <?php echo __('Update Profile'); ?></button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['user_edit_form'].elements['gender'].value = "<?php echo $user['gender']; ?>";
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>