<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cust_appointment_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cust_appointment_subtitle'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <button type="button" id="btn-<?php echo $uniqid; ?>" class="btn btn-primary"><?php echo lang('Text.btn_create_appointment'); ?></button>
        </div>
    </div>
    <div class="card-body p-9 pt-4">
        <div class="row">
        </div>
    </div>
</div>

<script>
    $('#btn-<?php echo $uniqid; ?>').on('click', function () { // Create Appointment
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Customer/createAppointment'); ?>",
            dataType: "html",
            success: function (response) {
                $('#tabContent').html(response);
            },
            error: function () {
                globalError();
            }
        });
    });
</script>