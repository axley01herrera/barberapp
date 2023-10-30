<!-- Tab Key Access -->
<div class="row">
    <div class="col-12 col-lg-4 mt-5">
        <label class="fs-6 fw-semibold" for="txt-current<?php echo $uniqid; ?>"><?php echo lang('Text.current_key'); ?> <span class="text-danger">*</span></label>
        <input type="password" id="txt-current<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" disabled />
    </div>
    <div class="col-12 col-lg-4 mt-5">
        <label class="fs-6 fw-semibold" for="txt-new<?php echo $uniqid; ?>"><?php echo lang('Text.new_key'); ?> <span class="text-danger">*</span></label>
        <input type="password" id="txt-new<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" disabled />
    </div>
    <div class="col-12 col-lg-4 mt-5">
        <label class="fs-6 fw-semibold" for="txt-confirm<?php echo $uniqid; ?>"><?php echo lang('Text.confirm_key'); ?> <span class="text-danger">*</span></label>
        <input type="password" id="txt-confirm<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" disabled />
    </div>
</div>
<div class="row">
    <div class="col-12 text-end mt-5">
        <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_enable_edit'); ?></button>
    </div>
</div>
<div class="row">
    <div class="col-12 text-end mt-5">
        <button hidden type="button" id="btn-cancel<?php echo $uniqid; ?>" class="btn btn-secondary"><?php echo lang('Text.btn_cancel'); ?></button>
        <button hidden type="button" id="btn-update<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_update'); ?></button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btn-<?php echo $uniqid; ?>').on('click', function() { // Enable Edit
            $('.form-control').each(function() {
                $(this).removeAttr('disabled');
            });
            $(this).attr('hidden', true);
            $('#btn-cancel<?php echo $uniqid; ?>').removeAttr('hidden');
            $('#btn-update<?php echo $uniqid; ?>').removeAttr('hidden');
        });

        $('#btn-cancel<?php echo $uniqid; ?>').on('click', function() { // Cancel Edit
            getProfileTabContent();
        });

        $('#btn-update<?php echo $uniqid; ?>').on('click', function() {
            let result = checkRequiredValues();
            if (result === 0) {
                let current = $('#txt-current<?php echo $uniqid; ?>').val();
                let newp = $('#txt-new<?php echo $uniqid; ?>').val();
                let confirmp = $('#txt-confirm<?php echo $uniqid; ?>').val();

                if (newp == confirmp) {
                    $('#btn-update<?php echo $uniqid; ?>').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Admin/changeAccessKey'); ?>",
                        data: {
                            'current': current,
                            'newp': newp
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.error === 0) {
                                simpleSuccessAlert("<?php echo lang("Text.prof_access_key_updated"); ?>");
                                setTimeout(() => {
                                    window.location.href = "<?php echo base_url('Admin/profile?tab='); ?>" + tab;
                                }, "2000");
                            } else if (response.error === 1) {
                                if (response.msg == "invalid current key") {
                                    $('#txt-current<?php echo $uniqid; ?>').addClass('is-invalid');
                                    simpleAlert("<?php echo lang('Text.invalid_current_password'); ?>", 'warning')
                                } else
                                    globalError();
                            } else
                                window.location.href = "<?php echo base_url('Home/loginAdmin?session=expired'); ?>";

                            $('#btn-update<?php echo $uniqid; ?>').removeAttr('disabled');
                        },
                        error: function(error) {
                            globalError();
                            $('#btn-update<?php echo $uniqid; ?>').removeAttr('disabled');
                        }
                    });
                } else {
                    $('#txt-confirm<?php echo $uniqid; ?>').addClass('is-invalid');
                    simpleAlert("<?php echo lang('Text.password_does_not_match'); ?>", 'warning')
                }
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

        $('.required<?php echo $uniqid; ?>').on('focus', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>