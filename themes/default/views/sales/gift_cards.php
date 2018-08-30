<?php
$v = "";

if ($this->input->post('card_no')) {
    $v .= "&card_no=" . $this->input->post('card_no');
}
if ($this->input->post('customer')) {
    $v .= "&customer=" . $this->input->post('customer');
}
if ($this->input->post('plate_number')) {
    $v .= "&plate_number=" . $this->input->post('plate_number');
}

?>
<script>
    $(document).ready(function () {
        $('#GCData').dataTable({
            "aaSorting": [[3, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            "bStateSave": true,
            'sAjaxSource': '<?= site_url('sales/getGiftCards/?v=1' . $v) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                nRow.id = aData[0];
                // nRow.className = "view_customer_history";
                return nRow;
            },
            "aoColumns": [{
                "bSortable": false,
                "mRender": checkbox
            }, null,
                {"mRender": currencyFormat},
                {"mRender": currencyFormat},
                null, null, null,
                <?php if($Settings->member_card_expiry) { ?>
                {"mRender": fsd},
                <?php } ?>
                {"bVisible": false},
                {"bSortable": false}]
        });

        $('#form').hide();
        $('.toggle_down').click(function () {
            $("#form").slideDown();
            return false;
        });
        $('.toggle_up').click(function () {
            $("#form").slideUp();
            return false;
        });
    });
</script>
<style>
    .view_customer_history {
        cursor: pointer;
    }
</style>
<?= form_open('sales/gift_card_actions', 'id="action-form"') ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-gift"></i><?= lang('list_gift_cards') ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="#" class="toggle_up tip" title="<?= lang('hide_form') ?>">
                        <i class="icon fa fa-toggle-up"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="toggle_down tip" title="<?= lang('show_form') ?>">
                        <i class="icon fa fa-toggle-down"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i></a>
                    <ul class="dropdown-menu pull-right" class="tasks-menus" role="menu" aria-labelledby="dLabel">

                        <?php if ($Owner || $Admin) { ?>

                            <li><a href="<?php echo site_url('sales/add_gift_card'); ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?= lang('add_gift_card') ?></a></li>
                            <li><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?></a></li>
                            <li><a href="#" id="pdf" data-action="export_pdf"><i class="fa fa-file-pdf-o"></i> <?= lang('export_to_pdf') ?></a></li>
                            <li>
                                <a href="<?= site_url('sales/import_gift_card'); ?>">
                                    <i class="fa fa-plus-circle"></i>
                                    <span class="text"> <?= lang('import_gift_card'); ?></span>
                                </a>
                            </li>

                        <?php }else{ ?>

                            <?php  if($GP['sales-add_gift_card']){ ?>
                                <li><a href="<?php echo site_url('sales/add_gift_card'); ?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?= lang('add_gift_card') ?></a></li>
                            <?php } ?>

                            <?php if($GP['sales-export_gift_card']) { ?>
                                <li><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?></a></li>
                                <li><a href="#" id="pdf" data-action="export_pdf"><i class="fa fa-file-pdf-o"></i> <?= lang('export_to_pdf') ?></a></li>
                            <?php }?>
                            <?php if($GP['sales-import_gift_card']) { ?>
                                <li>
                                    <a href="<?= site_url('sales/import_gift_card'); ?>">
                                        <i class="fa fa-plus-circle"></i>
                                        <span class="text"> <?= lang('import_gift_card'); ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php }?>

                        <li class="divider"></li>
                        <li><a href="#" id="delete" data-action="delete"><i class="fa fa-trash-o"></i> <?= lang('delete_gift_cards') ?></a></li>
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
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?php echo $this->lang->line("list_results"); ?></p>
                <div id="form">

                    <?php echo form_open("sales/gift_cards"); ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="card_no"><?= lang("card_no"); ?></label>
                                <?php
                                $gcard[""] = "";
                                foreach ($gift_cards as $gift_card) {
                                    $gcard[$gift_card->id] = $gift_card->card_no;
                                }
                                echo form_dropdown('card_no', $gcard, (isset($_POST['card_no']) ? $_POST['card_no'] : ""), 'class="form-control" id="card_no" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("card_number") . '"');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= lang("customer", "customer"); ?>
                                <?php
                                $cus['0'] = lang("all");
                                foreach ($customers as $customer) {
                                    $cus[$customer->id] = $customer->name;
                                }
                                echo form_dropdown('customer', $cus, null, 'class="form-control" ');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= lang("plate_number", "plate_number"); ?>
                                <?php echo form_input('plate_number', (isset($_POST['plate_number']) ? $_POST['plate_number'] : ""), 'class="form-control tip" id="plate_number"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
                    </div>
                    <?php echo form_close(); ?>

                </div>
                <div class="clearfix"></div>

                <div class="table-responsive">
                    <table id="GCData" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkth" type="checkbox" name="check"/>
                            </th>
                            <th><?php echo $this->lang->line("card_no"); ?></th>
                            <th><?php echo $this->lang->line("value"); ?></th>
                            <th><?php echo $this->lang->line("balance"); ?></th>
                            <th><?php echo $this->lang->line("created_by"); ?></th>
                            <th><?php echo $this->lang->line("customer"); ?></th>
                            <th><?php echo $this->lang->line("plate_number"); ?></th>
                            <?php if($Settings->member_card_expiry) { ?>
                                <th><?php echo $this->lang->line("expiry"); ?></th>
                            <?php } ?>
                            <th><?php echo $this->lang->line("customer_id"); ?></th>
                            <th style="min-width:110px !important; width: 100px !important;"><?php echo $this->lang->line("actions"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="9" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

<div style="display: none;">
    <input type="hidden" name="form_action" value="" id="form_action"/>
    <?= form_submit('submit', 'submit', 'id="action-form-submit"') ?>
</div>
<?= form_close() ?>
<script language="javascript">
    $(document).ready(function () {

        $('#delete').click(function (e) {
            e.preventDefault();
            $('#form_action').val($(this).attr('data-action'));
            $('#action-form-submit').trigger('click');
        });

        $('#excel').click(function (e) {
            e.preventDefault();
            $('#form_action').val($(this).attr('data-action'));
            $('#action-form-submit').trigger('click');
        });

        $('#pdf').click(function (e) {
            e.preventDefault();
            $('#form_action').val($(this).attr('data-action'));
            $('#action-form-submit').trigger('click');
        });

    });
</script>

