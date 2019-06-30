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
            echo form_open_multipart(base_url('admin/request/index'), array('class' => 'form-horizontal', 'method' => 'GET'));
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
                        <a class="btn btn-outline-primary" href="<?php echo base_url('admin/request/index') ?>"><i class="fa fa-repeat" aria-hidden="true" style="color: red"></i></a>
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
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert" style="color:#ffffff !important;background-color: #3c763d !important;font-size: 13pt !important;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Thông báo!</strong> <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center">STT</th>
                                <th style="text-align: center">Code</th>
                                <th style="text-align: center">Sự kiện</th>
                                <th style="text-align: center">Doanh nghiệp</th>
                                <th style="text-align: center">Người đại diện</th>
                                <th style="text-align: center">Địa chỉ</th>
                                <th style="text-align: center">Số điện thoại</th>
                                <th style="text-align: center">Email</th>
                                <th style="text-align: center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($result){ ?>
                                <?php foreach($result as $key => $item){ ?>
                                    <tr id="<?= $item['settingId'] ?>">
                                        <td style="text-align: center"><?php echo $key + 1; ?></td>
                                        <td><?php echo $item['code']; ?></td>
                                        <td style="display: none;" class="reg-client-event-id"><?php echo $item['event_id']; ?></td>
                                        <td><?php echo $item['eventName']; ?></td>
                                        <td class="reg-client-company"><?php echo $item['company']; ?></td>
                                        <td><?php echo $item['connector']; ?></td>
                                        <td><?php echo $item['address']; ?></td>
                                        <td><?php echo $item['phone']; ?></td>
                                        <td class="reg-client-email"><?php echo $item['email']; ?></td>
                                        <td style="text-align: center">
                                            <a onclick="active('<?= $item['settingId'] ?>');" title="Kích hoạt sự kiện cho yêu cầu này?" class="btn-reg-client" href="javascript:void(0);">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php }else{ ?>
                                <div class="post">Chưa có sự kiện!</div>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                        <?php echo $page_links ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script>
    function active(setting_id){
        if(confirm("Bạn chắc chắn muốn kích hoạt sự kiện cho yêu cầu này?")){
            $.ajax({
                method: 'GET',
                url: '<?php echo base_url('admin/request/activate') ?>',
                data: {
                    setting_id: setting_id,
                },
                success: function(res){
                    var result = JSON.parse(res);
                    if(result.message == 1){
                        alert('Kích hoạt thành công');
                        window.location.reload();
                    }else{
                        alert('Không đổi được trạng thái');
                        window.location.reload();
                    }
                }
            });
        }
    }
</script>