<!DOCTYPE html>
<html>

<head>
    <title><?php echo $profile[0]->company_name; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Assets -->
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="<?php echo base_url('public/assets/media/logos/favicon.ico'); ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?php echo base_url('public/assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/css/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('public/assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />

    <script>
        var hostUrl = "<?php echo base_url('public/assets/'); ?>";
    </script>
    <script src="<?php echo base_url('public/assets/plugins/global/plugins.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/scripts.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/widgets.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/custom/widgets.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/plugins/global/plugins.bundle.js'); ?>"></script>

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
    </script>
</head>
<body id="kt_app_body" data-kt-app-layout="dark-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <script>
        var themeMode = "<?php echo $config[0]->theme; ?>";    
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    </script>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--Header-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <?php echo view($page); ?>
                </div>
            </div>
            <!-- Footer -->
            <div id="kt_app_footer" class="app-footer">
                <div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-semibold me-1">2023&copy;</span>
                        <a href="" target="_blank" class="text-gray-800 text-hover-primary"><?php echo DEVELOPER; ?></a>
                    </div>
                    <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                        <li class="menu-item">
                            <a href="" target="_blank" class="menu-link px-2"><?php echo lang('Text.footer_contact_support'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>