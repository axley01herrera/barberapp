<link href="<?php echo base_url('assets/plugins/custom/datatables/datatables.bundle.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/plugins/custom/datatables/datatables.bundle.js'); ?>"></script>

<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.top_bar_customers'); ?>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3"></div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row">
                <div class="col-12 text-end">
                    <button id="btn-new-customer<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang("Text.cust_new"); ?></button>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card mb-5 mb-xl-10 shadow">
                    <div class="card-body border-top p-9">
                        <div class="table-responsive">
                            <table id="dtCustomers" class="table no-footer">
                                <thead>
                                    <tr class="fs-7 fw-bold">
                                        <th><?php echo lang('Text.dt_customer_name'); ?></th>
                                        <th><?php echo lang('Text.dt_customer_last_name'); ?></th>
                                        <th><?php echo lang('Text.dt_customer_email'); ?></th>
                                        <th><?php echo lang('Text.dt_customer_phone'); ?></th>
                                        <th></th>
                                        <th><?php echo lang('Text.dt_customer_status'); ?></th>
                                        <th><?php echo lang('Text.dt_customer_term'); ?></th>
                                        <th><?php echo lang('Text.dt_customer_email_subscription'); ?></th>
                                        <th></th>
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

<script>
    $(document).ready(function() {
        var dtCustomers = $('#dtCustomers').DataTable({ //DATA TABLE
            dom: 'RfrtlpiB',
            destroy: true,
            processing: true,
            language: {
                search: "",
                searchPlaceholder: 'Search'
            },
            serverSide: true,
            responsive: true,
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            buttons: [],
            ajax: {
                url: "<?php echo base_url('Admin/processingCustomer'); ?>",
                type: "POST"
            },
            order: [
                [0, 'asc']
            ],
            columns: [{
                    data: 'name'
                },
                {
                    data: 'lastName'
                },
                {
                    data: 'email'
                },
                {
                    data: 'phone',
                    searchable: false
                },
                {
                    data: 'switch',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'term',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'emailSubscription',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    class: 'text-center',
                    orderable: false,
                    searchable: false
                },
            ],
        });

        dtCustomers.on('click', '.switch_active_inactive', function(event) { // ACTIVE OR INACTIVE CUSTOMER
            event.preventDefault();
            let userID = $(this).attr('data-id');

            let status = $(this).attr('data-status');
            let newStatus = '';

            if (status == 0)
                newStatus = 1;
            else if (status == 1)
                newStatus = 0;

            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/changeCustomerStatus'); ?>",
                data: {
                    'userID': userID,
                    'status': newStatus
                },
                dataType: "json",
                success: function(jsonResponse) {
                    if (jsonResponse.error == 0) // CASE SUCCESS
                        dtCustomers.draw();
                    else // CASE ERROR
                        simpleAlert('error', 'Ha ocurrido un error');

                    if (jsonResponse.error == 2) // SESSION EXPIRED
                        window.location.href = '<?php echo base_url('Authentication'); ?>'
                },
                error: function() {
                    simpleAlert('error', 'Ha ocurrido un error');
                }
            });
        });

        $('#btn-new-customer<?php echo $uniqid; ?>').on('click', function() { // Create Customer
            $('#btn-new-customer<?php echo $uniqid; ?>').attr('disabled', true);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/showModalCustomer'); ?>",
                data: {
                    'action': "create"
                },
                dataType: "html",
                success: function(response) {
                    $('#btn-new-customer<?php echo $uniqid; ?>').removeAttr('disabled');
                    $('#app-modal').html(response);
                },
                error: function() {
                    $('#btn-new-customer<?php echo $uniqid; ?>').removeAttr('disabled');
                    globalError();
                }
            });

        });
    });
</script>