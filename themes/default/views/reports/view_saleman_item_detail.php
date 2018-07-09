<?php

$reference_no2 = $this->input->post('reference_no');
$biller2 = $this->input->post('biller');
$category2 = $this->input->post('category');
$start_date2 = $this->input->post('start_date');
$end_date2 = $this->input->post('end_date');
$issued_by2 = $this->input->post('issued_by');

?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#form').hide();
        $('.toggle_down').click(function () {
            $("#form").slideDown();
            return false;
        });
        $('.toggle_up').click(function () {
            $("#form").slideUp();
            return false;
        });
        $("#product").autocomplete({
            source: '<?= site_url('reports/suggestions'); ?>',
            select: function (event, ui) {
                $('#product_id').val(ui.item.id);
                //$(this).val(ui.item.label);
            },
            minLength: 1,
            autoFocus: false,
            delay: 300,
        });
    });
</script>

<style>
    .ref_data {
        border-top: 5px solid #CFE8FB;
    }

    .table-striped > tbody .ref_data:first-child > td {
        background-color: #EDF8FF;
        border: none;
    }

    .table > thead:first-child > tr:first-child > th, .table > thead:first-child > tr:first-child > td, .table-striped thead tr.primary:nth-child(2n+1) th {
        border: none;
    }

    tfoot th {
        background-color: #428BCA;
        color: #FFFFFF;

    }

</style>


<?php
//$this->erp->print_arrays($reference_no2);
echo form_open('reports/saleman_item_detail_action/' . $user_id, 'id="action-form"');
?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                    class="fa-fw fa fa-heart"></i><?= lang('saleman_detail_report');
            echo ' (' . ucwords($saleman_user->username) . ')'; ?>
        </h2>
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
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right" class="tasks-menus" role="menu" aria-labelledby="dLabel">
                        <?php if ($Owner || $Admin || $GP['sales-export']) { ?>
                            <li>
                                <a href="#" id="excel" data-action="export_excel">
                                    <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" id="pdf" data-action="export_pdf">
                                    <i class="fa fa-file-pdf-o"></i> <?= lang('export_to_pdf') ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if (!empty($warehouses)) {
                    ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip"
                                                                                      data-placement="left"
                                                                                      title="<?= lang("warehouses") ?>"></i></a>
                        <ul class="dropdown-menu pull-right" class="tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?= site_url('sales') ?>"><i
                                            class="fa fa-building-o"></i> <?= lang('all_warehouses') ?></a></li>
                            <li class="divider"></li>
                            <?php
                            foreach ($warehouses as $warehouse) {
                                echo '<li><a href="' . site_url('sales/' . $warehouse->id) . '"><i class="fa fa-building"></i>' . $warehouse->name . '</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
    </div>

    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <input type="hidden" name="hidden_saleman" value="<?= ucwords($saleman_user->username) ?>"/>
        <input type="hidden" name="hidden_reference_no" value="<?= $reference_no2 ?>"/>
        <input type="hidden" name="hidden_biller" value="<?= $biller2 ?>"/>
        <input type="hidden" name="hidden_category" value="<?= $category2 ?>"/>
        <input type="hidden" name="hidden_start_date" value="<?= $start_date2 ? $start_date2 : $start_date ?>"/>
        <input type="hidden" name="hidden_end_date" value="<?= $end_date2 ? $end_date2 : $end_date ?>"/>
        <input type="hidden" name="hidden_issued_by" value="<?= $issued_by2 ?>"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>

    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?= lang('list_results'); ?></p>
                <div id="form">
                    <?php echo form_open("reports/view_saleman_item_detail/" . $user_id); ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="reference_no"><?= lang("reference_no"); ?></label>
                                <?php echo form_input('reference_no', (isset($_POST['reference_no']) ? $_POST['reference_no'] : ""), 'class="form-control tip" id="reference_no"'); ?>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="biller"><?= lang("biller"); ?></label>
                                <?php
                                $bl[""] = "";
                                foreach ($billers as $biller) {
                                    $bl[$biller->id] = $biller->company != '-' ? $biller->company : $biller->name;
                                }
                                echo form_dropdown('biller', $bl, (isset($_POST['biller']) ? $_POST['biller'] : ""), 'class="form-control" id="biller" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("biller") . '"');
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?= lang("category", "category"); ?>
                                <?php
                                $cate[""] = "";
                                foreach ($categories as $category) {
                                    $cate[$category->id] = $category->name;
                                }
                                echo form_dropdown('category', $cate, (isset($_POST['category']) ? $_POST['category'] : ""), 'class="form-control" id="category" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("category") . '"');
                                ?>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("start_date", "start_date"); ?>
                                <?php echo form_input('start_date', (isset($_POST['start_date']) ? $_POST['start_date'] : $start_date), 'class="form-control datetime" id="start_date"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("end_date", "end_date"); ?>
                                <?php echo form_input('end_date', (isset($_POST['end_date']) ? $_POST['end_date'] : $end_date), 'class="form-control datetime" id="end_date"'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?= lang("issued_by", "issued_by"); ?>
                                <?php
                                $issued_by = array(
                                    'show' => lang("show"),
                                    'hide' => lang("hide")
                                );
                                echo form_dropdown('issued_by', $issued_by, (isset($_POST['issued_by']) ? $_POST['issued_by'] : ""), 'id="issued_by" class="form-control issued_by"');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div
                                class="controls"> <?php echo form_submit('submit_view_customer_balance', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
                    </div>

                    <?php echo form_close(); ?>
                </div>

                <div class="clearfix"></div>
                <div class="table-responsive">
                    <table id="SLData" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th style="min-width:20px; width: 20px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th style="width: 15%"><?php echo $this->lang->line("date"); ?></th>
                            <th><?php echo $this->lang->line("due_date"); ?></th>
                            <th><?php echo $this->lang->line("reference_no"); ?></th>
                            <th style="width: 25%"><?php echo $this->lang->line("shop"); ?></th>
                            <th><?php echo $this->lang->line("customer"); ?></th>
                            <th><?php echo $this->lang->line("issued_by"); ?></th>
                            <th><?php echo $this->lang->line("sale_status"); ?></th>
                            <th><?php echo $this->lang->line("grand_total"); ?></th>
                            <th><?php echo $this->lang->line("return"); ?></th>
                            <th><?php echo $this->lang->line("paid"); ?></th>
                            <th><?php echo $this->lang->line("deposit"); ?></th>
                            <th><?php echo $this->lang->line("discount"); ?></th>
                            <th><?php echo $this->lang->line("balance"); ?></th>
                            <th><?php echo $this->lang->line("payment_status"); ?></th>
                        </tr>
                        </thead>
                        <?php
                        $grand_total = 0;
                        $gtotal_return = 0;
                        $gtotal_paid = 0;
                        $gtotal_deposit = 0;
                        $gtotal_disc = 0;
                        $gtotal_balance = 0;
                        foreach ($salemans_data as $saleman_data) {

                            $saleman_items_data = $this->reports_model->getAllSalemanItemsData($saleman_data->id);
                            //$this->erp->print_arrays($saleman_items_data);

                            ?>
                            <tbody>
                            <tr class="ref_data">
                                <td style="min-width:20px; width: 20px; text-align: center;">
                                    <input type="checkbox" class="checkbox multi-select input-xs" name='val[]'
                                           value="<?php echo $saleman_data->id ?>"/>
                                </td>
                                <td><?= $this->erp->hrld($saleman_data->date); ?></td>
                                <td><?= $saleman_data->due_date; ?></td>
                                <td><?= $saleman_data->reference_no; ?></td>
                                <td><?= $saleman_data->biller; ?></td>
                                <td><?= $saleman_data->customer; ?></td>
                                <td><?= $saleman_data->note; ?></td>

                                <td class="text-center">
                                    <?php if ($saleman_data->sale_status == 'completed') { ?>
                                        <span class='label label-success'><?= ucwords($saleman_data->sale_status); ?></span>
                                    <?php } ?>
                                </td>

                                <td><?= $saleman_data->grand_total; ?></td>
                                <td><?= $saleman_data->return_sale; ?></td>
                                <td><?= $saleman_data->paid; ?></td>
                                <td><?= $saleman_data->deposit; ?></td>
                                <td><?= $saleman_data->discount; ?></td>
                                <td><?= $saleman_data->balance; ?></td>

                                <td class="text-center">
                                    <?php if ($saleman_data->payment_status == 'paid') { ?>
                                        <span class='label label-success'><?= ucwords($saleman_data->payment_status); ?></span>
                                    <?php } elseif ($saleman_data->payment_status == 'partial') { ?>
                                        <span class='label label-info'><?= ucwords($saleman_data->payment_status); ?></span>
                                    <?php } else { ?>
                                        <span class='label label-danger'><?= ucwords($saleman_data->payment_status); ?></span>
                                    <?php } ?>
                                </td>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-center"><u><strong><?= lang("no"); ?></strong></u></td>
                                <td class="text-center"><u><strong><?= lang("product_code"); ?></strong></u></td>
                                <td class="text-center"><u><strong><?= lang("description"); ?></strong></u></td>
                                <td class="text-center"><u><strong><?= lang("unit"); ?></strong></u></td>
                                <td class="text-center"><u><strong><?= lang("quantity"); ?></strong></u></td>
                                <td class="text-center"><u><strong><?= lang("unit_price"); ?></strong></u></td>
                                <td class="text-center"><u><strong><?= lang("subtotal"); ?></strong></u></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            $r = 1;
                            foreach ($saleman_items_data as $saleman_item_data) {

                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><?= $r ?></td>
                                    <td><?= $saleman_item_data->product_code; ?></td>
                                    <td><?= $saleman_item_data->product_name; ?></td>
                                    <td class="text-center"><?= $saleman_item_data->unit; ?></td>
                                    <td class="text-center"><?= $this->erp->formatQuantity($saleman_item_data->quantity); ?></td>
                                    <td><?= $this->erp->formatMoney($saleman_item_data->unit_price) ?></td>
                                    <td><?= $this->erp->formatMoney($saleman_item_data->subtotal) ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                                <?php
                                $r++;
                            }

                            $grand_total += $saleman_data->grand_total;
                            $gtotal_return += $saleman_data->return_sale;
                            $gtotal_paid += $saleman_data->paid;
                            $gtotal_deposit += $saleman_data->deposit;
                            $gtotal_disc += $saleman_data->discount;
                            $gtotal_balance += $saleman_data->balance;
                        }
                        ?>

                        <tfoot>
                        <tr>
                            <th colspan="8"><?= lang('grand_total') ?></th>
                            <th><span data-toggle="tooltip" data-placement="bottom"
                                      title="Grand Total"><?= $this->erp->formatMoney($grand_total) ?></span></th>
                            <th><span data-toggle="tooltip" data-placement="bottom"
                                      title="Total Return"><?= $this->erp->formatMoney($gtotal_return) ?></th>
                            <th><span data-toggle="tooltip" data-placement="bottom"
                                      title="Total Paid"><?= $this->erp->formatMoney($gtotal_paid) ?></th>
                            <th><span data-toggle="tooltip" data-placement="bottom"
                                      title="Total Deposit"><?= $this->erp->formatMoney($gtotal_deposit) ?></th>
                            <th><span data-toggle="tooltip" data-placement="bottom"
                                      title="Total Discount"><?= $this->erp->formatMoney($gtotal_disc) ?></th>
                            <th><span data-toggle="tooltip" data-placement="bottom"
                                      title="Total Balance"><?= $this->erp->formatMoney($gtotal_balance) ?></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $('[data-toggle="tooltip"]').tooltip();

        $('body').on('click', '#combine_pay', function () {
            if ($('.checkbox').is(":checked") === false) {
                alert('Please select at least one.');
                return false;
            }
            var idd = '<?=$user_id;?>';
            var arrItems = [];
            $('.checkbox').each(function (i) {
                if ($(this).is(":checked")) {
                    if (this.value != "") {
                        arrItems[i] = $(this).val();
                    }
                }
            });

            $('#myModal').modal({remote: '<?=base_url('sales/combine_payment_customer');?>?data=' + arrItems + '&idd=' + idd + ''});
            $('#myModal').modal('show');
        });
    });
</script>