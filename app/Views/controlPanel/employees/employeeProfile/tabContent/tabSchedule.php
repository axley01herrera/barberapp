<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.emp_schedule_title'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.emp_schedule_subtitle'); ?></div>
        </div>

        <!-- Card toolbar -->
        <div class="card-toolbar">
        </div>

    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        

        <div class="card-header mt-6">
            <!-- Card title -->
            <div class="card-title flex-column">
                <h6 class="mb-1"><?php echo lang('Text.monday'); ?></h6>
            </div>
            <!-- Card toolbar -->
            <div class="card-toolbar">
                <div class="form-check form-switch form-check-custom form-check-solid me-10">
                    <input type="checkbox" class="form-check-input h-30px w-50px" />
                    <label class="form-check-label"></label>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6 mt-5">
                    <h6 class="bg-success p-2"><?php echo lang('Text.first_time'); ?></h6>
                    <div class="row">
                        <div class="col-6 mt-5">
                            <label for="txt-monday_start1"><?php echo lang('Text.date_start'); ?></label>
                            <input type="text" id="txt-monday_start1" class="form-control timepicker" value="" />
                        </div>
                        <div class="col-6 mt-5">
                            <label for="txt-monday_end1"><?php echo lang('Text.date_end'); ?></label>
                            <input type="text" id="txt-monday_end1" class="form-control timepicker" value="" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 mt-5">
                    <h6 class="bg-primary p-2"><?php echo lang('Text.second_time'); ?></h6>
                    <div class="row">
                        <div class="col-6 mt-5">
                            <label for="txt-monday_start2"><?php echo lang('Text.date_start'); ?></label>
                            <input type="text" id="txt-monday_start2" class="form-control timepicker" value="" />
                        </div>
                        <div class="col-6 mt-5">
                            <label for="txt-monday_end2"><?php echo lang('Text.date_end'); ?></label>
                            <input type="text" id="txt-monday_end2" class="form-control timepicker" value="" />
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5 text-end">
                    <button id="schedule-monday" type="button" class="btn btn-primary font-weight-bold"><?php echo lang('Text.save_monday'); ?></button>
                </div>
            </div>
        </div>

    </div>
</div>