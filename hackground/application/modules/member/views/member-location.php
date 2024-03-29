<div class="row">
	<div class="col-sm-6">
		<form role="form" id="add_form" action="<?php echo $action; ?>" onsubmit="submitForm(this, event)">
			<input type="hidden" name="ID" value="<?php echo $member_id;?>"/>
			<input type="hidden" name="page" value="<?php echo $page;?>"/>
			
					<div class="form-group">
						<label for="timezone">Timezone</label>
						<input type="text" class="form-control" name="member_address[member_timezone]" value="<?php echo !empty($detail['member_address']['member_timezone']) ? $detail['member_address']['member_timezone'] : '' ;?>"/>
					</div>
					
					<div class="form-group">
						<label for="country">Country</label>
						<select onchange="getCity(this.value)" class="form-control" name="member_address[member_country]">
							<option value="">-Select-</option>
							<?php print_select_option(get_all_country(), 'country_code', 'country_name', (!empty($detail['member_address']['member_country']) ? $detail['member_address']['member_country']['code'] : '')); ?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="address_1">Address Line 1</label>
						<input type="text" class="form-control" name="member_address[member_address_1]" value="<?php echo !empty($detail['member_address']['member_address_1']) ? $detail['member_address']['member_address_1'] : '' ;?>"/>
					</div>
					
					<div class="form-group">
						<label for="address_1">Address Line 2</label>
						<input type="text" class="form-control" name="member_address[member_address_2]" value="<?php echo !empty($detail['member_address']['member_address_2']) ? $detail['member_address']['member_address_2'] : '' ;?>"/>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<label for="member_city">City</label>
								<div id="city_section">
									<select class="form-control" name="member_address[city_id]">
										<option value="">-Select-</option>
										<?php
										if(!empty($detail['member_address']['member_country']['code'])){
											$country_code=$detail['member_address']['member_country']['code'];
											$all_city=getAllCity(array('country_code'=>$country_code));
											if($all_city){
												foreach($all_city as $k=>$city){
													?>
													
													<option value="<?php echo $city->city_id;?>" <?php if(!empty($detail['member_address']['city_id']) && $detail['member_address']['city_id']== $city->city_id){echo 'selected';}?>><?php echo $city->city_name;?></option>
												<?php
												}
											}
											//print_select_option($all_city, 'city_id', 'city_name', (!empty($detail['member_address']['city_id']) ? $detail['city_id']['city_id'] : ''));
										}
										
										  ?>
									</select>
								</div>
								<!-- <input type="text" class="form-control" name="member_address[member_city]" value="<?php echo !empty($detail['member_address']['member_city']) ? $detail['member_address']['member_city'] : '' ;?>"/> -->
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">
								<label for="member_state">State</label>
								<input type="text" class="form-control" name="member_address[member_state]" value="<?php echo !empty($detail['member_address']['member_state']) ? $detail['member_address']['member_state'] : '' ;?>"/>
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="form-group">
								<label for="member_pincode">Postal Code</label>
								<input type="text" class="form-control" name="member_address[member_pincode]" value="<?php echo !empty($detail['member_address']['member_pincode']) ? $detail['member_address']['member_pincode'] : '' ;?>"/>
							</div>
						</div>
						
					</div>
					
					<div class="form-group">
						<label for="member_mobile">Phone </label>
						<input type="text" class="form-control" name="member_address[member_mobile]" value="<?php echo !empty($detail['member_address']['member_mobile']) ? $detail['member_address']['member_mobile'] : '' ;?>"/>
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

function onsuccess(res){
	if(res.cmd && res.cmd == 'reload'){
		location.reload();
	}
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
</script>