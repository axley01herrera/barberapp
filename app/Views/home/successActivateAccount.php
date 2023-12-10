<!DOCTYPE html>
<html>
<head>
    <title><?php echo $profile[0]->companyName; ?></title>
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
</head>

<body id="kt_app_body" data-kt-app-layout="dark-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <script>
        var themeMode = "<?php echo $config[0]->theme; ?>";
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('<?php echo base_url('public/assets/media/auth/bg1.jpg'); ?>');
            }

            [data-bs-theme="dark"] body {
                background-image: url('<?php echo base_url('public/assets/media/auth/bg1-dark.jpg'); ?>');
            }
        </style>
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <div class="d-flex flex-column flex-center text-center p-10">
                <div class="card card-flush w-lg-650px py-5">
                    <div class="card-body py-15 py-lg-20">
                        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4"><?php echo lang('Text.thanks'); ?></h1>
                        <div class="fw-semibold fs-6 text-gray-500 mb-7"><?php echo lang('Text.success_verified_email'); ?></div>
                        <div class="mb-3">
                            <img src="<?php echo base_url('public/assets/media/auth/ok.png'); ?>" class="mw-100 mh-300px theme-light-show" alt="" />
                            <img src="<?php echo base_url('public/assets/media/auth/ok-dark.png'); ?>" class="mw-100 mh-300px theme-dark-show" alt="" />
                        </div>
                        <div class="mb-0">
                            <a href="<?php echo base_url('/'); ?>" class="btn btn-sm btn-primary"><?php echo lang('Text.btn_home'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>