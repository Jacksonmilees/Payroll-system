<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo url('/dashboard'); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        
        <!-- logo for regular state and mobile devices -->
        
        <span class="logo-mini">
            <b><?php echo env('COM_SHORTNAME','NCL'); ?></b>
        </span>
        <span class="logo-lg">
            <b><?php echo env('COM_FULLNAME','NANLINE COMPANY'); ?></b> LTD
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only"><?php echo __('Toggle navigation'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if(!empty(auth()->user()->avatar)): ?>
                        <img src="<?php echo asset('public/profile_picture/'.auth()->user()->avatar); ?>" class="user-image" alt="User Image">
                        <?php else: ?>
                        <img src="<?php echo asset('public/profile_picture/blank_profile_picture.png'); ?>" class="user-image" alt="User Image">
                        <?php endif; ?>

                        <span class="hidden-xs"><?php echo Auth::user()->name; ?></span>
                    </a>
                    <ul class="dropdown-menu wow fadeInUp" data-wow-duration=".5s" data-wow-delay=".5s">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if(!empty(auth()->user()->avatar)): ?>
                            <img src="<?php echo asset('public/profile_picture/'.auth()->user()->avatar); ?>" class="img-circle" alt="User Image">
                            <?php else: ?>
                            <img src="<?php echo asset('public/profile_picture/blank_profile_picture.png'); ?>"  class="img-circle" alt="User Image">
                            <?php endif; ?>
                            <p>
                                <?php echo Auth::user()->name; ?>

                                <small><?php echo __('Member Since'); ?> <?php echo date("d F Y", strtotime(Auth::user()->created_at)); ?> </small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo url('/profile/user-profile'); ?>" class="btn btn-default btn-flat"><?php echo __('Profile'); ?></a>
                                <?php if(Auth::user()->access_label == 1): ?>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#logo-modal"><?php echo __('Change Logo'); ?></button>
                                <?php endif; ?>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo route('logout'); ?>" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo __('Sign out'); ?></a>
                                <form id="logout-form" action="<?php echo route('logout'); ?>" method="POST">
                                    <?php echo csrf_field(); ?>

                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>