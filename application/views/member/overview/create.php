<style type="text/css">
    .error{
        color: red;
        position: relative;
        line-height: 1;
        width: 12.5rem;
        font-size: 1rem !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($this->session->flashdata('message_error')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Thông báo!</h4>
                    <?php echo $this->session->flashdata('message_error'); ?>
                </div>
            <?php endif ?>
            <h6 style="text-align: center;">Tổng quan về doanh nghiệp</h6>
            <?php echo form_open_multipart('', array('class' => 'form-horizontal')); ?>
            <div class="form-group">
                <?php echo form_label('Tổng quát công nghệ sử dụng: ', 'overview'); ?>
                <?php echo form_error('overview', '<div class="error">', '</div>'); ?>
                <?php echo form_textarea('overview', '', 'class="form-control"'); ?>
            </div>
            <div class="form-group">
                <?php echo form_label('Hồ sơ doanh nghiệp (Tóm tắt lĩnh vự hoạt động): ', 'profile'); ?>
                <?php echo form_error('profile', '<div class="error">', '</div>'); ?>
                <?php echo form_textarea('profile', '', 'class="form-control"'); ?>
            </div>
            <div class="form-group">
                <?php echo form_label('File PDF: ', 'file'); ?>
                <?php echo form_error('file', '<div class="error">', '</div>'); ?>
                <?php echo form_upload('file', '', 'class=""'); ?>
            </div>
            <div class="form-group">
                <?php echo form_submit('submit', 'Lưu Thông Tin', 'class="btn btn-primary"'); ?>
                <!-- <a href="javascript:history.back()" name="back" class="btn btn-default btn-lg btn-block">Quay lại</a> -->
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>