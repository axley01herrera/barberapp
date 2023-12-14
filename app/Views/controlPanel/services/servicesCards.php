<div class="container g-10 draggable-zone" tabindex="0">
    <?php
    usort($services, function ($a, $b) {
        return $a->ordering <=> $b->ordering;
    });
    foreach ($services as $s) { ?>
        <div class="col draggable serviceCard mt-4" tabindex="0" data-service-id="<?php echo $s->id; ?>" data-order="<?php echo $s->ordering; ?>">
            <div class="card card-bordered">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label"><?php echo $s->title; ?> </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary draggable-handle">
                            <i class="ki-duotone ki-abstract-14 fs-2x"><span class="path1"></span><span class="path2"></span></i> </a>
                    </div>
                </div>
                <div class="card-body">
                    <h2><?php echo getMoneyFormat($config[0]->currency, $s->price); ?></h2>
                    <h6><?php echo lang('Text.duration_of'); ?> <?php echo $s->time; ?> <?php echo lang('Text.minutes'); ?></h6>
                    <p><?php echo $s->description; ?></p>
                    <div class="row">
                        <div class="col-2 col-lg-1 m-2">
                            <label class="mb-2"><?php echo lang('Text.status'); ?></label>
                            <div class=" form-check form-switch form-check-solid">
                                <input type="checkbox" class="form-check-input form-control change-status" title="<?php echo lang('Text.change_status'); ?>" <?php if ($s->status == 1) echo 'checked=""'; ?> data-service-id="<?php echo $s->id; ?>" data-status="<?php echo $s->status ?>">
                            </div>
                        </div>
                        <div class="col-2 col-lg-1 m-2">
                            <label class="mb-2"><?php echo lang('Text.visibility'); ?></label>
                            <div class=" form-check form-switch form-check-solid">
                                <input type="checkbox" class="form-check-input form-control change-visibility" title="<?php echo lang('Text.change_visibility'); ?>" <?php if ($s->visibility == 1) echo 'checked=""'; ?> data-service-id="<?php echo $s->id; ?>" data-visibility="<?php echo $s->visibility ?>">
                            </div>
                        </div>
                        <div class="col-4 col-lg-1 mt-6">
                            <button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-service" data-service-id="<?php echo $s->id; ?>" title="<?php echo lang('Text.btn_edit'); ?>"><span class="bi bi-pencil-square"></span></button>
                        </div>
                    </div>
                </div>
            </div>
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
    var target = document.querySelectorAll('.serviceCard');

    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                $(target).each(function() {
                    let serviceID = $(this).attr('data-service-id');
                    let newOrder = $(this).prevAll().length + 1; // Contar el número de elementos hermanos previos al elemento que se ha movido

                    // Actualizar el atributo data-order
                    $(this).attr('data-order', newOrder);

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('ControlPanel/updateServicesOrder') ?>',
                        data: {
                            serviceID: serviceID,
                            newOrder: newOrder
                        },
                        success: function(response) {

                        },
                        error: function(error) {

                        }
                    });
                });
            }
        });
    });

    var config = {
        childList: true,
        subtree: true
    };

    observer.observe(document.body, config);

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
        if ($(this).attr('data-status') == 1)
            $(this).attr('data-status', 0);
        else
            $(this).attr('data-status', 1);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/changeServiceStatus'); ?>",
            data: {
                'serviceID': serviceID,
                'status': $(this).attr('data-status')
            },
            dataType: "json",
            success: function(response) {
                if (response.error != 0) {
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
        if ($(this).attr('data-visibility') == 1)
            $(this).attr('data-visibility', 0);
        else
            $(this).attr('data-visibility', 1);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/changeServiceVisibility'); ?>",
            data: {
                'serviceID': serviceID,
                'visibility': $(this).attr('data-visibility')
            },
            dataType: "json",
            success: function(response) {
                if (response.error != 0) {
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