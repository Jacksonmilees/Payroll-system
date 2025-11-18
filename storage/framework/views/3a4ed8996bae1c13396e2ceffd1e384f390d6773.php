<?php
use Carbon\Carbon;
?>

<?php $__env->startSection('title', __('Leave Application Lists')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo __('Leave Application'); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a><?php echo __('Leave'); ?></a></li>
            <li class="active"><?php echo __('Leave Application lists'); ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Leave Application lists'); ?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div  class="col-md-4">
                    <input type="text" id="myInput" class="form-control" placeholder="<?php echo __('Search..'); ?>">
                </div>
                <div  class="col-md-8">
                    
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
                <div class="col-md-12 table-responsive">
                    <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo __('SL#'); ?></th>
                                <th><?php echo __('Employee Name'); ?></th>
                                <th><?php echo __('Reason'); ?></th>
                                <th><?php echo __('Starts Date'); ?></th>
                                <th><?php echo __('End Date'); ?></th>
                                <th><?php echo __('Leave Days'); ?></th>
                                <th><?php echo __('Leave category'); ?></th>
                                <th><?php echo __('Created at'); ?></th>
                                <th class="text-center"><?php echo __('Status'); ?></th>
                                <?php if(Auth::user()->access_label == 1): ?>
                                <th width="17%" class="text-center"><?php echo __('Actions'); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                        <?php ($sl = 1); ?>
                        <?php $__currentLoopData = $leave_applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td><?php echo $sl++; ?></td>
                            <td><?php echo $leave_application['name']; ?></td>
                            <td><?php echo str_limit($leave_application['reason'], 65); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($leave_application['start_date'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($leave_application['end_date'])); ?></td>
                            <td class="text-center">
                                <!--<?php ($leave_days = Carbon::parse($leave_application['start_date'])->diffInDays(Carbon::parse($leave_application['end_date']))+1); ?>-->
                                <?php echo $leave_application['leave_count']; ?>

                            </td>
                            <td><?php echo $leave_application['leave_category']; ?></td>
                            <td><?php echo date("D d F Y h:ia", strtotime($leave_application['created_at'])); ?></td>

                            <td class="text-center">
                            <?php if($leave_application['publication_status'] == 0): ?>
                            <a href="" class="btn btn-warning btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Pending"><i class="icon fa fa-hourglass-2"></i> <?php echo __('Pending'); ?></a>
                            <?php elseif($leave_application['publication_status'] == 1): ?>
                              <a href="" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Accepted"><i class="icon fa fa-smile-o"> <?php echo __('Accepted'); ?></i></a>
                            <?php else: ?>
                              <a href="" class="btn btn-danger btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Not Accepted"><i class="icon fa fa-flag"></i> <?php echo __('Not Accepted'); ?></a>
                            <?php endif; ?>
                          </td>
                            <?php if(Auth::user()->access_label == 1): ?>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <?php echo __('Actions'); ?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo url('/hrm/application_lists/' .$leave_application['id']); ?>"><i class="icon fa fa-file-text"></i> <?php echo __('Details'); ?></a></li>

                                         <li><a href="<?php echo url('/hrm/application/download/' .$leave_application['id']); ?>"><i class="icon fa fa-file-text"></i> <?php echo __('Download'); ?></a></li>

                                        <li><a  href="<?php echo url('/hrm/leave_application/approved/' .$leave_application['id']); ?>"><i class="icon fa fa-file-text"></i> <?php echo __('Approved'); ?></a></li>

                                        <li><a href="<?php echo url('/hrm/leave_application/not_approved/' .$leave_application['id']); ?>"><i class="icon fa fa-file-text"></i> <?php echo __('Not Approed'); ?></a></li>

                                    </ul>
                                </div>
                            </td>
                            <?php endif; ?>
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
<script type="text/javascript">
    $('.table-responsive').on('shown.bs.dropdown', function (e) {
        var t = $(this),
            m = $(e.target).find('.dropdown-menu'),
            tb = t.offset().top + t.height(),
            mb = m.offset().top + m.outerHeight(true),
            d = 20; // Space for shadow + scrollbar.
        if (t[0].scrollWidth > t.innerWidth()) {
            if (mb + d > tb) {
                t.css('padding-bottom', ((mb + d) - tb));
            }
        }
        else {
            t.css('overflow', 'visible');
        }
    }).on('hidden.bs.dropdown', function () {
        $(this).css({'padding-bottom': '', 'overflow': ''});
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>