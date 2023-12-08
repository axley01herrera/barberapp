<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.emp_schedule_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.emp_schedule_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <button type="button" id="btn-createTime<?php echo $uniqid; ?>" class="btn btn-sm btn-flex btn-light-primary">
                <i class="ki-duotone ki-plus-square fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i><?php echo lang('Text.btn_create_time'); ?></button>
        </div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">

        <div class="accordion" id="kt_accordion_1">

            <!-- Monday -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="kt_accordion_1_header_1">
                    <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                        <?php echo lang('Text.monday'); ?>
                    </button>
                </h2>
                <div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                    <input type="checkbox" id="monday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->monday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->monday; ?>" />
                                    <label class="form-check-label"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tuesday -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="kt_accordion_1_header_2">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                        <?php echo lang('Text.tuesday'); ?>
                    </button>
                </h2>
                <div id="kt_accordion_1_body_2" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                    <div class="accordion-body">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <input type="checkbox" id="tuesday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->tuesday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->tuesday; ?>" />
                                        <label class="form-check-label"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wednesday -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="kt_accordion_1_header_3">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_3" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                        <?php echo lang('Text.wednesday'); ?>
                    </button>
                </h2>
                <div id="kt_accordion_1_body_3" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_3" data-bs-parent="#kt_accordion_1">
                    <div class="accordion-body">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <input type="checkbox" id="wednesday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->wednesday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->wednesday; ?>" />
                                        <label class="form-check-label"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thursday -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="kt_accordion_1_header_4">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_4" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                        <?php echo lang('Text.thursday'); ?>
                    </button>
                </h2>
                <div id="kt_accordion_1_body_4" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_4" data-bs-parent="#kt_accordion_1">
                    <div class="accordion-body">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <input type="checkbox" id="thursday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->thursday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->thursday; ?>" />
                                        <label class="form-check-label"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Friday -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="kt_accordion_1_header_5">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_5" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                        <?php echo lang('Text.friday'); ?>
                    </button>
                </h2>
                <div id="kt_accordion_1_body_5" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_5" data-bs-parent="#kt_accordion_1">
                    <div class="accordion-body">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <input type="checkbox" id="friday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->friday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->friday; ?>" />
                                        <label class="form-check-label"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Saturday -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="kt_accordion_1_header_6">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_6" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                        <?php echo lang('Text.saturday'); ?>
                    </button>
                </h2>
                <div id="kt_accordion_1_body_6" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_6" data-bs-parent="#kt_accordion_1">
                    <div class="accordion-body">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <input type="checkbox" id="saturday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->saturday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->saturday; ?>" />
                                        <label class="form-check-label"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sunday -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="kt_accordion_1_header_7">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_7" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                        <?php echo lang('Text.sunday'); ?>
                    </button>
                </h2>
                <div id="kt_accordion_1_body_7" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_7" data-bs-parent="#kt_accordion_1">
                    <div class="accordion-body">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <input type="checkbox" id="sunday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->sunday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->sunday; ?>" />
                                        <label class="form-check-label"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.cbx-bussines-day').on('click', function() {
        let field = $(this).attr('id');
        let value = $(this).attr('data-value');
        let newValue = "";

        if (value == 0)
            newValue = 1;
        else
            newValue = 0;

        $(this).attr('data-value', newValue);

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/updateBussinessDay') ?>",
            data: {
                'field': field,
                'value': newValue,
                'employeeBussinesDayID': "<?php echo $employeeBussinesDay[0]->id; ?>"
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 1 && response.msg == "SESSION_EXPIRED")
                    window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
            },
            error: function(error) {
                globalError();
            }
        });

    });

    $('#btn-createTime<?php echo $uniqid; ?>').on('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ControlPanel/createTime'); ?>",
            data: {
                'employeeID': "<?php echo $employeeID; ?>"
            },
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            },
            error: function(error) {
                globalError();
            }
        });
    });
</script>