<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_emp_profile_tab_overview_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_emp_profile_tab_overview_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar"></div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        <div class="row">
            <!-- Services -->
            <div class="col-12 col-md-6 col-lg-6 mb-5">
                <div class="bg-light-primary bg-opacity-70 rounded-2 px-6 py-5">
                    <div class="m-0">
                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><?php echo sizeof($employeeServices); ?></span>
                        <span class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.emp_asigned_services'); ?></span>
                    </div>
                </div>
            </div>
            <!-- Email Verified -->
            <div class="col-12 col-md-6 col-lg-6 mb-5">
                <?php if ($employee[0]->emailVerified == 1) { ?>
                    <div class="bg-light-success bg-opacity-70 rounded-2 px-6 py-5">
                        <div class="m-0">
                            <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><i class="bi bi-envelope-check fs-2qx text-gray-700 fw-bolder"></i></span>
                            <span class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.emp_verified_email'); ?></span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="bg-light-danger bg-opacity-70 rounded-2 px-6 py-5">
                        <div class="m-0">
                            <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><i class="bi bi-envelope-dash fs-2qx text-gray-700 fw-bolder"></i></span>
                            <span class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.emp_unverified_email'); ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Times -->
        <div class="row">
            <div id="chart-time"></div>
            <?php if ($employeeBussinesDay[0]->monday == 0 && $employeeBussinesDay[0]->tuesday == 0 && $employeeBussinesDay[0]->wednesday == 0 && $employeeBussinesDay[0]->thursday == 0 && $employeeBussinesDay[0]->friday == 0 && $employeeBussinesDay[0]->saturday == 0 && $employeeBussinesDay[0]->sunday == 0) { ?>
                <div class="col-12">
                    <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-5 mt-5">
                        <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <h5 class="mb-1"><?php echo lang('Text.important'); ?></h5>
                            <span><?php echo lang('Text.emp_no_active_bussiness_days_msg'); ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (empty($employeeTimes)) { ?>
                <div class="col-12">
                    <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-5 mt-5">
                        <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <h5 class="mb-1"><?php echo lang('Text.important'); ?></h5>
                            <span><?php echo lang('Text.cp_emp_no_shift_days_msg'); ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- DT History Appointments -->
<div class="card card-flush mb-5 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.appointments'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_cust_appointment_history'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <div id="search-employee-appointments"></div>
        </div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        <!-- Data Table -->
        <div class="table-responsive">
            <table id="dt-employee-appointments" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                <thead>
                    <tr class="fs-6 fw-bold">
                        <th class="p-2 dt-vertical-align"><?php echo lang('Text.appointment_col_cust'); ?></th>
                        <th class="p-2 dt-vertical-align"><?php echo lang('Text.appointment_col_date'); ?></th>
                        <th class="p-2 dt-vertical-align"><?php echo lang('Text.appointment_col_schedule'); ?></th>
                        <th class="p-2 dt-vertical-align"><?php echo lang('Text.appointment_col_services'); ?></th>
                        <th class="p-2 dt-vertical-align"><?php echo lang('Text.appointment_col_time'); ?></th>
                        <th class="p-2 dt-vertical-align"><?php echo lang('Text.appointment_col_price'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Chart Times -->
<script>
    var bussinessDays = <?php echo json_encode($employeeBussinesDay); ?>;
    var times = <?php echo json_encode($employeeTimes); ?>;

    if (bussinessDays.length > 0 && times.length > 0) {

        var events = [];
        times.forEach(horario => {
            let day = horario.day.charAt(0).toLowerCase() + horario.day.slice(1);
            let dbDay = day;
            if (day == "monday") day = "<?php echo lang('Text.monday'); ?>";
            if (day == "tuesday") day = "<?php echo lang('Text.tuesday'); ?>";
            if (day == "wednesday") day = "<?php echo lang('Text.wednesday'); ?>";
            if (day == "thursday") day = "<?php echo lang('Text.thursday'); ?>";
            if (day == "friday") day = "<?php echo lang('Text.friday'); ?>";
            if (day == "saturday") day = "<?php echo lang('Text.saturday'); ?>";
            if (day == "sunday") day = "<?php echo lang('Text.sunday'); ?>";
            let start = new Date(`2023-01-01T${horario.start}`);
            let end = new Date(`2023-01-01T${horario.end}`);
            if (bussinessDays[0][dbDay] == 1) {
                events.push({
                    x: day,
                    y: [
                        start.getTime(),
                        end.getTime()
                    ],
                });
            }
        });

        if (events.length > 0) {

            series = [];
            for (let i = 0; i < events.length; i++) {
                if (events[i]['x'] == "<?php echo lang('Text.monday'); ?>") series.push(events[i]);
            }
            for (let i = 0; i < events.length; i++) {
                if (events[i]['x'] == "<?php echo lang('Text.tuesday'); ?>") series.push(events[i]);
            }
            for (let i = 0; i < events.length; i++) {
                if (events[i]['x'] == "<?php echo lang('Text.wednesday'); ?>") series.push(events[i]);
            }
            for (let i = 0; i < events.length; i++) {
                if (events[i]['x'] == "<?php echo lang('Text.thursday'); ?>") series.push(events[i]);
            }
            for (let i = 0; i < events.length; i++) {
                if (events[i]['x'] == "<?php echo lang('Text.friday'); ?>") series.push(events[i]);
            }
            for (let i = 0; i < events.length; i++) {
                if (events[i]['x'] == "<?php echo lang('Text.saturday'); ?>") series.push(events[i]);
            }
            for (let i = 0; i < events.length; i++) {
                if (events[i]['x'] == "<?php echo lang('Text.sunday'); ?>") series.push(events[i]);
            }

            var options = {
                series: [{
                    data: series,
                }],
                chart: {
                    height: 350,
                    type: 'rangeBar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        const convertTimestampToHours = (val) => {
                            const date = new Date(val);
                            const hours = date.getHours();
                            const minutes = date.getMinutes();
                            const formattedHours = hours % 12 || 12;
                            const period = hours >= 12 ? 'PM' : 'AM';
                            const formattedTime = `${formattedHours}:${minutes.toString().padStart(2, '0')} ${period}`;
                            return formattedTime;
                        };
                        const hoursArray = val.map(timestamp => convertTimestampToHours(timestamp));
                        return hoursArray[0] + ' - ' + hoursArray[1];
                    },
                },
                tooltip: {
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        let day = w.config.series[seriesIndex].data[dataPointIndex].x;
                        let val = w.config.series[seriesIndex].data[dataPointIndex].y;
                        const convertTimestampToHours = (val) => {
                            const date = new Date(val);
                            const hours = date.getHours();
                            const minutes = date.getMinutes();
                            const formattedHours = hours % 12 || 12;
                            const period = hours >= 12 ? 'PM' : 'AM';
                            const formattedTime = `${formattedHours}:${minutes.toString().padStart(2, '0')} ${period}`;
                            return formattedTime;
                        };
                        const hoursArray = val.map(timestamp => convertTimestampToHours(timestamp));
                        return day + ': ' + hoursArray[0] + ' - ' + hoursArray[1];
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0,
                        gradientToColors: undefined,
                        inverseColors: true,
                        opacityFrom: 10,
                        opacityTo: 10,
                        stops: [50, 0, 100, 100]
                    }
                },
                xaxis: {
                    type: 'datetime'
                },
                title: {
                    text: '<?php echo lang('Text.cp_emp_profile_tab_schedule_title'); ?>',
                    align: 'left',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '14px',
                        fontWeight: 'bold',
                        fontFamily: undefined,
                        color: '#99A1B7'
                    },
                },

            };

            var chart = new ApexCharts(document.querySelector("#chart-time"), options);
            chart.render();
        }
    }
</script>

<!-- DT Appointments -->
<script>
    var lang = "<?php echo $config[0]->lang; ?>";
    var dtLang = "";

    if (lang == "es")
        dtLang = "<?php echo base_url('assets/js/dataTable/es.json'); ?>";
    else if (lang == "en")
        dtLang = "<?php echo base_url('assets/js/dataTable/en.json'); ?>";

    var dtEmployeeAppointment = $('#dt-employee-appointments').DataTable({ // Data Table
        dom: 'RfrtlpiB',
        processing: true,
        serverSide: true,
        stateSave: true,
        pageLength: 10,
        ordering: false,
        language: {
            url: dtLang
        },
        buttons: [],
        ajax: {
            url: "<?php echo base_url('Employee/processingAppointment'); ?>",
            type: "POST",
            data: function(d) {
                d.employeeID = '<?php echo $employeeID; ?>'
            }
        },
        order: [
            [1, 'desc']
        ],
        columns: [{
                data: 'customer',
                class: 'dt-vertical-align p-2',
            },
            {
                data: 'date',
                class: 'dt-vertical-align p-2',
            },
            {
                data: 'schedule',
                class: 'dt-vertical-align p-2',
                searchable: false,
                orderable: false
            },
            {
                data: 'serv',
                class: 'dt-vertical-align p-2',
                searchable: false,
                orderable: false
            },
            {
                data: 'time',
                class: 'dt-vertical-align p-2',
                searchable: false,
                orderable: false
            },
            {
                data: 'price',
                class: 'dt-vertical-align p-2',
                searchable: false,
                orderable: false
            },
        ],
        initComplete: function(settings, json) {
            $('#search-employee-appointments').html('');
            $('#dt-employee-appointments_filter').appendTo('#search-employee-appointments');
        }
    }); // ok
</script>