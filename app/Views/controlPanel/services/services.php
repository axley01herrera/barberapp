<div class="container g-10 draggable-zone" tabindex="0">
    <?php foreach ($services as $s) { ?>
        <div class="col draggable mt-4" tabindex="0">
            <!--begin::Card-->
            <div class="card card-bordered">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label"><?php echo $s->title; ?> </h3>
                    </div>
                    <div class="card-toolbar row">
                        <div class="col-3 form-check form-switch form-check-solid"><input type="checkbox" class="form-check-input form-control change-status" title="<?php echo lang('Text.change_status'); ?>" <?php if ($s->status == 1) echo 'checked=""'; ?> data-service-id="<?php echo $s->id; ?>" data-status="<?php echo $s->status ?>"></div>
                        <div class="col-3 form-check form-switch form-check-solid"><input type="checkbox" class="form-check-input form-control change-visibility" title="<?php echo lang('Text.change_visibility'); ?>" <?php if ($s->visibility == 1) echo 'checked=""'; ?> data-service-id="<?php echo $s->id; ?>" data-visibility="<?php echo $s->visibility ?>"></div>
                        <div class="col-3"><button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-service" data-service-id="<?php echo $s->id; ?>" title="<?php echo lang('Text.btn_edit'); ?>"><span class="bi bi-pencil-square"></span></button></div>
                        <div class="col-3"><a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                                <i class="ki-duotone ki-abstract-14 fs-2x"><span class="path1"></span><span class="path2"></span></i> </a></div>
                    </div>
                </div>
                <div class="card-body">
                    <h2><?php echo getMoneyFormat($config[0]->currency, $s->price); ?></h2>
                    <h6>Duración de <?php echo $s->time; ?> minutos</h6>
                    <p><?php echo $s->description; ?></p>
                </div>
            </div>
            <!--end::Card-->
        </div>
    <?php } ?>
</div>

<script>
    var containers = document.querySelectorAll(".draggable-zone");

    var swappable = new Sortable.default(containers, {
        draggable: ".draggable",
        handle: ".draggable .draggable-handle",
        mirror: {
            appendTo: "#kt_app_content",
            constrainDimensions: true
        }
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
        let status = '';
        if ($(this).attr('data-status') == 1)
            status = 0;
        else
            status = 1;
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/changeServiceStatus'); ?>",
            data: {
                'serviceID': serviceID,
                'status': status
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0) {
                    simpleSuccessAlert('<?php echo lang('Text.success_change_status'); ?>');
                    getServices();
                } else {
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
    }); // ok

    $('.change-visibility').on('click', function() { // Change Visibility
        let serviceID = $(this).attr('data-service-id');
        let visibility = '';
        if ($(this).attr('data-visibility') == 1)
            visibility = 0;
        else
            visibility = 1;
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/changeServiceVisibility'); ?>",
            data: {
                'serviceID': serviceID,
                'visibility': visibility
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0) {
                    simpleSuccessAlert('<?php echo lang('Text.success_change_visibility'); ?>');
                    getServices();
                } else {
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