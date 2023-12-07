<div class="card pt-4 mb-6 mb-xl-9">
    <div class="card-body pt-0 pb-5">
        <div id="profile-tab-content" class="container mt-10 mb-10">
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

                    <!-- Image Input -->
                    <div id="kt_image_input_profile<?php echo $uniqid; ?>" class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(http://barberapp/public/assets/media/svg/avatars/blank.svg)">
                        <!-- Image Preview -->
                        <?php if (empty($customer[0]->avatar)) { ?>
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url(<?php echo base_url('public/assets/media/svg/avatars/blank.svg'); ?>)"></div>
                        <?php } else { ?>
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url(data:image/png;base64,<?php echo base64_encode($customer[0]->avatar); ?>)"></div>
                        <?php } ?>
                        <!-- Edit Button -->
                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cambiar Avatar">
                            <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                            <!-- Inputs -->
                            <input id="avatar<?php echo $uniqid; ?>" type="file" name="avatar" accept=".png, .jpg, .jpeg">
                            <input type="hidden" name="avatar_remove">

                        </label>
                        <!-- Cancel button -->
                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancelar Avatar">
                            <i class="ki-outline ki-cross fs-3"></i>
                        </span>
                        <!-- Remove button -->
                        <?php if (!empty($customer[0]->avatar)) { ?>
                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="<?php echo lang('Text.prof_remove_avatar'); ?>">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                        <?php } ?>
                    </div>
                    <div class="fs-6 fw-semibold">Avatar</div>
                </div>
                <!-- Name-->
                <div class="col-12 col-lg-6 mt-5">
                    <label class="fs-6 fw-semibold" for="txt-name<?php echo $uniqid; ?>"><?php echo lang('Text.name'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-name<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $customer[0]->name; ?>" disabled="">
                </div>
                <!-- last Name -->
                <div class="col-12 col-lg-6 mt-5">
                    <label class="fs-6 fw-semibold" for="txt-lastName<?php echo $uniqid; ?>"><?php echo lang('Text.last_name'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-lastName<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $customer[0]->lastName; ?>" disabled="">
                </div>
                <div class="col-12 col-lg-4 mt-5">
                    <!-- Phone -->
                    <label class="fs-6 fw-semibold" for="txt-phone<?php echo $uniqid; ?>"><?php echo lang('Text.phone'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-phone<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="45" value="<?php echo $customer[0]->phone; ?>" disabled="">
                </div>
                <div class="col-12 col-lg-4 mt-5">
                    <!-- Gender -->
                    <label class="fs-6 fw-semibold" for="txt-gender<?php echo $uniqid; ?>"><?php echo lang('Text.gender'); ?> <span class="text-danger">*</span></label>
                    <select id="txt-gender<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" disabled="">
                        <option value="" hidden><?php echo lang('Text.select_gender');?></option>
                        <option value="m" <?php if ($customer[0]->gender == 'm') {
                                                echo 'selected hidden';
                                            } ?>><?php echo lang('Text.male');?></option>
                        <option value="f" <?php if ($customer[0]->gender == 'f') {
                                                echo 'selected hidden';
                                            } ?>><?php echo lang('Text.female');?></option>
                        <option value="o" <?php if ($customer[0]->gender == 'o') {
                                                echo 'selected hidden';
                                            } ?>><?php echo lang('Text.other');?></option>
                    </select>
                </div>
                <div class="col-12 col-lg-4 mt-5">
                    <!-- Date of birth -->
                    <label class="fs-6 fw-semibold" for="sel-dob<?php echo $uniqid; ?>"><?php echo lang('Text.dob'); ?> <span class="text-danger">*</span></label>
                    <input id="sel-dob<?php echo $uniqid; ?>" class="flatpickr form-control required<?php echo $uniqid; ?>" value="<?php if (!empty($customer[0]->dob)) echo date($dateLabel, strtotime($customer[0]->dob)); ?>" disabled="" />
                </div>
                <div class="col-12 col-lg-6 mt-5">
                    <!-- Line 1 -->
                    <label class="fs-6 fw-semibold" for="txt-address1<?php echo $uniqid; ?>"><?php echo lang('Text.address1'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-address1<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="150" value="<?php echo @$address[0]->line1; ?>" disabled="">
                </div>
                <div class="col-12 col-lg-6 mt-5">
                    <!-- Line 2 -->
                    <label class="fs-6 fw-semibold" for="txt-address2<?php echo $uniqid; ?>"><?php echo lang('Text.address2'); ?></label>
                    <input type="text" id="txt-address2<?php echo $uniqid; ?>" class="form-control" maxlength="150" value="<?php echo @$address[0]->line2; ?>" disabled="">
                </div>
                <div class="col-12 col-lg-3 mt-5">
                    <!-- City -->
                    <label class="fs-6 fw-semibold" for="txt-city<?php echo $uniqid; ?>"><?php echo lang('Text.city'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-city<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="45" value="<?php echo @$address[0]->city; ?>" disabled="">
                </div>
                <div class="col-12 col-lg-3 mt-5">
                    <!-- State -->
                    <label class="fs-6 fw-semibold" for="txt-state<?php echo $uniqid; ?>"><?php echo lang('Text.state'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-state<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="45" value="<?php echo @$address[0]->state; ?>" disabled="">
                </div>
                <div class="col-12 col-lg-3 mt-5">
                    <!-- Zip -->
                    <label class="fs-6 fw-semibold" for="txt-zip<?php echo $uniqid; ?>"><?php echo lang('Text.zip'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-zip<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?> number<?php echo $uniqid; ?>" maxlength="5" value="<?php echo @$address[0]->zip; ?>" disabled="">
                </div>
                <div class="col-12 col-lg-3 mt-5">
                    <!-- Country -->
                    <label class="fs-6 fw-semibold" for="txt-country<?php echo $uniqid; ?>"><?php echo lang('Text.country'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-country<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" maxlength="45" value="<?php echo @$address[0]->country; ?>" disabled="">
                </div>
                <div class="col-12 mt-5">
                    <!-- Email Notification -->
                    <label class="fs-6 fw-semibold" for="txt-country<?php echo $uniqid; ?>"><?php echo lang('Text.email_notification'); ?></label>
                    <div class="form-check form-switch form-check-custom form-check-solid mt-2">
                        <input type="checkbox" id="en-checkbox" class="form-check-input form-control h-30px w-50px" disabled="" <?php if ($customer[0]->emailNotification == 1) echo 'checked=""'; ?> data-checked="<?php echo $customer[0]->emailNotification; ?>">
                        <label class="form-check-label"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-end mt-5">
                    <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary">Habilitar Edición</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-end mt-5">
                    <button hidden="" type="button" id="btn-cancel<?php echo $uniqid; ?>" class="btn btn-secondary">Cancelar</button>
                    <button hidden="" type="button" id="btn-update<?php echo $uniqid; ?>" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var lang = "<?php echo $config[0]->lang; ?>";
    var dateLabel = "";

    if (lang == 'es')
        dateLabel = "d-m-Y";
    else if (lang == 'en')
        dateLabel = "m-d-Y";

    $(".flatpickr").flatpickr({
        dateFormat: dateLabel
    });

    $('#en-checkbox').on('click', function() {
        if ($(this).attr('data-checked') == 1)
            $(this).attr('data-checked', 0);
        else
            $(this).attr('data-checked', 1);
    });

    // Avatar Procedure
    var avatarProfile = new KTImageInput.createInstances();
    var imageInputElement = document.querySelector("#kt_image_input_profile<?php echo $uniqid; ?>");
    var imageInput = KTImageInput.getInstance(imageInputElement);

    imageInput.on("kt.imageinput.change", function() { // Upload On Change
        let formData = new FormData();
        formData.append('file', $("#avatar<?php echo $uniqid; ?>")[0].files[0]);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/uploadAvatarProfile'); ?>",
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.error === 0) {
                    reloadCustomerInfo();
                    customerTabContent();
                } else if (response.error === 1)
                    globalError();
                else
                    window.location.href = "<?php echo base_url('Home/signInCustomer?session=expired'); ?>";
            },
            error: function(error) {
                globalError();
            }
        });
    });

    imageInput.on("kt.imageinput.cancel", function() { // Remove On Cancel
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/removeAvatarProfile'); ?>",
            data: "",
            dataType: "json",
            success: function(response) {
                if (response.error === 0) {
                    reloadCustomerInfo();
                    customerTabContent();
                } else if (response.error === 1)
                    globalError();
                else
                    window.location.href = "<?php echo base_url('Home/signInCustomer?session=expired'); ?>";
            },
            error: function(error) {
                globalError();
            }
        });
    });

    imageInput.on("kt.imageinput.remove", function() { // Remove On Delete
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/removeAvatarProfile'); ?>",
            data: "",
            dataType: "json",
            success: function(response) {
                if (response.error === 0) {
                    reloadCustomerInfo();
                    customerTabContent();
                } else if (response.error === 1)
                    globalError();
                else
                    window.location.href = "<?php echo base_url('Home/signInCustomer?session=expired'); ?>";
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
        customerTabContent();
    });

    $('#btn-update<?php echo $uniqid; ?>').on('click', function() {
        let result = checkRequiredValues();
        if (result === 0) {
            let resultEmail = checkEmailFormat();
            if (resultEmail === 0) {
                $('#btn-update<?php echo $uniqid; ?>').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Customer/updateProfile'); ?>",
                    data: {
                        'name': $('#txt-name<?php echo $uniqid; ?>').val(),
                        'lastName': $('#txt-lastName<?php echo $uniqid; ?>').val(),
                        'phone': $('#txt-phone<?php echo $uniqid; ?>').val(),
                        'gender': $('#txt-gender<?php echo $uniqid; ?>').val(),
                        'address1': $('#txt-address1<?php echo $uniqid; ?>').val(),
                        'address2': $('#txt-address2<?php echo $uniqid; ?>').val(),
                        'city': $('#txt-city<?php echo $uniqid; ?>').val(),
                        'state': $('#txt-state<?php echo $uniqid; ?>').val(),
                        'zip': $('#txt-zip<?php echo $uniqid; ?>').val(),
                        'country': $('#txt-country<?php echo $uniqid; ?>').val(),
                        'dob': $('#sel-dob<?php echo $uniqid; ?>').val(),
                        'status': $('#en-checkbox').attr('data-checked')
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            simpleSuccessAlert("<?php echo lang("Text.prof_data_updated"); ?>");
                            reloadCustomerInfo();
                            customerTabContent();
                        } else if (response.error == 1)
                            globalError();
                        else
                            window.location.href = "<?php echo base_url('Home/signInCustomer?session=expired'); ?>";

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
</script>