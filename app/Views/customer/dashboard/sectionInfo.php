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
    <span class="badge badge-light-primary"><?php echo lang('Text.profile'); ?></span>

</div>

<div id="kt_user_view_details" class="collapse show">
    <div class="pb-5 fs-6">

        <!-- Email -->
        <div class="fw-bold mt-5"><?php echo lang('Text.email'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $customer[0]->email; ?></span>
        </div>

        <!-- Phone -->
        <div class="fw-bold mt-5"><?php echo lang('Text.phone'); ?></div>
        <?php if (!empty($customer[0]->phone)) { ?>
            <div class="text-gray-600">
                <span class="text-gray-600"><?php echo $customer[0]->phone; ?></span>
            </div>
        <?php } else { ?>
            <div class="text-gray-600">
                <span class="badge badge-light-danger"><?php echo lang('Text.no_registered'); ?></span>
            </div>
        <?php } ?>

        <!-- Address -->
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

        <?php if (empty($customer[0]->emailVerified)) { ?>
            <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 mt-10">
                <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
                    <span><?php echo lang('Text.email'); ?> <?php echo lang('Text.not_verified'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-sm btn-light btn-active-color-primary"><i class="bi bi-envelope-check"></i> <?php echo lang('Text.cust_resend_verify_email'); ?></button>
                </div>
            </div>
        <?php } ?>

    </div>
</div>