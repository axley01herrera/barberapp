<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><?php echo $modalTitle; ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Title -->
                <div class="row">
                    <div class="col-12">
                        <label class="fs-6 fw-semibold" for="txt-current<?php echo $uniqid; ?>"><?php echo lang('Text.title'); ?> <span class="text-danger">*</span></label>
                        <input type="text" id="txt-title<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo @$service->title;?>" />
                    </div>
                </div>
                <!-- Price -->
                <div class="row">
                    <div class="col-3 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-current<?php echo $uniqid; ?>"><?php echo lang('Text.price'); ?> <span class="text-danger">*</span></label>
                        <input type="text" id="txt-price<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> decimal<?php echo $uniqid; ?>" value="<?php if(!empty($service->price)) echo number_format(@$service->price, 2,".",',');?>" />
                    </div>
                </div>
                <!-- Description -->
                <div class="row">
                    <div class="col-12 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-current<?php echo $uniqid; ?>"><?php echo lang('Text.description'); ?></label>
                        <textarea id="txt-description<?php echo $uniqid; ?>" class="form-control" rows="3"><?php echo @$service->description; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang("Text.btn_cancel"); ?></button>
                <button id="save-serv<?php echo $uniqid; ?>" type="button" class="btn btn-primary"><?php echo lang("Text.btn_save"); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let action = "<?php echo $action;?>";

        $('#modal').modal('show');
        $('#modal').on('hidden.bs.modal', function(event) {
            $('#app-modal').html('');
        });

        $('#save-serv<?php echo $uniqid; ?>').on('click', function() { // Submit
            let result = checkRequiredValues();
            if (result === 0) {
                $('#save-serv<?php echo $uniqid; ?>').attr('disabled', true);
                let url = "";
                let msg = "";
                if(action == "create") {
                    url = "<?php echo base_url('Admin/createService'); ?>";
                    msg = "<?php echo lang("Text.serv_success_created"); ?>";
                } else {
                    url = "<?php echo base_url('Admin/updateService'); ?>"
                    msg = "<?php echo lang("Text.serv_success_updated"); ?>";
                }
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'title': $('#txt-title<?php echo $uniqid; ?>').val(),
                        'price': $('#txt-price<?php echo $uniqid; ?>').val(),
                        'description': $('#txt-description<?php echo $uniqid; ?>').val(),
                        'id': "<?php echo @$service->id; ?>"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error === 0) {
                            simpleSuccessAlert(msg);
                            setTimeout(() => {
                                window.location.reload();
                            }, "2000");
                        } else if (response.error === 1) {
                            if (response.msg == "duplicate") {
                                simpleAlert("<?php echo lang('Text.serv_duplicate'); ?>", 'warning');
                                $('#txt-title<?php echo $uniqid; ?>').addClass('is-invalid');
                            } else
                                globalError();
                        } else
                            window.location.href = "<?php echo base_url('Home/loginAdmin?session=expired'); ?>";

                        $('#save-serv<?php echo $uniqid; ?>').removeAttr('disabled');
                    },
                    error: function() {
                        globalError();
                        $('#save-serv<?php echo $uniqid; ?>').removeAttr('disabled');
                    }
                });
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

        $('.decimal<?php echo $uniqid; ?>').on('input', function() {
            jQuery(this).val(jQuery(this).val().replace(/[^0-9.]/g, ''));
        });
    });
</script>