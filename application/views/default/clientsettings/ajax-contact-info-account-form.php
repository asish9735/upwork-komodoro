<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>

<form action="" method="post" accept-charset="utf-8" id="accountinfoform" class="form-horizontal" role="form" name="accountinfoform" onsubmit="updateAccountInfo();return false;">  
		<div class="row">

			<div class="col-md-4">
				<div class="submit-field">
					<h5><?php echo __('contact_company_account_name','Name');?></h5>
					<input type="text" class="form-control input-text with-border" value="<?php D($memberInfo->member_name)?>" name="name" id="name" placeholder="Enter Name">
					<span id="fnameError" class="rerror"></span>
				</div>
			</div>

			<div class="col-md-4">
				<div class="submit-field">
					<h5><?php echo __('contact_company_form_name','Company Name');?></h5>
					<input type="text" class="form-control input-text with-border" value="<?php D($memberInfo->organization_name)?>" name="company_name" id="company_name" placeholder="Enter Company Name">
					<span id="company_nameError" class="rerror"></span>
				</div>
			</div>

			<div class="col-md-4">
				<!-- Account Type -->
				<div class="submit-field">
					<h5><?php echo __('contact_company_account_email','Email');?></h5>
					<input type="text" class="form-control input-text with-border" value="<?php D($memberInfo->member_email)?>" name="email" id="email" placeholder="Enter email address" readonly>
					<span id="emailError" class="rerror"></span>
				</div>
			</div>
			<div class="col-md-4">
			<button class="button ripple-effect accountUpdateBTN"><?php echo __('contact_company_form_update','Update');?></button>
			<a href="javascript:void(0)" class="popup-with-zoom-anim button-sliding-icon padding-left-20" id="cancel_account_info"><?php echo __('contact_company_form_cancel','Cancel');?> </a>
			</div>
		</div>
		</form>