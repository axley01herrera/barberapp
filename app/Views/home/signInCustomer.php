<div class="d-flex flex-column flex-root" id="kt_app_root">
    <style>
        body {
            background-image: url('<?php echo base_url('assets/media/auth/bg4.jpg'); ?>');
        }

        [data-bs-theme="dark"] body {
            background-image: url('<?php echo base_url('assets/media/auth/bg4-dark.jpg'); ?>');
        }
    </style>
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <div class="d-flex flex-column-fluid justify-content-center justify-content-center p-12 p-lg-20">
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <div class="form w-100">
                        <div class="text-center mb-11">
                            <!-- Logo 
                                <span class="mb-7">
                                    <img alt="Logo" src="<?php // echo base_url('assets/media/logos/logoDark.png'); 
                                                            ?>" class="w-50" />
                                </span>-->
                            <h1 class="text-dark fw-bolder mb-3"><?php echo lang('Text.sign_title'); ?></h1>
                            <div class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.sign_subtitle'); ?></div>
                        </div>

                        <div class="fv-row mb-4">
                            <input type="text" id="txt-email<?php echo $uniqid; ?>" placeholder="<?php echo lang('Text.email'); ?>" autocomplete="off" class="form-control email bg-transparent mb-5 required<?php echo $uniqid; ?>" />
                            <input type="password" id="txt-pass<?php echo $uniqid; ?>" placeholder="<?php echo lang('Text.password'); ?>" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                        </div>

                        <div class="d-grid mb-5 text-end">
                            <a href="<?php echo base_url('Home/forgotPassword'); ?>"><?php echo lang('Text.sign_forgot_pass'); ?></a>
                        </div>

                        <div class="d-grid mb-10">
                            <button type="button" id="btn-login<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_signing'); ?></button>
                        </div>

                        <div class="d-grid mb-10 text-center">
                            <a href="<?php echo base_url('/'); ?>" class="link-primary"><?php echo lang("Text.btn_home") ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn-login<?php echo $uniqid; ?>').on('click', function() {
        let result = checkRequiredValues();
        if (result == 0) {
            let resultEmail = checkEmailFormat();
            if (resultEmail == 0) {
                $('#btn-login<?php echo $uniqid; ?>').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Home/signInCustomerProcess'); ?>",
                    data: {
                        'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                        'pass': $('#txt-pass<?php echo $uniqid; ?>').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            window.location.href = "<?php echo base_url('Customer/index'); ?>";
                        } else if (response.error == 1) {
                            if (response.msg == 'EMAIL_NOT_FOUND') {
                                simpleAlert('<?php echo lang('Text.invalid_credentials') ?>', 'warning');
                                $('#txt-email<?php echo $uniqid; ?>').addClass('required is-invalid');
                                $('#txt-pass<?php echo $uniqid; ?>').addClass('required is-invalid');
                            } else if (response.msg == 'USER_INACTIVE') {
                                simpleAlert('<?php echo lang('Text.user_inactive_msg'); ?>', 'warning');
                            } else if (response.msg == 'INVALID_PASSWORD') {
                                simpleAlert('<?php echo lang('Text.invalid_password'); ?>', 'warning');
                                $('#txt-pass<?php echo $uniqid; ?>').addClass('is-invalid');
                                $('#btn-login<?php echo $uniqid; ?>').removeAttr('disabled');
                            } else {
                                globalError();
                                $('#btn-login<?php echo $uniqid; ?>').removeAttr('disabled');
                            }
                            $('#btn-login<?php echo $uniqid; ?>').removeAttr('disabled');
                        }
                    },
                    error: function(error) {
                        globalError();
                        $('#btn-login<?php echo $uniqid; ?>').removeAttr('disabled');
                    }
                });
            } else
                simpleAlert('<?php echo lang('Text.invalid_email_format'); ?>', 'warning');
        } else
            simpleAlert('<?php echo lang("Text.required_values"); ?>', 'warning');
    }); // ok

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

    $('.required<?php echo $uniqid; ?>').on('focus', function() {
        $(this).removeClass('is-invalid');
    });

    function checkEmailFormat() {
        let inputValue = '';
        let response = 0;
        let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        $('.email').each(function() {
            inputValue = $(this).val();
            if (!regex.test(inputValue)) {
                $(this).addClass('is-invalid');
                response = 1;
            }
        });
        return response;
    }

    var session = "<?php echo $session; ?>";

    if (session == "expired") {
        simpleAlert("<?php echo lang('Text.session_expired'); ?>", "error");
    }
</script>