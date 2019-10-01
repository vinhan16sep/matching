<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($this->uri->segment(1) != 'admin'): ?>
                        <?php if ($this->session->flashdata('message_error')): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> <?= $this->lang->line('thongbao'); ?>!</h4>
                                <?php echo $this->session->flashdata('message_error'); ?>
                            </div>
                        <?php endif ?>
                        <?php if ($temp_register['is_saved'] == 1): ?>
                            <a href="<?php echo base_url('member/information/edit/' . $temp_register['id']) ?>" class="btn btn-primary"><?= $this->lang->line('chinhsua') ?></a>
                        <?php endif ?>
                    <?php endif ?>
                    
                    
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"  style="min-height: 500px">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <strong>Logo: </strong><br>
                                            <?php  if(!empty($temp_register['logo'])){ ?>
                                                <img src="<?php echo base_url('assets/upload/profile/' . $temp_register['logo']);  ?>" width="100%">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url('assets/img/no-image.jpg');  ?>" width="100%">
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-8">
                                            <strong><?= $this->lang->line('profiledn') ?>: </strong>
                                            <?php if (!empty($temp_register['file'])): ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url('assets/upload/profile/') . $temp_register['file'] ?>" download> <?= $this->lang->line('taive') ?></a>
                                                <embed src="<?= base_url('assets/upload/profile/' . $temp_register['file']) ?>" style="width:100%; height: 200%" />
                                            <?php else: ?>
                                                &nbsp; <?= $this->lang->line('chuacofile') ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6><?= $this->lang->line("Overview of Company/ Organization") ?></h6>
                                </div>
                                
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line("Company name"); ?>: </strong><br>
                                        <?php echo $temp_register['company'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('Is your company/ organization providing or applying IT?'); ?> </strong><?php echo ($temp_register['is_state'] == 1) ? '<i style="color: green" class="fa fa-check" aria-hidden="true"></i>' : '<i style="color: red" class="fa fa-times" aria-hidden="true"></i>'; ?><br>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line("Address (Vietnamese)") ?>: </strong><br>
                                        <?php echo $temp_register['address'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line("Address (English)") ?>: </strong><br>
                                        <?php echo $temp_register['address_en'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Website: </strong><br>
                                        <a href="<?php echo $temp_register['website'] ?>" target="_blank"><?php echo $temp_register['website'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line("sonhanluc") ?>: </strong><br>
                                        <?php echo $temp_register['manpower'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('doanhthunam') ?> 2018: </strong><br>
                                        <?php echo $temp_register['revenue'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('Product/Solution (Vietnamese name)'); ?>: </strong><br>
                                        <?php echo $temp_register['product'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('Product/Solution (English name)') ?> </strong><br>
                                        <?php echo $temp_register['product_en'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('Field of operation (Vietnamese)') ?> </strong><br>
                                        <?php echo $temp_register['profile'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('Field of operation (English)') ?> </strong><br>
                                        <?php echo $temp_register['profile_en'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('Targeted markets (Vietnamese)') ?> </strong><br>
                                        <?php echo $temp_register['market'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('Targeted markets (English)') ?> </strong><br>
                                        <?php echo $temp_register['market_en'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('Legal Representative') ?> </strong><br>
                                        <?php echo $temp_register['connector'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>E-Mail: </strong><br>
                                        <?php echo $temp_register['email'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong><?= $this->lang->line('Mobile') ?> </strong><br>
                                        <?php echo $temp_register['phone'] ?>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php if ($this->uri->segment(1) != 'admin'): ?>
                <a href="<?php echo base_url('member/setting') ?>" class="btn btn-primary" style="float: right;">
                    <?= $this->lang->line('Event list') ?>
                    <i class="fas fa-chevron-right"></i>
                </a>
            <?php endif ?>
        </div>
    </div>
</div>