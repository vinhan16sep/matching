<!-- Begin Page Content -->
<div class="container-fluid">

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

<!--    <div class="col-xl-3 col-md-6 mb-4">-->
<!--      <div class="card border-left-info shadow h-100 py-2">-->
<!--        <div class="card-body">-->
<!--          <div class="row no-gutters align-items-center">-->
<!--            <div class="col mr-2">-->
<!--              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending ...</div>-->
<!--              <div class="row no-gutters align-items-center">-->
<!--                <div class="col-auto">-->
<!--                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0000000</div>-->
<!--                </div>-->
<!--                <div class="col">-->
<!--                  <div class="progress progress-sm mr-2">-->
<!--                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="col-auto">-->
<!--              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-xl-3 col-md-6 mb-4">-->
<!--      <div class="card border-left-warning shadow h-100 py-2">-->
<!--        <div class="card-body">-->
<!--          <div class="row no-gutters align-items-center">-->
<!--            <div class="col mr-2">-->
<!--              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending ...</div>-->
<!--              <div class="h5 mb-0 font-weight-bold text-gray-800">0000000</div>-->
<!--            </div>-->
<!--            <div class="col-auto">-->
<!--              <i class="fas fa-comments fa-2x text-gray-300"></i>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
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
            <a title="Xem toàn bộ" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
</script>
<!-- /.container-fluid -->


