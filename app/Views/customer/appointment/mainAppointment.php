<div id="page" data-page="main-customers" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cust_appointment_title'); ?>
                </h1>
                <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cust_appointment_subtitle'); ?></div>
            </div>
            <!-- Page Button Action -->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="<?php echo base_url('Customer/createAppointment'); ?>" class="btn btn-primary"><?php echo lang('Text.btn_create_appointment'); ?></a>
            </div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row">
                <!-- U pcomingAppointments -->
                <div class="col-12 col-md-4 col-lg-4">
                    <?php foreach ($upcomingAppointments as $a) { ?>
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gx-9 h-100">
                                        <div class="col-12">
                                            <div class="d-flex flex-column h-100">

                                                <!-- Date -->
                                                <div class="flex-shrink-0 me-5 mb-5">
                                                    <span class="text-gray-400 fs-7 fw-bold me-2 d-block lh-1 pb-1"><?php echo date($dateLabel, strtotime($a->date)); ?></span>
                                                    <span class="text-gray-800 fs-1 fw-bold"><?php echo date('g:i a', strtotime($a->start)); ?> - <?php echo date('g:i a', strtotime($a->end)); ?></span>
                                                </div>

                                                <!-- Services -->
                                                <div class="mb-7">
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
                                            <a href="#" class="btn btn-sm btn-danger cancel-appointment"><?php echo lang('Text.btn_cancel') ?></a>
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
                </div>
            </div>
        </div>
    </div>
</div>