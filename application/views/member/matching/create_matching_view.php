
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin đối tác</h6>
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Doanh nghiệp </a> <p class="pull-right"><?php echo $result['company'] ?></p>
                        </li>
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Người đại diện </a> <p class="pull-right"><?php echo $result['connector'] ?></p>
                        </li>
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Chức danh	</a> <p class="pull-right"><?php echo $result['position'] ?></p>
                        </li>
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Địa chỉ </a> <p class="pull-right"><?php echo $result['address'] ?></p>
                        </li>
                        <li class="list-group-item">
                            <a><i class="fa fa-money margin-r-5"></i> Số điện thoại </a> <p class="pull-right"><?php echo $result['phone'] ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Yêu cầu gặp</h6>
                    <div class="dropdown no-arrow">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class='col-sm-12'>
                            <form>
                                <div class="form-group">
                                    <label>Thời gian</label>
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label>Ghi chú</label>
                                    <textarea class="form-control" rows="10"></textarea>
                                </div>
                                <br>
                                <button type="button" class="btn btn-primary btn-large">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Gửi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Main Content -->
</div>



<script type="text/javascript">

    $(function () {
        $('#datetimepicker').datetimepicker({
            stepping: 30,
            enabledHours: [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
        });
    });

</script>

