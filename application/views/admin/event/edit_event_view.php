<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper -->
<div class="container-fluid">
    <div class="col-lg-10 col-lg-offset-0" style="margin-left: 15px;">
        <h1>Cập nhật sự kiện</h1>
        <?php
        echo form_open_multipart('', array('class' => 'form-horizontal'));
        ?>
        <div class="form-group">
            <?php
            echo form_label('Tên event', 'name');
            echo form_error('name');
            echo form_input('name', set_value('name', $detail['name']), 'class="form-control" id="name"');
            ?>
        </div>
        <div class="form-group">
            <?php
            echo form_label('Ngày', 'date');
            echo form_error('date');
            echo form_input('date', set_value('date', date('d/m/Y', $detail['date'])), 'class="form-control datepicker" id="date" readonly');
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
                'min' => 0,
                'value' => $detail['table'],
            );
            echo form_input($data);
            ?>
        </div>
        <br>
        <div class="form-group col-sm-12 text-right">
            <?php
            echo form_submit('submit', 'Hoàn thành', 'class="btn btn-primary"');
            echo form_close();
            ?>
            <a class="btn btn-default cancel" href="javascript:window.history.go(-1);">Quay lại</a>
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