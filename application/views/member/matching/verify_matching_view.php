<!-- Begin Page Content -->

<div class="container-fluid" id="dashboard-member">
    <div class="card shadow mb-4">
        <div class="card-body" >
            <div>
                <?php if($setting['status'] == 0){ ?>
                    <p><?= $this->lang->line('You have not active the finding mode for this event. Please send a request to Vinasa to active') ?></p>
                    <a class="btn btn-primary" href="javascript:void(0);" onclick="activeEvent('<?php echo $event_id; ?>')" data-remote="false" data-toggle="modal" data-target="#myModal"><?= $this->lang->line('Active the event') ?></a>
                <?php } else { ?>
                    <p><?= $this->lang->line('bandakichhoat') ?></p>
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
        if(confirm("<?= $this->lang->line('bancochacchan') ?>")){
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
                        var message = '<?= $this->lang->line('emailchitiet') ?> <a href="mailto:' + email + '">' + email + '</a>';
                        if (code != 'free') {
                            message += '<p><?= $this->lang->line('makichhoat') ?>: <span style="color: red;">' + code + '</span></p>';
                            message += '<?= $this->lang->line('haylamtheohuongdan') ?>';
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


