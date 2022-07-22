<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($organizationInfo,TRUE);
?>

<form action="" method="post" accept-charset="utf-8" id="companyform" class="form-horizontal" role="form" name="companyform" onsubmit="updateCompany();return false;">  
<div class="row">
<div class="col-md-4">
    <div class="submit-field">
        <label class="form-label"><?php echo __('contact_company_form_name','Company Name');?></label>
        <input type="text" class="form-control input-text with-border" value="<?php D($organizationInfo->organization_name)?>" name="name" id="name" placeholder="Enter Company Name">
        <span id="nameError" class="rerror"></span>
    </div>
</div>

<div class="col-md-4">
    <div class="submit-field">
        <label class="form-label"><?php echo __('contact_company_form_website','Website');?></label>
        <input type="text" class="form-control input-text with-border" value="<?php D($organizationInfo->organization_website)?>" name="website" id="website" placeholder="Enter Website">
        <span id="websiteError" class="rerror"></span>
    </div>
</div>

<div class="col-md-4">
    <!-- Account Type -->
    <div class="submit-field">
        <label class="form-label"><?php echo __('contact_company_form_tagline','Tagline');?></label>
        <input type="text" class="form-control input-text with-border" value="<?php D($organizationInfo->organization_heading)?>" name="heading" id="heading" placeholder="Enter Tagline">
        <span id="headingError" class="rerror"></span>
    </div>
</div>
</div>

    <!-- Account Type -->
    <div class="submit-field">
        <label class="form-label"><?php echo __('contact_company_diplay_description','Description');?></label>
        <textarea class="form-control textarea-text with-border" rows="1" name="info" id="info" placeholder="Enter Description"><?php D($organizationInfo->organization_info)?></textarea>
        <span id="infoError" class="rerror"></span>
    </div>
<a href="javascript:void(0)" class="btn btn-secondary me-2" id="cancel_company"><?php echo __('contact_company_form_cancel','Cancel');?> </a>
<button class="btn btn-site companyUpdateBTN"><?php echo __('contact_company_form_update','Update');?></button>


</form>