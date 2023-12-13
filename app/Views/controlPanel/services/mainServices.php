<div id="page" data-page="main-service" class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.top_bar_services'); ?>
                </h1>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button id="btn-new-serv<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang("Text.serv_new"); ?></button>
            </div>
        </div>
    </div>
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="services"></div>
    </div>
</div>

<script>
    var lang = "<?php echo $config[0]->lang; ?>";
    var dtLang = "";

    if (lang == "es")
        dtLang = "<?php echo base_url('assets/js/dataTable/es.json'); ?>";
    else if (lang == "en")
        dtLang = "<?php echo base_url('assets/js/dataTable/en.json'); ?>";

    getServices();

    function getServices() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ControlPanel/getServices'); ?>",
            dataType: "html",
            success: function(response) {
                $('#services').html(response);
            },
            error: function(error) {
                globalError();
            }
        });
    };

    $('#btn-new-serv<?php echo $uniqid; ?>').on('click', function() { // Create Service
        $('#btn-new-serv<?php echo $uniqid; ?>').attr('disabled', true);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/showModalService'); ?>",
            data: {
                'action': "create"
            },
            dataType: "html",
            success: function(response) {
                $('#btn-new-serv<?php echo $uniqid; ?>').removeAttr('disabled');
                $('#app-modal').html(response);
            },
            error: function() {
                $('#btn-new-serv<?php echo $uniqid; ?>').removeAttr('disabled');
                globalError();
            }
        });
    }); // ok
</script>