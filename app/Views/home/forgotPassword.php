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
                            <h1 class="text-dark fw-bolder mb-3">Olvidaste tu contraseña?</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Introduce tu email para poder recuperarla</div>
                        </div>
                        <!-- Input Password -->
                        <div class="fv-row mb-4">
                            <input type="text" id="txt-email<?php echo $uniqid; ?>" placeholder="Email" autocomplete="off" class="form-control email bg-transparent mb-5 required<?php echo $uniqid; ?>" />
                        </div>
                        <!-- Button Save -->
                        <div class="d-grid">
                            <button type="button" id="btn-save<?php echo $uniqid; ?>" class="btn btn-primary">Guardar</button>
                        </div>
                        <!-- Link Sign In Customer -->
                        <div class="d-grid mt-5 text-center">
                            <a href="<?php echo base_url('Home/signInCustomer'); ?>">Regresar a Iniciar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btn-save<?php echo $uniqid; ?>').on('click', function() {
            let result = checkRequiredValues();
            let resultEmail = checkEmailFormat();
            if (result == 0) {
                if (resultEmail == 0) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('Home/forgotPasswordProcess'); ?>",
                        data: {
                            'email': $('#txt-email<?php echo $uniqid; ?>').val(),
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.error == 0)
                                simpleAlert('Se ha enviado un correo a esta dirección', 'success');
                            else if (response.error == 1) {
                                if (response.msg == 'EMAIL_NOT_FOUND') {
                                    simpleAlert('Rectifique sus credenciales', 'warning');
                                    $('#txt-email<?php echo $uniqid; ?>').addClass('required is-invalid');
                                }
                            }

                        },
                        error: function(error) {
                            globalError();
                        }
                    });
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