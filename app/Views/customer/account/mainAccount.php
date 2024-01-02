<div id="page" data-page="customer-profile" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.cust_account_page_title'); ?>
                </h1>
                <!-- Page Sub Title -->
                <div class="fs-6 fw-semibold text-muted"></div>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3"></div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!-- Tabs Header -->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8" role="tablist">
                <!-- Info -->
                <li class="nav-item">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-customer-account<?php echo $uniqid; ?> <?php if ($tab == "info") echo "active"; ?> " data-tab="info" href="#"><?php echo lang('Text.cp_cust_profile_tab_info'); ?></a>
                </li>
                <!-- Credentials -->
                <li class="nav-item">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 tab-customer-account<?php echo $uniqid; ?> <?php if ($tab == "credentials") echo "active"; ?>" data-tab="credentials" href="#"><?php echo lang('Text.account'); ?></a>
                </li>
            </ul>
            <div id="customer-tab-content"></div>
        </div>
    </div>
</div>

<script>
    var tab = "<?php echo $tab; ?>";
    getTabContent();

    function getTabContent() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/accountTab'); ?>",
            data: {
                'tab': tab
            },
            dataType: "html",
            success: function(response) {
                $('#customer-tab-content').html(response);
            },
            error: function() {
                globalError();
            }
        });
    }

    $('.tab-customer-account<?php echo $uniqid; ?>').on('click', function(e) {
        e.preventDefault();
        tab = $(this).attr('data-tab');
        window.location.href = "<?php echo base_url('Customer/account?tab='); ?>" + tab;
    });

</script>