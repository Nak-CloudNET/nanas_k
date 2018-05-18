
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_customer'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo form_open_multipart("customers/edit/" . $customer->id, $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>

            <div class="form-group">
                <label class="control-label"
                       for="customer_group"><?php echo $this->lang->line("default_customer_group"); ?></label>
                <span class="text-danger" id="message"></span>
                <div class="controls"> <?php
                    foreach ($customer_groups as $customer_group) {
                        $cgs[$customer_group->id] = $customer_group->name;
                    }
                    echo form_dropdown('customer_group', $cgs, $customer->customer_group_id, 'class="form-control tip select" id="customer_group" style="width:100%;" required="required"');
                    ?>
                </div>
            </div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label"
							   for="price_group"><?php echo $this->lang->line("price_groups"); ?></label>

						<div class="controls"> <?php
							$pr_group[""] = "No Price Group";
							foreach ($price_groups as $price_group) {
								$pr_group[$price_group->id] = $price_group->name;
							}
							echo form_dropdown('price_groups', $pr_group, $customer->price_group_id, 'class="form-control tip select" id="price_groups" style="width:100%;" placeholder="' . lang("select") . ' ' . lang("price_groups") . '" ');
							?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group"> <?php
						echo lang("group_area", "group_area");
						$ga_group[""] = "Select Group Area";
						foreach ($group_areas as $group_area) {
							$ga_group[$group_area->areas_g_code] = $group_area->areas_group;
						}
						echo form_dropdown('group_area', $ga_group, $customer->group_areas_id, 'class="form-control tip select" id="group_area" style="width:100%;" placeholder="' . lang("select") . ' ' . lang("group_area") . '" ');
						?>
					</div>
				</div>
			</div>
            <div class="row">
                <div class="col-md-6">
					<?php if($setting->show_company_code == 1) { ?>
					<div class="form-group">
                        <?= lang("plate_number", "plate_number"); ?>
                        <?php echo form_input('code', $customer->code, 'class="form-control tip" id="code"  data-bv-notempty="true"'); ?>
                    </div>
					<?php } ?>
                    <div class="form-group person">
                        <?= lang("name", "name"); ?>
                        <?php echo form_input('name', $customer->name, 'class="form-control tip" id="name" required="required"'); ?>
                    </div>
					<div class="form-group person">
                        <?= lang("name_kh", "name_kh"); ?>
                        <?php echo form_input('name_kh', $customer->name_kh, 'class="form-control tip" id="name_kh"'); ?>
                    </div>					
                    <div class="form-group">
                        <?= lang("vat_no", "vat_no"); ?>
                        <?php echo form_input('vat_no', $customer->vat_no, 'class="form-control" id="vat_no"'); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("email_address", "email_address"); ?>
                        <input type="email" name="email" class="form-control" id="email_address"
                               value="<?= $customer->email ?>"/>
                    </div>
                    <div class="form-group">
                        <?= lang("phone", "phone"); ?>
                        <input type="tel" name="phone" class="form-control" id="phone"
                               value="<?= $customer->phone ?>" />
                    </div>
                    <div class="form-group">
                        <?= lang("address", "address"); ?> 
                        <?php echo form_input('address', $customer->address, 'class="form-control" id="address" data-bv-notempty="true"'); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("series", "series"); ?>
                        <?php echo form_input('address1', $customer->address_1, 'class="form-control" id="address1" '); ?>
                    </div>

                    <div class="form-group">
                        <?= lang("price", "price"); ?>
                        <?php echo form_input('address3', $customer->address_3, 'class="form-control" id="address3" '); ?>
                    </div>
					<div class="form-group">
						<?= lang('award_points', 'award_points'); ?>
						<?= form_input('award_points', set_value('award_points', $customer->award_points), 'class="form-control tip" id="award_points"'); ?>
					</div>
                </div>
                <div class="col-md-6">
                    <div class="form-group company">
                        <?= lang("company", "company"); ?>
                        <?php echo form_input('company', $customer->company, 'class="form-control tip" id="company"'); ?>
                    </div>					
					<div class="form-group">
                        <?= lang("Marital Status", "status"); ?>
                        <?php
                        $status[""] = "Select Status";
                        $status['single'] = "Single";
                        $status['married'] = "Married";
                        echo form_dropdown('status', $status, $customer->status, 'class="form-control select" id="status" placeholder="' . lang("select") . ' ' . lang("status") . '" style="width:100%"')
                        ?>
                    </div>
					
                    <div class="form-group">
                        <?= lang("gender", "gender"); ?>
                        <?php
                        $gender[""] = "Select Gender";
                        $gender['male'] = "Male";
                        $gender['female'] = "Female";
                        echo form_dropdown('gender', $gender, $customer->gender, 'class="form-control select" id="gender" placeholder="' . lang("select") . ' ' . lang("gender") . '" style="width:100%"')
                        ?>
                    </div>
					
					<div class="form-group">
                        <?= lang("Identity Number", "cf1"); ?>
                        <?php echo form_input('cf1', $customer->cf1, 'class="form-control" id="cf1"'); ?>
                    </div>
					<div class="form-group">
                        <?= lang("identify_date", "identify_date"); ?>
                        <?php echo form_input('identify_date', isset($customer->identify_date)?$this->erp->hrsd($customer->identify_date):'', 'class="form-control date" id="identify_date"'); ?>
                    </div>
                    <div class="form-group" style="margin-bottom: 24px">
                        <?= lang("more_attachment", "cf4"); ?><input id="attachment" type="file" name="userfile[]" data-show-upload="false" data-show-preview="false" multiple data-show-upload="true" data-show-upload="true" data-show-preview="true"
                       class="file">

                    </div>
                    <div class="form-group">
                        <?= lang("date_of_birth", "cf5"); ?> <?= lang("Ex: YYYY-MM-DD"); ?>
                         <?php echo form_input('date_of_birth', (($customer->date_of_birth)? $this->erp->hrsd($customer->date_of_birth):''), 'class="form-control date" id=" date_of_birth"'); ?>
					</div>
                    <div class="form-group">
                        <?= lang("brand", "brand"); ?>
                        <?php echo form_input('address2', $customer->address_2, 'class="form-control" id="address2" '); ?>
                    </div>
                    <div class="form-group">
                        <?= lang("color", "color"); ?>
                        <?php echo form_input('address4', $customer->address_4, 'class="form-control" id="address4" '); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 form-group">
                    <?= lang("note", "note"); ?>
                    <?php echo form_textarea('note', $customer->invoice_footer, 'class="form-control skip" id="note" style="height:115px;"'); ?>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <?php echo form_submit('edit_customer', lang('update_customer'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?= $modal_js ?>
<script type="text/javascript" charset="UTF-8">
    $(document).ready(function () {
        $.fn.datetimepicker.dates['erp'] = <?=$dp_lang?>;
        $(".date").datetimepicker({
            format: site.dateFormats.js_ldate,
            fontAwesome: true,
            language: 'erp',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0
        });
		
		$("#credit_limit").live('change',function(){
			var credit_limit = $(this).val()-0;
			if(isNaN(credit_limit)){
				$(this).val(0);
				return false;
			}
		});
		$("#group_area").live('change',function(){
			var group_area = $(this).val();
			var option = '';
			if(group_area!=''){
				$.ajax({
					type:"get",
					async:false,
					url: "<?= site_url('customers/get_sale_areas'); ?>",
					dataType: "json",
					data:{
						group_area:group_area
					},
					success:function(re){
						for(var i=0; i<re.length; i++){
							option +='<option value="'+re[i].areacode+'">'+re[i].areadescription+'</option>';
						}
					}
				});
				$('#sale_area').html(option);
				$('#sale_area').change();
				$('#sale_area_box').css("display","block");
			}else{
				$('#sale_area').html(option);
				$('#sale_area').change();
				$('#sale_area_box').css("display","none");
			}
		});

        $('#customer_group').on('change', function(e) {
            e.preventDefault();
            var makeup_cost=$('#customer_group').val();
            $.ajax({
                url: '<?= base_url() ?>customers/makeupCost/'+makeup_cost,
                dataType: 'json',
                success: function(result){
                    $.each(result, function(i,val){
                        var cost = val.makeup_cost;
                        if(cost==1){
                            var option=$('#price_groups option:first-child').val();
                            $("#price_groups").select2("val", option);
                            $("#price_groups").select2("readonly", true);
                            $('#message').html('  This customer group has makeup cost.So, can not select price groups !');
                        }
                        else{
                            $("#price_groups").select2("readonly", false);
                            $('#message').html('');
                        }
                    });
                }
            });
        });
    });
</script>

