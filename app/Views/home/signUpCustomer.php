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
                            <h1 class="text-dark fw-bolder mb-3"><?php echo lang('Text.form_registration') ?></h1>
                            <div class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.registration_subtitle'); ?></div>
                        </div>

                        <form class="form" id="kt_signup">

                            <div class="row mb-8">

                                <div class="col-12 mb-5">
                                    <input type="text" id="txt-name<?php echo $uniqid; ?>" placeholder="<?php echo lang('Text.name'); ?>" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" autofocus />
                                </div>

                                <div class="col-12 mb-5">
                                    <input type="text" id="txt-lastName<?php echo $uniqid; ?>" placeholder="<?php echo lang('Text.last_name'); ?>" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                                </div>

                                <div class="col-12 mb-5">
                                    <input type="email" id="txt-email<?php echo $uniqid; ?>" placeholder="<?php echo lang('Text.email'); ?>" autocomplete="off" class="form-control bg-transparent email required<?php echo $uniqid; ?>" />
                                </div>

                                <div class="col-12 mb-5">
                                    <input type="password" id="txt-pass<?php echo $uniqid; ?>" placeholder="<?php echo lang('Text.password'); ?>" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                                </div>

                                <div class="col-12 mb-5">
                                    <input type="password" id="txt-confirmPass<?php echo $uniqid; ?>" placeholder="<?php echo lang('Text.password_repeat'); ?>" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                                </div>

                                <div class="col-12">
                                    <input type="checkbox" id="check-terms" data-value="0"> <label for="check-terms" class="text-muted"><?php echo lang('Text.registration_accept_text') ?> <a href="#" id="show-modal-policy-privacy"><?php echo lang('Text.registration_policy_privacy'); ?></a></label>.
                                </div>
                            </div>

                            <div class="d-grid mb-10">
                                <button type="button" id="btn-create<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_create_account'); ?></button>
                            </div>

                            <!-- Home -->
                            <div class="row">
                                <div class="col-12 text-center mb-10">
                                    <a href="<?php echo base_url('/'); ?>" class="link-primary"><i class="bi bi-house-up link-primary"></i> <?php echo lang("Text.btn_home") ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var terms = 0;

    $('#check-terms').on('click', function() {
        let value = $(this).attr('data-value');

        if (value == 0)
            terms = 1;
        else
            terms = 0;

        $(this).attr('data-value', terms);
    });

    $('#show-modal-policy-privacy').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Home/policyPrivacyModal'); ?>",
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            },
            error: function(error) {
                globalError();
            }
        });
    });

    $('#btn-create<?php echo $uniqid; ?>').on('click', function() { // Create Customer
        let result = checkRequiredValues();
        if (result == 0) {
            let resultEmail = checkEmailFormat();
            if (resultEmail == 0) {
                if ($('#txt-pass<?php echo $uniqid; ?>').val() == $('#txt-confirmPass<?php echo $uniqid; ?>').val()) {
                    if (terms == 1) {
                        $('#btn-create<?php echo $uniqid; ?>').attr('disabled', true);
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url('Home/signUpCustomerProcess'); ?>",
                            data: {
                                'name': $('#txt-name<?php echo $uniqid; ?>').val(),
                                'lastName': $('#txt-lastName<?php echo $uniqid; ?>').val(),
                                'phone': $('#txt-phone<?php echo $uniqid; ?>').val(),
                                'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                                'pass': $('#txt-pass<?php echo $uniqid; ?>').val(),
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.error == 0) {
                                    simpleSuccessAlert('<?php echo lang('Text.registration_success_create_account'); ?>');
                                    setTimeout(() => {
                                        window.location.href = "<?php echo base_url('/'); ?>";
                                    }, "2000");
                                } else if (response.error == 1) {
                                    if (response.msg == 'DUPLICATE_EMAIL') {
                                        $('#txt-email<?php echo $uniqid; ?>').addClass('required is-invalid');
                                        simpleAlert('<?php echo lang('Text.cust_duplicate'); ?>', 'warning');
                                    } else
                                        globalError();
                                }
                                $('#btn-create<?php echo $uniqid; ?>').removeAttr('disabled');
                            },
                            error: function(error) {
                                globalError();
                                $('#btn-create<?php echo $uniqid; ?>').removeAttr('disabled');
                            }
                        });
                    } else
                        simpleAlert('<?php echo lang('Text.registration_accept_msg'); ?>', 'warning');
                } else {
                    $('#txt-confirmPass<?php echo $uniqid; ?>').addClass('is-invalid');
                    simpleAlert('<?php echo lang('Text.password_does_not_match'); ?>', 'warning');
                }
            } else
                simpleAlert('<?php echo lang('Text.invalid_email_format'); ?>', 'warning');
        } else
            simpleAlert('<?php echo lang('Text.required_values'); ?>', 'warning');
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let form = document.getElementById("kt_signup");
        form.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                $('#btn-create<?php echo $uniqid; ?>').trigger('click');
            }
        });
    });
</script>