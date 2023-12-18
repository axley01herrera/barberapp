<!-- List -->
<ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x " role="tablist">
    <?php foreach ($employees as $index => $e) { ?>
        <!-- Employee -->
        <li class="nav-item" role="presentation">
            <a class="nav-link btn d-flex flex-column flex-center rounded-pill btn-active-primary <?php if ($index == 0) echo "active"; ?> exployee-list" data-employee-id="<?php echo $e->employeeID; ?>" href="#" role="tab">
                <div id="employee-img<?php echo $e->employeeID; ?>" class="symbol symbol-40px symbol-circle">
                    <?php if (empty($e->avatar)) { ?>
                        <img src="<?php echo base_url('public/assets/media/avatars/blank.png'); ?>" alt="Avatar">
                    <?php } else { ?>
                        <img src="data:image/png;base64,<?php echo base64_encode($e->avatar); ?>" alt="Avatar">
                    <?php } ?>
                    <br>
                    <span class="fs-6 fw-bold text-gray-900 mb-2"><?php echo $e->name; ?></span>
                </div>
            </a>
        </li>
    <?php } ?>
</ul>

<script>
    var countEmp = "<?php echo sizeof($employees); ?>";
    var serviceTime = "<?php echo $serviceTime; ?>";

    if (Number(countEmp) > 0) {
        employeeID = "<?php echo @$employees[0]->employeeID; ?>";
        getEmployeeAvailability();
    }

    $('.exployee-list').on('click', function(e) {
        e.preventDefault();

        $('.exployee-list').each(function() {
            $(this).removeClass('active');
        });

        $(this).addClass('active');

        employeeID = $(this).attr('data-employee-id');
        getEmployeeAvailability();
    });
</script>