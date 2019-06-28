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
                    <a href="<?php echo base_url('member/information/index?edit=1') ?>" class="btn btn-primary">Chỉnh sửa</a>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"  style="min-height: 500px">
                                    <h6>Logo & PDF</h6>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <strong>Logo: </strong><br>
                                                <img src="<?php echo base_url('assets/upload/profile/' . $temp_register['logo']);  ?>" width="100%">
                                        </div>
                                        <div class="col-lg-8">
                                            <strong>File PDF: </strong>
                                            <?php if (!empty($temp_register['file'])): ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url('assets/upload/profile/') . $temp_register['file'] ?>" download> Tải về</a>
                                                <embed src="<?= base_url('assets/upload/profile/' . $temp_register['file']) ?>" style="width:100%; height: 200%" />
                                            <?php else: ?>
                                                &nbsp; Chưa có file
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Tổng quan về doanh nghiệp</h6>
                                </div>
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Tên Doanh Nghiệp: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['company'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Địa Chỉ: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['address'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Website: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $temp_register['website'] ?>" target="_blank"><?php echo $temp_register['website'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Số Nhân lực: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['manpower'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Doanh Thu Năm 2018: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['revenue'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Sản Phẩm/Giải Pháp: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['product'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Lĩnh Vực/Dịch Vụ Hoạt Động: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['profile'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Thị trường chính hiện nay: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['market'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Tên Người Đại Diện Pháp Luật: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['connector'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>E-Mail: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['email'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Điện Thoại: </strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $temp_register['phone'] ?>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <a href="<?php echo base_url('member/event') ?>" class="btn btn-primary" style="float: right;">
                Danh sách sự kiện
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
</div>