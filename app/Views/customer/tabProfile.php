<div class="tab-pane fade" id="kt_user_view_overview_profile_tab" role="tabpanel">
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
                        <div id="kt_image_input_profile656e8bfe8a4d4" class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(http://barberapp/public/assets/media/svg/avatars/blank.svg)">
                            <!-- Image Preview -->
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url(http://barberapp/public/assets/media/svg/avatars/blank.svg)"></div>
                            <!-- Edit Button -->
                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cambiar Avatar">
                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                                <!-- Inputs -->
                                <input id="avatar656e8bfe8a4d4" type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="avatar_remove">

                            </label>
                            <!-- Cancel button -->
                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancelar Avatar">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!-- Remove button -->
                        </div>
                        <div class="fs-6 fw-semibold">Avatar</div>
                    </div>
                    <!-- Name-->
                    <div class="col-12 col-lg-6 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-name656e8bfe8a4d4">Nombre <span class="text-danger">*</span></label>
                        <input type="text" id="txt-name656e8bfe8a4d4" class="form-control required656e8bfe8a4d4" value="<?php echo $customer[0]->name; ?>" disabled="">
                    </div>
                    <!-- last Name -->
                    <div class="col-12 col-lg-6 mt-5">
                        <label class="fs-6 fw-semibold" for="txt-lastName656e8bfe8a4d4">Apellidos <span class="text-danger">*</span></label>
                        <input type="text" id="txt-lastName656e8bfe8a4d4" class="form-control required656e8bfe8a4d4" value="<?php echo $customer[0]->lastName; ?>" disabled="">
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <!-- Email -->
                        <label class="fs-6 fw-semibold" for="txt-email656e8bfe8a4d4">Correo Electrónico <span class="text-danger">*</span></label>
                        <input type="text" id="txt-email656e8bfe8a4d4" class="form-control required656e8bfe8a4d4 email656e8bfe8a4d4" maxlength="150" value="<?php echo $customer[0]->email; ?>" disabled="">
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <!-- Phone -->
                        <label class="fs-6 fw-semibold" for="txt-phone656e8bfe8a4d4">Teléfono <span class="text-danger">*</span></label>
                        <input type="text" id="txt-phone656e8bfe8a4d4" class="form-control required656e8bfe8a4d4" maxlength="45" value="<?php echo $customer[0]->phone; ?>" disabled="">
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <!-- Line 1 -->
                        <label class="fs-6 fw-semibold" for="txt-address1656e8bfe8a4d4">Linea 1 de Dirección <span class="text-danger">*</span></label>
                        <input type="text" id="txt-address1656e8bfe8a4d4" class="form-control required656e8bfe8a4d4" maxlength="150" value="<?php echo @$address[0]->line1; ?>" disabled="">
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <!-- Line 2 -->
                        <label class="fs-6 fw-semibold" for="txt-address2656e8bfe8a4d4">Linea 2 de Dirección</label>
                        <input type="text" id="txt-address2656e8bfe8a4d4" class="form-control" maxlength="150" value="<?php echo @$address[0]->line2; ?>" disabled="">
                    </div>
                    <div class="col-12 col-lg-3 mt-5">
                        <!-- City -->
                        <label class="fs-6 fw-semibold" for="txt-city656e8bfe8a4d4">Ciudad <span class="text-danger">*</span></label>
                        <input type="text" id="txt-city656e8bfe8a4d4" class="form-control required656e8bfe8a4d4" maxlength="45" value="<?php echo @$address[0]->city; ?>" disabled="">
                    </div>
                    <div class="col-12 col-lg-3 mt-5">
                        <!-- State -->
                        <label class="fs-6 fw-semibold" for="txt-state656e8bfe8a4d4">Provincia <span class="text-danger">*</span></label>
                        <input type="text" id="txt-state656e8bfe8a4d4" class="form-control required656e8bfe8a4d4" maxlength="45" value="<?php echo @$address[0]->state; ?>" disabled="">
                    </div>
                    <div class="col-12 col-lg-3 mt-5">
                        <!-- Zip -->
                        <label class="fs-6 fw-semibold" for="txt-zip656e8bfe8a4d4">Código Postal <span class="text-danger">*</span></label>
                        <input type="text" id="txt-zip656e8bfe8a4d4" class="form-control required656e8bfe8a4d4 number656e8bfe8a4d4" maxlength="5" value="<?php echo @$address[0]->zip; ?>" disabled="">
                    </div>
                    <div class="col-12 col-lg-3 mt-5">
                        <!-- Country -->
                        <label class="fs-6 fw-semibold" for="txt-country656e8bfe8a4d4">País <span class="text-danger">*</span></label>
                        <input type="text" id="txt-country656e8bfe8a4d4" class="form-control required656e8bfe8a4d4" maxlength="45" value="<?php echo @$address[0]->country; ?>" disabled="">
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <!-- Password -->
                        <label class="fs-6 fw-semibold" for="txt-zip656e8bfe8a4d4">Contraseña</label>
                        <input type="password" id="txt-password656e8bfe8a4d4" class="form-control" maxlength="5" disabled="">
                    </div>
                    <div class="col-12 col-lg-6 mt-5">
                        <!-- Confirm Password -->
                        <label class="fs-6 fw-semibold" for="txt-country656e8bfe8a4d4">Confirma su contraseña</label>
                        <input type="password" id="txt-confirmPassword656e8bfe8a4d4" class="form-control" maxlength="45" disabled="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end mt-5">
                        <button type="button" id="btn-656e8bfe8a4d4" class="btn btn-primary">Habilitar Edición</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end mt-5">
                        <button hidden="" type="button" id="btn-cancel656e8bfe8a4d4" class="btn btn-secondary">Cancelar</button>
                        <button hidden="" type="button" id="btn-update656e8bfe8a4d4" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Avatar Procedure
    let avatarProfile = new KTImageInput.createInstances();
    let imageInputElement = document.querySelector("#kt_image_input_profile656e8bfe8a4d4");
    let imageInput = KTImageInput.getInstance(imageInputElement);

    imageInput.on("kt.imageinput.change", function() { // Upload On Change
        let formData = new FormData();
        formData.append('file', $("#avatar656e8bfe8a4d4")[0].files[0]);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/uploadAvatarProfile'); ?>",
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.error === 0)
                    window.location.reload();
                else if (response.error === 1)
                    globalError();
                else
                    window.location.href = "http://barberapp/Home/signInCustomer?session=expired";
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
                if (response.error === 0)
                    window.location.reload();
                else if (response.error === 1)
                    globalError();
                else
                    window.location.href = "http://barberapp/Home/signInCustomer?session=expired";
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
                if (response.error === 0)
                    window.location.reload();
                else if (response.error === 1)
                    globalError();
                else
                    window.location.href = "http://barberapp/Home/signInCustomer?session=expired";
            },
            error: function(error) {
                globalError();
            }
        });
    });

    // End Avatar Procedure

    $('#btn-656e8bfe8a4d4').on('click', function() { // Enable Edit
        $('.form-control').each(function() {
            $(this).removeAttr('disabled');
        });
        $(this).attr('hidden', true);
        $('#btn-cancel656e8bfe8a4d4').removeAttr('hidden');
        $('#btn-update656e8bfe8a4d4').removeAttr('hidden');
    });

    $('#btn-cancel656e8bfe8a4d4').on('click', function() { // Cancel Edit
        $('.form-control').each(function() {
            $(this).attr('disabled', true);
        });
        $('#btn-656e8bfe8a4d4').removeAttr('hidden');
        $('#btn-cancel656e8bfe8a4d4').attr('hidden', true);
        $('#btn-update656e8bfe8a4d4').attr('hidden', true);
    });

    $('#btn-update656e8bfe8a4d4').on('click', function() {
        let result = checkRequiredValues();
        if (result === 0) {
            let resultEmail = checkEmailFormat();
            if (resultEmail === 0) {
                if ($('#txt-password656e8bfe8a4d4').val() === $('#txt-confirmPassword656e8bfe8a4d4').val()) {
                    $('#btn-update656e8bfe8a4d4').attr('disabled', true);
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Customer/updateProfile'); ?>",
                        data: {
                            'name': $('#txt-name656e8bfe8a4d4').val(),
                            'lastName': $('#txt-lastName656e8bfe8a4d4').val(),
                            'email': $('#txt-email656e8bfe8a4d4').val(),
                            'phone': $('#txt-phone656e8bfe8a4d4').val(),
                            'address1': $('#txt-address1656e8bfe8a4d4').val(),
                            'address2': $('#txt-address2656e8bfe8a4d4').val(),
                            'city': $('#txt-city656e8bfe8a4d4').val(),
                            'state': $('#txt-state656e8bfe8a4d4').val(),
                            'zip': $('#txt-zip656e8bfe8a4d4').val(),
                            'country': $('#txt-country656e8bfe8a4d4').val(),
                            'password': $('#txt-password656e8bfe8a4d4').val()
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.error == 0) {
                                simpleSuccessAlert("Datos del Perfil Actualizados");
                                setTimeout(() => {
                                    window.location.reload();
                                }, "2000");
                            } else if (response.error == 1)
                                globalError();
                            else
                                window.location.href = "http://barberapp/Home/signInCustomer?session=expired";

                            $('#btn-update656e8bfe8a4d4').removeAttr('disabled');
                        },
                        error: function(error) {
                            globalError();
                            $('#btn-update656e8bfe8a4d4').removeAttr('disabled');
                        }
                    });
                } else {
                    simpleAlert("Las contraseñas no coinciden", 'warning');
                    $('#txt-confirmPassword656e8bfe8a4d4').addClass('required is-invalid');
                }
            } else
                simpleAlert("Rectifique el formato del correo electrónico", 'warning');
        } else
            simpleAlert("Hay campos requeridos", 'warning');
    });

    $('.number656e8bfe8a4d4').on('input', function() { // ONLY NUMBER
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });

    function checkRequiredValues() {
        let result = 0;
        let value = "";

        $('.required656e8bfe8a4d4').each(function() {
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
        $('.email656e8bfe8a4d4').each(function() {
            inputValue = $(this).val();
            if (!regex.test(inputValue)) {
                $(this).addClass('is-invalid');
                response = 1;
            }
        });
        return response;
    }

    $('.required656e8bfe8a4d4').on('focus', function() {
        $(this).removeClass('is-invalid');
    });
</script>