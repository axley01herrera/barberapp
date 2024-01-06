<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5"><?php echo $modalTitle; ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php if ($action == 'update') { ?>
                        <!-- Day -->
                        <div class="col-12">
                            <label class="fs-6 fw-semibold" for="txt-name<?php echo $uniqid; ?>"><?php echo lang('Text.cp_emp_bussiness_day'); ?> <span class="text-danger">*</span></label>
                            <select id="sel-day<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" disabled>
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
                    <?php } ?>
                    <!-- Start Time -->
                    <div class="col-12 col-md-6 col-lg-6 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-last-name<?php echo $uniqid; ?>"><?php echo lang('Text.cp_emp_start_time'); ?> <span class="text-danger">*</span></label>
                        <input class="form-control flatpickr-input time required<?php echo $uniqid; ?>" id="sel-startTime<?php echo $uniqid; ?>" type="text" value="<?php if (!empty($time[0]->start)) {
                                                                                                                                                                        echo date('g:ia', strtotime($time[0]->start));
                                                                                                                                                                    } ?>" />
                    </div>
                    <!-- End Time -->
                    <div class="col-12 col-md-6 col-lg-6 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-email<?php echo $uniqid; ?>"><?php echo lang('Text.cp_emp_end_time'); ?> <span class="text-danger">*</span></label>
                        <input class="form-control flatpickr-input time required<?php echo $uniqid; ?>" id="sel-endTime<?php echo $uniqid; ?>" type="text" value="<?php if (!empty($time[0]->start)) {
                                                                                                                                                                        echo date('g:ia', strtotime($time[0]->end));
                                                                                                                                                                    } ?>" />
                    </div>
                    <?php if ($action == 'create') { ?>
                        <!-- Days of week -->
                        <div class="col-12 mt-5">
                            <label class="fs-6 fw-semibold" for="txt-name<?php echo $uniqid; ?>"><?php echo lang('Text.cp_emp_bussiness_day'); ?> <span class="text-danger">*</span></label>
                            <div class="row">

                                <?php if ($employeeBussinesDay[0]->monday == 1) { ?>
                                    <div class="col-4 mt-5">
                                        <div class="form-check">
                                            <input id="monday" class="form-check-input cbx-time-day" type="checkbox" checked data-value="1" />
                                            <label class="form-check-label" for="monday">
                                                <?php echo lang('Text.monday'); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($employeeBussinesDay[0]->tuesday == 1) { ?>
                                    <div class="col-4 mt-5">
                                        <div class="form-check">
                                            <input id="tuesday" class="form-check-input cbx-time-day" type="checkbox" checked data-value="1" />
                                            <label class="form-check-label" for="tuesday">
                                                <?php echo lang('Text.tuesday'); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($employeeBussinesDay[0]->wednesday == 1) { ?>
                                    <div class="col-4 mt-5">
                                        <div class="form-check">
                                            <input id="wednesday" class="form-check-input cbx-time-day" type="checkbox" checked data-value="1" />
                                            <label class="form-check-label" for="wednesday">
                                                <?php echo lang('Text.wednesday'); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($employeeBussinesDay[0]->thursday == 1) { ?>
                                    <div class="col-4 mt-5">
                                        <div class="form-check">
                                            <input id="thursday" class="form-check-input cbx-time-day" type="checkbox" checked data-value="1" />
                                            <label class="form-check-label" for="thursday">
                                                <?php echo lang('Text.thursday'); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($employeeBussinesDay[0]->friday == 1) { ?>
                                    <div class="col-4 mt-5">
                                        <div class="form-check">
                                            <input id="friday" class="form-check-input cbx-time-day" type="checkbox" checked data-value="1" />
                                            <label class="form-check-label" for="friday">
                                                <?php echo lang('Text.friday'); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($employeeBussinesDay[0]->saturday == 1) { ?>
                                    <div class="col-4 mt-5">
                                        <div class="form-check">
                                            <input id="saturday" class="form-check-input cbx-time-day" type="checkbox" checked data-value="1" />
                                            <label class="form-check-label" for="saturday">
                                                <?php echo lang('Text.saturday'); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($employeeBussinesDay[0]->sunday == 1) { ?>
                                    <div class="col-4 mt-5">
                                        <div class="form-check">
                                            <input id="sunday" class="form-check-input cbx-time-day" type="checkbox" checked data-value="1" />
                                            <label class="form-check-label" for="sunday">
                                                <?php echo lang('Text.sunday'); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div id="chart-employee-time" class="mt-10"></div>
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
    var timeID = "<?php echo $timeID; ?>";
    var startTime = document.getElementById('sel-startTime<?php echo $uniqid; ?>');
    var endTime = document.getElementById('sel-endTime<?php echo $uniqid; ?>');

    chartEmployeeTime();

    $('#modal').modal('show');

    $('#modal').on('hidden.bs.modal', function(event) {
        $('#app-modal').html('');
    });

    startTime.flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "G:i K",
        onChange: function(selectedDates, dateStr) {
            endTime._flatpickr.set("minTime", $(startTime).val());
        }
    });

    endTime.flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "G:i K",
    });


    $('#save-turn<?php echo $uniqid; ?>').on('click', function() { // Submit
        if (hourConvert($(startTime).val()) >= hourConvert($(endTime).val()) && $(startTime).val() != '') {
            $('#sel-endTime<?php echo $uniqid; ?>').addClass('required is-invalid');
            simpleAlert("<?php echo lang("Text.cp_emp_error_invalid_time"); ?>", 'warning');
        } else {
            if (action == "create")
                createEmployeeTimes();
            else if (action == "update")
                updateEmployeeTimes();
        }
    }); // ok

    function hourConvert(hour) {
        let horaPartes = hour.split(' ');
        let horasMinutos = horaPartes[0].split(':');
        let hours = parseInt(horasMinutos[0]);
        let minutes = parseInt(horasMinutos[1]);
        let meridian = horaPartes[1];

        if (meridian === 'PM' && hours !== 12)
            hours += 12;

        if (hours.toString().length == 1)
            hours = '0' + hours;

        return hours + ':' + (minutes < 10 ? '0' + minutes : minutes);
    }

    function createEmployeeTimes() {
        let url = "<?php echo base_url('Employee/createTime'); ?>";
        let msg = "<?php echo lang("Text.cp_emp_success_created_time"); ?>";

        let days = [];

        $('.cbx-time-day').each(function() {
            let value = $(this).attr('data-value');
            if (value == 1) {
                let day = $(this).attr('id');
                days.push(day);
            }
        });

        let result = checkRequiredValues();

        if (result == 0 && days.length > 0) {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    'days': days,
                    'startTime': $('#sel-startTime<?php echo $uniqid; ?>').val(),
                    'endTime': $('#sel-endTime<?php echo $uniqid; ?>').val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response.error == 0) {
                        simpleSuccessAlert(msg);
                        setTimeout(() => {
                            window.location.reload();
                        }, "2000");
                        $('#modal').modal('hide');
                    } else
                        globalError();
                },
                error: function(error) {
                    globalError();
                }
            });

        } else
            simpleAlert("<?php echo lang('Text.required_values_msg'); ?>", 'warning');
    }

    function updateEmployeeTimes() {
        let url = "<?php echo base_url('Employee/updateTime'); ?>";
        let msg = "<?php echo lang("Text.cp_emp_success_updated_time"); ?>";

        let result = checkRequiredValues();

        if (result == 0) {
            $.ajax({
                type: "post",
                url: url,
                data: {
                    'day': $('#sel-day<?php echo $uniqid; ?>').val(),
                    'startTime': $('#sel-startTime<?php echo $uniqid; ?>').val(),
                    'endTime': $('#sel-endTime<?php echo $uniqid; ?>').val(),
                    'timeID': timeID
                },
                dataType: "json",
                success: function(response) {
                    if (response.error == 0) {
                        simpleSuccessAlert(msg);
                        setTimeout(() => {
                            window.location.reload();
                        }, "2000");
                        $('#modal').modal('hide');
                    } else
                        globalError();
                },
                error: function(error) {
                    globalError();
                }
            });

        } else
            simpleAlert("<?php echo lang('Text.required_values_msg'); ?>", 'warning');
    }

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

    function chartEmployeeTime() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Employee/chartEmployeeTime'); ?>",
            dataType: "html",
            success: function(response) {
                $('#chart-employee-time').html(response);
            },
            error: function(e) {
                globalError();
            }
        });
    }

    $('.cbx-time-day').on('click', function() {
        let value = $(this).attr('data-value');

        if (value == 0)
            $(this).attr('data-value', 1);
        else if (value == 1)
            $(this).attr('data-value', 0);
    });
</script>