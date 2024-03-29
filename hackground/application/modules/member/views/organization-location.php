<div class="row">
	<div class="col-sm-6">
		<form role="form" id="add_form" action="<?php echo $action; ?>" onsubmit="submitForm(this, event)">
			<input type="hidden" name="ID" value="<?php echo $organization_id;?>"/>
			<input type="hidden" name="page" value="<?php echo $page;?>"/>
			
					<div class="form-group">
						<label for="timezone">Timezone</label>
						<input type="text" class="form-control" name="organization_address[organization_timezone]" value="<?php echo !empty($detail['organization_address']['organization_timezone']) ? $detail['organization_address']['organization_timezone'] : '' ;?>"/>
					</div>
					
					<div class="form-group">
						<label for="country">Country</label>
						<select onchange="getCity(this.value)" class="form-control" name="organization_address[organization_country]">
							<option value="">-Select-</option>
							<?php print_select_option(get_all_country(), 'country_code', 'country_name', (!empty($detail['organization_address']['member_country']) ? $detail['organization_address']['member_country']['code'] : '')); ?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="address_1">Address Line 1</label>
						<input type="text" class="form-control" name="organization_address[organization_address_1]" value="<?php echo !empty($detail['organization_address']['organization_address_1']) ? $detail['organization_address']['organization_address_1'] : '' ;?>"/>
					</div>
					
					<div class="form-group">
						<label for="address_1">Address Line 2</label>
						<input type="text" class="form-control" name="organization_address[organization_address_2]" value="<?php echo !empty($detail['organization_address']['organization_address_2']) ? $detail['organization_address']['organization_address_2'] : '' ;?>"/>
					</div>
					<div class="form-group">
						<label for="organization_vat_number">VAT ID</label>
						<input type="text" class="form-control" name="organization_address[organization_vat_number]" value="<?php echo !empty($detail['organization_address']['organization_vat_number']) ? $detail['organization_address']['organization_vat_number'] : '' ;?>"/>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label for="city_id">City</label>
								<div id="city_section">
									<select class="form-control" name="organization_address[city_id]">
										<option value="">-Select-</option>
										<?php
										if(!empty($detail['organization_address']['member_country']['code'])){
											$country_code=$detail['organization_address']['member_country']['code'];
											$all_city=getAllCity(array('country_code'=>$country_code));
											if($all_city){
												foreach($all_city as $k=>$city){
													?>
													
													<option value="<?php echo $city->city_id;?>" <?php if(!empty($detail['organization_address']['city_id']) && $detail['organization_address']['city_id']== $city->city_id){echo 'selected';}?>><?php echo $city->city_name;?></option>
												<?php
												}
											}
											//print_select_option($all_city, 'city_id', 'city_name', (!empty($detail['organization_address']['city_id']) ? $detail['city_id']['city_id'] : ''));
										}
										
										  ?>
									</select>
								</div>
								<!-- <input type="text" class="form-control" name="organization_address[organization_city]" value="<?php echo !empty($detail['organization_address']['organization_city']) ? $detail['organization_address']['organization_city'] : '' ;?>"/> -->
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">
								<label for="organization_state">State</label>
								<input type="text" class="form-control" name="organization_address[organization_state]" value="<?php echo !empty($detail['organization_address']['organization_state']) ? $detail['organization_address']['organization_state'] : '' ;?>"/>
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">
								<label for="organization_pincode">Postal Code</label>
								<input type="text" class="form-control" name="organization_address[organization_pincode]" value="<?php echo !empty($detail['organization_address']['organization_pincode']) ? $detail['organization_address']['organization_pincode'] : '' ;?>"/>
							</div>
						</div>
						
					</div>
					
					<div class="form-group">
						<label for="organization_mobile">Phone </label>
						<input type="text" class="form-control" name="organization_address[organization_mobile]" value="<?php echo !empty($detail['organization_address']['organization_mobile']) ? $detail['organization_address']['organization_mobile'] : '' ;?>"/>
					</div>
					
					<button type="submit" class="btn btn-site">Save</button>
	
			
		</form>
</div>
</div>

<script>
function submitForm(form, evt){
	evt.preventDefault();
	ajaxSubmit($(form), onsuccess);
}
function getCity(country_code){
	var url = '<?php echo base_url($curr_controller.'/getcity');?>';
	$.ajax({
		url : url,
		data: {country_code: country_code},
		type: 'POST',
		
		success: function(res){
			$('#city_section').html(res);
			
		}
	});
}
function onsuccess(res){
	if(res.cmd && res.cmd == 'reload'){
		location.reload();
	}
}

</script>