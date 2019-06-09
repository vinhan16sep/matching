
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin đối tác</h6>
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Doanh nghiệp </a> <p class="pull-right"><?php echo $result['company'] ?></p>
                        </li>
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Người đại diện </a> <p class="pull-right"><?php echo $result['connector'] ?></p>
                        </li>
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Chức danh	</a> <p class="pull-right"><?php echo $result['position'] ?></p>
                        </li>
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Địa chỉ </a> <p class="pull-right"><?php echo $result['address'] ?></p>
                        </li>
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Số điện thoại </a> <p class="pull-right"><?php echo $result['phone'] ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Yêu cầu gặp</h6>
                </div>
                <div class="card-body">
                    <p><span style="color: red">Chú ý: </span>nếu bạn đặt nhiều hơn một cuộc hẹn với cùng một khung giờ,
                        và một cuộc hẹn được đối tác chấp nhận, các cuộc hẹn cùng giờ khác của bạn sẽ được chuyển về trạng thái Từ chối. </p>
                    <p>Các đơn mời hẹn bạn nhận được từ đối tác khác, khi trùng khung giờ này cũng sẽ được chuyển sang trạng thái Từ chối.</p>
                    <hr>
                    <div class="row">
                        <div class='col-sm-12'>
                        <?php
                        echo form_open_multipart(site_url('member/matching/create?target=' . $target_id . '&event=' . $event_id), array('class' => 'form-horizontal'));
                        ?>
                            <div class="form-group">
                                <?php
                                echo form_label('Thời gian', 'date');
                                echo form_error('date');
                                echo form_input('date', set_value('date'), 'class="form-control datepicker" id="datetimepicker" readonly');
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_label('Ghi chú', 'note');
                                echo form_error('note');
                                echo form_textarea('note', set_value('name'), 'class="form-control" id="note"');
                                ?>
                            </div>
                            <br>
                            <div class="form-group col-sm-12 text-left" style="padding-left: 0 !important;">
                                <?php
                                echo form_submit('submit', 'Gửi', 'class="btn btn-primary" id="btnSend"');
                                ?>
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
    </div>

    <!-- End of Main Content -->
</div>


<?php
    $event_date = date('Y/m/d', $event['date']);
    $event_date_reformat = date('d-m-Y', $event['date']);
    $date = json_encode($time_range);
?>
<script type="text/javascript">
    $('#btnSend').click(function(){
        if($('#datetimepicker').val() == '' || $('#note').val() == ''){
            return false;
        }
    });


    var eventDate = '<?php echo $event_date; ?>';
    var eventDateFormat = '<?php echo $event_date_reformat; ?>';
    var time = <?php echo json_encode($time_range); ?>;

    console.log(time);
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

