<div id="page" data-page="main-customers" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cust_appointment_page_title'); ?>
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
            <div class="row">
                <!-- Upcoming Appointments -->
                <div class="col-12 col-md-4 col-lg-4">
                    <?php echo view('customer/appointment/sectionUpcomingAppointment'); ?>
                </div>
            </div>
        </div>
    </div>
</div>