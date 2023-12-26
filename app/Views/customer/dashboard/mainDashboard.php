<div id="page" data-page="customer-dashboard" class="d-flex flex-column flex-column-fluid">
    <!-- Page Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid mt-6">
        <!-- Page Container -->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <!-- Section Customer Info -->
                <section>
                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                        <div class="card mb-5 mb-xl-8">
                            <div id="customer-info" class="card-body">
                                <?php echo view('customer/dashboard/sectionInfo'); ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Upcoming Appointments -->
                <div class="flex-lg-row-fluid ms-lg-20">
                    <div class="col-12 col-md-8 col-lg-8">
                        <?php echo view('customer/appointment/sectionUpcomingAppointment'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>