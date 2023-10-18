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
            <!-- Card Profile Info -->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pb-0">
                    <!-- Name -->
                    <?php if (!empty($profile[0]->company_name)) { ?>
                        <h5><?php echo $profile[0]->company_name; ?></h5>
                    <?php } ?>
                    <div class="row">
                        <div class="col-12 col-lg-6 mt-5">
                            <div class="row">
                                <!-- Email -->
                                <?php if (!empty($profile[0]->email)) {?>
                                    <div class="col-12 mt-2">
                                        <i class="bi bi-envelope-fill fs-6"></i> <span class="fs-6 fw-semibold"><?php echo $profile[0]->email; ?></span>
                                    </div>
                                <?php } ?>
                                <!-- Phone1 -->
                                <?php if (!empty($profile[0]->phone1)) { ?>
                                    <div class="col-12 mt-2">
                                        <i class="bi bi-telephone-fill  fs-6"></i> <span class=" fs-6 fw-semibold"><?php echo $profile[0]->phone1; ?></span>
                                    </div>
                                <?php } ?>
                                <!-- Phone2 -->
                                <?php if (!empty($profile[0]->phone2)) { ?>
                                    <div class="col-12 mt-2">
                                        <i class="bi bi-telephone-fill  fs-6"></i> <span class=" fs-6 fw-semibold"><?php echo $profile[0]->phone2; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if (!empty($profile[0]->address1)) { ?>
                                    <div class="col-12 mt-2">
                                        <i class="bi bi-geo-alt-fill"></i> <span class=" fs-6 fw-semibold"><?php echo $profile[0]->address1; ?></span>
                                        <?php if (!empty($profile[0]->address2)) { ?>
                                            <span class=" fs-6 fw-semibold"><?php echo ', ' . $profile[0]->address2; ?></span>
                                        <?php } ?>
                                        <?php if (!empty($profile[0]->city)) {?>
                                            <span class=" fs-6 fw-semibold"><?php echo ', ' . $profile[0]->city; ?></span>
                                        <?php } ?>
                                        <?php if (!empty($profile[0]->state)) { ?>
                                            <span class=" fs-6 fw-semibold"><?php echo ', ' . $profile[0]->state; ?></span>
                                        <?php } ?>
                                        <?php if (!empty($profile[0]->zip)) { ?>
                                            <span class=" fs-6 fw-semibold"><?php echo ', ' . $profile[0]->zip; ?></span>
                                        <?php } ?>
                                        <?php if (!empty($profile[0]->country)) { ?>
                                            <span class=" fs-6 fw-semibold"><?php echo ', ' . $profile[0]->country; ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- Info-->
                        <div class="col-12 col-lg-6 mt-5">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <!--Total Customers-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex">
                                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1">5</div>
                                        </div>
                                        <div class="fw-semibold fs-6 "><?php echo lang('Text.total_customers'); ?></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <!--Total Services-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex">
                                            <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1">10</div>
                                        </div>
                                        <div class="fw-semibold fs-6 "><?php echo lang('Text.total_services'); ?></div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap flex-stack">
                                    <!-- Progress -->
                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-semibold fs-6 "><?php echo lang('Text.prof_compleation'); ?></span>
                                            <span class="fw-bold fs-6"><?php echo $profilePercent; ?>%</span>
                                        </div>
                                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                                            <div class="bg-success rounded h-5px" role="progressbar" style="width: <?php echo $profilePercent; ?>%;" aria-valuenow="<?php echo $profilePercent; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Tabs Profile -->
            <div class="card mb-5 mb-xl-10 mt-10">
                <div class="card-body pb-0">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                        <!--Profile Info-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "profile") echo "active"; ?> " data-tab-profile="profile" href="#"><?php echo lang('Text.prof_menu_edit_profile'); ?></a>
                        </li>
                        <!--Acess Key-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "key") echo "active"; ?>" data-tab-profile="key" href="#"><?php echo lang('Text.prof_menu_change_key'); ?></a>
                        </li>
                        <!--Config-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "config") echo "active"; ?>" data-tab-profile="config" href="#"><?php echo lang('Text.prof_menu_config'); ?></a>
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
            url: "<?php echo base_url('Admin/profileTab'); ?>",
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
        window.location.href = "<?php echo base_url('Admin/profile?tab='); ?>" + tab;
    });
</script>