<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"  href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('assets/scss/style.css') ?>">

    <title>Member Register</title>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo site_url('assets/vendor/jquery/jquery.min.js'); ?>" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="<?php echo site_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
</head>
<body>
    <div id="member-register">
        <header>
            <div class="nav-logo">
                <a href="<?php echo base_url('')?>">
                    <img src="<?php echo site_url('assets/img/logo.png') ?>" alt="Logo Vinasa">
                </a>
            </div>
        </header>

        <div class="cover-background" style="background-image: url('https://images.unsplash.com/photo-1517502884422-41eaead166d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1525&q=80">
            <div class="gradient"></div>

            <div class="content">
                <div class="left">
                    <h6>Matching Platform</h6>
                    <h3>Be the Best for your business and client</h3>

                    <p>Lots of benifits waiting for you when you become on of our partners.</p>
                </div>

                <div class="right">
                    <div class="wrapper">
                        <?php echo $this->session->flashdata('message'); ?>
                        <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                        <div class="row">
                            <div class="form-group col-xs-12 col-lg-12">
                                <?php echo form_label('Tên Công Ty: ', 'company'); ?>
                                <?php echo form_error('company'); ?>
                                <?php echo form_input('company', set_value('company'), 'class="form-control"'); ?>
                            </div>
                            <div class="form-group col-xs-12 col-lg-12">
                                <?php echo form_label('Người Đại Diện: ', 'connector'); ?>
                                <?php echo form_error('connector'); ?>
                                <?php echo form_input('connector', set_value('connector'), 'class="form-control"'); ?>
                            </div>
                            <div class="form-group col-xs-12 col-lg-6">
                                <?php echo form_label('Chức Danh: ', 'position'); ?>
                                <?php echo form_error('position'); ?>
                                <?php echo form_input('position', set_value('position'), 'class="form-control"'); ?>
                            </div>
                            <div class="form-group col-xs-12 col-lg-6">
                                <?php echo form_label('Điện Thoại: ', 'phone'); ?>
                                <?php echo form_error('phone'); ?>
                                <?php echo form_input('phone', set_value('phone'), 'class="form-control"'); ?>
                            </div>
                            <div class="form-group col-xs-12 col-lg-12">
                                <?php echo form_label('Địa Chỉ: ', 'address'); ?>
                                <?php echo form_error('address'); ?>
                                <?php echo form_input('address', set_value('address'), 'class="form-control"'); ?>
                            </div>
                            <div class="form-group col-xs-12 col-lg-12">
                                <?php echo form_label('Email: ', 'email'); ?>
                                <?php echo form_error('email'); ?>
                                <?php echo form_input('email', set_value('email'), 'class="form-control"'); ?>
                            </div>
                            <div class="form-group col-xs-12 col-lg-12">
                                <?php
                                echo form_label('Sự Kiện', 'event_id');
                                echo form_error('event_id', '<div class="error">', '</div>');
                                echo form_dropdown('event_id', $events, '', 'class="form-control" id="event_id"');
                                ?>
                            </div>
                        </div>
                        <?php echo form_submit('submit', 'Đăng Ký', 'class="btn btn-primary btn-lg btn-block"'); ?>
                        <?php echo form_close(); ?>
                    </div>

                    <p>All your information is private with us</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>