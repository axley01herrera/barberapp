<div id="page" data-page="main-employees" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cp_emp_page_title'); ?>
                </h1>
            </div>
            <!-- Page Button Action -->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button id="btn-new-employee<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang("Text.cp_emp_btn_new"); ?></button>
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
                        <div id="search-employees"></div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body pb-0">
                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table id="dt-employees" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                            <thead>
                                <tr class="fs-6 fw-bold">
                                    <th class="p-2"><?php echo lang('Text.employee_label_col_emp'); ?></th>
                                    <th class="p-2"><?php echo lang('Text.employee_label_col_email'); ?></th>
                                    <th class="text-center p-2"><?php echo lang('Text.employee_label_col_status'); ?></th>
                                    <th class="text-end p-2"></th>
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

    $('#btn-new-employee<?php echo $uniqid; ?>').on('click', function() { // Create
        $('#btn-new-employee<?php echo $uniqid; ?>').attr('disabled', true);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/showModalEmployee'); ?>",
            data: {
                'action': "create"
            },
            dataType: "html",
            success: function(response) {
                $('#btn-new-employee<?php echo $uniqid; ?>').removeAttr('disabled');
                $('#app-modal').html(response);
            },
            error: function(e) {
                $('#btn-new-employee<?php echo $uniqid; ?>').removeAttr('disabled');
                globalError();
            }
        });
    }); // ok

    var dtEmployees = $('#dt-employees').DataTable({ // Data Table
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
            url: "<?php echo base_url('ControlPanel/processingEmployee'); ?>",
            type: "POST"
        },
        order: [
            [0, 'asc']
        ],
        columns: [{
                data: 'avatar',
                class: 'dt-vertical-align p-2'
            },
            {
                data: 'email',
                class: 'dt-vertical-align p-2'
            },
            {
                data: 'status',
                class: 'dt-vertical-align text-center p-2',
                searchable: false
            },
            {
                data: 'action',
                class: 'dt-vertical-align text-end p-2',
                orderable: false,
                searchable: false
            },
        ],
        initComplete: function(settings, json) {
            $('#search-employees').html('');
            $('#dt-employees_filter').appendTo('#search-employees');
        }
    }); // ok

    dtEmployees.on('click', '.resend-verify-email', function() { // Resend Verify Email 
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/resendVerifyEmail'); ?>",
            data: {
                'employeeID': $(this).attr('data-employee-id'),
                'type': 'employee'
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0) {
                    simpleSuccessAlert('<?php echo lang('Text.cp_emp_success_resend_verify_email'); ?>');
                } else {
                    if (response.msg == "SESSION_EXPIRED") 
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                    else 
                        globalError();
                }
            },
            error: function(e) {
                globalError();
            }
        });
    }); // ok

    dtEmployees.on('click', '.resend-complete-account-email', function() { // Resend Complete Account Email 
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/resendCompleteAccount'); ?>",
            data: {
                'employeeID': $(this).attr('data-employee-id')
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0) {
                    simpleSuccessAlert('<?php echo lang('Text.cp_emp_success_resend_complete_account'); ?>');
                } else {
                    if (response.msg == "SESSION_EXPIRED") {
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                    } else {
                        globalError();
                    }
                }
            },
            error: function(e) {
                globalError();
            }
        });
    }); // ok

    dtEmployees.on('click', '.change-status', function() {
        let employeeID = $(this).attr('data-employee-id');
        let status = $(this).attr('data-status');
        let newStatus = "";
        let msg = "";

        if (status == 0) {
            newStatus = 1;
            msg = "<?php echo lang('Text.cp_emp_activated'); ?>";
        } else if (status == 1) {
            newStatus = 0;
            msg = "<?php echo lang('Text.cp_emp_deactivated'); ?>";
        }

        $(this).attr('data-status', newStatus);

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/changeEmployeeStatus'); ?>",
            data: {
                'employeeID': employeeID,
                'status': newStatus
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0) {
                    simpleSuccessAlert(msg);
                } else {
                    if (response.msg == "SESSION_EXPIRED") {
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                    } else
                        globalError();
                }
            },
            error: function(e) {
                globalError();
            }
        });
    }); // ok

    dtEmployees.on('click', '.edit-employee', function() { // Edit
        let employeeID = $(this).attr('data-employee-id');

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/showModalEmployee'); ?>",
            data: {
                'action': "update",
                'employeeID': employeeID
            },
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            },
            error: function(e) {
                globalError();
            }
        });
    }); // ok

    dtEmployees.on('click', '.delete-employee', function() { // Delete
        let employeeID = $(this).attr('data-employee-id');
        Swal.fire({
            title: '<?php echo lang('Text.are_you_sure_msg'); ?>',
            text: "<?php echo lang('Text.not_revert_this_msg'); ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Text.yes_remove_msg'); ?>',
            cancelButtonText: '<?php echo lang('Text.no_cancel_msg'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('ControlPanel/deleteEmployee'); ?>",
                    data: {
                        'employeeID': employeeID
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            simpleSuccessAlert('<?php echo lang('Text.emp_success_deleted'); ?>');
                            dtEmployees.draw();
                        } else {
                            if (response.msg == "SESSION_EXPIRED") {
                                window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
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
    }); // ok
</script>