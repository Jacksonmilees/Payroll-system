<?php $__env->startSection('title', __('Salary Statement')); ?>

<?php $__env->startSection('main_content'); ?>


<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo __('Salary Statement'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('Increment'); ?></a></li>
            <li class="active"><?php echo __('Salary Statement'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Salary Statement'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="btn-body">
                <a href="<?php echo url('hrm/salary/statement/search'); ?>" class="tip btn btn-primary btn-flat"><i class="fa fa-plus"></i> <?php echo __('add new Salary Statement'); ?></a>



                    <form action="<?php echo url('/hrm/salary/statement/preview'); ?>" method="get">

                        <?php echo csrf_field(); ?>


                        <input type="hidden" name="emp_id" value="<?php echo $empid; ?>">
                        <input type="hidden" name="date1" value="<?php echo $startdate; ?>">
                        <input type="hidden" name="date2" value="<?php echo $enddate; ?>">
                        <button type="submit" class="tip btn btn-primary btn-flat"><?php echo __('Preview'); ?> </button>
                        
                    </form>


                 <form action="<?php echo url('/hrm/salary/statement/pdf'); ?>" method="get">
                        <?php echo csrf_field(); ?>

                       <input type="hidden" name="emp_id" value="<?php echo $empid; ?>">
                        <input type="hidden" name="date1" value="<?php echo $startdate; ?>">
                        <input type="hidden" name="date2" value="<?php echo $enddate; ?>">
                        <button type="submit" class="tip btn btn-primary btn-flat"><?php echo __('PDF'); ?> </button>
                        
                    </form>
                </div>
                <hr>

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


                <div class="st-left-body">
                    <h4>
                    <?php $users= \App\User::all();
                    foreach($users as $user){
                        $id=$user->id;
                    $empname=$user->name;
                    $idno=$user->id_number;
                    $joindate=$user->joining_date;
                    $contact=$user->contact_no_one;
                    $datebirth=$user->date_of_birth;
                    $designation=$user->designation_id;
                    $prsaddress=$user->present_address;
                    $prmaddress=$user->permanent_address;
                    }
                    
                    ?>
                    <?php echo __('EMP ID NO:'); ?> <?php echo $idno; ?>000000<?php echo $id; ?><br>
                    <?php echo __('Name: '); ?><?php echo $empname; ?><br>
                    <?php //$desig= \App\Designation::find($designation)->designation;?>
                    <?php echo __('Designation: '); ?> <?php echo $designation; ?><br>
                    <?php echo __('Date of Birth: '); ?><?php echo $datebirth; ?><br>
                    <?php echo __('Joining Date: '); ?><?php echo $joindate; ?><br>
                    <?php echo __('Contact: '); ?><?php echo $contact; ?><br>
                    </h4>
                </div>
                <div class="st-center-body">
                    <div class="img-body"><img src="<?php echo asset('public/profile_picture/'.auth()->user()->avatar); ?>" class="img"></div>
                    <h2><?php echo __('Salary Statement'); ?></h2>
                    <center><b><?php echo date("F Y", strtotime($startdate)); ?> to <?php echo date("F Y", strtotime($enddate)); ?><br>
                    <?php $users= \App\User::all()->where('employee_id', $empid);
                    foreach($users as $user){
                    $empname=$user->name;
                    }
                    
                    ?>
                    
                    </b></center>
                </div>
                <div class="st-right-body">
                    <h4>
                    <?php echo __('Present Address: '); ?><?php echo $prsaddress; ?><br>
                    <?php echo __('Permanent Address: '); ?><?php echo $prmaddress; ?>

                    
                    </h4>
                </div>



               <div id="printable_area" class="col-md-12 table-responsive">
               <table  class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?php echo __('SL'); ?></th>
                            <th><?php echo __('PAID ID NO'); ?></th>
                            <th><?php echo __('Pay Month'); ?></th>
                            <th><?php echo __('Pay By'); ?></th>
                            <th><?php echo __('Note'); ?></th>
                            <th><?php echo __('Received Salary'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php ($sl = 1); ?>
                        <?php $__currentLoopData = $salarysheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payroll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo $sl ++; ?></td>
                            <td>PRLL<?php echo $payroll->id; ?></td>
                            <td><?php echo date("d F Y", strtotime($payroll->payment_month)); ?></td>
                            <td><?php echo Auth::user()->name; ?></td>
                            <td><?php echo $payroll->note; ?></td>
                            <td><?php echo $payroll->gross_salary; ?></td>
                           

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td colspan="4"></td>
                            <th><?php echo __('Total'); ?></th>
                            <th><?php echo $datetotal; ?></th>
                        </tr>

                    </tbody>
                </table>
            </div><!--printable-->



            <div class="sign-body-l">-----------------------------------<br><?php echo __('Employee'); ?></div>
            <div class="sign-body-r">-----------------------------------<br><?php echo __('Authorized'); ?></div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>