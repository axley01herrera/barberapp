<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cp_emp_profile_tab_serv_title'); ?>
                </h1>
                <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_emp_profile_tab_serv_subtitle'); ?></div>
            </div>
            <!-- Page Button Action -->
            <div class="d-flex align-items-center gap-2 gap-lg-3"></div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <div class="container">
                    <div class="card p-9 pt-4">
                        <?php foreach ($services as $service) { ?>
                            <div class="card-header">
                                <!-- Service Title -->
                                <h3 class="card-title"><?php echo $service->title; ?></h3>
                                <div class="card-toolbar">
                                    <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                        <input type="checkbox" class="form-check-input h-30px w-50px" <?php if (in_array($service->id, array_column($employeeServices, 'serviceID'))) echo 'checked'; ?> data-checked="<?php if (in_array($service->id, array_column($employeeServices, 'serviceID'))) echo '1';
                                                                                                                                                                                                                        else echo '0'; ?>" data-service-id="<?php echo $service->id; ?>" />
                                        <label class="form-check-label"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- Service Description -->
                            <div class="card-body">
                                <div class="alert bg-light-primary d-flex align-items-center p-5">
                                    <div class="d-flex flex-column">
                                        <h4 class="mb-1 text-dark"><?php echo lang("Text.description"); ?></h4>
                                        <span><?php echo $service->description; ?></span>
                                        <span><?php echo lang('Text.appointment_col_time'); ?> <?php echo $service->time; ?> <?php echo lang('Text.minutes'); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.form-check-input').on('click', function() {
        let checked = $(this).attr('data-checked');
        let serviceID = $(this).attr('data-service-id');

        $.ajax({
            type: "post",
            url: "<?php echo base_url('Employee/employeeService'); ?>",
            data: {
                'checked': checked,
                'serviceID': serviceID,
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 1 && response.msg == "SESSION_EXPIRED")
                    window.location.href = "<?php echo base_url('Home/signInEmployee?session=expired'); ?>";
            },
            error: function(error) {
                globalError();
            }
        });
    });
</script>