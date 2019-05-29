<style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
            echo form_open_multipart(base_url('admin/temp/index'), array('class' => 'form-horizontal', 'method' => 'GET'));
            ?>
            <div class="row">
                <div class="column">
                    <div class="form-group">
                        <?php
                        echo form_error('code');
                        echo form_input('code', set_value('code', $keywords), 'class="form-control" id="code"');
                        ?>
                    </div>
                </div>
                <div class="column">
                    <div class="form-group col-sm-12 text-left" style="padding-left: 0 !important;">
                        <?php
                        echo form_submit('submit', 'OK', 'class="btn btn-primary"');
                        ?>
                        <a class="btn btn-outline-primary" href="<?php echo base_url('admin/temp/index') ?>"><i class="fa fa-repeat" aria-hidden="true" style="color: red"></i></a>
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Code</th>
                            <th style="text-align: center">Doanh nghiệp</th>
                            <th style="text-align: center">Người đại diện</th>
                            <th style="text-align: center">Chức danh</th>
                            <th style="text-align: center">Địa chỉ</th>
                            <th style="text-align: center">Số điện thoại</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result){ ?>
                            <?php foreach($result as $key => $item){ ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $key + 1; ?></td>
                                    <td><?php echo $item['code']; ?></td>
                                    <td><?php echo $item['company']; ?></td>
                                    <td><?php echo $item['connector']; ?></td>
                                    <td><?php echo $item['position']; ?></td>
                                    <td><?php echo $item['address']; ?></td>
                                    <td><?php echo $item['phone']; ?></td>
                                    <td><?php echo $item['email']; ?></td>
                                    <td style="text-align: center">
                                        <a title="Tạo tài khoản cho đơn đăng ký" href="#"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
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