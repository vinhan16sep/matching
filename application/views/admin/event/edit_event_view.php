<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper -->
<style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: 300px; /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4"  style="height: calc(100% + 300px);">
                <div class="card-body">
                    <?php
                    echo form_open_multipart('', array('class' => 'form-horizontal'));
                    ?>

                    <div class="row">
                        <div class="column" style="height:450px;">
                            <div class="form-group" style="padding-left: 20px;">
                                <?php
                                echo form_label('Tên sự kiện', 'name');
                                echo form_error('name');
                                echo form_input('name', set_value('name', $detail['name']), 'class="form-control" id="name"');
                                ?>
                            </div>
                            <br>
                            <div class="form-group col-sm-12 text-left" style="padding-left: 20px !important;">
                                <?php
                                echo form_submit('submit', 'Hoàn thành', 'class="btn btn-primary"');
                                ?>
                                <a class="btn btn-default cancel" href="javascript:window.history.go(-1);">Quay lại</a>
                            </div>
                        </div>
                        <div class="column" style="height:450px;">
                            <div class="form-group" style="padding-right: 20px;">
                                <?php
                                echo form_label('Ngày sự kiện', 'date');
                                echo form_error('date');
                                echo form_input('date', set_value('date', date('d/m/Y', $detail['date'])), 'class="form-control datepicker" id="date" readonly');
                                ?>
                            </div>
                            <div class="form-group" style="padding-right: 20px;">
                                <?php
                                echo form_label('Địa điểm diễn ra sự kiện', 'place');
                                echo form_error('place');
                                echo form_input('place', set_value('place', $detail['place']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="form-group" style="padding-right: 20px;">
                                <?php
                                echo form_label('Địa điểm diễn ra sự kiện Tiếng Anh', 'place_en');
                                echo form_error('place_en');
                                echo form_input('place_en', set_value('place_en', $detail['place_en']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="form-group" style="padding-right: 20px;">
                                <?php
                                echo form_label('Website', 'person');
                                echo form_error('person');
                                echo form_input('person', set_value('person', $detail['person']), 'class="form-control"');
                                ?>
                            </div>
                            <div class="form-group" style="padding-right: 20px;">
                                <?php
                                echo form_label('Thời gian bắt đầu', 'start');
                                ?>
                                <br>
                                <?php
                                echo form_label('Định dạng mẫu: 08:00 hoặc 12:30 hoặc 16:10 ...', 'start');
                                echo form_error('start');
                                echo form_input('start', set_value('start', $detail['start']), 'class="form-control" id="start"');
                                ?>
                            </div>
                            <div class="form-group" style="padding-right: 20px;">
                                <?php
                                echo form_label('Thời lượng sự kiện', 'duration');
                                ?>
                                <br>
                                <?php
                                echo form_label('Đơn vị: giờ (tiếng), định dạng mẫu: số nguyên 1 đến 24', 'duration');
                                echo form_error('duration');
                                $duration = array(
                                    'name' => 'duration',
                                    'id'   => 'duration',
                                    'class'=> 'form-control',
                                    'type' => 'number',
                                    'min' => 1,
                                    'max' => 24,
                                    'value' => $detail['duration']
                                );
                                echo form_input($duration);
                                ?>
                            </div>
                            <div class="form-group" style="padding-right: 20px;">
                                <?php
                                echo form_label('Thời lượng mỗi cuộc gặp', 'step');
                                ?>
                                <br>
                                <?php
                                echo form_label('Đơn vị: phút, nên là số được 60 chia hết', 'step');
                                echo form_error('step');
                                $step = array(
                                    'name' => 'step',
                                    'id'   => 'step',
                                    'class'=> 'form-control',
                                    'type' => 'number',
                                    'min' => 1,
                                    'max' => 60,
                                    'value' => $detail['step']
                                );
                                echo form_input($step);
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
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<script>
    var st_dt = '<?php echo date('d/m/Y', $detail['date_from']) ?>';
    var ed_dt = '<?php echo date('d/m/Y', $detail['date_to']) ?>';
    $('.datepicker').daterangepicker({
        todayHighlight: true,
        autoclose: true,
        disableTouchKeyboard: true,
        enableOnReadonly: true,
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
    $('.datepicker').data('daterangepicker').setStartDate(st_dt);
    $('.datepicker').data('daterangepicker').setEndDate(ed_dt);
</script>