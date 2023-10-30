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
    </div>
</div>

<script>
    $(document).ready(function() {

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