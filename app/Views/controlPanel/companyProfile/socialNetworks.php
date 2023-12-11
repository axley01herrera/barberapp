<div class="card mb-5 mb-xl-8">
    <div class="card-header border-0">
        <div class="card-title">
            <h3 class="fw-bold m-0"><?php echo lang('Text.social_networks'); ?></h3>
        </div>
    </div>
    <div class="card-body pt-2">
        <div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
            <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            <div class="d-flex flex-column pe-0 pe-sm-10">
                <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
                <span><?php echo lang('Text.social_network_msg'); ?></span>
            </div>
        </div>
        <?php foreach ($socialNetworks as $sn) { ?>
            <div class="py-2">
                <div class="d-flex flex-stack">
                    <div class="d-flex">
                        <?php if ($sn->type == 'Google') { ?>
                            <img src="<?php echo base_url('public/assets/media/svg/brand-logos/google-icon.svg'); ?>" class="w-30px me-6" alt="logo">
                        <?php } elseif ($sn->type == 'Facebook') { ?>
                            <img src="<?php echo base_url('public/assets/media/svg/brand-logos/facebook-3.svg'); ?>" class="w-30px me-6" alt="logo">
                        <?php } elseif ($sn->type == 'Twitter') { ?>
                            <img src="<?php echo base_url('public/assets/media/svg/brand-logos/twitter.svg'); ?>" class="w-30px me-6" alt="logo">
                        <?php } elseif ($sn->type == 'LinkedIn') { ?>
                            <img src="<?php echo base_url('public/assets/media/svg/brand-logos/linkedin-1.svg'); ?>" class="w-30px me-6" alt="logo">
                        <?php } ?>
                        <div class="d-flex flex-column">
                            <a href="<?php echo $sn->url; ?>" class="fs-5 text-dark text-hover-primary fw-bold" target="_blank"><?php echo $sn->type; ?></a>
                            <p class="cursor-pointer social-action fs-9" data-action="edit" data-socialNetwork-id="<?php echo $sn->id; ?>" title="<?php echo lang('Text.edit'); ?>"><?php echo $sn->url; ?></p>
                            <div class="fs-6 fw-semibold text-muted" hidden>Plan properly your workflow</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <input class="form-check-input cursor-pointer social-action" data-action="changeStatus" data-socialNetwork-id="<?php echo $sn->id; ?>" name="google" type="checkbox" value="1" id="kt_modal_connected_accounts_google" <?php if ($sn->status == 1) echo "data-status='0' checked=''";
                                                                                                                                                                                                                                                    else echo "data-status='1'"; ?>>
                            <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_google"></span>
                        </label>
                    </div>
                </div>
                <div class="separator separator-dashed my-5"></div>
            </div>
        <?php } ?>
    </div>
    <div class="card-footer border-0 d-flex justify-content-center pt-0">
        <button class="btn btn-sm btn-primary btn-addSocialNetwork"><?php echo lang('Text.btn_add'); ?></button>
    </div>
</div>

<script>
    $('.btn-addSocialNetwork').on('click', function(e) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ControlPanel/addSocialNetwork'); ?>",
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            }
        });
    });

    $('.social-action').on('click', function(e) {
        let url = '';
        let datatype = '';
        if ($(this).attr('data-action') == 'edit') {
            url = "<?php echo base_url('ControlPanel/addSocialNetwork'); ?>";
            datatype = "html";
        } else if ($(this).attr('data-action') == 'changeStatus') {
            url = "<?php echo base_url('ControlPanel/addSocialNetworkProcess'); ?>";
            datatype = "json";
        }
        $.ajax({
            type: "POST",
            url: url,
            data: {
                'id': $(this).attr('data-socialNetwork-id'),
                'action': $(this).attr('data-action'),
                'status': $(this).attr('data-status'),
            },
            dataType: datatype,
            success: function(response) {
                if (datatype == 'html')
                    $('#app-modal').html(response);
                else {
                    if (response.error == 0)
                        getSocialNetworks();
                    else
                        globalError();
                }
            },
            error: function(error) {
                globalError();
            }
        });
    });
</script>