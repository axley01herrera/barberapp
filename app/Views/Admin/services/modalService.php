<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><?php echo $modalTitle; ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label class="fs-6 fw-semibold" for="txt-current<?php echo $uniqid; ?>"><?php echo lang('Text.title'); ?> <span class="text-danger">*</span></label>
                        <input type="text" id="txt-title<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-current<?php echo $uniqid; ?>"><?php echo lang('Text.price'); ?> <span class="text-danger">*</span></label>
                        <input type="text" id="txt-price<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> decimal<?php echo $uniqid; ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-current<?php echo $uniqid; ?>"><?php echo lang('Text.description'); ?></label>
                        <textarea id="txt-description<?php echo $uniqid; ?>" class="form-control" rows="3"></textarea>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang("Text.btn_cancel"); ?></button>
                <button id="save-new-serv<?php echo $uniqid; ?>" type="button" class="btn btn-primary"><?php echo lang("Text.btn_save"); ?></button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#modal').modal('show');
        $('#modal').on('hidden.bs.modal', function(event) {
            $('#app-modal').html('');
        });

        $('#save-new-serv<?php echo $uniqid; ?>').on('click', function() {
            let result = checkRequiredValues();
            if (result === 0) {
                $('#save-new-serv<?php echo $uniqid; ?>').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Admin/createService'); ?>",
                    data: {
                        'title': $('#txt-title<?php echo $uniqid; ?>').val(),
                        'price': $('#txt-price<?php echo $uniqid; ?>').val(),
                        'description': $('#txt-description<?php echo $uniqid; ?>').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error === 0) {
                            simpleSuccessAlert("<?php echo lang("Text.serv_success_created"); ?>");
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

                        $('#save-new-serv<?php echo $uniqid; ?>').removeAttr('disabled');
                    },
                    error: function() {
                        globalError();
                        $('#save-new-serv<?php echo $uniqid; ?>').removeAttr('disabled');
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

        $('.decimal<?php echo $uniqid; ?>').on('input', function() { // ONLY NUMBER
            jQuery(this).val(jQuery(this).val().replace(/[^0-9.]/g, ''));
        });
    });
</script>