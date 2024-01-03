<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_emp_profile_tab_schedule_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_emp_profile_tab_schedule_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <button type="button" id="btn-createTime<?php echo $uniqid; ?>" class="btn btn-primary">
                <?php echo lang('Text.cp_emp_create_time'); ?>
            </button>
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
                                    <label class="form-check-label"><?php echo lang('text.cp_emp_label_switch_bussiness_day'); ?></label>
                                </div>
                            </div>
                        </div>
                        <section class="mt-10">
                            <div class="table-responsive">
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
                                                        <button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-time monday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_edit'); ?>" <?php if ($employeeBussinesDay[0]->monday == 0) echo "disabled"; ?>>
                                                            <span class="bi bi-pencil-square"></span>
                                                        </button>
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
                                                    <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100">
                                                        <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                                            <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
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
                                        <label class="form-check-label"><?php echo lang('text.cp_emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <section class="mt-10">
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
                                                            <button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-time tuesday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_edit'); ?>" <?php if ($employeeBussinesDay[0]->tuesday == 0) echo "disabled"; ?>>
                                                                <span class="bi bi-pencil-square"></span>
                                                            </button>
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
                                                        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100">
                                                            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
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
                                        <label class="form-check-label"><?php echo lang('text.cp_emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <section class="mt-10">
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
                                                            <button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-time wednesday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_edit'); ?>" <?php if ($employeeBussinesDay[0]->wednesday == 0) echo "disabled"; ?>>
                                                                <span class="bi bi-pencil-square"></span>
                                                            </button>
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
                                                        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100">
                                                            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
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
                                        <label class="form-check-label"><?php echo lang('text.cp_emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <section class="mt-10">
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
                                                            <button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-time thursday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_edit'); ?>" <?php if ($employeeBussinesDay[0]->thursday == 0) echo "disabled"; ?>>
                                                                <span class="bi bi-pencil-square"></span>
                                                            </button>
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
                                                        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100">
                                                            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
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
                                        <label class="form-check-label"><?php echo lang('text.cp_emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <section class="mt-10">
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
                                                            <button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-time friday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_edit'); ?>" <?php if ($employeeBussinesDay[0]->friday == 0) echo "disabled"; ?>>
                                                                <span class="bi bi-pencil-square"></span>
                                                            </button>
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
                                                        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100">
                                                            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
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
                                        <label class="form-check-label"><?php echo lang('text.cp_emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <section class="mt-10">
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
                                                            <button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-time saturday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_edit'); ?>" <?php if ($employeeBussinesDay[0]->saturday == 0) echo "disabled"; ?>>
                                                                <span class="bi bi-pencil-square"></span>
                                                            </button>
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
                                                        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100">
                                                            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
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
                                        <label class="form-check-label"><?php echo lang('text.cp_emp_label_switch_bussiness_day'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <section class="mt-10">
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
                                                            <button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-time sunday" data-time-id="<?php echo $time->id; ?>" title="<?php echo lang('Text.btn_edit'); ?>" <?php if ($employeeBussinesDay[0]->sunday == 0) echo "disabled"; ?>>
                                                                <span class="bi bi-pencil-square"></span>
                                                            </button>
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
                                                        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100">
                                                            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                                                <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
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

<script>
    $('.cbx-bussines-day').on('click', function() { // Change Bussiness Day Status
        let field = $(this).attr('id');
        let value = $(this).attr('data-value');
        let newValue = "";
        let msg = "";

        if (value == 0) {
            newValue = 1;
            msg = "<?php echo lang('Text.cp_emp_bussiness_day_active'); ?>";
        } else {
            newValue = 0;
            msg = "<?php echo lang('Text.cp_emp_bussiness_day_inactive'); ?>";
        }

        $('.' + field).each(function() {
            if (newValue == 1)
                $(this).removeAttr('disabled');
            else
                $(this).attr('disabled', true);
        })

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
                if (response.error == 0)
                    simpleSuccessAlert(msg);
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
            url: "<?php echo base_url('ControlPanel/modalTime'); ?>",
            data: {
                'employeeID': "<?php echo $employeeID; ?>",
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
            url: "<?php echo base_url('ControlPanel/modalTime'); ?>",
            data: {
                'timeID': timeID,
                'action': 'update',
                'employeeID': "<?php echo $employeeID; ?>",
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

    $('.delete-time').on('click', function() { // Delete Time
        let timeID = $(this).attr('data-time-id');
        Swal.fire({
            title: "<?php echo lang('Text.are_you_sure'); ?>",
            text: "<?php echo lang('Text.not_revert_this'); ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Text.yes_remove'); ?>',
            cancelButtonText: '<?php echo lang('Text.no_cancel'); ?>'
        }).then((result) => {
            if (result.isConfirmed)
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('ControlPanel/deleteTime'); ?>",
                    data: {
                        'timeID': timeID,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            simpleSuccessAlert('<?php echo lang('Text.cp_emp_success_deleted_time'); ?>');
                            $('#row' + timeID).remove();
                        } else
                            globalError();
                    },
                    error: function(error) {
                        globalError();
                    }
                });
        })
    }); // ok
</script>