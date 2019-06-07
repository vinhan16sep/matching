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
                    

                    <div class="card">
                        <div class="card-header">
                            <h2>Tổng quan về doanh nghiệp</h2>
                        </div>
                        <?php if ($temp_register['is_overview'] == 0): ?>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Chưa lưu thông tin</strong>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('member/overview/create') ?>" title="Lưu thông tin doanh nghiệp"><i class="fas fa-plus-square"></i></a>
                                </li>
                            </ul>
                        <?php else: ?>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Tổng quát công nghệ sử dụng: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['overview'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Hồ sơ doanh nghiệp (Tóm tắt lĩnh vự hoạt động): </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['profile'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>File PDF: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url('assets/upload/profile/') . $temp_register['file'] ?>" download> Tải về</a> 
                                </li>
                            </ul>
                        <br>
                        <div class="form-group">
                            <a href="<?php echo base_url('member/overview/create') ?>" name="back" class="btn btn-primary btn-block">Cập nhật thông tin</a>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>