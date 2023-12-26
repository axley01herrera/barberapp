<div class="d-flex flex-center flex-column py-5">
    <!-- Avatar -->
    <div class="symbol symbol-100px symbol-circle mb-7">
        <?php if (empty($customer[0]->avatar)) { ?>
            <img src="<?php echo base_url('public/assets/media/avatars/blank.png'); ?>" class="border border-1 border-secondary" alt="Avatar">
        <?php } else { ?>
            <img src="data:image/png;base64,<?php echo base64_encode($customer[0]->avatar); ?>" class="border border-1 border-secondary" alt="Avatar">
        <?php } ?>
    </div>
    <!-- Name -->
    <p class="fs-3 text-gray-800 fw-bold mb-3"><?php echo $customer[0]->name . ' ' . $customer[0]->lastName; ?></p>
    <?php if ($customer[0]->status == 1) { ?>
        <span class="badge badge-light-success"><?php echo lang('Text.active'); ?></span>
    <?php } else { ?>
        <span class="badge badge-light-danger"><?php echo lang('Text.inactive'); ?></span>
    <?php } ?>
</div>
<div id="kt_user_view_details" class="collapse show">
    <div class="pb-5 fs-6">
        <div class="fw-bold mt-5"><?php echo lang('Text.email'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $customer[0]->email; ?></span>
        </div>
        <?php if (!empty($customer[0]->phone)) { ?>
            <div class="fw-bold mt-5"><?php echo lang('Text.phone'); ?></div>
            <div class="text-gray-600">
                <span class="text-gray-600"><?php echo $customer[0]->phone; ?></span>
            </div>
        <?php } ?>
        <?php if (!empty($customer[0]->address1) && !empty($customer[0]->city) && !empty($customer[0]->state) && !empty($customer[0]->zip) && !empty($customer[0]->country)) { ?>
            <section>
                <div class="fw-bold mt-5"><?php echo lang('Text.address'); ?></div>
                <div class="text-gray-600">
                    <?php echo @$customer[0]->address1; ?>
                    <?php if (@$customer[0]->address2) echo ", " . $customer[0]->address2; ?>
                    <br>
                    <?php echo @$customer[0]->city; ?>
                    <?php if (@$customer[0]->state) echo ", " .  $customer[0]->state; ?>
                    <br>
                    <?php echo @$customer[0]->zip; ?> <?php echo @$customer[0]->country; ?>
                </div>
            </section>
        <?php } ?>
        <?php if (empty($customer[0]->phone)) { ?>
            <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10 mt-10">
                <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
                    <span><?php echo lang('Text.emp_incomplete_profile_msg'); ?></span>
                </div>
            </div>
        <?php } ?>
    </div>
</div>