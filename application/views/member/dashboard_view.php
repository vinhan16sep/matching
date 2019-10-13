<style>
	.border-left-success{
		border-left: .25rem solid #1cc88a!important;
	}
	.border-left-success.errors{
		border-left: .25rem solid red!important;
	}
</style>
<div class="container-fluid">
    <!-- DataTales Example -->
    	
	<?php if (!empty($events)): ?>
		<div class="card shadow mb-4">
    		<div class="card-body">
			<h4 style="padding-bottom: 10px;"><?= $this->lang->line('Event'); ?></h4>
	        	<div class="row">
				    <!-- Earnings (Monthly) Card Example -->
				    <?php foreach ($events as $key => $value): ?>
					    <div class="col-xl-4 col-md-6 mb-4">
					    	<div class="card border-left-success <?php echo (in_array($value['id'],$events_active)) ? '' : 'errors'; ?> shadow h-100 py-2">
					            <div class="card-body">
					                <div class="row no-gutters align-items-center">
										<h6 class="text-primary" style="font-weight: bold;">
											<a href="<?php echo (in_array($value['id'],$events_active)) ? base_url('member/matching/index?event_id=' . $value['id']) : base_url('member/setting/event'); ?>"><?php echo $value['name'] ?></a>
										</h6>
					                </div>
					                <hr>

					                <div class="row no-gutters align-items-center">
										<?php 
											echo (in_array($value['id'],$events_active)) ? 
												"<span>
													<a style='color:#1cc88a;font-weight:bold;' >".$this->lang->line('Registered')."</a>
												</span>" : "
												<span>
													<a style='color:red;font-weight:bold;' >".$this->lang->line('Unregistered')."</a>
												</span>"; ?>
					                </div>
					            </div>
					        </div>
					    </div>
					<?php endforeach ?>
				</div>
	        </div>
	    	
		<?php endif ?>
	</div>

    <div class="card shadow mb-4">
        <div class="card-body">
        	<div class="row">
        		<div class="col-xl-12">
	        		<h4><?= $this->lang->line('Guideline'); ?></h4>
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
    
</div>