
<?php $__env->startSection('title', __('Manage Increment')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          <?php echo __(' Manage Increment'); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('Increment'); ?></a></li>
            <li class="active"><?php echo __('Manage Increment'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Manage Increment'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="d-flex-inline">           
                    <div  class="col-md-3">
                        <a href="<?php echo url('/hrm/payroll/increment/search'); ?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> <?php echo __('Add'); ?></a>
                    </div>
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
                            <th><?php echo __('SL'); ?></th>
                            <th><?php echo __('ID NO'); ?></th>
                            <th><?php echo __('Created By'); ?></th>
                            <th><?php echo __('Employee'); ?></th>
                            <th><?php echo __('Increment Date'); ?></th>
                            <th><?php echo __('Increment Amount'); ?> </th>
                            <th><?php echo __('Increment Purpose'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php ($sl = 1); ?>
                        <?php $__currentLoopData = $increments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $increment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo $sl ++; ?></td>
                            <td>INCR<?php echo $increment->id; ?></td>
                            <td><?php echo Auth::user()->name; ?></td>
                            <?php $empname= \App\User::find($increment->emp_id)->name;?>
                            <td><?php echo $empname; ?></td>
                            <td><?php echo date("d F Y", strtotime($increment->date)); ?></td>
                            <td><?php echo $increment->amount; ?></td>
                            <td><?php echo $increment->incr_purpose; ?></td>
                           

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>

  


            </div><!--printable-->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>