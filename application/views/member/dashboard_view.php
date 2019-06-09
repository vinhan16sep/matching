<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
        $log = array(
            1 => 'Đối tác đồng ý',
            2 => 'Đối tác từ chối',
            3 => 'Từ chối do cuộc hẹn khác'
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
                                            <td style="text-align: center"><?php echo $item['register_info']['connector']; ?></td>
                                            <td style="text-align: center"><?php echo $item['register_info']['position']; ?></td>
                                            <td style="text-align: center">
                                                <?php if($item['status'] == 0){ ?>
                                                    <button title="Đang chờ được xử lý" class="btnApprove"
                                                       href="javascript:void(0);" data-toggle="modal" data-target="#myModal" data-id="<?php echo $item['id']; ?>"
                                                    >
                                                        <i class="fa fa-clock" aria-hidden="true"></i>
                                                    </button>
                                                <?php }else if($item['status'] == 1){ ?>
                                                    <i class="fa fa-handshake" aria-hidden="true" style="color: #4e73df"></i>
                                                <?php }else{ ?>
                                                    <i class="fa fa-ban" aria-hidden="true" style="color: red"></i>
                                                <?php } ?>
                                            </td>
                                            <td style=""><?php echo isset($log[$item['log']]) ? $log[$item['log']] : ''; ?></td>
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
                                            <td style=""><?php echo isset($log[$item['log']]) ? $log[$item['log']] : ''; ?></td>
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
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Bạn hãy chắc chắn, nếu bạn đồng ý, tất cả những yêu cầu khác trùng lịch với yêu cầu này sẽ chuyển về trạng thái Từ chối.</p>
                <input type="hidden" id="hiddenId" name="hiddenId">
                <a title="Đồng ý" class="btn btn-primary workflow" href="#" style="width: 45%" data-status="1">
                    <i class="fa fa-handshake" aria-hidden="true"></i>
                    &nbsp;&nbsp;Đồng ý
                </a>
                <a title="Từ chối" class="btn btn-danger workflow" href="#" style="width: 45%" data-status="2">
                    <i class="fa fa-ban" aria-hidden="true"></i>
                    &nbsp;&nbsp;Từ chối
                </a>
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
                $('.modal-body').append('<button class="btn btn-secondary"><i class="fas fa-spinner fa-spin"></i> Đang xử lý ...</button');
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
</script>
<!-- /.container-fluid -->


