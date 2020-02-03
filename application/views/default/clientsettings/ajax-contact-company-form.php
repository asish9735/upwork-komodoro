<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($organizationInfo,TRUE);
?>

<form action="" method="post" accept-charset="utf-8" id="companyform" class="form-horizontal" role="form" name="companyform" onsubmit="updateCompany();return false;">  
<div class="row">
<div class="col-md-4">
    <div class="submit-field">
        <h5>Company Name</h5>
        <input type="text" class="form-control input-text with-border" value="<?php D($organizationInfo->organization_name)?>" name="name" id="name" placeholder="Enter Company Name">
        <span id="nameError" class="rerror"></span>
    </div>
</div>

<div class="col-md-4">
    <div class="submit-field">
        <h5>Website</h5>
        <input type="text" class="form-control input-text with-border" value="<?php D($organizationInfo->organization_website)?>" name="website" id="website" placeholder="Enter Website">
        <span id="websiteError" class="rerror"></span>
    </div>
</div>

<div class="col-md-4">
    <!-- Account Type -->
    <div class="submit-field">
        <h5>Tagline</h5>
        <input type="text" class="form-control input-text with-border" value="<?php D($organizationInfo->organization_heading)?>" name="heading" id="heading" placeholder="Enter Tagline">
        <span id="headingError" class="rerror"></span>
    </div>
</div>
</div>

    <!-- Account Type -->
    <div class="submit-field">
        <h5>Description</h5>
        <textarea class="form-control textarea-text with-border" rows="1" name="info" id="info" placeholder="Enter Description"><?php D($organizationInfo->organization_info)?></textarea>
        <span id="infoError" class="rerror"></span>
    </div>

<button class="button ripple-effect companyUpdateBTN">Update</button>
<a href="javascript:void(0)" class="popup-with-zoom-anim button-sliding-icon padding-left-20" id="cancel_company">Cancel </a>

</form>