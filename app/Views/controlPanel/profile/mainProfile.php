<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.top_bar_profile'); ?>
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
                <!-- Company Info -->
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <div id="company-info" class="card-body">
                            <div class="d-flex flex-center flex-column py-5">
                                <!-- Avatar -->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <?php if (empty($profile[0]->avatar)) { ?>
                                        <img src="<?php echo base_url('public/assets/media/avatars/logoBlank.png'); ?>" class="border border-1 border-secondary" alt="Avatar">
                                    <?php } else { ?>
                                        <img src="data:image/png;base64,<?php echo base64_encode($profile[0]->avatar); ?>" class="border border-1 border-secondary" alt="Avatar">
                                    <?php } ?>
                                </div>
                                <!-- Name -->
                                <p class="fs-3 text-gray-800 fw-bold mb-3"><?php echo $profile[0]->companyName; ?></p>
                                <span class="badge badge-light-success"><?php echo $profile[0]->companyType; ?></span>
                            </div>
                            <div id="kt_user_view_details" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <div class="fw-bold mt-5"><?php echo lang('Text.email'); ?></div>
                                    <div class="text-gray-600">
                                        <span class="text-gray-600"><?php echo $profile[0]->email; ?></span>
                                    </div>
                                    <!-- Phone-->
                                    <?php if (!empty($profile[0]->phone1)) { ?>
                                        <div class="fw-bold mt-5"><?php echo lang('Text.phone'); ?></div>
                                        <div class="text-gray-600">
                                            <span class="text-gray-600">
                                                <?php echo $profile[0]->phone1; ?>
                                            </span>
                                        </div>
                                        <div class="fw-bold mt-5"><?php echo lang('Text.address'); ?></div>
                                        <div class="text-gray-600">
                                            <?php echo @$profile[0]->address1; ?>
                                            <?php if (@$profile[0]->address2) echo ", " . $profile[0]->address2; ?>
                                            <br>
                                            <?php echo @$profile[0]->city; ?>
                                            <?php if (@$profile[0]->state) echo ", " .  $profile[0]->state; ?>
                                            <br>
                                            <?php echo @$profile[0]->zip; ?> <?php echo @$profile[0]->country; ?>
                                        </div>
                                    <?php } ?>

                                    <?php if (empty($profile[0]->phone1)) { ?>
                                        <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-5 mt-10">
                                            <i class="ki-duotone ki-notification-bing fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                                <h4 class="fw-semibold"><?php echo lang('Text.important'); ?></h4>
                                                <span><?php echo lang('Text.emp_incomplete_profile_msg'); ?></span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabs -->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!-- Tabs Header -->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8" role="tablist">
                        <!-- Profile Info -->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "profile") echo "active"; ?> " data-tab-profile="profile" href="#"><?php echo lang('Text.cp_profile_menu_bussiness_data'); ?></a>
                        </li>
                        <!-- Acess Key -->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "key") echo "active"; ?>" data-tab-profile="key" href="#"><?php echo lang('Text.cp_profile_menu_change_key'); ?></a>
                        </li>
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

    $('.tab-profile').on('click', function(e) {
        e.preventDefault();
        tab = $(this).attr('data-tab-profile');
        window.location.href = "<?php echo base_url('ControlPanel/profile?tab='); ?>" + tab;
    });
</script>