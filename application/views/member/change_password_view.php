<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <?php if ($this->session->flashdata('auth_message_error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h6><i class="icon fa fa-warning"></i></h6>
                    <?php echo $this->session->flashdata('auth_message_error'); ?>
                </div>
            <?php endif ?>
            <?php echo form_open('', array('class' => 'form-horizontal')); ?>
            <div class="form-group">
                <?php echo form_label('Mật khẩu cũ: ', 'old_password'); ?>
                <?php echo form_error('old_password'); ?>
                <?php echo form_password('old_password', '', 'class="form-control"'); ?>
            </div>
            <div class="form-group">
                <?php echo form_label('Mật khẩu mới (ít nhất 8 ký tự): ', 'new_password'); ?>
                <?php echo form_error('new_password'); ?>
                <?php echo form_password('new_password', '', 'class="form-control"'); ?>
            </div>
            <div class="form-group">
                <?php echo form_label('Xác nhận mật khẩu mới: ', 'new_confirm'); ?>
                <?php echo form_error('new_confirm'); ?>
                <?php echo form_password('new_confirm', '', 'class="form-control"'); ?>
            </div>
            <?php echo form_hidden('user_id', $user_id);?>
            <div class="form-group">
                <?php echo form_submit('submit', 'Đổi Mật Khẩu', 'class="btn btn-primary btn-lg btn-block"'); ?>
                <!-- <a href="javascript:history.back()" name="back" class="btn btn-default btn-lg btn-block">Quay lại</a> -->
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>