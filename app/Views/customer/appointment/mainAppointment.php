<div id="page" data-page="main-customers" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cp_cust_appointment_history'); ?>
                </h1>
                <!-- Page Sub Title -->
                <div class="fs-6 fw-semibold text-muted"></div>
            </div>
            <!-- Page Button Action -->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="<?php echo base_url('Customer/createAppointment'); ?>" class="btn btn-primary"><?php echo lang('Text.btn_create_appointment'); ?></a>
            </div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!-- Card -->
            <div class="card mb-5 mb-xl-10 mt-5">
                <!-- Card Header -->
                <div class="card-header border-0">
                    <!-- Card Title -->
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative ">
                            <h5></h5>
                        </div>
                    </div>
                    <!-- Card Toolbar -->
                    <div class="card-toolbar">
                        <div id="search-customer-appointments"></div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body pb-0">
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
            url: "<?php echo base_url('Customer/processingAppointment'); ?>",
            type: "POST"
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