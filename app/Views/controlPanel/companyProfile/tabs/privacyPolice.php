<textarea id="privacyPolice" class="tox-target"><?php echo $privacyPolice ?></textarea>

<button type="button" id="btn-save<?php echo $uniqid; ?>" class="btn btn-primary mt-5">Guardar</button>
<script>
    var options = {
        selector: "#privacyPolice",
        height: "480"
    };

    if (KTThemeMode.getMode() === "dark") {
        options["skin"] = "oxide-dark";
        options["content_css"] = "dark";
    }

    tinymce.init(options);

    $('#btn-save<?php echo $uniqid; ?>').on('click', function() {
        let privacyPolice = tinymce.get('privacyPolice').getContent();
        if (privacyPolice != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('ControlPanel/savePrivacyPolice'); ?>",
                data: {
                    'privacyPolice': privacyPolice
                },
                dataType: "json",
                success: function(response) {
                    simpleSuccessAlert('<?php echo lang('Text.cp_profile_success_update_privacy_police'); ?>');
                },
                error: function(error) {
                    globalError();
                }
            });
        } else {
            simpleAlert('<?php echo lang('Text.cp_profile_empty_privacy_police'); ?>', 'warning');
        }
    });
</script>