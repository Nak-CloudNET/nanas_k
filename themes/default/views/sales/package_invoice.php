<?php
function product_name($name)
{
    return character_limiter($name, (isset($pos_settings->char_per_line) ? ($pos_settings->char_per_line-8) : 35));
}

if ($modal) {
    echo '<div class="modal-dialog no-modal-header"><div class="modal-content" style="max-width: 520px; margin: 0px auto;"><div class="modal-body" style="max-width: 510px; margin: 0px auto;"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i></button>';
} else { ?>
    <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $page_title . " " . lang("no") . " " . $inv->id; ?></title>
    <base href="<?= base_url() ?>"/>
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <link rel="shortcut icon" href="<?= $assets ?>images/icon.png"/>
    <link rel="stylesheet" href="<?= $assets ?>styles/theme.css" type="text/css"/>
    <style type="text/css" media="all">
        body {
            color: #000;
            font-size:13px !important;
        }

        #wrapper {
            max-width: 480px;
            margin: 0 auto;
            padding-top: 20px;
        }

        .btn {
            border-radius: 0;
            margin-bottom: 5px;
        }

        h3 {
            margin: 5px 0;
        }
        .text-center {
            text-align:center;
        }

        .item td {
            border-bottom: 1px solid #000;
        }
        .receipt > thead > tr > th {
            font-size: 15px;
            background-color:#fff !important;color:#000 !important;
            -webkit-print-color-adjust: exact;
            -moz-print-color-adjust: exact;
            -ms-print-color-adjust:exact;
            print-color-adjust:exact;
            color-adjust:exact;
            -webkit-color-adjust:exact;
            -moz-color-adjust:exact;
            -ms-color-adjust:exact;
        }

        .footer_info td, th {
            padding: 2px !important;
        }

        @media print {
            #cinfo .col-sm-6, .col-xs-6 {
                padding: 0 !important;
                font-size: 9px !important;
                line-height: 1.7;
            }
            .no-print {
                display: none;
            }

            .bill h3 {
                margin-left: -20px !important;
            }

            #wrapper {
                /*max-width: 480px;*/
                width: 98% !important;
                /*min-width: 250px;*/
                margin: 0 auto !important;
                padding: 0 !important;
                font-size: 10px !important;
            }
            .modal-content, .modal-body{
                border-bottom: none !important;
                border-top: none !important;
                border-right: none !important;
                border-left: none !important;
            }
            thead tr th {
                font-size: 10px !important;
            }

            tbody {
                font-size: 10px !important;
            }

            img {
                padding-right: 20px !important;
            }

            .biller {
                margin-left: -20px !important;
            }

        }
    </style>
</head>
<body>

<?php } ?>

<div id="wrapper">
    <div id="receiptData">
        <div class="no-print">
            <?php if ($message) { ?>
                <div class="alert alert-success">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <?= is_array($message) ? print_r($message, true) : $message; ?>
                </div>
            <?php } ?>
        </div>
        <div id="receipt-data">
            <div class="text-center">
                <div class="row">
                    <div class="col-sm-9 col-xs-9"></div>
                    <div class="col-sm-3 col-xs-3">
                        <button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px; margin-top: 10px" onclick="window.print();">
                            <i class="fa fa-print"></i> <?= lang('print'); ?>
                        </button>
                    </div>
                </div>

                <div class="row" id="logo">
                    <?php if (isset($biller->logo)) { ?>
                        <div class="col-xs-12 text-center">
                            <img src="<?= base_url() . 'assets/uploads/logos/' . $biller->logo; ?>"
                                 alt="<?= $biller->company; ?>" width="150px"/>
                            <span class="biller"><?= strstr($biller->company, '(') ?></span>
                        </div>
                    <?php }else{
                        echo "";
                    } ?>
                </div>

                <div class="row bill">
                    <div class="col-sm-12"><h3><?= lang('bill') ?></h3></div>
                </div>

            </div>

            <div class="row" id="cinfo">
                <div class="col-sm-6 col-xs-6">
                    <div class="row" style="font-weight:bold !important;">
                        <div class="col-sm-6 col-xs-6" style="width: 34%; padding-right: 0px">
                            <?= lang('plate_no') ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 66%; padding-left: 0px">
                            : <?= $inv->plate_number ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 34%; padding-right: 0px">
                            <?= lang('customer') ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 66%; padding-left: 0px">
                            : <?= $inv->customer; ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 34%; padding-right: 0px">
                            <?= lang('member') ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 66%; padding-left: 0px">
                            : <?= $inv->card_no; ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 34%; padding-right: 0px">
                            <?= lang('r_value') ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 66%; padding-left: 0px">
                            : <?= $this->erp->formatMoney($inv->card_balance) ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-6">
                    <div class="row" style="font-weight:bold !important;">
                        <div class="col-sm-6 col-xs-6" style="width: 35%;padding-right: 1px">
                            <?= lang('date') ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 65%;padding-left: 1px">
                            : <?= $this->erp->hrld($inv->date); ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 35%; padding-right: 1px">
                            <?= lang('cashier') ?>
                        </div>
                        <div class="col-sm-6 col-xs-6" style="width: 65%;padding-left: 1px">
                            : <?= $inv->saleman; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="row" style="clear: both;"></div>
        </div>
        <div style="clear:both;"></div>

        <?php

        $total_disc = 0;
        if (is_array($rows)) {
            foreach ($rows as $d) {
                if ($d->discount != 0) {
                    $total_disc = $d->discount;
                }
            }
        }
        ?>

        <div style="clear:both;"></div>

        <style>
            .no_border_btm tr td{
                border:none !important;
            }
        </style>

        <table class="table-condensed receipt no_border_btm" style="width:100%; margin-top: 10px">
            <thead>
            <tr style="border:1px dotted black !important; height: 30px">
                <th style="text-align: center; width: 10%;"><?= lang("no"); ?></th>
                <th style="text-align: left; width: 45%"><?= lang("Description"); ?></th>
                <th style="text-align:center;width: 100px;"><?= lang("qty."); ?></th>
                <th style="text-align:center;"><?= lang("Price"); ?></th>
                <th style="text-align:center;"><?= lang("disc"); ?></th>
                <th style="padding-left:10px;padding-right:10px;text-align:right;width: 100px;"><?= lang("total"); ?> </th>
            </tr>
            </thead>
            <tbody style="border-bottom:2px solid black;">
            <?php
            $r = 1;
            $m_us = 0;
            $total_quantity = 0;
            $tax_summary = array();
            $sub_total = 0;
            $total = 0;
            if (is_array($rows)) {
                foreach ($rows as $row) {
                    $free = lang('free');
                    if (isset($tax_summary[$row->tax_code])) {
                        $tax_summary[$row->tax_code]['items'] += $row->quantity;
                        $tax_summary[$row->tax_code]['tax'] += $row->item_tax;
                        $tax_summary[$row->tax_code]['amt'] += ($row->quantity * $row->net_unit_price) - $row->item_discount;
                    } else {
                        $tax_summary[$row->tax_code]['items'] = $row->quantity;
                        $tax_summary[$row->tax_code]['tax'] = $row->item_tax;
                        $tax_summary[$row->tax_code]['amt'] = ($row->quantity * $row->net_unit_price) - $row->item_discount;
                        $tax_summary[$row->tax_code]['name'] = $row->tax_name;
                        $tax_summary[$row->tax_code]['code'] = $row->tax_code;
                        $tax_summary[$row->tax_code]['rate'] = $row->tax_rate;
                    }
                    $totals += $row->subtotal;
                    $total += $row->subtotal;



                    foreach ($gift_cards as $gift_card) {
                        $qty = 0;
                        $qty_used = 0;
                        $packages = $this->pos_model->getPackagesByGiftCardID($gift_card->package_id, $gift_card->sale_id);
                    
                        echo '<tr ' . ($row->product_type === 'combo' ? '' : 'class="item"') . '>';
                        echo '  <td style="text-align:center;width: 5%;">' . $r . '</td>';
                        echo '  <td class="text-left"><strong>' . $gift_card->package_size . ' (' . trim(str_replace('Premium Wash', '', $gift_card->package_name)) . ')' . '</strong></td>';

                        echo '  <td class="text-center">' . $this->erp->formatQuantity($row->quantity) . '</td>';

                        echo '  <td class="text-center"  style="text-align:center; width:100px !important">' . (($row->unit_price) == 0 ? $free : $this->erp->formatMoney($row->unit_price)) . '</td>';

                        $colspan = 5;
                        echo '<td style="width: 100px; text-align:right; vertical-align:middle;">' . ($row->discount != 0 ? '<small>(' . $row->discount . ')</small>' : '') . $this->erp->formatMoney($row->item_discount) . '</td>';

                        echo '<td class="text-right">' . (($row->subtotal) == 0 ? $free : $this->erp->formatMoney($row->subtotal)) . '</td>';


                        $r++;
                        $total_quantity += $row->quantity;

                        if ($row->product_type === 'combo') {

                            $c = 1;
                            $$package_qty = 0;

                            foreach ($packages as $package) {

                                if ($package->qty == '500') {
                                    $package_qty = 'Unlimited';
                                } else {
                                    $package_qty = $this->erp->formatQuantity($package->qty);
                                }

                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td colspan="5"><span style="padding-right: 5px;">' . $c . '. ' . $package->package_item_name . '</span>('. $package_qty .')</td>';
                                echo '</tr>';
                                $c++;
                            }
                        }

                    } // end loop gift cards
                }
            }
            ?>

            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <table class="footer_info" style="width: 100%; margin-top: 5px;">
            <tr>
                <td class="text-left" style="width:40%; "><?= lang('total') ?></td>
                <td class="text-left flabel" style="width: 40%;"><?= lang('សរុប') ?></td>
                <td style="text-align:right;width: 20%;"><?= $this->erp->formatMoney($total) ?></td>
            </tr>
            <tr>
                <td class="text-left"><?= lang('discount_price') ?></td>
                <td class="text-left flabel"><?= lang('បញ្ជុះតម្លៃ') ?></td>
                <td style="text-align:right;"><?= $this->erp->formatMoney($inv->order_discount) ?></td>
            </tr>
            <tr>
                <td class="text-left"><?= lang('final_price') ?></td>
                <td class="text-left flabel"><?= lang('សរុបចុងក្រោយ') ?></td>
                <td style="text-align:right;"><?= $this->erp->formatMoney($total - $inv->order_discount); ?></td>
            </tr>
            
            <?php
            $pos_paid = 0;
            $pos_paidd = 0;
            $colspan = 0;
            if ($payments) {
                foreach ($payments as $payment) {
                    $pos_paid = $payment->pos_paid;
                    if ($pos_settings->in_out_rate) {
                        $pos_paid_other = ($payment->pos_paid_other != null ? $payment->pos_paid_other / $outexchange_rate->rate : 0);
                    } else {
                        $pos_paid_other = ($payment->pos_paid_other != null ? $payment->pos_paid_other / $exchange_rate->rate : 0);
                    }
                }
                $pos_paidd = $pos_paid + $pos_paid_other;
            }

            if ($pos_paidd >= $inv->grand_total) {

                if (count($payments) > 1) {
                    ?>
                    <tr>
                        <th colspan="<?= $colspan + 2 ?>">
                            <?php
                            foreach ($payments as $payment) {
                                ?>
                                <table style="width:126%;">
                                    <caption style="float: left; padding-left: 13px;">
                                        <tr>
                                            <th colspan="3">
                                                <?php if ($payment->paid_by == 'Cheque') {
                                                    echo lang('paid_by') . ' ' . lang($payment->paid_by) . ' ' . lang('(' . $payment->cheque_no . ')');
                                                } elseif ($payment->paid_by == 'CC') {
                                                    echo lang('paid_by') . ' ' . lang($payment->paid_by) . ' ' . lang('(' . $payment->cc_no . ')');
                                                } else {
                                                    echo lang('paid_by') . ' ' . lang($payment->paid_by);
                                                } ?>
                                            </th>
                                        </tr>
                                    </caption>

                                    <tr>
                                        <th style="width: 40%" colspan="<?= $colspan ?>"
                                            class="text-left received_amount">
                                            <span style="padding-left:5px">Received (<?= $default_currency->code; ?>
                                                ): </span>
                                        </th>
                                        <th style="width: 40%"><?= lang('ប្រាក់ទទួល (ដុល្លារ)') ?></th>
                                        <th style="width: 20%"
                                            class="text-right"><?= $this->erp->formatMoney($payment->pos_paid); ?></th>
                                    </tr>
                                    <?php
                                    if ($inv->other_cur_paid) {

                                        ?>
                                        <tr>
                                            <th style="width: 40%"
                                                colspan="<?= $colspan ?>" class="text-left received_amount">
                                                Received (Riel):
                                            </th>
                                            <th style="width: 40%"><?= lang('ប្រាក់ទទួល (រៀល)') ?></th>
                                            <th style="width: 20%"
                                                class="text-right"><?= number_format($payment->pos_paid_other) . ' ៛'; ?></th>
                                        </tr>
                                        <?php

                                    } else {
                                    }
                                    ?>
                                </table>

                                <?php
                            }
                            ?>
                        </th>
                    </tr>
                    <?php
                } else {


                    if ($inv->other_cur_paid) {
                        $khr_paid = ($inv->other_cur_paid / $inv->other_cur_paid_rate);
                    } else {
                        $khr_paid = 0;
                    }
                    ?>
                    <caption style="float: left; padding-left: 13px;">
                        <tr>
                            <th colspan="3">
                                <?php if ($payment->paid_by == 'Cheque') {
                                    echo lang('paid_by') . ' ' . lang($payment->paid_by) . ' ' . lang('(' . $payment->cheque_no . ')');
                                } elseif ($payment->paid_by == 'CC') {
                                    echo lang('paid_by') . ' ' . lang($payment->paid_by) . ' ' . lang('(' . $payment->cc_no . ')');
                                } else {
                                    echo lang('paid_by') . ' ' . lang($payment->paid_by);
                                } ?>
                            </th>
                        </tr>
                    </caption>
                    <tr>
                        <th style="width:40%;" class="text-left received_amount">
                            <span style="padding-left: 5px">Received (<?= $default_currency->code; ?>) :</span>
                        </th>
                        <th style="width: 40%"><?= lang('ប្រាក់ទទួល (ដុល្លារ)') ?></th>
                        <th style="width: 20%"
                            class="text-right"><?= $this->erp->formatMoney($payment->pos_paid); ?></th>
                    </tr>
                    <tr>
                        <th style="width:40%;" class="text-left received_amount">
                            <span style="padding-left: 5px">Received (Riel) :</span>
                        </th>
                        <th style="width: 40%"><?= lang('ប្រាក់ទទួល (រៀល)') ?></th>
                        <th style="width: 20%"
                            class="text-right"><?= number_format($payment->pos_paid_other) . ' ៛'; ?></th>
                    </tr>

                    <?php
                }
                if (count($payments) > 1) {

                    $pay = '';
                    $pay_kh = '';
                    foreach ($payments as $payment) {

                        $pay += $payment->pos_paid;
                        $pay_kh += $payment->pos_paid_other;
                    }

                    if ((($pay + ($pay_kh / (($pos_settings->in_out_rate) ? $outexchange_rate->rate : $exchange_rate->rate))) - $inv->grand_total) != 0) {

                        ?>

                        <tr>
                            <th style="padding-right: 12px;"
                                class="text-left"><?= lang("change_amount_us"); ?>:
                            </th>
                            <th><?= lang('ប្រាក់អាប់ (ដុល្លារ)') ?></th>
                            <th class="text-right">
                                <?php
                                echo $this->erp->formatMoney(($pay + $pay_kh) - $inv->grand_total);
                                $total_us_b = $this->erp->formatMoney(($pay + $pay_kh) - $inv->grand_total);
                                $m_us = $this->erp->fraction($total_us_b);
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="padding-right: 12px;" colspan="<?= $colspan ?>"
                                class="text-left"><?= lang("change_amount_kh"); ?></th>
                            <th><?= lang('ប្រាក់អាប់ (រៀល)') ?></th>
                            <th class="text-right"><?= number_format(round($payment->pos_balance * $payment->pos_paid_other_rate)); ?>
                                <sup> ៛</sup></th>
                        </tr>
                        <?php
                    }
                } else {
                    if ((($pos_paid + $pos_paid_other) - $inv->grand_total) != 0 || ($this->erp->formatMoney((($pos_paid + $amount_kh_to_us) - $inv->grand_total) * $exchange_rate->rate)) != 0) { ?>
                        <tr>
                            <th class="text-left"><?= lang("change_amount_us"); ?>
                                :
                            </th>
                            <th><?= lang('ប្រាក់អាប់ (ដុល្លារ)') ?></th>
                            <th class="text-right">
                                <?php
                                echo $this->erp->formatMoney($payment->pos_balance);
                                $total_us_b = $this->erp->formatMoney(($pos_paid + $amount_kh_to_us) - $inv->grand_total);
                                $m_us = $this->erp->fraction($total_us_b);
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-left"><?= lang("change_amount_kh"); ?>
                                :
                            </th>
                            <th><?= lang('ប្រាក់អាប់ (រៀល)') ?></th>
                            <th class="text-right">
                                <?= number_format(round($payment->pos_balance * $payment->pos_paid_other_rate)); ?>
                                <sup> ៛</sup>

                            </th>
                        </tr>
                        <?php
                    }
                }
            }
            if ($pos_paidd < $inv->grand_total) {
                if (count($payments) > 1) {
                    ?>
                    <tr>
                        <th colspan="<?= $colspan + 2 ?>">
                            <?php

                            foreach ($payments as $payment) {

                                if ($payment->pos_paid > 0) {

                                    ?>

                                    <table style="width:126%;">
                                        <caption style="float: left; padding-left: 13px;">
                                            <tr>
                                                <th colspan="3">
                                                    <?php if ($payment->paid_by == 'Cheque') {
                                                        echo lang('paid_by') . ' ' . lang($payment->paid_by) . ' ' . lang('(' . $payment->cheque_no . ')');
                                                    } elseif ($payment->paid_by == 'CC') {
                                                        echo lang('paid_by') . ' ' . lang($payment->paid_by) . ' ' . lang('(' . $payment->cc_no . ')');
                                                    } else {
                                                        echo lang('paid_by') . ' ' . lang($payment->paid_by);
                                                    } ?>
                                                </th>
                                            </tr>
                                        </caption>

                                        <tr>
                                            <th style="width: 40%" colspan="<?= $colspan ?>"
                                                class="text-left received_amount">
                                                <span style="padding-left:5px">Received (<?= $default_currency->code; ?>
                                                    ): </span>
                                            </th>
                                            <th style="width: 40%"><?= lang('ប្រាក់ទទួល (ដុល្លារ)') ?></th>
                                            <th style="width: 20%"
                                                class="text-right"><?= $this->erp->formatMoney($payment->pos_paid); ?></th>
                                        </tr>
                                        <?php
                                        if ($inv->other_cur_paid) {

                                            ?>
                                            <tr>
                                                <th style="width: 40%"
                                                    colspan="<?= $colspan ?>" class="text-left received_amount">
                                                    Received (Riel):
                                                </th>
                                                <th style="width: 40%"><?= lang('ប្រាក់ទទួល (រៀល)') ?></th>
                                                <th style="width: 20%"
                                                    class="text-right"><?= number_format($payment->pos_paid_other) . ' ៛'; ?></th>
                                            </tr>
                                            <?php

                                        } else {
                                        }
                                        ?>
                                    </table>
                                    <?php
                                }

                            }
                            ?>
                        </th>
                    </tr>
                    <?php
                } else {
                    ?>
                    <caption style="float: left; padding-left: 13px;">
                        <tr>
                            <th colspan="3">
                                <?php if ($payment->paid_by == 'Cheque') {
                                    echo lang('paid_by') . ' ' . lang($payment->paid_by) . ' ' . lang('(' . $payment->cheque_no . ')');
                                } elseif ($payment->paid_by == 'CC') {
                                    echo lang('paid_by') . ' ' . lang($payment->paid_by) . ' ' . lang('(' . $payment->cc_no . ')');
                                } else {
                                    echo lang('paid_by') . ' ' . lang($payment->paid_by);
                                } ?>
                            </th>
                        </tr>
                    </caption>
                    <tr>
                        <th colspan="<?= $colspan ?>" class="text-left received_amount">
                            <span style="padding-left: 5px">Received (<?= $default_currency->code; ?>):</span>
                        </th>
                        <th><?= lang('ប្រាក់ទទួល (ដុល្លារ)') ?></th>
                        <th class="text-right"><?= $this->erp->formatMoney($payment->pos_paid); ?></th>
                    </tr>
                    <tr>
                        <th style="padding-right: 0px;" colspan="<?= $colspan ?>" class="text-left received_amount">
                            <span style="padding-left: 5px">Received (Riel):</span>
                        </th>
                        <th><?= lang('ប្រាក់ទទួល (រៀល)') ?></th>
                        <th class="text-right"><?= number_format($payment->pos_paid_other) . ' ៛'; ?></th>
                    </tr>
                    <?php
                }

                if (count($payments) > 1) {
                    $pay = '';
                    $pay_kh = '';
                    foreach ($payments as $payment) {

                        $pay += $payment->pos_paid;
                        $pay_kh += $payment->pos_paid_other;
                    }

                    if ((($pay + ($pay_kh / (($pos_settings->in_out_rate) ? $outexchange_rate->rate : $exchange_rate->rate))) - $inv->grand_total) != 0) {
                        ?>
                        <tr>
                            <th style="padding-right: 0px;" colspan="<?= $colspan ?>"
                                class="text-left"><?= lang("remaining_us"); ?></th>
                            <th><?= lang('ប្រាក់នៅខ្វះ (ដុល្លារ)') ?></th>
                            <th class="text-right">
                                <?php
                                $money_kh = $pay_kh / (($pos_settings->in_out_rate) ? $outexchange_rate->rate : $exchange_rate->rate);
                                echo $this->erp->formatMoney(abs(($pay + $money_kh) - $inv->grand_total));
                                $total_us_b = $this->erp->formatMoney(($pay + $money_kh) - $inv->grand_total);
                                $m_us = $this->erp->fraction($total_us_b);

                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="padding-right: 0px;" colspan="<?= $colspan ?>"
                                class="text-left"><?= lang("remaining_kh"); ?></th>
                            <th><?= lang('ប្រាក់នៅខ្វះ (រៀល)') ?></th>
                            <th class="text-right"><?= number_format(abs((($pay + $money_kh) - $inv->grand_total) * (($pos_settings->in_out_rate) ? $outexchange_rate->rate : $exchange_rate->rate))) . ' ៛'; ?></th>
                        </tr>
                        <?php
                    }
                } else {
                    $pay = '';
                    $pay_kh = '';
                    $balance = '';
                    $pos_paid_other_balance = '';
                    $balance_amount = '';
                    foreach ($payments as $payment) {
                        $pay += $payment->pos_paid;
                        $pay_kh += $payment->pos_paid_other;
                        $balance += $payment->pos_balance;
                        $pos_paid_other_balance += ($payment->pos_paid_other / $payment->pos_paid_other_rate) + $payment->pos_paid;
                        $balance_amount += $pos_paid_other_balance - $payment->amount;
                    }
                    
                    if ($balance_amount == $balance) { ?>
                        <tr>
                            <th colspan="<?= $colspan ?>"
                                class="text-left"><?= lang("change_amount_us"); ?> :
                            </th>
                            <th><?= lang('ប្រាក់អាប់ (ដុល្លារ)') ?></th>
                            <th class="text-right">
                                <?php
                                echo $this->erp->formatMoney(abs($inv->pos_balance));
                                $total_us_b = $this->erp->formatMoney($inv->grand_total - ($pos_paid + $amount_kh_to_us));
                                $m_us = $this->erp->fraction($total_us_b);
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="<?= $colspan ?>"
                                class="text-left"><?= lang("change_amount_kh"); ?> :
                            </th>
                            <th><?= lang('ប្រាក់អាប់ (រៀល)') ?></th>
                            <th class="text-right"><?= number_format(abs($inv->pos_balance * $inv->pos_paid_other_rate)) . ' ៛'; ?></th>
                        </tr>
                        <?php
                    } elseif (($inv->grand_total - ($pay + $pay_kh)) < 0) { ?>
                        <tr>
                            <th colspan="<?= $colspan ?>"
                                class="text-left"><?= lang("remaining_us"); ?> :
                            </th>
                            <th><?= lang('ប្រាក់នៅខ្វះ (ដុល្លារ)') ?></th>
                            <th class="text-right">
                                <?php
                                echo $this->erp->formatMoney(abs($inv->pos_balance));
                                $total_us_b = $this->erp->formatMoney($inv->grand_total - ($pos_paid + $amount_kh_to_us));
                                $m_us = $this->erp->fraction($total_us_b);
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="<?= $colspan ?>"
                                class="text-left"><?= lang("remaining_kh"); ?> :
                            </th>
                            <th><?= lang('ប្រាក់នៅខ្វះ (រៀល)') ?></th>
                            <th class="text-right"><?= number_format(abs($inv->pos_balance * $inv->pos_paid_other_rate)) . ' ៛'; ?></th>
                        </tr>
                        <?php
                    } elseif (($inv->grand_total - ($pos_paid + $pos_paid_other)) > 0 || ($this->erp->formatMoney((($pos_paid + $amount_kh_to_us) - $inv->grand_total) * (($pos_settings->in_out_rate) ? $outexchange_rate->rate : $exchange_rate->rate)))) { ?>
                        <tr>
                            <th colspan="<?= $colspan ?>"
                                class="text-left"><?= lang("remaining_us"); ?> :
                            </th>
                            <th><?= lang('ប្រាក់នៅខ្វះ (ដុល្លារ)') ?></th>
                            <th class="text-right">
                                <?php
                                echo $this->erp->formatMoney(abs($inv->pos_balance));
                                $total_us_b = $this->erp->formatMoney($inv->grand_total - ($pos_paid + $amount_kh_to_us));
                                $m_us = $this->erp->fraction($total_us_b);
                                ?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="<?= $colspan ?>"
                                class="text-left"><?= lang("remaining_kh"); ?> :
                            </th>
                            <th><?= lang('ប្រាក់នៅខ្វះ (រៀល)') ?></th>
                            <th class="text-right"><?= number_format(abs($inv->pos_balance * $inv->pos_paid_other_rate)) . ' ៛'; ?></th>
                        </tr>
                        <?php
                    }

                }

            }

            ?>

        </table>

        <div style="width:100%;text-align:left;margin-top:10px;display:none">
            ពិន្ទុចាស់ - Old Point &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b></b><br/>
            ពិន្ទុសរុប - Total Point &nbsp;&nbsp;: <b></b>
        </div>

        <?= $inv->note ? '<p class="text-left no-print"><strong>' . lang("note") . ': ' . $this->erp->decode_html($inv->note) . '</strong></p>' : ''; ?>
        <?= $inv->staff_note ? '<p class="no-print"><strong>' . lang('staff_note') . ':</strong> ' . $this->erp->decode_html($inv->staff_note) . '</p>' : ''; ?>

    </div>
    <?php $this->erp->qrcode('link', urlencode(site_url('pos/view/' . $inv->id)), 2); ?>
    <div class="text-center">
    </div>
    <?php $br = $this->erp->save_barcode($inv->reference_no, 'code39'); ?>
    <div class="text-center">
        <table width="100%">
            <tr>
                <td style="padding-top:10px;padding-left:20px;"><?= nl2br($biller->invoice_footer); ?></td>
            </tr>
            <!--<tr>
                <td class="text-center" style="padding-top: 10px;">~ ~ ~ <b>CloudNet</b> &nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:12px;">www.cloudnet.com.kh</span> ~ ~ ~</td>
            </tr>-->

        </table>
    </div>

    <div style="clear:both;"></div>

    <?php if ($modal) {
        echo '</div></div></div></div>';
    } else { ?>
    <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
        <hr>
        <?php if ($message) { ?>
            <div class="alert alert-success">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <?= is_array($message) ? print_r($message, true) : $message; ?>
            </div>
        <?php } ?>
        <span class="col-xs-12">
                <a class="btn btn-block btn-warning" href="<?= site_url('sales'); ?>"><?= lang("back"); ?></a>
            </span>
        <div style="clear:both;"></div>
    </div>
</div>
<canvas id="hidden_screenshot" style="display:none;"></canvas>
<div class="canvas_con" style="display:none;"></div>
<script type="text/javascript" src="<?= $assets ?>pos/js/jquery-1.7.2.min.js"></script>
<?php if ($pos_settings->java_applet) {
    function drawLine()
    {
        $size = $pos_settings->char_per_line;
        $new = '';
        for ($i = 1; $i < $size; $i++) {
            $new .= '-';
        }
        $new .= ' ';
        return $new;
    }

    function printLine($str, $sep = ":", $space = NULL)
    {
        $size = $space ? $space : $pos_settings->char_per_line;
        $lenght = strlen($str);
        list($first, $second) = explode(":", $str, 2);
        $new = $first . ($sep == ":" ? $sep : '');
        for ($i = 1; $i < ($size - $lenght); $i++) {
            $new .= ' ';
        }
        $new .= ($sep != ":" ? $sep : '') . $second;
        return $new;
    }

    function printText($text)
    {
        $size = $pos_settings->char_per_line;
        $new = wordwrap($text, $size, "\\n");
        return $new;
    }

    function taxLine($name, $code, $qty, $amt, $tax)
    {
        return printLine(printLine(printLine(printLine($name . ':' . $code, '', 18) . ':' . $qty, '', 25) . ':' . $amt, '', 35) . ':' . $tax, ' ');
    }

    ?>

    <script type="text/javascript" src="<?= $assets ?>pos/qz/js/deployJava.js"></script>
    <script type="text/javascript" src="<?= $assets ?>pos/qz/qz-functions.js"></script>
    <script type="text/javascript">
        deployQZ('themes/<?=$Settings->theme?>/assets/pos/qz/qz-print.jar', '<?= $assets ?>pos/qz/qz-print_jnlp.jnlp');
        usePrinter("<?= $pos_settings->receipt_printer; ?>");
        <?php /*$image = $this->erp->save_barcode($inv->reference_no);*/ ?>
        function printReceipt() {
            //var barcode = 'data:image/png;base64,<?php /*echo $image;*/ ?>';
            receipt = "";
            receipt += chr(27) + chr(69) + "\r" + chr(27) + "\x61" + "\x31\r";
            receipt += "<?= $biller->company; ?>" + "\n";
            receipt += " \x1B\x45\x0A\r ";
            receipt += "<?= $biller->address . " " . $biller->city . " " . $biller->country; ?>" + "\n";
            receipt += "<?= $biller->phone; ?>" + "\n";
            receipt += "<?php if ($pos_settings->cf_title1 != "" && $pos_settings->cf_value1 != "") { echo printLine($pos_settings->cf_title1 . ": " . $pos_settings->cf_value1); } ?>" + "\n";
            receipt += "<?php if ($pos_settings->cf_title2 != "" && $pos_settings->cf_value2 != "") { echo printLine($pos_settings->cf_title2 . ": " . $pos_settings->cf_value2); } ?>" + "\n";
            receipt += "<?=drawLine();?>\r\n";
            receipt += "<?php if($Settings->invoice_view == 1) { echo lang('tax_invoice'); } ?>\r\n";
            receipt += "<?php if($Settings->invoice_view == 1) { echo drawLine(); } ?>\r\n";
            receipt += "\x1B\x61\x30";
            receipt += "<?= printLine(lang("reference_no") . ": " . $inv->reference_no) ?>" + "\n";
            receipt += "<?= printLine(lang("sales_person") . ": " . $biller->name); ?>" + "\n";
            receipt += "<?= printLine(lang("customer") . ": " . $inv->customer); ?>" + "\n";
            receipt += "<?= printLine(lang("date") . ": " . date($dateFormats['php_ldate'], strtotime($inv->date))) ?>" + "\n\n";
            receipt += "<?php $r = 1;
                foreach ($rows as $row): ?>";
            receipt += "<?= "#" . $r ." "; ?>";
            receipt += "<?= printLine(product_name(addslashes($row->product_name)).($row->variant ? ' ('.$row->variant.')' : '').":".$row->tax_code, '*'); ?>" + "\n";
            receipt += "<?= printLine($this->erp->formatQuantity($row->quantity)."x".$this->erp->formatMoney($row->net_unit_price+($row->item_tax/$row->quantity)) . ":  ". $this->erp->formatMoney($row->subtotal), ' ') . ""; ?>" + "\n";
            receipt += "<?php $r++;
                endforeach; ?>";
            receipt += "\x1B\x61\x31";
            receipt += "<?=drawLine();?>\r\n";
            receipt += "\x1B\x61\x30";
            receipt += "<?= printLine(lang("total") . ": " . $this->erp->formatMoney($inv->total+$inv->product_tax)); ?>" + "\n";
            <?php if ($inv->order_tax != 0) { ?>
            receipt += "<?= printLine(lang("tax") . ": " . $this->erp->formatMoney($inv->order_tax)); ?>" + "\n";
            <?php } ?>
            <?php if ($inv->total_discount != 0) { ?>
            receipt += "<?= printLine(lang("discount") . ": (" . $this->erp->formatMoney($inv->product_discount).") ".$this->erp->formatMoney($inv->order_discount)); ?>" + "\n";
            <?php } ?>
            <?php if($pos_settings->rounding) { ?>
            receipt += "<?= printLine(lang("rounding") . ": " . $rounding); ?>" + "\n";
            receipt += "<?= printLine(lang("grand_total") . ": " . $this->erp->formatMoney($this->erp->roundMoney($inv->grand_total+$rounding))); ?>" + "\n";
            <?php } else { ?>
            receipt += "<?= printLine(lang("grand_total") . ": " . $this->erp->formatMoney($inv->grand_total)); ?>" + "\n";
            <?php } ?>
            <?php if($inv->paid < $inv->grand_total) { ?>
            receipt += "<?= printLine(lang("paid_amount") . ": " . $this->erp->formatMoney($inv->paid)); ?>" + "\n";
            receipt += "<?= printLine(lang("due_amount") . ": " . $this->erp->formatMoney($inv->grand_total-$inv->paid)); ?>" + "\n\n";
            <?php } ?>
            <?php
            if($payments) {
            foreach($payments as $payment) {
            if ($payment->paid_by == 'cash' && $payment->pos_paid) { ?>
            receipt += "<?= printLine(lang("paid_by") . ": " . lang($payment->paid_by)); ?>" + "\n";
            receipt += "<?= printLine(lang("amount") . ": " . $this->erp->formatMoney($payment->pos_paid)); ?>" + "\n";
            receipt += "<?= printLine(lang("change") . ": " . ($payment->pos_balance > 0 ? $this->erp->formatMoney($payment->pos_balance) : 0)); ?>" + "\n";
            <?php  } if (($payment->paid_by == 'CC' || $payment->paid_by == 'ppp' || $payment->paid_by == 'stripe') && $payment->cc_no) { ?>
            receipt += "<?= printLine(lang("paid_by") . ": " . lang($payment->paid_by)); ?>" + "\n";
            receipt += "<?= printLine(lang("amount") . ": " . $this->erp->formatMoney($payment->pos_paid)); ?>" + "\n";
            receipt += "<?= printLine(lang("card_no") . ": xxxx xxxx xxxx " . substr($payment->cc_no, -4)); ?>" + "\n";
            <?php } if ($payment->paid_by == 'Cheque' && $payment->cheque_no) { ?>
            receipt += "<?= printLine(lang("paid_by") . ": " . lang($payment->paid_by)); ?>" + "\n";
            receipt += "<?= printLine(lang("amount") . ": " . $this->erp->formatMoney($payment->pos_paid)); ?>" + "\n";
            receipt += "<?= printLine(lang("cheque_no") . ": " . $payment->cheque_no); ?>" + "\n";
            <?php if ($payment->paid_by == 'other' && $payment->amount) { ?>
            receipt += "<?= printLine(lang("paid_by") . ": " . lang($payment->paid_by)); ?>" + "\n";
            receipt += "<?= printLine(lang("amount") . ": " . $this->erp->formatMoney($payment->amount)); ?>" + "\n";
            receipt += "<?= printText(lang("payment_note") . ": " . $payment->note); ?>" + "\n";
            <?php }
            }

            }
            }

            if($Settings->invoice_view == 1) {
            if(!empty($tax_summary)) {
            ?>
            receipt += "\n" + "<?= lang('tax_summary'); ?>" + "\n";
            receipt += "<?= taxLine(lang('name'),lang('code'),lang('qty'),lang('tax_excl'),lang('tax_amt')); ?>" + "\n";
            receipt += "<?php foreach ($tax_summary as $summary): ?>";
            receipt += "<?= taxLine($summary['name'],$summary['code'],$this->erp->formatQuantity($summary['items']),$this->erp->formatMoney($summary['amt']),$this->erp->formatMoney($summary['tax'])); ?>" + "\n";
            receipt += "<?php endforeach; ?>";
            receipt += "<?= printLine(lang("total_tax_amount") . ":" . $this->erp->formatMoney($inv->product_tax)); ?>" + "\n";
            <?php
            }
            }
            ?>
            receipt += "\x1B\x61\x31";
            receipt += "\n" + "<?= $biller->invoice_footer ? printText(str_replace(array('\n', '\r'), ' ', $this->erp->decode_html($biller->invoice_footer))) : '' ?>" + "\n";
            receipt += "\x1B\x61\x30";
            <?php if(isset($pos_settings->cash_drawer_cose)) { ?>
            print(receipt, '', '<?=$pos_settings->cash_drawer_cose;?>');
            <?php } else { ?>
            print(receipt, '', '');
            <?php } ?>

        }

    </script>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#email').click(function () {
            var email = prompt("<?= lang("email_address"); ?>", "<?= $customer->email; ?>");
            if (email != null) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('pos/email_receipt') ?>",
                    data: {;<?= $this->security->get_csrf_token_name(); ?>:
                "<?= $this->security->get_csrf_hash(); ?>", email;
            :
                email, id;
            : <?= $inv->id; ?>},
                "json",
                    success;
            :

                function (data) {
                    alert(data.msg);
                }

            ,
                error: function () {
                    alert('<?= lang('ajax_request_failed'); ?>');
                    return false;
                }
            })
            }
            return false;
        });
    });
    <?php if (!$pos_settings->java_applet) { ?>
    $(window).load(function () {
        // window.print();
        <?php
        if($Settings->auto_print){?>
        setTimeout('window.close()', 5000);
        document.location.href = "<?=base_url()?>pos";
        <?php } ?>
    });
    <?php } ?>
</script>
</body>

</html>

<?php } ?>
