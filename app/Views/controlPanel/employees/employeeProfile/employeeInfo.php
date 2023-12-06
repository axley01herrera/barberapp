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
</div>
<div id="kt_user_view_details" class="collapse show">
    <div class="pb-5 fs-6">
        <div class="fw-bold mt-5"><?php echo lang('Text.email'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $employee[0]->email; ?></span>
        </div>
        <div class="fw-bold mt-5"><?php echo lang('Text.phone'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo @$employee[0]->phone; ?></span>
        </div>
        <div class="fw-bold mt-5"><?php echo lang('Text.address'); ?></div>
        <div class="text-gray-600"><?php echo @$address[0]->line1; ?><?php if (@$address[0]->line2) echo ", " . '' . $address[0]->line2; ?>
            <br><?php echo @$address[0]->city; ?><?php if (@$address[0]->state) echo ", " . '' .  $address[0]->state; ?>
            <br><?php echo @$address[0]->country; ?>
        </div>
    </div>
</div>