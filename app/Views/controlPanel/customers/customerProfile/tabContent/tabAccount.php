<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_cust_profile_tab_account_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_cust_profile_tab_account_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_edit'); ?></button>
        </div>
    </div>
    <div class="card-body p-9 pt-4">
        <div class="row">
            <div class="col-12 col-lg-4"></div>
            <div class="col-12 col-lg-4">
                <div class="row">

                    <div class="col-12">
                        <!-- Email -->
                        <label class="fs-6 fw-semibold" for="txt-email<?php echo $uniqid; ?>"><?php echo lang('Text.cp_cust_email'); ?></label>
                        <input type="text" id="txt-email<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> email<?php echo $uniqid; ?>" maxlength="150" value="<?php echo $customer[0]->email; ?>" disabled />
                    </div>

                    <div class="col-12 mt-5">
                        <!-- Current Password -->
                        <label class="fs-6 fw-semibold" for="txt-password<?php echo $uniqid; ?>"><?php echo lang('Text.cp_cust_current_pass'); ?></label>
                        <input type="password" id="txt-password<?php echo $uniqid; ?>" class="form-control password focus" disabled placeholder="**********" />
                    </div>

                    <div class="col-12 mt-5">
                        <!-- New Password -->
                        <label class="fs-6 fw-semibold" for="txt-newPassword<?php echo $uniqid; ?>"><?php echo lang('Text.cp_cust_new_pass'); ?></label>
                        <input type="password" id="txt-newPassword<?php echo $uniqid; ?>" class="form-control password focus" disabled placeholder="**********" />
                    </div>

                    <div class="col-12 mt-5">
                        <!-- Confirm New Password -->
                        <label class="fs-6 fw-semibold" for="txt-confirmNewPassword<?php echo $uniqid; ?>"><?php echo lang('Text.cp_cust_new_pass_c'); ?></label>
                        <input type="password" id="txt-confirmNewPassword<?php echo $uniqid; ?>" class="form-control password focus" disabled placeholder="**********" />
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-end mt-5 mb-5">
                <button hidden type="button" id="btn-cancel<?php echo $uniqid; ?>" class="btn btn-secondary"><?php echo lang('Text.btn_cancel'); ?></button>
                <button hidden type="button" id="btn-update<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_update'); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn-<?php echo $uniqid; ?>').on('click', function() { // Enable Edit
        $('.form-control').each(function() {
            $(this).removeAttr('disabled');
        });
        $(this).attr('hidden', true);
        $('#btn-cancel<?php echo $uniqid; ?>').removeAttr('hidden');
        $('#btn-update<?php echo $uniqid; ?>').removeAttr('hidden');
    });

    $('#btn-cancel<?php echo $uniqid; ?>').on('click', function() { // Cancel Edit
        customerTabContent();
    });

    $('#btn-update<?php echo $uniqid; ?>').on('click', function() { // Submit
        let flag = 0;
        $('.password').each(function() {
            if ($(this).val() != '') {
                $(this).addClass('required<?php echo $uniqid; ?>');
                flag = 1;
            }
        });
        if (flag == 1) {
            $('.password').each(function() {
                $(this).addClass('required<?php echo $uniqid; ?>');
            });
        }
        let result = checkRequiredValues();
        if (result === 0) {
            let resultEmail = checkEmailFormat();
            if (resultEmail === 0) {
                if ($('#txt-newPassword<?php echo $uniqid; ?>').val() === $('#txt-confirmNewPassword<?php echo $uniqid; ?>').val()) {
                    $('#btn-update<?php echo $uniqid; ?>').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('ControlPanel/updateCustomerAccount'); ?>",
                        data: {
                            'customerID': customerID,
                            'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                            'password': $('#txt-newPassword<?php echo $uniqid; ?>').val(),
                            'currentPassword': $('#txt-password<?php echo $uniqid; ?>').val(),
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.error == 0) {
                                simpleSuccessAlert("<?php echo lang("Text.cp_cust_account_success_updated"); ?>");
                                reloadCustomerInfo();
                                customerTabContent();
                            } else if (response.error == 1) {
                                $('#btn-update<?php echo $uniqid; ?>').removeAttr('disabled');
                                if (response.msg == "INVALID_CURRENT_KEY") {
                                    $('#txt-password<?php echo $uniqid; ?>').addClass('is-invalid');
                                    simpleAlert("<?php echo lang('Text.invalid_current_password_msg'); ?>", 'warning')
                                } else
                                    globalError();

                            } else
                                window.location.href = "<?php echo base_url('Home/signInCustomer?session=expired'); ?>";

                            $('#btn-update<?php echo $uniqid; ?>').removeAttr('disabled');
                        },
                        error: function(error) {
                            globalError();
                            $('#btn-update<?php echo $uniqid; ?>').removeAttr('disabled');
                        }
                    });
                } else {
                    simpleAlert("<?php echo lang('Text.password_label_does_not_match'); ?>", 'warning');
                    $('#txt-confirmNewPassword<?php echo $uniqid; ?>').addClass('is-invalid');
                }
            } else
                simpleAlert("<?php echo lang('Text.invalid_email_format_msg'); ?>", 'warning');
        } else
            simpleAlert("<?php echo lang('Text.required_values_msg'); ?>", 'warning');
    });

    function checkRequiredValues() {
        let result = 0;
        let value = "";

        $('.required<?php echo $uniqid; ?>').each(function() {
            value = $(this).val();
            if (value == "") {
                $(this).addClass('is-invalid');
                result = 1;
            }
        });
        return result;
    }

    function checkEmailFormat() {
        let inputValue = '';
        let response = 0;
        let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        $('.email<?php echo $uniqid; ?>').each(function() {
            inputValue = $(this).val();
            if (!regex.test(inputValue)) {
                $(this).addClass('is-invalid');
                response = 1;
            }
        });
        return response;
    }

    $('.required<?php echo $uniqid; ?>').on('focus', function() {
        $(this).removeClass('is-invalid');
    });

    $('.focus').on('input change', function() {
        let value = $(this).val();
        if (value == '')
            $(this).addClass('is-invalid');
        else
            $(this).removeClass('is-invalid');
    });
</script>