<style>
    .overview-text:hover, .overview-icon:hover{
        color: white !important;
    }
    .custom-btn-primary{
        border-color: #3495c4;
    }
    .custom-btn-primary:hover{
        background-color: #3495c4;
    }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <!-- Card Body -->
                    <div class="card-body" style="padding: 0 !important;">
                        <div class="">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">STT</th>
                                        <th style="text-align: center">Tên sự kiện</th>
                                        <th style="text-align: center">Trạng thái</th>
                                        <th style="text-align: center"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($temp_register)){
                                        foreach($temp_register as $key => $item) {
                                            ?>
                                            <tr id="<?= $item['id'] ?>">
                                                <td style="text-align: center"><?php echo $key + 1; ?></td>
                                                <td style="text-align: center"><?php echo $item['eventName']; ?></td>
                                                <td style="text-align: center" class="reg-client-company">
                                                    <?php
                                                        echo ($item['is_overview'] == 1)
                                                            ? '<a href="' . base_url('member/overview/manage?event_id=' . $item['event_id']) . '" class="btn btn-outline-primary overview-text custom-btn-primary"><i class="fa fa-check overview-icon" aria-hidden="true"></i> Xem / Chỉnh sửa</a>'
                                                            : '<a href="' . base_url('member/overview/manage?event_id=' . $item['event_id']) . '" class="btn btn-outline-danger overview-text"><i class="fa fa-exclamation-triangle overview-icon" style="color: red !important;" aria-hidden="true"></i> Bổ sung ngay</a>';
                                                    ?>
                                                </td>
                                                <td style="text-align: center">
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>