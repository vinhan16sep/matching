<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$events = array(
    2 => array
    (
        'name' => 'Danh mục gốc 1',
        7 => 'DM1 con 13',
        11 => 'DM1 con 2'
    ),

    3 => array
    (
        'name' => 'Danh mục gốc 2',
        '5' => 'DM con 123',
        '6' => 'DM con 2',
        '10' => 'DM con 334'
    )
);
?>
<div class="container-fluid">
    <!-- Area Chart -->
    <div class="col-xl-3 col-lg-3">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Chọn tiêu chí</h6>
                <div class="dropdown no-arrow">
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
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
                                echo form_submit('submit', 'OK', 'class="btn btn-primary"');
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

    <!-- Pie Chart -->
    <div class="col-xl-9 col-lg-9">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách</h6>
                <div class="dropdown no-arrow">
                    <a title="Xem toàn bộ" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-arrow-alt-circle-right text-primary"></i>
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>



    <!-- End of Main Content -->
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

