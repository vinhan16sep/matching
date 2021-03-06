<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
            echo form_open_multipart(base_url('member/setting/update/' . $setting_id . '?event_id=' . $event_id), array('class' => 'form-horizontal'));
            ?>
            <div class="row">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fa fa-warning"></i><?php echo $this->session->flashdata('error'); ?></h5>
                    </div>
                <?php endif ?>

                <div class="form-group col-lg-12">
                    <span style="font-weight: bold; font-size: 20px;">
                        <?php echo form_label($this->lang->line("Competencies of Company/ Organization"), 'category_id'); ?>
                    </span>
                    <br>
                    <span style="font-weight: bold; font-size: 15px; color:#3495c4;">
                        <?php echo form_label($this->lang->line("Setting category guide text"), 'category_id'); ?>
                    </span>
                    <?php echo form_error('category_id[]'); ?>
                    <br>
                    <?php if ($events): ?>
                        <?php foreach ($events as $key => $value): ?>
                            <?php 
                                
                                $require = '';
                                $check_require = '';
                                if ($value['require'] == 1) {
                                    $require = '<span style="color:red;font-weight:bold;"> ('.$this->lang->line("Require selected").') </span>';
                                    $check_require = 'require_capacity';
                                }
                                echo form_checkbox('category_id[]', $key, in_array($key, $detail['category_id']), ' title="' . $value['name'] . '" class="' . $check_require . ' btn-event event-'. $key .'" data-key=' . $key);
                                echo '<span style="color: #3495c4;font-weight: 700;">'. $value['name'] . '</span>' . $require . '<br>';
                                unset($value['require']);
                            ?>
                            <?php if ($value): ?>
                                <div style="margin-left: 20px" class="slide-service-<?php echo $key ?>" data-key="<?php echo $key ?>">
                                <?php foreach ($value as $k => $val): ?>
                                    <?php if ($val): ?>
                                        
                                        <?php 
                                            if (is_array($val)):
                                                if (isset($val['name'])) {
                                                    echo form_checkbox('category_id[]', $k, in_array($k, $detail['category_id']), 'class="btn-service sub-event-' . $k .'"');
                                                    echo $val['name'] . '<br>';
                                                }
                                        ?>
                                            <div style="margin-left: 40px" class="slide-service-sub-<?php echo $k ?>" data-key="<?php echo $k ?>">
                                                <?php foreach ($val as $item => $child): ?>
                                                    <?php if ($item != 'name'): ?>
                                                        <?php 
                                                            echo form_checkbox('category_id[]', $item, in_array($item, $detail['category_id']), 'class="btn-service btn-service-sub"');
                                                            echo $child . '<br>';
                                                        ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </div>
                                        <?php else: ?>
                                            <?php
                                                if ($k != 'name') {
                                                    echo form_checkbox('category_id[]', $k, in_array($k, $detail['category_id']), 'class="btn-service"');
                                                    echo $val . '<br>';
                                                }
                                            ?>
                                        <?php endif ?>
                                    <?php endif ?>
                                <?php endforeach; ?>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>

                <br>
                <div class="form-group col-sm-12 text-left" style="padding-left: 0 !important;">
                    <div class="pull-right">
                        <?php
                            echo form_submit('submit', $this->lang->line("capnhat"), 'class="btn btn-primary"');
                        ?>
                        <a class="btn btn-default cancel" href="javascript:window.history.go(-1);"><?= $this->lang->line("quaylai") ?></a>
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

<script type="text/javascript">
    $('.btn-event').click(function(){
        key = $(this).data('key');
        if($(this).prop("checked") == true){
            $('.slide-service-' + key).find('input').prop('checked',true);
        }else{
            $('.slide-service-' + key).find('input').prop('checked',false);
        }
        
    });
    $('.btn-service').click(function(){
        key = $(this).parent('div').data('key');
        if ($(this).prop("checked") == true) {
            $('.event-' + key).prop('checked',true);
            
        }else{
            input_checked = $(this).parent('div').children('input').length;
            if ($(this).parent('div').children('.btn-service:checkbox:not(:checked)').length == input_checked) {
                $('.event-' + key).prop('checked',false);
            }
        }
    });

    $('.btn-service').click(function(){
        key = $(this).val();
        if($(this).prop("checked") == true){
            $('.slide-service-sub-' + key).find('input').prop('checked',true);
        }else{
            $('.slide-service-sub-' + key).find('input').prop('checked',false);
        }
    });

    $('.btn-service-sub').click(function(){
        key = $(this).parent('div').data('key');
        if ($(this).prop("checked") == true) {
            $('.sub-event-' + key).prop('checked',true);
            key_parent_sub_event = $('.sub-event-' + key).parent('div').data('key');
            $('.event-' + key_parent_sub_event).prop('checked',true);
            
        }else{
            input_checked = $(this).parent('div').children('input').length;
            console.log(input_checked + '---' + $(this).parent('div').children('.btn-service-sub:checkbox:not(:checked)').length);
            if ($(this).parent('div').children('.btn-service-sub:checkbox:not(:checked)').length == input_checked) {
                $('.sub-event-' + key).prop('checked',false);
                input_checked_parent = $('.sub-event-' + key).parent('div').children('input').length;
                console.log(input_checked_parent);
                console.log($('.sub-event-' + key).parent('div').children('.btn-service:checkbox:not(:checked)').length);
                if ($('.sub-event-' + key).parent('div').children('.btn-service:checkbox:not(:checked)').length == input_checked_parent) {
                    key_parent_sub_event = $('.sub-event-' + key).parent('div').data('key');
                    $('.event-' + key_parent_sub_event).prop('checked',false);
                }
            }
        }
    });
    $('.form-horizontal [type="submit"]').click(function(){
        var length_require_capacity = $('.require_capacity:checkbox:not(:checked)').length;
        if (length_require_capacity > 0) {
            alert('Vui lòng chọn những năng lực là bắt buộc');
            return false;
        }
    });

</script>