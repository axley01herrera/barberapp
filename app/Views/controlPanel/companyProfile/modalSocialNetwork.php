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
                    <div class="col-12 col-lg-6 mb-5">
                        <label class="fs-6 fw-semibold" for="txt-name<?php echo $uniqid; ?>"><?php echo lang('Text.cp_profile_select_social_network'); ?> <span class="text-danger">*</span></label>
                        <select id="txt-name<?php echo $uniqid; ?>" class="form-control">
                            <option value="" hidden></option>
                            <option value="Google" <?php if (@$socialNetwork[0]->type == 'Google') echo "selected"; ?>> <?php echo lang('Text.google'); ?></option>
                            <option value="Facebook" <?php if (@$socialNetwork[0]->type == 'Facebook') echo "selected"; ?>> <?php echo lang('Text.facebook'); ?></option>
                            <option value="Twitter" <?php if (@$socialNetwork[0]->type == 'Twitter') echo "selected"; ?>> <?php echo lang('Text.twitter'); ?></option>
                            <option value="LinkedIn" <?php if (@$socialNetwork[0]->type == 'LinkedIn') echo "selected"; ?>> <?php echo lang('Text.linkedIn'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <!-- URL -->
                    <div class="col-12">
                        <label class="fs-6 fw-semibold" for="txt-url<?php echo $uniqid; ?>"><?php echo lang('Text.url'); ?> <span class="text-danger">*</span></label>
                        <input type="text" id="txt-url<?php echo $uniqid; ?>" class="form-control url<?php echo $uniqid; ?> required<?php echo $uniqid; ?>" value="<?php echo @$socialNetwork[0]->url; ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang("Text.btn_cancel"); ?></button>
                <button id="save-socialNetwork<?php echo $uniqid; ?>" type="button" class="btn btn-primary"><?php echo lang("Text.btn_save"); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modal').modal('show');
    $('#modal').on('hidden.bs.modal', function(event) {
        $('#app-modal').html('');
    });

    $('#save-socialNetwork<?php echo $uniqid; ?>').on('click', function() { // Submit
        let result = checkRequiredValues();
        if (result == 0) {
            let resultURL = checkUrlFormat();
            if (resultURL == 0) {
                $('#save-socialNetwork<?php echo $uniqid; ?>').attr('disabled', true);
                let action = "<?php echo $action; ?>";
                let url = "";
                let msg = "";
                if(action == "create") {
                    url = "<?php echo base_url('ControlPanel/addSocialNetwork'); ?>"
                }
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'name': $('#txt-name<?php echo $uniqid; ?>').val(),
                        'url': $('#txt-url<?php echo $uniqid; ?>').val(),
                        'action': action
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            simpleSuccessAlert("<?php echo lang('Text.cp_profile_social_network_success_created'); ?>");
                            getSocialNetworks();
                            $('#modal').modal('hide');
                        } else {
                            if (response.msg == "SESSION_EXPIRED") {
                                window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                            } else
                                globalError();
                        }
                        $('#save-socialNetwork<?php echo $uniqid; ?>').removeAttr('disabled');
                    },
                    error: function(e) {
                        globalError();
                        $('#save-socialNetwork<?php echo $uniqid; ?>').removeAttr('disabled');
                    }
                });
            } else
                simpleAlert("<?php echo lang('Text.invalid_url_format'); ?>", 'warning');
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

    function checkUrlFormat() {
        let inputValue = '';
        let response = 0;
        let regex = /^(http[s]?:\/\/)(([a-zA-Z0-9-])+\.)+([a-zA-Z]{2,})(\/([-a-zA-Z0-9@:%_\+.~#?&//=]*))?$/;
        $('.url<?php echo $uniqid; ?>').each(function() {
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