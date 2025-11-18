
<?php $__env->startSection('title', __('Team member details')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          <?php echo __(' TEAM'); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard'); ?> </a></li>
            <li><a><?php echo __('People'); ?></a></li>
            <li><a href="<?php echo url('/people/employees'); ?>"><?php echo __('Team'); ?></a></li>
            <li class="active"><?php echo __('Details'); ?></li>
        </ol>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Team member details'); ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <a href="<?php echo url('/people/employees'); ?>" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> <?php echo __('Back'); ?></a>
            <hr>
            <div id="printable_area">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <p>
                                <?php echo $employee->name; ?>

                                <br>
                                <?php echo $employee->employee_id; ?>

                                <br>
                                <?php echo $employee->designation; ?>

                            </p>
                        </td>
                        <td>
                            <?php if(!empty($employee->avatar)): ?>
                            <img src="<?php echo url('public/profile_picture/' . $employee->avatar); ?>" class="img-responsive img-thumbnail">
                            <?php else: ?>
                            <img src="<?php echo url('public/profile_picture/blank_profile_picture.png'); ?>" alt="blank_profile_picture" class="img-responsive img-thumbnail">
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <hr>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td><?php echo __('Middle\'s Name'); ?></td>
                            <td><?php echo $employee->mother_name; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Last\'s Name'); ?></td>
                            <td><?php echo $employee->father_name; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Present Address'); ?></td>
                            <td><?php echo $employee->present_address; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Permanent Address'); ?></td>
                            <td><?php echo $employee->permanent_address; ?></td>
                        </tr>
                        <tr>
                           <td><?php echo __('Designation'); ?></td>
                            <td>
                               <?php echo $employee->designation; ?>

                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Email'); ?></td>
                            <td><?php echo $employee->email; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Web'); ?></td>
                            <td><?php echo $employee->web; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Contact No'); ?></td>
                            <td><?php echo $employee->contact_no_one; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Emergency Contact'); ?></td>
                            <td><?php echo $employee->emergency_contact; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('ID Name'); ?></td>
                            <td>
                                <?php if($employee->id_name == 1): ?>
                                <p><?php echo __('NID'); ?></p>
                                <?php elseif($employee->id_name == 2): ?>
                                <p><?php echo __('Passport'); ?></p>
                                <?php elseif($employee->id_name == 3): ?>
                                <p><?php echo __('Driving License'); ?></p>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('ID Number'); ?></td>
                            <td><?php echo $employee->id_number; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Gender'); ?></td>
                            <td>
                                <?php if($employee->gender == 'm'): ?>
                                <p><?php echo __('Male'); ?></p>
                                <?php else: ?>
                                <p><?php echo __('Female'); ?></p>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Date of Birth'); ?></td>
                            <td>
                                <?php if($employee->date_of_birth != NULL): ?>
                                <?php echo date("d F Y", strtotime($employee->date_of_birth)); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('Job Group'); ?></td>
                            <td>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($employee->joining_position == $department->id): ?>
                                <?php echo $department->department; ?>

                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            
                        </tr>
                        <tr>
                             <td><?php echo __('NSSF No'); ?></td>
                            <td>
                                <?php echo $employee->nssf_no; ?>

                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('NHIF No'); ?></td>
                            <td>
                                <?php echo $employee->nhif_no; ?>

                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('KRA PIN'); ?></td>
                            <td>
                                <?php echo $employee->kra_no; ?>

                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('Next Kin Name'); ?></td>
                            <td>
                                <?php echo $employee->kin_details_name; ?>

                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('Next of Kin Relationship'); ?></td>
                            <td>
                                <?php echo $employee->kin_details_relation; ?>

                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('Next of Kin Phone Number'); ?></td>
                            <td>
                                <?php echo $employee->kin_details_phone; ?>

                            </td>
                        </tr>
                        <tr>
                            <td><?php echo __('Joining Date'); ?></td>
                            <td><?php echo date("D d F Y - h:ia", strtotime($employee->joining_date)); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Created By'); ?></td>
                            <td><?php echo $created_by->name; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Date Added'); ?></td>
                            <td><?php echo date("D d F Y - h:ia", strtotime($employee->created_at)); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __('Last Updated'); ?></td>
                            <td><?php echo date("D d F Y - h:ia", strtotime($employee->updated_at)); ?></td>
                        </tr>
                        <tr>
                            <td style="border: 0px; background: #fff;">
                                <h4>Bank Details</h4>
                            </td>

                        </tr>
                        <tr>
                             <td><?php echo __('Account name'); ?></td>
                            <td>
                                <?php echo $employee->account_name; ?>

                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('Bank Account Number'); ?></td>
                            <td>
                                <?php echo $employee->bank_acc_no; ?>

                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('Bank name'); ?></td>
                            <td>
                                <?php echo $employee->bank_name; ?>

                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('Bank Branch'); ?></td>
                            <td>
                                <?php echo $employee->bank_branch; ?>

                            </td>
                        </tr>
                        <tr>
                             <td><?php echo __('Bank sort code'); ?></td>
                            <td>
                                <?php echo $employee->bank_sort_code; ?>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Start Button -->
            <div class="btn-group btn-group-justified">
                <?php if($employee->activation_status == 1): ?>
                <div class="btn-group">
                    <a href="<?php echo url('/people/employees/deactive/' . $employee->id); ?>" class="tip btn btn-success btn-flat" data-toggle="tooltip" data-original-title="Click to deactive">
                        <i class="fa fa-arrow-down"></i>
                        <span class="hidden-sm hidden-xs"> <?php echo __('Active'); ?></span>
                    </a>
                </div>
                <?php else: ?>
                <div class="btn-group">
                    <a href="<?php echo url('/people/employees/active/' . $employee->id); ?>" class="tip btn btn-warning btn-flat" data-toggle="tooltip" data-original-title="Click to active">
                        <i class="fa fa-arrow-up"></i>
                        <span class="hidden-sm hidden-xs"> <?php echo __('Deactive'); ?></span>
                    </a>
                </div>
                <?php endif; ?>
                <div class="btn-group">
                    <button type="button" class="tip btn btn-primary btn-flat" title="Print" data-original-title="Label Printer" onclick="printDiv('printable_area')">
                        <i class="fa fa-print"></i>
                        <span class="hidden-sm hidden-xs"> <?php echo __('Print'); ?></span>
                    </button>
                </div>
               
                <div class="btn-group">
                    <a href="<?php echo url('/people/employees/edit/' . $employee->id); ?>" class="tip btn btn-warning tip btn-flat" title="" data-original-title="Edit Product">
                        <i class="fa fa-edit"></i>
                        <span class="hidden-sm hidden-xs"> <?php echo __('Edit'); ?></span>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="<?php echo url('/people/employees/delete/' . $employee->id); ?>" class="tip btn btn-danger btn-flat" data-toggle="tooltip" data-original-title="Click to delete" onclick="return confirm('Are you sure to delete this ?');">
                        <i class="fa fa-arrow-up"></i>
                        <span class="hidden-sm hidden-xs"> <?php echo __('Delete'); ?></span>
                    </a>
                </div>
            </div>
            <!-- /.End Button -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>