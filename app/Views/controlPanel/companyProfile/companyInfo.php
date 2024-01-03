<div class="card mb-5 mb-xl-8">
    <div id="company-info" class="card-body">

        <div class="d-flex flex-center flex-column py-5">

            <!-- Logo -->
            <div class="symbol symbol-100px symbol-circle mb-7">
                <?php if (empty($companyProfile[0]->avatar)) { ?>
                    <img src="<?php echo base_url('public/assets/media/avatars/logoBlank.png'); ?>" class="border border-1 border-secondary" alt="Avatar">
                <?php } else { ?>
                    <img src="data:image/png;base64,<?php echo base64_encode($companyProfile[0]->avatar); ?>" class="border border-1 border-secondary" alt="Avatar">
                <?php } ?>
            </div>

        </div>

        <div id="kt_user_view_details" class="collapse show">
            <div class="pb-5 fs-6">

                <!-- Company ID -->
                <?php if (!empty($companyProfile[0]->companyID)) { ?>
                    <div class="fw-bold mt-5"><?php echo lang('Text.cp_profile_tax_identifier'); ?></div>
                    <div class="text-gray-600">
                        <span class="text-gray-600">
                            <?php echo $companyProfile[0]->companyID; ?>
                        </span>
                    </div>
                <?php } ?>

                <!-- Company Name -->
                <?php if (!empty($companyProfile[0]->companyName)) { ?>
                    <div class="fw-bold mt-5"><?php echo lang('Text.cp_profile_company_name'); ?></div>
                    <div class="text-gray-600">
                        <span class="text-gray-600"><?php echo $companyProfile[0]->companyName; ?></span>
                    </div>
                <?php } ?>

                <!-- Company Type -->
                <?php if (!empty($companyProfile[0]->companyType)) { ?>
                    <div class="fw-bold mt-5"><?php echo lang('Text.cp_profile_company_type'); ?></div>
                    <div class="text-gray-600">
                        <span class="text-gray-600"><?php echo $companyProfile[0]->companyType; ?></span>
                    </div>
                <?php } ?>

                <!-- Company Email -->
                <?php if (!empty($companyProfile[0]->email)) { ?>
                    <div class="fw-bold mt-5"><?php echo lang('Text.cp_profile_email'); ?></div>
                    <div class="text-gray-600">
                        <span class="text-gray-600"><?php echo $companyProfile[0]->email; ?></span>
                    </div>
                <?php } ?>

                <!-- Priary Phone-->
                <?php if (!empty($companyProfile[0]->phone1)) { ?>
                    <div class="fw-bold mt-5"><?php echo lang('Text.cp_profile_primary_phone'); ?></div>
                    <div class="text-gray-600">
                        <span class="text-gray-600">
                            <?php echo $companyProfile[0]->phone1; ?>
                        </span>
                    </div>
                <?php } ?>

                <!-- Secondary Phone -->
                <?php if (!empty($companyProfile[0]->phone2)) { ?>

                    <div class="fw-bold mt-5"><?php echo lang('Text.cp_profile_secondary_phone'); ?></div>
                    <div class="text-gray-600">
                        <span class="text-gray-600">
                            <?php echo $companyProfile[0]->phone2; ?>
                        </span>
                    </div>

                <?php } ?>

                <!-- Phone Ext -->
                <?php if (!empty($companyProfile[0]->phoneExt)) { ?>

                    <div class="fw-bold mt-5"><?php echo lang('Text.cp_profile_phone_ext'); ?></div>
                    <div class="text-gray-600">
                        <span class="text-gray-600">
                            <?php echo $companyProfile[0]->phoneExt; ?>
                        </span>
                    </div>

                <?php } ?>

                <!-- Address-->
                <?php if (!empty($companyProfile[0]->address1)) { ?>
                    <div class="fw-bold mt-5"><?php echo lang('Text.cp_profile_address'); ?></div>
                    <div class="text-gray-600">
                        <?php echo @$companyProfile[0]->address1; ?>
                        <?php if (@$companyProfile[0]->address2) echo ", " . $companyProfile[0]->address2; ?>
                        <br>
                        <?php echo @$companyProfile[0]->city; ?>
                        <?php if (@$companyProfile[0]->state) echo ", " .  $companyProfile[0]->state; ?>
                        <br>
                        <?php echo @$companyProfile[0]->zip; ?> <?php echo @$companyProfile[0]->country; ?>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>