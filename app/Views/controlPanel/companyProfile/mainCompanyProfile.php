<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cp_profile_page_title'); ?>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3"></div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">

                    <!-- Company Info -->
                    <?php echo view('controlPanel/companyProfile/companyInfo'); ?>

                    <!-- Social Network -->
                    <div id="social-networks"></div>

                </div>

                <!-- Tabs -->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!-- Tabs Header -->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8" role="tablist">

                        <!-- Profile Info -->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "profile") echo "active"; ?> " data-tab-profile="profile" href="#"><?php echo lang('Text.cp_profile_menu_bussiness_data'); ?></a>
                        </li>

                        <!-- Privacy Police -->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "privacyPolice") echo "active"; ?>" data-tab-profile="privacyPolice" href="#"><?php echo lang('Text.cp_profile_menu_privacy_police'); ?></a>
                        </li>

                        <!-- Images -->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "images") echo "active"; ?>" data-tab-profile="images" href="#"><?php echo lang('Text.cp_profile_menu_photo'); ?></a>
                        </li>

                        <!-- Acess Key -->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "key") echo "active"; ?>" data-tab-profile="key" href="#"><?php echo lang('Text.cp_profile_menu_change_key'); ?></a>
                        </li>

                        <!-- Modules 
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php // if ($tab == "modules") echo "active"; ?>" data-tab-profile="modules" href="#"><?php // echo lang('Text.cp_profile_menu_modules'); ?></a>
                        </li> -->

                        <!-- Config -->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "config") echo "active"; ?>" data-tab-profile="config" href="#"><?php echo lang('Text.cp_profile_menu_config'); ?></a>
                        </li>

                    </ul>
                    <div id="profile-tab-content" class="container mt-10 mb-10"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var tab = "<?php echo $tab; ?>";
    getProfileTabContent();
    getSocialNetworks();

    function getProfileTabContent() { // Get Profile Tab Content
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/profileTab'); ?>",
            data: {
                'tab': tab
            },
            dataType: "html",
            success: function(response) {
                $('#profile-tab-content').html(response);
            },
            error: function() {
                globalError();
            }
        });
    }

    function getSocialNetworks() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/getSocialNetworks'); ?>",
            dataType: "html",
            success: function(response) {
                $('#social-networks').html(response);
            },
            error: function() {
                globalError();
            }
        });
    }

    $('.tab-profile').on('click', function(e) {
        e.preventDefault();
        tab = $(this).attr('data-tab-profile');
        window.location.href = "<?php echo base_url('ControlPanel/profile?tab='); ?>" + tab;
    });
</script>