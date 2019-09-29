
<div class="container-fluid" id="matching_create">
    <div class="row">
        <div class="left col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $this->lang->line('Company | Organization Information') ?></h6>
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <h6 class="subtitle-sm"><i class="fas fa-building"></i> <?= $this->lang->line('Company') ?></h6>
                            <h6><?php echo $result['company'] ?></h6>
                        </li>
                        <li class="list-group-item">
                            <h6 class="subtitle-sm"><i class="fas fa-user-tie"></i> <?= $this->lang->line('Legal Representative') ?></h6>
                            <h6><?php echo $result['connector'] ?></h6>
                        </li>
                        <li class="list-group-item">
                            <h6 class="subtitle-sm"><i class="fas fa-map-marked-alt"></i> <?= $this->lang->line('Address') ?></h6>
                            <h6><?php echo ($this->session->userdata('langAbbreviation') == 'vi') ? $result['address'] : $result['address_en'] ?></h6>
                        </li>
                        <li class="list-group-item">
                            <h6 class="subtitle-sm"><i class="fas fa-phone"></i> <?= $this->lang->line('Mobile') ?></h6>
                            <h6><?php echo $result['phone'] ?></h6>
                        </li>
                        <li class="list-group-item">
                            <h6 class="subtitle-sm"><i class="fas fa-globe"></i> Website</h6>
                            <h6><?php echo $result['website'] ?></h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="right col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $this->lang->line('Meeting Request') ?></h6>
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
                                echo form_label($this->lang->line('Time'), 'date');
                                echo form_error('date');
                                echo form_input('date', set_value('date'), 'class="form-control datepicker" id="datetimepicker" readonly');
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                echo form_label($this->lang->line('Note'), 'note');
                                echo form_error('note');
                                echo form_textarea('note', set_value('name'), 'class="form-control" id="note"');
                                ?>
                            </div>
                            <br>
                            <div class="form-group col-sm-12 text-left" style="padding-left: 0 !important;">
                                <?php
                                echo form_submit('submit', $this->lang->line('Send'), 'class="btn btn-primary" id="btnSend"');
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

