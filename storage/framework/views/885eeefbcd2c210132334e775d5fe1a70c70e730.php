
<?php $__env->startSection('title', __('Generate Payslip')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     <?php echo __('GENERATE PAYSLIP'); ?> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard'); ?> </a></li>
      <li><a><?php echo __('Salary'); ?></a></li>
      <li class="active"><?php echo __('Generate Payslip'); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Manage Salary Payment'); ?></h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
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
            <div class="col-md-12">
              <form class="form-horizontal" action="<?php echo url('/hrm/generate-payslips/'); ?>" method="post">
                <?php echo csrf_field(); ?>


                <!-- /.end group -->
                <div class="form-group<?php echo $errors->has('salary_month') ? ' has-error' : ''; ?>">
                  <label for="salary_month" class="col-sm-3 control-label"><?php echo __('Select Month'); ?></label>
                  <div class="col-sm-6">
                    <div class="input-group date">
                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                      <input type="text" name="salary_month" id="monthpicker2" class="form-control pull-right" value="<?php echo $salary_month; ?>">
                      <?php if($errors->has('salary_month')): ?>
                      <span class="help-block">
                        <strong><?php echo $errors->first('salary_month'); ?></strong>
                      </span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <!-- /.end group -->
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-arrow-right"></i> <?php echo __('GO'); ?></button>
                    <button type="button" class="btn btn-secondary btn-flat" onclick="openLinks()">
                      <i class="fa fa-print"></i> <?php echo __('Print All'); ?>

                    </button>
                  </div>
                </div>
                <!-- /.end group -->
              </form>
              <!-- /. end form -->
            </div>
            <!-- /. end col -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"></div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-md-12">
        <!-- Default box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Employee Details'); ?></h3>
          </div>
          <div class="box-body">
            <!-- Notification Box -->
            <div class="col-md-12">
              <table class="table table-bordered">
               <tr class="bg-info">
                <th><?php echo __('sl#'); ?></th>
                <th><?php echo __('Employee Name'); ?></th>
                <th><?php echo __('Designation'); ?></th>
                <th><?php echo __('Salary Month'); ?></th>
                <th><?php echo __('Gross Salary'); ?></th>
                <th><?php echo __('Total Allowance'); ?></th>
                
                
                <th><?php echo __('Advance Salary'); ?></th>
                <th><?php echo __('House Leavy'); ?></th>
                <th><?php echo __('Total Deduction'); ?></th>
                
                <th><?php echo __('Net Salary'); ?></th>
                <th><?php echo __('Provident Fund'); ?></th>
                <th><?php echo __('Payment Status'); ?></th>
              </tr>
              <?php ($sl = 1); ?>
               <?php ($totalotherd = 0); ?>
              <?php ($houseleavy = 0); ?>
              <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo $sl++; ?></td>
                <td><?php echo $employee['name']; ?></td>
                <td><?php echo $employee['designation']; ?></td>
                <td><?php echo date("F Y", strtotime($salary_month)); ?></td>
                <?php ($debits = 0); ?>
                <?php ($credits = 0); ?>
                <?php ($otherd = 0); ?>
                <?php ($advance = 0); ?>
                <?php ($loana= 0); ?>
                
                <?php ($totalhouseleavy = 0); ?>
                <?php ($al = 0); ?>
                <?php ($index = 1); ?>
                <?php ($houseleavy = ($employee['basic_salary'] * 1.5)/100); ?>
                <?php ($credits += ($employee['basic_salary'] + $employee['house_rent_allowance'] + $employee['medical_allowance'] + $employee['special_allowance'] + $employee['other_allowance'])); ?>
                <?php ($debits += $employee['tax_deduction'] + $employee['provident_fund_deduction'] + $employee['other_deduction'] + $employee['nhif'] + $employee['nssf']); ?>

                <?php $__currentLoopData = $bonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($employee['user_id'] == $bonus['user_id']): ?>
                <?php ($credits += $bonus['bonus_amount']); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($employee['user_id'] == $deduction['user_id']): ?>
                <?php ($debits += $deduction['deduction_amount']); ?>
                 <?php if($deduction['deduction_name'] != 'advance' && $deduction['deduction_name'] != 'loan'): ?>
                    <?php ($otherd += $deduction['deduction_amount']); ?>
                <?php endif; ?>
               <?php if($deduction['deduction_name'] == 'advance'): ?>
                    <?php ($advance += $deduction['deduction_amount']); ?>
                <?php endif; ?>
                <?php if($deduction['deduction_name'] == 'loan'): ?>
                    <?php ($loana += $deduction['deduction_amount']); ?>
                <?php endif; ?>
                   
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($employee['user_id'] == $allowance['user_id']): ?>
                <?php ($credits += $allowance['deduction_amount']); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($employee['user_id'] == $loan['user_id']): ?>
                <?php ($installment = $loan['loan_amount'] / $loan['remaining_installments']); ?>
                <?php ($debits += $installment); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <td><?php echo number_format($credits, 2, '.', ','); ?></td>
                <td><?php echo number_format($credits-$employee['basic_salary'], 2, '.', ','); ?></td>
                
                <td> <?php echo number_format($advance + $loana, 2, '.', ','); ?></td>
                <td> <?php echo number_format($houseleavy, 2, '.', ','); ?></td>
                <td><?php echo number_format($employee['paye'] + $employee['nhif'] + $employee['nssf'] + $advance + $loana + $otherd + ($employee['basic_salary'] * 1.5)/100, 2, '.', ','); ?></td>
             
                <td><?php echo number_format($credits - ($employee['paye'] + $employee['nhif'] + $employee['nssf'] + $advance + $loana + $otherd + ($employee['basic_salary'] * 1.5)/100), 2, '.', ','); ?></td>
                <td><?php echo number_format($employee['provident_fund_contribution'] + $employee['provident_fund_deduction'], 2, '.', ','); ?></td>

                <td>
                  <?php if(!empty($salary_payments)): ?>
                    <?php ($status = 0); ?>
                    <?php $__currentLoopData = $salary_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salary_payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($salary_payment['user_id'] == $employee['user_id']): ?>
                        <?php ($status = 1); ?>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($status == 1): ?>
                      <a href="<?php echo url('hrm/salary-payments/manage-salary/' . $employee['user_id'] . '/' . $salary_month); ?>" target="_blank"><p class="text-success"><?php echo __('Paid'); ?></p></a>
                      <a href="<?php echo url('/hrm/salary-payments/pdf/'.$employee['user_id'].'/'.$salary_month); ?>" target="_blank" class="d-none links"></a>
                    <?php else: ?>
                      <a href="<?php echo url('hrm/salary-payments/manage-salary/' . $employee['user_id'] . '/' . $salary_month); ?>"><p class="text-danger"><?php echo __('Make payment'); ?></p></a>
                    <?php endif; ?>
                  <?php else: ?>
                    <a href="<?php echo url('hrm/salary-payments/manage-salary/' . $employee['user_id'] . '/' . $salary_month); ?>"><p class="text-danger"><?php echo __('Make payment'); ?></p></a>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
          </div>
          <!-- /. end col -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.end.col -->
  </div>
  <!-- /.end.row -->
</section>
<!-- /.content -->
</div>
<script type="text/javascript">
  function openLinks() {
      var urls = [];
      $('.links').each(function() {
          urls.push(this.href);
          alert(this.href);
          window.open(this.href);
      });
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>