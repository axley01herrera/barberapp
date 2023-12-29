<style>
    .scroll-container {
        height: 50px;
        overflow: auto;
    }
</style>
<?php foreach ($upcomingAppointments as $a) { ?>
    <div class="<?php echo @$col; ?> mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row gx-9 h-100">
                    <div class="col-12">
                        <div class="d-flex flex-column h-100">

                            <!-- Date -->
                            <div class="flex-shrink-0 me-5 mb-5">
                                <span class="text-gray-800 fs-4 fw-bold me-2 d-block lh-1 pb-1">
                                    <?php
                                    if ($config[0]->lang == 'en')
                                        echo date('F j, Y', strtotime($a->date));
                                    else {
                                        $mont =  date('F', strtotime($a->date));
                                        echo lang('Text.' . $mont) . ' ' . date('j, Y', strtotime($a->date));
                                    }
                                    ?>
                                </span>
                                <span class="text-gray-800 fs-7 fw-bold"><i class="bi bi-clock-history fs-7"></i> <?php echo date('g:i a', strtotime($a->start)); ?> - <?php echo date('g:i a', strtotime($a->end)); ?></span>
                            </div>

                            <!-- Services -->
                            <div class="mb-7 scroll-container">
                                <div class=" align-items-center  d-grid gap-2">
                                    <div class=" align-items-center me-5 me-xl-13">
                                        <?php
                                        $price = 0;
                                        foreach (json_decode($a->services) as $s) {
                                            $price = $price + labelService($s)[0]->price;
                                        ?>
                                            <div class="fw-semibold"><span class="bullet bullet-dot bg-primary me-2 h-10px w-10px"></span> <?php echo labelService($s)[0]->title; ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-7">
                                <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                    <!-- Employee -->
                                    <div class="d-flex align-items-center me-5 me-xl-13">
                                        <div class="symbol symbol-30px symbol-circle me-3">
                                            <img src="<?php echo imgEmployee($a->employeeID); ?>" class="" alt="">
                                        </div>
                                        <div class="m-0">
                                            <span class="fw-semibold text-gray-400 d-block fs-8"><?php echo lang('Text.employee'); ?></span>
                                            <span class="fw-bold text-gray-800 text-hover-primary fs-7"><?php echo labelEmployeeName($a->employeeID); ?></span>
                                        </div>
                                    </div>
                                    <!-- Price -->
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px symbol-circle me-3">
                                            <span class="symbol-label bg-success">
                                                <i class="ki-duotone ki-abstract-41 fs-5 text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span class="fw-semibold text-gray-400 d-block fs-8"><?php echo lang('Text.price'); ?></span>
                                            <span class="fw-bold text-gray-800 fs-7"><?php echo getMoneyFormat($config[0]->currency, $price); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <a href="#" class="btn btn-sm btn-danger cancel-appointment<?php echo $uniqid; ?>" data-appointment-id="<?php echo $a->id; ?>"><?php echo lang('Text.btn_cancel'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if (empty($upcomingAppointments)) { ?>
    <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 mb-7 mt-5">
        <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
            <span><?php echo lang('Text.cust_no_future_appointments'); ?></span>
        </div>
    </div>
<?php } ?>
<script>
    $('.cancel-appointment<?php echo $uniqid; ?>').on('click', function(e) {
        e.preventDefault();
        let appointmentID = $(this).attr('data-appointment-id');
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
                    url: "<?php echo base_url('Customer/cancelAppointment'); ?>",
                    data: {
                        'appointmentID': appointmentID
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) { // Success
                            simpleSuccessAlert("<?php echo lang('Text.success_cancel_turn'); ?>");
                            setTimeout(() => {
                                window.location.reload();
                            }, "2000");
                        } else if (response.error == 2) { // Session Expired
                            window.location.href = "<?php echo base_url('Home/signInCustomer?session=expired'); ?>";
                        } else
                            globalError();
                    },
                    error: function() {
                        globalError();
                    }
                });
            }
        });
    });
</script>