<div class="container-fluid">
	
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
        	<div class="row">
			    <!-- Earnings (Monthly) Card Example -->
			    <div class="col-xl-3 col-md-6 mb-4">
			        <div class="card border-left-primary shadow h-100 py-2">
			            <div class="card-body">
			                <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                        <a href="<?= base_url('member/setting') ?>"><div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $this->lang->line('Registered Events'); ?></div></a>
			                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_registered ?></div>
			                    </div>
			                    <div class="col-auto">
			                        <i class="far fa-calendar-check fa-2x text-gray-300"></i>
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
			                        <a href="<?= base_url('member/setting/event') ?>"><div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?= $this->lang->line('Unregistered Events'); ?></div></a>
			                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_unregistered ?></div>
			                    </div>
			                    <div class="col-auto">
			                        <i class="far fa-calendar-plus fa-2x text-gray-300"></i>
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
			                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Matching</div>
			                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($list_event_of_current_user) ? count($list_event_of_current_user) : 0 ?></div>
			                    </div>
			                    <div class="col-auto">
			                        <i class="fas fa-handshake fa-2x text-gray-300"></i>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
        	<div class="row">
        		<h4>Hướng Dẫn</h4>
                <?php
                if($this->session->userdata('langAbbreviation') == 'vi') {
                ?>
                    <img src="<?= base_url('assets/img/banner_huong_dan.jpg') ?>" width="100%">
                <?php
                }else{
                ?>
                    <img src="<?= base_url('assets/img/banner_huong_dan_en.png') ?>" width="100%">
                <?php
                }
                ?>
        	</div>
        </div>
    </div>
    
</div>