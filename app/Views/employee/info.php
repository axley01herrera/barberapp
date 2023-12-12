<div class="d-flex flex-center flex-column py-5">
    <!-- Avatar -->
    <div class="symbol symbol-100px symbol-circle mb-7">
        <?php if (empty($employee[0]->avatar)) { ?>
            <img src="<?php echo base_url('public/assets/media/avatars/blank.png'); ?>" class="border border-1 border-secondary" alt="Avatar">
        <?php } else { ?>
            <img src="data:image/png;base64,<?php echo base64_encode($employee[0]->avatar); ?>" class="border border-1 border-secondary" alt="Avatar">
        <?php } ?>
    </div>
    <!-- Name -->
    <p class="fs-3 text-gray-800 fw-bold mb-3"><?php echo $employee[0]->name . ' ' . $employee[0]->lastName; ?></p>
    <a href="<?php echo base_url('Home/signInEmployee'); ?>" class="btn btn-sm btn-danger">Salir</a>
</div>
<div id="kt_user_view_details" class="collapse show">
    <div class="pb-5 fs-6">
        <div class="fw-bold mt-5"><?php echo lang('Text.email'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $employee[0]->email; ?></span>
        </div>
        <!-- Phone-->
        <?php if (!empty($employee[0]->phone)) { ?>
            <div class="fw-bold mt-5"><?php echo lang('Text.phone'); ?></div>
            <div class="text-gray-600">
                <span class="text-gray-600">
                    <?php echo $employee[0]->phone; ?>
                </span>
            </div>
            <div class="fw-bold mt-5"><?php echo lang('Text.address'); ?></div>
            <div class="text-gray-600">
                <?php echo @$address[0]->line1; ?>
                <?php if (@$address[0]->line2) echo ", " . $address[0]->line2; ?>
                <br>
                <?php echo @$address[0]->city; ?>
                <?php if (@$address[0]->state) echo ", " .  $address[0]->state; ?>
                <br>
                <?php echo @$address[0]->zip; ?> <?php echo @$address[0]->country; ?>
            </div>
        <?php } ?>

        <?php if (empty($employee[0]->phone)) { ?>
            <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 mt-10">
                <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1"><?php echo lang('Text.important'); ?></h5>
                    <span><?php echo lang('Text.emp_incomplete_profile_msg'); ?></span>
                </div>
            </div>
        <?php } ?>
    </div>
</div>