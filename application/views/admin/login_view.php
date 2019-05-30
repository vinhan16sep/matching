<div class="container-fluid" id="login">
    <div class="row no-gutters signin">
        <div class="left col-xs-12 col-lg-6">
            <div class="background"></div>

            <div class="logo">
                <a href="<?php echo base_url('admin/user/login/')?>">
                    <img src="<?php echo site_url('assets/img/logo.png') ?>" alt="Logo Vinasa">
                </a>
            </div>

            <div class="text" id="textWelcome">
                <h3>
                    Sign in to access your big data
                </h3>
            </div>
        </div>

        <div class="right col-xs-12 col-lg-6">
            <div class="content">
                <h6 class="subtitle-sm">
                    Please enter your username and password below
                </h6>

                <?php echo $this->session->flashdata('message'); ?>
                <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <?php echo form_label('Tài khoản', 'identity'); ?>
                        <?php echo form_error('identity'); ?>
                        <?php echo form_input('identity', '', 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Mật khẩu', 'password'); ?>
                        <?php echo form_error('password'); ?>
                        <?php echo form_password('password', '', 'class="form-control"'); ?>
                    </div>
                    <div class="form-group submit">
                        <?php echo form_submit('submit', 'Đăng nhập', 'class="btn btn-primary btn-lg btn-block"'); ?>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>