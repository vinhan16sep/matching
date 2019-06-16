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
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($this->session->flashdata('message_error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Thông báo!</h4>
                            <?php echo $this->session->flashdata('message_error'); ?>
                        </div>
                    <?php endif ?>
                    <?php
                        function build_textarea($name, $value = ''){
                            return array(
                                'name' => $name,
                                'class' => 'form-control',
                                'rows' => '4',
                                'cols' => '40',
                                'value'=> $value
                            );
                        }
                    ?>
                    <?php echo form_open_multipart(base_url('member/overview/manage?event_id=' . $event_id), array('class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <?php echo form_label('Giới thiệu ngắn về Doanh nghiệp: ', 'overview'); ?>
                        <?php echo form_error('overview', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea(build_textarea('overview')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Lĩnh vực hoạt động: ', 'profile'); ?>
                        <?php echo form_error('profile', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea(build_textarea('profile')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Sản phẩm/Giải pháp: ', 'product'); ?>
                        <?php echo form_error('product', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea(build_textarea('product')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Thị trường chính hiện nay: ', 'market'); ?>
                        <?php echo form_error('market', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea(build_textarea('market')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Đối tác chiến lược: ', 'partner'); ?>
                        <?php echo form_error('partner', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea(build_textarea('partner')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Khách hàng tiêu biểu: ', 'customer'); ?>
                        <?php echo form_error('customer', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea(build_textarea('customer')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Các chứng chỉ, bằng cấp đạt được (ISO, CMMI...): ', 'certificate'); ?>
                        <?php echo form_error('certificate', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea(build_textarea('certificate')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Mong muốn hợp tác: ', 'desire'); ?>
                        <?php echo form_error('desire', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea(build_textarea('desire')); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Website: ', 'website'); ?>
                        <?php echo form_error('website', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('website', '', 'class="form-control"'); ?>
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
    </div>
</div>