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
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!-- Card -->
            <div class="card mb-5 mb-xl-10 mt-5">
                <!-- Card Header -->
                <div class="card-header border-0">
                    <!-- Card Title -->
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative ">
                            <h5></h5>
                        </div>
                    </div>
                    <!-- Card Toolbar -->
                    <div class="card-toolbar">
                        <div id="search-service"></div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body pb-0">
                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table id="dt-service" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                            <thead>
                                <tr class="fs-6 fw-bold">
                                    <th class="p-2"><?php echo lang('Text.dt_serv_title'); ?></th>
                                    <th class="p-2"><?php echo lang('Text.dt_serv_price'); ?></th>
                                    <th class="text-center p-2"><?php echo lang('Text.dt_serv_time'); ?></th>
                                    <th class="p-2"><?php echo lang('Text.dt_serv_dec'); ?></th>
                                    <th class="text-center p-2"><?php echo lang('Text.dt_serv_status'); ?></th>
                                    <th class="text-center p-2"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var lang = "<?php echo $config[0]->lang; ?>";
    var dtLang = "";

    if (lang == "es")
        dtLang = "<?php echo base_url('assets/js/dataTable/es.json'); ?>";
    else if (lang == "en")
        dtLang = "<?php echo base_url('assets/js/dataTable/en.json'); ?>";

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
    });

    var dtService = $('#dt-service').DataTable({ // Data Table
        dom: 'RfrtlpiB',
        processing: true,
        serverSide: true,
        stateSave: true,
        pageLength: 10,
        language: {
            url: dtLang
        },
        buttons: [],
        ajax: {
            url: "<?php echo base_url('ControlPanel/processingService'); ?>",
            type: "POST"
        },
        order: [
            [0, 'asc']
        ],
        columns: [{
                data: 'title',
                class: 'dt-vertical-align p-2'
            },
            {
                data: 'price',
                class: 'dt-vertical-align p-2'
            },
            {
                data: 'time',
                class: 'dt-vertical-align text-center p-2'
            },
            {
                data: 'desc',
                class: 'dt-vertical-align p-2',
                orderable: false,
                searchable: false
            },
            {
                data: 'status',
                class: 'dt-vertical-align text-center p-2',
                searchable: false
            },
            {
                data: 'action',
                class: 'dt-vertical-align text-center p-2',
                orderable: false,
                searchable: false
            },
        ],
        initComplete: function(settings, json) {
            $('#search-service').html('');
            $('#dt-service_filter').appendTo('#search-service');
        }
    }); // ok

    dtService.on('click', '.edit-service', function() { // Edit Service
        let id = $(this).attr('data-service-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/showModalService'); ?>",
            data: {
                'id': id,
                'action': "update"
            },
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            },
            error: function() {
                globalError();
            }
        });
    });
</script>