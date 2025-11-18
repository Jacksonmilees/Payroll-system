
<?php $__env->startSection('title', __('Add Employee')); ?>
<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php echo __(' EMPLOYEE'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard'); ?> </a></li>
            <li><a href="<?php echo url('/people/employees'); ?>"><?php echo __('Employee'); ?></a></li>
            <li class="active"><?php echo __('Add Employee'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="<?php echo url('people/employees/store'); ?>" method="post" enctype="multipart/form-data" name="employee_add_form">
            <?php echo csrf_field(); ?>

            <!-- SELECT2 EXAMPLE -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __('Add Employee'); ?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
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
                            <p class="text-yellow"><?php echo __('Enter team member details. All (*)field are required.'); ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- /.Notification Box -->
                        <?php
                        $users = \App\User::orderBy('id', 'desc')->first();
                        $sl=$users->employee_id;
                        $sl++;
                        ?>
                        <div class="col-md-6">
                            <label for="employee_id"><?php echo __('ID'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('emplolyee_id') ? ' has-error' : ''; ?> has-feedback">
                                <input type="hidden" name="employee_id" value="<?php echo sprintf('%04s', $sl); ?>">
                                <input type="text" class="form-control" value="<?php echo sprintf('%04s',$sl); ?>" disabled>
                            </div>
                            <!-- /.form-group -->
                            <label for="id_name"><?php echo __('ID Name'); ?></label>
                            <div class="form-group<?php echo $errors->has('id_name') ? ' has-error' : ''; ?> has-feedback">
                                <select name="id_name" id="id_name" class="form-control">
                                    <option value="" selected disabled><?php echo __('Select one'); ?></option>
                                    <option value="1"><?php echo __('NID'); ?></option>
                                    <option value="2"><?php echo __('Passport'); ?></option>
                                    <option value="3"><?php echo __('Driving License'); ?></option>
                                </select>
                                <?php if($errors->has('id_name')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('id_name'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <label for="name"><?php echo __('First Name'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('name') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="name" id="name" class="form-control alphabets" value="<?php echo old('name'); ?>" placeholder="<?php echo __('Enter first name..'); ?>">
                                <?php if($errors->has('name')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('name'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                            <label for="father_name"><?php echo __('Last Name'); ?></label>
                            <div class="form-group<?php echo $errors->has('father_name') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="father_name" id="father_name" class="form-control alphabets" value="<?php echo old('father_name'); ?>" placeholder="<?php echo __('Enter last name..'); ?>">
                                <?php if($errors->has('father_name')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('father_name'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <label for="designation_id"><?php echo __('Designation'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('designation_id') ? ' has-error' : ''; ?> has-feedback">
                                <select name="designation_id" id="designation_id" class="form-control">
                                    <option value="" selected disabled><?php echo __('Select one'); ?></option>
                                    <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo $designation['id']; ?>"><?php echo $designation['designation']; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('designation_id')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('designation_id'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                            <!-- /.form-group -->
                            
                            <label for="datepicker4"><?php echo __('Joining Date'); ?><span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('joining_date') ? ' has-error' : ''; ?> has-feedback">
                                <div class="input-group date">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="joining_date" class="form-control pull-right" id="datepicker4" placeholder="<?php echo __('yyyy-mm-dd'); ?>">
                                </div>
                                <?php if($errors->has('joining_date')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('joining_date'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <label for="nhif_no"><?php echo __('NHIF No'); ?></label>
                            <div class="form-group<?php echo $errors->has('nhif_no') ? ' has-error' : ''; ?> has-feedback">
                                <input type="nhif_no" name="nhif_no" class="form-control digits" value="<?php echo old('nhif_no'); ?>" id="nhif_no" placeholder="Enter NHIF No">
                                <?php if($errors->has('nhif_no')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('nhif_no'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <label for="kra_no"><?php echo __('KRA PIN'); ?></label>
                            <div class="form-group<?php echo $errors->has('kra_no') ? ' has-error' : ''; ?> has-feedback">
                                <input type="kra_no" name="kra_no" class="form-control alpha-digits" value="<?php echo old('kra_no'); ?>" id="kra_no" placeholder="Enter KRA PIN">
                                <?php if($errors->has('kra_no')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('kra_no'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <label for="kin_details_relation"><?php echo __('Next of Kin Relationship'); ?>  <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('kin_details_relation') ? ' has-error' : ''; ?> has-feedback">
                                <input type="kin_details_relation" name="kin_details_relation" class="form-control" value="<?php echo old('kin_details_relation'); ?>" id="kin_details_relation" placeholder="Enter Next of Kin Relationship">
                                <?php if($errors->has('kin_details_relation')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('kin_details_relation'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                            <label for="passport_picture"><?php echo __('Passport Picture'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('passport_picture') ? ' has-error' : ''; ?> has-feedback">
                                <input type="file" name="passport_picture" id="passport_picture" class="form-control">
                                <?php if($errors->has('passport_picture')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('passport_picture'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <input type="hidden" name="home_district" value="None">
                            <!-- /.form-group -->
                            <label for="role"><?php echo __('Role'); ?><span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('role') ? ' has-error' : ''; ?> has-feedback">
                                <select name="role" id="role"  class="form-control">
                                    <option value="" disabled><?php echo __('Select one'); ?></option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo $role->name; ?>"><?php echo $role->display_name; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('role')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('role'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                            <label for="id_number"><?php echo __('ID Number'); ?></label>
                            <div class="form-group<?php echo $errors->has('id_number') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="id_number" id="id_number" class="form-control digits" value="<?php echo old('id_number'); ?>" placeholder="<?php echo __('Enter id number..'); ?>">
                                <?php if($errors->has('id_number')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('id_number'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <label for="mother_name"><?php echo __('Middle Name'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('mother_name') ? ' has-error' : ''; ?> has-feedback">
                                <input type="text" name="mother_name" id="mother_name" class="form-control alphabets" value="<?php echo old('name'); ?>" placeholder="<?php echo __('Enter Middle name..'); ?>">
                                <?php if($errors->has('mother_name')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('mother_name'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                            <label for="joining_position"><?php echo __('Job Group'); ?> <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('joining_position') ? ' has-error' : ''; ?> has-feedback">
                                <select name="joining_position" id="joining_position" class="form-control">
                                    <option value="" selected disabled><?php echo __('Select one'); ?></option>
                                    <?php $departments= \App\Department::all();?>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo $department['id']; ?>"><?php echo $department['department']; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('joining_position')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('joining_position'); ?></strong>
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
                                    <input type="date" name="date_of_birth" class="form-control pull-right" value="<?php echo old('date_of_birth') ?: date('Y-m-d',strtotime(date('Y-m-d').'-18 years')); ?>" max="<?php echo date('Y-m-d',strtotime(date('Y-m-d').'-18 years')); ?>">
                                </div>
                                <?php if($errors->has('date_of_birth')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('date_of_birth'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <!-- /.form-group -->
                            <label for="nssf_no"><?php echo __('NSSF No'); ?></label>
                            <div class="form-group<?php echo $errors->has('nssf_no') ? ' has-error' : ''; ?> has-feedback">
                                <input type="nssf_no" name="nssf_no" class="form-control digits" value="<?php echo old('nssf_no'); ?>" id="nssf_no" placeholder="Enter NSSF No">
                                <?php if($errors->has('nssf_no')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('nssf_no'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <label for="kin_details_name"><?php echo __('Next of Kin Name'); ?>   <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('kin_details_name') ? ' has-error' : ''; ?> has-feedback">
                                <input type="kin_details_name" name="kin_details_name" class="form-control" value="<?php echo old('kin_details_name'); ?>" id="kin_details_name" placeholder="Enter Next of Kin Name">
                                <?php if($errors->has('kin_details_name')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('kin_details_name'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <label for="kin_details_phone"><?php echo __('Next of Kin Phone No'); ?>  <span class="text-danger">*</span></label>
                            <div class="form-group<?php echo $errors->has('kin_details_phone') ? ' has-error' : ''; ?> has-feedback">
                                <input type="kin_details_phone" name="kin_details_phone" class="form-control" value="<?php echo old('kin_details_phone'); ?>" id="kin_details_phone" placeholder="Enter Next of Kin Phone No">
                                <?php if($errors->has('kin_details_phone')): ?>
                                <span class="help-block">
                                    <strong><?php echo $errors->first('kin_details_phone'); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Contact Details </h4>
                        <label for="email"><?php echo __('Email'); ?> <span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('email') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="email" id="email" class="form-control" value="<?php echo old('email'); ?>" placeholder="<?php echo __('Enter email address..'); ?>">
                            <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('email'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <!-- /.form-group -->
                        <label for="emergency_contact"><?php echo __('Emergency Contact'); ?></label>
                        <div class="form-group<?php echo $errors->has('emergency_contact') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="<?php echo old('emergency_contact'); ?>" placeholder="<?php echo __('Enter emergency contact no..'); ?>">
                            <?php if($errors->has('emergency_contact')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('emergency_contact'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-6">
                        <h4>&nbsp;</h4>
                        <!-- /.form-group -->
                        <label for="password"><?php echo __('Login PIN'); ?></label>
                        <div class="form-group<?php echo $errors->has('password') ? ' has-error' : ''; ?> has-feedback">
                            <input type="password" name="password" class="form-control" value="<?php echo old('password'); ?>" id="password" placeholder="Enter Employee PIN">
                            <?php if($errors->has('password')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('password'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <label for="contact_no_one"><?php echo __('Contact No'); ?><span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('contact_no_one') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="contact_no_one" id="contact_no_one" class="form-control digits" value="<?php echo old('contact_no_one'); ?>" placeholder="<?php echo __('Enter contact no..'); ?>">
                            <?php if($errors->has('contact_no_one')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('contact_no_one'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Bank Details'); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>&nbsp;</h4>
                        <!-- /.form-group -->
                        <label for="account_name"><?php echo __('Account Name'); ?>  <span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('account_name') ? ' has-error' : ''; ?> has-feedback">
                            <input type="account_name" name="account_name" class="form-control alphabets" value="<?php echo old('account_name'); ?>" id="account_name" placeholder="Enter Account Name">
                            <?php if($errors->has('account_name')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('account_name'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <label for="bank_acc_no"><?php echo __('Bank Account Number'); ?>  <span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('bank_acc_no') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="bank_acc_no" id="bank_acc_no" class="form-control digits" value="<?php echo old('bank_acc_no'); ?>" placeholder="<?php echo __('Enter Bank Account No..'); ?>">
                            <?php if($errors->has('bank_acc_no')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('bank_acc_no'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <label for="bank_name"><?php echo __('Bank Name'); ?>  <span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('bank_name') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="bank_name" id="bank_name" class="form-control alphabets" value="<?php echo old('bank_name'); ?>" placeholder="<?php echo __('Enter Bank Name..'); ?>">
                            <?php if($errors->has('bank_name')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('bank_name'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <label for="bank_branch"><?php echo __('Bank Branch'); ?>  <span class="text-danger">*</span></label>
                        <div class="form-group<?php echo $errors->has('bank_branch') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="bank_branch" id="bank_branch" class="form-control" value="<?php echo old('bank_branch'); ?>" placeholder="<?php echo __('Enter Bank Branch..'); ?>">
                            <?php if($errors->has('bank_branch')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('bank_branch'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        
                        <label for="bank_sort_code"><?php echo __('Bank Sort Code (Bank+Branch Code) '); ?></label>
                        <div class="form-group<?php echo $errors->has('bank_sort_code') ? ' has-error' : ''; ?> has-feedback">
                            <input type="text" name="bank_sort_code" id="bank_sort_code" class="form-control" value="<?php echo old('bank_sort_code'); ?>" placeholder="<?php echo __('Enter Sort Code..'); ?>">
                            <?php if($errors->has('bank_sort_code')): ?>
                            <span class="help-block">
                                <strong><?php echo $errors->first('bank_sort_code'); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?php echo url('/people/employees'); ?>" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i><?php echo __('Cancel'); ?> </a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> <?php echo __('Add'); ?></button>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
</div>
<script type="text/javascript">
document.forms['employee_add_form'].elements['gender'].value = "<?php echo old('gender'); ?>";
document.forms['employee_add_form'].elements['id_name'].value = "<?php echo old('id_name'); ?>";
document.forms['employee_add_form'].elements['designation_id'].value = "<?php echo old('designation_id'); ?>";
document.forms['employee_add_form'].elements['role'].value = "<?php echo old('role'); ?>";
document.forms['employee_add_form'].elements['joining_position'].value = "<?php echo old('joining_position'); ?>";
document.forms['employee_add_form'].elements['marital_status'].value = "<?php echo old('marital_status'); ?>";
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>