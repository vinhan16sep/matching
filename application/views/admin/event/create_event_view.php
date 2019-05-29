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
    <div class="col-lg-10 col-lg-offset-0" style="margin-left: 15px;">
        <?php
        echo form_open_multipart('', array('class' => 'form-horizontal'));
        ?>
        <div class="row">
            <div class="column">
                <div class="form-group">
                    <?php
                    echo form_label('Tên event', 'name');
                    echo form_error('name');
                    echo form_input('name', set_value('name'), 'class="form-control" id="name"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label('Số bàn', 'table');
                    echo form_error('table');
                    $data = array(
                        'name' => 'table',
                        'id'   => 'table',
                        'class'=> 'form-control',
                        'type' => 'number',
                        'min' => 0
                    );
                    echo form_input($data);
                    ?>
                </div>
                <br>
                <div class="form-group col-sm-12 text-left" style="padding-left: 0 !important;">
                    <?php
                    echo form_submit('submit', 'Hoàn thành', 'class="btn btn-primary"');
                    ?>
                    <a class="btn btn-default cancel" href="javascript:window.history.go(-1);">Quay lại</a>
                </div>
            </div>
            <div class="column">
                <div class="form-group">
                    <?php
                    echo form_label('Ngày', 'date');
                    echo form_error('date');
                    echo form_input('date', set_value('date'), 'class="form-control datepicker" id="date" readonly');
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
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<script>
    $.fn.datepicker.defaults.language = 'vi';
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
        disableTouchKeyboard: true,
        enableOnReadonly: true
    });
</script>