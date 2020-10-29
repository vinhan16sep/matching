<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.js"></script>
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
                            <th style="text-align: center">Người phụ trách</th>
                            <th style="text-align: center">Ngày tổ chức</th>
                            <th style="text-align: center">Địa điểm</th>
                            <th style="text-align: center">Địa điểm Tiếng Anh</th>
                            <th style="text-align: center">Số bàn</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result){ ?>
                            <?php foreach($result as $key => $item){ ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $key + 1; ?></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo $item['person']; ?></td>
                                    <td style="text-align: center"><?php echo (empty($item['date'])) ? date('d/m/Y', $item['date_from']) . '~' . date('d/m/Y', $item['date_to']) : date('d/m/Y', $item['date']); ?></td>
                                    <td style="text-align: center"><?php echo $item['place']; ?></td>
                                    <td style="text-align: center"><?php echo $item['place_en']; ?></td>
                                    <td style="text-align: center"><?php echo $item['table']; ?></td>
                                    <!-- <td style="text-align: center">
                                        <?php
                                            echo ($item['is_active'] == 0)
                                                ? '<a class="activate" title="Đang tắt, click để kích hoạt" href="javascript:void(0);" data-id="' . $item['id'] . '" data-activate="' . $item['is_active'] . '"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>'
                                                : '<a class="activate" title="Đang kích hoạt, click để tắt" href="javascript:void(0);" data-id="' . $item['id'] . '" data-activate="' . $item['is_active'] . '"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                                        ?>
                                    </td> -->
                                    <td style="text-align: center;">
                                      <input class="toggle-active" <?= $item['is_active'] == 1? 'checked' : ''  ?> type="checkbox" data-id="<?= $item['id'] ?>" data-toggle="toggle">
                                    </td>
                                    <td style="text-align: center">
                                        <a title="Cập nhật thông tin sự kiện" href="<?php echo base_url('admin/event/edit/' . $item['id']); ?>"><i class="fa fa-pen-square" aria-hidden="true"></i></a>
                                        <a title="Thiết lập danh mục" href="<?php echo base_url('admin/category/index?event=' . $item['id']); ?>"><i class="fa fa-book" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="post">Chưa có sự kiện!</div>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="dataTables_paginate paging_simple_numbers">
                    <?php echo $page_links ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>
    $('.activate').click(function(){
        var id = $(this).data('id');
        var activate = $(this).data('activate');

        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('admin/event/activate') ?>',
            data: {
                id: id,
                activate: activate
            },
            success: function(res){
                var result = JSON.parse(res);
                if(result.message == 1){
                    alert('OK');
                    window.location.reload();
                }else{
                    alert('Không đổi được trạng thái');
                    window.location.reload();
                }
            }
        });
    });

    $(".toggle-active").bootstrapSwitch('onText', 'ON');
    $(".toggle-active").bootstrapSwitch('offText', 'OFF');

    var options = {
        onSwitchChange: function (event, state) {
            // Return false to prevent the toggle from switching.
            return false;
        }
    };
    $(".toggle-active").bootstrapSwitch(options);

    $('.toggle-active').on('switchChange.bootstrapSwitch', function (e, data) {
        var currentDiv = $(this).bootstrapSwitch('state');
        var id = $(this).data('id');
        if (currentDiv == false) {
            var confirmed = confirm("Bạn chắc chăn đóng sự kiện này?");
            if (confirmed == true) {

                $.ajax({
                    method: 'GET',
                    url: '<?php echo base_url('admin/user/lock_account') ?>',
                    data: {
                        id: id,
                        status: currentDiv
                    },
                    success: function(res){
                        var result = JSON.parse(res);
                        if (result.status == true) {
                            alert('Đóng sự kiện thành công');
                            location.reload();
                        }
                    }
                });

            } else {
                $(this).bootstrapSwitch('toggleState', true);
            }
        } else {
            var confirmed = confirm("Bạn chắc mở sự kiện này?");
            if (confirmed == true) {
                
                $.ajax({
                    method: 'GET',
                    url: '<?php echo base_url('admin/user/lock_account') ?>',
                    data: {
                        id: id,
                        status: currentDiv
                    },
                    success: function(res){
                        var result = JSON.parse(res);
                        if (result.status == true) {
                            alert('Mở sự kiện thành công');
                            location.reload();
                        }
                        
                    }
                });

            } else {
                $(this).bootstrapSwitch('toggleState', true);
            }
        }
        
    });
</script>