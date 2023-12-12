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
                    <div class="col-12">
                        <label class="fs-6 fw-semibold" for="txt-name<?php echo $uniqid; ?>"><?php echo lang('Text.day'); ?> <span class="text-danger">*</span></label>
                        <select id="sel-day<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>">
                            <option value="" hidden></option>
                            <?php if ($employeeBussinesDay[0]->monday == 1) { ?>
                                <option value="monday" <?php if (!empty($time)) {
                                                            if ($time[0]->day == 'monday') echo "selected";
                                                        } ?>><?php echo lang('Text.monday'); ?></option>
                            <?php }
                            if ($employeeBussinesDay[0]->tuesday == 1) { ?>
                                <option value="tuesday" <?php if (!empty($time)) {
                                                            if ($time[0]->day == 'tuesday') echo "selected";
                                                        } ?>><?php echo lang('Text.tuesday'); ?></option>
                            <?php }
                            if ($employeeBussinesDay[0]->wednesday == 1) { ?>
                                <option value="wednesday" <?php if (!empty($time)) {
                                                                if ($time[0]->day == 'wednesday') echo "selected";
                                                            } ?>><?php echo lang('Text.wednesday'); ?></option>
                            <?php }
                            if ($employeeBussinesDay[0]->thursday == 1) { ?>
                                <option value="thursday" <?php if (!empty($time)) {
                                                                if ($time[0]->day == 'thursday') echo "selected";
                                                            } ?>><?php echo lang('Text.thursday'); ?></option>
                            <?php }
                            if ($employeeBussinesDay[0]->friday == 1) { ?>
                                <option value="friday" <?php if (!empty($time)) {
                                                            if ($time[0]->day == 'friday') echo "selected";
                                                        } ?>><?php echo lang('Text.friday'); ?></option>
                            <?php }
                            if ($employeeBussinesDay[0]->saturday == 1) { ?>
                                <option value="saturday" <?php if (!empty($time)) {
                                                                if ($time[0]->day == 'saturday') echo "selected";
                                                            } ?>><?php echo lang('Text.saturday'); ?></option>
                            <?php }
                            if ($employeeBussinesDay[0]->sunday == 1) { ?>
                                <option value="sunday" <?php if (!empty($time)) {
                                                            if ($time[0]->day == 'sunday') echo "selected";
                                                        } ?>><?php echo lang('Text.sunday'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- Start Time -->
                    <div class="col-12 col-md-6 col-lg-6 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-last-name<?php echo $uniqid; ?>"><?php echo lang('Text.start_time'); ?> <span class="text-danger">*</span></label>
                        <input class="form-control flatpickr-input time required<?php echo $uniqid; ?>" id="sel-startTime<?php echo $uniqid; ?>" type="text" value="<?php if (!empty($time[0]->start)) {
                                                                                                                                                                        echo date('g:i A', strtotime($time[0]->start));
                                                                                                                                                                    } ?>" />
                    </div>
                    <!-- End Time -->
                    <div class="col-12 col-md-6 col-lg-6 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-email<?php echo $uniqid; ?>"><?php echo lang('Text.end_time'); ?> <span class="text-danger">*</span></label>
                        <input class="form-control flatpickr-input time required<?php echo $uniqid; ?>" id="sel-endTime<?php echo $uniqid; ?>" type="text" value="<?php if (!empty($time[0]->start)) {
                                                                                                                                                                        echo date('g:i A', strtotime($time[0]->end));
                                                                                                                                                                    } ?>" />
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
    var action = "<?php echo $action; ?>";
    var callModalFrom = $('#page').attr('data-page');

    $('#modal').modal('show');

    $('#modal').on('hidden.bs.modal', function(event) {
        $('#app-modal').html('');
    });

    $(".time").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "G:i K",
    });

    $('#save-turn<?php echo $uniqid; ?>').on('click', function() { // Submit
        let result = checkRequiredValues();
        if (result == 0) {
            let url = "";
            let msg = "";

            if (action == "create") {
                url = "<?php echo base_url('Employee/createTime'); ?>";
                msg = "<?php echo lang("Text.emp_success_created_time"); ?>";
            } else if (action == "update") {
                url = "<?php echo base_url('Employee/updateTime'); ?>"
                msg = "<?php echo lang("Text.emp_success_updated_time"); ?>";
            }

            $.ajax({
                type: "post",
                url: url,
                data: {
                    'day': $('#sel-day<?php echo $uniqid; ?>').val(),
                    'startTime': $('#sel-startTime<?php echo $uniqid; ?>').val(),
                    'endTime': $('#sel-endTime<?php echo $uniqid; ?>').val(),
                    'timeID': "<?php echo @$timeID; ?>"
                },
                dataType: "json",
                success: function(response) {
                    if (response.error == 0) {
                        simpleSuccessAlert(msg);
                        employeeProfileTabContent();
                        $('input').val('');
                        $('select').val('');
                        if (action == 'update')
                            $('#modal').modal('hide');
                    } else
                        globalError();
                },
                error: function(error) {
                    globalError();
                }
            });
        } else
            simpleAlert("<?php echo lang('Text.required_values'); ?>", 'warning');
    }); // ok

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