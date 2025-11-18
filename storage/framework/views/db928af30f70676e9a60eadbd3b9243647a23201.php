
<?php $__env->startSection('title', __('Employee')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo __('Employee'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('Employee'); ?></a></li>
            <li class="active"><?php echo __('Employee'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Manage Active Employee'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="d-flex-inline">
                    <!--<div  class="col-md-3">-->
                    <!--    <a href="<?php echo url('/people/employees/create'); ?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i><?php echo __(' Add'); ?> </a>-->
                    <!--</div>           -->
                    <div  class="col-md-9">
                        <input type="text" id="myInput" class="form-control" placeholder="<?php echo __('Search..'); ?>">
                    </div>
                </div>

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
            <div id="printable_area" class="col-md-12 table-responsive">
                   <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo __(' SL#'); ?></th>
                                <th><?php echo __(' ID'); ?></th>
                                <th><?php echo __('Full Name'); ?></th>
                                <th><?php echo __(' ID No'); ?></th>
                                <th><?php echo __(' Phone No'); ?></th>
                                <th><?php echo __(' Designation'); ?></th>
                                <th><?php echo __(' Status'); ?></th>
                                <th class="text-center"><?php echo __('Added'); ?></th>
                                <th class="text-center"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php $sl = 1; ?>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($employee['activation_status'] == 0): ?>
                            <?php continue; ?>
                            <?php endif; ?>
                            <tr>
                                <td><a href="/people/employees/details/<?php echo $employee['id']; ?>"><?php echo $sl++; ?></a></td>
                                <td><?php echo $employee['id']; ?></td>
                                <td><?php echo $employee['name'].' '.$employee['mother_name'] .' '.$employee['father_name']; ?></td>
                                <td><?php echo $employee['id_number']; ?></td>
                                <td><?php echo $employee['contact_no_one']; ?></td>
                                <td><?php echo $employee['designation']; ?></td>
                                <td>
                                    <?php if($employee['activation_status'] == 1): ?>
                                    <div class="btn-group">
                                        <a href="<?php echo url('/people/employees/deactive/' . $employee['id']); ?>" class="tip btn btn-success btn-flat" data-toggle="tooltip" data-original-title="Click to disable">
                                            <i class="fa fa-arrow-down"></i>
                                            <span class="hidden-sm hidden-xs"> <?php echo __('Activated'); ?></span>
                                        </a>
                                    </div>
                                    <?php else: ?>
                                    <div class="btn-group">
                                        <a href="<?php echo url('/people/employees/active/' . $employee['id']); ?>" class="tip btn btn-warning btn-flat" data-toggle="tooltip" data-original-title="Click to active">
                                            <i class="fa fa-arrow-up"></i>
                                            <span class="hidden-sm hidden-xs"> <?php echo __('Disabled'); ?></span>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </td>  
                                <td class="text-center"><?php echo date("d F Y", strtotime($employee['created_at'])); ?></td>
                               
                                <td class="text-center">
                                   <a href="<?php echo url('/people/employees/edit/' . $employee['id']); ?>"><i class="icon fa fa-edit"></i> <?php echo __('Edit'); ?></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    
    
        <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Manage Disabled Employees'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <!--<div class="d-flex-inline">-->
                    <!--<div  class="col-md-3">-->
                    <!--    <a href="<?php echo url('/people/employees/create'); ?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i><?php echo __(' Add'); ?> </a>-->
                    <!--</div>           -->
                <!--    <div  class="col-md-9">-->
                <!--        <input type="text" id="myInput" class="form-control" placeholder="<?php echo __('Search..'); ?>">-->
                <!--    </div>-->
                <!--</div>-->

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
            <div id="printable_area1" class="col-md-12 table-responsive">
                   <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo __(' SL#'); ?></th>
                                <th><?php echo __(' ID'); ?></th>
                                <th><?php echo __('Full Name'); ?></th>
                                <th><?php echo __(' ID No'); ?></th>
                                <th><?php echo __(' Phone No'); ?></th>
                                <th><?php echo __(' Designation'); ?></th>
                                <th><?php echo __(' Status'); ?></th>
                                <th class="text-center"><?php echo __('Added'); ?></th>
                                <th class="text-center"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php $sl = 1; ?>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($employee['activation_status'] == 1): ?>
                            <?php continue; ?>
                            <?php endif; ?>
                            <tr>
                                <td><a href="/people/employees/details/<?php echo $employee['id']; ?>"><?php echo $sl++; ?></a></td>
                                <td><?php echo $employee['id']; ?></td>
                                <td><?php echo $employee['name'].' '.$employee['mother_name'] .' '.$employee['father_name']; ?></td>
                                <td><?php echo $employee['id_number']; ?></td>
                                <td><?php echo $employee['contact_no_one']; ?></td>
                                <td><?php echo $employee['designation']; ?></td>
                                <td>
                                    <?php if($employee['activation_status'] == 1): ?>
                                    <div class="btn-group">
                                        <a href="<?php echo url('/people/employees/deactive/' . $employee['id']); ?>" class="tip btn btn-success btn-flat" data-toggle="tooltip" data-original-title="Click to disable">
                                            <i class="fa fa-arrow-down"></i>
                                            <span class="hidden-sm hidden-xs"> <?php echo __('Activated'); ?></span>
                                        </a>
                                    </div>
                                    <?php else: ?>
                                    <div class="btn-group">
                                        <a href="<?php echo url('/people/employees/active/' . $employee['id']); ?>" class="tip btn btn-warning btn-flat" data-toggle="tooltip" data-original-title="Click to active">
                                            <i class="fa fa-arrow-up"></i>
                                            <span class="hidden-sm hidden-xs"> <?php echo __('Disabled'); ?></span>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </td>  
                                <td class="text-center"><?php echo date("d F Y", strtotime($employee['created_at'])); ?></td>
                               
                                <td class="text-center">
                                   <a href="<?php echo url('/people/employees/edit/' . $employee['id']); ?>"><i class="icon fa fa-edit"></i> <?php echo __('Edit'); ?></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
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