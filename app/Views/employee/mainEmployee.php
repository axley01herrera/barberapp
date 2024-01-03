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
                confirmButtonText: "<?php echo lang('Text.ok_label'); ?>",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }

        function globalError() {
            Swal.fire({
                text: "<?php echo lang('Text.error_label_msg'); ?>",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "<?php echo lang('Text.ok_label'); ?>",
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
                        <img alt="Logo" src="<?php echo base_url('public/assets/media/logos/logoWhite.png'); ?>" class="h-20px h-lg-30px app-sidebar-logo-default" />
                    </div>
                    <!-- Menu -->
                    <?php echo view('employee/employeeMenu'); ?>
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