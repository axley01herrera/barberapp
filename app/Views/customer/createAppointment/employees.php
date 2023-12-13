<div class="card-body">
    <!-- List -->
    <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x " role="tablist">
        <?php foreach ($employees as $e) { ?>
            <!-- Employee -->
            <li class="nav-item" role="presentation">
                <a class="nav-link btn d-flex flex-column flex-center rounded-pill btn-active-primary" href="#" role="tab">
                    <div class="symbol symbol-40px symbol-circle">
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
</div>