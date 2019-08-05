<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
            echo form_open_multipart(base_url('member/setting/create?event_id=' . $event_id), array('class' => 'form-horizontal'));
            ?>
            <div class="row">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i><?php echo $this->session->flashdata('error'); ?></h4>
                    </div>
                <?php endif ?>

                <div class="form-group col-lg-12">
                    <span style="font-weight: bold; font-size: 20px;">
                        <?php echo form_label('Năng lực Doanh nghiệp / tổ chức', 'category_id'); ?>
                    </span>
                    <?php echo form_error('category_id[]'); ?>
                    <br>
                    <?php if ($events): ?>
                        <?php foreach ($events as $key => $value): ?>
                            <?php 
                                echo form_checkbox('category_id[]', $key, false, 'class="btn-event event-'. $key .'" data-key=' . $key);
                                echo $value['name'] . '<br>';
                            ?>
                            <?php if ($value): ?>
                                <div style="margin-left: 20px" class="slide-service-<?php echo $key ?>" data-key="<?php echo $key ?>">
                                <?php foreach ($value as $k => $val): ?>
                                    <?php if ($k != 'name'): ?>
                                            <?php 
                                                echo form_checkbox('category_id[]', $k, false, 'class="btn-service"');
                                                echo $val . '<br>';
                                            ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>

                <br>
                <div class="form-group col-sm-12 text-left" style="padding-left: 0 !important;">
                    <div class="pull-right">
                        <?php
                            echo form_submit('submit', 'Đăng ký', 'class="btn btn-primary"');
                        ?>
                        <a class="btn btn-default cancel" href="javascript:window.history.go(-1);">Quay lại</a>
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
            // $('.slide-service-' + key).slideDown();
            $('.slide-service-' + key).find('input').prop('checked',true);
        }else{
            // $('.slide-service-' + key).slideUp();
            $('.slide-service-' + key).find('input').prop('checked',false);
        }
        
    });

    $('.btn-service').click(function(){
        key = $(this).parent('div').data('key');
        if ($(this).prop("checked") == true) {
            // console.log($(this).parent('div').children('.btn-service:checkbox:not(:checked)').length);
            $('.event-' + key).prop('checked',true);
            
        }else{
            input_checked = $(this).parent('div').children('input').length;
            if ($(this).parent('div').children('.btn-service:checkbox:not(:checked)').length == input_checked) {
                $('.event-' + key).prop('checked',false);
            }
        }
    });
</script>