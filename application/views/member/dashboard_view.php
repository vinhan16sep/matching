<!-- Begin Page Content -->

<div class="container-fluid" id="dashboard-member">
    <?php
        $send_log = array(
            1 => 'Đối tác đồng ý',
            2 => 'Đối tác từ chối',
            3 => 'Hủy do cuộc hẹn khác'
        );

        $receive_log = array(
            1 => 'Đã đồng ý',
            2 => 'Đã từ chối',
            3 => 'Hủy do cuộc hẹn khác'
        );
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!--    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thư mời đã nhận</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="padding: 0 !important;">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="text-align: center">STT</th>
                                    <th style="text-align: center">Thời gian</th>
                                    <th style="text-align: center">DN</th>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: center">Đại diện</th>
                                    <th style="text-align: center">Chức danh</th>
                                    <th style="text-align: center">Trạng thái</th>
                                    <th style="text-align: center">Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($receive)){
                                    foreach($receive as $key => $item) {
                                        ?>
                                        <tr id="<?= $item['id'] ?>">
                                            <td style="text-align: center"><?php echo $key + 1; ?></td>
                                            <td style="text-align: center"><?php echo date('H:i d/m/Y', $item['date']); ?></td>
                                            <td style="text-align: center" class="reg-client-company"><?php echo $item['register_info']['company']; ?></td>
                                            <td style="text-align: center" class="reg-client-company">
                                                <a href="javascript:void(0)"
                                                   class="btn-reg-info"
                                                   data-id="<?php echo $item['register_info']['id'] ?>"
                                                   title="Xem thông tin"
                                                >
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
                                            <td style="text-align: center"><?php echo $item['register_info']['connector']; ?></td>
                                            <td style="text-align: center"><?php echo $item['register_info']['position']; ?></td>
                                            <td style="text-align: center">
                                                <?php if($item['status'] == 0){ ?>
                                                    <button title="Đang chờ được xử lý" class="btnApprove"
                                                       href="javascript:void(0);" data-toggle="modal" data-target="#workflowModal" data-backdrop="static" data-keyboard="false" data-id="<?php echo $item['id']; ?>"
                                                    >
                                                        <i class="fa fa-clock" aria-hidden="true"></i>
                                                    </button>
                                                <?php }else if($item['status'] == 1){ ?>
                                                    <i class="fa fa-handshake" aria-hidden="true" style="color: #4e73df"></i>
                                                <?php }else{ ?>
                                                    <i class="fa fa-ban" aria-hidden="true" style="color: red"></i>
                                                <?php } ?>
                                            </td>
                                            <td style=""><?php echo isset($receive_log[$item['log']]) ? $receive_log[$item['log']] : ''; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thư mời đã gửi</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="padding: 0 !important;">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="text-align: center">STT</th>
                                    <th style="text-align: center">Thời gian</th>
                                    <th style="text-align: center">DN</th>
                                    <th style="text-align: center"></th>
                                    <th style="text-align: center">Đại diện</th>
                                    <th style="text-align: center">Chức danh</th>
                                    <th style="text-align: center">Trạng thái</th>
                                    <th style="text-align: center">Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($send)){
                                    foreach($send as $key => $item) {
                                        ?>
                                        <tr id="<?= $item['id'] ?>">
                                            <td style="text-align: center"><?php echo $key + 1; ?></td>
                                            <td style="text-align: center"><?php echo date('H:i d/m/Y', $item['date']); ?></td>
                                            <td style="text-align: center" class="reg-client-company"><?php echo $item['register_info']['company']; ?></td>
                                            <td style="text-align: center" class="reg-client-company">
                                                <a href="javascript:void(0)"
                                                   class="btn-reg-info"
                                                   data-id="<?php echo $item['register_info']['id'] ?>"
                                                   title="Xem thông tin"
                                                >
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
                                            <td style="text-align: center"><?php echo $item['register_info']['connector']; ?></td>
                                            <td style="text-align: center"><?php echo $item['register_info']['position']; ?></td>
                                            <td style="text-align: center">
                                                <?php if($item['status'] == 0){ ?>
                                                    <i class="fa fa-clock" aria-hidden="true"></i>
                                                <?php }else if($item['status'] == 1){ ?>
                                                    <i class="fa fa-handshake" aria-hidden="true" style="color: #4e73df"></i>
                                                <?php }else{ ?>
                                                    <i class="fa fa-ban" aria-hidden="true" style="color: red"></i>
                                                <?php } ?>
                                            </td>
                                            <td style=""><?php echo isset($send_log[$item['log']]) ? $send_log[$item['log']] : ''; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="workflowModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <p>Bạn hãy chắc chắn, nếu bạn đồng ý, tất cả những yêu cầu khác trùng lịch với yêu cầu này sẽ chuyển về trạng thái Từ chối.</p>
                    <input type="hidden" id="hiddenId" name="hiddenId">

                    <div class="buttons">
                        <a title="Đồng ý" class="btn btn-primary workflow" href="#" data-status="1">
                            <i class="fa fa-handshake" aria-hidden="true"></i>
                            &nbsp;&nbsp;Đồng ý
                        </a>
                        <a title="Từ chối" class="btn btn-danger workflow" href="#" data-status="2">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                            &nbsp;&nbsp;Từ chối
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Main Content -->

    <div class="popup" id="companyInfo">
        <div class="popup-content">
            <div class="popup-header">
                <h6>
                    Thông Tin Doanh Nghiệp: <strong id="title-info"></strong>
                </h6>

                <button type="button" class="popup-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="popup-body">
                <ul class="nav nav-tabs" id="companyInfomation" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#infoTab" role="tab" aria-controls="info" aria-selected="true">Thông Tin Doanh Nghiệp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="overview-tab" data-toggle="tab" href="#overviewTab" role="tab" aria-controls="overview" aria-selected="false">Tổng Quát</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profileTab" role="tab" aria-controls="profile" aria-selected="false">Hồ sơ doanh nghiệp</a>
                    </li>
                </ul>
                <div class="tab-content" id="companyInfomationContent">
                    <div class="tab-pane fade show active" id="infoTab" role="tabpanel" aria-labelledby="info-tab">
                        <div class="row no-gutters">
                            <div class="left col-xs-12 col-lg-6">
                                <div class="background">
                                    <img src="<?php echo site_url('assets/img/logo.svg') ?>" alt="Logo Company">

                                    <div class="mask-wrapper">
                                        <div class="mask mask-circle">
                                            <img src="<?php echo site_url('assets/img/logo.svg') ?>" alt="Logo Company">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="right col-xs-12 col-lg-6">
                                <div class="wrapper">
                                    <label>Công Ty</label>
                                    <h6 id="company">No data</h6>
                                </div>

                                <div class="wrapper">
                                    <label>Người Đại Diện</label>
                                    <h6 id="connector">No data</h6>
                                </div>

                                <div class="wrapper">
                                    <label>Chức Danh</label>
                                    <h6 id="position">No data</h6>
                                </div>

                                <div class="wrapper">
                                    <label>Địa Chỉ</label>
                                    <h6 id="address">No data</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane tab-text fade" id="overviewTab" role="tabpanel" aria-labelledby="overview-tab">
                        <p id="overview">No data</p>
                    </div>
                    <div class="tab-pane tab-text fade" id="profileTab" role="tabpanel" aria-labelledby="profile-tab">
                        <p id="profile">No data</p>
                    </div>
                </div>
            </div>
            <div class="popup-footer">
                <a type="" class="btn btn-sm btn-primary" id="file-pdf" download><i class="fas fa-file-download"></i> Tải File PDF</a>
                <button type="button" class="btn btn-sm btn-secondary popup-close" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", ".btnApprove", function () {
        var id = $(this).data('id');
        $("#hiddenId").val( id );
    });

    $('.workflow').click(function(){
        $('.workflow').addClass('disabled');
        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('member/matching/workflow') ?>',
            data: {
                id: $('#hiddenId').val(),
                status: $(this).data('status')
            },
            beforeSend: function() {
                $('.workflow').hide();
                $('.modal-body .buttons').append('<button class="btn btn-secondary"><i class="fas fa-spinner fa-spin"></i> Đang xử lý ...</button>');
                $('.modal-body').find('button.close').hide(); //Hide button close Modal when sending data
            },
            success: function(res){
                var result = JSON.parse(res);
                if(result.message == 1){
                    alert('Đã hoàn thành');
                    window.location.reload();
                }else{
                    alert('Không đổi được trạng thái');
                    window.location.reload();
                }
            }
        });
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
                    console.log(result.info);
                    $('.popup').addClass('show');
                    //$('#btn-reg-info-modal').modal('show');
                    $('#title-info').html(result.info.company);
                    $('#company').html(result.info.company);
                    $('#connector').html(result.info.connector);
                    $('#position').html(result.info.position);
                    $('#address').html(result.info.address);
                    $('#overview').html(result.info.overview);
                    $('#profile').html(result.info.profile);
                    $('#file-pdf').attr('href', '<?php echo base_url('assets/upload/profile/') ?>' + result.info.file);
                }else{
                    alert('Doanh nghiệp không tồn tại hoặc đã hủy tham gia sự kiện');
                }

                closePopup(); //Close Popup
            }
        });
    });

    function closePopup(){
        const $btnClose = $('.popup').find('.popup-close');

        $btnClose.on('click', function(){
            $(this).closest('.popup').removeClass('show');
        })
    }
</script>
<!-- /.container-fluid -->


