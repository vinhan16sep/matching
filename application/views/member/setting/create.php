<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
            echo form_open_multipart('', array('class' => 'form-horizontal'));
            ?>
            <div class="row">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert! <?php echo $this->session->flashdata('error'); ?></h4>
                    </div>
                <?php endif ?>

                <div class="form-group col-lg-12">
                    <?php 
                        echo form_label('Tiêu chí', 'category_id');
                        echo form_error('category_id[]');
                    ?>
                    <br>
                    <?php if ($events): ?>
                        <?php foreach ($events as $key => $value): ?>
                            <?php 
                                echo form_checkbox('category_id[]', $key, false, 'class="btn-event" data-key=' . $key);
                                echo $value['name'] . '<br>';
                            ?>
                            <?php if ($value): ?>
                                <?php foreach ($value as $k => $val): ?>
                                    <?php if ($k != 'name'): ?>
                                        <div style="display: none; margin-left: 20px" class="slide-service-<?php echo $key ?>">
                                            <?php 
                                                echo form_checkbox('category_id[]', $k, false, 'class="btn-service"');
                                                echo $val . '<br>';
                                            ?>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach ?>
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
            $('.slide-service-' + key).slideDown();
        }else{
            $('.slide-service-' + key).slideUp();
        }
        
    });
</script>