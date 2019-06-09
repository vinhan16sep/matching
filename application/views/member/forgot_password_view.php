<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"  href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('assets/scss/style.css') ?>">

    <title>Quên Mật Khẩu</title>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo site_url('assets/vendor/jquery/jquery.min.js'); ?>" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="<?php echo site_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
</head>
<body>
<div id="member-login">
    <header>
        <div class="nav-logo">
            <a href="<?php echo base_url('')?>">
                <img src="<?php echo site_url('assets/img/logo-w.svg') ?>" alt="Logo Vinasa">
            </a>
        </div>
    </header>

    <div class="cover-background" style="background-image: url('https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1355&q=80">
        <div class="gradient"></div>

        <div class="content">
            <div class="left">
                <h6>Matching Platform</h6>
                <h3>More million people using everyday</h3>

                <p>Lots of benifits waiting for you when you become on of our partners.</p>
            </div>

            <div class="right">
                <?php if ($this->session->flashdata('auth_message')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert! <?php echo $this->session->flashdata('auth_message'); ?></h4>
                    </div>
                <?php endif ?>
                <div class="wrapper">
                    <h3 style="text-align: center;">Quên mật khẩu</h3>
                    <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                        <div class="row">
                            <div class="form-group col-xs-12 col-lg-12">
                                <?php echo form_label('Email', 'email'); ?>
                                <?php echo form_error('email'); ?>
                                <?php echo form_input('email', '', 'class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_submit('submit', 'Xác Nhận', 'class="btn btn-primary btn-lg btn-block"'); ?>
                            <a href="javascript:history.back()" name="back" class="btn btn-default btn-lg btn-block">Quay lại</a>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>