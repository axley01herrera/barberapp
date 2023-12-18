<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.emp_service_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.emp_sercice_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
        </div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
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
                        <span><?php echo lang('Text.dt_serv_time_label'); ?> <?php echo $service->time; ?> <?php echo lang('Text.dt_serv_minutes_label'); ?></span> 
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        let employeeID = "<?php echo $employeeID; ?>";
        $('.form-check-input').on('click', function() {
            let checked = $(this).attr('data-checked');
            let serviceID = $(this).attr('data-service-id');
            let msg = "";

            if(checked == 0) {
                msg = "<?php echo lang('Text.emp_assigned_service'); ?>";
            } else
                msg = "<?php echo lang('Text.emp_unassigned_service'); ?>";

            $.ajax({
                type: "post",
                url: "<?php echo base_url('ControlPanel/employeeService'); ?>",
                data: {
                    'checked': checked,
                    'serviceID': serviceID,
                    'employeeID': employeeID
                },
                dataType: "json",
                success: function(response) {
                    if(response.error == 0)
                        simpleSuccessAlert(msg);
                    else if (response.error == 1 && response.msg == "SESSION_EXPIRED")
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                },
                error: function(error) {
                    globalError();
                }
            });
        });
    });
</script>