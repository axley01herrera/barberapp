<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.emp_overview_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.emp_overview_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar"></div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        <div class="row">
            <!-- Services -->
            <div class="col-12 col-md-6 col-lg-6 mb-5">
                <div class="bg-light-primary bg-opacity-70 rounded-2 px-6 py-5">
                    <div class="m-0">
                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><?php echo sizeof($employeeServices); ?></span>
                        <span class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.emp_asigned_services'); ?></span>
                    </div>
                </div>
            </div>
            <!-- Email Verified -->
            <div class="col-12 col-md-6 col-lg-6 mb-5">
                <?php if ($employee[0]->emailVerified == 1) { ?>
                    <div class="bg-light-success bg-opacity-70 rounded-2 px-6 py-5">
                        <div class="m-0">
                            <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><i class="bi bi-envelope-check fs-2qx text-gray-700 fw-bolder"></i></span>
                            <span class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.emp_verified_email'); ?></span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="bg-light-danger bg-opacity-70 rounded-2 px-6 py-5">
                        <div class="m-0">
                            <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><i class="bi bi-envelope-dash fs-2qx text-gray-700 fw-bolder"></i></span>
                            <span class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.emp_unverified_email'); ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Section Chart Employee Times -->
        <?php echo view('controlPanel/employees/employeeProfile/chartEmployeeTimes'); ?>
    </div>
</div>

