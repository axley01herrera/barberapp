<div id="page" data-page="main-customers" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cust_account_title'); ?>
                </h1>
                <div class="fs-6 fw-semibold text-muted">
                    <?php echo lang('Text.cust_account_subtitle'); ?>
                </div>
            </div>
            <!-- Page Button Action -->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_edit'); ?></button>
            </div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!-- Card -->
            <div class="card mb-5 mb-xl-10 mt-5">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <!-- Email -->
                            <label class="fs-6 fw-semibold" for="txt-email<?php echo $uniqid; ?>"><?php echo lang('Text.email'); ?> <span class="text-danger">*</span></label>
                            <input type="text" id="txt-email<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> email<?php echo $uniqid; ?>" maxlength="150" value="<?php echo $customer[0]->email; ?>" disabled />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4 mt-5">
                            <!-- Current Password -->
                            <label class="fs-6 fw-semibold" for="txt-password<?php echo $uniqid; ?>"><?php echo lang('Text.current_key'); ?></label>
                            <input type="password" id="txt-password<?php echo $uniqid; ?>" class="form-control password focus" disabled placeholder="**********" />
                        </div>
                        <div class="col-12 col-lg-4 mt-5">
                            <!-- New Password -->
                            <label class="fs-6 fw-semibold" for="txt-newPassword<?php echo $uniqid; ?>"><?php echo lang('Text.new_key'); ?></label>
                            <input type="password" id="txt-newPassword<?php echo $uniqid; ?>" class="form-control password focus" disabled placeholder="**********" />
                        </div>
                        <div class="col-12 col-lg-4 mt-5">
                            <!-- Confirm New Password -->
                            <label class="fs-6 fw-semibold" for="txt-confirmNewPassword<?php echo $uniqid; ?>"><?php echo lang('Text.confirm_key'); ?></label>
                            <input type="password" id="txt-confirmNewPassword<?php echo $uniqid; ?>" class="form-control password focus" disabled placeholder="**********" />
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
        window.location.reload();
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
                        url: "<?php echo base_url('Customer/updateAccount'); ?>",
                        data: {
                            'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                            'password': $('#txt-newPassword<?php echo $uniqid; ?>').val(),
                            'currentPassword': $('#txt-password<?php echo $uniqid; ?>').val(),
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.error == 0) {
                                simpleSuccessAlert("<?php echo lang("Text.cust_account_success_updated"); ?>");
                                setTimeout(() => {
                                    window.location.reload();
                                }, "2000");
                            } else if (response.error == 1) {
                                $('#btn-update<?php echo $uniqid; ?>').removeAttr('disabled');
                                if (response.msg == "INVALID_CURRENT_KEY") {
                                    $('#txt-password<?php echo $uniqid; ?>').addClass('is-invalid');
                                    simpleAlert("<?php echo lang('Text.invalid_current_password'); ?>", 'warning')
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
                    simpleAlert("<?php echo lang('Text.password_does_not_match'); ?>", 'warning');
                    $('#txt-confirmNewPassword<?php echo $uniqid; ?>').addClass('is-invalid');
                }
            } else
                simpleAlert("<?php echo lang('Text.invalid_email_format'); ?>", 'warning');
        } else
            simpleAlert("<?php echo lang('Text.required_values'); ?>", 'warning');
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