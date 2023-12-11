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
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <!-- Company Info -->
                    <div class="card mb-5 mb-xl-8">
                        <div id="company-info" class="card-body">
                            <div class="d-flex flex-center flex-column py-5">
                                <!-- Avatar -->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <?php if (empty($companyProfile[0]->avatar)) { ?>
                                        <img src="<?php echo base_url('public/assets/media/avatars/logoBlank.png'); ?>" class="border border-1 border-secondary" alt="Avatar">
                                    <?php } else { ?>
                                        <img src="data:image/png;base64,<?php echo base64_encode($companyProfile[0]->avatar); ?>" class="border border-1 border-secondary" alt="Avatar">
                                    <?php } ?>
                                </div>
                                <!-- Name -->
                                <p class="fs-3 text-gray-800 fw-bold mb-3"><?php echo $companyProfile[0]->companyName; ?></p>
                                <span class="badge badge-light-primary"><?php echo $companyProfile[0]->companyType; ?></span>
                            </div>
                            <div id="kt_user_view_details" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <div class="fw-bold mt-5"><?php echo lang('Text.email'); ?></div>
                                    <div class="text-gray-600">
                                        <span class="text-gray-600"><?php echo $companyProfile[0]->email; ?></span>
                                    </div>
                                    <!-- Priary Phone-->
                                    <?php if (!empty($companyProfile[0]->phone1)) { ?>
                                        <div class="fw-bold mt-5"><?php echo lang('Text.primary_phone'); ?></div>
                                        <div class="text-gray-600">
                                            <span class="text-gray-600">
                                                <?php echo $companyProfile[0]->phone1; ?>
                                            </span>
                                        </div>
                                        <!-- Secondary Phone -->
                                        <?php if (!empty($companyProfile[0]->phone2)) { ?>
                                            <div class="fw-bold mt-5"><?php echo lang('Text.secondary_phone'); ?></div>
                                            <div class="text-gray-600">
                                                <span class="text-gray-600">
                                                    <?php echo $companyProfile[0]->phone2; ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                        <!-- Phone Ext -->
                                        <?php if (!empty($companyProfile[0]->phoneExt)) { ?>
                                            <div class="fw-bold mt-5"><?php echo lang('Text.phone_ext'); ?></div>
                                            <div class="text-gray-600">
                                                <span class="text-gray-600">
                                                    <?php echo $companyProfile[0]->phoneExt; ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                        <div class="fw-bold mt-5"><?php echo lang('Text.address'); ?></div>
                                        <div class="text-gray-600">
                                            <?php echo @$companyProfile[0]->address1; ?>
                                            <?php if (@$companyProfile[0]->address2) echo ", " . $companyProfile[0]->address2; ?>
                                            <br>
                                            <?php echo @$companyProfile[0]->city; ?>
                                            <?php if (@$companyProfile[0]->state) echo ", " .  $companyProfile[0]->state; ?>
                                            <br>
                                            <?php echo @$companyProfile[0]->zip; ?> <?php echo @$companyProfile[0]->country; ?>
                                        </div>
                                        <?php if (!empty($companyProfile[0]->companyID)) { ?>
                                            <div class="fw-bold mt-5"><?php echo lang('Text.tax_identifier'); ?></div>
                                            <div class="text-gray-600">
                                                <span class="text-gray-600">
                                                    <?php echo $companyProfile[0]->companyID; ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- Alert Incomplete Profile -->
                                    <?php if (empty($companyProfile[0]->phone1)) { ?>
                                        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 mt-10">
                                            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                                <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
                                                <span><?php echo lang('Text.emp_incomplete_profile_msg'); ?></span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Social Network -->
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h3 class="fw-bold m-0"><?php echo lang('Text.social_networks'); ?></h3>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            <div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
                                    <span><?php echo lang('Text.social_network_msg'); ?></span>
                                </div>
                            </div>
                            <?php foreach ($socialNetworks as $sn) { ?>
                                <div class="py-2">
                                    <div class="d-flex flex-stack">
                                        <div class="d-flex">
                                            <?php if ($sn->type == 'Google') { ?>
                                                <img src="<?php echo base_url('public/assets/media/svg/brand-logos/google-icon.svg'); ?>" class="w-30px me-6" alt="logo">
                                            <?php } elseif ($sn->type == 'Facebook') { ?>
                                                <img src="<?php echo base_url('public/assets/media/svg/brand-logos/facebook-3.svg'); ?>" class="w-30px me-6" alt="logo">
                                            <?php } elseif ($sn->type == 'Twitter') { ?>
                                                <img src="<?php echo base_url('public/assets/media/svg/brand-logos/twitter.svg'); ?>" class="w-30px me-6" alt="logo">
                                            <?php } elseif ($sn->type == 'LinkedIn') { ?>
                                                <img src="<?php echo base_url('public/assets/media/svg/brand-logos/linkedin-1.svg'); ?>" class="w-30px me-6" alt="logo">
                                            <?php } ?>
                                            <div class="d-flex flex-column">
                                                <a href="<?php echo $sn->url; ?>" class="fs-5 text-dark text-hover-primary fw-bold"><?php echo $sn->type; ?></a>
                                                <div class="fs-6 fw-semibold text-muted">Plan properly your workflow</div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input cursor-pointer social-action" data-action="changeStatus" data-socialNetwork-id="<?php echo $sn->id; ?>" name="google" type="checkbox" value="1" id="kt_modal_connected_accounts_google" <?php if ($sn->status == 1) echo "data-status='0' checked=''";
                                                                                                                                                                                                                                                                        else echo "data-status='1'"; ?>>
                                                <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_google"></span>
                                            </label>
                                            <span class="cursor-pointer social-action m-2" data-action="edit" data-socialNetwork-id="<?php echo $sn->id; ?>"><i class="bi bi-pencil-square fs-5 text-warning"></i></span>
                                            <span class="cursor-pointer social-action m-2" data-action="delete" data-socialNetwork-id="<?php echo $sn->id; ?>"><i class="bi bi-x-octagon-fill fs-5 text-danger"></i></span>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed my-5"></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-footer border-0 d-flex justify-content-center pt-0">
                            <button class="btn btn-sm btn-primary btn-addSocialNetwork"><?php echo lang('Text.btn_add'); ?></button>
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

    $('.btn-addSocialNetwork').on('click', function(e) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ControlPanel/addSocialNetwork'); ?>",
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            }
        });
    });

    $('.social-action').on('click', function(e) {
        let url = '';
        let datatype = '';
        if ($(this).attr('data-action') == 'edit') {
            url = "<?php echo base_url('ControlPanel/addSocialNetwork'); ?>";
            datatype = "html";
        } else if ($(this).attr('data-action') == 'delete') {
            url = "<?php echo base_url('ControlPanel/addSocialNetworkProcess'); ?>";
            datatype = "json";
        } else if ($(this).attr('data-action') == 'changeStatus') {
            url = "<?php echo base_url('ControlPanel/addSocialNetworkProcess'); ?>";
            datatype = "json";
        }
        if ($(this).attr('data-action') == 'delete') {
            Swal.fire({
                title: '<?php echo lang('Text.are_you_sure'); ?>',
                text: "<?php echo lang('Text.not_revert_this'); ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo lang('Text.yes_remove'); ?>',
                cancelButtonText: '<?php echo lang('Text.no_cancel'); ?>'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'id': $(this).attr('data-socialNetwork-id'),
                            'action': $(this).attr('data-action'),
                            'status': $(this).attr('data-status'),
                        },
                        dataType: datatype,
                        success: function(response) {
                            if (response.error == 0)
                                window.location.reload();
                            else
                                globalError();
                        },
                        error: function(error) {
                            globalError();
                        }
                    });
                }
            })
        } else {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'id': $(this).attr('data-socialNetwork-id'),
                    'action': $(this).attr('data-action'),
                    'status': $(this).attr('data-status'),
                },
                dataType: datatype,
                success: function(response) {
                    if (datatype == 'html')
                        $('#app-modal').html(response);
                    else {
                        if (response.error == 0)
                            window.location.reload();
                        else
                            globalError();
                    }
                },
                error: function(error) {
                    globalError();
                }
            });
        }
    });
</script>