<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($organizationInfo,TRUE);
?>

<form action="" method="post" accept-charset="utf-8" id="locationform" class="form-horizontal" role="form" name="locationform" onsubmit="updateLocation();return false;">  
		
        <div class="submit-field">
            <label class="form-label"><?php echo __('contact_company_location_owner','Owner');?></label>
            <p><?php ucwords(D($organizationInfo->member_name));?></p>
        </div>
        
		<div class="row">
			<div class="col-xl-2">
				<div class="submit-field">
					<label class="form-label"><?php echo __('contact_company_location_phone','Phone');?></label>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_mobile_code)?>" name="mobile_code" id="mobile_code" placeholder="Enter mobile code">
					<span id="mobile_codeError" class="rerror"></span>
				</div>
			</div>
			<div class="col-xl-10">
				<div class="submit-field">
					<label class="form-label">&nbsp;</label>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_mobile)?>" name="mobile" id="mobile" placeholder="Enter mobile">
					<span id="mobileError" class="rerror"></span>
				</div>
			</div>
		</div>	
        
		<div class="row">	
			<div class="col-md-4">
				<div class="submit-field">
					<label class="form-label"><?php echo __('contact_company_location_vat','VAT ID');?></label>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_vat_number)?>" name="vat_number" id="vat_number" placeholder="Enter VAT ID">
					<span id="vat_numberError" class="rerror"></span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="submit-field">
					<label class="form-label"><?php echo __('contact_company_location_time','Time Zone');?></label>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_timezone)?>" name="timezone" id="timezone" placeholder="Enter timezone">
					<span id="timezoneError" class="rerror"></span>
				</div>
			</div>
			<div class="col-md-4">       	
	        	<div class="submit-field remove_arrow_select">
	            	<label class="form-label"><?php echo __('contact_company_location_country','Country:');?></label>  
	            	<select name="country" id="country" data-size="4" class="selectpicker" title="Select Country" data-live-search="true">
	            		<?php
	            		if($country){
							foreach($country as $country_list){
								?>
								<option value="<?php echo $country_list->country_code;?>" <?php if($country_list->country_code==$organizationInfo->organization_country){echo 'selected';}?>><?php echo ucfirst($country_list->country_name);?></option>
								<?php
							}
						}
	            		 ?>
	            	</select>          	
	        	</div>
	        	<span id="countryError" class="rerror"></span>
	        </div>
			
        </div>    

        <div class="submit-field">
            <label class="form-label"><?php echo __('contact_company_location_address','Address');?></label>
            <input type="text" class="form-control mb-3" value="<?php D($organizationInfo->organization_address_1)?>" name="address_1" id="address_1" placeholder="Enter address line 1">
            <input type="text" class="form-control" value="<?php D($organizationInfo->organization_address_2)?>" name="address_2" id="address_2" placeholder="Enter address line 2">
            <span id="address_1Error" class="rerror"></span>
        </div>
		
		<div class="row">	
			<div class="col-md-4">
				<div class="submit-field remove_arrow_select">
					<label class="form-label"><?php echo __('setting_contact_info_city','City');?></label>  
					<div id="load_city">
						<select name="city_id" id="city_id" data-size="4" class=" selectpicker" title="Select city" data-live-search="true">
							<?php
							if($city){
								foreach($city as $city_list){
									?>
									<option value="<?php echo $city_list->city_id;?>" <?php if($city_list->city_id==$organizationInfo->city_id){echo 'selected';}?>><?php echo ucfirst($city_list->city_name);?></option>
									<?php
								}
							}
								?>
						</select> 
					</div>
					<span id="city_idError" class="rerror"></span>
				</div>
			</div>
			<!-- <div class="col-md-4">
				<div class="submit-field">
					<label class="form-label"><?php echo __('contact_company_location_city','City');?></label>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_city)?>" name="city" id="city" placeholder="Enter city">
					<span id="cityError" class="rerror"></span>
				</div>
			</div> -->
			<div class="col-md-4">
				<div class="submit-field">
					<label class="form-label"><?php echo __('contact_company_location_state','State');?></label>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_state)?>" name="state" id="state" placeholder="Enter state">
					<span id="stateError" class="rerror"></span>
				</div>
			</div>
            <div class="col-md-4">
				<div class="submit-field">
					<label class="form-label"><?php echo __('contact_company_location_zip','Zip');?></label>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_pincode)?>" name="pincode" id="pincode" placeholder="Enter pincode">
					<span id="pincodeError" class="rerror"></span>
				</div>
			</div>
		</div>		
		<a href="javascript:void(0)" class="btn btn-secondary me-2" id="cancel_location"><?php echo __('contact_company_form_cancel','Cancel');?> </a>
		<button class="btn btn-site locationUpdateBTN"><?php echo __('contact_company_form_update','Update');?></button>
		
		</form>