<!--Page Main Login Admin-->
<div class="d-flex flex-column flex-column-fluid flex-lg-row justify-content-center">
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-center p-12 p-lg-20">
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <!--Img-->
                <div class="symbol symbol-100px  mb-7">
                    <img src="<?php echo base_url('public/assets/media/img/settings.png') ?>" alt="image">
                </div>
                <div class="text-center mb-11">
                    <!--Title-->
                    <h1 class="text-dark fw-bolder mb-3"><?php echo lang('Text.la_title'); ?></h1>
                    <!--Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6"><?php echo lang('Text.la_subtitle'); ?></div>
                </div>
                <div class="fv-row mb-10 fv-plugins-icon-container">
                    <!--Input Key-->
                    <input type="password" id="txt-pass<?php echo $uniqid; ?>" class="form-control bg-transparent" />
                </div>
                <div class="d-grid mb-10">
                    <!--Submit-->
                    <button type="button" id="btn-login<?php echo $uniqid; ?>" class="btn btn-primary">
                        <span class="indicator-label"><?php echo lang('Text.la_signIn'); ?></span>
                    </button>
                    <a href="<?php echo base_url('/')?>" class="mt-6 text-center"><i class="bi bi-house text-primary"></i> <?php echo lang('Text.la_goHome'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#btn-login<?php echo $uniqid; ?>').on('click', function() { // Submit
            let key = $('#txt-pass<?php echo $uniqid; ?>').val();
            if (key === "") {
                $('#txt-pass<?php echo $uniqid; ?>').addClass('is-invalid');
                simpleAlert("<?php echo lang('Text.la_required_password'); ?>", "warning");
            } else {
                $('#btn-login<?php echo $uniqid; ?>').attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Home/loginAdminProcess'); ?>",
                    data: {
                        'key': key
                    },
                    dataType: "json",
                    success: function(response) {
                        if(response.error === 0) {
                            window.location.href = "<?php echo base_url('ControlPanel/dashboard'); ?>"
                        } else {
                            simpleAlert(response.msg, "error");
                            $('#txt-pass<?php echo $uniqid; ?>').addClass('is-invalid');
                            $('#btn-login<?php echo $uniqid; ?>').removeAttr('disabled');
                        }
                    },
                    error: function(error) {
                        simpleAlert("<?php echo lang('Text.error_msg'); ?>", "error");
                        $('#btn-login<?php echo $uniqid; ?>').removeAttr('disabled');
                    }
                });
            }
        });

        $('#txt-pass<?php echo $uniqid; ?>').on('input', function() {
            let value = $(this).val();
            if (value === "")
                $(this).addClass('is-invalid');
            else
                $(this).removeClass('is-invalid');
        });

        let session = "<?php echo $session; ?>";

        if(session == "expired") {
            simpleAlert("<?php echo lang('Text.session_expired'); ?>", "error");
        }
    });
</script>