<div class="row">
    <div class="col-12 col-md-4 col-lg-4">
        <div class="row">
            <div class="col-12 mt-2">
                <h6 class="fw-semibold"><?php echo lang('Text.avatar'); ?></h6>
                <style>
                    .image-input-placeholder {
                        background-image: url('svg/avatars/blank.svg');
                    }

                    [data-bs-theme="dark"] .image-input-placeholder {
                        background-image: url('svg/avatars/blank-dark.svg');
                    }
                </style>

                <!--Image Input-->
                <div id="kt_image_input_profile<?php echo $uniqid; ?>" class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(<?php echo base_url('public/assets/media/svg/avatars/blank.svg'); ?>)">
                    <!--Image Preview-->
                    <?php if (empty($profile[0]->avatar)) { ?>
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(<?php echo base_url('public/assets/media/svg/avatars/blank.svg'); ?>)"></div>
                    <?php } else { ?>
                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(data:image/png;base64,<?php echo base64_encode($profile[0]->avatar); ?>)"></div>
                    <?php } ?>

                    <!--Edit Button-->
                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change avatar">
                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                        <!--Inputs-->
                        <input id="avatar<?php echo $uniqid; ?>" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar_remove" />

                    </label>


                    <!--Cancel button-->
                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancel avatar">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </span>

                    <!--Remove button-->
                    <?php if (!empty($profile[0]->avatar)) { ?>
                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove avatar">
                            <i class="ki-outline ki-cross fs-3"></i>
                        </span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-4">
        <div class="row">
            <div class="col-12">
                <!-- Name-->
                <label class="fs-6 fw-semibold" for="txt-name<?php echo $uniqid; ?>"><?php echo lang('Text.name'); ?></label>
                <input type="text" id="txt-name<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $profile[0]->name; ?>" disabled />
            </div>
            <div class="col-12 mt-5">
                <!-- Last Name-->
                <label class="fs-6 fw-semibold" for="txt-lastName<?php echo $uniqid; ?>"><?php echo lang('Text.last_name'); ?></label>
                <input type="text" id="txt-lastName<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $profile[0]->last_name; ?>" disabled />
            </div>
            <div class="col-12 mt-5">
                <!-- Email-->
                <label class="fs-6 fw-semibold" for="txt-lastName<?php echo $uniqid; ?>"><?php echo lang('Text.email'); ?></label>
                <input type="text" id="txt-lastName<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> email<?php echo $uniqid; ?>" value="<?php echo $profile[0]->email; ?>" disabled />
            </div>
            <div class="col-12 mt-5">
                <!-- Primary Phone-->
                <label class="fs-6 fw-semibold" for="txt-phone1<?php echo $uniqid; ?>"><?php echo lang('Text.primary_phone'); ?></label>
                <input type="text" id="txt-phone1<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $profile[0]->phone1; ?>" disabled />
            </div>
            <div class="col-12 mt-5">
                <!-- Secondary Phone-->
                <label class="fs-6 fw-semibold" for="txt-phone2<?php echo $uniqid; ?>"><?php echo lang('Text.secondary_phone'); ?></label>
                <input type="text" id="txt-phone2<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $profile[0]->phone2; ?>" disabled />
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-4">

    </div>
</div>

<script>
    $(document).ready(function() {

        // Avatar Procedure
        let avatarProfile = new KTImageInput.createInstances();
        let imageInputElement = document.querySelector("#kt_image_input_profile<?php echo $uniqid; ?>");
        let imageInput = KTImageInput.getInstance(imageInputElement);

        imageInput.on("kt.imageinput.change", function() { // Upload On Change
            let formData = new FormData();
            formData.append('file', $("#avatar<?php echo $uniqid; ?>")[0].files[0]);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Admin/uploadAvatarProfile'); ?>",
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) { console.log(response);
                    if(response.error === 0)
                        getProfileTabContent();
                    else 
                        globalError();
                },
                error: function(error) {
                    globalError();
                }
            });
        });

        imageInput.on("kt.imageinput.cancel", function() { // Remove On Cancel

        });

        imageInput.on("kt.imageinput.remove", function() { // Remove On Delete

        });

        // End Avatar Procedure
    });
</script>