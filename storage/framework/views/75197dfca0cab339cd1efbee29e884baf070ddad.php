
<?php $__env->startSection('title', __( 'Manage Salary')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo __('PAYROLL'); ?>

    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard'); ?> </a></li>
      <li><a><?php echo __('Salary'); ?></a></li>
      <li class="active"><?php echo __('Manage Salary'); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Default box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Employee Details'); ?></h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="col-md-12">
              <a href="<?php echo url('/hrm/salary-payments'); ?>" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> <?php echo __('Back'); ?></a>
            </div>
            <!-- Notification Box -->
            <div class="col-md-12 table-responsive">
             
             <table class="table table-bordered table-striped">
              
                <tr>
                  <td><b><?php echo __('Employee Name:'); ?></b></td>
                  <td><?php echo $user['name']; ?></td>
                </tr>
                <tr>
                  <td><b><?php echo __('Department:'); ?></b></td>
                  <td><?php echo $user['department']; ?></td>
                </tr>
                <tr>
                  <td><b><?php echo __('Designation:'); ?></b></td>
                  <td><?php echo $user['designation']; ?></td>
                </tr>
                <tr>
                  <td><b><?php echo __('Joining Date:'); ?></b></td>
                  <td><?php echo date("d F Y", strtotime($user['created_at'])); ?></td>
                </tr>
              </tr>
            </table>
          </div>
         
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.end.col -->

    <div class="col-md-3">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo __('Payment For: '); ?><strong><?php echo date("F Y", strtotime($salary_month)); ?></strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="<?php echo url('/hrm/salary-payments/store'); ?>" method="post">
            <?php echo csrf_field(); ?>


            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="payment_month" value="<?php echo $salary_month; ?>">

            <!-- Forl loan id and remaining installment -->
            <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" name="loan_id[]" value="<?php echo $loan['id']; ?>">
            <input type="hidden" name="remaining_installments[]" value="<?php echo $loan['remaining_installments']; ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="form-group">
              <label for="gross_salary"><?php echo __('Gross Salary'); ?></label>
              <input type="number" value="" class="form-control" id="gross_salary" disabled>
              <input type="hidden" name="gross_salary" id="gross_salary_1">
            </div>
            <!-- / .end form group -->

            <div class="form-group">
              <label for="total_deduction"><?php echo __('Total Deduction'); ?></label>
              <input type="number" value="" class="form-control" id="total_deduction" disabled>
              <input type="hidden" name="total_deduction" id="total_deduction_1">
            </div>
            <!-- / .end form group -->

            <div class="form-group">
              <label for="net_salary"><?php echo __('Net Salary'); ?></label>
              <input type="number" value="" class="form-control" id="net_salary" disabled>
              <input type="hidden" name="net_salary" id="net_salary_1">
            </div>
            <!-- / .end form group -->

            <?php ($provident_fund = $salary['provident_fund_contribution'] + $salary['provident_fund_deduction']); ?>

            <div class="form-group">
              <label for="net_salary"><?php echo __('Provident Fund'); ?></label>
              <input type="number" value="<?php echo $provident_fund; ?>" class="form-control" disabled>
              <input type="hidden" name="provident_fund" value="<?php echo $provident_fund; ?>">
            </div>
            <!-- / .end form group -->

            <div class="form-group<?php echo $errors->has('payment_amount') ? ' has-error' : ''; ?>">
              <label for="payment_amount"><?php echo __('Payment Amount'); ?></label>
              <input type="text" name="payment_amount" value="<?php echo old('payment_amount'); ?>" class="form-control" id="payment_amount">
              <?php if($errors->has('payment_amount')): ?>
              <span class="help-block">
                <strong><?php echo $errors->first('payment_amount'); ?></strong>
              </span>
              <?php endif; ?>
            </div>
            <!-- / .end form group -->

            <div class="form-group<?php echo $errors->has('payment_type') ? ' has-error' : ''; ?>">
              <label for="payment_type"><?php echo __('Payment Type'); ?></label>
              <select name="payment_type" id="payment_type" class="form-control">
                <option selected disabled><?php echo __('Select One'); ?></option>
                <option value="1"><?php echo __('Cash Payment'); ?></option>
                <option value="2"><?php echo __('Chaque Payment'); ?></option>
                <option value="3"><?php echo __('Bank Payment'); ?></option>
              </select>
              <?php if($errors->has('payment_type')): ?>
              <span class="help-block">
                <strong><?php echo $errors->first('payment_type'); ?></strong>
              </span>
              <?php endif; ?>
            </div>
            <!-- / .end form group -->

            <div class="form-group<?php echo $errors->has('note') ? ' has-error' : ''; ?>">
              <label for="note"><?php echo __('Note'); ?></label>
              <textarea name="note" class="form-control" id="note" rows="3" placeholder="<?php echo __('Enter note..'); ?>"></textarea>
              <?php if($errors->has('note')): ?>
              <span class="help-block">
                <strong><?php echo $errors->first('note'); ?></strong>
              </span>
              <?php endif; ?>
            </div>
            <!-- / .end form group -->

            <button type="submit" class="btn btn-danger btn-flat btn-block"><?php echo __('Make Payment'); ?></button>

        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.end.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo __('Payment Details For:'); ?> <strong><?php echo date("F Y", strtotime($salary_month)); ?></strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr class="bg-info">
              <th><?php echo __('sl#'); ?></th>
              <th><?php echo __('Item Name'); ?></th>
              <th><?php echo __('Debits'); ?></th>
              <th><?php echo __('Credits'); ?></th>
            </tr>
            <?php ($sl = 1); ?>
            <?php ($debits = 0); ?>
            <?php ($credits = 0); ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('Basic Salary'); ?></td>
              <td></td>
              <td>
                <?php ($credits += $salary['basic_salary']); ?>
                <?php echo $salary['basic_salary']; ?>

                <input type="hidden" name="item_name[]" value="Basic Salary">
                <input type="hidden" name="amount[]" value="<?php echo $salary['basic_salary']; ?>">
                <input type="hidden" name="status[]" value="credits">
              </td>
            </tr>

            <?php if(!empty($salary['house_rent_allowance'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('House Rent Allowance'); ?></td>
              <td></td>
              <td>
                <?php ($credits += $salary['house_rent_allowance']); ?>
                <?php echo $salary['house_rent_allowance']; ?>

                <input type="hidden" name="item_name[]" value="House Rent Allowance">
                <input type="hidden" name="amount[]" value="<?php echo $salary['house_rent_allowance']; ?>">
                <input type="hidden" name="status[]" value="credits">
              </td>
            </tr>
            <?php endif; ?>

            <?php if(!empty($salary['medical_allowance'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('Medical Allowance'); ?></td>
              <td></td>
              <td>
                <?php ($credits += $salary['medical_allowance']); ?>
                <?php echo $salary['medical_allowance']; ?>

                <input type="hidden" name="item_name[]" value="Medical Allowance">
                <input type="hidden" name="amount[]" value="<?php echo $salary['medical_allowance']; ?>">
                <input type="hidden" name="status[]" value="credits">
              </td>
            </tr>
            <?php endif; ?>

            <?php if(!empty($salary['special_allowance'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('Special Allowance</td>
              <td></td>'); ?>

              <td>
                <?php ($credits += $salary['special_allowance']); ?>
                <?php echo $salary['special_allowance']; ?>

                <input type="hidden" name="item_name[]" value="Special Allowance">
                <input type="hidden" name="amount[]" value="<?php echo $salary['special_allowance']; ?>">
                <input type="hidden" name="status[]" value="credits">
              </td>
            </tr>
            <?php endif; ?>

            <?php if(!empty($salary['provident_fund_contribution'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('Provident Fund Contribution'); ?></td>
              <td></td>
              <td>
                <?php echo $salary['provident_fund_contribution']; ?>

                <input type="hidden" name="item_name[]" value="Provident Fund Contribution">
                <input type="hidden" name="amount[]" value="<?php echo $salary['provident_fund_contribution']; ?>">
                <input type="hidden" name="status[]" value="credits">
              </td>
            </tr>
            <?php endif; ?>
            <?php $__currentLoopData = $allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo $allowance['deduction_name']; ?></td>
              <td>
                <?php ($credits += $allowance['deduction_amount']); ?>
                <input type="hidden" name="item_name[]" value="<?php echo $allowance['deduction_name']; ?>">
                <input type="hidden" name="amount[]" value="<?php echo $allowance['deduction_amount']; ?>">
                <input type="hidden" name="status[]" value="credits">
              </td>
              <td>
                <?php echo $allowance['deduction_amount']; ?>

              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($salary['other_allowance'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('Other Allowance'); ?></td>
              <td></td>
              <td>
                <?php ($credits += $salary['other_allowance']); ?>
                <?php echo $salary['other_allowance']; ?>

                <input type="hidden" name="item_name[]" value="Other Allowance">
                <input type="hidden" name="amount[]" value="<?php echo $salary['other_allowance']; ?>">
                <input type="hidden" name="status[]" value="credits">
              </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($salary['tax_deduction'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('Tax Deduction'); ?></td>
              <td>
                <?php ($debits += $salary['tax_deduction']); ?>
                -<?php echo $salary['tax_deduction']; ?>

                <input type="hidden" name="item_name[]" value="Tax Deduction">
                <input type="hidden" name="amount[]" value="<?php echo $salary['tax_deduction']; ?>">
                <input type="hidden" name="status[]" value="debits">
              </td>
              <td></td>
            </tr>
            <?php endif; ?>

            <?php if(!empty($salary['provident_fund_deduction'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('Provident Fund Deduction'); ?></td>
              <td>
                <?php ($debits += $salary['provident_fund_deduction']); ?>
                -<?php echo $salary['provident_fund_deduction']; ?>

                <input type="hidden" name="item_name[]" value="Provident Fund Deduction">
                <input type="hidden" name="amount[]" value="<?php echo $salary['provident_fund_deduction']; ?>">
                <input type="hidden" name="status[]" value="debits">
              </td>
              <td></td>
            </tr>
            <?php endif; ?>

            <?php if(!empty($salary['other_deduction'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('Other Deduction'); ?>n</td>
              <td>
                <?php ($debits += $salary['other_deduction']); ?>
                -<?php echo $salary['other_deduction']; ?>

                <input type="hidden" name="item_name[]" value="Other Deduction">
                <input type="hidden" name="amount[]" value="<?php echo $salary['other_deduction']; ?>">
                <input type="hidden" name="status[]" value="debits">
              </td>
              <td></td>
            </tr>
            <?php endif; ?>

            <?php if(!empty($salary['nhif'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('NHIF'); ?></td>
              <td>
                <?php ($debits += ($salary['basic_salary']* 2.75 / 100)); ?>
                -<?php echo ($salary['basic_salary']* 2.75 / 100); ?>

                <input type="hidden" name="item_name[]" value="NHIF">
                <input type="hidden" name="amount[]" value="<?php echo ($salary['basic_salary']* 2.75 / 100); ?>">
                <input type="hidden" name="status[]" value="debits">
              </td>
              <td></td>
            </tr>
            <?php endif; ?>

            <?php if(!empty($salary['nssf'])): ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo __('NSSF'); ?></td>
              <td>
                <?php ($debits += ($salary['basic_salary'] <= 36000 ? $salary['basic_salary'] * 6 / 100 : 2160)); ?>
                -<?php echo ($salary['basic_salary'] <= 36000 ? $salary['basic_salary'] * 6 / 100 : 2160); ?>

                <input type="hidden" name="item_name[]" value="NSSF">
                <input type="hidden" name="amount[]" value="<?php echo ($salary['basic_salary'] <= 36000 ? $salary['basic_salary'] * 6 / 100 : 2160); ?>">
                <input type="hidden" name="status[]" value="debits">
              </td>
              <td></td>
            </tr>
            <?php endif; ?>

            <?php $__currentLoopData = $bonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo $bonus['bonus_name']; ?></td>
              <td></td>
              <td>
                <?php ($credits += $bonus['bonus_amount']); ?>
                <?php echo $bonus['bonus_amount']; ?>

                <input type="hidden" name="item_name[]" value="<?php echo $bonus['bonus_name']; ?>">
                <input type="hidden" name="amount[]" value="<?php echo $bonus['bonus_amount']; ?>">
                <input type="hidden" name="status[]" value="credits">
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo $deduction['deduction_name']; ?></td>
              <td>
                <?php ($debits += $deduction['deduction_amount']); ?>
                -<?php echo $deduction['deduction_amount']; ?>

                <input type="hidden" name="item_name[]" value="<?php echo $deduction['deduction_name']; ?>">
                <input type="hidden" name="amount[]" value="<?php echo $deduction['deduction_amount']; ?>">
                <input type="hidden" name="status[]" value="debits">
              </td>
              <td></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            

            <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><?php echo $loan['loan_name']; ?></td>
              <td>
                <?php ($installment = $loan['loan_amount'] / $loan['number_of_installments']); ?>
                <?php ($debits += $installment); ?>
                -<?php echo number_format($installment, 2, '.', ','); ?>

                <input type="hidden" name="item_name[]" value="<?php echo $loan['loan_name']; ?>">
                <input type="hidden" name="amount[]" value="<?php echo $installment; ?>">
                <input type="hidden" name="status[]" value="debits">
              </td>
              <td></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </table>
        </div>
        <!-- /.box-body -->
        </form>
      </div>
    </div>
    <!-- /.end.col -->
  </div>
</section>
<!-- /.content -->
</div>

<input type="hidden" id="debits" value="<?php echo number_format($debits, 2, '.', ''); ?>">
<input type="hidden" id="credits" value="<?php echo number_format($credits, 2, '.', ''); ?>">

<script type="text/javascript">
  $(document).ready(function(){
    var debits = $("#debits").val();
    var credits = $("#credits").val();
    var net_salary = (+credits - +debits);


    $("#gross_salary").val(credits);
    $("#total_deduction").val(debits);
    $("#net_salary").val(net_salary);

    $("#gross_salary_1").val(credits);
    $("#total_deduction_1").val(debits);
    $("#net_salary_1").val(net_salary);

    $("#payment_amount").val(net_salary);
    calculation();
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>