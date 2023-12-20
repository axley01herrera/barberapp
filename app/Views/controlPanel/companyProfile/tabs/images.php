<div class="d-flex flex-column flex-column-fluid">
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4" data-select2-id="select2-data-131-50oa">
                        <div class="card-header">
                            <div class="card-title">
                                <h2><?php echo lang('Text.cp_profile_images_upload_header'); ?></h2>
                            </div>
                            <div class="card-toolbar"></div>
                        </div>
                        <div class="card-body pt-0" data-select2-id="select2-data-130-uoiu">
                            <!-- Dropzone -->
                            <div class="dropzone mb-5" id="dropzone">
                                <div class="dz-message needsclick">
                                    <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>
                                    <div class="ms-4">
                                        <h3 class="fs-5 fw-bold text-gray-900 mb-1"><?php echo lang('Text.photo'); ?></h3>
                                        <span class="fs-7 fw-semibold text-gray-500"><?php echo lang('Text.click_to_select'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-start">
                                    <span class="fs-7 fw-semibold text-gray-500">Se recomienda que tengan alta calidad.</span>
                                </div>
                                <div class="col-12 text-end">
                                    <button id="upload-<?php echo $uniqid; ?>" type="button" class="btn btn-primary"><?php echo lang('Text.btn_save'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-flush py-4 mt-2" data-select2-id="select2-data-131-50oa">
                        <div class="card-header">
                            <div class="card-title">
                                <h2><?php echo lang('Text.cp_profile_businness_images'); ?></h2>
                            </div>
                            <div class="card-toolbar"></div>
                        </div>
                        <div class="card-body pt-0" data-select2-id="select2-data-130-uoiu">
                            <div class="row">
                                <?php if (!empty($images)) { ?>
                                    <?php foreach ($images as $img) { ?>
                                        <div class="col-12 col-md-6 col-lg-4 mb-5">
                                            <div class="card card-flush flex-row-fluid p-6 pb-5 mw-100">
                                                <div class="card-body text-center">
                                                    <img src="data:image/png;base64,<?php echo base64_encode($img->img); ?>" class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px" alt="Image">
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 text-end">
                                                        <a href="#" class="del-img<?php echo $uniqid; ?>" data-image-id="<?php echo $img->id; ?>"><i class="bi bi-trash fs-2 text-danger"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }  ?>
                                <?php } else { ?>
                                    <div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                        <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                            <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
                                            <span><?php echo lang('Text.cp_profile_not_images'); ?></span>
                                        </div>
                                    </div>
                                <?php }  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Drop Zone Media -->
<script>
    var myDropzone = new Dropzone("#dropzone", {
        url: '<?php echo base_url('ControlPanel/uploadCompanyImages'); ?>',
        method: 'post',
        acceptedFiles: '.jpg,.png',
        maxFiles: 5,
        addRemoveLinks: true,
        autoProcessQueue: false,
        paramName: 'files',
        uploadMultiple: true,
        init: function() {
            dropzone = this;
            this.on("sending", function(file, xhr, formData) {

            });
        }
    });

    $('#upload-<?php echo $uniqid; ?>').on('click', function() {
        if (myDropzone.files.length > 0) {
            myDropzone.processQueue();
            myDropzone.on("complete", function(response) {
                simpleSuccessAlert('Archivos subidos');

            });
        } else
            simpleAlert('No hay archivos que subir', 'warning');
    });
</script>

<!-- Del Img -->
<script>
    $('.del-img<?php echo $uniqid; ?>').on('click', function(e) {
        e.preventDefault();
        let ImageID = $(this).attr('data-img-id');

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/deleteImage'); ?>",
            data: {
                'ImageID': ImageID
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0)
                    window.location.reload();
                else
                    globalError();
            },
            error: function(e) {
                globalError();
            }
        });
    });
</script>