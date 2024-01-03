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
                            <h1 class="text-dark fw-bolder mb-3"><?php echo lang('Text.recover_title'); ?></h1>
                            <div class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.recover_subtitle'); ?></div>
                        </div>

                        <div class="fv-row mb-4">
                            <input type="text" id="txt-email<?php echo $uniqid; ?>" placeholder="Email" autocomplete="off" class="form-control email bg-transparent mb-5 required<?php echo $uniqid; ?>" />
                        </div>

                        <div class="d-grid mb-10">
                            <button type="button" id="btn-send<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_send_recover_pass_email'); ?></button>
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
    $('#btn-send<?php echo $uniqid; ?>').on('click', function() {
        let result = checkRequiredValues();
        if (result == 0) {
            let resultEmail = checkEmailFormat();
            if (resultEmail == 0) {
                $('#btn-send<?php echo $uniqid; ?>').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Home/sendForgotPasswordEmail'); ?>",
                    data: {
                        'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            simpleSuccessAlert('<?php echo lang('Text.recover_success_send_email'); ?>');
                            setTimeout(() => {
                                window.location.href = "<?php echo base_url('/'); ?>";
                            }, "2000");
                        } else if (response.error == 1) {
                            if (response.msg == 'EMAIL_NOT_FOUND') {
                                simpleAlert('<?php echo lang('Text.recover_email_not_found'); ?>', 'warning');
                                $('#txt-email<?php echo $uniqid; ?>').addClass('required is-invalid');
                                $('#btn-send<?php echo $uniqid; ?>').removeAttr('disabled');
                            } else {
                                globalError();
                                $('#btn-send<?php echo $uniqid; ?>').removeAttr('disabled');
                            }
                        }

                    },
                    error: function(error) {
                        globalError();
                        $('#btn-send<?php echo $uniqid; ?>').removeAttr('disabled');
                    }
                });
            } else
                simpleAlert('<?php echo lang('Text.invalid_email_format_msg'); ?>', 'warning');
        } else
            simpleAlert('<?php echo lang("Text.required_values_msg"); ?>', 'warning');
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
</script>