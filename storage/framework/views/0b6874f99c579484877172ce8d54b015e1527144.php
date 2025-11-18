
<div class="invoice">
    <div class="heeading">
        <div class="invo"><b><?php echo __('Salary Statement'); ?></b></div></div>
<div class="row">
  <div class="column">
   
  <img src="<?php echo asset('public/profile_picture/'.auth()->user()->avatar); ?>" class="img" style="width:150px;"><br><br><br>
   

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
                    <b> 
                    <?php echo __('EMP ID NO: '); ?><?php echo $idno; ?>000000<?php echo $id; ?><br>
                    <?php echo __('Name:'); ?> <?php echo $empname; ?><br>
                    <?php //$desig= \App\Designation::find($designation)->designation;?>
                    <?php echo __('Designation:'); ?> <?php echo $designation; ?><br>
                    </b>
                     
                  
  </div>
 
  <div class="column">
  </div>
  <div class="column">
                                <br>
<p>
    <?php echo __('Date of Birth: '); ?> <?php echo $datebirth; ?><br>
    <?php echo __('Joining Date:'); ?> <?php echo $joindate; ?><br>
    <?php echo __('Contact: '); ?><?php echo $contact; ?><br>
    <?php echo __('Present Address:'); ?> <?php echo $prsaddress; ?><br>
    <?php echo __('Permanent Address:'); ?> <?php echo $prmaddress; ?></p>
  </div>

</div>

 
<div class="row table-responsive">
    <table border="1" class="mytable">

        <tr class="firstrow">
            <td><?php echo __('SL'); ?></td>
            <td><?php echo __('PAID ID NO'); ?></td>
            <td><?php echo __('Pay Month'); ?></td>
            <td><?php echo __('Pay By'); ?></td>
            <td><?php echo __('Note'); ?></td>
            <td><?php echo __('Received Salary'); ?></td></tr>

         
            <?php ($sl = 1); ?>
            <?php $__currentLoopData = $salarystats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payroll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo $sl ++; ?></td>
                <td><?php echo __('PRLL'); ?><?php echo $payroll->id; ?></td>
                <td><?php echo date("d F Y", strtotime($payroll->payment_month)); ?></td>
                <td><?php echo Auth::user()->name; ?></td>
                <td><?php echo $payroll->note; ?></td>
                <td>$<?php echo $payroll->gross_salary; ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </table>
  
  <div class="column1">
  </div>
  <div class="column1">
  </div>
  <div class="column1">
                         
                            <b><?php echo __('Total:'); ?> $<?php echo $datetotal; ?></b><br>
  </div>
</div>


<div class="row">
<div class="column1">

</div>
<div class="column1">
   
</div>
<div class="column1"><br><br><br><br>
    <b>-------------</b><br>
    <b><?php echo __('Authorized'); ?></b><br>
  </div>
</div>
<br>
     <p><?php echo __('Please contact us for more information about payment options'); ?></p>
     <p><?php echo __('Thank you for your booking'); ?></p>

 <div class="heeading"></div>
</div>