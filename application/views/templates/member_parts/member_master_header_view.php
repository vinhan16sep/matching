<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo site_url('assets/public/img/favicon.png'); ?>"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="<?php echo site_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet"  href="<?php echo site_url('assets/'); ?>css/sb-admin-2.min.css" />
    <link rel="stylesheet"  href="<?php echo site_url('assets/'); ?>vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" />

    <script src="<?php echo site_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo site_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo site_url('assets/'); ?>vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo site_url('assets/'); ?>vendor/bootstrap-datepicker/locales/bootstrap-datepicker.vi.js"></script>
    <script src="<?php echo site_url('assets/'); ?>js/sb-admin-2.min.js"></script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('members')): ?>
        <header class="main-header">
            <!-- logo -->
            <a href="<?php echo base_url('admin/dashboard') ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <!--      <span class="logo-mini"><b>MATO</b></span>-->
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>ADMINISTRATOR</b> PAGE</span>
            </a>
            <!-- header navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!--            <li class="dropdown messages-menu">-->
                            <!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">-->
                                <!--                    <i class="fa fa-envelope-o"></i>-->
                                <!--                    <span class="label label-success">--><?php //echo $total ?><!--</span>-->
                                <!--                </a>-->
                                <!--                <ul class="dropdown-menu">-->
                                    <!--                    <li class="header">Bạn có --><?php //echo $total ?><!-- bình luận chưa xem</li>-->
                                    <!--                    <li>-->
                                        <!--                        <!-- inner menu: contains the actual data -->
                                        <!--                        <ul class="menu">-->
                                            <!--                            --><?php //if($news_comment): ?>
                                            <!--                                --><?php //foreach ($news_comment as $value):?>
                                            <!--                                    <li><!-- start message -->
                                                <!--                                        <a href="#">-->
                                                    <!--                                            <h4>-->
                                                        <!--                                                Support Team-->
                                                        <!--                                                <small>-->
                                                            <!--                                                </small>-->
                                                            <!--                                            </h4>-->
                                                            <!--                                            <p style="padding-right: 15px;">--><?php //echo substr($value['content'], 0, 50) ?><!--...</p>-->
                                                            <!--                                        </a>-->
                                                            <!--                                    </li>-->
                                                            <!--                                --><?php //endforeach; ?>
                                                            <!--                            --><?php //else: ?>
                                                            <!--                                <li></li>-->
                                                            <!--                            --><?php //endif; ?>
                                                            <!--                        </ul>-->
                                                            <!--                    </li>-->
                                                            <!--                    <li class="footer"><a href="--><?php //echo base_url('admin/comment/delete_all') ?><!--" id="seen_comment">Đã xem</a>  <a href="--><?php //echo base_url('admin/comment/index/new-comment') ?><!--">Xem tất bình luận</a></li>-->
                                                            <!--                </ul>-->
                                                            <!--            </li>-->

                                                            <!-- user account: style can be found in dropdown.less -->
                                                            <li class="dropdown user user-menu">
                                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                    <img src="<?php echo site_url('assets/public/img/client.jpg'); ?>" class="user-image" alt="user image">
                                                                    <span class="hidden-xs"><?php echo (isset($user_email))? $user_email : '' ?></span>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <!-- user image -->
                                                                    <li class="user-header">
                                                                        <img src="<?php echo site_url('assets/public/img/logo.png'); ?>" class="img-circle" alt="user image">

                                                                        <p>
                                                                            Thời Gian Hiện Tại
                                                                            <small><?php echo date('d/m/Y') ?></small>
                                                                        </p>
                                                                    </li>
                                                                    <!-- menu body -->

                                                                    <!-- menu footer-->
                                                                    <li class="user-footer">
                                                                        <div class="pull-left">
                                                                            <a href="<?php echo site_url('member/user/change_password'); ?>" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                                                                        </div>
                                                                        <div class="pull-right">
                                                                            <a href="<?php echo site_url('member/user/logout'); ?>" class="btn btn-default btn-flat">Thoát</a>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <!-- control sidebar toggle button -->
                                                            <li>
                                                                <!--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </nav>
                                            </header>
                                        <?php endif; ?>
