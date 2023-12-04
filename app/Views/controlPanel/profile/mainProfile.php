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
            <!-- Card Tabs Profile -->
            <div class="card mb-5 mb-xl-10 mt-5">
                <div class="card-body pb-0">
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                        <!-- Profile Info -->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "profile") echo "active"; ?> " data-tab-profile="profile" href="#"><?php echo lang('Text.prof_menu_edit_profile'); ?></a>
                        </li>
                        <!-- Acess Key -->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-profile <?php if ($tab == "key") echo "active"; ?>" data-tab-profile="key" href="#"><?php echo lang('Text.prof_menu_change_key'); ?></a>
                        </li>
                        <!-- Config -->
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