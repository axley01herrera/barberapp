<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card header -->
    <div class="card-header mt-6">
        <!-- Card title -->
        <div class="card-title flex-column">
            <h2 class="mb-1"><?php echo lang('Text.cp_profile_aditionals_modules'); ?></h2>
            <div class="fs-6 fw-semibold text-muted"><?php echo lang('Text.cp_profile_functionality_expansions'); ?></div>
        </div>
        <!-- Card toolbar -->
        <div class="card-toolbar">
            <div id="search-modules"></div>
        </div>
    </div>
    <!-- Card body -->
    <div class="card-body p-9 pt-4">
        <div class="table-responsive">
            <table id="dt-modules" class="table table-row-bordered no-footer table-hover" style="width: 100%;">
                <thead>
                    <tr class="fs-6 fw-bold">
                        <th class="p-2"><?php echo lang('Text.cp_dt_module_name'); ?></th>
                        <th class="p-2"><?php echo lang('Text.cp_dt_module_type'); ?></th>
                        <th class="p-2"><?php echo lang('Text.cp_dt_module_status'); ?></th>
                        <th class="p-2"><?php echo lang('Text.cp_dt_module_request'); ?></th>
                        <th class="p-2 text-end"></th>
                    </tr>
                    <thead>
                    <tbody>
                        <?php foreach ($modules as $m) { ?>
                            <tr>
                                <td class="dt-vertical-align p-2">
                                    <?php if ($config[0]->lang == 'es') echo $m->name_es; ?>
                                    <?php if ($config[0]->lang == 'en') echo $m->name_en; ?>
                                </td>
                                <td class="dt-vertical-align p-2">
                                    <?php if ($m->type == 1) echo lang('Text.employee'); ?>
                                    <?php if ($m->type == 2) echo lang('Text.customer'); ?>
                                </td>
                                <td class="dt-vertical-align p-2">
                                    <?php if ($m->status == 0) { ?>
                                        <span class="badge badge-light-danger"><?php echo lang('Text.inactive'); ?></span>
                                    <?php } ?>
                                    <?php if ($m->status == 1) { ?>
                                        <span class="badge badge-light-success"><?php echo lang('Text.active'); ?></span>
                                    <?php } ?>
                                </td>
                                <td class="dt-vertical-align p-2">
                                    <?php if ($m->request == 0) { ?>
                                        <span class="badge badge-light-danger"><?php echo lang('Text.no_requested'); ?></span>
                                    <?php } ?>
                                    <?php if ($m->request == 1) { ?>
                                        <span class="badge badge-light-success"><?php echo lang('Text.requested'); ?></span>
                                    <?php } ?>
                                </td>
                                <td class="dt-vertical-align p-2 text-end">
                                    <?php if ($m->request == 0) { ?>
                                        <button class="btn btn-sm btn-light btn-active-color-primary m-1" title="<?php echo lang('Text.send_requested'); ?>"><i class="bi bi-send-plus"></i></button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var lang = "<?php echo $config[0]->lang; ?>";
    var dtLang = "";

    if (lang == "es")
        dtLang = "<?php echo base_url('assets/js/dataTable/es.json'); ?>";
    else if (lang == "en")
        dtLang = "<?php echo base_url('assets/js/dataTable/en.json'); ?>";

    var dtModules = $('#dt-modules').DataTable({ // Data Table
        dom: 'RfrtlpiB',
        processing: true,
        stateSave: true,
        pageLength: 10,
        language: {
            url: dtLang
        },
        buttons: [],
        order: [
            [0, 'asc']
        ],
        initComplete: function(settings, json) {
            $('#search-modules').html('');
            $('#dt-modules_filter').appendTo('#search-modules');
        }
    }); // ok
</script>