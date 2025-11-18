<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php echo $__env->make('administrator.layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </section>
    <!-- /.sidebar -->
</aside>