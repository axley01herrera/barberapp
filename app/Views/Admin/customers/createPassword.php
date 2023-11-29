<div class="d-flex flex-column flex-column-fluid flex-lg-row justify-content-center">
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-center p-12 p-lg-20">
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <div class="text-center mb-11">
                    <!--Title-->
                    <h1 class="text-dark fw-bolder mb-3"><?php echo lang('Text.create_pass_customer_title'); ?></h1>
                    <!--Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.create_pass_customer_subtitle'); ?></div>
                </div>
                <div class="fv-row mb-10 fv-plugins-icon-container">
                    <!--Input Pass-->
                    <input type="password" id="txt-pass<?php echo $uniqid; ?>" class="form-control bg-transparent required<?php echo $uniqid; ?> col-12" placeholder="<?php echo lang('Text.create_pass_customer_placeholder_pass'); ?>" />
                    <!--Input Confirm Pass-->
                    <input type="password" id="txt-confirmPass<?php echo $uniqid; ?>" class="form-control bg-transparent required<?php echo $uniqid; ?> mt-2" placeholder="<?php echo lang('Text.create_pass_customer_placeholder_confirmPass'); ?>" />
                </div>
                <div class="d-grid mb-10">
                    <!--Submit-->
                    <button type="button" id="btn-createPass<?php echo $uniqid; ?>" class="btn btn-primary">
                        <span class="indicator-label"><?php echo lang('Text.create_pass_customer_btn_create'); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btn-createPass<?php echo $uniqid; ?>').on('click', function() {
            let result = checkRequiredValues();
            if (result == 0) {
                if ($('#txt-pass<?php echo $uniqid; ?>').val() === $('#txt-confirmPass<?php echo $uniqid; ?>').val()) {
                    $('#btn-createPass<?php echo $uniqid; ?>').attr('disabled', true);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('Home/createPassword') ?>",
                        data: {
                            'customerID': "<?php echo $customerID; ?>",
                            'pass': $('#txt-pass<?php echo $uniqid; ?>').val()
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.error == 0) {
                                simpleAlert('<?php echo lang('Text.create_pass_customer_alert_successCreatePass'); ?>', 'success');
                                setTimeout(() => {
                                    window.location.href = "<?php echo base_url('/') ?>";
                                }, "2000");
                            } else {
                                simpleAlert('<?php echo lang('Text.create_pass_customer_alert_errorCreatePass'); ?>', 'success');
                                $('#btn-createPass<?php echo $uniqid; ?>').removeAttr('disabled');
                            }
                        }
                    });
                } else {
                    simpleAlert('<?php echo lang('Text.create_pass_customer_alert_passwordNotMatch'); ?>', 'warning');
                    $('#txt-pass<?php echo $uniqid; ?>').addClass('required<?php echo $uniqid; ?> is-invalid');
                    $('#txt-confirmPass<?php echo $uniqid; ?>').addClass('required<?php echo $uniqid; ?> is-invalid');
                }
            } else {
                simpleAlert('<?php echo lang('Text.create_pass_customer_alert_requiredFields'); ?>', 'warning');
            }
        });
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