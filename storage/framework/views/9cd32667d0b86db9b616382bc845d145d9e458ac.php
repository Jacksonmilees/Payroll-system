
<?php $__env->startSection('title', __('Salary Payment Details')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo __('PAYROLL'); ?>

    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
      <li><a><?php echo __('Salary'); ?></a></li>
      <li class="active"><?php echo __('Salary Payment Details'); ?></li>
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
            <a href="<?php echo url('/hrm/salary-payments'); ?>" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> <?php echo __('Back'); ?></a>
            <a href="<?php echo url('/hrm/salary-payments/pdf/'.$user['id'].'/'.$salary_month); ?>" class="btn btn-primary btn-flat"><i class="fa fa-print"></i><span class="hidden-sm hidden-xs"> <?php echo __('Print'); ?> </span></a>

            <!--<button type="button" class="btn btn-primary btn-flat" title="Print" data-original-title="Label Printer" onclick="printDiv('printable_area')"><i class="fa fa-print"></i><span class="hidden-sm hidden-xs"> <?php echo __('Print'); ?> </span></button>-->
           
            <hr>
            <div id="printable_area" class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <td>
                    <p>
                      <?php echo $user['employee_id']; ?>

                      <br>
                      <?php echo $user['name']; ?>

                      <br>
                      (<?php echo $user['designation']; ?>)
                      <br>
                      <?php echo __('Department of'); ?> <?php echo $user['department']; ?>

                      <br>
                     <?php echo __('Joining Date:'); ?>  <?php echo date("d F Y", strtotime($user['created_at'])); ?>

                    </p>
                  </td>
                  <td>
                    <?php if(!empty($user['avatar'])): ?>
                    <img src="<?php echo url('public/profile_picture/' . $user['avatar']); ?>" class="img-responsive img-thumbnail">
                    <?php else: ?>
                    <img src="<?php echo url('public/profile_picture/blank_profile_picture.png'); ?>" alt="blank_profile_picture" class="img-responsive img-thumbnail">
                    <?php endif; ?>
                  </td>
                </tr>
              </table>
              <hr>

              <table class="table table-bordered">
                <tr class="bg-info">
                  <th><?php echo __('sl#'); ?></th>
                  <th><?php echo __('Description'); ?></th>
                  <th><?php echo __('Debits'); ?></th>
                  <th><?php echo __('Credits'); ?></th>
                </tr>
                <?php ($sl = 1); ?>
                <?php ($amount = 0); ?>
                <?php $__currentLoopData = $salary_payment_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo $sl++; ?></td>
                  <td><?php echo $data->item_name; ?></td>
                  <td>
                    <?php if($data->status == 'debits'): ?>
                    -<?php echo $data->amount; ?>

                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($data->status == 'credits'): ?>
                    <?php echo $data->amount; ?>

                        <?php if($sl != 2): ?>
                            <?php ($amount += $data->amount); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td> &nbsp; </td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right"><?php echo __('Gross Salary:'); ?></strong></td>
                  <td>
                    <strong>
                      <?php echo number_format($salary_payment->gross_salary, 2, '.', ''); ?>

                    </strong>
                  </td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right"><?php echo __('P.A.Y.E:'); ?></strong></td>
                  <td><strong id="paye"></strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right"><?php echo __('Persnol Relief:'); ?></strong></td>
                  <td><strong id="persnol_relief"></strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right"><?php echo __('NHIF Relief:'); ?></strong></td>
                  <td><strong id="nhif_relief"></strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right"><?php echo __('Total Allowance:'); ?></strong></td>
                  <td><strong id="allowance"><?php echo $amount; ?></strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right"><?php echo __('Total Deduction:'); ?></strong></td>
                  <td><strong id="deduction">0</strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right"><?php echo __('Net Pay:'); ?></strong></td>
                  <td><strong id="net_salary">0</strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right"><?php echo __('Provident Fund:'); ?></strong></td>
                  <td><strong><?php echo number_format($salary_payment->provident_fund, 2, '.', ''); ?></strong></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.end.col -->

      <div class="col-md-12">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><strong><?php echo __('Payment History'); ?></strong></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
             <tr class="bg-info">
              <th><?php echo __('sl#'); ?></th>
              <th><?php echo __('Salary Month'); ?></th>
              <th><?php echo __('Gross Salary'); ?></th>
              <th><?php echo __('Total Deduction'); ?></th>
              <th><?php echo __('Net Salary'); ?></th>
              <th><?php echo __('Provident Fund'); ?></th>
              <th><?php echo __('Payment Amount'); ?></th>
              <th><?php echo __('Payment Type'); ?></th>
              <th><?php echo __('Note'); ?></th>
            </tr>
            <?php ($sl = 1); ?>
            <?php $__currentLoopData = $employee_salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee_salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo $sl++; ?></td>
              <td><a href="<?php echo url('/hrm/salary-payments/manage-salary/'.$employee_salary['user_id'].'/'.date("Y-m", strtotime($employee_salary['payment_month']))); ?>"><?php echo date("F Y", strtotime($employee_salary['payment_month'])); ?></a></td>
              <td><?php echo $employee_salary['gross_salary']; ?></td>
              <td><?php echo $employee_salary['total_deduction']; ?></td>
              <td><?php echo $employee_salary['net_salary']; ?></td>
              <td><?php echo $employee_salary['provident_fund']; ?></td>
              <td><?php echo $employee_salary['payment_amount']; ?></td>
              <td>
                <?php if($employee_salary['payment_type'] == 1): ?>
               <?php echo __(' Cash Payment'); ?>

                <?php elseif($employee_salary['payment_type'] == 2): ?>
               <?php echo __('Chaque Payment'); ?> 
                <?php else: ?>
               <?php echo __(' Bank Payment'); ?>

                <?php endif; ?>
              </td>
              <td><?php echo $employee_salary['note']; ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.end.col -->
  </div>
  <!-- /.end.row -->
</section>
<!-- /.content -->
</div>
<script>
      //For Calculation
  $(document).ready(function() {
    calculation();
  });

  function calculation() {
    var sum = 0;
    var gross_salary = '<?php echo $salary_payment->gross_salary ?? '0'; ?>';
    var nhif = getNHIFRates(gross_salary);
    var nssf = getNSSFRate(gross_salary);

    var total_deduction = '<?php echo $salary_payment->total_deduction ?? '0'; ?>';

    var taxable_pay = gross_salary - nssf;
    var nhif_relief = 0;
    var persnol_relief = 0;
    var paye = 0;
    var income_tax = 0;
    if(taxable_pay <= 24000){
      income_tax = taxable_pay*10/100;
    }
    if(taxable_pay > 24000){
      var a = 24000*10/100;
      var b = 8333*25/100;
      var c = taxable_pay-(+24000 + +8333);
      var c = c*30/100;
      // console.log(a);
      // console.log(b);
      // console.log(c);
      income_tax = (+a + +b + +c); 
      // console.log(income_tax);
      nhif_relief = nhif*15/100;
      persnol_relief = 2400;
      paye = income_tax-(+nhif_relief + +persnol_relief);
    }
    var pay_after_tax = taxable_pay - paye; 
    var net_pay = pay_after_tax - nhif; 
    var deduction = '<?php echo number_format($salary_payment->total_deduction, 2, '.', ''); ?>';
    var t_deduction = (+deduction + +paye);
    var net_salary = gross_salary-t_deduction;
    $("#deduction").text(parseInt(t_deduction));
    $("#paye").text(paye);
    $("#paye").text(paye);
    $("#net_salary").text(net_salary);
    $("#persnol_relief").text(persnol_relief);
    $("#nhif_relief").text(nhif_relief);
  }
//   function getNHIFRates(x) {
//     let nhif = 0;
//     if(between(x, 0, 5999))
//       nhif = 150;
//     else if(between(x, 6000, 8999))
//       nhif = 300;
//     else if(between(x, 8000, 11999))
//       nhif = 400;
//     else if(between(x, 12000, 14999))
//       nhif = 500;
//     else if(between(x, 15000,19999))
//       nhif = 600;
//     else if(between(x, 20000 ,24999))
//       nhif = 750;
//     else if(between(x, 25000 ,29999))
//       nhif = 850;
//     else if(between(x, 30000 ,34999))
//       nhif = 900;
//     else if(between(x, 35000 ,39000))
//       nhif = 950;
//     else if(between(x, 40000 ,44999))
//       nhif = 1000;
//     else if(between(x, 45000 ,49000))
//       nhif = 1100;
//     else if(between(x, 50000 ,59999))
//       nhif = 1200;
//     else if(between(x, 60000 ,69999))
//       nhif = 1300;
//     else if(between(x, 70000 ,79999))
//       nhif = 1400;
//     else if(between(x, 80000 ,89999))
//       nhif = 1500;
//     else if(between(x, 90000 ,99999))
//       nhif = 1600;
//     else if(x>100000)
//       nhif = 1700;
//     else 
//       nhif = 0;

//     return nhif;
//   }
  
    function getNHIFRates(x) {
        if(x > 0){
            return x * 2.75 / 100;// 2.75% of Gross Salary
        }
    }
  
//   function getNSSFRate (x) {
//     let NSSF = 0;
//     if(between(x, 0, 18000) ){
//       NSSF= x*6/100; //of Gross salary
//     }else if (x > 18000){
//       NSSF = 1080;
//     }
//     return NSSF;
//   }

 function getNSSFRate(x) {
      let nssf = 0;
      if (x <= 36000)) {
        nssf = x * 6 / 100; //of Gross salary
      } else if (x > 36000) {
        nssf = 2160;
      }
      return nssf;
    }

  function between(x, min, max) {
    return x >= min && x <= max;
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>