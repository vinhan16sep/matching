<style type="text/css">
    .dataTables_paginate{
        margin: 0;
        white-space: nowrap;
        text-align: right;
    }
    .pagination{
        margin: 2px 0;
        white-space: nowrap;
        justify-content: flex-end;
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: .35rem;
    }
    .pagination li a{
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #4e73df;
        background-color: #fff;
        border: 1px solid #dddfeb;
    }
    .pagination .active a{
        z-index: 1;
        color: #fff;
        background-color: #4e73df;
        border-color: #4e73df;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid" id="event_detail">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    </div>

  <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tài khoản / Số đơn đăng ký</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span style="color: #3495c4"><?php echo $count_active_temp_register; ?> tài khoản</span> / <span><?php echo $count_temp_register; ?></span>
                                &nbsp;đơn đăng ký
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng số cuộc hẹn đã được chấp nhận</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $approved_matching; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đăng ký mới nhất: <strong style="color: red"><?php echo date('d-m-Y', $event_date) ?></strong></h6>
                    <div class="dropdown no-arrow">
                        <a title="Xem toàn bộ" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-arrow-alt-circle-right text-primary"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <div class="chart-area">
                        <!-- <canvas id="myAreaChart"></canvas> -->
                        <div class="pull-right">
                            <?php
                            echo form_open_multipart(base_url('admin/event/detail/' . $event_id), array('class' => 'form-horizontal', 'method' => 'GET'));
                            ?>
                            <div class="row">
                                <div class="column">
                                    <div class="form-group">
                                        <?php
                                        echo form_error('keywords');
                                        echo form_input('keywords', set_value('keywords', $keywords), 'class="form-control" id="code"');
                                        ?>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="form-group col-sm-12 text-left" style="padding-left: 0 !important;">
                                        <?php
                                        echo form_submit('submit', 'OK', 'class="btn btn-primary"');
                                        ?>
                                        <a class="btn btn-outline-primary" href="<?php echo base_url('admin/event/detail/' . $event_id) ?>"><i class="fa fa-repeat" aria-hidden="true" style="color: red"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 text-right">
                                <?php
                                echo form_close();
                                ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">STT</th>
                                        <th style="text-align: center">Finder</th>
                                        <th style="text-align: center">Target</th>
                                        <th style="text-align: center">Thời gian</th>
                                        <th style="text-align: center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($matching): ?>
                                        <?php foreach ($matching as $key => $value): ?>
                                            <tr id="<?= $value['id'] ?>">
                                                <td style="text-align: center"><?php echo $key + 1; ?></td>
                                                <td style="text-align: center"><?php echo $value['company_finder'] ?></td>
                                                <td style="text-align: center"><?php echo $value['company_target'] ?></td>
                                                <td style="text-align: center"><?php echo date('H:i', $value['date']) ?></td>
                                                <td style="text-align: center" title="Thông tin cuộc hẹn">
                                                    <a href="#" class="call-popup" data-finder_id="<?php echo $value['finder_id'] ?>" data-target_id="<?php echo $value['target_id'] ?>"><i class="fas fa-info-circle"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else: ?>
                                        <div class="post">Chưa có cuộc hẹn!</div>
                                    <?php endif ?>
                                </tbody>
                            </table>
                            <div class="dataTables_paginate paging_simple_numbers">
                                <?php echo $page_links ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thống kê cuộc hẹn</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #36b9cc"></i> Đã đặt
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #ffc107"></i> Chờ xử lý
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: #dc3545"></i> Đã từ chối
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popup" id="matchingInfo">
        <button type="button" class="popup-close">
            <i class="fas fa-times"></i>
        </button>

        <div class="popup-content">
            <div class="item left">
                <div class="item-header">
                    <h6>
                        Bên đề nghị
                    </h6>
                </div>

                <div class="item-content">
                    <div class="tab-control">
                        <a href="#" class="tab active" data-tab="tab-info">
                            Thông tin cơ bản
                        </a>
                        <a href="#" class="tab" data-tab="tab-category">
                            Tiêu chí đăng ký
                        </a>
                        <a href="#" class="tab" data-tab="tab-overview">
                            Tổng quan
                        </a>
                        <a href="#" class="tab" data-tab="tab-profile">
                            Hồ sơ
                        </a>
                    </div>

                    <div class="tab-wrapper">
                        <div class="tab-inner tab-content-info show" data-tab-content="tab-info-content">
                            <div class="cover">
                                <img id="cover_1" src="<?php echo site_url('assets/img/logo.svg') ?>" alt="Logo Company 1">

                                <div class="mask mask-circle">
                                    <img id="logo_1" src="<?php echo site_url('assets/img/logo.svg') ?>" alt="Logo Company 1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="item col-xs-12 col-lg-6">
                                    <label>Công Ty</label>
                                    <h6 id="company-finder">No data</h6>
                                </div>

                                <div class="item col-xs-12 col-lg-6">
                                    <label>Địa Chỉ</label>
                                    <h6 id="address-finder">No data</h6>
                                </div>

                                <div class="item col-xs-12 col-lg-6">
                                    <label>Người Đại Diện</label>
                                    <h6 id="connector-finder">No data</h6>
                                </div>

                                <div class="item col-xs-12 col-lg-6">
                                    <label>Chức Danh</label>
                                    <h6 id="position-finder">No data</h6>
                                </div>
                                <div class="item col-xs-12 col-lg-6">
                                    <label>E-Mail</label>
                                    <h6 id="email-finder">No data</h6>
                                </div>
                                <div class="item col-xs-12 col-lg-6">
                                    <label>Số Điện Thoại</label>
                                    <h6 id="phone-finder">No data</h6>
                                </div>
                                <div class="item col-xs-12 col-lg-6">
                                    <label>File PDF</label>
                                    <h6 id="file-finder">No data</h6>
                                </div>
                            </div>
                        </div>
                        <div class="tab-inner tab-content-category" data-tab-content="tab-category-content" id="category-finder">
                            <div class="out collapse show" style="">

                            </div>
                        </div>
                        <div class="tab-inner tab-content-overview" data-tab-content="tab-overview-content" id="overview-finder">
                            <p>Aenean nec posuere tellus. In dictum, nisl vel pharetra laoreet, ligula urna feugiat arcu, rutrum aliquam ante erat quis mi. Quisque in pellentesque ipsum. Ut pretium orci tellus, a molestie diam venenatis a. Morbi vitae lorem dignissim, ornare orci at, euismod lorem. Morbi at eros enim. Phasellus efficitur faucibus arcu a mollis. Aenean elit dui, rutrum eget venenatis id, scelerisque id sapien. Nam vitae pellentesque sapien. Vestibulum vel mi tempor, sodales mi id, hendrerit diam. Morbi auctor vel quam et ullamcorper. Aliquam aliquet in dolor quis tempus. Quisque dolor nisi, tristique non suscipit nec, iaculis in purus. Nulla pulvinar erat turpis, non bibendum nibh semper ac. Sed elementum efficitur magna, nec cursus mi porta in.</p>
                        </div>
                        <div class="tab-inner tab-content-profile" data-tab-content="tab-profile-content" id="profile-finder">
                            <p>Aenean nec posuere tellus. In dictum, nisl vel pharetra laoreet, ligula urna feugiat arcu, rutrum aliquam ante erat quis mi. Quisque in pellentesque ipsum. Ut pretium orci tellus, a molestie diam venenatis a. Morbi vitae lorem dignissim, ornare orci at, euismod lorem. Morbi at eros enim. Phasellus efficitur faucibus arcu a mollis. Aenean elit dui, rutrum eget venenatis id, scelerisque id sapien. Nam vitae pellentesque sapien. Vestibulum vel mi tempor, sodales mi id, hendrerit diam. Morbi auctor vel quam et ullamcorper. Aliquam aliquet in dolor quis tempus. Quisque dolor nisi, tristique non suscipit nec, iaculis in purus. Nulla pulvinar erat turpis, non bibendum nibh semper ac. Sed elementum efficitur magna, nec cursus mi porta in.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="icon-connect">
                <i class="fas fa-link"></i>
            </div>

            <div class="item right">
                <div class="item-header">
                    <h6>
                        Bên chấp nhận
                    </h6>
                </div>

                <div class="item-content">
                    <div class="tab-control">
                        <a href="#" class="tab active" data-tab="tab-info">
                            Thông tin cơ bản
                        </a>
                        <a href="#" class="tab" data-tab="tab-category">
                            Tiêu chí đăng ký
                        </a>
                        <a href="#" class="tab" data-tab="tab-overview">
                            Tổng quan
                        </a>
                        <a href="#" class="tab" data-tab="tab-profile">
                            Hồ sơ
                        </a>
                    </div>

                    <div class="tab-wrapper">
                        <div class="tab-inner tab-content-info show" data-tab-content="tab-info-content">
                            <div class="cover">
                                <img id="cover_2" src="<?php echo site_url('assets/img/logo.svg') ?>" alt="Logo Company 2">

                                <div class="mask mask-circle">
                                    <img id="logo_2" src="<?php echo site_url('assets/img/logo.svg') ?>" alt="Logo Company 2">
                                </div>
                            </div>

                            <div class="row">
                                <div class="item col-xs-12 col-lg-6">
                                    <label>Công Ty</label>
                                    <h6 id="company-target">No data</h6>
                                </div>

                                <div class="item col-xs-12 col-lg-6">
                                    <label>Địa Chỉ</label>
                                    <h6 id="address-target">No data</h6>
                                </div>

                                <div class="item col-xs-12 col-lg-6">
                                    <label>Người Đại Diện</label>
                                    <h6 id="connector-target">No data</h6>
                                </div>

                                <div class="item col-xs-12 col-lg-6">
                                    <label>Chức Danh</label>
                                    <h6 id="position-target">No data</h6>
                                </div>
                                <div class="item col-xs-12 col-lg-6">
                                    <label>E-Mail</label>
                                    <h6 id="email-target">No data</h6>
                                </div>
                                <div class="item col-xs-12 col-lg-6">
                                    <label>Số Điện Thoại</label>
                                    <h6 id="phone-target">No data</h6>
                                </div>
                                <div class="item col-xs-12 col-lg-6">
                                    <label>File PDF</label>
                                    <h6 id="file-target"></h6>
                                </div>
                            </div>
                        </div>
                        <div class="tab-inner tab-content-category" data-tab-content="tab-category-content" id="category-target">
                            <div class="out collapse show" style="">
                                
                            </div>
                        </div>
                        <div class="tab-inner tab-content-overview" data-tab-content="tab-overview-content" id="overview-target">
                            <p>Pellentesque at magna volutpat, tincidunt arcu sit amet, lobortis nulla. Sed aliquet urna a enim semper, sed ultrices velit venenatis. Sed in interdum nisi. Ut vel quam nec massa tempor commodo id non leo. In molestie elit ut eros tempus lacinia. Duis mollis imperdiet sem sit amet mattis. In gravida velit vitae nibh vestibulum facilisis. Vestibulum sollicitudin, diam sit amet dictum ornare, lorem mauris maximus magna, quis finibus urna justo id odio. Aliquam sollicitudin rhoncus sapien, et interdum augue rutrum quis. Suspendisse tellus nulla, blandit nec orci in, sagittis fringilla nisl. Quisque convallis id arcu quis sagittis. Ut dictum, elit quis pharetra tempus, est erat sodales eros, eget tincidunt nibh dolor nec arcu. Etiam eu ex a justo commodo pulvinar in sed felis. Praesent suscipit pellentesque fermentum.</p>
                        </div>
                        <div class="tab-inner tab-content-profile" data-tab-content="tab-profile-content" id="profile-target">
                            <p>Pellentesque at magna volutpat, tincidunt arcu sit amet, lobortis nulla. Sed aliquet urna a enim semper, sed ultrices velit venenatis. Sed in interdum nisi. Ut vel quam nec massa tempor commodo id non leo. In molestie elit ut eros tempus lacinia. Duis mollis imperdiet sem sit amet mattis. In gravida velit vitae nibh vestibulum facilisis. Vestibulum sollicitudin, diam sit amet dictum ornare, lorem mauris maximus magna, quis finibus urna justo id odio. Aliquam sollicitudin rhoncus sapien, et interdum augue rutrum quis. Suspendisse tellus nulla, blandit nec orci in, sagittis fringilla nisl. Quisque convallis id arcu quis sagittis. Ut dictum, elit quis pharetra tempus, est erat sodales eros, eget tincidunt nibh dolor nec arcu. Etiam eu ex a justo commodo pulvinar in sed felis. Praesent suscipit pellentesque fermentum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page level plugins -->
<script src="<?php echo site_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>
<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Đã từ chối", "Chờ xử lý", "Đã đặt"],
            datasets: [{
                data: [
                    <?php echo $rejected_matching; ?>,
                    <?php echo $pending_matching; ?>,
                    <?php echo $approved_matching; ?>,
                ],
                backgroundColor: ['#dc3545', '#ffc107', '#36b9cc'],
                hoverBackgroundColor: ['#8B0000', '#FF8C00', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontFamily: 'sans-serif',
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });

    //Call Popup Event Info
    const $popup = $('.popup');
    const $tabControl = $('.popup').find('.tab-control');
    const $tabContent = $('.popup').find('.tab-wrapper');

    $('.call-popup').click(function(){
        let finder_id = $(this).data('finder_id');
        let target_id = $(this).data('target_id');
        $.ajax({
            method: 'GET',
            url: '<?php echo base_url("admin/event/get_matching_info") ?>',
            data: {
                finder_id: finder_id, target_id: target_id
            },
            success: function(res){
                result = JSON.parse(res);
                if (result.status == 200) {
                    $('#company-finder').text(result.data.finder.company);
                    $('#address-finder').text(result.data.finder.address);
                    $('#connector-finder').text(result.data.finder.connector);
                    $('#position-finder').text(result.data.finder.position);
                    $('#email-finder').text(result.data.finder.email);
                    $('#phone-finder').text(result.data.finder.phone);
                    if (result.data.finder.file != null && result.data.finder.file != '') {
                        link_finder = '<a href="<?php echo base_url('assets/upload/profile/') ?>'+ result.data.finder.file +'" download>Download</a>';
                        $('#file-finder').html(link_finder);
                    }
                    

                    $('#overview-finder').html(result.data.finder.overview);
                    $('#profile-finder').html(result.data.finder.profile);

                    html_finder = '';
                    if (result.data.finder.category.length > 0) {
                        html_finder += '<ul class="list-group">';
                        result.data.finder.category.forEach(function(value, key){
                            html_finder += '<li class="list-group-item" style="background: #85a0ef; color: white"><i class="fas fa-bullseye"></i> '+ value.name +'</li>'
                            value.sub.forEach(function(item, index){
                                html_finder += '<li class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;↳ '+ item.name +'</li>';
                            });
                        });
                        html_finder += '</ul';
                    }else{
                        html_finder = 'Doanh nghiệp chưa chọn tiêu chí';
                    }
                    $('#category-finder .show').html(html_finder);

                    $('#company-target').text(result.data.target.company);
                    $('#address-target').text(result.data.target.address);
                    $('#connector-target').text(result.data.target.connector);
                    $('#position-target').text(result.data.target.position);

                    $('#email-target').text(result.data.target.email);
                    $('#phone-target').text(result.data.target.phone);
                    if (result.data.target.file != null && result.data.target.file != '') {
                        link_target = '<a href="<?php echo base_url('assets/upload/profile/') ?>'+ result.data.target.file +'" download>Download</a>';
                        $('#file-target').html(link_target);
                    }

                    $('#overview-target').html(result.data.target.overview);
                    $('#profile-target').html(result.data.target.profile);

                    html_target = '';
                    if (result.data.target.category.length > 0) {
                        html_target += '<ul class="list-group">';
                        result.data.target.category.forEach(function(value, key){
                            html_target += '<li class="list-group-item" style="background: #85a0ef; color: white"><i class="fas fa-bullseye"></i> '+ value.name +'</li>'
                            value.sub.forEach(function(item, index){
                                html_target += '<li class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;↳ '+ item.name +'</li>';
                            });
                        });
                        html_target += '</ul';
                    }else{
                        html_target = 'Doanh nghiệp chưa chọn tiêu chí';
                    }
                    $('#category-target .show').html(html_target);
                    $popup.addClass('show');

                    statePopupDefault();//Reset to Default Popup State

                    selectTab();
                    closePopup(); //Close Popup
                }else{
                    alert('Không tồn tại finder hoặc target');
                }
            }
        });
    });

    function selectTab(){
        const $btn = $tabControl.find('a.tab');

        $btn.each(function(){
            $(this).on('click', function(e){
                e.preventDefault();

                //Indentify Tab
                let tabTarget = $(this).data('tab');

                $btn.removeClass('active'); //Reset Tab Actived
                $tabControl.find('a[data-tab="' + tabTarget + '"]').addClass('active'); //Indetify Clicked Tab

                //Show Selected Tab Content
                $tabContent.find('.tab-inner').removeClass('show');
                $tabContent.find('.tab-inner[data-tab-content="' + tabTarget + '-content"]').addClass('show');
            })
        })
    }

    function closePopup(){
        const $btnClose = $('.popup').find('.popup-close');

        $btnClose.on('click', function(){
            $(this).closest('.popup').removeClass('show');
        })
    }

    function statePopupDefault(){
        const $btn = $tabControl.find('a.tab');

        $btn.removeClass('active'); //Reset Tab Actived
        $tabControl.find('a:first-child').addClass('active'); //Indetify Clicked Tab

        //Show Selected Tab Content
        $tabContent.find('.tab-inner').removeClass('show');
        $tabContent.find('.tab-inner:first-child').addClass('show');
    }

</script>
<!-- /.container-fluid -->


