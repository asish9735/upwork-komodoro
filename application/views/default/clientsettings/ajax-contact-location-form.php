<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($organizationInfo,TRUE);
?>

<form action="" method="post" accept-charset="utf-8" id="locationform" class="form-horizontal" role="form" name="locationform" onsubmit="updateLocation();return false;">  
		
        <div class="submit-field">
            <h5>Owner</h5>
            <p><?php ucwords(D($organizationInfo->member_name));?></p>
        </div>
        
		<div class="row">
			<div class="col-xl-2">
				<div class="submit-field">
					<h5>Phone</h5>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_mobile_code)?>" name="mobile_code" id="mobile_code" placeholder="Enter mobile code">
					<span id="mobile_codeError" class="rerror"></span>
				</div>
			</div>
			<div class="col-xl-10">
				<div class="submit-field">
					<h5>&nbsp;</h5>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_mobile)?>" name="mobile" id="mobile" placeholder="Enter mobile">
					<span id="mobileError" class="rerror"></span>
				</div>
			</div>
		</div>	
        
		<div class="row">	
			<div class="col-md-4">
				<div class="submit-field">
					<h5>VAT ID</h5>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_vat_number)?>" name="vat_number" id="vat_number" placeholder="Enter VAT ID">
					<span id="vat_numberError" class="rerror"></span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="submit-field">
					<h5>Time Zone</h5>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_timezone)?>" name="timezone" id="timezone" placeholder="Enter timezone">
					<span id="timezoneError" class="rerror"></span>
				</div>
			</div>
			<div class="col-md-4">       	
	        	<div class="submit-field remove_arrow_select">
	            	<h5>Country:</h5>  
	            	<select name="country" id="country" data-size="4" class="form-control selectpicker" title="Select Country" data-live-search="true">
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
            <h5>Address</h5>
            <input type="text" class="form-control mb-3" value="<?php D($organizationInfo->organization_address_1)?>" name="address_1" id="address_1" placeholder="Enter address line 1">
            <input type="text" class="form-control" value="<?php D($organizationInfo->organization_address_2)?>" name="address_2" id="address_2" placeholder="Enter address line 2">
            <span id="address_1Error" class="rerror"></span>
        </div>
		
		<div class="row">	
			<div class="col-md-4">
				<div class="submit-field">
					<h5>City</h5>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_city)?>" name="city" id="city" placeholder="Enter city">
					<span id="cityError" class="rerror"></span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="submit-field">
					<h5>State</h5>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_state)?>" name="state" id="state" placeholder="Enter state">
					<span id="stateError" class="rerror"></span>
				</div>
			</div>
            <div class="col-md-4">
				<div class="submit-field">
					<h5>Zip</h5>
					<input type="text" class="form-control" value="<?php D($organizationInfo->organization_pincode)?>" name="pincode" id="pincode" placeholder="Enter pincode">
					<span id="pincodeError" class="rerror"></span>
				</div>
			</div>
		</div>		
		
		<button class="button ripple-effect locationUpdateBTN">Update</button>
		<a href="javascript:void(0)" class="popup-with-zoom-anim button-sliding-icon padding-left-20" id="cancel_location">Cancel </a>
		</form>