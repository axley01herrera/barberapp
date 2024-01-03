<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cp_emp_profile_tab_schedule_title'); ?>
                </h1>
                <div class="fs-6 fw-semibold text-muted">Subtitle</div>
            </div>
            <!-- Page Button Action -->
            <div class="d-flex align-items-center gap-2 gap-lg-3"></div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <!-- Times -->
                <div class="container">
                    <div class="card">
                        <div id="chart-time"></div>
                        <?php if ($employeeBussinesDay[0]->monday == 0 && $employeeBussinesDay[0]->tuesday == 0 && $employeeBussinesDay[0]->wednesday == 0 && $employeeBussinesDay[0]->thursday == 0 && $employeeBussinesDay[0]->friday == 0 && $employeeBussinesDay[0]->saturday == 0 && $employeeBussinesDay[0]->sunday == 0) { ?>
                            <div class="col-12">
                                <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-5 mt-5">
                                    <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <h5 class="mb-1"><?php echo lang('Text.important_label'); ?></h5>
                                        <span><?php echo lang('Text.cp_emp_no_active_bussiness_days_msg'); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (empty($employeeTimes)) { ?>
                            <div class="col-12">
                                <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-5 mt-5">
                                    <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <h5 class="mb-1"><?php echo lang('Text.important_label'); ?></h5>
                                        <span><?php echo lang('Text.emp_no_shift_days_msg'); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
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


            };

            var chart = new ApexCharts(document.querySelector("#chart-time"), options);
            chart.render();
        }
    }
</script>