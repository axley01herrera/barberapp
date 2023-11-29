<!-- Tab Edit Profile -->
<div class="row">
    <div class="col-12 mt-5">
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
            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="<?php echo lang('Text.prof_change_avatar'); ?>">
                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                <!--Inputs-->
                <input id="avatar<?php echo $uniqid; ?>" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                <input type="hidden" name="avatar_remove" />

            </label>
            <!--Cancel button-->
            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="<?php echo lang('Text.prof_cancel_avatar'); ?>">
                <i class="ki-outline ki-cross fs-3"></i>
            </span>
            <!--Remove button-->
            <?php if (!empty($profile[0]->avatar)) { ?>
                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="<?php echo lang('Text.prof_remove_avatar'); ?>">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
            <?php } ?>
        </div>
    </div>
    <!-- Company Name-->
    <div class="col-12 col-lg-6 mt-5">
        <label class="fs-6 fw-semibold" for="txt-company<?php echo $uniqid; ?>"><?php echo lang('Text.company_name'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="txt-company<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $profile[0]->company_name; ?>" disabled />
    </div>
    <!-- Company Type -->
    <div class="col-12 col-lg-6 mt-5">
        <label class="fs-6 fw-semibold" for="txt-type<?php echo $uniqid; ?>"><?php echo lang('Text.bussines_type'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="txt-type<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $profile[0]->company_type; ?>" disabled />
    </div>
    <div class="col-12 col-lg-6 mt-5">
        <!-- Email -->
        <label class="fs-6 fw-semibold" for="txt-email<?php echo $uniqid; ?>"><?php echo lang('Text.email'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="txt-email<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> email<?php echo $uniqid; ?>" maxlength="150" value="<?php echo $profile[0]->email; ?>" disabled />
    </div>
    <div class="col-12 col-lg-3 mt-5">
        <!-- Primary Phone -->
        <label class="fs-6 fw-semibold" for="txt-phone1<?php echo $uniqid; ?>"><?php echo lang('Text.primary_phone'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="txt-phone1<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="45" value="<?php echo $profile[0]->phone1; ?>" disabled />
    </div>
    <div class="col-12 col-lg-3 mt-5">
        <!-- Secondary Phone -->
        <label class="fs-6 fw-semibold" for="txt-phone2<?php echo $uniqid; ?>"><?php echo lang('Text.secondary_phone'); ?></label>
        <input type="text" id="txt-phone2<?php echo $uniqid; ?>" class="form-control" maxlength="45" value="<?php echo $profile[0]->phone2; ?>" disabled />
    </div>
    <div class="col-12 col-lg-6 mt-5">
        <!-- Line 1 -->
        <label class="fs-6 fw-semibold" for="txt-address1<?php echo $uniqid; ?>"><?php echo lang('Text.address1'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="txt-address1<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="150" value="<?php echo $profile[0]->address1; ?>" disabled />
    </div>
    <div class="col-12 col-lg-6 mt-5">
        <!-- Line 2 -->
        <label class="fs-6 fw-semibold" for="txt-address2<?php echo $uniqid; ?>"><?php echo lang('Text.address2'); ?></label>
        <input type="text" id="txt-address2<?php echo $uniqid; ?>" class="form-control" maxlength="150" value="<?php echo $profile[0]->address2; ?>" disabled />
    </div>
    <div class="col-12 col-lg-3 mt-5">
        <!-- City -->
        <label class="fs-6 fw-semibold" for="txt-city<?php echo $uniqid; ?>"><?php echo lang('Text.city'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="txt-city<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="45" value="<?php echo $profile[0]->city; ?>" disabled />
    </div>
    <div class="col-12 col-lg-3 mt-5">
        <!-- State -->
        <label class="fs-6 fw-semibold" for="txt-state<?php echo $uniqid; ?>"><?php echo lang('Text.state'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="txt-state<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="45" value="<?php echo $profile[0]->state; ?>" disabled />
    </div>
    <div class="col-12 col-lg-3 mt-5">
        <!-- Zip -->
        <label class="fs-6 fw-semibold" for="txt-zip<?php echo $uniqid; ?>"><?php echo lang('Text.zip'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="txt-zip<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> number<?php echo $uniqid; ?>" maxlength="5" value="<?php if (!empty($profile[0]->zip)) echo $profile[0]->zip; ?>" disabled />
    </div>
    <div class="col-12 col-lg-3 mt-5">
        <!-- Country -->
        <label class="fs-6 fw-semibold" for="txt-country<?php echo $uniqid; ?>"><?php echo lang('Text.country'); ?> <span class="text-danger">*</span></label>
        <input type="text" id="txt-country<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="45" value="<?php echo $profile[0]->country; ?>" disabled />
    </div>
</div>
<div class="row">
    <div class="col-12 text-end mt-5">
        <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_enable_edit'); ?></button>
    </div>
</div>
<div class="row">
    <div class="col-12 text-end mt-5">
        <button hidden type="button" id="btn-cancel<?php echo $uniqid; ?>" class="btn btn-secondary"><?php echo lang('Text.btn_cancel'); ?></button>
        <button hidden type="button" id="btn-update<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_update'); ?></button>
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
                url: "<?php echo base_url('ControlPanel/uploadAvatarProfile'); ?>",
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.error === 0)
                        window.location.href = "<?php echo base_url('ControlPanel/profile?tab='); ?>" + tab;
                    else if (response.error === 1)
                        globalError();
                    else
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                },
                error: function(error) {
                    globalError();
                }
            });
        });

        imageInput.on("kt.imageinput.cancel", function() { // Remove On Cancel
            $.ajax({
                type: "post",
                url: "<?php echo base_url('ControlPanel/removeAvatarProfile'); ?>",
                data: "",
                dataType: "json",
                success: function(response) {
                    if (response.error === 0)
                        window.location.href = "<?php echo base_url('ControlPanel/profile?tab='); ?>" + tab;
                    else if (response.error === 1)
                        globalError();
                    else
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                },
                error: function(error) {
                    globalError();
                }
            });
        });

        imageInput.on("kt.imageinput.remove", function() { // Remove On Delete
            $.ajax({
                type: "post",
                url: "<?php echo base_url('ControlPanel/removeAvatarProfile'); ?>",
                data: "",
                dataType: "json",
                success: function(response) {
                    if (response.error === 0)
                        window.location.href = "<?php echo base_url('ControlPanel/profile?tab='); ?>" + tab;
                    else if (response.error === 1)
                        globalError();
                    else
                        window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                },
                error: function(error) {
                    globalError();
                }
            });
        });

        // End Avatar Procedure

        $('#btn-<?php echo $uniqid; ?>').on('click', function() { // Enable Edit
            $('.form-control').each(function() {
                $(this).removeAttr('disabled');
            });
            $(this).attr('hidden', true);
            $('#btn-cancel<?php echo $uniqid; ?>').removeAttr('hidden');
            $('#btn-update<?php echo $uniqid; ?>').removeAttr('hidden');
        });

        $('#btn-cancel<?php echo $uniqid; ?>').on('click', function() { // Cancel Edit
            getProfileTabContent();
        });

        $('#btn-update<?php echo $uniqid; ?>').on('click', function() {
            let result = checkRequiredValues();
            if (result === 0) {
                let resultEmail = checkEmailFormat();
                if (resultEmail === 0) {
                    $('#btn-update<?php echo $uniqid; ?>').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('ControlPanel/updateProfile'); ?>",
                        data: {
                            'company': $('#txt-company<?php echo $uniqid; ?>').val(),
                            'type': $('#txt-type<?php echo $uniqid; ?>').val(),
                            'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                            'phone1': $('#txt-phone1<?php echo $uniqid; ?>').val(),
                            'phone2': $('#txt-phone2<?php echo $uniqid; ?>').val(),
                            'address1': $('#txt-address1<?php echo $uniqid; ?>').val(),
                            'address2': $('#txt-address2<?php echo $uniqid; ?>').val(),
                            'city': $('#txt-city<?php echo $uniqid; ?>').val(),
                            'state': $('#txt-state<?php echo $uniqid; ?>').val(),
                            'zip': $('#txt-zip<?php echo $uniqid; ?>').val(),
                            'country': $('#txt-country<?php echo $uniqid; ?>').val()
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.error === 0) {
                                simpleSuccessAlert("<?php echo lang("Text.prof_data_updated"); ?>");
                                setTimeout(() => {
                                    window.location.href = "<?php echo base_url('ControlPanel/profile?tab='); ?>" + tab;
                                }, "2000");
                            } else if (response.error === 1)
                                globalError();
                            else
                                window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";

                            $('#btn-update<?php echo $uniqid; ?>').removeAttr('disabled');
                        },
                        error: function(error) {
                            globalError();
                            $('#btn-update<?php echo $uniqid; ?>').removeAttr('disabled');
                        }
                    });
                } else
                    simpleAlert("<?php echo lang('Text.invalid_email_format'); ?>", 'warning');
            } else
                simpleAlert("<?php echo lang('Text.required_values'); ?>", 'warning');
        });

        $('.number<?php echo $uniqid; ?>').on('input', function() { // ONLY NUMBER
            jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
        });

        function checkRequiredValues() {
            let result = 0;
            let value = "";

            $('.required<?php echo $uniqid; ?>').each(function() {
                value = $(this).val();
                if (value == "") {
                    $(this).addClass('is-invalid');
                    result = 1;
                }
            });
            return result;
        }

        function checkEmailFormat() {
            let inputValue = '';
            let response = 0;
            let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
            $('.email<?php echo $uniqid; ?>').each(function() {
                inputValue = $(this).val();
                if (!regex.test(inputValue)) {
                    $(this).addClass('is-invalid');
                    response = 1;
                }
            });
            return response;
        }

        $('.required<?php echo $uniqid; ?>').on('focus', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>