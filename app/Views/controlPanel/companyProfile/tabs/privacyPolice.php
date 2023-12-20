<div class="card card-flush py-4 mb-4" data-select2-id="select2-data-131-50oa">
    <div class="card-header">
        <div class="card-title flex-column">
            <h2 class="mb-1">Title</h2>
            <div class="fs-6 fw-semibold text-muted">Subtitle</div>
        </div>
    </div>
    <div class="card-body pt-0">
        <textarea id="privacyPolice" class="tox-target"><?php echo $privacyPolice ?></textarea>
        <div class="text-end">
            <button type="button" id="btn-save<?php echo $uniqid; ?>" class="btn btn-primary mt-6"><?php echo lang('Text.btn_save'); ?></button>
        </div>
    </div>
</div>

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