<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $user['name']; ?> <?php echo __('Details'); ?></title>
  <style>
      h3{
          margin-top: 2px;
      }
      .text-center h3{
          padding-bottom: 4px;
          font-size:16px;
      }
      .text-center{
          text-align: center;
          width: 50%;
          /*padding: 30px;*/
      }
      
      body{
          width: 100% !important;
          margin: 0px;
      }
      table{
          width: 60% !important;
      }
      table tr, td {
          margin:0px;
          padding:0px;
          font-size:11px;
          width:35%;
      }
      table tr td h3{
          font-size:13px;
          font-weight:bold;
          margin:2px;
          padding:2px;
      }
      table tr td strong{
          font-size:12px;
          font-weight:bold;
          margin:0px;
          padding:0px;
      }
  </style>
</head>
<body>
  <?php
    $sum             = 0.0;
    $gross_salary    = $salary_payment->gross_salary;
    $nhif            = getNHIFRates($gross_salary);
    $nssf            = getNSSFRate($gross_salary);
    $total_deduction = $salary_payment->total_deduction;
    $taxable_pay     = to_number($gross_salary) - to_number($nssf);
    $nhif_relief     = 0.0;
    $persnol_relief  = 0.0;
    $paye            = 0.0;
    $income_tax      = 0.0;
    if ($taxable_pay <= 24000.0) {
        $income_tax = to_number($taxable_pay) * 10.0/ 100.0;
    }
    if ($taxable_pay > 24000.0) {
        $a              = (24000.0 * 10.0/ 100.0);
        $b              = (8333.0 * 25.0/ 100.0);
        $c              = to_number($taxable_pay) - (to_number(24000.0) + to_number(8333.0));
        $c              = (to_number($c) * 30.0 / 100.0);
        $income_tax     = (to_number($a) +  to_number($b) + to_number($c));
        $nhif_relief    = (to_number($nhif) * 15.0/ 100.0);
        $persnol_relief = 2400.0;
        $paye           = to_number($income_tax) - (to_number($nhif_relief) + to_number($persnol_relief));
    }
    
    // exit(between(5000,0,5000));
    $pay_after_tax = to_number($taxable_pay) - to_number($paye);
    $net_pay       = to_number($pay_after_tax) - to_number($nhif);
    $deduction     = $salary_payment->total_deduction;
    $t_deduction   = (to_number($deduction) + to_number($paye));
    $net_salary    = to_number($gross_salary) - to_number($t_deduction);
    
    
    // function getNHIFRates($x = null)
    // {
    //     $nhif = 0.0;
    //     if (between($x, 0.0, 5999.0)) {
    //         $nhif = 150.0;
    //     } else if (between($x, 6000.0, 8999.0)) {
    //         $nhif = 300.0;
    //     } else if (between($x, 8000.0, 11999.0)) {
    //         $nhif = 400.0;
    //     } else if (between($x, 12000.0, 14999.0)) {
    //         $nhif = 500.0;
    //     } else if (between($x, 15000.0, 19999.0)) {
    //         $nhif = 600.0;
    //     } else if (between($x, 20000.0, 24999.0)) {
    //         $nhif = 750.0;
    //     } else if (between($x, 25000.0, 29999.0)) {
    //         $nhif = 850.0;
    //     } else if (between($x, 30000.0, 34999.0)) {
    //         $nhif = 900.0;
    //     } else if (between($x, 35000.0, 39000.0)) {
    //         $nhif = 950.0;
    //     } else if (between($x, 40000.0, 44999.0)) {
    //         $nhif = 1000.0;
    //     } else if (between($x, 45000.0, 49000.0)) {
    //         $nhif = 1100.0;
    //     } else if (between($x, 50000.0, 59999.0)) {
    //         $nhif = 1200.0;
    //     } else if (between($x, 60000.0, 69999.0)) {
    //         $nhif = 1300.0;
    //     } else if (between($x, 70000.0, 79999.0)) {
    //         $nhif = 1400.0;
    //     } else if (between($x, 80000.0, 89999.0)) {
    //         $nhif = 1500.0;
    //     } else if (between($x, 90000.0, 99999.0)) {
    //         $nhif = 1600.0;
    //     } else if ($x > 100000.0) {
    //         $nhif = 1700.0;
    //     } else {
    //         $nhif = 0.0;
    //     }
    //     return $nhif;
    // }
    
     function getNHIFRates($x) {
        if($x > 0){
            return $x * 2.75 / 100;// 2.75% of Gross Salary
        }
    }
    
    
      function getNSSFRate($x) {
      $nssf = 0;
      if (between($x, 0, 36000)) {
        $nssf = $x * 6 / 100; //of Gross salary
      } else if ($x > 36000) {
        $nssf = 2160;
      }
      return $nssf;
    }
    
    // function getNSSFRate($x = null)
    // {
    //     $NSSF = 0.0;
    //     if (between($x, 0.0, 18000.0)) {
    //         $NSSF = (to_number($x) * 6.0/ 100.0);
    //     } else if ($x > 18000.0) {
    //         $NSSF = 1080.0;
    //     }
        
    //     return $NSSF;
    // };
    
    
    function between ($x = null, $min = null, $max = null)
    {
        return ($x >= $min && $x <= $max) ? true : false;
    };
    function to_number($x) {
        return $x;
    }
             $clean_salary = 0;
    foreach ($salary_payment_details->where('status', 'credits') as $data) {
        $clean_salary += $data->amount;
    }
    
    $nhif = ($clean_salary * 2.75) / 100;
    $house_leavy = ($clean_salary * 1.5) / 100;
    $nssf = $clean_salary <= 36000 ? ($clean_salary * 6) / 100 : 2160;
    $paye = 0;
    $income_tax = 0;
    
    // Ensure $clean_salary, $nssf, and $nhif are defined and initialized
    $taxable_pay = $clean_salary - $nssf;
    
    // Calculate income tax based on taxable pay
    if ($taxable_pay <= 24000) {
        $income_tax = ($taxable_pay * 10) / 100;
    } elseif ($taxable_pay > 24000 && $taxable_pay <= 32333) {
        $a = 2400; // Fixed tax for the first bracket
        $b = (($taxable_pay - 24000) * 25) / 100;
        $income_tax = $a + $b;
    } elseif ($taxable_pay > 32333) {
        $a = 2400; // Fixed tax for the first bracket
        $b = (8333 * 25) / 100; // Tax for the second bracket
        $c = (($taxable_pay - 32333) * 30) / 100; // Tax for the third bracket
        $income_tax = $a + $b + $c;
    }
    
    // Calculate PAYE only if taxable pay is above a certain threshold
    if ($taxable_pay > 24000) {
        $personal_relief = 2400; // Corrected spelling
        // Calculate PAYE ensuring it doesn't go negative
        $paye = $income_tax - (($nhif * 15) / 100 + $personal_relief);
    }
            
   ?>
  <!--<div class="header">-->
  <!--  <img src="<?php echo url('public/backend/img/corporatelogo.png'); ?>">-->
  <!--</div>-->
  <!--<div class="footer"><p><?php echo __('Page:'); ?> <span class="pagenum"></span></p></div>-->
  <div class="container">
    <div class="text-center">
      <h3 class=""> <b><?php echo env('APP_NAME'); ?></b> <br> <?php echo __('PAYSLIP'); ?></h3>
    </div>
    <table>
      <tr>
        <td class="h3-display">
          <tr>
            <td>Full Name: </td>
            <td><?php echo $user['name'] .' '. $user['father_name'] .' ' . $user['mother_name']; ?></td>
          </tr>
          <tr>
            <td>KRA PIN: </td>
            <td>
              <?php echo $user['kra_no']; ?>

            </td>
          </tr>
          <tr>
            <td>SHIF No: </td>
            <td>
              <?php echo $user['nhif_no']; ?>

            </td>
          </tr>
          <tr>
            <td>NSSF No: </td>
            <td>
              <?php echo $user['nssf_no']; ?>

            </td>
          </tr>
          <tr>
            <td>Designation: </td>
            <td>
              (<?php echo $user['designation']; ?>)
            </td>
          </tr>
          
          <tr>
            <td><?php echo __('Department of'); ?> </td>
            <td>
              <?php echo $user['department']; ?>

            </td>
          </tr>
          <tr>
            <td><?php echo __('Payroll No: '); ?> </td>
            <td>
               <?php echo $salary_payment->id; ?>

            </td>
          </tr>
          <tr>
            <td><?php echo __('Currency: '); ?> </td>
            <td>
              <?php echo __('KES'); ?>

            </td>
          </tr>
          <tr>
            <td><?php echo __('Month: '); ?></td>
            <td>
              <?php echo date("F Y", strtotime(now())); ?>

            </td>
          </tr>
        <!--<td>-->
        <!--  <?php if(!empty($user['avatar'])): ?>-->
        <!--  <img src="<?php echo url('public/profile_picture/' . $user['avatar']); ?>" class="img-responsive img-thumbnail" width="140px">-->
        <!--  <?php else: ?>-->
        <!--  <img src="<?php echo url('public/profile_picture/blank_profile_picture.png'); ?>" alt="blank_profile_picture" class="img-responsive img-thumbnail" width="160px">-->
        <!--  <?php endif; ?>-->
        <!--</td>-->
      </tr>
    </table>
    <table>
        <tr>
          <td>
            <h3>
              Earnings:
            </h3>
          </td>
      </tr>
      <?php ($sl = 1); ?>
      <?php ($amount = 0); ?>
      <?php $__currentLoopData = $salary_payment_details->where('status','credits'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo $data->item_name; ?></td>
        <!--<td>&nbsp;</td>-->
        <td>
          <?php if($data->status == 'credits'): ?>
          <?php echo $data->amount; ?>

            <?php if($sl != 1): ?>
                <?php ($amount += $data->amount); ?>
            <?php endif; ?>
            <?php ($sl++); ?>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
       
      
      
     <tr>
        <td>
            <h3>Deductions:</h3>
        </td>
      </tr>
      
            
      <!--<?php $__currentLoopData = $salary_payment_details->where('status','debits'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
      <!--<tr>-->
      <!--  <td>-->
      <!--      <?php echo $data->item_name == 'NHIF' ? 'SHIF' : $data->item_name; ?>-->
      <!--  </td>-->
        <!--<td>&nbsp;</td>-->
      <!--  <td>-->
      <!--      <?php if($data->item_name == 'NHIF'): ?>-->
      <!--      -<?php echo ($salary_payment->gross_salary * 2.75 / 100); ?>-->
      <!--      <?php endif; ?>-->
      <!--       <?php if($data->item_name == 'NSSF'): ?>-->
      <!--      -<?php echo ($salary_payment->gross_salary <= 36000 ? $salary_payment->gross_salary * 6 / 100 : 2160); ?>-->
      <!--      <?php endif; ?>-->
      <!--    <?php if($data->status == 'debits' && $data->item_name != 'NHIF'&& $data->item_name != 'NSSF'): ?>-->
      <!--    -<?php echo $data->amount; ?>-->
      <!--    <?php endif; ?>-->
      <!--  </td>-->
      <!--</tr>-->
      <!--<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
      
      <tr>
          <td>SHIF</td>
          <td>-<?php echo $nhif; ?></td>
      </tr>
       <tr>
          <td>NSSF</td>
          <td>-<?php echo $nssf; ?></td>
      </tr>
           
      <tr>
          <td>House Leavy</td>
          <td>-<?php echo $house_leavy; ?></td>
      </tr>
      
      <!--<tr>-->
      <!--  <td><?php echo __('NHIF'); ?></td>-->
      <!--  <td>&nbsp;</td>-->
      <!--  <td>-->
      <!--      -<?php echo __($nhif); ?>-->
      <!--  </td>-->
      <!--</tr>-->
      <!--<tr>-->
      <!--  <td><?php echo __('NSSF'); ?></td>-->
      <!--  <td>&nbsp;</td>-->
      <!--  <td>-->
      <!--      -<?php echo __($nssf); ?>-->
      <!--  </td>-->
      <!--</tr>-->
      <tr>
        <td> &nbsp; </td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right"><?php echo __('Gross Salary:'); ?></strong></td>
        <!--<td>&nbsp;</td>-->
        <td>
          <strong>
            <?php echo number_format($clean_salary, 2, '.', ''); ?>

          </strong>
        </td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right"><?php echo __('Persnol Relief:'); ?></strong></td>
        <!--<td>&nbsp;</td>-->
        <td>
          <strong>
            <?php echo number_format($persnol_relief, 2, '.', ''); ?>

          </strong>
        </td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right"><?php echo __('SHIF Relief:'); ?></strong></td>
        <!--<td>&nbsp;</td>-->
        <td>
          <strong>
            <?php echo number_format($nhif * 15 / 100, 2, '.', ''); ?>

          </strong>
        </td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right"><?php echo __('House Leavy Relief:'); ?></strong></td>
        <!--<td>&nbsp;</td>-->
        <td>
          <strong>
            <?php echo number_format(($clean_salary * 1.5/ 100) * 15 / 100, 2, '.', ''); ?>

          </strong>
        </td>
      </tr>
      
      

      
      <tr class="success">
        <td><strong class="pull-right"><?php echo __('P.A.Y.E:'); ?></strong></td>
        <!--<td>&nbsp;</td>-->
        <td><strong><?php echo number_format($paye - $house_leavy * 15 / 100, 2, '.', ''); ?></strong></td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right"><?php echo __('Total Allowance:'); ?></strong></td>
        <!--<td>&nbsp;</td>-->
        <td><strong><?php echo number_format($amount, 2, '.', ''); ?></strong></td>
        </tr>
      <tr class="success">
        <td><strong class="pull-right"><?php echo __('Total Deduction:'); ?></strong></td>
        <!--<td>&nbsp;</td>-->
        <td>
                    <strong><?php echo number_format($paye - ($house_leavy * 15) / 100 + ($clean_salary * 1.5) / 100 + ($clean_salary * 2.75) / 100 + $nssf, 2, '.', ''); ?></strong>

            </td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right"><?php echo __('Net Pay:'); ?></strong></td>
        <!--<td>&nbsp;</td>-->
        <td>
                    <strong><?php echo number_format($clean_salary - ($paye - ($house_leavy * 15) / 100 + (($clean_salary * 1.5) / 100 + ($clean_salary * 2.75) / 100) + $nssf), 2, '.', ''); ?></strong>
            </td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right"><?php echo __('Provident Fund:'); ?></strong></td>
        <!--<td>&nbsp;</td>-->
        <td><strong><?php echo number_format($salary_payment->provident_fund, 2, '.', ''); ?></strong></td>
    </tr>

    </table>

    <table>
      <tr>
        <td><?php echo __('Prepared By'); ?></td>
        <td><?php echo __('Receiver Signature'); ?></td>
        <td><?php echo __('Approval Signature'); ?></td>
      </tr>
    </table>
  </div>
</body>
</html>