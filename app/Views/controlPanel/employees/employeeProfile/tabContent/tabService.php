<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_emp_profile_tab_serv_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_emp_profile_tab_serv_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
        </div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        <div class="row">
            <?php foreach ($services as $service) { ?>
                <div class="col-12 col-md-6 col-lg-6 mb-5">
                    <div class="card card-bordered">
                        <div class="card-header">
                            <!-- Service Title -->
                            <h3 class="card-title"><?php echo $service->title; ?></h3>
                            <div class="card-toolbar">
                                <div class="form-check form-switch form-check-custom me-10">
                                    <input type="checkbox" class="form-check-input h-30px w-50px" <?php if (in_array($service->id, array_column($employeeServices, 'serviceID'))) echo 'checked'; ?> data-checked="<?php if (in_array($service->id, array_column($employeeServices, 'serviceID'))) echo '1';
                                                                                                                                                                                                                    else echo '0'; ?>" data-service-id="<?php echo $service->id; ?>" />
                                    <label class="form-check-label"></label>
                                </div>
                            </div>
                        </div>
                        <!-- Service Description -->
                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <img src="<?php echo base_url('public/assets/media/icons/duotune/abstract/abs019.svg'); ?>">
                                    </div>
                                    <div class="m-0">
                                        <span class="fw-semibold text-gray-400 d-block fs-8"><?php echo lang('Text.cp_serv_time_minutes') ?></span>
                                        <span class="fw-bold text-gray-800 text-hover-primary fs-7"><?php echo $service->time; ?> m</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-30px symbol-circle me-3">
                                        <img src="<?php echo base_url('public/assets/media/icons/duotune/finance/fin003.svg'); ?>">
                                    </div>
                                    <div class="m-0">
                                        <span class="fw-semibold text-gray-400 d-block fs-8"><?php echo lang('Text.cp_serv_price'); ?></span>
                                        <span class="fw-bold text-gray-800 fs-7"><?php echo getMoneyFormat($config[0]->currency, $service->price); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column mt-5 mb-5">
                                <h4 class="mb-1 text-muted"><?php echo lang("Text.cp_serv_description"); ?></h4>
                                <span class="text-muted"><?php echo $service->description; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let employeeID = "<?php echo $employeeID; ?>";
        $('.form-check-input').on('click', function() {
            let checked = $(this).attr('data-checked');
            let serviceID = $(this).attr('data-service-id');
            let msg = "";
            let value = ""

            if (checked == 0) {
                msg = "<?php echo lang('Text.cp_emp_assigned_service'); ?>";
                value = 1
            } else {
                msg = "<?php echo lang('Text.cp_emp_unassigned_service'); ?>";
                value = 0;
            }

            $(this).attr('data-checked', value);

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
                    if (response.error == 0)
                        simpleSuccessAlert(msg);
                    else if (response.error == 1 && response.msg == "SESSION_EXPIRED")
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                },
                error: function(error) {
                    globalError();
                }
            });
        });
    }); // ok
</script>