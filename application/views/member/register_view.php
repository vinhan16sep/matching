<div class="content-wrapper" style="min-height: 916px;">
    <section class="content row">
        <div>
            <div class="col-lg-4 col-lg-offset-4">
                <h1>Login</h1>
                <?php echo $this->session->flashdata('message'); ?>
                <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <?php echo form_label('Tên Công Ty: ', 'company'); ?>
                    <?php echo form_error('company'); ?>
                    <?php echo form_input('company', set_value('company'), 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Người Đại Diện: ', 'connector'); ?>
                    <?php echo form_error('connector'); ?>
                    <?php echo form_input('connector', set_value('connector'), 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Chức Danh: ', 'position'); ?>
                    <?php echo form_error('position'); ?>
                    <?php echo form_input('position', set_value('position'), 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Điện Thoại: ', 'phone'); ?>
                    <?php echo form_error('phone'); ?>
                    <?php echo form_input('phone', set_value('phone'), 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Địa Chỉ: ', 'address'); ?>
                    <?php echo form_error('address'); ?>
                    <?php echo form_input('address', set_value('address'), 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Email: ', 'email'); ?>
                    <?php echo form_error('email'); ?>
                    <?php echo form_input('email', set_value('email'), 'class="form-control"'); ?>
                </div>
                <?php echo form_submit('submit', 'Đăng Ký', 'class="btn btn-primary btn-lg btn-block"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>