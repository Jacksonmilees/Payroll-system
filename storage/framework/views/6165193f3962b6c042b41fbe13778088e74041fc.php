
<link rel="stylesheet" href="<?php echo asset('public/backend/mystyle.css'); ?>">
<div class="content-wrapper">
  
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
          
            <div class="box-body">
                <div class="btn-body">
                <a href="<?php echo url('hrm/salary/statement/search'); ?>" class="mybtn"><?php echo __('Back'); ?></a>
              
                <button onclick="window.print()" class="mybtn"><?php echo __('Print'); ?></button>
               
                </div>
      

        
                <div class="st-left-body">
                    <h4>
                    <?php $users= \App\User::all();
                    foreach($users as $user){
                    $id=$user->id;
                    $empname=$user->name;
                    $idno=$user->id;
                    $joindate=$user->joining_date;
                    $contact=$user->contact_no_one;
                    $datebirth=$user->date_of_birth;
                    $designation=$user->designation_id;
                    $prsaddress=$user->present_address;
                    $prmaddress=$user->permanent_address;
                    }
                    
                    ?>
                    <?php echo __('EMP ID NO:'); ?> <?php echo $idno; ?>000000<?php echo $id; ?><br>
                    <?php echo __('Name:'); ?> <?php echo $empname; ?><br>
                    <?php //$desig= \App\Designation::find($designation)->designation;?>
                    <?php echo __('Designation:'); ?> <?php echo $designation; ?><br>
                    <?php echo __('Date of Birth:'); ?> <?php echo $datebirth; ?><br>
                    <?php echo __('Joining Date:'); ?> <?php echo $joindate; ?><br>
                    <?php echo __('Contact:'); ?> <?php echo $contact; ?><br>
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
                    <?php echo __('Present Address:'); ?> <?php echo $prsaddress; ?><br>
                    <?php echo __('Permanent Address:'); ?> <?php echo $prmaddress; ?>

                    
                    </h4>
                </div>



                
                <div id="printable_area" class="table-responsive">
              


                <table class="mytable">
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
                        <?php $__currentLoopData = $salarystats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payroll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo $sl ++; ?></td>
                            <td><?php echo __('PRLL'); ?><?php echo $payroll->id; ?></td>
                            <td><?php echo date("d F Y", strtotime($payroll->payment_month)); ?></td>
                            <td><?php echo Auth::user()->name; ?></td>
                            <td><?php echo $payroll->note; ?></td>
                            <td><?php echo $payroll->gross_salary; ?></td>
                           

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <tr>
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
