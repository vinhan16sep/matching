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
                            <h6>Thông tin chung về doanh nghiệp</h6>
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
                                    <strong>Giới thiệu ngắn về Doanh nghiệp: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['overview'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Lĩnh vực hoạt động: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['profile'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Sản phẩm/Giải pháp: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['product'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Thị trường chính hiện nay: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['market'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Đối tác chiến lược: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['partner'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Khách hàng tiêu biểu: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['customer'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Các chứng chỉ, bằng cấp đạt được (ISO, CMMI...): </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['certificate'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Mong muốn hợp tác: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['desire'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Website: </strong><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['website'] ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>File PDF: </strong>
                                        <?php if(!empty($temp_register['file'])){ ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url('assets/upload/profile/') . $temp_register['file'] ?>" download> Tải về</a>
                                        <?php } else { ?>
                                        &nbsp; Chưa có file
                                        <?php } ?>
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