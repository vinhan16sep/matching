<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Tên event</th>
                            <th style="text-align: center">Ngày tổ chức</th>
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
                                    <td style="text-align: center"><?php echo date('d/m/Y', $item['date']); ?></td>
                                    <td style="text-align: center"><?php echo $item['table']; ?></td>
                                    <td style="text-align: center">
                                        <?php
                                            echo ($item['is_active'] == 0)
                                                ? '<a class="activate" title="Đang tắt, click để kích hoạt" href="javascript:void(0);" data-id="' . $item['id'] . '" data-activate="' . $item['is_active'] . '"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>'
                                                : '<a class="activate" title="Đang kích hoạt, click để tắt" href="javascript:void(0);" data-id="' . $item['id'] . '" data-activate="' . $item['is_active'] . '"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                                        ?>
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
</script>