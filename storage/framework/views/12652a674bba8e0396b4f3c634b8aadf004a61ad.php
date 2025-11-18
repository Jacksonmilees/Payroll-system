<div id="mainMenu">
    <ul class="sidebar-menu" data-widget="tree">
        <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <span><?php echo __('Dashboard'); ?></span></a></li>
        
        <?php if (\Entrust::can('people')) : ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i> <span><?php echo __('Employee Management'); ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
        <ul class="treeview-menu">
                <?php if (\Entrust::can('manage-employee')) : ?>
                <li><a href="<?php echo url('/people/employees/create'); ?>"><i class="fa fa-circle-o"></i><?php echo __(' New Employee'); ?></a></li>
                <li><a href="<?php echo url('/people/employees'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Manage Employee'); ?></a></li>
                <?php endif; // Entrust::can ?>
            </ul>
        </li>
        <?php endif; // Entrust::can ?>
      
        <?php if (\Entrust::can('payroll-management')) : ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dollar"></i> <span><?php echo __('Payroll Management'); ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <?php if (\Entrust::can('manage-salary')) : ?>
                <li><a href="<?php echo url('/hrm/payroll'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Manage Salary'); ?></a></li>
                <?php endif; // Entrust::can ?>
                <?php if (\Entrust::can('salary-list')) : ?>
                <li><a href="<?php echo url('/hrm/payroll/salary-list'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Salary List'); ?></a></li>
                <?php endif; // Entrust::can ?>

                <li><a href="<?php echo url('/hrm/payroll/increment/search'); ?>"><i class="fa fa-circle-o"></i><?php echo __(' New Increment'); ?></a></li>
                <li><a href="<?php echo url('/hrm/payroll/increment/list'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Increment List'); ?></a></li>

                <?php if (\Entrust::can('make-payment')) : ?>
                <li><a href="<?php echo url('/hrm/salary-payments'); ?>"><i class="fa fa-circle-o"></i><?php echo __(' Make Payment'); ?></a></li>
                <?php endif; // Entrust::can ?>
                <?php if (\Entrust::can('generate-payslip')) : ?>
                <li><a href="<?php echo url('/hrm/generate-payslips/'); ?>"><i class="fa fa-circle-o"></i> <?php echo __(' Generate Payslip'); ?></a></li>
                <?php endif; // Entrust::can ?>

                <?php if (\Entrust::can('manage-bonus')) : ?>
                <li><a href="<?php echo url('/hrm/bonuses'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Manage Bonus'); ?></a></li>
                <?php endif; // Entrust::can ?>
                <?php if (\Entrust::can('manage-deduction')) : ?>
                <li><a href="<?php echo url('/hrm/allowance'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Manage Allowance'); ?></a></li>
                <li><a href="<?php echo url('/hrm/deduction'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Manage Deduction'); ?></a></li>
                <?php endif; // Entrust::can ?>
                <?php if (\Entrust::can('loan-management')) : ?>
                <li><a href="<?php echo url('/hrm/loans'); ?>"><i class="fa fa-circle-o"></i><?php echo __(' Loan Management'); ?></a></li>
                <?php endif; // Entrust::can ?>
                <?php if (\Entrust::can('provident-fund')) : ?>
                <li><a href="<?php echo url('/hrm/provident-funds'); ?>"><i class="fa fa-circle-o"></i><?php echo __(' Provident Fund'); ?></a></li>
                <?php endif; // Entrust::can ?>
            </ul>
        </li>
        <?php endif; // Entrust::can ?>       
        <?php if (\Entrust::can('leave-application')) : ?>
        <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-send"></i> <span><?php echo __('Leave Management'); ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
             
                <?php if (\Entrust::can('manage-leave-application')) : ?>
                <li><a href="<?php echo url('/setting/leave_categories/create'); ?>"><i class="fa fa-circle-o"></i><?php echo __('New Leave Category'); ?></a></li>
                <li><a href="<?php echo url('/setting/leave_categories'); ?>"><i class="fa fa-circle-o"></i><?php echo __('Leave Category List'); ?></a></li>
                <li><a href="<?php echo url('/hrm/application_lists'); ?>"><i class="fa fa-circle-o"></i> <span><?php echo __('Leave Application List'); ?></span></a></li>
                <?php endif; // Entrust::can ?>
                <?php if (\Entrust::can('my-leave-application')) : ?>
                <li><a href="<?php echo url('/hrm/leave_application/create'); ?>"><i class="fa fa-circle-o"></i> <span><?php echo __('New Leave Application'); ?></span></a></li>
                <li><a href="<?php echo url('/hrm/leave_application'); ?>"><i class="fa fa-circle-o"></i> <span><?php echo __('Leave Application Manage'); ?></span></a></li>
                <?php endif; // Entrust::can ?>
            </ul>
        </li>
        <?php endif; // Entrust::can ?>



         <?php if (\Entrust::can('manage-award')) : ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file-text"></i> <span><?php echo __('NOC/Ex. Certificate'); ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <?php if (\Entrust::can('manage-award')) : ?>
                <li><a href="<?php echo url('/hrm/noc/add'); ?>"><i class="fa fa-circle-o"></i> <span><?php echo __('NOC/Certificate Add'); ?></span></a></li>
                <li><a href="<?php echo url('/hrm/noc/list'); ?>"><i class="fa fa-circle-o"></i> <span><?php echo __('NOC List'); ?></span></a></li>
                <li><a href="<?php echo url('/hrm/certificate/list'); ?>"><i class="fa fa-circle-o"></i> <span><?php echo __('Experience Certificate'); ?></span></a></li>
                <?php endif; // Entrust::can ?>
            </ul>
        </li>
         <?php endif; // Entrust::can ?>
        <?php if (\Entrust::can('notice')) : ?>
        <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-bell"></i> <span><?php echo __('Notice Board'); ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
               
                <?php if (\Entrust::can('manage-notice')) : ?>
                 <li><a href="<?php echo url('hrm/notice/create'); ?>"><i class="fa fa-circle-o"></i><?php echo __('New Notice'); ?></a></li>
                <li><a href="<?php echo url('/hrm/notice'); ?>"><i class="fa fa-circle-o"></i><?php echo __('Manage Notice'); ?></a></li>
                <?php endif; // Entrust::can ?>
                <?php if (\Entrust::can('notice-board')) : ?>
                <li><a href="<?php echo url('/hrm/notice/show'); ?>"><i class="fa fa-circle-o"></i> <span><?php echo __('Notice list'); ?></span></a></li>
                <?php endif; // Entrust::can ?>
            </ul>
        </li>
        <?php endif; // Entrust::can ?>
        <?php if (\Entrust::can('file-upload')) : ?>
        <li><a href="<?php echo url('/hrm/salary/statement/search'); ?>"><i class="fa fa-certificate"></i> <span><?php echo __('Salary Statement'); ?></span></a></li>
        <?php endif; // Entrust::can ?>

        <?php if (\Entrust::can('hrm-setting')) : ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cog"></i> <span><?php echo __('Configuration'); ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo url('/setting/departments'); ?>"><i class="fa fa-circle-o"></i><?php echo __('Manage Job Groups'); ?> </a></li>
                <li><a href="<?php echo url('/setting/designations'); ?>"><i class="fa fa-circle-o"></i><?php echo __('Manage Designations'); ?> </a></li>
                <li><a href="<?php echo url('/setting/leave_categories'); ?>"><i class="fa fa-circle-o"></i><?php echo __('Manage Leave Categories'); ?> </a></li>
                <li><a href="<?php echo url('/setting/working-days'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Set Working Day'); ?></a></li>
                <li><a href="<?php echo url('/setting/holidays'); ?>"><i class="fa fa-circle-o"></i><?php echo __('Holiday List'); ?> </a></li>
                <?php if (\Entrust::can('role')) : ?>
                <li><a href="<?php echo route('setting.role.index'); ?>"><i class="fa fa-circle-o"></i><?php echo __('Role'); ?></a></li>
                <?php endif; // Entrust::can ?>
            </ul>
        </li>
        <?php endif; // Entrust::can ?>
        <?php if(\Auth::user()->access_label != 1): ?>
        <!--<li><a href="<?php echo url('/hrm/salary/sheet/search'); ?>"><i class="fa fa-money"></i> <?php echo __('Salary Report'); ?></a></li>-->
        <li><a href="<?php echo url('/hrm/p9-report?employee='.\Auth::id()); ?>"><i class="fa fa-file-powerpoint-o"></i> <?php echo __('P9 Report'); ?></a></li>
        <li><a href="<?php echo url('/hrm/generate-payslips/'); ?>"><i class="fa fa-file-text"></i> <?php echo __(' Generate Payslip'); ?></a></li>
        <?php endif; ?>
        <?php if(\Auth::user()->access_label == 1): ?>   
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i> <span><?php echo __('Reports'); ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <?php if (\Entrust::can('manage-employee')) : ?>
                <li><a href="<?php echo url('/people/employees-report'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Employee Report'); ?></a></li>
                <?php endif; // Entrust::can ?>
                <li><a href="<?php echo url('/hrm/payroll-report-detail'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Detailed Payroll Report'); ?></a></li>
                <li><a href="<?php echo url('/hrm/nssf-report'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('NSSF Report'); ?></a></li>
                <li><a href="<?php echo url('/hrm/nhif-report'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('SHIF Report'); ?></a></li>
                <li><a href="<?php echo url('/hrm/paye-report'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('PAYE Report'); ?></a></li>
                <li><a href="<?php echo url('/hrm/salary/sheet/search'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('Salary Report'); ?></a></li>
                <li><a href="<?php echo url('/hrm/p9-report'); ?>"><i class="fa fa-circle-o"></i> <?php echo __('P9 Report'); ?></a></li>
                <?php if (\Entrust::can('leave-reports')) : ?>
                <li><a href="<?php echo url('/hrm/leave-reports'); ?>"><i class="fa fa-circle-o"></i> <span><?php echo __('Leave Reports'); ?></span></a></li>
                <?php endif; // Entrust::can ?>
            </ul>
        </li>
        <?php endif; ?>
        <li><a href="<?php echo url('/profile/user-profile'); ?>"><i class="fa fa-user"></i> <span><?php echo __('Profile'); ?></span></a></li>
        <li><a href="<?php echo url('/profile/change-password'); ?>"><i class="fa fa-key"></i> <span><?php echo __('Change Password'); ?></span></a></li>
        <li>
            <a href="<?php echo route('logout'); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> <span><?php echo __('Logout'); ?></span></a>
            <form id="logout-form" action="<?php echo route('logout'); ?>" method="POST">
                <?php echo csrf_field(); ?>

            </form>
        </li>
    </ul>
</div>