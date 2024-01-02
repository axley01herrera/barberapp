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
            <div id="dtTodayAppointments"></div>
        </div>
    </div>
</div>

<script>
    dtTodayAppointments ();

    function dtTodayAppointments () {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/dtTodayAppointments'); ?>",
            data: "",
            dataType: "html",
            success: function (response) {
                $('#dtTodayAppointments').html(response);
            },
            error: function (e) {
                globalError();
            }
        });
    }
</script>