<script>
    $(document).ready(function () {
        var oTable = $('#SLData').dataTable({
            "aaSorting": [[1, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=lang('all')?>"]],
            "iDisplayLength": <?=$Settings->rows_per_page?>,
            'bProcessing': true,
            'bServerSide': true,
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                __setItem('DataTables_' + window.location.pathname, JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                var data = __getItem('DataTables_' + window.location.pathname);
                return JSON.parse(data);
            },
            'sAjaxSource': '<?=site_url('sales/getCoupon') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?=$this->security->get_csrf_token_name()?>",
                    "value": "<?=$this->security->get_csrf_hash()?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{
                "bSortable": false,
                "mRender": checkbox
            }, null, {"mRender": coupon_date}, {"mRender": coupon_status}
            ],
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('code');?>]", filter_type: "text", data: []},
            {
                column_number: 2,
                filter_default_label: "[<?=lang('expiry_date');?> (yyyy-mm-dd)]",
                filter_type: "text",
                data: []
            },
            {column_number: 3, filter_default_label: "[<?=lang('stauts');?>]", filter_type: "text", data: []},
        ], "footer");

    });

</script>
<style>
    .sorting_disabled {
        width: 5% !important;
    }
</style>
<?php

echo form_open('sales/print_preview_coupon', 'id="action-form"');
?>

<div class="box">
    <div class="box-header">

        <h2 class="blue">
            <i class="fa-fw fa fa-barcode"></i>
            <?= lang('coupon'); ?>
        </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right" class="tasks-menus" role="menu" aria-labelledby="dLabel">

                        <li>
                            <a href="<?= site_url('sales/add_coupon') ?>" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-circle"></i> <?= lang('add_coupon') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('sales/import_coupon'); ?>" data-toggle="modal"
                               data-target="#myModal">
                                <i class="fa fa-plus"></i> <?= lang('import_coupon') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('sales/print_preview_coupon'); ?>" data-toggle="modal"
                               data-target="#myModal">
                                <i class="fa fa-plus"></i> <?= lang('print_preview_coupon') ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>

    <div class="box-content" style="overflow-x:scroll; width: 100%;">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?= lang('list_results'); ?></p>

                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="SLData"
                           class="table table-bordered table-hover table-striped table-condensed reports-table reports-table">
                        <thead>
                        <tr>
                            <th style="min-width:30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th><?php echo $this->lang->line("code"); ?></th>
                            <th><?php echo $this->lang->line("expiry_date"); ?></th>
                            <th><?php echo $this->lang->line("status"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="3"
                                class="dataTables_empty"><?php echo $this->lang->line("loading_data"); ?></td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>