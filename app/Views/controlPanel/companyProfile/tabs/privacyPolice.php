<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_profile_menu_privacy_police'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_profile_privacy_police_subtitle'); ?>.</div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_edit'); ?></button>
        </div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        <div class="row">
            <div class="col-12 mt-5">
                <textarea id="privacyPolice<?php echo $uniqid; ?>" class="tox-target" disabled><?php echo $privacyPolice ?></textarea>
            </div>
            <div class="col-12 text-end mt-5">
                <button hidden type="button" id="btn-cancel<?php echo $uniqid; ?>" class="btn btn-secondary"><?php echo lang('Text.btn_cancel'); ?></button>
                <button hidden type="button" id="btn-update<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_update'); ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    var lang = "<?php echo $config[0]->lang; ?>";
    tinymce.init({
        mode: "none",
        readonly: true,
        selector: "#privacyPolice<?php echo $uniqid; ?>",
        height: 500,
        menubar: false,
        language: lang,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });

    $('#btn-<?php echo $uniqid; ?>').on('click', function() { // Enable Edit
        tinymce.activeEditor.setMode('design');
        $(this).attr('hidden', true);
        $('#btn-cancel<?php echo $uniqid; ?>').removeAttr('hidden');
        $('#btn-update<?php echo $uniqid; ?>').removeAttr('hidden');
    });

    $('#btn-cancel<?php echo $uniqid; ?>').on('click', function() { // Cancel Edit
        getProfileTabContent();
    });

    $('#btn-update<?php echo $uniqid; ?>').on('click', function() {
        let privacyPolice = tinymce.get('privacyPolice<?php echo $uniqid; ?>').getContent();
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
                    getProfileTabContent();
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