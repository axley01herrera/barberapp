<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_cust_profile_tab_overview_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_cust_profile_tab_overview_subtitle'); ?></div>
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
                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"><i class="bi bi-calendar fs-2qx text-gray-700 fw-bolder"></i></span>
                        <span class="text-gray-500 fw-semibold fs-6"><?php echo sizeof($appointments) . ' ' . lang('Text.cust_future_appointments'); ?></span>
                    </div>
                </div>
            </div>
            <!-- Email Verified -->
            <div class="col-12 col-md-6 col-lg-6 mb-5">
                <?php if ($customer[0]->emailVerified == 1) { ?>
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
    </div>
</div>

<!-- DT History Appointments -->
<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.appointments'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cust_appointment_page_title'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <div id="search-customer-appointments"></div>
        </div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        <!-- Data Table -->
        <div class="table-responsive">
            <table id="dt-customer-appointments" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                <thead>
                    <tr class="fs-6 fw-bold">
                        <th class="p-2 dt-vertical-align"><?php echo lang('Text.appointment_col_emp'); ?></th>
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

<script>
    var lang = "<?php echo $config[0]->lang; ?>";
    var dtLang = "";

    if (lang == "es")
        dtLang = "<?php echo base_url('assets/js/dataTable/es.json'); ?>";
    else if (lang == "en")
        dtLang = "<?php echo base_url('assets/js/dataTable/en.json'); ?>";

    var dtCustomerAppointment = $('#dt-customer-appointments').DataTable({ // Data Table
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
            url: "<?php echo base_url('ControlPanel/processingCustomerAppointment'); ?>",
            type: "POST",
            data: function(d) {
            d.customerID = '<?php echo $customerID; ?>'
          }
        },
        order: [
            [1, 'desc']
        ],
        columns: [{
                data: 'emp',
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
            $('#search-customer-appointments').html('');
            $('#dt-customer-appointments_filter').appendTo('#search-customer-appointments');
        }
    }); // ok
</script>