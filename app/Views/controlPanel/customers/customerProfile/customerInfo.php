<div class="d-flex flex-center flex-column py-5">
    <!-- Avatar -->
    <div class="symbol symbol-100px symbol-circle mb-7">
        <?php if (empty($customer[0]->avatar)) { ?>
            <img src="<?php echo base_url('public/assets/media/avatars/blank.png'); ?>" class="border border-1 border-secondary" alt="Avatar">
        <?php } else { ?>
            <img src="data:image/png;base64,<?php echo base64_encode($customer[0]->avatar); ?>" class="border border-1 border-secondary" alt="Avatar">
        <?php } ?>
    </div>
</div>

<div id="kt_user_view_details" class="collapse show">
    <div class="pb-5 fs-6">

        <!-- Full Name -->
        <div class="fw-bold mt-5"><?php echo lang('Text.cp_cust_full_name'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $customer[0]->name . ' ' . $customer[0]->lastName; ?></span>
        </div>

        <!-- Email -->
        <div class="fw-bold mt-5"><?php echo lang('Text.cp_cust_email'); ?></div>
        <div class="text-gray-600">
            <span class="text-gray-600"><?php echo $customer[0]->email; ?></span>
        </div>

        <!-- Phone -->
        <div class="fw-bold mt-5"><?php echo lang('Text.cp_cust_phone'); ?></div>
        <?php if (!empty($customer[0]->phone)) { ?>
            <div class="text-gray-600">
                <span class="text-gray-600"><?php echo $customer[0]->phone; ?></span>
            </div>
        <?php } else { ?>
            <div class="text-gray-600">
                <span class="badge badge-light-danger"><?php echo lang('Text.cp_cust_no_registered_phone'); ?></span>
            </div>
        <?php } ?>

        <!-- Last Session -->
        <?php if (!empty($customer[0]->lastSession)) { ?>
        <div class="fw-bold mt-5"><?php echo lang('Text.cp_cust_last_session'); ?></div>
            <div class="text-gray-600">
                <span class="text-gray-600"><?php echo date($dateLabel . ' g:ia', strtotime($customer[0]->lastSession)); ?></span>
            </div>
        <?php } ?>
        
        <!-- Condition Verify Email -->
        <?php if (empty($customer[0]->emailVerified)) { ?>
            <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 mt-10">
                <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
                    <span><?php echo lang('Text.cp_cust_email'); ?> <?php echo lang('Text.cp_cust_not_verified_email'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button type="button" id="btn-resendEmail<?php echo $uniqid; ?>" class="btn btn-sm btn-light btn-active-color-primary"><i class="bi bi-envelope-check"></i> <?php echo lang('Text.cp_cust_resend_verify_email'); ?></button>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<script>
    $('#btn-resendEmail<?php echo $uniqid; ?>').on('click', function() {
        $(this).attr('disabled', true);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Customer/resendVerifyEmail') ?>",
            dataType: "json",
            success: function(response) {
                if (response.error == 0) {
                    simpleSuccessAlert(response.msg);
                    $('#btn-resendEmail<?php echo $uniqid; ?>').removeAttr('disabled');
                } else {
                    globalError();
                    $('#btn-resendEmail<?php echo $uniqid; ?>').removeAttr('disabled');
                }
            },
            error: function(error) {
                globalError();
                $('#btn-resendEmail<?php echo $uniqid; ?>').removeAttr('disabled');
            }
        });
    });
</script>