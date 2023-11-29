<div id="page" data-page="main-customers" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.top_bar_customers'); ?>
                </h1>
            </div>
            <!-- Page Button Action -->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button id="btn-new-customer<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang("Text.cust_btn_new"); ?></button>
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
                        <div id="search-customers"></div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body pb-0">
                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table id="dt-customers" class="table table-row-bordered no-footer table-hover">
                            <thead>
                                <tr class="fs-6 fw-bold">
                                    <th class="p-2"><?php echo lang('Text.dt_customer_name'); ?></th>
                                    <th class="p-2"><?php echo lang('Text.dt_customer_last_name'); ?></th>
                                    <th class="p-2"><?php echo lang('Text.dt_customer_email'); ?></th>
                                    <th class="p-2"><?php echo lang('Text.dt_customer_phone'); ?></th>
                                    <th class="text-center p-2"><?php echo lang('Text.dt_customer_status'); ?></th>
                                    <th class="text-center p-2"></th>
                                    <th class="text-center p-2"></th>
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

    $('#btn-new-customer<?php echo $uniqid; ?>').on('click', function() { // Create
        $('#btn-new-customer<?php echo $uniqid; ?>').attr('disabled', true);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/showModalCustomer'); ?>",
            data: {
                'action': "create"
            },
            dataType: "html",
            success: function(response) {
                $('#btn-new-customer<?php echo $uniqid; ?>').removeAttr('disabled');
                $('#app-modal').html(response);
            },
            error: function(e) {
                $('#btn-new-customer<?php echo $uniqid; ?>').removeAttr('disabled');
                globalError();
            }
        });
    }); // ok

    var dtCustomers = $('#dt-customers').DataTable({ // Data Table
        dom: 'RfrtlpiB',
        processing: true,
        serverSide: true,
        stateSave: true,
        pageLength: 10,
        language: {
            url: dtLang
        },
        buttons: [],
        ajax: {
            url: "<?php echo base_url('ControlPanel/processingCustomer'); ?>",
            type: "POST"
        },
        order: [
            [0, 'asc']
        ],
        columns: [{
                data: 'name',
                class: 'dt-vertical-align p-2'
            },
            {
                data: 'lastName',
                class: 'dt-vertical-align p-2'
            },
            {
                data: 'email',
                class: 'dt-vertical-align p-2'
            },
            {
                data: 'phone',
                class: 'dt-vertical-align p-2'
            },
            {
                data: 'status',
                class: 'dt-vertical-align text-center p-2',
                searchable: false
            },
            {
                data: 'emailVerified',
                class: 'dt-vertical-align text-center p-2',
                searchable: false
            },
            {
                data: 'action',
                class: 'dt-vertical-align text-center p-2',
                orderable: false,
                searchable: false
            },
        ],
        initComplete: function(settings, json) {
            $('#search-customers').html('');
            $('#dt-customers_filter').appendTo('#search-customers');
        }
    }); // ok

    dtCustomers.on('click', '.change-status', function() {
        let customerID = $(this).attr('data-customer-id');
        let status = $(this).attr('data-status');

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/changeCustomerStatus'); ?>",
            data: {
                'customerID': customerID,
                'status': status
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0) {
                    simpleSuccessAlert('<?php echo lang('Text.success_change_status'); ?>');
                    dtCustomers.draw();
                } else {
                    if (response.msg == "SESSION_EXPIRED") {
                        window.location.href = "<?php echo base_url('Home/loginAdmin?session=expired'); ?>";
                    } else
                        globalError();
                }
            },
            error: function(e) {
                globalError();
            }
        });
    })

    dtCustomers.on('click', '.edit-customer', function() { // Edit
        let customerID = $(this).attr('data-customer-id');

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/showModalCustomer'); ?>",
            data: {
                'action': "update",
                'customerID': customerID
            },
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            },
            error: function(e) {
                globalError();
            }
        });
    }) // ok

    dtCustomers.on('click', '.delete-customer', function() { // Delete
        let customerID = $(this).attr('data-customer-id');
        Swal.fire({
            title: '<?php echo lang('Text.are_you_sure'); ?>',
            text: "<?php echo lang('Text.not_revert_this'); ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Text.yes_remove'); ?>',
            cancelButtonText: '<?php echo lang('Text.no_cancel'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('ControlPanel/deleteCustomer'); ?>",
                    data: {
                        'customerID': customerID
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            simpleSuccessAlert('<?php echo lang('Text.cust_success_deleted'); ?>');
                            dtCustomers.draw();
                        } else {
                            if (response.msg == "SESSION_EXPIRED") {
                                window.location.href = "<?php echo base_url('Home/loginAdmin?session=expired'); ?>";
                            } else
                                globalError();
                        }
                    },
                    error: function(e) {
                        globalError();
                    }
                });
            }
        })
    }) // ok
</script>