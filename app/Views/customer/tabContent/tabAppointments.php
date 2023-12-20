<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cust_appointment_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cust_appointment_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_create_appointment'); ?></button>
        </div>
    </div>
</div>
<div class="row m-1">
    <?php if (empty($appointments)) { ?>
        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mt-2">
                <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
                    <span><?php echo lang('Text.cust_not_have_turns'); ?></span>
                </div>
            </div>
    <?php } else { ?>
        <?php foreach ($appointments as $a) { ?>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="d-flex align-items-center border-1 border-dashed card-rounded mh-200px p-5 p-lg-10 mb-6">
                    <div class="text-center flex-shrink-0 w-100px" style="margin-right: 50px;">
                        <!--Avatar-->
                        <div class="symbol symbol-70px symbol-circle mb-2">
                            <?php if (empty($a['employeeAvatar'])) { ?>
                                <img src="<?php echo base_url('public/assets/media/avatars/blank.png'); ?>" class="border border-1 border-secondary" alt="Avatar">
                            <?php } else { ?>
                                <img src="data:image/png;base64,<?php echo base64_encode($a['employeeAvatar']); ?>" class="border border-1 border-secondary" alt="Avatar">
                            <?php } ?>
                        </div>
                        <!--Avatar-->
                        <div class="mb-0">
                            <span class="text-gray-700 d-block fw-bold"><?php echo $a['employeeName']; ?></span>
                            <span class="text-gray-700 d-block fw-bold"><?php echo $a['employeeLastName']; ?></span>
                            <span class="text-gray-400 fs-7 fw-semibold d-block mt-1"><?php echo lang('Text.employee'); ?></span>
                        </div>
                    </div>
                    <div class="mb-0 fs-6">
                        <?php foreach ($a['services'] as $s) { ?>
                            <div class="text-muted fw-semibold lh-lg fs-8"><?php echo $s->title; ?></div>
                            <div class="text-muted fw-bold lh-lg mb-1 fs-7"><?php echo getMoneyFormat($config[0]->currency, $s->price); ?></div>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-danger fs-8 cancel-turn<?php echo $uniqid; ?> fw-semibold text-end" data-appoint-id="<?php echo $a['appointmentID']; ?>"><?php echo lang('Text.btn_cancel'); ?></button>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
<script>
    $('#btn-<?php echo $uniqid; ?>').on('click', function() { // Create Appointment
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/createAppointment'); ?>",
            dataType: "html",
            success: function(response) {
                $('#tabContent').html(response);
            },
            error: function() {
                globalError();
            }
        });
    });

    $('.cancel-turn<?php echo $uniqid; ?>').on('click', function() {
        Swal.fire({
            title: '<?php echo lang('Text.are_you_sure'); ?>',
            text: "<?php echo lang('Text.not_revert_this'); ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Text.yes_are_sure'); ?>',
            cancelButtonText: '<?php echo lang('Text.no_cancel'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Customer/cancelTurn'); ?>",
                    data: {
                        'appointmentID': $(this).attr('data-appoint-id')
                    },
                    dataType: "json",
                    success: function(response) {
                        simpleSuccessAlert("<?php echo lang('Text.success_cancel_turn'); ?>");
                        customerTabContent();
                    },
                    error: function() {
                        globalError();
                    }
                });
            }
        });
    });
</script>