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
                        <?php echo socialNetworkIcon($sn->type); ?>
                        <div class="d-flex flex-column">
                            <a href="<?php echo $sn->url; ?>" target="_blank" class="fs-5 text-dark text-hover-primary fw-bold"><?php echo $sn->type; ?></a>
                            <div class="fs-6 fw-semibold text-muted"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid me-1" title="<?php echo lang('Text.cp_profile_sn_change_v'); ?>">
                            <input data-social-network-id="<?php echo $sn->id; ?>" class="cursor-pointer form-check-input change-social-network-status" type="checkbox" data-value="<?php echo $sn->status; ?>" <?php if ($sn->status == 1) echo "checked"; ?>>
                            <span class="form-check-label fw-semibold text-muted" for=""></span>
                        </label>
                        <span data-social-network-id="<?php echo $sn->id; ?>" class="me-3 cursor-pointer edit-social-network text-hover-warning" title="<?php echo lang('Text.btn_edit'); ?>"><i class="bi bi-pencil-square"></i></span>
                        <span data-social-network-id="<?php echo $sn->id; ?>" class="cursor-pointer delete-social-network text-hover-danger" title="<?php echo lang('Text.btn_delete'); ?>"><i class="bi bi-trash-fill"></i></span>
                    </div>
                </div>
            </div>
            <div class="separator separator-dashed my-5"></div>
        <?php } ?>
    </div>
    <!-- Create Social Network -->
    <div class="card-footer border-0 d-flex justify-content-center pt-0">
        <button id="create-social-network<?php echo $uniqid; ?>" class="btn btn-sm btn-primary"><?php echo lang('Text.btn_add'); ?></button>
    </div>
</div>

<script>
    $('#create-social-network<?php echo $uniqid; ?>').on('click', function() { // CREATE MODAL SOCIAL NETWORK
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ControlPanel/modalSocialNetwork'); ?>",
            data: {
                'action': 'create'
            },
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            },
            error: function(error) {
                globalError();
            }
        });
    }); // ok

    $('.edit-social-network').on('click', function() { // EDIT MODAL SOCIAL NETWORK
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ControlPanel/modalSocialNetwork'); ?>",
            data: {
                'id': $(this).attr('data-social-network-id'),
                'action': 'update',
            },
            dataType: "html",
            success: function(response) {
                $('#app-modal').html(response);
            },
            error: function(error) {
                globalError();
            }
        });
    }); // ok

    $('.delete-social-network').on('click', function() { // DELETE SOCIAL NETWORK
        Swal.fire({
            title: '<?php echo lang('Text.are_you_sure'); ?>',
            text: "<?php echo lang('Text.not_revert_this'); ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Text.yes_remove'); ?>',
            cancelButtonText: '<?php echo lang('Text.no_cancel'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('ControlPanel/deleteSocialNetwork'); ?>",
                    data: {
                        'id': $(this).attr('data-social-network-id'),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error == 0) {
                            getSocialNetworks();
                        } else {
                            if (response.msg == "SESSION_EXPIRED") {
                                window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
                            } else
                                globalError();
                        }
                    },
                    error: function(error) {
                        globalError();
                    }
                });
            }
        });
    }); // ok

    $('.change-social-network-status').on('click', function() { //CHANGE STATUS SOCIAL NETWORK
        let socialNetworkID = $(this).attr('data-social-network-id');
        let value = $(this).attr('data-value');
        let newValue = "";

        if(value == 0)
            newValue = 1;
        else if(value == 1)
            newValue = 0;

        $(this).attr('data-value', newValue);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ControlPanel/changeStatusSocialNetwork'); ?>",
            data: {
                'socialNetworkID': socialNetworkID,
                'status': newValue,
            },
            dataType: "json",
            success: function(response) {
                if(response.error == 0) 
                    simpleSuccessAlert("<?php echo lang('Text.success_change_status'); ?>");
                else if (response.error == 1)
                    globalError();
                else if (response.error == 2) 
                    window.location.href = "<?php echo base_url('Home/controlPanelAuth?session=expired'); ?>";
            },
            error: function(error) {
                globalError();
            }
        });
    }); // ok
</script>