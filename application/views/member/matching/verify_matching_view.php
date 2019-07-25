<!-- Begin Page Content -->

<div class="container-fluid" id="dashboard-member">
    <div class="card shadow mb-4">
        <div class="card-body" >
            <div>
                <?php if($setting['status'] == 0){ ?>
                    <p>Bạn chưa kích hoạt chức năng tìm kiếm cho sự kiện này. Vui lòng gửi yêu cầu đến cho Vinasa để kích hoạt sự kiện</p>
                    <a class="btn btn-primary" href="javascript:void(0);" onclick="activeEvent('<?php echo $event_id; ?>')" data-remote="false" data-toggle="modal" data-target="#myModal">Kích hoạt sự kiện</a>
                <?php } else { ?>
                    <p>Bạn đã gửi yêu cầu kích hoạt cho sự kiện này, vui lòng làm theo hướng dẫn (đã gửi trong email) và đợi phản hồi từ Vinasa.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function activeEvent(event_id){
        if(confirm("Bạn có chắc chắn kích hoạt cho sự kiện này?")){
            $.ajax({
                method: 'GET',
                url: '<?php echo base_url('member/matching/active') ?>',
                data: {
                    event_id: event_id
                },
                success: function(res){
                    var data = JSON.parse(res);
                    // console.log(data);
                    if(data.message == 1){
                        var code = data.code;
                        var email = data.email;
                        var message = 'Email chi tiết đã được gửi về địa chỉ <a href="mailto:' + email + '">' + email + '</a>';
                        if (code != 'free') {
                            message += '<p>Mã kích hoạt là: <span style="color: red;">' + code + '</span></p>';
                            message += 'Hãy làm theo hướng dẫn trong email để tiếp tục tham gia sự kiện';
                        }

                        $(".modal-body").html(message);
                        $('#myModal').on('hidden.bs.modal', function () {
                            window.location.reload();
                        });
                    }else if(data.message != 1 && data.message != 0){
                        $(".modal-body").html(data.message);
                    }else{
                        window.location.reload();
                    }
                },
                error: function(){

                }
            });
        }else{
            window.location.reload();
        }
    }
</script>


