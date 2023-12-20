<div id="page" data-page="main-customers" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!-- Page Title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cust_appointment_title'); ?>
                </h1>
                <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cust_appointment_subtitle'); ?></div>
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
                <div class="card-body pb-0">
                    <?php if (empty($appointments)) { ?>
                        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 mb-7">
                            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
                                <span><?php echo lang('Text.cust_not_have_turns'); ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
