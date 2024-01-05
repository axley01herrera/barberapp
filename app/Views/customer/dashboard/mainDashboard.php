<div id="page" data-page="customer-dashboard" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cust_menu_dash'); ?>
                </h1>
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
            <div class="d-flex flex-column flex-lg-row">

                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <!-- Section Customer Info -->
                        <div id="customer-info" class="card-body">
                            <?php echo view('customer/dashboard/sectionInfo'); ?>
                        </div>
                    </div>
                </div>

                <div class="flex-lg-row-fluid ms-lg-20">
                    <!-- Upcoming Appointments -->
                    <h5><?php echo lang('Text.cust_dash_upcoming_appointment_title'); ?></h5>
                    <div class="row">
                        <?php echo view('customer/dashboard/upcomingAppointment'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>