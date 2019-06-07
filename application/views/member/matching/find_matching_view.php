<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->


<div class="container-fluid">
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-3 col-lg-3">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Chọn tiêu chí</h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <?php
                        echo form_open_multipart('', array('class' => 'form-horizontal', 'method' => 'GET'));
                        ?>
                        <div class="row">
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-warning"></i> Alert! <?php echo $this->session->flashdata('error'); ?></h4>
                                </div>
                            <?php endif ?>

                            <div class="form-group col-lg-12">
                                <?php
                                echo form_label('Tiêu chí', 'category_id');
                                echo form_error('category_id[]');
                                ?>
                                <br>
                                <?php if ($events): ?>
                                    <?php foreach ($events as $key => $value): ?>
                                        <?php
                                        echo form_checkbox('category_id[]', $key, in_array($key, $_GET['category_id']), 'class="btn-event" data-key=' . $key);
                                        echo $value['name'] . '<br>';
                                        ?>
                                        <?php if ($value): ?>
                                            <?php foreach ($value as $k => $val): ?>
                                                <?php if ($k != 'name'): ?>
                                                    <div style="display: none; margin-left: 20px" class="slide-service-<?php echo $key ?>">
                                                        <?php
                                                        echo form_checkbox('category_id[]', $k, in_array($key, $_GET['category_id']), 'class="btn-service"');
                                                        echo $val . '<br>';
                                                        ?>
                                                    </div>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>

                            <br>
                            <div class="form-group col-sm-12 text-left" style="padding-left: 0 !important;">
                                <div class="pull-right">
                                    <?php
                                    echo form_submit('submit', 'OK', 'class="btn btn-primary"');
                                    ?>
                                </div>

                            </div>
                        </div>
                        <div class="form-group col-sm-12 text-right">
                            <?php
                            echo form_close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-9 col-lg-9">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách</h6>
                    <div class="dropdown no-arrow">
                        <a title="Xem toàn bộ" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-arrow-alt-circle-right text-primary"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="text-align: center">STT</th>
                                <th style="text-align: center">Doanh nghiệp</th>
                                <th style="text-align: center">Người đại diện</th>
                                <th style="text-align: center">Chức danh</th>
                                <th style="text-align: center">Địa chỉ</th>
                                <!-- <th style="text-align: center">Số điện thoại</th> -->
                                <th style="text-align: center">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($matched_setting)){
                                foreach($matched_setting as $key => $item) {
                            ?>
                                <tr id="<?= $item['id'] ?>">
                                    <td style="text-align: center"><?php echo $key + 1; ?></td>
                                    <td class="reg-client-company"><?php echo $item['register_info']['company']; ?></td>
                                    <td><?php echo $item['register_info']['connector']; ?></td>
                                    <td><?php echo $item['register_info']['position']; ?></td>
                                    <td><?php echo $item['register_info']['address']; ?></td>
                                    <!-- <td><?php //echo $item['register_info']['phone']; ?></td> -->
                                    <td style="text-align: center">
                                        <a title="Gửi yêu cầu" class="btn-reg-client"
                                           href="<?php echo base_url('member/matching/create?target=' . $item['register_info']['id'] . '&event=' . $item['register_info']['event_id']) ?>"
                                        >
                                            <i class="fa fa-calendar-check" aria-hidden="true"></i>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="javascript:void(0)"
                                            class="btn-reg-info" 
                                            data-id="<?php echo $item['register_info']['id'] ?>" 
                                            title="Xem thông tin"
                                        >
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="chart-area pt-4 pb-2">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Main Content -->
</div>

<div class="modal fade" id="btn-reg-info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông Tin Doanh Nghiệp: <strong id="title-info" style="color: #4e73df"></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="company">Công Ty: </label>
                    <input type="text" class="form-control" name="company" id="company" disabled >
                </div>
                <div class="form-group">
                    <label for="connector">Người Đại Diện: </label>
                    <input type="text" class="form-control" name="connector" id="connector" disabled >
                </div>
                <div class="form-group">
                    <label for="position">Chức Danh: </label>
                    <input type="text" class="form-control" name="position" id="position" disabled >
                </div>
                <div class="form-group">
                    <label for="address">Địa Chỉ: </label>
                    <input type="text" class="form-control" name="address" id="address" disabled >
                </div>
                <div class="form-group">
                    <label for="overview">Tổng Quát Công Nghệ: </label>
                    <textarea class="form-control" name="overview" id="overview" rows="3" disabled></textarea>
                </div>
                <div class="form-group">
                    <label for="profile">Hồ sơ doanh nghiệp: </label>
                    <textarea class="form-control" name="profile" id="profile" rows="10" disabled></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <a type="" class="btn btn-primary" id="file-pdf" download><i class="fas fa-file-download"></i> Tải File PDF</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.btn-event').click(function(){
        key = $(this).data('key');
        if($(this).prop("checked") == true){
            $('.slide-service-' + key).slideDown();
        }else{
            $('.slide-service-' + key).slideUp();
        }
    });
    $('.btn-event').each(function(){
        key = $(this).data('key');
        if($(this).prop("checked") == true){
            $('.slide-service-' + key).slideDown();
        }else{
            $('.slide-service-' + key).slideUp();
        }
    });

    $('.btn-reg-info').click(function(){
        id = $(this).data('id');
        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('member/matching/get_info') ?>',
            data: {
                id: id,
            },
            success: function(res){
                result = JSON.parse(res);
                if (result.status == true) {
                    $('#btn-reg-info-modal').modal('show');
                    $('#title-info').text(result.info.company);
                    $('#company').val(result.info.company);
                    $('#connector').val(result.info.connector);
                    $('#position').val(result.info.position);
                    $('#address').val(result.info.address);
                    $('#overview').val(result.info.overview);
                    $('#profile').val(result.info.profile);
                    $('#file-pdf').attr('href', '<?php echo base_url('assets/upload/profile/') ?>' + result.info.file);
                }else{
                    alert('Doanh nghiệp không tồn tại hoặc đã hủy tham gia sự kiện');
                }
            }
        });
    });
</script>
