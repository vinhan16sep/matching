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
    .error{
        color: red;
        position: relative;
        line-height: 1;
        width: 100%;
        font-size: 1rem !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-12">
                <div class="card-body">
                    <?php
                    echo form_open_multipart('', array('class' => 'form-horizontal'));
                    ?>

                    <div class="row">
                        <div class="form-group" style="width: 100%">
                            <?php echo form_label('Sự kiện đã chọn', 'name'); ?>
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?><br>
                            <?php echo form_input('name', '', 'class="form-control" id="event-name" readonly'); ?>
                        </div>
                    </div>
                    <input type="hidden" name="event_id" id="event-id">
                    <div class="form-group">
                        <?php echo form_submit('submit', 'Lưu Thông Tin', 'class="btn btn-success" style="float: right" id="btnSave"'); ?>
                        
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
<style type="text/css">
    .zeroPadding {
        padding: 0 !important;
    }
</style>

<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background: #4e73df; color: white">
                        <tr>
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Tên event</th>
                            <th style="txt-aelign: center">Ngày tổ chức</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="event-add">
                        <?php if ($events): ?>
                            <?php foreach ($events as $key => $value): ?>
                                <tr>
                                    <td>
                                        <?php echo $key +1 ?>
                                    </td>
                                    <td>
                                        <?php echo $value['name'] ?>
                                    </td>
                                    <td>
                                        <?php echo date('d-m-Y', $value['date']) ?>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($value['date'] < now() && $value['is_active'] == 1) {
                                                echo '<span class="label label-default">Chưa diễn ra</span>';
                                            }
                                            if ($value['date'] >= now() && $value['is_active'] == 1) {
                                                echo '<span class="label label-success">Đang diễn ra</span>';
                                            }
                                            if ($value['is_active'] != 1) {
                                                echo '<span class="label label-danger">Hết sự kiện</span>';
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align: center" class="event-column-<?= $value['id'] ?>">
                                        <a href="javascript:void(0)" class="add-event" title="Thêm mới sự kiện" data-id="<?= $value['id'] ?>" data-name_event="<?= $value['name'] ?>"><i class="fas fa-plus-square" style="color: #5cb85c !important"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Không có sự kiện</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $('.collapse').on('show.bs.collapse', function() {
        $(this).parent().removeClass("zeroPadding");
    });

    $('.collapse').on('hide.bs.collapse', function() {
        $(this).parent().addClass("zeroPadding");
    });

    $('#event-add').on('click', '.add-event', function(){
        id = $(this).data('id');
        name = $(this).data('name_event');
        html = '<a href="javascript:void(0)" class="remove-event" title="Xóa sự kiện" data-id="' + id + '" data-name_event="' + name + '">';
        html += '<i class="fas fa-minus-square" style="color: #d9534f !important"></i>';
        html += '</a';
        $('.event-column-' + id).html(html);
        if ($('#event-name').val() == '') {
            $('#event-name').val(name);
        }else{
            $('#event-name').val($('#event-name').val() + ', ' + name);
        }
        if ($('#event-id').val() == '') {
            $('#event-id').val(id);
        }else{
            $('#event-id').val($('#event-id').val() + ',' + id);
        }
    });
    $('#event-add').on('click', '.remove-event', function(){
        id = $(this).data('id');
        name = $(this).data('name_event');
        html = '<a href="javascript:void(0)" class="add-event" title="Xóa sự kiện" data-id="' + id + '" data-name_event="' + name + '">';
        html += '<i class="fas fa-plus-square" style="color: #5cb85c !important"></i>';
        html += '</a';
        $('.event-column-' + id).html(html);
        if ($('#event-name').val() != '') {
            if($('#event-name').val().indexOf(', ') == -1){
                $('#event-name').val($('#event-name').val().replace(name, ''));
            }else if ($('#event-name').val().replace(', ' + name, '')) {
                $('#event-name').val($('#event-name').val().replace(', ' + name, ''));
            }else if($('#event-name').val().replace(name + ' ,', '')){
                $('#event-name').val($('#event-name').val().replace(name + ' ,', ''));
            }
            
        }
        if ($('#event-id').val() != '') {
            if($('#event-id').val().indexOf(', ') == -1){
                $('#event-id').val($('#event-id').val().replace(id, ''));
            }else if ($('#event-id').val().replace(', ' + id, '')) {
                $('#event-id').val($('#event-id').val().replace(', ' + id, ''));
            }else if($('#event-id').val().replace(id + ' ,', '')){
                $('#event-id').val($('#event-id').val().replace(id + ' ,', ''));
            }
        }
    });
</script>