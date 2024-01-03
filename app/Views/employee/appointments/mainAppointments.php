<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.appointments'); ?>
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
                <!-- DT History Appointments -->
                <!-- Data Table -->
                <div class="container">
                    <div class="card p-9 pt-4">
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
            </div>
        </div>
    </div>
</div>

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