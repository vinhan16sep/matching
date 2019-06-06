<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo site_url('assets/scss/style.css') ?>">

    <title>Member Login</title>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div id="member-login">
    <header>
        <div class="nav-logo">
            <a href="<?php echo base_url('')?>">
                <img src="<?php echo site_url('assets/img/logo.png') ?>" alt="Logo Vinasa">
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
                <?php if ($this->session->flashdata('login_message_error')): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert! <?php echo $this->session->flashdata('login_message_error'); ?></h4>
                    </div>
                <?php endif ?>
                <div class="wrapper">
                    <?php echo $this->session->flashdata('message'); ?>
                    <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                    <div class="row">
                        <div class="form-group col-xs-12 col-lg-12">
                            <?php echo form_label('Email: ', 'identity'); ?>
                            <?php echo form_error('identity'); ?>
                            <?php echo form_input('identity', set_value('identity'), 'class="form-control"'); ?>
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <?php echo form_label('Password: ', 'password'); ?>
                            <?php echo form_error('password'); ?>
                            <?php echo form_password('password', set_value('password'), 'class="form-control"'); ?>
                        </div>
                    </div>
                    <?php echo form_submit('submit', 'Đăng nhập', 'class="btn btn-primary btn-lg btn-block"'); ?>
                    <?php echo form_close(); ?>
                    <br>
                    Quên mật khẩu? Bấm vào <a href="<?php echo base_url('member/user/forgot_password'); ?>">đây</a>
                </div>
            </div>
        </div>
    </div>
</div>
