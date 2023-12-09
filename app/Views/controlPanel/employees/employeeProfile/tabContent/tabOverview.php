<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.emp_overview_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.emp_overview_subtitle'); ?></div>
        </div>

        <!-- Card toolbar -->
        <div class="card-toolbar">
        </div>

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
                            <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><i class="bi bi-envelope-check fs-2qx"></i></span>
                            <span class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.emp_verified_email'); ?></span>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="bg-light-danger bg-opacity-70 rounded-2 px-6 py-5">
                        <div class="m-0">
                            <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><i class="bi bi-envelope-dash fs-2qx"></i></span>
                            <span class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.emp_unverified_email'); ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div id="chart-time"></div>
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
                text: '<?php echo lang('Text.emp_time_title'); ?>',
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
</script>