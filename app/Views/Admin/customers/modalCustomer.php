<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><?php echo $modalTitle; ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Name -->
                    <div class="col-12 col-md-6 col-lg-6 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-name<?php echo $uniqid; ?>"><?php echo lang('Text.name'); ?> <span class="text-danger">*</span></label>
                        <input type="text" id="txt-name<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo @$customer->name; ?>" />
                    </div>
                    <!-- Last Name -->
                    <div class="col-12 col-md-6 col-lg-6 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-last-name<?php echo $uniqid; ?>"><?php echo lang('Text.last_name'); ?> <span class="text-danger">*</span></label>
                        <input type="text" id="txt-last-name<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo @$customer->lastName; ?>" />
                    </div>
                    <!-- Email -->
                    <div class="col-12 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-email<?php echo $uniqid; ?>"><?php echo lang('Text.email'); ?> <span class="text-danger">*</span></label>
                        <input type="text" id="txt-email<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> email<?php echo $uniqid; ?>" value="<?php echo @$customer->email; ?>" <?php if ($action == "update") echo "disabled"; ?> />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang("Text.btn_cancel"); ?></button>
                <button id="save-customer<?php echo $uniqid; ?>" type="button" class="btn btn-primary"><?php echo lang("Text.btn_save"); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    var action = "<?php echo $action; ?>";
    var callModalFrom = $('#page').attr('data-page');

    $('#modal').modal('show');
    $('#modal').on('hidden.bs.modal', function(event) {
        $('#app-modal').html('');
    });

    $('#save-customer<?php echo $uniqid; ?>').on('click', function() { // Submit
        let result = checkRequiredValues();
        if (result == 0) {
            let resultEmail = checkEmailFormat();
            if (resultEmail == 0) {
                $('#save-customer<?php echo $uniqid; ?>').attr('disabled', true);
                let url = "";
                let msg = "";

                if (action == "create") {
                    url = "<?php echo base_url('Admin/createCustomer'); ?>";
                    msg = "<?php echo lang("Text.cust_success_created"); ?>";
                } else if (action == "update") {
                    url = "<?php echo base_url('Admin/updateCustomer'); ?>"
                    msg = "<?php echo lang("Text.cust_success_updated"); ?>";
                }

                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'name': $('#txt-name<?php echo $uniqid; ?>').val(),
                        'lastName': $('#txt-last-name<?php echo $uniqid; ?>').val(),
                        'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                        'customerID': "<?php echo @$customerID; ?>",
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            simpleSuccessAlert(msg);
                            if (callModalFrom == "main-customers") {
                                dtCustomers.draw();
                                $('#modal').modal('hide');
                            }
                        } else {
                            if (response.msg == "SESSION_EXPIRED") {
                                window.location.href = "<?php echo base_url('Home/loginAdmin?session=expired'); ?>";
                            } else if (response.msg == "ERROR_DUPLICATE_EMAIL") {
                                simpleAlert("<?php echo lang('Text.cust_duplicate'); ?>", 'warning');
                                $('#txt-email<?php echo $uniqid; ?>').addClass('is-invalid');
                            } else if (response.msg == "ERROR_SEND_EMAIL") {
                                simpleAlert("<?php echo lang('Text.cust_error_send_email'); ?>", 'warning');
                                if (callModalFrom == "main-customers") {
                                    dtCustomers.draw();
                                    $('#modal').modal('hide');
                                }
                            }
                        }
                        $('#save-customer<?php echo $uniqid; ?>').removeAttr('disabled');
                    },
                    error: function(e) {
                        globalError();
                        $('#save-customer<?php echo $uniqid; ?>').removeAttr('disabled');
                    }
                });
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