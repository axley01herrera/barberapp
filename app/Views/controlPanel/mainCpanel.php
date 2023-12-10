<!DOCTYPE html>
<html>

<head>
    <title><?php echo $companyProfile[0]->companyName; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Assets CSS -->
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="<?php echo base_url('public/assets/media/logos/favicon.ico'); ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?php echo base_url('public/assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/css/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/custom/datatables/datatables.bundle.css'); ?>" rel="stylesheet" type="text/css" />

    <style>
        .dt-vertical-align {
            vertical-align: middle;
        }
    </style>

    <script>
        var hostUrl = "<?php echo base_url('public/assets/'); ?>";
    </script>
    <!-- Assets JS -->
    <script src="<?php echo base_url('public/assets/plugins/global/plugins.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/scripts.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/widgets.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/custom/widgets.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/plugins/global/plugins.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/custom/datatables/datatables.bundle.js'); ?>"></script>

    <script>
        function simpleAlert(text, icon) {
            Swal.fire({
                text: text,
                icon: icon,
                buttonsStyling: false,
                confirmButtonText: "<?php echo lang('Text.ok'); ?>",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }

        function globalError() {
            Swal.fire({
                text: "<?php echo lang('Text.error_msg'); ?>",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "<?php echo lang('Text.ok'); ?>",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }

        function simpleSuccessAlert(text) {
            Swal.fire({
                position: "top-end",
                text: text,
                icon: "success",
                buttonsStyling: false,
                showConfirmButton: false,
                timer: 2000,
            });
        }
    </script>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <script>
        var themeMode = "<?php echo $config[0]->theme; ?>";
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    </script>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!-- Page -->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!-- Header -->
            <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
                <!-- Header container -->
                <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
                    <!--Logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
                        <img alt="Logo" src="<?php echo base_url('public/assets/media/logos/default-dark.svg'); ?>" class="h-20px h-lg-30px app-sidebar-logo-default" />
                    </div>
                    <!-- Header wrapper -->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
                        <!-- Menu wrapper -->
                        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                            <!-- Menu -->
                            <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                                <!-- Dashboard -->
                                <a href="<?php echo base_url('ControlPanel/dashboard'); ?>" class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                    <span class="menu-link <?php echo @$activeDashboard; ?>">
                                        <span class="menu-title"><?php echo lang('Text.top_bar_dashboard'); ?></span>
                                    </span>
                                </a>
                                <!-- Services -->
                                <a href="<?php echo base_url('ControlPanel/services'); ?>" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <span class="menu-link <?php echo @$activeServices; ?>">
                                        <span class="menu-title"><?php echo lang('Text.top_bar_services'); ?></span>
                                    </span>
                                </a>
                                <!-- Customers -->
                                <a href="<?php echo base_url('ControlPanel/customers'); ?>" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <span class="menu-link <?php echo @$activeCustomers; ?>">
                                        <span class="menu-title"><?php echo lang('Text.top_bar_customers'); ?></span>
                                    </span>
                                </a>
                                <!-- Employees -->
                                <a href="<?php echo base_url('ControlPanel/employees'); ?>" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <span class="menu-link <?php echo @$activeEmployees; ?>">
                                        <span class="menu-title"><?php echo lang('Text.top_bar_employees'); ?></span>
                                    </span>
                                </a>
                                <!-- Profile -->
                                <a href="<?php echo base_url('ControlPanel/profile'); ?>" class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <span class="menu-link <?php echo @$activeProfile; ?>">
                                        <span class="menu-title"><?php echo lang('Text.top_bar_profile'); ?></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <!-- Navbar -->
                        <div class="app-navbar flex-shrink-0">
                            <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                                <a href="<?php echo base_url('Home/controlPanelAuth'); ?>" class="btn btn-sm btn-danger"><?php echo lang('Text.top_bar_logout'); ?></a>
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
                </div>
            </div>
            <div id="app-modal"></div>
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <?php echo view($page); ?>
                </div>
            </div>
            <!-- Footer -->
            <div id="kt_app_footer" class="app-footer">
                <div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">&copy;</span>
                        <a href="<?php echo DEVELOPER_URL; ?>" target="_blank" class="text-gray-800 text-hover-primary"><?php echo DEVELOPER; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>