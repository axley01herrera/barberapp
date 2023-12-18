<div class="row">
    <?php foreach ($availability as $a) { ?>
        <div class="col-12 col-lg-6 text-center">
            <a href="#" class="btn btn-sm btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary mt-2 w-100 time-selected" data-value="<?php echo $a; ?>"><?php echo $a; ?></a>
        </div>
    <?php } ?>
</div>

<?php if (empty($availability)) { ?>
    <!-- Alert Public Info -->
    <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100">
        <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h5 class="mb-1"><?php echo lang('Text.system_info'); ?></h5>
            <span><?php echo lang('Text.cust_no_appointment_available'); ?></span>
        </div>
    </div>
<?php } ?>

<script>
    $('.time-selected').on('click', function (e) {
        e.preventDefault();
        timeSelected = $(this).attr('data-value');
    });
</script>