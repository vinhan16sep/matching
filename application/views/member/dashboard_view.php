<!-- Begin Page Content -->

<div class="container-fluid" id="dashboard-member">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!--    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng số sự kiện</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span style="color: #3495c4"><?php echo count($active_events); ?></span>
                                &nbsp;sự kiện đang được kích hoạt
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead style="background: #4e73df; color: white">
                            <tr>
                                <th style="text-align: center">STT</th>
                                <th style="text-align: center">Tên sự kiện</th>
                                <th style="text-align: center">Thời gian tổ chức</th>
                                <th style="text-align: center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($active_events){ ?>
                                <?php foreach($active_events as $key => $item){ ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $key + 1; ?></td>
                                        <td><?php echo $item['eventName']; ?></td>
                                        <td style="text-align: center"><?php echo $item['eventStart'] . ' - ' . date('d/m/Y', $item['eventDate']); ?></td>
                                        <td style="text-align: center">
                                            <a title="Xem chi tiết" href="<?php echo base_url('member/matching/index?event_id=' . $item['eventId']); ?>"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php }else{ ?>
                                <div class="post">Chưa có sự kiện!</div>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<!--        <div class="col-xl-3 col-md-3 mb-4">-->
<!--            <div class="card border-left-success shadow h-100 py-2">-->
<!--                <div class="card-body">-->
<!--                    <div class="row no-gutters align-items-center">-->
<!--                        <div class="col mr-2">-->
<!--                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng số user</div>-->
<!--                            <div class="h5 mb-0 font-weight-bold text-gray-800">--><?php //echo $users; ?><!--</div>-->
<!--                        </div>-->
<!--                        <div class="col-auto">-->
<!--                            <i class="fas fa-user fa-2x text-gray-300"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-xl-3 col-md-3 mb-4">-->
<!--            <div class="card border-left-success shadow h-100 py-2">-->
<!--                <div class="card-body">-->
<!--                    <div class="row no-gutters align-items-center">-->
<!--                        <div class="col mr-2">-->
<!--                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng số user</div>-->
<!--                            <div class="h5 mb-0 font-weight-bold text-gray-800">--><?php //echo $users; ?><!--</div>-->
<!--                        </div>-->
<!--                        <div class="col-auto">-->
<!--                            <i class="fas fa-user fa-2x text-gray-300"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-xl-3 col-md-3 mb-4">-->
<!--            <div class="card border-left-success shadow h-100 py-2">-->
<!--                <div class="card-body">-->
<!--                    <div class="row no-gutters align-items-center">-->
<!--                        <div class="col mr-2">-->
<!--                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng số user</div>-->
<!--                            <div class="h5 mb-0 font-weight-bold text-gray-800">--><?php //echo $users; ?><!--</div>-->
<!--                        </div>-->
<!--                        <div class="col-auto">-->
<!--                            <i class="fas fa-user fa-2x text-gray-300"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>


