<div id="page" data-page="customer-index" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cp_customer_detail'); ?>
                </h1>
            </div>
            <!-- Change Customer Status -->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="form-check form-switch form-check-custom form-check mt-2">
                    <input type="checkbox" id="cbx-customer-status<?php echo $uniqid; ?>" class="form-check-input form-control h-30px w-50px" title="<?php echo lang('Text.cp_cust_change_status'); ?>" data-status="<?php echo $customer[0]->status; ?>" <?php if ($customer[0]->status == 1) echo "checked"; ?> />
                    <label class="fs-6 fw-semibold ms-5"></label>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <div id="customer-info" class="card-body">
                            <!-- Customer Info -->
                            <?php echo view('controlPanel/customers/customerProfile/customerInfo'); ?>
                        </div>
                    </div>
                    <!-- Upcoming Appointments -->
                    <h5><?php echo lang('Text.cp_cust_dash_upcoming_appointment_title'); ?></h5>
                    <?php echo view('customer/dashboard/upcomingAppointment'); ?>
                </div>
                <!-- Tabs -->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!-- Tabs Header -->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8" role="tablist">
                        <!-- Tab Overview -->
                        <li class="nav-item" role="presentation">
                            <a id="tab-overview" class="nav-link text-active-primary pb-4 active tab-profile" data-bs-toggle="tab" href="#" data-kt-initialized="1" aria-selected="false" tabindex="-1" role="tab"><?php echo lang('Text.cp_cust_profile_tab_overview'); ?></a>
                        </li>
                        <!-- Tab Account -->
                        <li class="nav-item" role="presentation">
                            <a id="tab-account" class="nav-link text-active-primary pb-4 tab-profile" data-bs-toggle="tab" href="#" data-kt-initialized="1" aria-selected="false" tabindex="-1" role="tab"><?php echo lang('Text.cp_cust_profile_tab_account'); ?></a>
                        </li>
                        <!-- Tab Info -->
                        <li class="nav-item" role="presentation">
                            <a id="tab-info" class="nav-link text-active-primary pb-4 tab-profile" data-bs-toggle="tab" href="#" aria-selected="false" tabindex="-1" role="tab"><?php echo lang('Text.cp_cust_profile_tab_info'); ?></a>
                        </li>
                    </ul>
                    <!-- Tab Content -->
                    <div id="tabContent"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var tab = "tab-overview";
    var customerID = "<?php echo $customer[0]->id; ?>";
    customerTabContent();

    function customerTabContent() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/customerTabContent'); ?>",
            data: {
                'customerID': customerID,
                'tab': tab
            },
            dataType: "html",
            success: function(response) {
                $('#tabContent').html(response);
            },
            error: function() {
                globalError();
            }
        });
    }

    $('.tab-profile').on('click', function(e) {
        e.preventDefault();

        $('.tab-profile').each(function() {
            $(this).removeClass('active');
        });

        tab = $(this).attr('id');

        $(this).addClass('active');

        customerTabContent();
    });

    function reloadCustomerInfo() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/reloadCustomerInfo'); ?>",
            data: {
                'customerID': customerID
            },
            dataType: "html",
            success: function(response) {
                $('#customer-info').html(response);
            },
            error: function() {
                globalError();
            }
        });
    }

    $('#cbx-customer-status<?php echo $uniqid; ?>').on('click', function() { // Change Status
        let status = $(this).attr('data-status');
        let newStatus = "";
        let msg = "";

        if (status == 0) {
            newStatus = 1;
            msg = "<?php echo lang('Text.cp_cust_activated'); ?>";
        } else if (status == 1) {
            newStatus = 0;
            msg = "<?php echo lang('Text.cp_cust_deactivated'); ?>";
        }

        $(this).attr('data-status', newStatus);

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/changeCustomerStatus'); ?>",
            data: {
                'customerID': customerID,
                'status': newStatus
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0)
                    simpleSuccessAlert(msg);
                else {
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
    }) // ok
</script>