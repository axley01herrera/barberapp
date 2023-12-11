<div id="page" data-page="customer-index" class="d-flex flex-column flex-column-fluid">
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <!-- Sidebar -->
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <!-- Card -->
                    <div class="card mb-5 mb-xl-8">
                        <!-- Card body -->
                        <div id="customer-info" class="card-body">
                            <?php echo view('customer/customerInfo'); ?>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!-- Tabs Header -->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8" role="tablist">

                        <!-- Tab item -->
                        <li class="nav-item" role="presentation">
                            <a id="tab-appointents" class="nav-link text-active-primary pb-4 tab-profile active" data-bs-toggle="tab" href="#" aria-selected="true" role="tab"><?php echo lang('Text.appointents'); ?></a>
                        </li>

                        <!-- Tab item -->
                        <li class="nav-item" role="presentation">
                            <a id="tab-account" class="nav-link text-active-primary pb-4 tab-profile" data-bs-toggle="tab" href="#" data-kt-initialized="1" aria-selected="false" tabindex="-1" role="tab"><?php echo lang('Text.account'); ?></a>
                        </li>

                        <!-- Tab Profile-->
                        <li class="nav-item" role="presentation">
                            <a id="tab-profile" class="nav-link text-active-primary pb-4 tab-profile" data-bs-toggle="tab" href="#" aria-selected="false" tabindex="-1" role="tab"><?php echo lang('Text.profile'); ?></a>
                        </li>

                    </ul>
                    <!-- Tab Content -->
                    <div id="tabContent"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var tab = "tab-appointents";
    customerTabContent();

    function customerTabContent() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/customerTabContent'); ?>",
            data: {
                'tab': tab
            },
            dataType: "html",
            success: function(response) {
                $('#tabContent').html(response);
            },
            error: function() {
                globalError();
            }
        });
    }

    $('.tab-profile').on('click', function(e) {
        e.preventDefault();

        $('.tab-profile').each(function() {
            $(this).removeClass('active');
        });

        tab = $(this).attr('id');

        $(this).addClass('active');

        customerTabContent();
    });

    function reloadCustomerInfo() {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/reloadCustomerInfo'); ?>",
            dataType: "html",
            success: function(response) {
                $('#customer-info').html(response);
            },
            error: function() {
                globalError();
            }
        });
    }
</script>