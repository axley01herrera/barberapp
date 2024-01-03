<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_emp_profile_tab_info_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_emp_profile_tab_info_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_edit'); ?></button>
        </div>
    </div>
    <div class="card-body p-9 pt-4">
        <div class="row">
            <div class="col-12 col-lg-4"></div>
            <div class="col-12 col-lg-4">
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
                        <?php if (empty($employee[0]->avatar)) { ?>
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url(<?php echo base_url('public/assets/media/svg/avatars/blank.svg'); ?>)"></div>
                        <?php } else { ?>
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url(data:image/png;base64,<?php echo base64_encode($employee[0]->avatar); ?>)"></div>
                        <?php } ?>
                        <!-- Edit Button -->
                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="<?php echo lang('Text.cp_emp_change_avatar'); ?>">
                            <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>
                            <!-- Inputs -->
                            <input id="avatar<?php echo $uniqid; ?>" type="file" name="avatar" accept=".png, .jpg, .jpeg">
                            <input type="hidden" name="avatar_remove">

                        </label>
                        <!-- Cancel button -->
                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="">
                            <i class="ki-outline ki-cross fs-3"></i>
                        </span>
                        <!-- Remove button -->
                        <?php if (!empty($employee[0]->avatar)) { ?>
                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="<?php echo lang('Text.cp_emp_remove_avatar'); ?>">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                        <?php } ?>
                    </div>
                </div>

                <!-- Name-->
                <div class="col-12 mt-5">
                    <label class="fs-6 fw-semibold" for="txt-name<?php echo $uniqid; ?>"><?php echo lang('Text.cp_emp_name'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-name<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $employee[0]->name; ?>" disabled="">
                </div>

                <!-- last Name -->
                <div class="col-12 mt-5">
                    <label class="fs-6 fw-semibold" for="txt-lastName<?php echo $uniqid; ?>"><?php echo lang('Text.cp_emp_last_name'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-lastName<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $employee[0]->lastName; ?>" disabled="">
                </div>

                <!-- Phone -->
                <div class="col-12 mt-5">
                    <label class="fs-6 fw-semibold" for="txt-phone<?php echo $uniqid; ?>"><?php echo lang('Text.cp_emp_phone'); ?> <span class="text-danger">*</span></label>
                    <input type="text" id="txt-phone<?php echo $uniqid; ?>" class="form-control required<?php echo $uniqid; ?>" value="<?php echo $employee[0]->phone; ?>" disabled="">
                </div>
            </div>
            <div class="col-12 col-lg-4"></div>

        </div>
        <div class="row">
            <div class="col-12 text-end mt-5">
                <button hidden="" type="button" id="btn-cancel<?php echo $uniqid; ?>" class="btn btn-secondary"><?php echo lang('Text.btn_cancel'); ?></button>
                <button hidden="" type="button" id="btn-update<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_update'); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    var lang = "<?php echo $config[0]->lang; ?>";
    var dateLabel = "";
    var employeeID = "<?php echo $employeeID; ?>";
    var locale = "";

    if (lang == 'es') {
        dateLabel = "d-m-Y";
        locale = {
            weekdays: {
                shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            },
            months: {
                shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            },
        }
    } else if (lang == 'en')
        dateLabel = "m-d-Y";

    $(".flatpickr").flatpickr({
        locale: locale,
        dateFormat: dateLabel
    });

    // Avatar Procedure
    var avatarProfile = new KTImageInput.createInstances();
    var imageInputElement = document.querySelector("#kt_image_input_profile<?php echo $uniqid; ?>");
    var imageInput = KTImageInput.getInstance(imageInputElement);

    imageInput.on("kt.imageinput.change", function() { // Upload On Change
        let formData = new FormData();
        formData.append('file', $("#avatar<?php echo $uniqid; ?>")[0].files[0]);
        formData.append('employeeID', employeeID);
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ControlPanel/uploadEmployeeAvatarProfile'); ?>",
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.error === 0) {
                    reloadEmployeeInfo();
                    employeeProfileTabContent();
                    simpleSuccessAlert("<?php echo lang("Text.cp_emp_info_upload_avatar"); ?>");
                } else if (response.error === 1)
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
            url: "<?php echo base_url('ControlPanel/removeEmployeeAvatarProfile'); ?>",
            data: {
                'employeeID': employeeID
            },
            dataType: "json",
            success: function(response) {
                if (response.error === 0) {
                    reloadEmployeeInfo();
                    employeeProfileTabContent();
                    simpleSuccessAlert("<?php echo lang("Text.cp_emp_info_remove_avatar"); ?>");
                } else if (response.error === 1)
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
        employeeProfileTabContent();
    });

    $('#btn-update<?php echo $uniqid; ?>').on('click', function() {
        let result = checkRequiredValues();
        if (result === 0) {
            $('#btn-update<?php echo $uniqid; ?>').attr('disabled', true);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('ControlPanel/updateEmployeeProfile'); ?>",
                data: {
                    'employeeID': employeeID,
                    'name': $('#txt-name<?php echo $uniqid; ?>').val(),
                    'lastName': $('#txt-lastName<?php echo $uniqid; ?>').val(),
                    'phone': $('#txt-phone<?php echo $uniqid; ?>').val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response.error == 0) {
                        simpleSuccessAlert("<?php echo lang("Text.cp_emp_success_update_info"); ?>");
                        reloadEmployeeInfo();
                        employeeProfileTabContent();
                    } else if (response.error == 1)
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