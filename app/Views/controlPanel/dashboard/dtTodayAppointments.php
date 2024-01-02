<!-- Card -->
<div class="card mb-5 mb-xl-10 mt-5">
    <!-- Card Header -->
    <div class="card-header border-0">
        <!-- Card Title -->
        <div class="card-title">
            <div class="d-flex align-items-center position-relative ">
                <h5>
                    <?php
                    echo lang('Text.appointments') . ' ';
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($todayAppointments as $ta) { ?>
                        <tr>
                            <td class="dt-vertical-align p-2">
                                <?php echo '<div class="symbol symbol-30px symbol-circle me-3"><img src="' . imgEmployee($ta->employeeID) . '" class="" alt=""></div>' . ' ' . $ta->employeeName . ' ' . $ta->employeeLastName; ?>
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
                                <?php echo $ta->totalTime . ' ' . lang('Text.minutes'); ?>
                            </td>

                            <td class="dt-vertical-align p-2">
                                <?php echo getMoneyFormat($config[0]->currency, $ta->totalPrice); ?>
                            </td>

                            <td class="dt-vertical-align p-2">
                                <?php echo '<div class="symbol symbol-30px symbol-circle me-3"><img src="' . imgCustomer($ta->customerID) . '" class="" alt=""></div>' . ' ' . $ta->customerName . ' ' . $ta->customerLastName; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>