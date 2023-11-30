<div class="d-flex flex-column flex-root" id="kt_app_root">
    <style>
        body {
            background-image: url('<?php echo base_url('assets/media/auth/bg4.jpg'); ?>');
        }

        [data-bs-theme="dark"] body {
            background-image: url('<?php echo base_url('assets/media/auth/bg4-dark.jpg'); ?>');
        }
    </style>
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <div class="d-flex flex-column-fluid justify-content-center justify-content-center p-12 p-lg-20">
            <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                    <div class="form w-100">
                        <div class="text-center mb-11">
                            <!-- Logo 
                                <span class="mb-7">
                                    <img alt="Logo" src="<?php // echo base_url('assets/media/logos/logoDark.png'); 
                                                            ?>" class="w-50" />
                                </span>-->
                            <h1 class="text-dark fw-bolder mb-3">Crea una Cuenta</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Introduzca sus datos</div>
                        </div>
                        <!-- Input Access Key -->
                        <div class="fv-row mb-8">
                            <div class="row ">
                                <div class="col-12 col-lg-6 mt-5">
                                    <input type="text" id="txt-name<?php echo $uniqid; ?>" placeholder="Name" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                                </div>
                                <div class="col-12 col-lg-6 mt-5">
                                    <input type="text" id="txt-lastName<?php echo $uniqid; ?>" placeholder="Last Name" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                                </div>
                                <div class="col-12 col-lg-6 mt-5">
                                    <input type="email" id="txt-email<?php echo $uniqid; ?>" placeholder="Email" autocomplete="off" class="form-control bg-transparent email required<?php echo $uniqid; ?>" />
                                </div>
                                <div class="col-12 col-lg-6 mt-5">
                                    <input type="text" id="txt-phone<?php echo $uniqid; ?>" placeholder="Phone" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                                </div>
                                <div class="col-12 mt-5">
                                    <input type="password" id="txt-pass<?php echo $uniqid; ?>" placeholder="Password" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                                </div>
                                <div class="col-12 mt-5">
                                    <input type="password" id="txt-confirmPass<?php echo $uniqid; ?>" placeholder="Repeat Password" autocomplete="off" class="form-control bg-transparent required<?php echo $uniqid; ?>" />
                                </div>
                                <div class="col-12 col-lg-5 mt-5">
                                    <input type="checkbox" id="check-terms" class=""> <span class="text-black-50">Aceptar los Términos.</span>
                                </div>
                                <div class="col-12 col-lg-7 mt-5">
                                    <input type="checkbox" id="check-emailSubscription" class=""> <span class="text-black-50">Recibir correos de promociones.</span>
                                </div>
                            </div>
                        </div>
                        <!-- Button Sig In Admin -->
                        <div class="d-grid mb-10">
                            <button type="button" id="btn-create<?php echo $uniqid; ?>" class="btn btn-primary">Crear cuenta</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //CHECK TERMS
        $('#check-terms').on('click', function() {
            $(this).toggleClass('checked');
        });
        //CHECK EMAIL SUBSCRIPTIONS
        $('#check-emailSubscription').on('click', function() {
            $(this).toggleClass('checked');
        });
        $('#btn-create<?php echo $uniqid; ?>').on('click', function() {
            let result = checkRequiredValues();
            if (result == 0) {
                let resultEmail = checkEmailFormat();
                if (resultEmail == 0) {
                    if ($('#txt-pass<?php echo $uniqid; ?>').val() === $('#txt-confirmPass<?php echo $uniqid; ?>').val()) {
                        var terms = 0;
                        if ($('#check-terms').hasClass('checked'))
                            terms = 1;
                        var emailSubscription = 0;
                        if ($('#check-emailSubscription').hasClass('checked'))
                            emailSubscription = 1;
                        $.ajax({
                            type: "post",
                            url: "<?php echo base_url('Home/signUpCustomerProcess'); ?>",
                            data: {
                                'name': $('#txt-name<?php echo $uniqid; ?>').val(),
                                'lastName': $('#txt-lastName<?php echo $uniqid; ?>').val(),
                                'phone': $('#txt-phone<?php echo $uniqid; ?>').val(),
                                'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                                'pass': $('#txt-pass<?php echo $uniqid; ?>').val(),
                                'terms': terms,
                                'emailSubscription': emailSubscription
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.error == 0) {
                                    simpleAlert('Cuenta creada', 'success');
                                    setTimeout(() => {
                                        window.location.href = "<?php echo base_url('/'); ?>";
                                    }, "2000");
                                } else if (response.error == 1) {
                                    if (response.msg == 'ERROR_SEND_EMAIL')
                                        simpleAlert('Error al enviar el correo', 'warning');

                                    else if (response.msg == 'DUPLICATE_EMAIL') {
                                        $('#txt-email<?php echo $uniqid; ?>').addClass('required is-invalid');
                                        simpleAlert('El email ya está registrado', 'warning');
                                    }
                                }
                            },
                            error: function(error) {
                                globalError();
                            }
                        });
                    } else {
                        $('#txt-pass<?php echo $uniqid; ?>').addClass('required is-invalid');
                        $('#txt-confirmPass<?php echo $uniqid; ?>').addClass('required is-invalid');
                        simpleAlert('Las contraseñas no coinciden', 'warning');
                    }
                } else
                    simpleAlert('Email Invalido', 'warning');
            } else
                simpleAlert('Campos Requeridos', 'warning');
        });

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

    $('.required<?php echo $uniqid; ?>').on('focus', function() {
        $(this).removeClass('is-invalid');
    });

    function checkEmailFormat() {
        let inputValue = '';
        let response = 0;
        let regex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        $('.email').each(function() {
            inputValue = $(this).val();
            if (!regex.test(inputValue)) {
                $(this).addClass('is-invalid');
                response = 1;
            }
        });
        return response;
    }
</script>