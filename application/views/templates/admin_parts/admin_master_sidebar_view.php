<?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('admin')): ?>
<!-- Sidebar -->
<?php if($user_email != PIKOM): ?>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/dashboard/') ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-link"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Matching Admin <sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('admin/dashboard/index') ?>" aria-expanded="true">
                <i class="fas fa-fw fa-tachometer-alt" aria-hidden="true"></i>
                <span>Thông tin chung</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('admin/users/index_member/2') ?>" aria-expanded="true">
                <i class="fas fa-fw fa-users" aria-hidden="true"></i>
                <span>Tài khoản</span>
            </a>
        </li>
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <span>Danh sách sự kiện</span>
            </a>
            <div id="collapseZero" class="collapse" aria-labelledby="headingZero" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if($active_event) {
                        foreach ($active_event as $key => $event) {
                            ?>
                            <a class="collapse-item" href="<?php echo base_url('admin/event/detail/' . $event['id']) ?>">
                                <?php echo $event['name'] ?>
                            </a>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Chức năng
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <span>Cấu hình</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Quản lý <br>sự kiện & danh mục</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/event/index') ?>">
                        <i class="fa fa-list" aria-hidden="true"></i> &nbsp;&nbsp;
                        Danh sách
                    </a>
                    <a class="collapse-item" href="<?php echo base_url('admin/event/create') ?>">
                        <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;
                        Tạo mới
                    </a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-file-text"></i>
                <span>Đơn đăng ký</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Các trạng thái</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/request/index') ?>">
                        <i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;&nbsp;
                        Chưa duyệt
                    </a>
                    <a class="collapse-item" href="<?php echo base_url('admin/request/approved') ?>">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp;&nbsp;
                        Đã duyệt
                    </a>
                    <a class="collapse-item" href="#">
                        <i class="fa fa-ban" aria-hidden="true"></i> &nbsp;&nbsp;
                        Đã huỷ
                    </a>
                </div>
            </div>
        </li>

        <!-- Divider -->

        <!-- Heading -->


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
    <!--    <div class="text-center d-none d-md-inline">-->
    <!--        <button class="rounded-circle border-0" id="sidebarToggle"></button>-->
    <!--    </div>-->

    </ul>
<?php else: ?>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/dashboard/') ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-link"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Matching Admin <sup></sup></div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('admin/dashboard/index') ?>" aria-expanded="true">
                <i class="fas fa-fw fa-tachometer-alt" aria-hidden="true"></i>
                <span>Thông tin chung</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin/event/detail/12') ?>" aria-expanded="true">
                <span>ASOCIO - PIKOM Digital Summit 2019</span>
            </a>
        </li>
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-file-text"></i>
                <span>Đơn đăng ký</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Các trạng thái</h6>
                    <a class="collapse-item" href="<?php echo base_url('admin/request/index') ?>">
                        <i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;&nbsp;
                        Chưa duyệt
                    </a>
                    <a class="collapse-item" href="<?php echo base_url('admin/request/approved') ?>">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp;&nbsp;
                        Đã duyệt
                    </a>
                    <a class="collapse-item" href="#">
                        <i class="fa fa-ban" aria-hidden="true"></i> &nbsp;&nbsp;
                        Đã huỷ
                    </a>
                </div>
            </div>
        </li>

        <!-- Divider -->

        <!-- Heading -->


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <!--    <div class="text-center d-none d-md-inline">-->
        <!--        <button class="rounded-circle border-0" id="sidebarToggle"></button>-->
        <!--    </div>-->

    </ul>
<?php endif; ?>
<!-- End of Sidebar -->
<?php endif; ?>