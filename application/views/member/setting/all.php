<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Content Wrapper -->
<style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: 300px; /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    .error{
        color: red;
        position: relative;
        line-height: 1;
        width: 100%;
        font-size: 1rem !important;
    }
</style>
<style type="text/css">
    .zeroPadding {
        padding: 0 !important;
    }
</style>

<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead style="background: #4e73df; color: white">
                        <tr>
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center"><?= $this->lang->line("Event name") ?></th>
                            <th style="txt-aelign: center"><?= $this->lang->line("Time") ?></th>
                            <th style="text-align: center"><?= $this->lang->line("Status") ?></th>
                            <th style="text-align: center"><?= $this->lang->line("dangkysukien") ?></th>
                        </tr>
                    </thead>
                    <tbody id="event-add">
                        <?php if ($events): ?>
                            <?php foreach ($events as $key => $value): ?>
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
                                                echo '<span class="label label-default">'.$this->lang->line("chuadienra").'</span>';
                                            }
                                            if ($value['date'] >= now() && $value['is_active'] == 1) {
                                                echo '<span class="label label-success">'.$this->lang->line("dangdienra").'</span>';
                                            }
                                            if ($value['is_active'] != 1) {
                                                echo '<span class="label label-danger">'.$this->lang->line("hetsukien").'</span>';
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align: center" class="event-column-<?= $value['id'] ?>">
                                        <?php if ($value['reg_stt'] == 0): ?>
                                            <a href="javascript:void(0)" class="add-event" title="<?= $this->lang->line("Active the event") ?>" data-id="<?= $value['id'] ?>" data-name_event="<?= $value['name'] ?>"><?php echo $this->lang->line("dangky") ?></a>
                                        <?php else: ?>
                                            <span class="label label-success"> <?php echo $this->lang->line("dadangky") ?></span> / 
                                            <a class="collapse-item" href="<?php echo base_url('member/setting/update/' . $value['_setting_id'] . '?event_id=' . $value['id']) ?>">
                                                <span><?php echo $this->lang->line("thietlap") ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5"><?= $this->lang->line("khongcosukien") ?></td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
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

    $('#event-add').on('click', '.add-event', function(){
        var id = $(this).data('id');
        var name = $(this).data('name_event');
        var msg = '<?php echo $this->lang->line("confirmdangkysukien") ?>';
        if (confirm(msg)) {
            $.ajax({
                method: 'GET',
                url: '<?php echo base_url('member/setting/register') ?>',
                data: {
                    id: id, 
                    name: name
                },
                success: function(res){
                    var result = JSON.parse(res);
                    if(result.message == 1){
                        alert('<?= $this->lang->line("dangkythanhcong") ?>');
                        window.location.reload();
                    }else{
                        alert('<?= $this->lang->line("dangkykhongthanhcong") ?>');
                        window.location.reload();
                    }
                }
            });
        }

        
    });
</script>