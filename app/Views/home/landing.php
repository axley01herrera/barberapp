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
</head>

<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-body position-relative app-blank">
    <script>
        var themeMode = "<?php echo $config[0]->theme; ?>";
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    </script>
    <div id="landing-modal"></div>
    <div class="d-flex flex-column flex-root" id="kt_app_root">

        <!-- Home -->
        <div class="mb-0" id="home">
            <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url(assets/media/svg/illustrations/landing.svg)">
                <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <div class="container">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-equal">
                                <!-- Mobile menu toggle -->
                                <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
                                    <i class="ki-duotone ki-abstract-14 fs-2hx">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                                <!-- Logo -->
                                <a href="#">
                                    <img alt="Logo" src="<?php echo base_url('public/assets/media/logos/logoWhite.png'); ?>" class="logo-default h-25px h-lg-30px" />
                                    <img alt="Logo" src="<?php echo base_url('public/assets/media/logos/logoDark.png'); ?>" class="logo-sticky h-20px h-lg-25px" />
                                </a>
                            </div>
                            <!-- Menu -->
                            <div class="d-lg-block" id="kt_header_nav_wrapper">
                                <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                                    <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-600 menu-state-title-primary nav nav-flush fs-5 fw-semibold" id="kt_landing_menu">

                                        <!-- Home -->
                                        <div class="menu-item">
                                            <a class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                                <?php echo lang('Text.lp_menu_home'); ?>
                                            </a>
                                        </div>

                                        <!-- Services -->
                                        <div class="menu-item">
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#kt_serv" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                                <?php echo lang('Text.lp_menu_services'); ?>
                                            </a>
                                        </div>

                                        <!-- Team -->
                                        <div class="menu-item">
                                            <a class="menu-link nav-link  py-3 px-4 px-xxl-6" href="#kt_team" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                                <?php echo lang('Text.lp_menu_team'); ?>
                                            </a>
                                        </div>

                                        <!-- Galery -->
                                        <div class="menu-item">
                                            <a class="menu-link nav-link  py-3 px-4 px-xxl-6" href="#kt_galery" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                                <?php echo lang('Text.lp_menu_galery'); ?>
                                            </a>
                                        </div>

                                        <!-- About -->
                                        <div class="menu-item">
                                            <a class="menu-link nav-link  py-3 px-4 px-xxl-6" href="#kt_about" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                                <?php echo lang('Text.lp_menu_about'); ?>
                                            </a>
                                        </div>

                                        <!-- Contact -->
                                        <div class="menu-item">
                                            <a class="menu-link nav-link  py-3 px-4 px-xxl-6" href="#kt_contact" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                                <?php echo lang('Text.lp_menu_contact'); ?>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Sign In -->
                            <div class="flex-equal text-end ms-1">
                                <a href="<?php echo base_url('Home/signInCustomer'); ?>" class="btn btn-success"><?php echo lang('Text.btn_sign_in'); ?></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                    <div class="text-center mb-5 py-10 py-lg-20">
                        <!-- Title -->
                        <h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x"><?php echo lang("Text.lp_welcome"); ?>
                            <br /><?php echo lang('Text.lp_welcome_to'); ?>
                            <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                <span id="kt_landing_hero_text"><?php echo lang('Text.lp_welcome_a_online'); ?></span>
                            </span>
                        </h1>
                    </div>
                    <div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 mb-20" style="background: linear-gradient(90deg, #20AA3E 0%, #03A588 100%);">
                        <div class="my-2 me-5">
                            <div class="fs-1 fs-lg-2qx fw-bold text-white mb-2"><?php echo $companyProfile[0]->companyType . ' ' . $companyProfile[0]->companyName; ?>,
                                <span class="fw-normal"><?php echo lang('Text.lp_portal_online'); ?></span>
                            </div>
                            <div class="fs-6 fs-lg-5 text-white fw-semibold opacity-75"><?php echo lang('Text.lp_invite'); ?></div>
                        </div>
                        <!--Signup Customer -->
                        <a href="<?php echo base_url('Home/signUpCustomer'); ?>" class="btn btn-lg btn-outline border-2 text-white btn-outline-white flex-shrink-0 my-2"><?php echo lang('Text.btn_signup'); ?></a>
                    </div>
                </div>
            </div>
            <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
                <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>

        <!-- Services -->
        <div class="mt-20 mb-20">
            <div class="container">
                <div class="text-center mb-17">
                    <h3 class="fs-2hx text-dark mb-5" id="kt_serv" data-kt-scroll-offset="{default: 100, lg: 150}">
                        <?php echo lang('Text.lp_menu_services'); ?>
                    </h3>
                    <div class="fs-5 text-muted fw-bold">
                        <br />
                    </div>
                </div>
                <div class="row w-100 gy-10 mb-md-20">
                    <?php foreach ($services as $s) { ?>
                        <div class="col-md-4 px-5">
                            <div class="card-body py-9">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-7">
                                        <div class="d-flex flex-stack mb-6">
                                            <!-- Service Title-->
                                            <div class="flex-shrink-0 me-5">
                                                <span class="text-gray-800 fs-1 fw-bold"><?php echo $s->title; ?></span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                            <div class="d-flex align-items-center me-5 me-xl-13">
                                                <div class="symbol symbol-30px symbol-circle me-3">
                                                    <img src="<?php echo base_url('public/assets/media/icons/duotune/abstract/abs019.svg'); ?>" />
                                                </div>
                                                <div class="m-0">
                                                    <span class="fw-semibold text-gray-400 d-block fs-8"><?php echo lang('Text.cp_serv_time_minutes'); ?></span>
                                                    <span class="fw-bold text-gray-800 text-hover-primary fs-7"><?php echo $s->time; ?> m</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-30px symbol-circle me-3">
                                                    <img src="<?php echo base_url('public/assets/media/icons/duotune/finance/fin003.svg'); ?>" />
                                                </div>
                                                <div class="m-0">
                                                    <span class="fw-semibold text-gray-400 d-block fs-8"><?php echo lang('Text.cp_serv_price'); ?></span>
                                                    <span class="fw-bold text-gray-800 fs-7"><?php echo getMoneyFormat($config[0]->currency, $s->price); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <!-- Service Description -->
                                        <span class="fw-semibold text-gray-600 fs-6 mb-8 d-block"><?php echo $s->description; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Team -->
        <div class="mt-20 mb-20">
            <div class="pb-15 pt-18 landing-dark-bg">
                <div class="container">
                    <div class="text-center mt-15 mb-18" id="kt_team" data-kt-scroll-offset="{default: 100, lg: 150}">
                        <h3 class="fs-2hx text-white fw-bold mb-5"><?php echo lang('Text.lp_menu_team'); ?></h3>
                        <div class="fs-5 text-gray-700 fw-bold">
                            <br />
                        </div>
                    </div>
                    <div class="tns tns-default" style="direction: ltr">
                        <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true" data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev" data-tns-next-button="#kt_team_slider_next" data-tns-responsive="{1200: {items: 3}, 992: {items: 2}}">
                            <?php foreach ($team as $e) { ?>
                                <div class="text-center">
                                    <?php
                                    if (empty($e->avatar))
                                        $img = base_url('public/assets/media/avatars/blank.png');
                                    else
                                        $img = "data:image/png;base64," . base64_encode($e->avatar);
                                    ?>
                                    <div class="octagon mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url('<?php echo $img; ?>')"></div>
                                    <div class="mb-0">
                                        <a href="#" class="fw-bold fs-3 text-white-50"><?php echo $e->name . ' ' . $e->lastName; ?></a>
                                        <div class="text-muted fs-6 fw-semibold mt-1"></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev">
                            <i class="ki-duotone ki-left fs-2x"></i>
                        </button>
                        <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next">
                            <i class="ki-duotone ki-right fs-2x"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Galery -->
        <div class="position-relative z-index-2 mt-20 mb-20">
            <div class="container">
                <div class="card" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
                    <div class="card-body p-lg-20">
                        <div class="text-center mb-5 mb-lg-10">
                            <h3 class="fs-2hx text-dark mb-5" id="kt_galery" data-kt-scroll-offset="{default: 100, lg: 250}">
                                <?php echo lang('Text.lp_menu_galery'); ?>
                            </h3>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_landing_projects_latest">
                                <div class="row g-10">
                                    <div class="col-lg-6">
                                        <a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" target="blank" href="<?php if (!empty($images[0]->img)) echo "data:image/png;base64," . base64_encode($images[0]->img) . "";
                                                                                                                                                    else echo "" . base_url('public/assets/media/img/img.png') . ""; ?>">
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('<?php if (!empty($images[0]->img)) echo "data:image/png;base64," . base64_encode($images[0]->img) . "";
                                                                                                                                                                                            else echo "" . base_url("public/assets/media/img/img.png") . ""; ?>')"></div>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-duotone ki-eye fs-3x text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row g-10 mb-10">
                                            <div class="col-lg-6">
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" target="blank" href="<?php if (!empty($images[1]->img)) echo "data:image/png;base64," . base64_encode($images[1]->img) . "";
                                                                                                                                                    else echo "" . base_url('public/assets/media/img/img.png') . ""; ?>">
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('<?php if (!empty($images[1]->img)) echo "data:image/png;base64," . base64_encode($images[1]->img) . "";
                                                                                                                                                                                    else echo "" . base_url("public/assets/media/img/img.png") . ""; ?>')"> </div>
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-duotone ki-eye fs-3x text-white">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6">
                                                <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" target="blank" href="<?php if (!empty($images[2]->img)) echo "data:image/png;base64," . base64_encode($images[2]->img) . "";
                                                                                                                                                    else echo "" . base_url('public/assets/media/img/img.png') . ""; ?>">
                                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('<?php if (!empty($images[2]->img)) echo "data:image/png;base64," . base64_encode($images[2]->img) . "";
                                                                                                                                                                                    else echo "" . base_url("public/assets/media/img/img.png") . ""; ?>')"></div>
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                        <i class="ki-duotone ki-eye fs-3x text-white">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" target="blank" href="<?php if (!empty($images[3]->img)) echo "data:image/png;base64," . base64_encode($images[3]->img) . "";
                                                                                                                                            else echo "" . base_url('public/assets/media/img/img.png') . ""; ?>">
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('<?php if (!empty($images[3]->img)) echo "data:image/png;base64," . base64_encode($images[3]->img) . "";
                                                                                                                                                                            else echo "" . base_url("public/assets/media/img/img.png") . ""; ?>')"></div>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="ki-duotone ki-eye fs-3x text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About -->
        <div id="kt_about" class="mt-20 mb-20">
            <div class="container">
                <div class="text-center mb-17">
                    <h3 class="fs-2hx text-dark mb-5" id="clients" data-kt-scroll-offset="{default: 125, lg: 150}"><?php echo lang('Text.lp_menu_about') ?></h3>
                </div>
                <div class="row g-lg-10 mb-10 mb-lg-20">
                    <div class="col-12">
                        <div class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                            <div class="mb-7">
                                <div class="text-gray-500 fw-semibold fs-4"><?php echo $companyProfile[0]->about; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div id="kt_contact" class="mb-0 mt-20">
            <div class="landing-dark-bg pt-20">
                <div class="container">
                    <div class="row py-10 py-lg-20">
                        <div class="col-lg-6 pe-lg-16 mb-10 mb-lg-0">
                            <h2 class="text-white"><?php echo $companyProfile[0]->companyType . ' ' . $companyProfile[0]->companyName; ?></h2>
                            <br>
                            <p class="text-white opacity-50 fs-5 mb-6"><i class="bi bi-envelope-at fs-5"></i> <?php echo $companyProfile[0]->email; ?></p>
                            <p class="text-white opacity-50 fs-5 mb-6"><i class="bi bi-telephone fs-5"></i> <?php echo $companyProfile[0]->phone1; ?></p>

                            <p class="text-white opacity-50 fs-5 mb-6">
                                <i class="bi bi-geo-alt fs-5"></i>
                                <?php echo @$companyProfile[0]->address1; ?>
                                <?php if (@$companyProfile[0]->address2) echo ", " . $companyProfile[0]->address2; ?>
                                <br>
                                <?php echo @$companyProfile[0]->city; ?>
                                <?php if (@$companyProfile[0]->state) echo ", " .  $companyProfile[0]->state; ?>
                                <br>
                                <?php echo @$companyProfile[0]->zip; ?> <?php echo @$companyProfile[0]->country; ?>
                            </p>
                        </div>
                        <div class="col-lg-6 ps-lg-16">
                            <div class="d-flex justify-content-center">
                                <!-- Company Social Networks -->
                                <div class="d-flex fw-semibold flex-column ms-lg-20">
                                    <?php foreach ($socialNetworks as $sn) { ?>
                                        <a href="<?php echo $sn->url; ?>" class="mb-6">
                                            <?php echo socialNetworkIcon($sn->type); ?>
                                            <span class="text-white opacity-50 text-hover-primary fs-5 mb-6"><?php echo $sn->type; ?></span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="landing-dark-separator"></div>
                <div class="container">
                    <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                        <!-- Copyright -->
                        <div class="d-flex align-items-center order-2 order-md-1">
                            <a class="mx-5 fs-6 fw-semibold text-gray-600 pt-1" href="<?php echo DEVELOPER_URL; ?>">&copy; <?php echo DEVELOPER; ?></a>
                        </div>
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
                            <!-- Employee Sign In -->
                            <li class="menu-item mx-5">
                                <a href="<?php echo base_url('Home/signInEmployee'); ?>" class="menu-link px-2"><?php echo lang('Text.top_bar_employees'); ?></a>
                            </li>
                            <!-- Control Panel Sign In -->
                            <li class="menu-item">
                                <a href="<?php echo base_url('Home/controlPanelAuth'); ?>" class="menu-link px-2"><?php echo lang('Text.lp_c_panel'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <i class="ki-duotone ki-arrow-up">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
</body>

</html>