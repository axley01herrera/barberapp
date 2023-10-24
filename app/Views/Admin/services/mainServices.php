<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!-- Page Title -->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    <?php echo lang('Text.top_bar_services'); ?>
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
                    <button id="btn-new-serv<?php echo $uniqid; ?>" class="btn btn-success"><?php echo lang("Text.serv_new"); ?></button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Title</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-light">
                                    Action
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            Lorem Ipsum is simply dummy text...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btn-new-serv<?php echo $uniqid; ?>').on('click', function() {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/showModalNewService'); ?>",
                data: {
                    'action': "create"
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
    });
</script>