<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($organizationInfo,TRUE);
?>

<div class="row">
    <div class="col-md-4">
        <div class="submit-field">
            <label class="form-label"><?php echo __('contact_company_location_owner','Owner');?></label>
            <p><?php ucwords(D($organizationInfo->member_name));?></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="submit-field">
            <label class="form-label"><?php echo __('contact_company_location_phone','Phone');?></label>
            <?php if($organizationInfo->organization_mobile){?>
            <p><?php D($organizationInfo->organization_mobile_code." "); D($organizationInfo->organization_mobile)?></p>
            <?php }?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="submit-field">
            <label class="form-label"><?php echo __('contact_company_location_vat','VAT ID');?></label>
            <?php if($organizationInfo->organization_vat_number){?>
            <p><?php D($organizationInfo->organization_vat_number)?></p>
            <?php }?>
        </div>
    </div>
    
<?php if($organizationInfo->organization_timezone){?>
        <div class="col-md-4">
            <div class="submit-field">
                <label class="form-label"><?php echo __('contact_company_location_time','Time Zone');?></label>
                <p><?php D($organizationInfo->organization_timezone)?></p>
            </div>
        </div>
<?php }?>


    <div class="col-md-4">
        <div class="submit-field">
            <label class="form-label"><?php echo __('contact_company_location_address','Address');?></label>
            <p>
            <?php if($organizationInfo->organization_address_1){?>
            <?php D($organizationInfo->organization_address_1)?><br/>
            <?php }?>
            <?php if($organizationInfo->organization_address_2){?>
            <?php D($organizationInfo->organization_address_2)?><br/>
            <?php }?>

            <?php if($organizationInfo->city_name){?>
            <?php D($organizationInfo->city_name)?>,  
            <?php }?>
            <?php if($organizationInfo->organization_state){?>
            <?php D($organizationInfo->organization_state)?> 
            <?php }?>
            <?php if($organizationInfo->organization_pincode){?>
            <?php D($organizationInfo->organization_pincode)?> 
            <?php }?>

            <?php if($organizationInfo->country_name){?>
            <br/>
            <?php D($organizationInfo->country_name)?>
            <?php }?>	
            </p>
        </div>
	</div>  
</div>