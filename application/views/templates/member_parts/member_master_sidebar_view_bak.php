<?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('members')): ?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-link"></i>
            </div>
            <div class="sidebar-brand-text mx-3"> BMO Personal Page <sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('member/dashboard/index') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span><?= $this->lang->line('General Information'); ?></span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            <?= $this->lang->line('Operator'); ?>
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('member/information') ?>">
                <i class="fas fa-id-badge"></i>
                <span><?= $this->lang->line('Company | Organization Information'); ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span><?= $this->lang->line('Event'); ?></span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if($is_temp_register){ ?>
                        <a class="collapse-item" href="<?php echo base_url('member/setting/event'); ?>">
                            <span><?= $this->lang->line('Unregistered'); ?></span>
                        </a>
                        <a class="collapse-item" href="<?php echo base_url('member/setting'); ?>">
                            <span><?= $this->lang->line('Registered'); ?></span>
                        </a>
                    <?php }else{ ?>
                        <a class="collapse-item" href="<?php echo base_url('member/information'); ?>">
                            <span><?= $this->lang->line('Information of company is required to show this function'); ?></span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-cog"></i>
                <span>Matching</span>
            </a>

            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if($is_temp_register){ ?>
                        <h6 class="collapse-header"><?= $this->lang->line('Event'); ?></h6>
                        <?php if($list_event_of_current_user){ ?>
                            <?php foreach($list_event_of_current_user as $key => $event){ ?>
                                <a class="collapse-item" href="<?php echo base_url('member/matching/index?event_id=' . $event['eventId']) ?>">
                                    <?php echo $event['eventName']; ?>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    <?php }else{ ?>
                        <a class="collapse-item" href="<?php echo base_url('member/information'); ?>">
                            <span><?= $this->lang->line('Information of company is required to show this function'); ?></span>
                        </a>
                    <?php } ?>
                </div>
            </div>



<!--            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">-->
<!--                <div class="bg-white py-2 collapse-inner rounded">-->
<!--                    <a class="collapse-item" href="--><?php //echo base_url('member/matching/find') ?><!--">Tìm đối tác</a>-->
<!--                </div>-->
<!--            </div>-->
        </li>
        <hr>
        <li class="nav-item" style="padding-left: 5px; padding-right: 5px;">
            <a class="btn btn-warning" href="javascript:void(0);" data-toggle="modal" data-target="#workflow-guide">
                <i class="fa fa-book" aria-hidden="true"></i>
                <?= $this->lang->line('System Support'); ?>
            </a>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item" href="utilities-color.html">Colors</a>
                    <a class="collapse-item" href="utilities-border.html">Borders</a>
                    <a class="collapse-item" href="utilities-animation.html">Animations</a>
                    <a class="collapse-item" href="utilities-other.html">Other</a>
                </div>
            </div>
        </li> -->

        <!-- Divider -->
        <!-- <hr class="sidebar-divider"> -->

        <!-- Heading -->
        <!-- <div class="sidebar-heading">
            Addons
        </div> -->

        <!-- Nav Item - Pages Collapse Menu -->
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item" href="login.html">Login</a>
                    <a class="collapse-item" href="register.html">Register</a>
                    <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>
                </div>
            </div>
        </li> -->

        <!-- Nav Item - Charts -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li> -->

        <!-- Nav Item - Tables -->
        <!-- li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li> -->
        <!-- Divider -->

        <!-- Sidebar Toggler (Sidebar) -->
        <!--    <div class="text-center d-none d-md-inline">-->
        <!--        <button class="rounded-circle border-0" id="sidebarToggle"></button>-->
        <!--    </div>-->

    </ul>
    <!-- End of Sidebar -->

    <div id="workflow-guide" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" style="max-width:80%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
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
<?php endif; ?>