<div class="row">
    <?php foreach ($availability as $a) { ?>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="form-check form-check-custom mt-5">
                <input class="form-check-input time-selected" type="radio" name="radio-time" data-value="<?php echo $a; ?>" id="<?php echo $a; ?>" >
                <label class="ms-2 fs-7" for="<?php echo $a; ?>">
                    <?php echo $a; ?>
                </label>
            </div>
        </div>
    <?php } ?>
</div>

<?php if (empty($availability)) { ?>
    <!-- Alert Public Info -->
    <div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100">
        <i class="ki-duotone ki-message-text-2 fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h5 class="mb-1"><?php echo lang('Text.important'); ?></h5>
            <span><?php echo lang('Text.cust_no_appointment_available'); ?></span>
        </div>
    </div>
<?php } ?>

<script>
    dateReview = "<?php echo $dateReview; ?>";
    $('#review-date').html(dateReview);

    $('.time-selected').on('click', function() {
        timeSelected = $(this).attr('data-value');
        $('#review-time').html(timeSelected);
    });
</script>