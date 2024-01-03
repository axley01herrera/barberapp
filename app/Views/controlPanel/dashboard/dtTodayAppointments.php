<?php
$pendingAppointments = 0;
?>
<!-- Card -->
<div class="card mb-5 mb-xl-10">
    <!-- Card Header -->
    <div class="card-header border-0">
        <!-- Card Title -->
        <div class="card-title">
            <div class="d-flex align-items-center position-relative ">
                <h5>
                    <?php
                    echo lang('Text.appointments_label') . ' ';
                    if ($config[0]->lang == 'en')
                        echo date('F j, Y');
                    else {
                        $montTitle =  date('F');
                        echo lang('Text.' . $montTitle) . ' ' . date('j, Y');
                    }
                    ?>
                </h5>
            </div>
        </div>
        <!-- Card Toolbar -->
        <div class="card-toolbar">
            <div id="search-todayAppointments"></div>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body pb-0">
        <!-- Data Table -->
        <div class="table-responsive">
            <table id="dt-todayAppointments" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                <thead>
                    <tr class="fs-6 fw-bold">
                        <th class="p-2"><?php echo lang('Text.today_appointment_col_emp'); ?></th>
                        <th class="p-2"><?php echo lang('Text.today_appointment_col_schedule'); ?></th>
                        <th class="p-2"><?php echo lang('Text.today_appointment_col_services'); ?></th>
                        <th class="p-2"><?php echo lang('Text.today_appointment_col_time'); ?></th>
                        <th class="p-2"><?php echo lang('Text.today_appointment_col_price'); ?></th>
                        <th class="p-2"><?php echo lang('Text.today_appointment_col_cust'); ?></th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($todayAppointments as $ta) { ?>
                        <tr>
                            <td class="dt-vertical-align p-2">
                                <?php echo '<div class="symbol symbol-30px symbol-circle me-3"><img src="' . imgEmployee($ta->employeeID) . '" class="" alt=""></div>' . ' ' . $ta->employeeName; ?>
                            </td>

                            <td class="dt-vertical-align p-2">
                                <?php echo '<span class="text-gray-800 fs-7 fw-bold"><i class="bi bi-clock-history fs-7"></i> ' . date('g:ia', strtotime($ta->start)) . ' - ' . date('g:ia', strtotime($ta->end)) . '</span>'; ?>
                            </td>

                            <td class="dt-vertical-align p-2">
                                <?php
                                $aux = json_decode($ta->servicesJSON);
                                $serv = "";

                                foreach ($aux as $s) {
                                    $serv = $serv . '<div class="fw-semibold"><span class="bullet bullet-dot bg-primary me-2 h-10px w-10px"></span>' . $s->serviceTitle . '</div>';
                                }
                                echo $serv
                                ?>
                            </td>

                            <td class="dt-vertical-align p-2">
                                <?php echo $ta->totalTime . ' ' . lang('Text.minutes_label'); ?>
                            </td>

                            <td class="dt-vertical-align p-2">
                                <?php echo getMoneyFormat($config[0]->currency, $ta->totalPrice); ?>
                            </td>

                            <td class="dt-vertical-align p-2">
                                <?php echo '<div class="symbol symbol-30px symbol-circle me-3"><img src="' . imgCustomer($ta->customerID) . '" class="" alt=""></div>' . ' ' . $ta->customerName; ?>
                            </td>

                            <td class="dt-vertical-align p-2">
                                <?php
                                $currentDateTime = strtotime(date('Y-m-d g:ia'));
                                $appointmentDateTimeStart = strtotime($ta->date . ' ' . $ta->start);
                                $appointmentDateTimeEnd = strtotime($ta->date . ' ' . $ta->end);

                                if ($currentDateTime < $appointmentDateTimeStart) {
                                    echo '<span class="badge badge-light-warning">' . lang('Text.pending') . '</span>';
                                    $pendingAppointments = $pendingAppointments + 1;
                                } else if ($currentDateTime >= $appointmentDateTimeStart && $currentDateTime <= $appointmentDateTimeEnd) {
                                    echo '<span class="badge badge-light-primary">' . lang('Text.in_progress') . '</span>';
                                } else if ($currentDateTime > $appointmentDateTimeEnd) {
                                    echo '<span class="badge badge-light-success">' . lang('Text.finish') . '</span>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var lang = "<?php echo $config[0]->lang; ?>";
    var dtLang = "";

    if (lang == "es")
        dtLang = "<?php echo base_url('assets/js/dataTable/es.json'); ?>";
    else if (lang == "en")
        dtLang = "<?php echo base_url('assets/js/dataTable/en.json'); ?>";

    var dtTodayAppointments = $('#dt-todayAppointments').DataTable({ // Data Table
        dom: 'RfrtlpiB',
        processing: true,
        serverSide: false,
        stateSave: true,
        pageLength: 10,
        language: {
            url: dtLang
        },
        buttons: [],
        order: [
            [1, 'asc']
        ],
        initComplete: function(settings, json) {
            $('#search-todayAppointments').html('');
            $('#dt-todayAppointments_filter').appendTo('#search-todayAppointments');
        }
    }); // ok

    $('#total-today-appointment').html('<?php echo sizeof($todayAppointments); ?>');
    $('#pending-appointment').html('<?php echo $pendingAppointments; ?>');
    $('#pecent-appointment').html('<?php echo ((sizeof($todayAppointments) - $pendingAppointments)  * 100) / sizeof($todayAppointments); ?>');
    $('#pecent-appointment-bar').css('width', '<?php echo ((sizeof($todayAppointments) - $pendingAppointments)  * 100) / sizeof($todayAppointments); ?>%');
</script>