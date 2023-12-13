<link href="<?php echo base_url('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js'); ?>"></script>

<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cust_new_appointment'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cust_new_appointment_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
        </div>
    </div>
    <div class="card-body p-9 pt-4">

        <!-- Step 1 -->
        <div id="step-1<?php echo $uniqid; ?>">
            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                <i class="ki-duotone ki-information fs-2tx text-primary me-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <div class="d-flex flex-stack flex-grow-1">
                    <div class="fw-semibold">
                        <h4 class="text-gray-900 fw-bold"><?php echo lang('Text.cust_new_appointment_step1'); ?></h4>
                        <div class="fs-6 text-gray-700"><?php echo lang('Text.cust_new_appointment_step1_sub'); ?>.</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($services as $s) { ?>
                    <div class="separator separator-dashed my-6"></div>
                    <div class="col-12">
                        <label class="form-check form-check-custom form-check-solid align-items-start">
                            <input class="form-check-input me-3 cbx-service<?php echo $uniqid; ?>" type="checkbox" data-service-id="<?php echo $s->id; ?>" data-value="0">
                            <span class="form-check-label d-flex flex-column align-items-start">
                                <span class="fw-bold fs-5 mb-0 text-dark"><?php echo $s->title; ?></span>
                                <span class="text-muted fs-6"><?php echo $s->description; ?></span>
                                <span class="text-muted fs-6"><?php echo getMoneyFormat($config[0]->currency, $s->price); ?></span>
                            </span>
                        </label>
                    </div>
                    <div class="separator separator-dashed my-6"></div>
                <?php } ?>
            </div>
        </div>

        <!-- Step 2 -->
        <div id="step-2<?php echo $uniqid; ?>" hidden>
            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                <i class="ki-duotone ki-information fs-2tx text-primary me-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <div class="d-flex flex-stack flex-grow-1">
                    <div class="fw-semibold">
                        <h4 class="text-gray-900 fw-bold"><?php echo lang('Text.cust_new_appointment_step2'); ?></h4>
                        <div class="fs-6 text-gray-700"><?php echo lang('Text.cust_new_appointment_step2_sub'); ?>.</div>
                    </div>
                </div>
            </div>
            <div id="calendar<?php echo $uniqid; ?>"></div>
        </div>

        <!-- Step 3 -->
        <div id="step-3<?php echo $uniqid; ?>" hidden>
            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                <i class="ki-duotone ki-information fs-2tx text-primary me-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <div class="d-flex flex-stack flex-grow-1">
                    <div class="fw-semibold">
                        <h4 class="text-gray-900 fw-bold"><?php echo lang('Text.cust_new_appointment_step3'); ?></h4>
                        <div class="fs-6 text-gray-700"><?php echo lang('Text.cust_new_appointment_step3_sub'); ?>.</div>
                    </div>
                </div>
            </div>
            <div id="employee<?php echo $uniqid; ?>"></div>
        </div>

        <!-- Buttons -->
        <div class="d-flex flex-stack pt-15">
            <!-- Previous -->
            <div class="mr-2">
                <button type="button" id="back<?php echo $uniqid; ?>" class="btn btn-lg btn-light-primary me-3" hidden>
                    <i class="ki-duotone ki-arrow-left fs-4 me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i><?php echo lang('Text.btn_back'); ?></button>
            </div>
            <div>
                <!-- Submit -->
                <button type="button" id="submit<?php echo $uniqid; ?>" class="btn btn-lg btn-primary me-3" hidden>
                    <span class="indicator-label">Submit
                        <i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i></span>
                </button>
                <!-- Next -->
                <button type="button" id="next<?php echo $uniqid; ?>" class="btn btn-lg btn-primary"><?php echo lang('Text.btn_next'); ?>
                    <i class="ki-duotone ki-arrow-right fs-4 ms-1 me-0">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i></button>
            </div>
        </div>

    </div>
</div>

<script>
    var step = 1;
    var services = [];
    var date = "<?php echo date('Y-m-d'); ?>"

    $('#next<?php echo $uniqid; ?>').on('click', function() { // Next
        if (services.length > 0) {
            step = Number(step) + 1;
            showStep();
        } else {
            simpleAlert('<?php echo lang('Text.cust_new_appointment_step1_sub'); ?>', 'warning')
        }
    });

    $('#back<?php echo $uniqid; ?>').on('click', function() { // Next
        step = Number(step) - 1;
        showStep();
    });

    $('#submit<?php echo $uniqid; ?>').on('click', function() { // Next

    });
</script>

<!-- Select Deselect Service -->
<script>
    $('.cbx-service<?php echo $uniqid; ?>').on('click', function() {
        let serviceID = $(this).attr('data-service-id');
        let value = $(this).attr('data-value');
        let newValue = 0;

        if (value == 0)
            newValue = 1;

        if (newValue == 0) { // remove
            let index = $.inArray(serviceID.toString(), services);
            if (index !== -1)
                services.splice(index, 1);
        } else // add
            services.push(serviceID);

        $(this).attr('data-value', newValue);
        renderEmployee();
    });
</script>

<!-- Function Show Step -->
<script>
    function showStep() {
        if (step == 1) {
            $('#step-2<?php echo $uniqid; ?>').attr('hidden', true);
            $('#step-1<?php echo $uniqid; ?>').removeAttr('hidden');
            $('#back<?php echo $uniqid; ?>').attr('hidden', true);
        } else if (step == 2) {
            $('#step-1<?php echo $uniqid; ?>').attr('hidden', true);
            $('#step-3<?php echo $uniqid; ?>').attr('hidden', true);
            $('#step-2<?php echo $uniqid; ?>').removeAttr('hidden');
            $('#back<?php echo $uniqid; ?>').removeAttr('hidden');
            renderCalendar();
        } else if (step == 3) {
            $('#step-2<?php echo $uniqid; ?>').attr('hidden', true);
            $('#step-3<?php echo $uniqid; ?>').removeAttr('hidden');
        }
    }
</script>

<!-- Calendar -->
<script>
    function renderCalendar() {
        let calendarEl = document.getElementById('calendar<?php echo $uniqid; ?>');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            locale: '<?php echo $config[0]->lang; ?>',
            headerToolbar: {
                left: 'next,today',
                center: 'title',
                right: ''
            },
            titleFormat: {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            },
            initialView: 'dayGridMonth',
            initialDate: '<?php echo date('Y-m-d'); ?>',
            navLinks: false,
            editable: false,
            droppable: false,
            selectable: true,
            nowIndicator: true,
            dayMaxEvents: true,
            dateClick: function(info) {
                let currentDate = new Date(moment().format("YYYY-MM-DD")).getTime();
                let selectedDate = new Date(info.dateStr).getTime();
                if (selectedDate >= currentDate) {
                    
                } else
                    simpleAlert('<?php echo lang('Text.cust_new_appointment_invalid_date'); ?>', 'warning')
            },
        });

        calendar.render();
    }
</script>

<!-- Function Employyees Availables -->
<script>
    function renderEmployee() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/employeesByServices'); ?>",
            data: {
                'services': services,
            },
            dataType: "html",
            success: function (response) {
                $('#employee<?php echo $uniqid; ?>').html(response);
            },
            error: function (error) {
                globalError();
            }
        });
    }
</script>