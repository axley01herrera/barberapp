<!-- Tab Config -->
<div class="row">
    <!-- Languaje -->
    <div class="col-12 col-lg-4 mt-5">
        <label class="fs-6 fw-semibold" for="txt-lang<?php echo $uniqid; ?>"><?php echo lang('Text.languaje'); ?> <span class="text-danger">*</span></label>
        <select id="txt-lang<?php echo $uniqid; ?>" class="form-control" disabled>
            <option value="" hidden></option>
            <option value="es" <?php if ($config[0]->lang == "es") echo "selected"; ?>>Español</option>
            <option value="en" <?php if ($config[0]->lang == "en") echo "selected"; ?>>English</option>
        </select>
    </div>
    <!-- Teme -->
    <div class="col-12 col-lg-4 mt-5">
        <label class="fs-6 fw-semibold" for="txt-theme<?php echo $uniqid; ?>"><?php echo lang('Text.theme'); ?> <span class="text-danger">*</span></label>
        <select id="txt-theme<?php echo $uniqid; ?>" class="form-control" disabled>
            <option value="" hidden></option>
            <option value="light" <?php if ($config[0]->theme == "light") echo "selected"; ?>><?php echo lang('Text.theme_light'); ?></option>
            <option value="dark" <?php if ($config[0]->theme == "dark") echo "selected"; ?>><?php echo lang('Text.theme_dark'); ?></option>
        </select>
    </div>
    <!-- Currency -->
    <div class="col-12 col-lg-4 mt-5">
        <label class="fs-6 fw-semibold" for="txt-currency<?php echo $uniqid; ?>"><?php echo lang('Text.currency'); ?> <span class="text-danger">*</span></label>
        <select id="txt-currency<?php echo $uniqid; ?>" class="form-control" disabled>
            <option value="" hidden></option>
            <option value="$" <?php if ($config[0]->currency == "$") echo "selected"; ?>>$</option>
            <option value="€" <?php if ($config[0]->currency == "€") echo "selected"; ?>>€</option>
        </select>
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

        $("#btn-update<?php echo $uniqid; ?>").on('click', function() {
            let result = checkRequiredValues();
            if (result === 0) {
                $("#btn-update<?php echo $uniqid; ?>").attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/updateConfig'); ?>",
                    data: {
                        'lang': $('#txt-lang<?php echo $uniqid; ?>').val(),
                        'theme': $('#txt-theme<?php echo $uniqid; ?>').val(),
                        'currency': $('#txt-currency<?php echo $uniqid; ?>').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error === 0) {
                            simpleSuccessAlert("<?php echo lang("Text.prof_config_updated"); ?>");
                            setTimeout(() => {
                                window.location.href = "<?php echo base_url('Admin/profile?tab='); ?>" + tab;
                            }, "2000");
                        } else if (response.error === 1)
                            globalError();
                        else
                            window.location.href = "<?php echo base_url('Home/loginAdmin?session=expired'); ?>";

                        $("#btn-update<?php echo $uniqid; ?>").removeAttr("disabled");
                    },
                    error: function(error) {
                        globalError();
                        $("#btn-update<?php echo $uniqid; ?>").removeAttr("disabled");
                    }
                });
            } else
                simpleAlert("<?php echo lang('Text.required_values'); ?>", 'warning')
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