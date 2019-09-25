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
    <script src="<?php echo site_url('assets/vendor/jquery/jquery.min.js'); ?>" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<div id="member-login">
    <header style="width: 100%;padding-right:120px !important;">
        <div class="nav-logo">
            <a href="<?php echo base_url('')?>">
                <img src="<?php echo site_url('assets/img/logo-w.svg') ?>" alt="Logo Vinasa">
            </a>
        </div>
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow li-lang <?php echo ($this->session->userdata('langAbbreviation') == 'vi') ? 'active' : '' ?>">
                    <a class="nav-link change-language" data-language="vi" href="javascript:void(0)" href="<?php echo base_url('member/user/login') ?>">
                        Vi
                    </a>
                </li>
                <li class="nav-item dropdown no-arrow li-lang <?php echo ($this->session->userdata('langAbbreviation') == 'en') ? 'active' : '' ?>">
                    <a class="nav-link change-language" data-language="en" href="javascript:void(0)" href="<?php echo base_url('member/user/login') ?>">
                        En
                    </a>
                </li>
            </ul>
        </nav>
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
                <div class="wrapper">
                    <?php if ($this->session->flashdata('auth_message')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6><i class="icon fa fa-warning"></i><?php echo $this->session->flashdata('auth_message'); ?></h6>
                        </div>
                    <?php endif ?>
                    <?php if ($this->session->flashdata('login_message_error')): ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6><i class="icon fa fa-warning"></i><?php echo $this->session->flashdata('login_message_error'); ?></h6>
                        </div>
                    <?php endif ?>

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
                    <?php echo form_submit('submit', $this->lang->line('Login'), 'class="btn btn-primary btn-lg btn-block"'); ?>
                    <?php echo form_close(); ?>
                    <br>
                    <?= $this->lang->line('Forgot Password?') ?> <?= $this->lang->line('Click') ?> <a href="<?php echo base_url('member/user/forgot_password'); ?>"><?= $this->lang->line('here') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var url = window.location.protocol + '//' + window.location.hostname;

    $(".change-language").click(function(){
        $.ajax({
            method: "GET",
            url: "<?php echo base_url(); ?>homepage/change_language",
            data: {
                lang: $(this).data('language')
            },
            async:false,
            success: function(res){
                if(res.message == 'changed'){
                    window.location.reload();
                }
            },
            error: function(){

            }
        });
    });
</script>
