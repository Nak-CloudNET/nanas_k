<div class="modal-dialog" style="width:70% !important;">
    <div class="modal-content">
        <div class="modal-header no-print">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?= lang('view_gift_card_history'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-condensed reports-table">
					<thead>
						<tr>
							<th><?= lang("date"); ?></th>
                            <th><?= lang("card_number"); ?></th>
							<th><?= lang("payment_ref"); ?></th>
							<th><?= lang("sale_ref"); ?></th>
							<th><?= lang("amount"); ?></th>
                            <th style="width: 25%"><?= lang("package"); ?></th>
                            <th><?= lang("expiry_date"); ?></th>
                            <th><?= lang("tran_type"); ?></th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $balance = 0;
                    foreach ($gift_cards as $gift_card) {
                        $balance = $gift_card->balance;
                        $combo_items = $this->sales_model->getComboItemsByProductCode($gift_card->product_code);

                        ?>
                        <tr>
                            <td><?= $gift_card->date ?></td>
                            <td><?= $gift_card->card_no ?></td>
                            <td><?= $gift_card->payment_ref ?></td>
                            <td><?= $gift_card->sale_ref ?></td>
                            <td class="text-center"><?= $this->erp->formatMoney($gift_card->amount) ?></td>
                            <td>
                                <!-- <span style="font-size: 16px"><strong><u><?= $gift_card->package_size ? $gift_card->package_size : $gift_card->product_name; ?></u></strong></span> -->
                                <?php
                                /*$package_items = $this->sales_model->getAllPackageItemsData($gift_card->package_id, $gift_card->sale_id);
                                if ($gift_card->payment_ref && $gift_card->amount > 0) {
                                    foreach ($package_items as $package_item) { ?>
                                        <dl style="margin-left: 10px; margin-bottom: 0px">
                                                <dt style="font-size: 14px">
                                                    <strong><?= ucfirst($package_item->package_item_name) ?></strong>
                                                </dt>
                                                    <dd style="padding-left: 20px;">
                                                        <span style="font-weight: bold">
                                                        (
                                                        Qty = <?= $this->erp->formatQuantity($package_item->qty); ?> |
                                                        Qty used = <?= $this->erp->formatQuantity($package_item->qty_used); ?>
                                                            |
                                                        Qty balance = <?= $this->erp->formatQuantity($package_item->qty_balance); ?>
                                                            )
                                                    </span>
                                                    </dd>
                                            </dl>
                                            <?php
                                    }
                                }*/

                                $gcards = $this->sales_model->getAllPackagesByCardNoNSaleID($gift_card->card_no, $gift_card->sale_id);

                                if ($gift_card->payment_ref && $gift_card->amount > 0) {
                                    foreach ($gcards as $gcard) {
                                        $packages = $this->sales_model->getPackagesByCardIDAndSaleID($gcard->package_id, $gcard->sale_id);
                                        ?>
                                        <dl style="margin-left: 10px; margin-bottom: 10px">
                                            <dt style="font-size: 16px">
                                                <strong><u><?= ucfirst($gcard->package_size) . ' (' . substr($gcard->package_name, -1) . ')' ?></u></strong>
                                            </dt>
                                            <?php foreach ($packages as $package) { ?>
                                                <dd style="padding-left: 20px;" value="<?= $package->id ?>">
                                                    <?= $package->package_item_name ?><br/>
                                                    <span style="font-weight: bold">
                                                        <?php if ($package->qty == '500') { ?>
                                                            Unlimited
                                                        <?php } else { ?>
                                                            (
                                                            Qty = <?= $this->erp->formatQuantity($package->qty); ?> |
                                                            Qty used = <?= $this->erp->formatQuantity($package->qty_used); ?> |
                                                            Qty balance = <?= $this->erp->formatQuantity($package->qty_balance); ?>
                                                            )
                                                        <?php } ?>
                                                    </span>
                                                </dd>
                                            <?php } ?>
                                        </dl>
                                    <?php }
                                }

                                foreach ($combo_items as $combo_item) {
                                    if ($gift_card->product_code == $combo_item->item_code) {
                                        echo '<p>'.$gift_card->product_name.'</p>';
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $this->erp->hrsd($gift_card->expiry_date) != '0000-00-00' ? $this->erp->hrsd($gift_card->expiry_date) : ''; ?></td>
                            <td class="text-center">
                                <?php
                                if ($gift_card->transaction_type == 'created') {
                                    echo '<div class="text-center"><span class="label" style="background-color:DodgerBlue;"><i class="fa fa-plus-circle" aria-hidden="true"></i>  
' . ucwords($gift_card->transaction_type) . '</span></div>';
                                } elseif ($gift_card->transaction_type == 'added') {
                                    echo '<div class="text-center"><span class="label" style="background-color:Tomato;"><i class="fa fa-plus-square" aria-hidden="true"></i> 
 ' . ucwords($gift_card->transaction_type) . '</span></div>';
                                } elseif ($gift_card->transaction_type == 'updated') {
                                    echo '<div class="text-center"><span class="label" style="background-color:Orange;"><i class="fa fa-pencil-square" aria-hidden="true"></i> 
 ' . ucwords($gift_card->transaction_type) . '</span></div>';
                                } elseif ($gift_card->transaction_type == 'paid') {
                                    echo '<div class="text-center"><span class="label label-success"><i class="fa fa-money" aria-hidden="true"></i> 
 ' . ucwords($gift_card->transaction_type) . '</span></div>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
					</tbody>
					<tfoot class="dtFilter">
						<tr class="active">
                            <th class="text-center"><?= lang("date"); ?></th>
                            <th class="text-center"><?= lang("card_number"); ?></th>
                            <th class="text-center"><?= lang("payment_ref"); ?></th>
                            <th class="text-center"><?= lang("sale_ref"); ?></th>
                            <th class="text-center"><?= $this->erp->formatMoney($balance) ?></th>
                            <th class="text-center"><?= lang("package"); ?></th>
                            <th class="text-center"><?= lang("expiry_date"); ?></th>
                            <th class="text-center"><?= lang("tran_type"); ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
        </div>
    </div>
</div>
