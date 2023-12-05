<div class="card pt-4 mb-6 mb-xl-9">
    <div class="card-body pt-0 pb-5">
        <div id="profile-tab-content" class="container mt-10 mb-10">
            <div class="row">
                <div class="col-12 mt-5">
                    <!-- Email -->
                    <label class="fs-6 fw-semibold" for="txt-email<?php echo $uniqid; ?>"><?php echo lang('Text.email'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-email<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> email<?php echo $uniqid; ?>" maxlength="150" value="<?php echo $customer[0]->email; ?>" disabled="">
                </div>
                <div class="col-12 col-lg-6 mt-5">
                    <!-- Password -->
                    <label class="fs-6 fw-semibold" for="txt-password<?php echo $uniqid; ?>"><?php echo lang('Text.password'); ?></label>
                    <input type="password" id="txt-password<?php echo $uniqid; ?>" class="form-control" maxlength="5" disabled="">
                </div>
                <div class="col-12 col-lg-6 mt-5">
                    <!-- Confirm Password -->
                    <label class="fs-6 fw-semibold" for="txt-confirmPassword<?php echo $uniqid; ?>"><?php echo lang('Text.password_repeat'); ?></label>
                    <input type="password" id="txt-confirmPassword<?php echo $uniqid; ?>" class="form-control" maxlength="45" disabled="">
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-end mt-5">
                    <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary">Habilitar Edición</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-end mt-5">
                    <button hidden="" type="button" id="btn-cancel<?php echo $uniqid; ?>" class="btn btn-secondary">Cancelar</button>
                    <button hidden="" type="button" id="btn-update<?php echo $uniqid; ?>" class="btn btn-primary">Actualizar</button>
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
        customerTabContent();
    });

    $('#btn-update<?php echo $uniqid; ?>').on('click', function() {
        let result = checkRequiredValues();
        if (result === 0) {
            let resultEmail = checkEmailFormat();
            if (resultEmail === 0) {
                if ($('#txt-password<?php echo $uniqid; ?>').val() === $('#txt-confirmPassword<?php echo $uniqid; ?>').val()) {
                    $('#btn-update<?php echo $uniqid; ?>').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Customer/updateProfile'); ?>",
                        data: {
                            'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                            'password': $('#txt-password<?php echo $uniqid; ?>').val(),
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.error == 0) {
                                simpleSuccessAlert("<?php echo lang("Text.prof_data_updated"); ?>");
                                reloadCustomerInfo();
                                customerTabContent();
                            } else if (response.error == 1)
                                globalError();
                            else
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
                    $('#txt-confirmPassword<?php echo $uniqid; ?>').addClass('is-invalid');
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
</script>