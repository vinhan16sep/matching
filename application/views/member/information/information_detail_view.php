<style type="text/css">
    .error{
        color: red;
        position: relative;
        line-height: 1;
        width: 100%;
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
                    <?php if ($this->session->flashdata('message_success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-success"></i> Thông báo!</h4>
                            <?php echo $this->session->flashdata('message_success'); ?>
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
                    
                    <?php echo form_open_multipart('', array('class' => 'form-horizontal')); ?>
                    
                    <div class="form-group">
                        <?php echo form_label('Logo: ', 'logo'); ?><br>
                        <?php if (isset($temp) && !empty($temp['logo'])): ?>
                            <img src="<?= base_url('assets/upload/profile/' . $temp['logo']) ?>" width="30%">
                            <br>
                        <?php endif ?>
                        <?php echo form_error('logo', '<div class="error">', '</div>'); ?><br>
                        <?php echo form_upload('logo', '', 'class=""'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Tên Doanh Nghiệp: ', 'company'); ?>
                        <?php echo form_error('company', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('company', $company, 'class="form-control" readonly'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Địa Chỉ: ', 'address'); ?>
                        <?php echo form_error('address', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('address', (isset($temp) && !empty($temp['address']))? $temp['address'] : set_value('address'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Tên Người Đại Diện Pháp Luật: ', 'connector'); ?>
                        <?php echo form_error('connector', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('connector', (isset($temp) && !empty($temp['connector']))? $temp['connector'] : set_value('connector'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('E-Mail: ', 'email'); ?>
                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('email', (isset($temp) && !empty($temp['email']))? $temp['email'] : set_value('email'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Điện Thoại: ', 'phone'); ?>
                        <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('phone', (isset($temp) && !empty($temp['phone']))? $temp['phone'] : set_value('phone'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Website: ', 'website'); ?>
                        <?php echo form_error('website', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('website', (isset($temp) && !empty($temp['website']))? $temp['website'] : set_value('website'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Số Nhân lực: ', 'manpower'); ?>
                        <?php echo form_error('manpower', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('manpower', (isset($temp) && !empty($temp['manpower']))? $temp['manpower'] : set_value('manpower'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Doanh Thu Năm ' . (date("Y") - 1) . ':' , 'revenue'); ?>
                        <?php echo form_error('revenue', '<div class="error">', '</div>'); ?>
                        <?php echo form_input('revenue', (isset($temp) && !empty($temp['revenue']))? $temp['revenue'] : set_value('revenue'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Sản Phẩm/Giải Pháp: ', 'product'); ?>
                        <?php echo form_error('product', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea('product', (isset($temp) && !empty($temp['product']))? $temp['product'] : set_value('product'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Lĩnh Vực/Dịch Vụ Hoạt Động: ', 'profile'); ?>
                        <?php echo form_error('profile', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea('profile', (isset($temp) && !empty($temp['profile']))? $temp['profile'] : set_value('profile'), 'class="form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Thị trường chính hiện nay: ', 'market'); ?>
                        <?php echo form_error('market', '<div class="error">', '</div>'); ?>
                        <?php echo form_textarea('market', (isset($temp) && !empty($temp['market']))? $temp['market'] : set_value('market'), 'class="form-control"'); ?>
                    </div>
                    
                    <div class="form-group">
                        <?php echo form_label('File PDF: ', 'file'); ?><br>
                        <?php if (isset($temp) && !empty($temp['file'])): ?>
                            <embed src="<?= base_url('assets/upload/profile/' . $temp['file']) ?>" width="30%" />
                            <br>
                        <?php endif ?>
                        <?php echo form_error('file', '<div class="error">', '</div>'); ?><br>
                        <?php echo form_upload('file', '', 'class=""'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_submit('submit', 'Lưu Thông Tin', 'class="btn btn-success" style="float: right"'); ?>
                        <?php if ($this->uri->segment(3) != 'edit'): ?>
                            <?php echo form_submit('submit', 'Lưu Tạm', 'class="btn btn-primary"'); ?>
                        <?php endif ?>
                        <!-- <a href="javascript:history.back()" name="back" class="btn btn-default btn-lg btn-block">Quay lại</a> -->
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>