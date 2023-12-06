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
    <a href="<?php echo base_url('Home/signInCustomer'); ?>" class="btn btn-sm btn-danger"><?php echo lang('Text.top_bar_logout'); ?></a>
</div>
<div id="kt_user_view_details" class="collapse show">
    <div class="pb-5 fs-6">
        <div class="fw-bold mt-5"><?php echo lang('Text.email'); ?> <i <?php $notCheck = lang('Text.email_not_check');
                                                                        $check = lang('Text.email_check');
                                                                        if ($customer[0]->emailVerified == 0) echo "class='bi bi-envelope-exclamation-fill text-danger' title='$notCheck'";
                                                                        else echo "class='bi bi-envelope-check-fill text-success' title='$check'"; ?>></i></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $customer[0]->email; ?></span>
        </div>
        <div class="fw-bold mt-5"><?php echo lang('Text.phone'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $customer[0]->phone; ?></span>
        </div>
        <div class="fw-bold mt-5"><?php echo lang('Text.address'); ?></div>
        <div class="text-gray-600"><?php echo @$address[0]->line1; ?><?php if (@$address[0]->line2) echo ", " . '' . $address[0]->line2; ?>
            <br><?php echo @$address[0]->city; ?><?php if (@$address[0]->state) echo ", " . '' .  $address[0]->state; ?>
            <br><?php echo @$address[0]->country; ?>
        </div>
    </div>
</div>