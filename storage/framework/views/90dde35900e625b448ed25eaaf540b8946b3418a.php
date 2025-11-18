
<?php $__env->startSection('title', __(date('F Y',strtotime(request()->date ?? date('F Y')))  .' DETAILED PAYROLL REPORT')); ?>
<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php echo __('Employees Detailed Report'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('Employee'); ?></a></li>
            <li class="active"><?php echo __('Employees Detailed Report'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Salary List'); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                 <div class="col-md-6">
                    <div class="my-2">
                        <form action="<?php echo URL::current();; ?>" method="GET">
                            <div class="mb-3" style="display: flex;">
                                <input type="date" class="form-control" style="margin-top: 10px;" name="date" value="<?php echo request()->date ?? ''; ?>">
                                <button class="btn btn-primary" style="margin: 10px;" type="submit">GET</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- /.Notification Box -->
                <div id="printable_area" class="col-md-12 table-responsive">
                    <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo __('Full Name'); ?></th>
                                <th><?php echo __(' B. SALARY'); ?></th>
                                <th><?php echo __(' T. ALLOWANCES'); ?></th>
                                <th><?php echo __(' PAYE'); ?></th>
                                <th><?php echo __(' NSSF'); ?></th>
                                <th><?php echo __(' SHIF'); ?></th>
                                <th><?php echo __(' Loans'); ?></th>
                                <th><?php echo __(' Advance Salary'); ?></th>
                                <th><?php echo __(' House Levy'); ?></th>
                                <th><?php echo __('OTHER DEDUCTIONS'); ?></th>
                                <th><?php echo __(' GROSS PAY'); ?></th>
                                <th><?php echo __(' T.DEDS'); ?></th>
                                <th><?php echo __(' NET SALARY'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            $sl = 1;
                            $totalBasicSalary = 0;
                            $tAllowance = 0;
                            $totalPaye = 0;
                            $totalNssf = 0;
                            $totalNhif = 0;
                            $totalloan = 0;
                            $totalGrossPay = 0;
                            $totalDeduction = 0;
                            $totaladvance = 0;
                            $totalhouseleavy = 0;
                            $totalotherd = 0;
                            $totalNetSalary = 0;
                            ?>
                            
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($debits = 0); ?>
                            <?php ($credits = 0); ?>
                            <?php ($al = 0); ?>
                            <?php ($loanAmm = 0); ?>
                            <?php ($specLoan = 0); ?>
                            <?php ($advance = 0); ?>
                            <?php ($houseleavy = 0); ?>
                            <?php ($otherd = 0); ?>
                            <?php ($credits += ($employee['house_rent_allowance'] + $employee['medical_allowance'] + $employee['special_allowance'] + $employee['other_allowance'])); ?>
                            <?php ($debits += $employee['tax_deduction'] + $employee['provident_fund_deduction'] + $employee['other_deduction'] + $employee['nhif'] + $employee['nssf']); ?>
                            <?php ($debits += $employee['paye']); ?>
                            <?php ($houseleavy += ($employee['basic_salary'] * 1.5)/100); ?>
                            <?php $__currentLoopData = $bonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($employee['user_id'] == $bonus['user_id']): ?>
                                    <?php ($credits += $bonus['bonus_amount']); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php $__currentLoopData = $deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($employee['user_id'] == $deduction['user_id']): ?>
                                    <?php ($debits += $deduction['deduction_amount']); ?>
                                    <?php if($deduction['deduction_name'] == 'advance'): ?>
                                        <?php ($advance += $deduction['deduction_amount']); ?>
                                    <?php endif; ?>
                                    
                                     <?php if($deduction['deduction_name'] != 'advance' && $deduction['deduction_name'] != 'loan'): ?>
                                        <?php ($otherd += $deduction['deduction_amount']); ?>
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
                                    <?php ($loanAmm += $installment); ?>
                                    <?php ($specLoan = $loan['loan_amount']); ?>
                                    <?php ($remaining = $loan['remaining_installments']); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $employee['name'].' '.$employee['mother_name'] .' '.$employee['father_name']; ?></td>
                                
                                <?php ($totalBasicSalary += $employee['basic_salary']); ?>
                                <td><?php echo number_format ($employee['basic_salary'], 2, '.', ','); ?></td>
                                
                                <?php ($tAllowance += $credits); ?>
                                <td><?php echo number_format ($credits, 2, '.', ','); ?></td>
                                
                                <?php ($totalPaye += $employee['paye']); ?>
                                <td><?php echo number_format ($employee['paye'], 2, '.', ','); ?></td>
                                
                                <?php ($totalNssf += $employee['basic_salary'] <= 36000 ? $employee['basic_salary'] * 6 / 100 : 2160); ?>
                                <td><?php echo number_format ( $employee['basic_salary'] <= 36000 ? $employee['basic_salary'] * 6 / 100 : 2160, 2, '.', ','); ?></td>
                                
                                <?php ($totalNhif +=  $employee['basic_salary'] * 1.5 / 100); ?>
                                <td><?php echo number_format ($employee['basic_salary'] * 2.75 / 100, 2, '.', ','); ?></td>
                                
                                <?php ($totalloan += $specLoan / ($remaining ?? 1)); ?>
                                <?php ($loanDevideByinstallments = $specLoan / ($remaining ?? 1)); ?>
                                <td><?php echo number_format ($loanDevideByinstallments, 2, '.', ','); ?></td>
                                
                                <?php ($totaladvance += $advance); ?>
                                <td><?php echo number_format ($advance, 2, '.', ','); ?></td>
                            
                                
                                <?php ($houseLevy = ($employee['basic_salary']) * 1.5 / 100); ?>
                                <?php ($totalhouseleavy += $houseLevy); ?>
                                <td><?php echo number_format($houseLevy, 2, '.', ','); ?></td>
                                <?php ($totalotherd+= $otherd); ?>
                                <td><?php echo number_format($otherd, 2, '.', ','); ?></td>
                                
                                
                                <?php ($totalGrossPay += $credits+$employee['basic_salary']); ?>
                                <td><?php echo number_format ($credits+$employee['basic_salary'], 2, '.', ','); ?></td>
                                
                                <?php ($totalDeduction += ($employee['paye'] + $loanDevideByinstallments + $employee['nssf'] + $employee['nhif'] + $advance + $houseLevy + $otherd)); ?>
                                <td><?php echo number_format (($employee['paye'] +  + $employee['nssf'] + $employee['nhif'] +$loanAmm + $advance + $houseLevy  + $otherd ), 2, '.', ','); ?></td>
                                
                                <?php ($totalNetSalary += ($credits+$employee['basic_salary'])-($employee['paye'] + $loanDevideByinstallments  + $employee['nssf'] + $employee['nhif']  + $advance + $houseleavy+ $otherd) ); ?>
                                <td><?php echo number_format (($credits+$employee['basic_salary'])-($employee['paye'] + $loanDevideByinstallments  +$employee['nssf'] + $employee['nhif']  + $advance + $houseleavy+ $otherd), 2, '.', ','); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td><?php echo 'KES '.number_format($totalBasicSalary,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($tAllowance,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totalPaye,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totalNssf,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totalNhif,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totalloan,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totaladvance,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totalhouseleavy,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totalotherd,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totalGrossPay,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totalDeduction,2,'.',','); ?></td>
                                <td><?php echo 'KES '.number_format($totalNetSalary,2,'.',','); ?></td>  
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>