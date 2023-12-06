<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.top_bar_services'); ?>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button id="btn-new-serv<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang("Text.serv_new"); ?></button>
            </div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <?php foreach ($services as $service) { ?>
                <div class="card shadow-sm mt-5">
                    <div class="card-header">
                        <!-- Service Title -->
                        <h3 class="card-title"><?php echo $service->title; ?></h3>
                        <div class="card-toolbar">
                            <!-- Btn Edit -->
                            <button type="button" class="btn btn-sm btn-light edit-service" data-service-id="<?php echo $service->id; ?>">
                                <?php echo lang("Text.btn_edit"); ?>
                            </button>
                        </div>
                    </div>
                    <!-- Service Description -->
                    <div class="card-body">
                        <?php if (!empty($service->description)) { ?>
                            <div class="alert bg-light-primary d-flex align-items-center p-5">
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark"><?php echo lang("Text.description"); ?></h4>
                                    <span><?php echo $service->description; ?></span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="alert bg-light-danger d-flex align-items-center p-5">
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark"><?php echo lang("Text.description"); ?></h4>
                                    <span><?php echo lang("Text.serv_no_desc"); ?></span>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-12 text-end mt-5">
                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">
                                    <?php echo getMoneyFormat($config[0]->currency, $service->price); ?>
                                </span>
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
        $('#btn-new-serv<?php echo $uniqid; ?>').on('click', function() { // Create Service
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
        });
    });
</script>