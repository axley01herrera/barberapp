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
            <!-- Page Button Action -->
            <div class="d-flex align-items-center gap-2 gap-lg-3"></div>
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
                            <?php echo view('customer/dashboard/sectionInfo'); ?>
                        </div>
                    </div>
                    <!-- Upcoming Appointments -->
                    <h5><?php echo lang('Text.cust_dash_upcoming_appointment_title'); ?></h5>
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
                        <!-- Tab Profile-->
                        <li class="nav-item" role="presentation">
                            <a id="tab-profile" class="nav-link text-active-primary pb-4 tab-profile" data-bs-toggle="tab" href="#" aria-selected="false" tabindex="-1" role="tab"><?php echo lang('Text.cp_cust_profile_tab_info'); ?></a>
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
</script>