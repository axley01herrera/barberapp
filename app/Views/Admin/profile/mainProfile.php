<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--Page Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"><?php echo lang('Text.top_bar_profile'); ?></h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3"></div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--Header Profile-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <!--Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <?php if (empty($profile[0]->avatar)) { ?>
                                    <img src="<?php echo base_url('public/assets/media/avatars/blank.png'); ?>" alt="image">
                                <?php } else { ?>
                                    <img src="data:image/png;base64,<?php echo base64_encode($profile[0]->avatar); ?>" alt="image">
                                <?php } ?>
                            </div>
                        </div>
                        <!--Info-->
                        <div class="flex-grow-1">
                            <!--Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--User-->
                                <div class="d-flex flex-column">
                                    <!--Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-gray-900 fs-2 fw-bold me-1"><?php echo $profile[0]->name . ' ' . $profile[0]->last_name; ?></span>
                                    </div>
                                    <!--Info-->
                                    <div class="fw-semibold fs-6 mb-4 pe-2 ">
                                        <div class="row">
                                            <!--Email-->
                                            <?php if (!empty($profile[0]->email)) { ?>
                                                <div class="col-12">
                                                    <i class="bi bi-envelope-fill text-muted"></i> <span class="text-muted"><?php echo $profile[0]->email; ?></span>
                                                </div>
                                            <?php } ?>
                                            <!--Phone1-->
                                            <?php if (!empty($profile[0]->phone1)) { ?>
                                                <div class="col-12">
                                                    <i class="bi bi-telephone-fill text-muted"></i> <span class="text-muted"><?php echo $profile[0]->phone1; ?></span>
                                                </div>
                                            <?php } ?>
                                            <!--Phone2-->
                                            <?php if (!empty($profile[0]->phone1)) { ?>
                                                <div class="col-12">
                                                    <i class="bi bi-telephone-fill text-muted"></i> <span class="text-muted"><?php echo $profile[0]->phone2; ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!--Actions-->
                                <div class="d-flex my-4">
                                    <div class="me-0">
                                        <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-solid ki-dots-horizontal fs-2x"></i>
                                        </button>
                                        <!--Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                                            <!-- Edit Profile-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3"><?php echo lang('Text.prof_menu_edit_profile'); ?></a>
                                            </div>
                                            <!-- Config-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3"><?php echo lang('Text.prof_menu_change_key'); ?></a>
                                            </div>
                                            <!-- Config-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3"><?php echo lang('Text.prof_menu_config'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">
                                        <!--Total Customers-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1">5</div>
                                            </div>
                                            <div class="fw-semibold fs-6 text-gray-400"><?php echo lang('Text.total_customers'); ?></div>
                                        </div>
                                        <!--Total Services-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1">10</div>
                                            </div>
                                            <div class="fw-semibold fs-6 text-gray-400"><?php echo lang('Text.total_services'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!--Progress-->
                                <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        <span class="fw-semibold fs-6 text-gray-400"><?php echo lang('Text.prof_compleation'); ?></span>
                                        <span class="fw-bold fs-6">50%</span>
                                    </div>
                                    <div class="h-5px mx-3 w-100 bg-light mb-3">
                                        <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabs Profile-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pb-0">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                        <!--Profile Info-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile active" data-tab-profile="profile" href="#"><?php echo lang('Text.prof_info'); ?></a>
                        </li>
                        <!--Acess Key-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile" data-tab-profile="key" href="#"><?php echo lang('Text.prof_menu_change_key'); ?></a>
                        </li>
                        <!--Config-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile" data-tab-profile="config" href="#"><?php echo lang('Text.prof_menu_config'); ?></a>
                        </li>
                    </ul>
                    <div id="profile-tab-content" class="container mt-10 mb-10"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var tabProfile = "profile";
    getProfileTabContent();

    function getProfileTabContent() { // Get Profile Tab Content
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Admin/profileTab'); ?>",
            data: {
                'tab': tabProfile
            },
            dataType: "html",
            success: function (response) {
                $('#profile-tab-content').html(response);
            },
            error: function () {
                globalError();
            }
        });
    }
</script>