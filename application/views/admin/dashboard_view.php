<!-- Begin Page Content -->
<div class="container-fluid" id="dashboard-admin">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tổng quan</h1>
        <!--    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pending ...</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0000000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pending ...</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0000000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending ...</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0000000</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending ...</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0000000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Đăng ký mới nhất</h6>
                    <div class="dropdown no-arrow">
                        <a title="Xem toàn bộ" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-arrow-alt-circle-right text-primary"></i>
                        </a>
                        <!--            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">-->
                        <!--              <div class="dropdown-header">Dropdown Header:</div>-->
                        <!--              <a class="dropdown-item" href="#">Action</a>-->
                        <!--              <a class="dropdown-item" href="#">Another action</a>-->
                        <!--              <div class="dropdown-divider"></div>-->
                        <!--              <a class="dropdown-item" href="#">Something else here</a>-->
                        <!--            </div>-->
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sự kiện</h6>
                    <div class="dropdown no-arrow">
                        <a title="Xem toàn bộ" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-arrow-alt-circle-right text-primary"></i>
                        </a>
                        <!--            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">-->
                        <!--              <div class="dropdown-header">Dropdown Header:</div>-->
                        <!--              <a class="dropdown-item" href="#">Action</a>-->
                        <!--              <a class="dropdown-item" href="#">Another action</a>-->
                        <!--              <div class="dropdown-divider"></div>-->
                        <!--              <a class="dropdown-item" href="#">Something else here</a>-->
                        <!--            </div>-->
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-danger"></i> Đã kết thúc
            </span>
                        <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Đang diễn ra
            </span>
                        <span class="mr-2">
              <i class="fas fa-circle text-warning"></i> Sắp tới
            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="call-popup" style="position: fixed; top: 50%; right: 0; z-index: 100">
        Call popup, delete when use
    </button>

    <div class="popup" id="matchingInfo">
        <button type="button" class="popup-close">
            <i class="fas fa-times"></i>
        </button>

        <div class="popup-content">
            <div class="item left">
                <div class="item-header">
                    <h6>
                        Company
                    </h6>
                </div>

                <div class="item-content">
                    <div class="tab-control">
                        <a href="#" class="tab active" data-tab="tab-info">
                            Thong tin
                        </a>
                        <a href="#" class="tab" data-tab="tab-category">
                            Tieu chi
                        </a>
                        <a href="#" class="tab" data-tab="tab-overview">
                            Tong quat
                        </a>
                        <a href="#" class="tab" data-tab="tab-profile">
                            Ho so
                        </a>
                    </div>

                    <div class="tab-wrapper">
                        <div class="tab-inner show" data-tab-content="tab-info-content">
                            1
                        </div>
                        <div class="tab-inner" data-tab-content="tab-category-content">
                            2
                        </div>
                        <div class="tab-inner" data-tab-content="tab-overview-content">
                            3
                        </div>
                        <div class="tab-inner" data-tab-content="tab-profile-content">
                            4
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
                        Target
                    </h6>
                </div>

                <div class="item-content">
                    <div class="tab-control">
                        <a href="#" class="tab active" data-tab="tab-info">
                            Thong tin
                        </a>
                        <a href="#" class="tab" data-tab="tab-category">
                            Tieu chi
                        </a>
                        <a href="#" class="tab" data-tab="tab-overview">
                            Tong quat
                        </a>
                        <a href="#" class="tab" data-tab="tab-profile">
                            Ho so
                        </a>
                    </div>

                    <div class="tab-wrapper">
                        <div class="tab-inner show" data-tab-content="tab-info-content">
                            1
                        </div>
                        <div class="tab-inner" data-tab-content="tab-category-content">
                            2
                        </div>
                        <div class="tab-inner" data-tab-content="tab-overview-content">
                            3
                        </div>
                        <div class="tab-inner" data-tab-content="tab-profile-content">
                            4
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    const $popup = $('.popup');
    const $tabControl = $('.popup').find('.tab-control');
    const $tabContent = $('.popup').find('.tab-wrapper');

    $('.call-popup').click(function(){
        let id = $(this).data('id');
        $.ajax({
            method: 'GET',
            url: '',
            data: {
                id: id,
            },
            success: function(){
                $popup.addClass('show');

                statePopupDefault();//Reset to Default Popup State

                selectTab();
                closePopup(); //Close Popup
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


