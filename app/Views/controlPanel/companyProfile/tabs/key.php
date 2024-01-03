<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_profile_change_key_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_profile_change_key_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_enable_edit'); ?></button>
        </div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        <div class="row">
            <div class="col-12 col-lg-4"></div>
            <div class="col-12 col-lg-4">
                <div class="col-12">
                    <label class="fs-6 fw-semibold" for="txt-current<?php echo $uniqid; ?>"><?php echo lang('Text.cp_profile_current_key'); ?> <span class="text-danger">*</span></label>
                    <input type="password" id="txt-current<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" disabled placeholder="**********" />
                </div>
                <div class="col-12 mt-5">
                    <label class="fs-6 fw-semibold" for="txt-new<?php echo $uniqid; ?>"><?php echo lang('Text.cp_profile_new_key'); ?> <span class="text-danger">*</span></label>
                    <input type="password" id="txt-new<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" disabled disabled placeholder="**********" />
                </div>
                <div class="col-12 mt-5">
                    <label class="fs-6 fw-semibold" for="txt-confirm<?php echo $uniqid; ?>"><?php echo lang('Text.cp_profile_confirm_key'); ?> <span class="text-danger">*</span></label>
                    <input type="password" id="txt-confirm<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" disabled disabled placeholder="**********" />
                </div>
            </div>
            <div class="col-12 col-lg-4"></div>
        </div>
        <div class="row">
            <div class="col-12 text-end mt-5">
                <button hidden type="button" id="btn-cancel<?php echo $uniqid; ?>" class="btn btn-secondary"><?php echo lang('Text.btn_cancel'); ?></button>
                <button hidden type="button" id="btn-update<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_update'); ?></button>
            </div>
        </div>
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
                        url: "<?php echo base_url('ControlPanel/changeAccessKey'); ?>",
                        data: {
                            'current': current,
                            'newp': newp
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.error === 0) {
                                simpleSuccessAlert("<?php echo lang("Text.cp_profile_access_key_updated"); ?>");
                                setTimeout(() => {
                                    window.location.href = "<?php echo base_url('ControlPanel/profile?tab='); ?>" + tab;
                                }, "2000");
                            } else if (response.error === 1) {
                                if (response.msg == "INVALID_CURRENT_KEY") {
                                    $('#txt-current<?php echo $uniqid; ?>').addClass('is-invalid');
                                    simpleAlert("<?php echo lang('Text.invalid_current_password'); ?>", 'warning')
                                } else
                                    globalError();
                            } else
                                window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";

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