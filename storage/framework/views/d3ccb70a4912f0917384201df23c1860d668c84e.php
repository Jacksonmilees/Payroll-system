<!DOCTYPE html>
<html>
    <!-- head -->
    <?php echo $__env->make('administrator.layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /head -->
    <body class="hold-transition skin-blue-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <!-- header -->
            <?php echo $__env->make('administrator.layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- /header -->

            <!-- Left side column. contains the side bar -->
            <?php echo $__env->make('administrator.layouts.left_side_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- /Left Side Bar -->

            <!-- Content Wrapper. Contains page content -->
            <?php echo $__env->yieldContent('main_content'); ?>
            <!-- /content-wrapper -->

            <!-- Footer. contains the footer -->
            <?php echo $__env->make('administrator.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- /Footer -->

            <!-- Add the side bar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- Scripts. contains the script -->
        <?php echo $__env->make('administrator.layouts.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- /Scripts -->
        
        <div class="modal" id="logo-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Logo</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img src="<?php echo __('/public/backend/img/corporatelogo.png'); ?>" width="100" height="100" id="logo-image">
                        <hr>
                        <div id="message"></div>
                        <form id="logo-form" action="<?php echo route('logo.update'); ?>" enctype="multipart/form-data" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="logo_url">Upload logo Image:</label>
                                <input type="file" class="form-control-file" id="logo_image" name="logo_image">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>


</html>
