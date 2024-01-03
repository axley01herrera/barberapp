<div class="card card-flush mb-6 mb-xl-9 p-3">
    <!-- Card header -->
    <div class="card-header mt-2">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_profile_menu_photo'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_profile_photo_subtitle'); ?>.</div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar"></div>
    </div>
    <!-- Card body -->
    <div class="row justify-content-around">
        <?php foreach ($images as $i) { ?>
            <div class="d-flex flex-center flex-column py-5 col-3">
                <!-- Image -->
                <div class="symbol symbol-100px mb-7">
                    <img src="data:image/png;base64,<?php echo base64_encode($i->img); ?>" class="w-125px h-125px" alt="Image">
                </div>
                <!-- Action -->
                <button type="button" class="btn btn-sm btn-danger del-image<?php echo $uniqid; ?>" data-image-id="<?php echo $i->id; ?>"><?php echo lang('Text.btn_delete') ?></button>
            </div>
        <?php } ?>
    </div>
    <?php if (empty($images)) { ?>
        <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-80 m-6 p-4">
            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <h5 class="mb-1"><?php echo lang('Text.important'); ?></h5>
                <span><?php echo lang('Text.cp_profile_not_images'); ?></span>
            </div>
        </div>
    <?php } ?>
</div>



<script>
    //DELETE IMAGE
    $('.del-image<?php echo $uniqid; ?>').on('click', function(e) {
        e.preventDefault();
        let imageID = $(this).attr('data-image-id');
        Swal.fire({
            title: '<?php echo lang('Text.are_you_sure'); ?>',
            text: "<?php echo lang('Text.not_revert_this'); ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Text.yes_remove'); ?>',
            cancelButtonText: '<?php echo lang('Text.no_cancel'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('ControlPanel/deleteCompanyImages'); ?>",
                    data: {
                        'imageID': imageID
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            // simpleSuccessAlert('<?php echo lang('Text.cp_profile_success_delete_img'); ?>');
                            getProfileTabContent();
                        } else
                            globalError();
                    },
                    error: function(e) {
                        globalError();
                    }
                });
            }
        });
    });
</script>

<?php if (sizeof($images) < 4) { ?>
    <div class="row">
        <div class="col-12">
            <!-- Dropzone -->
            <div class="dropzone mb-5" id="dropzone">
                <div class="dz-message needsclick">
                    <i class="ki-duotone ki-file-up fs-4x text-primary"><span class="path1"></span><span class="path2"></span></i>
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
            acceptedFiles: '.jpeg,.jpg,.png',
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