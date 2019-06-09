<style type="text/css">
    .zeroPadding {
        padding: 0 !important;
    }
</style>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Alert! <?php echo $this->session->flashdata('success'); ?></h4>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Alert! <?php echo $this->session->flashdata('error'); ?></h4>
                </div>
            <?php endif ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background: #4e73df; color: white">
                        <tr>
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Tên event</th>
                            <th style="text-align: center">Ngày tổ chức</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result): ?>
                            <?php foreach ($result as $key => $value): ?>
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
                                    <td style="text-align: center">
                                        <a data-toggle="collapse" href="#review-<?php echo $key ?>" role="button" aria-expanded="false">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo base_url('member/setting/update/' . $value['setting_id']) ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="zeroPadding">
                                        <div class="collapse out" id="review-<?php echo $key ?>">
                                            <ul class="list-group">
                                                <li class="list-group-item active"><i class="fas fa-list"></i> Tiêu chí</li>
                                                <?php if ($value['category']): ?>
                                                    <?php foreach ($value['category'] as $k => $val): ?>
                                                        <li class="list-group-item" style="background: #3495c4 !important; color: white"><i class="fas fa-bullseye"></i> <?php echo $val['name'] ?></li>
                                                        <?php if (isset($val['sub']) && !empty($val['sub'])): ?>
                                                            <?php foreach ($val['sub'] as $item): ?>
                                                                <li class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;&#8627; <?php echo $item['name'] ?></li>
                                                            <?php endforeach ?>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
                <div class="dataTables_paginate paging_simple_numbers">
                    <?php //echo $page_links ?>
                </div>
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
</script>