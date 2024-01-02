<div id="page" data-page="main-customers" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cp_dash_page_title'); ?>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3"></div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row">
                <div class="col-12 col-lg-4 mb-5">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-50 mb-5 mb-xl-10" style="background-color: #080655; min-height: 200px;">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span id="total-today-appointment" class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"></span>
                                <span class="text-white opacity-50 pt-1 fw-semibold fs-6"><?php echo lang('Text.cp_dash_today_appointents'); ?></span>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end pt-0">
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span><span id="pending-appointment"></span> <?php echo lang('Text.pending'); ?></span>
                                    <span><span id="pecent-appointment"></span>%</span> 
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                    <div id="pecent-appointment-bar" class="bg-success rounded h-8px" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!-- Data Table -->
                <div class="col-12 mb-5">
                    <div id="dtTodayAppointments"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    dtTodayAppointments();

    function dtTodayAppointments() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/dtTodayAppointments'); ?>",
            data: "",
            dataType: "html",
            success: function(response) {
                $('#dtTodayAppointments').html(response);
            },
            error: function(e) {
                globalError();
            }
        });
    }
</script>