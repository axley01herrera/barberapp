<div class="d-flex flex-center flex-column py-5">
    <!-- Avatar -->
    <div class="symbol symbol-100px symbol-circle mb-7">
        <?php if (empty($customer[0]->avatar)) { ?>
            <img src="<?php echo base_url('public/assets/media/avatars/blank.png'); ?>" alt="Avatar">
        <?php } ?>
    </div>
    <!-- Name -->
    <p class="fs-3 text-gray-800 fw-bold mb-3"><?php echo $customer[0]->name . ' ' . $customer[0]->lastName; ?></p>
    <a href="<?php echo base_url('Home/signInCustomer'); ?>" class="btn btn-sm btn-danger"><?php echo lang('Text.top_bar_logout'); ?></a>
</div>
<div id="kt_user_view_details" class="collapse show">
    <div class="pb-5 fs-6">
        <div class="fw-bold mt-5"><?php echo lang('Text.email'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $customer[0]->email; ?></span>
        </div>
        <div class="fw-bold mt-5"><?php echo lang('Text.phone'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $customer[0]->phone; ?></span>
        </div>
        <div class="fw-bold mt-5"><?php echo lang('Text.address'); ?></div>
        <div class="text-gray-600">101 Collin Street,
            <br>Melbourne 3000 VIC
            <br>Australia
        </div>
    </div>
</div>