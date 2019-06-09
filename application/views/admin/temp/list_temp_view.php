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
                                    <tr id="<?= $item['id'] ?>">
                                        <td style="text-align: center"><?php echo $key + 1; ?></td>
                                        <td><?php echo $item['code']; ?></td>
                                        <td style="display: none;" class="reg-client-event-id"><?php echo $item['event_id']; ?></td>
                                        <td><?php echo $item['event_name']; ?></td>
                                        <td class="reg-client-company"><?php echo $item['company']; ?></td>
                                        <td><?php echo $item['connector']; ?></td>
                                        <td><?php echo $item['position']; ?></td>
                                        <td><?php echo $item['address']; ?></td>
                                        <td><?php echo $item['phone']; ?></td>
                                        <td class="reg-client-email"><?php echo $item['email']; ?></td>
                                        <td style="text-align: center">
                                            <a title="Tạo tài khoản cho đơn đăng ký" class="btn-reg-client" href="#" data-toggle="modal" data-target="#register-client-form">
                                                <i class="fa fa-user-plus" aria-hidden="true"></i>
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


<div class="modal fade" id="register-client-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo tài khoản cho doanh nghiệp: <strong id="reg-company"></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('admin/user/register', array()); ?>
                    <div class="form-group">
                        <label for="email" class="col-form-label">E-Mail:</label>
                        <input type="text" class="form-control" id="txt-reg-email" name="email" readonly>
                    </div>
                    <input type="hidden" class="form-control" id="txt-reg-event-id" name="event_id" readonly>
                    <div class="form-group">
                        <label for="pass" class="col-form-label">Mật khẩu:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="txt-reg-pass" name="password"></input> 
                            <div class="input-group-append">
                                <a class="btn btn-info" id="btn-random-pass" style="color: #fff; cursor: pointer;" href="javascript:void(0)"><i class="fas fa-sync-alt"></i></a>
                            </div>   
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 ">
                            <input type="submit" class="btn btn-success" name="register" value="Đăng Ký">
                        </div>
                    </div>
                <?php echo form_close(); ?>
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

    $('.btn-reg-client').click(function(){
        company = $(this).parents('tr').find('.reg-client-company').text();
        email = $(this).parents('tr').find('.reg-client-email').text();
        event_id = $(this).parents('tr').find('.reg-client-event-id').text();
        $('#reg-company').text(company);
        $('#txt-reg-email').val(email);
        $('#txt-reg-event-id').val(event_id);
        random_pass = Math.random().toString(36).replace(/[^a-zA-z0-9]+/g, '').substr(0, 8);
        $('#txt-reg-pass').val(random_pass);
    });
    $('#btn-random-pass').click(function(){
        random_pass = Math.random().toString(36).replace(/[^a-zA-z0-9]+/g, '').substr(0, 8);
        $('#txt-reg-pass').val(random_pass);
    });

</script>