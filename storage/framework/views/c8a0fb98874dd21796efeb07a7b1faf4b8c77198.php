
<?php $__env->startSection('title', __('Salary Report')); ?>
<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?php echo __('Salary Report'); ?>

    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard'); ?> </a></li>
      <li><a><?php echo __('Salary'); ?></a></li>
      <li class="active"><?php echo __('Salary Report'); ?></li>
    </ol>
  </section>
  <section class="content">
    <div class="Main_Div">
      <div class="card card-primary card-outline">
        <div class="card-header Su clearfix">
          <div class="Left_One float-left w-50">
            <h3 class="card-title FormTitle"><?php echo __('Salary Report'); ?></h3>
          </div>
          <div class="Left_Two text-right float-left w-50">
            <button class="btn StateB Print"><?php echo __('print'); ?> </button>
          </div>
        </div>
        <div class="card-body Border_bg">
          <div class="state_hader clearfix">
            <div class="state_logo float-left w-50">
              <?php if(!empty(auth()->user()->avatar)): ?>
              <img src="<?php echo asset('public/profile_picture/'.auth()->user()->avatar); ?>" class="img-fluid" alt="User Image">
              <?php else: ?>
              <img src="<?php echo asset('public/profile_picture/blank_profile_picture.png'); ?>" class="img-fluid" alt="User Image">
              <?php endif; ?>
            </div>
            <div class="state_title float-left w-50">
              <h3 class="mb-0"><?php echo __('Salary Report Of'); ?> <?php echo date("F Y", strtotime($salary_month)); ?></h3>
              <p class="mb-0"><?php echo auth()->user()->name; ?></p>
              <div class="Employee_dtl pt-2">
                <p class="mb-0"><?php echo auth()->user()->present_address; ?></p>
                <p class="mb-0"><?php echo __(''); ?>From <?php echo date("F Y", strtotime($salary_month)); ?></p>
                <p class="mb-0"><?php echo __('Contact:'); ?> <?php echo auth()->user()->contact_no_one; ?></p>
              </div>
            </div>
          </div>
          <div class="personal_info py-3 mt-3 clearfix">
            <div class="Present_add float-left">
              <p class="mb-0 FB"><?php echo __('Address'); ?></p>
              <p class="mb-0"><?php echo auth()->user()->present_address; ?></p>
            </div>
            <div class="Parmanent_add float-left">
              <p class="mb-0 FB"><?php echo __('From'); ?> </p>
              <p class="mb-0"><?php echo date("F Y", strtotime($salary_month)); ?></p>
            </div>
            <div class="Dates_official float-left">
              <p class="mb-0 FB"><?php echo auth()->user()->email; ?></p>
              <p class="mb-0"><?php echo __('Contact:'); ?> <?php echo auth()->user()->contact_no_one; ?></p>
            </div>
          </div>
          <div class="salary_table">
            <table class="table table-bordered">
              <tr class="bg-info">
                <th><?php echo __('sl#'); ?></th>
                <th><?php echo __('Employee Name'); ?></th>
                <th><?php echo __('Designation'); ?></th>
                <th><?php echo __('Gross Salary'); ?></th>
                <th><?php echo __('Total Deduction'); ?></th>
                <th><?php echo __('Net Salary'); ?></th>
                <th><?php echo __('Provident Fund'); ?></th>
                <th><?php echo __('Payment Total'); ?></th>
              </tr>
              <?php
                $where = '';
                $salarypayments = \App\SalaryPayment::all()->where('payment_month',$salary_month);
                $grosstotal = \App\SalaryPayment::all()->where('payment_month',$salary_month);
                $didcttotal = \App\SalaryPayment::all()->where('payment_month',$salary_month);
                $nettotal = \App\SalaryPayment::all()->where('payment_month',$salary_month);
                $pftotal = \App\SalaryPayment::all()->where('payment_month',$salary_month);
                $paymenttotal = \App\SalaryPayment::all()->where('payment_month',$salary_month);
                if(\Auth::user()->access_label != 1){
                  $salarypayments = $salarypayments->where('user_id',\Auth::user()->id);
                  $grosstotal = $grosstotal->where('user_id',\Auth::user()->id);
                  $didcttotal = $didcttotal->where('user_id',\Auth::user()->id);
                  $nettotal = $nettotal->where('user_id',\Auth::user()->id);
                  $pftotal = $pftotal->where('user_id',\Auth::user()->id);
                  $paymenttotal = $paymenttotal->where('user_id',\Auth::user()->id);
                }
                $grosstotal = $grosstotal->sum('gross_salary');
                $didcttotal = $didcttotal->sum('total_deduction');
                $nettotal = $nettotal->sum('net_salary');
                $pftotal = $pftotal->sum('provident_fund');
                $paymenttotal = $paymenttotal->sum('payment_amount');
              ?>
              <?php ($sl = 1); ?>
              <?php $__currentLoopData = $salarypayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salarypay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
              $emplname = \App\User::find($salarypay->user_id)->name;
              $desigid = \App\User::find($salarypay->user_id)->designation_id;
              $designation = \App\Designation::find($desigid)->designation;
              ?>
              <tr>
                <td><?php echo $sl++; ?></td>
                <td><?php echo $emplname; ?></td>
                <td><?php echo $designation; ?></td>
                <td><?php echo number_format($salarypay->gross_salary, 2, '.', ','); ?> </td>
                <td><?php echo number_format($salarypay->total_deduction, 2, '.', ','); ?></td>
                <td><?php echo number_format($salarypay->net_salary, 2, '.', ','); ?></td>
                <td><?php echo number_format($salarypay->provident_fund, 2, '.', ','); ?></td>
                <td><?php echo number_format($salarypay->payment_amount, 2, '.', ','); ?></td>
                
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
              
              <tr>
                <td colspan="3"><span class="TR_B"><?php echo __('Total'); ?></span></td>
                <td><span class="TR_B">KES<?php echo number_format($grosstotal, 2, '.', ','); ?></span></td>
                <td><span class="TR_B">KES<?php echo number_format($didcttotal, 2, '.', ','); ?></span></td>
                <td><span class="TR_B">KES<?php echo number_format($nettotal, 2, '.', ','); ?></span></td>
                <td><span class="TR_C">KES<?php echo number_format($pftotal, 2, '.', ','); ?> </span></td>
                <td><span class="TR_C">KES<?php echo number_format($paymenttotal, 2, '.', ','); ?> </span></td>
              </tr>
            </tbody>
          </table>
          <div class="Bottom_txt_statement text-center my-3">
            <h4 class="mb-0"><?php echo __('This is Salary sheet of only one month'); ?></h4>
          </div>
          <div class="clearfix mt-5">
            <div class="Emplyee_sign w-50 py-2 float-left">
              <span class="mb-0"><?php echo __('HR Signature'); ?></span>
            </div>
            <div class="Author_sign py-2 w-50 float-left text-right"><span><?php echo __('Authorize Signature'); ?></span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
$(function() {

$(".Print").on('click', function() {
print();
});

});
</script>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>