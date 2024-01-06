<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cp_emp_profile_tab_schedule_title'); ?>
                </h1>
                <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_emp_profile_tab_schedule_subtitle'); ?></div>
            </div>

            <!-- Card toolbar -->
            <div class="card-toolbar">
                <button type="button" id="btn-createTime<?php echo $uniqid; ?>" class="btn btn-primary">
                    <?php echo lang('Text.btn_create_time'); ?>
                </button>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <div class="container">
                    <div class="row">
                        <!-- Monday -->
                        <div class="card col-12 col-md-6 col-lg-6 mb-3 card-shadow">
                            <div class="card-header">
                                <h2 class="card-title"> <?php echo lang('Text.monday'); ?></h2>
                                <div class="card-toolbar">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <label class="form-check-label me-3"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                        <input type="checkbox" id="monday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->monday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->monday; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <section class="mt-5">
                                    <div class="table-responsive mt-6">
                                        <table class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                                            <tr class="fs-6 fw-bold">
                                                <th class="p-2"><?php echo lang('Text.start_time'); ?></th>
                                                <th class="p-2"><?php echo lang('Text.end_time'); ?></th>
                                                <th class="p-2 text-center"></th>
                                            </tr>
                                            <tbody>
                                                <?php foreach ($employeeTimes as $time) { ?>
                                                    <?php if ($time->day == "monday") { ?>
                                                        <?php $flagMonday = 1; ?>
                                                        <tr id="row<?php echo $time->id; ?>">
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->start)); ?></td>
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->end)); ?></td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-time monday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_delete'); ?>" <?php if ($employeeBussinesDay[0]->monday == 0) echo "disabled"; ?>>
                                                                    <span class="bi bi-trash-fill"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (empty($flagMonday)) { ?>
                                                    <tr>
                                                        <td colspan="3" class="dt-vertical-align p-2">
                                                            <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                    <span><?php echo lang('Text.cp_emp_no_times_alert'); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- Tuesday -->
                        <div class="card col-12 col-md-6 col-lg-6 mb-3 card-shadow">
                            <div class="card-header">
                                <h2 class="card-title"> <?php echo lang('Text.tuesday'); ?></h2>
                                <div class="card-toolbar">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <label class="form-check-label me-3"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                        <input type="checkbox" id="monday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->monday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->monday; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <section class="mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                                            <tr class="fs-6 fw-bold">
                                                <th class="p-2"><?php echo lang('Text.start_time'); ?></th>
                                                <th class="p-2"><?php echo lang('Text.end_time'); ?></th>
                                                <th class="p-2 text-center"></th>
                                            </tr>
                                            <tbody>
                                                <?php foreach ($employeeTimes as $time) { ?>
                                                    <?php if ($time->day == "tuesday") { ?>
                                                        <?php $flagTuesday = 1; ?>
                                                        <tr id="row<?php echo $time->id; ?>">
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->start)); ?></td>
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->end)); ?></td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-time tuesday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_delete'); ?>" <?php if ($employeeBussinesDay[0]->tuesday == 0) echo "disabled"; ?>>
                                                                    <span class="bi bi-trash-fill"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (empty($flagTuesday)) { ?>
                                                    <tr>
                                                        <td colspan="3" class="dt-vertical-align p-2">
                                                            <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                    <span><?php echo lang('Text.cp_emp_no_times_alert'); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- Wednesday -->
                        <div class="card col-12 col-md-6 col-lg-6 mb-3 card-shadow">
                            <div class="card-header">
                                <h2 class="card-title"> <?php echo lang('Text.wednesday'); ?></h2>
                                <div class="card-toolbar">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <label class="form-check-label me-3"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                        <input type="checkbox" id="wednesday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->wednesday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->wednesday; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <section class="mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                                            <tr class="fs-6 fw-bold">
                                                <th class="p-2"><?php echo lang('Text.start_time'); ?></th>
                                                <th class="p-2"><?php echo lang('Text.end_time'); ?></th>
                                                <th class="p-2 text-center"></th>
                                            </tr>
                                            <tbody>
                                                <?php foreach ($employeeTimes as $time) { ?>
                                                    <?php if ($time->day == "wednesday") { ?>
                                                        <?php $flagWednesday = 1; ?>
                                                        <tr id="row<?php echo $time->id; ?>">
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->start)); ?></td>
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->end)); ?></td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-time wednesday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_delete'); ?>" <?php if ($employeeBussinesDay[0]->wednesday == 0) echo "disabled"; ?>>
                                                                    <span class="bi bi-trash-fill"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (empty($flagWednesday)) { ?>
                                                    <tr>
                                                        <td colspan="3" class="dt-vertical-align p-2">
                                                            <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                    <span><?php echo lang('Text.cp_emp_no_times_alert'); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- Thursday -->
                        <div class="card col-12 col-md-6 col-lg-6 mb-3 card-shadow">
                            <div class="card-header">
                                <h2 class="card-title"> <?php echo lang('Text.thursday'); ?></h2>
                                <div class="card-toolbar">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <label class="form-check-label me-3"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                        <input type="checkbox" id="thursday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->thursday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->thursday; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <section class="mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                                            <tr class="fs-6 fw-bold">
                                                <th class="p-2"><?php echo lang('Text.start_time'); ?></th>
                                                <th class="p-2"><?php echo lang('Text.end_time'); ?></th>
                                                <th class="p-2 text-center"></th>
                                            </tr>
                                            <tbody>
                                                <?php foreach ($employeeTimes as $time) { ?>
                                                    <?php if ($time->day == "thursday") { ?>
                                                        <?php $flagThursday = 1; ?>
                                                        <tr id="row<?php echo $time->id; ?>">
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->start)); ?></td>
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->end)); ?></td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-time thursday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_delete'); ?>" <?php if ($employeeBussinesDay[0]->thursday == 0) echo "disabled"; ?>>
                                                                    <span class="bi bi-trash-fill"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (empty($flagThursday)) { ?>
                                                    <tr>
                                                        <td colspan="3" class="dt-vertical-align p-2">
                                                            <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                    <span><?php echo lang('Text.cp_emp_no_times_alert'); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- Friday -->
                        <div class="card col-12 col-md-6 col-lg-6 mb-3 card-shadow">
                            <div class="card-header">
                                <h2 class="card-title"> <?php echo lang('Text.friday'); ?></h2>
                                <div class="card-toolbar">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <label class="form-check-label me-3"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                        <input type="checkbox" id="friday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->friday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->friday; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <section class="mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                                            <tr class="fs-6 fw-bold">
                                                <th class="p-2"><?php echo lang('Text.start_time'); ?></th>
                                                <th class="p-2"><?php echo lang('Text.end_time'); ?></th>
                                                <th class="p-2 text-center"></th>
                                            </tr>
                                            <tbody>
                                                <?php foreach ($employeeTimes as $time) { ?>
                                                    <?php if ($time->day == "friday") { ?>
                                                        <?php $flagFriday = 1; ?>
                                                        <tr id="row<?php echo $time->id; ?>">
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->start)); ?></td>
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->end)); ?></td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-time friday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_delete'); ?>" <?php if ($employeeBussinesDay[0]->friday == 0) echo "disabled"; ?>>
                                                                    <span class="bi bi-trash-fill"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (empty($flagFriday)) { ?>
                                                    <tr>
                                                        <td colspan="3" class="dt-vertical-align p-2">
                                                            <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                    <span><?php echo lang('Text.cp_emp_no_times_alert'); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- Saturday -->
                        <div class="card col-12 col-md-6 col-lg-6 mb-3 card-shadow">
                            <div class="card-header">
                                <h2 class="card-title"> <?php echo lang('Text.saturday'); ?></h2>
                                <div class="card-toolbar">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <label class="form-check-label me-3"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                        <input type="checkbox" id="saturday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->saturday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->saturday; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <section class="mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                                            <tr class="fs-6 fw-bold">
                                                <th class="p-2"><?php echo lang('Text.start_time'); ?></th>
                                                <th class="p-2"><?php echo lang('Text.end_time'); ?></th>
                                                <th class="p-2 text-center"></th>
                                            </tr>
                                            <tbody>
                                                <?php foreach ($employeeTimes as $time) { ?>
                                                    <?php if ($time->day == "saturday") { ?>
                                                        <?php $flagSaturday = 1; ?>
                                                        <tr id="row<?php echo $time->id; ?>">
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->start)); ?></td>
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->end)); ?></td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-time saturday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_delete'); ?>" <?php if ($employeeBussinesDay[0]->saturday == 0) echo "disabled"; ?>>
                                                                    <span class="bi bi-trash-fill"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (empty($flagSaturday)) { ?>
                                                    <tr>
                                                        <td colspan="3" class="dt-vertical-align p-2">
                                                            <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                    <span><?php echo lang('Text.cp_emp_no_times_alert'); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- Sunday -->
                        <div class="card col-12 mb-3 card-shadow">
                            <div class="card-header">
                                <h2 class="card-title"> <?php echo lang('Text.sunday'); ?></h2>
                                <div class="card-toolbar">
                                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                                        <label class="form-check-label me-3"><?php echo lang('text.emp_label_switch_bussiness_day'); ?></label>
                                        <input type="checkbox" id="sunday" class="form-check-input cbx-bussines-day form-control h-30px w-50px" <?php if ($employeeBussinesDay[0]->sunday == 1) echo "checked"; ?> data-value="<?php echo $employeeBussinesDay[0]->sunday; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <section class="mt-5">
                                    <div class="table-responsive">
                                        <table class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                                            <tr class="fs-6 fw-bold">
                                                <th class="p-2"><?php echo lang('Text.start_time'); ?></th>
                                                <th class="p-2"><?php echo lang('Text.end_time'); ?></th>
                                                <th class="p-2 text-center"></th>
                                            </tr>
                                            <tbody>
                                                <?php foreach ($employeeTimes as $time) { ?>
                                                    <?php if ($time->day == "sunday") { ?>
                                                        <?php $flagSunday = 1; ?>
                                                        <tr id="row<?php echo $time->id; ?>">
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->start)); ?></td>
                                                            <td class="dt-vertical-align p-2"><i class="bi bi-clock"></i> <?php echo date('g:ia', strtotime($time->end)); ?></td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-time sunday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_delete'); ?>" <?php if ($employeeBussinesDay[0]->sunday == 0) echo "disabled"; ?>>
                                                                    <span class="bi bi-trash-fill"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (empty($flagSunday)) { ?>
                                                    <tr>
                                                        <td colspan="3" class="dt-vertical-align p-2">
                                                            <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
                                                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                    <span><?php echo lang('Text.cp_emp_no_times_alert'); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.cbx-bussines-day').on('click', function() { // Change Bussiness Day Status
        let field = $(this).attr('id');
        let value = $(this).attr('data-value');
        let newValue = "";

        if (value == 0)
            newValue = 1;
        else
            newValue = 0;

        $('.' + field).each(function() {
            if (newValue == 1)
                $(this).removeAttr('disabled');
            else
                $(this).attr('disabled', true);
        })

        $(this).attr('data-value', newValue);

        $.ajax({
            type: "post",
            url: "<?php echo base_url('Employee/updateBussinessDay') ?>",
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

    }); // ok

    $('#btn-createTime<?php echo $uniqid; ?>').on('click', function() { // Create Time
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Employee/modalTime'); ?>",
            data: {
                'action': 'create'
            },
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            },
            error: function(error) {
                globalError();
            }
        });
    }); // ok

    $('.edit-time').on('click', function() { // Update Time
        let timeID = $(this).attr('data-time-id');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Employee/modalTime'); ?>",
            data: {
                'timeID': timeID,
                'action': 'update',
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

    $('.delete-time').on('click', function() { // Delete Time
        let timeID = $(this).attr('data-time-id');
        Swal.fire({
            title: "<?php echo lang('Text.are_you_sure_msg'); ?>",
            text: "<?php echo lang('Text.not_revert_this_msg'); ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Text.yes_remove_msg'); ?>',
            cancelButtonText: '<?php echo lang('Text.no_cancel_msg'); ?>'
        }).then((result) => {
            if (result.isConfirmed)
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Employee/deleteTime'); ?>",
                    data: {
                        'timeID': timeID,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            simpleSuccessAlert('<?php echo lang('Text.emp_success_deleted_time'); ?>');
                            $('#row' + timeID).remove();
                        } else
                            globalError();
                    },
                    error: function(error) {
                        globalError();
                    }
                });
        })
    });
</script>