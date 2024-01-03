<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
    <!-- Menu wrapper -->
    <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">

        <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">

            <!-- Dashboard -->
            <a href="<?php echo base_url('Employee/dashboard'); ?>" class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                <span class="menu-link <?php echo @$activeDashboard; ?>">
                    <span class="menu-title"><?php echo lang('Text.dashboard'); ?></span>
                </span>
            </a>

            <!-- Appointments -->
            <a href="<?php echo base_url('Employee/appointment'); ?>" class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                <span class="menu-link <?php echo @$activeAppointment; ?>">
                    <span class="menu-title"><?php echo lang('Text.appointments_label'); ?></span>
                </span>
            </a>

            <!-- Services -->
            <a href="<?php echo base_url('Employee/services'); ?>" class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                <span class="menu-link <?php echo @$activeServices; ?>">
                    <span class="menu-title"><?php echo lang('Text.top_bar_services'); ?></span>
                </span>
            </a>

            <!-- Times -->
            <a href="<?php echo base_url('Employee/times'); ?>" class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                <span class="menu-link <?php echo @$activeTimes; ?>">
                    <span class="menu-title"><?php echo lang('Text.top_bar_times'); ?></span>
                </span>
            </a>

            <!-- Account -->
            <a href="<?php echo base_url('Employee/account'); ?>" class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                <span class="menu-link <?php echo @$activeAccount; ?>">
                    <span class="menu-title"><?php echo lang('Text.account'); ?></span>
                </span>
            </a>

        </div>
    </div>
    <!-- Navbar -->
    <div class="app-navbar flex-shrink-0">
        <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
            <a href="<?php echo base_url('Home/signInEmployee'); ?>" class="btn btn-sm btn-danger"><?php echo lang('Text.top_bar_logout'); ?></a>
        </div>
        <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
            <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">
                <i class="ki-duotone ki-element-4 fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
    </div>
</div>