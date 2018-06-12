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
                            <th><?= lang("tran_type"); ?></th>
						</tr>
					</thead>
					
					<tbody>
                    <?php
                    $balance = 0;
                    foreach ($gift_cards as $gift_card) {
                        $balance = $gift_card->balance;
                        $packages = $this->sales_model->getPackagesByGiftCardID($gift_card->gift_card_id, $gift_card->sale_id);
                        ?>
                        <tr>
                            <td><?= $gift_card->date ?></td>
                            <td><?= $gift_card->card_no ?></td>
                            <td><?= $gift_card->payment_ref ?></td>
                            <td><?= $gift_card->sale_ref ?></td>
                            <td class="text-center"><?= $this->erp->formatMoney($gift_card->amount) ?></td>
                            <td>
                                <?php if ($packages) { ?>
                                    <select name="package" class="form-control">
                                        <option><?= $gift_card->package_name ?></option>
                                        <?php foreach ($packages as $package) { ?>
                                            <option value="<?= $package->id ?>"><?= $package->item_name ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                            </td>
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
                            <th class="text-center"><?= lang("tran_type"); ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
        </div>
    </div>
</div>
