<!-- Begin Page Content -->

<div class="container-fluid" id="dashboard-member">
    <?php
    $send_log = array(
        1 => $this->lang->line('Partner accepted'),
        2 => $this->lang->line('Partner rejected'),
        3 => $this->lang->line('Cancel because other event(s) take this time')
    );

    $receive_log = array(
        1 => $this->lang->line('Accepted'),
        2 => $this->lang->line('Rejected'),
        3 => $this->lang->line('Cancel because other event(s) take this time')
    );
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!--    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <a class="btn btn-primary" href="<?php echo base_url('member/matching/find?event_id=' . $event_id) ?>">
                <?= $this->lang->line('Find partner') ?>
            </a>
            <br>
            <br>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $this->lang->line('Received Matching') ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="padding: 0 !important;">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="text-align: center"><?= $this->lang->line('No.') ?></th>
                                    <th style="text-align: center"><?= $this->lang->line('Time') ?></th>
                                    <th style="text-align: center"><?= $this->lang->line('Company') ?></th>
                                    <th style="text-align: center"><?= $this->lang->line('Status') ?></th>
                                    <th style="text-align: center"><?= $this->lang->line('Note') ?></th>
                                    <th style="text-align: center"></th>
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
                                                <a href="javascript:;"
                                                   class="btn-reg-info"
                                                   data-id="<?php echo $item['register_info']['id'] ?>"
                                                   title="<?= $this->lang->line('Show information') ?>"
                                                >
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if($item['status'] == 0){ ?>
                                                    <button title="<?= $this->lang->line('Wait for response') ?>" class="btnApprove"
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
                    <h6 class="m-0 font-weight-bold text-primary"><?= $this->lang->line('Sent Matching') ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="padding: 0 !important;">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="text-align: center"><?= $this->lang->line('No.') ?></th>
                                    <th style="text-align: center"><?= $this->lang->line('Time') ?></th>
                                    <th style="text-align: center"><?= $this->lang->line('Company') ?></th>
                                    <th style="text-align: center"><?= $this->lang->line('Status') ?></th>
                                    <th style="text-align: center"><?= $this->lang->line('Note') ?></th>
                                    <th style="text-align: center"></th>
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
                                                <a href="#"
                                                   class="btn-reg-info"
                                                   data-id="<?php echo $item['register_info']['id'] ?>"
                                                   title="<?= $this->lang->line('Show information') ?>"
                                                >
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </td>
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
                    <div id="waitingApprove">
                        <p><?= $this->lang->line('Please be sure with your choice. If you agree, any requirements at the same time as this requirement will be turned to DENY status') ?></p>
                        <input type="hidden" id="hiddenId" name="hiddenId">

                        <div class="buttons">
                            <a title="Đồng ý" class="btn btn-primary workflow" href="#" data-status="1">
                                <i class="fa fa-handshake" aria-hidden="true"></i>
                                &nbsp;&nbsp;<?= $this->lang->line('Accept') ?>
                            </a>
                            <a title="Từ chối" class="btn btn-danger" id="cancelMatching" href="#">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                                &nbsp;&nbsp;<?= $this->lang->line('Reject') ?>
                            </a>
                        </div>
                    </div>

                    <div id="cancelReason">
                            <p><?= $this->lang->line('Please give us the reason why you find the Enterprise inappropriate?') ?></p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="<?= $this->lang->line('Irrelevant field') ?>" name="reason">
                                <label class="form-check-label" for="defaultCheck1">
                                    <?= $this->lang->line('Irrelevant field') ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="<?= $this->lang->line('Unagreed time schedule') ?>" name="reason">
                                <label class="form-check-label" for="defaultCheck1">
                                    <?= $this->lang->line('Unagreed time schedule') ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="<?= $this->lang->line('No demand for finding any similar partners') ?>" name="reason">
                                <label class="form-check-label" for="defaultCheck1">
                                    <?= $this->lang->line('No demand for finding any similar partners') ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input show-date" type="radio" value="<?= $this->lang->line('Offer a different time') ?>" name="reason">
                                <label class="form-check-label" for="defaultCheck1">
                                    <?= $this->lang->line('Offer a different time') ?>
                                </label>
                            </div>
                            <div class="form-group another-time" style="display: none;">
                                <?php
                                echo form_label($this->lang->line('Time'), 'date');
                                echo form_error('date');
                                echo form_input('date', set_value('date'), 'class="form-control datepicker" id="datetimepicker" readonly');
                                ?>
                            </div>
                            <div class="buttons">
                                <button class="btn btn-primary workflow" id="sendCancelRequest" type="submit" data-status="2" data-node="" disabled>
                                    <?= $this->lang->line('Send') ?>
                                </button>
                                <button class="btn btn-danger" id="cancelCancelRequest" type="button">
                                    <?= $this->lang->line('Cancel') ?>
                                </button>
                            </div>
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
                    <?= $this->lang->line('Company') ?>: <strong id="title-info"></strong>
                </h6>

                <button type="button" class="popup-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="popup-body">
                <ul class="nav nav-tabs" id="companyInfomation" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#infoTab" role="tab" aria-controls="info" aria-selected="true"><?= $this->lang->line('Company | Organization Information') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-tab" data-toggle="tab" href="#productTab" role="tab" aria-controls="product" aria-selected="false"><?= $this->lang->line('Product/Solution') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profileTab" role="tab" aria-controls="profile" aria-selected="false"><?= $this->lang->line('Field of operation') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="market-tab" data-toggle="tab" href="#marketTab" role="tab" aria-controls="market" aria-selected="false"><?= $this->lang->line('Targeted markets') ?></a>
                    </li>
                </ul>
                <div class="tab-content" id="companyInfomationContent">
                    <div class="tab-pane fade show active" id="infoTab" role="tabpanel" aria-labelledby="info-tab">
                        <div class="row no-gutters">
                            <div class="left col-xs-12 col-lg-4">
                                <div class="wrapper">
                                    <label><?= $this->lang->line('Company') ?></label>
                                    <p id="company">No data</p>
                                </div>
                                <div class="wrapper">
                                    <label><?= $this->lang->line('Address') ?></label>
                                    <h6 id="address">No data</h6>
                                </div>
                                <div class="wrapper">
                                    <label><?= $this->lang->line('Legal Representative') ?></label>
                                    <h6 id="connector">No data</h6>
                                </div>
                            </div>

                            <div class="right col-xs-12 col-lg-4">
                                <div class="wrapper">
                                    <label>Website</label>
                                    <h6 id="website">No data</h6>
                                </div>
                                <div class="wrapper">
                                    <label>Email</label>
                                    <h6 id="email">No data</h6>
                                </div>
                                <div class="wrapper">
                                    <label><?= $this->lang->line('Mobile') ?></label>
                                    <h6 id="phone">No data</h6>
                                </div>
                            </div>
                            <div class="right col-xs-12 col-lg-4">
                                <div class="wrapper">
                                    <label><?= $this->lang->line("sonhanluc") ?></label>
                                    <h6 id="manpower">No data</h6>
                                </div>
                                <div class="wrapper">
                                    <label><?= $this->lang->line('doanhthunam') ?> 2018</label>
                                    <h6 id="revenue">No data</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane tab-text fade" id="productTab" role="tabpanel" aria-labelledby="product-tab">
                        <p id="product">No data</p>
                    </div>
                    <div class="tab-pane tab-text fade" id="profileTab" role="tabpanel" aria-labelledby="profile-tab">
                        <p id="profile">No data</p>
                    </div>
                    <div class="tab-pane tab-text fade" id="marketTab" role="tabpanel" aria-labelledby="market-tab">
                        <p id="market">No data</p>
                    </div>
                </div>
            </div>
            <div class="popup-footer">
                <a type="" class="btn btn-sm btn-primary" id="file-pdf" download><i class="fas fa-file-download"></i> <?= $this->lang->line('Download file PDF of company/organization') ?></a>
                <button type="button" class="btn btn-sm btn-secondary popup-close" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", ".btnApprove", function () {
        var id = $(this).data('id');
        $("#hiddenId").val( id );
    });


    reason = '';
    $('.form-check-input').change(function(){
        if ($('.show-date').prop('checked')) {
            $('.another-time').slideDown();
            $('#sendCancelRequest').prop('disabled', true);
        }else{
            $('.another-time').slideUp();
            $('#sendCancelRequest').prop('disabled', false);
        }
        reason = $(this).val();
        
    });
    $('#datetimepicker').change(function(){
        reason = $('.show-date').val() + ': ' + $(this).val();
        if ($(this).val().length > 0) {
            $('#sendCancelRequest').prop('disabled', false);
        }
    });


    $('.workflow').click(function(){
       $('.workflow').addClass('disabled');
       $.ajax({
           method: 'GET',
           url: '<?php echo base_url('member/matching/workflow') ?>//',
           data: {
               id: $('#hiddenId').val(),
               status: $(this).data('status'),
               reason: reason
           },
           beforeSend: function() {
               $('.workflow').hide();
               $('#cancelCancelRequest').hide();
               $('.modal-body .buttons').append('<button class="btn btn-secondary"><i class="fas fa-spinner fa-spin"></i> <?= $this->lang->line('Processing') ?> ...</button>');
               $('.modal-body').find('button.close').hide(); //Hide button close Modal when sending data
           },
           success: function(res){
               var result = JSON.parse(res);
               if(result.message == 1){
                   alert("<?= $this->lang->line('Complete') ?>");
                   window.location.reload();
               }else{
                   alert('Không đổi được trạng thái');
                   window.location.reload();
               }
           }
       });
    });

    $('body').on('click', '#cancelMatching', function(){
        $('#waitingApprove').hide();
        $('#cancelReason').fadeIn();
    });

    $('body').on('click', '#cancelCancelRequest', function(){
        $('#cancelReason').hide();
        $('#waitingApprove').fadeIn();
    });

    $('.btn-reg-info').click(function(e){
        e.preventDefault();
        id = $(this).data('id');
        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('member/matching/get_info') ?>',
            data: {
                id: id,
            },
            success: function(res){
                result = JSON.parse(res);
                console.log(result);

                if (result.status == true) {
                    console.log(result.info.file);
                    $('.popup').addClass('show');
                    //$('#btn-reg-info-modal').modal('show');
                    $('#title-info').html(result.info.company);
                    $('#company').html(result.info.company);
                    $('#website').html(result.info.website);
                    $('#connector').html(result.info.connector);
                    $('#position').html(result.info.position);
                    $('#address').html(result.info.address);
                    $('#file-pdf').attr('href', '<?php echo base_url('assets/upload/profile/') ?>' + result.info.file);

                    $('#email').html(result.info.email);
                    $('#phone').html(result.info.phone);

                    $('#manpower').html(result.info.manpower);
                    $('#revenue').html(result.info.revenue);

                    $('#product').html(result.info.product);
                    $('#profile').html(result.info.profile);
                    $('#market').html(result.info.market);

                    if(result.info.file === null){
                        $('#file-pdf').hide();
                    }
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

    var eventDate = '<?php echo date('Y/m/d', $event['date']); ?>';
    var eventDateFormat = '<?php echo date('d-m-Y', $event['date']); ?>';
    var time = <?php echo json_encode($time_range); ?>;

    $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'd-m-Y H:i',
            allowDates : eventDate,
            allowTimes: time,
            validateOnBlur: true,
            defaultDate: eventDateFormat
        });
    });
</script>
<!-- /.container-fluid -->


