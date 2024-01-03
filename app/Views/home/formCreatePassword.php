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
                            <h1 class="text-dark fw-bolder mb-3"><?php echo lang('Text.create_pass_label'); ?></h1>
                            <div class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.create_pass_subtitle_label') ?></div>
                        </div>
                        <!-- Input Access Key -->
                        <div class="fv-row mb-8">
                            <input type="password" id="txt-pass<?php echo $uniqid; ?>" placeholder="<?php echo lang('Text.password_label'); ?>" autocomplete="off" class="form-control bg-transparent mb-5 required<?php echo $uniqid; ?>" />
                            <input type="password" id="txt-confirmPass<?php echo $uniqid; ?>" placeholder="<?php echo lang('Text.password_repeat_label'); ?>" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                        </div>
                        <!-- Button Create Pass -->
                        <div class="d-grid mb-10">
                            <button type="button" id="btn-createPass<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_save'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn-createPass<?php echo $uniqid; ?>').on('click', function() {
        let result = checkRequiredValues();
        if (result == 0) {
            if ($('#txt-pass<?php echo $uniqid; ?>').val() == $('#txt-confirmPass<?php echo $uniqid; ?>').val()) {
                $('#btn-createPass<?php echo $uniqid; ?>').attr('disabled', true);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Home/createPassword') ?>",
                    data: {
                        'employeeID': "<?php echo @$employeeID; ?>",
                        'customerID': "<?php echo @$customerID; ?>",
                        'password': $('#txt-pass<?php echo $uniqid; ?>').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            simpleSuccessAlert('<?php echo lang('Text.success_create_pass_labelword_msg'); ?>');
                            setTimeout(() => {
                                window.location.href = "<?php echo base_url('/') ?>";
                            }, "2000");
                        } else {
                            simpleAlert('<?php echo lang('Text.create_pass_label_customer_alert_errorCreatePass'); ?>', 'success');
                            $('#btn-createPass<?php echo $uniqid; ?>').removeAttr('disabled');
                        }
                    }
                });
            } else {
                simpleAlert('<?php echo lang('Text.password_label_not_match'); ?>', 'warning');
                $('#txt-confirmPass<?php echo $uniqid; ?>').addClass('required<?php echo $uniqid; ?> is-invalid');
            }
        } else
            simpleAlert('<?php echo lang('Text.required_values_msg'); ?>', 'warning');
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

    $('.required<?php echo $uniqid; ?>').on('focus', function() {
        $(this).removeClass('is-invalid');
    });
</script>