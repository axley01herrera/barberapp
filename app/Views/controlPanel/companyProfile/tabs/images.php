<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_profile_menu_photo'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_profile_photo_subtitle'); ?>.</div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar"></div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        <div class="row">
            <?php foreach ($images as $img) { ?>
                <div class="col-12 col-md-6 col-lg-3 mb-5">
                    <div class="card-body text-center">
                        <img src="data:image/png;base64,<?php echo base64_encode($img->img); ?>" class="rounded-3 mb-4 w-100px h-100px" alt="Image">
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-sm btn-danger del-image<?php echo $uniqid; ?>" data-image-id="<?php echo $img->id; ?>"><?php echo lang('Text.btn_delete'); ?></button>
                        </div>
                    </div>
                </div>
            <?php }  ?>
            <?php if (empty($images)) { ?>
                <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
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

<?php if (sizeof($images) < 4) { ?>

    <div class="card card-flush mb-6 mb-xl-9">
        <div class="card-body p-9 pt-4">
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
                <div class="col-12 text-end">
                    <button id="upload-<?php echo $uniqid; ?>" type="button" class="btn btn-primary"><?php echo lang('Text.btn_save'); ?></button>
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
                this.on("sending", function(file, xhr, formData) {});
            }
        });

        $('#upload-<?php echo $uniqid; ?>').on('click', function() {
            if (myDropzone.files.length > 0) {
                myDropzone.processQueue();
                myDropzone.on("complete", function(response) {
                    simpleSuccessAlert('<?php echo lang('Text.cp_profile_success_upload_imgs'); ?>');
                    getProfileTabContent();
                });
            } else
                simpleAlert('<?php echo lang('Text.cp_profile_not_images'); ?>', 'warning');
        });
    </script>
<?php }  ?>

<!-- Del Img -->
<script>
    $('.del-image<?php echo $uniqid; ?>').on('click', function(e) {
        e.preventDefault();
        let imageID = $(this).attr('data-image-id');

        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/deleteCompanyImages'); ?>",
            data: {
                'imageID': imageID
            },
            dataType: "json",
            success: function(response) {
                if (response.error == 0) {
                    simpleSuccessAlert('<?php echo lang('Text.cp_profile_success_delete_img'); ?>');
                    getProfileTabContent();
                } else
                    globalError();
            },
            error: function(e) {
                globalError();
            }
        });
    });
</script>