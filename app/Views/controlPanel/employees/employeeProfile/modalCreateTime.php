<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><?php echo $modalTitle; ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Days -->
                    <div class="col-12 col-md-4 col-lg-4 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-name<?php echo $uniqid; ?>"><?php echo lang('Text.day'); ?> <span class="text-danger">*</span></label>
                        <select id="sel-day<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>">
                            <option value="" hidden></option>
                            <?php if ($days[0]->monday == 1) { ?>
                                <option value="monday"><?php echo lang('Text.monday'); ?></option>
                            <?php }
                            if ($days[0]->tuesday == 1) { ?>
                                <option value="tuesday"><?php echo lang('Text.tuesday'); ?></option>
                            <?php }
                            if ($days[0]->wednesday == 1) { ?>
                                <option value="wednesday"><?php echo lang('Text.wednesday'); ?></option>
                            <?php }
                            if ($days[0]->thursday == 1) { ?>
                                <option value="thursday"><?php echo lang('Text.thursday'); ?></option>
                            <?php }
                            if ($days[0]->friday == 1) { ?>
                                <option value="friday"><?php echo lang('Text.friday'); ?></option>
                            <?php }
                            if ($days[0]->saturday == 1) { ?>
                                <option value="saturday"><?php echo lang('Text.saturday'); ?></option>
                            <?php }
                            if ($days[0]->sunday == 1) { ?>
                                <option value="sunday"><?php echo lang('Text.sunday'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- Start Time -->
                    <div class="col-12 col-md-4 col-lg-4 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-last-name<?php echo $uniqid; ?>"><?php echo lang('Text.start_time'); ?> <span class="text-danger">*</span></label>
                        <input class="form-control flatpickr-input time required<?php echo $uniqid; ?>" id="sel-startTime<?php echo $uniqid; ?>" type="text">
                    </div>
                    <!-- End Time -->
                    <div class="col-12 col-md-4 col-lg-4 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-email<?php echo $uniqid; ?>"><?php echo lang('Text.end_time'); ?> <span class="text-danger">*</span></label>
                        <input class="form-control flatpickr-input time required<?php echo $uniqid; ?>" id="sel-endTime<?php echo $uniqid; ?>" type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo lang("Text.btn_cancel"); ?></button>
                <button id="save-turn<?php echo $uniqid; ?>" type="button" class="btn btn-primary"><?php echo lang("Text.btn_save"); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modal').modal('show');

    $(".time").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });

    $('#save-turn<?php echo $uniqid; ?>').on('click', function() {
        let result = checkRequiredValues();
        if (result === 0) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('ControlPanel/createTimeProcess'); ?>",
                data: {
                    'employeeID': "<?php echo $employeeID; ?>",
                    'day': $('#sel-day<?php echo $uniqid; ?>').val(),
                    'startTime': $('#sel-startTime<?php echo $uniqid; ?>').val(),
                    'endTime': $('#sel-endTime<?php echo $uniqid; ?>').val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response.error == 0) {
                        simpleSuccessAlert("<?php echo lang("Text.turn_created"); ?>");
                        $('input').val('');
                        $('select').val('');
                    } else
                        globalError();
                },
                error: function(error) {
                    globalError();
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
</script>