<div id="page" data-page="main-service" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cp_serv_page_title'); ?>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button id="btn-new-serv<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang("Text.cp_serv_new"); ?></button>
            </div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-10 draggable-zone mt-5">
                <?php foreach ($services as $s) { ?>
                    <div class="col-12 col-md-4 col-lg-4 draggable service-card mt-4" data-service-id="<?php echo $s->id; ?>">
                        <div class="card card-bordered">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label"><?php echo $s->title; ?> </h3>
                                </div>
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                                        <i class="bi bi-arrows-move fs-2x"><span class="path1"></span><span class="path2"></span></i> </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                    <div class="d-flex align-items-center me-5 me-xl-13">
                                        <div class="symbol symbol-30px symbol-circle me-3">
                                            <img src="<?php echo base_url('public/assets/media/icons/duotune/abstract/abs019.svg'); ?>">
                                        </div>
                                        <div class="m-0">
                                            <span class="fw-semibold text-gray-400 d-block fs-8"><?php echo lang('Text.cp_serv_time_minutes') ?></span>
                                            <span class="fw-bold text-gray-800 text-hover-primary fs-7"><?php echo $s->time; ?> m</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px symbol-circle me-3">
                                            <img src="<?php echo base_url('public/assets/media/icons/duotune/finance/fin003.svg'); ?>">
                                        </div>
                                        <div class="m-0">
                                            <span class="fw-semibold text-gray-400 d-block fs-8"><?php echo lang('Text.cp_serv_price'); ?></span>
                                            <span class="fw-bold text-gray-800 fs-7"><?php echo getMoneyFormat($config[0]->currency, $s->price); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column mt-5 mb-5">
                                    <h4 class="mb-1 text-muted"><?php echo lang("Text.cp_serv_description"); ?></h4>
                                    <span class="text-muted"><?php echo $s->description; ?></span>
                                </div>

                                <div class="row">

                                    <!-- Switch Status -->
                                    <div class="col-6">
                                        <label class="mb-2"><?php echo lang('Text.status'); ?></label>
                                        <div class=" form-check form-switch">
                                            <input type="checkbox" class="form-check-input form-control change-status" title="<?php echo lang('Text.cp_serv_change_status'); ?>" <?php if ($s->status == 1) echo 'checked=""'; ?> data-service-id="<?php echo $s->id; ?>" data-status="<?php echo $s->status ?>">
                                        </div>
                                    </div>

                                    <!-- Switch Visibility -->
                                    <div class="col-6">
                                        <label class="mb-2"><?php echo lang('Text.visibility'); ?></label>
                                        <div class=" form-check form-switch">
                                            <input type="checkbox" class="form-check-input form-control change-visibility" title="<?php echo lang('Text.cp_serv_change_visibility'); ?>" <?php if ($s->visibility == 1) echo 'checked=""'; ?> data-service-id="<?php echo $s->id; ?>" data-visibility="<?php echo $s->visibility ?>">
                                        </div>
                                    </div>

                                    <!-- BTN Edit -->
                                    <div class="col-12 mt-5">
                                        <button class="btn btn-sm btn-secondary edit-service" data-service-id="<?php echo $s->id; ?>" title="<?php echo lang('Text.cp_serv_edit'); ?>"><span class="bi bi-pencil-square"></span> <?php echo lang('Text.cp_serv_edit'); ?></button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if (empty($services)) { ?>
                    <div class="col-12">
                        <div class="alert alert-dismissible bg-light-danger d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
                            <i class="ki-duotone ki-information-5 fs-5tx text-danger mb-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <div class="text-center">
                                <h1 class="fw-bold mb-5"><?php echo lang("Text.cp_serv_not_services"); ?></h1>
                                <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="col-12">
                        <div class="alert alert-dismissible bg-light-primary d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
                            <i class="ki-duotone ki-information-5 fs-5tx text-primary mb-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <div class="text-center">
                                <h1 class="fw-bold mb-5"><?php echo lang('Text.cp_serv_order_msg'); ?></h1>
                                <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
                                <span><?php echo lang('Text.cp_serv_order_msg_sub1'); ?> <?php echo lang('Text.cp_serv_order_msg_sub2'); ?>.</span>
                                <div class="row">
                                    <div class="col-12 text-center mt-5">
                                        <button id="save-order" class="btn btn-primary"><?php echo lang('Text.btn_save_ordering'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Create Service -->
<script>
    $('#btn-new-serv<?php echo $uniqid; ?>').on('click', function() {
        $('#btn-new-serv<?php echo $uniqid; ?>').attr('disabled', true);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/showModalService'); ?>",
            data: {
                'action': "create"
            },
            dataType: "html",
            success: function(response) {
                $('#btn-new-serv<?php echo $uniqid; ?>').removeAttr('disabled');
                $('#app-modal').html(response);
            },
            error: function() {
                $('#btn-new-serv<?php echo $uniqid; ?>').removeAttr('disabled');
                globalError();
            }
        });
    }); // ok
</script>

<!-- Dragable -->
<script>
    var containers = document.querySelectorAll(".draggable-zone");
    var swappable = new Sortable.default(containers, {
        draggable: ".draggable",
        handle: ".draggable .draggable-handle",
        mirror: {
            appendTo: "#services",
            constrainDimensions: true
        }
    });

    $('#save-order').on('click', function() {
        let servicesIds = [];
        $('.service-card').each(function() {
            servicesIds.push($(this).attr('data-service-id'));
        });
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/updateServicesOrder') ?>",
            data: {
                'servicesIds': servicesIds
            },
            dataType: "json",
            success: function(response) {
                simpleSuccessAlert('<?php echo lang('Text.cp_serv_success_order'); ?>');
            },
            error: function(e) {
                globalError();
            }
        });
    });

    $('.edit-service').on('click', function() { // Edit Service
        let id = $(this).attr('data-service-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/showModalService'); ?>",
            data: {
                'id': id,
                'action': "update"
            },
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            },
            error: function() {
                globalError();
            }
        });
    }); // ok

    $('.change-status').on('click', function() { // Change Status
        let serviceID = $(this).attr('data-service-id');
        let value = $(this).attr('data-status');
        let newValue = "";
        let msg = "";

        if (value == 1) {
            newValue = 0;
            msg = "<?php echo lang("Text.cp_serv_inactive"); ?>";
        } else if (value == 0) {
            newValue = 1;
            msg = "<?php echo lang("Text.cp_serv_active"); ?>";
        }

        $(this).attr('data-status', newValue);

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/changeServiceStatus'); ?>",
            data: {
                'serviceID': serviceID,
                'status': newValue
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0)
                    simpleSuccessAlert(msg);
                else {
                    if (response.msg == "SESSION_EXPIRED") {
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                    } else
                        globalError();
                }
            },
            error: function(e) {
                globalError();
            }
        });
    });

    $('.change-visibility').on('click', function() { // Change Visibility
        let serviceID = $(this).attr('data-service-id');
        let value = $(this).attr('data-visibility');
        let newValue = "";
        let msg = "";

        if (value == 1) {
            newValue = 0;
            msg = "<?php echo lang("Text.cp_serv_inactive_visibility"); ?>";
        } else if (value == 0) {
            newValue = 1;
            msg = "<?php echo lang("Text.cp_serv_active_visibility"); ?>";
        }

        $(this).attr('data-visibility', newValue);

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/changeServiceVisibility'); ?>",
            data: {
                'serviceID': serviceID,
                'visibility': newValue
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0)
                    simpleSuccessAlert(msg);
                else {
                    if (response.msg == "SESSION_EXPIRED") {
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                    } else
                        globalError();
                }
            },
            error: function(e) {
                globalError();
            }
        });
    });
</script>