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
    <div class="position-relative z-index-2 m-3">
        <div class="container">
            <div class="" style="filter: drop-shadow(0px 0px 40px rgba(68, 81, 96, 0.08))">
                <div class="tab-content">
                    <!-- HERE IMGS-->
                    <div class="tab-pane fade show active" id="kt_landing_projects_latest">
                        <!--begin::Row-->
                        <div class="row g-10">
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <!--begin::Item-->
                                <?php if (empty($image1)) { ?>
                                    <a class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="#">
                                    <?php } else { ?>
                                        <a class="d-block card-rounded overlay h-lg-100 del-image<?php echo $uniqid; ?>" data-fslightbox="lightbox-projects" href="#" data-image-id="<?php echo @$image1[0]->id; ?>">
                                        <?php } ?>
                                        <!--begin::Image-->
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-lg-100 min-h-250px" style="background-image:url('<?php if (!empty($image1[0]->img)) echo "data:image/png;base64," . base64_encode($image1[0]->img) . "";
                                                                                                                                                                                        else echo "" . base_url("public/assets/media/img/img.png") . ""; ?>')"></div>
                                        <!--end::Image-->
                                        <!--begin::Action-->
                                        <?php if (empty($image1)) { ?>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-75">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input id="image1" type="file" class="col-12" name="image" accept=".png, .jpg, .jpeg" />
                                                    </div>
                                                    <div class="col-12 mt-5 text-center">
                                                        <i class="bi bi-cloud-upload-fill fs-4x text-primary upload-image" title="<?php echo lang('Text.upload_photo'); ?>" data-position="1" data-file="#image1"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-75">
                                                <i class="ki-duotone bi bi-trash-fill fs-4x text-danger" title="<?php echo lang('Text.btn_delete'); ?>">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </div>
                                        <?php } ?>
                                        <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <!--begin::Row-->
                                <div class="row g-10 mb-10">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <?php if (empty($image2)) { ?>
                                            <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="#">
                                            <?php } else { ?>
                                                <a class="d-block card-rounded overlay del-image<?php echo $uniqid; ?>" data-fslightbox="lightbox-projects" href="#" data-image-id="<?php echo @$image2[0]->id; ?>">
                                                <?php } ?>
                                                <!--begin::Image-->
                                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('<?php if (!empty($image2[0]->img)) echo "data:image/png;base64," . base64_encode($image2[0]->img) . "";
                                                                                                                                                                                else echo "" . base_url("public/assets/media/img/img.png") . ""; ?>')"> </div>
                                                <!--end::Image-->
                                                <!--begin::Action-->
                                                <?php if (empty($image2)) { ?>
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-75">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <input id="image2" type="file" class="col-12" name="image" accept=".png, .jpg, .jpeg" />
                                                            </div>
                                                            <div class="col-12 mt-5 text-center">
                                                                <i class="bi bi-cloud-upload-fill fs-4x text-primary upload-image" title="<?php echo lang('Text.upload_photo'); ?>" data-position="2" data-file="#image2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-75">
                                                        <i class="ki-duotone bi bi-trash-fill fs-4x text-danger" title="<?php echo lang('Text.btn_delete'); ?>">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </div>
                                                <?php } ?>
                                                <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <?php if (empty($image3)) { ?>
                                            <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="#">
                                            <?php } else { ?>
                                                <a class="d-block card-rounded overlay del-image<?php echo $uniqid; ?>" data-fslightbox="lightbox-projects" href="#" data-image-id="<?php echo @$image3[0]->id; ?>">
                                                <?php } ?>
                                                <!--begin::Image-->
                                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('<?php if (!empty($image3[0]->img)) echo "data:image/png;base64," . base64_encode($image3[0]->img) . "";
                                                                                                                                                                                else echo "" . base_url("public/assets/media/img/img.png") . ""; ?>')"></div>
                                                <!--end::Image-->
                                                <!--begin::Action-->
                                                <?php if (empty($image3)) { ?>
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-75">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <input id="image3" class="col-12" type="file" name="image" accept=".png, .jpg, .jpeg" />
                                                            </div>
                                                            <div class="col-12 mt-5 text-center">
                                                                <i class="bi bi-cloud-upload-fill fs-4x text-primary upload-image" title="<?php echo lang('Text.upload_photo'); ?>" data-position="3" data-file="#image3"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-75">
                                                        <i class="ki-duotone bi bi-trash-fill fs-4x text-danger" title="<?php echo lang('Text.btn_delete'); ?>">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </div>
                                                <?php } ?>

                                                <!--end::Action-->
                                                </a>
                                                <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Item-->
                                <?php if (empty($image4)) { ?>
                                    <a class="d-block card-rounded overlay" data-fslightbox="lightbox-projects" href="#">
                                    <?php } else { ?>
                                        <a class="d-block card-rounded overlay del-image<?php echo $uniqid; ?>" data-fslightbox="lightbox-projects" href="#" data-image-id="<?php echo @$image4[0]->id; ?>">
                                        <?php } ?>
                                        <!--begin::Image-->
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded h-250px" style="background-image:url('<?php if (!empty($image4[0]->img)) echo "data:image/png;base64," . base64_encode($image4[0]->img) . "";
                                                                                                                                                                        else echo "" . base_url("public/assets/media/img/img.png") . ""; ?>')"></div>
                                        <!--end::Image-->
                                        <!--begin::Action-->
                                        <?php if (empty($image4)) { ?>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-75">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input id="image4" type="file" class="col-12" name="image" accept=".png, .jpg, .jpeg" />
                                                    </div>
                                                    <div class="col-12 mt-5 text-center">
                                                        <i class="bi bi-cloud-upload-fill fs-4x text-primary upload-image" title="<?php echo lang('Text.upload_photo'); ?>" data-position="4" data-file="#image4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-75">
                                                <i class="ki-duotone bi bi-trash-fill fs-4x text-danger" title="<?php echo lang('Text.btn_delete'); ?>">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </div>
                                        <?php } ?>
                                        <!--end::Action-->
                                        </a>
                                        <!--end::Item-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //UPLOAD IMAGE
    $('.upload-image').on("click", function() {
        let formData = new FormData();
        formData.append('file', $($(this).attr('data-file'))[0].files[0]);
        formData.append('position', $(this).attr('data-position'));
        if ($($(this).attr('data-file')).val() == '') {
            simpleAlert('<?php echo lang('Text.cp_profile_select_image') ?>', 'warning');
        } else {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('ControlPanel/uploadCompanyImages'); ?>",
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.error === 0)
                        getProfileTabContent();
                    else if (response.error === 1)
                        globalError();
                    else
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                },
                error: function(error) {
                    globalError();
                }
            });
        }
    });

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

    <div class="card card-flush mb-6 mb-xl-9" hidden>
        <div class="card-body p-9 pt-4">
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