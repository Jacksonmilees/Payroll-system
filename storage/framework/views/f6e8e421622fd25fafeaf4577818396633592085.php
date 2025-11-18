<?php $__env->startSection('title', __('Manage Bonuses')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo __(' BONUS'); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __(' Dashboard'); ?></a></li>
            <li><a><?php echo __(' Bonus'); ?> </a></li>
            <li class="active"><?php echo __(' Manage Bonuses'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __(' Manage Bonuses'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
            
                <div  class="col-md-6">  <a href="<?php echo url('/hrm/bonuses/create'); ?>" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> <?php echo __(' Add bonus'); ?></a></div>

       <div  class="col-md-6">  <input type="text" id="myInput" class="form-control" placeholder="<?php echo __('Search..'); ?>"></div>



                <hr>
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
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo __('SL#'); ?></th>
                                <th><?php echo __('Employee Name'); ?></th>
                                <th><?php echo __('Designation'); ?></th>
                                <th><?php echo __('Bonus Name'); ?></th>
                                <th><?php echo __('Bonus Month'); ?></th>
                                <th><?php echo __('Bonus Amount'); ?></th>
                                <th><?php echo __('Date Added'); ?></th>
                                <th class="text-center"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php ($sl = 1); ?>
                            <?php $__currentLoopData = $bonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $bonus['name']; ?></td>
                                <td><?php echo $bonus['designation']; ?></td>
                                <td><?php echo $bonus['bonus_name']; ?></td>
                                <td><?php echo date("F Y", strtotime($bonus['bonus_month'])); ?></td>
                                <td><?php echo $bonus['bonus_amount']; ?></td>
                                <td><?php echo date("d F Y", strtotime($bonus['created_at'])); ?></td>
                                <td class="text-center">
                                 <a href="<?php echo url('/hrm/bonuses/edit/' . $bonus['id']); ?>"><i class="icon fa fa-edit"></i> <?php echo __('Edit'); ?></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>





 <!-- =================Data Search================== -->
                <script>
                $(document).ready(function(){
                 $("#myInput").on("keyup", function() {
                   var value = $(this).val().toLowerCase();
                   $("#myTable tr").filter(function() {
                     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                   });
                 });
                });
                </script>
<!-- =================Data Search================== -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>